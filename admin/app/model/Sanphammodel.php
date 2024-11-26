<?php
require_once('../model/database.php'); // Sửa đường dẫn cho đúng

class Sanphammodel {
    private $db;

    // public function __construct() {
    //     $this->db = new Database();
    // }

    // Lấy tất cả người dùng
    public function getAllSp() {
        $sql = "
           SELECT sp.*, dm.tendanhmuc, h.hinh
FROM san_pham AS sp
JOIN danh_muc AS dm ON sp.id_danhmuc = dm.id_danhmuc
JOIN hinh AS h ON sp.id_hinh = h.id_hinh
           
        ";
        $products = pdo_query_all($sql);
        if (!$products) {
            echo "Không có sản phẩm nào.";
        }
        return $products;
    }
    // Lấy người dùng theo ID
    public function getSpById($id) {
        $query = "SELECT * FROM san_pham WHERE id_sanpham = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

  
  public function updateSp($id, $name, $price, $categoryId, $image) {
    $query = "
        UPDATE san_pham
        SET tensanpham = :name, gia = :price, id_danhmuc = :categoryId, id_hinh = :image
        WHERE id_sanpham = :id
    ";
    $this->db->query($query);
    $this->db->bind(':id', $id);
    $this->db->bind(':name', $name);
    $this->db->bind(':price', $price);
    $this->db->bind(':categoryId', $categoryId);
    $this->db->bind(':image', $image);
    
    return $this->db->execute(); // Returns true if successful
}
}


?>