<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant Home Mobile</title>
    <link rel="stylesheet" href="mobile.css">
    <link rel="stylesheet" href="participant-action-submit-mobile.css">    
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
        <div class="header-title">Log Action</div>     
    </div>
    <!-- switch action -->
    <div class="switch-action-container">
        <div class="switch-btn-container">
            <a href="participant-action-submit-mobile.php" class="switch-btn-item active">
            <i data-lucide="image" class="switch-btn"></i>
        </a>
        <a href="participant-action-qr-mobile.php" class="switch-btn-item">
            <i data-lucide="qr-code" class="switch-btn"></i>
        </a>
        </div>
    </div>

    <!-- submit -->
     <div class="submit-container">
        <div class="submit-select">
            <button class="submit-dropdown-btn">
                <span>Select Challenge</span> <span class="arrow-icon">▼</span>
            </button>
        </div>
        <div class="submit-image">
            <label class="image-upload-box" for="imageInput">
                <i data-lucide="image" class="upload-icon"></i>
                <span class="upload-text">Tap to upload image</span>
                <input type="file" id="imageInput" accept="image/*" style="display:none;">
            </label>
        </div>
        <div class="submit-description">
        <textarea placeholder="Add a description... (Optional)"></textarea>
        </div>  
     </div>

    <div class="submit-btn-container">
        <button class="submit-btn">Submit For Review</button>
    </div>
    


    <script>
        lucide.createIcons();
    </script>

</body>
</html>