<?php
// Start session
session_start();

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
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute query to fetch user details
    $stmt = $conn->prepare("SELECT ID, Full_Name, Password FROM admin WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $full_name, $hashed_password);
        $stmt->fetch();

        // Verify the hashed password
        if (password_verify($password, $hashed_password)) {
            // Set session variables
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_name'] = $full_name;

            // Redirect to dashboard or another page
            header("Location: Admin_Home.php");
            exit();
        } else {
            echo "Error: Incorrect password.";
        }
    } else {
        echo "Error: Username not found.";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
