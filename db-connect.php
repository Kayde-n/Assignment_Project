<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection</title>
</head>

<body>
    <?php
    $con = mysqli_connect("localhost", "root", "", "ecoxp database");
    // Check connection (optional)
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    ?>
</body>

</html>