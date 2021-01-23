-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 23, 2021 at 05:06 PM
-- Server version: 5.6.37
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shipping_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `id_card` varchar(13) NOT NULL,
  `phone_number` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `firstname`, `lastname`, `id_card`, `phone_number`) VALUES
(1, 'ชื่อคนทำรายการ', 'นามสกุลคนทำรายการ', '1102002841486', ''),
(2, 'ชื่อคนทำรายการ', 'นามสกุลคนทำรายการ', '1102002841486', '0819584848'),
(3, 'ชื่อคนทำรายการ2', 'นามสกุลคนทำรายการ2', '1102002841486', '0819584848'),
(4, 'ชื่อคนทำรายการ3', 'นามสกุลคนทำรายการ3', '1102002841486', '0819584848'),
(5, 'Postman', 'Test', '1102002844444', '0819584848'),
(8, 'Postman2', 'Test', '1102002844444', '0819584848'),
(9, 'Postman2', 'Test2', '1102002844444', '0819584848'),
(10, 'Test', 'Test', '1102002814444', '0819584848'),
(11, 'Test', 'Createposman', '1102002844777', '0897505566'),
(12, 'ชื่อคนทำรายการ', 'ชื่อคนทำรายการ', '1102002841486', '0899999999'),
(13, 'ชื่อคนทำรายการ', 'ชื่อคนทำรายการ', '1102002841486', '0899999998'),
(14, 'Test', 'Test', '1194887555652', '028445555'),
(15, 'Test', 'Testupdate', '1194887555652', '028445555'),
(16, 'นงนภัส', 'ง่วงนอน', '1102002888598', '0859484646'),
(17, 'Chutipas', 'Borsub', '1102002841486', '0830884161'),
(18, 'E-TENT', 'Studio', '1102002841486', '0830884162');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE IF NOT EXISTS `tbl_member` (
  `id` int(11) NOT NULL,
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `member_type` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `session_id` text,
  `active_status` varchar(1) NOT NULL DEFAULT 'T'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`id`, `firstname`, `lastname`, `member_type`, `username`, `password`, `session_id`, `active_status`) VALUES
