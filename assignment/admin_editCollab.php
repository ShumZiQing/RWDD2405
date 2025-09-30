<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Collaborator | Admin</title>
    <link rel="stylesheet" href="styles/admin_collab.css">
    <link rel="stylesheet" href="styles/global.css">

</head>

<body>
    <?php include "admin_header.php" ?>
    
    <div id="content">
    <div id="side">
        <?php include "admin_sideMenu.php"?> 
    </div> 

        <h1>Edit Collaborator</h1>

        <div id="uploadProfile">
            <img src="images/upload-user.png" alt="upload-user" id="user">
            <img src="images/upload.png" alt="upload" id="upload">
        </div>

        <!--set to get data when link to db-->
        <div class="form">
            <div id="circle"></div>
             <form action="#" method="post">
                <input type="text" name="txtName" value="Name" id="indiForm">
             </form>
        </div>

        <div class="form">
            <div id="circle"></div>
             <form action="#" method="post">
                <input type="email" name="txtEmail" value="E-mail" id="indiForm">
             </form>
        </div>

        <div class="form">
            <div id="circle"></div>
             <form action="#" method="post">
                <input type="text" name="txtPhoneNo" value="Phone Number" id="indiForm">
             </form>
        </div>

        <div class="form">
            <div id="circle"></div>
             <form action="#" method="post">
                <select name="selCollab" id="indiSel">
                    <option value="INS">Internal</option>
                    <option value="EXT">External</option>
                    <option value="NGO">Non-Governmental Organization</option>
                    <option value="GO">Government Organization</option>
                </select>
             </form>
        </div>

        <input type="submit" value="Save" name="btnSave" id="save">
    </div>
</body>
</html>