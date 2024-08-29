<?php
require_once __DIR__ . '/../core/database.php';  
require_once __DIR__ . '/../models/Product.php'; 
require_once __DIR__ . '/../models/ProductsType.php';

class Home {
    private $db;
    private $productModel;

    public function __construct($db) {
        $this->db = $db;
        $this->productModel = new Product($this->db);
    }

    public function index() {
        $this->showProductList();
    }

    public function showProductList() {
        $productList = $this->productModel->getAllProducts();
        $products = [];
    
        foreach ($productList as $row) {
            $products[] = $row;
        }
    
        include __DIR__ . '/../views/Productlist.php';  
    }

    public function delete_products() {
        if (isset($_POST['product_ids']) && is_array($_POST['product_ids'])) {
            $productIds = $_POST['product_ids'];
            $this->productModel->deleteProducts($productIds);
        }
        header('Location: /ecom_/public/home');
        exit();
    }

    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sku = $_POST['sku'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $productType = $_POST['productType'];
    
            if ($productType === 'DVD') {
                $product = new DVD($sku, $name, $price, $_POST['size']);
            } elseif ($productType === 'Book') {
                $product = new Book($sku, $name, $price, $_POST['weight']);
            } elseif ($productType === 'Furniture') {
                $dimensions = $_POST['height'] . 'x' . $_POST['width'] . 'x' . $_POST['length'];
                $product = new Furniture($sku, $name, $price, $dimensions);
            }
    
            if ($this->productModel->addProduct($product)) {
                header('Location: /ecom_/public/home');
                exit();
            } else {
                echo json_encode(['success' => false, 'message' => 'Error saving product']);
                exit();
            }
        }
        include __DIR__ . '/../views/addproduct.php';  
    }
}
?>