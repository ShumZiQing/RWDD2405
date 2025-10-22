<?php
    include 'dbConn.php';
    session_start();

    $sql = "DELETE FROM energytips WHERE eTipID = '".$_GET['eTipID']."'";
    if(mysqli_query($conn,$sql)){
        echo "<script>alert('Energy tip deleted successfully!')</script>";
        header("Location: admin_energyTips.php");
    }else{
        echo "Error deleting energy tip: ".mysqli_error($conn);
    }
?>