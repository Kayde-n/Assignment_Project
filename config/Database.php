<?php
$database = mysqli_connect("localhost", "root", "", "ecoxp database");

if (mysqli_connect_errno()) {
    error_log("Database connection failed: " . mysqli_connect_error());
    exit();
}
?>