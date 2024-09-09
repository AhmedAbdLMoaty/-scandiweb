<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/app/views/addproduct.css">
</head>
<body>

<h1>Add Product</h1>

<!-- Display error message if it exists -->
<?php if (isset($_SESSION['error_message'])): ?>
    <div class="error-message" style="color: red;">
        <?php 
        echo $_SESSION['error_message']; 
        unset($_SESSION['error_message']); // Clear the message after displaying
        ?>
    </div>
<?php endif; ?>

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
    
    <!-- DVD Fields -->
    <div id="dvdFields" class="form-group" style="display:none;">
        <label for="size">Size (MB)</label>
        <input type="number" id="size" name="size">
    </div>

    <!-- Book Fields -->
    <div id="bookFields" class="form-group" style="display:none;">
        <label for="weight">Weight (Kg)</label>
        <input type="number" id="weight" name="weight">
    </div>

    <!-- Furniture Fields -->
    <div id="furnitureFields" class="form-group" style="display:none;">
        <label for="height">Height (CM)</label>
        <input type="number" id="height" name="height">
        <label for="width">Width (CM)</label>
        <input type="number" id="width" name="width">
        <label for="length">Length (CM)</label>
        <input type="number" id="length" name="length">
    </div>
    <small id="validationMessage" style="color: red; display: none;">Please, submit required data</small>

    <div class="form-group">
        <button type="submit">Save</button>
        <button type="button" onclick="window.location.href='./home'">Cancel</button>
    </div>
</form>

<script>
// Show relevant fields based on product type selection
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

// Form validation before submission
document.getElementById('product_form').addEventListener('submit', function(event) {
    const productType = document.getElementById('productType').value;
    let valid = true;

    // Check common fields
    if (!document.getElementById('sku').value || !document.getElementById('name').value || !document.getElementById('price').value) {
        valid = false;
    }

    // Validate based on product type
    if (productType === 'DVD' && !document.getElementById('size').value) {
        valid = false;
    } else if (productType === 'Book' && !document.getElementById('weight').value) {
        valid = false;
    } else if (productType === 'Furniture' && 
        (!document.getElementById('height').value || !document.getElementById('width').value || !document.getElementById('length').value)) {
        valid = false;
    }

    if (!valid) {
        document.getElementById('validationMessage').style.display = 'block'; // Show validation message
        event.preventDefault(); // Prevent form submission
    } else {
        document.getElementById('validationMessage').style.display = 'none'; // Hide validation message
    }
});
</script>

</body>
</html>
