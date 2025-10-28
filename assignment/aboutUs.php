<?php 
include 'dbConn.php'; 
$pageTitle = "EcoConnect - About Us";

$sql = "SELECT * FROM tblcompany WHERE companyID = 1";
$result = mysqli_query($conn, $sql);
$company = mysqli_fetch_assoc($result);
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
            <p><?php echo nl2br($company['missionDtl']); ?></p>
        </section>

        <section class="goal">
            <h2>Our Goal</h2>
            <p><?php echo nl2br($company['goalDtl']); ?></p>
        </section>

        <section class="what-we-do">
            <h2>What We Do</h2>
            <p><?php echo nl2br($company['wwdDtl']); ?></p>
            <img src="<?php echo !empty($company['companyImg']) ? 'images/' . $company['companyImg'] : 'images/aboutUS1.png'; ?>" 
            alt="Community Image" class="communityIMG">
        </section>
    </main>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <!-- SCRIPTS -->
    <script src="scripts/hamburger.js"></script>
</body>
</html>
