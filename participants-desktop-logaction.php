<?php
include("session.php");
include("database.php");
$sql_query = "SELECT challenge_name FROM challenges";
$result = mysqli_query($database, $sql_query);
if (!$result) {
    die("Database query failed: " . mysqli_error($database));
}
$challenges = [];
while ($row = mysqli_fetch_assoc($result)) {
    $challenges[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Action</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="participant.css">
    <link rel="stylesheet" href="participants-logaction-desktop.css">

</head>

<body>
    <div class="top-bar">
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='participants-desktop-home.php'">
            <h2>EcoXP</h2>
        </button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='participants-desktop-profile.php'"><i data-lucide="user-round"></i></button>
            <button class="icon-btn"><i data-lucide="bell"></i></button>
            <button class="icon-btn"><i data-lucide="bolt"></i></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="participant-icon-container">
            <button class="icon-btn" onclick="window.location.href='participants-desktop-home.php'"><i data-lucide="house"></i></button>
            <button class="icon-btn"><i data-lucide="trophy"></i></button>
            <div id="log-icon-box">
                <button class="icon-btn" onclick="window.location.href='participants-desktop-logaction.php'"><i data-lucide="scan-line"></i></button>
            </div>
            <button class="icon-btn" onclick="window.location.href='participants-desktop-rewards.php'"><i data-lucide="badge-percent"></i></button>
            <button class="icon-btn" id="logout"><i data-lucide="log-out"></i></button>
        </div>
    </div>
    <div class="main-content">
        <div class="attendance-btn-wrapper">
            <button class="attendance-btn" onclick="window.location.href='participants-desktop-otp.php'">Sign Up for
                Attendance</button>
        </div>
        <div class="log-action-container">

            <div class="text-box">
                Log Action
            </div>
            <form action="challenges-upload.php" method="POST" enctype="multipart/form-data">
                <select class="log-select" name="challenge_selected" required>
                    <?php foreach ($challenges as $challenge): ?>
                        <option><?php echo $challenge['challenge_name']; ?></option>
                    <?php endforeach; ?>
                </select>

                <div class="upload-box">

                    <input type="file" name="upload_file" required>



                </div>


                <textarea class="log-notes" placeholder="Add Notes (Optional)"></textarea>

                <div class="submit-container">
                    <button class="submit-btn">Submit For Review</button>
                </div>
            </form>
        </div>

    </div>

        <script src="https://unpkg.com/lucide@latest"></script>
            <script>
                lucide.createIcons();
            </script>
    </body>

    </html>