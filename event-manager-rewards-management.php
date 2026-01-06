<?php
include("session.php");
include("database.php");

// Fetch all rewards from database
$sql = "SELECT rewards_id, reward_name, description, points_required, quantity FROM rewards";
$result = mysqli_query($database, $sql);

$sql_query_category = "SELECT ca"
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rewards</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="event-manager.css">
    <link rel="stylesheet" href="event-manager-rewards-management.css">

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
    <div class="main-content">

        <div class="page-header">
            <div class="title-box"><h1>Rewards</h1></div>
        </div>

        <div class="reward-categories">
            <button class="category-btn active">All Rewards</button>
            <button class="category-btn" onclick="filterRewards('Discount/Vouchers')">Discount/Vouchers</button>
            <button class="category-btn" onclick="filterRewards('Physical Rewards')">Physical Rewards</button>
            <div class="add-btn-container">
                <button class="add-btn" onclick="window.location.href='event-manager-new-reward-post.php'"><img src="images/add.png" alt="add rewards"></button>
                <span class="tooltip">Add rewards</span>
            </div>
        </div>

        <p class="result-count"><?php echo mysqli_num_rows($result); ?> results</p>
        <div class="reward-cards">

            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="reward-card">
                        <div class="reward-card-trash-icon">
                            <img src="images/trash.png" alt="Edit" title="Edit reward">
                            <span class="tooltip">Delete Rewards</span>
                        </div>
                        <div class="reward-img"><img src="images/voucher.png"></div>
                        <div class="reward-info">
                            <h3><?php echo $row['reward_name']; ?></h3>
                            <p class="reward-points"><?php echo $row['points_required']; ?>GP</p>
                            <button class="unavailible-btn" disabled >Unavailible</button>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p>No rewards available at the moment.</p>';
            }
            ?>

        </div>
    </div>
</body>

</html>