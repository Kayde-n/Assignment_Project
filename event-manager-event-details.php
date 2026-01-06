<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="event-manager.css">
    <link rel="stylesheet" href="event-manager-event-details.css">
</head>
<body>
    <div class="top-bar">
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='participants-desktop-home.php'">
            <h2>EcoXP</h2>
        </button>
        <div class="default-icon-container">
            <button class="icon-btn"><img
                    src="images/profile.png" alt="Profile Logo"></button>
            <button class="icon-btn"><img src="images/notif.png" alt="Notification Logo"></button>
            <button class="icon-btn"><img src="images/setting.png" alt="Setting Logo"></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="event-manager-icon-container">
            <button class="icon-btn" onclick="window.location.href='event-manager-home.php'"><img src="images/home.png" alt="Home"></button>
            <div id="calendar-icon-box">
                <button class="icon-btn" onclick="window.location.href='event-manager-calendar.php'"><img src="images/calendar.png" alt="Calendar"></button>
            </div>
            <button class="icon-btn" onclick="window.location.href='event-manager-news.php'"><img src="images/newspaper.png" alt="News"></button>
            <button class="icon-btn" onclick="window.location.href='event-manager-rewards-management.php'"><img src="images/tag.png" alt="Rewards"></button>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Event Details Card -->
        <div class="event-details-container">
            <!-- Event Image -->
            <div class="event-image-container">
                <?php if (!empty($event['image_path']) && file_exists($event['image_path'])): ?>
                    <img src="<?php echo htmlspecialchars($event['image_path']); ?>" alt="Event Image" class="event-image">
                <?php else: ?>
                    <div class="event-image-placeholder">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#90A4AE" stroke-width="1.5">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Event Title -->
            <h2 class="event-title"><?php echo htmlspecialchars($event['event_name']); ?></h2>

            <!-- Event Description -->
            <div class="event-description">
                <p><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>
                
                <?php if (!empty($event['things_to_bring'])): ?>
                    <p><strong>Things to bring:</strong> <?php echo htmlspecialchars($event['things_to_bring']); ?></p>
                <?php endif; ?>
                
                <?php if (!empty($event['dress_code'])): ?>
                    <p><strong>Dress code:</strong> <?php echo htmlspecialchars($event['dress_code']); ?></p>
                <?php endif; ?>
            </div>

            <!-- Event Info Grid -->
            <div class="event-info-grid">
                <!-- Date & Time -->
                <div class="info-item">
                    <div class="info-label">Date & Time</div>
                    <div class="info-value">
                        <?php 
                            $start_date = date('d M Y, h:i A', strtotime($event['start_datetime']));
                            $end_time = date('h:i A', strtotime($event['end_datetime']));
                            echo $start_date . ' - ' . $end_time;
                        ?>
                    </div>
                </div>

                <!-- Type & Location -->
                <div class="info-item">
                    <div class="info-label">Type & Location</div>
                    <div class="info-value">
                        <?php echo htmlspecialchars($event['event_type']); ?> - <?php echo htmlspecialchars($event['location']); ?>
                    </div>
                </div>

                <!-- Max Participants -->
                <div class="info-item">
                    <div class="info-label">Max Participants</div>
                    <div class="info-value"><?php echo $event['max_participants']; ?></div>
                </div>

                <!-- Points Awarded -->
                <div class="info-item">
                    <div class="info-label">Points Awarded</div>
                    <div class="info-value"><?php echo $event['points_awarded']; ?> GP</div>
                </div>
            </div>

            <!-- View Attendees Button -->
            <button class="btn-attendees" onclick="viewAttendees(<?php echo $event_id; ?>)">
                View Attendees
            </button>
        </div>
    </div>

</body>
</html>