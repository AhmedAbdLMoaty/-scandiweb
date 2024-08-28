<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid
            border-radius: 4px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            padding: 10px 15px;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<h1>Add Product</h1>

<form id="product_form" method="post" action="/add-product">
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
        <select id="productType" name="productType" required>
            <option value="DVD">DVD</option>
            <option value="Book">Book</option>
            <option value="Furniture">Furniture</option>
        </select>
    </div>
    <div id="type-specific-attributes">
        <!-- Type-specific fields will be injected here -->
    </div>
    <div class="form-group">
        <button type="submit">Save</button>
        <a href="/home"><button type="button">Cancel</button></a>
    </div>
</form>

<script>
document.getElementById('productType').addEventListener('change', function() {
    var type = this.value;
    var attributesDiv = document.getElementById('type-specific-attributes');
    attributesDiv.innerHTML = '';

    if (type === 'DVD') {
        attributesDiv.innerHTML = `
            <div class="form-group">
                <label for="size">Size (MB)</label>
                <input type="number" id="size" name="size" required>
            </div>
        `;
    } else if (type === 'Book') {
        attributesDiv.innerHTML = `
            <div class="form-group">
                <label for="weight">Weight (Kg)</label>
                <input type="number" id="weight" name="weight" required>
            </div>
        `;
    } else if (type === 'Furniture') {
        attributesDiv.innerHTML = `
            <div class="form-group">
                <label for="height">Height (cm)</label>
                <input type="number" id="height" name="height" required>
            </div>
            <div class="form-group">
                <label for="width">Width (cm)</label>
                <input type="number" id="width" name="width" required>
            </div>
            <div class="form-group">
                <label for="length">Length (cm)</label>
                <input type="number" id="length" name="length" required>
            </div>
        `;
    }
});
</script>

</body>
</html>
