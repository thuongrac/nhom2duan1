<?php


// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?pg=dangnhap");
    exit();
}

// Kết nối đến cơ sở dữ liệu
include_once('model/database.php'); // Sử dụng include_once

// Lấy thông tin người dùng dựa trên user_id
$user_id = $_SESSION['user_id'];
$pdo = pdo_get_connection(); // Gọi hàm để thiết lập kết nối
$stmt = $pdo->prepare("SELECT taikhoan, sdt, admin FROM user WHERE id_user = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: index.php?pg=dangnhap");
    exit();
}

// Xác định nhóm tài khoản
$group = ($user['admin'] == 1) ? 'Quản trị viên' : 'Khách hàng';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Hồ Sơ Khách Hàng</title>
    <style>
      

        .profile-container {
            max-width: 800px;
            margin: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-header img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            margin-right: 20px;
            object-fit: cover;
        }

        .profile-header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .profile-header p {
            margin: 5px 0;
            color: #666;
        }

        .form-group {
            margin-top: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .update-password {
            margin-top: 20px;
        }

        .update-password a {
            color: #007bff;
            text-decoration: none;
        }

        .update-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="profile-container">
    <div class="profile-header">
        <img src="public/upload/qa3.webp" alt="Ảnh đại diện">
        <div>
            <h1>Tên: <?php echo htmlspecialchars($user['taikhoan']); ?></h1>
            <p>Số điện thoại: <?php echo htmlspecialchars($user['sdt']); ?></p>
            <p>Nhóm tài khoản: <?php echo htmlspecialchars($group); ?></p> <!-- Hiển thị nhóm tài khoản -->
        </div>
    </div>

    <div class="form-group">
        <label for="avatar">Cập nhật hình đại diện:</label>
        <input type="file" id="avatar" name="avatar" accept="image/*">
    </div>

    <div class="update-password">
        <p><a href="index.php?pg=doimatkhau">Đổi mật khẩu</a></p>
    </div>

    <div class="form-group">
        <button type="button" onclick="alert('Hình đại diện đã được cập nhật!')">Cập nhật hình đại diện</button>
    </div>
</div>

</body>
</html>