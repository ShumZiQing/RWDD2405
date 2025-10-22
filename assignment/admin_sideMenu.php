<link rel="stylesheet" href="styles/admin_sideMenu.css">
<div class="vmenu">
    <a href="admin_mngUser.php">
    <div class="selection-box">
        <img src="images/user-icon.png" alt="icon" class="icons">
        Manage Users
    </div>
    </a>
    
    <div id="nav-collab" class="selection-dropdown">
        <img src="images/collab.png" alt="icon" class="icons" >
            Collaborators
            <img src="images/down-arrow.png" alt="icon" class="arrow" id="collabArrow">
            <ul>
                <a href="admin_addCollab.php"><li>Add Collaborator</li></a>
                <a href="admin_collab.php"><li>View Collaborator</li></a>
            </ul>
    </div>

    <div id="nav-act", class="selection-dropdown">
        <img src="images/globe.png" alt="icon" class="icons">
        <a href="#">All activities</a>
            <img src="images/down-arrow.png" alt="icon" class="arrow" id="actArrow">
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
</div>