<?php
include 'db_connect.php';

if (isset($_POST['category'])) {
    $category = $conn->real_escape_string($_POST['category']);
    $query = "SELECT food_id, food_name FROM food WHERE category = ? ORDER BY food_name";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    $options = '<option value="" disabled selected>Select a food item</option>';
    while ($row = $result->fetch_assoc()) {
        $options .= '<option value="'.htmlspecialchars($row['food_id']).'">'.htmlspecialchars($row['food_name']).'</option>';
    }
    
    echo $options;
    $stmt->close();
}
$conn->close();
?>