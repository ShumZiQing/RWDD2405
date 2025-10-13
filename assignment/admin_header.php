<link rel="stylesheet" href="styles/admin_header.css">

<div class="header">
    <div class="logo-container">
        <img src="images/logo.jpg" alt="EcoConnect Logo" class="logo">
        <h1 class="site-title">EcoConnect</h1> 
    </div>

    <div class="header-nav">
        <button id="profile">
            <img src="images/user.png" alt="user icon">
        </button>
        <button class="menu-toggle" id="hamburger">
            <div id="dropdown">
            ☰
                <ul>
                    <a href="#"><li>Manage Users</li></a>
                    <li>Collaborators
                        <ul>
                            <a href="admin_addCollab.php"><li>Add Collaborators</li></a>
                            <a href="admin_collab.php"><li>View Collaborators</li></a>
                        </ul>
                    </li>

                    <li>All Activities
                        <ul>
                            <li>Add Activities
                                <ul>
                                    <a href="#"><li>Add Project</li></a>
                                    <a href="admin_addProg.php"><li>Add Program</li></a>
                                </ul>
                            </li>
                            <a href="admin_activities.php"><li>View Activities</li></a>
                        </ul>
                    </li>

                    <a href="#"><li>Edit About Us</li></a>
                    <a href="admin_business.php"><li>All Businesses</li></a>
                </ul>
            </div>
        </button>
    </div>

</div>