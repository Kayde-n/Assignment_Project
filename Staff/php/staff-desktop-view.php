<?php
    require_once __DIR__ . "/../../session.php";
    require_once __DIR__ . "/../../config/database.php";
    require_once __DIR__ . "/../../check-maintenance-status.php";

    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'staff') {
    echo "<script>
        alert('Access denied. Staff only.');
        window.location.href = '../../login.php';
    </script>";
    exit();
    }

    // Get 5 most recent actions performed
    function getActivityLog($database, $user_id) {
        $logs = [];

        $sql = "SELECT timestamp, action_performed, description
            FROM system_log
            WHERE user_id = $user_id
            ORDER BY timestamp DESC
            LIMIT 5";

        $result = mysqli_query($database, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $logs[] = date('d M Y H:i', strtotime($row['timestamp'])) .
                    " - " . $row['action_performed'];
        }
        return $logs;
    }

    // check user type in search, kalau x use emtpy string
    $search = $_POST['search'] ?? '';
    $search = mysqli_real_escape_string($database, $search);

    // query total points for ranking
    $sql = "SELECT u.user_id,u.user_full_name,u.profile_picture_path,p.TP_no,COALESCE(SUM(c.points_reward), 0) AS total_points,RANK() OVER (ORDER BY COALESCE(SUM(c.points_reward), 0) DESC) AS ranking
        FROM participants p
        JOIN user u ON p.user_id = u.user_id
        LEFT JOIN participants_challenges pc ON p.participants_id = pc.participants_id AND pc.challenges_status = 'approved'
        LEFT JOIN challenges c ON pc.challenges_id = c.challenges_id";

    // if search for name or ID
    if (!empty($search)) {
        $sql .= " WHERE u.user_full_name LIKE '%$search%' OR p.TP_no LIKE '%$search%'";
    }
    
    // group user points by user
    $sql .= " GROUP BY u.user_id, u.user_full_name, u.profile_picture_path, p.TP_no
            ORDER BY ranking ASC";


    $result = mysqli_query($database, $sql);

    if (!$result) {
        die("SQL Error: " . mysqli_error($database));
    }

    //participants array
    $participants = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $row['activity_log'] = getActivityLog($database, $row['user_id']);
        $participants[] = $row;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Participant</title>
    <link rel="stylesheet" href="../../global.css">
    <link rel="stylesheet" href="../css/staff.css">
    <link rel="stylesheet" href="../css/staff-view-desktop.css">
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
            <div id="account-icon">
                <button class="icon-btn" onclick="window.location.href='staff-desktop-account.php'"><i data-lucide="users"></i></button>
            </div>
            <button class="icon-btn" id="logout" onclick="return logout_confirm();"><i data-lucide="log-out"></i></button>
        </div>
    </div>

    <div class="main-content">
        <div class="text-box">Participant Management</div>

        <div class="search-container">
            <form method="POST" style="display: flex; align-items: center; gap: 10px;">
                <div style="position: relative; flex-grow: 1;">
                    <i data-lucide="search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 18px; color: #666;"></i>
                    <input type="text" name="search" placeholder="Search Name or TP Number..." id="participant-search" value="<?= htmlspecialchars($_POST['search'] ?? ''); ?>" style="padding-left: 40px; width: 100%;">
                </div>
                <button type="submit" class="search-submit-btn">Search</button>
            </form>
        </div>

        <div class="participant-list">

        <?php if (!empty($participants)): ?>
            <?php foreach ($participants as $p): ?>

                <div class="participant-card">
                    <div class="card-left">
                        <img src="../../<?= htmlspecialchars($p['profile_picture_path'] ?? 'images/profile.png'); ?>" alt="Profile">
                    </div>

                    <div class="card-right">
                        <p class="p-name">
                            <?= htmlspecialchars($p['user_full_name']); ?>
                        </p>

                        <p class="p-tp">
                            <?= htmlspecialchars($p['TP_no']); ?>
                        </p>

                        <button class="view-details-btn"
                            onclick='openModal(
                                <?= json_encode($p["user_full_name"]); ?>,
                                <?= json_encode($p["profile_picture_path"] ?? "images/profile.png"); ?>,
                                <?= (int)$p["total_points"]; ?>,
                                "#<?= $p["ranking"]; ?>",
                                <?= json_encode($p["activity_log"]); ?>)'>
                            <i data-lucide="external-link" style="width: 14px; height: 14px; vertical-align: middle; margin-right: 5px;"></i>
                            View Profile
                        </button>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <div style="text-align: center; padding: 40px; color: #666;">
                <i data-lucide="user-search" style="width: 48px; height: 48px; margin-bottom: 10px; opacity: 0.5;"></i>
                <p>No participants found.</p>
            </div>
        <?php endif; ?>

        <div id="participantModal" class="modal-overlay">
            <div class="modal-content">
                <span class="close-modal" onclick="closeModal()">&times;</span>

                    <div class="modal-body">
                        <div class="profile-header">
                            <img id="modalProfilePic" src="../../images/profile.png" alt="Profile">
                            <h2 id="modalName">-</h2>
                        </div>

                        <div class="profile-stats">
                            <div class="stat-box">
                                <span class="stat-label">Points</span>
                                <span class="stat-number" id="modalPoints">0</span>
                            </div>
                            <div class="stat-box">
                                <span class="stat-label">Ranking</span>
                                <span class="stat-number" id="modalRanking">-</span>
                            </div>
                        </div>

                        <div class="activity-log">
                            <h3>Activity Log</h3>
                            <ul id="modalActivityLog">
                            </ul>
                        </div>
                    </div>
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

            function openModal(name, pic, points, ranking, activityLog) {
                document.getElementById('modalName').innerText = name;
                document.getElementById('modalProfilePic').src = pic;
                document.getElementById('modalPoints').innerText = points;
                document.getElementById('modalRanking').innerText = ranking;

                const ul = document.getElementById('modalActivityLog');
                ul.innerHTML = '';

                if (activityLog.length === 0) {
                    ul.innerHTML = '<li>No activity recorded</li>';
                } else {
                    activityLog.forEach(item => {
                        const li = document.createElement('li');
                        li.textContent = item;
                        ul.appendChild(li);
                    });
                }

                document.getElementById('participantModal').style.display = "flex";
                // Re-run icon creation if new elements with data-lucide are added
                lucide.createIcons();
            }

            function closeModal() {
                document.getElementById('participantModal').style.display = 'none';
            }

            window.onclick = function(event) {
                const modal = document.getElementById('participantModal');
                if (event.target == modal) closeModal();
            }
            </script>
    </div>
</body>
</html>