import express from "express";
import requestRoutes from "./routes/requestRoutes.js";
import recipeRoutes from './routes/recipesRoutes.js';

const app = express();

app.use('/request', requestRoutes);
app.use('/recipes', recipeRoutes);
app.get('/', (req,res)=>{
    res.send('Welcome');
});

app.listen(5000, ()=>{
    console.log("Server running successfuly");
})