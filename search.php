<?php
include("Database.php");
header('Content-Type: application/json');

$query = $_GET['query'] ?? '';
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
} elseif ($source === 'home') {
    $items = [
        [
            'title' => 'Eco News',
            'description' => 'Latest environmental news and updates',
            'url' => 'participant-econews-mobile.php'
        ],
        [
            'title' => 'Challenges',
            'description' => 'Challenges tab',
            'url' => 'participant-challenges-mobile.php'
        ],
        [
            'title' => 'LeaderBoard',
            'description' => 'Participants Green Points Leaderboard',
            'url' => 'participant-leaderboard-mobile.php'
        ],
        [
            'title' => 'Log Action',
            'description' => 'Participants Log Action Subbmission Page',
            'url' => 'participant-action-submit-mobile.php'
        ],
        [
            'title' => 'Profile',
            'description' => 'Participants Profile Page',
            'url' => 'participant-profile-mobile.php'
        ],
        [
            'title' => 'Rewards',
            'description' => 'Participants Rewards Page',
            'url' => 'participant-rewards-mobile.php'
        ],
        [
            'title' => 'FAQ',
            'description' => 'Participants Help and Questions Page',
            'url' => 'participant-help-mobile.php'
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

} elseif ($source === 'admin') {
    $items = [
        [
            'title' => 'System Settings',
            'description' => 'System Settings allows administratorsto configure core system preferences',
            'url' => 'Admin_system_config.php'
        ],
        [
            'title' => 'System Analytics',
            'description' => 'System Analytics provides insights into system usage',
            'url' => 'Admin_system_analytics.php'
        ],
        [
            'title' => 'Sustainability Report',
            'description' => 'System sustainability report provides insights into enviromental impact',
            'url' => 'Admin_sustainability_report.php'
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


} elseif ($source === 'event_manager') {
    $items = [
        [
            'title' => 'Event Calendar',
            'description' => 'Event Calendar enables administrators to create, manage, and track scheduled events and activities.',
            'url' => 'event-manager-calendar.php'
        ],
        [
            'title' => 'Rewards Management',
            'description' => 'Rewards Management allows administrators to manage reward programs, points, and redemption rules.',
            'url' => 'event-manager-rewards-management.php'
        ],
        [
            'title' => 'Eco News Management',
            'description' => 'Eco News Management enables administrators to create, update, and publish environmental news and announcements.',
            'url' => 'event-manager-news.php'
        ],
        [
            'title' => 'Profile',
            'description' => 'Eco News Management enables administrators to view profile',
            'url' => 'event-manager-profile.php'
        ],
        [
            'title' => 'Create new Event',
            'description' => 'User will be able to create new events and insert into the database',
            'url' => 'event-manager-event-form.php'
        ],
        [
            'title' => 'Create new Reward',
            'description' => 'User will be able to create new rewards and insert into the database',
            'url' => 'event-manager-new-reward-post.php'
        ],
        [
            'title' => 'Create new News',
            'description' => 'User will be able to create new news and insert into the database',
            'url' => 'event-manager-news-post-form.php'
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

} elseif ($source === 'staff') {
    $items = [
        [
            'title' => 'Participants Management',
            'description' => 'Participants Management enables staff to manage participant accounts, profiles, and participation records.',
            'url' => 'staff-desktop-account-.php'
        ],
        [
            'title' => 'Challenge Submission Verifications',
            'description' => 'Challenge Submission Verifications enables staff to review, verify, and approve participant challenge submissions.',
            'url' => 'staff-desktop-verification.php'
        ],
        [
            'title' => 'Profile',
            'description' => 'Profile enables staff to view and manage their profile information.',
            'url' => 'staff-desktop-profile.php'
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

}else{
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