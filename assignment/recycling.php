<?php 
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
            </select>
        </section>

        <section class="program-list">

            <!-- PLASTIC -->
            <a href="bottleCollector.php" class="program-card" data-material="plastic">
                <img src="images/bottleCollector.jpg" alt="Plastic Bottle Drive">
                <div class="program-info">
                    <h3>Plastic Bottle Drive</h3>
                    <p>Community plastic bottle collection for recycling</p>
                    <p><b>Wednesday - Sept 17</b></p>
                    <p>10:00 AM ~ 12:00 PM</p>
                </div>
            </a>

            <a href="plasticCollector.php" class="program-card" data-material="plastic">
                <img src="images/plasticCollector.jpg" alt="Plastic Container Drop-off">
                <div class="program-info">
                    <h3>Plastic Container Drop-off</h3>
                    <p>Bring used containers for recycling and reuse</p>
                    <p><b>Friday - Sept 19</b></p>
                    <p>1:00 PM ~ 3:00 PM</p>
                </div>
            </a>

            <!-- PAPER -->
            <a href="newspaperCollector.php" class="program-card" data-material="paper">
                <img src="images/newspaperCollector.jpg" alt="Newspaper Collection">
                <div class="program-info">
                    <h3>Newspaper Collection</h3>
                    <p>Old newspaper pickup service</p>
                    <p><b>Tuesday - Sept 16</b></p>
                    <p>9:00 AM ~ 11:00 AM</p>
                </div>
            </a>

            <a href="cardboardCollector.php" class="program-card" data-material="paper">
                <img src="images/cardboardCollector.jpg" alt="Cardboard Recycling Drive">
                <div class="program-info">
                    <h3>Cardboard Recycling Drive</h3>
                    <p>Collecting cardboard boxes for recycling</p>
                    <p><b>Saturday - Sept 20</b></p>
                    <p>2:00 PM ~ 4:00 PM</p>
                </div>
            </a>

            <!-- GLASS -->
            <a href="jarCollector.php" class="program-card" data-material="glass">
                <img src="images/jarCollector.jpg" alt="Glass Recycling Drop-off">
                <div class="program-info">
                    <h3>Glass Recycling Drop-off</h3>
                    <p>Bring glass bottles and jars for safe recycling</p>
                    <p><b>Thursday - Sept 18</b></p>
                    <p>11:00 AM ~ 1:00 PM</p>
                </div>
            </a>

            <a href="glassCollector.php" class="program-card" data-material="glass">
                <img src="images/glassCollector.jpg" alt="Glass Bottle Collection">
                <div class="program-info">
                    <h3>Glass Bottle Collection</h3>
                    <p>Community drive for recycling clear and colored glass</p>
                    <p><b>Sunday - Sept 21</b></p>
                    <p>9:00 AM ~ 11:00 AM</p>
                </div>
            </a>
        </section>
    </main>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <!-- Scripts -->
    <script src="scripts/hamburger.js"></script>
    <script src="scripts/recycling.js"></script>
</body>
</html>
