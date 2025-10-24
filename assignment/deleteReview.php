<?php
include 'dbConn.php';
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $revID = intval($_POST['revID']);
    $busID = intval($_POST['busID']);
    $userID = intval ($_SESSION['userid']);

    // Ensure the review belongs to the logged-in user
    $check = mysqli_query($conn, "SELECT * FROM tblreviews WHERE revID = $revID AND userID = $userID");

    if ($check && mysqli_num_rows($check) > 0) {
        $delete = mysqli_query($conn, "DELETE FROM tblreviews WHERE revID = $revID AND userID = $userID");
        if ($delete) {
            echo "<script>alert('Review deleted successfully.'); window.location='businessDetails.php?busID=$busID';</script>";
            exit;
        } else {
            echo "<script>alert('Error deleting review: " . mysqli_error($conn) . "'); window.location='businessDetails.php?busID=$busID';</script>";
        }
    } else {
        echo "<script>alert('You can only delete your own reviews.'); window.location='businessDetails.php?busID=$busID';</script>";
    }
} else {
    header("Location: businessGuide.php");
    exit;
}
?>
