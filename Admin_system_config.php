<?php
//include("session.php");
include("database.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

// Check if maintenance mode is currently active
$sql_check = "SELECT * FROM downtime WHERE admin_id = 1 AND end_time = '2099-12-31 23:59:59' LIMIT 1";
$result_check = mysqli_query($database, $sql_check);
$maintenance_active = mysqli_num_rows($result_check);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Config</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="admin-system-config.css">
</head>

<body>
    <div class="top-bar">
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='Admin_home.php'">
            <h2>EcoXP</h2>
        </button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='Admin_profile.php'"><img src="images/profile.png"
                    alt="Profile Logo"></button>
            <button class="icon-btn"><img src="images/notif.png" alt="Notification Logo"></button>
            <button class="icon-btn"><img src="images/setting.png" alt="Setting Logo"></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="admin-icon-container">
            <button class="icon-btn" onclick="window.location.href='Admin_home.php'"><img src="images/home.png"
                    alt="Home"></button>
            <button class="icon-btn" onclick="window.location.href='Admin_system_analytics.php'"><img
                    src="images/system-analytics.png" alt="System Analytics"></button>
            <button class="icon-btn" onclick="window.location.href='Admin_sustainability_report.php'"><img
                    src="images/sustainability-report.png" alt="Sustainability Report"></button>
            <div id="system-config-icon-box">
                <button class="icon-btn" onclick="window.location.href='Admin_system_config.php'"><img
                        src="images/system-config.png" alt="System Config"></button>
            </div>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>

    <div class="main-content">
        <!-- Header Section -->
        <div class="page-header">
            <button class="back-btn" onclick="window.history.back()">
                <img src="Images/back-arrow.png" alt="Back">
            </button>
            <div class="title-box">
                <h1>System Settings</h1>
            </div>
        </div>

        <!-- System Maintenance Section -->
        <section class="system-maintenance">
            <h2>System Maintenance</h2>

            <!-- Toggle Switch -->
            <div class="toggle-container">
                <span class="toggle-label">Maintenance Mode</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="maintenance-mode" onclick="confirmMaintenance(this)" <?php echo $maintenance_active ? 'checked' : ''; ?>>
                    <span class="slider"></span>
                </label>
            </div>

            <!-- Date Time Inputs -->
            <form action="system-settings-change.php" method="POST">
                <div class="datetime-group">
                    <div class="datetime-field">
                        <label for="start-date">Start Date & Time</label>
                        <input type="datetime-local" id="start-date" name="start-date"
                            value="<?php echo date('Y-m-d\TH:i'); ?>">
                    </div>
                    <div class="datetime-field">
                        <label for="end-date">End Date & Time</label>
                        <input type="datetime-local" id="end-date" name="end-date" value="">
                    </div>
                </div>

                <!-- Notification Message -->
                <div class="notification-field">
                    <label for="notification-msg">Send Push Notification</label>
                    <textarea id="notification-msg" name="notification-msg" rows="3"
                        placeholder="Enter notification message..."></textarea>
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
                        <img src="Images/edit.png" alt="Edit">
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
        </form>
    </div>
</body>
<script>
    function confirmMaintenance(checkbox) {
        if (checkbox.checked) {
            // Turning ON maintenance
            if (confirm("Are you sure you want to enable maintenance mode?")) {
                updateMaintenance(1);
            } else {
                checkbox.checked = false; // revert
            }
        } else {
            // Turning OFF maintenance
            if (confirm("Disable maintenance mode?")) {
                updateMaintenance(0);
            } else {
                checkbox.checked = true; // revert
            }
        }
    }

    function updateMaintenance(status) {

        fetch("maintainence_toggle.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: 'status=' + status

        })
            .then(response => response.text())
            .then(data => {
                if (data !== "OK") {
                    console.log("Failed to update maintenance mode: " + data);
                } else {
                    console.log("Maintenance mode updated successfully.");
                }
            })
            .catch(error => {
                console.log("Error: " + error.message);

            });
    }
</script>

</html>