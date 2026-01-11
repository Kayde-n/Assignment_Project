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
    
    // query participant profile
    $query = "SELECT u.user_id, u.user_full_name, u.account_status, u.profile_picture_path, p.TP_no 
            FROM participants p
            INNER JOIN user u ON p.user_id = u.user_id";

    $result = mysqli_query($database, $query);
    $total_results = mysqli_num_rows($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <link rel="stylesheet" href="../../global.css">
    <link rel="stylesheet" href="../css/staff.css">
    <link rel="stylesheet" href="../css/staff-account-desktop.css">
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
        <div class="title_header">Participants Management</div>

        <div class="search-bar-container">
            <input type="text" class="search-input" id="participantSearch" placeholder="Search by Name or TP Number" oninput="filterParticipants()">
            <span class="search-icon"><i data-lucide="search"></i></span>
        </div>

        <div class="verification-tabs">
            <input type="radio" name="status" id="all" value="all" checked onclick="filterParticipants()">
            <label for="all" class="tab-box">All</label>
            <input type="radio" name="status" id="active" value="active" onclick="filterParticipants()">
            <label for="active" class="tab-box">Active</label>
            <input type="radio" name="status" id="suspended" value="deactivated" onclick="filterParticipants()">
            <label for="suspended" class="tab-box">Suspended</label>
        </div>

        <div class="results-info">
            <span><?php echo $total_results; ?> results</span>
            <div class="action-buttons">
                <button id="mainViewBtn" class="view-profile-btn" onclick="window.location.href='staff-desktop-view.php'">View Profile</button>
                <button class="add-btn-circle" onclick="window.location.href='staff-desktop-manage.php'"><i data-lucide="plus"></i></button>
            </div>
        </div>

        <div class="participants-grid">
            <?php
            if ($total_results > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $status_label = $row['account_status'];
                    $status_class = (strtolower($status_label) == 'deactivated') ? 'suspended' : 'active';
                    
                    $raw_path = $row['profile_picture_path'];
                    if (empty($raw_path) || $raw_path == 'NULL') {
                        $image_src = "../../images/profile.png"; 
                    } else {
                        $image_src = "../../" . $raw_path;
                    }
                    ?>
                    <div class="user-card" onclick="openModal('<?php echo $row['user_id']; ?>', '<?php echo addslashes($row['user_full_name']); ?>', '<?php echo $row['TP_no']; ?>', '<?php echo $image_src; ?>', '<?php echo $status_label; ?>')">
                        <div class="user-details">
                            <img src="<?php echo $image_src; ?>" alt="User">
                            <div>
                                <div class="name"><?php echo htmlspecialchars($row['user_full_name']); ?></div>
                                <div class="tp-num"><?php echo htmlspecialchars($row['TP_no']); ?></div>
                            </div>
                        </div>
                        <div class="status-badge <?php echo $status_class; ?>">
                            <?php echo $status_label; ?>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

    <div id="userModal" class="modal-overlay">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <div class="modal-body">
                <img id="modalImg" src="" alt="Profile">
                <h2 id="modalName"></h2>
                <p id="modalTP"></p>
                <p>Current Status: <strong id="modalStatus"></strong></p>
                
                <form method="POST" action="update_status.php">
                    <input type="hidden" name="user_id" id="modalUserId">
                    <div class="modal-actions">
                        <button type="submit" name="new_status" value="Active" class="btn-status btn-active">Activate</button>
                        <button type="submit" name="new_status" value="Deactivated" class="btn-status btn-suspend">Suspend</button>
                    </div>
                </form>
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

    function filterParticipants() {
        let searchText = document.getElementById('participantSearch').value.toLowerCase();
        let selectedStatus = document.querySelector('input[name="status"]:checked').value.toLowerCase();
        let cards = document.getElementsByClassName('user-card');
        let visibleCount = 0;

        for (let i = 0; i < cards.length; i++) {
            let name = cards[i].querySelector('.name').innerText.toLowerCase();
            let tp = cards[i].querySelector('.tp-num').innerText.toLowerCase();
            let badge = cards[i].querySelector('.status-badge');
            
            let isSuspended = badge.classList.contains('suspended');
            let isActive = badge.classList.contains('active');

            let matchesStatus = (selectedStatus === 'all') || 
                                (selectedStatus === 'active' && isActive) || 
                                (selectedStatus === 'deactivated' && isSuspended);
            let matchesSearch = name.includes(searchText) || tp.includes(searchText);

            if (matchesSearch && matchesStatus) {
                cards[i].style.display = "";
                visibleCount++;
            } else {
                cards[i].style.display = "none";
            }
        }
        document.querySelector('.results-info span').innerText = visibleCount + " results";
    }

    function openModal(id, name, tp, img, status) {
        document.getElementById('modalUserId').value = id;
        document.getElementById('modalName').innerText = name;
        document.getElementById('modalTP').innerText = "TP Number: " + tp;
        document.getElementById('modalImg').src = img;
        document.getElementById('modalStatus').innerText = status;
        document.getElementById('userModal').style.display = "block";
        document.getElementById('viewProfileBtn').onclick = function() {
            window.location.href = 'staff-desktop-view.php?id=' + id;
        };
    }

    function closeModal() {
        document.getElementById('userModal').style.display = "none";
    }
    window.onclick = function(event) {
        let modal = document.getElementById('userModal');
        if (event.target == modal) closeModal();
    }
    </script>
</body>
</html>