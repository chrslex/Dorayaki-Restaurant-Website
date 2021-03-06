import { json } from "express";
import pool from "../config/database.js";

export const getAllRequest = async(req,res)=>{
    pool.getConnection((err, conn)=>{
        if(err) res.json({'message' : err.message});
        conn.query('SELECT * FROM request_toko WHERE status = ?', [-1],(err,rows)=>{
            conn.release(); 
            if(err) throw err;
            res.json(rows);
        });
    });
}
export const acceptRequest = async (req,res) => {
    const id = req.params.id;
    const nama_varian = req.params.nama_varian
    // Untuk accept request
    pool.getConnection((err, conn)=>{
        if(err) throw err;
        let sql = "UPDATE request_toko SET status =? WHERE id_request =?"
        conn.query(sql, [1, id], (err,rows)=>{
            conn.release(); 
            if(err) throw err;
        });
    });

    // 
    // Untuk ngurangin bahan baku sesuai resep dorayaki yang di request oleh toko
    // Dapetin resep
    pool.getConnection((err, conn)=>{
        if(err) throw err;
        let sql = "SELECT bahan_baku, jumlah FROM resep NATURAL JOIN bahan_resep WHERE resep.nama_resep =? "
        conn.query(sql, [nama_varian], (err,rows)=>{
            conn.release(); 
            if(err) throw err;
            rows.forEach((r)=>{
                let bahan_baku = r.bahan_baku;
                let jumlah = r.jumlah;
                pool.getConnection((err, conn)=>{
                    if(err) throw err;
                    let sql = "UPDATE bahan_baku SET stok = stok -? WHERE nama_bahan_baku =?"
                    conn.query(sql, [jumlah, bahan_baku], (err,rows)=>{
                        conn.release(); 
                        if(err) throw err;
                    });
                });
        
            })
        });
    });
    // Iterate setiap bahan baku di resep untuk dikurangin
}

export const declineRequest = (req,res) => {
    const id = req.params.id
    pool.getConnection((err, conn)=>{
        if(err) throw err;
        let sql = "UPDATE request_toko SET status =? WHERE id_request =?"
        conn.query(sql, [0, id], (err,rows)=>{
            conn.release(); 
            if(err) throw err;
            res.json(rows);
        });
    });
}

export const getRequestByIP = (req,res) => {
    const ip = req.params.ip
    pool.getConnection((err, conn)=>{
        if(err) throw err;
        let sql = "SELECT * FROM request_toko WHERE ip = ?"
        conn.query(sql, [ip], (err,rows)=>{
            conn.release(); 
            if(err) throw err;
            res.json(rows);
        });
    });
}

export const addRequest = (req,res) => {
    const ip = req.body.ip;
    const varian = req.body.varian;
    const jumlah_penambahan = req.body.jumlah_penambahan

    pool.getConnection((err, conn)=>{
        if(err) throw err;
        let sql = 'INSERT INTO request_toko (varian,jumlah_penambahan,status,ip) VALUES (? ,?,?,?)'
        conn.query(sql, [varian, jumlah_penambahan, -1, ip], (err,rows)=>{
            conn.release(); 
            if(err) throw err;
            res.json(rows);
        });
    });
}