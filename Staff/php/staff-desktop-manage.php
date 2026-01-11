<?php 
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../check-maintenance-status.php";

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'staff') {
    echo "<script>
        alert('Access denied. Staff only.');
        window.location.href = '../../login.php';
    </script>";
    exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <link rel="stylesheet" href="../../global.css">
    <link rel="stylesheet" href="../css/staff.css">
    <link rel="stylesheet" href="../css/staff-manage-desktop.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <div class="top-bar">
        <img src="../../images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='staff-desktop-home.php'"><h2>EcoXP</h2></button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='staff-desktop-profile.php'"><i data-lucide="user"></i></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="staff-icon-container">
            <button class="icon-btn" onclick="window.location.href='staff-desktop-home.php'"><i data-lucide="home"></i></button>
            <button class="icon-btn" onclick="window.location.href='staff-desktop-verification.php'"><i data-lucide="shield-check"></i></button>
            <div id="account-icon">
                <button class="icon-btn" onclick="window.location.href='staff-desktop-account.php'"><i data-lucide="users"></i></button>
            </div>
            <button class="icon-btn" id="logout" onclick="return logout_confirm();"><i data-lucide="log-out"></i></button>
        </div>
    </div>

    <div class="main-content">
        <div class="text-box">
            Add New Account
        </div>

        <div class="create-user-container">
            <h3>Create New User Form</h3>
            <form action="process_add_user.php" method="POST">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="full_name" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter password" required>
                </div>
                <div class="form-group">
                    <label>Assign Role</label>
                    <select name="role" id="roleSelect" onchange="updateUI()">
                        <option value="Participants">Participants</option>
                        <option value="Staff">Staff</option>
                        <option value="EventManager">Event Manager</option>
                    </select>
                </div>

                <div class="form-group" id="tpGroup">
                    <label>TP Number (Student ID, etc TP01234)</label>
                    <input type="text" name="tp_no" placeholder="Enter TP number" maxlength="7">
                </div>

                <div class="button-wrapper">
                    <button type="submit" class="add-btn">Add</button>
                </div>
            </form>
        </div>

        <hr style="margin: 50px 0; border: 0; border-top: 1px solid #eee;">

        <div class="list-section">
            <h3 id="tableTitle" style="color: var(--primary-green); margin-bottom: 20px;">Existing Participants</h3>
            <div id="userTableContainer">
                </div>
        </div>
    </div>

    <script>
    // Initialize Lucide Icons
    lucide.createIcons();

    function logout_confirm() {
                if (confirm("Are you sure you want to logout?")) {
                    window.location.href = "../../logout.php";
                }
            }

    function updateUI() {
        const role = document.getElementById("roleSelect").value;
        const tpGroup = document.getElementById("tpGroup");
        const tableTitle = document.getElementById("tableTitle");

        tpGroup.style.display = (role === "Participants") ? "block" : "none";
        
        tableTitle.innerText = "Existing " + role + " List";

        fetchUserList(role);
    }

    function fetchUserList(role) {
        const container = document.getElementById("userTableContainer");
        
        fetch('fetch_users.php?role=' + role)
            .then(response => response.text())
            .then(data => {
                container.innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    window.onload = updateUI;
    </script>
</body>
</html>