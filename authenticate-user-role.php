<?php
ini_set('session.cookie_path', '/');
session_start();

require_once __DIR__ . "/config/database.php";


$sql_query = "SELECT participants_id from participants where user_id = " . $_SESSION['mySession'];
$sql_query_admin = "SELECT admin_id from admin where user_id = " . $_SESSION['mySession'];
$sql_query_event_manager = "SELECT event_manager_id from event_manager where user_id = " . $_SESSION['mySession'];
$sql_query_staff = "SELECT staff_id from staff where user_id = " . $_SESSION['mySession'];

$result = mysqli_query($database, $sql_query);
$result_admin = mysqli_query($database, $sql_query_admin);
$result_event_manager = mysqli_query($database, $sql_query_event_manager);
$result_staff = mysqli_query($database, $sql_query_staff);


$row = mysqli_fetch_array($result);
$row_admin = mysqli_fetch_array($result_admin);
$row_event_manager = mysqli_fetch_array($result_event_manager);
$row_staff = mysqli_fetch_array($result_staff);

if (mysqli_num_rows($result) == 1) {

    $_SESSION['user_role_id'] = $row['participants_id'];
    $_SESSION['user_role'] = 'participant';
} else if (mysqli_num_rows($result_admin) == 1) {

    $_SESSION['user_role_id'] = $row_admin['admin_id'];
    $_SESSION['user_role'] = 'admin';
} else if (mysqli_num_rows($result_event_manager) == 1) {

    $_SESSION['user_role_id'] = $row_event_manager['event_manager_id'];
    $_SESSION['user_role'] = 'event_manager';
} else if (mysqli_num_rows($result_staff) == 1) {

    $_SESSION['user_role_id'] = $row_staff['staff_id'];
    $_SESSION['user_role'] = 'staff';
} else {
    echo "<script>alert('Error Occurred! No user role found. Consult admin to report the issue');window.location.href='Login.php';</script>";

    exit();
}
if (isset($_SESSION['user_role_id'])) {
    echo "$_SESSION[user_role_id]";
    if ($_SESSION['user_role'] == 'participant') {
        header("location: participants/php/participant-home-mobile.php");
    } else if ($_SESSION['user_role'] == 'admin') {
        header("location: admin/php/admin_home.php");
    } else if ($_SESSION['user_role'] == 'event_manager') {
        header("location: event_manager/php/event-manager-home.php");
    } else if ($_SESSION['user_role'] == 'staff') {
        header("location: Staff/php/staff-desktop-home.php");

    }


} else {
    echo '<script>alert("User role authentication failed. Please contact support.");</script>';
}

