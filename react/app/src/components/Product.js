
function Product({ product }) {
  return (
    <ul className='list'>
      <li>{product['SKU']}</li>
      <li>{product['Name']}</li>
      <li>{product['Price']} $</li>
      {product['type'] === 'book' && <li>Weight: {product['Weight']}KG</li>}
      {product['type'] === 'dvd' && <li>Size: {product['Size']}MB</li>}
      {product['type'] === 'furniture' && 
      <li>Dimentions: {product['Length']}x{product['Width']}x{product['Height']}</li>}
    </ul>
  );
}

export default Product;
