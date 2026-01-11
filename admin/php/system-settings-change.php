<?php
require_once __DIR__ . "/../../config/database.php";

// Handle challenge points update
if (isset($_POST['points']) && isset($_POST['challenge_names'])) {
    $challenge_names = $_POST['challenge_names'];
    $points = $_POST['points'];

    $success_count = 0;

    foreach ($challenge_names as $index => $challenge_name) {
        // Get corresponding points value
        $new_points = isset($points[$challenge_name]) ? $points[$challenge_name] : 0;

        $sql = "UPDATE challenges 
                SET points_reward = '$new_points' 
                WHERE challenge_name = '$challenge_name'";

        if (mysqli_query($database, $sql)) {
            $success_count++;
        } else {
            echo "Error updating $challenge_name: " . mysqli_error($database) . "<br>";
        }
    }

    echo "<script>
        alert('Updated $success_count challenges!');
        window.location.href='Admin_system_config.php';
    </script>";
}
?>