<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/app/views/addproduct.css">
</head>
<body>

<h1>Add Product</h1>

<form id="product_form" method="post" action="./add-product/store" onsubmit="return validateForm()">
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
    
    <div id="dvdFields" class="form-group" style="display: none;">
        <label for="size">Size (MB)</label>
        <input type="number" id="size" name="size">
    </div>
    
    <div id="bookFields" class="form-group" style="display: none;">
        <label for="weight">Weight (Kg)</label>
        <input type="number" id="weight" name="weight">
    </div>
    
    <div id="furnitureFields" class="form-group" style="display: none;">
        <label for="height">Height (CM)</label>
        <input type="number" id="height" name="height">
        <label for="width">Width (CM)</label>
        <input type="number" id="width" name="width">
        <label for="length">Length (CM)</label>
        <input type="number" id="length" name="length">
    </div>
    
    <!-- Ensure only one error message -->
    <small id="errorMessage" style="display: none; color: red;">Please, provide the correct dimensions based on the selected product type.</small>

    <div class="form-group">
        <button type="submit">Save</button>
        <button type="button" onclick="window.location.href='/ecom_/public/home'">Cancel</button>
    </div>
</form>

<script>
document.getElementById('productType').addEventListener('change', function() {
    document.getElementById('dvdFields').style.display = 'none';
    document.getElementById('bookFields').style.display = 'none';
    document.getElementById('furnitureFields').style.display = 'none';
    
    document.getElementById('errorMessage').style.display = 'none';

    if (this.value === 'DVD') {
        document.getElementById('dvdFields').style.display = 'block';
    } else if (this.value === 'Book') {
        document.getElementById('bookFields').style.display = 'block';
    } else if (this.value === 'Furniture') {
        document.getElementById('furnitureFields').style.display = 'block';
    }
});

function validateForm() {
    const productType = document.getElementById('productType').value;
    let isValid = true;
    const errorMessage = document.getElementById('errorMessage');

    errorMessage.style.display = 'none';

    if (productType === 'DVD') {
        const size = document.getElementById('size').value;
        if (!size) {
            isValid = false;
            errorMessage.style.display = 'block';
        }
    } else if (productType === 'Book') {
        const weight = document.getElementById('weight').value;
        if (!weight) {
            isValid = false;
            errorMessage.style.display = 'block';
        }
    } else if (productType === 'Furniture') {
        const height = document.getElementById('height').value;
        const width = document.getElementById('width').value;
        const length = document.getElementById('length').value;
        if (!height || !width || !length) {
            isValid = false;
            errorMessage.style.display = 'block';
        }
    }

    return isValid;
}
</script>

</body>
</html>
