<?php
include 'dbConn.php';
session_start();

$pageTitle = "EcoConnect - Community Gardening Projects";
include 'header.php';
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
    <section class="banner">
      <img src="images/banner1.jpg" alt="Banner">
      <h2>Community Gardening Projects</h2>
    </section>

    <div class="tabs">
      <button class="tab-btn active">Community Gardening</button>
      <button class="tab-btn" onclick="window.location.href='gardenTip.php'">
        Community Gardening Tips
      </button>
    </div>

    <div class="cards-container">
      <p class="no-projects-msg">No community projects yet.</p>
    </div>
  </main>

  <?php include 'footer.php'; ?>

  <script src="scripts/communityGardening.js"></script>
  <script src="scripts/hamburger.js"></script>
</body>
</html>
