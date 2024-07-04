<?php
session_start();
include 'config.php';

// Check if the user is logged in and is a teacher or admin
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'teacher' && $_SESSION['role'] != 'admin')) {
    header("Location: login.html");
    exit;
}

$sql = "SELECT * FROM teachers";
$result = $conn->query($sql);

$teachers = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $teachers[] = $row;
    }
} else {
    echo "No teachers found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers - School Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Teachers</h1>
        <nav>
        <a href="teacher_dashboard.php">Home</a>
            <a href="Teacher_Subject.php">Subjects</a>
            <a href="teachers.php">Teachers</a>
            <a href="classes.php">Classes</a>
           <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <h2>Teachers List</h2>
        <table>
            <thead>
                <tr>
                    <th>Teacher ID</th>
                    <th>Teacher Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($teachers as $teacher): ?>
                <tr>
                    <td><?php echo $teacher['teacher_id']; ?></td>
                    <td><?php echo $teacher['teacher_name']; ?></td>
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
