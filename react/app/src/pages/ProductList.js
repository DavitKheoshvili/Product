import axios from "axios"
import Product from "../components/Product";
import { useEffect, useState } from 'react';

function ProductList({ products }) {
  let skuList = [];

  const handleCheckbox = (e) => {
    if (!skuList.some((elem) => elem.sku === e.target.id)) {
      skuList.push({sku: e.target.id, type: e.target.value});
    }else{
      skuList = skuList.filter((elem) => elem.sku !== e.target.id)
    }
  }
  const handleMassDelete = () => {
    axios.post("http://157.230.125.117:8000/products/delete", skuList, {
      headers: {
        "Content-type": "multipart/form-date",
      },
    }).then(res => { 
      console.log('deleting', res); 
    })
    .catch(err => console.log('err ///', err));

    window.location.reload();
  }
  return (
    <>
      <div className="header">
        <h1>Product List</h1>
        <div className="buttonsContainer">
          <a href="\add"><button>ADD</button></a>
          <button id="delete-product-btn" onClick={handleMassDelete}>MASS DELETE</button>
        </div>
      </div>
      <div className="container">
        {
          products.map((product, index) => {
            return (
              <div key={index} className="card">
                <input type="checkbox" className="delete-checkbox" id={product.SKU} value={product.type} onChange={handleCheckbox} />
                <Product product={product} />
              </div>
            )
          })
        }

      </div>
    </>
  );
}

export default ProductList;
