<?php
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../../config/database.php";


if (!isset($_SESSION['mySession'])) {
    header("Location: ../../login.php");
    exit();
}

$profile_id = $_SESSION['mySession'];

$sql_profile_info = "SELECT user_full_name, profile_picture_path FROM user WHERE user_id = $profile_id";
$result = mysqli_query($database, $sql_profile_info);
$profile = mysqli_fetch_assoc($result);

if (!$profile) {
    echo "<script>alert('Profile not found'); window.location.href='admin_home.php';</script>";
    exit();
}

$avatarPath = $profile["profile_picture_path"];

if (!empty($_FILES['avatar']['name'])) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    if (!in_array($_FILES['avatar']['type'], $allowedTypes)) {
        echo "<script>alert('Invalid file type');</script>";
    } else {
        
        $uploadDir = __DIR__ . '/../../images/';
        
        $dbPath = 'images/' . time() . '_' . basename($_FILES['avatar']['name']);
        
        $targetPath = $uploadDir . basename($dbPath);

        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath)) {
            if (!empty($avatarPath)) {
                $oldFile = __DIR__ . '/../../' . $avatarPath;
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            $updatesql = "UPDATE user SET profile_picture_path = '$dbPath' WHERE user_id = $profile_id";
            mysqli_query($database, $updatesql);

            $avatarPath = $dbPath;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="../../global.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/admin-profile.css">
    <script src="https://unpkg.com/lucide@latest"></script>

</head>

<body>

    <div class="side-bar">
        <div class="admin-icon-container">
            <div id="home-icon-box">
                <button class="icon-btn" onclick="window.location.href='admin_home.php'">
                    <i data-lucide="home"></i>
                </button>
            </div>
            <button class="icon-btn" onclick="window.location.href='Admin_system_analytics.php'">
                <i data-lucide="bar-chart-3"></i>
            </button>
            <button class="icon-btn" onclick="window.location.href='Admin_sustainability_report.php'">
                <i data-lucide="file-text"></i>
            </button>
            <button class="icon-btn" onclick="window.location.href='Admin_system_config.php'">
                <i data-lucide="sliders"></i>
            </button>
            <button class="icon-btn" id="logout" onclick="logout_confirm()">
                <i data-lucide="log-out"></i>
            </button>
        </div>
    </div>

    <div class="top-bar">
        <img src="../../images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='Admin_home.php'">
            <h2>EcoXP</h2>
        </button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='Admin_profile.php'">
                <i data-lucide="user"></i>
            </button>
        </div>
    </div>

    <div class="main-content">
        <div class="profile-container">
            <div class="profile-pic">
                <form method="POST" enctype="multipart/form-data" id="uploadForm">
                    <label style="cursor: pointer;">
                        <?php if (!empty($avatarPath)): ?>
                            <img src="<?= '../../' . $avatarPath ?>" alt="Profile Picture">
                        <?php else: ?>
                            <img src="../../images/profile.png" alt="Default Profile Picture">
                        <?php endif; ?>
                        <input type="file" name="avatar" accept="image/*" hidden onchange="document.getElementById('uploadForm').submit()">
                    </label>
                </form>
            </div>
            <div class="profile-info">
                <p class="profile-name"><?php echo htmlspecialchars($profile['user_full_name']); ?></p>
            </div>
        </div>

        <div class="quick-access">
            <h3>Quick Access</h3>
            <ul>
                <li>
                    <a href="Admin_system_analytics.php">
                        <div class="left">
                            <i data-lucide="bar-chart-3" style="margin-right: 10px;"></i>
                            System Analytics
                        </div>
                        <i data-lucide="chevron-right"></i>
                    </a>
                </li>
                <li>
                    <a href="Admin_sustainability_report.php">
                        <div class="left">
                            <i data-lucide="file-text" style="margin-right: 10px;"></i>
                            Sustainability Report
                        </div>
                        <i data-lucide="chevron-right"></i>
                    </a>
                </li>
                <li>
                    <a href="account-management.php">
                        <div class="left">
                            <i data-lucide="users" style="margin-right: 10px;"></i>
                            Account Management
                        </div>
                        <i data-lucide="chevron-right"></i>
                    </a>
                </li>
                <li>
                    <a href="Admin_system_config.php">
                        <div class="left">
                            <i data-lucide="sliders" style="margin-right: 10px;"></i>
                            System Configuration
                        </div>
                        <i data-lucide="chevron-right"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        function logout_confirm() {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = "../../logout.php";
            }
        }
    </script>
</body>
</html>