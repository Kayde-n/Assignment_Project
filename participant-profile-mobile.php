<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant Home Mobile</title>
    <link rel="stylesheet" href="mobile.css">
    <link rel="stylesheet" href="participant-profile-mobile.css">    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

    <!-- navigation bar -->
    <nav class="bottom-nav">
        <a href="participant-home-mobile.php" class="nav-item">
            <i data-lucide="house" class="icon-btn"></i>
        </a>
        <a href="participant-challenges-mobile.php" class="nav-item">
            <i data-lucide="trophy" class="icon-btn"></i>
        </a>
        <a href="participant-action-submit-mobile.php" class="nav-item">
            <i data-lucide="scan-line" class="icon-btn"></i>
        </a>
        <a href="participant-rewards-mobile.php" class="nav-item">
            <i data-lucide="badge-percent" class="icon-btn"></i>
        </a>
        <a href="participant-profile-mobile.php" class="nav-item active">
            <i data-lucide="user-round" class="icon-btn"></i>
        </a>
    </nav>

<!-- header -->
    <div class="page-header">
        <div class="header-title">Profile</div>     
    </div>

    <div class="profile-page">
    <!-- Profile header -->
    <div class="profile-header">
        <label class="avatar upload-avatar">
            <input type="file" accept="image/*" hidden id="avatarInput">
            <span class="avatar-text">Upload Photo</span>
        </label>


        <h2 class="profile-name">John Doe</h2>
        <p class="profile-id">TP012345</p>
    </div>

    <!-- Stats -->
    <div class="profile-stats">
        <div class="stat-card">
            <span class="stat-title">Points</span>
            <span class="stat-value">6767</span>
        </div>

        <div class="stat-card">
            <span class="stat-title">Ranking</span>
            <span class="stat-value">#67</span>
        </div>
    </div>

    <!-- Quick Access -->
    <div class="quick-access">
    <h4 class="section-title">Quick Access</h4>

    <a href="participant-challenges-mobile.php" class="quick-item">
        <i data-lucide="trophy"></i>
        <span>Challenges</span>
        <i data-lucide="chevron-right" class="chevron"></i>
    </a>

    <a href="participant-econews-mobile.php" class="quick-item">
        <i data-lucide="newspaper"></i>
        <span>Eco News Feed</span>
        <i data-lucide="chevron-right" class="chevron"></i>
    </a>

    <a href="participant-rewards-mobile.php" class="quick-item">
        <i data-lucide="badge-percent"></i>
        <span>Rewards</span>
        <i data-lucide="chevron-right" class="chevron"></i>
    </a>

    <a href="participant-leaderboard-mobile.php" class="quick-item">
        <i data-lucide="crown"></i>
        <span>Leaderboard</span>
        <i data-lucide="chevron-right" class="chevron"></i>
    </a>

    <a href="participant-help-mobile.php" class="quick-item">
        <i data-lucide="help-circle"></i>
        <span>Help & FAQ</span>
        <i data-lucide="chevron-right" class="chevron"></i>
    </a>

    <a href="participant-settings-mobile.php" class="quick-item">
        <i data-lucide="bolt"></i>
        <span>Settings</span>
        <i data-lucide="chevron-right" class="chevron"></i>
    </a>

        <div class="quick-item logout">
            <i data-lucide="log-out"></i>
            <span>Logout</span>
        </div>
    </div>
    </div>

    <script>
        lucide.createIcons();
    </script>

</body>
</html>