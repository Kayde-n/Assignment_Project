<?php
require_once __DIR__ . "/config/database.php";
date_default_timezone_set("Asia/Kuala_Lumpur");
$current_time = date("Y-m-d H:i:s");
$sql = "SELECT * FROM downtime 
        WHERE start_time < '$current_time'
          AND end_time > '$current_time'
        LIMIT 1";
$result = mysqli_query($database, $sql);

// If a row exists, maintenance mode is active
if (mysqli_num_rows($result) > 0) {


    $downtime = mysqli_fetch_assoc($result);
    if ($downtime['end_time'] == '2099-12-31 23:59:59') {
        $new_end_time = 'Indefinitely';
        $message1 = "System is under maintenance from "
            . date("d M Y H:i", strtotime($downtime['start_time']))
            . " to "
            . $new_end_time
            . ". Please try again later.";
        echo "<h1>Maintenance Mode</h1>";
        echo "<p>$message1</p>";
        exit(); // Stop further script execution
    }
    $message2 = "System is under maintenance from "
        . date("d M Y H:i", strtotime($downtime['start_time']))
        . " to "
        . date("d M Y H:i", strtotime($downtime['end_time']))
        . ". Please try again later.";
    // Block access
    echo "<h1>Maintenance Mode</h1>";
    echo "<p>$message2</p>";
    exit(); // Stop further script execution
}