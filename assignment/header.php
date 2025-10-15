<?php
session_start();

?>


<header class="header">
    <div class="logo-container">
        <a href="homepage.php" class="logo-link">
            <img src="images/logo.jpg" alt="EcoConnect Logo" class="logo">
            <h1 class="site-title">EcoConnect</h1>
        </a>
    </div>

    <nav class="nav">
        <?php 
        if (isset($_SESSION['userid']) && $_SESSION['userid'] != "") {
        ?>
            <div class="profile-dropdown">
            <button class="profile-btn">
                <img src="images/icon-profile.png" alt="Profile" class="profile-icon">
            </button>
                <div class="dropdown-menu">
                    <a href="manageProfile.php">Manage Profile</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="guest-links">
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            </div>
        <?php
        }
        ?>


        <button class="menu-toggle" aria-label="Menu">☰</button>
    </nav>
</header>

<nav class="dropdown-nav">
    <ul>
        <li><a href="aboutUs.php">About Us</a></li>
        <li><a href="recycling.php">Recycling Programs</a></li>
        <li><a href="energyTips.php">Energy Conservation Tips</a></li>
        <li><a href="communityGardening.php">Community Gardening</a></li>
        <li><a href="productSwap.php">Eco-friendly Product Swap</a></li>
        <li><a href="businessGuide.php">Local Business Guide</a></li>
    </ul>
</nav>
