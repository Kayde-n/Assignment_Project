<?php
    include("session.php");

    if (!isset($_GET['id'])) {
        echo "<script>alert('Invalid profile ID.'); window.location.href='participants-desktop-home.php';</script>";
        exit();
    }

    $profile_id = $_GET['id'];

    /* PROFILE INFO */
    $sql = "SELECT participants.participants_id,participants.TP_no,`user`.name,`user`.email FROM participants
            JOIN `user` ON participants.user_id = `user`.user_id WHERE participants.participants_id = $profile_id";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $profile = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Profile not found'); window.location.href='participants-desktop-home.php';</script>";
        exit();
    }

    /* TOTAL POINTS */
    $points_sql = "SELECT IFNULL(SUM(points), 0) AS total_points FROM participants_challenges WHERE participants_id = $profile_id";

    $points_result = mysqli_query($con, $points_sql);
    $points_row = mysqli_fetch_assoc($points_result);
    $total_points = $points_row['total_points'];

    /* RANKING */
    $ranking_sql = "SELECT COUNT(*) + 1 AS ranking FROM ( SELECT participants_id, SUM(points) AS total FROM participants_challenges GROUP BY participants_id HAVING total > (SELECT IFNULL(SUM(points), 0) FROM participants_challenges WHERE participants_id = $profile_id)) ranked";

    $ranking_result = mysqli_query($con, $ranking_sql);
    $ranking_row = mysqli_fetch_assoc($ranking_result);
    $ranking = $ranking_row['ranking'];
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
            <button class="icon-btn" onclick="window.location.href='participants-desktop-profile.php'"><i data-lucide="user-round" class="icon-btn"></i></button>
            <button class="icon-btn"><i data-lucide="bell" class="icon-btn"></i></button>
            <button class="icon-btn"><i data-lucide="bolt" class="icon-btn"></i></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="participant-icon-container">
            <div id="home-icon-box">
                <button class="icon-btn" onclick="window.location.href='participants-desktop-home.php'"><i data-lucide="house" class="icon-btn"></i></button>
            </div>
            <button class="icon-btn"><i data-lucide="trophy" class="icon-btn"></i></button>
            <button class="icon-btn" onclick="window.location.href='participants-desktop-logaction.php'"><i data-lucide="scan-line" class="icon-btn"></i></button>
            <button class="icon-btn" onclick="window.location.href='participants-desktop-rewards.php'"><i data-lucide="badge-percent" class="icon-btn"></i></button>
            <button class="icon-btn" id="logout"><i data-lucide="log-out" class="icon-btn"></i></button>
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
                <p class = 'profile-name'><?php echo htmlspecialchars($profile['name']);?></p>
                <p class="profile-education"><?php echo htmlspecialchars($profile['TP_no']);?></p>
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
                    <a href="participants-desktop-challenges.php">
                        <div class="left">
                            <i data-lucide="trophy"></i> Challenges
                        </div>
                        <i data-lucide="chevron-right"></i>
                    </a>
                </li>
                <li>
                    <a href="participants-desktop-econews.php">
                        <div class="left">
                            <i data-lucide="newspaper"></i> Eco News Feed
                        </div>
                        <i data-lucide="chevron-right"></i>
                    </a>
                </li>
                <li>
                    <a href="participants-desktop-rewards.php">
                        <div class="left">
                            <i data-lucide="badge-percent"></i> Rewards
                        </div>
                        <i data-lucide="chevron-right"></i>
                    </a>
                </li>
                <li>
                    <a href="participants-desktop-impact.php">
                        <div class="left">
                            <i data-lucide="leaf"></i> Your Impact
                        </div>
                        <i data-lucide="chevron-right"></i>
                    </a>
                </li>
                <li>
                    <a href="participants-desktop-leaderboard.php">
                        <div class="left">
                            <i data-lucide="crown"></i> Leaderboard
                        </div>
                        <i data-lucide="chevron-right"></i>
                    </a>
                </li>
                <li>
                    <a href="participants-desktop-help.php">
                        <div class="left">
                            <i data-lucide="help-circle"></i> Help & FAQ
                        </div>
                        <i data-lucide="chevron-right"></i>
                    </a>
                </li>
                <li>
                    <a href="participants-desktop-settings.php">
                        <div class="left">
                            <i data-lucide="bolt"></i> Settings
                        </div>
                        <i data-lucide="chevron-right"></i>
                    </a>
                </li>
            </ul>
        </div>

    </div>

        <script src="https://unpkg.com/lucide@latest"></script>
        <script>
            lucide.createIcons();
        </script>

    </body>

    </html>

<!-- When linking to the profile page, pass the ID:

<a href="participants-desktop-profile.php?id=<?php echo $participants_id; ?>">
    View Profile
</a>

-->