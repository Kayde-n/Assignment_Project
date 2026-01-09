<?php

    include("session.php");
    include("Database.php");

    // Get filter (default = all)
    $filter = $_GET['filter'] ?? 'all';
    $search = $_POST['search'] ?? '';
    $search = mysqli_real_escape_string($database, $search);

    $sql_all = "SELECT u.user_full_name, u.account_status, p.TP_no
                FROM participants p
                JOIN user u ON p.user_id = u.user_id";

    $sql_act = "SELECT u.user_full_name, u.account_status, p.TP_no
                FROM participants p
                JOIN user u ON p.user_id = u.user_id
                WHERE u.account_status = 'Active'";

    $sql_dea = "SELECT u.user_full_name, u.account_status, p.TP_no
                FROM participants p
                JOIN user u ON p.user_id = u.user_id
                WHERE u.account_status = 'Deactivated'";

    // differentiate users
    if ($filter === 'active') {
        $sql = $sql_act;
    } elseif ($filter === 'deactivated') {
        $sql = $sql_dea;
    } else {
        $sql = $sql_all;
    }

    if (!empty($search)) {
        if (strpos($sql, 'WHERE') !== false) {
            $sql .= " AND u.user_full_name LIKE '%$search%'";
        } else {
            $sql .= " WHERE u.user_full_name LIKE '%$search%'"; 
        }
    }

    $sql .= " ORDER BY u.user_full_name ASC"; //sort a-z

    $result = mysqli_query($database, $sql);

    $participants = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $participants[] = $row;
        }
    }

    $total_results = count($participants);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="mobile-container">
        <!-- Header -->
        <header class="header">
            <h1>Account Management</h1>
        </header>
        
        <!-- Main Content -->
        <main class="main-content">
            <div class="content-header">
                <h2>Participants Management</h2>
            </div>
            
            <!-- Search Bar -->
            <form method="POST" class="search-bar">
                <input type="text" name="search" placeholder="Search by Name" value="<?= htmlspecialchars($search); ?>">
                <button type="submit" class="search-btn">🔍</button>
            </form>

            
            <!-- Filter Tabs -->
            <div class="filter-tabs">

                <a href = "?filter=all" >
                    <button class="tab <?= ($filter === 'all') ? 'active': '' ?>">All</button>
                </a>
                <a href = "?filter=active" >
                    <button class="tab <?= ($filter === 'active') ? 'active': '' ?>">Active</button>
                </a>
                <a href = "?filter=deactivated" >
                    <button class="tab <?= ($filter === 'deactivated') ? 'active': '' ?>">deactivated</button>
                </a>

            </div>
            
            <!-- Results Count -->
            <div class="results-header">

                <span class="results-count">
                    <?= $total_results; ?> results
                </span>

                <button class="add-btn">➕</button>
            </div>
            
            <!-- Participants List -->
            <div class="participants-list">

                <?php if ($total_results > 0): ?>
                    <?php foreach ($participants as $p): ?>

                        <div class="participant-item">
                            <div class="user-icon">👤</div>

                            <div class="user-info">
                                <span class="name">
                                    <?= htmlspecialchars($p['user_full_name']); ?>
                                </span>
                                <span class="id">
                                    <?= htmlspecialchars($p['TP_no']); ?>
                                </span>
                            </div>

                            <span class="status <?= strtolower($p['account_status']); ?>">
                                <?= htmlspecialchars($p['account_status']); ?>
                            </span>
                        </div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No participants found.</p>
                <?php endif; ?>

            </div>
        </main>
        
        <!-- Bottom Navigation -->
        <nav class="bottom-nav">
            <button class="nav-btn">
                <span class="icon">🏠</span>
            </button>
            <button class="nav-btn">
                <span class="icon">🔍</span>
            </button>
            <button class="nav-btn">
                <span class="icon">📄</span>
            </button>
            <button class="nav-btn active">
                <span class="icon">👥</span>
            </button>
            <button class="nav-btn">
                <span class="icon">👤</span>
            </button>
        </nav>
    </div>
    
</body>
</html>
</body>
</html>