<?php
include 'dbConn.php';

session_start();

if (isset($_POST['btnSave'])) {
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

    $sql = "INSERT INTO tblprojects (prjName, startDate, endDate, startTime, endTime, prjDetails, location, collaborator, collabEmail, status)
                VALUES ('$prjName', '$startDate', '$endDate', '$startTime', '$endTime', '$prjDetails', '$location', '$collaborator', '$collabEmail', '$status')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
        alert('Project added successfully!');
        window.location.href = 'admin_activities.php';
        </script>";
    } else {
        echo "<script>
        alert('Error: " . mysqli_error($conn) . "');
        window.history.back();
        </script>";
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project | Admin</title>

    <link rel="stylesheet" href="styles/addPrj.css">
    <link rel="stylesheet" href="styles/global.css">

    <script src="https://kit.fontawesome.com/b70fe5a297.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php include 'admin_header.php' ?>

    <div id="side">
        <?php include 'admin_sideMenu.php' ?>
    </div>

    <div id="nav">
        <a href="admin_activities.php">
            <i class="fa-solid fa-arrow-left navIcon"></i>
        </a>
        <p>Add Project</p>
    </div>

    <div id="content">
        <form action="admin_addPrj.php" method="POST">
            <table>
                <tr>
                    <td><i class="fa-solid fa-image icon"></i></td>
                    <td>
                        <?php if (!empty($prjImg)): ?>
                            <img src="images/<?php echo $prjImg; ?>" style="max-width: 300px; max-height: 300px">
                        <?php endif; ?>
                        <input type="file" name="prjImg" accept="image/*" class="upload">
                    </td>
                <tr>

                <tr>
                    <td><i class="fa-solid fa-heading icon"></i></td>
                    <td><input type="text" name="txtTitle" class="title" placeholder="Project Title" required></td>
                </tr>

                <tr>
                    <td><i class="fa-solid fa-calendar icon"></i></td>
                    <td><input type="date" name="txtSdate" required class="date"> to <input type="date" name="txtEdate"
                            required class="date"></td>
                </tr>

                <tr>
                    <td><i class="fa-solid fa-clock icon"></i></td>
                    <td><input type="time" name="txtStime" required class="time"> to <input type="time" name="txtEtime"
                            required class="time"></td>
                </tr>

                <tr>
                    <td><i class="fa-solid fa-circle-info icon"></i></td>
                    <td><textarea name="txtDetails" rows="20" cols="120" placeholder="Project Details" required
                            class="prjDtl"></textarea></td>
                </tr>

                <tr>
                    <td><i class="fa-solid fa-location-dot icon"></i></td>
                    <td><select name="txtLocation" class="info" required>
                            <option value="location1">Taman Merah</option>
                            <option value="location2">Taman Siakap</option>
                            <option value="location3">Taman Cempaka</option>
                            <option value="location4">Taman Anggerik</option>
                            <option value="location5">Taman Seri Mutiara</option>
                        </select></td>
                </tr>

                <tr>
                    <td><i class="fa-solid fa-user icon"></i></td>
                    <td><select name="txtOrganizer" class="info" required>
                            <option value="ORG1">Urban Bloom Association</option>
                            <option value="ORG2">NatureNurture Club</option>
                            <option value="ORG3">Greenpeace</option>
                        </select></td>
                </tr>

                <tr>
                    <td><i class="fa-solid fa-envelope icon"></i></td>
                    <td><input type="text" name="txtEmail" class="mail" placeholder="org@gmail.com" required></td>
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

    <div id="button">
        <input type="submit" value="Save" name="btnSave" class="save">
    </div>
    </form>
</body>

</html>