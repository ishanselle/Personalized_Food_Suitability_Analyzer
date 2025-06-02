<?php
$servername = "localhost";
$username = "root";
$password = "ishan@2001";
$dbname = "pfsa"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
