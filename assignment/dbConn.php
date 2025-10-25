<?php
    // $host = "127.0.0.1:3307"
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "ecoconnect";
    $conn = mysqli_connect($host, $user, $password, $db);

    if(!$conn){
        die("Connect failed: ".mysqli_connect_error());
    }else{
        //echo "Successfully connected";
    }
?>
