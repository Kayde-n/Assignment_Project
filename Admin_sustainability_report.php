<?php
    include("session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <div class="container">
        <!-- Header Section -->
        <header>
            <h1>Sustainability Report</h1>
            <div class="date-selector">
                <label for="month-year">
                    <img src="Images/calendar-icon.png" alt="Calendar">
                </label>
                <select id="month-year" name="month-year">
                    <option value="november-2025" selected>November 2025</option>
                    <option value="october-2025">October 2025</option>
                    <option value="september-2025">September 2025</option>
                </select>
            </div>
        </header>

        <!-- Executive Summary Section -->
        <section class="executive-summary">
            <h2>Executive Summary</h2>
            <p>
                This month showed exceptional growth in sustainability initiatives, with community engagement increasing by significant environmental impact, though challenges in waste reduction remain a priority moving forward.
            </p>
        </section>

        <!-- Environmental Impact Section -->
        <section class="environmental-impact">
            <h2>Environmental Impact</h2>
            <div class="impact-grid">
                <div class="impact-card">
                    <div class="impact-value">2,450 kg</div>
                    <div class="impact-label">Carbon Offset</div>
                </div>
                <div class="impact-card">
                    <div class="impact-value">1,234</div>
                    <div class="impact-label">Trees Planted</div>
                </div>
                <div class="impact-card">
                    <div class="impact-value">890 kg</div>
                    <div class="impact-label">Items Recycled</div>
                </div>
                <div class="impact-card">
                    <div class="impact-value">567 liters</div>
                    <div class="impact-label">Water Conserved</div>
                </div>
            </div>
        </section>

        <!-- Participation Statistics Section -->
        <section class="participation-stats">
            <h2>Participation Statistics</h2>
            <div class="stat-item">
                <div class="stat-info">
                    <span class="stat-label">Active Users</span>
                    <span class="stat-badge positive">68%</span>
                </div>
                <div class="stat-bar">
                    <div class="stat-fill" style="width: 68%;"></div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-info">
                    <span class="stat-label">Green Points Awarded</span>
                    <span class="stat-badge positive">98634</span>
                </div>
                <div class="stat-bar">
                    <div class="stat-fill" style="width: 85%;"></div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-info">
                    <span class="stat-label">Events in Last Month</span>
                    <span class="stat-badge">432</span>
                </div>
                <div class="stat-bar">
                    <div class="stat-fill" style="width: 60%;"></div>
                </div>
            </div>
        </section>

        <!-- Download Button -->
        <div class="download-section">
            <button class="download-btn">
                <img src="Images/download-icon.png" alt="Download">
                Download Full Report as PDF
            </button>
        </div>

        <!-- Bottom Navigation -->
        <nav class="bottom-nav">
            <a href="home.html" class="nav-item">
                <img src="Images/home-icon.png" alt="Home">
                <span>Home</span>
            </a>
            <a href="stats.html" class="nav-item">
                <img src="Images/stats-icon.png" alt="Stats">
                <span>Stats</span>
            </a>
            <a href="leaderboard.html" class="nav-item active">
                <img src="Images/leaderboard-icon.png" alt="Leaderboard">
                <span>Leaderboard</span>
            </a>
            <a href="community.html" class="nav-item">
                <img src="Images/community-icon.png" alt="Community">
                <span>Community</span>
            </a>
            <a href="profile.html" class="nav-item">
                <img src="Images/profile-icon.png" alt="Profile">
                <span>Profile</span>
            </a>
        </nav>
    </div>

</body>
</html>
