<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = "ishan@2001"; // Change this to your database password
$dbname = "pfsa"; // Change this to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords match
    if ($password !== $confirm_password) {
        die("Error: Passwords do not match.");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Check if username or email already exists
    $check_user = $conn->prepare("SELECT ID FROM admin WHERE Username = ? OR Email = ?");
    $check_user->bind_param("ss", $username, $email);
    $check_user->execute();
    $check_user->store_result();

    if ($check_user->num_rows > 0) {
        die("Error: Username or Email already exists.");
    }
    $check_user->close();

    // Prepare and bind SQL query
    $stmt = $conn->prepare("INSERT INTO admin (Full_Name, Email, Username, Password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $full_name, $email, $username, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Admin registered successfully!";
        header("Location: Admin_Home.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>
