import pool from "../config/database.js";

let recipe = [];
pool.getConnection((err, conn)=>{
    if(err) throw err;
    let sql = "SELECT bahan_baku, jumlah FROM resep NATURAL JOIN bahan_resep WHERE resep.nama_resep =? "
    conn.query(sql, ["Rasa Pasir"], (err,rows)=>{
        conn.release(); 
        if(err) throw err;
    });
});
console.log(recipe);