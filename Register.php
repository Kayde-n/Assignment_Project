<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoXP Register Page</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="login-signup.css">
</head>

<body>
    <div class="login-left">
        <div>
            <h1>Hello!</h1>
        </div>
        <form method="POST">
            <div class="details_form">
                <label>Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username..." required>
            </div>
            <div>
                <label>Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email..." required>
            </div>

            <div>
                <label>Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password..." required>
            </div>
            <div>
                <label>Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password..."
                    required>
            </div>

            <button type="submit">Log in</button>
            <button type="button">Sign up</button>
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