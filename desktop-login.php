<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoXP Login - Desktop</title>
    <link rel="stylesheet" href="desktop-login.css">
</head>
<body>

<div class="container">
    <!-- Left Panel -->
    <div class="left-panel">
        <div class="login-section">
            <h1>Welcome back,</h1>
            <form method="POST">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email..." required>

                <label >Password</label>
                <input type="password" name="password" placeholder="Enter your password..." required>
            </form>
        </div>

        <!-- Button Section -->
        <div class="button-section">
            <button type="submit" class="login-btn">Log in</button>
            <button type="button" class="signup-btn" onclick="window.location.href='signup.php'">Sign up</button>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="right-panel">
        <div class="eco-box">
            <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
            <h2>EcoXP</h2>
        </div>
    </div>
</div>

</body>
</html>
