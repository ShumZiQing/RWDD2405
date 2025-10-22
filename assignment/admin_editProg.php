<?php
    include 'dbConn.php';

    $progID = $_GET['progID'];
    $sql = "SELECT * FROM tblprogram WHERE progID = '".$_GET['progID']."'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $name = $row['progName'];
    $startDate = $row['startDate'];
    $endDate = $row['endDate'];
    $startTime = $row['startTime'];
    $endTime = $row['endTime'];
    $desc = $row['progDetails'];
    $recyclables = $row['recyclablesType'];
    $location = $row['location'];
    $freq = $row['frequency'];
    $collabName = $row['collaborators'];

    $recyclablesArr = explode(',', $recyclables);
    $locationArr = explode(',', $location);

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
        $collabName = $_POST['selCollab'];

        $sql="UPDATE tblprogram 
        SET progName = '$name', startDate = '$startDate', endDate = '$endDate', startTime = '$startTime', endTime = '$endTime', progDetails = '$desc', 
        recyclablesType = '$recyclables', location = '$location', frequency = '$freq', collaborators = '$collabName'
        WHERE progID = '".$_GET['progID']."'";

        if(mysqli_query($conn, $sql)){
            echo'<script>
                alert("Program edited successfully!");
                window.location.href="admin_activities.php";
            </script>';

            exit();
        }else{
            echo"<br>Error: ".$sql ."<br>" .mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Program | Admin</title>
    <link rel="stylesheet" href="styles/admin_prog.css">
    <link rel="stylesheet" href="styles/global.css">
    <script src="https://kit.fontawesome.com/8d434a5b7f.js" crossorigin="anonymous"></script>

    <style>
        #bottomFeature{
            width: 650px;
        }
    </style>
    
</head>
<body>
    <?php include "admin_header.php"?>

    <div id="side">
        <?php include "admin_sideMenu.php"?>
    </div>

    <div id="content">
        <a href="admin_activities.php"><i class="fa-solid fa-arrow-left fa-lg returnArrow"></i></a>
        <h1>Edit Program</h1>

    <form action="#" method="post">
    <div id="box">
        <div class="forms">
            <div id="circle"><i class="fa-solid fa-heading fa-lg nameIcon"></i></div>
            <input type="text" name = "txtName" id="indiForm" required value = "<?php echo $name;   ?>">
        </div>

        <div class="forms">
            <div id="circle"><i class="fa-solid fa-calendar fa-lg dateIcon"></i></div>
                <input type="date" name="txtStartDate" id="indiSmallForm" value = "<?php echo $startDate?>" required>
                <p>to</p>
                <input type="date" name="txtEndDate" id="indiSmallForm" value = "<?php echo $endDate?>" required>
        </div>

        <div class="forms">
            <div id="circle"><i class="fa-solid fa-clock fa-lg timeIcon"></i></div>
                <input type="time" name="txtStartTime" id="indiSmallForm" value = "<?php echo $startTime?>" required>
                <p>to</p>
                <input type="time" name="txtEndTime" id="indiSmallForm" value = "<?php echo $endTime?>" required>
        </div>

        <div class="forms">
            <div id="circle"><i class="fa-solid fa-pen fa-lg descIcon"></i></div>
                <textarea name="txtProgDetails" id="indiTxtArea"><?php echo $desc?></textarea>
        </div>

        <div class="forms">
            <div id="circle"><i class="fa-solid fa-list fa-lg selection"></i></div>
                <select name="selRecyclable[]" id="indiSel" multiple required>
                    <option value="PLT" <?php if(in_array('PLT', $recyclablesArr)) echo 'selected';?>>Plastic</option>
                    <option value="MTL" <?php if(in_array('MTL', $recyclablesArr)) echo 'selected';?>>Metal</option>
                    <option value="PPR" <?php if(in_array('PPR', $recyclablesArr)) echo 'selected';?>>Paper</option>
                    <option value="GLS" <?php if(in_array('GLS', $recyclablesArr)) echo 'selected';?>>Glass</option>
                </select>
        </div>

        <div class="forms">
            <div id="circle"><i class="fa-solid fa-location-dot fa-lg locationIcon"></i></div>
                <select name="selNeighbourhood[]" id="indiSel" multiple required>
                    <option value="ESP" <?php if(in_array('ESP', $locationArr)) echo 'selected';?>>Taman Esplanad</option>
                    <option value="LTAT" <?php if(in_array('LTAT', $locationArr)) echo 'selected';?>>Taman LTAT</option>
                    <option value="PUJ" <?php if(in_array('PUJ', $locationArr)) echo 'selected';?>>Taman Puncak Jalil</option>
                    <option value="YAR" <?php if(in_array('YAR', $locationArr)) echo 'selected';?>>Taman Yarl</option>
                    <option value="EQP" <?php if(in_array('EQP', $locationArr)) echo 'selected';?>>Taman Equine Park</option>
                </select>
        </div>

        <div class="forms">
            <div id="circle"><i class="fa-solid fa-repeat fa-lg freqIcon"></i></div>
                <select name="selFrequency" id="indiSel" required>
                    <option value="Daily" <?php if($freq == "Daily") echo "selected";?>>Daily</option>
                    <option value="Weekly" <?php if($freq == "Weekly") echo "selected";?>>Weekly</option>
                    <option value="Monthly" <?php if($freq == "Monthly") echo "selected";?>>Monthly</option>
                </select>
        </div>

        <div class="forms">
            <div id="circle"><i class="fa-solid fa-users fa-lg collabIcon"></i></div>
                <select name="selCollab" id="indiSel" required>
                    <?php
                        $sql = "SELECT * FROM tblcollaborator";
                        $result = mysqli_query($conn, $sql);

                        while($row = mysqli_fetch_assoc($result)){
                            $name = $row['name'];
                            $selected = ($name == $collabName)? 'selected':'';
                            echo "<option value = '$name' $selected>$name</option>";
                        }
                    ?>
                </select>
        </div>
        
        <div id="bottomFeature">
        <a href="admin_deleteProg.php?progID=<?php echo $progID;?>" onclick="return confirm('Are you sure you want to delete this program?');">
            <div id="delete">
                <p>Delete</p>
            </div>
        </a>

        <input type="submit" name = "btnSave" value="Save" id="save">
        </form>
        </div>
    </div>
    </div>
</body>
</html>