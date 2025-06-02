import mysql.connector
import html

# Database configuration (adjust as needed)
DB_CONFIG = {
    'host': 'localhost',
    'user': 'root',
    'password': 'ishan@2001',
    'database': 'pfsa'
}

def get_db_connection():
    """Create and return a new database connection."""
    return mysql.connector.connect(**DB_CONFIG)

def fetch_food_details(food_id):
    """
    Fetch food details from the database by food_id.
    Sanitize output for safety.
    """
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    query = "SELECT * FROM food WHERE food_id = %s"
    cursor.execute(query, (food_id,))
    food = cursor.fetchone()
    cursor.close()
    conn.close()

    if not food:
        return None

    # Sanitize output
    sanitized_food = {k: html.escape(str(v)) if isinstance(v, str) else v for k, v in food.items()}
    return sanitized_food

def classify_food_suitability(food, user_health_profile):
    """
    Classify food suitability for the user as 'Safe', 'Moderate', or 'Avoid'
    based on health conditions and food nutritional info.
    """
    suitability = 'Safe'

    # Extract relevant food data safely
    sugar = float(food.get('sugar', 0))
    saturated_fats = float(food.get('saturated_fats', 0))
    trans_fats = float(food.get('trans_fats', 0))
    sodium = float(food.get('sodium', 0))
    allergens = food.get('allergens', '').lower()

    # Diabetes check
    if sugar > 100 and user_health_profile.get('diabetes') in ['Diabetic', 'Above 250 mg/dL']:
        suitability = 'Avoid'

    # Cholesterol check
    if (saturated_fats + trans_fats) > 5 and user_health_profile.get('cholesterol') == 'High Cholesterol':
        suitability = 'Moderate' if suitability != 'Avoid' else suitability

    # Hypertension check
    if sodium > 500 and user_health_profile.get('hypertension') == 'Stage 2 Hypertension':
        suitability = 'Moderate' if suitability != 'Avoid' else suitability

    # Allergy check
    allergy_severity = user_health_profile.get('allergy_severity', 'None')
    if allergy_severity != 'None' and allergens and 'allergies' in allergy_severity.lower():
        suitability = 'Avoid'

    return suitability

def extract_allergens_from_text(food_description):
    """
    Simple NLP extraction of allergens from a food description.
    This is a placeholder for more advanced NLP techniques.
    """
    common_allergens = ['nuts', 'gluten', 'dairy', 'soy', 'shellfish', 'eggs', 'peanuts', 'wheat', 'fish']
    found_allergens = []

    description_lower = food_description.lower()
    for allergen in common_allergens:
        if allergen in description_lower:
            found_allergens.append(allergen)

    return found_allergens

