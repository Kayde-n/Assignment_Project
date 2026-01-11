<?php
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../../config/database.php";
date_default_timezone_set("Asia/Kuala_Lumpur");

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    echo "<script>
        alert('Access denied. Admin only.');
        window.location.href = '../../login.php';
    </script>";
    exit();
    }

$today = new DateTime();
if ($today) {
    $todayString = $today->format("Y-m-d");

}
$today->modify("-1 day");
if ($today) {
    $yesterdayString = $today->format("Y-m-d");

}

$sql_active_users1 = "SELECT *
                    from participants_challenges 
                    WHERE date_accomplished = '$todayString'
                    ";
$result = mysqli_query($database, $sql_active_users1);
$todays_users = mysqli_num_rows($result);

$sql_active_users2 = "SELECT * from participants_challenges 
                    WHERE date_accomplished = '$yesterdayString'
                    ";
$result1 = mysqli_query($database, $sql_active_users2);
$yesterdays_users = mysqli_num_rows($result1);

if ($yesterdays_users == 0) {
    $percentage_diff = ($todays_users == 0) ? 0 : 100; 
} else {
    $percentage_diff = (($todays_users - $yesterdays_users) / $yesterdays_users) * 100;
}
if ($percentage_diff >= 0) {
    $percentage_change = 'positive';
} else {
    $percentage_change = 'negative';
}



$today->modify("-1 month");
if ($today) {
    $lastMonthString = $today->format("Y-m-d");
}
$sql_active_users_per_month = "SELECT * from participants_challenges WHERE date_accomplished > '$lastMonthString'";

$today->modify("-1 month");
if ($today) {
    $last_2_MonthString = $today->format("Y-m-d");
}
$sql_active_users_per_month2 = "SELECT * from participants_challenges WHERE date_accomplished > '$last_2_MonthString' AND date_accomplished <= '$lastMonthString'";

$today->modify("-1 month");
if ($today) {
    $last_3_MonthString = $today->format("Y-m-d");
}
$sql_active_users_per_month3 = "SELECT * from participants_challenges WHERE date_accomplished > '$last_3_MonthString' AND date_accomplished <= '$last_2_MonthString'";

$today->modify("-1 month");
if ($today) {
    $last_4_MonthString = $today->format("Y-m-d");
}
$sql_active_users_per_month4 = "SELECT * from participants_challenges WHERE date_accomplished > '$last_4_MonthString' AND date_accomplished <= '$last_3_MonthString'";




$result_per_month1 = mysqli_query($database, $sql_active_users_per_month);
$monthly_users1 = mysqli_num_rows($result_per_month1);

$result_per_month2 = mysqli_query($database, $sql_active_users_per_month2);
$monthly_users2 = mysqli_num_rows($result_per_month2);

$result_per_month3 = mysqli_query($database, $sql_active_users_per_month3);
$monthly_users3 = mysqli_num_rows($result_per_month3);

$result_per_month4 = mysqli_query($database, $sql_active_users_per_month4);
$monthly_users4 = mysqli_num_rows($result_per_month4);

$month_array = [
    'Since ' . $last_4_MonthString,
    'Since ' . $last_3_MonthString,
    'Since ' . $last_2_MonthString,
    'Since ' . $lastMonthString,
];
$monthly_users_array = [
    $monthly_users4,
    $monthly_users3,
    $monthly_users2,
    $monthly_users1
];

$sql_monthly_sales1 = "SELECT SUM(r.points_required) AS total_sales
                      FROM rewards r 
                      RIGHT JOIN reward_redemption rr
                      ON r.rewards_id = rr.rewards_id
                      WHERE date_redeemed > '$lastMonthString'";

$sql_monthly_sales2 = "SELECT SUM(r.points_required) AS total_sales
                      FROM rewards r 
                      RIGHT JOIN reward_redemption rr
                      ON r.rewards_id = rr.rewards_id
                      WHERE date_redeemed > '$last_2_MonthString' AND date_redeemed <= '$lastMonthString'";

$sql_monthly_sales3 = "SELECT SUM(r.points_required) AS total_sales
                      FROM rewards r 
                      RIGHT JOIN reward_redemption rr
                      ON r.rewards_id = rr.rewards_id
                      WHERE date_redeemed > '$last_3_MonthString' AND date_redeemed <= '$last_2_MonthString'";

