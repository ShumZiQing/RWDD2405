<?php
include 'dbConn.php';
session_start();

if (!isset($_GET['busID'])) {
  header("Location: businessGuide.php");
  exit;
}

$busID = intval($_GET['busID']);

$busQuery = mysqli_query($conn, "SELECT * FROM tblbusiness WHERE busID = $busID");
if (mysqli_num_rows($busQuery) === 0) {
  echo "<p>Business not found.</p>";
  exit;
}
$bus = mysqli_fetch_assoc($busQuery);

$reviewQuery = mysqli_query($conn, "SELECT * FROM tblreviews WHERE busID = $busID ORDER BY revID DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($bus['name']) ?> - EcoConnect</title>
  <link rel="stylesheet" href="styles/global.css">
  <link rel="stylesheet" href="styles/businessGuide.css">
  <link rel="stylesheet" href="styles/businessDetails.css">
</head>
<body>
  <?php include 'header.php'; ?>

  <main class="business-details">

  <section class="banner">
      <img src="images/banner1.jpg" alt="Banner">
      <h2>Local Business Details</h2>
    </section>

  <h2><a href="businessGuide.php" class="section-link">← Return to Guide</a></h2>
  <div class="business-details-container">
    <div class="business-card">
      <?php if (!empty($bus['busImg'])): ?>
        <img src="busImages/<?= htmlspecialchars($bus['busImg']) ?>" alt="<?= htmlspecialchars($bus['name']) ?>" class="business-detail-img">
      <?php else: ?>
        <img src="images/default-business.jpg" alt="No image available" class="business-detail-img">
      <?php endif; ?>

      <div class="business-info">
        <h2><?= htmlspecialchars($bus['name']) ?></h2>
        <p>📝 <?= htmlspecialchars($bus['busType']) ?></p>
        <p>📍 <?= htmlspecialchars($bus['location']) ?></p>
        <p>☎️ <?= htmlspecialchars($bus['phoneNum']) ?></p>
        <p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($bus['description'])) ?></p>
      </div>

      <hr class="separator">

      <div class="reviews-section">
        <h3>Reviews</h3>
        <?php if (mysqli_num_rows($reviewQuery) > 0): ?>
          <?php while ($rev = mysqli_fetch_assoc($reviewQuery)): ?>
            <div class="review-card">
              <h4><?= htmlspecialchars($rev['revName']) ?></h4>
              <p class="stars"><?= str_repeat("⭐", (int)$rev['revStars']) ?></p>
              <p><?= nl2br(htmlspecialchars($rev['revContent'])) ?></p>

              <?php if (isset($_SESSION['userid']) && $_SESSION['userid'] == $rev['userID']): ?>
                <form action="deleteReview.php" method="POST" onsubmit="return confirm('Delete this review?');" class="delete-review-form">
                  <input type="hidden" name="revID" value="<?= $rev['revID'] ?>">
                  <input type="hidden" name="busID" value="<?= $busID ?>">
                  <section class="delete-btn">
                  <button type="submit" class="delete-review-btn">Delete</button>
                  </section>
                </form>
              <?php endif; ?>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p class="no-reviews">No reviews yet.</p>
        <?php endif; ?>
      </div>

      <hr class="separator">

      <?php if (isset($_SESSION['userid'])): ?>
        <div class="add-review-section">
          <h3>Write a Review</h3>
          <form action="addReview.php" method="POST" class="review-form">
            <input type="hidden" name="busID" value="<?= $busID ?>">

            <label for="revName">Title</label>
            <input type="text" id="revName" name="revName" required>

            <label for="revStars">Rating</label>
            <select id="revStars" name="revStars" required>
              <option value="5">⭐⭐⭐⭐⭐ (5)</option>
              <option value="4">⭐⭐⭐⭐ (4)</option>
              <option value="3">⭐⭐⭐ (3)</option>
              <option value="2">⭐⭐ (2)</option>
              <option value="1">⭐ (1)</option>
            </select>

            <label for="revContent">Review</label>
            <textarea id="revContent" name="revContent" rows="4" required></textarea>

            <button type="submit">Submit Review</button>
          </form>
        </div>
      <?php else: ?>
        <div class="add-review-section">
          <h3>Write a Review</h3>
          <p class="login-required">You must <a href="login.php">log in</a> to write a review.</p>
        </div>
      <?php endif; ?>

    </div>
    </div>
  </main>

  <?php include 'footer.php'; ?>
  <script src="scripts/hamburger.js"></script>
</body>
</html>
