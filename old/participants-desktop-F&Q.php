<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help & FAQ</title>

    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="participant.css">
    <link rel="stylesheet" href="participants-F&Q-desktop.css">
</head>

<body>

    <!-- ===== TOP BAR ===== -->
    <div class="top-bar">
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='participants-desktop-home.php'">
            <h2>EcoXP</h2>
        </button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='participants-desktop-profile.php'"><img
                    src="images/profile.png" alt="Profile Logo"></button>
            <button class="icon-btn"><img src="images/notif.png" alt="Notification Logo"></button>
            <button class="icon-btn"><img src="images/setting.png" alt="Setting Logo"></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="participant-icon-container">
            <div id="home-icon-box">
                <button class="icon-btn" onclick="window.location.href='participants-desktop-home.php'"><img
                        src="images/home.png" alt="Home"></button>
            </div>
            <button class="icon-btn"><img src="images/challanges.png" alt="Challenges"></button>
            <button class="icon-btn" onclick="window.location.href='participants-desktop-logaction.php'"><img
                    src="images/scan.png" alt="Scan"></button>
            <div id="reward-icon-box">
                <button class="icon-btn" onclick="window.location.href='participants-desktop-rewards.php'"><img
                        src="images/tag.png" alt="Rewards"></button>
            </div>

        </div>
    </div>

    <div class="main-content">

        <div class="text-box">Help & FAQ</div>

        <div class="faq-search">
            <input type="text" placeholder="Search here">
        </div>

        <div class="faq-list">

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    What are Green Points (GP)?
                    <span>›</span>
                </button>
                <div class="faq-answer">
                    Green Points (GP) are rewards earned by completing eco-friendly activities.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    How much are my GP worth?
                    <span>›</span>
                </button>
                <div class="faq-answer">
                    GP can be redeemed for vouchers and physical rewards based on availability.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Why did my GP total change?
                    <span>›</span>
                </button>
                <div class="faq-answer">
                    GP may change after redemption, activity verification, or corrections.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    My reward voucher isn’t working.
                    <span>›</span>
                </button>
                <div class="faq-answer">
                    Please ensure the voucher is still valid and has not expired.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    How long does verification take?
                    <span>›</span>
                </button>
                <div class="faq-answer">
                    Verification usually takes 1–3 working days.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    I think there is a bug in the app.
                    <span>›</span>
                </button>
                <div class="faq-answer">
                    Please report bugs via the Help section or contact support.
                </div>
            </div>

        </div>
    </div>

    <script>
        function toggleFaq(btn) {
            const answer = btn.nextElementSibling;
            const arrow = btn.querySelector("span");

            if (answer.style.display === "block") {
                answer.style.display = "none";
                arrow.style.transform = "rotate(0deg)";
            } else {
                answer.style.display = "block";
                arrow.style.transform = "rotate(90deg)";
            }
        }
    </script>

</body>

</html>