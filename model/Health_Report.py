# Health_Report.py
from db_connect import get_db_connection
from recommendations import get_recommendations, calculate_match_percentage
import json

def generate_health_report(user_data, food_id):
    conn = get_db_connection()
    if not conn:
        return {"error": "Database connection failed"}

    cursor = conn.cursor(dictionary=True)

    # Fetch selected food item
    cursor.execute("SELECT * FROM food WHERE food_id = %s", (food_id,))
    food = cursor.fetchone()

    if not food:
        return {"error": "Food item not found"}

    # Extract and convert food values
    food_sugar = float(food.get('sugar', 0))
    food_fats = float(food.get('fats', 0))
    food_sat_fats = float(food.get('saturated_fats', 0))
    food_trans_fats = float(food.get('trans_fats', 0))
    food_sodium = float(food.get('sodium', 0))

    suitability = 'Safe'
    warnings = []
    suitability_percentage = 100

    # Diabetes check
    if food_sugar > 100 and user_data['diabetes'] in ['Diabetic', 'Above 250 mg/dL']:
        suitability = 'Avoid'
        suitability_percentage -= 40
        warnings.append(f"High sugar content ({food_sugar}g) not suitable for diabetics")

    # Cholesterol check
    total_bad_fats = food_sat_fats + food_trans_fats
    if total_bad_fats > 5 and user_data['cholesterol'] == 'High Cholesterol':
        suitability = 'Avoid' if suitability == 'Avoid' else 'Moderate'
        suitability_percentage -= 30
        warnings.append(f"High unhealthy fats ({total_bad_fats}g) not recommended for your cholesterol")

    # Hypertension check
    if food_sodium > 500 and user_data['hypertension'] == 'Stage 2 Hypertension':
        suitability = 'Avoid' if suitability == 'Avoid' else 'Moderate'
        suitability_percentage -= 25
        warnings.append(f"High sodium content ({food_sodium}mg) may affect blood pressure")

    # Allergy check
    if user_data['allergy_severity'] != 'None' and food.get('allergens') and 'Allergies' in user_data['allergy_severity']:
        suitability = 'Avoid'
        suitability_percentage = 0
        warnings.append(f"Contains allergens: {food['allergens']}")

    suitability_percentage = max(0, suitability_percentage)

    # Get recommendations
    recommendations = get_recommendations(user_data, food)
    for rec in recommendations:
        rec['match_percentage'] = calculate_match_percentage(rec, user_data)

    cursor.close()
    conn.close()

    return {
        "selected_food": food,
        "suitability": suitability,
        "suitability_percentage": suitability_percentage,
        "warnings": warnings,
        "recommendations": recommendations
    }
