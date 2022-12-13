
function ProductType({ productType, formData, setFormData, errors, setErrors }) {
    return (
        <div>
            {productType == "book" &&
                <>
                    <label>
                        Weight:
                        <input type="text" name="weight" id="weight" onChange={(e) => {
                            setFormData({ ...formData, weight: e.target.value });
                            setErrors({ ...errors, weight: "" })
                        }} />
                    </label>
                    <p style={{ color: "red" }}>{errors.weight}</p>

                    <h4>Please, provide weight</h4>
                </>
            }
            {productType == "dvd" &&
                <>
                    <label>
                        Size:
                        <input type="text" name="size" id="size" onChange={(e) => {
                            setFormData({ ...formData, size: e.target.value });
                            setErrors({ ...errors, size: "" })
                        }} />
                    </label>
                    <p style={{ color: "red" }}>{errors.size}</p>

                    <h3>Please, provide size</h3>
                </>
            }
            {productType == "furniture" &&
                <>
                    <label>
                        Height:
                        <input type="text" name="height" id="height" onChange={(e) => {
                            setFormData({ ...formData, height: e.target.value });
                            setErrors({ ...errors, height: "" })
                        }} />
                    </label>
                    <p style={{ color: "red" }}>{errors.height}</p>

                    <label>
                        Width:
                        <input type="text" name="width" id="width" onChange={(e) => {
                            setFormData({ ...formData, width: e.target.value });
                            setErrors({ ...errors, width: "" })
                        }} />
                    </label>
                    <p style={{ color: "red" }}>{errors.width}</p>

                    <label>
                        Length:
                        <input type="text" name="length" id="length" onChange={(e) => {
                            setFormData({ ...formData, length: e.target.value });
                            setErrors({ ...errors, length: "" })
                        }} />
                    </label>
                    <p style={{ color: "red" }}>{errors.length}</p>

                    <h3>Please, provide dimensions</h3>
                </>
            }
        </div>
    );
}

export default ProductType;
