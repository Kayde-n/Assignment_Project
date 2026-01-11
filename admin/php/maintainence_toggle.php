<?php
session_start();
require_once __DIR__ . "/../../config/database.php";

$status = $_POST['status'] ?? null;

if ($status !== null && ($status == '0' || $status == '1')) {
    $status = (int) $status;

    if ($status == 1) {
        $now = date("Y-m-d H:i:s");

        $sql_query = "INSERT INTO downtime (admin_id, start_time, end_time)
            VALUES (1, '$now', '2099-12-31 23:59:59')";

        if (mysqli_query($database, $sql_query)) {
            echo "OK";
        } else {
            echo "ERROR: " . mysqli_error($database);
        }
    } else {
        $sql_query2 = "DELETE FROM downtime WHERE admin_id = 1 AND end_time = '2099-12-31 23:59:59'";
        if (mysqli_query($database, $sql_query2)) {
            echo "OK";
        } else {
            echo "ERROR: " . mysqli_error($database);
        }
    }
} else {
    echo "ERROR: Invalid status";
}
?>