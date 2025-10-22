<?php
    include 'dbConnect.php';
    session_start();

    $sql = "DELETE FROM tblcollaborator WHERE collabID = '".$_GET['collabID']."'";
    if(mysqli_query($conn,$sql)){
        echo "<script>alert('Collaborator deleted successfully!')</script>";
        header("Location: admin_collab.php");
    }else{
        echo "Error deleting collaborator: ".mysqli_error($conn);
    }
?>