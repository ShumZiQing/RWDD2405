<?php 
include 'dbConn.php';
session_start();
$pageTitle = "EcoConnect - Login";

if(isset($_POST['btnLogin'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM tbluser WHERE email='$email' AND password='$password'";

    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $_SESSION['email'] = $email;
        $row = mysqli_fetch_assoc($result);
        $_SESSION['userid'] = $row['userID'];
        $_SESSION['fullname'] = $row['name'];
        $role = $row['role'];
        
        if($role == "user"){
            header("Location: homepage.php");
        }else if ($role == "admin"){
            header("Location: admin_home.php");
        }
    } else{
        $errorMsg = "Invalid email or password.";
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
        <img src="images/loginRegisterImg.jpg" alt="EcoConnect Login Image" class="login_register-IMG">
 
        <h2>Login</h2>
        <?php if(!empty($errorMsg)) echo "<p class='error-msg'>$errorMsg</p>"; ?>
        <form action="" method="POST" class="form-box">
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn" name="btnLogin">Login</button>
        </form>
 
        <p class="text-small">
            Don’t have an account? <a href="register.php">Register</a>
        </p>
    </div>
</body>
</html>
