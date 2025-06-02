# routes/admin_routes.py

from flask import Blueprint, request, render_template, redirect, url_for, flash
from model import get_all_food_items, get_food_details, add_food_item, update_food_item, delete_food_item

admin_routes = Blueprint('admin_routes', __name__, url_prefix='/admin')

# Admin dashboard - list all food items
@admin_routes.route('/')
def admin_dashboard():
    food_items = get_all_food_items()
    return render_template('admin/dashboard.html', food_items=food_items)

# View a specific food item for editing
@admin_routes.route('/food/<int:food_id>')
def view_food(food_id):
    food = get_food_details(food_id)
    if not food:
        flash("Food item not found", "danger")
        return redirect(url_for('admin_routes.admin_dashboard'))
    return render_template('admin/edit_food.html', food=food)

# Add new food item - display form
@admin_routes.route('/food/add', methods=['GET'])
def add_food_form():
    return render_template('admin/add_food.html')

# Add new food item - process form submission
@admin_routes.route('/food/add', methods=['POST'])
def add_food():
    data = request.form.to_dict()
    success, msg = add_food_item(data)
    if success:
        flash("Food item added successfully", "success")
        return redirect(url_for('admin_routes.admin_dashboard'))
    else:
        flash(f"Error adding food item: {msg}", "danger")
        return redirect(url_for('admin_routes.add_food_form'))

# Update existing food item
@admin_routes.route('/food/update/<int:food_id>', methods=['POST'])
def update_food(food_id):
    data = request.form.to_dict()
    success, msg = update_food_item(food_id, data)
    if success:
        flash("Food item updated successfully", "success")
    else:
        flash(f"Error updating food item: {msg}", "danger")
    return redirect(url_for('admin_routes.view_food', food_id=food_id))

# Delete a food item
@admin_routes.route('/food/delete/<int:food_id>', methods=['POST'])
def delete_food(food_id):
    success, msg = delete_food_item(food_id)
    if success:
        flash("Food item deleted successfully", "success")
    else:
        flash(f"Error deleting food item: {msg}", "danger")
    return redirect(url_for('admin_routes.admin_dashboard'))
