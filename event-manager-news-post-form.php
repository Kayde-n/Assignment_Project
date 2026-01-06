<?php
    include("session.php");
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
            <form id="newsForm" method="POST" enctype="multipart/form-data" onsubmit="return handleSubmit(news)">
                
                <!-- Title Field -->
                <div class="form-group">
                    <label for="news-title">News Title</label>
                    <input type="text" 
                           id="news-title" 
                           name="news_title" 
                           placeholder="Enter news title" 
                           required>
                </div>

                <!-- Category Field -->
                <div class="form-group">
                    <label for="news-category">Category</label>
                    <select id="news-category" name="news_category" required>
                        <option value="">Select a category</option>
                        <option value="Events">Events</option>
                        <option value="Announcements">Announcements</option>
                        <option value="Updates">Updates</option>
                    </select>
                </div>

                <!-- Content Field -->
                <div class="form-group">
                    <label for="news-content">Content</label>
                    <textarea id="news-content" 
                              name="news_content" 
                              rows="4" 
                              placeholder="Enter news, announcement, or community update here" 
                              required></textarea>
                </div>

                <!-- Upload Image Field -->
                <div class="form-group">
                    <label for="news-image">Upload Image</label>
                    <div class="upload-area" id="uploadArea">
                        <input type="file" 
                               id="news-image" 
                               name="news_image" 
                               accept="image/*" 
                               onchange="handleImageUpload(event)">
                        <div class="upload-placeholder" id="uploadPlaceholder">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#BDBDBD" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                            <p>Click to upload image</p>
                        </div>
                        <img id="imagePreview" class="image-preview" style="display: none;">
                    </div>
                </div>
        


    </div>
</body>
</html>