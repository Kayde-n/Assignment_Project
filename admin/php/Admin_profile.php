<?php
require_once __DIR__ . "/../../session.php";

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    echo "<script>
        alert('Access denied. Admin only.');
        window.location.href = '../../login.php';
    </script>";
    exit();
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
            <button class="icon-btn" id="logout" onclick="window.location.href='../../logout.php'">
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

        </div>
    </div>

    <div class="main-content">
        <div class="profile-container">
            <div class="profile-pic">
                <img src="../../images/profile.png" alt="Profile Picture">
            </div>
            <div class="profile-info">
                <p class="profile-name">Eiden Jackson</p>

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
    </script>
</body>

</html>