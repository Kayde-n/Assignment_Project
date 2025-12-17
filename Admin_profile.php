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

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="icon">🏠</div>
        <div class="icon">📊</div>
        <div class="icon">📰</div>
        <div class="icon">👥</div>
        <div class="icon">⚙️</div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main">

        <!-- TOP BAR (hidden on mobile) -->
        <div class="topbar">
            <div class="icon">🔔</div>
            <div class="icon">⚙️</div>
            <div class="icon">☰</div>
        </div>

        <!-- MAIN CONTENT BOX -->
        <div class="content-area">

            <!-- PROFILE SECTION -->
            <div class="profile-header">
                <div class="profile-picture">🖼</div>
                <div class="profile-info">
                    <h2>Michael Jackson</h2>
                    <p>Admin</p>
                </div>
            </div>

            <!-- QUICK ACCESS -->
            <div class="quick-title">Quick Access</div>

            <div class="quick-list">
                <div class="quick-item">
                    System Analytics <span class="arrow">›</span>
                </div>
                <div class="quick-item">
                    Sustainability Report <span class="arrow">›</span>
                </div>
                <div class="quick-item">
                    Account Management <span class="arrow">›</span>
                </div>
                <div class="quick-item">
                    System Settings <span class="arrow">›</span>
                </div>
                <div class="quick-item">
                    Settings <span class="arrow">›</span>
                </div>
            </div>

        </div>
    </div>

</div>


</body>
</html>