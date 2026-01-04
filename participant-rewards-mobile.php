<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant Home Mobile</title>
    <link rel="stylesheet" href="mobile.css">
    <link rel="stylesheet" href="participant-rewards-mobile.css">    
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
        <a href="participant-rewards-mobile.php" class="nav-item active">
            <i data-lucide="badge-percent" class="icon-btn"></i>
        </a>
        <a href="participant-profile-mobile.php" class="nav-item">
            <i data-lucide="user-round" class="icon-btn"></i>
        </a>
    </nav>
<!-- header -->
    <div class="page-header">
        <div class="header-title">Rewards</div>     
    </div>

    <!-- pill -->
    <div class="pill-filter">
        <div class="category-pill active">All Rewards</div>
        <div class="category-pill">Discount/Vouchers</div>
        <div class="category-pill">Donations</div>
        <div class="category-pill">Physical Items</div>
    </div>

    <!-- reward cards -->
     <div class="rewards-container">
    <div class="rewards-card">
        <img src="https://picsum.photos/120/120" alt="rewards image" class="rewards-image">
            <div class="rewards-content">
                <h4 class="rewards-title">
                    10% cafeteria voucher
                </h4>
                <div class="rewards-details">
                    <p class="rewards-text">
                    500GP
                    </p>                
                    <a href="participant-challenges-details-mobile.php">
                    <div class="rewards-btn">Redeem</div>
                    </a>
                </div>
            </div>
    </div>
    
    <div class="rewards-card">
        <img src="https://picsum.photos/120/120" alt="rewards image" class="rewards-image">
            <div class="rewards-content">
                <h4 class="rewards-title">
                    10% cafeteria voucher
                </h4>
                <div class="rewards-details">
                    <p class="rewards-text">
                    500GP
                    </p>                
                    <div class="rewards-btn">Redeem</div>
                </div>
            </div>
    </div>

    <div class="rewards-card">
        <img src="https://picsum.photos/120/120" alt="rewards image" class="rewards-image">
            <div class="rewards-content">
                <h4 class="rewards-title">
                    10% cafeteria voucher
                </h4>
                <div class="rewards-details">
                    <p class="rewards-text">
                    500GP
                    </p>                
                    <a href="participant-challenges-details-mobile.php">
                    <div class="rewards-btn">Redeem</div>
                    </a>
                </div>
            </div>
    </div>
    
    <div class="rewards-card">
        <img src="https://picsum.photos/120/120" alt="rewards image" class="rewards-image">
            <div class="rewards-content">
                <h4 class="rewards-title">
                    10% cafeteria voucher
                </h4>
                <div class="rewards-details">
                    <p class="rewards-text">
                    500GP
                    </p>                
                    <div class="rewards-btn">Redeem</div>
                </div>
            </div>
    </div>
    </div>

    

    <script>
        lucide.createIcons();
    </script>

</body>
</html>