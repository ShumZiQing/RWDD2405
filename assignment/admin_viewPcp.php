<?php

    //check error
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

    include 'dbConn.php';

    session_start();

    if (isset($_GET['prjID'])) {
        $prjID = mysqli_real_escape_string($conn, $_GET['prjID']);

        $sql = "SELECT u.userID, u.username
                FROM tblparticipants pp
                JOIN tbluser u ON pp.userID = u.userID
                WHERE pp.prjID = '$prjID'";

        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Error fetching participants: " . mysqli_error($conn));
        }
    }else{
        echo "<script>
        alert('No project selected.');
        window.location.href='admin_activities.php';
        </script>";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Participants | Admin</title>

    <link rel="stylesheet" href="styles/viewPcp.css">
    <link rel="stylesheet" href="styles/global.css">
    
    <script src="https://kit.fontawesome.com/b70fe5a297.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php include 'admin_header.php'; ?>

    <div id="side">
        <?php include 'admin_sideMenu.php'; ?>
    </div>

    <div id="nav">
        <a href="admin_activities.php">
            <i class="fa-solid fa-arrow-left navIcon"></i>
        </a>
        <p>View Participants</p>
    </div>

    <div id="user">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $userID = htmlspecialchars($row['userID']);
                $username = htmlspecialchars($row['username']);

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
                    <a href="admin_deletePcp.php?prjID=' . $prjID . '&userID=' . $userID . '" 
                       onclick="return confirm(\'Remove this participant from the project?\')">
                        <i class="fa-solid fa-trash delete"></i>
                    </a>
                </div>
            </div>';
            }
        } else {
            echo "<p>No participants found for this project.</p>";
        }
        ?>
    </div>

</body>

</html>