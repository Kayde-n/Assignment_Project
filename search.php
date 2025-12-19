<?php
header('Content-Type: application/json');

// Database connection
$conn = new mysqli('localhost', 'username', 'password', 'eco_xp');

if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed']));
}

if ($_GET['query']) {
    $query = $_GET['query'];
} else {
    $query = '';
}
$query = mysqli_real_escape_string($conn, $query);

// Search in title and description
$sql_query = "SELECT eco_news_id, title, description, image_path, venue, organised_by 
        FROM eco_news 
        WHERE title LIKE '%$query%' 
        ORDER BY eco_news_id DESC";

$result = mysqli_query($conn, $sql_query);
$results = mysqli_fetch_array($result);

echo json_encode($results);

mysqli_close($conn);
?>