import os
import pickle
import mysql.connector
import numpy as np # type: ignore
from sklearn.ensemble import RandomForestClassifier  # type: ignore # Example ML model
from sklearn.model_selection import train_test_split # type: ignore
from sklearn.preprocessing import StandardScaler # type: ignore

# Database config
DB_CONFIG = {
    'host': 'localhost',
    'user': 'root',
    'password': 'ishan@2001',
    'database': 'pfsa'
}

MODEL_PATH = 'models/food_suitability_model.pkl'
SCALER_PATH = 'models/scaler.pkl'

def get_db_connection():
    return mysql.connector.connect(**DB_CONFIG)

def load_model():
    """Load the trained ML model from disk."""
    if os.path.exists(MODEL_PATH):
        with open(MODEL_PATH, 'rb') as f:
            model = pickle.load(f)
        return model
    else:
        return None

def save_model(model):
    """Save the trained ML model to disk."""
    os.makedirs(os.path.dirname(MODEL_PATH), exist_ok=True)
    with open(MODEL_PATH, 'wb') as f:
        pickle.dump(model, f)

def load_scaler():
    """Load the scaler from disk."""
    if os.path.exists(SCALER_PATH):
        with open(SCALER_PATH, 'rb') as f:
            scaler = pickle.load(f)
        return scaler
    else:
        return None

def save_scaler(scaler):
    """Save the scaler to disk."""
    os.makedirs(os.path.dirname(SCALER_PATH), exist_ok=True)
    with open(SCALER_PATH, 'wb') as f:
        pickle.dump(scaler, f)

def fetch_training_data():
    """
    Fetch features and labels from the database for training.
    Assumes you have a 'food_features' table with columns for
    features and a target column 'suitability_label' (0/1 or classes).
    """
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    query = """
        SELECT sugar, fats, saturated_fats, trans_fats, sodium, calories, suitability_label
        FROM food_features
        WHERE suitability_label IS NOT NULL
    """
    cursor.execute(query)
    data = cursor.fetchall()
    cursor.close()
    conn.close()

    if not data:
        return None, None

    X = []
    y = []
    for row in data:
        features = [row['sugar'], row['fats'], row['saturated_fats'], row['trans_fats'], row['sodium'], row['calories']]
        X.append(features)
        y.append(row['suitability_label'])

    return np.array(X), np.array(y)

def train_model():
    """Train the ML model and save it."""
    X, y = fetch_training_data()
    if X is None or y is None:
        raise ValueError("No training data found.")

    # Split data
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

    # Feature scaling
    scaler = StandardScaler()
    X_train_scaled = scaler.fit_transform(X_train)
    X_test_scaled = scaler.transform(X_test)

    # Train classifier
    model = RandomForestClassifier(n_estimators=100, random_state=42)
    model.fit(X_train_scaled, y_train)

    # Save scaler and model
    save_scaler(scaler)
    save_model(model)

    # Optionally, return test accuracy
    test_accuracy = model.score(X_test_scaled, y_test)
    return test_accuracy

def predict_suitability(features):
    """
    Predict suitability using the trained model.
    Features should be a list or numpy array in order:
    [sugar, fats, saturated_fats, trans_fats, sodium, calories]
    """
    model = load_model()
    scaler = load_scaler()

    if model is None or scaler is None:
        raise ValueError("Model or scaler not found. Train the model first.")

    features_array = np.array(features).reshape(1, -1)
    features_scaled = scaler.transform(features_array)
    prediction = model.predict(features_scaled)
    prediction_proba = model.predict_proba(features_scaled)

    return int(prediction[0]), prediction_proba[0].tolist()
