# Initialize and expose key service classes for easier imports
from .db_service import DatabaseService
from .food_service import FoodService
from .user_service import UserService
from .ml_model_service import MLModelService
from .recommendation_service import RecommendationService
from .nlp_service import NLPService

__all__ = [
    "DatabaseService",
    "FoodService",
    "UserService",
    "MLModelService",
    "RecommendationService",
    "NLPService"
]
