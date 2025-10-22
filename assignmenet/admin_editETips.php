<?php
    include 'dbConnect.php';
    session_start();

    $eTipID = $_GET['eTipID'];

    //get frm client side
    if(isset($_POST['btnSave'])){
        $name = $_POST['txtGName'];
        $content = $_POST['txtContent'];
        $type = $_POST['txtType'];

        //handle img upload
        $target_dir = "images/energyTips/";
        $defaultImg = "images/image(6).png";
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
        
        $sql = "UPDATE energytips
        SET eTipName = '$name', eTipContent = '$content', eTipType = '$type', eTipImage = '$imgName'
        WHERE eTipID = $eTipID";

        if(mysqli_query($conn, $sql)){
            echo"<script> 
                alert('Energy Tip edited successfully!');
                window.location.href='admin_energyTips.php';
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
    <title>Edit Energy Tip | Admin</title>
    <link rel="stylesheet" href="styles/admin_editBus.css">
    <link rel="stylesheet" href="styles/global.css">
    <script src="https://kit.fontawesome.com/8d434a5b7f.js" crossorigin="anonymous"></script>

    <style>

    </style>

</head>
<body>
    <?php include "admin_header.php"?>

    <div id="side">
        <?php include "admin_sideMenu.php"?>
    </div>

    <div id="content">
        <a href="admin_energyTips.php"><i class="fa-solid fa-arrow-left fa-lg returnArrow"></i></a>
        <h1>Edit Energy Tips</h1>

        <?php
            $sql = "SELECT * FROM energytips WHERE eTipID = '".$_GET['eTipID']."'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $name = $row['eTipName'];
            $content = $row['eTipContent'];
            $type = $row['eTipType'];
            $user = $row['userID'];
            $img = $row['eTipImage'];
        ?>

        <div id="uploadPic">
            <form action="" method="post" enctype="multipart/form-data">
            <img src= <?php echo $img ?> alt="upload-user" id="user">
            <i class="fa-solid fa-arrow-up-from-bracket upld" id="uploadIcon"></i>
            <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-heading fa-lg name"></i></div>
                <input type="text" name="txtGName" id="indiForm" value="<?php echo $name?>" required>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-pen fa-lg descIcon"></i></div>
                <textarea name="txtContent" id="indiTxtArea" rows="6" cols="23" required><?php echo $content?></textarea>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-list fa-lg selection"></i></div>
                <input type="text" name="txtType" id="indiForm" value="<?php echo $type?>" required>
        </div>

        <input type="submit" value="Save" id="save" name = 'btnSave'>
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