<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EcoXP Login</title>
<link rel="stylesheet" href="login-merge.css">

</head>
<body>

<div class="container">

    <!-- Left panel = form -->
    <div class="left-panel">
        <!-- Mobile top green logo -->
        <div class="top-section-mobile">
            <div class="eco-box logo-card">
                <img src="images/ecoxp-logo.png" class="eco-logo" alt="EcoXP Logo">
                <h2>EcoXP</h2>
            </div>
        </div>

        <div class="login-section">
            <h1>Welcome back,</h1>
            <form method="POST">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email..." required>

                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password..." required>

                <div class="button-section">
                    <button type="submit" class="login-btn">Log in</button>
                    <button type="button" class="signup-btn">Sign up</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Right panel = desktop logo -->
    <div class="right-panel">
        <div class="eco-box">
            <img src="images/ecoxp-logo.png" class="eco-logo" alt="EcoXP Logo">
            <h2 style="font-size: 32px; font-weight: 600;">EcoXP</h2>
        </div>
    </div>
</div>

</body>
</html>
