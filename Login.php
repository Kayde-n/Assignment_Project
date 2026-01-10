<?php
ini_set('session.cookie_path', '/');
session_start();

require_once __DIR__ . "/config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($database, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($database, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row['hash_password'])) { 
        $_SESSION['mySession'] = $row['user_id'];
        $_SESSION['user_id'] = $row['user_full_name'];
        header("location: authenticate-user-role.php");
        exit(); 
    } else {
        header("Location: Login.php?error=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoXP Login Page</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="login-signup.css">

    <?php if (isset($_GET['error'])): ?>
    <script>
        window.onload = function() {
            alert("Your Email or Password is invalid. Please re-login.");
        };
    </script>
    <?php endif; ?>
</head>

<body>
    <div class="login-left">
        <div>
            <h1>Welcome Back!</h1>
        </div>
        <form method="POST">
            <div class="details_form">
                <label>Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email..." required>
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password..." required>
            </div>

            <button type="submit">Log in</button>
            <button type="button" onclick="window.location.href='Register.php'">Sign up</button>
        </form>
    </div>
    <div class="login-right">
        <div class="logo-box">
            <img src="images/ecoxp-logo.png" alt="EcoXP Logo">
            <h2>EcoXP</h2>
        </div>
    </div>
</body>
</html>