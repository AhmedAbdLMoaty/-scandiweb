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
    </style>
</head>
<body>

<h1>Add Product</h1>

<form id="product_form" method="post" action="./add-product/store">
    <div class="form-group">
        <label for="sku">SKU</label>
        <input type="text" id="sku" name="sku" value="<?= htmlspecialchars($sku ?? '') ?>" required>
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($name ?? '') ?>" required>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" id="price" name="price" value="<?= htmlspecialchars($price ?? '') ?>" required>
    </div>
    <div class="form-group">
        <label for="productType">Product Type</label>
        <select id="productType" name="productType" onchange="this.form.submit()" required>
            <option value="">Select type</option>
            <option value="DVD" <?= ($productType ?? '') === 'DVD' ? 'selected' : '' ?>>DVD</option>
            <option value="Book" <?= ($productType ?? '') === 'Book' ? 'selected' : '' ?>>Book</option>
            <option value="Furniture" <?= ($productType ?? '') === 'Furniture' ? 'selected' : '' ?>>Furniture</option>
        </select>
    </div>

    <!-- Type-specific fields -->
    <?php if (isset($productType)): ?>
        <?php if ($productType === 'DVD'): ?>
            <div class="form-group">
                <label for="size">Size (MB)</label>
                <input type="number" id="size" name="size" value="<?= htmlspecialchars($size_mb ?? '') ?>" required>
                <small>Please, provide size.</small>
            </div>
        <?php elseif ($productType === 'Book'): ?>
            <div class="form-group">
                <label for="weight">Weight (Kg)</label>
                <input type="number" id="weight" name="weight" value="<?= htmlspecialchars($weight_kg ?? '') ?>" required>
                <small>Please, provide weight.</small>
            </div>
        <?php elseif ($productType === 'Furniture'): ?>
            <div class="form-group">
                <label for="height">Height (cm)</label>
                <input type="number" id="height" name="height" value="<?= htmlspecialchars($height ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label for="width">Width (cm)</label>
                <input type="number" id="width" name="width" value="<?= htmlspecialchars($width ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label for="length">Length (cm)</label>
                <input type="number" id="length" name="length" value="<?= htmlspecialchars($length ?? '') ?>" required>
            </div>
            <small>Please, provide dimensions.</small>
        <?php endif; ?>
    <?php endif; ?>

    <div class="form-group">
        <button type="submit">Save</button>
        <a href="/product-list"><button type="button">Cancel</button></a>
    </div>

    <?php if (isset($errorMessage)): ?>
        <div class="error"><?= htmlspecialchars($errorMessage) ?></div>
    <?php endif; ?>
</form>

</body>
</html>
