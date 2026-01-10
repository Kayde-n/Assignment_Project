<?php
include("session.php");
include("Database.php");

if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid news ID'); window.location.href='participants-desktop-home.php';</script>";
    exit();
}

$news_id = intval($_GET['id']);

$sql = "SELECT eco_news_id, title, description, venue, organised_by, image_path
            FROM eco_news
            WHERE eco_news_id = $news_id";

$result = mysqli_query($database, $sql);

if (mysqli_num_rows($result) === 0) {
    echo "<script>alert('News not found'); window.location.href='participants-desktop-home.php';</script>";
    exit();
}

$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewsDetails</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="participant.css">
    <link rel="stylesheet" href="participants-newsdetails-desktop.css">

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
            <button class="icon-btn" onclick="window.location.href='participants-desktop-rewards.php'"><img
                    src="images/tag.png" alt="Rewards"></button>

        </div>
    </div>
    <div class="main-content">
        <div class="page-header">
            <div class="title-box"><h1>What's New?</h1></div>
        </div>

        <div class="news-image">
            <img src="images/<?php echo $row['image_path']; ?>" alt="sample image">
        </div>

        <div class="news-text-container">

            <h2 class="news-title">
                <?php
                echo $row['title'];
                ?><!-- title -->
            </h2>

            <p class="news-paragraph">
                <br>
                Organised by:
                <br>
                <?php
                echo $row['organised_by'];
                ?><!-- organised by-->
            </p>

            <p class="news-paragraph">
                Venue:
                <br>
                <?php
                echo $row['venue'];
                ?> <!--- venue --->
            </p>

            <p class="news-paragraph">
                Full description:
                <br>
                <?php
                echo $row['description'];
                ?> <!-- description -->
            </p>

            <div class="quote-box">
                <p>
                    “Ask yourself: ‘How long will this device truly serve me?’
                    Don’t just chase the newest model. A device that is well-built
                    with good core specifications will last longer.”
                </p>
            </div>

        </div>
    </div>

</body>

</html>