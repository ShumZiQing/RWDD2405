<?php
include 'dbConn.php';
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $busID = intval($_POST['busID']);
    $revName = mysqli_real_escape_string($conn, $_POST['revName']);
    $revContent = mysqli_real_escape_string($conn, $_POST['revContent']);
    $revStars = intval($_POST['revStars']);
    $userID = $_SESSION['userid'];

    $sql = "INSERT INTO tblreviews (busID, userID, revName, revStars, revContent) 
            VALUES ('$busID', '$userID', '$revName', '$revStars', '$revContent')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Review added successfully!'); window.location='businessDetails.php?busID=$busID';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>
