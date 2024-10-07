<?php
require_once __DIR__ . '/../core/database.php';  
require_once __DIR__ . '/../models/Product.php'; 

class AddProduct {
    private $product;

    public function __construct($db) {
        $this->init($db);
    }

    private function init($db) {
        $this->product = new Product($db);
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
            $attributes = $this->getAttributes($productType, $_POST);
            if ($this->product->skuExists($sku)) {
                echo json_encode(['success' => false, 'message' => 'SKU already exists!']);
                exit();
            }
            if ($this->product->addProduct($sku, $name, $price, $productType, $attributes)) {
                header('Location: ' . BASE_URL . '/home');
                exit();
            } else {
                $_SESSION['error_message'] = 'Failed to add product.';
                header('Location: ' . BASE_URL . '/add-product');
                exit();
            }
        }
    }
    
    private function getAttributes($productType, $postData) {
        $attributes = [];
        switch ($productType) {
            case 'DVD':
                $attributes['size_mb'] = $postData['size'] ?? null;
                break;
            case 'Book':
                $attributes['weight_kg'] = $postData['weight'] ?? null;
                break;
            case 'Furniture':
                $attributes['dimensions_cm'] = ($postData['height'] ?? '') . 'x' . ($postData['width'] ?? '') . 'x' . ($postData['length'] ?? '');
                break;
        }
        return $attributes;
    }
}
?>
