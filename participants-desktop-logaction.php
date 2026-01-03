<?php
include("session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Action</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="participant.css">
    <link rel="stylesheet" href="participants-logaction-desktop.css">

</head>

<body>
    <div class="top-bar">
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='participants-desktop-home.php'">
            <h2>EcoXP</h2>
        </button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='participants-desktop-profile.php'"><img
                    src="images/profile.png" alt="Profile Logo"></button>
            <button class="icon-btn"><img src="images/notif.png" alt="Notification Logo"></button>
            <button class="icon-btn"><img src="images/setting.png" alt="Setting Logo"></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="participant-icon-container">
            <button class="icon-btn" onclick="window.location.href='participants-desktop-home.php'"><img
                    src="images/home.png" alt="Home"></button>
            <button class="icon-btn"><img src="images/challanges.png" alt="Challenges"></button>
            <div id="log-icon-box">
                <button class="icon-btn" onclick="window.location.href='participants-desktop-logaction.php'"><img
                        src="images/scan.png" alt="Scan"></button>
            </div>
            <button class="icon-btn" onclick="window.location.href='participants-desktop-rewards.php'"><img
                    src="images/tag.png" alt="Rewards"></button>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>
    <div class="main-content">
        <div class="attendance-btn-wrapper">
            <button class="attendance-btn" onclick="window.location.href='participants-desktop-otp.php'">Sign Up for
                Attendance</button>
        </div>
        <div class="log-action-container">

            <div class="text-box">
                Log Action
            </div>

            <select class="log-select">
                <option>Select Challenge</option>
                <option>Recycle Plastic</option>
                <option>Bring Reusable Bottle</option>
                <option>Public Transport</option>
            </select>

            <div class="upload-box">
                <form action="challenges-upload.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="upload_file" required>

                </form>

            </div>

            <textarea class="log-notes" placeholder="Add Notes (Optional)"></textarea>

            <div class="submit-container">
                <button class="submit-btn">Submit For Review</button>
            </div>
        </div>

    </div>

</body>

</html>