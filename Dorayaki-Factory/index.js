import express from "express";
import requestRoutes from "./routes/requestRoutes.js";
import recipeRoutes from './routes/recipesRoutes.js';
import ingredientsRoutes from './routes/ingredientsRoutes.js';

const app = express();
app.use(express.json());

app.use('/request', requestRoutes);
app.use('/recipes', recipeRoutes);
app.use('/ingredients', ingredientsRoutes);

app.get('/', (req,res)=>{
    res.send('Welcome');
});

app.listen(5000, ()=>{
    console.log("Server running successfuly");
})