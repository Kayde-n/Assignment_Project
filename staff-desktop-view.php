<?php
    include("Database.php");

    $search = $_POST['search'] ?? '';
    $search = mysqli_real_escape_string($database, $search);

    $sql = "SELECT u.user_full_name, u.profile_picture_path, p.TP_no
            FROM participants p
            JOIN user u ON p.user_id = u.user_id";

    if (!empty($search)) {
        $sql .= " WHERE u.user_full_name LIKE '%$search%' OR p.TP_no LIKE '%$search%'";
    }

    $sql .= " ORDER BY u.user_full_name ASC";

    $result = mysqli_query($database, $sql);

    $participants = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $participants[] = $row;
        }
    }

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Participant</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="staff.css">
    <link rel="stylesheet" href="staff-view-desktop.css">
    </head>
<body>
    <div class="top-bar">
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='staff-desktop-home.php'"><h2>EcoXP</h2></button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='staff-desktop-profile.php'"><img src="images/profile.png" alt="Profile"></button>
            <button class="icon-btn"><img src="images/notif.png" alt="Notification"></button>
            <button class="icon-btn"><img src="images/setting.png" alt="Setting"></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="staff-icon-container">
            <button class="icon-btn" onclick="window.location.href='staff-desktop-home.php'"><img src="images/home.png" alt="Home"></button>
            <button class="icon-btn" onclick="window.location.href='staff-desktop-verification.php'"><img src="images/verification.png" alt="Verification"></button>
            <button class="icon-btn"><img src="images/newspaper.png" alt="News"></button>
            <div id="account-icon">
                <button class="icon-btn" onclick="window.location.href='staff-desktop-account.php'"><img src="images/account-management.png" alt="Account"></button>
            </div>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>

    <div class="main-content">
        <div class="text-box">Participant</div>

        <div class="search-container">
            <form method="POST">
                <input type="text" name="search" placeholder="Search Name or TP Number..." id="participant-search" value="<?= htmlspecialchars($_POST['search'] ?? ''); ?>">
                <button type="submit" class="search-submit-btn">Search</button>
            </form>
        </div>

        <div class="participant-list">

        <?php if (!empty($participants)): ?>
            <?php foreach ($participants as $p): ?>

                <div class="participant-card">
                    <div class="card-left">
                        <img src="<?= htmlspecialchars($p['profile_picture_path'] ?? 'images/profile.png'); ?>" alt="Profile">
                    </div>

                    <div class="card-right">
                        <p class="p-name">
                            <?= htmlspecialchars($p['user_full_name']); ?>
                        </p>

                        <p class="p-tp">
                            <?= htmlspecialchars($p['TP_no']); ?>
                        </p>

                        <button class="view-details-btn"
                            onclick="openModal(
                                '<?= addslashes($p['user_full_name']); ?>',
                                '<?= addslashes($p['profile_picture_path'] ?? 'images/profile.png'); ?>',
                                '<?= $p['points'] ?? 0; ?>',
                                '#<?= $p['ranking'] ?? '-'; ?>',
                                [])">
                            View Profile
                        </button>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <p>No participants found.</p>
        <?php endif; ?>

        <div id="participantModal" class="modal-overlay">
            <div class="modal-content">
                <span class="close-modal" onclick="closeModal()">&times;</span>

                    <div class="modal-body">
                        <div class="profile-header">
                            <img id="modalProfilePic" src="images/profile.png" alt="Profile">
                            <h2 id="modalName">Ivan</h2>
                            <p id="modalDept">Environmental Studies</p>
                        </div>

                        <div class="profile-stats">
                            <div class="stat-box">
                                <span class="stat-label">Points</span>
                                <span class="stat-number" id="modalPoints">10600</span>
                            </div>
                            <div class="stat-box">
                                <span class="stat-label">Ranking</span>
                                <span class="stat-number" id="modalRanking">#9</span>
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
            function openModal(name, pic, points, ranking, activityLog) {
                document.getElementById('modalName').innerText = name;
                document.getElementById('modalProfilePic').src = pic;
                document.getElementById('modalPoints').innerText = points;
                document.getElementById('modalRanking').innerText = ranking;

                const ul = document.getElementById('modalActivityLog');
                ul.innerHTML = '';
                activityLog.forEach(item => {
                    const li = document.createElement('li');
                    li.textContent = item;
                    ul.appendChild(li);
                });

                document.getElementById('participantModal').style.display = "flex";
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