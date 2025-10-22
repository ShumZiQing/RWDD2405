<?php
    include 'dbConnect.php';
    session_start();

    if(isset($_GET['btnSearch'])){
        $search = $_GET['txtSearch'];
        $sql = "SELECT * FROM tblcollaborator WHERE name LIKE '%$search%'";

    }else{
        $sql = "SELECT * FROM tblcollaborator";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Collaborators | Admin</title>
    <link rel="stylesheet" href="styles/admin_business.css">
    <link rel="stylesheet" href="styles/admin_viewCollab.css">
    <link rel="stylesheet" href="styles/global.css">
    <script src="https://kit.fontawesome.com/8d434a5b7f.js" crossorigin="anonymous"></script>

</head>
<body>
    <?php include "admin_header.php" ?>

    <div id="content">
        <div id="side">
            <?php include "admin_sideMenu.php" ?>
        </div>

        <div id="top">
            <a href="admin_home.php"><i class="fa-solid fa-arrow-left fa-lg returnArrow"></i></a>
            <h1>Program Collaborators</h1>
            <div id="feature">
                <div id="search">
                    <form action="" method = "get">
                        <input type="text" name="txtSearch" placeholder="Search program" id="searchBar" autocomplete = "off">
                        <button type="submit" name="btnSearch" id="searchButton"><img src="images/magnifying-glass.png" alt="search" class="icon"></button>
                    </form>
                </div>
                <a href="admin_addCollab.php">
                <div id="add">
                    <img src="images/add.png" alt="add" class="icon">
                    <p>Add</p>
                </div>
                </a>
            </div>
        </div>
        
        <?php
            //add proj table too
            $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($result)){
                $collabID = $row['collabID'];
                $name = $row['name'];
                $img = $row['image'];
            ?>

            <div class="indiBus" onclick='window.location="admin_collabDetail.php?collabID=<?php echo $collabID;?>"'>
                    <img src="<?php echo $img?>" alt="user" id="picture">

                    <div id="text">
                        <h2>Collab #<?php echo $collabID?></h2>
                        <p><?php echo $name?></p>
                    </div>
                
                <div class="collabIcons">
                    <a href="admin_editCollab.php?collabID=<?php echo $row['collabID'];?>">
                        <i class="fa-solid fa-pen-to-square fa-xl editIcon"></i>
                    </a>
                    <a href="admin_deleteCollab.php?collabID=<?php echo $row['collabID'];?>" onclick="event.stopPropagation(); return confirm('Are you sure you want to delete this collaborator?');">
                        <i class="fa-solid fa-trash-can fa-xl deleteIcon"></i>
                    </a>
                </div>
            </div>

        <?php
            }

        ?>

        </div> 
        <!-- <div id="businesses">
            <div class="indiBus">
                <img src="images/upload-user.png" alt="user" id="picture">

                <div id="text">
                    <h2>Collab ID</h2>
                    <p id="cName">Collab Name</p>
                </div>

                <div id="icons">
                    <a href="admin_editCollab.php"><i class="fa-solid fa-pen-to-square fa-xl editIcon"></i></a>
                    <i class="fa-solid fa-trash-can fa-xl deleteIcon"></i>
                </div>
            </div>
        </div>

        <div id="businesses">
            <div class="indiBus">
                <img src="images/upload-user.png" alt="user" id="picture">

                <div id="text">
                    <h2>Collab ID</h2>
                    <p id="cName">Collab Name</p>
                </div>

                <div id="icons">
                    <a href="admin_editCollab.php"><i class="fa-solid fa-pen-to-square fa-xl editIcon"></i></a>
                    <i class="fa-solid fa-trash-can fa-xl deleteIcon"></i>
                </div>
            </div>
        </div>

        <div id="businesses">
            <div class="indiBus">
                <img src="images/upload-user.png" alt="user" id="picture">

                <div id="text">
                    <h2>Collab ID</h2>
                    <p id="cName">Collab Name</p>
                </div>

                <div id="icons">
                    <a href="admin_editCollab.php"><i class="fa-solid fa-pen-to-square fa-xl editIcon"></i></a>
                    <i class="fa-solid fa-trash-can fa-xl deleteIcon"></i>
                </div>
            </div>
        </div>

         <div id="businesses">
            <div class="indiBus">
                <img src="images/upload-user.png" alt="user" id="picture">

                <div id="text">
                    <h2>Collab ID</h2>
                    <p id="cName">Collab Name</p>
                </div>

                <div id="icons">
                    <a href="admin_editCollab.php"><i class="fa-solid fa-pen-to-square fa-xl editIcon"></i></a>
                    <i class="fa-solid fa-trash-can fa-xl deleteIcon"></i>
                </div>
            </div>
        </div>-->
    
</body>
</html>