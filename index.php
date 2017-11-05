<?php

 $hostname = "sql.njit.edu";
 $username = "bv98";
 $password = "dvJjpozdZ";
 $connect = NULL;

 try {
    $connect = new PDO("mysql:host=$hostname;dbname=bv98",$username,$password);
    echo "Connected successfully <br><br>";
    $query = 'SELECT * FROM accounts WHERE `id` < 6';
    $rows = runQuery($query);
    echo count($rows) . ' records have user ID less than 6 in "accounts" table <br><br>';
    $header = 'SHOW COLUMNS FROM accounts';
    $head = tableHead($header);
    echo htmlTable($head,$rows);
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

 function tableHead($query){
    global $connect;
    try {
        $sql = $connect->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_COLUMN);
        $sql->closeCursor();
        return $result;
    }
    catch(PDOException $e) {
        http_error("500 Internal Server Error\n\n" . "Error in connecting to the DB:\n\n" . $e->getMessage() . "<br>");
    }
 }

function htmlTable($head,$rows) {
    $htmlTable = NULL;
    $htmlTable .= "<table border = 2>";
    foreach ($head as $head1) {
        $htmlTable .= "<th>$head1</th>";
    }
    foreach ($rows as $row) {
      $htmlTable .= "<tr>";
       foreach ($row as $column) {
         $htmlTable .= "<td>$column</td>";
       }
      $htmlTable .= "</tr>";
    }
    $htmlTable .= "</table>";
    return $htmlTable;
}

?>
