<?php
    include("session.php");
    include("Database.php");

    if (isset($_GET['events_id'])) {
    $eventId = $_GET['events_id'];  
    echo "Event ID is: " . $eventId;
    }

    $specificevent_sql="SELECT events.events_id,events.event_name,events.description,events.venue,events.organised_by,events.organizer_email,events.start_time,events.end_time,events.max_participants,events.points_rewarded,eco_news.image_path
    FROM events
    LEFT JOIN eco_news ON eco_news.events_id = events.events_id
     WHERE events.events_id = '$eventId'";
    
    $event_result = mysqli_query($database, $specificevent_sql);
    $event = mysqli_fetch_assoc($event_result);

    $start_datetime = date('d M Y, h:i A', strtotime($event['start_time']));
    $end_datetime = date('d M Y, h:i A', strtotime($event['end_time']));
    $image=$event['image_path'];
    $image = !empty($event['image_path'])
    ? $event['image_path']
    : 'images/default-event.jpg';

?>

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
                    <img src="images/<?php echo htmlspecialchars($image); ?>"alt="Event Image" class="event-image">
            </div>

            <!-- Event Title -->
            <h2 class="event-title"><?php echo htmlspecialchars($event['event_name']); ?></h2>


            <!-- Event Info Grid -->
            <div class="event-info-grid">
                <!-- Date & Time -->
                <div class="info-item">
                    <div class="info-label">Date & Time</div>
                    <div><strong>Start:</strong> <?php echo $start_datetime; ?></div>
                    <div><strong>End:</strong> <?php echo $end_datetime; ?></div>
                </div>

                <!-- Type & Location -->
                <div class="info-item">
                    <div class="info-label">Type & Location</div>
                    <div class="info-value">
                        <?php echo htmlspecialchars($event['venue']); ?>
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
                    <div class="info-value"><?php echo $event['points_rewarded']; ?> GP</div>
                </div>
            </div>

            <!-- View Attendees Button -->
            <button class="btn-attendees" onclick="window.location.href='event-manager-attendees.php?events_id=<?php echo $eventId; ?>'">
                View Attendees
            </button>
        </div>
    </div>

</body>
</html>