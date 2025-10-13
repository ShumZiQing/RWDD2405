<?php
    include 'dbConnect.php';
    session_start();

    $collabID = $_GET['collabID'];

    if(isset($_POST['btnSave'])){
        $name = $_POST['txtName'];
        $email = $_POST['txtEmail'];
        $phoneNo = $_POST['txtPhoneNo'];
        $orgType = $_POST['selCollab'];
        
        $sql = "UPDATE tblcollaborator
        SET name = '$name', email = '$email', phoneNum = '$phoneNo', orgType = '$orgType'
        WHERE collabID = $collabID";

        if(mysqli_query($conn, $sql)){
            echo"<script> 
                alert('Collaborator edited successfully!');
                window.location.href='admin_collab.php';
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
    <title>Edit Collaborator | Admin</title>
    <link rel="stylesheet" href="styles/admin_collab.css">
    <link rel="stylesheet" href="styles/global.css">
    <script src="https://kit.fontawesome.com/8d434a5b7f.js" crossorigin="anonymous"></script>

</head>

<body>
    <?php include "admin_header.php" ?>
    <div id="content">
        <div id="side">
            <?php include "admin_sideMenu.php"?> 
        </div> 
        <a href="admin_collab.php"><i class="fa-solid fa-arrow-left fa-lg returnArrow"></i></a>
        <h1>Edit Collaborator</h1>

        <?php
            $sql = "SELECT * FROM tblcollaborator WHERE collabID = '".$_GET['collabID']."'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $name = $row['name'];
            $email = $row['email'];
            $phoneNo = $row['phoneNum'];
            $orgType = $row['orgType'];
        ?>

        <div id="uploadProfile">
            <img src="images/upload-user.png" alt="upload-user" id="user">
            <i class="fa-solid fa-arrow-up-from-bracket upload"></i>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-heading fa-lg name"></i></div>
             <form action="#" method="post">
                <input type="text" name="txtName" value="<?php echo $name?>" id="indiForm" required>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-envelope fa-lg email"></i></div>
            <input type="email" name="txtEmail" value="<?php echo $email?>" id="indiForm" required>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-phone fa-lg phone"></i></div>
            <input type="text" name="txtPhoneNo" value="<?php echo $phoneNo?>" id="indiForm" required>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-list fa-lg selection"></i></div>
                <select name="selCollab" id="indiSel" required>
                    <option value="INS" <?php if($orgType == "INS") echo "selected";?>>Internal</option>
                    <option value="EXT" <?php if($orgType == "EXT") echo "selected";?>>External</option>
                    <option value="NGO" <?php if($orgType == "NGO") echo "selected";?>>Non-governmental Organization</option>
                    <option value="GO" <?php if($orgType == "GO") echo "selected";?>>Governmental Organization</option>
                </select>
        </div>

        <input type="submit" value="Save" name="btnSave" id="save">
        </form>
    </div>
</body>
</html>