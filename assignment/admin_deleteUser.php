<?php

    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

    include 'dbConn.php';

    session_start();

    if(isset($_GET['userID'])){
        $userID = $_GET['userID'];

        $sql = "DELETE FROM tbluser WHERE userID = '$userID'";

        if(mysqli_query($conn, $sql)){
            echo "<script>
            alert ('User deleted succeddfully!');
            window.location.href='admin_mngUser.php';
            </script>";
            exit;
        }else{
            echo "<script>
            alert ('Error: ". mysqli_error($conn) . "');
            windoe.location.href='admin_mngUser.php';
            </script>";
            exit;
        }
    }else{
        echo "<script>
            alert ('User not found.');
            windoe.location.href='admin_mngUser.php';
            </script>";
            exit;
    }

    
?>
