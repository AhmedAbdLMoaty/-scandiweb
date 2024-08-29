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
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            padding: 10px 15px;
            margin-right: 10px;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        #dvdFields, #bookFields, #furnitureFields {
            display: none;
        }
    </style>
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
        <select id="productType" name="productType" required onchange="showFields()">
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
    function showFields() {
        document.getElementById('dvdFields').style.display = 'none';
        document.getElementById('bookFields').style.display = 'none';
        document.getElementById('furnitureFields').style.display = 'none';

        var productType = document.getElementById('productType').value;

        if (productType === 'DVD') {
            document.getElementById('dvdFields').style.display = 'block';
        } else if (productType === 'Book') {
            document.getElementById('bookFields').style.display = 'block';
        } else if (productType === 'Furniture') {
            document.getElementById('furnitureFields').style.display = 'block';
        }
    }
</script>

</body>
</html>
