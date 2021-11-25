import {BrowserRouter as Router, Routes, Route} from  'react-router-dom'
import Header from "./components/Header";
import ListBahanBaku from "./components/ListBahanBaku";
import TambahBahanBaku from "./components/TambahBahanBaku";

function App() {
  return (
    <Router>
    <div>
      <Header />
      <Routes>
        <Route path= "/stok" element= {<ListBahanBaku/>}/> 
        <Route path="stok/add" element={<TambahBahanBaku/>}/>
      </Routes>
    </div>
    </Router>
  );
}

export default App;
