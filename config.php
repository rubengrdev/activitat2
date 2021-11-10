<?php
define('APP',__DIR__);
//datos acceso db
$dbname= $_ENV['DB_NAME'];
$dbhost = $_ENV['DB_HOST'];
$dbuser= $_ENV['DB_USER'];
$dbpasswd= $_ENV['DB_PASSWORD'];
$dsn='mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8mb4';
