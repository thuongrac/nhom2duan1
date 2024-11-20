<?php
require_once 'database.php';

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


function is_username_taken($username) {
    $stmt = pdo_get_connection()->prepare("SELECT COUNT(*) FROM user WHERE taikhoan = :taikhoan");
    $stmt->bindParam(':taikhoan', $username);
    $stmt->execute();
    return $stmt->fetchColumn() > 0; // Trả về true nếu tài khoản đã tồn tại
}
?>
