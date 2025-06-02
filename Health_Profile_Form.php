<?php
session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: login.html");
    exit();
}
$fullname = $_SESSION['fullname'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Profile Form</title>
    <link rel="stylesheet" href="HPFstyles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="image/log3.png" alt="Logo">
        </div>
        <ul class="nav-links">
            <li><a href="User_Interface.php">Home</a></li>
            <li><a href="#">Food details and categories</a></li>
            <li><a href="Log_out.php">Log out</a></li>
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
            <h1>Health Profile Form</h1>
        </div>
        <div class="h3">
            <h3>"Your Health, Your Food Personalized Just for You"</h3>
        </div>
        <br><br>
        <p>The Health Profile Form allows users to create a personalized health profile by entering their medical conditions, allergies, dietary preferences, and other relevant health details. This information is used to tailor food suitability analyses, ensuring users receive accurate and customized recommendations for healthier eating.</p>
    </header>
    <section class="Health_Profile_Form" id="Health_Profile_Form">
    <!-- Form -->
    <form class="Health_Profile" id="Health_Profile" action="Health_Report.php" method="post">
                <h1 class="title">Personalize Your Profile with Essential Details</h1>
                    <h2>Personal Details</h2>
                    <p class="p">Enter basic information about yourself.</p>
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" value="<?= htmlspecialchars($_SESSION['fullname'] ?? '') ?>">
                    <br>
                    <label for="Age">Age</label>
                    <select name="Age" id="Age">
                        <option value="" disabled selected>Select your age</option>
                        <option value="0 - 5 years (Infants & Toddlers)">0 - 5 years (Infants & Toddlers)</option>
                        <option value="6 - 12 years (Children)">6 - 12 years (Children)</option>
                        <option value="13 - 18 years (Teenagers)">13 - 18 years (Teenagers)</option>
                        <option value="19 - 30 years (Young Adults)">19 - 30 years (Young Adults)</option>
                        <option value="31 - 45 years (Adults)">31 - 45 years (Adults)</option>
                        <option value="46 - 60 years (Middle-Aged Adults)">46 - 60 years (Middle-Aged Adults)</option>
                        <option value="61 - 75 years (Seniors)">61 - 75 years (Seniors)</option>
                        <option value="76+ years (Elderly)">76+ years (Elderly)</option>
                    </select>
                    <br>
                    <label for="Gender">Gender</label>
                    <select name="Gender" id="Gender">
                        <option value="" disabled selected>Select your gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <br>
                    <label for="Weight">Weight</label>
                    <select id="weight" name="weight" required>
                        <option value="">Select Weight Category</option>
                        <option value="Less than 50 kg (110 lbs)">Underweight: Less than 50 kg (110 lbs)</option>
                        <option value="50 - 75 kg (110 - 165 lbs)">Healthy Weight: 50 - 75 kg (110 - 165 lbs)</option>
                        <option value="75 - 100 kg (165 - 220 lbs)">Overweight: 75 - 100 kg (165 - 220 lbs)</option>
                        <option value="Above 100 kg (220 lbs)">Obese: Above 100 kg (220 lbs)</option>
                    </select>
                    <h2>Medical Conditions</h2>
                    <p class="p">Share any health conditions.</p>
                    <label for="Diabetes">Diabetes</label>
                    <select id="diabetes" name="diabetes">
                        <option value="">Select Diabetes Level</option>
                        <option value="70 - 99 mg/dL">Normal: 70 - 99 mg/dL</option>
                        <option value="100 - 125 mg/dL">Prediabetes: 100 - 125 mg/dL</option>
                        <option value="126 - 180 mg/dL">Diabetes (Controlled): 126 - 180 mg/dL</option>
                        <option value="181 - 250 mg/dL">Diabetes (High): 181 - 250 mg/dL</option>
                        <option value="Above 250 mg/dL">Diabetes (Very High): Above 250 mg/dL</option>
                    </select>
                    <br>
                    <label for="Cholesterol">Cholesterol</label>
                    <select name="cholesterol" id="cholesterol">
                        <option value="">Select Cholesterol Level</option>
                        <option value="Less than 200 mg/dL">Desirable: Less than 200 mg/dL</option>
                        <option value="200 - 239 mg/dL">Borderline High: 200 - 239 mg/dL</option>
                        <option value="240 mg/dL and above">High Cholesterol: 240 mg/dL and above</option>
                    </select>
                    <br>
                    <label for="Hypertension">Hypertension</label>
                    <select id="hypertension" name="hypertension">
                        <option value="">Select Blood Pressure Level</option>
                        <option value="Less than 120/80 mmHg">Normal: Less than 120/80 mmHg</option>
                        <option value="120-129 / Less than 80 mmHg">Elevated (Pre-Hypertension): 120-129 / Less than 80 mmHg</option>
                        <option value="130-139 / 80-89 mmHg">Stage 1 Hypertension: 130-139 / 80-89 mmHg</option>
                        <option value="140+ / 90+ mmHg">Stage 2 Hypertension: 140+ / 90+ mmHg</option>
                        <option value="Higher than 180 / Higher than 120 mmHg">Hypertensive Crisis (Emergency): Higher than 180 / Higher than 120 mmHg</option>
                    </select>
                    <br>
                    <label for="Heart Condition">Heart Condition</label>
                    <select id="heart_condition" name="heart_condition">
                        <option value="">Select Heart Condition</option>
                        <option value="No Known Heart Condition">No Known Heart Condition</option>
                        <option value="Mild Risk (Early Symptoms)">Mild Risk (Early Symptoms)</option>
                        <option value="Moderate Risk (Managed with Medication)">Moderate Risk (Managed with Medication)</option>
                        <option value="High Risk (Severe Heart Disease)">High Risk (Severe Heart Disease)</option>
                    </select>
                    <h2>Allergies</h2>
                    <p class="p">Specify any food allergies (e.g., nuts, gluten, dairy).</p>
                    <label for="Allergies">Allergy Name or Food Item</label>
                    <select id="allergy_severity" name="allergy_severity">
                        <option value="">Select Allergy Severity</option>
                        <option value="None">No Allergies</option>
                        <option value="Mild Allergies (Non-Life-Threatening Reactions)">Mild Allergies (Non-Life-Threatening Reactions)</option>
                        <option value="Moderate Allergies (Reactions Requiring Caution)">Moderate Allergies (Reactions Requiring Caution)</option>
                        <option value="Severe Allergies (Anaphylactic Risk – Life-Threatening)">Severe Allergies (Anaphylactic Risk – Life-Threatening)</option>
                    </select>
                    <h2>Health Restrictions</h2>
                    <p class="p">Add dietary restrictions or doctor-recommended limits.</p>
                    <label for="Sugar Level">Sugar Level</label>
                    <select name="sugarLevel" id="sugarLevel">
                        <option value="" disabled selected>Select your sugar level</option>
                        <option value="Normal">Normal</option>
                        <option value="Pre-Diabetic">Pre-Diabetic</option>
                        <option value="Diabetic">Diabetic</option>
                    </select>
                    <br>
                    <label for="sodiumLevel">Sodium Level</label>
                    <select name="sodiumLevel" id="sodiumLevel">
                        <option value="" disabled selected>Select your sodium level</option>
                        <option value="Low">Low</option>
                        <option value="Normal">Normal</option>
                        <option value="High">High</option>
                    </select>
                    <br>
                    <label for="fatsLevel">Fats Level</label>
                    <select name="fatsLevel" id="fatsLevel">
                        <option value="" disabled selected>Select your fats level</option>
                        <option value="Low">Low</option>
                        <option value="Normal">Normal</option>
                        <option value="High">High</option>
                    </select>
        
        <h2>Food Preferences</h2>
        <label for="foodCategories">Food Categories</label>
        <select name="foodCategories" id="foodCategories" required>
            <option value="" disabled selected>Loading categories...</option>
        </select>
        <br>
        
        <label for="Food_Item_Name">Food Item Name</label>
        <select name="Food_Item_Name" id="Food_Item_Name" required>
            <option value="" disabled selected>Select a category first</option>
        </select>
        <br>
        
        <p>Click the button below to generate results.</p>
        <button type="submit" class="Generate" id="Generate">Generate</button>
    </form>
    <script>
        $(document).ready(function() {
    // Load food categories
    $.ajax({
        url: 'get_categories.php',
        type: 'GET',
        success: function(response) {
            $('#foodCategories').html(response);
        },
        error: function() {
            $('#foodCategories').html('<option value="">Error loading categories</option>');
        }
    });

    // Load food items when category changes
    $('#foodCategories').change(function() {
        var category = $(this).val();
        if (category) {
            $.ajax({
                url: 'get_food_items.php',
                type: 'POST',
                data: { category: category },
                success: function(response) {
                    $('#Food_Item_Name').html(response);
                },
                error: function() {
                    $('#Food_Item_Name').html('<option value="">Error loading items</option>');
                }
            });
        } else {
            $('#Food_Item_Name').html('<option value="" disabled selected>Select a category first</option>');
        }
    });
});
    </script>
    </section>
    <footer class="footer">
        <div class="row">
            <p>
                <a href="mailto:support@foodsuitability.com">support@foodsuitability.com</a>
                <br>
                <a href="tel:+1234567890">+1 234 567 890</a>
            </p>
        </div>
        <div class="row">
            <p>&copy; 2024 Personalized Food Suitability System. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>