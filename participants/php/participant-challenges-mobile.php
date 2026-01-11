<?php
    require_once __DIR__ . "/../../session.php";
    require_once __DIR__ . "/../../config/database.php";
    require_once __DIR__ . "/../../check-maintenance-status.php";
    $user_id = $_SESSION['user_id'];
    $participants_id = $_SESSION['user_role_id'];

    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'ongoing';
    
    if ($active_tab == 'ongoing') {
        $sql = "SELECT challenges.challenges_id,challenges.challenge_name,challenges.points_reward,challenges.challenge_type,participants_challenges.challenges_status, participants_challenges.date_accomplished
        FROM challenges
        LEFT JOIN participants_challenges
            ON challenges.challenges_id = participants_challenges.challenges_id
            AND participants_challenges.participants_id = $participants_id
            AND DATE(participants_challenges.date_accomplished) = CURDATE()
        WHERE challenges.challenge_type = 'Daily'
        AND (participants_challenges.challenges_id IS NULL
            OR participants_challenges.challenges_status = 'pending')";
        
        $challenges_result = mysqli_query($database, $sql);

    } else if ($active_tab == 'completed') {
        $sql= "SELECT challenges.challenges_id,challenges.challenge_name,challenges.points_reward,challenges.challenge_type,participants_challenges.challenges_status,participants_challenges.verified_date
        FROM challenges
        INNER JOIN participants_challenges
            ON challenges.challenges_id = participants_challenges.challenges_id
        WHERE participants_challenges.participants_id = $participants_id
         AND participants_challenges.challenges_status IN ('approved', 'rejected')
         ORDER BY participants_challenges.verified_date DESC";

        $challenges_result = mysqli_query($database, $sql);
    }

     //counting the number of daily quest in db
    $dailes_total_sql="SELECT challenges.challenges_id,challenges.challenge_name,challenges.points_reward,challenges.challenge_type
            FROM challenges
            Where challenges.challenge_type = 'Daily'";
    
    $dailes_total_result = mysqli_query($database, $dailes_total_sql);
    $daily_total = mysqli_num_rows($dailes_total_result);

    //to get all completed/rejected/pending that are daily
    $compledted_sql= "SELECT challenges.challenges_id,challenges.challenge_name,challenges.points_reward,challenges.challenge_type,participants_challenges.challenges_status
        FROM challenges
        INNER JOIN participants_challenges
            ON challenges.challenges_id = participants_challenges.challenges_id
        WHERE participants_challenges.participants_id = $participants_id
         AND participants_challenges.challenges_status IN ('approved', 'rejected','pending')
         AND challenges.challenge_type = 'Daily'
         AND participants_challenges.verified_date= CURDATE()";

    $daily_completed_total_result = mysqli_query($database, $compledted_sql);
    $completed_daily_total = mysqli_num_rows($daily_completed_total_result);

        //Special Events section - include attendance info for current participant
        $events_sql = "SELECT eco_news.eco_news_id, eco_news.title, eco_news.description, eco_news.image_path, eco_news.venue, eco_news.organised_by, events.start_time, events.points_rewarded, events.events_id, attendance.attendance_id, attendance.event_attended
            FROM eco_news
            JOIN events ON eco_news.events_id = events.events_id
            LEFT JOIN attendance ON attendance.events_id = events.events_id AND attendance.participants_id = $participants_id
            ORDER BY events.start_time DESC LIMIT 10";

        $events_result = mysqli_query($database, $events_sql);

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant Challenges Mobile</title>
    <link rel="stylesheet" href="../../mobile.css">
    <link rel="stylesheet" href="../css/participant-challenges-mobile.css">    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <!-- top bar -->
    <header class="top-bar" role="banner">
    <div class="top-left">
        <button class="icon-btn no-hover topbar-icon" onclick="window.location.href='participant-home-mobile.php'" style="display:flex;align-items:center;gap:8px;">
            <svg width="56" height="56" viewBox="0 0 72 72" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                <path d="M17.0278 55.17C17.9238 56.03 18.8788 56.833 19.8928 57.579C23.3048 55.1141 26.0849 51.8767 28.0058 48.1313C29.9267 44.386 30.9338 40.2392 30.9448 36.03C30.9448 27.216 26.5978 19.398 19.8748 14.478C18.8713 15.2154 17.9201 16.0213 17.0278 16.89C20.2462 18.9439 22.8981 21.7722 24.7408 25.1159C26.5835 28.4597 27.5583 32.2122 27.5758 36.03C27.5758 44.016 23.3968 51.042 17.0278 55.17Z" fill="var(--primary-green)"/>
                <path d="M57.0119 19.125C55.1822 23.1625 52.2267 26.5866 48.4997 28.9864C44.7728 31.3863 40.4326 32.6601 35.9999 32.655C31.5676 32.6595 27.2281 31.3854 23.5018 28.9856C19.7754 26.5858 16.8203 23.1621 14.9909 19.125C14.1119 20.205 13.3199 21.366 12.6299 22.578C15.0031 26.6727 18.4119 30.0707 22.5141 32.4309C26.6162 34.7911 31.2672 36.0303 35.9999 36.024C40.7325 36.0303 45.3835 34.7911 49.4857 32.4309C53.5878 30.0707 56.9967 26.6727 59.3699 22.578C58.6743 21.3678 57.886 20.2133 57.0119 19.125ZM30.9449 62.427C31.2809 47.787 43.0769 36.027 57.5669 36.027C59.3783 36.0212 61.1852 36.2063 62.9579 36.579C62.929 37.7587 62.8227 38.9352 62.6399 40.101C60.8168 39.6325 58.9422 39.3947 57.0599 39.393C54.0149 39.4167 51.005 40.0462 48.2057 41.2447C45.4064 42.4432 42.8736 44.1869 40.7549 46.374C38.6374 48.5623 36.9773 51.1506 35.8714 53.9878C34.7655 56.8249 34.236 59.854 34.3139 62.898C33.1812 62.8209 32.0553 62.6635 30.9449 62.427Z" fill="var(--primary-green)"/>
                <path d="M59.5382 37.509C58.7462 49.572 48.2161 59.616 36.0001 59.616C35.0881 59.618 34.1841 59.561 33.2881 59.445L32.8681 62.817C36.416 63.2333 40.0111 62.9403 43.4447 61.955C46.8783 60.9697 50.0817 59.3118 52.8689 57.0776C55.6561 54.8433 57.9715 52.0774 59.6803 48.9405C61.3892 45.8036 62.4575 42.3584 62.8232 38.805L59.5892 37.695L59.5382 37.491V37.509ZM58.8152 21.639C55.7076 16.6761 51.0676 12.8608 45.5977 10.7707C40.1278 8.6807 34.1259 8.42974 28.5007 10.0558C22.8754 11.682 17.9332 15.0966 14.4221 19.7827C10.911 24.4689 9.02242 30.1715 9.04215 36.027C9.04215 44.382 12.8521 51.867 18.8131 56.802L21.5791 54.492C18.7623 52.3004 16.4753 49.5023 14.8882 46.3056C13.301 43.1089 12.4544 39.5958 12.4111 36.027C12.4111 23.322 23.2951 12.438 36.0001 12.438C40.1006 12.4994 44.1165 13.6131 47.6629 15.6723C51.2092 17.7316 54.1672 20.6673 56.2531 24.198L58.8152 21.639Z" fill="var(--primary-green)"/>
            </svg>
            <h2 class="top-title">EcoXP</h2>
        </button>
    </div>

    <div class="top-center">
    </div>

    <div class="top-right">
        <a href="participant-profile-mobile.php" aria-label="Profile" class="topbar-icon">
            <button class="icon-btn" aria-label="Profile">
                <i data-lucide="user-round"></i>
            </button>
        </a>
    </div>
    </header>

