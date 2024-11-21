<?php


require_once 'model/user.php'; // Đảm bảo bạn có file này để truy cập hàm check_login

$error = "";
$success = "";

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?pg=dangnhap");
    exit();
}

// Xử lý đổi mật khẩu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $matkhau_hientai = $_POST['matkhau_hientai'];
    $matkhau_moi = $_POST['matkhau_moi'];
    $matkhau_xacnhan = $_POST['matkhau_xacnhan'];

    // Kiểm tra mật khẩu hiện tại
    $user = check_login($_SESSION['username'], $matkhau_hientai);
    if (!$user) {
        $error = "Mật khẩu hiện tại không chính xác.";
    } elseif (strlen($matkhau_moi) < 6) {
        $error = "Mật khẩu mới phải có ít nhất 6 ký tự.";
    } elseif ($matkhau_moi !== $matkhau_xacnhan) {
        $error = "Mật khẩu mới và xác nhận không khớp.";
    } else {
        // Mã hóa mật khẩu mới
        $hashed_password = password_hash($matkhau_moi, PASSWORD_DEFAULT);

        // Cập nhật mật khẩu trong cơ sở dữ liệu
        $stmt = pdo_get_connection()->prepare("UPDATE user SET matkhau = :matkhau WHERE id_user = :id_user");
        $stmt->bindParam(':matkhau', $hashed_password);
        $stmt->bindParam(':id_user', $userId);

        if ($stmt->execute()) {
            $success = "Đổi mật khẩu thành công!";
        } else {
            $error = "Đã xảy ra lỗi. Vui lòng thử lại.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu</title>
</head>
<body>
<div id="change-password">
    <h2>Đổi Mật Khẩu</h2>
    <?php if (!empty($error)): ?>
        <div class="notification error"><?php echo $error; ?></div>
    <?php elseif (!empty($success)): ?>
        <div class="notification success"><?php echo $success; ?></div>
    <?php endif; ?>
    <form action="index.php?pg=doimatkhau" method="POST">
        <div class="form-group">
            <label for="matkhau_hientai">Mật Khẩu Hiện Tại</label>
            <input type="password" name="matkhau_hientai" id="matkhau_hientai" required>
        </div>
        <div class="form-group">
            <label for="matkhau_moi">Mật Khẩu Mới</label>
            <input type="password" name="matkhau_moi" id="matkhau_moi" required>
        </div>
        <div class="form-group">
            <label for="matkhau_xacnhan">Xác Nhận Mật Khẩu Mới</label>
            <input type="password" name="matkhau_xacnhan" id="matkhau_xacnhan" required>
        </div>
        <button type="submit">Đổi Mật Khẩu</button>
    </form>
</div>
        </form>
    </div>
</body>
<style>
    /* Đặt một số kiểu cho phần chứa biểu mẫu */
#change-password {
    width: 100%;
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

#change-password h2 {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

#change-password .notification {
    padding: 15px;
    margin: 10px 0;
    border-radius: 5px;
    font-size: 16px;
    text-align: center;
}

.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Các nhóm trường nhập liệu */
.form-group {
    position: relative;
    margin-bottom: 20px;
}

.form-group input {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    background-color: #f9f9f9;
}

.form-group input:focus {
    border-color: #007bff;
    outline: none;
}

.form-group label {
    position: absolute;
    top: -12px;
    left: 12px;
    font-size: 14px;
    color: #333;
    background-color: #fff;
    padding: 0 5px;
    transition: all 0.2s ease;
}

/* Hiệu ứng cho input khi có dữ liệu */
.form-group input:focus + label,
.form-group input:not(:focus):not(:placeholder-shown) + label {
    top: -20px;
    font-size: 12px;
    color: #007bff;
}

/* Nút đổi mật khẩu */
button {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #007bff;
}

/* Tối ưu hóa cho thiết bị di động */
@media (max-width: 768px) {
    #change-password {
        max-width: 100%;
        padding: 20px;
    }
}
    </style>
</html>