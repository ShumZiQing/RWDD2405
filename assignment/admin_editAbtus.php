<?php
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

    include 'dbConn.php';
    session_start();

    $query = "SELECT * FROM tblcompany LIMIT 1";
    $res = mysqli_query($conn, $query);
    if ($res && mysqli_num_rows($res) > 0) {
        $company = mysqli_fetch_assoc($res);

        $address = $company['address'];
        $phone = $company['phone'];
        $email = $company['email'];
        $missionDtl = $company['missionDtl'];
        $wwdDtl = $company['wwdDtl'];
        $goalDtl = $company['goalDtl'];
        $companyImg = $company['companyImg'];
    } else {
        $address = $phone = $email = $missionDtl = $wwdDtl = $goalDtl = $companyImg = "";
    }

    if (isset($_POST['btnSave'])) {
        $address = $_POST['txtAddress'];
        $phone = $_POST['txtPhone'];
        $email = $_POST['txtEmail'];
        $missionDtl = $_POST['txtMission'];
        $wwdDtl = $_POST['txtWWD'];
        $goalDtl = $_POST['txtGoal'];
        $defaultImg = "images/abtUs.png";
        $companyImg = $defaultImg;

        // Upload image
        if (!empty($_FILES['companyImg']['name'])) {
            $filename = basename($_FILES['companyImg']['name']);
            $tempname = $_FILES['companyImg']['tmp_name'];
            $folder = "images/" . $filename;

            if (move_uploaded_file($tempname, $folder)) {
                $companyImg = $filename;
            } else {
                echo "<script>alert('Failed to upload image!');</script>";
            }
        }

    // Update tbl
    $sql = "UPDATE tblcompany SET
            address = '$address', phone = '$phone', email = '$email', missionDtl = '$missionDtl', wwdDtl = '$wwdDtl', goalDtl = '$goalDtl', companyImg = '$companyImg'
            WHERE companyID = 1"; 

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Updated successfully!'); window.location='admin_editAbtus.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error updating: " . mysqli_error($conn) . "');</script>";
    }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Edit About Us | Admin</title>

    <link rel="stylesheet" href="styles/editAbtus.css">
    <link rel="stylesheet" href="styles/global.css">

    <script src="https://kit.fontawesome.com/b70fe5a297.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'admin_header.php' ?>
    <div id="side"><?php include 'admin_sideMenu.php' ?></div>

    <div id="nav">
        <a href="admin_home.php">
            <i class="fa-solid fa-arrow-left navIcon"></i>
        </a>
        <p>Edit About Us</p>
    </div>

    <form action="admin_editAbtus.php" method="POST" enctype="multipart/form-data">
        <div id="contact">
            <table>
                <tr>
                    <td><i class="fa-solid fa-image icon"></i></td>
                    <td>
                        <?php if (!empty($companyImg)): ?>
                            <img src="images/<?php echo $companyImg; ?>" style="max-width: 300px; max-height: 300px">
                        <?php endif; ?>
                        <input type="file" name="companyImg" accept="image/*" class="upload">
                    </td>

                <tr>
                    <td><i class="fa-solid fa-location-dot icon"></i></td>
                    <td><input type="text" name="txtAddress" value="<?php echo $address; ?>"></td>
                </tr>

                <tr>
                    <td><i class="fa-solid fa-mobile-screen-button icon"></i></td>
                    <td><input type="tel" name="txtPhone" value="<?php echo $phone; ?>"></td>
                </tr>

                <tr>
                    <td><i class="fa-solid fa-envelope icon"></i></td>
                    <td><input type="email" name="txtEmail" value="<?php echo $email; ?>"></td>
                </tr>
            </table>
        </div>

        <div id="info">
            <table>
                <tr>
                    <td class="section">Our Mission:</td>
                    <td><textarea name="txtMission" rows="10" cols="100"><?php echo $missionDtl; ?></textarea></td>
                </tr>

                <tr>
                    <td class="section">What We Do:</td>
                    <td><textarea name="txtWWD" rows="10" cols="100"><?php echo $wwdDtl; ?></textarea></td>
                </tr>

                <tr>
                    <td class="section">Our Goal:</td>
                    <td><textarea name="txtGoal" rows="10" cols="100"><?php echo $goalDtl; ?></textarea></td>
                </tr>
            </table>
        </div>

        <div class="button">
            <input type="submit" value="Save" name="btnSave" class="save">
        </div>
    </form>
</body>

</html>