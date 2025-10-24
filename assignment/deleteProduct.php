<?php
include 'dbConn.php';
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prodID'])) {
    $prodID = intval($_POST['prodID']);
    $userID = $_SESSION['userid'];

    // Ensure the review belongs to the logged-in user
    $check = mysqli_query($conn, "SELECT * FROM tblproducts WHERE prodID = $prodID AND userID = $userID");

    if (mysqli_num_rows($check) > 0) {
        // Get image name before deleting
        $row = mysqli_fetch_assoc($check);
        $imgPath = "prodImages/" . $row['prodImg'];

        // Delete product from database
        $delete = mysqli_query($conn, "DELETE FROM tblproducts WHERE prodID = $prodID AND userID = $userID");

        if ($delete) {
            // Delete image file if exists
            if (file_exists($imgPath) && !empty($row['prodImg'])) {
                unlink($imgPath);
            }

            header("Location: productSwap.php?deleted=success");
            exit;
        } else {
            echo "Error deleting product.";
        }
    } else {
        echo "Unauthorized action.";
    }
}
?>
