<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "dulieumau"; // Đổi "dulieumau" thành tên cơ sở dữ liệu của bạn

function pdo_get_connection() {
    global $servername, $username, $password, $database; // Sử dụng biến toàn cục
    $dburl = "mysql:host=$servername;dbname=$database;charset=utf8";

    try {
        $conn = new PDO($dburl, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Kết nối thất bại: " . $e->getMessage());
    }
}

// Hàm thực hiện truy vấn và lấy một kết quả duy nhất
function pdo_query_one($sql) {
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        die("Truy vấn thất bại: " . $e->getMessage());
    } finally {
        unset($conn); // Đóng kết nối
    }
}

// Ví dụ sử dụng
// $user = pdo_query_one("SELECT * FROM user WHERE taikhoan = ?", "username_example");
?>