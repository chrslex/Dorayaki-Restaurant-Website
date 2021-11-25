import express from "express";
import requestRoutes from "./routes/requestRoutes.js";
import recipeRoutes from './routes/recipesRoutes.js';
import stocksRoutes from './routes/stocksRoutes.js';
import cors from "cors";

const app = express();
app.use(cors());
app.use(express.json());

app.use('/request', requestRoutes);
app.use('/recipes', recipeRoutes);
app.use('/stok', stocksRoutes);

app.get('/', (req,res)=>{
    res.send('Welcome');
});

app.listen(5000, ()=>{
    console.log("Server running successfuly");
})