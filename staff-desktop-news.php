<?php
// Example PHP News Feed
$news_list = [
    [
        'title' => 'Top 5 Green Tips for reducing e-waste.',
        'image' => 'images/placeholder-image.png',
        'content' => "Check out the most upvoted post this week from community — it's sparked a real conversation around how we deal with our old gadgets. In our tech-driven world, devices like phones, laptops, and chargers stack up quickly—and when they're discarded improperly, they become toxic e-waste..."
    ],
    [
        'title' => 'How to compost at home effectively.',
        'image' => 'images/placeholder-image.png',
        'content' => "Composting is an easy way to reduce your household waste and create nutrient-rich soil. Learn the basics of composting and tips to make it successful even in small apartments..."
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco News Feed</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="staff.css">
    <link rel="stylesheet" href="staff-news-desktop.css">
</head>
<body>
    <div class="top-bar">
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='staff-desktop-home.php'"><h2>EcoXP</h2></button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='staff-desktop-profile.php'"><img src="images/profile.png" alt="Profile"></button>
            <button class="icon-btn"><img src="images/notif.png" alt="Notification"></button>
            <button class="icon-btn"><img src="images/setting.png" alt="Setting"></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="staff-icon-container">
            <button class="icon-btn" onclick="window.location.href='staff-desktop-home.php'"><img src="images/home.png" alt="Home"></button>
            <button class="icon-btn" onclick="window.location.href='staff-desktop-verification.php'"><img src="images/verification.png" alt="Verification"></button>
            <div id="news-icon">
                <button class="icon-btn" onclick="window.location.href='staff-desktop-news.php'"><img src="images/newspaper.png" alt="News"></button>
            </div>
            <div id="account-icon">
                <button class="icon-btn" onclick="window.location.href='staff-desktop-account.php'"><img src="images/account-management.png" alt="Account"></button>
            </div>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>

    <div class="main-content">
        <div class="text-box">What News?</div>

        <div class="news-header">
            <button class="add-btn" onclick="window.location.href='staff-desktop-addnews.php'">+</button>
            <div class="search-container">
                <input type="text" placeholder="Search Here">
            </div>
        </div>

        <?php foreach ($news_list as $news): ?>
        <div class="news-card">
            <!-- havent add any function for delete -->
            <!-- use pop up message -->
            <button class="delete-btn"><img src="images/trash.png" alt="delete"></button>
            <div class="card-image-placeholder">
                <img src="<?= $news['image']; ?>" alt="News Image">
            </div>
            <div class="card-content">
                <div class="card-header">
                    <h3><?= $news['title']; ?></h3>
                </div>
                <p><?= $news['content']; ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
