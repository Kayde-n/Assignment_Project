<?php
    include("session.php");
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
            <button class="back-btn">←</button>
            <h1>Account Registration</h1>
        </header>
        
        <!-- Main Content -->
        <main class="main-content">
            <div class="form-header">
                <button class="add-account-btn">
                    <span class="icon">+</span>
                    <span class="text">Add New Account</span>
                </button>
            </div>
            
            <div class="form-container">
                <h2>Create New User Form</h2>
                
                <form class="user-form" method="post" action="">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter name">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter email">
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter password">
                    </div>
                    
                    <div class="form-group">
                        <label for="assign-role">Assign Role</label>
                        <select id="assign-role" name="assign-role">
                            <option value="">Select role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="submit-btn">Add</button>
                </form>
            </div>
        </main>
        
        <!-- Bottom Navigation -->
        <nav class="bottom-nav">
            <button class="nav-btn">
                <span class="icon">🏠</span>
            </button>
            <button class="nav-btn">
                <span class="icon">⚙️</span>
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
