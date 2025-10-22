<?php
include 'dbConn.php';
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['userid'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

if (!isset($_POST['tipID'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$tipID = intval($_POST['tipID']);
$userID = intval($_SESSION['userid']);

// Sanity: check tip exists
$chk = mysqli_query($conn, "SELECT gTipID FROM tblgardentips WHERE gTipID = $tipID");
if (!$chk || mysqli_num_rows($chk) === 0) {
    echo json_encode(['success' => false, 'message' => 'Tip not found']);
    exit;
}

// Does the user already like this tip?
$existsQ = mysqli_query($conn, "SELECT * FROM tblfavourites WHERE userID = $userID AND gTipID = $tipID");

if ($existsQ && mysqli_num_rows($existsQ) > 0) {
    // Unlike: remove favourite row, decrement count (non-negative)
    mysqli_query($conn, "DELETE FROM tblfavourites WHERE userID = $userID AND gTipID = $tipID");
    mysqli_query($conn, "UPDATE tblgardentips SET gTipLikes = GREATEST(gTipLikes - 1, 0) WHERE gTipID = $tipID");
    $res = mysqli_query($conn, "SELECT gTipLikes FROM tblgardentips WHERE gTipID = $tipID");
    $row = mysqli_fetch_assoc($res);
    echo json_encode(['success' => true, 'likes' => (int)$row['gTipLikes'], 'liked' => false]);
    exit;
} else {
    // Like: insert favourite row and increment count
    $ins = mysqli_query($conn, "INSERT INTO tblfavourites (userID, gTipID) VALUES ($userID, $tipID)");
    if (!$ins) {
        echo json_encode(['success' => false, 'message' => 'Failed to add favourite']);
        exit;
    }
    mysqli_query($conn, "UPDATE tblgardentips SET gTipLikes = gTipLikes + 1 WHERE gTipID = $tipID");
    $res = mysqli_query($conn, "SELECT gTipLikes FROM tblgardentips WHERE gTipID = $tipID");
    $row = mysqli_fetch_assoc($res);
    echo json_encode(['success' => true, 'likes' => (int)$row['gTipLikes'], 'liked' => true]);
    exit;
}
