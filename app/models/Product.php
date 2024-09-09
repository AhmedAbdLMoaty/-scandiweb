<?php

require_once __DIR__ . '/ProductsType.php';

class Product {
    private $conn;
    private $table = "products";
    private $db;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllProducts() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function skuExists($sku) {
        $query = "SELECT COUNT(*) FROM " . $this->table . " WHERE sku = :sku";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sku', $sku);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function addProduct($sku, $name, $price, $productType, $attributes) {
        // Save main product details
        $query = $this->db->prepare("INSERT INTO products (sku, name, price, productType) VALUES (:sku, :name, :price, :productType)");
        $query->execute([
            'sku' => $sku,
            'name' => $name,
            'price' => $price,
            'productType' => $productType
        ]);
    
        $productId = $this->db->lastInsertId(); // Get the last inserted product ID
    
        // Save product-specific attributes based on the type
        if ($productType === 'DVD') {
            $query = $this->db->prepare("INSERT INTO product_attributes (product_id, attribute_name, attribute_value) VALUES (:product_id, 'size', :value)");
            $query->execute(['product_id' => $productId, 'value' => $attributes['size']]);
        } elseif ($productType === 'Book') {
            $query = $this->db->prepare("INSERT INTO product_attributes (product_id, attribute_name, attribute_value) VALUES (:product_id, 'weight', :value)");
            $query->execute(['product_id' => $productId, 'value' => $attributes['weight']]);
        } elseif ($productType === 'Furniture') {
            $query = $this->db->prepare("INSERT INTO product_attributes (product_id, attribute_name, attribute_value) VALUES (:product_id, 'height', :value)");
            $query->execute(['product_id' => $productId, 'value' => $attributes['height']]);
    
            $query = $this->db->prepare("INSERT INTO product_attributes (product_id, attribute_name, attribute_value) VALUES (:product_id, 'width', :value)");
            $query->execute(['product_id' => $productId, 'value' => $attributes['width']]);
    
            $query = $this->db->prepare("INSERT INTO product_attributes (product_id, attribute_name, attribute_value) VALUES (:product_id, 'length', :value)");
            $query->execute(['product_id' => $productId, 'value' => $attributes['length']]);
        }
    
        return true;
    }
    

    public function deleteProducts($skus) {
        $placeholders = implode(',', array_fill(0, count($skus), '?'));
        $query = "DELETE FROM " . $this->table . " WHERE sku IN ($placeholders)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($skus);
    }
}
?>
