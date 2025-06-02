import mysql.connector

# Database config
DB_CONFIG = {
    'host': 'localhost',
    'user': 'root',
    'password': 'ishan@2001',
    'database': 'pfsa'
}

def get_db_connection():
    return mysql.connector.connect(**DB_CONFIG)

def calculate_match_percentage(food, user_health):
    """
    Calculate match percentage between food nutrition and user health profile.
    Returns an integer between 20 and 100.
    """
    score = 100

    # Diabetes condition check (using sugar)
    if user_health.get('diabetes') == 'Diabetic' and food.get('sugar', 0) > 50:
        score -= (food['sugar'] / 2)

    # High cholesterol check (using fats)
    if user_health.get('cholesterol') == 'High Cholesterol' and food.get('fats', 0) > 10:
        score -= (food['fats'] * 2)

    # Hypertension check (using sodium)
    if user_health.get('hypertension') == 'Stage 2 Hypertension' and food.get('sodium', 0) > 200:
        score -= (food['sodium'] / 10)

    # Clamp between 20 and 100
    return max(20, min(100, int(score)))

def fetch_recommendations(category, excluded_food_id, user_health, limit=5):
    """
    Fetch recommended foods from the same category,
    excluding the selected food, sorted by suitability.
    """

    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)

    # Fetch candidate foods from the same category except excluded food_id
    query = """
        SELECT food_id, food_name, calories, fats, sugar, sodium, saturated_fats, trans_fats
        FROM food
        WHERE category = %s AND food_id != %s
    """
    cursor.execute(query, (category, excluded_food_id))
    foods = cursor.fetchall()

    # Calculate match percentages
    for food in foods:
        food['match_percentage'] = calculate_match_percentage(food, user_health)

    # Sort foods by descending match_percentage and ascending calories as tiebreaker
    foods_sorted = sorted(
        foods,
        key=lambda f: (-f['match_percentage'], f['calories'])
    )

    cursor.close()
    conn.close()

    return foods_sorted[:limit]
