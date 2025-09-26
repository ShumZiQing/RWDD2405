<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/admin_sideMenu.css">
    <link rel="stylesheet" href="styles/global.css">
</head>

<body>
    <div class="vmenu">
        <div class="selection-box">
            <img src="images/user-icon.png" alt="icon" class="icons">
            <a href="#">Manage Users</a>
        </div>
        
        <div id="nav-collab" class="selection-dropdown">
            <img src="images/collab.png" alt="icon" class="icons" >
                Collaborators
                <img src="images/down-arrow.png" alt="icon" class="arrow" id="collabArrow">
                <ul>
                    <li>Add Collaborator</li>
                    <li>View Collaborator</li>
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
                            <li>Add Project</li>
                            <li>Add Program</li>
                        </ul>
                    </li>
                    <li>View activities</li>
                </ul>
        </div>
        
        <div class="selection-box">
            <img src="images/edit.png" alt="icon" class="icons">
            <a href="#">Edit About Us</a>
        </div>
        <div class="selection-box">
            <img src="images/briefcase (1).png" alt="icon" class="icons">
            <a href="#">All Businesses</a>
        </div>
    </div>
</body>
</html>