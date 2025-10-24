<?php
include 'dbConn.php';
session_start();

if (!isset($_GET['prjID'])) {
  header("Location: gardenProject.php");
  exit();
}

$prjID = intval($_GET['prjID']);
$sql = "SELECT * FROM tblprojects WHERE prjID = $prjID";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
  echo "<p>Project not found.</p>";
  exit();
}

$project = mysqli_fetch_assoc($result);
$pageTitle = "EcoConnect - " . htmlspecialchars($project['prjName']);
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?></title>
  <link rel="stylesheet" href="styles/global.css">
  <link rel="stylesheet" href="styles/community_gardening.css">
  <link rel="stylesheet" href="styles/gardenProjectDetails.css">
</head>
<body>
  <main>
    <section class="project-details">
      <?php if (!empty($project['prjImg'])): ?>
        <div class="project-image">
          <img src="images/<?= htmlspecialchars($project['prjImg']) ?>" 
              alt="<?= htmlspecialchars($project['prjName']) ?>">
        </div>
      <?php else: ?>
        <div class="project-image placeholder">
          <img src="images/defaultProject.jpg" alt="No image available">
        </div>
      <?php endif; ?>

      <h2><?= htmlspecialchars($project['prjName']) ?></h2>

      <p><strong>📅 Start Date:</strong> <?= htmlspecialchars($project['startDate']) ?></p>
      <p><strong>📅 End Date:</strong> <?= htmlspecialchars($project['endDate']) ?></p>
      <p><strong>🕒 Time:</strong> <?= htmlspecialchars($project['startTime']) ?> - <?= htmlspecialchars($project['endTime']) ?></p>
      <p><strong>📍 Location:</strong> <?= htmlspecialchars($project['location']) ?></p>
      <p><strong>🤝 Collaborator:</strong> <?= htmlspecialchars($project['collaborator']) ?></p>
      <p><strong>📧 Collaborator Email:</strong> <?= htmlspecialchars($project['collabEmail']) ?></p>
      <p><strong>📌 Status:</strong> <?= htmlspecialchars($project['status']) ?></p>
      <p><strong>🪴 Project Details:</strong><br><?= nl2br(htmlspecialchars($project['prjDetails'])) ?></p>

      <?php
      $joined = false;
      if (isset($_SESSION['userid'])) {
        $userID = $_SESSION['userid'];
        $check = mysqli_query($conn, "SELECT * FROM tblparticipants WHERE prjID = $prjID AND userID = $userID");
        $joined = ($check && mysqli_num_rows($check) > 0);
      }
      ?>

      <div class="btn-group">
        <button class="btn back-btn" onclick="window.location.href='gardenProject.php'">Back</button>

        <?php if (isset($_SESSION['userid'])): ?>
          <?php if ($joined): ?>
            <button type="button" class="btn join-btn" disabled>Joined</button>
          <?php else: ?>
            <button type="button" class="btn join-btn" id="joinProjectBtn" data-id="<?= $project['prjID'] ?>">Join Project</button>
          <?php endif; ?>
        <?php else: ?>
          <p class="error-msg">Please log in to join this project.</p>
        <?php endif; ?>
      </div>

      <!-- message container -->
      <div id="join-message"></div>
    </section>
  </main>

  <?php include 'footer.php'; ?>
  <script src="scripts/hamburger.js"></script>

  <script>
  document.addEventListener("DOMContentLoaded", () => {
    const joinBtn = document.getElementById("joinProjectBtn");
    const msgBox = document.getElementById("join-message");

    if (joinBtn) {
      joinBtn.addEventListener("click", () => {
        const prjID = joinBtn.dataset.id;
        msgBox.innerHTML = "";

        fetch("joinProject.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: "prjID=" + encodeURIComponent(prjID)
        })
        .then(res => res.text())
        .then(html => {
          msgBox.innerHTML = html;
          // Optionally disable button after success
          if (html.includes('success-msg')) {
            joinBtn.disabled = true;
            joinBtn.textContent = "Joined";
          }
        })
        .catch(() => {
          msgBox.innerHTML = "<div class='error-msg'>Something went wrong. Please try again later.</div>";
        });
      });
    }
  });
  </script>
</body>
</html>
