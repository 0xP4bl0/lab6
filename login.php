<?php
session_start();
include('db/db.php'); // connection sa database

// ✅ get username from URL then fetch account_number
$prefill_acc = '';

if (isset($_GET['acc_num'])) {
    $username = $_GET['acc_num'];

    $account_n = mysqli_query($conn, "SELECT account_number FROM users WHERE username='$username'");
    
    if ($account_n && mysqli_num_rows($account_n) > 0) {
        $acc_n = mysqli_fetch_assoc($account_n);
        $prefill_acc = $acc_n['account_number'];
    }
}

if (isset($_POST['login'])) {
    $acc_num = $_POST['account_number'];
    $pass = md5($_POST['password']);

    // ✅ FIX: use account_number (NOT username)
    $result = mysqli_query($conn, "SELECT * FROM users WHERE account_number='$acc_num'");
    $user = mysqli_fetch_assoc($result);

    // checker ng account number at password
    if (!$user) {
        echo "<script>alert('Invalid account number');</script>"; 
    } elseif ($user['password'] !== $pass) {
        echo "<script>alert('Wrong password');</script>";
    } else {
        $_SESSION['user'] = $user;
        header("Location: dashb/index.php");
        exit();
    }
}
?>

<head>
    <link rel="stylesheet" href="css/s.css">
    <title>Login</title>
</head>

<body class="register-wrapper">
    <div class="register-card">
        <form method="post">
            <h2>Welcome Back!</h2>

            <input type="number" name="account_number" placeholder="Account Number" 
                   value="<?php echo htmlspecialchars($prefill_acc); ?>" required>

            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" name="login" class="btn-register">Log In</button>

            <p class="login-link">
                <a href="register.php">Create an Account?</a>
            </p>
        </form>
    </div>
</body>
</html>