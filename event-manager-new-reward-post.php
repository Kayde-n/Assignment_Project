<?php
include("session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Reward Post</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="event-manager.css">
    <link rel="stylesheet" href="event-manager-new-reward-post.css">
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
            <button class="icon-btn" onclick="window.location.href='event-manager-news.php'"><img src="images/newspaper.png" alt="News"></button>
            <div id="reward-icon-box">
                <button class="icon-btn" onclick="window.location.href='event-manager-rewards-management.php'"><img
                        src="images/tag.png" alt="Rewards"></button>
            </div>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>
    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="title-box"><h1>New Reward Post</h1></div>
        </div>

        <!-- Reward Form -->
        <div class="reward-form-container">
            <form id="rewardForm" method="POST" enctype="multipart/form-data" onsubmit="return handleSubmit(event)">
                
                <!-- Title Field -->
                <div class="form-group">
                    <label for="reward-title">Title</label>
                    <input type="text" 
                           id="reward-title" 
                           name="reward_title" 
                           placeholder="Enter reward title" 
                           required>
                </div>

                <!-- Category Field -->
                <div class="form-group">
                    <label for="reward-category">Category</label>
                    <select id="reward-category" name="reward_category" required>
                        <option value="" disabled selected>Select category</option>
                        <option value="Discount/Vouchers">Discount/Vouchers</option>
                        <option value="Physical Rewards">Physical Rewards</option>
                        <option value="Gift Cards">Gift Cards</option>
                        <option value="Merchandise">Merchandise</option>
                    </select>
                </div>

                <!-- Points Required Field -->
                <div class="form-group">
                    <label for="points-required">Points Required</label>
                    <input type="number" 
                           id="points-required" 
                           name="points_required" 
                           placeholder="Enter points required" 
                           min="1" 
                           required>
                </div>

                <!-- Quantity Field -->
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" 
                           id="quantity" 
                           name="quantity" 
                           placeholder="Enter quantity available" 
                           min="1" 
                           required>
                </div>

                <!-- Description Field -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" 
                              name="description" 
                              rows="4" 
                              placeholder="Enter reward description and terms & conditions" 
                              required></textarea>
                </div>

                <!-- Upload Image Field -->
                <div class="form-group">
                    <label for="reward-image">Upload Image</label>
                    <div class="upload-area" id="uploadArea">
                        <input type="file" 
                               id="reward-image" 
                               name="reward_image" 
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

                <!-- Submit Button -->
                <button type="submit" class="btn-post">Post</button>
            </form>
        </div>
    </div>

</body>
</html>