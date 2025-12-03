<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboards</title>
</head>

<body>
    <div>
        <button name="back_bttn">&larr;</button>
        <h1>Leaderboard</h1>
    </div>

    <?php
    // Array of participants (ONLY TEMPLATE, DATA SHOULD COME FROM DATABASE, )
    $participants = [
        ["name" => "Sebastian", "score" => 12000],
        ["name" => "Natalie", "score" => 11700],
        ["name" => "Jason", "score" => 11200],
        ["name" => "Serenity", "score" => 10900],
        ["name" => "Hannah", "score" => 10700],
        ["name" => "Ivan", "score" => 10600]
    ];

    // Loop through and generate divs
    foreach ($participants as $participant) {
        echo '<div>';
        echo '    <div>';
        echo '        <img src="placeholder.jpg" alt="' . $participant['name'] . '">';
        echo '    </div>';
        echo '    <div>';
        echo '        <span>' . $participant['name'] . '</span>';
        echo '        <span>' . $participant['score'] . '</span>';
        echo '    </div>';
        echo '</div>';
    }
    ?>

</body>

</html>