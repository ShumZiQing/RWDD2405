<?php 
include 'dbConn.php';
$pageTitle = "EcoConnect - Recycling Programs";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/recycling.css">
</head>

<body>
    <!-- HEADER -->
    <?php include 'header.php'; ?>

    <!-- CONTENT -->
    <main class="recycling">
        <section class="banner">
            <img src="images/banner1.jpg" alt="Banner">
            <h2>Recycling Programs</h2>
        </section>

        <section class="filter">
            <label for="filter">Filter by:</label>
            <select id="filter">
                <option value="all">All</option>
                <option value="plastic">Plastic</option>
                <option value="paper">Paper</option>
                <option value="glass">Glass</option>
                <option value="metal">Metal</option>
            </select>
        </section>

        <section class="program-list">
            <?php
            $sql = "SELECT * FROM tblprograms ORDER BY startDate ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $progID = $row['progID'];
                    $progName = $row['progName'];
                    $progDetails = $row['progDetails'];
                    $recyclablesType = strtolower($row['recyclablesType']);
                    $startDate = date("D - M j", strtotime($row['startDate']));
                    $startTime = date("g:i A", strtotime($row['startTime']));
                    $endTime = date("g:i A", strtotime($row['endTime']));
                    $image = 'images/' . (!empty($row['progImage']) ? $row['progImage'] : 'default.jpg');

                    $shortDetails = explode('Users can participate', $progDetails)[0];
                    
                    echo "
                    <a href='recyclingDetails.php?progID=$progID' class='program-card' data-material='$recyclablesType'>
                        <img src='$image' alt='$progName'>
                        <div class='program-info'>
                            <h3>$progName</h3>
                            <p>" . nl2br($shortDetails) . "</p>
                            <p><b>$startDate</b></p>
                            <p>$startTime ~ $endTime</p>
                        </div>
                    </a>";
                }
            } else {
                echo '<p>No recycling programs available right now.</p>';
            }
            ?>
        </section>
    </main>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <!-- SCRIPTS -->
    <script src="scripts/hamburger.js"></script>
    <script src="scripts/recycling.js"></script>
</body>
</html>
