<?php 
    include 'dbConn.php';

    session_start();

    // Display all user
    $sql = "SELECT userID, username FROM tbluser WHERE role = 'user'";
    
    // Search user
    if (isset($_GET['btnSearch'])){
            $search = $_GET['txtSearch'];
            $sql = "SELECT * FROM tbluser WHERE role='user' AND username LIKE '%$search%'";
    }

    $result = mysqli_query($conn, $sql); 
?>
 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage User | Admin</title>
    
    <link rel="stylesheet" href="styles/mngUser.css">
    <link rel="stylesheet" href="styles/global.css">

    <script src="https://kit.fontawesome.com/b70fe5a297.js" crossorigin="anonymous"></script>
</head>

<body> 
    <?php include 'admin_header.php' ?>
    <div id="side"> 
        <?php include 'admin_sideMenu.php' ?> 
    </div>
    <div id="nav"> 
        <a href="admin_home.php"> 
            <i class="fa-solid fa-arrow-left navIcon"></i> 
        </a>
        <p>Manage User</p>
    </div>

    <div id="search"> 
        <form action="admin_mngUser.php" method="GET">
        <input type="text" name="txtSearch" placeholder="Search User" autocomplete="off"> 
            <button type="submit" name="btnSearch"><i class="fa-solid fa-magnifying-glass "></i></button> 
        </form>
    </div>

    <div id="user">
        <?php if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $userID = $row['userID'];
                $username = $row['username'];
                echo ' 
                <div class="container"> 
                    <i class="fa-solid fa-user profile"></i> 

                        <div class="text"> 
                            <p id="userid">' . $userID . '</p> 
                            <p id="username">' . $username . '</p> 
                        </div> 
                        
                        <div id="icon"> 
                            <a href="admin_userDetails.php?userID=' . $userID . '"> 
                                <i class="fa-solid fa-eye view"></i> 
                            </a> 
                            <a href="admin_deleteUser.php?userID=' . $userID . '" onclick="return confirm(\'Are you sure you want to delete this user?\')"> 
                                <i class="fa-solid fa-trash delete"></i> 
                            </a> 
                        </div> 
                </div>';
            }
        } else {
            echo "<p>No users found.</p>";
        } ?>
    </div>
</body>

</html>