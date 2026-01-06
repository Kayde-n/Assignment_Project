<?php
    include("Database.php");

    if (isset($_GET['event_id'])) {
        $event_id = $_GET['event_id'];  

        $delete_sql = "DELETE FROM events WHERE events_id = '$event_id'";
        if (mysqli_query($database, $delete_sql)) {
            echo "<script>alert('Event deleted successfully.'); window.location.href='event-manager-calendar.php';</script>";
        } else {
            echo "Error deleting event: " . mysqli_error($database);
        }
    } else {
        echo "<script>alert('No event ID provided.'); window.location.href='event-manager-calendar.php';</script>";
    }
?>