<?php
    //to check error
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

    include 'dbConn.php';

    session_start();

    if (isset($_GET['prjID'])) {
        $prjID = $_GET['prjID'];
    } else {
        echo "<script>
        alert('No project selected.');
        window.location.href='admin_activities.php';
        </script>";
        exit;
    }

    $sql = "SELECT * FROM tblprojects WHERE prjID = '$prjID'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_assoc($result);
        $prjName = $row['prjName'];
        $startDate = $row['startDate'];
        $endDate = $row['endDate'];
        $startTime = $row['startTime'];
        $endTime = $row['endTime'];
        $prjDetails = $row['prjDetails'];
        $location = $row['location'];
        $collaborator = $row['collaborator'];
        $collabEmail = $row['collabEmail'];
        $status = $row['status'];
    } else {
        echo "<script>
        alert('Project not found!');
        window.location.href='admin_activities.php';
        </script>";
        exit;
    }

    if(isset($_POST['btnSave'])){

        $prjName = $_POST['txtTitle'];
        $startDate = $_POST['txtSdate'];
        $endDate = $_POST['txtEdate'];
        $startTime = $_POST['txtStime'];
        $endTime = $_POST['txtEtime'];
        $prjDetails = $_POST['txtDetails'];
        $location = $_POST['txtLocation'];
        $collaborator = $_POST['txtOrganizer'];
        $collabEmail = $_POST['txtEmail'];
        $status = $_POST['txtStatus'];

        $update = "UPDATE tblprojects SET
                prjName = '$prjName', startDate = '$startDate', endDate = '$endDate', startTime = '$startTime', endTime = '$endTime', prjDetails = '$prjDetails', location = '$location', collaborator = '$collaborator',collabEmail = '$collabEmail',  status = '$status'
                WHERE prjID = '$prjID'";

        $result = mysqli_query($conn, $update);

            if($result){
                echo "<script>
                alert ('Project updated successfully!');
                window.location.href='admin_activities.php';
                </script>";
            }else{
                echo "Error: ". mysqli_error($conn);
            }
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project | Admin</title>

    <link rel="stylesheet" href="styles/editPrj.css">
    <link rel="stylesheet" href="styles/global.css">

    <script src="https://kit.fontawesome.com/b70fe5a297.js" crossorigin="anonymous"></script>
</head>
<body>

    <?php include 'admin_header.php'?>

    <div id="side">
        <?php include 'admin_sideMenu.php'?>
    </div>

    <div id="nav">
        <a href="admin_activities.php">
            <i class="fa-solid fa-arrow-left navIcon"></i>
        </a>
        <p>Edit Project</p>
    </div>

    <div id="content">
        <form action="admin_editPrj.php?prjID=<?php echo $prjID; ?>" method="POST">
        <table>
                <tr>
                    <td><i class="fa-solid fa-image icon"></i></td>
                    <td>
                        <?php if (!empty($prjImg)): ?>
                            <img src="images/<?php echo $prjImg; ?>" style="max-width: 300px; max-height: 300px">
                        <?php endif; ?>
                        <input type="file" name="prjImg" accept="image/*" class="upload">
                    </td>
                </tr>    

            <tr>
                <td><i class="fa-solid fa-heading icon"></i></td>
                <td><input type="text" name="txtTitle" class="title" value="<?php echo $prjName; ?>" required></td>
            </tr>

            <tr>
                <td><i class="fa-solid fa-calendar icon"></i></td>
                <td>
                    <input type="date" name="txtSdate" value="<?php echo $startDate; ?>" required class="date"> 
                to 
                    <input type="date" name="txtEdate" value="<?php echo $endDate; ?>" required class="date">
                </td>
            </tr>

            <tr>
                <td><i class="fa-solid fa-clock icon"></i></td>
                <td>
                    <input type="time" name="txtStime" value="<?php echo $startTime; ?>" required class="time"> 
                to 
                    <input type="time" name="txtEtime" value="<?php echo $endTime; ?>" required class="time">
            </td>
            </tr>

            <tr>
                <td><i class="fa-solid fa-circle-info icon"></i></td>
                <td><textarea name="txtDetails"  rows="20" cols="120" required class="prjDtl"><?php echo $prjDetails; ?></textarea></td>
            </tr>

            <tr>
                <td><i class="fa-solid fa-location-dot icon"></i></td>
                <td><select name="txtLocation"  class="info" required>
                    <option value="location1" <?php if($location=='Taman Merah') echo 'selected'; ?>>Taman Merah</option>
                    <option value="location2" <?php if($locaiton=='Taman Siakap') echo 'selected'; ?>>Taman Siakap</option>
                    <option value="location3" <?php if($locaiton=='Taman Cempaka') echo 'selected'; ?>>Taman Cempaka></option>
                    <option value="location4" <?php if($locaiton=='Taman Anggerik') echo 'selected'; ?>>Taman Anggerik</option>
                    <option value="location5" <?php if($locaiton=='Taman Seri Mutiara') echo 'selected'; ?>>Taman Seri Mutiara</option>
                </select></td>
            </tr>

            <tr>
                <td><i class="fa-solid fa-user icon"></i></td>
                <td><select name="txtOrganizer"  class="info" required>
                    <option value="ORG1" <?php if($collaborator=='Urban Bloom Association') echo 'selected'; ?>>Urban Bloom Association</option>
                    <option value="ORG2" <?php if($collaborator=='NatureNurture Club') echo 'selected'; ?>>NatureNurture Club</option>
                    <option value="ORG3" <?php if($collaborator=='Greenpeace') echo 'selected'; ?>>Greenpeace</option>
                </select></td>
            </tr>

            <tr>
                <td><i class="fa-solid fa-envelope icon"></i></td>
                <td><input type="text" name="txtEmail" value="<?php echo $collabEmail; ?>" class="info" required></td>
            </tr>

            <tr>
                <td><i class="fa-solid fa-circle-check icon"></i></td>
                <td><select name="txtStatus" class="info" required>
                        <option value="pending" <?php if($status=='Pending') echo 'selected'; ?>>Pending</option>
                        <option value="inProgress" <?php if($status=='InProgress') echo 'selected'; ?>>In Progress</option>
                        <option value="finished" <?php if($status=='Finished') echo 'selected'; ?>>Finished</option>
                        <option value="onHold" <?php if($status=='OnHold') echo 'selected'; ?>>On Hold</option>
                </select>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="button">
        <a href="deletePrj.php?prjID=<?php echo $prjID; ?>" onclick="return confirm('Are you sure you want to delete this project?')">
            <input type="button" value="Delete" class="delete">
        </a>
        <input type="submit" value="Save" name="btnSave" class="save">
    </div>
    </form>
    
</body>
</html>