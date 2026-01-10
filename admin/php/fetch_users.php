<?php
require_once __DIR__ . "/../../config/database.php";
$role = $_GET['role'] ?? 'Participants';


if ($role === 'Participants') {
    $query = "SELECT u.user_full_name, u.email, u.account_status, p.TP_no FROM participants p JOIN user u ON p.user_id = u.user_id";
} elseif ($role === 'Staff') {
    $query = "SELECT u.user_full_name, u.email, u.account_status FROM staff s JOIN user u ON s.user_id = u.user_id";
} else {
    $query = "SELECT u.user_full_name, u.email, u.account_status FROM event_manager em JOIN user u ON em.user_id = u.user_id";
}

$result = mysqli_query($database, $query);

echo '<table width="100%" style="border-collapse: collapse;">
        <tr style="background-color: var(--primary-green); color: white; text-align: left;">
            <th style="padding: 12px;">Name</th>
            <th style="padding: 12px;">Email</th>';
if ($role === 'Participants') echo '<th style="padding: 12px;">TP Number</th>';
echo '      <th style="padding: 12px;">Status</th></tr>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr style="border-bottom: 1px solid #eee;">
            <td data-label="Name" style="padding: 12px;">'.htmlspecialchars($row['user_full_name']).'</td>
            <td data-label="Email" style="padding: 12px;">'.htmlspecialchars($row['email']).'</td>';
    if ($role === 'Participants') echo '<td data-label="TP Number" style="padding: 12px;">'.htmlspecialchars($row['TP_no']).'</td>';
    echo '  <td data-label="Status" style="padding: 12px;">'.htmlspecialchars($row['account_status']).'</td></tr>';
}
echo '</table>';
?>