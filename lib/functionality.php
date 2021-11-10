<?php
//función para determinar el status visualmente de la sessión
function sessionStatus(){
    if(isset($_SESSION['profile'])){    //profile es una variable (array) que contiene todos los datos de el usuario de una consulta, pero la aproveharemos para ver si está creada
        $status = "active"; 
    }else{
        $status = "innactive";
    }
    //generamos una cookie con el estado de nuestra session
    setcookie("status",$status, time()+860000);
}

function isTeacher($email){
    if(preg_match("/@escolesnuria.cat/",$email)){
        return 2;   //en la base de datos "1=alumn" -> "2 = teacher"
    }
    return 1;
}
//comprovación de 2 contraseñas ("hasehadas")
function passwordVerify($pass, $dbPass){
    if($pass === $dbPass){
        return true;
    }else{
        return false;
    }
}
function breadcrumbs(){
    //conseguimos la ruta de la ubicación actual
$location = getRoute();
switch($location){
    case "login":
        return  "Home /Login";
        break;
    case "register":
        return  "Home / Register";
        break;
    case "dashboard":
        return  "Home / Login / Dashboard";
        break;
    case "lists":
        return "Home / Login / Dashboard / Lists";
        break;
    default:
        return "Home";
}
}
function prepareBreadcrumb ($route){    //le estamos pasando un array
    $path = array();
    foreach($route as $val){
       $path[]= "/".$val;
    }
  
    return $path;
}
//selecionador de role según la BD (o 1 o 2)
function roleDefiner($role){
    if($role == 1){
        return "student";
    }elseif($role == 2){
        return "teacher";
    }
    return false;
    }
    //comprovación de si el usuario ha aceptado la politica de cookies
    function cookiePolicyAccept(){
        if(isset($_SESSION["noCookienoAcces"]) && $_SESSION["noCookienoAcces"] != true){
            header("location:?url=home");
        }
    }
//recorredor de arrays asociativas recuperadas de la base de datos para las listas de tareas
function getArrayData($assocArray,$parametter){
    foreach($assocArray as $array){
        $lists[] = $array[$parametter];
    }
    return $lists;
}


function createListsHTML($data){
    $count=count($data);
   
    for($i = 0; $i<$count; $i++){
        $title = "<div class='newlist'><h3 class='list-title'>".$data[$i][0]."</h3>";

        if(isset($data[$i][1])) {//estamos comprovando si el usuario tiene tareas

        for($a=0; $a<count($data[$i][1][0]); $a++){
            $arrayZoom = $data[$i][1][0];
            $tasks[] = "<p class='taskdesc'>".$arrayZoom[$a]."</p>";
        }
        $prepareString[] = $title.implode($tasks)."</div>";    //cada lista tendra una o varias tareas, no será de otra manera
        $tasks = null;  //reseteamos el array
    }else{
        $prepareString[] = $title."</div>";  //en el caso de no tener tareas este "row" solo tendrá un título
    }
       
    }
    return implode($prepareString); //devolvemos como string
    
}
