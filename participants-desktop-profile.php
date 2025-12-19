<?php
include("session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="participant.css">
    <link rel="stylesheet" href="participants-profile-desktop.css">

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
    <div class="main-content">
        <div class='text-box'>
            Profile
        </div>
        <div class="profile-container">
            <div class="profile-pic">
                <img src="images/profile.png" alt="Profile Picture">
            </div>
            <div class="profile-info">
                <p class="profile-name">Eiden Jackson</p>
                <p class="profile-education">Bachelor of Environmental Science</p>
            </div>
        </div>
        <div class="stats-container">
            <div class="stat-box">
                <div class="stat-upper">Points</div>
                <div class="stat-lower">20000</div>
            </div>
            <button class="stat-box" onclick="window.location.href='participants-desktop-leaderboard.php'">
                <div class="stat-upper">Ranking</div>
                <div class="stat-lower">1</div>
            </button>
        </div>
        <div class="quick-access">
            <h3>Quick Access</h3>
            <ul>
                <li>
                    <a href="participants-desktop-challenges.php">
                        <div class="left">
                            <img src="images/challanges.png" alt="Challenges Icon"> Challenges
                        </div>
                        <img src="images/arrow.png" alt="Arrow Icon">
                    </a>
                </li>
                <li>
                    <a href="participants-desktop-econews.php">
                        <div class="left">
                            <img src="images/newspaper.png" alt="Eco News Feed Icon"> Eco News Feed
                        </div>
                        <img src="images/arrow.png" alt="Arrow Icon">
                    </a>
                </li>
                <li>
                    <a href="participants-desktop-rewards.php">
                        <div class="left">
                            <img src="images/tag.png" alt="Rewards Icon"> Rewards
                        </div>
                        <img src="images/arrow.png" alt="Arrow Icon">
                    </a>
                </li>
                <li>
                    <a href="participants-desktop-impact.php">
                        <div class="left">
                            <img src="images/eco.png" alt="Your Impact Icon"> Your Impact
                        </div>
                        <img src="images/arrow.png" alt="Arrow Icon">
                    </a>
                </li>
                <li>
                    <a href="participants-desktop-leaderboard.php">
                        <div class="left">
                            <img src="images/leaderboard.png" alt="Leaderboard Icon"> Leaderboard
                        </div>
                        <img src="images/arrow.png" alt="Arrow Icon">
                    </a>
                </li>
                <li>
                    <a href="participants-desktop-help.php">
                        <div class="left">
                            <img src="images/help.png" alt="Help & FAQ Icon"> Help & FAQ
                        </div>
                        <img src="images/arrow.png" alt="Arrow Icon">
                    </a>
                </li>
                <li>
                    <a href="participants-desktop-settings.php">
                        <div class="left">
                            <img src="images/setting.png" alt="Settings Icon"> Settings
                        </div>
                        <img src="images/arrow.png" alt="Arrow Icon">
                    </a>
                </li>
            </ul>
        </div>

    </div>

</body>

</html>