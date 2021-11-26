import express from "express";
import requestRoutes from "./routes/requestRoutes.js";
import recipeRoutes from './routes/recipesRoutes.js';
import stocksRoutes from './routes/stocksRoutes.js';
import cors from "cors";
import jwtpkg from "jsonwebtoken"
import "dotenv/config.js"

const posts = [
    {
        username: 'Tim',
        title: 'Post 1'
    }
]
const app = express();
const jwt = jwtpkg;
app.use(cors());
app.use(express.json());

app.use('/request', requestRoutes);
app.use('/recipes', recipeRoutes);
app.use('/stok', stocksRoutes);

app.get('/', (req,res)=>{
    res.send('Welcome');
});

app.get('/posts', authenticateToken, (req,res) =>{
    res.json(posts.filter(post => post.username === req.user.name))
})

app.post('/login', (req,res)=>{
    //authentication
    const username = req.body.username
    const user = { name: username}
    const accessToken = generateAccessToken(user)
    const refreshToken = jwt.sign(user, process.env.REFRESH_TOKEN_SECRET)
    refreshToken.push
    res.json({accessToken: accessToken, refreshToken: refreshToken})

})

app.post('/token', (req,res)=>{
    const refreshToken = req.body.token
    if (refreshToken == null) {
        return res.sendStatus(401)
    }
    if (!refreshToken.includes(refreshToken)) {
        return res.sendStatus(403)
    }
    jwt.verify(refreshToken, process.env.REFRESH_TOKEN_SECRET, (err,user) => {
        if(err) return res.sendStatus(403)
        const accessToken = generateAccessToken({ name: user.name})
        res.json({ accessToken:accessToken })
    })
})

app.listen(5000, ()=>{
    console.log("Server running successfuly");
})

function authenticateToken(req, res, next){
    const authHeader = req.headers['authorization']
    const token = authHeader && authHeader.split('')[1]
    if (token == null) {return res.sendStatus(401)}
    jwt.verify(token, process.env.ACCESS_TOKEN_SECRET, (err,user) => {
        if (err) return res.sendStatus(403)
        req.user = user
        next()
    })
}

function generateAccessToken(user) {
    return jwt.sign(user, process.env.ACCESS_TOKEN_SECRET, { expiresIn: '1m'})
}