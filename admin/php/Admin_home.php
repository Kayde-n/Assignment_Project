<?php
    session_start();
    require_once __DIR__ . "/../../config/database.php";
    // check if its on maintenance
    require_once __DIR__ . "/../../check-maintenance-status.php";

    // query overvall enviroment impact
    $sql = "SELECT SUM(CASE WHEN LOWER(impact_type) LIKE '%air pollution%' THEN impact_amount ELSE 0 END) AS air_pollution,
        SUM(CASE WHEN LOWER(impact_type) LIKE '%carbon%' THEN impact_amount ELSE 0 END) AS carbon_emission,
        SUM(CASE WHEN LOWER(impact_type) LIKE '%recycling%' THEN impact_amount ELSE 0 END) AS item_recycled,
        SUM(CASE WHEN LOWER(impact_type) LIKE '%water pollution%'OR LOWER(impact_type) LIKE '%reduced pollution%'THEN impact_amount ELSE 0 END) AS water_conserved
        FROM participants_challenges
        WHERE challenges_status = 'approved'";

    $result = mysqli_query($database, $sql);

    if (!$result) {
        die("Database error: " . mysqli_error($database));
    }

    $impacts = mysqli_fetch_assoc($result);

    $air_pollution   = $impacts['air_pollution']   ?? 0;
    $carbon_emission = $impacts['carbon_emission'] ?? 0;
    $item_recycled   = $impacts['item_recycled']   ?? 0;
    $water_conserved = $impacts['water_conserved'] ?? 0;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="../../global.css">
    <link rel="stylesheet" href="../../participant.css">
    <link rel="stylesheet" href="../../participants-home-desktop.css">

</head>

<body>
    <div class="top-bar">
        <img src="../../images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='Admin_home.php'">
            <h2>EcoXP</h2>
        </button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='Admin_profile.php'"><img
                    src="../../images/profile.png" alt="Profile Logo"></button>
            <button class="icon-btn"><img src="../../images/notif.png" alt="Notification Logo"></button>
            <button class="icon-btn"><img src="../../images/setting.png" alt="Setting Logo"></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="participant-icon-container">
            <div id="home-icon-box">
                <button class="icon-btn" onclick="window.location.href='Admin_home.php'"><img
                        src="../../images/home.png" alt="Home"></button>
            </div>
            <button class="icon-btn" onclick="window.location.href='Admin_system_analytics.php'"><img
                    src="../../images/system-analytics.png" alt="System Analytics"></button>
            <button class="icon-btn" onclick="window.location.href='Admin_sustainability_report.php'"><img
                    src="../../images/sustainability-report.png" alt="Sustainability Report"></button>
            <button class="icon-btn" onclick="window.location.href='Admin_system_config.php'"><img
                    src="../../images/system-config.png" alt="System Config"></button>
            <button class="icon-btn" id="logout" onclick="logout_confirm()">
                <script>
                    function logout_confirm() {
                        if (confirm("Are you sure you want to logout?")) {
                            window.location.href = "../../logout.php";
                        }
                    }
                </script>
                <img src="../../images/logout.png" alt="Logout">
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
            Overall Environmental Impact
        </div>

        <div class="impact-container">

            <div class="impact-box">
                <h3><?= number_format($air_pollution); ?> kg CO₂e</h3>
                <p>Reduced Air Pollution</p>
            </div>

            <div class="impact-box">
                <h3><?= number_format($carbon_emission); ?> kg CO₂e</h3>
                <p>Reduced Carbon Emission</p>
            </div>

            <div class="impact-box">
                <h3><?= number_format($item_recycled); ?> kg</h3>
                <p>Total Garbage Recycled</p>
            </div>

            <div class="impact-box">
                <h3><?= number_format($water_conserved); ?> ℓ</h3>
                <p>Reduced Water Pollution</p>
            </div>

        </div>

        <div class="text-box" style="cursor: pointer;">
            Unavailable
        </div>

        <!-- Verification Item 1 -->
        <div class="content-container">

            <button class="image-holder">
                <img src="../../challenge_submission_uploads/sample-proof-1.jpg" alt="Unavailable">
            </button>

            <button class="content-text-box">
                <div class="text-inner">

                    <h4 class="category-box">
                        Unavailable
                    </h4>

                    <h3 class="title-box">
                        Unavailable
                    </h3>

                    <h5 class="description-box">
                        Unavailable
                    </h5>

                    <h5 class="description-box">
                        Unavailable
                    </h5>

                </div>
            </button>

            <button class="next-btn">
                <img src="../../images/next.png" alt="Next Icon">
            </button>

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
                    fetch('../../search.php?query=' + encodeURIComponent(query) + '&source=admin')
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
                        redirectUrl = '../../participant/php/participants-desktop-newsdetails.php?id=' + item.eco_news_id;
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