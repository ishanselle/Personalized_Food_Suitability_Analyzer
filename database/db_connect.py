import mysql.connector
from mysql.connector import Error

def get_db_connection():
    try:
        connection = mysql.connector.connect(
            host='localhost',    # Change if needed
            user='root',         # Change your database username
            password='ishan@2001',  # Change your database password
            database='pfsa'      # Change to your actual database name
        )
        if connection.is_connected():
            return connection
    except Error as e:
        print(f"Error while connecting to MySQL: {e}")
        return None
