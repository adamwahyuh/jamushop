<?php 

// aku mau lambo
try{
    $kon = new \PDO('sqlite:'.__DIR__.'/../database/database.db');
    // echo "Duck is Ducking in the River";
}catch(\PDOException $e){
    echo $e->getMessage();
}

$namaToko = "Jamu Mbah Jawa";

include "worker.php";
include "call.php";