(4, 'มาลี2', 'ไม่อร่อยนะ', 'admin', 'admin', '$2y$12$BP0jqnze1LL/VfJe3DcT.eB/ODAhkxDZtO9oTaKmvXi.2tVGNtFKu', '$2y$12$3ZF/gM9ZUYR7IfIMxi37ausRB64ZMXcU4mvHQn/IBLjLlov/HcA/m', 'T'),
(5, 'Test', 'Create2', 'staff', 'testaccount', '$2y$12$i0G.Xb3tKE50HPqzsWkhQ.U00Nz1uR8xSUOpj4b9JVMYxuO/xuFmy', NULL, 'T'),
(6, 'Testadd', 'Onpage', 'admin', 'admin2', '$2y$12$xQfZzkrtApWh/D280A0BseVN/d2rh8KcylzpTQAvMCsciEVBcVPIW', NULL, 'T'),
(7, 'Chutipas2', 'Borsub', 'staff', 'itsofun01', '$2y$12$H.ISNtFqC.jCeGTsJmOiW.WepH7w0hGbsw9VKbFLXHwZxhy9eH0e.', '$2y$12$5VBl0Inj..C/ld5GSad0ae0LL52OL1clFtcXTIEHFxEgKEt5ZH5gC', 'T'),
(8, 'Manee', 'Aroina', 'admin', 'Manee01', '$2y$12$SLL7v8bGgA7VMLs.kyUwIuroR9qGUsLiLTl0EEqssuZN7lPb942oy', NULL, 'T'),
(9, 'Bot', 'test', 'staff', 'Bot01', '$2y$12$DoRHcqnFtQ.56dLRkKK9feQvFrR/rIWn6lBs9F.N5EnaAtfd4lH/q', NULL, 'T'),
(10, 'Bot2', 'Test', 'staff', 'Bot02', '$2y$12$TDPRxMF3RBFwu.AwQ0zz3e/fVJBBM93ssU4OWla7/ih2u5l.VEAq2', NULL, 'T'),
(11, 'Test', 'Postman', 'admin', 'admin_postman', '$2y$12$g.CiobjIU9wgVm6b526Z9.mLh40omKe7IFomwyfw/pxF2sXyaTNqO', '$2y$12$11U47NE65lS0ZianUtXjJeyCEbsc8nS6BlCwrH.LO.xeXESGNc/kq', 'T'),
(12, 'Test', 'Shipper', 'shipper', 'shipper01', '$2y$12$RuFmO0OLmbCtdvJJ5gNVjuvGvgrrWG81XQ4qJwTw.wEx2Opm8wm4m', '$2y$12$9Kh3botS8H1QX5ogpNKbb.U6m4t4azGEOwij9MmVakZMGVHyzeBru', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `id` int(11) NOT NULL,
  `shipping_type` varchar(100) NOT NULL,
  `weight` float NOT NULL,
  `price` float NOT NULL,
  `tracking_code` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shipper_id` int(11) NOT NULL,
  `payment_type` text NOT NULL,
  `image_signature` text NOT NULL,
  `active_status` varchar(1) NOT NULL DEFAULT 'T'
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `shipping_type`, `weight`, `price`, `tracking_code`, `status`, `create_date`, `shipper_id`, `payment_type`, `image_signature`, `active_status`) VALUES
(1, 'normal', 1.5, 30, 'SH540H2684NJ9', 'sending', '2020-12-26 18:27:57', 6, 'cod', '', 'T'),
(2, 'normal', 1.5, 30, 'SH023V5641RS5', 'success', '2020-12-26 18:27:57', 8, 'cod', '', 'T'),
(3, 'normal', 1.5, 30, 'SH431C2604NW3', 'success', '2020-12-26 18:28:32', 5, 'cod', '5fef0227e181a_product3.png', 'T'),
(4, 'normal', 1.5, 30, 'SH286X5783XI2', 'waiting', '2020-12-26 18:28:32', 0, 'normal', '', 'T'),
(5, 'normal', 1.5, 30, 'SH836J4639NI4', 'waiting', '2021-01-02 15:46:21', 0, 'normal', '', 'T'),
(6, 'normal', 1.5, 30, 'SH642H9085XP7', 'waiting', '2021-01-02 15:46:56', 0, 'normal', '', 'T'),
(7, 'normal', 1.5, 30, 'SH758N9625VI1', 'waiting', '2021-01-02 15:46:56', 0, 'normal', '', 'T'),
(8, 'normal', 1.5, 30, 'SH219H9682MT1', 'waiting', '2021-01-02 15:47:06', 0, 'normal', '', 'T'),
(9, 'normal', 1.5, 30, 'SH317D3820DW0', 'waiting', '2021-01-02 15:47:06', 0, 'normal', '', 'T'),
(10, 'normal', 1.5, 30, 'SH832D9461PR0', 'waiting', '2021-01-02 15:50:32', 0, 'normal', '', 'T'),
(11, 'normal', 1.5, 30, 'SH673G4892CO6', 'waiting', '2021-01-02 15:50:32', 0, 'normal', '', 'T'),
(12, 'normal', 1.5, 30, 'SH893E4235CS6', 'waiting', '2021-01-02 15:50:51', 8, 'normal', '', 'T'),
(13, 'normal', 1.5, 30, 'SH140Q2473KO6', 'sending', '2021-01-02 15:50:51', 9, 'normal', '', 'T'),
(16, 'normal', 1.5, 30, 'SH473M5693XY9', 'waiting', '2021-01-03 11:38:35', 0, 'normal', '', 'T'),
(17, 'normal', 1.5, 30, 'SH657Z9460HO9', 'waiting', '2021-01-03 11:38:36', 0, 'normal', '', 'T'),
(18, 'normal', 1.5, 30, 'SH578B1643MX0', 'waiting', '2021-01-03 11:40:04', 0, 'normal', '', 'T'),
(19, 'normal', 1.5, 30, 'SH362S2730SL8', 'waiting', '2021-01-03 11:40:04', 0, 'normal', '', 'T'),
(20, 'normal', 1.5, 30, 'SH469G2071CN5', 'waiting', '2021-01-03 13:27:18', 0, 'normal', '', 'T'),
(21, 'normal', 1.5, 30, 'SH891M7910NZ7', 'waiting', '2021-01-03 13:27:18', 0, 'normal', '', 'T'),
(22, 'normal', 1.5, 30, 'SH417F2701UV8', 'waiting', '2021-01-03 13:27:26', 0, 'normal', '', 'T'),
(23, 'normal', 1.5, 30, 'SH145S6109ZP7', 'waiting', '2021-01-03 13:27:26', 0, 'normal', '', 'T'),
(24, 'normal', 1.5, 30, 'SH159L8206KA7', 'waiting', '2021-01-03 13:35:41', 0, 'normal', '', 'T'),
(25, 'normal', 1.5, 30, 'SH469P4352ZX5', 'waiting', '2021-01-03 13:35:41', 0, 'normal', '', 'T'),
(26, 'normal', 1.5, 30, 'SH147F8724CJ1', 'waiting', '2021-01-03 13:37:27', 0, 'normal', '', 'T'),
(27, 'normal', 1.5, 30, 'SH854T3981PK6', 'waiting', '2021-01-03 13:37:27', 11, 'normal', '', 'T'),
(28, 'normal', 1.5, 300.5, 'SH078W8963ZK4', 'waiting', '2021-01-16 08:43:38', 0, 'normal', '', 'T'),
(29, 'normal', 1.5, 50, 'SH760L4819QP3', 'waiting', '2021-01-16 11:14:09', 0, 'normal', '', 'T'),
(30, 'normal', 1.5, 400, 'SH817U6924BX8', 'success', '2021-01-16 11:24:04', 6, 'cod', '6002cd57f0e67_product30.png', 'T'),
(31, 'normal', 1.5, 599, 'SH423K0327TE3', 'waiting', '2021-01-16 14:36:02', 0, 'normal', '', 'T'),
(32, 'normal', 1.5, 400, 'SH836G1429PG4', 'waiting', '2021-01-16 14:38:34', 0, 'normal', '', 'T'),
(33, 'normal', 1.5, 305, 'SH634K0495TZ7', 'waiting', '2021-01-16 15:57:26', 0, 'normal', '', 'T'),
(34, 'normal', 1.5, 30, 'SH796R4179FT1', 'waiting', '2021-01-16 15:58:03', 0, 'normal', '', 'T'),
(35, 'normal', 1.5, 30, 'SH012O8635MH1', 'waiting', '2021-01-16 16:02:06', 0, 'normal', '', 'T'),
(36, 'normal', 1.5, 30, 'SH895C6729VH5', 'waiting', '2021-01-16 16:18:57', 0, 'normal', '', 'T'),
(37, 'normal', 1.5, 30, 'SH465Q8512OJ4', 'waiting', '2021-01-16 16:19:52', 0, 'normal', '', 'T'),
(38, 'normal', 1.5, 30, 'SH980V1072OQ5', 'waiting', '2021-01-16 16:23:40', 0, 'normal', '', 'T'),
(39, 'normal', 50, 400, 'SH187A0875CI7', 'waiting', '2021-01-17 09:44:06', 0, 'normal', '', 'F'),
(40, 'normal', 40, 500, 'SH376D6305DR2', 'waiting', '2021-01-17 09:44:43', 0, 'normal', '', 'T'),
(41, 'normal', 1.5, 400, 'SH072P3175JB9', 'waiting', '2021-01-17 09:45:18', 0, 'normal', '', 'T'),
(42, 'normal', 1.5, 500, 'SH327H0961OE8', 'waiting', '2021-01-17 10:48:20', 4, 'normal', '', 'T'),
(43, 'normal', 1.5, 400, 'SH584X6129JN1', 'waiting', '2021-01-17 15:59:48', 7, 'normal', '', 'T'),
(44, 'normal', 1.5, 599, 'SH380Q9032RX3', 'waiting', '2021-01-17 16:03:10', 0, 'normal', '', 'T'),
(45, 'normal', 1.5, 305, 'SH874R6194MD3', 'waiting', '2021-01-19 16:03:44', 0, 'normal', '', 'T'),
(46, 'normal', 50, 599, 'SH420Y3614XQ4', 'waiting', '2021-01-19 16:03:44', 0, 'cod', '', 'F'),
(47, 'normal', 1.5, 50, 'SH608Y8261PZ1', 'waiting', '2021-01-19 16:03:44', 7, 'normal', '', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receiver`
--

CREATE TABLE IF NOT EXISTS `tbl_receiver` (
  `id` int(11) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_receiver`
--

INSERT INTO `tbl_receiver` (`id`, `phone_number`, `firstname`, `lastname`, `address`) VALUES
(1, '0987786666', 'FReceiver1', 'LReceiver1', '{"firstname":"FReceiver1","lastname":"LReceiver1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(2, '0922222222', 'FReceiver2', 'LReceiver2', '{"firstname":"FReceiver2","lastname":"LReceiver2","address":"919 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0922222222"}'),
(3, '0987786666', 'ชื่อคนรับ1', 'นามสกุลคนรับ1', '{"firstname":"ชื่อคนรับ1","lastname":"นามสกุลคนรับ1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(4, '0845586666', 'Postman', 'Updatereceiver', '{"address":"1050","district":"บางกะปิ","area":"ลาดพร้าว","province":"กรุงเทพมหานคร","postal":"10355","phone_number":"0845586666"}'),
(5, '0845586667', 'Postman', 'Updatereceiver', '{"address":"1050","district":"บางกะปิ","area":"ลาดพร้าว","province":"กรุงเทพมหานคร","postal":"10355","phone_number":"0845586667"}'),
(6, '0987786666', 'ชื่อคนรับ10', 'นามสกุลคนรับ2', '{"address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(7, '0987786666', 'ชื่อคนรับ10', 'นามสกุลคนรับ10', '{"address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(8, '0857778888', 'สร้างรับ', 'นามสกุลรับ', '{"firstname":"สร้างรับ","lastname":"นามสกุลรับ","address":"12/100","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0857778888"}'),
(9, '0830884161', 'E-TENT', 'Studio', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}'),
(10, '0830884161', 'E-TENT2', 'Studio', '{"address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}'),
(11, '0830884161', 'ชุติภาส', 'บ่อทรัพย์', '{"firstname":"ชุติภาส","lastname":"บ่อทรัพย์","address":"99 ถนนพัฒนาการ","district":"บางแค","area":"บางแค","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0830884161"}'),
(12, '0830884161', 'E-TENTR00', 'Studio', '{"firstname":"E-TENTR00","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}'),
(13, '0830884161', 'E-TENT', 'Studio', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"หนองแขม","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}'),
(14, '0830884161', 'E-TENT', 'Studio', '{"address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0830884161"}');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sender`
--

CREATE TABLE IF NOT EXISTS `tbl_sender` (
  `id` int(11) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sender`
--

INSERT INTO `tbl_sender` (`id`, `phone_number`, `firstname`, `lastname`, `address`) VALUES
(1, '0911111111', 'ชื่อคนส่ง1', 'นามสกุลคนส่ง1', '{"firstname":"ชื่อคนส่ง1","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0911111111"}'),
(2, '0987786662', 'ชื่อคนส่ง22', 'นามสกุลคนส่ง2', '{"firstname":"ชื่อคนส่ง22","lastname":"นามสกุลคนส่ง2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786662"}'),
(5, '0987786666', 'ชื่อคนส่ง13', 'นามสกุลคนส่ง1', '{"firstname":"ชื่อคนส่ง13","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0911111111"}'),
(6, '0987786666', 'ชื่อคนส่ง1', 'นามสกุลคนส่ง1', '{"firstname":"ชื่อคนส่ง1","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(7, '0964458989', 'Postman', 'Updatesender', '{"address":"12/100","district":"หนองจอก","area":"ลาดกระบัง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0964458989"}'),
(8, '0964458987', 'Postman', 'Updatesender', '{"address":"12/100","district":"หนองจอก","area":"ลาดกระบัง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0964458987"}'),
(9, '0987786666', 'ชื่อคนรับ10', 'นามสกุลคนรับ10', '{"address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(10, '0987786666', 'ชื่อคนส่งUpdate', 'นามสกุลคนส่งUpdate', '{"address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(11, '0830884161', 'สร้างส่ง', 'นามสกุลส่ง', '{"firstname":"สร้างส่ง","lastname":"นามสกุลส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}'),
(12, '0830884161', 'Chutipas', 'Borsub', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}'),
(13, '0830884161', 'E-TENT', 'Studio', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}'),
(14, '0830884161', 'E-TENTRRR', 'StudioR', '{"firstname":"E-TENTRRR","lastname":"StudioR","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}'),
(15, '0830884161', 'E-TENT', 'Studio', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"หนองแขม","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}'),
(16, '0847775556', 'E-TENT', 'Studio', '{"address":"99 ถนนพัฒนาการ","district":"หนองแขม","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0847775556"}'),
(17, '0830884161', 'Chutipas', 'Borsub', '{"address":"99 ถนนพัฒนาการ","district":"หนองแขม","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE IF NOT EXISTS `tbl_transaction` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(20) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `receiver_desc` text NOT NULL,
  `sender_desc` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active_status` varchar(1) NOT NULL DEFAULT 'T'
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`id`, `transaction_id`, `employee_id`, `customer_id`, `product_id`, `receiver_desc`, `sender_desc`, `create_date`, `active_status`) VALUES
(1, '160900727713YO', 0, 1, 1, '{"firstname":"FReceiver1","lastname":"LReceiver1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง1","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0911111111"}', '2021-01-17 16:02:05', 'T'),
(2, '160900727713YO', 0, 1, 2, '{"firstname":"FReceiver2","lastname":"LReceiver2","address":"919 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0922222222"}', '{"firstname":"ชื่อคนส่ง22","lastname":"นามสกุลคนส่ง2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786662"}', '2021-01-17 16:02:05', 'T'),
(3, '160900731274ZM', 0, 1, 3, '{"firstname":"ทดสอบ","lastname":"อัพเดท","address":"12\\/100","district":"หนองแขม","area":"หนองแขม","province":"กรุงเทพ","postal":"10160","phone_number":"0891111111"}', '{"firstname":"ชื่อคนส่ง001","lastname":"นามสกุลคนส่ง001","address":"999\\/1999 หมู่3","district":"บางเขน","area":"บางเขน","province":"กรุงเทพมหนาคร","postal":"10555","phone_number":"0859484747"}', '2021-01-17 16:02:05', 'T'),
(4, '160900731274ZM', 0, 1, 4, '{"firstname":"FReceiver2","lastname":"LReceiver2","address":"919 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0859997777"}', '{"firstname":"ชื่อคนส่ง22","lastname":"นามสกุลคนส่ง2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786661"}', '2021-01-17 16:02:05', 'T'),
(5, '160960238179EG', 0, 1, 5, '{"firstname":"FReceiver1","lastname":"LReceiver1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง1","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0911111111"}', '2021-01-17 16:02:05', 'T'),
(6, '160960241639EZ', 0, 1, 6, '{"firstname":"FReceiver1","lastname":"LReceiver1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง1","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0911111111"}', '2021-01-17 16:02:05', 'T'),
(7, '160960241639EZ', 0, 1, 7, '{"firstname":"FReceiver2","lastname":"LReceiver2","address":"919 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0922222222"}', '{"firstname":"ชื่อคนส่ง22","lastname":"นามสกุลคนส่ง2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786662"}', '2021-01-17 16:02:05', 'T'),
(8, '160960242682YV', 0, 1, 8, '{"firstname":"FReceiver1","lastname":"LReceiver1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง1","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0911111111"}', '2021-01-17 16:02:05', 'T'),
(9, '160960242682YV', 0, 1, 9, '{"firstname":"FReceiver2","lastname":"LReceiver2","address":"919 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0922222222"}', '{"firstname":"ชื่อคนส่ง22","lastname":"นามสกุลคนส่ง2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786662"}', '2021-01-17 16:02:05', 'T'),
(10, '160960263267LD', 0, 1, 10, '{"firstname":"FReceiver1","lastname":"LReceiver1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง1","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0911111111"}', '2021-01-17 16:02:05', 'T'),
(11, '160960263267LD', 0, 1, 11, '{"firstname":"FReceiver2","lastname":"LReceiver2","address":"919 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0922222222"}', '{"firstname":"ชื่อคนส่ง22","lastname":"นามสกุลคนส่ง2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786662"}', '2021-01-17 16:02:05', 'T'),
(12, '160960265142XV', 0, 1, 12, '{"firstname":"FReceiver1","lastname":"LReceiver1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง13","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0911111111"}', '2021-01-17 16:02:05', 'T'),
(13, '160960265142XV', 0, 1, 13, '{"firstname":"FReceiver2","lastname":"LReceiver2","address":"919 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0922222222"}', '{"firstname":"ชื่อคนส่ง22","lastname":"นามสกุลคนส่ง2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786662"}', '2021-01-17 16:02:05', 'T'),
(14, '160967383018NG', 0, 1, 14, '{"firstname":"ชื่อคนรับ1","lastname":"นามสกุลคนรับ1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง1","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '2021-01-17 16:02:05', 'T'),
(15, '160967383018NG', 0, 1, 15, '{"firstname":"ชื่อคนรับ2","lastname":"นามสกุลคนรับ2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง2","lastname":"นามสกุลคนส่ง2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '2021-01-17 16:02:05', 'T'),
(16, '160967391694NJ', 0, 1, 16, '{"firstname":"ชื่อคนรับ1","lastname":"นามสกุลคนรับ1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง1","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '2021-01-17 16:02:05', 'T'),
(17, '160967391694NJ', 0, 1, 17, '{"firstname":"ชื่อคนรับ2","lastname":"นามสกุลคนรับ2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง2","lastname":"นามสกุลคนส่ง2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '2021-01-17 16:02:05', 'T'),
(18, '160967400473YG', 0, 1, 18, '{"firstname":"ชื่อคนรับ1","lastname":"นามสกุลคนรับ1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง1","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '2021-01-17 16:02:05', 'T'),
(19, '160967400473YG', 0, 1, 19, '{"firstname":"ชื่อคนรับ2","lastname":"นามสกุลคนรับ2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง2","lastname":"นามสกุลคนส่ง2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '2021-01-17 16:02:05', 'T'),
(20, '160968043852HQ', 0, 2, 20, '{"firstname":"ชื่อคนรับ1","lastname":"นามสกุลคนรับ1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง1","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '2021-01-17 16:02:05', 'T'),
(21, '160968043852HQ', 0, 2, 21, '{"firstname":"ชื่อคนรับ2","lastname":"นามสกุลคนรับ2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง2","lastname":"นามสกุลคนส่ง2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '2021-01-17 16:02:05', 'T'),
(26, '160968104743KQ', 0, 2, 26, '{"firstname":"ชื่อคนรับ1","lastname":"นามสกุลคนรับ1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง1","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '2021-01-17 16:02:05', 'T'),
(27, '160968104743KQ', 0, 10, 27, '{"firstname":"ชื่อคนรับ10","lastname":"นามสกุลคนรับ10","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่งUpdate","lastname":"นามสกุลคนส่งUpdate","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '2021-01-17 16:02:05', 'T'),
(28, '161078661838XL', 0, 17, 28, '{"firstname":"สร้างรับ","lastname":"นามสกุลรับ","address":"12/100","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0857778888"}', '{"firstname":"สร้างส่ง","lastname":"นามสกุลส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-17 16:02:05', 'T'),
(29, '161079564903FH', 0, 17, 29, '{"firstname":"E-TENT2","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-17 16:02:05', 'T'),
(30, '161079624405AU', 0, 17, 30, '{"firstname":"ชุติภาส","lastname":"บ่อทรัพย์","address":"99 ถนนพัฒนาการ","district":"บางแค","area":"บางแค","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0830884161"}', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-17 16:02:05', 'T'),
(31, '161080776291QK', 0, 18, 31, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-17 16:02:05', 'T'),
(32, '161080791446CP', 0, 17, 32, '{"firstname":"E-TENTR00","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"E-TENTRRR","lastname":"StudioR","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-17 16:02:05', 'T'),
(33, '161081264674TE', 0, 17, 33, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-17 16:02:05', 'T'),
(34, '161081268313JR', 0, 17, 34, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-17 16:02:05', 'T'),
(35, '161081292643EN', 0, 17, 35, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-17 16:02:05', 'T'),
(36, '161081393731UQ', 0, 17, 36, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-17 16:02:05', 'T'),
(37, '161081399252RL', 0, 17, 37, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-17 16:02:05', 'T'),
(38, '161081422017PG', 0, 17, 38, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-17 16:02:05', 'T'),
(39, '161087664603OB', 0, 17, 39, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"หนองแขม","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-17 16:02:05', 'T'),
(40, '161087668348DT', 0, 17, 40, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"หนองแขม","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-17 16:02:05', 'T'),
(41, '161087671858SJ', 0, 17, 41, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"หนองแขม","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-17 16:02:05', 'T'),
(42, '161088050048YO', 0, 17, 42, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"หนองแขม","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-17 16:02:05', 'T'),
(43, '161089918834RB', 4, 17, 43, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"หนองแขม","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"หนองแขม","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-17 16:02:05', 'T'),
(44, '161089939093BE', 4, 17, 44, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"หนองแขม","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"หนองแขม","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0847775556"}', '2021-01-17 16:03:10', 'T'),
(45, '161107222419BE', 4, 17, 45, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"หนองแขม","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"หนองแขม","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-19 16:03:44', 'T'),
(46, '161107222419BE', 4, 17, 46, '{"firstname":"คนไม่ดี","lastname":"จ่ะ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"นครปฐม","postal":"10160","phone_number":"0830884161"}', '{"firstname":"คนดี","lastname":"นะจะ","address":"99 ถนนพัฒนาการ","district":"หนองแขม","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-19 16:03:44', 'T'),
(47, '161107222419BE', 4, 17, 47, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"หนองแขม","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-19 16:03:44', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transport`
--

CREATE TABLE IF NOT EXISTS `tbl_transport` (
  `id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'waiting',
  `note` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transport`
--

INSERT INTO `tbl_transport` (`id`, `product_id`, `status`, `note`, `timestamp`) VALUES
(1, '1', 'waiting', '', '2020-12-26 18:27:57'),
(2, '2', 'waiting', '', '2020-12-26 18:27:57'),
(3, '3', 'waiting', '', '2020-12-26 18:28:32'),
(4, '4', 'waiting', '', '2020-12-26 18:28:32'),
(5, '3', 'waiting', '', '2021-01-01 07:59:08'),
(6, '3', 'sending', '', '2021-01-01 07:59:26'),
(7, '3', 'success', '', '2021-01-01 08:14:23'),
(8, '3', 'success', '', '2021-01-01 08:23:51'),
(9, '3', 'sending', '', '2021-01-01 09:04:14'),
(10, '3', 'success', '', '2021-01-01 09:13:27'),
(11, '3', 'success', '', '2021-01-01 09:17:05'),
(12, '3', 'success', '', '2021-01-01 09:46:12'),
(13, '3', 'sending', '', '2021-01-01 09:46:46'),
(14, '3', 'success', '', '2021-01-01 09:48:09'),
(15, '3', 'success', '', '2021-01-01 10:10:47'),
(16, '3', 'success', 'ไม่มีคนรับ', '2021-01-01 10:12:20'),
(17, '2', 'success', '', '2021-01-01 10:53:39'),
(18, '3', 'success', '', '2021-01-01 11:06:15'),
(19, '1', 'sending', '', '2021-01-02 15:01:22'),
(20, '6', 'waiting', '', '2021-01-02 15:46:56'),
(21, '7', 'waiting', '', '2021-01-02 15:46:56'),
(22, '8', 'waiting', '', '2021-01-02 15:47:06'),
(23, '9', 'waiting', '', '2021-01-02 15:47:06'),
(24, '10', 'waiting', '', '2021-01-02 15:50:32'),
(25, '11', 'waiting', '', '2021-01-02 15:50:32'),
(26, '12', 'waiting', '', '2021-01-02 15:50:51'),
(27, '13', 'waiting', '', '2021-01-02 15:50:51'),
(28, '13', 'sending', '', '2021-01-02 16:06:34'),
(29, '14', 'waiting', '', '2021-01-03 11:37:10'),
(30, '15', 'waiting', '', '2021-01-03 11:37:10'),
(31, '16', 'waiting', '', '2021-01-03 11:38:36'),
(32, '17', 'waiting', '', '2021-01-03 11:38:36'),
(33, '18', 'waiting', '', '2021-01-03 11:40:04'),
(34, '19', 'waiting', '', '2021-01-03 11:40:04'),
(35, '20', 'waiting', '', '2021-01-03 13:27:18'),
(36, '21', 'waiting', '', '2021-01-03 13:27:18'),
(37, '22', 'waiting', '', '2021-01-03 13:27:26'),
(38, '23', 'waiting', '', '2021-01-03 13:27:26'),
(39, '24', 'waiting', '', '2021-01-03 13:35:41'),
(40, '25', 'waiting', '', '2021-01-03 13:35:41'),
(41, '26', 'waiting', '', '2021-01-03 13:37:27'),
(42, '27', 'waiting', '', '2021-01-03 13:37:27'),
(43, '28', 'waiting', '', '2021-01-16 08:43:38'),
(44, '29', 'waiting', '', '2021-01-16 11:14:09'),
(45, '30', 'waiting', '', '2021-01-16 11:24:04'),
(46, '30', 'sending', '', '2021-01-16 11:25:49'),
(47, '30', 'success', '', '2021-01-16 11:26:15'),
(48, '31', 'waiting', '', '2021-01-16 14:36:02'),
(49, '32', 'waiting', '', '2021-01-16 14:38:34'),
(50, '33', 'waiting', '', '2021-01-16 15:57:26'),
(51, '34', 'waiting', '', '2021-01-16 15:58:03'),
(52, '35', 'waiting', '', '2021-01-16 16:02:07'),
(53, '36', 'waiting', '', '2021-01-16 16:18:58'),
(54, '37', 'waiting', '', '2021-01-16 16:19:52'),
(55, '38', 'waiting', '', '2021-01-16 16:23:40'),
(56, '39', 'waiting', '', '2021-01-17 09:44:06'),
(57, '40', 'waiting', '', '2021-01-17 09:44:43'),
(58, '41', 'waiting', '', '2021-01-17 09:45:18'),
(59, '42', 'waiting', '', '2021-01-17 10:48:20'),
(60, '43', 'waiting', '', '2021-01-17 15:59:48'),
(61, '44', 'waiting', '', '2021-01-17 16:03:10'),
(62, '45', 'waiting', '', '2021-01-19 16:03:44'),
(63, '46', 'waiting', '', '2021-01-19 16:03:44'),
(64, '47', 'waiting', '', '2021-01-19 16:03:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_receiver`
--
ALTER TABLE `tbl_receiver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sender`
--
ALTER TABLE `tbl_sender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transport`
--
ALTER TABLE `tbl_transport`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `tbl_receiver`
--
ALTER TABLE `tbl_receiver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_sender`
--
ALTER TABLE `tbl_sender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `tbl_transport`
--
ALTER TABLE `tbl_transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=65;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
