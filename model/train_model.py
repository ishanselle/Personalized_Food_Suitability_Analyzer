import mysql.connector
import pandas as pd # type: ignore
from sklearn.model_selection import train_test_split # type: ignore
from sklearn.tree import DecisionTreeClassifier # type: ignore
from sklearn.preprocessing import LabelEncoder # type: ignore
import joblib # type: ignore

# Step 1: Connect to MySQL Database
def connect_db():
    return mysql.connector.connect(
        host="localhost",
        user="root",
        password="ishan@2001",
        database="pfsa"
    )

# Step 2: Load and prepare data
def load_data():
    conn = connect_db()
    cursor = conn.cursor(dictionary=True)

    query = """
    SELECT category, sugar, fats, saturated_fats, trans_fats, sodium, 
           diabetes_label, cholesterol_label, hypertension_label, allergy_label, 
           suitability 
    FROM training_dataset
    """
    cursor.execute(query)
    records = cursor.fetchall()
    df = pd.DataFrame(records)

    conn.close()
    return df

# Step 3: Encode categorical labels (category, diabetes, cholesterol, etc.)
def preprocess_data(df):
    label_encoders = {}
    categorical_cols = ['category', 'diabetes_label', 'cholesterol_label', 'hypertension_label', 'allergy_label', 'suitability']

    for col in categorical_cols:
        le = LabelEncoder()
        df[col] = le.fit_transform(df[col])
        label_encoders[col] = le

    return df, label_encoders

# Step 4: Train model
def train_model():
    df = load_data()
    df, encoders = preprocess_data(df)

    # Define features and target
    X = df.drop(columns=['suitability'])
    y = df['suitability']

    # Split into training/test sets
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

    # Use Decision Tree Classifier (suitable for logic-based classification)
    clf = DecisionTreeClassifier(max_depth=5, random_state=42)
    clf.fit(X_train, y_train)

    # Save model and encoders
    joblib.dump(clf, 'models/food_suitability_model.pkl')
    joblib.dump(encoders, 'models/label_encoders.pkl')

    print("✅ Model training complete and saved as 'food_suitability_model.pkl'")

if __name__ == "__main__":
    train_model()
