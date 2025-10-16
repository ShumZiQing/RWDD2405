<?php
include 'dbConn.php';
session_start();

if (!isset($_SESSION['userid'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

if (isset($_POST['tipID'])) {
    $tipID = intval($_POST['tipID']);

    // Update likes in database
    $updateQuery = "UPDATE tblgardentips SET gTipLikes = gTipLikes + 1 WHERE gTipID = $tipID";
    if (mysqli_query($conn, $updateQuery)) {
        // Fetch new like count
        $result = mysqli_query($conn, "SELECT gTipLikes FROM tblgardentips WHERE gTipID = $tipID");
        $row = mysqli_fetch_assoc($result);
        echo json_encode(['success' => true, 'likes' => $row['gTipLikes']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
