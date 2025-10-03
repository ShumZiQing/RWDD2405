<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Program | Admin</title>
    <link rel="stylesheet" href="styles/admin_prog.css">
    <link rel="stylesheet" href="styles/global.css">
</head>
<body>
    <?php include "admin_header.php"?>

    <div id="side">
        <?php include "admin_sideMenu.php"?>
    </div>

    <div id="content">
        <h1>Edit Program</h1>

    <div id="box">
        <div class="forms">
            <div id="circle"></div>
            <form action="#" method="post">
                <input type="text" name="txtStartDate" value="Start Date" id="indiSmallForm">
                to
                <input type="text" name="txtEndDate" value="End Date" id="indiSmallForm">
            </form>
        </div>

        <div class="forms">
            <div id="circle"></div>
            <form action="#" method="post">
                <input type="text" name="txtStartTime" value="Start Time" id="indiSmallForm">
                to
                <input type="text" name="txtEndTime" value="End Time" id="indiSmallForm">
            </form>
        </div>

        <div class="forms">
            <div id="circle"></div>
            <form action="#" method="post">
                <textarea name="txtProgDetails" id="indiTxtArea">Program Details</textarea>
            </form>
        </div>

        <div class="forms">
            <div id="circle"></div>
            <form action="#" method="post">
                <select name="selRecyclable" id="indiSel">
                    <option value="PLT">Plastic</option>
                    <option value="MTL">Metal</option>
                    <option value="PPR">Paper</option>
                    <option value="GLS">Glass</option>
                </select>
            </form>
        </div>

        <div class="forms">
            <div id="circle"></div>
            <form action="#" method="post">
                <select name="selRecyclable" id="indiSel">
                    <option value="ESP">Taman Esplanad</option>
                    <option value="LTAT">Taman LTAT</option>
                    <option value="PUJ">Taman Puncak Jalil</option>
                    <option value="YAR">Taman Yarl</option>
                    <option value="EQP">Taman Equine Park</option>
                </select>
            </form>
        </div>

        <div class="forms">
            <div id="circle"></div>
            <form action="#" method="post">
                <select name="selFrequency" id="indiSel">
                    <option value="day">Daily</option>
                    <option value="week">Weekly</option>
                    <option value="month">Monthly</option>
                </select>
            </form>
        </div>

        <div class="forms">
            <div id="circle"></div>
            <form action="#" method="post">
                <select name="selCollab" id="indiSel">
                    <option value="ESGAM">ESG Association of Malaysia</option>
                    <option value="MAREA">Malaysian Recycling Alliance</option>
                    <option value="PERKESA">Malaysian Recycling Empowerment Association </option>
                    <option value="PASS">Pertubuhan Amal Seri Sinar</option>
                </select>
            </form>
        </div>

        <input type="submit" value="Save" id="save">
    </div>
    </div>
</body>
</html>