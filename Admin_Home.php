<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home - Personalized Food Suitability Analyzer</title>
    <link rel="stylesheet" href="Admin_Home.css">
    <style>
/* Food Details Table Styles */
section.Food_details_table {
  max-width: 1200px;
  margin: 2rem auto;
  padding: 1rem;
}

section.Food_details_table h1 {
  color: #2c3e50;
  text-align: center;
  margin-bottom: 1.5rem;
}

.details_table {
  overflow-x: auto;
  background: white;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.details_table table {
  width: 100%;
  border-collapse: collapse;
}

.details_table th {
  background-color: #3498db;
  color: white;
  padding: 1rem;
  text-align: left;
}

.details_table td {
  padding: 0.8rem 1rem;
  border-bottom: 1px solid #eee;
  vertical-align: middle;
}

.details_table tr:hover {
  background-color: #f5f5f5;
}

.details_table .actions {
  display: flex;
  gap: 0.5rem;
}

.details_table .view-btn,
.details_table .edit-btn {
  padding: 0.4rem 0.8rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.9rem;
  transition: all 0.2s;
}

.details_table .view-btn {
  background-color: #2ecc71;
  color: white;
}

.details_table .edit-btn {
  background-color: #f39c12;
  color: white;
}

.details_table .view-btn:hover {
  background-color: #27ae60;
}

.details_table .edit-btn:hover {
  background-color: #e67e22;
}

/* Modal Styles */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.4);
}

.modal-content {
  background-color: #fefefe;
  margin: 5% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 800px;
  border-radius: 8px;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover {
  color: black;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .details_table {
    font-size: 0.9rem;
  }
  
  .details_table th,
  .details_table td {
    padding: 0.6rem;
  }
  
  .details_table .actions {
    flex-direction: column;
    gap: 0.3rem;
  }
  
  .modal-content {
    width: 95%;
    margin: 10% auto;
  }
}
section.image-text-reader {
  font-family: Arial, sans-serif;
  max-width: 600px;
  margin: 20px auto;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  background-color: #f9f9f9;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

section.image-text-reader h2 {
  color: #333;
  margin-bottom: 20px;
  text-align: center;
}

section.image-text-reader input[type="file"] {
  display: block;
  margin-bottom: 15px;
  padding: 10px;
  width: 100%;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: white;
}

section.image-text-reader button {
  display: block;
  width: 100%;
  padding: 10px 15px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
  margin-bottom: 15px;
  transition: background-color 0.3s;
}

section.image-text-reader button:hover {
  background-color: #45a049;
}

section.image-text-reader textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
  min-height: 150px;
  font-family: inherit;
  font-size: 14px;
}
</style>
</head>
<body>
    <nav class="navbar">
    <div class="logo">
      <img src="image/log3.png" alt="Logo">
    </div>
    <ul class="nav-links">
      <li><a href="Admin_Home.php">Food Management</a></li>
      <li><a href="Admin Manage.html">Admin Manage</a></li>
      <li><a href="Admin_logout.php">Log Out</a></li>
    </ul>
    <div class="search-box">
      <input type="text" class="search-txt" name="" placeholder="What's on your mind?"/>
      <a href="#" class="search-btn">
        <img src="image/search .png" alt="Search Icon" class="search-icon" />
      </a>
    </div>
  </nav>
  <header class="header">
    <br><br>
  <h1 class="h1">Welcome, Admin!</h1>
  <p>
    Use the navigation menu to manage the application.
  </p><br><br>
</header>
<section class="food_barcode">
</section>
<section class="food details enter">
  <h2>Food Details</h2>
  <form id="foodDetailsForm" action="submit_food.php" method="post">
    <h2>Food Details Entry</h2>
    
    <div class="form-group">
      <label for="food_name">Food Name:</label>
      <input type="text" id="food_name" name="food_name" maxlength="450" required>
    </div>
    
    <div class="form-group">
      <label for="category">Category:</label>
      <select id="category" name="category" required>
        <option value="">Select a category</option>
        <option value="Toffee">Toffee</option>
        <option value="Fruits">Fruits</option>
        <option value="Biscuits">Biscuits</option>
        <option value="Chocolate">Chocolate</option>
        <option value="Cold drinks">Cold drinks</option>
        <option value="Noodles">Noodles</option>
        <option value="Beverages">Beverages</option>
        <option value="Ice Cream">Ice Cream</option>
      </select>
    </div>
    
    <div class="form-group">
      <label for="brand_name">Brand Name:</label>
      <input type="text" id="brand_name" name="brand_name" maxlength="450">
    </div>
    
    <h3>Nutritional Information</h3>
    
    <div class="form-group">
      <label for="calories">Calories:</label>
      <input type="text" id="calories" name="calories" maxlength="450">
    </div>
    
    <div class="form-group">
      <label for="fats">Fats (g):</label>
      <input type="text" id="fats" name="fats" maxlength="450">
    </div>
    
    <div class="form-group">
      <label for="saturated_fats">Saturated Fats (g):</label>
      <input type="text" id="saturated_fats" name="saturated_fats" maxlength="450">
    </div>
    
    <div class="form-group">
      <label for="trans_fats">Trans Fats (g):</label>
      <input type="text" id="trans_fats" name="trans_fats" maxlength="450">
    </div>
    
    <div class="form-group">
      <label for="sugar">Sugar (g):</label>
      <input type="text" id="sugar" name="sugar" maxlength="450">
    </div>
    
    <div class="form-group">
      <label for="sodium">Sodium (mg):</label>
      <input type="text" id="sodium" name="sodium" maxlength="450">
    </div>
    
    <div class="form-group">
      <label for="protein">Protein (g):</label>
      <input type="text" id="protein" name="protein" maxlength="450">
    </div>
    
    <div class="form-group">
      <label for="fiber">Fiber (g):</label>
      <input type="text" id="fiber" name="fiber" maxlength="450">
    </div>
    
    <div class="form-group">
      <label for="carbohydrates">Carbohydrates (g):</label>
      <input type="text" id="carbohydrates" name="carbohydrates" maxlength="450">
    </div>
    
    <div class="form-group">
      <label for="ingredients">Ingredients:</label>
      <textarea id="ingredients" name="ingredients" maxlength="450" rows="3"></textarea>
    </div>
    
    <div class="form-group">
      <label for="allergens">Allergens:</label>
      <textarea id="allergens" name="allergens" maxlength="450" rows="3"></textarea>
    </div>
    
    <div class="form-group">
      <label for="additives">Additives:</label>
      <textarea id="additives" name="additives" maxlength="450" rows="3"></textarea>
    </div>
    
    <div class="form-actions">
      <button type="submit">Submit Food Details</button>
      <button type="reset">Clear</button>
    </div>
  </form>
</section>
<section class="image-text-reader">
  <h2>Upload Food Details Image</h2>
  
  <!-- File Upload (accept jpg, jpeg, png) -->
  <input type="file" id="imageInput" accept="image/jpeg, image/jpg, image/png">
  
  <!-- Button to Start OCR -->
  <button onclick="extractText()">Extract Text</button>
  
  <!-- Text Field 1 (TextArea) -->
  <textarea id="textField1" rows="10" cols="50" placeholder="Extracted text will appear here..."></textarea>
</section>

<!-- Load Tesseract.js Library -->
<script src="https://cdn.jsdelivr.net/npm/tesseract.js@4.0.2/dist/tesseract.min.js"></script>

<script>
function extractText() {
  const imageInput = document.getElementById('imageInput');
  
  if (imageInput.files.length === 0) {
    alert('Please select an image file (jpg, jpeg, or png).');
    return;
  }

  const file = imageInput.files[0];
  
  const reader = new FileReader();
  reader.onload = function() {
    Tesseract.recognize(
      reader.result,
      'eng', // English language
      {
        logger: m => console.log(m) // Optional: Progress logs
      }
    ).then(({ data: { text } }) => {
      document.getElementById('textField1').value = text.trim();
    }).catch(error => {
      console.error(error);
      alert('Failed to extract text.');
    });
  };
  
  reader.readAsDataURL(file);
}
</script>

<section class="Food_details_table">
  <h1>Food Details Table</h1>
  <div class="details_table">
    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "ishan@2001";
    $dbname = "pfsa";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    // SQL query to fetch food data
    $sql = "SELECT food_id, food_name, category, brand_name, calories, carbohydrates, protein 
            FROM food 
            ORDER BY food_name ASC";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
    ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Food Name</th>
          <th>Category</th>
          <th>Brand</th>
          <th>Calories</th>
          <th>Carbs (g)</th>
          <th>Protein (g)</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>".htmlspecialchars($row["food_id"])."</td>
                  <td>".htmlspecialchars($row["food_name"])."</td>
                  <td>".htmlspecialchars($row["category"])."</td>
                  <td>".htmlspecialchars($row["brand_name"])."</td>
                  <td>".htmlspecialchars($row["calories"])."</td>
                  <td>".htmlspecialchars($row["carbohydrates"])."</td>
                  <td>".htmlspecialchars($row["protein"])."</td>
                  <td class='actions'>
                    <button class='view-btn' data-id='".$row["food_id"]."'>View</button>
                    <button class='edit-btn' data-id='".$row["food_id"]."'>Edit</button>
                  </td>
                </tr>";
        }
        ?>
      </tbody>
    </table>
    <?php
    } else {
      echo "<p>No food items found in the database.</p>";
    }
    $conn->close();
    ?>
  </div>
