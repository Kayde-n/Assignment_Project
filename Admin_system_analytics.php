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
            <h1>System Analytics</h1>
        </header>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Analytics Grid -->
            <div class="analytics-grid">
                <!-- Row 1 -->
                <div class="analytics-card">
                    <h3>System Performance</h3>
                    <div class="chart-placeholder line-chart">
                        <svg viewBox="0 0 100 50">
                            <polyline points="0,40 20,30 40,35 60,20 80,25 100,15" fill="none" stroke="#ccc" stroke-width="2"/>
                        </svg>
                    </div>
                </div>
                
                <div class="analytics-card">
                    <h3>Popular Challenges</h3>
                    <div class="image-placeholder">
                        <span class="icon">🖼️</span>
                    </div>
                </div>
                
                <!-- Row 2 -->
                <div class="analytics-card">
                    <h3>Admin's Permission</h3>
                    <div class="chart-placeholder donut-chart">
                        <svg viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="40" fill="none" stroke="#e0e0e0" stroke-width="20"/>
                            <circle cx="50" cy="50" r="40" fill="none" stroke="#4CAF50" stroke-width="20" stroke-dasharray="188.4 62.8" transform="rotate(-90 50 50)"/>
                        </svg>
                    </div>
                </div>
                
                <div class="analytics-card">
                    <h3>Green Points Analytics</h3>
                    <div class="chart-placeholder bar-chart">
                        <svg viewBox="0 0 100 60">
                            <rect x="5" y="30" width="10" height="30" fill="#4CAF50"/>
                            <rect x="20" y="20" width="10" height="40" fill="#4CAF50"/>
                            <rect x="35" y="35" width="10" height="25" fill="#4CAF50"/>
                            <rect x="50" y="15" width="10" height="45" fill="#4CAF50"/>
                            <rect x="65" y="25" width="10" height="35" fill="#4CAF50"/>
                            <rect x="80" y="40" width="10" height="20" fill="#4CAF50"/>
                        </svg>
                    </div>
                </div>
                
                <!-- Row 3 -->
                <div class="analytics-card">
                    <h3>System Performance</h3>
                    <div class="chart-placeholder line-chart">
                        <svg viewBox="0 0 100 50">
                            <polyline points="0,40 20,35 40,30 60,38 80,32 100,28" fill="none" stroke="#ccc" stroke-width="2"/>
                        </svg>
                    </div>
                </div>
                
                <div class="analytics-card">
                    <h3>Popular Challenges</h3>
                    <div class="image-placeholder">
                        <span class="icon">🖼️</span>
                    </div>
                </div>
                
                <!-- Row 4 -->
                <div class="analytics-card">
                    <h3>Admins Permission</h3>
                    <div class="chart-placeholder donut-chart">
                        <svg viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="40" fill="none" stroke="#e0e0e0" stroke-width="20"/>
                            <circle cx="50" cy="50" r="40" fill="none" stroke="#4CAF50" stroke-width="20" stroke-dasharray="188.4 62.8" transform="rotate(-90 50 50)"/>
                        </svg>
                    </div>
                </div>
                
                <div class="analytics-card">
                    <h3>Green Points Analytics</h3>
                    <div class="chart-placeholder bar-chart">
                        <svg viewBox="0 0 100 60">
                            <rect x="5" y="35" width="10" height="25" fill="#4CAF50"/>
                            <rect x="20" y="25" width="10" height="35" fill="#4CAF50"/>
                            <rect x="35" y="30" width="10" height="30" fill="#4CAF50"/>
                            <rect x="50" y="20" width="10" height="40" fill="#4CAF50"/>
                            <rect x="65" y="28" width="10" height="32" fill="#4CAF50"/>
                            <rect x="80" y="38" width="10" height="22" fill="#4CAF50"/>
                        </svg>
                    </div>
                </div>
            </div>
        </main>
        
        <!-- Bottom Navigation -->
        <nav class="bottom-nav">
            <button class="nav-btn">
                <span class="icon">🏠</span>
            </button>
            <button class="nav-btn active">
                <span class="icon">📊</span>
            </button>
            <button class="nav-btn">
                <span class="icon">📄</span>
            </button>
            <button class="nav-btn">
                <span class="icon">👥</span>
            </button>
            <button class="nav-btn">
                <span class="icon">👤</span>
            </button>
        </nav>
    </div>
</body>
</html>