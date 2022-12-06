import axios from "axios"

const getData = () => {
  axios.get("http://localhost:8000/").then(res => {
    console.log(res);
  }).catch(err => {
    console.log("errorrr", err);
  })
}
async function request() {
  await axios.get('http://localhost:8000/');
}
function ProductList() {
  getData();
  return (
    <div>
      Hey There From Product List page
      
    </div>
  );
}

export default ProductList;