-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 10, 2020 at 06:13 PM
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
  `id_card` varchar(13) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `firstname`, `lastname`, `id_card`) VALUES
(1, 'Customer', 'Test', ''),
(2, 'Testcustomer', 'Add', ''),
(3, 'Test', 'Createcustomer', ''),
(4, 'Test', 'Createcustomer', ''),
(5, 'มานี', 'อร่อยนะ', ''),
(6, 'มานี', 'อร่อยนะ', ''),
(7, 'มานี', 'อร่อยนะ', ''),
(8, 'มานี', 'อร่อยนะ', ''),
(9, 'มานี', 'อร่อยนะ', ''),
(10, 'มานี', 'อร่อยนะ', ''),
(11, 'มานี', 'อร่อยนะ', ''),
(12, 'มานี', 'อร่อยนะ', ''),
(13, 'มานี', 'อร่อยนะ', ''),
(14, 'ชื่อคนทำรายการ', 'นามสกุลคนทำรายการ', '1102002841486'),
(15, 'ชื่อคนทำรายการ', 'นามสกุลคนทำรายการ', '1102002999995');

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
  `session_id` text
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`id`, `firstname`, `lastname`, `member_type`, `username`, `password`, `session_id`) VALUES
(3, 'Test', 'Signup', NULL, 'testsignup', '$2y$12$rUz0H84mEiG0BDYnqHljDuxOafLyiadlzeWTd6TGrxNojvIbFHBEy', '$2y$12$zNmYv3ycY5b0tRGUpgJ7yOTnBbkpz259q8JoC3t89hhuukZv9jPQe'),
(4, 'Admin', 'Test', NULL, 'admin', '$2y$12$P2AvHFLQDJaq6jZPYvlAu.MVHIrj8ZxGa98OTSwWb.Nh5XkQOLjh.', '$2y$12$0oqSySz.WYRnfR2qA6TStu9YVecTCcZiwlJU7pexyRwB.TBUHF9aG'),
(5, 'Admin', 'Test', NULL, 'admin2', '$2y$12$eK974nZoXdYRNe6nrJm1S.2drx/0o/Roen/DssBHj/0po1B.AGavG', NULL),
(6, 'Admin', 'Test', NULL, 'admin3', '$2y$12$2m3D1N8Wa7ijQMtu1j6RPe9NVEDk0wZhOvldHn5R7/FkHi3W6IuAe', NULL);

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
  `temp_shipping` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `shipping_type`, `weight`, `price`, `tracking_code`, `status`, `create_date`, `shipper_id`, `temp_shipping`) VALUES
(1, 'EMS', 1.65, 50, '1102002841486', '', '2020-12-07 15:38:17', 0, ''),
(2, 'normal', 1.5, 30, 'SH1607448733', 'waiting', '2020-12-08 17:32:13', 0, ''),
(3, 'normal', 1.5, 30, 'SH1607449216', 'waiting', '2020-12-08 17:40:16', 0, ''),
(4, 'normal', 1.5, 30, 'SHT7KFYV0J4N', 'waiting', '2020-12-08 18:00:05', 0, ''),
(5, 'normal', 1.5, 30, 'SHSN9OTC4AE5', 'waiting', '2020-12-08 18:02:52', 0, ''),
(6, 'normal', 1.5, 30, 'SHHZIABOMTGK', 'waiting', '2020-12-08 18:05:58', 0, ''),
(7, 'normal', 1.5, 30, 'SH1NTBK28PLC', 'waiting', '2020-12-08 18:11:44', 0, ''),
(8, 'normal', 1.5, 30, 'SHKR5EPQHSDX', 'waiting', '2020-12-08 18:15:39', 0, ''),
(9, 'normal', 1.5, 30, 'SHLE4V09G28P', 'waiting', '2020-12-08 18:16:42', 0, ''),
(10, 'normal', 1.5, 30, 'SH5fcfc3d9ddbe14.14639092', 'waiting', '2020-12-08 18:20:09', 0, ''),
(11, 'normal', 1.5, 30, 'SH724N2980RL1', 'waiting', '2020-12-08 18:29:22', 0, ''),
(12, 'normal', 1.5, 30, 'SH301U6781TY6', 'waiting', '2020-12-09 16:30:45', 0, ''),
(13, 'normal', 1.5, 30, 'SH243J3810DU8', 'waiting', '2020-12-10 14:30:29', 0, ''),
(14, 'normal', 1.5, 30, 'SH158B7905LA6', 'waiting', '2020-12-10 14:30:29', 0, ''),
(15, 'normal', 1.5, 30, 'SH106U4312SE8', 'waiting', '2020-12-10 14:33:06', 0, ''),
(16, 'normal', 1.5, 30, 'SH748Y7183UJ9', 'waiting', '2020-12-10 14:33:06', 0, ''),
(17, 'normal', 1.5, 30, 'SH405D6741UX8', 'waiting', '2020-12-10 14:34:00', 0, ''),
(18, 'normal', 1.5, 30, 'SH749T0763TS8', 'waiting', '2020-12-10 14:34:01', 0, ''),
(19, 'normal', 1.5, 30, 'SH069W2916LE6', 'waiting', '2020-12-10 14:35:48', 0, ''),
(20, 'normal', 2, 40, 'SH694B2708JR9', 'waiting', '2020-12-10 14:35:48', 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE IF NOT EXISTS `tbl_transaction` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `receiver_desc` text NOT NULL,
  `sender_desc` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`id`, `transaction_id`, `customer_id`, `product_id`, `receiver_desc`, `sender_desc`) VALUES
