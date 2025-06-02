from flask import Blueprint

# Create a blueprint for all routes
routes = Blueprint('routes', __name__)

# Import individual route modules
from .main_routes import main_routes
from .profile_routes import profile_routes
from .analysis_routes import analysis_routes
from .admin_routes import admin_routes

# Register blueprints from individual modules
def register_routes(app):
    app.register_blueprint(main_routes)
    app.register_blueprint(profile_routes)
    app.register_blueprint(analysis_routes)
    app.register_blueprint(admin_routes)
