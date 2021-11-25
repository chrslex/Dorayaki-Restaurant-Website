import {useState, useEffect} from 'react'
import axios from 'axios';
import {useNavigate, useParams} from 'react-router-dom'

const EditBahanBaku = () => {
    const [namaBahanBaku, setNamaBahanBaku] = useState('');
    const [stok, setStok] = useState('');
    const navigate = useNavigate();
    const {nama_bahan_baku} = useParams();

    const EditBahanBaku = async(e) =>{
        e.preventDefault();
        await axios.post("http://localhost:5000/stok/updateStok", {
            bahan_baku : namaBahanBaku,
            stok : stok
        });
        navigate('/stok');
    }

    const getBahanBakubyId = async () => {
        const res = await axios.get(`http://localhost:5000/stok/${nama_bahan_baku}`);
        setNamaBahanBaku(res.data[0].nama_bahan_baku);
        setStok(res.data[0].stok);
    };

    useEffect(()=>{
        getBahanBakubyId();
    }, []);

    

    return (
        <div>
            <form onSubmit = {EditBahanBaku}>
                <div className="field">
                    <label className="label ml-5">Nama Bahan Baku</label>
                    <input 
                        className="input ml-5" 
                        type="text" 
                        style={{"width" : "33%"}} 
                        placeholder="Nama Bahan Baku"
                        value = {namaBahanBaku}
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
                    <button className="button is-primary ml-5">Update Bahan Baku</button>
                </div>
            </form>
        </div>
    )
}

export default EditBahanBaku;
