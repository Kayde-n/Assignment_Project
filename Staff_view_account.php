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
    <div class="mobile-container">
        <!-- Header -->
        <header class="header">
            <button class="back-btn">←</button>
        </header>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Profile Section -->
            <div class="profile-section">
                <div class="profile-image">
                    <span class="image-icon">🖼️</span>
                </div>
                <h2 class="profile-name">Ivan</h2>
                <p class="profile-id">TP012345</p>
                <p class="profile-email">Email@email.com</p>
            </div>
            
            <!-- Stats Section -->
            <div class="stats-section">
                <div class="stat-item">
                    <span class="stat-label">Points</span>
                    <span class="stat-value">10000</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Ranking</span>
                    <span class="stat-value">#9</span>
                </div>
            </div>
            
            <!-- Activity Log Section -->
            <div class="activity-section">
                <h3>Activity Log</h3>
                
                <div class="activity-list">
                    <div class="activity-item">
                        <span class="activity-text">Redeemed 10% McDonald's Voucher</span>
                        <span class="activity-points">-20886P</span>
                    </div>
                    
                    <div class="activity-item">
                        <span class="activity-text">Redeemed 10% KFC Voucher</span>
                        <span class="activity-points">-30886P</span>
                    </div>
                    
                    <div class="activity-item">
                        <span class="activity-text">Redeemed 10% Jolibee Voucher</span>
                        <span class="activity-points">-40886P</span>
                    </div>
                    
                    <div class="activity-item">
                        <span class="activity-text">Redeemed 10% Subway Voucher</span>
                        <span class="activity-points">-20886P</span>
                    </div>
                    
                    <div class="activity-item">
                        <span class="activity-text">Redeemed 10% McDonald's Voucher</span>
                        <span class="activity-points">-20886P</span>
                    </div>
                </div>
            </div>
            
            <!-- Suspend Account Button -->
            <div class="action-section">
                <button class="suspend-btn">Suspend Account</button>
            </div>
        </main>
        
        <!-- Bottom Navigation -->
        <nav class="bottom-nav">
            <button class="nav-btn">
                <span class="icon">🏠</span>
            </button>
            <button class="nav-btn">
                <span class="icon">⚙️</span>
            </button>
            <button class="nav-btn">
                <span class="icon">📄</span>
            </button>
            <button class="nav-btn active">
                <span class="icon">👥</span>
            </button>
            <button class="nav-btn">
                <span class="icon">👤</span>
            </button>
        </nav>
    </div>
</body>
</html>