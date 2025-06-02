# routes/analysis_routes.py

from flask import Blueprint, request, render_template, redirect, url_for
from model import get_food_details, analyze_suitability, get_recommendations

analysis_routes = Blueprint('analysis_routes', __name__)

@analysis_routes.route('/analyze', methods=['POST'])
def analyze_food():
    if not request.form.get("Food_Item_Name"):
        return redirect(url_for("profile_routes.health_profile_form", error="no_food_selected"))

    food_id = int(request.form["Food_Item_Name"])

    user_health_data = {
        'fullname': request.form.get("fullname", ""),
        'age': request.form.get("Age", ""),
        'gender': request.form.get("Gender", ""),
        'weight': request.form.get("weight", ""),
        'diabetes': request.form.get("diabetes", ""),
        'cholesterol': request.form.get("cholesterol", ""),
        'hypertension': request.form.get("hypertension", ""),
        'heart_condition': request.form.get("heart_condition", ""),
        'allergy_severity': request.form.get("allergy_severity", ""),
        'sugarLevel': request.form.get("sugarLevel", ""),
        'sodiumLevel': request.form.get("sodiumLevel", ""),
        'fatsLevel': request.form.get("fatsLevel", "")
    }

    food = get_food_details(food_id)
    if not food:
        return redirect(url_for("profile_routes.health_profile_form", error="food_not_found"))

    analysis_result = analyze_suitability(food, user_health_data)
    recommendations = get_recommendations(food, user_health_data)

    return render_template("Health_Report.html",
                           user=user_health_data,
                           food=food,
                           result=analysis_result,
                           recommendations=recommendations)
