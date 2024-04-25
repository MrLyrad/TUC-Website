<?php
    //Database Info
    $hostname = "localhost";
    $username ="root";
    $password = "";
    $database = "tanglaw_db";

    //Connect to DB
    $connection = mysqli_connect($hostname, $username, $password, $database);

    //If connection unsuccessful
    if (!$connection) {
        die("Connection Error");
    }
?>