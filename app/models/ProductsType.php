<?php

abstract class ProductType {
    protected $sku;
    protected $name;
    protected $price;

    public function __construct($sku, $name, $price) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

    public function getSku() {
        return $this->sku;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    abstract public function getAttributes();
    abstract public function save($db);
}

class DVD extends ProductType {
    private $size;

    public function __construct($sku, $name, $price, $size) {
        parent::__construct($sku, $name, $price);
        $this->size = $size;
    }

    public function getAttributes() {
        return ['size_mb' => $this->size];
    }

    public function save($db) {
        $query = "INSERT INTO products (sku, name, price, type, size_mb) VALUES (:sku, :name, :price, 'DVD', :size_mb)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':size_mb', $this->size);
        return $stmt->execute();
    }
}

class Book extends ProductType {
    private $weight;

    public function __construct($sku, $name, $price, $weight) {
        parent::__construct($sku, $name, $price);
        $this->weight = $weight;
    }

    public function getAttributes() {
        return ['weight_kg' => $this->weight];
    }

    public function save($db) {
        $query = "INSERT INTO products (sku, name, price, type, weight_kg) VALUES (:sku, :name, :price, 'Book', :weight_kg)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':weight_kg', $this->weight);
        return $stmt->execute();
    }
}

class Furniture extends ProductType {
    private $dimensions;

    public function __construct($sku, $name, $price, $dimensions) {
        parent::__construct($sku, $name, $price);
        $this->dimensions = $dimensions;
    }

    public function getAttributes() {
        return ['dimensions_cm' => $this->dimensions];
    }

    public function save($db) {
        $query = "INSERT INTO products (sku, name, price, type, dimensions_cm) VALUES (:sku, :name, :price, 'Furniture', :dimensions_cm)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':dimensions_cm', $this->dimensions);
        return $stmt->execute();
    }
}
?>