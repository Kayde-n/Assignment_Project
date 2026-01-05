<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="staff.css">
    <link rel="stylesheet" href="staff-verification-desktop.css">
 
</head>
<body>
    <div class="top-bar" >
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='staff-desktop-home.php'"><h2>EcoXP</h2></button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='staff-desktop-profile.php'"><img src="images/profile.png" alt="Profile Logo"></button>
            <button class="icon-btn"><img src="images/notif.png" alt="Notification Logo"></button>
            <button class="icon-btn"><img src="images/setting.png" alt="Setting Logo"></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="staff-icon-container">
            <div id="home-icon-box">
                <button class="icon-btn" onclick="window.location.href='staff-desktop-home.php'"><img src="images/home.png" alt="Home"></button>
            </div>
            <div id="verification-icon">
                <button class="icon-btn" onclick="window.location.href='staff-desktop-verification.php'"><img src="images/verification.png" alt="Verification"></button>
            </div>
            <button class="icon-btn" onclick="window.location.href='staff-desktop-verification.php'"><img src="images/newspaper.png" alt="Scan"></button>
            <div id="account-icon-box">
                <button class="icon-btn" onclick="window.location.href='staff-desktop-account.php'"><img src="images/account-management.png" alt="Account management"></button>
            </div>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>
    <div class="main-content">
        <div class="text-box">
            Verification Queue
        </div>
        <div class="verification-tabs">
            <input type="radio" name="status" id="pending" value="pending" checked>
            <label for="pending" class="tab-box">Pending (32)</label>

            <input type="radio" name="status" id="approved" value="approved">
            <label for="approved" class="tab-box">Approved (312)</label>

            <input type="radio" name="status" id="rejected" value="rejected">
            <label for="rejected" class="tab-box">Rejected (24)</label>
            </div>
    </div>
</body>
</html>