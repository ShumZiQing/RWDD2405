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
      <h2><?= htmlspecialchars($project['prjName']) ?></h2>

      <p><strong>📅 Start Date:</strong> <?= htmlspecialchars($project['startDate']) ?></p>
      <p><strong>📅 End Date:</strong> <?= htmlspecialchars($project['endDate']) ?></p>
      <p><strong>🕒 Time:</strong> <?= htmlspecialchars($project['startTime']) ?> - <?= htmlspecialchars($project['endTime']) ?></p>
      <p><strong>📍 Location:</strong> <?= htmlspecialchars($project['location']) ?></p>
      <p><strong>🤝 Collaborator:</strong> <?= htmlspecialchars($project['collaborator']) ?></p>
      <p><strong>📧 Collaborator Email:</strong> <?= htmlspecialchars($project['collabEmail']) ?></p>
      <p><strong>📌 Status:</strong> <?= htmlspecialchars($project['status']) ?></p>
      <p><strong>🪴 Project Details:</strong><br><?= nl2br(htmlspecialchars($project['prjDetails'])) ?></p>

      <div class="btn-group">
        <button class="btn back-btn" onclick="window.location.href='gardenProject.php'">Back</button>

        <form action="joinProject.php" method="POST">
          <input type="hidden" name="prjID" value="<?= $project['prjID'] ?>">
          <button type="submit" class="btn join-btn">Join Project</button>
        </form>
      </div>
    </section>
  </main>

  <?php include 'footer.php'; ?>
  <script src="scripts/hamburger.js"></script>
</body>
</html>