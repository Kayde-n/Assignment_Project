<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();
require_once __DIR__ . "/../../config/database.php";

// Ensure the user is a participant
if (!isset($_SESSION['user_role_id'])) {
    header("Location: ../../login.php");
    exit();
}

$participant_id = $_SESSION['user_role_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Validate File Upload
    if (!isset($_FILES['upload_file']) || $_FILES['upload_file']['error'] !== UPLOAD_ERR_OK) {
        die('File upload failed or no file selected.');
    }

    $file = $_FILES['upload_file'];
    $fileTmp = $file['tmp_name'];
    $fileName = basename($file['name']);
    $fileSize = $file['size'];
    $fileType = mime_content_type($fileTmp);

    // 2. Allowed File Types & Size (2MB)
    $allowed = ['image/jpeg', 'image/png', 'image/webp'];
    if (!in_array($fileType, $allowed)) {
        echo "<script>alert('Invalid file type. Please upload JPG, PNG, or WEBP.'); window.history.back();</script>";
        exit();
    }

    if ($fileSize > 2 * 1024 * 1024) {
        echo "<script>alert('File is too large (Max 2MB).'); window.history.back();</script>";
        exit();
    }

    // 3. Folder Path Logic (Go up to root from participant/php/)
    $uploadDir = '../../challenge_submission_uploads/';
    if (!is_dir($uploadDir)) { 
        mkdir($uploadDir, 0755, true); 
    }

    // 4. Generate Unique Filename & Physical Path
    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    $newName = uniqid('img_', true) . '.' . $extension;
    $targetPath = $uploadDir . $newName;

    // 5. Move file to the physical folder
    if (!move_uploaded_file($fileTmp, $targetPath)) {
        die('Failed to save file to server.');
    }

    // 6. Fetch challenge_id (Sanitized)
    $challenge_selected = mysqli_real_escape_string($database, $_POST['challenge_selected']);
    $sql_query1 = "SELECT challenges_id FROM challenges WHERE challenge_name = '$challenge_selected'";
    $result1 = mysqli_query($database, $sql_query1);
    $row1 = mysqli_fetch_array($result1);
    
    if (!$row1) {
        die("Challenge not found.");
    }
    $challenges_id = $row1['challenges_id'];

    // 7. Get Random Staff ID for assignment
    $staff_ids = [];
    $sql_query2 = "SELECT staff_id FROM staff";
    $result2 = mysqli_query($database, $sql_query2);
    while ($row_s = mysqli_fetch_array($result2)) {
        $staff_ids[] = $row_s['staff_id'];
    }
    
    if (empty($staff_ids)) {
        die("No staff members available to assign verification.");
    }
    $randomStaff = $staff_ids[array_rand($staff_ids)];

    // 8. FINAL INSERT (Database saves ONLY the filename $newName)
    $todayString = date("Y-m-d");
    $challenge_notes = mysqli_real_escape_string($database, $_POST['challenge_notes']);

    $sql_query3 = "INSERT INTO participants_challenges 
        (participants_id, challenges_id, date_accomplished, verified_date, challenges_status, impact_type, image_path, impact_amount, Challenge_notes, staff_id) 
        VALUES ('$participant_id', '$challenges_id', '$todayString', NULL, 'pending', NULL, '$newName', NULL, '$challenge_notes', '$randomStaff')";

    if (mysqli_query($database, $sql_query3)) {
        $_SESSION['popup_message'] = "Upload successful!";
        header("Location: participant-action-submit-mobile.php");
        exit();
    } else {
        die("Database error: " . mysqli_error($database));
    }
}
?>