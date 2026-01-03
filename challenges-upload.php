<?php
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
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Unique filename
    $newName = uniqid('img_', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);

    // Move file
    if (!move_uploaded_file($fileTmp, $uploadDir . $newName)) {
        die('Failed to save file');
    }

    echo "Upload successful: $newName";
}
?>