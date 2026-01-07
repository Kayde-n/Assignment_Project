<?php
    include("session.php");
    include("Database.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = mysqli_real_escape_string($database, $_POST['news_title']);
        $description = mysqli_real_escape_string($database, $_POST['news_description']);
        $venue = mysqli_real_escape_string($database, $_POST['news_venue']);
        $organised_by = mysqli_real_escape_string($database, $_POST['news_organiser']);
        $image_path = '';

        $posted_by = $_SESSION['user_id'];

        if (isset($_FILES['news_image']) && $_FILES['news_image']['error'] === 0) {
            $image_path = mysqli_real_escape_string($database, $_FILES['news_image']['name']);
            $tmpName   = $_FILES['news_image']['tmp_name'];

            // Create images directory if it doesn't exist
            $upload_dir = "images/";
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            if (!move_uploaded_file($tmpName, $upload_dir . $_FILES['news_image']['name'])) {
                echo "<script>alert('Error uploading image.'); window.location.href='event-manager-news-post-form.php';</script>";
                exit;
            }
        }

        $events_id = !empty($_POST['events_id']) ? intval($_POST['events_id']) : 'NULL';

        $insert_sql = "INSERT INTO eco_news (title, description, image_path, venue, organised_by, events_id, posted_by) 
        VALUES ('$title', '$description', '$image_path', '$venue', '$organised_by', '$events_id', '$posted_by')";
        
        if (mysqli_query($database, $insert_sql)) {
            echo "<script>alert('New news post created successfully.'); window.location.href='event-manager-news.php';</script>";
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
    <title>New News Post</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="event-manager.css">
    <link rel="stylesheet" href="event-manager-news-post-form.css">
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
            <button class="icon-btn" onclick="window.location.href='event-manager-calendar.php'"><img src="images/calendar.png" alt="Calendar"></button>
            <div id="news-icon-box">
                <button class="icon-btn" onclick="window.location.href='event-manager-news.php'"><img src="images/newspaper.png" alt="News"></button>
            </div>
            <button class="icon-btn" onclick="window.location.href='event-manager-rewards-management.php'"><img src="images/tag.png" alt="Rewards"></button>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="title-box"><h1>New News Post</h1></div>
        </div>
        <!-- News Form -->
        <div class="news-form-container">
            <form id="newsForm" method="POST" enctype="multipart/form-data">
                
                <!-- Title Field -->
                <div class="form-group">
                    <label for="news-title">News Title</label>
                    <input type="text" 
                           id="news-title" 
                           name="news_title" 
                           placeholder="Enter news title" 
                           required>
                </div>

                <!-- Description Field -->
                <div class="form-group">
                    <label for="news-description">Description</label>
                    <textarea id="news-description" 
                              name="news_description" 
                              rows="4"
                              placeholder="Enter news, announcement, or community update here" 
                              required></textarea>
                </div>

                <!-- Event Selection Field -->
                <div class="form-group">
                    <label for="events-id">Related Event</label>
                    <select id="events-id" name="events_id" required>
                        <option value="">-- Select an Event --</option>
                        <?php
                        include("Database.php");
                        $events_query = "SELECT events_id, event_name FROM events ORDER BY event_name";
                        $events_result = mysqli_query($database, $events_query);
                        
                        if ($events_result && mysqli_num_rows($events_result) > 0) {
                            while ($event = mysqli_fetch_assoc($events_result)) {
                                echo "<option value='" . $event['events_id'] . "'>" . htmlspecialchars($event['event_name']) . "</option>";
                            }
                        } else {
                            echo "<option value='' disabled>No events available</option>";
                        }
                        ?>
                    </select>
                </div>


                <!-- Venue Field -->
                <div class="form-group">
                    <label for="news-venue">Venue</label>
                    <textarea id="news-venue" 
                           name="news_venue" 
                           placeholder="Enter venue details" 
                           required></textarea>
                </div>

                <!-- Organised By Field -->
                <div class="form-group">
                    <label for="news-organiser">Organised By</label>
                    <input type="text" 
                           id="news-organiser" 
                           name="news_organiser" 
                           placeholder="Enter organiser details" 
                           required>
                </div>


                <!-- Upload Image Field -->
                <div class="form-group">
                    <label for="news-image">Upload Image</label>
                    <div class="upload-area" id="uploadArea" onclick="document.getElementById('news-image').click();" style="cursor: pointer;">
                        <input type="file" 
                               id="news-image" 
                               name="news_image" 
                               accept="image/*" 
                               onchange="handleImageUpload(event)"
                               style="display: none;">
                        <div class="upload-placeholder" id="uploadPlaceholder">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#BDBDBD" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                            <p>Click to upload image</p>
                        </div>
                        <img id="imagePreview" class="image-preview" style="display: none; max-width: 100%; height: auto;">
                    </div>
                </div>
        
                <!-- Submit Button -->
                <button type="submit" class="btn-post">Post</button>
            </form>
        </div>
    </div>
    <script>
    function handleImageUpload(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        const placeholder = document.getElementById('uploadPlaceholder');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = "block";
                placeholder.style.display = "none";
            };
            reader.readAsDataURL(file);
        }
    }
    </script>
</body>
</html>