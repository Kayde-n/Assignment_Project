<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant Challenges Mobile</title>
    <link rel="stylesheet" href="mobile.css">
    <link rel="stylesheet" href="participant-challenges-mobile.css">    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
<!-- nav bar -->
    <nav class="bottom-nav">
        <a href="participant-home-mobile.php" class="nav-item">
            <i data-lucide="house" class="icon-btn"></i>
        </a>
        <a href="participant-challenges-mobile.php" class="nav-item active">
            <i data-lucide="trophy" class="icon-btn"></i>
        </a>
        <a href="participant-action-submit-mobile.php" class="nav-item">
            <i data-lucide="scan-line" class="icon-btn"></i>
        </a>
        <a href="participant-rewards-mobile.php" class="nav-item">
            <i data-lucide="badge-percent" class="icon-btn"></i>
        </a>
        <a href="participant-profile-mobile.php" class="nav-item">
            <i data-lucide="user-round" class="icon-btn"></i>
        </a>
    </nav>
<!-- title -->
    <div class="page-header">
        <div class="header-title">Challenges</div>     
    </div>
<!-- category pill -->
    <div class="pill-filter">
        <div class="category-pill active">Ongoing</div>
        <div class="category-pill">Completed</div>
    </div>
<!-- daily -->
    <section class="daily-quest-container">
        <div class="section-header">
            <div class="section-title">Daily Quest</div>
        </div>
<!-- daily streak -->
        <div class="daily-streak">
            <div class="streak-bar">
                <div class="streak-fill" style="width: 50%;"></div>
            </div>
            <div class="streak-info">
                <span class="streak-text">2 / 4</span>
                <i data-lucide="flame" class="streak-icon"></i>
            </div>
        </div>
<!-- daily quest -->
        <div class="dailies-card">
            <img src="https://picsum.photos/120/120" alt="dailies image" class="dailies-image">
            <div class="dailies-content">
                <h4 class="dailies-title">Bus to Campus</h4>
                <div class="dailies-details">
                    <p class="dailies-text">20GP</p>             
                    <a href="participant-action-submit-mobile.php"> 
                        <div class="dailies-btn">Submit</div>
                    </a>  
                </div>
            </div>
        </div>
        
        <div class="dailies-card">
            <img src="https://picsum.photos/120/120" alt="dailies image" class="dailies-image">
            <div class="dailies-content">
                <h4 class="dailies-title">Bus to Campus</h4>
                <div class="dailies-details">
                    <p class="dailies-text">20GP</p>                
                    <div class="dailies-btn">Claim</div>
                </div>
            </div>
        </div>

        <div class="dailies-card">
            <img src="https://picsum.photos/120/120" alt="dailies image" class="dailies-image">
            <div class="dailies-content">
                <h4 class="dailies-title">Bus to Campus</h4>
                <div class="dailies-details">
                    <p class="dailies-text">20GP</p>                
                    <div class="dailies-btn">Claim</div>
                </div>
            </div>
        </div>

        <div class="dailies-card">
            <img src="https://picsum.photos/120/120" alt="dailies image" class="dailies-image">
            <div class="dailies-content">
                <h4 class="dailies-title">Bus to Campus</h4>
                <div class="dailies-details">
                    <p class="dailies-text">20GP</p>                
                    <div class="dailies-btn active">Claimed</div>
                </div>
            </div>
        </div>

        <div class="dailies-card">
            <img src="https://picsum.photos/120/120" alt="dailies image" class="dailies-image">
            <div class="dailies-content">
                <h4 class="dailies-title">Bus to Campus</h4>
                <div class="dailies-details">
                    <p class="dailies-text">20GP</p>                
                    <div class="dailies-btn active">Claimed</div>
                </div>
            </div>
        </div>
    </section>
<!-- special events -->
    <section class="specials-container">
        <div class="section-header">
            <div class="section-title">Special Events</div>
        </div>

        <div class="specials-card">
            <img src="https://picsum.photos/120/120" alt="specials image" class="specials-image">
            <div class="specials-content">
                <h4 class="specials-title">Campus Cleanup Day</h4>
                <div class="specials-details">
                    <p class="specials-text">500GP</p>                
                    <a href="participant-challenges-details-mobile.php">
                        <div class="specials-btn">Join</div>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="specials-card">
            <img src="https://picsum.photos/120/120" alt="specials image" class="specials-image">
            <div class="specials-content">
                <h4 class="specials-title">Campus Cleanup Day</h4>
                <div class="specials-details">
                    <p class="specials-text">500GP</p>                
                    <div class="specials-btn">Join</div>
                </div>
            </div>
        </div>

        <div class="specials-card">
            <img src="https://picsum.photos/120/120" alt="specials image" class="specials-image">
            <div class="specials-content">
                <h4 class="specials-title">Campus Cleanup Day</h4>
                <div class="specials-details">
                    <p class="specials-text">500GP</p>                
                    <div class="specials-btn">Join</div>
                </div>
            </div>
        </div>

        <div class="specials-card">
            <img src="https://picsum.photos/120/120" alt="specials image" class="specials-image">
            <div class="specials-content">
                <h4 class="specials-title">Campus Cleanup Day</h4>
                <div class="specials-details">
                    <p class="specials-text">500GP</p>                
                    <div class="specials-btn">Join</div>
                </div>
            </div>
        </div>

        <div class="specials-card">
            <img src="https://picsum.photos/120/120" alt="specials image" class="specials-image">
            <div class="specials-content">
                <h4 class="specials-title">Campus Cleanup Day</h4>
                <div class="specials-details">
                    <p class="specials-text">500GP</p>              
                    <div class="specials-btn">Join</div>
                </div>
            </div>
        </div>
    </section>

    <script>
        lucide.createIcons();
    </script>

</body>
</html>