<?php

 $hostname = "sql.njit.edu";
 $username = "bv98";
 $password = "dvJjpozdZ";
 $connect = NULL;

 try {
    $connect = new PDO("mysql:host=$hostname;dbname=bv98",$username,$password);
    echo "Connected successfully <br>";
    $query = 'SELECT * FROM accounts WHERE `id` < 6';
    $rows = runQuery($query);
    echo count($rows) . ' records have id < 6 <br>';
    $header = 'SHOW COLUMNS FROM accounts';
    $head = runQuery($header);
    echo table($head,$rows);
 }
 catch(PDOException $e) {
    http_error("500 Internal Server Error\n\n" . "Error in connecting to the DB:\n\n" . $e->getMessage() . "<br>");
 }

 function runQuery($query){
    global $connect;
    try {
        $sql = $connect->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        return $result;
    }
    catch(PDOException $e) {
        http_error("500 Internal Server Error\n\n" . "Error in connecting to the DB:\n\n" . $e->getMessage() . "<br>");
    }
 }

?>
