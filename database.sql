CREATE TABLE danh_muc (
    id_danhmuc INT PRIMARY KEY,
    tendanhmuc VARCHAR(255)
);

CREATE TABLE hinh (
    id_hinh INT PRIMARY KEY,
    hinh VARCHAR(255)
);

CREATE TABLE san_pham (
    id_sanpham INT PRIMARY KEY,
    id_danhmuc INT,
    tensanpham VARCHAR(255),
    sale DECIMAL(10, 2),
    gia DECIMAL(10, 2),
    luot_mua INT,
    ngay_tao DATE,
    id_hinh INT,
    FOREIGN KEY (id_danhmuc) REFERENCES danh_muc(id_danhmuc),
    FOREIGN KEY (id_hinh) REFERENCES hinh(id_hinh)
);

CREATE TABLE user (
    id_user INT PRIMARY KEY,
    taikhoan VARCHAR(255),
    matkhau VARCHAR(255),
    sdt VARCHAR(20),
    ban BOOLEAN,
    admin BOOLEAN
);

 

CREATE TABLE gio_hang (
    id INT PRIMARY KEY,
    id_sanpham INT,
    id_user INT,
    tensanpham VARCHAR(255),
    gia DECIMAL(10, 2),
    soluong INT,
    thanhtien DECIMAL(10, 2),
    FOREIGN KEY (id_sanpham) REFERENCES san_pham(id_sanpham),
    FOREIGN KEY (id_user) REFERENCES user(id_user)
);

CREATE TABLE bill (
    id_bill INT PRIMARY KEY,
    id_user INT,
    ten VARCHAR(255),
    dienthoai VARCHAR(20),
    diachi VARCHAR(255),
    pt_thanhtoan VARCHAR(50),
    ngay_dat_hang DATE,
    trangthai INT,
    FOREIGN KEY (id_user) REFERENCES user(id_user)
);

CREATE TABLE bill_chi_tiet (
    id_billchitiet INT PRIMARY KEY,
    id_sanpham INT,
    id_donhang INT,
    soluong INT,
    gia DECIMAL(10, 2),
    tongtien DECIMAL(10, 2),
    created_at DATE,
    FOREIGN KEY (id_sanpham) REFERENCES san_pham(id_sanpham),
    FOREIGN KEY (id_donhang) REFERENCES bill(id_bill)
);

CREATE TABLE trang_thai_bill (
    id_trangthai INT PRIMARY KEY,
    trangthai VARCHAR(50)
);