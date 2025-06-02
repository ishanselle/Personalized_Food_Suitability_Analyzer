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
    $food_name = $_POST['food_name'];
    $category = $_POST['category'];
    $brand_name = $_POST['brand_name'];
    $calories = $_POST['calories'];
    $fats = $_POST['fats'];
    $saturated_fats = $_POST['saturated_fats'];
    $trans_fats = $_POST['trans_fats'];
    $sugar = $_POST['sugar'];
    $sodium = $_POST['sodium'];
    $protein = $_POST['protein'];
    $fiber = $_POST['fiber'];
    $carbohydrates = $_POST['carbohydrates'];
    $ingredients = $_POST['ingredients'];
    $allergens = $_POST['allergens'];
    $additives = $_POST['additives'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO food (food_name, category, brand_name, calories, fats, saturated_fats, trans_fats, sugar, sodium, protein, fiber, carbohydrates, ingredients, allergens, additives) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssssss", $food_name, $category, $brand_name, $calories, $fats, $saturated_fats, $trans_fats, $sugar, $sodium, $protein, $fiber, $carbohydrates, $ingredients, $allergens, $additives);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New food item added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>
