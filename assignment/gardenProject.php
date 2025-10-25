<?php
include 'dbConn.php';
session_start();

$pageTitle = "EcoConnect - Community Gardening Projects";
include 'header.php';

$sql = "SELECT * FROM tblprojects";
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
      <h2>Community Gardening Projects</h2>
    </section>

    <div class="tabs">
      <button class="tab-btn active">Community Gardening</button>
      <button class="tab-btn" onclick="window.location.href='gardenTip.php'">
        Community Gardening Tips
      </button>
    </div>

    <?php if (isset($_GET['msg'])): ?>
      <?php 
        $msgType = $_GET['type'] ?? 'success'; 
        $msgClass = $msgType === 'error' ? 'error-msg' : 'success-msg';
      ?>
      <div class="<?= $msgClass ?>">
        <?= htmlspecialchars($_GET['msg']) ?>
      </div>
    <?php endif; ?>


    <div class="cards-container">
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <div class="project-card">
            <h3><?= htmlspecialchars($row['prjName']) ?></h3>
            <p><strong>📅 Start:</strong> <?= htmlspecialchars($row['startDate']) ?></p>
            <p><strong>📅 End:</strong> <?= htmlspecialchars($row['endDate']) ?></p>
            <p><strong>📍 Location:</strong> <?= htmlspecialchars($row['location']) ?></p>
            <p><strong>🤝 Collaborator:</strong> <?= htmlspecialchars($row['collaborator']) ?></p>

            <?php
              $joined = false;
              if (isset($_SESSION['userid'])) {
                $userID = $_SESSION['userid'];
                $check = mysqli_query($conn, "SELECT * FROM tblparticipants WHERE prjID = {$row['prjID']} AND userID = $userID");
                $joined = ($check && mysqli_num_rows($check) > 0);
              }
              ?>
              <div class="btn-group">
                <button 
                  class="btn explore-btn" 
                  onclick="window.location.href='gardenProjectDetails.php?prjID=<?= $row['prjID'] ?>'">
                  Explore
                </button>

                <?php if (isset($_SESSION['userid'])): ?>
                  <?php if ($joined): ?>
                    <div id="join-message"></div>
                    <button type="button" class="btn join-btn" onclick="alert('You have already joined this project.')">Joined</button>
                  <?php else: ?>
                    <form action="joinProject.php" method="POST" style="margin:0;">
                      <input type="hidden" name="prjID" value="<?= $row['prjID'] ?>">
                      <button type="submit" class="btn join-btn">Join</button>
                    </form>
                  <?php endif; ?>
                <?php endif; ?>
              </div>

          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="no-projects-msg">No community projects yet.</p>
      <?php endif; ?>
    </div>
  </main>

  <?php include 'footer.php'; ?>

  <script src="scripts/communityGardening.js"></script>
  <script src="scripts/hamburger.js"></script>
</body>
</html>
