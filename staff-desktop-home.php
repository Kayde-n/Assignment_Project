<?php
    include("Database.php");

    $sql_counts = "SELECT
                    SUM(CASE WHEN challenges_status = 'pending' THEN 1 ELSE 0 END) AS pending_count,
                    SUM(CASE WHEN challenges_status = 'approved' THEN 1 ELSE 0 END) AS approved_count,
                    SUM(CASE WHEN challenges_status = 'rejected' THEN 1 ELSE 0 END) AS rejected_count
                    FROM participants_challenges";
    
    $results_counts = mysqli_query($database, $sql_counts);
    $counts = mysqli_fetch_assoc($results_counts);


    $pendingCount = $counts['pending_count'] ?? 0;
    $approvedCount = $counts['approved_count'] ?? 0;
    $rejectedCount = $counts['rejected_count'] ?? 0;

    $listQuery = "SELECT pc.*,pc.image_path AS proof_image,u.user_full_name,c.challenge_name,c.description,pc.date_accomplished
        FROM participants_challenges pc
        JOIN participants p ON pc.participants_id = p.participants_id
        JOIN user u ON p.user_id = u.user_id
        JOIN challenges c ON pc.challenges_id = c.challenges_id
        WHERE pc.challenges_status = 'pending'";
    
    $pendingList = mysqli_query($database, $listQuery);
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
            Submission Statistics 
        </div>
        <div class="impact-container">

            <button class="impact-box">
                <h3><?= $pendingCount; ?></h3>
                <p>Pending Verifications</p>
            </button>

            <button class="impact-box">
                <h3><?= $approvedCount; ?></h3>
                <p>Approved Challenges</p>
            </button>

            <button class="impact-box">
                <h3><?= $rejectedCount; ?></h3>
                <p>Rejected Challenges</p>
            </button>

            <button class="impact-box">
                <h3><?= ($approvedCount + $pendingCount + $rejectedCount); ?></h3>
                <p>Total Submissions</p>
            </button>

        </div>
        <div class="text-box" onclick="window.location.href='participants-desktop-econews.php'"
            style="cursor: pointer;">
            Verifications Queue
        </div>

        <?php while ($row = mysqli_fetch_assoc($pendingList)): ?>

            <div class="content-container"
                onclick="window.location.href='staff-desktop-verification?id=<?= $row['participants_challenges_id']; ?>'">

                <button class="image-holder">
                    <img src="challenge_submission_uploads/<?= htmlspecialchars($row['proof_image']); ?>" alt="Proof Image">
                </button>

                <!-- u.user_full_name, c.challenge_name, c.description, pc.date_accomplished -->
                <button class="content-text-box">
                    <div class="text-inner">

                        <h4 class="category-box">
                            <?= htmlspecialchars($row['user_full_name']); ?>
                        </h4>

                        <h3 class="title-box">
                            <?= htmlspecialchars($row['challenge_name']); ?>
                        </h3>

                        <h5>
                            <?= date("d M Y", strtotime($row['date_accomplished'])); ?>
                        </h5>

                        <h5 class="description-box">
                            <?= htmlspecialchars($row['description']); ?>
                        </h5>

                    </div>
                </button>

                <button class="next-btn">
                    <img src="images/next.png" alt="Next Icon">
                </button>

            </div>

        <?php endwhile; ?>

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