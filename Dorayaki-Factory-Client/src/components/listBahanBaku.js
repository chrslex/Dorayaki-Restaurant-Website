import {useState, useEffect} from 'react';
import axios from 'axios';

const ListBahanBaku = () => {
    const [bahanBaku, setBahanBaku] = useState([]);

    useEffect(()=>{
        getBahanBaku();
    }, [])

    const getBahanBaku = async() =>{
        const res = await axios.get('http://localhost:5000/stok');
        setBahanBaku(res.data);
    };

    return (
        <div>
            <a href="/stok/add" className="button is-primary mt-5 ml-1">Add New</a>
            <table className="table is-striped is-fullwidth ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Bahan Baku</th>
                        <th>Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    { bahanBaku.map((b, index) => (
                        <tr key={b.nama_bahan_baku}>
                            <td>{index + 1}</td>
                            <td>{b.nama_bahan_baku}</td>
                            <td>{b.stok}</td>
                            <td>
                                <a href={`/stok/updateStok/${b.nama_bahan_baku}`} className="button is-small is-info">Edit</a>
                            </td>
                        </tr>
                    )) }
                    
                </tbody>
            </table>
        </div>
    )
}

export default ListBahanBaku;