<!-- side bar -->
    <nav class="side-bar" role="navigation" aria-label="Main">
    <div class="participant-icon-container">
        <div id="home-icon-box">
        <a href="participant-home-mobile.php" class="icon-link sidebar-icon" aria-label="Home">
            <button class="icon-btn"><i data-lucide="house"></i></button>
        </a>
        </div>

        <a class="icon-link active sidebar-icon" href="participant-challenges-mobile.php" aria-label="Challenges">
        <button class="icon-btn"><i data-lucide="trophy"></i></button>
        </a>

        <a class="icon-link sidebar-icon" href="participant-action-submit-mobile.php" aria-label="Scan / Log Action">
        <button class="icon-btn"><i data-lucide="scan-line"></i></button>
        </a>

        <a class="icon-link sidebar-icon" href="participant-rewards-mobile.php" aria-label="Rewards">
        <button class="icon-btn"><i data-lucide="badge-percent"></i></button>
        </a>


    </div>

    <a class="icon-link sidebar-icon" id="logout" style="cursor: pointer;">
            <button class="icon-btn" onclick="logout_confirm()">
                <i data-lucide="log-out"></i>
            </button>
        </a>

        <script>
        function logout_confirm() {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = "../../logout.php";
            }
        }
        </script>
    </nav>

