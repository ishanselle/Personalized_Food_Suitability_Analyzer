from flask import Flask, request, jsonify
import mysql.connector
from mysql.connector import Error
import html

app = Flask(__name__)

# Database configuration
db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': 'ishan@2001',
    'database': 'pfsa'
}

@app.route('/get_food_details', methods=['GET'])
def get_food_details():
    food_id = request.args.get('id', default=0, type=int)
    
    try:
        connection = mysql.connector.connect(**db_config)
        if connection.is_connected():
            cursor = connection.cursor(dictionary=True)
            query = "SELECT * FROM food WHERE food_id = %s"
            cursor.execute(query, (food_id,))
            result = cursor.fetchone()
            
            if result:
                # Sanitize all output like PHP htmlspecialchars()
                sanitized_result = {k: html.escape(str(v)) for k, v in result.items()}
                return jsonify(sanitized_result)
            else:
                return jsonify({'error': 'Food item not found'}), 404
    
    except Error as e:
        return jsonify({'error': f'Database connection failed: {e}'}), 500
    
    finally:
        if connection.is_connected():
            cursor.close()
            connection.close()

if __name__ == '__main__':
    app.run(debug=True)
