import {BrowserRouter as Router, Routes, Route} from  'react-router-dom'
import Header from "./components/Header";
import ListBahanBaku from "./components/ListBahanBaku";
import TambahBahanBaku from "./components/TambahBahanBaku";
import EditBahanBaku from './components/EditBahanBaku';

function App() {
  return (
    <Router>
    <div>
      <Header />
      <Routes>
        <Route path= "/stok" element= {<ListBahanBaku/>}/> 
        <Route path="/stok/add" element={<TambahBahanBaku/>}/>
        <Route path="/stok/updateStok/:nama_bahan_baku" element={<EditBahanBaku/>}/>
      </Routes>
    </div>
    </Router>
  );
}

export default App;
