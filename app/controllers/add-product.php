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
            $errors = [];
    
            // Common validations
            if (empty($sku) || empty($name) || empty($price)) {
                $errors[] = 'Please, submit required data';
            }
    
            // Product-specific validations and attribute assignment
            if ($productType === 'DVD') {
                if (empty($_POST['size'])) {
                    $errors[] = 'Please, submit required data for DVD';
                } else {
                    $attributes['size'] = $_POST['size'];
                }
            } elseif ($productType === 'Book') {
                if (empty($_POST['weight'])) {
                    $errors[] = 'Please, submit required data for Book';
                } else {
                    $attributes['weight'] = $_POST['weight'];
                }
            } elseif ($productType === 'Furniture') {
                if (empty($_POST['height']) || empty($_POST['width']) || empty($_POST['length'])) {
                    $errors[] = 'Please, submit required data for Furniture dimensions';
                } else {
                    $attributes['height'] = $_POST['height'];
                    $attributes['width'] = $_POST['width'];
                    $attributes['length'] = $_POST['length'];
                }
            }
    
            // If there are errors, return them
            if (!empty($errors)) {
                $_SESSION['error_message'] = implode(', ', $errors);
                header('Location: ' . BASE_URL . '/add-product');
                exit();
            }
    
            // Proceed with saving the product
            $product = new Product($this->db);
            
            // Check if SKU exists
            if ($product->skuExists($sku)) {
                $_SESSION['error_message'] = 'SKU already exists!';
                header('Location: ' . BASE_URL . '/add-product');
                exit();
            }
    
            // Save the product and attributes in the database
            if ($product->addProduct($sku, $name, $price, $productType, $attributes)) {
                header('Location: ' . BASE_URL . '/home');
                exit();
            } else {
                $_SESSION['error_message'] = 'Failed to add product.';
                header('Location: ' . BASE_URL . '/add-product');
                exit();
            }
        }
    }
    

}


