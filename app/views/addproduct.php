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
        <label for="price">Price</label>
        <input type="text" id="price" name="price" required>
    </div>
    <div class="form-group">
        <label for="productType">Product Type</label>
        <select id="productType" name="productType" required onchange="toggleFields()">
            <option value="">Select type</option>
            <option value="DVD">DVD</option>
            <option value="Book">Book</option>
            <option value="Furniture">Furniture</option>
        </select>
    </div>

    <div id="dvdFields">
        <div class="form-group">
            <label for="size">Size (MB)</label>
            <input type="number" id="size" name="size">
            <small>Please, provide size.</small>
        </div>
    </div>

    <div id="bookFields">
        <div class="form-group">
            <label for="weight">Weight (Kg)</label>
            <input type="number" id="weight" name="weight">
            <small>Please, provide weight.</small>
        </div>
    </div>

    <div id="furnitureFields">
        <div class="form-group">
            <label for="height">Height (cm)</label>
            <input type="number" id="height" name="height">
        </div>
        <div class="form-group">
            <label for="width">Width (cm)</label>
            <input type="number" id="width" name="width">
        </div>
        <div class="form-group">
            <label for="length">Length (cm)</label>
            <input type="number" id="length" name="length">
        </div>
        <small>Please, provide dimensions.</small>
    </div>

    <div class="form-group">
        <button type="submit">Save</button>
        <a href="./"><button type="button">Cancel</button></a>
    </div>

    <div class="error" id="errorMessage"></div>
</form>

<script>
    const fieldMap = {
        DVD: 'dvdFields',
        Book: 'bookFields',
        Furniture: 'furnitureFields',
    };

    function toggleFields() {
        const selectedType = document.getElementById('productType').value;
        Object.keys(fieldMap).forEach(type => {
            const field = document.getElementById(fieldMap[type]);
            field.style.display = type === selectedType ? 'block' : 'none';
        });
    }
</script>

</body>
</html>
