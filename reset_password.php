<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Update the user's password
    $sql = "UPDATE users SET password = '$new_password' WHERE id = '$user_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Password reset successfully. Please log in with your new password.');
                window.location.href = 'login.html';
              </script>";
    } else {
        echo "Error updating password: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - School Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Reset Password</h1>
        <nav>
            <a href="login.html">Login</a>
            <a href="register.html">Register</a>
        </nav>
    </header>
    <main>
        <h2>Enter Your New Password</h2>
        <form id="reset-password-form" action="reset_password.php" method="post">
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>
            <br>
            <button type="submit">Reset Password</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 School Management System. All rights reserved.</p>
    </footer>
</body>
</html>
