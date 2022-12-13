import React, { useState } from 'react'
import ProductType from '../components/ProductType'
import axios from 'axios'
import { useNavigate } from 'react-router-dom';

function AddProduct() {
  const [type, setType] = useState('');
  const navigate = useNavigate();
  const [errors, setErrors] = useState({
    sku: "",
    name: "",
    price: "",
  });

  const options = [
    {
      label: "Book",
      value: "book",
    },
    {
      label: "DVD",
      value: "dvd",
    },
    {
      label: "Furniture",
      value: "furniture",
    },
  ];
  const [formData, setFormData] = useState({
    sku: "",
    name: "",
    price: ""
  });

  const typeSwitcher = (e) => {
    setType(e.target.value);
    setFormData({ ...formData, type: e.target.value });
    setErrors({});
  }
  const handleSave = () => {
    submitForm();
  }
  const validations = () => {
    if (!/\w/.test(formData.sku)) {
      setErrors({ ...errors, sku: "Please, submit required data" });
      return false;
    }
    if (!/^[A-Z0-9]{8,10}$/.test(formData.sku)) {
      setErrors({ ...errors, sku: "Please, provide the data of indicated type" });
      return false;
    }

    if (!/\w/.test(formData.name)) {
      setErrors({ ...errors, name: "Please, submit required data" });
      return false;
    }
    if (!formData.name.match(/[A-Za-z]/g)) {
      setErrors({ ...errors, name: "Please, provide the data of indicated type" });
      return false;
    } else if (!(/^[\w\s]{3,50}$/.test(formData.name) && formData.name.match(/[A-Za-z]/g).length >= 2)) {
      setErrors({ ...errors, name: "Please, provide the data of indicated type" });
      return false;
    }
    if (!/\w/.test(formData.name)) {
      setErrors({ ...errors, name: "Please, provide the data of indicated type" });
      return false;
    }

    if (!/\w/.test(formData.price)) {
      setErrors({ ...errors, price: "Please, submit required data" });
      return false;
    }
    if (!/^[0-9]{1,10}\.?[0-9]{0,2}$/.test(formData.price)) {
      setErrors({ ...errors, price: "Please, provide the data of indicated type" });
      return false;
    }
    if (type === 'book') {
      if (!/\w/.test(formData.weight)) {
        setErrors({ ...errors, weight: "Please, submit required data" });
        return false;
      }
      if (!/^[1-9][0-9]*?$/.test(formData.weight)) {
        setErrors({ ...errors, weight: "Please, provide the data of indicated type" });
        return false;
      }
    }
    if (type === 'dvd') {
      if (!/\w/.test(formData.size)) {
        setErrors({ ...errors, size: "Please, submit required data" });
        return false;
      }
      if (!/^[1-9][0-9]*?$/.test(formData.size)) {
        setErrors({ ...errors, size: "Please, provide the data of indicated type" });
        return false;
      }
    }

    if (type === 'furniture') {
      if (!/\w/.test(formData.height)) {
        setErrors({ ...errors, height: "Please, submit required data" });
        return false;
      }
      if (!/^[1-9][0-9]*?$/.test(formData.height)) {
        setErrors({ ...errors, height: "Please, provide the data of indicated type" });
        return false;
      }

      if (!/\w/.test(formData.width)) {
        setErrors({ ...errors, width: "Please, submit required data" });
        return false;
      }
      if (!/^[1-9][0-9]*?$/.test(formData.width)) {
        setErrors({ ...errors, width: "Please, provide the data of indicated type" });
        return false;
      }

      if (!/\w/.test(formData.length)) {
        setErrors({ ...errors, length: "Please, submit required data" });
        return false;
      }
      if (!/^[1-9][0-9]*?$/.test(formData.length)) {
        setErrors({ ...errors, length: "Please, provide the data of indicated type" });
        return false;
      }
    }

    return true;
  }
  const submitForm = () => {
    let valid = validations();
    console.log(valid);
    console.log(errors);

    if (valid) {
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
          <input type="text" name="sku" id="sku" onChange={(e) => {
            setFormData({ ...formData, sku: e.target.value });
            setErrors({ ...errors, sku: "" })
          }} />
        </label>
        <p style={{ color: "red" }}>{errors.sku}</p>
        <label>
          Name:
          <input type="text" name="name" id="name" onChange={(e) => {
            setFormData({ ...formData, name: e.target.value });
            setErrors({ ...errors, name: "" })
          }} />
        </label>
        <p style={{ color: "red" }}>{errors.name}</p>
        <label>
          Price:
          <input type="text" name="price" id="price" onChange={(e) => {
            setFormData({ ...formData, price: e.target.value });
            setErrors({ ...errors, price: "" })
          }} />
        </label>
        <p style={{ color: "red" }}>{errors.price}</p>
        <select name="cars" id="productType" onChange={typeSwitcher}>
          <option>Type Switcher</option>
          {options.map((option) => (
            <option key={option.value} value={option.value} id={option.label}>{option.label}</option>
          ))}
        </select>
        <ProductType
          productType={type}
          formData={formData}
          setFormData={setFormData}
          errors={errors}
          setErrors={setErrors}
        />
      </form>
    </div>
  );
}

export default AddProduct;