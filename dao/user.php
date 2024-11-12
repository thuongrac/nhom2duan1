<?php
require_once 'database.php';
session_start();

/**
 * Function to log in a user by username and password.
 */
function login_user($username, $password): bool {
    error_log(message: "Tên đăng nhập: " . $username); // Ghi log tên tài khoản để kiểm tra
    $user = get_user_by_username($username);

    if ($user && password_verify($password, $user['matkhau'])) {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['taikhoan'] = $user['taikhoan'];
        $_SESSION['admin'] = $user['admin'] == 1;
        session_regenerate_id(delete_old_session: true);
        return true;
    } else {
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = 1;
        } else {
            $_SESSION['login_attempts']++;
        }
        if ($_SESSION['login_attempts'] >= 3) {
            // Thực hiện biện pháp bảo mật khi vượt quá số lần đăng nhập
        }
        return false;
    }
}

/**
 * Function to retrieve user information by username.
 */
function get_user_by_username($username) {
    $sql = "SELECT * FROM user WHERE taikhoan = ?";
    return pdo_query_one($sql, $username);
}
