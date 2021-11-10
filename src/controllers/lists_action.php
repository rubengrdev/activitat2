<?php
require APP.'/lib/render.php';
require './lib/functionality.php';
require './src/db/database.php';
require './config.php';
require './lib/con.php';
//comprovación previa de que no ha habido problemas y la conexión con el usuario es estable
cookiePolicyAccept();   //si no aceptamos las cookies no hay servicio

if($_COOKIE["status"] != "active"){
    header('location:?url=login');
}

//sessión con toda la información del usuario
$userId = $_SESSION["profile"]["id"];
//la id del usuario es clave foranea en la tabla listas, hace referencia a el campo propietary a continuación almacenaremos todas las listas de el usuario actual
$gdb = getconnection($dsn, $dbuser, $dbpasswd); //conseguimos la conexión con la base de datos
$lists = getLists($gdb, $userId);

if($lists != null){
    //en este caso si que se han encontrado listas del usuario, a continuacón debemos preparar los datos del AssocArray que nos ha devuelto la función getLists()
    //"Descargamos" o "volcamos" los datos de la BD
    $structuredData = downloadList($gdb,$lists);
    //función que nos pasa una array a contenido legible en HTML
    $HTMLList=createListsHTML($structuredData);
    //guardamos la información en una sessión
    $_SESSION["htmllist"]=$HTMLList;
    header('location:?url=lists');
}elseif($lists === 0){
    header('location:?url=lists');
}else{
    //este caso es muy raro, hago este else por poner una tercera condición y curarme de páginas que no funcionan, en el caso de que esta consulta no funcione llevaremos al usuario a un sitio seguro
    header('location:?url=dashboard');
}