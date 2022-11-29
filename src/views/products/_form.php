<?php //if (!empty($errors)): 
?>
<!--    <div class="alert alert-danger">-->
<!--        --><?php //foreach ($errors as $error): 
                ?>
<!--            <div>--><?php //echo $error 
                        ?>
<!--</div>-->
<!--        --><?php //endforeach; 
                ?>
<!--    </div>-->
<?php //endif; 
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-check">
        <input class="form-check-input" type="radio" name="type" value="book" id="Book">
        <label class="form-check-label" for="flexRadioDefault1">
            Book
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="type" value="dvd" id="DVD" checked>
        <label class="form-check-label" for="flexRadioDefault2">
            DVD
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="type" value="Furniture" id="furniture">
        <label class="form-check-label" for="flexRadioDefault2">
            Furniture
        </label>
    </div>

    <div class="form-group">
        <label>Product Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo $product['name'] ?>">
    </div>
    <div class="form-group">
        <label>Product price</label>
        <input type="number" step=".01" name="price" class="form-control" value="<?php echo $product['price'] ?>">
    </div>
    <div class="form-group">
        <label>Product SKU</label>
        <input type="text" class="form-control" name="sku"><?php echo $product['sku'] ?></input>
    </div>
    <div class="form-group">
        <label>Product Weight</label>
        <input type="text" class="form-control" name="weight"><?php echo $product['weight'] ?></input>
    </div>
    <div class="form-group">
        <label>Product Size</label>
        <input type="text" class="form-control" name="size"><?php echo $product['size'] ?></input>
    </div>
    <div class="form-group">
        <label>Product Width</label>
        <input type="text" class="form-control" name="width"><?php echo $product['width'] ?></input>
    </div><div class="form-group">
        <label>Product Height</label>
        <input type="text" class="form-control" name="height"><?php echo $product['height'] ?></input>
    </div><div class="form-group">
        <label>Product Length</label>
        <input type="text" class="form-control" name="length"><?php echo $product['length'] ?></input>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>