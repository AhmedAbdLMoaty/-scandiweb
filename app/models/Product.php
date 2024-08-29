<?php

require_once __DIR__ . '/ProductsType.php';

class Product {
    private $conn;
    private $table = "products";

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
        $product = null;
        switch ($productType) {
            case 'DVD':
                $product = new DVD($sku, $name, $price, $attributes['size_mb']);
                break;
            case 'Book':
                $product = new Book($sku, $name, $price, $attributes['weight_kg']);
                break;
            case 'Furniture':
                $product = new Furniture($sku, $name, $price, $attributes['dimensions_cm']);
                break;
        }
        if ($product) {
            $query = "INSERT INTO " . $this->table . " (sku, name, price, type, attributes) VALUES (:sku, :name, :price, :type, :attributes)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':sku', $sku);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':type', $productType);
            $stmt->bindParam(':attributes', json_encode($product->getAttributes()));
            return $stmt->execute();
        }
        return false;
    }

public function deleteProducts($skus) {
    $placeholders = implode(',', array_fill(0, count($skus), '?'));
    $query = "DELETE FROM " . $this->table . " WHERE sku IN ($placeholders)";
    $stmt = $this->conn->prepare($query);
    return $stmt->execute($skus);
}
}
?>
