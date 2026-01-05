<?php
session_start();
include("database.php");

header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || !isset($_POST['reward_redemption_id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit();
}

$redemption_id = intval($_POST['reward_redemption_id']);
$user_id = $_SESSION['user_id'];

try {
    mysqli_begin_transaction($database);
    
    // Get reward details
    $get_reward = "SELECT r.points_required, red.reward_id 
                   FROM reward_redemptions red 
                   JOIN rewards r ON red.reward_id = r.rewards_id 
                   WHERE red.reward_redemption_id = ? AND red.participants_id = ? AND red.qr_used = '0'";
    $stmt = mysqli_prepare($database, $get_reward);
    mysqli_stmt_bind_param($stmt, "ii", $redemption_id, $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $reward_data = mysqli_fetch_assoc($result);
    
    if (!$reward_data) {
        throw new Exception('Redemption not found or already completed');
    }
    
    // Deduct points from user
    $deduct_points = "UPDATE participants 
                      SET points = points - ? 
                      WHERE user_id = ? AND points >= ?";
    $stmt2 = mysqli_prepare($database, $deduct_points);
    mysqli_stmt_bind_param($stmt2, "iii", 
        $reward_data['points_required'], 
        $user_id, 
        $reward_data['points_required']
    );
    
    if (!mysqli_stmt_execute($stmt2)) {
        throw new Exception('Failed to deduct points');
    }
    
    if (mysqli_stmt_affected_rows($stmt2) == 0) {
        throw new Exception('Insufficient points');
    }
    
    // Update redemption status to completed
    $update_query = "UPDATE reward_redemptions
                     SET qr_used = '1', 
                         date_redeemed = NOW() 
                     WHERE reward_redemption_id = ? AND participants_id = ?";
    $stmt3 = mysqli_prepare($database, $update_query);
    mysqli_stmt_bind_param($stmt3, "ii", $redemption_id, $user_id);
    
    if (!mysqli_stmt_execute($stmt3)) {
        throw new Exception('Failed to complete redemption');
    }
    
    mysqli_commit($database);
    
    // Clean up session
    unset($_SESSION['current_redemption_id']);
    unset($_SESSION['rewards_id']);
    
    echo json_encode(['success' => true, 'message' => 'Redemption completed successfully']);
    
} catch (Exception $e) {
    mysqli_rollback($database);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

mysqli_close($database);
?>