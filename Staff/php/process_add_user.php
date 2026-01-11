<?php
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = mysqli_real_escape_string($database, $_POST['full_name']);
    $email     = mysqli_real_escape_string($database, $_POST['email']);
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role      = $_POST['role'];
    $status    = "Active";
    $profile   = "images/profile.png";

    mysqli_begin_transaction($database);
    try {
        $q1 = "INSERT INTO user (user_full_name, email, hash_password, profile_picture_path, account_status) 
               VALUES ('$full_name', '$email', '$password', '$profile', '$status')";
        mysqli_query($database, $q1);
        $new_id = mysqli_insert_id($database);

        if ($role === 'Participants') {
            $tp = mysqli_real_escape_string($database, $_POST['tp_no']);
            $q2 = "INSERT INTO participants (user_id, TP_no) VALUES ('$new_id', '$tp')";
        } elseif ($role === 'Staff') {
            $q2 = "INSERT INTO staff (user_id) VALUES ('$new_id')";
        } elseif ($role === 'EventManager') {
            $q2 = "INSERT INTO event_manager (user_id) VALUES ('$new_id')";
        }
        
        mysqli_query($database, $q2);
        mysqli_commit($database);
        if($_SESSION['user_role'] === 'staff'){
            header("Location: staff-desktop-manage.php?success=1");
            } else {
            header("Location: ../../admin/php/account-management.php?success=1");
        } 
}catch (Exception $e) {
            mysqli_rollback($database);
            header("Location: staff-desktop-manage.php?error=1");
            }
}

?>