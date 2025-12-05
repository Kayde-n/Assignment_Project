<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Challenges Tab</title>
</head>

<body>

    <!-- Page wrapper -->
    <div class="challenges-page" id="challengesPage">

        <!-- Header -->
        <h1 class="header-title" id="headerTitle">Challenges</h1>


        <!-- Tabs (Ongoing / Completed) -->
        <nav class="tabs" id="tabs" role="tablist">
            <button class="tab tab-ongoing" id="tabOngoing" role="tab">Ongoing</button>
            <button class="tab tab-completed" id="tabCompleted" role="tab">Completed</button>
        </nav>

        <!-- Main content -->
        <main class="content" id="mainContent">

            <!-- Section: Daily Quests -->
            <section class="daily-quests-section" id="dailyQuestsSection">
                <h2 id="dailyQuestsHeading" class="section-title">Daily Quests</h2>

                <!-- Progress row (e.g., 2/5) -->
                <div class="daily-progress" id="dailyProgress">
                    <label for="dailyProgressMeter" class="progress-label">2/5</label>
                    <!-- HTML progress element (no styling) -->
                    <progress id="dailyProgressMeter" class="progress-meter" value="2" max="5">2 of 5</progress>
                </div>

                <!-- Quest list -->
                <div class="quest-list" id="questList">

                    <!-- Quest card (not claimed) -->
                    <article class="quest-card" id="quest1" role="article">
                        <figure class="quest-image" id="quest1Image">
                            <!-- placeholder for image -->
                            <img src="" alt="Quest image placeholder" />
                        </figure>

                        <div class="quest-body" id="quest1Body">
                            <span class="quest-tag" id="quest1Tag">Bus-to-Campus</span>
                            <h3 class="quest-title" id="quest1Title">Bus-to-Campus</h3>
                            <p class="quest-reward" id="quest1Reward">20GP</p>
                        </div>

                        <div class="quest-action" id="quest1Action">
                            <button class="btn-claim" id="claimBtn1" type="button"
                                aria-label="Claim reward">Claim</button>
                        </div>
                    </article>

                    <!-- Quest card (not claimed) -->
                    <article class="quest-card" id="quest2" role="article">
                        <figure class="quest-image" id="quest2Image">
                            <img src="" alt="Quest image placeholder" />
                        </figure>

                        <div class="quest-body" id="quest2Body">
                            <span class="quest-tag" id="quest2Tag">Bus-to-Campus</span>
                            <h3 class="quest-title" id="quest2Title">Bus-to-Campus</h3>
                            <p class="quest-reward" id="quest2Reward">20GP</p>
                        </div>

                        <div class="quest-action" id="quest2Action">
                            <button class="btn-claim" id="claimBtn2" type="button">Claim</button>
                        </div>
                    </article>

                    <!-- Quest card (claimed state) -->
                    <article class="quest-card claimed" id="quest3" role="article" aria-labelledby="quest3Title">
                        <figure class="quest-image" id="quest3Image">
                            <img src="" alt="Quest image placeholder" />
                        </figure>

                        <div class="quest-body" id="quest3Body">
                            <span class="quest-tag" id="quest3Tag">Bus-to-Campus</span>
                            <h3 class="quest-title" id="quest3Title">Bus-to-Campus</h3>
                            <p class="quest-reward" id="quest3Reward">20GP</p>
                        </div>

                        <div class="quest-action" id="quest3Action">
                            <!-- Claimed state shown as disabled button/text -->
                            <button class="btn-claimed" id="claimedBtn3" type="button" disabled
                                aria-disabled="true">Claimed</button>
                        </div>
                    </article>


                </div>
            </section>

            <!-- Section divider -->
            <hr />

            <!-- Section: Special Events -->
            <section class="special-events-section" id="specialEventsSection" aria-labelledby="specialEventsHeading">
                <h2 id="specialEventsHeading" class="section-title">Special Events</h2>

                <div class="event-list" id="eventList">

                    <!-- Event card -->
                    <article class="event-card" id="event1" role="article" aria-labelledby="event1Title">
                        <figure class="event-image" id="event1Image" aria-hidden="true">
                            <img src="" alt="Event image placeholder" />
                        </figure>

                        <div class="event-body" id="event1Body">
                            <h3 class="event-title" id="event1Title">Campus Cleanup Day</h3>
                            <p class="event-reward" id="event1Reward">500GP</p>
                        </div>

                        <div class="event-action" id="event1Action">
                            <button class="btn-join" id="joinBtn1" type="button">Join</button>
                        </div>
                    </article>

                    <!-- Event card -->
                    <article class="event-card" id="event2" role="article" aria-labelledby="event2Title">
                        <figure class="event-image" id="event2Image" aria-hidden="true">
                            <img src="" alt="Event image placeholder" />
                        </figure>

                        <div class="event-body" id="event2Body">
                            <h3 class="event-title" id="event2Title">Campus Cleanup Day</h3>
                            <p class="event-reward" id="event2Reward">500GP</p>
                        </div>

                        <div class="event-action" id="event2Action">
                            <button class="btn-join" id="joinBtn2" type="button">Join</button>
                        </div>
                    </article>

                </div>
            </section>

        </main>

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