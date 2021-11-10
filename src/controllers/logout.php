<?php
session_destroy();  //cuando el usuario haga logout las variables de sessión se borrarán
if(isset($_COOKIE['rememberdata'])){
    setcookie('rememberdata', false, time()+0);  //borramos la variable rememberdata
    setcookie("getDate", false, time()+0);   //borramos la variable getDate
    setcookie("getUser", false, time()+0);
    //Apunte: La variable getDate no se puede eliminar, así que en el archivo /resources/date.js se implementa la configuración de 
    //que si la sessión rememberdata deja de existir no se mostrará en el home la última visit
}
header('location:?url=home');