<?php
session_start();
ob_start();

include "model/database.php";
include "view/header.php";
include "model/sanpham.php";
include "model/user.php";

// Biến kiểm tra lỗi đăng nhập
$checkMK = 0; 
$saimatkhau = "";
$saitaikhoan = "";

// Xử lý đăng nhập
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['pg']) && $_GET['pg'] === 'dangnhap') {
    $taikhoan = trim($_POST['taikhoan']);
    $matkhau = trim($_POST['matkhau']);

    // Kiểm tra tài khoản và mật khẩu
    $user = check_login($taikhoan, $matkhau); // Hàm check_login kiểm tra thông tin từ cơ sở dữ liệu

    if ($user) {
        // Lưu thông tin người dùng vào session
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['taikhoan'] = $user['taikhoan'];

        // Điều hướng về trang chủ sau khi đăng nhập thành công
        header("Location: index.php");
        exit();
    } else {
        $checkMK = 1; 
        $saimatkhau = "Sai tài khoản hoặc mật khẩu.";
    }
}

// Xử lý điều hướng trang
if (!isset($_GET['pg'])) {
    include "view/home.php"; // Trang mặc định là home
} else {
    switch ($_GET['pg']) {
        case 'dangnhap':
            include "view/dangnhap.php"; // Giao diện đăng nhập
            break;

        case 'dangxuat':
            // Xử lý đăng xuất
            if (isset($_SESSION['user_id'])) {
                session_unset();
                session_destroy();
                header("Location: index.php");
                exit();
            }
            break;

        case 'sanpham':
            include "view/sanpham.php"; 
            break;

        case 'giohang':
            include "view/giohang.php"; 
            break;

        case 'thanhtoan':
            include "view/thanhtoan.php"; 
            break;

        default:
            echo "<h1>Trang không tồn tại!</h1>"; 
            break;
    }
}

include "view/footer.php";
?>
