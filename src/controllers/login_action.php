<?php

require APP.'/lib/render.php';
require './config.php';
require './lib/con.php';
require './src/db/database.php';
require './lib/functionality.php';

if(isset($_COOKIE['rememberdata'])){
    header('location:?url=dashboard');
}

$email = filter_input(INPUT_POST,'email');
$password = filter_input(INPUT_POST,'password');
$remember = filter_input(INPUT_POST,"remember");



if($email !=null && $password !=null){
    $gdb = getconnection($dsn, $dbuser, $dbpasswd); //conseguimos la conexión
    $auth = authentication($gdb, $email, $password); //autenticamos los datos
    if($auth){
        //comprobación de si el usuario ha seleccionado el checkbox de recordarme en este equipo
        if(isset($remember)){
            $data = $email . $password;
            setcookie("rememberdata", $data,time()+86000);
        }
        
        //guardamos datos de el usuario en la variable profile (vease. function on /db/database.php linea 87)
        $profile = getProfile($gdb,$email);
        //creación de sesiones
        $_SESSION["profile"]= $profile;
        $_SESSION["email"]=$email;
        //creación de cookies de uso
        //creamos datos para la información del usuario (role)
        setcookie("role", getRole($gdb,$profile["id"]), 0, time()+86000);
        //creación de cookie con información del usuario
        setcookie("getUser", getUser($gdb,$email),time()+86000);
        $date=date("F j, Y, g:i a");
        //creacion de cookie con la fecha actual
        setcookie("getDate", $date, 0 ,time()+3600);
        sessionStatus();//crea la cookie status, funciona gracias a la sesión profile (login_action linea 29)
        //cuando todo el trabajo se completa accedemos a la vista del usuario
        header('location:?url=dashboard');
    }else{
    header('location:?url=login');
    }
}else{
    header('location:?url=login');
}

