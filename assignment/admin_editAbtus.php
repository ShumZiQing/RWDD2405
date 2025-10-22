<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit About Us | Admin</title>

    <link rel="stylesheet" href="styles/editAbtus.css">
    <link rel="stylesheet" href="styles/global.css">

    <script src="https://kit.fontawesome.com/b70fe5a297.js" crossorigin="anonymous"></script>
</head>
<body>

    <?php include 'admin_header.php'?>

    <div id="side">
        <?php include 'admin_sideMenu.php'?>
    </div> 
    
    <div id="title">
        <p>Edit About Us</p>
    </div>

    <div id="container">
        <div id="edit">
            <i class="fa-solid fa-trash delete"></i>
            <i class="fa-solid fa-arrow-up-from-bracket upload"></i>
        </div>

        <div id="choose">
            <i class="fa-solid fa-chevron-left left"></i>
            <i class="fa-solid fa-image image" style="color: #000000;"></i>
            <i class="fa-solid fa-chevron-right right"></i>
        </div>
        
        <div class="pages">
            <p>1/2</p>
        </div>
    </div>

    <div id="info">
        <table>
            <tr>
                <td><i class="fa-solid fa-heading variable"></i></td>
                <td><input type="text" name="txtAbtus" placeholder="About Us" required></td>
            </tr>

            <tr>
                <td><i class="fa-solid fa-circle-info variable"></i></td>
                <td><textarea name="txtDesc" rows="15" cols="120" placeholder="Description" required></textarea></td>
            </tr>
        </table>
    </div>

    <div class="save">
        <input type="submit" value="Save" name="btnSave">
    </div>
</body>
</html>