$sql_monthly_sales4 = "SELECT SUM(r.points_required) AS total_sales
                      FROM rewards r 
                      RIGHT JOIN reward_redemption rr
                      ON r.rewards_id = rr.rewards_id
                      WHERE date_redeemed > '$last_4_MonthString' AND date_redeemed <= '$last_3_MonthString'";

$sales_per_month1 = mysqli_query($database, $sql_monthly_sales1);
$monthly_sales1 = mysqli_num_rows($sales_per_month1);

$sales_per_month2 = mysqli_query($database, $sql_monthly_sales2);
$monthly_sales2 = mysqli_num_rows($sales_per_month2);

$sales_per_month3 = mysqli_query($database, $sql_monthly_sales3);
$monthly_sales3 = mysqli_num_rows($sales_per_month3);

$sales_per_month4 = mysqli_query($database, $sql_monthly_sales4);
$monthly_sales4 = mysqli_num_rows($sales_per_month4);

$monthly_sales_array = [
    $monthly_sales4,
    $monthly_sales3,
    $monthly_sales2,
    $monthly_sales1
];

$sql_challenge_data1 = "SELECT challenge_name,
                        SUM(c.points_reward) AS total_points_per_challenge,
                        COUNT(participants_challenges_id) AS challenge_count
                         FROM participants_challenges pc
                         LEFT JOIN challenges c ON pc.challenges_id = c.challenges_id
                         GROUP BY challenge_name
                         ORDER BY challenge_count DESC";
$result_challenges = mysqli_query($database, $sql_challenge_data1);
while ($row = mysqli_fetch_assoc($result_challenges)) {
    $best_challenge[] = [$row['challenge_count'], $row['challenge_name']];
    $total_points_challenge[] = $row['total_points_per_challenge'];
}
$stat_name = $best_challenge[0];
$stat_challenge = $stat_name[1];
$stat_value = $stat_name[0];


$total_system_points = 0;
$total_system_points_last_month = 0;

$sql_challenge_data2 = "SELECT c.challenges_id,
                        SUM(c.points_reward) AS total_points_per_challenge
                         FROM participants_challenges pc
                         LEFT JOIN challenges c ON pc.challenges_id = c.challenges_id
                         WHERE date_accomplished < '$lastMonthString'
                         GROUP BY challenges_id 
                         ORDER BY total_points_per_challenge DESC";

$result_points = mysqli_query($database, $sql_challenge_data2);
while ($row = mysqli_fetch_assoc($result_points)) {
    $total_points_challenge_last_month[] = $row['total_points_per_challenge'];

}

foreach ($total_points_challenge as $challenge_points) {
    $total_system_points += $challenge_points;

}
foreach ($total_points_challenge_last_month as $challenge_points) {
    $total_system_points_last_month += $challenge_points;

}

if ($total_system_points_last_month == 0) {
    $points_percentage_diff = ($total_system_points == 0) ? 0 : 100; 
} else {
    $points_percentage_diff = (($total_system_points - $total_system_points_last_month) / $total_system_points_last_month) * 100;
}
if ($points_percentage_diff >= 0) {
    $points_percentage_change = 'positive';
} else {
    $points_percentage_change = 'negative';
}


$sql_event_distribution = "SELECT event_name,
                            COUNT(attendance_id) AS event_attendees
                            FROM attendance a
                            LEFT JOIN events e ON a.events_id = e.events_id
                            GROUP BY event_name 
                            ORDER BY event_attendees DESC";
