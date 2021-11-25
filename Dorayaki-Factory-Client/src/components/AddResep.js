import {useState} from 'react'
import axios from 'axios';
import {useNavigate} from 'react-router-dom'

const AddResep = () => {
    const [namaResep, setNamaResep] = useState('');
    const navigate = useNavigate();
    
    const tambahResep = async (e) =>{
        e.preventDefault();
        await axios.post("http://localhost:5000/recipes/create", {
            nama_resep : namaResep
        });
        navigate('/recipes');
    }
    return (
        <div>
            <form onSubmit= {tambahResep}>
                <div className="field mt-5">
                    <label className="label ml-5">Nama Resep</label>
                    <input 
                        className="input ml-5" 
                        type="text" 
                        style={{"width" : "33%"}} 
                        placeholder="Nama Resep"
                        value ={namaResep}
                        onChange = {(e) => setNamaResep(e.target.value) }
                        />
                </div>

                <div className="field">
                    <button className="button is-primary ml-5">Add Resep</button>
                </div>
            </form>
        </div>
    )
}

export default AddResep;
