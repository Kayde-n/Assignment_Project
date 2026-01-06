<?php
include("session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Reward Post</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="event-manager.css">
    <link rel="stylesheet" href="event-manager-new-reward-post.css">
</head>
<body>
    <div class="top-bar">
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='participants-desktop-home.php'">
            <h2>EcoXP</h2>
        </button>
        <div class="default-icon-container">
            <button class="icon-btn"><img
                    src="images/profile.png" alt="Profile Logo"></button>
            <button class="icon-btn"><img src="images/notif.png" alt="Notification Logo"></button>
            <button class="icon-btn"><img src="images/setting.png" alt="Setting Logo"></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="event-manager-icon-container">
            <button class="icon-btn" onclick="window.location.href='event-manager-home.php'"><img src="images/home.png" alt="Home"></button>
            <button class="icon-btn" onclick="window.location.href='event-manager-calendar.php'"><img src="images/calendar.png" alt="Calendar"></button>
            <button class="icon-btn" onclick="window.location.href='event-manager-news.php'"><img src="images/newspaper.png" alt="News"></button>
            <div id="reward-icon-box">
                <button class="icon-btn" onclick="window.location.href='event-manager-rewards-management.php'"><img
                        src="images/tag.png" alt="Rewards"></button>
            </div>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>   
    <div class="text-box" onclick="window.location.href='participants-desktop-econews.php'"
        style="cursor: pointer;">
        What's New?
    </div>

            <?php while ($row = mysqli_fetch_assoc($result_news)) { ?>

            <div class="content-container"
                onclick="window.location.href='participants-desktop-newsdetails.php?id=<?php echo $row['eco_news_id']; ?>'">

                <button class="image-holder">
                    <img src="images/<?php echo $row['image_path']; ?>" alt="News Image">
                </button>

                <button class="content-text-box">
                    <div class="text-inner">
                        <h4 class="category-box">Environment</h4>

                        <h3 class="title-box">
                            <?php echo htmlspecialchars($row['title']); ?>
                        </h3>

                        <h5 class="description-box">
                            <?php echo substr(strip_tags($row['description']), 0, 200); ?>...
                        </h5>
                    </div>
                </button>
                
                <button class="next-btn">
                    <img src="images/next.png" alt="Next Icon">
                </button>

            </div>

        <?php } ?>