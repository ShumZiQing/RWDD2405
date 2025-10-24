<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Homepage</title>
    <link rel="stylesheet" href="styles/admin_home.css">
    <link rel="stylesheet" href="styles/global.css">
</head>
<body>
    <header class="header">
        <div class="logo-container">
            <img src="images/logo.jpg" alt="EcoConnect Logo" class="logo">
            <h1 class="site-title">EcoConnect</h1> 
        </div>

        <nav class="header-nav">
            <a href="admin_profile.php">
                <img src="images/user.png" alt="user icon">
            </a>
        </nav>
    </header>
    
    <main>
        <section class="home">
            <?php
                if(isset($_SESSION["userid"]) != ""){
            ?>
                <h2>Hello, <?php echo $_SESSION['fullname']; ?></h2>

            <?php }?>
            <p id="sub">What would you like to do?</p> 
        </section>

        <section class="selection">
            <a href="admin_mngUser.php">
            <div class="selection-box">
                <img src="images/user-icon.png" alt="icon" class="icons">
                <a href="admin_mngUser.php">Manage Users</a>
            </div>
            </a>
            
            <div id="nav-collab" class="selection-dropdown">
                <img src="images/collab.png" alt="icon" class="icons">
                    Collaborators
                    <img src="images/down-arrow.png" alt="icon" class="arrow">
                    <ul>
                        <a href="admin_addCollab.php"><li>Add Collaborator</li></a>
                        <a href="admin_collab.php"><li>View Collaborator</li></a>
                    </ul>
                </div>

            <div id="nav-act", class="selection-dropdown">
                <img src="images/globe.png" alt="icon" class="icons">
                <a href="#">All activities</a>
                    <img src="images/down-arrow.png" alt="icon" class="arrow">
                    <ul>
                        <li>Add activities 
                            <img src="images/down-arrow.png" alt="icon" class="arrow">
                            <ul>
                                <a href="admin_addPrj.php"><li>Add Project</li></a>
                                <a href="admin_addProg.php"><li>Add Program</li></a>
                            </ul>
                        </li>
                            <a href="admin_activities.php"><li>View activities</li></a>
                    </ul>
                </div>
            
            <a href="admin_editAbtus.php">
                <div class="selection-box">
                    <img src="images/edit.png" alt="icon" class="icons">
                    Edit About Us
                </div>
            </a>

            <a href="admin_business.php">
            <div class="selection-box">
                <img src="images/briefcase (1).png" alt="icon" class="icons">
                All Businesses
            </div>
            </a>

            <div id="nav-tips" class="selection-dropdown">
                <img src="images/idea.png" alt="icon" class="icons">
                    All Tips
                    <img src="images/down-arrow.png" alt="icon" class="arrow">
                    <ul>
                        <a href="admin_energyTips.php"><li>Energy Tips</li></a>
                        <a href="admin_gardenTips.php"><li>Gardening Tips</li></a>
                    </ul>
            </div>
        </section>
    </main>
</body>
</html>