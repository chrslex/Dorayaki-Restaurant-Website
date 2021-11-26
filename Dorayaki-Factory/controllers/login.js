import pool from "../config/database.js";

export const verify = async(req,res)=> {
    pool.getConnection((err,conn)=>{
        if (err) res.json({'message' : err.message});
        const username = req.param.username
        const password = req.param.password
        let query = "SELECT username, passwd, is_admin FROM account WHERE username=?"
        conn.query(query, [username], (err,rows)=>{
            conn.release()
            if(err) throw err;
            if (rows['passwd'] == password) {
                res.json(true)
            }
            else{
                res.json(false)
                console.log(false)
            }
        })
    })
}