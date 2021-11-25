import {BrowserRouter as Router, Routes, Route} from  'react-router-dom'
import Header from "./components/Header";
import ListBahanBaku from "./components/ListBahanBaku";
import TambahBahanBaku from "./components/TambahBahanBaku";
import EditBahanBaku from './components/EditBahanBaku';
import ListResep from './components/ListResep'
import LihatResep from './components/LihatResep';

function App() {
  return (
    <Router>
    <div>
      <Header />
      <Routes>
        <Route path= "/stok" element= {<ListBahanBaku/>}/> 
        <Route path="/stok/add" element={<TambahBahanBaku/>}/>
        <Route path="/stok/updateStok/:nama_bahan_baku" element={<EditBahanBaku/>}/>
        <Route path="/recipes/" element={<ListResep/>}/>
        <Route path="/recipes/:id" element={<LihatResep/>}/>
      </Routes>
    </div>
    </Router>
  );
}

export default App;
