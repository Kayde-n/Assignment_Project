<?php
session_start();


if (!isset($_POST['reward_id']) || !isset($_SESSION['user_role_id'])) {
    http_response_code(400);
    echo "INVALID";
    exit;
}

$reward_id = (int) $_POST['reward_id'];


$_SESSION['redeem_reward_id'] = $reward_id;
echo "OK";