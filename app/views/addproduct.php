<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="/ecom_/app/views/addproduct.css">
</head>
<body>

<h1>Add Product</h1>

<form id="product_form" method="post" action="./add-product/store">
    <div class="form-group">
        <label for="sku">SKU</label>
        <input type="text" id="sku" name="sku" required>
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="price">Price ($)</label>
        <input type="number" id="price" name="price" required>
    </div>
    <div class="form-group">
        <label for="productType">Product Type</label>
        <select id="productType" name="productType" required>
            <option value="">Select Type</option>
            <option value="DVD">DVD</option>
            <option value="Book">Book</option>
            <option value="Furniture">Furniture</option>
        </select>
    </div>
    <div id="dvdFields" class="form-group">
        <label for="size">Size (MB)</label>
        <input type="number" id="size" name="size">
    </div>
    <div id="bookFields" class="form-group">
        <label for="weight">Weight (Kg)</label>
        <input type="number" id="weight" name="weight">
    </div>
    <div id="furnitureFields" class="form-group">
        <label for="height">Height (CM)</label>
        <input type="number" id="height" name="height">
        <label for="width">Width (CM)</label>
        <input type="number" id="width" name="width">
        <label for="length">Length (CM)</label>
        <input type="number" id="length" name="length">
        </div>
        </div>
        <small>Please, provide dimensions.</small>
    </div>

    <div class="form-group">
    </div>
        <small>Please, provide dimensions.</small>
    </div>

    <div class="form-group">
    <button type="submit">Save</button>
    <button type="button" onclick="window.location.href='/ecom_/public/home'">Cancel</button>
</form>

<script>
document.getElementById('productType').addEventListener('change', function() {
    document.getElementById('dvdFields').style.display = 'none';
    document.getElementById('bookFields').style.display = 'none';
    document.getElementById('furnitureFields').style.display = 'none';
    if (this.value === 'DVD') {
        document.getElementById('dvdFields').style.display = 'block';
    } else if (this.value === 'Book') {
        document.getElementById('bookFields').style.display = 'block';
    } else if (this.value === 'Furniture') {
        document.getElementById('furnitureFields').style.display = 'block';
    }
});
</script>

</body>
</html>