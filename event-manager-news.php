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
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="event-manager.css">
    <link rel="stylesheet" href="event-manager-news.css">
</head>
<body>
    <div class="top-bar">
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='participants-desktop-home.php'">
            <h2>EcoXP</h2>
        </button>
        <div class="default-icon-container">
            <button class="icon-btn"><img
                    src="images/profile.png" alt="Profile Logo"></button>
            <button class="icon-btn"><img src="images/notif.png" alt="Notification Logo"></button>
            <button class="icon-btn"><img src="images/setting.png" alt="Setting Logo"></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="event-manager-icon-container">
            <button class="icon-btn" onclick="window.location.href='event-manager-home.php'"><img src="images/home.png" alt="Home"></button>
            <button class="icon-btn" onclick="window.location.href='event-manager-calendar.php'"><img src="images/calendar.png" alt="Calendar"></button>
            <div id="news-icon-box">
                <button class="icon-btn" onclick="window.location.href='event-manager-news.php'"><img src="images/newspaper.png" alt="News"></button>
            </div>
            <button class="icon-btn" onclick="window.location.href='event-manager-rewards-management.php'"><img src="images/tag.png" alt="Rewards"></button>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>
    <div class="main-content">
    <div class="page-header">
        <div class="search-box">

            <input type="text" placeholder="Search..." id="search-input">

            <div id="search-results"></div> 

        </div>
       
        <div class="title-box">
            <h1>What's New?</h1>
            <button class="add-news-btn" onclick="window.location.href='event-manager-news-post-form.php'">+</button>
        </div>

    </div>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

            <button class="content-holder"
                onclick="window.location.href='event-manager-news-details.php?id=<?php echo $row['eco_news_id']; ?>'">
                <div class="content-image">
                    <img src="images/<?php echo $row['image_path']; ?>">
                </div>

                <div class="content-text-box">
                    <div class="event_title-row">
                    <h3 class="content-text-title">
                        <?php echo $row['title']; ?>
                    </h3>
                    <span class="trash-icon" onclick="deleteNews(event, <?php echo $row['eco_news_id']; ?>)" title="Delete">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-icon lucide-trash"><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                    </span>
                    </div>

                    <p class="content-text-description">
                        <?php echo substr($row['description'], 0, 200); ?>...
                    </p>
                </div>

            </button>

        <?php } ?>

    </div>
    <script>
        const searchInput = document.getElementById('search-input');
        const searchResults = document.getElementById('search-results');

        // Trigger search on every keystroke
        searchInput.addEventListener('input', function () {
            const query = this.value;

            // Only search if user typed at least 2 characters
            if (query.length >= 2) {
                // Send AJAX request to PHP
                fetch('search.php?query=' + encodeURIComponent(query) + '&source=eco_news')
                    .then(response => response.json())
                    .then(data => {
                        displayResults(data);
                    })
                    .catch(error => {
                        console.error('Error fetching search results:', error);
                    });
            } else {
                searchResults.innerHTML = ''; // Clear results if less than 2 chars
            }
        });

        function displayResults(results) {
            if (results.length === 0) {
                searchResults.innerHTML = '<p>No results found</p>';
                return;
            }

            let html = '<div class="search-results-container">';
            results.forEach(item => {
                // For eco news results, use eco_news_id to construct URL
                let redirectUrl = 'event-manager-news-details.php?id=' + item.eco_news_id;
                
                html += `
                <div class="search-result-box" onclick="redirectToResult('${redirectUrl}')">
                    <h4>${item.title}</h4>
                    <p>${item.description ? item.description.substring(0, 30) : ''}...</p>
                </div>
            `;
            });
            html += '</div>';

            searchResults.innerHTML = html;
        }

        function redirectToResult(url) {
            if (url) {
                window.location.href = url;
            }
        }

        function deleteNews(e, eco_news_id) {
            e.stopPropagation(); 

            if (confirm("Are you sure you want to delete this news item?")) {
                window.location.href = "delete_news.php?eco_news_id=" + eco_news_id;
        }
    }

    </script>
</body>
</html>