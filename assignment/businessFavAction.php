<?php
include 'dbConn.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['userid'])) {
  echo json_encode(['success' => false, 'message' => 'Please log in to favorite a business.']);
  exit;
}

$userID = intval($_SESSION['userid']);
$busID = intval($_POST['busID'] ?? 0);

if ($busID <= 0) {
  echo json_encode(['success' => false, 'message' => 'Invalid business.']);
  exit;
}

$check = mysqli_query($conn, "SELECT * FROM tblfavourites WHERE userID=$userID AND busID=$busID");

if (mysqli_num_rows($check) > 0) {
  mysqli_query($conn, "DELETE FROM tblfavourites WHERE userID=$userID AND busID=$busID");
  echo json_encode(['success' => true, 'liked' => false]);
} else {
  mysqli_query($conn, "INSERT INTO tblfavourites (userID, busID) VALUES ($userID, $busID)");
  echo json_encode(['success' => true, 'liked' => true]);
}
?>
