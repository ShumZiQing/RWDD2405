<?php
    include 'dbConn.php';

    session_start();

    $prjID = $_SESSION['prjID'];

    if(isset($_POST['btnSave'])){
        echo "User clicked the save button";

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

        $sql = "UPDATE tblprojects SET
                prjName = '$prjName', startDate = '$startDate', endDate = '$endDate', startTime = '$startTime', endTime = '$endTime', prjDetails = '$prjDetails', location = '$location', collaborator = '$collaborator',collabEmail = '$collabEmail',  status = '$status'
                WHERE prjID = '$prjID'";

        $result = mysqli_query($conn, $sql);

            if($result){
                echo "Project edited successfully!";
            }else{
                echo "Error: ".$sql."<br>".mysqli_error($conn);
            }
        // }else{
        //     echo "User didn't click save button";

    }else if(isset($_POST['btnDelete'])){
        $prjID = $_POST['prjID'];
        echo "Project deleted successfully!";
    }
    // }else{
    //     echo "No button is clicked";
    // }
    
    
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
        <form action="admin_editPrj.php" method="POST">
        <table>
            <tr>
                <td><i class="fa-solid fa-heading icon"></i></td>
                <td><input type="text" name="txtTitle" class="title" placeholder="Project Title" required></td>
            </tr>

            <tr>
                <td><i class="fa-solid fa-calendar icon"></i></td>
                <td><input type="date" name="txtSdate" required class="date"> to <input type="date" name="txEdate" required class="date"></td>
            </tr>

            <tr>
                <td><i class="fa-solid fa-clock icon"></i></td>
                <td><input type="time" name="txtStime" required class="time"> to <input type="time" name="txEtime" required class="time"></td>
            </tr>

            <tr>
                <td><i class="fa-solid fa-circle-info icon"></i></td>
                <td><textarea name="txtDetails"  rows="20" cols="120" placeholder="Project Details" required class="prjDtl"></textarea></td>
            </tr>

            <tr>
                <td><i class="fa-solid fa-location-dot icon"></i></td>
                <td><select name="txtLocation"  class="info" required>
                    <option value="location1">Location 1</option>
                    <option value="location2">Location 2</option>
                    <option value="location3">Location 3</option>
                    <option value="location4">Location 4</option>
                    <option value="location5">Location 5</option>
                </select></td>
            </tr>

            <tr>
                <td><i class="fa-solid fa-user icon"></i></td>
                <td><select name="txtOrganizer"  class="info" required>
                    <option value="ORG1">ORG 1</option>
                    <option value="ORG2">ORG 2</option>
                    <option value="ORG3">ORG 3</option>
                </select></td>
            </tr>

            <tr>
                <td><i class="fa-solid fa-envelope icon"></i></td>
                <td><input type="text" name="txtEmail"  class="info" placeholder="org@gmail.com" required></td>
            </tr>

            <tr>
                <td><i class="fa-solid fa-circle-check icon"></i></td>
                <td><select name="txtStatus" class="info" required>
                        <option value="pending">Pending</option>
                        <option value="inProgress">In Progress</option>
                        <option value="finished">Finished</option>
                        <option value="onHold">On Hold</option>
                </select>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="button">
        <input type="submit" value="Delete" name="btnDelete" class="delete">
        <input type="submit" value="Save" name="btnSave" class="save">
    </div>
    </form>
    
</body>
</html>