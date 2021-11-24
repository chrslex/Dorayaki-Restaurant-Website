import pool from "../config/database.js";

export const getAllRecipes = async(req,res)=>{
    pool.getConnection((err, conn)=>{
        if(err) res.json({'message' : err.message});
        conn.query('SELECT * FROM resep', (err,rows)=>{
            conn.release(); 
            if(err) throw err;
            res.json(rows);
        });
    });
}

export const getRecipesById = async(req,res)=>{
    pool.getConnection((err, conn)=>{
        if(err) res.json({'message' : err.message});
        const id = req.params.id
        let sql = "SELECT bahan_baku, jumlah FROM resep NATURAL JOIN bahan_resep WHERE id_resep =? "
        conn.query(sql, [id], (err,rows)=>{
            conn.release(); 
            if(err) throw err;
            res.json(rows);
        });
    });
}