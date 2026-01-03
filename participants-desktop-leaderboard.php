<?php
include("session.php");
include("database.php");
$participant_id = $_SESSION['user_role_id'];

$sql_query = "SELECT 
                u.profile_picture_path,
                u.user_full_name,
                COALESCE(SUM(c.points_reward), 0) AS total_eco_points
                FROM user u
                LEFT JOIN participants p 
                    ON u.user_id = p.user_id
                LEFT JOIN participants_challenges pc 
                    ON p.participants_id = pc.participants_id
                LEFT JOIN challenges c 
                    ON pc.challenges_id = c.challenges_id
                ORDER BY total_eco_points DESC;";
$result = mysqli_query($database, $sql_query);

if (!$result) {
    die("Database query failed: " . mysqli_error($database));
}



$leaderstats = [];

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Insufficient leaderboard data found.'); window.location.href = 'participants-desktop-home.php'; </script>";
    exit();
}
while ($row = mysqli_fetch_assoc($result)) {
    $leaderstats[$row['user_full_name']] = $row['total_eco_points'];
    $images[] = $row['profile_picture_path'];
}
$empty_space = 21 - count($leaderstats);
while (count($leaderstats) < $empty_space) {
    $leaderstats['Spot Open ' . (count($leaderstats) + 1)] = 0;
    $images[] = 'images/profile.png';
}

$topThree = array_slice($leaderstats, 0, 3, true);

$topThreeArrays = [];

foreach ($topThree as $name => $points) {
    $topThreeArrays[] = [
        'user_full_name' => $name,
        'total_eco_points' => $points
    ]; //convert to array within an array 

}

echo "<pre>";
print ($empty_space);
print_r($leaderstats);
print_r($topThreeArrays);
print_r($images);
echo "</pre>";

?>
<!DOCTYPE html>
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

        <div class="leaderboard-banner">

            <!-- Title should be here -->
            <div class="leaderboard-title">
                <div class="text-box">leaderboard</div>
            </div>

            <div class="podium-wrapper">

                <!-- 2nd Place -->
                <div class="podium second">
                    <div class="profile-pic"><img src="<?php echo $images[1]; ?>" alt="Profile Logo"></div>
                    <div class="podium-info">
                        <p class="name-box">
                            <?php echo $topThreeArrays[1]['user_full_name']; ?>
                        </p>
                        <p class="points"><?php echo $topThreeArrays[1]['total_eco_points']; ?></p>
                    </div>
                </div>

                <!-- 1st Place -->
                <div class="podium first">
                    <div class="profile-pic"><img src="<?php echo $images[0]; ?>" alt="Profile Logo"></div>
                    <div class="podium-info">
                        <p class="name-box"><?php echo $topThreeArrays[0]['user_full_name']; ?></p>
                        <p class="points"><?php echo $topThreeArrays[0]['total_eco_points']; ?></p>
                    </div>
                </div>

                <!-- 3rd Place -->
                <div class="podium third">
                    <div class="profile-pic"><img src="<?php echo $images[2]; ?>" alt="Profile Logo"></div>
                    <div class="podium-info">
                        <p class="name-box"><?php echo $topThreeArrays[2]['user_full_name']; ?></p>
                        <p class="points"><?php echo $topThreeArrays[2]['total_eco_points']; ?></p>
                    </div>
                </div>

            </div>

        </div>
        <div class="leaderboard-list-box">
            <?php
            ;

            $rank = 4; // starting from 4th place
            $counter = 0;

            foreach ($leaderstats as $name => $points) {
                if ($counter < 3) {
                    $counter++;
                    continue;
                }
                echo '
                    <div class="rank-row">
                    <div class="left">
                        <div class="small-pic">
                        <img src="' . $images[3] . '" alt="Profile Logo">
                    </div>
                    <p class="rank-name">' . $rank . '. ' . htmlspecialchars($name) . '</p>
                </div>
                <p class="rank-points">' . (int) $points . '</p>
            </div>
        ';

                $rank++;
            }
            ?>

        </div>

</body>

</html>