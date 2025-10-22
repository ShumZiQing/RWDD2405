<?php
    include 'dbConn.php';
    session_start();

    $gTipID = $_GET['gTipID'];

    //get frm client side
    if(isset($_POST['btnSave'])){
        $name = $_POST['txtGName'];
        $datePublished = $_POST['txtDate'];
        $content = $_POST['txtContent'];

        //handle img upload
        $target_dir = "images/gardenTips/";
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
        
        $sql = "UPDATE gardentips
        SET gTipName = '$name', gTipDate = '$datePublished', gTipContent = '$content', gTipImage = '$imgName'
        WHERE gTipID = $gTipID";

        if(mysqli_query($conn, $sql)){
            echo"<script> 
                alert('Gardening Tip edited successfully!');
                window.location.href='admin_gardenTips.php';
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
    <title>Edit Gardening Tip | Admin</title>
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
        <a href="admin_gardenTips.php"><i class="fa-solid fa-arrow-left fa-lg returnArrow"></i></a>
        <h1>Edit Gardening Tips</h1>

        <?php
            $sql = "SELECT * FROM gardentips WHERE gTipID = '".$_GET['gTipID']."'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $name = $row['gTipName'];
            $datePublished = $row['gTipDate'];
            $content = $row['gTipContent'];
            $likes = $row['gTipLikes'];
            $dislikes = $row['gTipDislikes'];
            $user = $row['userID'];
            $img = $row['gTipImage'];
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
            <div id="circle"><i class="fa-solid fa-calendar fa-lg dateIcon"></i></div>
                <input type="date" name="txtDate" id="indiForm" value="<?php echo $datePublished?>" required>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-pen fa-lg descIcon"></i></div>
                <textarea name="txtContent" id="indiTxtArea" rows="6" cols="23" required><?php echo $content?></textarea>
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