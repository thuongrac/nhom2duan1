<?php
require_once('../model/database.php'); // Sửa đường dẫn cho đúng

class UserModel {
    private $db;

    // public function __construct() {
    //     $this->db = new Database();
    // }

    // Lấy tất cả người dùng
    public function getAllUsers() {
        $sql = "SELECT * FROM user"; // Giả sử bạn có bảng user
        $users = pdo_query_all($sql);
        if (!$users) {
            echo "Không có người dùng nào.";
        }
        return $users;
    }

    // Lấy người dùng theo ID
    public function getUserById($id) {
        $query = "SELECT * FROM user WHERE id_user = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

  }



?>