<?php
    include("session.php");
    
    // Fetch all rewards from database
    $sql = "SELECT rewards_id, reward_name, description, points_required, quantity FROM rewards";
    $result = mysqli_query($con, $sql);
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
    <div class="top-bar" >
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='participants-desktop-home.php'"><h2>EcoXP</h2></button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='participants-desktop-profile.php'"><img src="images/profile.png" alt="Profile Logo"></button>
            <button class="icon-btn"><img src="images/notif.png" alt="Notification Logo"></button>
            <button class="icon-btn"><img src="images/setting.png" alt="Setting Logo"></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="participant-icon-container">
            <div id="home-icon-box">
                <button class="icon-btn" onclick="window.location.href='participants-desktop-home.php'"><img src="images/home.png" alt="Home"></button>
            </div>
            <button class="icon-btn"><img src="images/challanges.png" alt="Challenges"></button>
            <button class="icon-btn" onclick="window.location.href='participants-desktop-logaction.php'"><img src="images/scan.png" alt="Scan"></button>
            <div id="reward-icon-box">
                <button class="icon-btn" onclick="window.location.href='participants-desktop-rewards.php'"><img src="images/tag.png" alt="Rewards"></button>
            </div>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>
    <div class="main-content">

        <div class="text-box">Rewards</div>

        <div class="reward-categories">
            <button class="category-btn active">All Rewards</button>
            <button class="category-btn">Discount/Vouchers</button>
            <button class="category-btn">Physical Rewards</button>
        </div>

        <p class="result-count"><?php mysqli_num_rows($result);?> 4 results</p>

        <div class="reward-cards">

            <?php
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
            ?>
                        <div class="reward-card">
                            <div class="reward-img"><img src="images/voucher.png"></div>
                            <div class="reward-info">
                                <h3><?php echo $row['reward_name']; ?></h3>
                                <p class="reward-points"><?php echo $row['points_required']; ?>GP</p>
                                <button class="redeem-btn" onclick="openModal('<?php echo $row['reward_name']; ?>', '<?php echo $row['description']; ?>', <?php echo $row['rewards_id']; ?>)">Redeem</button>
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

            <p id = "modalDescription">
                <strong>Terms & Conditions:</strong>
                <span id = "termsText"></span>
            </p>
            
            <label>
                <input type="checkbox"> I agree to the terms & conditions
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
            <img src="images/qrcode.png" alt="QR Code" style="width:180px;">
            </div>

            <p style="color:#53B757; font-weight:600;">09 : 47</p>

            <button class="redeem-btn" onclick="closeQrModal()">End Redeem</button>

        </div>
    </div>

    <!-- ===== JAVASCRIPT ===== -->
    <script>
    let currentRewardId = null;

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
        if(!document.getElementById("agreeCheckbox").checked) {
            alert("Please agree to the terms & conditions");
            return;
        }

        // Close first modal
        closeModal();

        // Open QR modal
        document.getElementById("qrModal").classList.add("show");
    }

    function closeQrModal() {
        document.getElementById("qrModal").classList.remove("show");
    }
    </script>

</body>
</html>
<?php
    mysqli_close($con);
?>