<?php
session_start();
include('../db/db.php');

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

if ($user['user_type'] !== 'Admin') {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users Table</title>
    <link rel="stylesheet" href="../css/s.css">
</head>
<body class="dashboard-wrapper">

    <div class="sidebar">
        <div class="sidebar-header">ADMIN DASHBOARD</div>
        <div class="sidebar-menu">
            <a href="index.php">Dashboard</a>

            <?php if($user['user_type'] == 'Admin'): ?>
                <a href="users_table.php">Manage Users</a>
            <?php endif; ?>

            <a href="../logout.php">Logout</a>
        </div>
    </div>

    <div class="main-content">
        <div class="dashboard-header">
            <h1>Registered Accounts</h1>
        </div>

        <div class="container">

            <div class="table-card">
                <table>
                    <tr>
                        <th>Acc #</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Password (MD5)</th>
                    </tr>

                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM users");

                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<tr>
                                <td>{$row['account_number']}</td>
                                <td>{$row['first_name']}</td>
                                <td>{$row['last_name']}</td>
                                <td>{$row['username']}</td>
                                <td style='font-family: monospace; font-size: 0.8em;'>{$row['password']}</td>
                              </tr>";
                    }
                    ?>
                </table>
            </div>

        </div>
    </div>

</body>
</html>