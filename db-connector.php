<?php
    //Database Info
    $hostname = "localhost";
    $db_username ="root";
    $db_password = "";
    $database = "tanglaw_db";

    $db = "mysql:host=localhost;dbname=tanglaw_db";

    //Connect to DB
    $connection = mysqli_connect($hostname, $db_username, $db_password, $database);
    $pdo_obj = new PDO($db, $db_username, $db_password);
    //If connection unsuccessful
    if (!$connection) {
        die("Connection Error");
    }
?>