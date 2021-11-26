import {useState} from 'react'
import axios from 'axios';
import {useNavigate} from 'react-router-dom'

const Login = () => {
    const [username] = useState('');
    const [password] = useState('');
    const navigate = useNavigate();

    const TryLogin = async(e) =>{
        e.preventDefault();
        await axios.post("http://localhost:5000/login", {
            username : username,
            password : password
        }).then(resp =>{
            if (resp.data.message) {
                navigate('/');
            }
            else console.log(resp);
        });
    }

    return (
        <div class="box">
            <form onSubmit={TryLogin}>
                <h1>Login</h1>
                <input type="text" name="username"  placeholder="Username" class="username" required/>
                <input type="password" name="password" placeholder="Password" class="password" required/>

                <button type="submit" class="btn">Login</button>

                <a href="register.php"><div id="btn2">Sign Up</div></a>
            </form>
        </div>
        // <div>
        //     <form onSubmit = {TambahBahanBaku}>
        //         <div className="field">
        //             <label className="label ml-5">Nama Bahan Baku</label>
        //             <input 
        //                 className="input ml-5" 
        //                 type="text" 
        //                 style={{"width" : "33%"}} 
        //                 placeholder="Nama Bahan Baku"
        //                 value ={namaBahanBaku}
        //                 onChange = {(e) => setNamaBahanBaku(e.target.value) }
        //                 />
        //         </div>

        //         <div className="field">
        //             <label className="label ml-5">Stok</label>
        //             <input 
        //                 className="input ml-5" 
        //                 type="text" 
        //                 style={{"width" : "33%"}} 
        //                 placeholder="Stok"
        //                 value = {stok}
        //                 onChange = {(e) => setStok(e.target.value)}
        //             />
        //         </div>

        //         <div className="field">
        //             <button className="button is-primary ml-5">Add Bahan Baku</button>
        //         </div>
        //     </form>
        // </div>
    )
}

export default Login
