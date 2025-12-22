<?php
include("Database.php");
header('Content-Type: application/json');

$query = $_GET['query'] ?? '';
$query = mysqli_real_escape_string($database, $query);

// Search in title and description
$sql_query = "SELECT eco_news_id, title, description, image_path, venue, organised_by 
        FROM eco_news 
        WHERE title LIKE '%$query%' 
        ORDER BY eco_news_id DESC";

$result = mysqli_query($database, $sql_query);
$results = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $results[] = $row;
    }
}


echo json_encode($results);
mysqli_close($database);