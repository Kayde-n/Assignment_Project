<?php
    include("session.php");
    if(isset($_GET['id'])){
        $news_id = $_GET['id'];
        $sql = "SELECT eco_news_id, title, description, image_path, venue, organised_by FROM eco_news WHERE eco_news_id = $news_id";
        $result = mysqli_query($con, $sql);  // Fixed: was "myqli_query"
        if(mysqli_num_rows($result) > 0){
            $news = mysqli_fetch_assoc($result);
        } else {
            echo "<script>alert('News not found.'); window.location.href = 'participants-home.php'; </script>";  // Fixed: was "windows"
            exit();
        }  // Added missing closing brace
    } else {
        echo "<script>alert('Invalid news ID.'); window.location.href = 'participants-home.php';</script>";  // Added missing semicolon
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $news['title']; ?> - News Details</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="participant.css">
</head>

<body>
    <button class="back-bttn" id="back-bttn-id" onclick="window.history.back()">&larr;</button>
    <div>
        <img src="<?php echo $news['image_path']; ?>" alt="Image PLaceholder">
    </div>
    <p><strong><?php echo $news['organised_by']; ?></strong></p>
    <h2><?php echo $news['title']; ?></h2>
    <p>
        <?php echo nl2br($news['description']); ?>    
    </p>
    <p><em>Venue: <?php echo $news['venue']; ?></em></p>
    <nav>
        <button onclick="location.href='participants-home.php'">Home</button>
        <button onclick="location.href='tools.php'">Tools</button> <!-- dont have php yet -->
        <button onclick="location.href='scan.php'">Scan</button> <!-- dont have php yet -->
        <button onclick="location.href='messages.php'">Messages</button>  <!-- dont have php yet -->
        <button onclick="location.href='participants-profile-desktop'">Profile</button> <!-- dont have php yet -->
    </nav>

</body>

</html>
<?php
    mysqli_close($con);  // Moved inside PHP tags
?>