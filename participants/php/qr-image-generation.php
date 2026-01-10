<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
$participant_id = $_SESSION['user_role_id'];
$reward_id = $_SESSION['redeem_reward_id'] ?? null;
$date_redeemed = new DateTime();
$date_redeemed_string = $date_redeemed->format("Y-m-d");
$qrToken = bin2hex(random_bytes(16));

$sql_get_reward_info_query = "SELECT rewards_id FROM rewards WHERE rewards_id = $reward_id";
$result = mysqli_query($database, $sql_get_reward_info_query);
if (!$result || mysqli_num_rows($result) == 0) {
    echo "Error: Reward not found";
    exit;
}

$sql_query = "INSERT INTO reward_redemption (participants_id,rewards_id,date_redeemed,qr_used,qr_token) VALUES ($participant_id, $reward_id, '$date_redeemed_string', 0, '$qrToken')";

if (!mysqli_query($database, $sql_query)) {
    echo "Error: " . mysqli_error($database);
    exit;
}

$qrData = urlencode($qrToken);
$qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=$qrData";
$_SESSION['qr_url'] = $qrUrl;


echo $qrUrl;
