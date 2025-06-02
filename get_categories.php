<?php
include 'db_connect.php';

$query = "SELECT DISTINCT category FROM food ORDER BY category";
$result = $conn->query($query);

$options = '<option value="" disabled selected>Select a category</option>';
while ($row = $result->fetch_assoc()) {
    $options .= '<option value="'.htmlspecialchars($row['category']).'">'.htmlspecialchars($row['category']).'</option>';
}

echo $options;
$conn->close();
?>