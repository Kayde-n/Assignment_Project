<?php
//include("session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="participant.css">
    <link rel="stylesheet" href="admin-profile-desktop.css">
</head>

<body>


    <!-- SIDEBAR -->
    <div class="side-bar">
        <div class="participant-icon-container">
            <div id="home-icon-box">
                <button class="icon-btn" onclick="window.location.href='participants-desktop-home.php'"><img
                        src="images/home.png" alt="Home"></button>
            </div>
            <button class="icon-btn"><img src="images/challanges.png" alt="Challenges"></button>
            <button class="icon-btn" onclick="window.location.href='participants-desktop-logaction.php'"><img
                    src="images/scan.png" alt="Scan"></button>
            <button class="icon-btn"><img src="images/tag.png" alt="Rewards"></button>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>



    <!-- TOP BAR (hidden on mobile) -->
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

    <!-- MAIN CONTENT BOX -->
    <div class="main-content">
        <div class='text-box'>
            Profile
        </div>
        <!-- PROFILE SECTION -->
        <div class="profile-container">
            <div class="profile-pic">
                <img src="images/profile.png" alt="Profile Picture">
            </div>
            <div class="profile-info">
                <p class="profile-name">Eiden Jackson</p>
                <p class="profile-role">Bachelor of Environmental Science</p>
            </div>
        </div>
    

    <!-- QUICK ACCESS -->
        <div class="quick-access">
            <h3>Quick Access</h3>
            <ul>
                <li>
                    <a href="Admin_system_anlytics.php">
                        <div class="left">
                            <img src="images/system-analytics.png" alt="Arrow Icon">System Analytics
                        </div>
                        <img src="images/arrow.png" alt="Arrow Icon">
                    </a>
                </li>
                <li>
                    <a href="Admin_sustainability_report.php">
                        <div class="left">
                            <img src="images/sustainability-report.png" alt="Arrow Icon">Sustainability Report
                        </div>
                        <img src="images/arrow.png" alt="Arrow Icon">
                    </a>
                </li>
                <li>
                    <a href="Staff_account_management.php">
                        <div class="left">
                            <img src="images/account-management.png" alt="Arrow Icon">System Analytics
                        </div>
                        <img src="images/arrow.png" alt="Arrow Icon">
                    </a>
                </li>
                <li>
                    <a href="Admin_system_config.php">
                        <div class="left">
                            <img src="images/system-config.png" alt="Arrow Icon">System Configuration
                        </div>
                        <img src="images/arrow.png" alt="Arrow Icon">
                    </a>
                </li>
            </ul>

        </div>
    </div>


</body>

</html>