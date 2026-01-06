<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Action</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="participant.css">
    <link rel="stylesheet" href="participants-logaction-desktop.css">
    <style>
        .otp-container {
            padding: 40px;
            border-radius: 20px;
            width: 840px;
            background-color: rgba(255, 255, 255, 0.6);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
            margin: 40px auto; 
        }
        .otp-boxes {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }
        .otp-input {
            width: 240px;
            height: 320px;
            font-size: 128px;
            text-align: center;
            border-radius: 16px;
            border: 3px solid #53B757;
            outline: none;
            transition: 0.2s ease;
        }
        .otp-input:focus {
            border-color: #3fa84a;
            box-shadow: 0 0 10px rgba(83,183,87,0.4);
        }
        .otp-submit {
            width: 240px;
            height: 56px;
            background: #53B757;
            border: none;
            border-radius: 16px;
            color: white;
            font-size: 20px;
            font-weight: 600;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }
        .otp-submit:hover {
            background: #46a14b;
        }

    </style>
 
</head>
<body>
    <div class="top-bar">
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='participants-desktop-home.php'"><h2>EcoXP</h2></button>
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
        <div class="text-box">
                Enter OTP
        </div>

        <div class="otp-container">
            <div class="otp-boxes">
                <input type="text" maxlength="1" class="otp-input">
                <input type="text" maxlength="1" class="otp-input">
                <input type="text" maxlength="1" class="otp-input">
            </div>
            <button class="otp-submit">Verify</button>
        </div>

</div>

    <script src="https://unpkg.com/lucide@latest"></script>
            <script>
                lucide.createIcons();
            </script>
</body>
</html>