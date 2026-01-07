<?php
    session_start();
    include("Database.php");

    if (!isset($_SESSION['user_role_id'])) {
        header("Location: login.php");
        exit();
    }

    $event_manager_id = $_SESSION['user_role_id'];

    $sql = "SELECT u.user_full_name
        FROM event_manager em
        JOIN user u ON u.user_id = em.user_id
        WHERE em.event_manager_id = $event_manager_id";

    $result_name = mysqli_query($database, $sql);

    $row_name = null;
    if ($result_name && mysqli_num_rows($result_name) > 0) {
        $row_name = mysqli_fetch_assoc($result_name);
    }
    
    $sql_news = "SELECT eco_news_id, title, description, image_path FROM eco_news ORDER BY eco_news_id DESC";
    $result_news = mysqli_query($database, $sql_news);

        // total number of events
    $sql_events = "SELECT COUNT(*) AS total_events FROM events";
    $result_events = mysqli_query($database, $sql_events);
    $row_events = mysqli_fetch_assoc($result_events);
    $total_events = $row_events['total_events'] ?? 0;

    // total participation (only attended)
    $sql_participation = "SELECT COUNT(*) AS total_participation
        FROM attendance
        WHERE event_attended = 1";
    $result_participation = mysqli_query($database, $sql_participation);
    $row_participation = mysqli_fetch_assoc($result_participation);
    $total_participation = $row_participation['total_participation'] ?? 0;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
                <button class="icon-btn" onclick="window.location.href='event-manager-home.php'"><img
                        src="images/home.png" alt="Home"></button>
            </div>
            <button class="icon-btn" onclick="window.location.href='event-manager-calendar.php'"><img src="images/calendar.png" alt="Calendar"></button>
            <button class="icon-btn" onclick="window.location.href='event-manager-news.php'"><img src="images/newspaper.png" alt="News"></button>
            <button class="icon-btn" onclick="window.location.href='event-manager-rewards-management.php'"><img src="images/tag.png" alt="Rewards"></button>
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
        <p style="color: green; font-size: 24px; margin-left: 16px;">
            Welcome back,
            <?php
                if ($row_name) {
                    echo $row_name['user_full_name'];
                } else {
                    echo "Event Manager";
                }
            ?>
        </p>

        <div class="text-box">
            Event Statistics
        </div>
        <div class="impact-container">
            <button class="impact-box">
                <h3>
                <?php echo $total_events; ?> events held

                </h3>
            </button>

            <button class="impact-box">
                <h3>
                <?php echo $total_participation; ?> participation in all events
                </h3>
            </button>

            <button class="impact-box">
                <h3>
                not available
                </h3>
            </button>

            <button class="impact-box">
                <h3>
                not available
                </h3>
            </button>

        </div>
        <div class="text-box" onclick="window.location.href='participants-desktop-econews.php'"
            style="cursor: pointer;">
            What's New?
        </div>
        <?php while ($row = mysqli_fetch_assoc($result_news)) { ?>

            <div class="content-container"
                onclick="window.location.href='participants-desktop-newsdetails.php?id=<?php echo $row['eco_news_id']; ?>'">

                <button class="image-holder">
                    <img src="images/<?php echo $row['image_path']; ?>" alt="News Image">
                </button>

                <button class="content-text-box">
                    <div class="text-inner">

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

            <button class="next-btn">
                <img src="images/next.png" alt="Next Icon">
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
                    fetch('search.php?query=' + encodeURIComponent(query) + '&source=event_manager')
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