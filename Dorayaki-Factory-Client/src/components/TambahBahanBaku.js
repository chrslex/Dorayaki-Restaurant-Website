import {useState} from 'react'
import axios from 'axios';
import {useNavigate} from 'react-router-dom'

const TambahBahanBaku = () => {
    const [namaBahanBaku, setNamaBahanBaku] = useState('');
    const [stok, setStok] = useState('');
    const navigate = useNavigate();

    const TambahBahanBaku = async(e) =>{
        e.preventDefault();
        await axios.post("http://localhost:5000/stok/add", {
            bahan_baku : namaBahanBaku,
            stok :stok
        });
        navigate('/stok');
    }

    return (
        <div>
            <form onSubmit = {TambahBahanBaku}>
                <div className="field">
                    <label className="label ml-5">Nama Bahan Baku</label>
                    <input 
                        className="input ml-5" 
                        type="text" 
                        style={{"width" : "33%"}} 
                        placeholder="Nama Bahan Baku"
                        value ={namaBahanBaku}
                        onChange = {(e) => setNamaBahanBaku(e.target.value) }
                        />
                </div>

                <div className="field">
                    <label className="label ml-5">Stok</label>
                    <input 
                        className="input ml-5" 
                        type="text" 
                        style={{"width" : "33%"}} 
                        placeholder="Stok"
                        value = {stok}
                        onChange = {(e) => setStok(e.target.value)}
                    />
                </div>

                <div className="field">
                    <button className="button is-primary ml-5">Add Bahan Baku</button>
                </div>
            </form>
        </div>
    )
}

export default TambahBahanBaku
