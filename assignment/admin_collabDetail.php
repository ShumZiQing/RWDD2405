<?php
    include 'dbConn.php';
    session_start();

    $collabID = "";
    $collabName = "";

    if (isset($_GET['collabID'])) {
        $collabID = $_GET['collabID'];
        $sql = "SELECT * FROM tblcollaborator WHERE collabID = '$collabID'";

    }else if (isset($_GET['collabName'])) {
        $collabName = $_GET['collabName'];
        $sql = "SELECT * FROM tblcollaborator WHERE name = '$collabName'";

    }else{
        echo "<script>alert('No collaborator selected.'); window.location='admin_collab.php';</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaborator Details | Admin</title>

    <link rel="stylesheet" href="styles/admin_collabDetail.css">
    <link rel="stylesheet" href="styles/global.css">
    <script src="https://kit.fontawesome.com/8d434a5b7f.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <?php include "admin_header.php"?>

    <div id="side">
        <?php include "admin_sideMenu.php"?>
    </div>

    <div id="content">
        <div id="top">
            <a href="admin_collab.php"><i class="fa-solid fa-arrow-left fa-xl returnArrow"></i></a>
            <h2>Collaborator Details</h2>
        </div>

        <?php
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $name = $row['name'];
            $email = $row['email'];
            $phoneNo = $row['phoneNum'];
            $orgType = $row['orgType'];
            $progInvolved = $row['progInvolved'];
            $image = $row['image'];
        ?>

        <div id="mainInfo">
            <img src="<?php echo $image?>" alt="" id="collabImg">

            <div id="desc">
                <h1>Collaborator <?php echo $collabID?></h1>
                <h2><?php echo $name?></h2>
            </div>
        </div>

        <div id="subInfo">
            <table>
                <tr>
                    <td id="title">Phone No: </td>
                    <td id="attr"><?php echo $phoneNo?></td>
                </tr>

                <tr>
                    <td id="title">Email: </td>
                    <td id="attr"><?php echo $email?></td>
                </tr>

                <tr>
                    <td id="title">Type: </td>
                    <td id="attr">
                        <?php if($orgType == "INS"){
                                echo "Internal";
                            }else if ($orgType == "EXT"){
                                echo "External";
                            }else if($orgType == "NGO"){
                                echo "Non-governmental Organization";
                            }else if ($orgType == "GO"){
                                echo "Governmental Organization";
                            }?>
                    </td>
                </tr>

                <tr>
                    <td id="title">Currently Involved: </td>
                    <td id="attr"> <?php echo $progInvolved;?>
                    </td>
                </tr>
            </table>
        </div>

        <a href="admin_deleteCollab.php?collabID=<?php echo $row['collabID'];?>" onclick="return confirm('Are you sure you want to delete this collaborator?');">
            <div id="delete">
                <p>Delete</p>
            </div>
        </a>
    </div>
</body>
</html>