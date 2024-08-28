<?php
require_once __DIR__ . '/../core/database.php';  
require_once __DIR__ . '/../models/Product.php'; 

class AddProduct {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        include __DIR__ . '/../views/addproduct.php';  
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sku = $_POST['sku'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $productType = $_POST['productType'];

            $product = new Product($this->db);

            if ($product->skuExists($sku)) {
                echo json_encode(['success' => false, 'message' => 'SKU already exists']);
                exit();
            }

            $attributes = [];
            if ($productType === 'DVD') {
                $attributes['size_mb'] = $_POST['size'] ?? null;
            } elseif ($productType === 'Book') {
                $attributes['weight_kg'] = $_POST['weight'] ?? null;
            } elseif ($productType === 'Furniture') {
                $attributes['dimensions_cm'] = $_POST['height'] . 'x' . $_POST['width'] . 'x' . $_POST['length'];
            }

            if ($product->addProduct($sku, $name, $price, $productType, $attributes)) {
                header('Location: /home');
                exit();
            } else {
                echo json_encode(['success' => false, 'message' => 'Error saving product']);
                exit();
            }
        }
    }
}
