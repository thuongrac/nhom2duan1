<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$database = "dulieumau"; // Đổi "ten_database" thành tên cơ sở dữ liệu của bạn

// Tạo kết nối
$conn = new mysqli(hostname: $servername, username: $username, password: $password, database: $database);

// Kiểm tra kết nối và debug lỗi
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
} else {
    // echo "Kết nối thành công!";
}
function pdo_get_connection(){
    $dburl = "mysql:host=localhost;dbname=dulieumau;charset=utf8";
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO($dburl, username: $username, password: $password);
        $conn->setAttribute(attribute: PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Kết nối thất bại: " . $e->getMessage());
    }
}

// Hàm thực hiện truy vấn và lấy một kết quả duy nhất
function pdo_query_one($sql){
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
?>
