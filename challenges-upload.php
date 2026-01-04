<?php
session_start();
include("database.php");
$participant_id = $_SESSION['user_role_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_FILES['upload_file']) || $_FILES['upload_file']['error'] !== UPLOAD_ERR_OK) {
        die('File upload failed');
    }

    $file = $_FILES['upload_file'];

    // File info
    $fileTmp = $file['tmp_name'];
    $fileName = basename($file['name']);
    $fileSize = $file['size'];
    $fileType = mime_content_type($fileTmp);

    // Allowed types
    $allowed = ['image/jpeg', 'image/png', 'image/webp'];

    if (!in_array($fileType, $allowed)) {
        die('Invalid file type');
    }

    // Size limit (2MB)
    if ($fileSize > 2 * 1024 * 1024) {
        die('File too large');
    }

    // Upload folder
    $uploadDir = 'challenge_submission_uploads/';
    if (!is_dir($uploadDir)) { //recursive directory creation ensures directory created if missing 
        mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist, server is local, r/w/x permissions for all users
    }

    // Unique filename
    $newName = uniqid('img_', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);

    // Move file
    $targetPath = $uploadDir . $newName;
    if (!move_uploaded_file($fileTmp, $targetPath)) {
        die('Failed to save file');
    }
    // Insert into database
<<<<<<< HEAD
    $sql_query1 = "SELECT challenges_id FROM challenges WHERE challenge_name = '" . mysqli_real_escape_string($database, $_POST['challenge_selected']) . "'";
    $result = mysqli_query($database, $sql_query1);
    if (!$result) {
        die("Database query failed: " . mysqli_error($database));
    }
    $row = mysqli_fetch_assoc($result);
    if (!$row) {
        die("Challenge not found");
    }
    $challenges_id = $row['challenges_id'];
=======
    $sql_query1 = "SELECT challenges_id FROM challenges WHERE challenge_name = '$_POST[challenge_selected]'";
    $result = mysqli_query($database, $sql_query1);
    $row = mysqli_fetch_array($result);
    $challenges_id = $row['challenges_id'];

    if (!$result) {
        die("Database query failed: " . mysqli_error($database));
    }
>>>>>>> 1292f447953e6b82a798fb2108f090e526de5cee

    $today = new DateTime();
    $todayString = $today->format("Y-m-d");

<<<<<<< HEAD
    $sql_query2 = "INSERT INTO participants_challenges (participants_id,challenges_id,date_accomplished,verified_date,challenges_status,impact_type,image_path,impact_amount,staff_id) VALUES ('$participant_id', '$challenges_id', '$todayString', NULL, 'pending', '$targetPath', NULL, NULL, NULL)";

    if (mysqli_query($database, $sql_query2)) {
=======
    $staff_id = [];
    $sql_query2 = "SELECT staff_id FROM staff";
    $result = mysqli_query($database, $sql_query2);
    if (!$result) {
        die("Database query failed: " . mysqli_error($database));
    }
    while ($row = mysqli_fetch_array($result)) {
        $staff_id[] = $row['staff_id'];
    }
    $randomINdex = array_rand($staff_id);

    $sql_query3 = "INSERT INTO participants_challenges (participants_id,challenges_id,date_accomplished,verified_date,challenges_status,impact_type,image_path,impact_amount,staff_id) VALUES ('$participant_id', '$challenges_id', '$todayString', NULL, 'pending',NULL, '$targetPath', NULL, '$staff_id[$randomINdex]')";

    if (mysqli_query($database, $sql_query3)) {
>>>>>>> 1292f447953e6b82a798fb2108f090e526de5cee
        echo "Upload successful: $newName";
    } else {
        die("Insert failed: " . mysqli_error($database));
    }
}
?>