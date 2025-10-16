<?php
include 'dbConn.php';
session_start();

$pageTitle = "EcoConnect - Add New Gardening Tip";
include 'header.php';

// Restrict access to logged-in users only
if (!isset($_SESSION['userid'])) {
  header("Location: login.php");
  exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $tipName = mysqli_real_escape_string($conn, $_POST['tipName']);
  $tipContent = mysqli_real_escape_string($conn, $_POST['tipContent']);
  $userID = $_SESSION['userid'];
  $date = date('Y-m-d');
  $tipImage = "";

  // Handle image upload
  if (!empty($_FILES['tipImage']['name'])) {
    $uploadDir = "gTipsImages/";
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $fileExt = strtolower(pathinfo($_FILES['tipImage']['name'], PATHINFO_EXTENSION));
    $allowedTypes = ['png', 'jpg', 'jpeg'];

    if (in_array($fileExt, $allowedTypes)) {
      $uniqueName = uniqid('garden_', true) . '.' . $fileExt;
      $targetFile = $uploadDir . $uniqueName;
      if (move_uploaded_file($_FILES['tipImage']['tmp_name'], $targetFile)) {
        $tipImage = $uniqueName;
      }
    }
  }

  // Insert into database
  $sql = "INSERT INTO tblgardentips (gTipName, gTipDate, gTipContent, gTipLikes, userID, gTipImage)
          VALUES ('$tipName', '$date', '$tipContent', 0, '$userID', '$tipImage')";

  if (mysqli_query($conn, $sql)) {
    $successMsg = "Gardening Tip added successfully!";
  } else {
    $errorMsg = "Database error: " . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" href="styles/global.css">
  <link rel="stylesheet" href="styles/community_gardening.css">
</head>
<body>
  <main class="community-gardening">
    <!-- Replaces old banner + form with unified section -->
    <section class="add-tip-form">
      <div class="banner">
        <img src="images/banner1.jpg" alt="Add a Gardening Tip">
        <h2>Share Your Gardening Tip</h2>
      </div>

      <form class="form-box" action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="tipName" placeholder="Tip Title" required>
        <textarea name="tipContent" placeholder="Write your tip here..." rows="6" required></textarea>
        <input type="file" name="tipImage" accept="image/*">

        <div class="form-actions">
        <button type="submit" class="btn add-btn">Add Tip</button>
        <button type="button" class="btn cancel-btn" onclick="window.location.href='gardenTip.php'">Cancel</button>
        </div>

        <?php if (isset($successMsg)): ?>
          <p class="success-msg"><?= $successMsg ?></p>
          <meta http-equiv="refresh" content="1.5;url=gardenTip.php">
        <?php endif; ?>

        <?php if (isset($errorMsg)): ?>
          <p class="error-msg"><?= $errorMsg ?></p>
        <?php endif; ?>
      </form>
    </section>
  </main>

  <?php include 'footer.php'; ?>
  <script src="scripts/communityGardening.js"></script>
  <script src="scripts/hamburger.js"></script>
</body>
</html>
