<?php
session_start();

if (!isset($_POST['reward_id'])) {
    http_response_code(400);
    echo "Missing reward_id";
    exit;
}

$_SESSION['redeem_reward_id'] = (int) $_POST['reward_id'];
if (!isset($_SESSION['redeem_reward_id'])) {
    http_response_code(500);
    echo "Failed to set session variable";
    exit;
}
echo "OK";