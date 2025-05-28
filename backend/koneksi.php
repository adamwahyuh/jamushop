<?php 
try{
	$kon = new \PDO('sqlite:'.__DIR__.'/../database/database.db');
}catch(\PDOException $e){
    echo $e->getMessage();
}

$namaToko = "Jamu Mbah Jawa";

include "worker.php";
include "call.php";
