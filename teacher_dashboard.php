<?php
session_start();
if ($_SESSION['role'] != 'teacher') {
    header("Location: login.html");
    exit;
}

include 'config.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM teachers WHERE user_id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $teacher = $result->fetch_assoc();
} else {
    echo "No teacher information found.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - School Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['full_name']; ?></h1>
        <nav>
        <a href="teacher_dashboard.php">Home</a>
            <a href="Teacher_Subject.php">Subjects</a>
            <a href="teachers.php">Teachers</a>
            <a href="classes.php">Classes</a>
           <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <h2>Teacher Dashboard</h2>
        <h3>Your Information</h3>
        <table>
            <tr>
                <th>Your Teaching ID</th>
                <td><?php echo $teacher['teacher_id']; ?></td>
            </tr>
            <tr>
                <th>Your Name</th>
                <td><?php echo $teacher['teacher_name']; ?></td>
            </tr>
        </table>
    </main>
    <footer>
        <p>&copy; 2024 School Management System. All rights reserved.</p>
    </footer>
</body>
</html>
