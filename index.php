<?php
session_start();
ob_start();
include "model/database.php";
include "view/header.php";
include "model/sanpham.php";
include "model/user.php";


$checkMK = 0; // Khởi tạo giá trị cho biến kiểm tra mật khẩu
$saimatkhau = "";
$saitaikhoan = "";

// Kiểm tra đăng nhập
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['pg']) && $_GET['pg'] === 'dangnhap') {
    $taikhoan = $_POST['taikhoan'];
    $matkhau = $_POST['matkhau'];

    // Kiểm tra tài khoản và mật khẩu
    $user = check_login($taikhoan, $matkhau); // Hàm check_login sẽ trả về thông tin người dùng nếu đúng

    if ($user) {
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['taikhoan'] = $user['taikhoan'];
        header("Location: index.php"); // Redirect về trang chủ sau khi đăng nhập thành công
        exit();
    } else {
        $checkMK = 1; // Đặt mã lỗi nếu sai mật khẩu
        $saimatkhau = "Sai mật khẩu";
    }
}


if (!isset($_GET['pg'])) {
    include "view/home.php";
} else {
    switch ($_GET['pg']) {
        case 'dangnhap':
            include "view/dangnhap.php"; // Tải giao diện đăng nhập
            break;
            case 'dangky':
                include "view/dangky.php"; // Tải giao diện đăng nhập
                break;
        case 'dangxuat':
            if (isset($_SESSION['user_id'])) {
                session_unset();
                session_destroy();
                header("Location: index.php");
                exit();
            }
            break;
    }
}
include "view/footer.php";
?>
