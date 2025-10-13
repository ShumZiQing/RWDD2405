<?php
    include 'dbConnect.php';
    session_start();

    $busID = $_GET['busID'];

    //get frm client side
    if(isset($_POST['btnSave'])){
        $name = $_POST['txtBusName'];
        $busType = $_POST['txtBusType'];
        $desc = $_POST['txtBusDetails'];
        $location = $_POST['txtBusLoc'];
        $phoneNum = $_POST['txtBusPhone'];
        
        $sql = "UPDATE tblbusiness
        SET name = '$name', busType = '$busType', description = '$desc', location = '$location', phoneNum = '$phoneNum'
        WHERE busID = $busID";

        if(mysqli_query($conn, $sql)){
            echo"<script> 
                alert('Business edited successfully!');
                window.location.href='admin_business.php';
            </script>";

        }else{
            echo "Error: ".mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Business | Admin</title>
    <link rel="stylesheet" href="styles/admin_editBus.css">
    <link rel="stylesheet" href="styles/global.css">
    <script src="https://kit.fontawesome.com/8d434a5b7f.js" crossorigin="anonymous"></script>

</head>
<body>
    <?php include "admin_header.php"?>

    <div id="side">
        <?php include "admin_sideMenu.php"?>
    </div>

    <div id="content">
        <a href="admin_business.php"><i class="fa-solid fa-arrow-left fa-lg returnArrow"></i></a>
        <h1>Edit Business</h1>

        <?php
            $sql = "SELECT * FROM tblbusiness WHERE busID = '".$_GET['busID']."'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $name = $row['name'];
            $busType = $row['busType'];
            $desc = $row['description'];
            $location = $row['location'];
            $phoneNum = $row['phoneNum'];
        ?>

        <div id="uploadPic">
            <i class="fa-solid fa-angle-left fa-xl LArrow"></i>
            <img src="images/image (6).png" alt="image" id="pic">
            <i class="fa-solid fa-angle-right fa-xl RArrow"></i>
            <i class="fa-solid fa-trash fa-lg dlt"></i>
            <i class="fa-solid fa-arrow-up-from-bracket fa-lg upld"></i>

            <!-- add pic number when link to db -->
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-heading fa-lg name"></i></div>
            <form action="#" method="post">
                <input type="text" name="txtBusName" id="indiForm" value="<?php echo $name?>" required>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-list fa-lg selection"></i></div>
                <input type="text" name="txtBusType" id="indiForm" value="<?php echo $busType?>" required>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-pen fa-lg descIcon"></i></div>
                <textarea name="txtBusDetails" id="indiTxtArea" rows="6" cols="23" required><?php echo $desc?></textarea>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-location-dot fa-lg locationIcon"></i></div>
                <input type="text" name="txtBusLoc" id="indiForm" value="<?php echo $location?>" required>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-phone fa-lg phone"></i></div>
                <input type="text" name="txtBusPhone" id="indiForm" value="<?php echo $phoneNum?>" required>
        </div>

        <input type="submit" value="Save" id="save" name = 'btnSave'>
        </form>
    </div>
</body>
</html>