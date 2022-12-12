
function ProductType({ productType, formData, setFormData }) {
    return (
        <div>
            {productType == "book" &&
                <label>
                    Weight:
                    <input type="text" name="weight" id="weight" onChange={(e) => setFormData({...formData, weight: e.target.value})}/>
                </label>
            }
            {productType == "dvd" &&
                <label>
                    Size:
                    <input type="text" name="size" id="size" onChange={(e) => setFormData({...formData, size: e.target.value})}/>
                </label>
            }
            {productType == "furniture" &&
                <>
                    <label>
                        Hieght:
                        <input type="text" name="Height" id="height" onChange={(e) => setFormData({...formData, height: e.target.value})}/>
                    </label>
                    <label>
                        Width:
                        <input type="text" name="width" id="width" onChange={(e) => setFormData({...formData, width: e.target.value})}/>
                    </label>
                    <label>
                        Length:
                        <input type="text" name="length" id="length" onChange={(e) => setFormData({...formData, length: e.target.value})}/>
                    </label>
                </>
            }
        </div>
    );
}

export default ProductType;
