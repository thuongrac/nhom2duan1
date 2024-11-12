<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$database = "dulieumau"; // Đổi "ten_database" thành tên cơ sở dữ liệu của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối và debug lỗi
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
} else {
    // echo "Kết nối thành công!";
}
function pdo_get_connection(){
    $dburl = "mysql:host=localhost;dbname=duanmautest;charset=utf8";
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO($dburl, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        // Log or handle the error appropriately
        die("Connection failed: " . $e->getMessage());
    }
}
function pdo_query_one($sql){
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        // Log or handle the error appropriately
        die("Query failed: " . $e->getMessage());
    } finally {
        unset($conn);
    }
}
?>
