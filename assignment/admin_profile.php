<?php
    include 'dbConn.php';

    session_start();

    $userID = $_SESSION['AdminID'];

    if(isset($_POST['btnSave'])){
        echo "User clicked save button";

        $name = $_POST['txtName'];
        $username = $_POST['txtUsername'];
        $password = $_POST['txtPassword'];
        $phone = $_POST['txtPhone'];

        $sql = "UPDATE tbluser SET    
                name = '$name', username = '$username', password = '$password', phone = '$phone'
                WHERE userID = '$userID'";

        $result = mysqli_query($conn, $sql);

        if($result){
            echo "Updated successfully!";
        }else{
            echo "Error: ".$sql."<br>".mysqli_error($conn);
        }
    }else{
        echo "User didn't click save button";
    }
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Admin</title>

    <link rel="stylesheet" href="styles/profile.css">
    <link rel="stylesheet" href="styles/global.css">

    <script src="https://kit.fontawesome.com/b70fe5a297.js" crossorigin="anonymous"></script>
</head>
<body>

    <?php include 'admin_header.php'?>

    <div id="side">
        <?php include 'admin_sideMenu.php'?>
    </div>

    <div id="title">
        <p>Admin Profile</p>
    </div>

    <div id="user">
        <div class="container">
            <i class="fa-solid fa-user profile"></i>

            <div id="name">
                <form action="admin_profile.php" method="POST">
                <table>
                    <tr>
                        <td><i class="fa-solid fa-user-tie  icon"></i></td>
                        <td><input type="text" name="txtAdminID" placeholder="Admin ID"></td>
                    </tr>

                    <tr>
                        <td><i class="fa-solid fa-id-card-clip icon"></i></td>
                        <td><input type="text" name="txtName" placeholder="Name"></td>
                    </tr>

                    <tr>
                        <td><i class="fa-solid fa-id-badge icon"></i></td>
                        <td><input type="text" name="txtUsername" placeholder="Username"></td>
                    </tr>
                </table>
                <!-- </form> -->
            </div>
        </div>
    </div>

    <div id="info">
        <!-- <form action="admin_profile.php" method="POST"> -->
        <table>
            <tr>
                <td>Password: </td>
                <td><input type="text" name="txtPassword" ></td>
            </tr>

            <tr>
                <td>Email: </td>
                <td>admin@gmail.com</td>
            </tr>

            <tr>
                <td>Phone No: </td>
                <td><input type="tel" name="txtPhone" placeholder="+60 123456789"></td>
            </tr>

            <tr>
                <td>City: </td>
                <td>Kuala Lumpur</td>
            </tr>

            <tr>
                <td>Role: </td>
                <td>Admin</td>
            </tr>
        </table>
    </div>

    <div id="button">
        <input type="submit" value="Save" name="btnSave" class="btnSave">
    </div>
    </form>
</body>
</html>