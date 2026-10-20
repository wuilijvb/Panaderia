<?php
declare(strict_types=1);
$sessionDirectory = __DIR__ . '/data/sessions';
if (!is_dir($sessionDirectory)) mkdir($sessionDirectory, 0770, true);
session_save_path($sessionDirectory);
session_start(['cookie_httponly' => true, 'cookie_samesite' => 'Strict', 'use_strict_mode' => true]);
