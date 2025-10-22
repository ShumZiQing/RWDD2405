<?php
include 'dbConn.php';
session_start();

$pageTitle = "EcoConnect - Community Gardening Tips";
include 'header.php';

$sql = "SELECT * FROM tblgardentips ORDER BY gTipDate DESC";
$result = mysqli_query($conn, $sql);

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
        <h2>Community Gardening Tips</h2>
        </section>

        <div class="tabs">
        <button class="tab-btn" onclick="window.location.href='gardenProject.php'">Community Gardening</button>
        <button class="tab-btn active">Community Gardening Tips</button>

       <?php if (isset($_SESSION['userid'])): ?>
        <div class="add-btn-container">
          <a href="addGardenTip.php" class="add-tip-btn">+</a>
        </div>
      <?php endif; ?>
    </div>

        <div class="cards-container">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="card" data-id="<?= $row['gTipID'] ?>">
                <?php if (!empty($row['gTipImage'])): ?>
                <img src="gTipsImages/<?= htmlspecialchars($row['gTipImage']) ?>" alt="Tip Image">
                <?php endif; ?>
                <div class="card-content">
                <h3><?= htmlspecialchars($row['gTipName']) ?></h3>
                <p><small><?= htmlspecialchars($row['gTipDate']) ?></small></p>
                <p><?= nl2br(htmlspecialchars($row['gTipContent'])) ?></p>
                <div class="card-actions">
                    <button class="like-btn" data-id="<?= $row['gTipID'] ?>">
                    👍 <span><?= $row['gTipLikes'] ?></span>
                    </button>
                    <?php if (isset($_SESSION['userid']) && $_SESSION['userid'] == $row['userID']): ?>
                    <button class="delete-btn" data-id="<?= $row['gTipID'] ?>">Delete</button>
                    <?php endif; ?>
                </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-tips-msg">No gardening tips found. Be the first to share one!</p>
        <?php endif; ?>
        </div>


  </main>

    <?php include 'footer.php'; ?>
    <script src="scripts/communityGardening.js"></script>
    <script src="scripts/hamburger.js"></script> 
</body>
</html>