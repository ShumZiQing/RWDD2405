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
            <?php if (isset($_SESSION['fullname'])): ?>
                <h2 class="welcome-text">
                Welcome, <?php echo $_SESSION['fullname']; ?>!
                </h2>
            <?php else: ?>
                <h2 class="welcome-text">
                Welcome to EcoConnect!
                </h2>
            <?php endif; ?>
        </section>

        <section class="programs">
            <h2>Our Programs</h2>
            <div class="scroll-container">
                <div class="card">
                    <h3>Recycling</h3>
                    <p>Explore EcoConnect's recycling and collection schedules. Click to see schedules and get involved.</p>
                    <button class="icon-btn">🔍</button>
                </div>

                <div class="card">
                    <h3>Donations</h3>
                    <p>Join our donation drives to support NGOs and community projects.</p>
                    <button class="icon-btn">🔍</button>
                </div>

                <div class="card"><b>Bottle Collector</b></div>
                <div class="card"><b>Newspaper Collection</b></div>
            </div>
        </section>

        <section class="tips">
            <h2>User's Tips</h2>
            <div class="scroll-container">
                <div class="card">"If you're new, join recycling programs to get to know more!"</div>
                <div class="card">"Collection schedules may be confusing, feel free to ask!"</div>
            </div>
        </section>

        <section class="projects">
            <h2>Upcoming Projects</h2>
            <div class="scroll-container">
                <div class="project-card" style="background-image: url('images/homepageImg5.jpg');">
                    <div class="overlay">
                        <h3>Produce Donations</h3>
                        <p>Donate fresh produce for a small fee. Funds go to local NGOs!</p>
                        <button>More</button>
                    </div>
                </div>

                <div class="project-card" style="background-image: url('images/homepageImg4.jpg');">
                    <div class="overlay">
                        <h3>Plastic Collection</h3>
                        <p>Join an NGO to collect and reuse plastics for eco projects.</p>
                        <button>More</button>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="goals">
            <h2>Our Goals</h2>
            <p>
                EcoConnect aims to provide a shared platform for eco-focused groups, 
                including NGOs, local communities, and conservation experts, to connect 
                and collaborate. Through this space, we bring people together by hosting 
                events, sharing sustainable living tips, and encouraging community-driven 
                initiatives. Our mission is to raise awareness, reduce carbon footprints, 
                and promote sustainable lifestyles within the community. By fostering eco-friendly 
                behaviors, we strive to combat global warming and create a greener, more sustainable 
                future for everyone.
            </p>
        </section>  
    </main>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <!-- SCRIPTS -->
    <script src="scripts/hamburger.js"></script>
    <script src="scripts/homepage.js"></script>
</body>
</html>
