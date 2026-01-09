<?php
require_once __DIR__ . "/../../config/Database.php";

/*
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}*/

// Check if eco_news_id is provided
if (!isset($_GET['eco_news_id']) || empty($_GET['eco_news_id'])) {
    echo "<script>alert('No news ID provided'); window.location.href='event-manager-news.php';</script>";
    exit();
}

$eco_news_id = $_GET['eco_news_id'];

// Delete the news item
$delete_sql = "DELETE FROM eco_news WHERE eco_news_id = ?";
$stmt = mysqli_prepare($database, $delete_sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $eco_news_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('News deleted successfully'); window.location.href='event-manager-news.php';</script>";
    } else {
        echo "<script>alert('Error deleting news: " . mysqli_error($database) . "'); window.location.href='event-manager-news.php';</script>";
    }
    
    mysqli_stmt_close($stmt);
} else {
    echo "<script>alert('Database error: " . mysqli_error($database) . "'); window.location.href='event-manager-news.php';</script>";
}

mysqli_close($database);
?>