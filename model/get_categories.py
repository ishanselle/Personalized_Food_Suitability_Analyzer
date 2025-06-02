import mysql.connector
import json

# Database connection
conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",           # Change if your DB has a password
    database="pfsa"
)

cursor = conn.cursor()

# Query to get distinct categories
query = "SELECT DISTINCT category FROM food ORDER BY category"
cursor.execute(query)
results = cursor.fetchall()

# Prepare as HTML <option> elements or JSON
options = '<option value="" disabled selected>Select a category</option>\n'
for row in results:
    category = row[0]
    options += f'<option value="{category}">{category}</option>\n'

# Output the result
print("Content-Type: text/html\n")
print(options)

# Clean up
cursor.close()
conn.close()
