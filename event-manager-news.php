<?php
include("session.php");
include("Database.php");

$sql = "SELECT eco_news_id, title, description, image_path FROM eco_news ORDER BY eco_news_id DESC";
$result = mysqli_query($database, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco News Feed</title>
    <link rel="stylesheet" href="mobile.css">
    <link rel="stylesheet" href="event-manager-news.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <header class="top-bar" role="banner">
        <div class="top-left">
            <button class="icon-btn no-hover topbar-icon" onclick="window.location.href='event-manager-home.php'" style="display:flex;align-items:center;gap:8px;">
                <svg width="56" height="56" viewBox="0 0 72 72" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.0278 55.17C17.9238 56.03 18.8788 56.833 19.8928 57.579C23.3048 55.1141 26.0849 51.8767 28.0058 48.1313C29.9267 44.386 30.9338 40.2392 30.9448 36.03C30.9448 27.216 26.5978 19.398 19.8748 14.478C18.8713 15.2154 17.9201 16.0213 17.0278 16.89C20.2462 18.9439 22.8981 21.7722 24.7408 25.1159C26.5835 28.4597 27.5583 32.2122 27.5758 36.03C27.5758 44.016 23.3968 51.042 17.0278 55.17Z" fill="var(--primary-green)"/>
                    <path d="M57.0119 19.125C55.1822 23.1625 52.2267 26.5866 48.4997 28.9864C44.7728 31.3863 40.4326 32.6601 35.9999 32.655C31.5676 32.6595 27.2281 31.3854 23.5018 28.9856C19.7754 26.5858 16.8203 23.1621 14.9909 19.125C14.1119 20.205 13.3199 21.366 12.6299 22.578C15.0031 26.6727 18.4119 30.0707 22.5141 32.4309C26.6162 34.7911 31.2672 36.0303 35.9999 36.024C40.7325 36.0303 45.3835 34.7911 49.4857 32.4309C53.5878 30.0707 56.9967 26.6727 59.3699 22.578C58.6743 21.3678 57.886 20.2133 57.0119 19.125ZM30.9449 62.427C31.2809 47.787 43.0769 36.027 57.5669 36.027C59.3783 36.0212 61.1852 36.2063 62.9579 36.579C62.929 37.7587 62.8227 38.9352 62.6399 40.101C60.8168 39.6325 58.9422 39.3947 57.0599 39.393C54.0149 39.4167 51.005 40.0462 48.2057 41.2447C45.4064 42.4432 42.8736 44.1869 40.7549 46.374C38.6374 48.5623 36.9773 51.1506 35.8714 53.9878C34.7655 56.8249 34.236 59.854 34.3139 62.898C33.1812 62.8209 32.0553 62.6635 30.9449 62.427Z" fill="var(--primary-green)"/>
                </svg>
                <h2 class="top-title">EcoXP</h2>
            </button>
        </div>
        <div class="top-right">
            <a href="event-manager-profile.php" class="topbar-icon">
                <button class="icon-btn"><i data-lucide="user-round"></i></button>
            </a>
        </div>
    </header>

    <nav class="side-bar">
        <div class="participant-icon-container">
            <a href="event-manager-home.php" class="icon-link sidebar-icon"><button class="icon-btn"><i data-lucide="house"></i></button></a>
            <a href="event-manager-calendar.php" class="icon-link sidebar-icon"><button class="icon-btn"><i data-lucide="calendar-fold"></i></button></a>
            <a href="event-manager-news.php" class="icon-link active sidebar-icon"><button class="icon-btn"><i data-lucide="newspaper"></i></button></a>
            <a href="event-manager-rewards-management.php" class="icon-link sidebar-icon"><button class="icon-btn"><i data-lucide="badge-percent"></i></button></a>
        </div>
        <a href="logout.php" id="logout" class="sidebar-icon"><button class="icon-btn"><i data-lucide="log-out"></i></button></a>
    </nav>

    <main class="main-content">
        <div class="search-container">
            <div class="search-box">
                <i data-lucide="search" class="search-icon"></i>
                <input type="text" placeholder="Search news..." id="search-input">
            </div>
            <div id="search-results"></div> 
        </div>

        <div class="header-action-row">
            <h1 class="page-title">What's New?</h1>
            <button class="add-news-btn" onclick="window.location.href='event-manager-news-post-form.php'">
                <i data-lucide="plus"></i>
            </button>
        </div>

        <div class="news-feed">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="news-card" onclick="window.location.href='event-manager-news-details.php?id=<?php echo $row['eco_news_id']; ?>'">
                    <div class="news-image-container">
                        <img src="images/<?php echo $row['image_path']; ?>" alt="News">
                    </div>
                    <div class="news-details">
                        <div class="news-header">
                            <h3 class="news-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                            <span class="delete-action" onclick="deleteNews(event, <?php echo $row['eco_news_id']; ?>)">
                                <i data-lucide="trash-2"></i>
                            </span>
                        </div>
                        <p class="news-snippet">
                            <?php echo substr(strip_tags($row['description']), 0, 120); ?>...
                        </p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>

    <nav class="bottom-nav">
        <a href="event-manager-home.php" class="nav-item"><i data-lucide="house"></i></a>
        <a href="event-manager-calendar.php" class="nav-item"><i data-lucide="calendar-fold"></i></a>
        <a href="event-manager-news.php" class="nav-item active"><i data-lucide="newspaper"></i></a>
        <a href="event-manager-rewards-management.php" class="nav-item"><i data-lucide="badge-percent"></i></a>
        <a href="event-manager-profile.php" class="nav-item"><i data-lucide="user-round"></i></a>
    </nav>

    <script>
        // Lucide Icons
        lucide.createIcons();

        // Search logic
        const searchInput = document.getElementById('search-input');
        const searchResults = document.getElementById('search-results');
        searchInput.addEventListener('input', function () {
            const query = this.value;
            if (query.length >= 2) {
                fetch('search.php?query=' + encodeURIComponent(query) + '&source=eco_news')
                    .then(response => response.json())
                    .then(data => displayResults(data));
            } else { searchResults.innerHTML = ''; }
        });

        function displayResults(results) {
            if (results.length === 0) {
                searchResults.innerHTML = '<div class="search-dropdown"><p style="padding:10px">No news found</p></div>';
                return;
            }
            let html = '<div class="search-dropdown">';
            results.forEach(item => {
                html += `<div class="search-item" onclick="location.href='event-manager-news-details.php?id=${item.eco_news_id}'">
                            <strong>${item.title}</strong>
                         </div>`;
            });
            html += '</div>';
            searchResults.innerHTML = html;
        }

        function deleteNews(e, id) {
            e.stopPropagation(); 
            if (confirm("Delete this news item?")) {
                window.location.href = "delete_news.php?eco_news_id=" + id;
            }
        }
    </script>
</body>
</html>