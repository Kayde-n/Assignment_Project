<?php
//include("session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Analytics</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="admin-system-analytics.css">
</head>

<body>
    <div class="top-bar">
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='Admin_home.php'">
            <h2>EcoXP</h2>
        </button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='Admin_profile.php'"><img src="images/profile.png"
                    alt="Profile Logo"></button>
            <button class="icon-btn"><img src="images/notif.png" alt="Notification Logo"></button>
            <button class="icon-btn"><img src="images/setting.png" alt="Setting Logo"></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="admin-icon-container">
            <button class="icon-btn" onclick="window.location.href='Admin_home.php'"><img src="images/home.png"
                    alt="Home"></button>
            <div id="system-analytics-icon-box">
                <button class="icon-btn" onclick="window.location.href='Admin_system_analytics.php'"><img
                        src="images/system-analytics.png" alt="System Analytics"></button>
            </div>
            <button class="icon-btn" onclick="window.location.href='Admin_sustainability_report.php'"><img
                    src="images/sustainability-report.png" alt="Sustainability Report"></button>
            <button class="icon-btn" onclick="window.location.href='Admin_system_config.php'"><img
                    src="images/system-config.png" alt="System Config"></button>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="title-box">
                <h1>System Analytics</h1>
            </div>
        </div>

        <!-- Analytics Grid -->
        <div class="analytics-grid">
            <!-- Row 1 -->
            <div class="analytics-card">
                <h3 class="card-title">System Performance</h3>
                <div class="card-content">
                    <canvas id="performanceChart1"></canvas>
                </div>
            </div>

            <div class="analytics-card">
                <h3 class="card-title">Popular Challenges</h3>
                <div class="card-content card-image">
                    <div class="image-placeholder">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#90A4AE" stroke-width="1.5">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="analytics-card">
                <h3 class="card-title">Activity Distribution</h3>
                <div class="card-content">
                    <canvas id="activityChart1"></canvas>
                </div>
            </div>

            <div class="analytics-card">
                <h3 class="card-title">Green Points Awarded</h3>
                <div class="card-content">
                    <canvas id="pointsChart1"></canvas>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="analytics-card">
                <h3 class="card-title">System Performance</h3>
                <div class="card-content">
                    <canvas id="performanceChart2"></canvas>
                </div>
            </div>

            <div class="analytics-card">
                <h3 class="card-title">Popular Challenges</h3>
                <div class="card-content card-image">
                    <div class="image-placeholder">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#90A4AE" stroke-width="1.5">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="analytics-card">
                <h3 class="card-title">Activity Distribution</h3>
                <div class="card-content">
                    <canvas id="activityChart2"></canvas>
                </div>
            </div>

            <div class="analytics-card">
                <h3 class="card-title">Green Points Awarded</h3>
                <div class="card-content">
                    <canvas id="pointsChart2"></canvas>
                </div>
            </div>

            <!-- Row 3 -->
            <div class="analytics-card">
                <h3 class="card-title">System Performance</h3>
                <div class="card-content">
                    <canvas id="performanceChart3"></canvas>
                </div>
            </div>

            <div class="analytics-card">
                <h3 class="card-title">Popular Challenges</h3>
                <div class="card-content card-image">
                    <div class="image-placeholder">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#90A4AE" stroke-width="1.5">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="analytics-card">
                <h3 class="card-title">Activity Distribution</h3>
                <div class="card-content">
                    <canvas id="activityChart3"></canvas>
                </div>
            </div>

            <div class="analytics-card">
                <h3 class="card-title">Green Points Awarded</h3>
                <div class="card-content">
                    <canvas id="pointsChart3"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script src="admin-system-analytics.js"></script>
</body>

</html>