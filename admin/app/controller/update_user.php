<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
require_once('../model/AdminModel.php');

// Kiểm tra phương thức POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['ban'], $_POST['admin'])) {
        $id = $_POST['id'];
        $ban = $_POST['ban'];
        $admin = $_POST['admin'];

        try {
            // Tạo đối tượng AdminModel
            $admModel = new AdminModel();

            // Gọi phương thức updateUserStatus để cập nhật thông tin người dùng
            $response = $admModel->updateUserStatus($id, $ban, $admin);

            // Trả về phản hồi dưới dạng JSON
            echo $response;
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra trong quá trình cập nhật: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Dữ liệu không đầy đủ']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Phương thức không hợp lệ']);
}

exit;
