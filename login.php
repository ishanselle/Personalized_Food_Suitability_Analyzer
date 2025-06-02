<?php
session_start();
require 'config.php'; // Database connection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT UserID, Full_Name, Password FROM user WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userID, $fullname, $hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Store full name in session
            $_SESSION['userID'] = $userID;
            $_SESSION['fullname'] = $fullname;

            echo "<script>
                    alert('Login successful!');
                    window.location.href = 'User_Interface.php';
                  </script>";
        } else {
            echo "<script>alert('Invalid password!'); window.location.href = 'login.html';</script>";
        }
    } else {
        echo "<script>alert('User not found!'); window.location.href = 'login.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
