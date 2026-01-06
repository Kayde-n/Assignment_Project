<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant Econews Mobile</title>
    <link rel="stylesheet" href="mobile.css">
    <link rel="stylesheet" href="participant-econews-example-mobile.css">    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
<!-- nav bar -->
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
        <a href="participant-profile-mobile.php" class="nav-item">
            <i data-lucide="user-round" class="icon-btn"></i>
        </a>
    </nav>
<!-- background hero -->
    <div class="hero">
         <div class="hero" style="background-image: url('https://picsum.photos/600/400');">
        <a href="participant-econews-mobile.php" class="return-btn" aria-label="Return button">
            <i data-lucide="arrow-left"></i>
        </a>    
    </div>
<!-- article -->
    <div class="article-container">
        <div class="news-tag">Sustainability</div>
        <h1 class="article-title">Top 5 Green Tips for Reducing E-Waste</h1>

        <p>
            UK businesses and households produce 1.45 million tonnes of e-waste a year. 
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod 
            tempor incididunt ut labore et dolore magna aliqua.
        </p>

        <h2>Tip 1: Buy Less</h2>
        <p>
            Only purchase devices you really need. Lorem ipsum dolor sit amet, 
            consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut 
            labore et dolore magna aliqua.
        </p>

        <h2>Tip 2: Recycle Properly</h2>
        <p>
            Always drop old electronics at certified recycling points. Lorem ipsum 
            dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor 
            incididunt ut labore et dolore magna aliqua.
        </p>

        <img src="https://picsum.photos/400/200" alt="E-waste image" class="article-img">
    </div>

    <script>
        lucide.createIcons();
    </script>

</body>
</html>