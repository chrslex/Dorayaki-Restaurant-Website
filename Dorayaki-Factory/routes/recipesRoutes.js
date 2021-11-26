import express from "express";
import {
    getAllRecipes,
    getRecipesById, 
    createRecipes,
    createIngredientForRecipes,
    deleteIngredientForRecipes
} from '../controllers/recipes.js'

const router = express.Router();

router.get('/', getAllRecipes);
router.get('/:id', getRecipesById);
router.post('/create', createRecipes);
router.post('/ingredients/:id', createIngredientForRecipes);
router.delete('/ingredients/:id/:bahan_baku', deleteIngredientForRecipes);

export default router;