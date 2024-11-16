<?php
require_once 'database.php';
session_start();
function check_login($taikhoan, $matkhau) {
    global $pdo;

    // Dùng prepared statement để tránh SQL Injection
    $stmt = $pdo->prepare("SELECT * FROM user WHERE taikhoan = :taikhoan");
    $stmt->bindParam(':taikhoan', $taikhoan);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Kiểm tra nếu người dùng tồn tại và mật khẩu đúng
    if ($user && password_verify($matkhau, $user['matkhau'])) {
        return $user;
    }
    return false; // Trả về false nếu không tìm thấy tài khoản hoặc mật khẩu sai
}

?>