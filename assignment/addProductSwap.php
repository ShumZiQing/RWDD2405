<?php
include 'dbConn.php';
session_start();

// Ensure user is logged in
if (!isset($_SESSION['userid'])) {
  header("Location: login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $userID = $_SESSION['userid'];
  $prodName = mysqli_real_escape_string($conn, $_POST['prodName']);
  $prodType = mysqli_real_escape_string($conn, $_POST['prodType']);
  $prodCity = mysqli_real_escape_string($conn, $_POST['prodCity']);
  $prodDetail = mysqli_real_escape_string($conn, $_POST['prodDetail']);
  $prodDate = date("Y-m-d");

  $targetDir = "prodImages/";
  if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
  }

  $prodImg = $_FILES['prodImg']['name'];
  $tempName = $_FILES['prodImg']['tmp_name'];
  $imgExt = strtolower(pathinfo($prodImg, PATHINFO_EXTENSION));
  $newImgName = uniqid("prod_", true) . "." . $imgExt;
  $targetFile = $targetDir . $newImgName;

  $allowed = ['jpg', 'jpeg', 'png'];
  if (in_array($imgExt, $allowed)) {
    if (move_uploaded_file($tempName, $targetFile)) {
      $query = "INSERT INTO tblproducts (prodName, prodDate, prodType, prodCity, prodDetail, userID, prodImg)
                VALUES ('$prodName', '$prodDate', '$prodType', '$prodCity', '$prodDetail', '$userID', '$newImgName')";
      if (mysqli_query($conn, $query)) {
        echo "<script>alert('Product uploaded successfully!'); window.location='productSwap.php';</script>";
        exit;
      } else {
        echo "<script>alert('Database error: " . mysqli_error($conn) . "');</script>";
      }
    } else {
      echo "<script>alert('Failed to upload image.');</script>";
    }
  } else {
    echo "<script>alert('Invalid image format. Allowed: JPG, JPEG, PNG.');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Product Swap - EcoConnect</title>
  <link rel="stylesheet" href="styles/global.css">
  <link rel="stylesheet" href="styles/productSwap.css">
</head>
<body>
  <?php include 'header.php'; ?>

  <main class="product-swap">
    <section class="banner">
      <img src="images/banner1.jpg" alt="Add Product Banner">
      <h2>Add a Product for Swap</h2>
    </section>

    <section class="form-section">
      <div class="form-card">
        <h3>Upload Your Product</h3>

        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="prodName">Product Name</label>
            <input type="text" id="prodName" name="prodName" required>
          </div>

          <div class="form-group">
            <label for="prodType">Category</label>
            <select id="prodType" name="prodType" required>
              <option value="">Select a category</option>
              <option value="Household items">Household items</option>
              <option value="Packaging">Packaging</option>
              <option value="Utensils">Utensils</option>
            </select>
          </div>

          <div class="form-group">
            <label for="prodCity">City</label>
            <select id="prodCity" name="prodCity" required>
              <option value="">Select a city</option>
              <option value="">City</option>
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
          </div>

          <div class="form-group">
            <label for="prodDetail">Details</label>
            <textarea id="prodDetail" name="prodDetail" rows="4" placeholder="Describe your product..." required></textarea>
          </div>

          <div class="form-group">
            <label for="prodImg">Upload Image</label>
            <input type="file" id="prodImg" name="prodImg" accept="image/*" required>
          </div>

          <div class="btn-group">
            <button type="submit" class="submit-btn">Upload Product</button>
            <button type="button" class="cancel-btn" onclick="window.location.href='productSwap.php'">Cancel</button>
          </div>
        </form>
      </div>
    </section>
  </main>

  <?php include 'footer.php'; ?>
  <script src="scripts/hamburger.js"></script>
</body>
</html>
