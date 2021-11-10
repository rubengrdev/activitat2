<?php
$option = filter_input(INPUT_POST,"option");
if($option == "Accept"){
    $option = "true";
}elseif($option == "Decline"){
    $option = "false";
}
//creamos cookie y variable de sesión 
setcookie("cookiesEnabled", $option, time()+86000);
$_SESSION["noCookienoAcces"]=$option;   //si no hay cookies no hay acceso a la página

//una vez hecho esto nos vamos al directorio home de vuelta
header("location:?url=home");
