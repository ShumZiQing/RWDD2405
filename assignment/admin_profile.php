<?php
    include 'dbConn.php';

    session_start();

    //uncomment when not testing
    // $userID = $_SESSION['userID'];

    // for testing purposes
    $userID = 3;

    // uncomment when not testing
    // $sql = "SELECT * FROM tbluser WHERE userID = '$userID' AND role = 'admin'";

    // for testing purposes
    $sql = "SELECT * FROM tbluser WHERE userID = '$userID'";

    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);

        $name = $row['name'];
        $username = $row['username'];
        $password = $row['password'];
        $email = $row['email'];
        $phone = $row['phone'];
        $city = $row['city'];
        $role = $row['role'];
    }else{
        echo "<script>
        alert ('Admin not found');
        window.location.href='admin_login.php';
        </script>";
        exit;
        
    }

    if(isset($_POST['btnSave'])){

        $name = $_POST['txtName'];
        $username = $_POST['txtUsername'];
        $password = $_POST['txtPassword'];
        $phone = $_POST['txtPhone'];

        $update = "UPDATE tbluser SET    
                name = '$name', username = '$username', password = '$password', phone = '$phone'
                WHERE userID = '$userID' AND role='admin'";


        if(mysqli_query($conn, $update)){
            echo "<script>
            alert ('Profile updated successfully!');
            window.location.href='admin_profile.php';
            </script>";
        }
    }else{
        echo "Error: ". mysqli_error($conn);
    }

    // Admin logout
    if (isset($_POST['btnLogout'])) {
        session_unset();
        session_destroy(); 

        echo "<script>
            alert('You have been logged out successfully!');
            window.location.href='admin_login.php';
        </script>";
        exit;
    }
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Admin</title>

    <link rel="stylesheet" href="styles/admin_profile.css">
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
                        <td><?php echo $userID; ?></td>
                    </tr>

                    <tr>
                        <td><i class="fa-solid fa-id-card-clip icon"></i></td>
                        <td><input type="text" name="txtName" value="<?php echo $name; ?>" ></td>
                    </tr>

                    <tr>
                        <td><i class="fa-solid fa-id-badge icon"></i></td>
                        <td><input type="text" name="txtUsername" value="<?php echo $username; ?>" ></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div id="info">
        <form action="admin_profile.php" method="POST">
        <table>
            <tr>
                <td>Password: </td>
                <td><input type="text" name="txtPassword" value="<?php echo $password; ?>" redonly></td>
            </tr>

            <tr>
                <td>Email: </td>
                <td>admin@gmail.com</td>
            </tr>

            <tr>
                <td>Phone No: </td>
                <td><input type="tel" name="txtPhone" value="<?php echo $phone; ?>" ></td>
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
        <input type="submit" value="Save" name="btnSave" class="btnSave">
        <input type="submit" value="Logout" name="btnLogout" class="btnLogout">
    </div>
    </form>
</body>
</html>