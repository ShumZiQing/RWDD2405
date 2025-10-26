<?php
include 'dbConn.php';
$pageTitle = "EcoConnect - Program Details";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/recyclingDetails.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <main class="program-details">
        <div class="back-container">
            <a href="recycling.php" class="back-btn">← Recycling Programs</a>
        </div>

        <?php
        if (isset($_GET['progID'])) {
            $progID = $_GET['progID'];
            $sql = "SELECT * FROM tblprograms WHERE progID = '$progID'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $image = 'images/' . (!empty($row['progImage']) ? $row['progImage'] : 'default.jpg');

                echo "
                <section class='details-container'>
                    <img src='$image' alt='{$row['progName']}' class='details-image'>
                    <div class='details-text'>
                        <h2>{$row['progName']}</h2>
                        <p><b>Type:</b> {$row['recyclablesType']}</p>
                        <p><b>Date:</b> " . date('D - M j', strtotime($row['startDate'])) . "</p>
                        <p><b>Time:</b> " . date('g:i A', strtotime($row['startTime'])) . " - " . date('g:i A', strtotime($row['endTime'])) . "</p>
                        <p><b>Location:</b> {$row['location']}</p>
                        <p><b>Frequency:</b> {$row['frequency']}</p>
                        <hr>
                        <p>" . nl2br($row['progDetails']) . "</p>
                    </div>
                </section>";
            } else {
                echo "<p>Program not found.</p>";
            }
        } else {
            echo "<p>No program selected.</p>";
        }
        ?>
    </main>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <!-- SCRIPTS -->
    <script src="scripts/hamburger.js"></script>
</body>
</html>
