<?php
    //Database Info
    $hostname = "localhost";
    $username ="root";
    $password = "";
    $database = "tanglaw_db";

    $db = "mysql:host=localhost;dbname=tanglaw_db";

    //Connect to DB
    $connection = mysqli_connect($hostname, $username, $password, $database);
    $pdo_obj = new PDO($db, $username, $password);
    //If connection unsuccessful
    if (!$connection) {
        die("Connection Error");
    }
?>