<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['role'])) {
    header("Location: login.html");
    exit;
}

$sql = "SELECT * FROM students";
$result = $conn->query($sql);

$students = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
} else {
    echo "No students found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - School Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Students</h1>
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
        <h2>Student List</h2>
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Stage</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo $student['student_id']; ?></td>
                    <td><?php echo $student['student_name']; ?></td>
                    <td><?php echo $student['student_stage']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; 2024 School Management System. All rights reserved.</p>
    </footer>
</body>
</html>
