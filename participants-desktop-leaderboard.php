!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>leaderboard</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="participant.css">
    <link rel="stylesheet" href="participants-leaderboard-desktop.css">
 
</head>
<body>
    <div class="top-bar">
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover"><h2>EcoXP</h2></button>
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
            <button class="icon-btn"><img src="images/scan.png" alt="Scan"></button>
            <button class="icon-btn"><img src="images/tag.png" alt="Rewards"></button>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>
    <div class="main-content">

        <div class="leaderboard-banner">

            <!-- Title should be here -->
            <div class="leaderboard-title">
                <div class="text-box">leaderboard</div>
            </div>

            <div class="podium-wrapper">

                <!-- 2nd Place -->
                <div class="podium second">
                    <div class="profile-pic"><img src="images/profile.png" alt="Profile Logo"></div>
                    <div class="podium-info">
                        <p class="name-box">Jackson</p>
                        <p class="points">18000</p>
                    </div>
                </div>

                <!-- 1st Place -->
                <div class="podium first">
                    <div class="profile-pic"><img src="images/profile.png" alt="Profile Logo"></div>
                    <div class="podium-info">
                        <p class="name-box">Eiden</p>
                        <p class="points">20000</p>
                    </div>
                </div>

                <!-- 3rd Place -->
                <div class="podium third">
                    <div class="profile-pic"><img src="images/profile.png" alt="Profile Logo"></div>
                    <div class="podium-info">
                        <p class="name-box">Emma</p>
                        <p class="points">17999</p>
                    </div>
                </div>

            </div>
            
        </div>
        <div class="leaderboard-list-box">
            <?php
                // SAMPLE DATA — you can replace this with database results.
                $players = [
                    ["name" => "Sebastian", "points" => 12000],
                    ["name" => "Natalie", "points" => 11700],
                    ["name" => "Jason", "points" => 11300],
                    ["name" => "Hiro", "points" => 11100],
                    ["name" => "Aisha", "points" => 10900],
                    ["name" => "Daniel", "points" => 10800],
                    ["name" => "Sofia", "points" => 10500],
                    ["name" => "Louis", "points" => 9900],
                    ["name" => "Ryan", "points" => 9700],
                    ["name" => "Bella", "points" => 9500],
                    ["name" => "Mia", "points" => 9400],
                    ["name" => "Oliver", "points" => 9200],
                    ["name" => "Chloe", "points" => 9000],
                    ["name" => "Felix", "points" => 8800],
                    ["name" => "Zara", "points" => 8600],
                    ["name" => "Evan", "points" => 8300],
                    ["name" => "Harper", "points" => 8200]
                ];

                $rank = 4; // starting from 4th place

                foreach ($players as $p) {
                    echo '
                        <div class="rank-row">
                            <div class="left">
                                <div class="small-pic"><img src="images/profile.png" alt="Profile Logo"></div>
                                <p class="rank-name">'. $rank .'. '. $p["name"] .'</p>
                            </div>
                            <p class="rank-points">'. $p["points"] .'</p>
                        </div>
                    ';
                    $rank++;
                }
            ?>
        </div>

    </div>

</body>
</html>