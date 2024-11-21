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
?>  