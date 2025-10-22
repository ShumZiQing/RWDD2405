<?php
    include 'dbConnect.php';
    session_start();

    $collabID = $_GET['collabID'];

    if(isset($_POST['btnSave'])){
        $name = $_POST['txtName'];
        $email = $_POST['txtEmail'];
        $phoneNo = $_POST['txtPhoneNo'];
        $orgType = $_POST['selCollab'];
        $progInvolved = implode(',', $_POST['selProgram']);
        
        //handle img upload
        $target_dir = "images/collaborator/";
        $defaultImg = "images/upload-user.png";
        $imgName = $defaultImg;

        if(!empty($_FILES["fileToUpload"]["name"])){
            $fileName = basename($_FILES["fileToUpload"]["name"]);
            $target_file = $target_dir . $fileName;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $imgName = $target_file; 
                }
            }
        }

        $sql = "UPDATE tblcollaborator
        SET name = '$name', email = '$email', phoneNum = '$phoneNo', orgType = '$orgType', progInvolved = '$progInvolved', image = '$imgName'
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
            $progInvolved = $row['progInvolved'];
            $img = $row['image'];
        ?>

        <div id="uploadProfile">
            <form action="" method="post" enctype="multipart/form-data">
                <img src= <?php echo $img ?> alt="upload-user" id="user">
                <i class="fa-solid fa-arrow-up-from-bracket upload" id="uploadIcon"></i>
                <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-heading fa-lg name"></i></div>
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

        <div class="form">
            <div id="circle"><i class="fa-solid fa-tree fa-lg progIcon"></i></div>
            <select name="selProgram[]" id="multiSel" required multiple>
                <?php
                    $progSQL = "SELECT * FROM tblprogram";
                    $progResult = mysqli_query($conn, $progSQL);

                    $currentProgs = explode(',', $progInvolved);

                    while($progRow = mysqli_fetch_assoc($progResult)){
                        $progName = $progRow['progName'];
                        $selected = in_array($progName, $currentProgs) ? "selected" : "";
                        echo "<option value = '$progName' $selected>$progName</option>";
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