<?php
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../check-maintenance-status.php";

// sql all data from rewards
$sql = "SELECT rewards_id, reward_name, description, points_required, quantity, category FROM rewards";
$result = mysqli_query($database, $sql);

// fetch total points per person
$participant_id = (int) $_SESSION['user_role_id'];

/* TOTAL POINTS */
$points_sql = "SELECT 
    p.participants_id AS participant_id,
    
    
    COALESCE(
        (SELECT SUM(c.points_reward)
         FROM participants_challenges pc
         JOIN challenges c ON pc.challenges_id = c.challenges_id
         WHERE pc.participants_id = p.participants_id
           AND pc.challenges_status = 'approved'), 0
    ) AS total_eco_points,
    
    
    COALESCE(
        (SELECT SUM(r.points_required)
         FROM reward_redemption rr
         JOIN rewards r ON rr.rewards_id = r.rewards_id
         WHERE rr.participants_id = p.participants_id), 0
    ) AS redeemed_points,
    
    
      COALESCE(
        (SELECT SUM(e.points_rewarded)
         FROM attendance a
         JOIN events e ON e.events_id = a.events_id
         WHERE a.participants_id = p.participants_id
           AND a.event_attended = 1
    ), 0) AS rewarded_points

FROM participants p
GROUP BY p.participants_id";

$points_result = mysqli_query($database, $points_sql);
while ($points_row = mysqli_fetch_assoc($points_result)) {
    $points_info[] = [
        'earned_points' => $points_row['total_eco_points'],
        'redeemed_points' => $points_row['redeemed_points'],
        'participant_id' => $points_row['participant_id'],
        'rewarded_points' => $points_row['rewarded_points']
    ];
}

foreach ($points_info as $p) {
    $total_points = $p['earned_points'] + $p['rewarded_points'] - $p['redeemed_points'];
    $user_total_points[] = [
        'participant_id' => $p['participant_id'],
        'total_points' => $total_points

    ];
}

