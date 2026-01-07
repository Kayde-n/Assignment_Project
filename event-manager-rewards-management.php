<?php
include("session.php");
include("Database.php");

$active_category = $_GET['category'] ?? 'All Rewards';
$result = null;

if ($active_category === 'All Rewards') {
    $sql = "SELECT rewards_id, reward_name, description, points_required FROM rewards";
    $result = mysqli_query($database, $sql);
} elseif ($active_category === 'Physical Rewards') {
    $sql = "SELECT rewards_id, reward_name, description, points_required FROM rewards WHERE category LIKE '%Physical%'";
    $result = mysqli_query($database, $sql);
} elseif ($active_category === 'Discount/Vouchers') {
    $sql = "SELECT rewards_id, reward_name, description, points_required FROM rewards WHERE category LIKE '%Vouchers%'";
    $result = mysqli_query($database, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rewards</title>
    <link rel="stylesheet" href="mobile.css">
    <link rel="stylesheet" href="participant-rewards-mobile.css">
    <link rel="stylesheet" href="event-manager-rewards-management.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <header class="top-bar">
        <div class="top-left">
            <button class="icon-btn no-hover topbar-icon" onclick="window.location.href='event-manager-home.php'" style="display:flex;align-items:center;gap:8px;">
                <svg width="56" height="56" viewBox="0 0 72 72" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.0278 55.17C17.9238 56.03 18.8788 56.833 19.8928 57.579C23.3048 55.1141 26.0849 51.8767 28.0058 48.1313C29.9267 44.386 30.9338 40.2392 30.9448 36.03C30.9448 27.216 26.5978 19.398 19.8748 14.478C18.8713 15.2154 17.9201 16.0213 17.0278 16.89C20.2462 18.9439 22.8981 21.7722 24.7408 25.1159C26.5835 28.4597 27.5583 32.2122 27.5758 36.03C27.5758 44.016 23.3968 51.042 17.0278 55.17Z" fill="#53B757"/>
                    <path d="M57.0119 19.125C55.1822 23.1625 52.2267 26.5866 48.4997 28.9864C44.7728 31.3863 40.4326 32.6601 35.9999 32.655C31.5676 32.6595 27.2281 31.3854 23.5018 28.9856C19.7754 26.5858 16.8203 23.1621 14.9909 19.125C14.1119 20.205 13.3199 21.366 12.6299 22.578C15.0031 26.6727 18.4119 30.0707 22.5141 32.4309C26.6162 34.7911 31.2672 36.0303 35.9999 36.024C40.7325 36.0303 45.3835 34.7911 49.4857 32.4309C53.5878 30.0707 56.9967 26.6727 59.3699 22.578C58.6743 21.3678 57.886 20.2133 57.0119 19.125ZM30.9449 62.427C31.2809 47.787 43.0769 36.027 57.5669 36.027C59.3783 36.0212 61.1852 36.2063 62.9579 36.579C62.929 37.7587 62.8227 38.9352 62.6399 40.101C60.8168 39.6325 58.9422 39.3947 57.0599 39.393C54.0149 39.4167 51.005 40.0462 48.2057 41.2447C45.4064 42.4432 42.8736 44.1869 40.7549 46.374C38.6374 48.5623 36.9773 51.1506 35.8714 53.9878C34.7655 56.8249 34.236 59.854 34.3139 62.898C33.1812 62.8209 32.0553 62.6635 30.9449 62.427Z" fill="#53B757"/>
                </svg>
                <h2 class="top-title">EcoXP</h2>
            </button>
        </div>
        <div class="top-right">
            <a href="profile.php" class="topbar-icon"><button class="icon-btn"><i data-lucide="user-round"></i></button></a>
        </div>
    </header>

    <nav class="side-bar">
        <div class="participant-icon-container">
            <a href="event-manager-home.php" class="icon-link sidebar-icon"><button class="icon-btn"><i data-lucide="house"></i></button></a>
            <a href="manage-challenges.php" class="icon-link sidebar-icon"><button class="icon-btn"><i data-lucide="trophy"></i></button></a>
            <a href="manager-actions.php" class="icon-link sidebar-icon"><button class="icon-btn"><i data-lucide="scan-line"></i></button></a>
            <a href="event-manager-rewards-management.php" class="icon-link active sidebar-icon"><button class="icon-btn"><i data-lucide="badge-percent"></i></button></a>
            <a href="profile.php" class="icon-link sidebar-icon"><button class="icon-btn"><i data-lucide="user-round"></i></button></a>
        </div>
        <a class="icon-link sidebar-icon" href="logout.php" id="logout"><button class="icon-btn"><i data-lucide="log-out"></i></button></a>
    </nav>

    <main class="main-content">
        <div class="page-header">
            <h1 class="header-title">Rewards</h1>
        </div>

        <div class="reward-categories">
            <form method="GET" style="display:flex; gap:12px; align-items:center;">
                <button type="submit" name="category" value="All Rewards" class="category-pill <?php echo ($active_category === 'All Rewards') ? 'active' : ''; ?>">All Rewards</button>
                <button type="submit" name="category" value="Discount/Vouchers" class="category-pill <?php echo ($active_category === 'Discount/Vouchers') ? 'active' : ''; ?>">Vouchers</button>
                <button type="submit" name="category" value="Physical Rewards" class="category-pill <?php echo ($active_category === 'Physical Rewards') ? 'active' : ''; ?>">Physical</button>
            </form>

            <div class="add-btn-container">
                <button class="add-btn" onclick="window.location.href='event-manager-new-reward-post.php'">
                    <img src="images/add.png" alt="Add">
                </button>
                <span class="tooltip">Add Reward</span>
            </div>
        </div>

        <p class="result-count" style="margin-left: 16px;">
            <?php echo ($result) ? mysqli_num_rows($result) : 0; ?> results found
        </p>

        <div class="rewards-container">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="rewards-card">
                        <button class="reward-card-trash-icon" onclick="deleteReward(<?php echo $row['rewards_id']; ?>)">
                            <img src="images/trash.png" alt="Delete">
                        </button>

                        <img src="images/voucher.png" alt="Reward" class="rewards-image">
                        
                        <div class="rewards-content">
                            <h3 class="rewards-title"><?php echo $row['reward_name']; ?></h3>
                            <p class="rewards-text"><?php echo $row['points_required']; ?>GP</p>
                            
                            <div class="rewards-details">
                                <button class="rewards-btn" onclick="window.location.href='edit-reward.php?id=<?php echo $row['rewards_id']; ?>'">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="padding-left: 16px;">No rewards available.</p>
            <?php endif; ?>
        </div>
    </main>

    <script>
        function deleteReward(rewards_id) {
            if (confirm("Are you sure?")) window.location.href = `delete_reward.php?rewards_id=${rewards_id}`;
        }
        lucide.createIcons();
    </script>
</body>
</html>