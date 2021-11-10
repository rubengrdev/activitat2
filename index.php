<?php
session_start();
 //establecer errores
 ini_set('display_errors', 'On');


require 'vendor/autoload.php';
//access .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
//acceso a las variables de entorno
require 'config.php';
require APP.'/src/route.php';


$controller=getRoute();
require APP.'/src/controllers/'.$controller.'.php';

