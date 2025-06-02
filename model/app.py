from flask import Flask
from flask_cors import CORS # type: ignore

# Importing route blueprints
from routes.main_routes import main_bp
from routes.profile_routes import profile_bp
from routes.analysis_routes import analysis_bp
from routes.admin_routes import admin_bp

# Initialize Flask app
app = Flask(__name__)
app.config['SECRET_KEY'] = 'supersecretkey'  # Replace with a secure value in production

# Enable CORS
CORS(app)

# Register Blueprints
app.register_blueprint(main_bp)
app.register_blueprint(profile_bp, url_prefix='/profile')
app.register_blueprint(analysis_bp, url_prefix='/analysis')
app.register_blueprint(admin_bp, url_prefix='/admin')

# Root route
@app.route('/')
def home():
    return {'message': 'Welcome to the Personalized Food Suitability Analyzer API'}

# Run the application
if __name__ == '__main__':
    app.run(debug=True)
