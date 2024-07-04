<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['role'])) {
    header("Location: login.html");
    exit;
}

// Handle form submission for adding new subjects
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject_id = $_POST['subject_id'];
    $subject_name = $_POST['subject_name'];

    // Insert new subject into the subjects table
    $sql = "INSERT INTO subjects (subject_id, subject_name) VALUES ('$subject_id', '$subject_name')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New subject added successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieve all subjects from the subjects table
$sql = "SELECT * FROM subjects";
$result = $conn->query($sql);

$subjects = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $subjects[] = $row;
    }
} else {
    echo "No subjects found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects - School Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Subjects</h1>
        <nav>
            <a href="student_dashboard.php">Home</a>
            <a href="students.php">Students</a>
            <a href="subjects.php">Subjects</a>
            <a href="enroll_course.php">Enroll in Course</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <h2>Subject List</h2>
        <table>
            <thead>
                <tr>
                    <th>Subject ID</th>
                    <th>Subject Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subjects as $subject): ?>
                <tr>
                    <td><?php echo $subject['subject_id']; ?></td>
                    <td><?php echo $subject['subject_name']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
   
</body>
</html>
