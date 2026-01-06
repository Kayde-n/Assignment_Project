<?php
    session_start();
    include("database.php");

    if (!isset($_POST['reward_id']) || !isset($_SESSION['user_role_id'])) {
        http_response_code(400);
        echo "INVALID";
        exit;
    }

    $reward_id = (int) $_POST['reward_id'];
    $participant_id = (int) $_SESSION['user_role_id'];

    //get reward cost
    $reward_sql = "SELECT points_required FROM rewards WHERE rewards_id = $reward_id";
    $reward_result = mysqli_query($database, $reward_sql);
    $reward = mysqli_fetch_assoc($reward_result);

    if (!$reward) {
        echo "INVALID_REWARD";
        exit;
    }

    $points_required = (int)$reward['points_required'];

    // get participant total points
    $points_sql = "SELECT COALESCE(SUM(c.points_reward), 0) - COALESCE(SUM(r.points_required), 0) AS total_points
        FROM participants p
        LEFT JOIN participants_challenges pc 
            ON p.participants_id = pc.participants_id
            AND pc.challenges_status = 'approved'
        LEFT JOIN challenges c 
            ON pc.challenges_id = c.challenges_id
        LEFT JOIN reward_redemption rr 
            ON rr.participants_id = p.participants_id
        LEFT JOIN rewards r 
            ON rr.rewards_id = r.rewards_id
        WHERE p.participants_id = $participant_id
    ";

    $points_result = mysqli_query($database, $points_sql);
    $row_points = mysqli_fetch_assoc($points_result);
    $total_points = (int)$row_points['total_points'];

    if ($total_points < $points_required) {
        echo "NOT_ENOUGH_POINTS";
        exit;
    }

    $_SESSION['redeem_reward_id'] = $reward_id;
    echo "OK";

