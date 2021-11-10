<?php
//ini_set('display_errors', 'On');
require './lib/functionality.php';
require APP.'/lib/render.php';
cookiePolicyAccept();   //si no aceptamos cookies no hay servicio
//si el usuario ha guardado anteriormente los datos usando el checkbox o no ha cerrado la sessión no pasaremos por el login, si no que usaremos los datos almacenados para otorgar el servicio
if(isset($_COOKIE['rememberdata']) || isset($_COOKIE["status"])){
    if($_COOKIE["status"] == "active" && isset($_SESSION["profile"])){
    header('location:?url=dashboard');
    }
}
echo render("login",["nom" => "login"]);

$_SESSION["location"]=breadcrumbs();
setcookie("location", $_SESSION["location"],time()+86000);