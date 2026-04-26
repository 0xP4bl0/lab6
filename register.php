<?php
include('db/db.php'); // connection sa database

if (isset($_POST['register'])) {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $uname = $_POST['username'];
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];
    $type = $_POST['user_type'];

    // matching ng password at confirm password
    if ($pass !== $confirm_pass) {
        echo "<script>alert('Password inputs do not match.');</script>"; 
    } 
    // checker ng password strength
    elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/', $pass)) {
        echo "<script>alert('Password must contain letters and numbers and must be 8-20 characters long.');</script>";
    } 
    else {
        $encrypted_pass = md5($pass);
        $sql = "INSERT INTO users (first_name, last_name, username, password, user_type) 
                VALUES ('$fname', '$lname', '$uname', '$encrypted_pass', '$type')";
        
        if (mysqli_query($conn, $sql)) {
            // ✅ redirect with account number
            header("Location: login.php?acc_num=" . $uname);
            exit();
        }
    }
}
?>

<head>
    <link rel="stylesheet" href="css/s.css">
    <title>Register</title>
</head>
<body class="register-wrapper">
    <div class="register-card">
        <h2>Create an Account!</h2>
        
        <form method="POST">
            <div class="input-row">
                <input type="text" name="first_name" placeholder="First Name" required>
                <input type="text" name="last_name" placeholder="Last Name" required>
            </div>
            
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            
            <label style="font-size: 0.8rem; color: #666; margin-bottom: 5px; display: block;">User Type</label>
            <select name="user_type">
                <option value="Employee">Employee</option>
                <option value="Admin">Admin</option>
            </select>
            
            <button type="submit" name="register" class="btn-register">Register Account</button>
        </form>
        
        <a href="login.php" class="login-link">Already have an account? Login!</a>
    </div>
</body>
</html>