<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Kiểm tra xem người dùng đã đăng nhập và có quyền admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
    $error_message = "Bạn không có quyền truy cập vào trang admin.";
    echo "<div class='notification error'>$error_message</div>";
    exit;
}
require_once('../model/database.php'); // Đường dẫn chính xác đến database.php
require_once('./app/model/usermodel.php'); // Đường dẫn chính xác đến usermodel.php
require_once('./app/model/sanphammodel.php'); // Đường dẫn chính xác đến usermodel.php
require_once('./app/view/header.php');
// require_once('./app/controller/update_user.php');

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'user':
            $userModel = new UserModel();
            $data['user'] = $userModel->getAllUsers();
            require_once('app/view/userview.php'); // Đường dẫn đến userview.php
            break;
            case 'sanpham':
                $Sanphammodel = new Sanphammodel();
                $data['san_pham'] = $Sanphammodel->getAllSp();
                require_once('app/view/product.php'); // Đường dẫn đến userview.php
                break;
           
        default:
            // Xử lý các trang khác
            break;
    }
} else {
    // Xử lý khi không có trang cụ thể
}

require_once('./app/view/footer.php');
?>