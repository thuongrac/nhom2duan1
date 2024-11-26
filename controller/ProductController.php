<?php
require_once 'model/ProductModel.php';
require_once 'model/database.php';


class ProductController {
    private $productModel;

    public function __construct() {
        $this->productModel = new ProductModel();
    }

    public function getBestSellingProducts() {
        return $this->productModel->getBestSellingProducts();
    }

    public function getNewProducts() {
        return $this->productModel->getNewProducts();
    }

    public function getProductById($id) {
        $db = pdo_get_connection(); 
        $query = "
            SELECT sp.*, h.hinh
            FROM san_pham sp
            LEFT JOIN hinh h ON sp.id_sanpham = h.id_hinh
            WHERE sp.id_sanpham = :id
        ";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
?>
