import { Route, Routes } from "react-router-dom"
import ProductList from "./pages/ProductList"
import AddProduct from "./pages/AddProduct"
import { useEffect, useState} from 'react'
import axios from "axios"

function App() {
  const [products, setProducts] = useState([]);
  const [newProduct, setNewProduct] = useState(false);
  useEffect(() => {
    axios.get("http://157.230.125.117:8000/").then(res => {
      setProducts(res.data);
    }).catch(err => {
      console.log("errorrr", err);
    })
  }, [newProduct]);
  return (
    <>
      <Routes>
        <Route path="/" element={<ProductList products={products} />} />
        <Route path="/product" element={<ProductList products={products} />} />
        <Route path="/add" element={<AddProduct products={products} setNewProduct={setNewProduct} />} />
        <Route path="/product/add" element={<AddProduct products={products} setNewProduct={setNewProduct} />} />
      </Routes>
    </>
  );
}

export default App;
