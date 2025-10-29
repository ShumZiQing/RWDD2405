<?php
include 'dbConn.php';
session_start();

if (!isset($_SESSION['userid'])) {
  header("Location: login.php");
  exit();
}

$userID = $_SESSION['userid'];
$pageTitle = "EcoConnect - My Activities";
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?></title>
  <link rel="stylesheet" href="styles/global.css">
  <link rel="stylesheet" href="styles/showActivities.css">
  
</head>
<body>
  <main class="activities-container">
    
    <!-- Joined Projects -->
    <section class="activity-card">
      <h2>🌱 Joined Community Projects</h2>
      <?php
      $sql = "SELECT p.prjID, p.prjName, p.startDate, p.endDate, p.startTime, p.endTime
              FROM tblparticipants tp
              JOIN tblprojects p ON tp.prjID = p.prjID
              WHERE tp.userID = '$userID'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "
          <div class='activity-item'>
            <div class='activity-info'>
              <strong>{$row['prjName']}</strong><br>
              {$row['startDate']} to {$row['endDate']} | {$row['startTime']} - {$row['endTime']}
            </div>
            <button class='view-btn' onclick=\"window.location.href='gardenProjectDetails.php?prjID={$row['prjID']}'\">View</button>
          </div>";
        }
      } else {
        echo "<p class='no-record'>You haven’t joined any projects yet.</p>";
      }
      ?>
    </section>

    <!-- Favourites Card -->
    <section class="activity-card">
      <h2>💚 My Favourites</h2>

      <!-- Favourite Businesses -->
      <h3>🏪 Favourite Businesses</h3>
      <?php
      $sqlBus = "SELECT b.busID, b.name
                 FROM tblfavourites f
                 JOIN tblbusiness b ON f.busID = b.busID
                 WHERE f.userID = '$userID' AND f.busID IS NOT NULL";
      $resBus = mysqli_query($conn, $sqlBus);
      if (mysqli_num_rows($resBus) > 0) {
        while ($row = mysqli_fetch_assoc($resBus)) {
          echo "
          <div class='activity-item'>
            <div class='activity-info'><strong>{$row['name']}</strong></div>
            <button class='view-btn' onclick=\"window.location.href='businessDetails.php?busID={$row['busID']}'\">View</button>
          </div>";
        }
      } else {
        echo "<p class='no-record'>No favourite businesses yet.</p>";
      }
      ?>

      <div class="separator"></div>

      <!-- Liked Energy Tips -->
      <h3>⚡ Liked Energy Tips</h3>
      <?php
      $sqlEnergy = "SELECT e.eTipID, e.eTipName
                    FROM tblfavourites f
                    JOIN tblenergytips e ON f.eTipID = e.eTipID
                    WHERE f.userID = '$userID' AND f.eTipID IS NOT NULL";
      $resEnergy = mysqli_query($conn, $sqlEnergy);
      if (mysqli_num_rows($resEnergy) > 0) {
        while ($row = mysqli_fetch_assoc($resEnergy)) {
          echo "
          <div class='activity-item'>
            <div class='activity-info'><strong>{$row['eTipName']}</strong></div>
            <button class='view-btn' onclick=\"window.location.href='energyTips.php#tip{$row['eTipID']}'\">View</button>
          </div>";
        }
      } else {
        echo "<p class='no-record'>No liked energy tips yet.</p>";
      }
      ?>

      <div class="separator"></div>

      <!-- Liked Gardening Tips -->
      <h3>🪴 Liked Gardening Tips</h3>
      <?php
      $sqlGarden = "SELECT g.gTipID, g.gTipName
                    FROM tblfavourites f
                    JOIN tblgardentips g ON f.gTipID = g.gTipID
                    WHERE f.userID = '$userID' AND f.gTipID IS NOT NULL";
      $resGarden = mysqli_query($conn, $sqlGarden);
      if (mysqli_num_rows($resGarden) > 0) {
        while ($row = mysqli_fetch_assoc($resGarden)) {
          echo "
          <div class='activity-item'>
            <div class='activity-info'><strong>{$row['gTipName']}</strong></div>
            <button class='view-btn' onclick=\"window.location.href='gardenTip.php#tip{$row['gTipID']}'\">View</button>
          </div>";
        }
      } else {
        echo "<p class='no-record'>No liked gardening tips yet.</p>";
      }
      ?>
    </section>

  </main>

  <?php include 'footer.php'; ?>
  <script src="scripts/hamburger.js"></script>
</body>
</html>
