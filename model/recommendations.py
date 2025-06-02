# recommendations.py
from db_connect import get_db_connection

def get_recommendations(user_data, food):
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)

    category = food['category']
    food_id = food['food_id']
    
    query = """
    SELECT food_id, food_name, calories, fats, sugar, sodium, saturated_fats, trans_fats
    FROM food
    WHERE category = %s AND food_id != %s
    ORDER BY 
        CASE WHEN %s = 'Diabetic' THEN sugar ELSE 0 END ASC,
        CASE WHEN %s = 'High Cholesterol' THEN (saturated_fats + trans_fats) ELSE 0 END ASC,
        CASE WHEN %s = 'Stage 2 Hypertension' THEN sodium ELSE 0 END ASC,
        calories ASC
    LIMIT 5
    """
    cursor.execute(query, (
        category,
        food_id,
        user_data.get('diabetes', ''),
        user_data.get('cholesterol', ''),
        user_data.get('hypertension', '')
    ))

    recommendations = cursor.fetchall()
    cursor.close()
    conn.close()
    return recommendations

def calculate_match_percentage(food, user_data):
    score = 100

    if user_data['diabetes'] == 'Diabetic' and food['sugar'] > 50:
        score -= (food['sugar'] / 2)

    if user_data['cholesterol'] == 'High Cholesterol' and food['fats'] > 10:
        score -= (food['fats'] * 2)

    if user_data['hypertension'] == 'Stage 2 Hypertension' and food['sodium'] > 200:
        score -= (food['sodium'] / 10)

    return max(20, min(100, score))
