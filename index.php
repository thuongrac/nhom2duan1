<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
ob_start();

include "model/database.php";
include "view/header.php";
include "model/sanpham.php";
include "model/user.php";


// Phần xử lý đăng nhập
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['pg']) && $_GET['pg'] === 'dangnhap') {
    $taikhoan = $_POST['username'];
    $matkhau = $_POST['password'];
    $error = ""; // Biến để lưu thông báo lỗi
    $success = ""; // Biến để lưu thông báo thành công

    // Kiểm tra thông tin đăng nhập
    $user = check_login($taikhoan, $matkhau);
    if ($user) {
        // Lưu thông tin người dùng vào session
        $_SESSION['user_id'] = $user['id_user']; // Giả sử bạn có trường id_user trong bảng user
        $_SESSION['username'] = $user['taikhoan'];
        $_SESSION['sdt'] = $user['sdt'];
        $_SESSION['admin'] = $user['admin']; // Lưu quyền admin vào session
        $success = "Đăng nhập thành công! Bạn sẽ được chuyển hướng đến trang chính.";
        echo "<meta http-equiv='refresh' content='3;url=index.php'>";
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu không chính xác.";
    }

    // Hiển thị thông báo lỗi hoặc thành công
    if (!empty($error)) {
        echo "<div class='notification error'>$error</div>";
    } elseif (!empty($success)) {
        echo "<div class='notification success'>$success</div>";
    }
}


// Phần xử lý đăng ký
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['pg']) && $_GET['pg'] === 'dangky') {
    $dienthoai = $_POST['dienthoai'];
    $taikhoan = $_POST['username'];
    $matkhau = $_POST['password'];
    $success = ""; // Biến để lưu thông báo thành công  

    // Kiểm tra số điện thoại
    if (!preg_match('/^0\d{9}$/', $dienthoai)) {
        $error = "Số điện thoại phải có số 0 ở đầu và đúng 10 số.";
    }

    // Kiểm tra tài khoản và mật khẩu
    if (strlen($taikhoan) < 6 || strlen($matkhau) < 6) {
        $error = "Tên đăng nhập và mật khẩu phải có ít nhất 6 ký tự.";
    }

    // Kiểm tra xem tài khoản đã tồn tại chưa
    if (empty($error) && is_username_taken($taikhoan)) {
        $error = "Tên đăng nhập đã tồn tại.";
    }

    // Nếu không có lỗi, tiến hành đăng ký
    if (empty($error)) {
        // Mã hóa mật khẩu
        $hashed_password = password_hash($matkhau, PASSWORD_DEFAULT);

        // Thêm vào cơ sở dữ liệu
        $stmt = pdo_get_connection()->prepare("INSERT INTO user (taikhoan, matkhau, sdt) VALUES (:taikhoan, :matkhau, :dienthoai)");
        $stmt->bindParam(':taikhoan', $taikhoan);
        $stmt->bindParam(':matkhau', $hashed_password);
        $stmt->bindParam(':dienthoai', $dienthoai);

        if ($stmt->execute()) {
            $success = "Đăng ký thành công! Bạn sẽ được chuyển hướng đến trang đăng nhập trong 3 giây.";
            // Tạo meta tag để tự động chuyển hướng
            echo "<meta http-equiv='refresh' content='3;url=index.php?pg=dangnhap'>";
        } else {
            $error = "Đăng ký không thành công. Vui lòng thử lại.";
        }
    }

    // Hiển thị thông báo lỗi hoặc thành công
    if (!empty($error)) {
        echo "<div class='notification error'>$error</div>";
    } elseif (!empty($success)) {
        echo "<div class='notification success'>$success</div>";
    }
}

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
