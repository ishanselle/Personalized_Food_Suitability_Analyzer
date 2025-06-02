<?php
header('Content-Type: application/json');
// Database connection
$servername = "localhost";
$username = "root";
$password = "ishan@2001";
$dbname = "pfsa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die(json_encode(['error' => "Connection failed: " . $conn->connect_error]));
}

$foodId = $_GET['id'] ?? 0;

// SQL query to fetch all details of a specific food item
$sql = "SELECT * FROM food WHERE food_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $foodId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  // Sanitize all output
  foreach ($row as $key => $value) {
    $row[$key] = htmlspecialchars($value);
  }
  echo json_encode($row);
} else {
  echo json_encode(['error' => 'Food item not found']);
}

$stmt->close();
$conn->close();
?>