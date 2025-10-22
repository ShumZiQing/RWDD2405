<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details | Admin</title>

    <link rel="stylesheet" href="styles/userDetails.css">
    <link rel="stylesheet" href="styles/global.css">

    <script src="https://kit.fontawesome.com/b70fe5a297.js" crossorigin="anonymous"></script>
</head>
<body>

    <?php include 'admin_header.php'?>

    <div id="side">
        <?php include 'admin_sideMenu.php'?>
    </div>

    <div id="nav">
        <a href="mngUser.html">
            <i class="fa-solid fa-arrow-left navIcon"></i>
        </a>
        <p>User Details</p>
    </div>

    <div id="user">
        <div class="container">
            <i class="fa-solid fa-user profile"></i>

            <div class="text">
                <p>User ID</p>
                <p>Username</p>
            </div>
        </div>
    </div>

    <div id="info">
        <table>
            <tr>
                <td>Phone No: </td>
                <td>+60 123456789</td>
            </tr>

            <tr>
                <td>Email: </td>
                <td>username@gamil.com</td>
            </tr>

            <tr>
                <td>City: </td>
                <td>Kuala Lumpur</td>
            </tr>

            <tr>
                <td>Role: </td>
                <td>User</td>
            </tr>

            <tr>
                <td>Date Added: </td>
                <td>18/09/2025</td>
            </tr>
        </table>
    </div>

    <div id="button">
        <input type="submit" value="Delete" name="btnDelete" class="delete">
    </div>
</body>
</html>