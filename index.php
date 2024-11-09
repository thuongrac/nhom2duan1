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
       
        case 'dangky':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $hoten = $_POST['hoten'];
                $email = $_POST['email'];
                $dienthoai = $_POST['dienthoai'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $register_result = register_user($hoten, $email, $dienthoai, $username, $password);
                if ($register_result === true) {
                    echo '<p style="color: green;">Đăng ký thành công! Đăng nhập <a href="index.php?pg=dangnhap">tại đây</a>.</p>';
                } else {
                    echo '<p style="color: red;">Đăng ký thất bại: ' . $register_result . '</p>';
                }
            }
            include "view/dangky.php";
            break;
        case 'dangnhap':
            if (isset($_SESSION['user_id'])) {
                header("Location: index.php");
                exit();
            }
        
            $checkMK = 0; 
            $saimatkhau = ''; 
            $saitaikhoan = ''; 
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['username']) && isset($_POST['password'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    
                    // Sử dụng tên trường trong bảng SQL đúng với 'taikhoan' thay vì 'username'
                    $user = get_user_by_username($username);
                    
                    if ($user) {
                        // Sửa lại để lấy đúng id_user từ bảng SQL
                        $id_user = $user['id_user']; 
                        $_SESSION['name'] = $username;
                        $_SESSION['id_user'] = $id_user;
                        
                        // Sử dụng hàm login_user để kiểm tra mật khẩu
                        $login_result = login_user($username, $password);
                        
                        if ($login_result) {
                            $_SESSION['user_id'] = $login_result;
                            if (isset($_SESSION['is_admin']) && ($_SESSION['is_admin'] == 1)) {
                                echo '<center><p style="color: green;">Đăng nhập thành công!</p></center>';
                                header("Location: admin/index.php");
                            } else {
                                echo '<center><p style="color: green;">Đăng nhập thành công!</p></center>';
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
            if ($is_user_logged_in) {
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

