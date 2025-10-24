<?php
    include "dbConn.php";

    session_start();

    if(isset($_POST['btnSave'])){
        $name = $_POST['txtName'];
        $email = $_POST['txtEmail'];
        $phoneNo = $_POST['txtPhoneNo'];
        $orgType = $_POST['selCollab'];
        $progInvolved = isset($_POST['selProgram']) ? implode(',', $_POST['selProgram']) : '';

        //handle img upload
        $target_dir = "collabImages/";
        $defaultImg = "upload-user.png"; 
        $imgName = $defaultImg;

        if (!empty($_FILES['fileToUpload']['name'])) {
            $uploadDir = "collabImages/";
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $fileExt = strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
            $allowedTypes = ['png', 'jpg', 'jpeg'];

            if (in_array($fileExt, $allowedTypes)) {
            $uniqueName = uniqid('garden_', true) . '.' . $fileExt;
            $targetFile = $uploadDir . $uniqueName;
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
                $imgName = $uniqueName;
            }
            }
        }

        $sql = "INSERT INTO tblcollaborator(name, email, phoneNum, orgType, progInvolved, image) VALUES('$name', '$email', '$phoneNo', '$orgType', '$progInvolved', '$imgName')";

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
        #indiForm, #indiSel, #multiSel{
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
            <form action="#" method="post" enctype="multipart/form-data">
                <img src="images/upload-user.png" alt="upload-user" id="user">
                <i class="fa-solid fa-arrow-up-from-bracket upload" id="uploadIcon"></i>
                <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
        </div>

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

        <div class="form">
            <div id="circle"><i class="fa-solid fa-tree fa-lg progIcon"></i></div>
            <select name="selProgram[]" id="multiSel" required multiple>
                <?php
                    $sql = "SELECT * FROM tblprograms";
                    $result = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($result)){
                        $name = $row['progName'];?>

                        <option value="<?php echo $name?>"><?php echo $name?></option>
                    <?php
                    }
                ?>
            </select>
        </div>

        <input type="submit" value="Save" name="btnSave" id="save">

        </form>
    </div>

    <script>
        //upload img
        document.getElementById('uploadIcon').addEventListener('click', () => {
            document.getElementById('fileToUpload').click();
        });


        //preview img
        document.getElementById('fileToUpload').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('user').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>