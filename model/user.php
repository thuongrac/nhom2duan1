<?php
require_once 'database.php';

function check_login($taikhoan, $matkhau) {
    // Get the PDO connection
    $pdo = pdo_get_connection(); 

    // Use prepared statement to prevent SQL Injection
    $stmt = $pdo->prepare("SELECT * FROM user WHERE taikhoan = :taikhoan");
    $stmt->bindParam(':taikhoan', $taikhoan);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists and the password is correct
    if ($user && password_verify($matkhau, $user['matkhau'])) {
        return $user;
    }
    return false; // Return false if no account found or incorrect password
}


function is_username_taken($username) {
    $stmt = pdo_get_connection()->prepare("SELECT COUNT(*) FROM user WHERE taikhoan = :taikhoan");
    $stmt->bindParam(':taikhoan', $username);
    $stmt->execute();
    return $stmt->fetchColumn() > 0; // Trả về true nếu tài khoản đã tồn tại
}


?>
