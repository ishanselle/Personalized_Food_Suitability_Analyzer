<?php
session_start();
include 'db_connect.php';

// Validate food item selection
if (!isset($_POST['Food_Item_Name']) || empty($_POST['Food_Item_Name'])) {
    header("Location: Health_Profile_Form.php?error=no_food_selected");
    exit();
}

// Get all user health data with proper defaults
$user_health_data = [
    'fullname' => $_POST['fullname'] ?? '',
    'age' => $_POST['Age'] ?? '',
    'gender' => $_POST['Gender'] ?? '',
    'weight' => $_POST['weight'] ?? '',
    'diabetes' => $_POST['diabetes'] ?? '',
    'cholesterol' => $_POST['cholesterol'] ?? '',
    'hypertension' => $_POST['hypertension'] ?? '',
    'heart_condition' => $_POST['heart_condition'] ?? '',
    'allergy_severity' => $_POST['allergy_severity'] ?? '',
    'sugarLevel' => $_POST['sugarLevel'] ?? '',
    'sodiumLevel' => $_POST['sodiumLevel'] ?? '',
    'fatsLevel' => $_POST['fatsLevel'] ?? ''
];

// Get selected food
$food_id = (int)$_POST['Food_Item_Name'];

// Fetch complete food details using food_id
$query = "SELECT * FROM food WHERE food_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $food_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: Health_Profile_Form.php?error=food_not_found");
    exit();
}

$food = $result->fetch_assoc();

// Convert string values to numbers for comparison
$food_sugar = (float)$food['sugar'];
$food_fats = (float)$food['fats'];
$food_saturated_fats = (float)$food['saturated_fats'];
$food_trans_fats = (float)$food['trans_fats'];
$food_sodium = (float)$food['sodium'];

// Health impact analysis
$suitability = 'Safe';
$warnings = [];
$suitability_percentage = 100;

// Diabetes check (using sugar)
if ($food_sugar > 100 && in_array($user_health_data['diabetes'], ['Diabetic', 'Above 250 mg/dL'])) {
    $suitability = 'Avoid';
    $suitability_percentage -= 40;
    $warnings[] = "High sugar content (" . $food['sugar'] . "g) not suitable for diabetics";
}

// Cholesterol check (using saturated and trans fats)
$total_bad_fats = $food_saturated_fats + $food_trans_fats;
if ($total_bad_fats > 5 && $user_health_data['cholesterol'] == 'High Cholesterol') {
    $suitability = ($suitability === 'Avoid') ? 'Avoid' : 'Moderate';
    $suitability_percentage -= 30;
    $warnings[] = "High unhealthy fats (" . $total_bad_fats . "g) not recommended for your cholesterol";
}

// Hypertension check (using sodium)
if ($food_sodium > 500 && $user_health_data['hypertension'] == 'Stage 2 Hypertension') {
    $suitability = ($suitability === 'Avoid') ? 'Avoid' : 'Moderate';
    $suitability_percentage -= 25;
    $warnings[] = "High sodium content (" . $food['sodium'] . "mg) may affect blood pressure";
}

// Allergy check
if ($user_health_data['allergy_severity'] != 'None' && 
    !empty($food['allergens']) && 
    stripos($user_health_data['allergy_severity'], 'Allergies') !== false) {
    $suitability = 'Avoid';
    $suitability_percentage = 0;
    $warnings[] = "Contains allergens: " . $food['allergens'];
}

// Ensure percentage doesn't go below 0
$suitability_percentage = max($suitability_percentage, 0);

// Get similar food recommendations (healthier alternatives)
$category = $food['category'];
$query = "SELECT food_id, food_name, calories, fats, sugar, sodium 
          FROM food 
          WHERE category = ? AND food_id != ?
          ORDER BY 
            CASE WHEN ? = 'Diabetic' THEN sugar ELSE 0 END ASC,
            CASE WHEN ? = 'High Cholesterol' THEN (saturated_fats + trans_fats) ELSE 0 END ASC,
            CASE WHEN ? = 'Stage 2 Hypertension' THEN sodium ELSE 0 END ASC,
            calories ASC
          LIMIT 5";

