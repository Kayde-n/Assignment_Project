<?php
    require_once __DIR__ . "/../../session.php";
    require_once __DIR__ . "/../../config/database.php";
    $user_id = $_SESSION['user_id'];
    $participants_id = $_SESSION['user_role_id'];

    if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    echo "Event ID: " . $event_id;
    }

    if ($event_id === null) {
    die('Event ID not provided');
}
    $sql = "INSERT INTO attendance(events_id, participants_id,time_taken,event_attended) VALUES ('$event_id', '$participants_id', NULL, 0)";
    if (mysqli_query($database, $sql)) {
        echo "<script>alert('Successfully joined the event!');window.location.href='participant-challenges-mobile.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($database);
    }


?>