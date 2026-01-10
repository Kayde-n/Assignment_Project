<?php
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = mysqli_real_escape_string($database, $_POST['user_id']);
    $new_status = mysqli_real_escape_string($database, $_POST['new_status']);

    $sql = "UPDATE user SET account_status = '$new_status' WHERE user_id = '$user_id'";

    if (mysqli_query($database, $sql)) {
        
        header("Location: staff-desktop-account.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($database);
    }
}
?>