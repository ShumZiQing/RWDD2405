<?php
include 'dbConn.php';
$pageTitle = "EcoConnect - Add Energy Conservation Tip";
include 'header.php';

if (!isset($_SESSION['userid'])) {
  header("Location: login.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $tipName = mysqli_real_escape_string($conn, $_POST['tipName']);
  $tipContent = mysqli_real_escape_string($conn, $_POST['tipContent']);
  $tipType = mysqli_real_escape_string($conn, $_POST['tipType']);
  $userID = $_SESSION['userid'];

  $imageName = $_FILES['tipImage']['name'];
  $imageTmp = $_FILES['tipImage']['tmp_name'];
  $uploadDir = "eTipsImages/";

  if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
  }

  $fileExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
  $allowedTypes = ['png'];

  if (!empty($imageName)) {
    if (in_array($fileExt, $allowedTypes)) {
      $mimeType = mime_content_type($imageTmp);
      if ($mimeType === 'image/png') {
        $uniqueName = uniqid('tip_', true) . '.png';
        $targetFile = $uploadDir . $uniqueName;

        if (move_uploaded_file($imageTmp, $targetFile)) {
          $query = "INSERT INTO tblenergytips (eTipName, eTipContent, eTipType, eTipImage, userID)
                    VALUES ('$tipName', '$tipContent', '$tipType', '$uniqueName', '$userID')";
          if (mysqli_query($conn, $query)) {
            $successMsg = "Energy Tip added successfully!";
          } else {
            $errorMsg = "Database error: " . mysqli_error($conn);
          }
        } else {
          $errorMsg = "Failed to upload image.";
        }
      } else {
        $errorMsg = "Invalid image file. Please upload a real PNG image.";
      }
    } else {
      $errorMsg = "Invalid file format. Only PNG images are allowed.";
    }
  } else {
    $errorMsg = "Please upload an image.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" href="styles/global.css">
  <link rel="stylesheet" href="styles/addEnergyTip.css">
</head>

<body>
  <main class="add-tip">
    <section class="banner">
        <img src="images/banner1.jpg" alt="Banner">
        <h2>Add Energy Conservation Tips</h2>
    </section>

    <form action="" method="POST" enctype="multipart/form-data" class="form-box">
        <input type="text" name="tipName" placeholder="Tip Title" required>

        <select name="tipType" required>
            <option value="home">Home</option>
            <option value="workplace">Workplace</option>
        </select>

        <textarea name="tipContent" placeholder="Tip Content (use new line for bullet points)" rows="6" required></textarea>

        <input type="file" name="tipImage" accept="image/png" required>

        <button type="submit" class="btn-add">Add Tip</button>
        <button type="button" class="btn-cancel" onclick="window.location.href='energyTips.php'">Cancel</button>

        <?php
            if (isset($successMsg)) {
            echo "<p class='success-msg'>$successMsg</p>";
            echo "<meta http-equiv='refresh' content='1.5;url=energyTips.php'>";
            }
            if (isset($errorMsg)) {
            echo "<p class='error-msg'>$errorMsg</p>";
            }
        ?>
    </form>
  </main>

  <?php include 'footer.php'; ?>
  <script src="scripts/hamburger.js"></script>

</body>
</html>
