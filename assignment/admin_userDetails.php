<?php   
    // to check error
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    
    include 'dbConn.php';

    session_start();

    if(isset($_GET['userID'])){
        $userID = $_GET['userID'];

        $sql = "SELECT * FROM tbluser WHERE userID = '$userID'";
        $result = mysqli_query($conn, $sql);

        if($result && mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);

            $userID = $row['userID'];
            $username = $row['username'];
            $phone = $row['phone'];
            $email = $row['email'];
            $city = $row['city'];
            $role = $row['role'];
        }else{
            echo "<script>
            alert ('User not found.'); window.location.href='admin_mngUser.php'; <script>";
            exit;
        }
    }else{
        echo "<script>
        alert ('No user selected'); window.location.href='admin_mngUser.php'; <script>";
        exit;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details | Admin</title>

    <link rel="stylesheet" href="styles/userDetails.css">
    <link rel="stylesheet" href="styles/global.css">

    <script src="https://kit.fontawesome.com/b70fe5a297.js" crossorigin="anonymous"></script>
</head>
<body>

    <?php include 'admin_header.php'?>

    <div id="side">
        <?php include 'admin_sideMenu.php'?>
    </div>

    <div id="nav">
        <a href="admin_mngUser.php">
            <i class="fa-solid fa-arrow-left navIcon"></i>
        </a>
        <p>User Details</p>
    </div>

    <div id="user">
        <div class="container">
            <i class="fa-solid fa-user profile"></i>

            <div class="text">
                <p><?php echo $userID; ?></p>
                <p><?php echo $username; ?></p>
            </div>
        </div>
    </div>

    <div id="info">
        <table>
            <tr>
                <td>Phone No: </td>
                <td><?php echo $phone; ?></td>
            </tr>

            <tr>
                <td>Email: </td>
                <td><?php echo $email; ?></td>
            </tr>

            <tr>
                <td>City: </td>
                <td><?php echo $city; ?></td>
            </tr>

            <tr>
                <td>Role: </td>
                <td><?php echo $role; ?></td>
            </tr>
        </table>
    </div>

    <div id="button">
        <button class="delete" 
        onclick="if(confirm('Are you sure you want to delete this user?')) { 
            window.location.href='admin_deleteUser.php?userID=<?php echo $userID; ?>';
        }">
        Delete
    </button>
    </div>
</body> 
</html>