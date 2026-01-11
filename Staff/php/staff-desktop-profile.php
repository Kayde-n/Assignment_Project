<?php
    session_start();

    require_once __DIR__ . "/../../config/database.php";
    require_once __DIR__ . "/../../check-maintenance-status.php";

    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'staff') {
    echo "<script>
        alert('Access denied. Staff only.');
        window.location.href = '../../login.php';
    </script>";
    exit();
    }

    date_default_timezone_set("Asia/Kuala_Lumpur");

    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'staff') {
        header("Location: ../../login.php");
        exit();
    }

    $current_user_id = (int) $_SESSION['user_role_id'];

    $query = "SELECT u.user_full_name, u.email, u.profile_picture_path, u.account_status, s.staff_id 
          FROM staff s
          JOIN user u ON u.user_id = s.user_id
          WHERE s.staff_id = ?";

    // use prepared stuff for security
    $stmt = mysqli_prepare($database, $query);
    mysqli_stmt_bind_param($stmt, "i", $current_user_id); // i means ID in int
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $staff = mysqli_fetch_assoc($result);


    if (!$staff) {
        die("Error: Access denied. You are not registered as a Staff member.");
    }

    // count pending challenges
    $pending_q = "SELECT COUNT(*) as total FROM participants_challenges WHERE challenges_status = 'pending'";
    $pending_res = mysqli_query($database, $pending_q);
    $pending_data = mysqli_fetch_assoc($pending_res);
    $pending_count = $pending_data['total'] ?? 0;

    $active_q = "SELECT COUNT(*) as total 
                FROM user u 
                JOIN participants p ON u.user_id = p.user_id 
                WHERE u.account_status = 'Active'";
    $active_res = mysqli_query($database, $active_q);
    $active_data = mysqli_fetch_assoc($active_res);
    $active_count = $active_data['total'] ?? 0;

    if (isset($_POST['save_profile'])) {
    $new_name = $_POST['update_name'];
    $new_email = $_POST['update_email'];

    $update_sql = "UPDATE user u
                   JOIN staff s ON u.user_id = s.user_id
                   SET u.user_full_name = ?, u.email = ?
                   WHERE s.staff_id = ?";

    $upd_stmt = mysqli_prepare($database, $update_sql);
    mysqli_stmt_bind_param($upd_stmt, "ssi", $new_name, $new_email, $current_user_id);

    if (mysqli_stmt_execute($upd_stmt)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($database);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../../global.css">
    <link rel="stylesheet" href="../css/staff.css">
    <link rel="stylesheet" href="../css/staff-profile-desktop.css">
    <script src="https://unpkg.com/lucide@latest"></script>
    </head>
<body>
    <div class="top-bar">
        <img src="../../images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='staff-desktop-home.php'"><h2>EcoXP</h2></button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='staff-desktop-profile.php'"><i data-lucide="user"></i></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="staff-icon-container">
            <button class="icon-btn" onclick="window.location.href='staff-desktop-home.php'"><i data-lucide="home"></i></button>
            <button class="icon-btn" onclick="window.location.href='staff-desktop-verification.php'"><i data-lucide="shield-check"></i></button>
            <div id="account-icon-box">
                <button class="icon-btn" onclick="window.location.href='staff-desktop-account.php'"><i data-lucide="users"></i></button>
            </div>
            <button class="icon-btn" id="logout" onclick="return logout_confirm();"><i data-lucide="log-out"></i></button>
        </div>
    </div>

    <div class="main-content">
        <div class="text-box">Profile</div>

        <div class="profile-page-wrapper">
            <div class="profile-card">
                <div class="profile-left-panel">
                    <img src="../../<?php echo htmlspecialchars($staff['profile_picture_path']); ?>" alt="Staff Image" class="main-profile-pic">
                    <div class="staff-id-badge">ID: #<?php echo htmlspecialchars($staff['staff_id']); ?></div>
                </div>

                <div class="profile-right-panel">
                    <h1><?php echo htmlspecialchars($staff['user_full_name']); ?></h1>
                    <p class="staff-role-text">EcoXP System Staff</p>

                    <div class="info-container">
                        <div class="info-group">
                            <span class="info-label">Email Address</span>
                            <span class="info-data"><?php echo htmlspecialchars($staff['email']); ?></span>
                        </div>

                        <div class="info-group">
                            <span class="info-label">Account Status</span>
                            <span class="info-data">
                                <span class="status-indicator <?php echo ($staff['account_status'] == 'Active') ? 'active-bg' : 'deactivated-bg'; ?>"></span>
                                <?php echo htmlspecialchars($staff['account_status']); ?>
                            </span>
                        </div>

                        <div class="info-group">
                            <span class="info-label">Department</span>
                            <span class="info-data">Staff Administration</span>
                        </div>
                    </div>

                    <button class="edit-action-btn" onclick="openModal()">Edit Profile</button>
                </div>
            </div>
        </div>

        <div class="dashboard-stats">
            <div class="stat-box" onclick="window.location.href='staff-desktop-verification.php'">
                <div class="stat-details">
                    <span class="stat-number"><?php echo $pending_count; ?></span>
                    <span class="stat-text">Pending Verification</span>
                </div>
                <i data-lucide="shield-check"></i>
            </div>

            <div class="stat-box" onclick="window.location.href='staff-desktop-account.php'">
                <div class="stat-details">
                    <span class="stat-number"><?php echo $active_count; ?></span>
                    <span class="stat-text">Participant Overview (Active)</span>
                </div>
                <i data-lucide="users"></i>
            </div>
        </div>
    </div>

    <div id="editProfileModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Profile</h2>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>
            <form action="" method="POST">
                <div class="input-group">
                    <label>Full Name</label>
                    <input type="text" name="update_name" value="<?php echo htmlspecialchars($staff['user_full_name']); ?>" required>
                </div>
                <div class="input-group">
                    <label>Email Address</label>
                    <input type="email" name="update_email" value="<?php echo htmlspecialchars($staff['email']); ?>" required>
                </div>
                <div class="modal-actions">
                    <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                    <button type="submit" name="save_profile" class="save-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    // Initialize Lucide Icons
    lucide.createIcons();

    function logout_confirm() {
                if (confirm("Are you sure you want to logout?")) {
                    window.location.href = "../../logout.php";
                }
            }

    function openModal() {
        document.getElementById('editProfileModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('editProfileModal').style.display = 'none';
    }

    window.onclick = function(event) {
        let modal = document.getElementById('editProfileModal');
        if (event.target == modal) {
            closeModal();
        }
    }
    </script>
</body>
</html>