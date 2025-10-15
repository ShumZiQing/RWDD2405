<?php 
$pageTitle = "EcoConnect - Energy Conservation Tips";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/energyTips.css">
</head>

<body>
    <!-- HEADER -->
    <?php include 'header.php'; ?>

    <!-- CONTENT -->
    <main class="energy">
        <section class="banner">
            <img src="images/banner1.jpg" alt="Banner">
            <h2>Energy Conservation Tips</h2>
        </section>

        <section class="tabs">
            <button class="tab-btn active" data-target="home">Home</button>
            <button class="tab-btn" data-target="workplace">Workplace</button>
        </section>

        <!-- HOME TIPS -->
        <section id="home" class="tips-list active">
            <div class="tip-card">
                <img src="images/saveWater.png" alt="Save Water">
                <h3>Save Water</h3>
                <ul>
                    <li>Take shorter showers</li>
                    <li>Turn off the tap when not using</li>
                    <li>Collect rainwater for gardening</li>
                </ul>
            </div>

            <div class="tip-card">
                <img src="images/saveEnergy.png" alt="Save Energy">
                <h3>Save Energy</h3>
                <ul>
                    <li>Unplug devices when not in use</li>
                    <li>Use natural lighting in daytime</li>
                    <li>Switch to LED bulbs</li>
                </ul>
            </div>

            <div class="tip-card">
                <img src="images/saveAppliances.png" alt="Efficient Appliances">
                <h3>Efficient Appliances</h3>
                <ul>
                    <li>Use energy-efficient appliances (with energy star label)</li>
                    <li>Wash clothes with cold water</li>
                    <li>Run washing machines/diswashers with full loads only</li>
                </ul>
            </div>

            <div class="tip-card">
                <img src="images/saveAC.png" alt="Cooling & Heating">
                <h3>Cooling & Heating</h3>
                <ul>
                    <li>Set AC to 24°C / 75°F or higher</li>
                    <li>Clean filters regularly</li>
                    <li>Use fans instead of AC when possible</li>
                </ul>
            </div>

            <div class="tip-card">
                <img src="images/saveKitchen.png" alt="Kitchen Efficiency">
                <h3>Kitchen Efficiency</h3>
                <ul>
                    <li>Cover pots when boiling to save gas/electricity</li>
                    <li>Avoid opening the fridge frequently</li>
                    <li>Defrost frozen food in the fridge overnight</li>
                </ul>
            </div>
        </section>

        <!-- WORKPLACE TIPS -->
        <section id="workplace" class="tips-list">
            <div class="tip-card">
                <img src="images/saveLight.png" alt="Smart Lighting">
                <h3>Smart Lighting</h3>
                <ul>
                    <li>Turn off lights in unused rooms</li>
                    <li>Install motion-sensor lighting</li>
                    <li>Use task lighting instead of overhead lights</li>
                </ul>
            </div>

            <div class="tip-card">
                <img src="images/saveElectronics.png" alt="Computers & Office Equipment">
                <h3>Computers & Office Equipment</h3>
                <ul>
                    <li>Enable sleep mode after 10 minutes</li>
                    <li>Shut down after work hours</li>
                    <li>Use energy-efficient monitors</li>
                </ul>
            </div>

            <div class="tip-card">
                <img src="images/savePaper.png" alt="Printing & Paper">
                <h3>Printing & Paper</h3>
                <ul>
                    <li>Print double-sided to save paper</li>
                    <li>Share digital documents instead of printing</li>
                    <li>Reuse scrap paper for drafts</li>
                </ul>
            </div>

            <div class="tip-card">
                <img src="images/saveMeeting.png" alt="Smart Meeting Practices">
                <h3>Smart Meeting Practices</h3>
                <ul>
                    <li>Use video calls to reduce travel energy use</li>
                    <li>Schedule meetings in naturally lit rooms</li>
                    <li>Share one large screen instead of multiple devices</li>
                </ul>
            </div>

            <div class="tip-card">
                <img src="images/saveOffice.png" alt="Office Habits">
                <h3>Office Habits</h3>
                <ul>
                    <li>Encourage carpooling or public transport for staff</li>
                    <li>Provide water dispensers instead of bottled water</li>
                    <li>Create "energy champions" among employees to monitor and promote savings</li>
                </ul>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <!-- SCRIPTS -->
    <script src="scripts/hamburger.js"></script>
    <script src="scripts/energyTips.js"></script>
</body>
</html>
