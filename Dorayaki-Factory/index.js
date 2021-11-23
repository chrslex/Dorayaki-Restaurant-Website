import express from "express";
import db from "./config/database.js";

const app = express();

try{
    await db.connect();
    console.log("Database Connected");
}catch(err){
    console.error('Conenction error',err);
}
app.get('/', (req,res)=>{
    res.send('Welcome');
})

app.listen(5000, ()=>{
    console.log("Server running successfuly");
})