<?php
require_once __DIR__ . '/../core/database.php';  
require_once __DIR__ . '/../models/Product.php'; 

class Home {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function index() {
        if (isset($_GET['action']) && $_GET['action'] === 'delete_products' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->deleteProducts();
        } else {
            $this->showProductList();
        }
    }

    public function showProductList() {
        $product = new Product($this->db);
        $result = $product->getAllProducts();
        
        $products = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $products[] = $row;
        }

        include __DIR__ . '/../views/Productlist.php';  
    }

    private function deleteProducts() {
        if (isset($_POST['product_ids']) && is_array($_POST['product_ids'])) {
            $productIds = $_POST['product_ids'];
            $product = new Product($this->db);
            $product->deleteProducts($productIds);
        }
        header('Location: ./home/');
        exit();
    }
    
}
?>
