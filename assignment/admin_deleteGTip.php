<?php
    include 'dbConn.php';
    session_start();

    $sql = "DELETE FROM gardentips WHERE gTipID = '".$_GET['gTipID']."'";
    if(mysqli_query($conn,$sql)){
        echo "<script>alert('Gardening tip deleted successfully!')</script>";
        header("Location: admin_gardenTips.php");
    }else{
        echo "Error deleting garden tip: ".mysqli_error($conn);
    }
?>