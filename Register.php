<!DOCTYPE html>
<html lang="en">
<?php
include("database.php");
?>

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
                <input type="text" id="username" name="user_full_name" placeholder="Enter your username..." required>
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
                <input type="password" id="confirm_password" name="confirm_password"
                    placeholder="Confirm your password..." required>
            </div>

            <button type="submit" name="regBtn">Sign up</button>
        </form>
    </div>
    <?php
    if (isset($_POST['regBtn'])) {

        $sql = "SELECT * FROM user WHERE email='$_POST[email]'";
        $result = mysqli_query($database, $sql);
        $numrow = mysqli_num_rows($result);
        $password = $_POST['password'];

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $profile_pic = "images/profile.png";
        $account_status = "Active";
        if ($numrow == 0) {

            $sql = "INSERT INTO user (user_full_name, email, hash_password, profile_picture_path, account_status) VALUES ('$_POST[user_full_name]', '$_POST[email]', '$hashed_password', '$profile_pic', '$account_status')";
            if (!mysqli_query($database, $sql)) {
                die('Error: ' . mysqli_error($database));
            } else {
                echo "<script>alert('Registration successful!');window.location.href='Login.php';</script>";

            }
        } else {
            echo "<script>alert('Email already registered. Please use a different email.')</script>";
        }

        // Retrieve user_id of the newly registered user
        $sql_retreive_id = "SELECT user_id FROM user WHERE email='$_POST[email]'";
        $result_retreive_id = mysqli_query($database, $sql_retreive_id);
        $id_count = mysqli_num_rows($result_retreive_id);
        if ($id_count == 1) {
            $row = mysqli_fetch_array($result_retreive_id);
            $user_id = $row['user_id'];
        }
        //insert data of newly registered user into participants table
        $sql = "INSERT INTO participants (user_id) VALUES ($user_id)";
        if (!mysqli_query($database, $sql)) {
            die('Error: ' . mysqli_error($database));
        } else {
            echo "<script>alert('Registration successful!');window.location.href='Login.php';</script>";

        }
    }
    mysqli_close($database);
    ?>
    <div class="login-right">
        <div class="logo-box">
            <img src="images/ecoxp-logo.png" alt="EcoXP Logo">
            <h2>EcoXP</h2>
        </div>
    </div>

</body>

</html>