<!-- nav bar -->
    <nav class="bottom-nav">
        <a href="participant-home-mobile.php" class="nav-item">
            <i data-lucide="house" class="icon-btn"></i>
        </a>
        <a href="participant-challenges-mobile.php" class="nav-item active">
            <i data-lucide="trophy" class="icon-btn"></i>
        </a>
        <a href="participant-action-submit-mobile.php" class="nav-item">
            <i data-lucide="scan-line" class="icon-btn"></i>
        </a>
        <a href="participant-rewards-mobile.php" class="nav-item">
            <i data-lucide="badge-percent" class="icon-btn"></i>
        </a>
        <a href="participant-profile-mobile.php" class="nav-item">
            <i data-lucide="user-round" class="icon-btn"></i>
        </a>
    </nav>

<main class="main-content">
<!-- title -->
    <div class="page-header">
        <div class="header-title">Challenges</div>     
    </div>
<!-- category pill -->
    <div class="pill-filter">
        <button class="category-pill <?php echo ($active_tab == 'ongoing') ? 'active' : ''; ?>" 
                id="tabOngoing" 
                role="tab">
            Ongoing
        </button>
        <button class="category-pill <?php echo ($active_tab == 'completed') ? 'active' : ''; ?>" 
                id="tabCompleted" 
                role="tab">
            Completed
        </button>
    </div>
<!-- daily -->
    <section class="daily-quest-container">
        <div class="section-header">
            <div class="section-title">Daily Quest</div>
        </div>
<!-- daily streak -->
        <div class="daily-streak">
            <div class="streak-bar">
                <?php
                $percent = ($daily_total > 0) ? ($completed_daily_total / $daily_total) * 100 : 0;
                ?>
                <div class="streak-fill" style="width: <?php echo $percent; ?>%;"></div>
            </div>
            <div class="streak-info">
                <span class="streak-text"><?php echo $completed_daily_total; ?>/<?php echo $daily_total; ?></span>
                <i data-lucide="flame" class="streak-icon"></i>
            </div>
        </div>
