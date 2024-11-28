<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
ob_start();

include "model/database.php";
include "view/header.php";
<<<<<<< HEAD

//help @@@@
//@@@@@@@@@@@@@@@
//QuangAnhsieucapvippro
//!@@@@@@@@@@@@@@@
include "dao/sanpham.php";
include "dao/user.php";

=======
include "model/sanpham.php";
include "model/user.php";
>>>>>>> 2eb99a90e9339090407d955b9f5dd22fb4d31716


    //////////////////
if (!isset($_GET['pg'])) {
    include "view/home.php"; // Trang mặc định là home
} else {
    switch ($_GET['pg']) {
        case 'dangnhap':
            include "view/dangnhap.php"; // Giao diện đăng nhập
            break;
        case 'dangxuat':
            include "view/logout.php"; 
            break;
            case 'admin':
                include "admin/index.php"; 
                break;
        case 'dangky':
            include "view/dangky.php"; 
            break;
        case 'doimatkhau':
            include "view/doimatkhau.php"; 
                break;
        case 'lienhe':
            include "view/lienhe.php"; 
                break;
        case 'profile':
            include "view/profile.php"; 
               break;
        
        case 'sanpham':
            include "view/sanpham.php"; 
            break;

        case 'giohang':
            include "view/giohang.php"; 
            break;
    
        case 'chitietsp':
            include "view/chitietsp.php"; 
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
