<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
