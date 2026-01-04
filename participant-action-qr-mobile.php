<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant Home Mobile</title>
    <link rel="stylesheet" href="mobile.css">
    <link rel="stylesheet" href="participant-action-qr-mobile.css">    
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
        <a href="participant-action-submit-mobile.php" class="nav-item active">
            <i data-lucide="scan-line" class="icon-btn"></i>
        </a>
        <a href="participant-rewards-mobile.php" class="nav-item">
            <i data-lucide="badge-percent" class="icon-btn"></i>
        </a>
        <a href="participant-profile-mobile.php" class="nav-item">
            <i data-lucide="user-round" class="icon-btn"></i>
        </a>
    </nav>

<!-- header -->
    <div class="page-header">
        <div class="header-title">Sign Attendance</div>     
    </div>
    <!-- switch action -->
    <div class="switch-action-container">
        <div class="switch-btn-container">
            <a href="participant-action-submit-mobile.php" class="switch-btn-item">
            <i data-lucide="image" class="switch-btn"></i>
        </a>
        <a href="participant-action-qr-mobile.php" class="switch-btn-item active">
            <i data-lucide="qr-code" class="switch-btn"></i>
        </a>
        </div>
    </div>

    <!-- otp -->
     <div class="otp-container">
        <input type="text" maxlength="1" class="otp-box" />
        <input type="text" maxlength="1" class="otp-box" />
        <input type="text" maxlength="1" class="otp-box" />
    </div>

     
    <div class="scan-btn-container">
        <button class="scan-btn">Scan QR Code</button>
    </div>
    


    <script>
        lucide.createIcons();
    </script>

</body>
</html>