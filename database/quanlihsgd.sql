-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 24, 2020 lúc 02:32 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlihsgd`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoa`
--

CREATE TABLE `khoa` (
  `makhoa` int(11) NOT NULL,
  `tenkhoa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `khoa`
--

INSERT INTO `khoa` (`makhoa`, `tenkhoa`) VALUES
(1, 'Cơ Khí'),
(2, 'Công Nghệ Thực Phẩm'),
(3, 'Công Nghệ Thông Tin'),
(4, 'Điện-Điện Tử');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mon`
--

CREATE TABLE `mon` (
  `mamon` int(11) NOT NULL,
  `tenmon` varchar(255) NOT NULL,
  `makhoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `mon`
--

INSERT INTO `mon` (`mamon`, `tenmon`, `makhoa`) VALUES
(1, 'Lập trình Web', 3),
(2, 'Nguyên Lí Động Cơ', 1),
(8, 'Xử Lí Ảnh', 3),
(9, 'Lập Trình Android', 3),
(16, 'Nhiệt Điện Lạnh', 1),
(48, 'Ngôn Ngữ Lập Trình', 3),
(57, 'Trí Tuệ Nhân Tạo', 3),
(64, 'Truyền Số Liệu', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhtich`
--

CREATE TABLE `thanhtich` (
  `id` int(11) NOT NULL,
  `macanbo` int(11) NOT NULL,
  `soquyetdinh` varchar(255) NOT NULL,
  `noidung` varchar(255) NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `nam` date NOT NULL,
  `ghichu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `thanhtich`
--

INSERT INTO `thanhtich` (`id`, `macanbo`, `soquyetdinh`, `noidung`, `hinhanh`, `nam`, `ghichu`) VALUES
(14, 111, 'Quyết định khen thưởng thành tích', 'Khen thưởng thành tích HK2 Năm học 2019-2020', 'bangkhen(1).jpg', '2020-06-06', ''),
(18, 222, 'quyết định số 100', 'Khen thuong hoc ky', 'NNLT_BaoCao-2_(1).pptx', '2020-06-03', 'abc'),
(19, 222, 'quyết định số 19', 'Khen thưởng thành tích', 'background(1).jpg', '2020-06-17', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `makhoa` int(11) NOT NULL,
  `macanbo` int(11) NOT NULL,
  `mamon` int(11) NOT NULL,
  `ngaydang` datetime NOT NULL,
  `loaitailieu` varchar(255) NOT NULL,
  `tenfile` varchar(255) NOT NULL,
  `loaifile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `uploads`
--

INSERT INTO `uploads` (`id`, `makhoa`, `macanbo`, `mamon`, `ngaydang`, `loaitailieu`, `tenfile`, `loaifile`) VALUES
(89, 3, 111, 1, '2020-06-24 19:15:56', 'Bài giảng', 'GT Web.docx', 'docx'),
(90, 3, 111, 1, '2020-06-24 19:16:10', 'Bài giảng', 'BG Web.pptx', 'pptx'),
(91, 3, 222, 1, '2020-06-24 19:17:13', 'Đề cương', 'DE CUONG CHI TIET-LAP TRINH WEB.pdf', 'pdf'),
(92, 3, 111, 48, '2020-06-24 19:17:37', 'Bài giảng', 'Chuong 3.pptx', 'pptx'),
(93, 3, 111, 48, '2020-06-24 19:17:53', 'Bài giảng', 'chuong 4.pptx', 'pptx'),
(94, 3, 222, 8, '2020-06-24 19:18:58', 'Giáo trình', 'GT XLA.docx', 'docx'),
(95, 3, 222, 8, '2020-06-24 19:19:38', 'Lịch giảng dạy', 'LichXLA.xlsx', 'xlsx'),
(96, 3, 222, 57, '2020-06-24 19:20:07', 'Bài giảng', 'GT TTNT.docx', 'docx'),
(97, 3, 111, 9, '2020-06-24 19:20:28', 'Bài giảng', 'bt_intent.pdf', 'pdf'),
(98, 3, 222, 64, '2020-06-24 19:23:06', 'Lịch giảng dạy', 'KHHT. TrSL.pdf', 'pdf'),
(99, 3, 222, 64, '2020-06-24 19:23:24', 'Giáo trình', 'Chuong 2.pdf', 'pdf'),
(100, 3, 111, 64, '2020-06-24 19:23:46', 'Giáo trình', 'Chuong 1-TruyenSoLieu.pdf', 'pdf');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `macanbo` int(11) NOT NULL,
  `matkhau` varchar(20) NOT NULL,
  `makhoa` int(11) NOT NULL,
  `chucvu` varchar(30) NOT NULL,
  `hocvi` varchar(255) NOT NULL,
  `chuyennganh` varchar(255) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `gioitinh` varchar(255) NOT NULL,
  `ngaysinh` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `sdt` text NOT NULL,
  `cmnd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`macanbo`, `matkhau`, `makhoa`, `chucvu`, `hocvi`, `chuyennganh`, `hoten`, `gioitinh`, `ngaysinh`, `email`, `sdt`, `cmnd`) VALUES
(1, 'admin', 3, 'ADMIN', 'Tiến Sĩ', 'Khoa Học Máy Tính', 'ADMIN', 'Nam', '1990-05-10', 'admin@gmail.com', '05865882', '332584559'),
(111, '123', 3, 'Giảng Viên', 'Thạc Sĩ', 'Khoa Học Máy Tính', 'Nguyễn Phương Ngân', 'Nữ', '1997-04-11', 'phuongngan@gmail.com', '096557813', '3318205691             '),
(123, '123', 1, 'Giảng viên', 'Thạc Sĩ', 'Cơ Khí', 'Nguyễn Văn A', 'Nam', '1990-11-12', 'nguyenvana@gmail.com', '0762862511', '331825682'),
(222, '123', 3, 'Giảng Viên', 'Thạc Sĩ', 'Hệ Thống Thông Tin', 'Lê Trung Thành', 'Nam', '1995-06-10', 'trungthanh@gmail.com', '0123456782', '3318205692');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`makhoa`);

--
-- Chỉ mục cho bảng `mon`
--
ALTER TABLE `mon`
  ADD PRIMARY KEY (`mamon`),
  ADD KEY `mon_ibfk_1` (`makhoa`);

--
-- Chỉ mục cho bảng `thanhtich`
--
ALTER TABLE `thanhtich`
  ADD PRIMARY KEY (`id`),
  ADD KEY `macanbo` (`macanbo`);

--
-- Chỉ mục cho bảng `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uploads_ibfk_2` (`makhoa`),
  ADD KEY `uploads_ibfk_3` (`mamon`),
  ADD KEY `macanbo` (`macanbo`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`macanbo`),
  ADD KEY `user_ibfk_1` (`makhoa`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `khoa`
--
ALTER TABLE `khoa`
  MODIFY `makhoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `mon`
--
ALTER TABLE `mon`
  MODIFY `mamon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT cho bảng `thanhtich`
--
ALTER TABLE `thanhtich`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `macanbo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1700456;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `mon`
--
ALTER TABLE `mon`
  ADD CONSTRAINT `mon_ibfk_1` FOREIGN KEY (`makhoa`) REFERENCES `khoa` (`makhoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `thanhtich`
--
ALTER TABLE `thanhtich`
  ADD CONSTRAINT `thanhtich_ibfk_1` FOREIGN KEY (`macanbo`) REFERENCES `user` (`macanbo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_ibfk_2` FOREIGN KEY (`makhoa`) REFERENCES `khoa` (`makhoa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uploads_ibfk_3` FOREIGN KEY (`mamon`) REFERENCES `mon` (`mamon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uploads_ibfk_4` FOREIGN KEY (`macanbo`) REFERENCES `user` (`macanbo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`makhoa`) REFERENCES `khoa` (`makhoa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
