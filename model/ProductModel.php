<?php
// Sử dụng các hàm đã định nghĩa trong file database.php
require_once 'model/database.php';

class ProductModel {
    private $conn;

    public function __construct() {
        // Thay vì tạo đối tượng Database, bạn chỉ cần sử dụng hàm kết nối PDO trực tiếp
        $this->conn = pdo_get_connection();
    }

    public function getBestSellingProducts() {
        $query = "
            SELECT sp.*, h.hinh, dm.tendanhmuc 
            FROM san_pham sp
            LEFT JOIN hinh h ON sp.id_hinh = h.id_hinh
            LEFT JOIN danh_muc dm ON sp.id_danhmuc = dm.id_danhmuc
            ORDER BY sp.id_sanpham ASC LIMIT 8
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getNewProducts() {
        $query = "
            SELECT sp.*, h.hinh, dm.tendanhmuc 
            FROM san_pham sp
            LEFT JOIN hinh h ON sp.id_hinh = h.id_hinh
            LEFT JOIN danh_muc dm ON sp.id_danhmuc = dm.id_danhmuc
            ORDER BY sp.id_sanpham ASC LIMIT 8 OFFSET 8
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
