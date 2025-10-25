<?php
include 'dbConn.php';
session_start();
 
$pageTitle = "EcoConnect - Add New Business";
include 'header.php';
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $busType = mysqli_real_escape_string($conn, $_POST['busType']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $city = mysqli_real_escape_string($conn, $_POST['city']); // correct field
  $phoneNum = mysqli_real_escape_string($conn, $_POST['phoneNum']);
  $userID = $_SESSION['userid'];
  $revID = NULL;
  $imagePath = "";
 
  if (!empty($_FILES['businessImage']['name'])) {
    $uploadDir = "busImages/";
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
 
    $fileExt = strtolower(pathinfo($_FILES['businessImage']['name'], PATHINFO_EXTENSION));
    $allowedTypes = ['png', 'jpg', 'jpeg'];
 
    if (in_array($fileExt, $allowedTypes)) {
      $uniqueName = uniqid('business_', true) . '.' . $fileExt;
      $targetFile = $uploadDir . $uniqueName;
      if (move_uploaded_file($_FILES['businessImage']['tmp_name'], $targetFile)) {
        $imagePath = $uniqueName;
      } else {
        $errorMsg = "Failed to upload image.";
      }
    } else {
      $errorMsg = "Only JPG, JPEG, and PNG files are allowed.";
    }
  }
 
  if (!isset($errorMsg)) {
    $sql = "INSERT INTO tblbusiness (name, busType, description, location, phoneNum, userID, revID, busImg)
            VALUES ('$name', '$busType', '$description', '$city', '$phoneNum', '$userID', " .
            ($revID ? "'$revID'" : "NULL") . ", '$imagePath')";
 
    if (mysqli_query($conn, $sql)) {
      $successMsg = "Business added successfully!";
    } else {
      $errorMsg = "Database error: " . mysqli_error($conn);
    }
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
  <link rel="stylesheet" href="styles/businessGuide.css">
</head>
<body>
  <main class="business-guide">
  <section class="banner">
    <img src="images/banner1.jpg" alt="Banner">
    <h2>Promote Your Business</h2>
  </section>
 
  <section class="add-business-section">
    <form class="form-box" action="" method="POST" enctype="multipart/form-data">
      <input type="text" name="name" placeholder="Business Name" required>
 
      <select name="busType" required>
        <option value="">-- Select Category --</option>
        <option value="Household Items">Household Items</option>
        <option value="Health & Beauty">Health & Beauty</option>
        <option value="General Items">General Items</option>
        <option value="Food & Beverage">Food & Beverage</option>
      </select>
 
      <textarea name="description" placeholder="Describe your business..." rows="4" required></textarea>
       <select name="city" required>
        <option value="Alor Setar">Alor Setar</option>
        <option value="George Town">George Town</option>
        <option value="Ipoh">Ipoh</option>
        <option value="Johor Bahru">Johor Bahru</option>
        <option value="Klang">Klang</option>
        <option value="Kota Bharu">Kota Bharu</option>
        <option value="Kota Kinabalu">Kota Kinabalu</option>
        <option value="Kuala Lumpur">Kuala Lumpur</option>
        <option value="Kuala Terengganu">Kuala Terengganu</option>
        <option value="Kuantan">Kuantan</option>
        <option value="Kuching">Kuching</option>
        <option value="Labuan">Labuan</option>
        <option value="Malacca City">Malacca City</option>
        <option value="Miri">Miri</option>
        <option value="Petaling Jaya">Petaling Jaya</option>
        <option value="Putrajaya">Putrajaya</option>
        <option value="Seremban">Seremban</option>
        <option value="Shah Alam">Shah Alam</option>
        <option value="Subang Jaya">Subang Jaya</option>
      </select>
      <input type="text" name="phoneNum" placeholder="Phone Number (e.g. 0123456789)"required>
      <input type="file" name="businessImage" accept="image/*" required>
 
      <div class="form-actions">
        <button type="submit" class="btn add-btn">Add Business</button>
        <button type="button" class="btn cancel-btn" onclick="window.location.href='businessGuide.php'">Cancel</button>
      </div>
 
      <?php if (isset($successMsg)): ?>
        <p class="success-msg"><?= $successMsg ?></p>
        <meta http-equiv="refresh" content="1.5;url=businessGuide.php">
      <?php endif; ?>
 
      <?php if (isset($errorMsg)): ?>
        <p class="error-msg"><?= $errorMsg ?></p>
      <?php endif; ?>
    </form>
  </section>
</main>
 
 
  <?php include 'footer.php'; ?>
  <script src="scripts/hamburger.js"></script>
</body>
</html>