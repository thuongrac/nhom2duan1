<?php
require_once 'database.php';

function login_user($username, $password): bool {
    $user = get_user_by_username(username: $username);
    if ($user && password_verify(password: $password, hash: $user['password'])) {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['role'] == 1;
        session_regenerate_id(delete_old_session: true);
        return true;
    } else {
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = 1;
        } else {
            $_SESSION['login_attempts']++;
        }
        if ($_SESSION['login_attempts'] >= 3) {
            // Khoá tài khoản hoặc thực hiện các biện pháp bảo mật khác
            // ...
        }
        return false;
    }
}

// user.php

function get_user_by_username($username) {
    // Sử dụng cột 'taikhoan' thay vì 'username'
    $sql = "SELECT * FROM User WHERE taikhoan = ?";
    return pdo_query_one($sql, $username);
}


?>
