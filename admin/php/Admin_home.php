<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../check-maintenance-status.php";

    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    echo "<script>
        alert('Access denied. Admin only.');
        window.location.href = '../../login.php';
    </script>";
    exit();
    }

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

$air_pollution = $impacts['air_pollution'] ?? 0;
$carbon_emission = $impacts['carbon_emission'] ?? 0;
$item_recycled = $impacts['item_recycled'] ?? 0;
$water_conserved = $impacts['water_conserved'] ?? 0;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="../../global.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../../participants-home-desktop.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>
    <div class="side-bar">
        <div class="admin-icon-container">
            <div id="home-icon-box">
                <button class="icon-btn" onclick="window.location.href='admin_home.php'">
                    <i data-lucide="home"></i>
                </button>
            </div>
            <button class="icon-btn" onclick="window.location.href='Admin_system_analytics.php'">
                <i data-lucide="bar-chart-3"></i>
            </button>
            <button class="icon-btn" onclick="window.location.href='Admin_sustainability_report.php'">
                <i data-lucide="file-text"></i>
            </button>
            <button class="icon-btn" onclick="window.location.href='Admin_system_config.php'">
                <i data-lucide="sliders"></i>
            </button>
            <button class="icon-btn" id="logout" onclick="logout_confirm()">
                <i data-lucide="log-out"></i>
            </button>
        </div>
    </div>



    <div class="top-bar">
        <img src="../../images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='Admin_home.php'">
            <h2>EcoXP</h2>
        </button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='Admin_profile.php'">
                <i data-lucide="user"></i>
            </button>

        </div>
    </div>

    <div class="main-content">
        <div class="search-box">
            <input type="text" placeholder="Search..." id="search-input">
            <div id="search-results"></div>
        </div>
        <p style="color: green;font-size: 24px; font-weight: 600;margin-left: 16px; margin-bottom: 16px;">“Together We
            Save Nature.”
        </p>
        <div class="page-header">
            <div class="title-box">
                Environmental Impact
            </div>
        </div>

        <div class="impact-container">

            <div class="impact-box">
                <h3><?= number_format($air_pollution); ?> kg </h3>
                <p>Reduced Air Pollution</p>
            </div>

            <div class="impact-box">
                <h3><?= number_format($carbon_emission); ?> kg </h3>
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



    </div>

    <script>
        function logout_confirm() {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = "../../logout.php";
            }
        }

        const searchInput = document.getElementById('search-input');
        const searchResults = document.getElementById('search-results');

        searchInput.addEventListener('input', function () {
            const query = this.value;

            if (query.length >= 2) {
                fetch('../../search.php?query=' + encodeURIComponent(query) + '&source=admin')
                    .then(response => response.json())
                    .then(data => {

                        displayResults(data);
                    })
                    .catch(error => {
                        console.error('Error fetching search results:', error);
                    });
            } else {
                searchResults.innerHTML = '';
            }
        });

        function displayResults(results) {
            if (results.length === 0) {
                searchResults.innerHTML = '<p>No results found</p>';
                return;
            }

            let html = '<div class="search-results-container">';
            results.forEach(item => {
                let redirectUrl = '';
                if (item.url) {
                    redirectUrl = item.url;
                } else if (item.eco_news_id) {
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

        lucide.createIcons();
    </script>

</body>

</html>