<!-- daily quest -->
        <?php
            mysqli_data_seek($challenges_result, 0);

            while ($row = mysqli_fetch_assoc($challenges_result)):
            // Only filter Daily for ONGOING tab
            if ($active_tab === 'ongoing' && $row['challenge_type'] !== 'Daily') {
                continue;
            }

                $status = $row['challenges_status'] ?? null;
            ?>
            <div class="dailies-card">
                <svg xmlns="http://www.w3.org/2000/svg" class="dailies-image" width="45" height="45" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-swords-icon lucide-swords"><polyline points="14.5 17.5 3 6 3 3 6 3 17.5 14.5"/><line x1="13" x2="19" y1="19" y2="13"/><line x1="16" x2="20" y1="16" y2="20"/><line x1="19" x2="21" y1="21" y2="19"/><polyline points="14.5 6.5 18 3 21 3 21 6 17.5 9.5"/><line x1="5" x2="9" y1="14" y2="18"/><line x1="7" x2="4" y1="17" y2="20"/><line x1="3" x2="5" y1="19" y2="21"/></svg>


                <div class="dailies-content">
                <h4 class="dailies-title">
                    <?php echo htmlspecialchars($row['challenge_name']); ?>
                </h4>

                <div class="dailies-details">
                    <p class="dailies-text">
                        <?php echo htmlspecialchars($row['points_reward']); ?> GP
                    </p>

                    <?php if ($active_tab === 'completed' && !empty($row['verified_date'])): ?>
                        <p class="dailies-text verified-date">
                            Verified on: <?php echo date('d M Y', strtotime($row['verified_date'])); ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($status === 'pending'): ?>
                        <div class="dailies-btn-pending">Pending</div>

                    <?php elseif (is_null($status)): ?>
                        <a href="participant-action-submit-mobile.php?challenge_id=<?php echo $row['challenges_id']; ?>">
                            <div class="dailies-btn">Log Action</div>
                        </a>

                    <?php elseif ($status === 'approved'): ?>
                        <div class="dailies-btn active">Claimed</div>

                    <?php elseif ($status === 'rejected'): ?>
                        <div class="dailies-btn-rejected">Rejected</div>
                    <?php endif; ?>
                </div>
            </div>
            </div>
            <?php endwhile; ?>
    </section>
