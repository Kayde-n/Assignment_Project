<?php
    include("session.php");
    include("Database.php");
    $user_id = $_SESSION['user_id'];
    $participants_id = $_SESSION['user_role_id'];

    // DEBUG - Check what's in $_GET
    echo "<!-- GET array: ";
    print_r($_GET);
    echo " -->";
    
    echo "<!-- isset GET tab: " . (isset($_GET['tab']) ? 'YES' : 'NO') . " -->";
    echo "<!-- GET tab value: " . (isset($_GET['tab']) ? $_GET['tab'] : 'NOTHING') . " -->";

    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'ongoing';
    
    echo "<!-- active_tab variable: " . $active_tab . " -->";

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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Challenges Tab</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="participants_challenges.css">
    <link rel="stylesheet" href="participant.css">
</head>

<body>
    <div class="top-bar">
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover"><h2>EcoXP</h2></button>
        <div class="default-icon-container">
            <button class="icon-btn"><img src="images/profile.png" alt="Profile Logo"></button>
            <button class="icon-btn"><img src="images/notif.png" alt="Notification Logo"></button>
            <button class="icon-btn"><img src="images/setting.png" alt="Setting Logo"></button>
        </div>
    </div>
    
    <div class="side-bar">
            <div class="participant-icon-container">
            <button class="icon-btn" onclick="window.location.href='participants-desktop-home.php'"><img
                src="images/home.png" alt="Home"></button>
            <div id="challenges-icon-box">
                <button class="icon-btn" onclick="window.location.href='participants-desktop-challenges-tab.php'"><img src="images/challanges.png" alt="Challenges"></button>
            </div>    
            <button class="icon-btn" onclick="window.location.href='participants-desktop-logaction.php'"><img
                src="images/scan.png" alt="Scan"></button>
            <button class="icon-btn" onclick="window.location.href='participants-desktop-rewards.php'"><img
                src="images/tag.png" alt="Rewards"></button>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>

    <!-- Page wrapper -->
    <div class="challenges-page" id="challengesPage">

        <!-- Header -->
        <h1 class="header-title" id="headerTitle">Challenges</h1>


        <!-- Tabs (Ongoing / Completed) -->
        <nav class="tabs" id="tabs" role="tablist">
        <button class="tab tab-ongoing <?php echo ($active_tab == 'ongoing') ? 'active' : ''; ?>" 
                id="tabOngoing" 
                role="tab">
            Ongoing
        </button>
        <button class="tab tab-completed <?php echo ($active_tab == 'completed') ? 'active' : ''; ?>" 
                id="tabCompleted" 
                role="tab">
            Completed
        </button>
        </nav>

        <!-- Main content -->
        <main class="content" id="mainContent">

            <!-- Section: Daily Quests -->
            <section class="daily-quests-section" id="dailyQuestsSection">
                <h2 id="dailyQuestsHeading" class="section-title">Daily Quests</h2>

                <!-- Progress row (e.g., 2/5) -->
                <!-- Progress row - ALWAYS SHOW -->
            <div class="daily-progress" id="dailyProgress">
                <label for="dailyProgressMeter" class="progress-label">
                    <?php echo $completed_daily_total; ?>/<?php echo $daily_total; ?>
                </label>
                <!-- HTML progress element -->
                <progress id="dailyProgressMeter" class="progress-meter" 
                        value="<?php echo $completed_daily_total; ?>" 
                        max="<?php echo $daily_total; ?>">
                    <?php echo $completed_daily_total; ?> of <?php echo $daily_total; ?>
                </progress>
            </div>

                <!-- Quest list -->
                <div class="quest-list" id="questList">

                <!-- Quest list -->
                <div class="quest-list" id="questList">

                    <?php
                    // Reset the result pointer to the beginning
                    mysqli_data_seek($challenges_result, 0);
                    
                    // Loop through all challenges from the query
                    while ($row = mysqli_fetch_assoc($challenges_result)):
                        // Only show Daily challenges in this section
                        if ($row['challenge_type'] == 'Daily'):
                    ?>
                        <article class="quest-card" role="article">
                            <figure class="quest-image">
                                <img src="images/ecoxp-.png" alt="Quest image placeholder" />
                            </figure>

                            <div class="quest-body">
                                <span class="quest-tag"><?php echo htmlspecialchars($row['challenge_type']); ?></span>
                                <h3 class="quest-title"><?php echo htmlspecialchars($row['challenge_name']); ?></h3>
                                <p class="quest-reward"><?php echo htmlspecialchars($row['points_reward']); ?>GP</p>
                                <?php if ($active_tab == 'completed' && isset($row['verified_date']) && $row['verified_date']): ?>
                                <p class="quest-verified" style="font-size: 0.85em; color: #666; margin-top: 5px;">Verified: <?php echo date('M d, Y', strtotime($row['verified_date'])); ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="quest-action">
                                <?php
                                    $status = isset($row['challenges_status']) ? $row['challenges_status'] : null;

                                    if ($status === 'pending') {
                                ?>
                                    <button class="btn-pending" type="button" disabled aria-disabled="true">Pending</button>
                                <?php
                                    } elseif (is_null($status) || $status === '') {
                                ?>
                                    <a class="btn-logaction" href="participants-desktop-logaction.php?challenge_id=<?php echo urlencode($row['challenges_id']); ?>">Log Action</a>
                                <?php
                                    } elseif ($status === 'approved') {
                                ?>
                                    <button class="btn-approved" type="button" disabled>Claimed</button>
                                <?php
                                    } elseif ($status === 'rejected') {
                                ?>
                                    <button class="btn-rejected" type="button" disabled>Rejected</button>
                                <?php
                                    } else {
                                ?>
                                    <button class="btn-claimed" type="button" disabled><?php echo htmlspecialchars(ucfirst($status)); ?></button>
                                <?php
                                    }
                                ?>
                            </div>
                        </article>
                    <?php 
                        endif;
                    endwhile; 
                    ?>

                </div>

            <!-- Section divider -->
            <hr />

            <!-- Section: Special Events -->
            <section class="special-events-section" id="specialEventsSection" aria-labelledby="specialEventsHeading">
                <h2 id="specialEventsHeading" class="section-title">Upcoming Events</h2>

                <div class="event-list" id="eventList">

                <?php
                // Loop through all events from the query
                while ($event = mysqli_fetch_assoc($events_result)):
                ?>
                    <article class="event-card" role="article">
                        <figure class="event-image" aria-hidden="true">
                            <img src="images/<?php echo htmlspecialchars($event['image_path']); ?>" 
                                alt="<?php echo htmlspecialchars($event['title']); ?>" 
                                onerror="this.src='images/event-placeholder.png'" />
                        </figure>

                        <div class="event-body">
                            <h3 class="event-title"><?php echo htmlspecialchars($event['title']); ?></h3>
                            <p class="event-date"><?php echo date('M d, Y - H:i', strtotime($event['start_time'])); ?></p>
                            <p class="event-reward"><?php echo htmlspecialchars($event['points_rewarded']); ?>GP</p>
                        </div>

                        <div class="event-action">
                        <?php
                            // If attendance record exists for this participant & event, show status
                            if (!empty($event['attendance_id'])) {
                                if (isset($event['event_attended']) && $event['event_attended'] == 1) {
                                    // Already attended
                                    echo '<button class="btn-attended" type="button" disabled>Attended</button>';
                                } else {
                                    // Signed up but not yet attended
                                    echo '<button class="btn-signedup" type="button" disabled>Signed Up</button>';
                                }
                            } else {
                                if ($event['start_time'] <= date('Y-m-d H:i:s')) {
                                    // Event has already started/passed — no Join button
                                    echo '<button class="btn-closed" type="button" disabled>Event_Over</button>';
                                } else {
                                // Not signed up yet — show Join button
                        ?>
                            <button class="btn-join" 
                                    type="button"
                                    data-event-id="<?php echo htmlspecialchars($event['events_id']); ?>"
                                    data-eco-news-id="<?php echo htmlspecialchars($event['eco_news_id']); ?>"
                                    data-title="<?php echo htmlspecialchars($event['title']); ?>"
                                    data-description="<?php echo htmlspecialchars($event['description']); ?>"
                                    data-image="images/<?php echo htmlspecialchars($event['image_path']); ?>"
                                    data-venue="<?php echo htmlspecialchars($event['venue']); ?>"
                                    data-organizer="<?php echo htmlspecialchars($event['organised_by']); ?>"
                                    data-date="<?php echo date('M d, Y', strtotime($event['start_time'])); ?>"
                                    data-time="<?php echo date('H:i', strtotime($event['start_time'])); ?>"
                                    data-points="<?php echo htmlspecialchars($event['points_rewarded']); ?>GP"
                                    onclick="showEventDetails(this)">
                                Join
                            </button>
                        <?php }}
                         ?>
                        </div>
                    </article>
                <?php 
                endwhile; 
                ?>

            </div>
                <!-- Event Details Overlay -->
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

                </div>
            </section>

        </main>

        <!-- Bottom navigation (mobile-style) -->
        <nav class="bottom-nav" id="bottomNav" role="navigation">
            <button class="nav-item nav-home" id="navHome" type="button">Home</button>
            <button class="nav-item nav-challenges active" id="navChallenges" type="button">Challenges</button>
            <button class="nav-item nav-scan" id="navScan" type="button">Scan</button>
            <button class="nav-item nav-rewards" id="navRewards" type="button">Rewards</button>
            <button class="nav-item nav-profile" id="navProfile" type="button">Profile</button>
        </nav>

    </div>

    <script>
        // Tab switching
        document.getElementById('tabOngoing').addEventListener('click', function() {
            window.location.href = 'participants-desktop-challenges-tab.php?tab=ongoing';
        });

        document.getElementById('tabCompleted').addEventListener('click', function() {
            window.location.href = 'participants-desktop-challenges-tab.php?tab=completed';
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
    </script>

</body>

</html>