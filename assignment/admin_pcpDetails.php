<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant Details | Admin</title>

    <link rel="stylesheet" href="styles/pcpDetails.css">
    <link rel="stylesheet" href="styles/global.css">

    <script src="https://kit.fontawesome.com/b70fe5a297.js" crossorigin="anonymous"></script>
</head>
<body>

    <?php include 'admin_header.php'?>

    <div id="side">
        <?php include 'admin_sideMenu.php'?>
    </div>

    <div id="nav">
        <a href="viewPcp.html">
            <i class="fa-solid fa-circle-arrow-left navIcon"></i>
        </a>
        <p>Participant Details</p>
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
                <td>Group ID: </td>
                <td>P001</td>
            </tr>

            <tr>
                <td>Group Name: </td>
                <td>Garden Guardians</td>
            </tr>

            <tr>
                <td>Area: </td>
                <td>Taman Midah</td>
            </tr>

            <tr>
                <td>Task: </td>
                <td>Soil Preparation- <br> clearing weeds, <br>loosening soil,<br> and adding compost.</td>
            </tr>
        </table>
    </div>
</body>
</html>