-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th10 19, 2024 lúc 03:06 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dulieumau`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bai_viet`
--

CREATE TABLE `bai_viet` (
  `id_baiviet` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_sanpham` int(11) DEFAULT NULL,
  `noidung` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `id_bill` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `ten` varchar(255) DEFAULT NULL,
  `dienthoai` varchar(20) DEFAULT NULL,
  `diachi` varchar(255) DEFAULT NULL,
  `pt_thanhtoan` varchar(50) DEFAULT NULL,
  `ngay_dat_hang` date DEFAULT NULL,
  `trangthai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_chi_tiet`
--

CREATE TABLE `bill_chi_tiet` (
  `id_billchitiet` int(11) NOT NULL,
  `id_sanpham` int(11) DEFAULT NULL,
  `id_donhang` int(11) DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `gia` decimal(10,2) DEFAULT NULL,
  `tongtien` decimal(10,2) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_muc`
--

CREATE TABLE `danh_muc` (
  `id_danhmuc` int(11) NOT NULL,
  `tendanhmuc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gio_hang`
--

CREATE TABLE `gio_hang` (
  `id` int(11) NOT NULL,
  `id_sanpham` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tensanpham` varchar(255) DEFAULT NULL,
  `gia` decimal(10,2) DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `thanhtien` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinh`
--

CREATE TABLE `hinh` (
  `id_hinh` int(11) NOT NULL,
  `hinh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham`
--

CREATE TABLE `san_pham` (
  `id_sanpham` int(11) NOT NULL,
  `id_danhmuc` int(11) DEFAULT NULL,
  `tensanpham` varchar(255) DEFAULT NULL,
  `sale` decimal(10,2) DEFAULT NULL,
  `gia` decimal(10,2) DEFAULT NULL,
  `luot_mua` int(11) DEFAULT NULL,
  `ngay_tao` date DEFAULT NULL,
  `id_hinh` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trang_thai_bill`
--

CREATE TABLE `trang_thai_bill` (
  `id_trangthai` int(11) NOT NULL,
  `trangthai` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `taikhoan` varchar(255) DEFAULT NULL,
  `matkhau` varchar(255) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `ban` tinyint(1) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id_user`, `taikhoan`, `matkhau`, `sdt`, `ban`, `admin`) VALUES
(1, 'admin', 'admin', '0123456789', 0, 1),
(2, 'tranthib', 'abc12345', '0987654321', 0, 0),
(3, 'phamvanh', 'pass6789', '0912345678', 1, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bai_viet`
--
ALTER TABLE `bai_viet`
  ADD PRIMARY KEY (`id_baiviet`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_sanpham` (`id_sanpham`);

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id_bill`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `bill_trtbill` (`trangthai`);

--
-- Chỉ mục cho bảng `bill_chi_tiet`
--
ALTER TABLE `bill_chi_tiet`
  ADD PRIMARY KEY (`id_billchitiet`),
  ADD KEY `id_sanpham` (`id_sanpham`),
  ADD KEY `id_donhang` (`id_donhang`);

--
-- Chỉ mục cho bảng `danh_muc`
--
ALTER TABLE `danh_muc`
  ADD PRIMARY KEY (`id_danhmuc`);

--
-- Chỉ mục cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sanpham` (`id_sanpham`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `hinh`
--
ALTER TABLE `hinh`
  ADD PRIMARY KEY (`id_hinh`);

--
-- Chỉ mục cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id_sanpham`),
  ADD KEY `id_danhmuc` (`id_danhmuc`),
  ADD KEY `id_hinh` (`id_hinh`);

--
-- Chỉ mục cho bảng `trang_thai_bill`
--
ALTER TABLE `trang_thai_bill`
  ADD PRIMARY KEY (`id_trangthai`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bai_viet`
--
ALTER TABLE `bai_viet`
  ADD CONSTRAINT `bai_viet_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `bai_viet_ibfk_2` FOREIGN KEY (`id_sanpham`) REFERENCES `san_pham` (`id_sanpham`);

--
-- Các ràng buộc cho bảng `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `bill_trtbill` FOREIGN KEY (`trangthai`) REFERENCES `trang_thai_bill` (`id_trangthai`);

--
-- Các ràng buộc cho bảng `bill_chi_tiet`
--
ALTER TABLE `bill_chi_tiet`
  ADD CONSTRAINT `bill_chi_tiet_ibfk_1` FOREIGN KEY (`id_sanpham`) REFERENCES `san_pham` (`id_sanpham`),
  ADD CONSTRAINT `bill_chi_tiet_ibfk_2` FOREIGN KEY (`id_donhang`) REFERENCES `bill` (`id_bill`);

--
-- Các ràng buộc cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `gio_hang_ibfk_1` FOREIGN KEY (`id_sanpham`) REFERENCES `san_pham` (`id_sanpham`),
  ADD CONSTRAINT `gio_hang_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Các ràng buộc cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `san_pham_ibfk_1` FOREIGN KEY (`id_danhmuc`) REFERENCES `danh_muc` (`id_danhmuc`),
  ADD CONSTRAINT `san_pham_ibfk_2` FOREIGN KEY (`id_hinh`) REFERENCES `hinh` (`id_hinh`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
