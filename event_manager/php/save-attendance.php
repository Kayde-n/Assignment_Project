<?php
require_once __DIR__ . "/../../config/Database.php";

$event_id = $_POST['event_id'];
$attendance = $_POST['attendance'] ?? [];

// Reset all to NOT attended
$reset_sql = "
    UPDATE attendance
    SET event_attended = 0
    WHERE events_id = '$event_id'
";
mysqli_query($database, $reset_sql);

// Set attended = 1 for checked participants
foreach ($attendance as $participant_id => $value) {
    $update_sql = "
        UPDATE attendance
        SET event_attended = 1
        WHERE events_id = '$event_id'
        AND participants_id = '$participant_id'
    ";
    mysqli_query($database, $update_sql);
}

echo "
<script>
    alert('✅ Attendance updated successfully!');
    window.location.href = 'event-manager-attendees.php?events_id=$event_id';
</script>
";
exit;

?>
