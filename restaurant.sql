-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 17, 2017 lúc 11:32 AM
-- Phiên bản máy phục vụ: 10.1.25-MariaDB
-- Phiên bản PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `restaurant`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `id_table` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1: chua thanh toan, 2: da thanh toan',
  `description` text NOT NULL,
  `created` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `catalog`
--

CREATE TABLE `catalog` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `position` tinyint(4) NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `catalog`
--

INSERT INTO `catalog` (`id`, `name`, `position`, `img`) VALUES
(52, 'Món khai vị', 1, 'khaivi.png'),
(53, 'Món thịt', 2, 'thit.jpg'),
(54, 'Món rau', 4, 'rau.png'),
(55, 'Món lẩu', 5, 'lau.png'),
(56, 'Hải sản', 3, 'haisan.png'),
(57, 'Tráng miệng', 6, 'trangmieng.JPG');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `intro` text COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `google` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `youtube` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `view` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `content`
--

INSERT INTO `content` (`id`, `company_name`, `address`, `email`, `phone`, `intro`, `facebook`, `google`, `twitter`, `youtube`, `logo`, `slider`, `view`) VALUES
(1, 'Nhà hàng ABC', 'Số 2 Nguyễn Thị Thập, Cầu Giấy, Hà Nội', 'nhahangabc@gmail.com', '0916341138', '<p>Ch&agrave;o mừng c&aacute;c bạn&nbsp;đang&nbsp;đến với&nbsp;website của ch&uacute;ng t&ocirc;i</p>\r\n', '#', '#', '#', '#', 'logo1.png', 'img1.jpg/img2.jpg/img3.jpg', '3841-1400-11/2017-249-2-17/11/2017-0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `day_of_month`
--

CREATE TABLE `day_of_month` (
  `id` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `date` int(11) NOT NULL,
  `month_id` int(11) NOT NULL,
  `working_time` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `department`
--

INSERT INTO `department` (`id`, `name`, `parent_id`) VALUES
(1, 'Bộ phận phục vụ', 0),
(2, 'Bộ phận bếp', 0),
(4, 'Bộ phận kho', 0),
(5, 'Bộ phận quản lý tài chính', 0),
(6, 'Bộ phận vệ sinh', 0),
(7, 'Quản lý nhà hàng', 1),
(8, 'Nhân viên lễ tân', 1),
(9, 'Nhân viên phục vụ', 1),
(10, 'Nhân viên order', 1),
(11, 'Quản lý bếp', 2),
(12, 'Bếp trưởng', 2),
(13, 'Đầu bếp', 2),
(14, 'Phụ bếp', 2),
(15, 'Nhân viên mua hàng', 4),
(16, 'Nhân viên giao hàng, chở hàng', 4),
(17, 'Nhân viên thủ kho', 4),
(18, 'Nhân viên thu ngân', 5),
(19, 'Quản lý nhân sự', 5),
(20, 'Kế toán', 5),
(21, 'Bộ phận quản lý website', 0),
(22, 'Nhân viên trực máy', 21),
(23, 'Nhân viên quản trị web', 21),
(24, 'Nhân viên vệ sinh', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `wage` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `birthday` varchar(10) NOT NULL,
  `start_date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `employee`
--

INSERT INTO `employee` (`id`, `name`, `department_id`, `wage`, `phone`, `address`, `birthday`, `start_date`) VALUES
(1, 'Nguyễn Đức Bình', 11, 10000000, '0984787003', '', '01-06-1993', '16-08-2017'),
(2, 'Nguyễn Vân Anh', 19, 10000000, '01666537321', '', '16-11-1985', '09-08-2016'),
(3, 'Nguyễn Thanh Tùng', 23, 10000000, '0166622390', 'Số 26, 164 Nguyễn Lân, Thanh Xuân, Hà Nội', '13-10-1993', '13-06-2017'),
(4, 'Phạm Văn Trường', 17, 7000000, '0964777235', '19 Đại Từ, Hoàng Mai, Hà Nội', '16-10-1981', '11-08-2017'),
(5, 'Trần Trung Hiếu', 16, 7000000, '0123456789', 'Số 2 Nguyễn Thị Thập, Cầu Giấy, Hà Nội', '18-11-1990', '05-07-2017'),
(6, 'Vũ Văn Nguyên', 12, 15000000, '01637984321', 'Trường Chinh, Hà Nội', '26-02-1986', '17-11-2016'),
(7, 'Lê Tuấn Hải', 14, 7000000, '0946735866', 'Giải Phóng, Hà Nội', '15-05-1990', '07-06-2017'),
(8, 'Phan Văn Long', 13, 10000000, '0946454365', 'Đại La, Hà Nội', '03-08-1988', '04-07-2017'),
(9, 'Lê Thị Hằng', 10, 8000000, '0164946723', 'Đại La, Hà Nội', '04-07-1995', '12-07-2017'),
(10, 'Bùi Thị Thúy', 9, 5000000, '0946145458', 'Phương Mai, Hà Nội', '19-06-1996', '17-11-2017'),
(11, 'Nguyễn Thúy Anh', 8, 7000000, '01665489956', 'Tam Trinh, Hoàng Mai, Hà Nội', '03-02-1993', '14-06-2017'),
(12, 'Nguyễn Thị Thuận', 7, 12000000, '0123456789', 'Minh Khai, Hai Bà Trưng, Hà Nội', '17-11-1988', '10-07-2017'),
(13, 'Nguyễn Thị Hà', 15, 7000000, '0164946723', 'Thái Hà, Hà Nội', '14-08-1984', '30-08-2017'),
(14, 'Phạm Thu Huyền', 18, 8000000, '0946735866', 'Bạch Mai, Hai Bà Trưng, Hà Nội', '17-08-1993', '06-09-2017'),
(15, 'Lê Thị Vân', 20, 10000000, '0964777235', 'Lĩnh Nam, Hoàng Mai, Hà Nội', '17-11-1988', '06-09-2017'),
(16, 'Trần Văn Huy', 22, 6000000, '0964777235', 'Lê Thanh Nghị, Hai Bà Trưng, Hà Nội', '14-09-1992', '06-09-2017'),
(17, 'Nguyễn Thị Thu', 24, 5000000, '01637984321', 'Minh Khai, Hai Bà Trưng, Hà Nội', '04-11-1984', '15-06-2016');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dram` text NOT NULL,
  `catalog_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `food`
--

INSERT INTO `food` (`id`, `name`, `dram`, `catalog_id`, `quantity`) VALUES
(1, 'Thịt bò', 'kg', 53, 10),
(2, 'Thịt ba chỉ lợn', 'kg', 53, 15),
(3, 'Rau muống', 'kg', 54, 5),
(4, 'Cá quả', 'kg', 56, 6),
(5, 'Ếch', 'kg', 56, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `import`
--

CREATE TABLE `import` (
  `id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `create_by` int(11) NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `import`
--

INSERT INTO `import` (`id`, `food_id`, `quantity`, `price`, `create_by`, `created`) VALUES
(1, 2, 10, 60000, 4, 1510586913),
(2, 1, 10, 250000, 4, 1510587317),
(3, 2, 5, 60000, 4, 1510587682),
(4, 3, 5, 15000, 4, 1510588782),
(5, 4, 6, 150000, 4, 1510588950);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `weigh` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ingredients`
--

INSERT INTO `ingredients` (`id`, `food_id`, `product_id`, `weigh`) VALUES
(5, 5, 72, 0.5),
(12, 5, 73, 0.5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `month`
--

CREATE TABLE `month` (
  `id` int(11) NOT NULL,
  `month_name` varchar(40) NOT NULL,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `start_day` varchar(10) NOT NULL,
  `day_off` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(255) NOT NULL,
  `catalog_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `img_link` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `view` int(11) NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `catalog_id`, `name`, `price`, `discount`, `img_link`, `view`, `create_time`) VALUES
(1, 52, 'Súp tôm chua cay', 65, 0, 'khaivi.png', 0, 1510074218),
(2, 52, 'Salad củ đậu dừa tưoi', 78000, 0, 'salad.png', 0, 1510152568),
(3, 52, 'Súp nấm tôm tươi', 58000, 0, 'supnam.png', 0, 1510152788),
(4, 57, 'Súp gà măng trúc non', 49000, 0, 'supga.png', 0, 1510152846),
(5, 52, 'Súp cua, gà sợi ngô non', 65000, 0, 'supcua.png', 0, 1510152906),
(6, 52, 'Súp hải sản đậu phụ', 58000, 0, 'suphaisan.png', 0, 1510152989),
(7, 53, 'Bò nhúng giấm cuốn bánh tráng', 198000, 0, 'bonhunggiam.jpg', 0, 1510153044),
(8, 53, 'Thịt ba chỉ rang cháy cạnh', 78000, 0, 'thitbachi.jpg', 0, 1510153089),
(9, 53, 'Thăn lợn quay mật ong', 118000, 0, 'thanlon.jpg', 0, 1510153120),
(10, 53, 'Thịt heo quay da giòn', 118000, 0, 'thitheo.jpg', 0, 1510153164),
(11, 53, 'Thịt ba chỉ luộc chấm mắm ruốc', 98000, 0, 'thitbachiluoc.jpg', 0, 1510153205),
(12, 53, 'Thịt ba chỉ trứng cút kho tộ', 98000, 0, 'thitbachitrungcut.jpg', 0, 1510153249),
(13, 53, 'HEO CẮP NÁCH NƯỚNG RIỀNG MẺ', 138000, 0, 'heohapnach.jpg', 0, 1510153320),
(14, 53, 'THỊT DẢI NƯỚNG MUỐI', 138, 0, 'thitdai.jpg', 0, 1510153349),
(15, 53, 'Nõn đuôi nướng', 98000, 0, 'nonduoi.jpg', 0, 1510153372),
(16, 53, 'CHÂN GIÒ QUAY DA GIÒN', 98000, 0, 'changioquay.jpg', 0, 1510153442),
(17, 53, 'SƯỜN CHIÊN CHAO ĐỖ', 148000, 0, 'suonchien.jpg', 0, 1510153472),
(18, 53, 'SƯỜN THĂN CHIÊN TỎI ỚT', 148000, 0, 'suonthan.jpg', 0, 1510153518),
(19, 53, 'SƯỜN XÀO CHUA NGỌT', 138000, 0, 'suonxao.jpg', 0, 1510153559),
(20, 53, 'SƯỜN NƯỚNG MẬT ONG', 168000, 0, 'suonnuong.jpg', 0, 1510153586),
(21, 53, 'SƯỜN RAM SỐT MƠ', 148000, 0, 'suonram.jpg', 0, 1510153620),
(22, 57, 'GÀ QUAY NGUYÊN CON', 495000, 0, 'gaquay.jpg', 0, 1510153664),
(23, 53, 'GÀ RANG GỪNG HÀNH NỒI ĐẤT', 168, 0, 'garang.jpg', 0, 1510153695),
(24, 53, 'ĐĨA GHÉP VỊT QUAY TỔNG HỢP', 298000, 0, 'vitquaytonghop.jpg', 0, 1510153755),
(25, 53, 'VỊT QUAY LÁ MÓC MẬT', 595000, 0, 'vitquay.jpg', 0, 1510153793),
(26, 53, 'ẾCH XÀO ỚT KHÔ SỐT DẦU HÀO NỒI ĐẤT', 165000, 0, 'echxao.jpg', 0, 1510153823),
(27, 53, 'THỊT BÊ TÁI CHANH', 158000, 0, 'betaichanh.jpg', 0, 1510153850),
(28, 57, 'VỊT HẤP SỐT ĐẶC BIỆT', 235000, 0, 'vithap.jpg', 0, 1510153897),
(29, 53, 'THỊT BÒ XÀO DƯA CHUA', 128000, 0, 'boxao.jpg', 0, 1510153935),
(30, 56, 'Tôm Sú Chiên Sả Ớt', 215000, 0, 'tomsu.png', 0, 1510154124),
(31, 56, 'Tôm Chao Muối Bỏ Lò', 245000, 0, 'tomchao.png', 0, 1510154124),
(32, 56, 'CÁ LÓC CHIÊN GIÒN SỐT XÌ DẦU', 265000, 0, 'caloc.png', 0, 1510154450),
(33, 56, 'CÁ DIÊU HỒNG CHIÊN GIÒN CHẤM MẮM CHUA CAY', 255000, 0, 'cadieuhong.png', 0, 1510154531),
(34, 56, 'CÁ DIÊU HỒNG HẤP XÌ DẦU KÈM BÚN BÁNH TRÁNG', 295000, 0, 'cadieuhong1.png', 0, 1510154560),
(35, 56, 'CÁ DIÊU HỒNG CHIÊN GIÒN SỐT XÌ DẦU', 265000, 0, 'cadieuhong2.png', 0, 1510154620),
(36, 56, 'NGAO HẤP GỪNG, SẢ NỒI ĐẤT', 88000, 0, 'ngaohap.png', 0, 1510154660),
(37, 56, 'NGAO XÀO HÚNG QUẾ', 88000, 0, 'ngaoxao.png', 0, 1510154715),
(38, 56, 'NGAO HẤP CAY KIỂU THÁI', 88000, 0, 'ngaohap1.png', 0, 1510154743),
(39, 56, 'CHẢ NGÊU CHẤM SỐT RAU RĂM', 118000, 0, 'changheu.png', 0, 1510154769),
(40, 56, 'MỰC TƯƠI XÀO GỪNG HÀNH', 155000, 0, 'muctuoi.png', 0, 1510154798),
(41, 56, 'MỰC CHIÊN GIÒN SỐT CAY', 218000, 0, 'mucchien.png', 0, 1510154828),
(42, 56, 'HÀO NƯỚNG PHÔ MAI', 138000, 0, 'haunuong.png', 0, 1510154856),
(43, 56, 'HÀO NƯỚNG MỠ HÀNH', 138000, 0, 'haunuong1.jpg', 0, 1510154878),
(44, 56, 'HÀO TÁI CHANH', 138000, 0, 'hautaichanh.png', 0, 1510154901),
(45, 56, 'HÀO HẤP MIẾN TỎI CHIÊN', 138000, 0, 'hauhap.png', 0, 1510154931),
(46, 54, 'RAU CỦ BỐN MÙA HẤP LỒNG CHẤM KHO QUẸT', 68000, 0, 'raucu.jpg', 0, 1510155036),
(47, 54, 'NGỒNG TỎI XÀO', 68000, 0, 'ngongtoi.png', 0, 1510155063),
(48, 54, 'LƠ XANH THỊT BÒ XÀO NẤM', 138000, 0, 'loxanh.png', 0, 1510155091),
(49, 57, 'NGỌN SU SU XÀO TỎI', 59000, 0, 'susu.png', 0, 1510155120),
(50, 57, 'RAU XANH OM NẤM SỐT DẦU HÀO', 58000, 0, 'rauxanh.png', 0, 1510155146),
(51, 54, 'RAU MUỐNG XÀO CHAO', 55000, 0, 'raumuong.png', 0, 1510155174),
(52, 54, 'RÂU MỰC XÀO RAU MUỐNG MẮM RUỐC', 98000, 0, 'raumuc.png', 0, 1510155204),
(53, 54, 'NGỒNG CẢI XÀO TỎI', 58000, 0, 'ngongcai.png', 0, 1510155232),
(54, 54, 'BÒ XÀO NẤM THẬP CẨM', 138000, 0, 'boxao1.jpg', 0, 1510155265),
(55, 57, 'KHOAI MÔN HẤP THỊT BẰM SỐT CAY', 88000, 0, 'khoaimon.jpg', 0, 1510155296),
(56, 55, 'LẨU CUA GIA VIÊN CHUA CAY', 690000, 0, 'laucua.png', 1, 1510155483),
(57, 55, 'LẨU CUA GIA VIÊN SÒ ĐIỆP', 690000, 0, 'laucua1.png', 0, 1510155500),
(58, 55, 'CÁ CHÉP OM DƯA CHUA', 350000, 0, 'cachep.png', 0, 1510155520),
(59, 55, 'LẨU NẤM BỐN MÙA VỚI THỊT BÒ', 458000, 0, 'launam.png', 0, 1510155543),
(60, 55, 'CANH CẢI XANH OM NẤM, THỊT BẰM', 78000, 0, 'caixanh.png', 0, 1510155564),
(61, 55, 'CANH CÀ CHUA ĐẬU HŨ THỊT NẠC THĂN', 78000, 0, 'canhca.png', 0, 1510155581),
(62, 55, 'SƯỜN NON OM SẤU KÈM BÚN', 185000, 0, 'suonnon.png', 0, 1510155605),
(63, 55, 'LẨU RIÊU CUA SƯỜN SỤN BẮP BÒ', 385000, 0, 'laurieucua.jpg', 0, 1510155628),
(64, 55, 'CANH TÔM SÚ CHUA CAY', 255000, 0, 'canhtomsu.jpg', 0, 1510155651),
(65, 55, 'CANH CUA RAU MỒNG TƠI', 78000, 0, 'canhcua.jpg', 0, 1510155689),
(66, 55, 'CÁ QUẢ OM CHUỐI', 218000, 0, 'caquaomchuoi.jpg', 0, 1510155709),
(67, 55, 'LẨU VỊT MĂNG CHUA', 350000, 0, 'lauvit.jpg', 0, 1510155733),
(68, 55, 'LẨU ẾCH MĂNG CAY', 255000, 0, 'lauech.jpg', 0, 1510155756),
(69, 55, 'CANH NGAO MỒNG TƠI', 78000, 0, 'canhngaomongtoi.jpg', 0, 1510155785),
(70, 55, 'CANH CÁ NẤU CHUA', 168000, 0, 'canhcanauchua.jpg', 0, 1510155810),
(72, 56, 'ẾCH RANG MUỐI LÁ LỐT', 145000, 0, 'echrangmuoi1.png', 0, 1510759105),
(73, 56, 'ẾCH XÀO SẢ ỚT', 165000, 0, 'echxaosaot.png', 0, 1510761295);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sale`
--

INSERT INTO `sale` (`id`, `title`, `img`, `start`, `end`) VALUES
(1, 'Ưu đãi tháng 9 - Ăn Buffet chỉ từ 200k/người', 'kmt9.jpg', 0, 0),
(2, 'Ưu đãi tháng 10 - Ưu đãi món mẹt đồng quê', 'kmt10.jpg', 0, 0),
(3, 'Ưu đãi tháng 11 - Ăn cả cân chẳng cần xem giá', 'kmt11.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `timesheets`
--

CREATE TABLE `timesheets` (
  `id` int(11) NOT NULL,
  `month_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `working_times` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `employee_id` int(11) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `create_time` int(11) NOT NULL,
  `create_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `employee_id`, `role`, `status`, `create_time`, `create_by`) VALUES
(1, 'admin', '5c5ca2ca10bd5d843628909e166609fe', 0, 1, 1, 1493721361, 1),
(2, 'admin_sgc', '5c5ca2ca10bd5d843628909e166609fe', 0, 1, 1, 1494310891, 1),
(3, 'tungnt', '202cb962ac59075b964b07152d234b70', 3, 2, 1, 1510900370, 1),
(4, 'huytv', '202cb962ac59075b964b07152d234b70', 16, 2, 1, 1510900819, 1),
(5, 'anhnv', '202cb962ac59075b964b07152d234b70', 2, 2, 1, 1510902856, 1),
(6, 'huyenpt', '202cb962ac59075b964b07152d234b70', 14, 2, 1, 1510902852, 1),
(7, 'vanlt', '202cb962ac59075b964b07152d234b70', 15, 2, 1, 1510902848, 1),
(8, 'truongpv', '202cb962ac59075b964b07152d234b70', 4, 2, 1, 1510902844, 1),
(9, 'hieutt', '202cb962ac59075b964b07152d234b70', 5, 2, 1, 1510902840, 1),
(10, 'hant', '202cb962ac59075b964b07152d234b70', 13, 2, 1, 1510902836, 1),
(11, 'binhnd', '202cb962ac59075b964b07152d234b70', 1, 1, 1, 1510902830, 1),
(12, 'hanglt', '202cb962ac59075b964b07152d234b70', 9, 2, 1, 1510902826, 1),
(13, 'thuybt', '202cb962ac59075b964b07152d234b70', 10, 2, 1, 1510902822, 1),
(14, 'anhnt', '202cb962ac59075b964b07152d234b70', 11, 2, 1, 1510902818, 1),
(15, 'thuant', '202cb962ac59075b964b07152d234b70', 12, 2, 1, 1510902815, 1),
(16, 'nguyenvv', '202cb962ac59075b964b07152d234b70', 6, 2, 1, 1510902811, 1),
(17, 'hailt', '202cb962ac59075b964b07152d234b70', 7, 2, 1, 1510902807, 1),
(18, 'longpv', '202cb962ac59075b964b07152d234b70', 8, 2, 1, 1510902803, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `_order`
--

CREATE TABLE `_order` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `_table`
--

CREATE TABLE `_table` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `seat` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `import`
--
ALTER TABLE `import`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `month`
--
ALTER TABLE `month`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `_order`
--
ALTER TABLE `_order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `_table`
--
ALTER TABLE `_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT cho bảng `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT cho bảng `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT cho bảng `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT cho bảng `import`
--
ALTER TABLE `import`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT cho bảng `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT cho bảng `month`
--
ALTER TABLE `month`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT cho bảng `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT cho bảng `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `_order`
--
ALTER TABLE `_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `_table`
--
ALTER TABLE `_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
