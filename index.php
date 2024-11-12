<?php
session_start();
ob_start();
include "dao/database.php";
include "view/header.php";
include "dao/sanpham.php";
include "dao/user.php";


if (!isset($_GET['pg'])) {
    include "view/home.php";
} else {
    switch ($_GET['pg']) {
        case 'dangnhap':
            if (isset($_SESSION['user_id'])) {
                header("Location: index.php");
                exit();
            }
            $checkMK = 0; 
            $saimatkhau = ''; 
            $saitaikhoan = ''; 
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!empty($_POST['taikhoan']) && !empty($_POST['matkhau'])) {
                    $username = $_POST['taikhoan'];
                    $password = $_POST['matkhau'];
                    $user = get_user_by_username($username);
                    if ($user) {
                        $login_result = login_user($username, $password);
                        if ($login_result) {
                            echo '<center><p style="color: green;">Đăng nhập thành công!</p></center>';
                            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                                header("Location: admin/index.php");
                            } else {
                                header("Location: index.php");
                            }
                            exit();
                        } else {
                            $checkMK = 1;
                            $saimatkhau = '<p style="color: red;">Đăng nhập thất bại: sai mật khẩu</p>';
                        }
                    } else {
                        $checkMK = 2;
                        $saitaikhoan = '<p style="color: red;">Tên đăng nhập không tồn tại!</p>';
                    }
                } else {
                    echo '<center><p style="color: red;">Thiếu thông tin đăng nhập!</p></center>';
                }
            }
            include "view/dangnhap.php";
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
