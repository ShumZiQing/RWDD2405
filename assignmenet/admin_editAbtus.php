<?php
    include 'dbConn.php';

    session_start();

    if(isset($_POST['btnSave'])){
        echo "User clicked the save button";

        $address = $_POST['txtAddress'];
        $phone = $_POST['txtPhone'];
        $email = $_POST['txtEmail'];
        $missionDtl = $_POST['txtMission'];
        $wwdDtl = $_POST['txtWWD'];

        $sql = "UPDATE tblCompany SET
                address = '$address', phone = '$phone', email = '$email', missionDtl = '$missionDtl', wwdDtl = '$wwdDtl'";

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
    <title>Edit About Us | Admin</title>

    <link rel="stylesheet" href="styles/editAbtus.css">
    <link rel="stylesheet" href="styles/global.css">

    <script src="https://kit.fontawesome.com/b70fe5a297.js" crossorigin="anonymous"></script>
</head>
<body>

    <?php include 'admin_header.php'?>

    <div id="side">
        <?php include 'admin_sideMenu.php'?>
    </div> 
    
    <div id="title">
        <p>Edit About Us</p>
    </div>

    <div id="contact">
        <form action="admin_editAbtus.php" method="POST">
        <table>
            <tr>
                <td><i class="fa-solid fa-location-dot icon"></i></td>
                <td><input type="text" name="txtAddress" placeholder="Address"></td>
            </tr>

            <tr>
                <td><i class="fa-solid fa-mobile-screen-button icon"></i></td>
                <td><input type="tel" name="txtPhone" placeholder="phone no."></td>
            </tr>

            <tr>
                <td><i class="fa-solid fa-envelope icon"></i></td>
                <td><input type="email" name="txtEmail" placeholder="email"></td>
            </tr>

            
        </table>
        <!-- </form> -->
    </div>

    <div id="info">
        <!-- <form action="admin_editAbtus.php" method="POST"> -->
        <table>
            <tr>
                <td class="section">Our Mission: </td>
                <td><textarea name="txtMission" placeholder="Detials" rows="10" cols="100"></textarea></td>
            </tr>

            <tr>
                <td class="section">What We Do: </td>
                <td><textarea name="txtWWD" placeholder="Detials" rows="10" cols="100"></textarea></td>
            </tr>
        </table>
    </div>


    <div class="button">
        <input type="submit" value="Save" name="btnSave" class="save">
    </div> 
    </form>
</body>
</html>