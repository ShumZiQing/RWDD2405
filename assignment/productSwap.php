<?php
include 'dbConn.php';
session_start();

$cityFilter = $_GET['city'] ?? 'all';
$typeFilter = $_GET['type'] ?? 'all';

$query = "SELECT p.*, 
                 u.name AS userName, 
                 u.username AS userUsername, 
                 u.email, 
                 u.phone, 
                 u.city AS userCity
          FROM tblproducts p
          JOIN tbluser u ON p.userID = u.userID
          WHERE 1";

if ($cityFilter !== 'all') {
  $query .= " AND p.prodCity = '" . mysqli_real_escape_string($conn, $cityFilter) . "'";
}
if ($typeFilter !== 'all') {
  $query .= " AND p.prodType = '" . mysqli_real_escape_string($conn, $typeFilter) . "'";
}

$query .= " ORDER BY p.prodDate DESC";
$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eco-Friendly Product Swap - EcoConnect</title>
  <link rel="stylesheet" href="styles/global.css">
  <link rel="stylesheet" href="styles/productSwap.css">
</head>
<body>
  <?php include 'header.php'; ?>

  <main class="product-swap">
    <section class="banner">
      <img src="images/banner1.jpg" alt="Product Swap Banner">
      <h2>Eco-Friendly Product Swap</h2>
    </section>   

    <div class="filter-bar">
        <div class="filter">
            <label for="filter">Filter by:</label><br>
        <select id="cityFilter">
            <option value="all">City</option>
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

        <select id="typeFilter">
            <option value="all">Category</option>
            <option value="Household items">Household items</option>
            <option value="Packaging">Packaging</option>
            <option value="Utensils">Utensils</option>
        </select>
        </div>
    </div>

    <?php if (isset($_SESSION['userid'])): ?>
        <div class="add-btn-container">
            <a href="addProductSwap.php" class="add-btn">+</a>
        </div>
    <?php endif; ?>

    <div class="cards-container">
  <?php if (mysqli_num_rows($result) > 0): ?>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <div class="card" 
           data-city="<?= htmlspecialchars($row['prodCity']) ?>" 
           data-category="<?= htmlspecialchars($row['prodType']) ?>">

        <div class="card-content">
          <div class="user-info">
            <h3><?= htmlspecialchars($row['userName']) ?></h3>
            <p class="date"><?= htmlspecialchars(date('d/m/Y', strtotime($row['prodDate']))) ?></p>
          </div>

          <div class="meta">
            🛒 <?= htmlspecialchars($row['prodName']) ?><br>
            🏷️ <?= htmlspecialchars($row['prodType']) ?><br>
            📍 <?= htmlspecialchars($row['prodCity']) ?>
          </div>


          <p class="prod-detail"><?= nl2br(htmlspecialchars($row['prodDetail'])) ?></p>
        </div>

        <div class="card-right">
          <?php if (!empty($row['prodImg'])): ?>
            <div class="card-image">
              <img src="prodImages/<?= htmlspecialchars($row['prodImg']) ?>" 
                   alt="<?= htmlspecialchars($row['prodName']) ?>">
            </div>
          <?php endif; ?>

          <div class="button-group">
            <button class="contact-btn"
              data-name="<?= htmlspecialchars($row['userName']) ?>"
              data-email="<?= htmlspecialchars($row['email']) ?>"
              data-phone="<?= htmlspecialchars($row['phone']) ?>"
              data-city="<?= htmlspecialchars($row['userCity']) ?>">
              contact
            </button>

            <?php if (isset($_SESSION['userid']) && $_SESSION['userid'] == $row['userID']): ?>
              <form method="POST" action="deleteProduct.php" onsubmit="return confirm('Are you sure you want to delete this product?');" class="delete-form">
                <input type="hidden" name="prodID" value="<?= $row['prodID'] ?>">
                <button type="submit" class="delete-btn" title="Delete Product">🗑️</button>
              </form>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>No products found.</p>
  <?php endif; ?>
</div>

 </main>

  <div id="contactPopup" class="popup">
    <div class="popup-content">
      <span class="close">&times;</span>
      <h3>Contact Info</h3>
      <p><strong>Name:</strong> <span id="contactName"></span></p>
      <p><strong>Phone:</strong> <span id="contactPhone"></span></p>
      <p><strong>Email:</strong> <span id="contactEmail"></span></p>
      <p><strong>City:</strong> <span id="contactCity"></span></p>
    </div>
  </div>

  <?php include 'footer.php'; ?>
  <script src="scripts/productSwap.js"></script>
  <script src="scripts/hamburger.js"></script>
</body>
</html>
