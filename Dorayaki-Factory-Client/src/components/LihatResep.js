import { useState, useEffect } from 'react'
import axios from 'axios';
import {useNavigate, useParams} from 'react-router-dom'

const LihatResep = () => {
    const [resep, setResep] = useState([]);
    const[namaResep, setNamaResep] = useState("");

    const[bahanBaru, setBahanBaru] = useState("");
    const[jumlahBaru, setJumlahBaru] = useState("");
    const {id} = useParams();

    useEffect(()=>{
        getResepById();
    }, []);
    const getResepById = async() =>{
        const res = await axios.get(`http://localhost:5000/recipes/${id}`);
        setResep(res.data);
        if(res.data.length > 0){
        setNamaResep(res.data[0].nama_resep);
        }
    }

    const deleteBahanResep = async (id, bahan_baku)=>{
        await axios.delete(`http://localhost:5000/recipes/ingredients/${id}/${bahan_baku}`)
        getResepById();
    }

    const tambahBahanResep = async() =>{
        await axios.post(`http://localhost:5000/recipes/ingredients/${id}`,{
            bahan_baku : bahanBaru,
            jumlah : jumlahBaru
        });
        getResepById();
    }

    return (
        <div>
                <section class = "section">
         <div class = "container">
            <span class = "is-size-5">
               Resep {namaResep}
            </span>
            <br/>
            
            <table class = "table is-bordered">
               <thead>
                  <tr>
                     <th>No Bahan</th>
                     <th>Nama Bahan</th>
                     <th>Jumlah Bahan Baku</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                    {resep.map((r, index)=>(
                        <tr key ={r.id_resep}>
                            <td>{index + 1}</td>
                            <td>{r.bahan_baku}</td>
                            <td>{r.jumlah}</td>
                            <td>
                                <button onClick={() => deleteBahanResep(id, r.bahan_baku)} className="button is-small is-danger">Delete</button>
                            </td>
                        </tr>
                    ))}
               </tbody>
            </table>
            <div>
                <form onSubmit = {tambahBahanResep}>
                    <div className="field">
                        <label className="label">Nama Bahan Baku</label>
                        <input 
                            className="input" 
                            type="text" 
                            style={{"width" : "33%"}} 
                            placeholder="Nama Bahan Baku"
                            value = {bahanBaru}
                            onChange = {(e) => setBahanBaru(e.target.value) }
                            />
                    </div>

                    <div className="field">
                        <label className="label">Jumlah yang Diperlukan</label>
                        <input 
                            className="input" 
                            type="text" 
                            style={{"width" : "33%"}} 
                            placeholder="Stok"
                            value = {jumlahBaru}
                            onChange = {(e) => setJumlahBaru(e.target.value)}
                        />
                    </div>

                    <div className="field">
                        <button className="button is-primary">Tambah Bahan Resep</button>
                    </div>
                </form>
            </div>
         </div>
      </section>
        </div>
    )
}

export default LihatResep;
