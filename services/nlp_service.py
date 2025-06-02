import re
from typing import List, Dict

# Sample allergen keywords you might want to detect
ALLERGEN_KEYWORDS = [
    'peanut', 'tree nut', 'milk', 'egg', 'wheat', 'soy', 'fish', 'shellfish', 'gluten', 'sesame'
]

def extract_allergens(food_description: str) -> List[str]:
    """
    Extract allergens mentioned in the food description.
    Case-insensitive search for known allergen keywords.
    """
    allergens_found = []
    description_lower = food_description.lower()

    for allergen in ALLERGEN_KEYWORDS:
        # Simple keyword search; can be enhanced with NLP models
        if re.search(r'\b' + re.escape(allergen) + r'\b', description_lower):
            allergens_found.append(allergen)

    return allergens_found

def extract_ingredients(food_description: str) -> List[str]:
    """
    Extract ingredients from a food description string.
    This example assumes ingredients are comma-separated or listed after a keyword 'Ingredients:'.
    """
    ingredients = []

    # Look for an 'Ingredients:' section, e.g. "Ingredients: sugar, milk, cocoa..."
    match = re.search(r'ingredients?:\s*([^\.]+)', food_description, re.IGNORECASE)
    if match:
        ingredients_str = match.group(1)
        # Split by commas and strip whitespace
        ingredients = [ing.strip() for ing in ingredients_str.split(',') if ing.strip()]
    else:
        # Fallback: try splitting the whole description by commas (less precise)
        ingredients = [part.strip() for part in food_description.split(',') if part.strip()]

    return ingredients

def analyze_food_text(food_description: str) -> Dict[str, List[str]]:
    """
    Combined NLP analysis of food description to extract allergens and ingredients.
    """
    allergens = extract_allergens(food_description)
    ingredients = extract_ingredients(food_description)
    return {
        'allergens': allergens,
        'ingredients': ingredients
    }
