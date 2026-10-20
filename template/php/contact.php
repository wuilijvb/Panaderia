<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
function respond(int $status,bool $ok,string $message): never { http_response_code($status); echo json_encode(['ok'=>$ok,'message'=>$message],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); exit; }
if(($_SERVER['REQUEST_METHOD']??'')!=='POST'){header('Allow: POST');respond(405,false,'Method not allowed.');}
if(trim((string)($_POST['website']??''))!=='') respond(200,true,'Reservation request received.');
$name=trim((string)($_POST['name']??''));$email=trim((string)($_POST['email']??''));$date=trim((string)($_POST['date']??''));$guests=trim((string)($_POST['guests']??'2'));$message=trim((string)($_POST['message']??''));
if($name===''||strlen($name)>100) respond(422,false,'Please enter a valid name.');
if(!filter_var($email,FILTER_VALIDATE_EMAIL)||strlen($email)>160) respond(422,false,'Please enter a valid email.');
if(!preg_match('/^\d{4}-\d{2}-\d{2}$/',$date)) respond(422,false,'Please choose a valid date.');
$parts=array_map('intval',explode('-',$date)); if(count($parts)!==3||!checkdate($parts[1],$parts[2],$parts[0])) respond(422,false,'Please choose a valid date.');
$requestedDate=DateTimeImmutable::createFromFormat('!Y-m-d',$date); $today=new DateTimeImmutable('today'); if(!$requestedDate||$requestedDate<$today) respond(422,false,'Please choose a future reservation date.');
$allowed=['2','3','4','5','6','7+']; if(!in_array($guests,$allowed,true)) respond(422,false,'Please choose a valid party size.');
if(strlen($message)>2000) respond(422,false,'Notes are too long.');
foreach([$name,$email] as $value) if(preg_match('/[\r\n]/',$value)) respond(422,false,'Invalid header value.');
$recipient=getenv('CONTACT_TO_EMAIL')?:''; if($recipient===''||!filter_var($recipient,FILTER_VALIDATE_EMAIL)) respond(503,false,'Reservation recipient is not configured. Set CONTACT_TO_EMAIL on the server.');
$server=preg_replace('/[^a-z0-9.-]/i','',$_SERVER['SERVER_NAME']??'localhost');
$subject='Ember Table reservation request — '.$date;
$body=implode("\n",['New reservation request','-----------------------','Name: '.strip_tags($name),'Email: '.$email,'Date: '.$date,'Guests: '.$guests,'','Notes:',strip_tags($message?:'None')]);
$headers=['From: Website <no-reply@'.$server.'>','Reply-To: '.$email,'Content-Type: text/plain; charset=UTF-8'];
if(!mail($recipient,$subject,$body,implode("\r\n",$headers))) respond(500,false,'The server could not send the reservation request. Please try again later.');
respond(200,true,'Reservation request received. We will confirm availability separately.');
