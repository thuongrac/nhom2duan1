<?php
require_once 'model/ProductModel.php';

class ProductController {
    public function displayProducts() {
        $productModel = new ProductModel();
        return $productModel->getAllProducts();
    }
}
?>
