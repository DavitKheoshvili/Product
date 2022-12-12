import React, { useState } from 'react'
import ProductType from '../components/ProductType'
import axios from 'axios'
import { useNavigate } from 'react-router-dom';

function AddProduct() {
  const [type, setType] = useState('');
  const navigate = useNavigate();


  const options = [
    {
      key: 1,
      label: "Book",
      value: "book",
    },
    {
      key: 1,
      label: "DVD",
      value: "dvd",
    },
    {
      label: "Furniture",
      value: "furniture",
    },
  ];
  const [formData, setFormData] = useState({
    SKU: "",
    name: "",
    price: ""
  });

  const typeSwitcher = (e) => {
    setType(e.target.value);
    setFormData({ ...formData, type: e.target.value });
  }
  const handleSave = () => {
    submitForm();
  }

  const submitForm = () => {
    axios.post("http://localhost:8000/products/create", formData, {
      headers: {
        "Content-type": "multipart/form-date",
      },
    }).then(res => { 
      console.log('posting', res); 
      navigate("/product");
    })
    .catch(err => console.log('err ///', err));
  }

  return (
    <div>
      <div className="header">
        <h1>Product Add</h1>
        <div>
          <button onClick={handleSave}>Save</button>
          <a href="\">Cancel</a>
        </div>
      </div>

      <form className="addForm" id="product_form" method="post">
        <label>
          SKU:
          <input type="text" name="sku" id="sku" />
        </label>
        <label>
          Name:
          <input type="text" name="name" id="name" value={formData.name} onChange={(e) => setFormData({ ...formData, name: e.target.value })} />
        </label>
        <label>
          Price:
          <input type="text" name="price" id="price" onChange={(e) => setFormData({ ...formData, price: e.target.value })} />
        </label>
        <select name="cars" id="productType" onChange={typeSwitcher}>
          <option>Type Switcher</option>
          {options.map((option) => (
            <option key={option.value} value={option.value} id={option.label}>{option.label}</option>
          ))}
        </select>
        <ProductType productType={type} formData={formData} setFormData={setFormData} />
      </form>
    </div>
  );
}

export default AddProduct;