<?php 
include 'dbConn.php';
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit;
}

$userID = $_SESSION['userid'];
$pageTitle = "EcoConnect - Manage Profile";


if(isset($_POST['btnSave'])){
  $name = $_POST['name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $city = $_POST['city'];

  $sql = "UPDATE tbluser SET
    name = '$name',
    username = '$username',
    phone = '$phone',
    city = '$city'
    WHERE userid = '$userID'";

  if(mysqli_query($conn, $sql)){
      $successMsg = "Changes saved successfully!";
  } else{
      echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
  }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/manageProfile.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <main class="manageProfile">
        <section class="banner">
            <img src="images/banner1.jpg" alt="Banner">
            <h2>Manage Profile</h2>
        </section>
    <div class="manage-profile">
        <div class="container">
            <?php if (isset($successMsg) && !empty($successMsg)) : ?>
                <p class="success-msg"><?php echo htmlspecialchars($successMsg); ?></p>
            <?php endif; ?>

            
            <?php
            $userID = $_SESSION['userid'];

            $result = mysqli_query($conn, "SELECT * FROM tbluser WHERE userid = '$userID'");
            $user = mysqli_fetch_assoc($result);

            $name = $user['name'];
            $username = $user['username'];
            $email = $user['email'];
            $phone = $user['phone'];
            $city = $user['city'];

            ?>

        <form action="#" method="POST" class="form-box">
            <div class="form-group">
                <label for="name">Full Name: </label>
                <input type="text" id="name" name="name" placeholder="Name" required
                value="<?php echo htmlspecialchars($name ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="username">Username: </label>
                <input type="text" id="username" name="username" placeholder="Username" required
                value="<?php echo htmlspecialchars($username ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="email">Email: </label>
                <input readonly type="email" id="email" name="email" placeholder="Email" required
                value="<?php echo htmlspecialchars($email ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number: </label>
                <input type="text" id="phone" name="phone" placeholder="Phone" required
                value="<?php echo htmlspecialchars($phone ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="city">City: </label>
                <select id="city" name="city" required>
                <option value="<?php echo htmlspecialchars($city ?? ''); ?>">
                    <?php echo htmlspecialchars($city ?? 'Select City'); ?>
                </option>
                <option value="Alor Setar">Alor Setar</option>
                <option value="George Town">George Town</option>
                <option value="Ipoh">Ipoh</option>
                <option value="Johor Bahru">Johor Bahru</option>
                <option value="Klang">Klang</option>
                <option value="Kota Bharu">Kota Bharu</option>
                <option value="Kota Kinabalu">Kota Kinabalu</option>
                <option value="Kuala Lumpur">Kuala Lumpur</option>
                <option value="Kuala Terengganu">Kuala Terengganu</option>
                <option value="Kuantan">Kuantan</option>
                <option value="Kuching">Kuching</option>
                <option value="Labuan">Labuan</option>
                <option value="Malacca City">Malacca City</option>
                <option value="Miri">Miri</option>
                <option value="Petaling Jaya">Petaling Jaya</option>
                <option value="Putrajaya">Putrajaya</option>
                <option value="Seremban">Seremban</option>
                <option value="Shah Alam">Shah Alam</option>
                <option value="Subang Jaya">Subang Jaya</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn save-btn" name="btnSave">Save Changes</button>
                <button type="button" class="btn cancel-btn" onclick="window.location.href='homepage.php'">Cancel</button>
            </div>
        </form>
        </div>
    </div>
        </main>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <!-- SCRIPTS -->
    <script src="scripts/hamburger.js"></script>
    <script src="scripts/energyTips.js"></script>
</body>
</html>
