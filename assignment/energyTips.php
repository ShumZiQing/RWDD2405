<?php 
include 'dbConn.php';
session_start();

$pageTitle = "EcoConnect - Energy Conservation Tips";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" href="styles/global.css">
  <link rel="stylesheet" href="styles/energyTips.css">
</head>

<body>
  <!-- HEADER -->
  <?php include 'header.php'; ?>

  <!-- CONTENT -->
  <main class="energy">
    <section class="banner">
      <img src="images/banner1.jpg" alt="Banner">
      <h2>Energy Conservation Tips</h2>
    </section>

    <div class="tabs-row">
      <section class="tabs">
        <button class="tab-btn active" data-target="home">Home</button>
        <button class="tab-btn" data-target="workplace">Workplace</button>
      </section>

      <?php
        if (isset($_SESSION['userid'])) {
          echo '
            <div class="add-btn-container">
              <a href="addEnergyTip.php" class="add-tip-btn">+ Add New Tip</a>
            </div>
          ';
        }
      ?>
  </div>

    <!-- HOME TIPS -->
    <section id="home" class="tips-list active">
      <?php
        $query = "SELECT * FROM tblenergytips WHERE eTipType='home'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <div class="tip-card" data-id="' . $row['eTipID'] . '">
              <img src="images/' . $row['eTipImage'] . '" alt="' . $row['eTipName'] . '">
              <h3>' . $row['eTipName'] . '</h3>
              <ul>';
              
              // Split bullet points by newline or comma
              $bullets = preg_split('/[\r\n,]+/', $row['eTipContent']);
              foreach ($bullets as $tip) {
                echo '<li>' . trim($tip) . '</li>';
              }
              
            echo '</ul>
            
            <div class="card-actions">
              <button class="like-btn" data-id="' . $row['eTipID'] . '">
                👍 <span>' . $row['eTipLikes'] . '</span>
              </button>';

              if (isset($_SESSION['userid']) && $_SESSION['userid'] == $row['userID']) {
                echo '<button class="delete-btn" data-id="' . $row['eTipID'] . '">Delete</button>';
              }

            echo '</div>

            </div>';
          }
        } else {
          echo "<p>No home energy tips available yet.</p>";
        }
      ?>
    </section>

    <!-- WORKPLACE TIPS -->
    <section id="workplace" class="tips-list">
      <?php
        $query = "SELECT * FROM tblenergytips WHERE eTipType='workplace'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <div class="tip-card" data-id="' . $row['eTipID'] . '">
              <img src="images/' . $row['eTipImage'] . '" alt="' . $row['eTipName'] . '">
              <h3>' . $row['eTipName'] . '</h3>
              <ul>';
              
              $bullets = preg_split('/[\r\n,]+/', $row['eTipContent']);
              foreach ($bullets as $tip) {
                echo '<li>' . trim($tip) . '</li>';
              }
              
            echo '</ul>
            
            <div class="card-actions">
              <button class="like-btn" data-id="' . $row['eTipID'] . '">
                👍 <span>' . $row['eTipLikes'] . '</span>
              </button>';

              if (isset($_SESSION['userid']) && $_SESSION['userid'] == $row['userID']) {
                echo '<button class="delete-btn" data-id="' . $row['eTipID'] . '">Delete</button>';
              }

            echo '</div>

            </div>';
          }
        } else {
          echo "<p>No workplace energy tips available yet.</p>";
        }
      ?>
    </section>
  </main>

  <!-- FOOTER -->
  <?php include 'footer.php'; ?>

  <!-- SCRIPTS -->
  <script src="scripts/hamburger.js"></script>
  <script src="scripts/energyTips.js"></script>
</body>
</html>
