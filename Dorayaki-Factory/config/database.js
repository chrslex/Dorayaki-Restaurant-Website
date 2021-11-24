import mysql from 'mysql2';

const pool = mysql.createPool({
    host: 'localhost',
    user: 'root',
    password : 'admin',
    database : 'dorayaki_factory'
});

export default pool;