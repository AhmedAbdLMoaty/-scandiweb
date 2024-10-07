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
        $query = "INSERT INTO " . $this->table . " (sku, name, price, type, size_mb, weight_kg, dimensions_cm, productType) VALUES (:sku, :name, :price, :type, :size_mb, :weight_kg, :dimensions_cm, :productType)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':sku', $sku);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':type', $productType);
        $stmt->bindValue(':size_mb', $attributes['size_mb'] ?? null);
        $stmt->bindValue(':weight_kg', $attributes['weight_kg'] ?? null);
        $stmt->bindValue(':dimensions_cm', $attributes['dimensions_cm'] ?? null);
        $stmt->bindValue(':productType', $productType);
        return $stmt->execute();
    }

    public function deleteProducts($skus) {
        $placeholders = implode(',', array_fill(0, count($skus), '?'));
        $query = "DELETE FROM " . $this->table . " WHERE sku IN ($placeholders)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($skus);
    }
}
?>
