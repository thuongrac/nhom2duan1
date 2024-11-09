<style>
    /* Tổng quan về phần đăng nhập */
#login {
    width: 100%;
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

#login h3 {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

#login p {
    text-align: center;
    font-size: 14px;
    color: #666;
}

/* Style cho các nhóm input */
.form-group-login {
    margin-bottom: 15px;
}

/* Style cho các input */
input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    outline: none;
}

/* Style cho các icon mắt */
.eye {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 20px;
    color: #ccc;
}

/* Style cho nút quên mật khẩu */
a {
    font-size: 12px;
    color: #007bff;
    text-decoration: none;
    display: inline-block;
    margin-top: 10px;
}

a:hover {
    text-decoration: underline;
}

/* Style cho nút đăng nhập */
.btn-login {
    margin-top: 20px;
    text-align: center;
}
button[type="submit"] {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    background-color: #000; /* Đổi màu nền thành đen */
    color: white; /* Chữ màu trắng để dễ đọc */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #333; /* Màu đen nhạt hơn khi hover */
}

/* Style cho thông báo lỗi */
.center {
    text-align: center;
    color: red;
}

/* Responsiveness */
@media (max-width: 480px) {
    #login {
        width: 90%;
        padding: 15px;
    }

    #login h3 {
        font-size: 20px;
    }
}

    </style>
<section>
    <div id="login">
        <h3 class="login-title">Đăng Nhập Hệ Thống</h3>
        <p>Bạn Chưa Có Tài Khoản? <a href="index.php?pg=dangky" style="color:blue">Đăng Ký</a></p>
        <?php if (isset($_SESSION['user_id'])): ?>
    <p>Bạn Đã Năng Nhập!</p>
<?php else: ?>
    <form action="index.php?pg=dangnhap" method="POST" id="form-login">

            <form action="index.php?pg=dangnhap" method="POST" id="form-login">
               
                <div class="form-group-login">
                    <input type="text" name="username" id="username" class="email-ip" placeholder="Tên đăng nhập " required />
                    
                </div>
                <div class="form-group-login">
                    <input type="password" name="password" id="password" placeholder="Mật khẩu " required />
                    <i class="far fa-eye eye"></i>
                    <i class="far fa-eye-slash eye eye-none"></i>
                
                </div>
                    <?php
                        if($checkMK==1){
                            echo $saimatkhau;
                        }
                        if($checkMK==2){
                            echo $saitaikhoan;
                        }
                    ?>
                    <a href="index.php?pg=forgot_password" style="margin-left:52px; color:#000">Quên Mật Khẩu?</a>
                <div class="btn-login pt-1">
                    <button type="submit">Đăng Nhập</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</section>
