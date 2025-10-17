<?php
include 'dbConn.php';
session_start();

if (!isset($_SESSION['userid'])) {
  echo json_encode(["success" => false, "message" => "Unauthorized"]);
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $etipID = intval($_POST['etipID']);
  $userID = $_SESSION['userid'];

  $check = mysqli_query($conn, "SELECT eTipImage FROM tblenergytips WHERE eTipID = $etipID AND userID = $userID");
  if (mysqli_num_rows($check) > 0) {
    $row = mysqli_fetch_assoc($check);
    $imagePath = "images/" . $row['eTipImage'];

    mysqli_query($conn, "DELETE FROM tblenergytips WHERE eTipID = $etipID AND userID = $userID");

    if (file_exists($imagePath) && !empty($row['eTipImage'])) {
      unlink($imagePath);
    }

    echo json_encode(["success" => true]);
  } else {
    echo json_encode(["success" => false, "message" => "Not allowed or tip not found"]);
  }
}
?>
