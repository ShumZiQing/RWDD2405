<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Business | Admin</title>
    <link rel="stylesheet" href="styles/admin_editBus.css">
    <link rel="stylesheet" href="styles/global.css">

</head>
<body>
    <?php include "admin_header.php"?>

    <div id="side">
        <?php include "admin_sideMenu.php"?>
    </div>

    <div id="content">
        <h1>Edit Business</h1>

        <div id="uploadPic">
            <img src="images/left-arrow.png" alt="" id="LArrow">
            <img src="images/image (6).png" alt="image" id="pic">
            <img src="images/right-arrow.png" alt="" id="RArrow">
            <img src="images/delete_black.png" alt="dlt" id="dlt">
            <img src="images/upload.png" alt="upload" id="upld">

            <!-- add pic number when link to db -->
        </div>

        <div class="form">
            <div id="circle"></div>
            <form action="#" method="post">
                <input type="text" name="txtBusName" id="indiForm" value="Business Name">
            </form>
        </div>

        <div class="form">
            <div id="circle"></div>
            <form action="#" method="post">
                <input type="text" name="txtBusType" id="indiForm" value="Business Type">
            </form>
        </div>

        <div class="form">
            <div id="circle"></div>
            <form action="#" method="post">
                <textarea name="txtBusDetails" id="indiTxtArea" rows="6" cols="23">Business Details</textarea>
            </form>
        </div>

        <div class="form">
            <div id="circle"></div>
            <form action="#" method="post">
                <input type="text" name="txtBusLoc" id="indiForm" value="Location">
            </form>
        </div>

        <div class="form">
            <div id="circle"></div>
            <form action="#" method="post">
                <input type="text" name="txtBusPhone" id="indiForm" value="Phone Number">
            </form>
        </div>

        <input type="submit" value="Save" id="save">
    </div>
</body>
</html>