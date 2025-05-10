<?php 

// aku mau lambo
try{
    $kon = new \PDO('sqlite: .'.'/../database/database.db');
    echo "Duck is Ducking in the River";
}catch(\PDOException $e){
    echo $e->getMessage();
}

include"worker.php";