<?php
    include("session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge Submission</title>
</head>

<body>
    <div class="main-container">
        <header>
            <h1>Log Action</h1>
            <div class="header-icons">
                <button>📷</button>
                <button>📊</button>
            </div>
        </header>

        <article class="log-form">
            <section class="form-section">
                <label for="challenge-select">Select Challenge</label>
                <select id="challenge-select" name="challenge">
                    <option value="">Select Challenge</option>
                    <option value="urban-gardening">Urban Gardening Initiative</option>
                    <option value="beach-cleanup">Beach Cleanup</option>
                    <option value="tree-planting">Tree Planting</option>
                </select>
            </section>

            <section class="image-upload">
                <figure class="image-placeholder">
                    <svg width="120" height="120" viewBox="0 0 120 120">
                        <rect width="120" height="120" fill="#6B7280" />
                        <circle cx="45" cy="45" r="12" fill="#9CA3AF" />
                        <path d="M20 100 L50 70 L70 90 L100 60 L100 100 Z" fill="#9CA3AF" />
                    </svg>
                </figure>
            </section>

            <section class="notes-section">
                <label>Add Notes (Optional)</label>
                <br>
                <textarea id="notes" name="notes" rows="8" placeholder="e.g. Ivan liek men!"></textarea>
            </section>

            <footer class="action-footer">
                <button type="submit" class="submit-button">Submit For Review</button>
            </footer>

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
</body>

</html>