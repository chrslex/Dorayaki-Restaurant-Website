import axios from 'axios';
import { useState, useEffect } from 'react'

const ListResep = () => {
    const [resep, setResep] = useState([]);

    useEffect(() => {
        getAllResep();
    }, []);

    const getAllResep = async() =>{
        const res = await axios.get("http://localhost:5000/recipes");
        setResep(res.data);
    }
    return (
        <div>
            <a href="/stok/add" className="button is-primary mt-5 ml-1">Add New</a>
            <table className="table is-striped is-fullwidth ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Resep</th>
                        <th>Nama Resep</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    { resep.map((r, index) => (
                        <tr key={r.id_resep}>
                            <td>{index + 1}</td>
                            <td>{r.id_resep}</td>
                            <td>{r.nama_resep}</td>
                            <td>
                                <a href={`/recipes/${r.id_resep}`} className="button is-small is-info">Lihat Resep</a>
                            </td>
                        </tr>
                    )) }
                    
                </tbody>
            </table>
        </div>
    )
}

export default ListResep;
