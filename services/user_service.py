import mysql.connector
import html

# Database configuration (adjust if needed)
DB_CONFIG = {
    'host': 'localhost',
    'user': 'root',
    'password': 'ishan@2001',
    'database': 'pfsa'
}

def get_db_connection():
    """Create and return a new database connection."""
    return mysql.connector.connect(**DB_CONFIG)

def fetch_user_profile(user_id):
    """
    Fetch user profile details from the database by user_id.
    """
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    query = "SELECT * FROM user_profiles WHERE user_id = %s"
    cursor.execute(query, (user_id,))
    user = cursor.fetchone()
    cursor.close()
    conn.close()

    if not user:
        return None

    # Sanitize output
    sanitized_user = {k: html.escape(str(v)) if isinstance(v, str) else v for k, v in user.items()}
    return sanitized_user

def create_user_profile(user_data):
    """
    Insert a new user profile into the database.
    user_data is a dictionary containing keys like:
    fullname, age, gender, weight, diabetes, cholesterol, hypertension,
    heart_condition, allergy_severity, sugarLevel, sodiumLevel, fatsLevel
    """
    conn = get_db_connection()
    cursor = conn.cursor()

    query = """
    INSERT INTO user_profiles 
    (fullname, age, gender, weight, diabetes, cholesterol, hypertension, heart_condition, allergy_severity, sugarLevel, sodiumLevel, fatsLevel)
    VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
    """
    values = (
        user_data.get('fullname'),
        user_data.get('age'),
        user_data.get('gender'),
        user_data.get('weight'),
        user_data.get('diabetes'),
        user_data.get('cholesterol'),
        user_data.get('hypertension'),
        user_data.get('heart_condition'),
        user_data.get('allergy_severity'),
        user_data.get('sugarLevel'),
        user_data.get('sodiumLevel'),
        user_data.get('fatsLevel')
    )

    cursor.execute(query, values)
    conn.commit()
    user_id = cursor.lastrowid

    cursor.close()
    conn.close()

    return user_id

def update_user_profile(user_id, updated_data):
    """
    Update existing user profile details.
    updated_data is a dictionary with keys to update.
    """
    conn = get_db_connection()
    cursor = conn.cursor()

    # Build query dynamically based on updated_data keys
    set_clause = ", ".join([f"{k} = %s" for k in updated_data.keys()])
    values = list(updated_data.values())
    values.append(user_id)

    query = f"UPDATE user_profiles SET {set_clause} WHERE user_id = %s"

    cursor.execute(query, values)
    conn.commit()
    cursor.close()
    conn.close()

    return cursor.rowcount  # Number of affected rows

def delete_user_profile(user_id):
    """
    Delete a user profile from the database by user_id.
    """
    conn = get_db_connection()
    cursor = conn.cursor()
    query = "DELETE FROM user_profiles WHERE user_id = %s"
    cursor.execute(query, (user_id,))
    conn.commit()
    cursor.close()
    conn.close()

    return cursor.rowcount

