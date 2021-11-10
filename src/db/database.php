<?php
function register($db, $username, $email, $pass, $role){
    //antes de nada vamos a encriptar la contraseña
    $encryptVariable = "M7mola";
     $encryptPassword = hash_hmac("sha256",$pass, $encryptVariable);
        $sql = "INSERT into users (email,uname,passw,`role`)values(?,?,?,?)";
       
        
        $stmt=$db->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2,$username);
        $stmt->bindParam(3,$encryptPassword);
        $stmt->bindParam(4,$role );
      
        if($stmt->execute()){
            return true;
        }
       return false;
        
}

function authentication($db, $email, $pass):bool{
    try{
        $sql = "SELECT email, passw FROM users where email='".$email."'LIMIT 1";
        $stmt=$db->prepare($sql);
        $stmt->execute();
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            //en cada variable guardamos el mail y password
            $getDBmail = $row['email'];
            $getDBpassw = $row['passw'];
        }
        if(isset($getDBmail)){
            //el mail coincide (está definido) entonces ahora procederemos a comprovar la contraseña
            
            $encryptVariable = "M7mola";
            $encryptPassword = hash_hmac("sha256",$pass, $encryptVariable);
            $auth = passwordVerify($encryptPassword,$getDBpassw);

            if($auth){
                return true;
            }
        }
        return false;
    
    }catch(PDOException $e){
        return false;
    }
}

function noRedundancy($db,$email){
    try{
        $sql = "SELECT * FROM users where email='".$email."'";
        $stmt=$db->prepare($sql);
        $stmt->execute();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            //en cada variable guardamos el mail y password
            if(isset($row)){
                return true;
            }
        }
        return false;
        
    }catch(PDOException $e){
        return false;
    }
}

function getUser($db,$email){
    try{
        $sql = "SELECT uname FROM users where email='".$email."' LIMIT 1";
        $stmt=$db->prepare($sql);
        $stmt->execute();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            //en cada variable guardamos el mail y password
            $getUsername = $row['uname'];
        }
        return $getUsername;

    }catch(PDOException $e){
        return false;
    }
}



function getProfile($db, $email){
    try{
        $sql = "SELECT * FROM users where email='".$email."' LIMIT 1";
        $stmt=$db->prepare($sql);
        $stmt->execute();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            //en cada variable guardamos el mail y password
            $getAllData = $row;
        }
        return $getAllData;

    }catch(PDOException $e){
        return false;
    }
}

function getRole($db, $id){
    try{
        $sql = "SELECT * FROM role where id='".$id."';";    //AVISO: role se trata de una vista creada para no tener que hacer consultas y que se vean datos sensibles como passwords, mails, etc
        $stmt=$db->prepare($sql);
        $stmt->execute();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data = $row;
        }
        $getRole = roleDefiner($data["role"]);  //returns string (ex.teacher || student)
        return $getRole;

    }catch(PDOException $e){
        return false;
    }
}

function getLists($db, $id){
        //id es un string, hay que castearlo
        
        $sql = "SELECT * FROM lists where propietary='".$id."';";
        $stmt=$db->prepare($sql);
        $stmt->execute();
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
            $data[] = $row;
        }
            
            if(isset($data) != null){
                return $data;    //si no está vacio significa que si que tiene alguna lista
            }else{
                return 0;       //en el caso de que no tenga lista le devolveremos un valor
            }
        return false;
}

function getTasks($db, $id){
    $sql = "SELECT * FROM tasks where whichlist='".$id."';";
    $stmt=$db->prepare($sql);
    $stmt->execute();
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
        $data[] = $row;
    }
        
        if(isset($data) != null){
            return $data;    
        }else{
            return 0;      
        }
    return false;
}

function downloadList($gdb, $lists){

    for($i = 0; $i< count($lists); $i++){
        $getListId = $lists[$i]["idList"];
        $getListName = $lists[$i]["tasksData"];
        if(count($lists) != 0){
            $tasks = getTasks($gdb, $getListId);    //necesito tener esta consulta para poder cuadrar las listas con las tareas
            if($tasks != null){ //este usuario no tiene tareas 
            for($a=0; $a<count($tasks); $a++){
                $getTaskData[] =  $tasks[$a]["description"];
             
            }
            
            $data[] = array($getListName, array($getTaskData));
            $getTaskData = null;    //reseteamos el array
        }else{
            $data[] = array($getListName);
        }
        }
    }
    return $data;
    //Estamos devolviendo un array de este tipo: ejemplo:
    //Array ( [0] => Array ( [0] => firts list [1] => Array ( [0] => Array ( [0] => esto es una tarea de m8 [1] => hola mundo ) ) ) [1] => Array ( [0] => second list [1] => Array ( [0] => Array ( [0] => esto pertenece a la otra ) ) ) ) 
}
function maxIdList($db){
    $sql = "SELECT max(idList) from lists;";
    $stmt=$db->prepare($sql);
    $stmt->execute();
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
        if($row == null){
            $row = 0;
        }
        return $row;
    }
    
        
}

function addList($db,$listName){
    $sql = "INSERT INTO lists (propietary,tasksData)values(".$_SESSION["profile"]["id"].", '".$listName."');";
    $stmt=$db->prepare($sql);
    
    if( $stmt->execute() == true){
        return true;
    }else{
        return false;
    }
    return false;
}

function selectIdListFromName($db, $listname){
    $sql = "SELECT idList FROM lists where tasksData='".$listname."';";
    $stmt=$db->prepare($sql);
    $stmt->execute();
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
        if(isset($row["idList"])){
            return $row["idList"];
        }else{
            return false;
        }
    }   
}
//función para comprovar si 
function issetObject($db,$table, $column, $field){
    try{
        $sql = "SELECT count(*)  FROM ".$table." where ".$column."='".$field."';";
        $stmt=$db->prepare($sql);
        $stmt->execute();
    }catch(Exception $e){
        $e->getMessage();
    }
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
       return $row["count(*)"]; //devolvemos el nº de resultados de la consulta
    }   
}


function addTask($db,$idList,$taskName){
    $sql = "INSERT INTO tasks (whichlist,`description`)values('".$idList."', '".$taskName."');";
    $stmt=$db->prepare($sql);
    
    if( $stmt->execute() == true){
        return true;
    }else{
        return false;
    }
    return false;
}

function delList($db, $listname){
    $sql = "DELETE FROM lists where tasksData='".$listname."';";
    $stmt=$db->prepare($sql);
    
    if( $stmt->execute() == true){
        return true;
    }else{
        return false;
    }
    return false;
}

function delTasks($db, $taskName){
    $sql = "DELETE FROM tasks where description='".$taskName."';";
    $stmt=$db->prepare($sql);
    
    if( $stmt->execute() == true){
        return true;
    }else{
        return false;
    }
    return false;
}
function delALLTasks($db, $idList){
    $sql = "DELETE FROM tasks where whichlist='".$idList."';";
    $stmt=$db->prepare($sql);
    
    if( $stmt->execute() == true){
        return true;
    }else{
        return false;
    }
    return false;
}

function modifyTasks($db,$taskName, $newTaskName){
    $sql ="UPDATE tasks set description='".$newTaskName."' where description='".$taskName."'";
    $stmt=$db->prepare($sql);
    
    if( $stmt->execute() == true){
        return true;
    }else{
        return false;
    }
    return false;
}