</section>
<!-- Modal for detailed view -->
<div id="foodDetailModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div id="foodDetails"></div>
  </div>
</div>
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
<script>
// JavaScript to handle view button clicks
document.querySelectorAll('.view-btn').forEach(button => {
  button.addEventListener('click', function() {
    const foodId = this.getAttribute('data-id');
    fetchFoodDetails(foodId);
  });
});

function fetchFoodDetails(foodId) {
  fetch('get_food_details.php?id=' + foodId)
    .then(response => response.json())
    .then(data => {
      document.getElementById('foodDetails').innerHTML = `
        <h2>${data.food_name}</h2>
        <p><strong>Category:</strong> ${data.category}</p>
        <p><strong>Brand:</strong> ${data.brand_name}</p>
        <h3>Nutritional Information</h3>
        <p><strong>Calories:</strong> ${data.calories}</p>
        <p><strong>Fats:</strong> ${data.fats}g</p>
        <p><strong>Saturated Fats:</strong> ${data.saturated_fats}g</p>
        <p><strong>Trans Fats:</strong> ${data.trans_fats}g</p>
        <p><strong>Sugar:</strong> ${data.sugar}g</p>
        <p><strong>Sodium:</strong> ${data.sodium}mg</p>
        <p><strong>Protein:</strong> ${data.protein}g</p>
        <p><strong>Fiber:</strong> ${data.fiber}g</p>
        <p><strong>Carbohydrates:</strong> ${data.carbohydrates}g</p>
        <h3>Composition</h3>
        <p><strong>Ingredients:</strong> ${data.ingredients}</p>
        <p><strong>Allergens:</strong> ${data.allergens}</p>
        <p><strong>Additives:</strong> ${data.additives}</p>
      `;
      document.getElementById('foodDetailModal').style.display = 'block';
    });
}

// Close modal
document.querySelector('.close').addEventListener('click', function() {
  document.getElementById('foodDetailModal').style.display = 'none';
});
</script>
</body>
</html>