<?php
class Product {
    private $conn;
    private $table = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllProducts() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id"; // Ensure sorting by primary key
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

    public function addProduct($sku, $name, $price, $type, $attributes) {
        $query = "INSERT INTO " . $this->table . " (sku, name, price, type, size_mb, weight_kg, dimensions_cm) 
                  VALUES (:sku, :name, :price, :type, :size_mb, :weight_kg, :dimensions_cm)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':type', $type);
        $stmt->bindValue(':size_mb', $attributes['size_mb'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':weight_kg', $attributes['weight_kg'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':dimensions_cm', $attributes['dimensions_cm'] ?? null, PDO::PARAM_STR);
    
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error: " . implode(":", $stmt->errorInfo());
            return false;
        }
    }

    public function deleteProducts($productIds) {
        $query = "DELETE FROM " . $this->table . " WHERE sku IN (" . implode(',', array_fill(0, count($productIds), '?')) . ")";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($productIds);
    }
}
?>