<?php
require_once __DIR__ . "/../../config/Database.php";

if (isset($_GET['rewards_id'])) {
    $rewards_id = $_GET['rewards_id']; 

    $rewards_id = mysqli_real_escape_string($database, $rewards_id);

    $delete_soft_enntity_rows="DELETE FROM reward_redemption WHERE rewards_id = '$rewards_id'";
    $delete_sql = "DELETE FROM rewards WHERE rewards_id = '$rewards_id'";

    mysqli_query($database, $delete_soft_enntity_rows);

    if (mysqli_query($database, $delete_sql)) {
        echo "<script>alert('Reward deleted successfully.'); window.location.href='event-manager-rewards-management.php';</script>";
    } else {
        echo "Error deleting reward: " . mysqli_error($database);
    }
} else {
    echo "<script>alert('No reward ID provided.'); window.location.href='event-manager-rewards-management.php';</script>";
}
?>
