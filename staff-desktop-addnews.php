<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco News Feed</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="staff.css">
    <link rel="stylesheet" href="staff-addnews-desktop.css">
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
        <div class="text-box">
            Add News Feed
        </div>
            <form class="news-form">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" placeholder="Enter the title">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" placeholder="Enter the description" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="organiser">Organiser</label>
                    <input type="text" id="organiser" placeholder="Enter the organiser name">
                </div>

                <div class="form-group">
                    <label for="venue">Venue</label>
                    <input type="text" id="venue" placeholder="Enter the venue">
                </div>

                <div class="form-group">
                    <label for="image">Upload Image</label>
                    <input type="file" id="image">
                </div>

                <div class="form-actions">
                    <button type="submit" class="post-btn">Post</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>