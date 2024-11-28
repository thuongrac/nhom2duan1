<?php
require_once 'model/database.php';

class ProductModel {
    private $conn;

    
    public function getAllProducts() {
        $query = "SELECT * FROM san_pham";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
