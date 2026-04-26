<?php
session_start();
include('../db/db.php');

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/s.css">
</head>
<body class="dashboard-wrapper">

    <div class="sidebar">
        <div class="sidebar-header">ADMIN DASHBOARD</div>
        <div class="sidebar-menu">
            <a href="#">Dashboard</a>

            <?php if($user['user_type'] == 'Admin'): ?>
                <a href="users_table.php">Manage Users</a>
            <?php endif; ?>

            <a href="../logout.php">Logout</a>
        </div>
    </div>

    <div class="main-content">
        <div class="dashboard-header">
            <h1>Dashboard</h1>
        </div>

        <div class="container">

            <div class="table-card">
                <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
            </div>

        </div>
    </div>

</body>
</html>