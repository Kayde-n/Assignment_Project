<?php
    require_once __DIR__ . "/../../session.php";
    require_once __DIR__ . "/../../config/Database.php";
    require_once __DIR__ . "/../../check-maintenance-status.php";

    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'event_manager') {
    echo "<script>
        alert('Access denied. Event Manager only.');
        window.location.href = '../../login.php';
    </script>";
    exit();
    }

    // run if the user has submitted a form
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

        // sql insert data into table
        $insert_sql = "INSERT INTO events (event_name, description, points_rewarded,venue,organised_by,organizer_email,start_time, end_time, max_participants) 
        VALUES ('$event_name', '$description', '$points_rewarded', '$venue', '$organised_by', '$organizer_email', '$start_time', '$end_time', '$max_participants')";
        if (mysqli_query($database, $insert_sql)) {
            echo "<script>alert('New event created successfully.'); window.location.href='event-manager-calendar.php';</script>";
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
    <link rel="stylesheet" href="../../mobile.css">

    <link rel="stylesheet" href="../css/event-manager-event-form.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
        <!-- top bar -->
    <header class="top-bar" role="banner">
    <div class="top-left">
        <button class="icon-btn no-hover topbar-icon" onclick="window.location.href='event-manager-home.php'" style="display:flex;align-items:center;gap:8px;">
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
        <a href="event-manager-profile.php" aria-label="Profile" class="topbar-icon">
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
        <a href="event-manager-home.php" class="icon-link sidebar-icon" aria-label="Home">
            <button class="icon-btn"><i data-lucide="house"></i></button>
        </a>
        </div>

        <a class="icon-link active sidebar-icon" href="event-manager-calendar.php" aria-label="Callendar">
        <button class="icon-btn"><i data-lucide="calendar-fold"></i></button>
        </a>

        <a class="icon-link sidebar-icon" href="event-manager-news.php" aria-label="News Feed Management">
        <button class="icon-btn"><i data-lucide="newspaper"></i></button>
        </a>

        <a class="icon-link sidebar-icon" href="event-manager-rewards-management.php" aria-label="Rewards">
        <button class="icon-btn"><i data-lucide="badge-percent"></i></button>
        </a>

    </div>

    <a class="icon-link sidebar-icon" id="logout" aria-label="Logout" onclick="return logout_confirm();">
        <button class="icon-btn"><i data-lucide="log-out"></i></button>
    </a>
    </nav>

    <!-- nav bar -->
    <nav class="bottom-nav">
        <a href="event-manager-home.php" class="nav-item active">
            <i data-lucide="house" class="icon-btn"></i>
        </a>
        <a href="event-manager-calendar.php" class="nav-item">
            <i data-lucide="calendar-fold" class="icon-btn"></i>
        </a>
        <a href="event-manager-news.php" class="nav-item">
            <i data-lucide="newspaper" class="icon-btn"></i>
        </a>
        <a href="event-manager-rewards-management.php" class="nav-item">
            <i data-lucide="badge-percent" class="icon-btn"></i>
        </a>
        <a href="event-manager-profile.php" class="nav-item">
            <i data-lucide="user-round" class="icon-btn"></i>
        </a>
        
    </nav>

    <main class="main-content">
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
    <script>
        function logout_confirm() {
                if (confirm("Are you sure you want to logout?")) {
                    window.location.href = "../../logout.php";
                }
            }

        lucide.createIcons();
    </script>

</body>
</html>