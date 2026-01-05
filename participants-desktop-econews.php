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
    <title>Eco News Page</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="participant.css">
    <link rel="stylesheet" href="participants-econews-desktop.css">

</head>

<body>
    <div class="top-bar">
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='participants-desktop-home.php'">
            <h2>EcoXP</h2>
        </button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='participants-desktop-profile.php'"><img
                    src="images/profile.png" alt="Profile Logo"></button>
            <button class="icon-btn"><img src="images/notif.png" alt="Notification Logo"></button>
            <button class="icon-btn"><img src="images/setting.png" alt="Setting Logo"></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="participant-icon-container">
            <div id="home-icon-box">
                <button class="icon-btn" onclick="window.location.href='participants-desktop-home.php'"><img
                        src="images/home.png" alt="Home"></button>
            </div>
            <button class="icon-btn"><img src="images/challanges.png" alt="Challenges"></button>
            <button class="icon-btn" onclick="window.location.href='participants-desktop-logaction.php'"><img src="images/scan.png" alt="Scan"></button>
            <button class="icon-btn" onclick="window.location.href='participants-desktop-rewards.php'"><img src="images/tag.png" alt="Rewards"></button>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>
    <div class="main-content">
        <div class="search-box">

            <input type="text" placeholder="Search..." id="search-input">

            <div id="search-results"></div> <!-- placeholder for search results -->

        </div>
        <div class="text-box">
            What News?
        </div>
        
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

            <button class="content-holder"
                onclick="window.location.href='participants-desktop-newsdetails.php?id=<?php echo $row['eco_news_id']; ?>'">

                <div class="category-box">Environment</div>

                <div class="content-image">
                    <img src="/Assignment_Project/images/<?php echo $row['image_path']; ?>">
                </div>

                <div class="content-text-box">
                    <h3 class="content-text-title">
                        <?php echo $row['title']; ?>
                    </h3>

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
                fetch('search.php?query=' + encodeURIComponent(query)+'&source=eco_news')
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
                let redirectUrl = 'participants-desktop-newsdetails.php?id=' + item.eco_news_id;
                
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
    </script>

</body>

</html>