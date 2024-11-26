<?php
require_once('../model/database.php'); // Đảm bảo đường dẫn đúng
require_once('../model/Sanphammodel.php'); // Bao gồm model sản phẩm

// Bật chế độ báo lỗi để dễ dàng gỡ lỗi
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ POST
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? null;
    $price = $_POST['price'] ?? null;
    $categoryId = $_POST['category'] ?? null; // Đảm bảo đây là ID của danh mục
    $image = $_POST['image'] ?? null;

    // Kiểm tra xem tất cả các biến đã được cung cấp
    if ($id && $name && $price !== null && $categoryId && $image) {
        // Tạo một instance của model
        $model = new Sanphammodel();

        // Cập nhật sản phẩm
        if ($model->updateSp($id, $name, $price, $categoryId, $image)) {
            // Trả về phản hồi thành công
            echo json_encode(['success' => true]);
        } else {
            // Trả về phản hồi thất bại
            echo json_encode(['success' => false, 'message' => 'Cập nhật thất bại do không có thay đổi nào hoặc ID không tồn tại.']);
        }
    } else {
        // Trả về phản hồi nếu có trường thiếu
        echo json_encode(['success' => false, 'message' => 'Thiếu thông tin cần thiết.']);
    }
} else {
    // Trả về phản hồi nếu không phải là yêu cầu POST
    echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ.']);
}
?>