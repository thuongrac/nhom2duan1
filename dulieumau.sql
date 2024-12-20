-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th10 23, 2024 lúc 03:10 AM
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
  `id_user` int(11) NOT NULL,
  `id_sanpham` int(11) DEFAULT NULL,
  `noidung` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `id_bill` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
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
  `tendanhmuc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danh_muc`
--

INSERT INTO `danh_muc` (`id_danhmuc`, `tendanhmuc`) VALUES
(1, 'Giày'),
(2, 'Áo'),
(3, 'Balo'),
(4, 'Túi xách');

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
  `hinh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hinh`
--

INSERT INTO `hinh` (`id_hinh`, `hinh`) VALUES
(1, 'g1.webp'),
(2, 'g2.webp'),
(3, 'g3.webp'),
(4, 'g4.webp'),
(5, 'g5.webp'),
(6, 'g6.webp'),
(7, 'g7.webp'),
(8, 'g8.webp'),
(9, 'g9.webp'),
(10, 'g10.webp'),
(11, 'g11.webp'),
(12, 'g12.webp'),
(13, 'g13.webp'),
(14, 'g14.webp'),
(15, 'g15.webp'),
(16, 'g16.webp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `view` int(11) DEFAULT 0
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

--
-- Đang đổ dữ liệu cho bảng `san_pham`
--

INSERT INTO `san_pham` (`id_sanpham`, `id_danhmuc`, `tensanpham`, `sale`, `gia`, `luot_mua`, `ngay_tao`, `id_hinh`) VALUES
(1, 1, 'Giày Nike Air Force 1', 0.00, 2000000.00, 50, '2024-01-01', 1),
(2, 1, 'Giày Adidas Ultraboost', 10.00, 2500000.00, 30, '2024-01-05', 2),
(3, 1, 'Giày Puma Suede Classic', 15.00, 1800000.00, 40, '2024-02-10', 3),
(4, 1, 'Giày Converse Chuck 70', 20.00, 1500000.00, 25, '2024-03-15', 4),
(5, 1, 'Giày Vans Old Skool', 15.00, 1700000.00, 60, '2024-04-20', 5),
(6, 1, 'Giày New Balance 327', 5.00, 2200000.00, 45, '2024-05-01', 6),
(7, 1, 'Giày ASICS Gel-Kayano', 30.00, 2400000.00, 35, '2024-06-10', 7),
(8, 1, 'Giày Reebok Classic', 10.00, 1600000.00, 20, '2024-07-15', 8),
(9, 1, 'Giày Urban Step', 0.00, 1100000.00, 50, '2024-01-01', 9),
(10, 1, 'Giày Velocity Vibe', 10.00, 2200000.00, 30, '2024-01-05', 10),
(11, 1, 'Giày Trail Blazer', 15.00, 3300000.00, 40, '2024-02-10', 11),
(12, 1, 'Giày Edge Runner', 20.00, 4400000.00, 25, '2024-03-15', 12),
(13, 1, 'Giày Aero Glide', 0.00, 5500000.00, 60, '2024-04-20', 13),
(14, 1, 'Giày Fusion Force', 5.00, 6600000.00, 45, '2024-05-01', 14),
(15, 1, 'Giày Stride Swift', 0.00, 7700000.00, 35, '2024-06-10', 15),
(16, 1, 'Giày Momentum Max', 10.00, 8800000.00, 20, '2024-07-15', 16);

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
(3, 'phamvanh', 'pass6789', '0912345678', 1, 0),
(4, '0913515617', '$2y$10$XEPH./0Si0.LJ4y1m7eXHuutk4HvVcBLcpKbQ5BaWBIP4vcP0f7s.', '0913515617', NULL, NULL),
(5, '0913515619', '$2y$10$ZFFXy/4rXzEckd9yDCas0OPYBcBzha6lyAWvpiaRUwlqoFIaIdKfy', '0913515619', NULL, NULL),
(6, '0913515699', '$2y$10$M.Io1Fa2DvRDX8alceuHN./Wdgqv2ApsBl2k1I8LD06i7K9/A54Q2', '0913515699', NULL, NULL),
(7, '0913515666', '$2y$10$noGKcM9im9icrmEOzL749ebDrU/O2tCL.NQQBUYZrd2ldhADVarXi', '0913515666', NULL, NULL),
(8, 'thanhhoai', '$2y$10$YmAdp/IQ05jk788y5Mem4uRaTpQsO5lYiC4lwu04JkTmPXPgBOf3.', '0865184037', NULL, NULL),
(9, 'nth123', '$2y$10$d5q4cyOY7BF9EAcobDv1j.toIicDZpdaUakcINWzhtWQaivnnLS0S', '0865184037', NULL, NULL);

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
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bai_viet`
--
ALTER TABLE `bai_viet`
  MODIFY `id_baiviet` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `bill_chi_tiet`
--
ALTER TABLE `bill_chi_tiet`
  MODIFY `id_billchitiet` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `danh_muc`
--
ALTER TABLE `danh_muc`
  MODIFY `id_danhmuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `hinh`
--
ALTER TABLE `hinh`
  MODIFY `id_hinh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id_sanpham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bai_viet`
--
ALTER TABLE `bai_viet`
  ADD CONSTRAINT `bv_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Các ràng buộc cho bảng `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_trtbill` FOREIGN KEY (`trangthai`) REFERENCES `trang_thai_bill` (`id_trangthai`),
  ADD CONSTRAINT `bill_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Các ràng buộc cho bảng `bill_chi_tiet`
--
ALTER TABLE `bill_chi_tiet`
  ADD CONSTRAINT `bill_chi_tiet_ibfk_2` FOREIGN KEY (`id_donhang`) REFERENCES `bill` (`id_bill`);

--
-- Các ràng buộc cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `gh_sp` FOREIGN KEY (`id_sanpham`) REFERENCES `san_pham` (`id_sanpham`),
  ADD CONSTRAINT `gh_usver` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Các ràng buộc cho bảng `hinh`
--
ALTER TABLE `hinh`
  ADD CONSTRAINT `sp_hinh` FOREIGN KEY (`id_hinh`) REFERENCES `san_pham` (`id_hinh`);

--
-- Các ràng buộc cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `dm_sp` FOREIGN KEY (`id_danhmuc`) REFERENCES `danh_muc` (`id_danhmuc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
