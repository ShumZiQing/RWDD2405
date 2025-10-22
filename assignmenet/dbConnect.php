<?php
    //create db connection
    $host = "localhost"; //IP address
    $user = "root"; //admin by def
    $password = "";
    $db = "recovery"; //change to proper one later
    $conn = mysqli_connect($host, $user, $password, $db);

    if(!$conn){
        die("Connection failed: ".mysqli_connect_error()); //die: print and execute
    }else{
        // echo '<script type="text/javascript">';
        // echo 'alert("Connected successfully");';
        // echo '</script>';
    }
?>