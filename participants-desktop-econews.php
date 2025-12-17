<?php
    include("session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco News Page</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="participant.css">
    <link rel="stylesheet" href="participants-econews-desktop.css">
 
</head>
<body>
    <div class="top-bar">
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='participants-desktop-home.php'"><h2>EcoXP</h2></button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='participants-desktop-profile.php'"><img src="images/profile.png" alt="Profile Logo"></button>
            <button class="icon-btn"><img src="images/notif.png" alt="Notification Logo"></button>
            <button class="icon-btn"><img src="images/setting.png" alt="Setting Logo"></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="participant-icon-container">
            <div id="home-icon-box">
                <button class="icon-btn" onclick="window.location.href='participants-desktop-home.php'"><img src="images/home.png" alt="Home"></button>
            </div>
            <button class="icon-btn"><img src="images/challanges.png" alt="Challenges"></button>
            <button class="icon-btn" onclick="window.location.href='participants-desktop-logaction.php'"><img src="images/scan.png" alt="Scan"></button>
            <button class="icon-btn"><img src="images/tag.png" alt="Rewards"></button>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>
    <div class="main-content">
        <div class="search-box">
            <input type="text" placeholder="Search..." id="search-input">
            <button id="search-btn">🔍</button>
        </div>
        <div class="text-box">
            What News?
        </div>
        <button class="content-holder" onclick="window.location.href='participants-desktop-newsdetails.php'">
            <div class="category-box">Environment</div>
            <div class="content-image">
                <img src="images/sample-image.png" alt="">
            </div>
            <div class="content-text-box">
                <h3 class="content-text-title">Top 5 Green Tips for reducing e-waste.</h3>
                <p class="content-text-description">TCheck out the most upvoted post this week from community — it’s sparked a real conversation around how we deal with our old gadgets. In our tech-driven world, devices like phones, laptops, and chargers stack up quickly—and when they’re discarded improperly, they become toxic e-waste that hurts both the environment and our health. Those same devices also contain materials like gold and copper that, if recycled responsibly, could be reused instead of wasted. By being smarter with how we use and dispose of electronics—</p>
            </div>
        </button>
        <button class="content-holder">
            <div class="category-box">Environment</div>
            <div class="content-image">
                <img src="images/sample-image.png" alt="">
            </div>
            <div class="content-text-box">
                <h3 class="content-text-title">Top 5 Green Tips for reducing e-waste.</h3>
                <p class="content-text-description">TCheck out the most upvoted post this week from community — it’s sparked a real conversation around how we deal with our old gadgets. In our tech-driven world, devices like phones, laptops, and chargers stack up quickly—and when they’re discarded improperly, they become toxic e-waste that hurts both the environment and our health. Those same devices also contain materials like gold and copper that, if recycled responsibly, could be reused instead of wasted. By being smarter with how we use and dispose of electronics—</p>
            </div>
        </button>
    </div>

</body>
</html>