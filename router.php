<?php
$path = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if (preg_match('~/(data|docs|database)(/|$)|\.(sql|md)$~i', $path)) { http_response_code(403); exit('Acceso restringido'); }
if (preg_match('~^/api(?:/(.*))?$~', $path, $match)) { $_GET['path']=trim($match[1]??'','/'); require __DIR__.'/api.php'; exit; }
return false;
