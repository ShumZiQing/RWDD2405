<?php
    include "dbConnect.php";

    session_start();

    if(isset($_POST['btnSave'])){
        $name = $_POST['txtName'];
        $email = $_POST['txtEmail'];
        $phoneNo = $_POST['txtPhoneNo'];
        $orgType = $_POST['selCollab'];

        $sql = "INSERT INTO tblcollaborator(name, email, phoneNum, orgType) VALUES('$name', '$email', '$phoneNo', '$orgType')";

        if(mysqli_query($conn, $sql)){
            //redirect with html instead

           echo'<script>
                alert("New Collaborator added!");
                window.location.href="admin_addCollab.php";
            </script>';

            exit();
        }else{
            echo "Error: ".$sql ."<br>" .mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Collaborator | Admin</title>
    <link rel="stylesheet" href="styles/admin_collab.css">
    <link rel="stylesheet" href="styles/global.css">
    <script src="https://kit.fontawesome.com/8d434a5b7f.js" crossorigin="anonymous"></script>

    <style>
        #indiForm, #indiSel{
            font-style: normal;
        }

        #indiSel{
            color: black;
        }
    </style>
</head>

<body>
    <?php include "admin_header.php" ?>
    
    <div id="side">
            <?php include "admin_sideMenu.php"?> 
    </div> 

    <div id="content">
        <a href="admin_collab.php"><i class="fa-solid fa-arrow-left fa-lg returnArrow"></i></a>
        <h1>Add Collaborator</h1>

        <div id="uploadProfile">
            <img src="images/upload-user.png" alt="upload-user" id="user">
            <i class="fa-solid fa-arrow-up-from-bracket upload"></i>
        </div>

        <form action="#" method="post">
        <div class="form">
            <div id="circle"><i class="fa-solid fa-heading fa-lg name"></i></div>
                <input type="text" name="txtName" placeholder="Name" id="indiForm" required>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-envelope fa-lg email"></i></div>
                <input type="email" name="txtEmail" placeholder="E-mail" id="indiForm" required>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-phone fa-lg phone"></i></div>
                <input type="text" name="txtPhoneNo" placeholder="Phone Number" id="indiForm" required>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-list fa-lg selection"></i></div>
                <select name="selCollab" id="indiSel" required>
                    <option value="INS">Internal</option>
                    <option value="EXT">External</option>
                    <option value="NGO">Non-Governmental Organization</option>
                    <option value="GO">Government Organization</option>
                </select>
        </div>

        <input type="submit" value="Save" name="btnSave" id="save">

        </form>
    </div>
</body>
</html>