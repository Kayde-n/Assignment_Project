<?php
    session_start();
    include("Database.php");
    $participant_id = $_SESSION['user_role_id'];
    $sql_query_impact = "SELECT impact_type, impact_amount, participants_challenges_id FROM participants_challenges WHERE participants_id = $participant_id";

    $sql_query_daily_streak = "SELECT date_accomplished FROM participants_challenges 
            WHERE participants_id = $participant_id
            ORDER BY date_accomplished DESC";
    $streak_result = mysqli_query($database, $sql_query_daily_streak);
    $dates = [];
    $streak = 0;

    $challenges_count = 0;
    $impact = [];
    $total_impact_amount = 0; // total CO2 reduction
    $total_impact_amount2 = 0; // total waste recycled
    $result = mysqli_query($database, $sql_query_impact);
    
    // news 
    $sql_news = "SELECT eco_news_id, title, description, image_path FROM eco_news ORDER BY eco_news_id DESC";
    $result_news = mysqli_query($database, $sql_news);

    if (!$result) {
        error_log("Database query failed: " . mysqli_error($database));
        exit();
    }
    while ($row = mysqli_fetch_assoc($result)) {
        $challenges_count += 1;
    }
    while ($row = mysqli_fetch_assoc($result)) {
        $impact[$row['impact_type']] = $row['impact_amount'];
    }
    $row_count = count($impact);
    $count = 0;

    while ($count < $row_count) {
        // Check impact type and add corresponding impact amount
        if ($impact['impact_type'] == 'reduced carbon emission') {
            $total_impact_amount = $impact['impact_amount'] + $total_impact_amount;

        } else if ($impact['impact_type'] == 'recycling trash') {
            $total_impact_amount2 = $impact['impact_amount'] + $total_impact_amount2;

        }
        $count++;
    }
    $user_impact_emissions = $total_impact_amount . " kg of CO2 Reduced Emissions";
    $user_impact_waste = $total_impact_amount2 . " kg of Waste Recycled";

    while ($row = mysqli_fetch_assoc($streak_result)) {
        $dates[] = $row['date_accomplished']; // push each date into array
    }

    $today = new DateTime('today'); // Get today's date (no time, only date)
    $current_day = clone $today;


    // Convert date strings into DateTime objects
    $dates = array_map(function ($d) {
        return new DateTime($d);
    }, $dates);


    while (true) {
        $found = false;
        foreach ($dates as $d) {
            if ($d->format('Y-m-d') == $current_day->format('Y-m-d')) {
                $found = true;
                break;
            }
        }
        if ($found) {
            $streak++;
            $current_day->modify('-1 day'); // go to previous day
        } else {
            // Streak breaks when a day is missing
            break;
        }
    }
?>
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
            <button class="icon-btn" onclick="window.location.href='participants-desktop-challenges-tab.php'"><img src="images/challanges.png" alt="Challenges"></button>
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
            <button id="search-btn">🔍</button>
            <div id="search-results"></div> <!-- placeholder for search results -->
        </div>
        <p style="color: green;font-size: 24px;margin-left: 16px;">“Together We Save Energy. Together We Save Nature.”
        </p>
        <div class="text-box">
            Your Impact
        </div>
        <div class="impact-container">
            <button class="impact-box">
                <h3><?= $user_impact_emissions ?></h3>
            </button>

            <button class="impact-box">
                <h3><?= $user_impact_waste ?></h3>
            </button>

            <button class="impact-box">
                <h3>
                    <?= $challenges_count ?> Challenges Completed
                </h3>
            </button>

            <button class="impact-box">
                <h3>
                    Daily Streak <br><?= $streak ?>
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
        <?php while ($row = mysqli_fetch_assoc($result_news)) { ?>

            <div class="content-container"
                onclick="window.location.href='participants-desktop-newsdetails.php?id=<?php echo $row['eco_news_id']; ?>'">

                <button class="image-holder">
                    <img src="/Assignment_Project/images/<?php echo $row['image_path']; ?>" alt="News Image">
                </button>

                <button class="content-text-box">
                    <div class="text-inner">
                        <h4 class="category-box">Environment</h4>

                        <h3 class="title-box">
                            <?php echo htmlspecialchars($row['title']); ?>
                        </h3>

                        <h5 class="description-box">
                            <?php echo substr(strip_tags($row['description']), 0, 200); ?>...
                        </h5>
                    </div>
                </button>

                <button class="next-btn">
                    <img src="images/next.png" alt="Next Icon">
                </button>

            </div>

        <?php } ?>
<script>
        const searchInput = document.getElementById('search-input');
        const searchResults = document.getElementById('search-results');

        // Trigger search on every keystroke
        searchInput.addEventListener('input', function () {
            const query = this.value;

            // Only search if user typed at least 2 characters
            if (query.length >= 2) {
                // Send AJAX request to PHP
                fetch('search.php?query=' + encodeURIComponent(query)+'&source=home')
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

            let html = '<ul>';
            results.forEach(item => {
                html += `
                <li>
                    <h4>${item.title}</h4>
                </li>
            `;
            });
            html += '</ul>';

            searchResults.innerHTML = html;
        }
    </script>

</body>

</html>