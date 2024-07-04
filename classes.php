<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['role'])) {
    header("Location: login.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_name = $_POST['class_name'];

    // Insert class into the classes table
    $sql = "INSERT INTO classes (class_name) VALUES ('$class_name')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Class added successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch classes from the database
$sql = "SELECT * FROM classes";
$result = $conn->query($sql);

$classes = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $classes[] = $row;
    }
} else {
    echo "No classes found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes - School Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Classes</h1>
        <nav>
        <a href="teacher_dashboard.php">Home</a>
            <a href="Teacher_Subject.php">Subjects</a>
            <a href="teachers.php">Teachers</a>
            <a href="classes.php">Classes</a>
           <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <h2>Class List</h2>
        <table>
            <thead>
                <tr>
                    <th>Class ID</th>
                    <th>Class Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($classes as $class): ?>
                <tr>
                    <td><?php echo $class['class_id']; ?></td>
                    <td><?php echo $class['class_name']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Add a New Class</h2>
        <form id="add-class-form" action="classes.php" method="post">
            <label for="class_name">Class Name:</label>
            <input type="text" id="class_name" name="class_name" required>
            <br>
            <button type="submit">Add Class</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 School Management System. All rights reserved.</p>
    </footer>
</body>
</html>
