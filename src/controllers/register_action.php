<?php
require APP.'/lib/render.php';
require './config.php';
require './lib/con.php';
require './src/db/database.php';
require './lib/functionality.php';

$username = filter_var(filter_input(INPUT_POST,'username'),FILTER_SANITIZE_STRING);
$email = filter_var(filter_input(INPUT_POST,'email'),FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST,'password');
$passwordConfirmation = filter_input(INPUT_POST,'passwordConfirmation');

if($username !=null && $email !=null && $password !=null){
     //comprovación de que las dos contraseñas son correctas
    if(passwordVerify($password, $passwordConfirmation)){
    $gdb = getconnection($dsn, $dbuser, $dbpasswd); //conseguimos la conexión
    if(noRedundancy($gdb,$email) != true){  //tal vez no queda claro, pero lo que queremos es que no haya redundancia, buscamos un false
        //si nos encontramos aquí es que no hay nadie en la base de datos que use este email, así que podemos crear una cuenta
        //procedemos a hacer el insert con la función register
        $role =isTeacher($email);   //comprovamos antes de nada que tipo de registro va a ser (si un usuario alumno o un usuario profesor)
        register($gdb, $username, $email, $password, $role);
        //cookie que nos servirá para ejecutar un script en javascript próximamente
        setcookie("SuccessfullyRegistered", true, time()+5);
        //volvemos a la página inicial (no iniciamos sessión, si no que esperamos a que el usuario lo deseé hacerlo)
        header('location:?url=home');

    }
}
}

