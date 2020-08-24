<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "snapperly refurb";

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<script>console.log('Database connected successfully ✅');</script>";
    }catch(PDOException $e){
        echo "<script>console.log('Database not connected ❌');</script>";
    }
?>