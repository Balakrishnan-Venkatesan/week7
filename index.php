<?php

 $hostname = "sql.njit.edu";
 $username = "bv98";
 $password = "dvJjpozdZ";
 $connect = NULL;

try {
    $connect = new PDO("mysql:host=$hostname;dbname=bv98",$username,$password);
    echo "Connected successfully <br>";
}
catch(PDOException $e) {
    http_error("500 Internal Server Error\n\n" . "Error in connecting to the DB:\n\n" . $e->getMessage() . "<br>");
}

?>
