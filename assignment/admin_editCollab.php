<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Collaborator | Admin</title>
    <link rel="stylesheet" href="styles/admin_collab.css">
    <link rel="stylesheet" href="styles/global.css">
    <script src="https://kit.fontawesome.com/8d434a5b7f.js" crossorigin="anonymous"></script>

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
            <i class="fa-solid fa-arrow-up-from-bracket upload"></i>
        </div>

        <!--set to get data when link to db-->
        <div class="form">
            <div id="circle"><i class="fa-solid fa-heading fa-lg name"></i></div>
             <form action="#" method="post">
                <input type="text" name="txtName" value="Name" id="indiForm">
             </form>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-envelope fa-lg email"></i></div>
             <form action="#" method="post">
                <input type="email" name="txtEmail" value="E-mail" id="indiForm">
             </form>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-phone fa-lg phone"></i></div>
             <form action="#" method="post">
                <input type="text" name="txtPhoneNo" value="Phone Number" id="indiForm">
             </form>
        </div>

        <div class="form">
            <div id="circle"><i class="fa-solid fa-list fa-lg selection"></i></div>
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