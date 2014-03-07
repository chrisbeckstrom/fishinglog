<?php
include 'config/config.php';

$server     = $DBurl;
$username   = $DBuser;
$password   = $DBpass;
$database   = $DBdb;
 
$dsn        = "mysql:host=$server;dbname=$database";
     
    try {
     
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
         
        $sth = $db->query("SELECT * FROM trips");
        $locations = $sth->fetchAll();
         
        echo json_encode( $locations );
         
    } catch (Exception $e) {
        echo $e->getMessage();
    }
?>
