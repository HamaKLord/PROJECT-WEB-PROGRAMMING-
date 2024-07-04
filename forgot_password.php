<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $email = $_POST['email'];

    // Verify the user's identity
    $sql = "SELECT * FROM users WHERE id = '$user_id' AND email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, set session and redirect to reset password page
        $_SESSION['user_id'] = $user_id;
        header("Location: reset_password.php");
        exit;
    } else {
        echo "<script>alert('Invalid User ID or Email');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - School Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Forgot Password</h1>
        <nav>
            <a href="login.html">Login</a>
            <a href="register.html">Register</a>
        </nav>
    </header>
    <main>
        <h2>Reset Your Password</h2>
        <form id="forgot-password-form" action="forgot_password.php" method="post">
            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <button type="submit">Submit</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 School Management System. All rights reserved.</p>
    </footer>
</body>
</html>
