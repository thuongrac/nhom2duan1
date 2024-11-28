<?php

// Cấu hình kết nối
$servername = "localhost";
$port = 3307;
$username = "root";
$password = "";
$database = "dulieumau";

function pdo_get_connection() {
    global $servername, $port, $username, $password, $database;
    $dsn = "mysql:host=$servername;port=$port;dbname=$database;charset=utf8";

    try {
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Kết nối thất bại: " . $e->getMessage());
    }
}

function pdo_query_all($sql) {
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Truy vấn thất bại: " . $e->getMessage());
    } finally {
        unset($conn); 
    }
}

function pdo_query_one($sql) {
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Truy vấn thất bại: " . $e->getMessage());
    } finally {
        unset($conn); 
    }
}


?>