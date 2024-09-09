<?php
require_once __DIR__ . '/../core/database.php';
require_once __DIR__ . '/../models/Product.php';

class Home {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        $product = new Product($this->db);
        $products = $product->getAllProducts();
        include __DIR__ . '/../views/Productlist.php';
    }

    public function delete_products() {
        error_log("delete_products method called");
        if (isset($_POST['product_ids']) && is_array($_POST['product_ids'])) {
            $productIds = $_POST['product_ids'];
            error_log("Product IDs to delete: " . implode(", ", $productIds));
            $product = new Product($this->db);
            $product->deleteProducts($productIds);
        }
        header('Location: ' . BASE_URL . '/home');
        exit();
    }

    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productIds = $_POST['product_ids'] ?? [];
            $product = new Product($this->db);
            foreach ($productIds as $sku) {
                $product->deleteProduct($sku);
            }
            header('Location: ' . BASE_URL . '/home');
            exit();
        }
        $viewFile = __DIR__ . '/../views/addproduct.php';
        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            error_log("View file not found: " . $viewFile);
            header("HTTP/1.0 404 Not Found");
            include __DIR__ . '/../views/404.php';
            exit();
        }
    }
}
?>