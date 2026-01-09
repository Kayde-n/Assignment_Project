<?php 
require_once __DIR__ . "/../../config/database.php";
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
</head>
<body>
    <div class="top-bar">
        <img src="../../images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='staff-desktop-home.php'"><h2>EcoXP</h2></button>
        <div class="default-icon-container">
            <button class="icon-btn" onclick="window.location.href='staff-desktop-profile.php'"><img src="../../images/profile.png" alt="Profile"></button>
            <button class="icon-btn"><img src="../../images/notif.png" alt="Notification"></button>
            <button class="icon-btn"><img src="../../images/setting.png" alt="Setting"></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="staff-icon-container">
            <button class="icon-btn" onclick="window.location.href='staff-desktop-home.php'"><img src="../../images/home.png" alt="Home"></button>
            <button class="icon-btn" onclick="window.location.href='staff-desktop-verification.php'"><img src="../../images/verification.png" alt="Verification"></button>
            <div id="account-icon">
                <button class="icon-btn" onclick="window.location.href='staff-desktop-account.php'"><img src="../../images/account-management.png" alt="Account"></button>
            </div>
            <button class="icon-btn" id="logout"><img src="../../images/logout.png" alt="Logout"></button>
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
            <h3 id="tableTitle" style="color: #53B757; margin-bottom: 20px;">Existing Participants</h3>
            <div id="userTableContainer">
                </div>
        </div>
    </div>

    <script>
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