$stmt = $conn->prepare($query);
$diabetic_condition = ($user_health_data['diabetes'] == 'Diabetic') ? 'Diabetic' : '';
$chol_condition = ($user_health_data['cholesterol'] == 'High Cholesterol') ? 'High Cholesterol' : '';
$hyp_condition = ($user_health_data['hypertension'] == 'Stage 2 Hypertension') ? 'Stage 2 Hypertension' : '';

$stmt->bind_param("sisss", $category, $food['food_id'], $diabetic_condition, $chol_condition, $hyp_condition);
$stmt->execute();
$recommendations = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Calculate match percentages for recommendations
foreach ($recommendations as &$rec) {
    $rec['match_percentage'] = calculateMatchPercentage($rec, $user_health_data);
}

// Close database connection
$stmt->close();
$conn->close();

// Helper function to calculate match percentage
function calculateMatchPercentage($food, $user_health) {
    $score = 100;
    
    // Adjust score based on health conditions
    if ($user_health['diabetes'] == 'Diabetic' && $food['sugar'] > 50) {
        $score -= ($food['sugar'] / 2);
    }
    
    if ($user_health['cholesterol'] == 'High Cholesterol' && $food['fats'] > 10) {
        $score -= ($food['fats'] * 2);
    }
    
    if ($user_health['hypertension'] == 'Stage 2 Hypertension' && $food['sodium'] > 200) {
        $score -= ($food['sodium'] / 10);
    }
    
    return max(20, min(100, $score)); // Keep between 20-100%
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Report - <?= htmlspecialchars($food['food_name']) ?></title>
    <link rel="stylesheet" href="HPFstyles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
<nav class="navbar">
        <div class="logo">
            <img src="image/log3.png" alt="Logo">
        </div>
        <ul class="nav-links">
        <li><a href="User_Interface.php">Back</a></li>
        <li><a href="Health_Profile_Form.php">Health Profile</a></li>
        <li><a href="">Food Categories</a></li>
        </ul>
        <div class="search-box">
            <input
              type="text"
              class="search-txt"
              name=""
              placeholder="What's on your mind?"
            />
            <a href="#" class="search-btn">
              <img src="image/search .png" alt="Search Icon" class="search-icon" />
            </a>
          </div>
    </nav>
    <header class="header">
        <br><br><br>
        <div class="h1">
        <h1>Your Personalized Health Report</h1>
        </div>
        <div class="h3">
        <h3>Analysis for: <?= htmlspecialchars($food['food_name']) ?></h3>
    </div>
</header>

<main class="report-container">
    <section class="food-summary">
        <div class="card">
            <h2><?= htmlspecialchars($food['food_name']) ?></h2>
            <p><strong>Brand:</strong> <?= htmlspecialchars($food['brand_name'] ?? 'N/A') ?></p>
            <p><strong>Category:</strong> <?= htmlspecialchars($food['category']) ?></p>
            
            <?php if (!empty($warnings)): ?>
                <div class="warnings">
                    <h3>Health Warnings</h3>
                    <?php foreach ($warnings as $warning): ?>
                        <div class="warning">⚠️ <?= htmlspecialchars($warning) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="suitability-badge">
            <h3>Suitability Rating</h3>
            <div class="rating" style="color: <?= 
                $suitability == 'Safe' ? '#28a745' : 
                ($suitability == 'Moderate' ? '#ffc107' : '#dc3545') 
            ?>">
                <?= $suitability ?> (<?= $suitability_percentage ?>%)
            </div>
            <canvas id="suitabilityChart"></canvas>
        </div>
    </section>

    <section class="nutritional-info">
        <h2>Nutritional Information</h2>
        <div class="nutrition-facts">
            <div class="nutrition-card">
                <div class="nutrition-label">Calories</div>
                <div class="nutrition-value"><?= $food['calories'] ?></div>
                <div class="nutrition-unit">kcal</div>
            </div>
            <div class="nutrition-card">
                <div class="nutrition-label">Sugar</div>
                <div class="nutrition-value"><?= $food['sugar'] ?></div>
                <div class="nutrition-unit">g</div>
            </div>
            <div class="nutrition-card">
                <div class="nutrition-label">Fats</div>
                <div class="nutrition-value"><?= $food['fats'] ?></div>
                <div class="nutrition-unit">g</div>
            </div>
            <div class="nutrition-card">
                <div class="nutrition-label">Protein</div>
                <div class="nutrition-value"><?= $food['protein'] ?></div>
                <div class="nutrition-unit">g</div>
            </div>
            <div class="nutrition-card">
                <div class="nutrition-label">Sodium</div>
                <div class="nutrition-value"><?= $food['sodium'] ?></div>
                <div class="nutrition-unit">mg</div>
            </div>
            <div class="nutrition-card">
                <div class="nutrition-label">Carbs</div>
                <div class="nutrition-value"><?= $food['carbohydrates'] ?></div>
                <div class="nutrition-unit">g</div>
            </div>
        </div>
    </section>

    <section class="ingredients-allergens">
        <div class="card">
            <h3>Ingredients</h3>
            <p><?= htmlspecialchars($food['ingredients']) ?></p>
            
            <h3>Allergens</h3>
            <p><?= !empty($food['allergens']) ? htmlspecialchars($food['allergens']) : 'None detected' ?></p>
            
            <h3>Additives</h3>
            <p><?= !empty($food['additives']) ? htmlspecialchars($food['additives']) : 'No additives reported' ?></p>
        </div>
    </section>

    <section class="recommendations">
        <h2>Recommended Alternatives</h2>
        <p>Based on your health profile, we suggest these healthier options:</p>
        
        <div class="recommendation-list">
            <?php if (!empty($recommendations)): ?>
                <?php foreach ($recommendations as $item): ?>
                    <div class="recommendation-card">
                        <h4><?= htmlspecialchars($item['food_name']) ?></h4>
                        <p><?= $item['calories'] ?> kcal | 
                           Sugar: <?= $item['sugar'] ?>g | 
                           Sodium: <?= $item['sodium'] ?>mg</p>
                        <div class="match-meter">
                            <div class="match-bar" style="width: <?= $item['match_percentage'] ?>%; 
                                background-color: <?= 
                                    $item['match_percentage'] > 75 ? '#28a745' : 
                                    ($item['match_percentage'] > 50 ? '#ffc107' : '#dc3545')
                                ?>">
                                <?= $item['match_percentage'] ?>% match
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No specific recommendations available. This food appears suitable for your profile.</p>
            <?php endif; ?>
        </div>
        
        <canvas id="recommendationChart"></canvas>
    </section>
</main>

<footer class="footer">
    <div class="row">
        <p>
            <a href="mailto:support@foodsuitability.com">support@foodsuitability.com</a>
            <br>
            <a href="tel:+1234567890">+1 234 567 890</a>
        </p>
    </div>
    <div class="row">
        <p>&copy; <?= date('Y') ?> Personalized Food Suitability System. All rights reserved.</p>
    </div>
</footer>

<script>
    // Suitability Chart
    var ctx1 = document.getElementById('suitabilityChart').getContext('2d');
    new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Suitable', 'Unsuitable'],
            datasets: [{
                data: [<?= $suitability_percentage ?>, 100 - <?= $suitability_percentage ?>],
                backgroundColor: ['#28a745', '#dc3545'],
                borderWidth: 0
            }]
        },
        options: {
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Recommendations Chart
    var ctx2 = document.getElementById('recommendationChart').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: [<?php foreach ($recommendations as $item) { 
                echo "'" . addslashes($item['food_name']) . "',"; 
            } ?>],
            datasets: [{
                label: 'Health Match Percentage',
                data: [<?php foreach ($recommendations as $item) { 
                    echo $item['match_percentage'] . ","; 
                } ?>],
                backgroundColor: [
                    <?php foreach ($recommendations as $item): ?>
                        '<?= $item['match_percentage'] > 75 ? "#28a745" : 
                          ($item['match_percentage'] > 50 ? "#ffc107" : "#dc3545") ?>',
                    <?php endforeach; ?>
                ],
                borderColor: '#343a40',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: 'Match Percentage'
                    }
                }
            }
        }
    });
</script>
</body>
</html>