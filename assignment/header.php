<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($pageTitle)) {
    $pageTitle = "EcoConnect";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
</head>
<body>
    <header class="header">
    <div class="logo-container">
        <a href="homepage.php" class="logo-link">
            <img src="images/logo.jpg" alt="EcoConnect Logo" class="logo">
            <h1 class="site-title">EcoConnect</h1>
        </a>
    </div>

    <nav class="nav">
        <a href="profile.php" class="profile">
            <img src="images/icon-profile.png" alt="Profile" class="profile-icon">
        </a>
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