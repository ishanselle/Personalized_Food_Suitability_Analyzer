import mysql.connector
from mysql.connector import Error
from typing import Optional, List, Dict, Any

class DatabaseService:
    def __init__(self, host: str, user: str, password: str, database: str):
        self.host = host
        self.user = user
        self.password = password
        self.database = database
        self.connection = None

    def connect(self):
        """
        Establish a database connection.
        """
        try:
            self.connection = mysql.connector.connect(
                host=self.host,
                user=self.user,
                password=self.password,
                database=self.database,
                charset='utf8mb4'
            )
        except Error as e:
            print(f"Error connecting to database: {e}")
            self.connection = None

    def close(self):
        """
        Close the database connection.
        """
        if self.connection and self.connection.is_connected():
            self.connection.close()

    def fetch_one(self, query: str, params: Optional[tuple] = None) -> Optional[Dict[str, Any]]:
        """
        Execute a query and fetch a single record as a dict.
        """
        if not self.connection or not self.connection.is_connected():
            self.connect()
        cursor = self.connection.cursor(dictionary=True)
        cursor.execute(query, params or ())
        result = cursor.fetchone()
        cursor.close()
        return result

    def fetch_all(self, query: str, params: Optional[tuple] = None) -> List[Dict[str, Any]]:
        """
        Execute a query and fetch all records as a list of dicts.
        """
        if not self.connection or not self.connection.is_connected():
            self.connect()
        cursor = self.connection.cursor(dictionary=True)
        cursor.execute(query, params or ())
        results = cursor.fetchall()
        cursor.close()
        return results

    def execute(self, query: str, params: Optional[tuple] = None) -> bool:
        """
        Execute a query that modifies data (INSERT, UPDATE, DELETE).
        Returns True if successful, False otherwise.
        """
        if not self.connection or not self.connection.is_connected():
            self.connect()
        cursor = self.connection.cursor()
        try:
            cursor.execute(query, params or ())
            self.connection.commit()
            success = True
        except Error as e:
            print(f"Database execution error: {e}")
            self.connection.rollback()
            success = False
        finally:
            cursor.close()
        return success
