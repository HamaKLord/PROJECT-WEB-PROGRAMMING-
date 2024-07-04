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
           
        <a href="teacher_dashboard.php">Home</a>
            <a href="Teacher_Subject.php">Subjects</a>
            <a href="teachers.php">Teachers</a>
            <a href="classes.php">Classes</a>
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
        <h2>Add New Subject</h2>
        <form action="subjects.php" method="post">
            <label for="subject_id">Subject ID:</label>
            <input type="text" id="subject_id" name="subject_id" required>
            <br>
            <label for="subject_name">Subject Name:</label>
            <input type="text" id="subject_name" name="subject_name" required>
            <br>
            <button type="submit">Add Subject</button>
        </form>
    </main>
   
</body>
</html>
