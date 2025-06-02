import pandas as pd # type: ignore
import joblib # type: ignore
from sklearn.preprocessing import LabelEncoder # type: ignore

# Load encoders (used for transforming labels during prediction)
def load_label_encoders(path='models/label_encoders.pkl'):
    return joblib.load(path)

# Encode a single input row using the saved encoders
def preprocess_input(user_food_data, encoders):
    """
    user_food_data should be a dictionary with:
    - category
    - sugar
    - fats
    - saturated_fats
    - trans_fats
    - sodium
    - diabetes_label
    - cholesterol_label
    - hypertension_label
    - allergy_label
    """
    input_df = pd.DataFrame([user_food_data])

    # Apply label encoding for all applicable fields
    for col in ['category', 'diabetes_label', 'cholesterol_label', 'hypertension_label', 'allergy_label']:
        if col in encoders:
            le = encoders[col]
            if input_df[col].iloc[0] in le.classes_:
                input_df[col] = le.transform(input_df[col])
            else:
                # Handle unknown category gracefully
                input_df[col] = le.transform([le.classes_[0]])

    return input_df

# Inverse transform predicted suitability index to label
def decode_prediction(pred_index, encoders):
    le = encoders.get('suitability')
    if le:
        return le.inverse_transform([pred_index])[0]
    return "Unknown"

# Test only (used in standalone scripts)
if __name__ == "__main__":
    encoders = load_label_encoders()

    test_input = {
        'category': 'Snacks',
        'sugar': 120.5,
        'fats': 15.0,
        'saturated_fats': 7.0,
        'trans_fats': 2.0,
        'sodium': 700,
        'diabetes_label': 'Diabetic',
        'cholesterol_label': 'High Cholesterol',
        'hypertension_label': 'Stage 2 Hypertension',
        'allergy_label': 'Severe Allergies'
    }

    processed = preprocess_input(test_input, encoders)
    print(processed)
