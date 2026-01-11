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
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = mysqli_real_escape_string($database, $_POST['news_title']);
        $description = mysqli_real_escape_string($database, $_POST['news_description']);
        $venue = mysqli_real_escape_string($database, $_POST['news_venue']);
        $organised_by = mysqli_real_escape_string($database, $_POST['news_organiser']);
        $image_path = '';

        // handle image upload
        $posted_by = $_SESSION['user_role_id'];

        if (isset($_FILES['news_image']) && $_FILES['news_image']['error'] === 0) {
            $image_path = mysqli_real_escape_string($database, $_FILES['news_image']['name']);
            $tmpName   = $_FILES['news_image']['tmp_name'];

            // Create images directory if it doesn't exist
            $upload_dir = "../../images/";
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            if (!move_uploaded_file($tmpName, $upload_dir . $_FILES['news_image']['name'])) {
                echo "<script>alert('Error uploading image.'); window.location.href='event-manager-news-post-form.php';</script>";
                exit;
            }
        }

        $events_id = !empty($_POST['events_id']) ? intval($_POST['events_id']) : 'NULL';

        //save to db
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
    <link rel="stylesheet" href="../../mobile.css">
    <link rel="stylesheet" href="../css/event-manager-news-post-form.css">
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

        <a class="icon-link sidebar-icon" href="event-manager-calendar.php" aria-label="Callendar">
        <button class="icon-btn"><i data-lucide="calendar-fold"></i></button>
        </a>

        <a class="icon-link active sidebar-icon" href="event-manager-news.php" aria-label="News Feed Management">
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
        <a href="event-manager-home.php" class="nav-item">
            <i data-lucide="house" class="icon-btn"></i>
        </a>
        <a href="event-manager-calendar.php" class="nav-item">
            <i data-lucide="calendar-fold" class="icon-btn"></i>
        </a>
        <a href="event-manager-news.php" class="nav-item active">
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
            <div class="title-box"><h1>New News Post</h1></div>
        </div>
        <!-- News Form -->
        <div class="news-form-container">
            <form id="newsForm" method="POST" enctype="multipart/form-data" onsubmit="return validateImageUpload();">
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
    function validateImageUpload() {
        const imageInput = document.getElementById('news-image');

        if (!imageInput.files || imageInput.files.length === 0) {
            alert("Please upload an image before posting.");
            return false; // stop form submission
        }

        return true; // allow submission
    }
    function logout_confirm() {
                if (confirm("Are you sure you want to logout?")) {
                    window.location.href = "../../logout.php";
                }
            }
            
    lucide.createIcons();
    </script>
</body>
</html>