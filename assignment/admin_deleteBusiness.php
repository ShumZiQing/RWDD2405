<?php
    include 'dbConnect.php';
    session_start();

    $sql = "DELETE FROM tblBusiness WHERE busID = '".$_GET['busID']."'";
    if(mysqli_query($conn,$sql)){
        echo "<script>alert('Business deleted successfully!')</script>";
        header("Location: admin_business.php");
    }else{
        echo "Error deleting business: ".mysqli_error($conn);
    }
?>