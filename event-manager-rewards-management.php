<?php
include("session.php");
include("Database.php");

$active_category = $_GET['category'] ?? 'All Rewards';
$result = null;

if ($active_category === 'All Rewards') {

    $sql = "SELECT rewards_id, reward_name, description, points_required 
            FROM rewards";
    $result = mysqli_query($database, $sql);

} elseif ($active_category === 'Physical Rewards') {

    $sql = "SELECT rewards_id, reward_name, description, points_required 
            FROM rewards 
            WHERE category LIKE '%Physical%'";
    $result = mysqli_query($database, $sql);

} elseif ($active_category === 'Discount/Vouchers') {

    $sql = "SELECT rewards_id, reward_name, description, points_required 
            FROM rewards 
            WHERE category LIKE '%Vouchers%'";
    $result = mysqli_query($database, $sql);

}
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
            <form method="GET" style="display:flex; gap:12px;">
                <button type="submit" name="category" value="All Rewards"
                    class="category-btn <?php echo ($active_category === 'All Rewards') ? 'active' : ''; ?>">
                    All Rewards
                </button>

                <button type="submit" name="category" value="Discount/Vouchers"
                    class="category-btn <?php echo ($active_category === 'Discount/Vouchers') ? 'active' : ''; ?>">
                    Discount/Vouchers
                </button>

                <button type="submit" name="category" value="Physical Rewards"
                    class="category-btn <?php echo ($active_category === 'Physical Rewards') ? 'active' : ''; ?>">
                    Physical Rewards
                </button>
            </form>

            <div class="add-btn-container">
                <button class="add-btn" onclick="window.location.href='event-manager-new-reward-post.php'">
                    <img src="images/add.png" alt="add rewards">
                </button>
                <span class="tooltip">Add rewards</span>
            </div>
        </div>



        <p class="result-count">
            <?php echo ($result) ? mysqli_num_rows($result) : 0; ?> results
        </p>
            <div class="reward-container">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="reward-card">
                        <button class="reward-card-trash-icon" 
                                onclick="deleteReward(<?php echo $row['rewards_id']; ?>)" 
                                title="Delete reward">
                            <img src="images/trash.png" alt="Delete">
                            <span class="tooltip">Delete Rewards</span>
                        </button>
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
    <script>
        function deleteReward(rewards_id) {
            if (confirm("Are you sure you want to delete this reward?")) {
                window.location.href = `delete_reward.php?rewards_id=${rewards_id}`;
            }
        }
    </script>

</body>

</html>