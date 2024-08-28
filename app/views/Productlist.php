<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .product-card {
            border: 1px solid black;
            padding: 10px;
            width: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .delete-checkbox {
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .product-actions {
            margin-top: 20px;
        }

        .product-actions button {
            padding: 10px 15px;
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <h1>Product List</h1>

    <!-- Action Buttons -->
    <form method="post" action="index.php?action=delete_products">
        <div class="product-actions">
            <a href="./add-product"><button id="add-product-btn" type="button">ADD</button></a>
            <button id="delete-product-btn" type="submit">MASS DELETE</button>
        </div>

        <!-- Product List -->
        <div class="product-list">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <input type="checkbox" name="product_ids[]" class="delete-checkbox" value="<?php echo $product['sku']; ?>">
                    
                    <p><strong><?php echo $product['sku']; ?></strong></p>
                    <p><?php echo $product['name']; ?></p>
                    <p><?php echo $product['price']; ?> $</p>
                    <p>
                        <?php
                        if ($product['type'] == 'DVD') {
                            echo "Size: " . $product['size_mb'] . " MB";
                        } elseif ($product['type'] == 'Book') {
                            echo "Weight: " . $product['weight_kg'] . " Kg";
                        } elseif ($product['type'] == 'Furniture') {
                            echo "Dimensions: " . $product['dimensions_cm'];
                        }
                        ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </form>

</body>
</html>
