import json
import mysql.connector

# Establish a connection to the database
conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="ishan@2001",  # Replace with your database password
    database="pfsa"  # Replace with your database name
)
cursor = conn.cursor()

# Fetch the user's health profile from the health_profile table
cursor.execute("SELECT * FROM health_profile WHERE full_name = %s", (1,))  # Assuming the profile_id is 1 for now
user_data = cursor.fetchone()

# Fetch the selected food item details from the food table
cursor.execute("SELECT * FROM food WHERE food_name = %s", ('Chocolate',))  # Replace 'Chocolate' with the food item selected by the user
food_item = cursor.fetchone()

# Close the database connection
cursor.close()
conn.close()

# Map user_data and food_item to dictionaries for easier processing
user_data_dict = {
    'age': user_data[2],  # Assuming 'age' is at index 2
    'weight_category': user_data[4],  # Assuming 'weight_category' is at index 4
    'diabetes_level': user_data[5],  # Assuming 'diabetes_level' is at index 5
    'cholesterol_level': user_data[6],  # Assuming 'cholesterol_level' is at index 6
    'hypertension_level': user_data[7],  # Assuming 'hypertension_level' is at index 7
    'heart_condition': user_data[8],  # Assuming 'heart_condition' is at index 8
    'allergies': user_data[9],  # Assuming 'allergies' is at index 9
    'sugar_level': user_data[10],  # Assuming 'sugar_level' is at index 10
    'sodium_level': user_data[11],  # Assuming 'sodium_level' is at index 11
    'fats_level': user_data[12],  # Assuming 'fats_level' is at index 12
}

food_item_dict = {
    'name': food_item[1],  # Assuming 'food_name' is at index 1
    'category': food_item[2],  # Assuming 'category' is at index 2
    'calories': food_item[3],  # Assuming 'calories' is at index 3
    'fats': food_item[4],  # Assuming 'fats' is at index 4
    'saturated_fats': food_item[5],  # Assuming 'saturated_fats' is at index 5
    'sugar': food_item[6],  # Assuming 'sugar' is at index 6
    'sodium': food_item[7],  # Assuming 'sodium' is at index 7
    'protein': food_item[8],  # Assuming 'protein' is at index 8
    'fiber': food_item[9],  # Assuming 'fiber' is at index 9
    'carbohydrates': food_item[10],  # Assuming 'carbohydrates' is at index 10
    'ingredients': food_item[11],  # Assuming 'ingredients' is at index 11
    'allergens': food_item[12],  # Assuming 'allergens' is at index 12
}

def check_food_suitability(user_data, food_item):
    status = "Safe"
    reason = "The food item is safe for you based on your health profile."

    # Check conditions based on user's health profile
    if user_data['sugar_level'] == 'diabetic' and int(food_item['sugar']) > 10:
        status = "Avoid"
        reason = "This food item contains high sugar, which is not suitable for your diabetic condition."

    if user_data['fats_level'] == 'high' and int(food_item['fats']) > 15:
        status = "Avoid"
        reason = "This food item contains high fats, which is not suitable for your health condition."

    if user_data['cholesterol_level'] == 'high' and int(food_item['sodium']) > 100:
        status = "Avoid"
        reason = "This food item contains high sodium, which is not suitable for your cholesterol condition."

    return {
        'food_item': food_item['name'],
        'status': status,
        'reason': reason
    }

# Get the result
result = check_food_suitability(user_data_dict, food_item_dict)

# Output result as JSON for PHP to handle
print(json.dumps(result))
