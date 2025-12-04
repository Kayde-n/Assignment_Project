<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoXP Login</title>
    <link rel="stylesheet" href="mobile-login.css">
</head>

<body>
    <div class="top-section">
        <img src="images/ecoxp-logo.png" class="logo" alt="EcoXP Logo">
        <h2>EcoXP</h2>
    </div>

    <div class="login-section">
        <h1>Welcome back,</h1>

        <form method="POST">

            <label>Email Address</label>
            <input type="email" name="email" placeholder="Enter your email..." required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password..." required>

            <button type="submit" class="login-btn">Log in</button>
            <button type="button" class="signup-btn">Sign up</button>

        </form>
    </div>

</body>

</html>
