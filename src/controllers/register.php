<?php
//ini_set('display_errors', 'On');
require APP.'/lib/render.php';
require './lib/functionality.php';
cookiePolicyAccept();   //si no aceptamos las cookies no hay servicio
if(isset($_COOKIE['rememberdata']) || isset($_COOKIE["status"])){
    if($_COOKIE["status"] == "active" && isset($_SESSION["profile"])){
    header('location:?url=dashboard');
    }
}
echo render("register",["nom" => "register"]);
$_SESSION["location"]=breadcrumbs();
setcookie("location", $_SESSION["location"],time()+86000);