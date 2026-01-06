<?php
    include("session.php");
    include("Database.php");

    if (isset($_GET['events_id'])) {
    $eventId = $_GET['events_id'];  
    echo "Event ID is: " . $eventId;
    }

    $specificevent_sql="SELECT events.events_id,events.event_name,events.max_participants,eco_news.image_path
    FROM events
    LEFT JOIN eco_news ON eco_news.events_id = events.events_id
     WHERE events.events_id = '$eventId'";
    
    $event_result = mysqli_query($database, $specificevent_sql);
    $event = mysqli_fetch_assoc($event_result);

    $image=$event['image_path'];
    $image = !empty($event['image_path'])
    ? $event['image_path']
    : 'images/default-event.jpg';


    $present = "SELECT COUNT(attendance_id) as present_count 
    FROM attendance 
    WHERE events_id = '$eventId' 
    AND event_attended = '1'";

    $present_participants = mysqli_query($database, $present);
    $present_count = mysqli_fetch_assoc($present_participants);

    


mysqli_free_result($present_participants);


    $participants_name = "SELECT participants.participants_id, user.user_full_name, attendance.event_attended, events.events_id
                        FROM participants
                        JOIN user ON participants.user_id = user.user_id
                        JOIN attendance ON participants.participants_id = attendance.participants_id
                        JOIN events ON attendance.events_id = events.events_id
                        WHERE events.events_id = '$eventId'";


    $participants_name_result = mysqli_query($database, $participants_name);

    if (!$participants_name_result) {
    die("Query failed: " . mysqli_error($database));
    }

    $total_participants= mysqli_num_rows($participants_name_result);


    $attendance_percentage = ($total_participants > 0) 
        ? ($present_count['present_count'] / $total_participants) * 100 
        : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendees</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="event-manager.css">
    <link rel="stylesheet" href="event-manager-attendees.css">
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
        <!-- Page Header -->
        <div class="page-header">
            <div class="title-box"><h1>View Attendees</h1></div>
        </div>
        <div class="attendees-container">
            <!-- Event Image -->
            <div class="event-image-container">
                <img src="images/<?php echo $image; ?>" alt="Event Image" class="event-image">
            </div>
        </div>

        <!-- Event Title -->
        <h2 class="event-title"><?php echo htmlspecialchars($event['event_name']); ?></h2>

        <!-- Progress -->
        <?php
            if ($total_participants == 0) {
                echo '<p class="no-attendance-message">No attendance records yet for this event.</p>';
            } else {
                // Show progress bar
                ?>
                <div class="progress-container">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: <?php echo round($attendance_percentage, 2); ?>%;"></div>
                    </div>
                    <span class="progress-text"><?php echo $present_count['present_count']; ?>/<?php echo $total_participants; ?></span>
                </div>
                <?php
            }
            ?>


        <!-- Attendance Table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $counter = 1;
                    while ($row = mysqli_fetch_assoc($participants_name_result)) { 
                    ?>
                    <tr>
                        <td><?php echo $counter; ?>.</td>
                        <td><?php echo htmlspecialchars($row['user_full_name']); ?></td>
                        <td><label class="switch">
                            <input type="checkbox"
                            class="attendance-toggle"
                            data-event-id="<?php echo htmlspecialchars($eventId); ?>"
                            data-participant-id="<?php echo htmlspecialchars($row['participants_id']); ?>"
                            <?php echo ($row['event_attended'] == 1) ? 'checked' : ''; ?>>
                        <span class="slider"></span></label></td>
                    </tr>
                    <?php $counter++; } ?>
                    
                </tbody>
                <?php
                    // Free result set
                    mysqli_free_result($participants_name_result);
                    ?>
            </table>
        </div>

    </main>
</div>

</body>
</html>

        





    </div>
</body>
</html>