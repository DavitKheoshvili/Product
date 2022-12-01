<h1>Product CRUD</h1>

<p>
    <a href="/products/create" type="button" class="btn btn-sm btn-success">Add Product</a>
</p>
<form method="post" action="/products/delete">
    <button type="submit">MASS DELETE</button>
    <div class="row">
        <?php foreach ($products as $i => $product) { ?>
            <div class="card" style="width: 18rem;">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name=<?php if ($product['SKU']) echo $product['SKU'] ?>>
                    <label class="form-check-label" for="checkbox"></label>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Name: <?php if ($product['Name']) echo $product['Name'] ?></li>
                    <li class="list-group-item">Prive: <?php if ($product['Price']) echo $product['Price'] ?></li>
                    <li class="list-group-item">SKU: <?php if ($product['SKU']) echo $product['SKU'] ?></li>
                    <li class="list-group-item">Weight: <?php if ($product['Weight']) echo $product['Weight'] ?></li>
                    <li class="list-group-item">Size: <?php if ($product['Size']) echo $product['Size'] ?></li>
                    <li class="list-group-item">Width: <?php if ($product['Width']) echo $product['Width'] ?></li>
                    <li class="list-group-item">Height: <?php if ($product['Height']) echo $product['Height'] ?></li>
                    <li class="list-group-item">Length: <?php if ($product['Length']) echo $product['Length'] ?></li>
                </ul>
            </div>
        <?php } ?>
    </div>
</form>