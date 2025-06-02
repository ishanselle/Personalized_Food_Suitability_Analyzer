# routes/profile_routes.py

from flask import Blueprint, request, render_template, redirect, url_for, jsonify
from model import get_categories, get_food_items_by_category

profile_routes = Blueprint('profile_routes', __name__)

# Route: Display health profile form
@profile_routes.route('/health-profile', methods=['GET'])
def health_profile_form():
    categories = get_categories()
    return render_template("Health_Profile_Form.html", categories=categories)

# Route: Fetch food items based on selected category (AJAX)
@profile_routes.route('/fetch-food-items', methods=['POST'])
def fetch_food_items_for_profile():
    category = request.form.get('category')
    if not category:
        return jsonify({"error": "Category not provided"}), 400
    food_items = get_food_items_by_category(category)
    return jsonify(food_items)

# Route: Redirect POST form submission to analysis
@profile_routes.route('/submit-profile', methods=['POST'])
def submit_health_profile():
    # This will redirect to the analyze_food route in main_routes
    return redirect(url_for('main_routes.analyze_food'))
