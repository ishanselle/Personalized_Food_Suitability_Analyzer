<?php
$host = "localhost";  // Change if needed
$user = "root";       // Change your database username
$pass = "ishan@2001";           // Change your database password
$dbname = "pfsa"; // Change to your actual database name

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
