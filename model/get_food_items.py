from flask import Flask, request
import mysql.connector
from mysql.connector import Error
import html

app = Flask(__name__)

db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': 'ishan@2001',
    'database': 'pfsa'
}

@app.route('/get_food_items', methods=['POST'])
def get_food_items():
    category = request.form.get('category', '')

    if not category:
        return "No category provided", 400

    try:
        connection = mysql.connector.connect(**db_config)
        cursor = connection.cursor(dictionary=True)
        query = "SELECT food_id, food_name FROM food WHERE category = %s ORDER BY food_name"
        cursor.execute(query, (category,))
        results = cursor.fetchall()

        options = '<option value="" disabled selected>Select a food item</option>'
        for row in results:
            food_id = html.escape(str(row['food_id']))
            food_name = html.escape(row['food_name'])
            options += f'<option value="{food_id}">{food_name}</option>'

        return options

    except Error as e:
        return f"Database error: {e}", 500

    finally:
        if connection.is_connected():
            cursor.close()
            connection.close()

if __name__ == '__main__':
    app.run(debug=True)
