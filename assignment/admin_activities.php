<?php
    include 'dbConn.php';
    session_start();

    if(isset($_GET['btnSearch'])){
        $search = $_GET['txtSearch'];
        $progSql = "SELECT * FROM tblprogram WHERE progName LIKE '%$search%'";
        $projSql = "SELECT * FROM tblproject WHERE prjName LIKE '%$search%'";

    }else{
        $progSql = "SELECT * FROM tblprogram";
        $projSql = "SELECT * FROM tblproject";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Activites | Admin</title>
    <link rel="stylesheet" href="styles/admin_act.css">
    <link rel="stylesheet" href="styles/global.css">
    <script src="https://kit.fontawesome.com/8d434a5b7f.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include "admin_header.php" ?>
    
    <div id="content">
        <div id="side">
            <?php include "admin_sideMenu.php" ?>
        </div>

        <div id="main">
            <a href="admin_home.php"><i class="fa-solid fa-arrow-left fa-lg returnArrow"></i></a>
            <h1>All Activities</h1>
            <div id="features">
                <div id="search">
                    <form action="" method = "get">
                        <input type="text" name="txtSearch" placeholder="Search program" id="searchBar" autocomplete = "off">
                        <button type="submit" name="btnSearch" id="searchButton"><img src="images/magnifying-glass.png" alt="search" class="icon"></button>
                    </form>
                </div>
                <div id="add">
                    <img src="images/add.png" alt="add" class="icon">
                    <p>Add</p>
                    <img src="images/down-arrow.png" alt="dropdown" class="icon">
                    <ul>
                        <a href="admin_addProg.php"><li>New Program</li></a>
                        <a href="admin_addPrj.php"><li>New Project</li></a>
                    </ul>
                </div>
            </div>

            <?php
                $progResult = mysqli_query($conn, $progSql);

                while($progRow = mysqli_fetch_assoc($progResult)){
                    $progID = $progRow['progID'];
                    $progName = $progRow['progName'];
                    $progDesc = $progRow['progDetails'];
                    ?>

                    <div class="prog">
                    <div id="desc">
                        <h2><?php echo $progName?></h2>
                        <p><?php echo $progDesc?></p>
                    </div>
                    
                    <div class="actIcon">
                        <div id="collab">
                            <a href="admin_collabDetail.php?collabName=<?php echo $progRow['collaborators'];?>"><i class="fa-solid fa-users fa-xl collabIcon"></i></a>
                            <p>Collaborator</p>
                        </div>
                        
                        <a href="admin_editProg.php?progID=<?php echo $progRow['progID'];?>">
                            <div id="edit">
                                <i class="fa-solid fa-pen-to-square fa-xl editIcon"></i>
                                <p>Edit</p>
                            </div>
                        </a>
                    </div>
                </div>

            <?php
                }

            ?>

            <?php
                $projResult = mysqli_query($conn, $projSql);

                while($projRow = mysqli_fetch_assoc($projResult)){
                    $projID = $projRow['prjID'];
                    $projName = $projRow['prjName'];
                    $projDesc = $projRow['prjDetails'];
                    ?>

                    <div class="proj">
                    <div id="desc">
                        <h2><?php echo $projName?></h2>
                        <p><?php echo $projDesc?></p>
                    </div>
                    
                    <div class="actIcon">
                        <div id="collab">
                            <a href="admin_collabDetail.php?collabName=<?php echo $projRow['collaborator'];?>"><i class="fa-solid fa-users fa-xl collabIcon"></i></a>
                            <p>Collaborator</p>
                        </div>
                        
                        <a href="admin_editPrj.php">
                            <div id="edit">
                                <i class="fa-solid fa-pen-to-square fa-xl editIcon"></i>
                                <p>Edit</p>
                            </div>
                        </a>
                    </div>
                </div>

            <?php
                }

            ?>

            <!-- <div class="prog">
                <div id="desc">
                    <h2>Recycling Program</h2>
                    <p>Summary of program
                        <br>...
                        <br>...
                    </p>
                </div>
                
                <div class="actIcon">
                    <div id="collab">
                        <i class="fa-solid fa-users fa-xl collabIcon"></i>
                        <p>Collaborator</p>
                    </div>
                    
                    <div id="edit">
                        <i class="fa-solid fa-pen-to-square fa-xl editIcon"></i>
                        <p>Edit</p>
                    </div>
                </div>
            </div>

            <div class="proj">
                <div id="desc">
                    <h2>Gardening Project</h2>
                    <p>Summary of program
                        <br>...
                        <br>...
                    </p>
                </div>
                
                <div class="actIcon">
                    <div id="collab">
                        <i class="fa-solid fa-users fa-xl collabIcon"></i>
                        <p>Collaborator</p>
                    </div>
                    
                    <div id="edit">
                        <i class="fa-solid fa-pen-to-square fa-xl editIcon"></i>
                        <p>Edit</p>
                    </div>
                </div>
            </div>

            <div class="proj">
                    <div id="desc">
                        <h2>Gardening Project</h2>
                        <p>Summary of program
                            <br>...
                            <br>...
                        </p>
                    </div>
                    
                    <div class="actIcon">
                        <div id="collab">
                            <i class="fa-solid fa-users fa-xl collabIcon"></i>
                            <p>Collaborator</p>
                        </div>
                        
                        <div id="edit">
                            <i class="fa-solid fa-pen-to-square fa-xl editIcon"></i>
                            <p>Edit</p>
                        </div>
                    </div>
            </div>

            <div class="prog">
                <div id="desc">
                    <h2>Recycling Program</h2>
                    <p>Summary of program
                        <br>...
                        <br>...
                    </p>
                </div>
                
                <div class="actIcon">
                    <div id="collab">
                        <i class="fa-solid fa-users fa-xl collabIcon"></i>
                        <p>Collaborator</p>
                    </div>
                    
                    <div id="edit">
                        <i class="fa-solid fa-pen-to-square fa-xl editIcon"></i>
                        <p>Edit</p>
                    </div>
                </div>
            </div>
            
            <div class="prog">
                <div id="desc">
                    <h2>Recycling Program</h2>
                    <p>Summary of program
                        <br>...
                        <br>...
                    </p>
                </div>
                
                <div class="actIcon">
                    <div id="collab">
                        <i class="fa-solid fa-users fa-xl collabIcon"></i>
                        <p>Collaborator</p>
                    </div>
                    
                    <div id="edit">
                        <i class="fa-solid fa-pen-to-square fa-xl editIcon"></i>
                        <p>Edit</p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</body>
</html>