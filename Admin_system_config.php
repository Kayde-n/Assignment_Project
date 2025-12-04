<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <div class="container">
        <!-- Header Section -->
        <header>
            <button class="back-btn">
                <img src="Images/back-arrow.png" alt="Back">
            </button>
            <h1>System Settings</h1>
        </header>

        <!-- System Maintenance Section -->
        <section class="system-maintenance">
            <h2>System Maintenance</h2>
            
            <!-- Toggle Switch -->
            <div class="toggle-container">
                <span class="toggle-label">Maintenance Mode</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="maintenance-mode">
                    <span class="slider"></span>
                </label>
            </div>

            <!-- Date Time Inputs -->
            <div class="datetime-group">
                <div class="datetime-field">
                    <label for="start-date">Start Date & Time</label>
                    <input type="datetime-local" id="start-date" name="start-date" value="2025-11-01T00:00">
                </div>
                <div class="datetime-field">
                    <label for="end-date">End Date & Time</label>
                    <input type="datetime-local" id="end-date" name="end-date" value="2025-11-01T00:00">
                </div>
            </div>

            <!-- Notification Message -->
            <div class="notification-field">
                <label for="notification-msg">Send Push Notification</label>
                <textarea id="notification-msg" name="notification-msg" rows="3" placeholder="Enter notification message..."></textarea>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button class="btn-secondary">Clear System Notification</button>
            </div>
        </section>

        <!-- System Configurations Section -->
        <section class="system-configurations">
            <h2>System Configurations</h2>
            
            <!-- System Color -->
            <div class="config-item">
                <label for="system-color">System Color</label>
                <div class="color-picker">
                    <input type="text" id="system-color" name="system-color" value="#4CAF50" readonly>
                    <button class="edit-btn">
                        <img src="Images/edit-icon.png" alt="Edit">
                    </button>
                </div>
            </div>

            <!-- Green Points Settings -->
            <div class="config-section">
                <h3>Green Points Settings</h3>
                
                <div class="input-field">
                    <label for="recycle-points">Per 1st Recycle</label>
                    <input type="number" id="recycle-points" name="recycle-points" value="10" min="0">
                </div>

                <div class="input-field">
                    <label for="bus-checkin-points">Bus In-Campus</label>
                    <input type="number" id="bus-checkin-points" name="bus-checkin-points" value="5" min="0">
                </div>

                <div class="input-field">
                    <label for="event-checkin-points">Bus In-Campus</label>
                    <input type="number" id="event-checkin-points" name="event-checkin-points" value="15" min="0">
                </div>
            </div>
        </section>

        <!-- Footer Buttons -->
        <div class="footer-buttons">
            <button class="btn-reset">Reset</button>
            <button class="btn-save">Save</button>
        </div>

        <!-- Bottom Navigation -->
        <nav class="bottom-nav">
            <a href="home.html" class="nav-item">
                <img src="Images/home-icon.png" alt="Home">
            </a>
            <a href="stats.html" class="nav-item">
                <img src="Images/stats-icon.png" alt="Stats">
            </a>
            <a href="leaderboard.html" class="nav-item">
                <img src="Images/leaderboard-icon.png" alt="Leaderboard">
            </a>
            <a href="community.html" class="nav-item">
                <img src="Images/community-icon.png" alt="Community">
            </a>
            <a href="profile.html" class="nav-item active">
                <img src="Images/profile-icon.png" alt="Profile">
            </a>
        </nav>
    </div>

</body>
</html>
