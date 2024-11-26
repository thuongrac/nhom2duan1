<?php
require_once 'database.php';

/**
 * Kiểm tra thông tin đăng nhập của người dùng.
 *
 * @param string $taikhoan Tên đăng nhập của người dùng.
 * @param string $matkhau Mật khẩu của người dùng.
 * @return array|false Trả về thông tin người dùng nếu đăng nhập thành công, ngược lại là false.
 */
function check_login($taikhoan, $matkhau) {
    // Kết nối PDO
    $pdo = pdo_get_connection(); 

    // Sử dụng prepared statement để ngăn chặn SQL Injection
    $stmt = $pdo->prepare("SELECT * FROM user WHERE taikhoan = :taikhoan");
    $stmt->bindParam(':taikhoan', $taikhoan);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Kiểm tra xem người dùng có tồn tại và mật khẩu có chính xác không
    if ($user && password_verify($matkhau, $user['matkhau'])) {
        return $user; // Trả về thông tin người dùng
    }
    return false; // Trả về false nếu không tìm thấy tài khoản hoặc mật khẩu không đúng
}
/**
 * Kiểm tra xem tên đăng nhập đã tồn tại hay chưa.
 *
 * @param string $username Tên đăng nhập cần kiểm tra.
 * @return bool Trả về true nếu tên đăng nhập đã tồn tại, ngược lại là false.
 */
function is_username_taken($username) {
    $pdo = pdo_get_connection(); // Kết nối PDO
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE taikhoan = :taikhoan");
    $stmt->bindParam(':taikhoan', $username);
    $stmt->execute();
    return $stmt->fetchColumn() > 0; // Trả về true nếu tài khoản đã tồn tại
}

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

?>  