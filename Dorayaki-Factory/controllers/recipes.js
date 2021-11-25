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
        let sql = "SELECT nama_resep, bahan_baku, jumlah FROM resep NATURAL JOIN bahan_resep WHERE id_resep =? "
        conn.query(sql, [id], (err,rows)=>{
            conn.release(); 
            if(err) throw err;
            res.json(rows);
        });
    });
}

export const createRecipes = async (req,res) =>{
    pool.getConnection((err, conn)=>{
        if(err) res.json({'message' : err.message});
        const nama_resep = req.body.nama_resep;
        let sql = "INSERT INTO resep (nama_resep) VALUES (?)"
        conn.query(sql, [nama_resep], (err,rows)=>{
            conn.release(); 
            if(err) throw err;
            res.json(rows);
        });
    });
};

export const createIngredientForRecipes = async (req,res) =>{
    pool.getConnection((err, conn)=>{
        if(err) res.json({'message' : err.message});
        const id = req.params.id;
        const bahan_baku = req.body.bahan_baku;
        const jumlah = req.body.jumlah;
        let sql = "INSERT INTO bahan_resep (id_resep, bahan_baku, jumlah) VALUES (?,?,?)"
        conn.query(sql, [id,bahan_baku, jumlah], (err,rows)=>{
            conn.release(); 
            if(err) throw err;
            res.json(rows);
        });
    });
}

export const deleteIngredientForRecipes = async (req,res) =>{
    pool.getConnection((err, conn)=>{
        if(err) res.json({'message' : err.message});
        const id = req.params.id;
        const bahan_baku = req.params.bahan_baku;
        let sql = "DELETE FROM bahan_resep WHERE id_resep = ? and bahan_baku = ? "
        conn.query(sql, [id,bahan_baku], (err,rows)=>{
            conn.release(); 
            if(err) throw err;
            res.json(rows);
        });
    });
}