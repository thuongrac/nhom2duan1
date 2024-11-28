<?php
require_once('../../../model/database.php'); // Sửa đường dẫn cho đúng

class AdminModel {
    private $db;


    public function updateUserStatus($id, $ban, $admin) {
        try {
            // Chuẩn bị câu truy vấn SQL
            $sql = "UPDATE user SET ban = :ban, admin = :admin WHERE id_user = :id";
            
            // Thực thi câu truy vấn thông qua PDO
            $stmt = pdo_get_connection()->prepare($sql);
            $stmt->bindParam(':ban', $ban, PDO::PARAM_INT);
            $stmt->bindParam(':admin', $admin, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                return json_encode(['success' => true, 'message' => 'Cập nhật thành công']);
            } else {
                return json_encode(['success' => false, 'message' => 'Cập nhật thất bại']);
            }
        } catch (PDOException $e) {
            return json_encode(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()]);
        }
    }
    

  }



?>