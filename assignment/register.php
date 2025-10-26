<?php 
include 'dbConn.php';
$pageTitle = "EcoConnect - Register";

if(isset($_POST['btnRegister'])){
  $name = $_POST['name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $phone = $_POST['phone'];
  $city = $_POST['city'];
  $role = 'user';

  $sql = "INSERT INTO tbluser (name, username, email, password, phone, city, role)
  VALUES ('$name', '$username', '$email', '$password', '$phone', '$city', '$role')";

  if(mysqli_query($conn, $sql)){
      $successMsg = "Account created successfully! Please log in.";
  } else{
      echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
  }
} else{
  echo 'user did not click the register button';
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" href="styles/global.css">
  <link rel="stylesheet" href="styles/login-register.css">
</head>

<body>
  <header class="header">
    <div class="logo-container">
      <a href="homepage.php" class="logo-link">
        <img src="images/logo.jpg" alt="EcoConnect Logo" class="logo">
        <h1 class="site-title">EcoConnect</h1>
      </a>
    </div>
  </header>

  <div class="container">
    <img src="images/loginRegisterImg.jpg" alt="EcoConnect Register Image" class="login_register-IMG">

    <h2>Register</h2>
    <?php if(!empty($successMsg)) echo "<p class='success-msg'>$successMsg</p>"; ?>
    
    <form action="" method="POST" class="form-box">
      <input type="text" name="name" placeholder="Name" required>
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="text" name="phone" placeholder="Phone" required>
      <select name="city" required>
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

      <button type="submit" class="btn" name="btnRegister">Register</button>
    </form>

    <p class="text-small">
      Already have an account? <a href="login.php">Login</a>
    </p>
  </div>
</body>
</html>
