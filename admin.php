<?php
session_start();
include 'config.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.html");
    exit;
}

// Handle form submission to add a new admin
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];

    // Check if username or email already exists
    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<script>
                alert('Username or Email already exists.');
                window.location.href = 'admin.php';
              </script>";
    } else {
        // Insert user into the users table
        $sql = "INSERT INTO users (full_name, username, password, email, gender, birthday, address, city, state, country, role) 
                VALUES ('$full_name', '$username', '$password', '$email', '$gender', '$birthday', '$address', '$city', '$state', '$country', 'admin')";

        if ($conn->query($sql) === TRUE) {
            $user_id = $conn->insert_id;

            // Insert into the admin table
            $sql = "INSERT INTO admin (user_id, admin_name) VALUES ('$user_id', '$full_name')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>
                        alert('Admin added successfully.');
                        window.location.href = 'admin.php';
                      </script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Fetch admin users from the database
$sql = "SELECT * FROM admin INNER JOIN users ON admin.user_id = users.id";
$result = $conn->query($sql);

$admins = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $admins[] = $row;
    }
} else {
    echo "No admin users found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management - School Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Admin Management</h1>
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
        <h2>Admin List</h2>
        <table>
            <thead>
                <tr>
                    <th>Admin ID</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($admins as $admin): ?>
                <tr>
                    <td><?php echo $admin['admin_id']; ?></td>
                    <td><?php echo $admin['admin_name']; ?></td>
                    <td><?php echo $admin['username']; ?></td>
                    <td><?php echo $admin['email']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Add a New Admin</h2>
        <form id="add-admin-form" action="admin.php" method="post">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required>
            <br>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <br>
            <label for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday" required>
            <br>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address">
            <br>
            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>
            <br>
            <label for="state">State:</label>
            <input type="text" id="state" name="state" required>
            <br>
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" required>
            <br>
            <button type="submit">Add Admin</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 School Management System. All rights reserved.</p>
    </footer>
</body>
</html>
