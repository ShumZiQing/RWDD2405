<?php 
$pageTitle = "EcoConnect - About Us";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/aboutUs.css">
</head>
<body>

    <!-- HEADER -->
    <?php include 'header.php'; ?>

    <!-- CONTENT -->
    <main class="about">
        <section class="banner">
            <img src="images/banner1.jpg" alt="Banner">
            <h2>About Us</h2>
        </section>

        <section class="mission">
            <h2>Our Mission</h2>
            <p>At EcoConnect, our mission is to inspire and empower communities to live more sustainably by providing practical tools, resources, and opportunities to make eco-friendly choices part of everyday life. We believe that small actions, when multiplied across neighborhoods and cities, can create a significant impact in protecting our environment for future generations. Through collaboration with local groups, schools, and organizations, we aim to build a culture of responsibility, awareness, and care for the planet we all share.</p>
        </section>

        <section class="what-we-do">
            <h2>What We Do</h2>
            <p>EcoConnect serves as a hub where individuals and organizations come together to share ideas, participate in programs, and support sustainable initiatives. From organizing recycling and donation drives to promoting renewable energy and community gardening, we strive to make sustainable living accessible and engaging for everyone. By connecting NGOs, local businesses, and everyday citizens, we create opportunities to learn, act, and grow together toward a healthier, greener future.</p>
            <img src="images/aboutUS1.png" alt="Community Image" class="communityIMG">
        </section>
    </main>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <!-- SCRIPTS -->
    <script src="scripts/hamburger.js"></script>
</body>
</html>
