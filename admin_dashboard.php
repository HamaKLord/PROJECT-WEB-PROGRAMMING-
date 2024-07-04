<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - School Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['full_name']; ?></h1>
        <nav>
            <a href="admin_dashboard.php">Home</a>
            <a href="admin.php">Admins</a>
            <a href="studentsAdmin.php">Students</a>
            <a href="subjectsAdmin.php">Subjects</a>
            <a href="teachersAdmin.php">Teachers</a>
            <a href="classesAdmin.php">Classes</a>
            <a href="enrollAdmin.php">Enroll</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <h2>Admin Dashboard</h2>
        <!-- Add content for admins here -->
    </main>
    <footer>
        <p>&copy; 2024 School Management System. All rights reserved.</p>
    </footer>
</body>
</html>
