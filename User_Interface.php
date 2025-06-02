<?php
session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: login.html");
    exit();
}
$fullname = $_SESSION['fullname'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personalized Food Suitability Analyzer</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <nav class="navbar">
    <div class="logo">
      <img src="image/log3.png" alt="Logo">
    </div>
    <ul class="nav-links">
      <li><a href="Health_Profile_Form.php">Health Profile</a></li>
      <li><a href="#">Food details and categories</a></li>
      <li><a href="Log_out.php">Log out</a></li>
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
  <h1 class="h1">Personalized Food<br>Suitability Analyzer</h1>
  <h3>"Your Personalized Guide to Safe and Healthy Eating"</h3><br>
  <p>
    Welcome to the Personalized Food Suitability System!<br>
    Your health, your food, your choice simplified.
  </p><br><br>
  <a href="#profile"><button class="cta-button">LET'S GO...</button></a>
</header>
<!--Health Profile Form-->
<section id="profile" class="health-profile-form">
  <div class="title">
  <h1>Health Profile Form</h1>
</div>
<div class="row">
  <div class="col">
  <img src="image/p01.png" alt="Profile">
</div>
<div class="col">
  <p>The Health Profile Form helps you enter your health details, allergies, and dietary preferences to get personalized food recommendations.</p><br>
  <a href="Health_Profile_Form.php"><button class="fillform">Fill in the Form</button></a>
</div>  
</div>
</section>

<!--Services-->
<section id="services" class="Services">
  <div class="title">
    <h1>Services</h1>
  </div>
  <div class="row">
    <div class="col">
      <h2>Suitability Analysis</h2>
      <img src="image/Suitability Analysis.png" alt="gif">
      <br><p>"Quickly determine if a food item is safe, moderate, or unsuitable based on your health profile. The analysis provides a clear rating and reasons for the result."</p>
    </div>
    <div class="col">
      <h2>Food Categories</h2>
      <img src="image/Food Categories.png" alt="gif">
      <br><p>"Browse through organized food categories like snacks, beverages, or desserts. Quickly find and analyze items that match your dietary needs within each group."</p>
    </div>
    <div class="col">
      <h2>Recommendations</h2>
      <img src="image/Recommendations.png" alt="gif">
      <br><p>"Get personalized suggestions for healthier alternatives. If a food item doesn’t fit your needs, we’ll recommend similar options that align with your health goals and preferences."</p>
    </div>
  </div>
</section>

<!--About Us-->
<section id="about" class="About-us">
<div class="title">
  <h1>About Us</h1>
</div>
  <div class="row">
    <div class="col">
      <p>Welcome to the Personalized Food Suitability System! Our platform helps you make healthier food choices by analyzing your health profile and dietary needs. Whether you’re managing allergies, following a specific diet, or simply looking to eat better, we provide tailored recommendations and insights to match your lifestyle.</p>
    </div>
    <div class="col">
      <img src="image/About Us.png" alt="gif">
    </div>
  </div>
</section>

<!-- Footer -->
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
<script src="script.js"></script>
</body>
</html>