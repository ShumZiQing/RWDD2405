<?php
    include "dbConn.php";

    session_start();

    if(isset($_POST['btnSave'])){
       $name = $_POST['txtName'];
       $startDate = $_POST['txtStartDate'];
       $endDate = $_POST['txtEndDate'];
       $startTime = $_POST['txtStartTime'];
       $endTime = $_POST['txtEndTime'];
       $desc = $_POST['txtProgDetails'];
       $recyclables = isset($_POST['selRecyclable']) ? implode(',', $_POST['selRecyclable']) : '';
       $location = isset($_POST['selNeighbourhood']) ? implode(',', $_POST['selNeighbourhood']) : '';
       $freq = $_POST['selFrequency'];
       $collab = $_POST['selCollab'];

       //handle img upload
        $target_dir = "images/";
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

       $sql = "INSERT INTO tblprograms(progName, startDate, endDate, startTime, endTime, progDetails, recyclablesType, location, frequency, collabName, progImage)
        VALUES ('$name', '$startDate', '$endDate', '$startTime', '$endTime', '$desc', '$recyclables', '$location', '$freq', '$collab', '$imgName')";

        if(mysqli_query($conn, $sql)){
            //redirect with html instead

           echo'<script>
                alert("New Program added!");
                window.location.href="admin_addProg.php";
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
    <title>Add Program | Admin</title>
    <link rel="stylesheet" href="styles/admin_prog.css">
    <link rel="stylesheet" href="styles/global.css">
    <script src="https://kit.fontawesome.com/8d434a5b7f.js" crossorigin="anonymous"></script>

    <style>
        #indiForm, #indiTxtArea, #indiSmallForm, #indiSel, #multiSel{
            font-style: normal;
        }

        #save{
            margin-left: 80%;
        }

        @media(min-width: 601px) and (max-width: 1024px){
            #save{
                margin-left: 50vh;
            }
        }
    </style>
</head>
<body>
    <div id="header"><?php include "admin_header.php"?></div>

    <div id="side">
        <?php include "admin_sideMenu.php"?>
    </div>

    <div id="content">
        <a href="admin_activities.php"><i class="fa-solid fa-arrow-left fa-lg returnArrow"></i></a>
        <h1>Add Program</h1>

    <div id="box">
        <div id="uploadProfile">
            <form action="" method="post" enctype="multipart/form-data">
                <img src="images/image(6).png" alt="upload-user" id="user">
                <i class="fa-solid fa-arrow-up-from-bracket upload" id="uploadIcon"></i>
                <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
        </div>

        <div class="forms">
            <div id="circle"><i class="fa-solid fa-heading fa-lg nameIcon"></i></div>
            <input type="text" name = "txtName" id="indiForm" required placeholder = "Program Title">
        </div>

        <div class="forms">
            <div id="circle"><i class="fa-solid fa-calendar fa-lg dateIcon"></i></div>
                <input type="date" name="txtStartDate" id="indiSmallForm" required>
                <p>to</p>
                <input type="date" name="txtEndDate" id="indiSmallForm" required>
        </div>

        <div class="forms">
            <div id="circle"><i class="fa-solid fa-clock fa-lg timeIcon"></i></div>
                <input type="time" name="txtStartTime" id="indiSmallForm" required>
                <p>to</p>
                <input type="time" name="txtEndTime" id="indiSmallForm" required>
        </div>

        <div class="forms">
            <div id="circle"><i class="fa-solid fa-pen fa-lg descIcon"></i></div>
                <textarea name="txtProgDetails" id="indiTxtArea" placeholder="Program Details" required></textarea>
        </div>

        <div class="forms">
            <div id="circle"><i class="fa-solid fa-list fa-lg selection"></i></div>
                <select name="selRecyclable[]" id="multiSel" required multiple>
                    <option value="plastic">Plastic</option>
                    <option value="metal">Metal</option>
                    <option value="paper">Paper</option>
                    <option value="glass">Glass</option>
                </select>
        </div>

        <div class="forms">
            <div id="circle"><i class="fa-solid fa-location-dot fa-lg locationIcon"></i></div>
                <select name="selNeighbourhood[]" id="multiSel" required multiple>
                    <option value="ESP">Taman Esplanad</option>
                    <option value="LTAT">Taman LTAT</option>
                    <option value="PUJ">Taman Puncak Jalil</option>
                    <option value="YAR">Taman Yarl</option>
                    <option value="EQP">Taman Equine Park</option>
                </select>
        </div>

        <div class="forms">
            <div id="circle"><i class="fa-solid fa-repeat fa-lg freqIcon"></i></div>
                <select name="selFrequency" id="indiSel" required>
                    <option value="Daily">Daily</option>
                    <option value="Weekly">Weekly</option>
                    <option value="Monthly">Monthly</option>
                </select>
        </div>

        <!--get value frm collab-->
        <div class="forms">
            <div id="circle"><i class="fa-solid fa-users fa-lg collabIcon"></i></div>
                <select name="selCollab" id="indiSel" required>
                    <?php
                        $sql = "SELECT * FROM tblcollaborator";
                        $result = mysqli_query($conn, $sql);

                        while($row = mysqli_fetch_assoc($result)){
                            $name = $row['name'];?>

                            <option value="<?php echo $name?>"><?php echo $name?></option>
                        <?php
                        }
                    ?>
                    
                </select>
        </div>

        <input type="submit" name="btnSave" value="Save" id="save">
        </form>
    </div>
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