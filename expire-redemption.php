<?php
session_start();
include("database.php");

header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || !isset($_POST['redemption_id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit();
}

$redemption_id = intval($_POST['redemption_id']);
$user_id = $_SESSION['user_id'];

try {
    // Update redemption status to expired
    $update_query = "UPDATE reward_redemption 
                     SET qr_used = '1', 
                        date_redeemed = NOW() 
                     WHERE reward_redemption_id = ? 
                     AND participants_id = ? 
                     AND qr_used = '1'";

    $stmt = mysqli_prepare($database, $update_query);
    mysqli_stmt_bind_param($stmt, "ii", $redemption_id, $user_id);

    if (mysqli_stmt_execute($stmt)) {
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Clean up session
            unset($_SESSION['current_redemption_id']);
            unset($_SESSION['reward_id']);

            echo json_encode(['success' => true, 'message' => 'Redemption expired']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Redemption not found or already expired']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }

    mysqli_stmt_close($stmt);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

mysqli_close($database);
?>