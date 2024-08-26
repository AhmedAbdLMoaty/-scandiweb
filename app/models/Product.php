<?php
class Product {
    private $conn;
    private $table = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllProducts() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function deleteProducts($productIds) {
        if (empty($productIds)) {
            return;
        }

        // Create a comma-separated list of placeholders for the SQL query
        $placeholders = implode(',', array_fill(0, count($productIds), '?'));

        // Prepare the DELETE query
        $query = "DELETE FROM " . $this->table . " WHERE sku IN (" . $placeholders . ")";
        $stmt = $this->conn->prepare($query);

        // Execute the query with the product IDs
        $stmt->execute($productIds);
    }
}
?>
