<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant Home Mobile</title>
    <link rel="stylesheet" href="mobile.css">
    <link rel="stylesheet" href="participant-help-mobile.css">    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

    <!-- navigation bar -->
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

   <!-- page header -->
    <div class="page-header">
        <a href="participant-profile-mobile.php" class="return-btn" aria-label="Return button">
                <i data-lucide="arrow-left"></i>
        </a>
        <div class="header-title">Help & FAQ</div>     
    </div>

    

    <div class="profile-page">
   

    <!-- Quick Access -->
    <div class="quick-access">
    
   
    <div class="quick-item">
        <div class="quick-header">
        <span>What are Green Points (GP)?</span>
        <button>
        <i data-lucide="chevron-right" class="chevron"></i>
        </button>
        </div>
        <div class="panel">
        <p>Lorem ipsum...</p>
        </div>
    </div>
    

    <div class="quick-item">
        <div class="quick-header">
        <span>How much are my GP worth?</span>
        <button>
        <i data-lucide="chevron-right" class="chevron"></i>
        </button>
        </div>
        <div class="panel">
        <p>Lorem ipsum...</p>
        </div>
    </div>

    <div class="quick-item">
        <div class="quick-header">
        <span>My reward voucher isn't working.</span>
        <button>
        <i data-lucide="chevron-right" class="chevron"></i>
        </button>
        </div>
        <div class="panel">
        <p>Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit amet consectetur adipisci[ng] velit, sed quia non numquam [do] eius modi tempora inci[di]dunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum[d] exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? [D]Quis autem vel eum i[r]ure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?</p>
        </div>
    </div>

    <div class="quick-item">
        <div class="quick-header">
        <span>How long does verification take?</span>
        <button>
        <i data-lucide="chevron-right" class="chevron"></i>
        </button>
        </div>
        <div class="panel">
        <p>Lorem ipsum...</p>
        </div>
    </div>

    <div class="quick-item">
        <div class="quick-header">
        <span>I think there is a bug in the app.</span>
        <button>
        <i data-lucide="chevron-right" class="chevron"></i>
        </button>
        </div>
        <div class="panel">
        <p>Lorem ipsum...</p>
        </div>
    </div>

 

    <script>
document.querySelectorAll(".quick-header").forEach(header => {
    header.addEventListener("click", function () {
        const item = this.parentElement;              // .quick-item
        const panel = item.querySelector(".panel");   // ✅ correct
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

lucide.createIcons();
</script>



</body>
</html>