# routes/main_routes.py

from flask import Blueprint, request, jsonify, render_template
from model import (
    get_categories,
    get_food_items_by_category,
    get_food_details,
    generate_health_report,
    get_recommendations,
    preprocess_input,
    load_label_encoders,
    decode_prediction
)

main_routes = Blueprint('main_routes', __name__)

# Route: Homepage (index)
@main_routes.route('/')
def index():
    categories = get_categories()
    return render_template("index.html", categories=categories)

# Route: Fetch food items for a category (AJAX)
@main_routes.route('/get_food_items', methods=['POST'])
def fetch_food_items():
    category = request.form.get('category')
    items = get_food_items_by_category(category)
    return jsonify(items)

# Route: Fetch detailed food info
@main_routes.route('/get_food_details', methods=['GET'])
def fetch_food_details():
    food_id = request.args.get('id', type=int)
    food = get_food_details(food_id)
    return jsonify(food)

# Route: Analyze food suitability and generate report
@main_routes.route('/analyze_food', methods=['POST'])
def analyze_food():
    user_data = {
        "fullname": request.form.get("fullname"),
        "age": request.form.get("Age"),
        "gender": request.form.get("Gender"),
        "weight": request.form.get("weight"),
        "diabetes": request.form.get("diabetes"),
        "cholesterol": request.form.get("cholesterol"),
        "hypertension": request.form.get("hypertension"),
        "heart_condition": request.form.get("heart_condition"),
        "allergy_severity": request.form.get("allergy_severity"),
        "sugarLevel": request.form.get("sugarLevel"),
        "sodiumLevel": request.form.get("sodiumLevel"),
        "fatsLevel": request.form.get("fatsLevel")
    }

    food_id = int(request.form.get("Food_Item_Name"))
    food_details = get_food_details(food_id)

    if not food_details:
        return jsonify({"error": "Food item not found"}), 404

    report = generate_health_report(user_data, food_details)
    recommendations = get_recommendations(user_data, food_details['category'], food_id)

    return render_template("report.html", report=report, food=food_details, recommendations=recommendations)

# Route: JSON API for direct ML model prediction (optional)
@main_routes.route('/predict_suitability', methods=['POST'])
def predict_suitability():
    input_data = request.json
    if not input_data:
        return jsonify({'error': 'No input data received'}), 400

    # Preprocess input and load model/encoders
    features, _ = preprocess_input(input_data)
    model, label_encoders = load_label_encoders()
    prediction = model.predict([features])[0]
    suitability = decode_prediction(prediction)

    return jsonify({"suitability": suitability})
