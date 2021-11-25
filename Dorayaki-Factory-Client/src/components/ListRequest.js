import {useState, useEffect} from 'react';
import axios from 'axios';

const ListRequest = () => {
    const [request, setRequest] = useState([]);

    useEffect(()=>{
        getRequest();
    }, []);

    const getRequest = async() =>{
        const res = await axios.get('http://localhost:5000/request');
        setRequest(res.data);
    };
    return (
        <div>
            <table className="table is-striped is-fullwidth ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Request</th>
                        <th>Varian</th>
                        <th>Jumlah Penambahan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    { request.map((r, index) => (
                        <tr key={r.nama_bahan_baku}>
                            <td>{index + 1}</td>
                            <td>{r.id_request}</td>
                            <td>{r.varian}</td>
                            <td>{r.jumlah_penambahan}</td>
                            <td>
                                <button href={`/request/acc/${r.id_request}/${r.varian}}`} className="button is-small is-primary mr-5">Terima</button>
                                <button href={`/request/acc/${r.id_request}/${r.varian}}`} className="button is-small is-danger">Tolak</button>
                            </td>
                        </tr>
                    )) }
                    
                </tbody>
            </table>
        </div>
    )
}

export default ListRequest
