<?php
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../../config/database.php";

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    echo "<script>
        alert('Access denied. Admin only.');
        window.location.href = '../../login.php';
    </script>";
    exit();
    }

// set timezone 
date_default_timezone_set("Asia/Kuala_Lumpur");
require_once '../../config/system.php';


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
    <link rel="stylesheet" href="../../global.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/admin-system-config.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>
    <div class="top-bar">
        <img src="../../images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='Admin_home.php'">
            <h2>EcoXP</h2>
        </button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='Admin_profile.php'"><i
                    data-lucide="user"></i></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="admin-icon-container">
            <button class="icon-btn" onclick="window.location.href='Admin_home.php'"><i data-lucide="home"></i></button>
            <button class="icon-btn" onclick="window.location.href='Admin_system_analytics.php'"><i
                    data-lucide="bar-chart-3"></i></button>
            <button class="icon-btn" onclick="window.location.href='Admin_sustainability_report.php'"><i
                    data-lucide="file-text"></i></button>
            <div id="system-config-icon-box">
                <button class="icon-btn" onclick="window.location.href='Admin_system_config.php'"><i
                        data-lucide="sliders"></i></button>
            </div>
            <button class="icon-btn" id="logout" onclick="logout_confirm()"><i
                    data-lucide="log-out"></i></button>
        </div>
    </div>

    <div class="main-content">
        <div class="page-header">
            <div class="title-box">
                <h1>System Settings</h1>
            </div>
        </div>
        <form action="system-settings-change.php" method="POST">

            <section class="system-maintenance">
                <h2>System Maintenance</h2>

                <div class="toggle-container">
                    <span class="toggle-label">Maintenance Mode</span>
                    <label class="toggle-switch">
                        <input type="checkbox" id="maintenance-mode" onclick="confirmMaintenance(this)" <?php echo $maintenance_active ? 'checked' : ''; ?>>
                        <span class="slider"></span>
                    </label>
                </div>




            </section>

            <section class="system-configurations">
                <h2>System Configurations</h2>

                <div class="config-section">
                    <h3>Green Points Settings</h3>
                    <div class="points-grid">
                        <?php while ($row = mysqli_fetch_assoc($green_points_check)): ?>
                            <div class="input-field">
                                <label><?= $row['challenge_name'] ?></label>
                                <input type="number" name="points[<?= $row['challenge_name'] ?>]"
                                    value="<?= $row['points_reward'] ?>" min="0" required>
                                <input type="hidden" name="challenge_names[]" value="<?= $row['challenge_name'] ?>">
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </section>

            <div class="footer-buttons">
                <button class="btn-reset" type="reset">Reset</button>
                <button class="btn-save" type="submit">Save</button>
            </div>
        </form>
    </div>

    <script>
        // Initialize Icons
        lucide.createIcons();

        function logout_confirm() {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = "../../logout.php";
            }
        }

        function confirmMaintenance(checkbox) {
            if (checkbox.checked) {
                if (confirm("Are you sure you want to enable maintenance mode?")) {
                    updateMaintenance(1);
                } else {
                    checkbox.checked = false;
                }
            } else {
                if (confirm("Disable maintenance mode?")) {
                    updateMaintenance(0);
                } else {
                    checkbox.checked = true;
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
                        alert("Failed to update maintenance mode: " + data);
                    } else {
                        alert("Maintenance mode updated successfully!");
                    }
                })
                .catch(error => {
                    alert("Error: " + error.message);
                });
        }
    </script>
</body>

</html>