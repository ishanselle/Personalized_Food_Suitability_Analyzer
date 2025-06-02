import mysql.connector

# Connect to the database
conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="ishan@2001",
    database="pfsa"
)
cursor = conn.cursor(dictionary=True)

# Simulating the user POST data (In real usage, use frameworks like Flask to get POST data)
user_health_data = {
    'fullname': input("Full Name: "),
    'age': input("Age: "),
    'gender': input("Gender: "),
    'weight': input("Weight Category: "),
    'diabetes': input("Diabetes Level: "),
    'cholesterol': input("Cholesterol Level: "),
    'hypertension': input("Hypertension Level: "),
    'heart_condition': input("Heart Condition: "),
    'allergy_severity': input("Allergy Severity: "),
    'sugarLevel': input("Sugar Level: "),
    'sodiumLevel': input("Sodium Level: "),
    'fatsLevel': input("Fats Level: "),
    'food_category': input("Food Category: "),
    'food_item_name': input("Food Item Name: ")
}

# Fetch selected food
food_item_name = user_health_data['food_item_name']
cursor.execute("SELECT * FROM food WHERE food_name = %s", (food_item_name,))
food = cursor.fetchone()

if not food:
    print("Food item not found!")
    conn.close()
    exit()

# Convert values to numbers for analysis
food_sugar = float(food['sugar'].replace('g', '').replace('mg', '').replace('kcal', '').strip() or 0)
food_fats = float(food['fats'].replace('g', '').replace('mg', '').replace('kcal', '').strip() or 0)
food_saturated_fats = float(food['saturated_fats'].replace('g', '').replace('mg', '').replace('kcal', '').strip() or 0)
food_trans_fats = float(food['trans_fats'].replace('g', '').replace('mg', '').replace('kcal', '').strip() or 0)
food_sodium = float(food['sodium'].replace('g', '').replace('mg', '').replace('kcal', '').strip() or 0)

# Health impact analysis
suitability = "Safe"
warnings = []
suitability_percentage = 100

# Diabetes check
if food_sugar > 100 and user_health_data['diabetes'] in ['Diabetic', 'Above 250 mg/dL']:
    suitability = "Avoid"
    suitability_percentage -= 40
    warnings.append(f"High sugar content ({food['sugar']}) not suitable for diabetics")

# Cholesterol check
total_bad_fats = food_saturated_fats + food_trans_fats
if total_bad_fats > 5 and user_health_data['cholesterol'] == "High Cholesterol":
    suitability = "Avoid" if suitability == "Avoid" else "Moderate"
    suitability_percentage -= 30
    warnings.append(f"High unhealthy fats ({total_bad_fats}g) not recommended for your cholesterol")

# Hypertension check
if food_sodium > 500 and user_health_data['hypertension'] == "Stage 2 Hypertension":
    suitability = "Avoid" if suitability == "Avoid" else "Moderate"
    suitability_percentage -= 25
    warnings.append(f"High sodium content ({food['sodium']}) may affect blood pressure")

# Allergy check
if user_health_data['allergy_severity'] != 'None' and food['allergens']:
    suitability = "Avoid"
    suitability_percentage = 0
    warnings.append(f"Contains allergens: {food['allergens']}")

# Ensure percentage doesn't fall below 0
suitability_percentage = max(0, suitability_percentage)

# Get alternative food recommendations
category = food['category']
query = """
    SELECT food_id, food_name, calories, fats, sugar, sodium 
    FROM food 
    WHERE category = %s AND food_id != %s
"""
cursor.execute(query, (category, food['food_id']))
recommendations = cursor.fetchall()

# Calculate match percentage for each recommended food
def calculate_match_percentage(food, user_health):
    score = 100
    sugar = float(food['sugar'].replace('g', '').replace('mg', '').strip() or 0)
    fats = float(food['fats'].replace('g', '').replace('mg', '').strip() or 0)
    sodium = float(food['sodium'].replace('g', '').replace('mg', '').strip() or 0)

    if user_health['diabetes'] == 'Diabetic' and sugar > 50:
        score -= (sugar / 2)
    if user_health['cholesterol'] == 'High Cholesterol' and fats > 10:
        score -= (fats * 2)
    if user_health['hypertension'] == 'Stage 2 Hypertension' and sodium > 200:
        score -= (sodium / 10)

    return max(20, min(100, score))

for rec in recommendations:
    rec['match_percentage'] = calculate_match_percentage(rec, user_health_data)

# Show the report
print("\n========= Food Suitability Report =========")
print(f"Food: {food['food_name']}")
print(f"Suitability: {suitability}")
print(f"Suitability Percentage: {suitability_percentage}%")
if warnings:
    print("Warnings:")
    for w in warnings:
        print(f" - {w}")

print("\nRecommended Alternatives:")
if recommendations:
    for rec in recommendations[:5]:
        print(f"{rec['food_name']} (Match: {rec['match_percentage']}%)")
else:
    print("No suitable alternatives found.")

# Close connection
conn.close()
