<?php
include("Database.php");
header('Content-Type: application/json');

$query  = $_GET['query']  ?? '';
$source = $_GET['source'] ?? ''; 
$results = [];

$query = mysqli_real_escape_string($database, $query);

if ($source === 'eco_news') {
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
}
elseif($source === 'home'){ 
    $items = [
        [
            'title' => 'Eco News',
            'description' => 'Latest environmental news and updates',
            'url' => 'participants-desktop_econews.php'
        ],
        [
            'title' => 'Challenges',
            'description' => 'Challenges tab',
            'url' => 'participants-challenges-details.php'
        ],
        [
            'title' => 'LeaderBoard',
            'description' => 'Participants Green Points Leaderboard',
            'url' => 'participants-desktop_leaderboard.php'
        ]
    ];

    foreach ($items as $item) {
        if (
            stripos($item['title'], $query) !== false ||
            stripos($item['description'], $query) !== false
        ) {
            $results[] = $item;
        }
    }
}

echo json_encode($results);
mysqli_close($database);