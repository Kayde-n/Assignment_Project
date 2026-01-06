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
        <svg width="60" height="60" viewBox="0 0 72 72" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.0278 55.17C17.9238 56.03 18.8788 56.833 19.8928 57.579C23.3048 55.1141 26.0849 51.8767 28.0058 48.1313C29.9267 44.386 30.9338 40.2392 30.9448 36.03C30.9448 27.216 26.5978 19.398 19.8748 14.478C18.8713 15.2154 17.9201 16.0213 17.0278 16.89C20.2462 18.9439 22.8981 21.7722 24.7408 25.1159C26.5835 28.4597 27.5583 32.2122 27.5758 36.03C27.5758 44.016 23.3968 51.042 17.0278 55.17Z" fill="var(--primary-green)"/>
            <path d="M57.0119 19.125C55.1822 23.1625 52.2267 26.5866 48.4997 28.9864C44.7728 31.3863 40.4326 32.6601 35.9999 32.655C31.5676 32.6595 27.2281 31.3854 23.5018 28.9856C19.7754 26.5858 16.8203 23.1621 14.9909 19.125C14.1119 20.205 13.3199 21.366 12.6299 22.578C15.0031 26.6727 18.4119 30.0707 22.5141 32.4309C26.6162 34.7911 31.2672 36.0303 35.9999 36.024C40.7325 36.0303 45.3835 34.7911 49.4857 32.4309C53.5878 30.0707 56.9967 26.6727 59.3699 22.578C58.6743 21.3678 57.886 20.2133 57.0119 19.125ZM30.9449 62.427C31.2809 47.787 43.0769 36.027 57.5669 36.027C59.3783 36.0212 61.1852 36.2063 62.9579 36.579C62.929 37.7587 62.8227 38.9352 62.6399 40.101C60.8168 39.6325 58.9422 39.3947 57.0599 39.393C54.0149 39.4167 51.005 40.0462 48.2057 41.2447C45.4064 42.4432 42.8736 44.1869 40.7549 46.374C38.6374 48.5623 36.9773 51.1506 35.8714 53.9878C34.7655 56.8249 34.236 59.854 34.3139 62.898C33.1812 62.8209 32.0553 62.6635 30.9449 62.427Z" fill="var(--primary-green)"/>
            <path d="M59.5382 37.509C58.7462 49.572 48.2161 59.616 36.0001 59.616C35.0881 59.618 34.1841 59.561 33.2881 59.445L32.8681 62.817C36.416 63.2333 40.0111 62.9403 43.4447 61.955C46.8783 60.9697 50.0817 59.3118 52.8689 57.0776C55.6561 54.8433 57.9715 52.0774 59.6803 48.9405C61.3892 45.8036 62.4575 42.3584 62.8232 38.805L59.5892 37.695L59.5382 37.491V37.509ZM58.8152 21.639C55.7076 16.6761 51.0676 12.8608 45.5977 10.7707C40.1278 8.6807 34.1259 8.42974 28.5007 10.0558C22.8754 11.682 17.9332 15.0966 14.4221 19.7827C10.911 24.4689 9.02242 30.1715 9.04215 36.027C9.04215 44.382 12.8521 51.867 18.8131 56.802L21.5791 54.492C18.7623 52.3004 16.4753 49.5023 14.8882 46.3056C13.301 43.1089 12.4544 39.5958 12.4111 36.027C12.4111 23.322 23.2951 12.438 36.0001 12.438C40.1006 12.4994 44.1165 13.6131 47.6629 15.6723C51.2092 17.7316 54.1672 20.6673 56.2531 24.198L58.8152 21.639Z" fill="var(--primary-green)"/>
        </svg>
        <button class="icon-btn no-hover" onclick="window.location.href='participants-desktop-home.php'">
            <h1>EcoXP</h1>
        </button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='participants-desktop-profile.php'"><i data-lucide="user-round" class="icon-btn"></i></button>
            <button class="icon-btn"><i data-lucide="bell" class="icon-btn"></i></button>
            <button class="icon-btn"><i data-lucide="bolt" class="icon-btn"></i></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="participant-icon-container">
            <div id="home-icon-box">
                <button class="icon-btn" onclick="window.location.href='participants-desktop-home.php'"><i data-lucide="house" class="icon-btn active"></i></button>
                </div>
                <button class="icon-btn"><i data-lucide="trophy" class="icon-btn"></i></button>
                <button class="icon-btn" onclick="window.location.href='participants-desktop-logaction.php'"><i data-lucide="scan-line" class="icon-btn"></i></button>
                <button class="icon-btn" onclick="window.location.href='participants-desktop-rewards.php'"><i data-lucide="badge-percent" class="icon-btn"></i></button>
                <button class="icon-btn" id="logout" onclick="logout_confirm()">
                    <script>
                        function logout_confirm() {
                            if (confirm("Are you sure you want to logout?")) {
                                window.location.href = "logout.php";
                            }
                        }
                    </script>
                    <i data-lucide="log-out" class="icon-btn"></i>
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
                <i data-lucide="chevron-right" class="icon-btn"></i>
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
                    <i data-lucide="chevron-right" class="icon-btn"></i>
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

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>

</body>

</html>