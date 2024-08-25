<?php
abstract class Product {
    protected $sku;
    protected $name;
    protected $price;
    protected $type;

    abstract public function save();

    public function setSKU($sku) {
        $this->sku = $sku;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setType(ProductType $type) {
        $this->type = $type;
    }

    public function getAllProducts() {
        $db = new Database();
        $db->query("SELECT * FROM products");
        return $db->resultSet();
    }

    public function delete($id) {
        $db = new Database();
        $db->query("DELETE FROM products WHERE id = :id");
        $db->bind(':id', $id);
        $db->execute();
    }
}
