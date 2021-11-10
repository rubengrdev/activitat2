<?php
require 'config.php';
function getConnection (String $dsn, String $dbuser, String $dbpasswd) {
    $gdb = new PDO($dsn, $dbuser, $dbpasswd); //en el caso de que no funcione localhost 127.0.0.1
    $gdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $gdb->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    return $gdb;
}
function connectSqlite(string $dbname){
    try{
        $db=new PDO('sqlite:'.__DIR__.'/database/'.$dbname.'.sqlite');
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        die($e->getMessage());
    }
    return $db;
}



function insert($db,$data):bool{
    if(is_array($data)){

        foreach($data[0] as $column => $value){
            $names[]=$column;
            $values[]=$value;
        }
        $dbConn=connectSqlite($db);
        $sqlQuery = "insert into users ($names[0],$names[1],$names[2]) values ($values[0],$values[1],$values[2])";
        
     $dbConn->exec($sqlQuery);
     return true;
    }
        return false;
    
}