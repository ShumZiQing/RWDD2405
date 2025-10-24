<?php
include 'dbConn.php';
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['userid'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

if (!isset($_POST['eTipID'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$eTipID = intval($_POST['eTipID']);
$userID = intval($_SESSION['userid']);

// Check tip exists
$chk = mysqli_query($conn, "SELECT eTipID FROM tblenergytips WHERE eTipID = $eTipID");
if (!$chk || mysqli_num_rows($chk) === 0) {
    echo json_encode(['success' => false, 'message' => 'Tip not found']);
    exit;
}

// Check if user already liked this eTip
$existsQ = mysqli_query($conn, "SELECT * FROM tblfavourites 
                               WHERE userID = $userID AND eTipID = $eTipID");

if ($existsQ && mysqli_num_rows($existsQ) > 0) {
    // UNLIKE
    mysqli_query($conn, "DELETE FROM tblfavourites 
                         WHERE userID = $userID AND eTipID = $eTipID");
    mysqli_query($conn, "UPDATE tblenergytips 
                         SET eTipLikes = GREATEST(eTipLikes - 1, 0) 
                         WHERE eTipID = $eTipID");

    $res = mysqli_query($conn, "SELECT eTipLikes FROM tblenergytips WHERE eTipID = $eTipID");
    $row = mysqli_fetch_assoc($res);

    echo json_encode(['success' => true, 'likes' => (int)$row['eTipLikes'], 'liked' => false]);
    exit;

} else {
    // LIKE
    mysqli_query($conn, "INSERT INTO tblfavourites (userID, eTipID) 
                         VALUES ($userID, $eTipID)");
    mysqli_query($conn, "UPDATE tblenergytips 
                         SET eTipLikes = eTipLikes + 1 
                         WHERE eTipID = $eTipID");

    $res = mysqli_query($conn, "SELECT eTipLikes FROM tblenergytips WHERE eTipID = $eTipID");
    $row = mysqli_fetch_assoc($res);

    echo json_encode(['success' => true, 'likes' => (int)$row['eTipLikes'], 'liked' => true]);
    exit;
}
?>
