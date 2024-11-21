

<style>
   /* Đặt một số kiểu cho phần chứa biểu mẫu */
   #login {
  width: 100%;
  max-width: 400px;
  margin: 50px auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background-color: #fff;
}

#login h3.login-title {
  text-align: center;
  font-size: 24px;
  margin-bottom: 20px;
  color: #333;
}

#login p {
  text-align: center;
  margin-bottom: 20px;
  font-size: 14px;
}

#login p a {
  color: #007bff;
  text-decoration: none;
}

#login p a:hover {
  text-decoration: underline;
}

/* Các nhóm trường nhập liệu */
.form-group-login {
  position: relative;
  margin-bottom: 20px;
}

.form-group-login input {
  width: 100%;
  padding: 12px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  background-color: #f9f9f9;
}

.form-group-login input:focus {
  border-color: #007bff;
  outline: none;
}

.form-group-login label {
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
.form-group-login input:focus + label,
.form-group-login input:not(:focus):not(:placeholder-shown) + label {
  top: -20px;
  font-size: 12px;
  color: #007bff;
}

/* Nút đăng ký */
.btn-login button {
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

.btn-login button:hover {
  background-color: #007bff;
}

/* Biểu tượng mắt */
.eye {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  font-size: 18px;
  color: #888;
}

.eye-none {
  display: none;
}

.eye-slash {
  display: block;
}

#password:focus + .eye {
  display: block;
}

/* Tối ưu hóa cho thiết bị di động */
@media (max-width: 768px) {
  #login {
    max-width: 100%;
    padding: 20px;
  }
}


.notification {
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

        </style>
   <section>
  <div id="login">
    <h3 class="login-title">Đăng Nhập Hệ Thống</h3>
    <center><d>Chưa có tài khoản? <a href="index.php?pg=dangky" style="color:blue">Đăng Ký</a></d></center>
    <form action="index.php?pg=dangnhap" method="POST" id="form-login">
      <br>
      <!-- Các trường nhập liệu cho đăng nhập -->
      <div class="form-group-login">
      <label for="username">Tên Đăng Nhập</label>
        <input type="text" name="username" id="username" class="email-ip" placeholder=" " required />
      </div>
      <div class="form-group-login">
      <label for="password">Mật Khẩu</label>
        <input type="password" name="password" id="password" placeholder=" " required />
      </div>
      <div class="btn-login pt-1">
        <button type="submit">Đăng Nhập</button>
      </div>
    </form>
  </div>
</section>

    

