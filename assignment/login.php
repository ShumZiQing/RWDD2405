<?php 
$pageTitle = "EcoConnect - Login";
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
            <a href="index.php" class="logo-link">
                <img src="images/logo.jpg" alt="EcoConnect Logo" class="logo">
                <h1 class="site-title">EcoConnect</h1>
            </a>
        </div>
    </header>

    <div class="container">
        <img src="images/loginRegisterImg.jpg" alt="EcoConnect Login Image" class="login_register-IMG">

        <h2>Login</h2>
        <form action="homepage.php" method="POST" class="form-box">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn">Login</button>
        </form>

        <p class="text-small">
            Don’t have an account? <a href="register.php">Register</a>
        </p>
    </div>
</body>
</html>
