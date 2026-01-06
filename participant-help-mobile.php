<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant FAQ Mobile</title>
    <link rel="stylesheet" href="mobile.css">
    <link rel="stylesheet" href="participant-help-mobile.css">    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
<!-- nav bar -->
    <nav class="bottom-nav">
        <a href="participant-home-mobile.php" class="nav-item">
            <i data-lucide="house" class="icon-btn"></i>
        </a>
        <a href="participant-challenges-mobile.php" class="nav-item">
            <i data-lucide="trophy" class="icon-btn"></i>
        </a>
        <a href="participant-action-submit-mobile.php" class="nav-item">
            <i data-lucide="scan-line" class="icon-btn"></i>
        </a>
        <a href="participant-rewards-mobile.php" class="nav-item">
            <i data-lucide="badge-percent" class="icon-btn"></i>
        </a>
        <a href="participant-profile-mobile.php" class="nav-item">
            <i data-lucide="user-round" class="icon-btn"></i>
        </a>
    </nav>
<!-- title -->
    <div class="page-header">
        <a href="participant-profile-mobile.php" class="return-btn" aria-label="Return button">
            <i data-lucide="arrow-left"></i>
        </a>
        <div class="header-title">Help & FAQ</div>     
    </div>
<!-- faq -->
    <div class="faq-page">
        <div class="faq-access">
            
            <div class="faq-item">
                <div class="faq-header">
                    <span>What are Green Points (GP)?</span>
                    <button>
                        <i data-lucide="chevron-right" class="chevron"></i>
                    </button>
                </div>
                <div class="panel">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Green Points are our way of rewarding your sustainable actions.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header">
                    <span>How much are my GP worth?</span>
                    <button>
                        <i data-lucide="chevron-right" class="chevron"></i>
                    </button>
                </div>
                <div class="panel">
                    <p>Points can be redeemed for various rewards in our store, ranging from campus coffee vouchers to sustainable merchandise.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header">
                    <span>My reward voucher isn't working.</span>
                    <button>
                        <i data-lucide="chevron-right" class="chevron"></i>
                    </button>
                </div>
                <div class="panel">
                    <p>Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header">
                    <span>How long does verification take?</span>
                    <button>
                        <i data-lucide="chevron-right" class="chevron"></i>
                    </button>
                </div>
                <div class="panel">
                    <p>Usually, our team verifies submissions within 24 to 48 hours.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header">
                    <span>I think there is a bug in the app.</span>
                    <button>
                        <i data-lucide="chevron-right" class="chevron"></i>
                    </button>
                </div>
                <div class="panel">
                    <p>Please report any technical issues to our support team via the contact form on our website.</p>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Lucide Icon Initialization
        lucide.createIcons();

        // Accordion Logic
        document.querySelectorAll(".faq-header").forEach(header => {
            header.addEventListener("click", function () {
                const item = this.parentElement;
                const panel = item.querySelector(".panel");
                const chevron = this.querySelector(".chevron");

                if (panel.style.display === "block") {
                    panel.style.display = "none";
                    chevron.style.transform = "rotate(0deg)";
                } else {
                    panel.style.display = "block";
                    chevron.style.transform = "rotate(90deg)";
                }
            });
        });
    </script>

</body>
</html>