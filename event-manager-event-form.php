<?php
include("session.php");
include("Database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_name = $_POST['event_title'];
    $description = $_POST['event_details'];
    $points_rewarded = $_POST['points_awarded'];
    $max_participants = $_POST['max_participants'];
    $start_time = $_POST['start_date_time'];
    $end_time = $_POST['end_date_time'];
    $venue = $_POST['location'];
    $organised_by = $_POST['organiser'];
    $organizer_email = $_POST['organiser_email'];

    $insert_sql = "INSERT INTO events (event_name, description, points_rewarded,venue,organised_by,organizer_email,start_time, end_time, max_participants) 
    VALUES ('$event_name', '$description', '$points_rewarded', '$venue', '$organised_by', '$organizer_email', '$start_time', '$end_time', '$max_participants')";
    if (mysqli_query($database, $insert_sql)) {
        echo "<script>alert('New event created successfully.');</script>";
    } else {
        echo "Error: " . $insert_sql . "<br>" . mysqli_error($database);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Event Post</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="event-manager.css">
    <link rel="stylesheet" href="event-manager-event-form.css">
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
            <div class="title-box"><h1>New Event Post</h1></div>
        </div>

        <!-- Event Form -->
        <div class="event-form-container">
            <form id="eventForm" method="POST" enctype="multipart/form-data" onsubmit="return handleSubmit(event)">
                
                <!-- Title Field -->
                <div class="form-group">
                    <label for="event-title">Event Title</label>
                    <input type="text" 
                           id="event-title" 
                           name="event_title" 
                           placeholder="Enter event title" 
                           required>
                </div>

                <!-- Details Field -->
                <div class="form-group">
                    <label for="event-details">Event Details</label>
                    <textarea id="event-details" 
                              name="event_details" 
                              rows="4" 
                              placeholder="Enter event details and description" 
                              required></textarea>
                </div>

                <div class = "row">
                    <!-- Points Awarded Field -->
                    <div class="form-group">
                        <label for="points-awarded">Points Awarded</label>
                        <input type="number" 
                            id="points-awarded" 
                            name="points_awarded" 
                            placeholder="Enter points awarded" 
                            min="1" 
                            required>
                    </div>

                    <!-- Max Participants Field -->
                    <div class="form-group">
                        <label for="max-participants">Max Participants</label>
                        <input type="number" 
                            id="max-participants" 
                            name="max_participants" 
                            placeholder="Enter max participants" 
                            min="1" 
                            required>
                    </div>
                </div>

                <div class = "row">
                    <!-- Start Date and Time Field -->
                    <div class="form-group">
                        <label for="start-date-time">Start Date and Time</label>
                        <input type="datetime-local" 
                            id="start-date-time" 
                            name="start_date_time" 
                            required>
                    </div>

                    <!-- End Date and Time Field -->
                    <div class="form-group">
                        <label for="end-date-time">End Date and Time</label>
                        <input type="datetime-local" 
                            id="end-date-time" 
                            name="end_date_time" 
                            required>
                    </div>
                </div>

                <div class = "row">
                    <div class="form-group">
                        <label for="Organiser">Organiser</label>
                        <input type="text" 
                            id="organiser" 
                            name="organiser" 
                            placeholder="Enter The organiser" 
                            required>
                    </div>
                    <div class="form-group">
                        <label for="Organiser Email">Organiser Email</label>
                        <input type="text" 
                            id="organiser_email" 
                            name="organiser_email" 
                            placeholder="Enter The organiser Email" 
                            required>
                    </div>
                </div>
                <div class = "row">
                    <!-- Location/Online Link -->
                    <div class="form-group">
                        <label for="location">Location/Online Link</label>
                        <input type="text" 
                            id="location" 
                            name="location" 
                            placeholder="Enter location or online link" 
                            required>
                    </div>  
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn-post">Post</button>
            </form>
        </div>
    </div>

</body>
</html>