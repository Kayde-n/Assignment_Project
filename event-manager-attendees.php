<?php
    include("session.php");
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
        </div>

        <!-- Event Title -->
        <h2 class="event-title"><?php echo htmlspecialchars($event['event_name']); ?></h2>

        <!-- Progress -->
        <div class="progress-container">
            <div class="progress-bar">
                <div class="progress-fill" style="width:70%"></div>
            </div>
            <span class="progress-text">10/14</span>
        </div>

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
                    <tr>
                        <td>1.</td>
                        <td>Liam</td>
                        <td><label class="switch"><input type="checkbox"><span class="slider"></span></label></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Olivia</td>
                        <td><label class="switch"><input type="checkbox"><span class="slider"></span></label></td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>Ethan</td>
                        <td><label class="switch"><input type="checkbox" checked><span class="slider"></span></label></td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>Noah</td>
                        <td><label class="switch"><input type="checkbox" checked><span class="slider"></span></label></td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>Emma</td>
                        <td><label class="switch"><input type="checkbox" checked><span class="slider"></span></label></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </main>
</div>

</body>
</html>

        





    </div>
</body>
</html>