(1, '1', 1, 1, '{"firstname": "Test", "lastname": "Receiver", "address": "12/0000 ถนนมาเจริญ กทม 10160"}', ''),
(2, '1607448733', 2, 30, '{"address": "99 ถนนพัฒนาการ, "district": "สวนหลวง",  "area": "สวนหลวง", "province": "กรุงเทพมหานคร", "postal": "10250", "phone_number": "0987786666"}', ''),
(3, '1607449216', 4, 3, '{"address": "99 ถนนพัฒนาการ, "district": "สวนหลวง",  "area": "สวนหลวง", "province": "กรุงเทพมหานคร", "postal": "10250", "phone_number": "0987786666"}', ''),
(4, '2147483647', 5, 4, '{"address": "99 ถนนพัฒนาการ, "district": "สวนหลวง",  "area": "สวนหลวง", "province": "กรุงเทพมหานคร", "postal": "10250", "phone_number": "0987786666"}', ''),
(5, '1607450572', 6, 5, '{"address": "99 ถนนพัฒนาการ, "district": "สวนหลวง",  "area": "สวนหลวง", "province": "กรุงเทพมหานคร", "postal": "10250", "phone_number": "0987786666"}', ''),
(6, '1607450758', 7, 6, '{"address": "99 ถนนพัฒนาการ, "district": "สวนหลวง",  "area": "สวนหลวง", "province": "กรุงเทพมหานคร", "postal": "10250", "phone_number": "0987786666"}', ''),
(7, '1607451104', 8, 7, '{"address": "99 ถนนพัฒนาการ, "district": "สวนหลวง",  "area": "สวนหลวง", "province": "กรุงเทพมหานคร", "postal": "10250", "phone_number": "0987786666"}', ''),
(8, '2147483647', 9, 8, '{"address": "99 ถนนพัฒนาการ, "district": "สวนหลวง",  "area": "สวนหลวง", "province": "กรุงเทพมหานคร", "postal": "10250", "phone_number": "0987786666"}', ''),
(9, '2147483647', 10, 9, '{"address": "99 ถนนพัฒนาการ, "district": "สวนหลวง",  "area": "สวนหลวง", "province": "กรุงเทพมหานคร", "postal": "10250", "phone_number": "0987786666"}', ''),
(10, '2147483647', 11, 10, '{"address": "99 ถนนพัฒนาการ, "district": "สวนหลวง",  "area": "สวนหลวง", "province": "กรุงเทพมหานคร", "postal": "10250", "phone_number": "0987786666"}', ''),
(11, '1607452162', 12, 11, '{"address": "99 ถนนพัฒนาการ, "district": "สวนหลวง",  "area": "สวนหลวง", "province": "กรุงเทพมหานคร", "postal": "10250", "phone_number": "0987786666"}', ''),
(12, '1607531445', 13, 12, '{"address": "99 ถนนพัฒนาการ, "district": "สวนหลวง",  "area": "สวนหลวง", "province": "กรุงเทพมหานคร", "postal": "10250", "phone_number": "0987786666"}', ''),
(13, '2147483647', 14, 13, '{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(14, '2147483647', 14, 14, '{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(15, '2147483647', 14, 15, '{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(16, '2147483647', 14, 16, '{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(17, '2147483647', 15, 17, '{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(18, '2147483647', 15, 18, '{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(19, '160761094880XO', 15, 19, '{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(20, '160761094880XO', 15, 20, '{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}');

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
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