foreach ($user_total_points as $rank) {
    if ($rank['participant_id'] == $participant_id) {
        $total_points = $rank['total_points'];

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant Rewards Mobile</title>
    <link rel="stylesheet" href="../../mobile.css">
    <link rel="stylesheet" href="../css/participant-rewards-mobile.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>
    <!-- top bar -->
    <header class="top-bar" role="banner">
        <div class="top-left">
            <button class="icon-btn no-hover topbar-icon" onclick="window.location.href='participant-home-mobile.php'"
                style="display:flex;align-items:center;gap:8px;">
                <svg width="56" height="56" viewBox="0 0 72 72" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                    focusable="false">
                    <path
                        d="M17.0278 55.17C17.9238 56.03 18.8788 56.833 19.8928 57.579C23.3048 55.1141 26.0849 51.8767 28.0058 48.1313C29.9267 44.386 30.9338 40.2392 30.9448 36.03C30.9448 27.216 26.5978 19.398 19.8748 14.478C18.8713 15.2154 17.9201 16.0213 17.0278 16.89C20.2462 18.9439 22.8981 21.7722 24.7408 25.1159C26.5835 28.4597 27.5583 32.2122 27.5758 36.03C27.5758 44.016 23.3968 51.042 17.0278 55.17Z"
                        fill="var(--primary-green)" />
                    <path
                        d="M57.0119 19.125C55.1822 23.1625 52.2267 26.5866 48.4997 28.9864C44.7728 31.3863 40.4326 32.6601 35.9999 32.655C31.5676 32.6595 27.2281 31.3854 23.5018 28.9856C19.7754 26.5858 16.8203 23.1621 14.9909 19.125C14.1119 20.205 13.3199 21.366 12.6299 22.578C15.0031 26.6727 18.4119 30.0707 22.5141 32.4309C26.6162 34.7911 31.2672 36.0303 35.9999 36.024C40.7325 36.0303 45.3835 34.7911 49.4857 32.4309C53.5878 30.0707 56.9967 26.6727 59.3699 22.578C58.6743 21.3678 57.886 20.2133 57.0119 19.125ZM30.9449 62.427C31.2809 47.787 43.0769 36.027 57.5669 36.027C59.3783 36.0212 61.1852 36.2063 62.9579 36.579C62.929 37.7587 62.8227 38.9352 62.6399 40.101C60.8168 39.6325 58.9422 39.3947 57.0599 39.393C54.0149 39.4167 51.005 40.0462 48.2057 41.2447C45.4064 42.4432 42.8736 44.1869 40.7549 46.374C38.6374 48.5623 36.9773 51.1506 35.8714 53.9878C34.7655 56.8249 34.236 59.854 34.3139 62.898C33.1812 62.8209 32.0553 62.6635 30.9449 62.427Z"
                        fill="var(--primary-green)" />
                    <path
                        d="M59.5382 37.509C58.7462 49.572 48.2161 59.616 36.0001 59.616C35.0881 59.618 34.1841 59.561 33.2881 59.445L32.8681 62.817C36.416 63.2333 40.0111 62.9403 43.4447 61.955C46.8783 60.9697 50.0817 59.3118 52.8689 57.0776C55.6561 54.8433 57.9715 52.0774 59.6803 48.9405C61.3892 45.8036 62.4575 42.3584 62.8232 38.805L59.5892 37.695L59.5382 37.491V37.509ZM58.8152 21.639C55.7076 16.6761 51.0676 12.8608 45.5977 10.7707C40.1278 8.6807 34.1259 8.42974 28.5007 10.0558C22.8754 11.682 17.9332 15.0966 14.4221 19.7827C10.911 24.4689 9.02242 30.1715 9.04215 36.027C9.04215 44.382 12.8521 51.867 18.8131 56.802L21.5791 54.492C18.7623 52.3004 16.4753 49.5023 14.8882 46.3056C13.301 43.1089 12.4544 39.5958 12.4111 36.027C12.4111 23.322 23.2951 12.438 36.0001 12.438C40.1006 12.4994 44.1165 13.6131 47.6629 15.6723C51.2092 17.7316 54.1672 20.6673 56.2531 24.198L58.8152 21.639Z"
                        fill="var(--primary-green)" />
                </svg>
                <h2 class="top-title">EcoXP</h2>
            </button>
        </div>

        <div class="top-center">
        </div>

        <div class="top-right">
            <a href="participant-profile-mobile.php" aria-label="Profile" class="topbar-icon">
                <button class="icon-btn" aria-label="Profile">
                    <i data-lucide="user-round"></i>
                </button>
            </a>
        </div>
    </header>

    <!-- side bar -->
    <nav class="side-bar" role="navigation" aria-label="Main">
        <div class="participant-icon-container">
            <div id="home-icon-box">
                <a href="participant-home-mobile.php" class="icon-link sidebar-icon" aria-label="Home">
                    <button class="icon-btn"><i data-lucide="house"></i></button>
                </a>
            </div>

            <a class="icon-link sidebar-icon" href="participant-challenges-mobile.php" aria-label="Challenges">
                <button class="icon-btn"><i data-lucide="trophy"></i></button>
            </a>

            <a class="icon-link sidebar-icon" href="participant-action-submit-mobile.php"
                aria-label="Scan / Log Action">
                <button class="icon-btn"><i data-lucide="scan-line"></i></button>
            </a>

            <a class="icon-link active sidebar-icon" href="participant-rewards-mobile.php" aria-label="Rewards">
                <button class="icon-btn"><i data-lucide="badge-percent"></i></button>
            </a>


        </div>

        <a class="icon-link sidebar-icon" id="logout" style="cursor: pointer;">
            <button class="icon-btn" onclick="logout_confirm()">
                <i data-lucide="log-out"></i>
            </button>
        </a>

        <script>
            function logout_confirm() {
                if (confirm("Are you sure you want to logout?")) {
                    window.location.href = "../../logout.php";
                }
            }
        </script>
    </nav>

    <!-- nav bar -->
    <nav class="bottom-nav">
        <a href="participant-home-mobile.php" class="nav-item">
            <i data-lucide="house" class="icon-btn"></i>
        </a>
        <a href="participant-challenges-mobile.php" class="nav-item">
            <i data-lucide="trophy" class="icon-btn"></i>
        </a>
        <a href="participant-action-submit-mobile.php" class="nav-item">
            <i data-lucide="scan-line" class="icon-btn"></i>
        </a>
        <a href="participant-rewards-mobile.php" class="nav-item active">
            <i data-lucide="badge-percent" class="icon-btn"></i>
        </a>
        <a href="participant-profile-mobile.php" class="nav-item">
            <i data-lucide="user-round" class="icon-btn"></i>
        </a>
    </nav>

    <main class="main-content">
        <!-- title -->
        <div class="page-header">
            <div class="header-title">Rewards</div>
        </div>
        <!-- category filter -->
        <div class="pill-filter">
            <div class="category-pill active" onclick="filterRewards(this, 'all')">All Rewards</div>
            <div class="category-pill" onclick="filterRewards(this, 'Vouchers')">Discount/Vouchers</div>
            <div class="category-pill" onclick="filterRewards(this, 'Physical')">Physical Rewards</div>
        </div>
        <!-- rewards -->
        <div class="rewards-container">

            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="rewards-card" data-category="<?php echo $row['category']; ?>">
                        <img src="../../images/voucher.png" alt="rewards image" class="rewards-image">
                        <div class="rewards-content">
                            <h4 class="rewards-title">
                                <?php echo $row['reward_name']; ?>
                            </h4>
                            <div class="rewards-details">
                                <p class="rewards-text"><?php echo $row['points_required']; ?>GP</p>
                                <div class="rewards-btn" data-title="<?php echo htmlspecialchars($row['reward_name']); ?>"
                                    data-description="<?php echo htmlspecialchars($row['description']); ?>"
                                    data-id="<?php echo $row['rewards_id']; ?>"
                                    data-cost="<?php echo $row['points_required']; ?>"
                                    data-quantity="<?php echo $row['quantity'] ?>" onclick="openModal(
                                        this.dataset.title,
                                        this.dataset.description,
                                        this.dataset.id,
                                        this.dataset.cost,
                                        this.dataset.quantity
                                    )">
                                    Redeem
                                </div>

                            </div>
                        </div>
                    </div>
                <?php }
            } else {
                echo '<p>No rewards available at the moment.</p>';
            } ?>

            <!-- ===== POPUP MODAL ===== -->
            <div id="rewardModal" class="modal-overlay">
                <div class="modal-box">

                    <div class="modal-header">
                        <h3 id="modalTitle"></h3>
                        <span class="close-btn" onclick="closeModal()">&times;</span>
                    </div>

                    <div class="modal-image">
                        <img src="../../images/voucher.png" style="width:120px;">
                    </div>

                    <p id="modalDescription">
                        <strong>Terms & Conditions:</strong>
                        <span id="termsText"></span>
                    </p>

                    <label>
                        <input type="checkbox" id="agreeCheckbox"> I agree to the terms & conditions
                    </label>

                    <div class="modal-footer">
                        <button onclick="confirmRedeem()">Redeem</button>
                    </div>

                </div>
            </div>

            <div id="qrModal" class="modal-overlay">
                <div class="modal-box" style="width:420px; text-align:center;">

                    <div class="modal-header">
                        <h3>Redeem QR Code</h3>

                    </div>

                    <div style="margin:20px 0;">
                        <img id="qrCodeImg" src=" " alt="QR Code" style="width:180px;">

                    </div>

                    <p id="timerDisplay" style="color:#53B757; font-weight:600;">10:00</p>

                    <button class="redeem-btn" onclick="closeQrModal()">End Redeem</button>

                </div>
            </div>

            <!-- sends php to js -->
            <script>
                const USER_POINTS = <?php echo $total_points; ?>;


                //<!-- ===== JAVASCRIPT ===== -->

                let currentRewardId = null;
                let currentRedemptionId = null;
                let timeLeft = 600; // 10 minutes in seconds
                let timerInterval = null;

                // Format time as MM:SS
                function formatTime(seconds) {
                    const mins = Math.floor(seconds / 60);
                    const secs = seconds % 60;
                    return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
                }

                // Update timer display
                function updateTimer() {
                    const timerElement = document.getElementById('timerDisplay');
                    timerElement.textContent = formatTime(timeLeft);

                    // Change color when time is running out (last minute)
                    if (timeLeft <= 60) {
                        timerElement.style.color = '#F44336';
                        timerElement.classList.add('expiring');
                    } else {
                        timerElement.style.color = '#4CAF50';
                        timerElement.classList.remove('expiring');
                    }

                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        alert("QR expired, quitting pop-up");
                        document.getElementById("qrModal").classList.remove("show");

                    } else {
                        timeLeft--;
                    }
                }

                // Start the countdown timer
                function startTimer() {
                    // Clear any existing timer
                    if (timerInterval) {
                        clearInterval(timerInterval);
                    }

                    // Reset to 10 minutes
                    timeLeft = 600;

                    // Update display immediately
                    const timerElement = document.getElementById('timerDisplay');
                    timerElement.textContent = formatTime(timeLeft);
                    timerElement.style.color = '#4CAF50';
                    timerElement.classList.remove('expiring');

                    // Start countdown
                    timerInterval = setInterval(updateTimer, 1000);
                }

                // Stop the timer
                function stopTimer() {
                    if (timerInterval) {
                        clearInterval(timerInterval);
                        timerInterval = null;
                    }
                }
                // Prevent accidental page close
                window.onbeforeunload = function (e) {
                    if (document.getElementById("qrModal").classList.contains("show")) {
                        e.preventDefault();
                        e.returnValue = "";
                        return "Your redemption is still active. Are you sure you want to leave?";
                    }
                };

                function endRedemption() {

                    stopTimer();
                    document.getElementById("qrModal").classList.remove("show");
                }

                function openModal(title, description, rewardId, rewardCost, rewardQuantity) {
                    rewardCost = parseInt(rewardCost);
                    rewardQuantity = parseInt(rewardQuantity);
                    if (USER_POINTS < rewardCost) {
                        alert("You do not have enough points to redeem this reward.");
                        return;
                    }
                    if (rewardQuantity == 0) {
                        alert("Reward is redeemed fully! Reward no longer available");
                        return;
                    }



                    currentRewardId = rewardId;
                    document.getElementById("modalTitle").innerText = title;
                    document.getElementById("termsText").innerHTML = description.replace(/\n/g, '<br>');
                    document.getElementById("agreeCheckbox").checked = false;
                    document.getElementById("rewardModal").classList.add("show");
                }

                function closeModal() {
                    document.getElementById("rewardModal").classList.remove("show");
                }

                function confirmRedeem() {
                    // Check if checkbox is checked
                    if (!document.getElementById("agreeCheckbox").checked) {
                        alert("Please agree to the terms & conditions");
                        return;
                    }
                    fetch("set-reward-session.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: "reward_id=" + encodeURIComponent(currentRewardId)
                    })
                        .then(response => response.text())
                        .then(data => {
                            if (data === "OK") {
                                // Now generate QR
                                return fetch("qr-image-generation.php");//"return" keyword essentially for chaining promises in following async operations
                            } else {
                                alert("Failed to start redemption");
                            }
                        })
                        .then(response => response.text())
                        .then(qrUrl => {
                            console.log("QR URL:", qrUrl);
                            alert("QR URL: " + qrUrl);
                            document.getElementById("qrCodeImg").src = qrUrl;
                            closeModal(); // Close first modal
                            document.getElementById("qrModal").classList.add("show"); // Open QR modal
                            startTimer();
                        })
                        .catch(error => {
                            alert(error.message);
                        });

                }
                function closeQrModal() {
                    if (confirm('Closing will end your redemption. Continue?')) {
                        stopTimer();
                        endRedemption();
                    }
                }




                function filterRewards(el, category) {
                    const cards = document.querySelectorAll('.rewards-card');
                    const pills = document.querySelectorAll('.category-pill');

                    // Remove "active" class from all pills
                    pills.forEach(p => p.classList.remove('active'));

                    // Add "active" class to clicked pill
                    el.classList.add('active');

                    // Show/hide cards
                    cards.forEach(card => {
                        if (category === 'all') {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = (card.dataset.category === category) ? 'flex' : 'none';
                        }
                    });

                    const modal = document.getElementById("rewardModal");
                }

                lucide.createIcons()
            </script>
        </div>
    </main>
</body>

</html>

<?php
if ($database) {
    mysqli_close($database);
}
?>