<!-- special events -->
    <section class="specials-container">
        <div class="section-header">
            <div class="section-title">Special Events</div>
        </div>

        <?php while ($event = mysqli_fetch_assoc($events_result)): ?>
            <div class="specials-card">
                <img src="../../images/<?php echo htmlspecialchars($event['image_path']); ?>"
                    class="specials-image"
                    alt="event image"
                    onerror="this.src='../../images/event-placeholder.png'">

                <div class="specials-content">
                    <h4 class="specials-title">
                        <?php echo htmlspecialchars($event['title']); ?>
                    </h4>

                    <div class="specials-details">
                        <p class="specials-text">
                            <?php echo htmlspecialchars($event['points_rewarded']); ?> GP
                        </p>
                        <?php
                            // If attendance record exists for this participant & event, show status
                            if (!empty($event['attendance_id'])) {
                                if (isset($event['event_attended']) && $event['event_attended'] == 1) {
                                    // Already attended
                                    echo '<div class="specials-btn active" disabled>Attended</div>';
                                } else {
                                    // Signed up but not yet attended
                                    echo '<div class="specials-btn active" disabled>Signed Up</div>';
                                }
                            } else {
                                if ($event['start_time'] <= date('Y-m-d H:i:s')) {
                                    // Event has already started/passed — no Join button
                                    echo '<div class="specials-btn active" disabled>Closed</div>';
                                } else {
                                    // Not signed up yet — show Join button
                                    echo '<div class="specials-btn" onclick="showEventDetails(this)"
                                            data-event-id="' . htmlspecialchars($event['events_id']) . '"
                                            data-eco-news-id="' . htmlspecialchars($event['eco_news_id']) . '"
                                            data-title="' . htmlspecialchars($event['title']) . '"
                                            data-description="' . htmlspecialchars($event['description']) . '"
                                            data-image="../../images/' . htmlspecialchars($event['image_path']) . '"
                                            data-venue="' . htmlspecialchars($event['venue']) . '"
                                            data-organizer="' . htmlspecialchars($event['organised_by']) . '"
                                            data-date="' . date('M d, Y', strtotime($event['start_time'])) . '"
                                            data-time="' . date('H:i', strtotime($event['start_time'])) . '"
                                            data-points="' . htmlspecialchars($event['points_rewarded']) . 'GP"
                                        >Join</div>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
            <div class="event-details-overlay" id="eventDetailsOverlay">
                    <div class="event-details-container">
                        <button class="event-details-close" id="closeEventDetails">&times;</button>
                        
                        <img class="event-details-image" id="eventImage" src="" alt="Event image">
                        
                        <h2 class="event-details-title" id="eventTitle"></h2>
                        
                        <div class="event-details-description" id="eventDescription"></div>
                        
                        <div class="event-details-info">
                            <div class="event-info-row">
                                <span class="event-info-label">Points Reward:</span>
                                <span class="event-info-value" id="eventPoints"></span>
                            </div>
                            <div class="event-info-row">
                                <span class="event-info-label">Start Time:</span>
                                <span class="event-info-value" id="eventTime"></span>
                            </div>
                            <div class="event-info-row">
                                <span class="event-info-label">Date:</span>
                                <span class="event-info-value" id="eventDate"></span>
                            </div>
                            <div class="event-info-row">
                                <span class="event-info-label">Venue:</span>
                                <span class="event-info-value" id="eventVenue"></span>
                            </div>
                            <div class="event-info-row">
                                <span class="event-info-label">Organiser:</span>
                                <span class="event-info-value" id="eventOrganizer"></span>
                            </div>
                        </div>
                        
                        <div class="event-details-actions">
                            <button class="btn-cancel" id="cancelEvent">Cancel</button>
                            <button class="btn-join-event" id="joinEventBtn">Join Event</button>
                        </div>
                    </div>
                </div>

</main>

    <script>
        // Tab switching
        document.getElementById('tabOngoing').addEventListener('click', function() {
            window.location.href = 'participant-challenges-mobile.php?tab=ongoing';
        });

        document.getElementById('tabCompleted').addEventListener('click', function() {
            window.location.href = 'participant-challenges-mobile.php?tab=completed';
        });

        // Event details modal
        function showEventDetails(button) {
            const overlay = document.getElementById('eventDetailsOverlay');
            
            // Populate modal with event data
            document.getElementById('eventImage').src = button.dataset.image;
            document.getElementById('eventTitle').textContent = button.dataset.title;
            document.getElementById('eventDescription').textContent = button.dataset.description;
            document.getElementById('eventDate').textContent = button.dataset.date;
            document.getElementById('eventVenue').textContent = button.dataset.venue || 'N/A';
            document.getElementById('eventOrganizer').textContent = button.dataset.organizer || 'N/A';
            document.getElementById('eventPoints').textContent = button.dataset.points;
            document.getElementById('eventTime').textContent = button.dataset.time;
            
            // Store event IDs for join action
            document.getElementById('joinEventBtn').dataset.eventId = button.dataset.eventId;
            document.getElementById('joinEventBtn').dataset.ecoNewsId = button.dataset.ecoNewsId;
            
            // Show overlay
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        // Close event details
        document.getElementById('closeEventDetails').addEventListener('click', function() {
            closeEventDetails();
        });

        document.getElementById('cancelEvent').addEventListener('click', function() {
            closeEventDetails();
        });

        function closeEventDetails() {
            const overlay = document.getElementById('eventDetailsOverlay');
            overlay.classList.remove('active');
            document.body.style.overflow = ''; // Restore scrolling
        }   
        

    // Close overlay when clicking outside the container
    document.getElementById('eventDetailsOverlay').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEventDetails();
        }
    });

    document.getElementById('joinEventBtn').addEventListener('click', function () {
    const eventId = this.dataset.eventId;
    window.location.href = 'join-event.php?event_id=' + eventId;
    });
        lucide.createIcons();
    </script>

</body>
</html>