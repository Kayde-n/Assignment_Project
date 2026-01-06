<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>newsdetails</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="participant.css">
    <link rel="stylesheet" href="participants-home-desktop.css">

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
            <button class="icon-btn" onclick="window.location.href='participants-desktop-challenges-tab.php'"><img
                    src="images/challanges.png" alt="Challenges"></button>
            <button class="icon-btn" onclick="window.location.href='participants-desktop-logaction.php'"><img
                    src="images/scan.png" alt="Scan"></button>
            <button class="icon-btn" onclick="window.location.href='participants-desktop-rewards.php'"><img
                    src="images/tag.png" alt="Rewards"></button>
            <button class="icon-btn" id="logout" onclick="logout_confirm()">
                <script>
                    function logout_confirm() {
                        if (confirm("Are you sure you want to logout?")) {
                            window.location.href = "logout.php";
                        }
                    }
                </script>
                <img src="images/logout.png" alt="Logout">
            </button>
        </div>
    </div>
    <div class="main-content">
        <div class="search-box">
            <input type="text" placeholder="Search..." id="search-input">
            <div id="search-results"></div> <!-- placeholder for search results -->
        </div>
        <p style="color: green;font-size: 24px;margin-left: 16px;">“Together We Save Energy. Together We Save Nature.”
        </p>
        <div class="text-box">
            Application Impact
        </div>
        <div class="impact-container">
            <button class="impact-box">
                <h3>
                    <?= number_format($air_pollution); ?> kg CO₂e

                </h3>
            </button>

            <button class="impact-box">
                <h3>
                    <?= $user_impact_waste ?>
                </h3>
            </button>

            <button class="impact-box">
                <h3>
                    <?= $challenges_count ?> Challenges Completed
                </h3>
            </button>

            <button class="impact-box">
                <h3>
                    Daily Streak <br>
                    <?= $streak ?>
                </h3>
            </button>
            <button class="impact-next-btn">
                <img src="images/next.png" alt="Next" />
            </button>
        </div>
        <div class="text-box" onclick="window.location.href='participants-desktop-econews.php'"
            style="cursor: pointer;">
            What News?
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
                    fetch('search.php?query=' + encodeURIComponent(query) + '&source=staff')
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

            function displayResults(results) { //builds HTML search results
                if (results.length === 0) {
                    searchResults.innerHTML = '<p>No results found</p>';
                    return;
                }

                let html = '<div class="search-results-container">';
                results.forEach(item => {
                    // Determine redirect URL
                    let redirectUrl = '';
                    if (item.url) {
                        // For home search results with predefined url
                        redirectUrl = item.url;
                    } else if (item.eco_news_id) {
                        // For eco news results
                        redirectUrl = 'participants-desktop-newsdetails.php?id=' + item.eco_news_id;
                    }

                    html += `
                <div class="search-result-box" onclick="redirectToResult('${redirectUrl}')">
                    <h4>${item.title}</h4>
                    <p>${item.description || ''}</p>
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