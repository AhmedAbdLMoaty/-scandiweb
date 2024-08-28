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
            $attributes = [];
            if ($productType === 'DVD') {
                $attributes['size_mb'] = $_POST['size'] ?? null;
            } elseif ($productType === 'Book') {
                $attributes['weight_kg'] = $_POST['weight'] ?? null;
            } elseif ($productType === 'Furniture') {
                $attributes['dimensions_cm'] = $_POST['height'] . 'x' . $_POST['width'] . 'x' . $_POST['length'];
            }
    
            // Instantiate the Product model
            $product = new Product($this->db);
    
            // Check if SKU already exists
            if ($product->skuExists($sku)) {
                echo json_encode(['success' => false, 'message' => 'SKU already exists!']);
                exit();
            }
    
            // Add product to the database
            if ($product->addProduct($sku, $name, $price, $productType, $attributes)) {
                echo json_encode(['success' => true, 'message' => 'Product added successfully!']);
                header('Location: /ecom_/public/home');
                exit();
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add product.']);
            }
            exit();
        }
    }
}
