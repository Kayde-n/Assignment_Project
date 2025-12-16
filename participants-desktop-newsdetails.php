<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mewsDetails</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="participant.css">
    <link rel="stylesheet" href="participants-newsdetails-desktop.css">
 
</head>
<body>
    <div class="top-bar">
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='participants-desktop-home.php'"><h2>EcoXP</h2></button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='participants-desktop-profile.php'"><img src="images/profile.png" alt="Profile Logo"></button>
            <button class="icon-btn"><img src="images/notif.png" alt="Notification Logo"></button>
            <button class="icon-btn"><img src="images/setting.png" alt="Setting Logo"></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="participant-icon-container">
            <div id="home-icon-box">
                <button class="icon-btn" onclick="window.location.href='participants-desktop-home.php'"><img src="images/home.png" alt="Home"></button>
            </div>
            <button class="icon-btn"><img src="images/challanges.png" alt="Challenges"></button>
            <button class="icon-btn" onclick="window.location.href='participants-desktop-logaction.php'"><img src="images/scan.png" alt="Scan"></button>
            <button class="icon-btn"><img src="images/tag.png" alt="Rewards"></button>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>
    <div class="main-content">

        <div class="news-image">
            <img src="images/sample-image.png" alt="sample image">
        </div>

        <div class="news-text-container">

            <h2 class="news-title">
                Top 5 Green Tips for reducing e-waste.
            </h2>

            <p class="news-paragraph">
                UK businesses and households produce 1.45 million tonnes of e-waste a year,
                equating to 23.9kg of e-waste each year per capita, which places the UK as
                the second highest producer in the world.
            </p>

            <p class="news-paragraph">
                What is e-waste?
            </p>

            <p class="news-paragraph">
                Electronic waste, or e-waste, refers to any product with electrical components
                that businesses and households dispose of, including laptops, tablets, phones,
                televisions, air conditioners and printers. The proliferation of devices among
                businesses and households is causing a major environmental problem since most
                electronic waste contains toxic materials.
            </p>

            <div class="quote-box">
                <p>
                    “Ask yourself: ‘How long will this device truly serve me?’
                    Don’t just chase the newest model. A device that is well-built
                    with good core specifications will last longer.”
                </p>
            </div>

        </div>
    </div>

</body>
</html>