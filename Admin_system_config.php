<?php
    include("session.php");
    include("database.php");

    // set timezone 
    date_default_timezone_set("Asia/Kuala_Lumpur");
    require_once 'config/system.php';


    // Check if maintenance mode is currently active
    $sql_check = "SELECT * FROM downtime WHERE admin_id = 1 AND end_time = '2099-12-31 23:59:59' LIMIT 1";
    $result_check = mysqli_query($database, $sql_check);
    $maintenance_active = mysqli_num_rows($result_check);

    //pre-input the green points settings for challenges
    $challenges_settings_sql = "SELECT challenge_name,points_reward FROM Challenges";
    $green_points_check = mysqli_query($database, $challenges_settings_sql);

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


        </section>

        <!-- System Configurations Section -->
        <section class="system-configurations">
            <h2>System Configurations</h2>

            <!-- Green Points Settings -->
            <div class="config-section">
                <h3>Green Points Settings</h3>
                <div class="points-grid">
                    <?php while ($row = mysqli_fetch_assoc($green_points_check)): ?>
                        <div class="input-field">
                            <label><?= $row['challenge_name'] ?></label>
                            <input type="number" name="points[<?= $row['challenge_name'] ?>]"
                                value="<?= $row['points_reward'] ?>" min="0">
                        </div>
                    <?php endwhile; ?>
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