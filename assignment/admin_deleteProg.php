<?php
    include 'dbConn.php';
    session_start();

    $sql = "DELETE FROM tblprograms WHERE progID = '".$_GET['progID']."'";
    if(mysqli_query($conn,$sql)){
        echo "<script>alert('Program deleted successfully!')</script>";
        header("Location: admin_activities.php");
    }else{
        echo "Error deleting program: ".mysqli_error($conn);
    }
?>