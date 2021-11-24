import pool from "../config/database.js";

export const getAllBahanBaku = async(req,res)=>{
    pool.getConnection((err, conn)=>{
        if(err) res.json({'message' : err.message});
        conn.query('SELECT * FROM bahan_baku', (err,rows)=>{
            conn.release(); 
            if(err) throw err;
            res.json(rows);
        });
    });
}

export const tambahBahanBaku = async(req,res)=>{
    let nama = req.body.bahan_baku;
    let stok = req.body.stok;
    pool.getConnection((err, conn)=>{
        if(err) res.json({'message' : err.message});
        conn.query('INSERT INTO bahan_baku (nama_bahan_baku, stok) VALUES (? ,?)',[nama, stok], (err,rows)=>{
            conn.release(); 
            if(err) throw err;
            res.json(rows);
        });
    });
}

export const updateStok = async(req,res) =>{
    let nama_bahan = req.body.bahan_baku;
    let stokBaru = req.body.stok;
    pool.getConnection((err, conn)=>{
        if(err) res.json({'message' : err.message});
        conn.query('UPDATE bahan_baku SET stok = ? WHERE nama_bahan_baku = ?',[stokBaru, nama_bahan], (err,rows)=>{
            conn.release(); 
            if(err) throw err;
            res.json(rows);
        });
    });
}