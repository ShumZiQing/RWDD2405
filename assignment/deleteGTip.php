<?php
include 'dbConn.php';
session_start();

if (!isset($_SESSION['userid'])) {
  echo json_encode(["success" => false, "message" => "Unauthorized"]);
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $tipID = intval($_POST['tipID']);
  $userID = $_SESSION['userid'];

  // Verify ownership before deleting
  $check = mysqli_query($conn, "SELECT gTipImage FROM tblgardentips WHERE gTipID = $tipID AND userID = $userID");
  if (mysqli_num_rows($check) > 0) {
    $row = mysqli_fetch_assoc($check);
    $imagePath = "gTipsImages/" . $row['gTipImage'];

    mysqli_query($conn, "DELETE FROM tblgardentips WHERE gTipID = $tipID AND userID = $userID");

    if (file_exists($imagePath) && !empty($row['gTipImage'])) {
      unlink($imagePath); // remove image file
    }

    echo json_encode(["success" => true]);
  } else {
    echo json_encode(["success" => false, "message" => "Not allowed or tip not found"]);
  }
}
?>
