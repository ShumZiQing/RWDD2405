<?php
include 'dbConn.php';
session_start();

if (!isset($_SESSION['userid'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

if (!isset($_POST['eTipID'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$etipID = intval($_POST['eTipID']);

if (!isset($_SESSION['liked_tips'])) {
    $_SESSION['liked_tips'] = [];
}

if (in_array($etipID, $_SESSION['liked_tips'])) {
    $updateQuery = "UPDATE tblenergytips 
                    SET eTipLikes = GREATEST(eTipLikes - 1, 0)
                    WHERE eTipID = $etipID";

    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['liked_tips'] = array_diff($_SESSION['liked_tips'], [$etipID]);
        $result = mysqli_query($conn, "SELECT eTipLikes FROM tblenergytips WHERE eTipID = $etipID");
        $row = mysqli_fetch_assoc($result);
        echo json_encode(['success' => true, 'likes' => $row['eTipLikes'], 'action' => 'unliked']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error while unliking']);
    }

} else {
    $updateQuery = "UPDATE tblenergytips SET eTipLikes = eTipLikes + 1 WHERE eTipID = $etipID";

    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['liked_tips'][] = $etipID;
        $result = mysqli_query($conn, "SELECT eTipLikes FROM tblenergytips WHERE eTipID = $etipID");
        $row = mysqli_fetch_assoc($result);
        echo json_encode(['success' => true, 'likes' => $row['eTipLikes'], 'action' => 'liked']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error while liking']);
    }
}
?>