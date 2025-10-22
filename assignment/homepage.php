<?php 
$pageTitle = "EcoConnect - Homepage";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/homepage.css">
</head>
<body>

    <!-- HEADER -->
    <?php include 'header.php'; ?>

    <!-- CONTENT -->
    <main>
        <section class="imageScroll">
            <div class="carousel">
                <img src="images/homepageImg1.jpeg" alt="scroll image">
                <img src="images/homepageImg2.jpg" alt="scroll image">
                <img src="images/homepageImg3.jpg" alt="scroll image">
            </div>
        </section>

        <section class="welcome-section">
            <?php
            if (isset($_SESSION['fullname'])) {
                echo '<h2 class="welcome-text">Welcome, ' . $_SESSION['fullname'] . '!</h2>';
            } else {
                echo '<h2 class="welcome-text">Welcome to EcoConnect!</h2>';
            }
            ?>
        </section>

        <section class="programs">
            <h2><a href="recycling.php" class="section-link">Recycling Programs →</a></h2>
            <div class="scroll-container">
                <?php
                include 'dbConn.php';

                $sql = "SELECT * FROM tblprograms ORDER BY progID DESC LIMIT 6";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="card">';
                    
                    if (!empty($row['progImage'])) {
                    echo '<img src="images/' . $row['progImage'] . '" alt="' . $row['progName'] . '" style="width:100%; border-radius:8px; height:140px; object-fit:cover; margin-bottom:10px;">';
                    }

                    echo '<h3>' . $row['progName'] . '</h3>';
                    echo '<p>' . substr($row['progDetails'], 0, 100) . '...</p>';

                    echo '<form action="recyclingDetails.php" method="get">';
                    echo '<input type="hidden" name="progID" value="' . $row['progID'] . '">';
                    echo '<button type="submit" class="icon-btn">🔍</button>';
                    echo '</form>';
                    
                    echo '</div>';
                }
                } else {
                echo '<p>No programs available at the moment.</p>';
                }
                ?>
            </div>
        </section>


        <section class="tips">
            <h2><a href="gardenTip.php" class="section-link">User's Tips →</a></h2>
            <div class="scroll-container">
                <?php
                include 'dbConn.php';

                $sqlTips = "SELECT * FROM tblgardentips ORDER BY gTipDate DESC LIMIT 6";
                $resultTips = mysqli_query($conn, $sqlTips);

                if (mysqli_num_rows($resultTips) > 0) {
                    while ($tip = mysqli_fetch_assoc($resultTips)) {
                        echo '<div class="card">';

                
                        if (!empty($tip['gTipImage'])) {
                            echo '<img src="gTipsImages/' . htmlspecialchars($tip['gTipImage']) . '" 
                                alt="' . $tip['gTipName'] . '" 
                                style="width:100%; border-radius:8px; height:140px; object-fit:cover; margin-bottom:10px;">';
                        }
                        
                        echo '<h3>' . $tip['gTipName'] . '</h3>';
                        echo '<p>"' . substr($tip['gTipContent'], 0, 120) . '..."</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No tips available at the moment.</p>';
                }
                ?>
            </div>
        </section>

        <section class="projects">
            <h2><a href="gardenProject.php" class="section-link">Upcoming Projects →</a></h2>
            <div class="scroll-container">
                <?php
                $sqlProjects = "SELECT * FROM tblprojects WHERE status='Upcoming' ORDER BY startDate ASC LIMIT 6";
                $resultProjects = mysqli_query($conn, $sqlProjects);

                if (mysqli_num_rows($resultProjects) > 0) {
                    while ($prj = mysqli_fetch_assoc($resultProjects)) {
                        echo '<div class="project-card" style="background-image: url(\'images/' . $prj['prjImage'] . '\');">';
                        echo '<div class="overlay">';
                        echo '<h3>' . $prj['prjName'] . '</h3>';
                        echo '<p>' . substr($prj['prjDetails'], 0, 80) . '...</p>';
                        echo '<form action="projectDetails.php" method="get">';
                        echo '<input type="hidden" name="prjID" value="' . $prj['prjID'] . '">';
                        echo '<button type="submit">More</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No upcoming projects at the moment.</p>';
                }
                ?>
            </div>
        </section>

        <?php
        $sqlCompany = "SELECT * FROM tblcompany LIMIT 1";
        $resultCompany = mysqli_query($conn, $sqlCompany);
        $company = mysqli_fetch_assoc($resultCompany);
        ?>
        
        <section class="goals">
            <h2><a href="aboutUs.php" class="section-link">Our Goal →</a></h2>
            <p><?php echo nl2br($company['goalDtl']); ?></p>
        </section>  

    </main>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <!-- SCRIPTS -->
    <script src="scripts/hamburger.js"></script>
    <script src="scripts/homepage.js"></script>
</body>
</html>
