<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoXP Login Page</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="login-signup.css">
</head>

<body>
    <div class="login-left">
        <div>
            <h1>Welcome Back!</h1>
        </div>
        <form action="POST">
            <div class="details_form">
                <label>Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email..." required>
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password..." required>
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