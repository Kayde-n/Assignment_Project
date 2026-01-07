<?php
include("session.php");
include("database.php");
if (!isset($_SESSION['mySession'])) {
    echo "<script>alert('Invalid profile ID.'); window.location.href='participants-desktop-home.php';</script>";
    exit();
}

$profile_id = $_SESSION['mySession'];
$participant_id = $_SESSION['user_role_id'];

/* PROFILE INFO */
$sql_profile_info = "SELECT u.user_full_name,
                        u.profile_picture_path
                        FROM user u 
                        WHERE u.user_id = $profile_id";


$result = mysqli_query($database, $sql_profile_info);
$row = mysqli_fetch_assoc($result);
$profile = [];
if (mysqli_num_rows($result) > 0) {
    $profile = [
        "user_full_name" => $row['user_full_name'],
        "profile_picture_path" => $row['profile_picture_path']
    ];
} else {
    echo "<script>alert('Profile not found');</script>";
    exit();
}

/* TOTAL POINTS */
$points_sql = "SELECT COALESCE(SUM(c.points_reward), 0) AS total_eco_points,
                p.participants_id AS participant_id,
                COALESCE(SUM(r.points_required), 0) AS redeemed_points
                FROM participants p
                LEFT JOIN participants_challenges pc 
                    ON p.participants_id = pc.participants_id
                    AND pc.challenges_status = 'approved'
                LEFT JOIN challenges c 
                    ON pc.challenges_id = c.challenges_id
                LEFT JOIN reward_redemption rr
                    ON rr.participants_id = p.participants_id
                LEFT JOIN rewards r
                    ON rr.rewards_id = r.rewards_id
                    GROUP BY p.participants_id";



$points_result = mysqli_query($database, $points_sql);
while ($points_row = mysqli_fetch_assoc($points_result)) {
    $points_info[] = [
        'earned_points' => $points_row['total_eco_points'],
        'redeemed_points' => $points_row['redeemed_points'],
        'participant_id' => $points_row['participant_id']

    ];
}

foreach ($points_info as $p) {
    $total_points = $p['earned_points'] - $p['redeemed_points'];
    $user_total_points[] = [
        'participant_id' => $p['participant_id'],
        'total_points' => $total_points
    ];

}

echo "<pre>";
print_r($user_total_points);  // Displays the array contents
echo "</pre>";







/*RANKING */
usort($user_total_points, function ($a, $b) {
    return $b['total_points'] <=> $a['total_points'];
});


$rankCount = 1;
$ranking = 0;
foreach ($user_total_points as $rank) {
    if ($rank['participant_id'] == $participant_id) {
        $ranking = $rankCount;

    }
    $rankCount++;
}


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
            <button class="icon-btn" onclick="window.location.href='participants-desktop-rewards.php'"><img
                    src="images/tag.png" alt="Rewards"></button>
            <button class="icon-btn" id="logout" onclick="logout_confirm()">
                <script>
                    function logout_confirm() {
                        if (confirm("Are you sure you want to logout?")) {
                            window.location.href = "logout.php";
                        }
                    }
                </script>
                <img src="images/logout.png" alt="Logout">
            </button>
        </div>
    </div>
    <div class="main-content">
        <div class='text-box'>
            Profile
        </div>
        <div class="profile-container">
            <div class="profile-pic">
                <img src="<?php echo htmlspecialchars($profile['profile_picture_path']); ?>" alt="Profile Picture">
            </div>
            <div class="profile-info">
                <p class='profile-name'><?php echo htmlspecialchars($profile['user_full_name']); ?></p>

            </div>
        </div>
        <div class="stats-container">
            <div class="stat-box">
                <div class="stat-upper">Points</div>
                <div class="stat-lower"><?php echo $total_points; ?></div>
            </div>
            <button class="stat-box" onclick="window.location.href='participants-desktop-leaderboard.php'">
                <div class="stat-upper">Ranking</div>
                <div class="stat-lower"><?php echo $ranking; ?></div>
            </button>
        </div>
        <div class="quick-access">
            <h3>Quick Access</h3>
            <ul>
                <li>
                    <a href="participants-desktop-challenges-tab.php">
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
                    <a href="participants-desktop-leaderboard.php">
                        <div class="left">
                            <img src="images/leaderboard.png" alt="Leaderboard Icon"> Leaderboard
                        </div>
                        <img src="images/arrow.png" alt="Arrow Icon">
                    </a>
                </li>
                <li>
                    <a href="participants-desktop-F&Q.php">
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

<!-- When linking to the profile page, pass the ID:

<a href="participants-desktop-profile.php?id=<?php echo $participants_id; ?>">
    View Profile
</a>

-->