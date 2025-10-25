<?php
    include 'dbConn.php';
    session_start();

    //get frm client side
    if(isset($_GET['btnSearch'])){
        $search = $_GET['txtSearch'];
        $sql = "SELECT * FROM tblenergytips WHERE eTipName LIKE '%$search%'";

    }else{
        $sql = "SELECT * FROM tblenergytips";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Energy Tips | Admin</title>
    <link rel="stylesheet" href="styles/admin_business.css">
    <link rel="stylesheet" href="styles/global.css">
    <script src="https://kit.fontawesome.com/8d434a5b7f.js" crossorigin="anonymous"></script>

    <style>
        @media(max-width: 600px){
            #search{
                margin-top: 10px;
            }
            
            .indiBus{
                height: auto;
            }

            .indiBus h2{
                font-size: 15px;
            }

            .indiBus p{
                font-size: 10px;
            }

            #busIcons{
                margin-left: 0;
                width: 35%;
            }
        }
    </style>

</head>
<body>
    <?php include "admin_header.php" ?>
    <div id="side">
        <?php include "admin_sideMenu.php" ?>
    </div>

    <div id="content">
        <div id="top">
            <a href="admin_home.php"><i class="fa-solid fa-arrow-left fa-lg returnArrow"></i></a>
            <h1>All Energy Tips</h1>
            <div id="search">
                <form action="" method = "get">
                        <input type="text" name="txtSearch" placeholder="Search tips" id="searchBar" autocomplete = "off">
                        <button type="submit" name="btnSearch" id="searchButton"><img src="images/magnifying-glass.png" alt="search" class="icon"></button>
                </form>
            </div>
        </div>

        <?php
            $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($result)){
                $eTipID = $row['eTipID'];
                $name = $row['eTipName'];
                $content = $row['eTipContent'];
                $type = $row['eTipType'];
                $userID = $row['userID'];

                $userSQL= "SELECT * FROM tbluser WHERE userID = '$userID'";
                $userResult = mysqli_query($conn, $userSQL);
                if (mysqli_num_rows($userResult) > 0) {
                    $userRow = mysqli_fetch_assoc($userResult);
                    $userName = $userRow['name'];
                } else{
                    $userName = "Unknown User";
                }
                ?>

                <div class="indiBus">
                    <?php if (!empty($row['eTipImage'])): ?>
                    <img src="eTipsImages/<?= htmlspecialchars($row['eTipImage']) ?>" alt="picture" id="picture">
                    <?php endif; ?>

                    <div id="text">
                        <h2><?php echo $name?></h2>
                        <p><?php echo $content?></p>
                        <p>Added by: <?php echo $userName?></p>
                    </div>
                
                    <div id="busIcons">
                        <a href="admin_editETips.php?eTipID=<?php echo $row['eTipID'];?>">
                                <i class="fa-solid fa-pen-to-square fa-xl editIcon"></i>
                        </a>
                        <a href="admin_deleteETip.php?eTipID=<?php echo $row['eTipID'];?>" onclick="return confirm('Are you sure you want to delete this energy tip?');">
                                <i class="fa-solid fa-trash-can fa-xl deleteIcon"></i>
                        </a>
                    </div>
                </div>

        <?php
            }

        ?>
        <!-- <div id="businesses">
            <div class="indiBus">
                <img src="images/image (6).png" alt="picture" id="picture">

                <div id="text">
                    <h2>Business A</h2>
                    <p id="summary">Summary</p>
                    <p id="user">Added by: user</p>
                </div>

                <div id="icons">
                    <i class="fa-solid fa-pen-to-square fa-xl editIcon"></i>
                    <i class="fa-solid fa-trash-can fa-xl deleteIcon"></i>
                </div>
            </div>
        </div>

        <div id="businesses">
            <div class="indiBus">
                <img src="images/image (6).png" alt="picture" id="picture">

                <div id="text">
                    <h2>Business B</h2>
                    <p id="summary">Summary</p>
                    <p id="user">Added by: user</p>
                </div>

                <div id="icons">
                    <i class="fa-solid fa-pen-to-square fa-xl editIcon"></i>
                    <i class="fa-solid fa-trash-can fa-xl deleteIcon"></i>
                </div>
            </div>
        </div>

        <div id="businesses">
            <div class="indiBus">
                <img src="images/image (6).png" alt="picture" id="picture">

                <div id="text">
                    <h2>Business C</h2>
                    <p id="summary">Summary</p>
                    <p id="user">Added by: user</p>
                </div>

                <div id="icons">
                    <i class="fa-solid fa-pen-to-square fa-xl editIcon"></i>
                    <i class="fa-solid fa-trash-can fa-xl deleteIcon"></i>
                </div>
            </div>
        </div>

        <div id="businesses">
            <div class="indiBus">
                <img src="images/image (6).png" alt="picture" id="picture">

                <div id="text">
                    <h2>Business D</h2>
                    <p id="summary">Summary</p>
                    <p id="user">Added by: user</p>
                </div>

                <div id="icons">
                    <i class="fa-solid fa-pen-to-square fa-xl editIcon"></i>
                    <i class="fa-solid fa-trash-can fa-xl deleteIcon"></i>
                </div>
            </div>
        </div>

         <div id="businesses">
            <div class="indiBus">
                <img src="images/image (6).png" alt="picture" id="picture">

                <div id="text">
                    <h2>Business E</h2>
                    <p id="summary">Summary</p>
                    <p id="user">Added by: user</p>
                </div>

                <div id="icons">
                    <i class="fa-solid fa-pen-to-square fa-xl editIcon"></i>
                    <i class="fa-solid fa-trash-can fa-xl deleteIcon"></i>
                </div>
            </div>
        </div>
    </div> -->
</body>
</html>