$result_event_distribution = mysqli_query($database, $sql_event_distribution);
while ($row = mysqli_fetch_assoc($result_event_distribution)) {
    $best_events[] = [$row['event_name'], $row['event_attendees']];
}
foreach ($best_events as $event) {
    $event_label[] = $event[0];
    $event_data[] = $event[1];

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Analytics</title>
    <link rel="stylesheet" href="../../global.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/admin-system-analytics.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>
    <div class="top-bar">
        <img src="../../images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='Admin_home.php'">
            <h2>EcoXP</h2>
        </button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='Admin_profile.php'"><i data-lucide="user"></i></button>

        </div>
    </div>

    <div class="side-bar">
        <div class="admin-icon-container">
            <button class="icon-btn" onclick="window.location.href='Admin_home.php'"><i data-lucide="home"></i></button>
            <div id="system-analytics-icon-box">
                <button class="icon-btn" onclick="window.location.href='Admin_system_analytics.php'"><i data-lucide="bar-chart-3"></i></button>
            </div>
            <button class="icon-btn" onclick="window.location.href='Admin_sustainability_report.php'"><i data-lucide="file-text"></i></button>
            <button class="icon-btn" onclick="window.location.href='Admin_system_config.php'"><i data-lucide="sliders"></i></button>
            <button class="icon-btn" id="logout" onclick="logout_confirm()"><i data-lucide="log-out"></i></button>
        </div>
    </div>

    <div class="main-content">
        <div class="page-header">
            <div class="title-box">
                <h1>System Analytics</h1>
            </div>
        </div>

        <div class="analytics-grid">
            <div class="analytics-card">
                <h3 class="card-title">Today's Users</h3>
                <div class="card-content">
                    <div class="stat-value">
                        <?php echo $todays_users;
                        if ($percentage_change == 'positive') {
                            echo '<span class="stat-change positive">+' . round($percentage_diff, 1) . '%</span>';
                        } else {
                            echo '<span class="stat-change negative">' . round($percentage_diff, 1) . '%</span>';
                        }
                        ?>

                    </div>
                </div>


            </div>


            <div class="analytics-card">
                <h3 class="card-title">Popular Challenges</h3>
                <div class="card-content">
                    <div class="stat-value">
                        <?php echo $stat_challenge ?>
                        <br>
                        <div class="small-stat-value">
                            <?php echo $stat_value ?> times

                        </div>



                    </div>
                </div>
            </div>

            <div class="analytics-card">
                <h3 class="card-title">Activity Distribution</h3>
                <div class="card-content">
                    <canvas id="pieChart1" width="200" height="200"></canvas>
                </div>
            </div>

            <div class="analytics-card">
                <h3 class="card-title">Green Points Awarded</h3>
                <div class="card-content">
                    <div class="stat-value">
                        <?php echo number_format($total_system_points);
                        if ($points_percentage_change == 'positive') {
                            echo '<span class="stat-change positive">+' . round($points_percentage_diff, 1) . '%</span>';
                        } else {
                            echo '<span class="stat-change negative">' . round($points_percentage_diff, 1) . '%</span>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="large-analytics-card">
                <h3 class="card-title">Active Users per Month</h3>
                <div class="card-content">
                    <canvas id="performanceChart1" width="400" height="400"></canvas>
                </div>
            </div>
            <div class="large-analytics-card-2">
                <h3 class="card-title">Monthly Sales</h3>
                <p>*Sales are based on redeemed rewards</p>
                <div class="card-content">
                    <canvas id="performanceChart2" width="400" height="400"></canvas>
                </div>
            </div>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script>
        lucide.createIcons();

        function logout_confirm() {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = "../../logout.php";
            }
        }

        const Ctx = document.getElementById('pieChart1');
        const lineCtx = document.getElementById('performanceChart1');
        const barCtx = document.getElementById('performanceChart2');
        const labels = <?= json_encode($event_label) ?>;
        const data = <?= json_encode($event_data) ?>;
        const month_data = <?= json_encode($month_array) ?>;
        const user_amount_data = <?= json_encode($monthly_users_array) ?>;
        const user_sales_data = <?= json_encode($monthly_sales_array) ?>;

        new Chart(Ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: '',
                    data: data,
                    backgroundColor: [
                        '#4CAF50', // green
                        '#2196F3', // blue
                        '#FFC107', // amber
                        '#FF5722', // orange
                        '#9C27B0'  // purple
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            }
        });
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: month_data,
                datasets: [{
                    label: 'Active Users (Monthly)',
                    data: user_amount_data,
                    borderColor: '#4CAF50',
                    backgroundColor: 'rgba(76, 175, 80, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#4CAF50',
                    pointRadius: 4
                }]
            }
        });
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: month_data,
                datasets: [{
                    label: 'Sales Amount (Monthly)',
                    data: user_sales_data,
                    backgroundColor: '#2196F3',
                    borderColor: '#1976D2',
                    borderWidth: 1,
                    borderRadius: 4,
                    hoverBackgroundColor: '#42A5F5'

                }]
            }
        });
    </script>
</body>

</html>