<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/app/views/ProductList.css">
</head>
<body>

    <h1>Product List</h1>

    <!-- Action Buttons -->
    <form method="post" action="<?= BASE_URL ?>/home/delete_products">
    <div class="product-actions">
            <a href="./add-product" id="add-product-btn">ADD</a>
            <button id="delete-product-btn" type="submit">MASS DELETE</button>
        </div>
        <div class="product-list">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <input type="checkbox" name="product_ids[]" class="delete-checkbox" value="<?php echo $product['sku']; ?>">
                    <div class="product-info">
                        <p><strong><?php echo $product['sku']; ?></strong></p>
                        <p><?php echo $product['name']; ?></p>
                        <p><?php echo $product['price']; ?> $</p>
                        <p><?php echo $product['type'] === 'DVD' ? "Size: " . $product['size_mb'] . " MB" : ($product['type'] === 'Book' ? "Weight: " . $product['weight_kg'] . " Kg" : "Dimensions: " . $product['dimensions_cm']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </form>

</body>
</html>