<?php
    include 'dbConn.php';
    session_start();

    if (isset($_GET['busID'])) {
        $busID = $_GET['busID'];
    } else {
        echo "<script>
        alert('No business selected.');
        window.location.href='admin_business.php';
        </script>";
        exit;
    }

     $sql = "SELECT * FROM tblbusiness WHERE busID = '".$_GET['busID']."'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $name = $row['name'];
            $busType = $row['busType'];
            $desc = $row['description'];
            $location = $row['location'];
            $phoneNum = $row['phoneNum'];

    $target_dir = "busImages/";

    //get frm client side
    if(isset($_POST['btnSave'])){
        $name = $_POST['txtBusName'];
        $busType = $_POST['txtBusType'];
        $desc = $_POST['txtBusDetails'];
        $location = $_POST['txtBusLoc'];
        $phoneNum = $_POST['txtBusPhone'];
        
        //handle img upload
        $defaultImg = "image(6).png"; 
        $imgName = $row['busImg']; 

        if(!empty($_FILES["fileToUpload"]["name"])){
            $fileExt = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
            $allowedTypes = ['png', 'jpg', 'jpeg'];
            
            if (in_array($fileExt, $allowedTypes)) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    $uniqueName = uniqid('business_', true) . '.' . $fileExt;
                    $target_file = $target_dir . $uniqueName;
                    
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $imgName = $uniqueName; 
                    }
                }
            }
        }

        $sql = "UPDATE tblbusiness
        SET name = '$name', busType = '$busType', description = '$desc', location = '$location', phoneNum = '$phoneNum', busImg = '$imgName'
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

        <div id="uploadPic">
            <form action="" method="post" enctype="multipart/form-data">
                <?php if (!empty($row['busImg'])): ?>
                <img src="busImages/<?= htmlspecialchars($row['busImg']) ?>" alt="upload-image" id="user">
                <?php endif; ?>
                <i class="fa-solid fa-arrow-up-from-bracket upld" id="uploadIcon"></i>
                <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-heading fa-lg name"></i></div>
                <input type="text" name="txtBusName" id="indiForm" value="<?php echo $name?>" required>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-list fa-lg selection"></i></div>
            <select name="txtBusType" id="indiForm" required>
                <option value="Household Items" <?php if($busType == "Household Items") echo "selected";?>>Household Items</option>
                <option value="Health & Beauty"  <?php if($busType == "Health & Beauty") echo "selected";?>>Health & Beauty</option>
                <option value="General Items"  <?php if($busType == "General Items") echo "selected";?>>General Items</option>
                <option value="Food & Beverage"  <?php if($busType == "Food & Beverage") echo "selected";?>>Food & Beverage</option>
            </select>
        </div>

        
        <div class="form">
            <div id="circle"><i class="fa-solid fa-pen fa-lg descIcon"></i></div>
                <textarea name="txtBusDetails" id="indiTxtArea" rows="6" cols="23" required><?php echo $desc?></textarea>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-location-dot fa-lg locationIcon"></i></div>
            <select name="txtBusLoc" id="indiForm" required>
                <option value="Alor Setar" <?php if($location == "Alor Setar") echo "selected";?>>Alor Setar</option>
                <option value="George Town" <?php if($location == "George Town") echo "selected";?>>George Town</option>
                <option value="Ipoh" <?php if($location == "Ipoh") echo "selected";?>>Ipoh</option>
                <option value="Johor Bahru" <?php if($location == "Johor Bahru") echo "selected";?>>Johor Bahru</option>
                <option value="Klang" <?php if($location == "Klang") echo "selected";?>>Klang</option>
                <option value="Kota Bharu" <?php if($location == "Kota Bharu") echo "selected";?>>Kota Bharu</option>
                <option value="Kota Kinabalu" <?php if($location == "Kota Kinabalu") echo "selected";?>>Kota Kinabalu</option>
                <option value="Kuala Lumpur" <?php if($location == "Kuala Lumpur") echo "selected";?>>Kuala Lumpur</option>
                <option value="Kuala Terengganu" <?php if($location == "Kuala Terengganu") echo "selected";?>>Kuala Terengganu</option>
                <option value="Kuantan" <?php if($location == "Kuantan") echo "selected";?>>Kuantan</option>
                <option value="Kuching" <?php if($location == "Kuching") echo "selected";?>>Kuching</option>
                <option value="Labuan" <?php if($location == "Labuan") echo "selected";?>>Labuan</option>
                <option value="Malacca City" <?php if($location == "Malacca City") echo "selected";?>>Malacca City</option>
                <option value="Miri" <?php if($location == "Miri") echo "selected";?>>Miri</option>
                <option value="Petaling Jaya" <?php if($location == "Petaling Jaya") echo "selected";?>>Petaling Jaya</option>
                <option value="Putrajaya" <?php if($location == "Putrajaya") echo "selected";?>>Putrajaya</option>
                <option value="Seremban" <?php if($location == "Seremban") echo "selected";?>>Seremban</option>
                <option value="Shah Alam" <?php if($location == "Shah Alam") echo "selected";?>>Shah Alam</option>
                <option value="Subang Jaya" <?php if($location == "Subang Jaya") echo "selected";?>>Subang Jaya</option>
            </select>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-phone fa-lg phone"></i></div>
                <input type="text" name="txtBusPhone" id="indiForm" value="<?php echo $phoneNum?>" required>
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