<?php
require APP.'/lib/render.php';
require './lib/functionality.php';
require './src/db/database.php';
require './config.php';
require './lib/con.php';
ini_set('display_errors', 'On');
//comprovación previa de que no ha habido problemas y la conexión con el usuario es estable
cookiePolicyAccept();   //si no aceptamos las cookies no hay servicio

if($_COOKIE["status"] != "active"){
    header('location:?url=login');
}
//reseteamos la cookie
setcookie("result", "", time()+4 );   
//recoger el nombre de la acción deseada por el usuario
$userSelect = filter_input(INPUT_POST, 'modify');
$gdb = $gdb = getconnection($dsn, $dbuser, $dbpasswd); //conseguimos la conexión con la base de datos

switch($userSelect){
    case 'addList':
        $newListTitle = filter_input(INPUT_POST, "listname");
        if($newListTitle != null){
            $maxid = maxIdList($gdb);   //conseguimos la id en el caso de que sea necesaria
            $newIdList = $maxid["max(idList)"] +=1; 
            $redundance = issetObject($gdb,"lists","tasksData",$newListTitle);
            if($redundance <= 0){   //si da + de uno significa que ya existe esa tarea (no la podemos volver a crear)
                addList($gdb,$newListTitle);
                setcookie("result", "true", time()+4 );    
           }else{
                setcookie("result", "false", time()+4 ); 
           }
            
        }
        
       break;
    case 'addTask':
        $listName = filter_input(INPUT_POST, "listname");
        $newTaskName = filter_input(INPUT_POST, "taskname");
        if($listName != null && $newTaskName != null){
            $selectedListId = selectIdListFromName($gdb,$listName);
            if($selectedListId != false || $selectedListId != null){
                $redundance = issetObject($gdb,"tasks","description",$newTaskName);
                if($redundance <= 0){ //si da + de uno significa que ya existe esa tarea (no la podemos volver a crear)
                    addTask($gdb,$selectedListId,$newTaskName);
                    setcookie("result", "true", time()+4 ); 
                    break;   
                }else{
                     setcookie("result", "false", time()+4 );
                     break; 
                }
                
            }
            
               setcookie("result", "false", time()+4 );  
        }
       
        break;

    case 'delList':
        $listName = filter_input(INPUT_POST,"listname");
        $redundance = issetObject($gdb,"lists","tasksData", $listName);
        //en este caso con la función issetObject nos interesa que haya coincidencias
        issetObject($gdb,"lists","tasksData", $listName);
        if($listName != null && $redundance >0){
            //AGREGAR FUNCIÓN DELETETASK DE TODAS LAS QUE TENGAN LA MISMA ID QUE ESTA
            $idList =selectIdListFromName($gdb,$listName);
            $redundanceTasks = issetObject($gdb,"tasks","whichlist", $idList);
            echo"$idList <br> $redundanceTasks";
            if($redundanceTasks>0){ //si se encuentran tareas dentro de la lista las eliminamos
                delALLTasks($gdb,$idList);
            }
            delList($gdb,$listName);
            setcookie("result", "true", time()+4 );    
        }else{
             setcookie("result", "false", time()+4 ); 
        }
        break;
        case 'delTask':
            $taskName = filter_input(INPUT_POST,"taskname");
            $redundance = issetObject($gdb,"tasks","description", $taskName);
            if($taskName != null && $redundance > 0){
                
                delTasks($gdb,$taskName);
                setcookie("result", "true", time()+4 );    
            }else{
                 setcookie("result", "false", time()+4 ); 
            }
           
            break;

        case 'alterTask':
            $taskName = filter_input(INPUT_POST,"taskname");
            $newTaskName = filter_input(INPUT_POST, "newtaskname");
            $redundance = issetObject($gdb,"tasks","description", $taskName);
            if($taskName != null && $redundance > 0){
                modifyTasks($gdb,$taskName,$newTaskName);
                
                setcookie("result", "true", time()+4 );    
            }else{
                 setcookie("result", "false", time()+4 ); 
            }
            break;
}


//recargamos la página desde 0 y la consulta de los SELECT
header('location:?url=lists_action');