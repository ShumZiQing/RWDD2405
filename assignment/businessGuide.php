<?php
include 'dbConn.php';
session_start();

$pageTitle = "EcoConnect - Local Business Guide";
include 'header.php';

$sql = "SELECT * FROM tblbusiness ORDER BY name ASC";
$result = mysqli_query($conn, $sql);
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
      <h2>Local Business Guide</h2>
    </section>

    <section class="filter">
      <label for="filter">Filter by:</label>
    <div class="filter-bar">
      <select id="cityFilter">
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
      <select id="categoryFilter">
        <option value="">Category</option>
        <option value="Household Items">Household Items</option>
        <option value="Health & Beauty">Health & Beauty</option>
        <option value="General Items">General Items</option>
        <option value="Food & Beverage">Food & Beverage</option>
      </select>
    </div>
    </section>

    <?php if (isset($_SESSION['userid'])): ?>
        <div class="add-btn-container">
            <a href="addBusiness.php" class="add-business-btn">+</a>
        </div>
    <?php endif; ?>

    <div class="cards-container">
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <div class="card"
          data-id="<?= $row['busID'] ?>"
          data-city="<?= htmlspecialchars($row['location']) ?>"
          data-category="<?= htmlspecialchars($row['busType']) ?>">

           <?php if (!empty($row['busImg'])): ?>
            <img src="busImages/<?= htmlspecialchars($row['busImg']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" class="business-img">
          <?php else: ?>
            <img src="images/default-business.jpg" alt="No image available" class="business-img">
          <?php endif; ?>

          <?php
          $busID = $row['busID'];
          $revQuery = mysqli_query($conn, "SELECT COUNT(*) AS total, AVG(revStars) AS avgStars FROM tblreviews WHERE busID = $busID");
          $revData = mysqli_fetch_assoc($revQuery);
          $reviewCount = (int)$revData['total'];
          $averageStars = round($revData['avgStars'], 1);
          ?>
          <div class="review-summary">
            <?php if ($reviewCount > 0): ?>
              <p>⭐ <?= $averageStars ?> (<?= $reviewCount ?> reviews)</p>
            <?php else: ?>
              <p>No reviews yet</p>
            <?php endif; ?>
          </div>

          <div class="card-content">
            <div class="card-header">
              <h3><?= htmlspecialchars($row['name']) ?></h3>
              <p class="type">📝 <?= htmlspecialchars($row['busType']) ?></p>
            </div>
            <div class="card-body">
              <p class="location">📍 <?= htmlspecialchars($row['location']) ?></p>
              <p class="phone">☎️ <?= htmlspecialchars($row['phoneNum']) ?></p>
              <p><?= htmlspecialchars($row['description']) ?></p>
            </div>
            <div class="card-footer">
              <?php
              $liked = false;
              if (isset($_SESSION['userid'])) {
                $uid = $_SESSION['userid'];
                $checkFav = mysqli_query($conn, "SELECT * FROM tblfavourites WHERE userID=$uid AND busID={$row['busID']}");
                $liked = mysqli_num_rows($checkFav) > 0;
              }
              ?>
              <button class="fav-btn <?= $liked ? 'liked' : '' ?>" data-id="<?= $row['busID'] ?>">
                <?= $liked ? '❤️' : '🤍' ?>
              </button>

              <a href="businessDetails.php?busID=<?= $busID ?>" class="view-reviews-btn">View Details & Reviews</a>
            </div>
          </div>
            </div>
          </div>

        <?php endwhile; ?>
      <?php else: ?>
        <p class="no-business">No businesses found.</p>
      <?php endif; ?>
    </div>
    
</main>
  <?php include 'footer.php'; ?>
  <script src="scripts/hamburger.js"></script>
  <script src="scripts/busiFav.js"></script>
  <script src="scripts/businessGuide.js"></script>
</body>
</html>
