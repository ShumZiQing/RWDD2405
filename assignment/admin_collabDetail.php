<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaborator Details | Admin</title>

    <link rel="stylesheet" href="styles/admin_collabDetail.css">
    <link rel="stylesheet" href="styles/global.css">
</head>
<body>
    <?php include "admin_header.php"?>

    <div id="side">
        <?php include "admin_sideMenu.php"?>
    </div>

    <div id="content">
        <div id="top">
            <div id="arrowBck">
                <img src="images/left-arrow_black.png" alt="" id="arrow">
            </div>
            <h2>Collaborator Details</h2>
        </div>

        <div id="mainInfo">
            <img src="images/upload-user.png" alt="">
            <div id="desc">
                <h1>Collab ID</h1>
                <h2>Collab Name</h2>
                <p>Contributes resources, knowledge, and innovation to help achieve sustainable living among the communities.</p>
            </div>
        </div>

        <div id="subInfo">
            <table>
                <tr>
                    <td id="title">Phone No: </td>
                    <td id="attr">+60 123456789</td>
                </tr>

                <tr>
                    <td id="title">Email: </td>
                    <td id="attr">username@gmail.com</td>
                </tr>

                <tr>
                    <td id="title">Type: </td>
                    <td id="attr">Non-Government Organization (NGO)</td>
                </tr>

                <tr>
                    <td id="title">Currently Involved: </td>
                    <td id="attr">Program A, Program B</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>