import { useState, useEffect } from 'react'
import axios from 'axios';
import {useNavigate, useParams} from 'react-router-dom'

const LihatResep = () => {
    const [resep, setResep] = useState([]);
    const[namaResep, setNamaResep] = useState("");
    const {id} = useParams();

    useEffect(()=>{
        getResepById();
    }, []);
    const getResepById = async() =>{
        const res = await axios.get(`http://localhost:5000/recipes/${id}`);
        console.log(res.data);
        setResep(res.data);
        if(res.data.length > 0){
        setNamaResep(res.data[0].nama_resep);

        }
    }

    return (
        <div>
                {/* {
                    resep.map((r, index)=>(
                        <ul>
                            <li key={r.nama_resep}></li>
                            <li>{r.bahan_baku}</li>
                            <li>{r.jumlah}</li>
                        </ul>
                    ))
                } */}
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
                  </tr>
               </thead>
               <tbody>
                    {resep.map((r, index)=>(
                        <tr key ={r.id}>
                            <td>{index + 1}</td>
                            <td>{r.bahan_baku}</td>
                            <td>{r.jumlah}</td>
                        </tr>
                    ))}
               </tbody>
            </table>
         </div>
      </section>
        </div>
    )
}

export default LihatResep;
