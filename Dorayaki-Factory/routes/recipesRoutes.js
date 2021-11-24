import express from "express";
import {
    getAllRecipes,
    getRecipesById
} from '../controllers/recipes.js'

const router = express.Router();

router.get('/', getAllRecipes);
router.get('/:id', getRecipesById);

export default router;