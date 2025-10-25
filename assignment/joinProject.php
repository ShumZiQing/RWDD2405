<?php
include 'dbConn.php';
session_start();

if (!isset($_SESSION['userid'])) {
  header("Location: login.php");
  exit();
}

$successMsg = "";
$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['prjID'])) {
  $prjID = intval($_POST['prjID']);
  $userID = $_SESSION['userid'];

  // Check if user already joined
  $check = mysqli_query($conn, "SELECT * FROM tblparticipants WHERE prjID = $prjID AND userID = $userID");
  if (mysqli_num_rows($check) > 0) {
    $errorMsg = "You have already joined this project.";
  } else {
    $insert = mysqli_query($conn, "INSERT INTO tblparticipants (userID, prjID) VALUES ($userID, $prjID)");
    if ($insert) {
      $successMsg = "Successfully joined the project!";
    } else {
      $errorMsg = "Failed to join the project. Please try again.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Join Project - EcoConnect</title>
  <link rel="stylesheet" href="styles/global.css">
  <link rel="stylesheet" href="styles/community_gardening.css">
</head>
<body>
  <main class="community-gardening">
    <section class="banner">
      <img src="images/banner1.jpg" alt="Community Projects">
      <h2>Community Gardening Projects</h2>
    </section>

    
    <?php if (!empty($successMsg)): ?>
    <p class="success-msg"><?= $successMsg ?></p>
    <meta http-equiv="refresh" content="1.5;url=gardenProject.php">
    <?php endif; ?>

    <?php if (!empty($errorMsg)): ?>
    <p class="error-msg"><?= $errorMsg ?></p>
    <meta http-equiv="refresh" content="2;url=gardenProject.php">
    <?php endif; ?>
  </main>

  <?php include 'footer.php'; ?>
  <script src="scripts/hamburger.js"></script>
</body>
</html>
