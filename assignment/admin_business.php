<?php
    include 'dbConn.php';
    session_start();

    //get frm client side
    if(isset($_GET['btnSearch'])){
        $search = $_GET['txtSearch'];
        $sql = "SELECT * FROM tblbusiness WHERE name LIKE '%$search%'";

    }else{
        $sql = "SELECT * FROM tblbusiness";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Businesses | Admin</title>
    <link rel="stylesheet" href="styles/admin_business.css">
    <link rel="stylesheet" href="styles/global.css">
    <script src="https://kit.fontawesome.com/8d434a5b7f.js" crossorigin="anonymous"></script>

</head>
<body>
    <?php include "admin_header.php" ?>
    <div id="side">
        <?php include "admin_sideMenu.php" ?>
    </div>

    <div id="content">
        <div id="top">
            <a href="admin_home.php"><i class="fa-solid fa-arrow-left fa-lg returnArrow"></i></a>
            <h1>All Businesses</h1>
            <div id="search">
                <form action="" method = "get">
                        <input type="text" name="txtSearch" placeholder="Search business" id="searchBar" autocomplete = "off">
                        <button type="submit" name="btnSearch" id="searchButton"><img src="images/magnifying-glass.png" alt="search" class="icon"></button>
                </form>
            </div>
        </div>

        <?php
            $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($result)){
                $busID = $row['busID'];
                $name = $row['name'];
                $desc = $row['description'];
                $userID = $row['userID'];

                $userSQL= "SELECT * FROM tbluser WHERE userID = '$userID'";
                $userResult = mysqli_query($conn, $userSQL);
                while($userRow = mysqli_fetch_assoc($userResult)){
                    $userName = $userRow['name'];
                }
                ?>

                <div class="indiBus">
                    <?php if (!empty($row['busImg'])): ?>
                    <img src="busImages/<?= htmlspecialchars($row['busImg']) ?>" alt="picture" id="picture">
                    <?php endif; ?>

                    <div id="text">
                        <!--get picture-->
                        <h2><?php echo $name?></h2>
                        <p><?php echo $desc?></p>
                        <p>Added by: <?php echo $userName?></p>
                    </div>
                
                    <div id="busIcons">
                        <a href="admin_editBusiness.php?busID=<?php echo $row['busID'];?>">
                                <i class="fa-solid fa-pen-to-square fa-xl editIcon"></i>
                        </a>
                        <a href="admin_deleteBusiness.php?busID=<?php echo $row['busID'];?>" onclick="return confirm('Are you sure you want to delete this business?');">
                                <i class="fa-solid fa-trash-can fa-xl deleteIcon"></i>
                        </a>
                    </div>
                </div>

        <?php
            }

        ?>
</body>
</html>