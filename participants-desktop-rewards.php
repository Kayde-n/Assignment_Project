<?php
include("session.php");
include("database.php");

// Fetch all rewards from database
$sql = "SELECT rewards_id, reward_name, description, points_required, quantity FROM rewards";
$result = mysqli_query($database, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rewards</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="participant.css">
    <link rel="stylesheet" href="participants-rewards-desktop.css">

</head>

<body>
    <div class="top-bar">
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='participants-desktop-home.php'">
            <h2>EcoXP</h2>
        </button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='participants-desktop-profile.php'"><img
                    src="images/profile.png" alt="Profile Logo"></button>
            <button class="icon-btn"><img src="images/notif.png" alt="Notification Logo"></button>
            <button class="icon-btn"><img src="images/setting.png" alt="Setting Logo"></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="participant-icon-container">
            <div id="home-icon-box">
                <button class="icon-btn" onclick="window.location.href='participants-desktop-home.php'"><img
                        src="images/home.png" alt="Home"></button>
            </div>
            <button class="icon-btn"><img src="images/challanges.png" alt="Challenges"></button>
            <button class="icon-btn" onclick="window.location.href='participants-desktop-logaction.php'"><img
                    src="images/scan.png" alt="Scan"></button>
            <div id="reward-icon-box">
                <button class="icon-btn" onclick="window.location.href='participants-desktop-rewards.php'"><img
                        src="images/tag.png" alt="Rewards"></button>
            </div>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>
    <div class="main-content">

        <div class="text-box">Rewards</div>

        <div class="reward-categories">
            <button class="category-btn active">All Rewards</button>
            <button class="category-btn" onclick="filterRewards('Discount/Vouchers')">Discount/Vouchers</button>
            <button class="category-btn" onclick="filterRewards('Physical Rewards')">Physical Rewards</button>
        </div>

        <p class="result-count"><?php echo mysqli_num_rows($result); ?> results</p>
        <div class="reward-cards">

            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="reward-card">
                        <div class="reward-img"><img src="images/voucher.png"></div>
                        <div class="reward-info">
                            <h3><?php echo $row['reward_name']; ?></h3>
                            <p class="reward-points"><?php echo $row['points_required']; ?>GP</p>
                            <button class="redeem-btn" data-title="<?php echo htmlspecialchars($row['reward_name']); ?>"
                                data-description="<?php echo htmlspecialchars($row['description']); ?>"
                                data-id="<?php echo $row['rewards_id']; ?>"
                                onclick="openModal(this.dataset.title, this.dataset.description, this.dataset.id)">Redeem</button>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p>No rewards available at the moment.</p>';
            }
            ?>

        </div>
    </div>

    <!-- ===== POPUP MODAL ===== -->
    <div id="rewardModal" class="modal-overlay">
        <div class="modal-box">

            <div class="modal-header">
                <h3 id="modalTitle"></h3>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>

            <div class="modal-image">
                <img src="images/voucher.png" style="width:120px;">
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
                <span class="close-btn" onclick="closeQrModal()">&times;</span>
            </div>

            <div style="margin:20px 0;">
                <img id="qrCodeImg" src=" " alt="QR Code" style="width:180px;">

            </div>

            <p id="timerDisplay" style="color:#53B757; font-weight:600;">10:00</p>

            <button class="redeem-btn" onclick="closeQrModal()">End Redeem</button>

        </div>
    </div>

    <!-- ===== JAVASCRIPT ===== -->
    <script>
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
                expireRedemption();
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


        // Expire redemption when timer runs out
        function expireRedemption() {
            if (!currentRedemptionId) {
                alert('No active redemption found.');
                document.getElementById("qrModal").classList.remove("show");
                return;
            }

            fetch('expire-redemption.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `redemption_id=${currentRedemptionId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Redemption time expired. QR code is no longer valid.');
                    document.getElementById("qrModal").classList.remove("show");
                    location.reload(); // Refresh to update points
                } else {
                    alert('Error: ' + data.message);
                    document.getElementById("qrModal").classList.remove("show");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while expiring redemption.');
                document.getElementById("qrModal").classList.remove("show");
            });
        }

        function endRedemption() {
            if (!confirm('Are you sure you want to end this redemption?')) {
                return;
            }

            stopTimer();

            if (!currentRedemptionId) {
                document.getElementById("qrModal").classList.remove("show");
                return;
            }

            fetch('end-redemption.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `redemption_id=${currentRedemptionId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Redemption ended successfully.');
                    document.getElementById("qrModal").classList.remove("show");
                    location.reload(); // Refresh page
                } else {
                    alert('Error: ' + data.message);
                    document.getElementById("qrModal").classList.remove("show");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        }

        function openModal(title, description, rewardId) {
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


        // Prevent accidental page close
        window.onbeforeunload = function() {
            if (document.getElementById("qrModal").classList.contains("show")) {
                e.preventDefault();
                return "Your redemption is still active. Are you sure you want to leave?";
            }
        };

        function filterRewards(category) {
            // Placeholder function for filtering rewards

        }

    </script>

</body>

</html>
<?php
if ($database) {
    mysqli_close($database);
}
?>