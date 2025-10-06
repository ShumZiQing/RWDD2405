<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Business | Admin</title>
    <link rel="stylesheet" href="styles/admin_editBus.css">
    <link rel="stylesheet" href="styles/global.css">
    <script src="https://kit.fontawesome.com/8d434a5b7f.js" crossorigin="anonymous"></script>

</head>
<body>
    <?php include "admin_header.php"?>

    <div id="side">
        <?php include "admin_sideMenu.php"?>
    </div>

    <div id="content">
        <h1>Edit Business</h1>

        <div id="uploadPic">
            <i class="fa-solid fa-angle-left fa-xl LArrow"></i>
            <img src="images/image (6).png" alt="image" id="pic">
            <i class="fa-solid fa-angle-right fa-xl RArrow"></i>
            <i class="fa-solid fa-trash fa-lg dlt"></i>
            <i class="fa-solid fa-arrow-up-from-bracket fa-lg upld"></i>

            <!-- add pic number when link to db -->
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-heading fa-lg name"></i></div>
            <form action="#" method="post">
                <input type="text" name="txtBusName" id="indiForm" value="Business Name">
            </form>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-list fa-lg selection"></i></div>
            <form action="#" method="post">
                <input type="text" name="txtBusType" id="indiForm" value="Business Type">
            </form>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-pen fa-lg descIcon"></i></div>
            <form action="#" method="post">
                <textarea name="txtBusDetails" id="indiTxtArea" rows="6" cols="23">Business Details</textarea>
            </form>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-location-dot fa-lg locationIcon"></i></div>
            <form action="#" method="post">
                <input type="text" name="txtBusLoc" id="indiForm" value="Location">
            </form>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-phone fa-lg phone"></i></div>
            <form action="#" method="post">
                <input type="text" name="txtBusPhone" id="indiForm" value="Phone Number">
            </form>
        </div>

        <input type="submit" value="Save" id="save">
    </div>
</body>
</html>