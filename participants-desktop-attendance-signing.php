<?php
    include("session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Signing</title>
</head>

<body>
    <div class="main-container">
        <header>
            <h1>Sign Attendance</h1>
            <button>📷</button>

        </header>

        <article class="attendance-form">
            <section class="code-input">
                <label class="view-only-code-title">Enter attendance code</label>
                <div class="code-boxes">
                    <input type="text" maxlength="1">
                    <input type="text" maxlength="1">
                    <input type="text" maxlength="1">
                </div>
            </section>

            <section class="scan-section">
                <button type="button" class="scan-button">Scan QR</button>
            </section>

        </article>

        <!-- Bottom navigation (mobile-style) -->
        <nav class="bottom-nav" id="bottomNav" role="navigation">
            <button class="nav-item nav-home" id="navHome" type="button">Home</button>
            <button class="nav-item nav-challenges active" id="navChallenges" type="button">Challenges</button>
            <button class="nav-item nav-scan" id="navScan" type="button">Scan</button>
            <button class="nav-item nav-rewards" id="navRewards" type="button">Rewards</button>
            <button class="nav-item nav-profile" id="navProfile" type="button">Profile</button>
        </nav>
    </div>
            <script src="https://unpkg.com/lucide@latest"></script>
            <script src="desktop-icons.js"></script>

        </body>

        </html>