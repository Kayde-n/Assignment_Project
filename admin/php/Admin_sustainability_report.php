<?php
    require_once __DIR__ . "/../../session.php";
    require_once __DIR__ . "/../../config/database.php";

    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    echo "<script>
        alert('Access denied. Admin only.');
        window.location.href = '../../login.php';
    </script>";
    exit();
    }

//Latest month as default
$sql_latest = "SELECT DATE_FORMAT
        (MAX(date_accomplished), '%Y-%m') AS latest_month
        FROM participants_challenges";
$latest = mysqli_fetch_assoc(mysqli_query($database, $sql_latest));
$monthYear = $_GET['month_year'] ?? $latest['latest_month'];
[$year, $month] = explode('-', $monthYear);

//get the avaiable months
$sql_months = "SELECT DISTINCT 
            DATE_FORMAT(date_accomplished, '%Y-%m') AS ym,
            DATE_FORMAT(date_accomplished, '%M %Y') AS label
            FROM participants_challenges
            ORDER BY ym DESC";
$result_months = mysqli_query($database, $sql_months);

//Enviromental Impacts by month
$sql = "SELECT 
            SUM(CASE WHEN LOWER(impact_type) LIKE '%air pollution%' THEN impact_amount ELSE 0 END) AS air_pollution,
            SUM(CASE WHEN LOWER(impact_type) LIKE '%carbon emmision%' THEN impact_amount ELSE 0 END) AS carbon_emission,
            SUM(CASE WHEN LOWER(impact_type) LIKE '%recycling%' THEN impact_amount ELSE 0 END) AS item_recycled,
            SUM(CASE WHEN LOWER(impact_type) LIKE '%water pollution%' THEN impact_amount ELSE 0 END) AS water_conserved
            FROM participants_challenges
            WHERE DATE_FORMAT(date_accomplished, '%Y-%m') = '$monthYear'";


//green points by month + approved 
$sql_points = "SELECT 
            SUM(c.points_reward) AS total_points
            FROM participants_challenges pc
            JOIN challenges c ON pc.challenges_id = c.challenges_id 
            WHERE pc.challenges_status = 'approved' AND DATE_FORMAT(pc.date_accomplished, '%Y-%m') = '$monthYear'";

$result_points = mysqli_query($database, $sql_points);
$data_points = mysqli_fetch_assoc($result_points);
$green_points = $data_points['total_points'] ?? 0;

//fetch results
$data = mysqli_fetch_assoc(mysqli_query($database, $sql));

$air_pollution = $data['air_pollution'] ?? 0;
$carbon_emission = $data['carbon_emission'] ?? 0;
$item_recycled = $data['item_recycled'] ?? 0;
$water_conserved = $data['water_conserved'] ?? 0;


//participation percentage (active vs total)
$sql_users = "SELECT 
            COUNT(DISTINCT u.user_id) AS total_users,
            COUNT(DISTINCT CASE WHEN u.account_status = 'active' THEN u.user_id END) AS active_users
            FROM user u
            JOIN participants_challenges pc ON u.user_id = pc.participants_id
            WHERE MONTH(pc.date_accomplished) = $month AND YEAR(pc.date_accomplished) = $year";
$data_users = mysqli_fetch_assoc(mysqli_query($database, $sql_users));

$total_users = $data_users['total_users'] ?? 0;
$active_users = $data_users['active_users'] ?? 0;
$active_percent = ($total_users > 0) ? round(($active_users / $total_users) * 100) : 0;

//count event by month
$sql_events = "SELECT COUNT(*) AS total_events
                FROM events
                WHERE YEAR(start_time) = $year
                AND MONTH(start_time) = $month";

$data_events = mysqli_fetch_assoc(mysqli_query($database, $sql_events));
$total_events = $data_events['total_events'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sustainability Report</title>
    <link rel="stylesheet" href="../../global.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/admin-sustainability-report.css">
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
            <button class="icon-btn" onclick="window.location.href='Admin_system_analytics.php'"><i data-lucide="bar-chart-3"></i></button>
            <div id="sustainability-report-icon-box">
                <button class="icon-btn" onclick="window.location.href='Admin_sustainability_report.php'"><i data-lucide="file-text"></i></button>
            </div>
            <button class="icon-btn" onclick="window.location.href='Admin_system_config.php'"><i data-lucide="sliders"></i></button>
            <button class="icon-btn" id="logout" onclick="logout_confirm()"><i data-lucide="log-out"></i></button>
        </div>
    </div>

    <div class="main-content">
        <div class="page-header">
            <div class="title-box">
                <h1>Sustainability Report</h1>
            </div>

            <div class="date-selector">
                <label for="month-year">
                    <i data-lucide="calendar"></i>
                </label>
                <form method="GET">
                    <select id="month-year" name="month_year" onchange="this.form.submit()">
                        <?php while ($row = mysqli_fetch_assoc($result_months)): ?>
                            <option value="<?= $row['ym']; ?>" <?= ($monthYear === $row['ym']) ? 'selected' : ''; ?>>
                                <?= $row['label']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </form>
            </div>
        </div>

        <section class="executive-summary">
            <h2>Executive Summary</h2>
            <p>
                This month showed exceptional growth in sustainability initiatives, with community engagement increasing
                by significant environmental impact, though challenges in waste reduction remain a priority moving
                forward.
            </p>
        </section>

        <section class="environmental-impact">
            <h2>Environmental Impact</h2>
            <div class="impact-grid">
                <div class="impact-card">
                    <div class="impact-value"><?= number_format($air_pollution); ?> kg </div>
                    <div class="impact-label">Reduced Air Pollution</div>
                </div>
                <div class="impact-card">
                    <div class="impact-value"><?= number_format($carbon_emission); ?> kg </div>
                    <div class="impact-label">Reduced Carbon Emission</div>
                </div>
                <div class="impact-card">
                    <div class="impact-value"><?= number_format($item_recycled); ?>kg</div>
                    <div class="impact-label">Total Garbage Recycled</div>
                </div>
                <div class="impact-card">
                    <div class="impact-value"><?= number_format($water_conserved); ?>&ell;</div>
                    <div class="impact-label">Reduced Water Pollution</div>
                </div>
            </div>
        </section>

        <section class="participation-stats">
            <h2>Participation Statistics</h2>
            <div class="stat-item">
                <div class="stat-info">
                    <span class="stat-label">Active Users</span>
                    <span class="stat-badge positive">
                        <?php echo $active_users; ?> (<?php echo $active_percent; ?>%)
                    </span>
                </div>
                <div class="stat-bar">
                    <div class="stat-fill" style="width: <?php echo $active_percent; ?>%;"></div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-info">
                    <span class="stat-label">Green Points Awarded</span>
                    <span class="stat-badge positive">
                        <?php echo number_format($green_points); ?>
                    </span>
                </div>
                <div class="stat-bar">
                    <?php
                    $max_points = 10000;
                    $points_percent = ($green_points > 0) ? min(100, round(num: ($green_points / $max_points) * 100)) : 0; // min val to not make it exceed over 100
                    ?>
                    <div class="stat-fill" style="width: <?php echo $points_percent; ?>%;"></div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-info">
                    <span class="stat-label">Events Held</span>
                    <span class="stat-badge">
                        <?php echo $total_events; ?>
                    </span>
                </div>
                <div class="stat-bar">
                    <div class="stat-fill" style="width: 60%;"></div>
                </div>
            </div>
        </section>
    </div>

    <script>
        lucide.createIcons();

        function logout_confirm() {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = "../../logout.php";
            }
        }
    </script>
</body>

</html>