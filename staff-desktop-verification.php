<?php 
include('Database.php'); 
if (isset($_POST['action']) && isset($_POST['id'])) {
    $id = mysqli_real_escape_string($database, $_POST['id']);
    $newStatus = ($_POST['action'] === 'approve') ? 'approved' : 'rejected';

    $updateSql = "UPDATE participants_challenges 
                  SET challenges_status = '$newStatus', 
                      verified_date = NOW() 
                  WHERE participants_challenges_id = '$id'";
    
    if (mysqli_query($database, $updateSql)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($database);
    }
}
if (isset($_POST['action']) && isset($_POST['id'])) {
    $id = mysqli_real_escape_string($database, $_POST['id']);
    $newStatus = ($_POST['action'] === 'approve') ? 'approved' : 'rejected';
    $updateSql = "UPDATE participants_challenges 
                  SET challenges_status = '$newStatus', 
                      verified_date = NOW() 
                  WHERE participants_challenges_id = '$id'";
    if (mysqli_query($database, $updateSql)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
$query = "SELECT 
            SUM(CASE WHEN challenges_status = 'pending' THEN 1 ELSE 0 END) AS pending_count,
            SUM(CASE WHEN challenges_status = 'approved' THEN 1 ELSE 0 END) AS approved_count,
            SUM(CASE WHEN challenges_status = 'rejected' THEN 1 ELSE 0 END) AS rejected_count
          FROM participants_challenges";

$result = mysqli_query($database, $query);

$pendingCount = 0;
$approvedCount = 0;
$rejectedCount = 0;

if ($result) {
    $counts = mysqli_fetch_assoc($result);
    $pendingCount  = $counts['pending_count'] ?? 0;
    $approvedCount = $counts['approved_count'] ?? 0;
    $rejectedCount = $counts['rejected_count'] ?? 0;

    $listQuery = "SELECT pc.*, u.user_full_name, c.challenge_name, c.description, pc.date_accomplished, pc.image_path, u.profile_picture_path AS user_prof
                FROM participants_challenges pc
                JOIN participants p ON pc.participants_id = p.participants_id
                JOIN user u ON p.user_id = u.user_id
                JOIN challenges c ON pc.challenges_id = c.challenges_id
                WHERE pc.challenges_status = 'pending'";

    $listQueryApporve = "SELECT pc.*, u.user_full_name, c.challenge_name, c.description, pc.date_accomplished, pc.image_path, u.profile_picture_path AS user_prof
                        FROM participants_challenges pc 
                        JOIN participants p ON pc.participants_id = p.participants_id 
                        JOIN user u ON p.user_id = u.user_id 
                        JOIN challenges c ON pc.challenges_id = c.challenges_id 
                        WHERE pc.challenges_status = 'approved'";
    
    $listQueryRejected = "SELECT pc.*, u.user_full_name, c.challenge_name, c.description, pc.date_accomplished, pc.image_path, u.profile_picture_path AS user_prof
                      FROM participants_challenges pc
                      JOIN participants p ON pc.participants_id = p.participants_id
                      JOIN user u ON p.user_id = u.user_id
                      JOIN challenges c ON pc.challenges_id = c.challenges_id
                      WHERE pc.challenges_status = 'rejected'";
                      
    $pendingList = mysqli_query($database, $listQuery);
    $approvedList = mysqli_query($database, $listQueryApporve);
    $rejectedList = mysqli_query($database, $listQueryRejected);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="staff.css">
    <link rel="stylesheet" href="staff-verification-desktop.css">
    <script>
        function openModal(data) {
            document.getElementById('modal-id').value = data.participants_challenges_id;
            const dateAccomplished = data.date_accomplished ? data.date_accomplished : "No date provided";
            const description = data.description ? data.description : "No description available for this challenge.";

            document.getElementById('modal-body').innerHTML = `
                <div style="text-align: left; padding: 10px;">
                    <div style="background: #f4f4f4; padding: 15px; border-radius: 8px; margin-bottom: 15px; border-left: 5px solid #4CAF50;">
                        <p style="margin: 0 0 5px 0;"><strong>Participant:</strong> ${data.user_full_name}</p>
                        <p style="margin: 0;"><strong>Date Finished:</strong> ${dateAccomplished}</p>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <h4 style="margin: 0 0 5px 0; color: #333;">${data.challenge_name}</h4>
                        <p style="font-size: 14px; color: #666; line-height: 1.4; font-style: italic;">
                            ${description}
                        </p>
                    </div>
                    <div style="text-align: center; border-top: 1px solid #eee; pt: 15px;">
                        <p style="font-weight: bold; margin-bottom: 10px;">Submitted Proof Image:</p>
                        <img src="challenge_submission_uploads/${data.image_path}" style="width: 100%; max-height: 250px; object-fit: contain; border-radius: 5px;" onerror="this.src='challenge_submission_uploads/default.png'">
                    </div>
                </div>
            `;
            document.getElementById('verificationModal').style.display = "block";
        }
        function closeModal() {
            document.getElementById('verificationModal').style.display = "none";
        }
        function submitModal(actionType) {
            document.getElementById('modal-action').value = actionType;
            if (confirm("Are you sure you want to " + actionType + " this submission?")) {
                document.getElementById('modalForm').submit();
            }
        }
        window.onclick = function(event) {
            let modal = document.getElementById('verificationModal');
            if (event.target == modal) closeModal();
        }
    </script>
</head>
<body>
    <div id="desktop">
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
                <div id="verification-icon">
                    <button class="icon-btn"><img src="images/verification.png" alt="Verification"></button>
                </div>
                <button class="icon-btn" onclick="window.location.href='staff-desktop-news.php'"><img src="images/newspaper.png" alt="Scan"></button>
                <button class="icon-btn" onclick="window.location.href='staff-desktop-account.php'"><img src="images/account-management.png" alt="Account"></button>
                <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
            </div>
        </div>

        <div class="main-content">
            <div class="text-box">Verification Queue</div>

            <div class="verification-tabs">
                <input type="radio" name="status" id="pending" value="pending" checked>
                <label for="pending" class="tab-box">Pending (<?php echo $pendingCount; ?>)</label>

                <input type="radio" name="status" id="approved" value="approved">
                <label for="approved" class="tab-box">Approved (<?php echo $approvedCount; ?>)</label>

                <input type="radio" name="status" id="rejected" value="rejected">
                <label for="rejected" class="tab-box">Rejected (<?php echo $rejectedCount; ?>)</label>

                <div class="tab-content" id="content-pending">
                    <div class="verification-list">
                        <?php while($row = mysqli_fetch_assoc($pendingList)): ?>
                            <div class="verification-item" onclick='openModal(<?php echo json_encode($row); ?>)'>
                                <div class="item-details">
                                    <img src="<?= htmlspecialchars($row['user_prof']) ?>" class="user-pfp">
                                    <div class="user-text">
                                        <span class="user-name"><?php echo htmlspecialchars($row['user_full_name']); ?></span>
                                        <h3 class="challenge-name"><?php echo htmlspecialchars($row['challenge_name']); ?></h3>
                                    </div>
                                </div>
                                <img src="challenge_submission_uploads/<?php echo htmlspecialchars($row['image_path']); ?>" class="proof-img">
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>

                <div class="tab-content" id="content-approved">
                    <div class="verification-list">
                        <?php if($approvedCount > 0): mysqli_data_seek($approvedList, 0); ?>
                            <?php while($row = mysqli_fetch_assoc($approvedList)): ?>
                                <div class="verification-item" onclick='openModal(<?php echo json_encode($row); ?>)'>
                                    <div class="item-details">
                                        <img src="<?= htmlspecialchars($row['user_prof']) ?>" class="user-pfp">
                                        <div class="user-text">
                                            <span class="user-name"><?php echo htmlspecialchars($row['user_full_name']); ?></span>
                                            <h3 class="challenge-name"><?php echo htmlspecialchars($row['challenge_name']); ?></h3>
                                            <span style="color: green; font-weight: bold;">✓ Approved</span>
                                        </div>
                                    </div>
                                    <img src="challenge_submission_uploads/ <?php echo htmlspecialchars($row['image_path']) ?>" class="proof-img">
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>No approved items found.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="tab-content" id="content-rejected">
                    <div class="verification-list">
                        <?php if($rejectedCount > 0): mysqli_data_seek($rejectedList, 0); ?>
                            <?php while($row = mysqli_fetch_assoc($rejectedList)): ?>
                                <div class="verification-item" onclick='openModal(<?php echo json_encode($row); ?>)'>
                                    <div class="item-details">
                                        <img src="<?= htmlspecialchars($row['user_prof']) ?>" class="user-pfp"> 
                                        <div class="user-text">
                                            <span class="user-name"><?php echo htmlspecialchars($row['user_full_name']); ?></span>
                                            <h3 class="challenge-name"><?php echo htmlspecialchars($row['challenge_name']); ?></h3>
                                            <span style="color: red; font-weight: bold;">✕ Rejected</span>
                                        </div>
                                    </div>
                                    <img src='challenge_submission_uploads/<?= htmlspecialchars($row['image_path']) ?>' class="proof-img">
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>No rejected items found.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div id="verificationModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal()">&times;</span>
                        <h2 style="margin-bottom: 10px;">Verification Details</h2>
                        <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 20px;">
                        
                        <div id="modal-body">

                            </div>

                        <div class="button-group-modal">
                            <form id="modalForm" method="POST">
                                <input type="hidden" name="id" id="modal-id">
                                <input type="hidden" name="action" id="modal-action">
                                <button type="button" class="btn-reject" onclick="submitModal('reject')">Reject</button>
                                <button type="button" class="btn-approve" onclick="submitModal('approve')">Approve</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>