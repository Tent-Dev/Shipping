-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 20, 2020 at 03:34 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`id`, `firstname`, `lastname`, `member_type`, `username`, `password`, `session_id`) VALUES
(3, 'Test', 'Signup', NULL, 'testsignup', '$2y$12$rUz0H84mEiG0BDYnqHljDuxOafLyiadlzeWTd6TGrxNojvIbFHBEy', '$2y$12$AOz8QUplw934HauQG0KB9eSlsSDTAPflu4hsDl92Pvh2TxWfWxRDG'),
(4, 'มาลี', 'อร่อยนะ', 'admin', 'admin', '$2y$12$cseLkNbuvrIOD506dAPtze7PGfyDwclbHjTKXVpKV/PP9/wpwfx22', '$2y$12$Z5IiBMH.gKnYK4EbV2O.tOZtYsQx6zdl.0CGXpalHhv5a9eDuU8zi'),
(5, 'Admin', 'Test', NULL, 'admin2', '$2y$12$eK974nZoXdYRNe6nrJm1S.2drx/0o/Roen/DssBHj/0po1B.AGavG', '$2y$12$UCjJNDw3AHmDDpxJOLxCLeeOz5Ps9qfOGlWRCg0hfKaOe/8L9vqEi'),
(6, 'Admin', 'Test', NULL, 'admin3', '$2y$12$2m3D1N8Wa7ijQMtu1j6RPe9NVEDk0wZhOvldHn5R7/FkHi3W6IuAe', NULL),
(7, 'Admin', 'Test', NULL, 'admin22', '$2y$12$BDIL.R7eVoSUlaNiEC5F.OCzcZ5Kqdhv7vGvkAceC3s8vvrVJlgLa', NULL),
(8, 'Test', 'Create', NULL, 'testCreate1', '$2y$12$3Fk5Crpk5JuF4S1jqVz7ke5FbR6AGUW/hpfoB6xJytZ3aOEVrcbu.', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `shipping_type`, `weight`, `price`, `tracking_code`, `status`, `create_date`, `shipper_id`, `temp_shipping`) VALUES
(1, 'normal', 1.5, 30, 'SH316N7810AM4', 'success', '2020-12-19 17:14:58', 0, ''),
(2, 'normal', 1.5, 30, 'SH780H5261ZO2', 'waiting', '2020-12-19 17:14:58', 0, ''),
(3, 'normal', 1.5, 30, 'SH857Y2649MK5', 'waiting', '2020-12-19 17:15:04', 0, ''),
(4, 'normal', 1.5, 30, 'SH362L1947SE4', 'waiting', '2020-12-19 17:15:04', 0, ''),
(5, 'normal', 1.5, 30, 'SH170Q6702TD5', 'waiting', '2020-12-19 17:15:05', 0, ''),
(6, 'normal', 1.5, 30, 'SH940C5329UH2', 'waiting', '2020-12-19 17:15:05', 0, ''),
(7, 'normal', 1.5, 30, 'SH189T8241ID3', 'waiting', '2020-12-19 17:15:06', 0, ''),
(8, 'normal', 1.5, 30, 'SH384W0541PK8', 'waiting', '2020-12-19 17:15:07', 0, ''),
(9, 'normal', 1.5, 30, 'SH872S5204PM5', 'waiting', '2020-12-19 17:15:08', 0, ''),
(10, 'normal', 1.5, 30, 'SH680Z0367OF3', 'sending', '2020-12-19 17:15:08', 0, '');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`id`, `transaction_id`, `customer_id`, `product_id`, `receiver_desc`, `sender_desc`) VALUES
(1, '160839809821DH', 14, 1, '{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(2, '160839809921DH', 14, 2, '{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(3, '160839810436YU', 14, 3, '{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(4, '160839810436YU', 14, 4, '{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(5, '160839810535UO', 14, 5, '{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(6, '160839810535UO', 14, 6, '{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(7, '160839810671HF', 14, 7, '{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(8, '160839810771HF', 14, 8, '{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(9, '160839810848HA', 14, 9, '{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(10, '160839810848HA', 14, 10, '{"firstname":"ชื่อคนส่ง","lastname":"นามสกุลคนส่ง","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนรับ","lastname":"นามสกุลคนรับ","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transport`
--

INSERT INTO `tbl_transport` (`id`, `product_id`, `status`, `note`, `timestamp`) VALUES
(1, '1', 'waiting', '', '2020-12-19 17:14:58'),
(2, '2', 'waiting', '', '2020-12-19 17:14:59'),
(3, '3', 'waiting', '', '2020-12-19 17:15:04'),
(4, '4', 'waiting', '', '2020-12-19 17:15:04'),
(5, '5', 'waiting', '', '2020-12-19 17:15:05'),
(6, '6', 'waiting', '', '2020-12-19 17:15:05'),
(7, '7', 'waiting', '', '2020-12-19 17:15:06'),
(8, '8', 'waiting', '', '2020-12-19 17:15:07'),
(9, '9', 'waiting', '', '2020-12-19 17:15:08'),
(10, '10', 'waiting', '', '2020-12-19 17:15:08'),
(11, '1', 'sending', '', '2020-12-19 17:16:05'),
(13, '1', 'return_distribution_center', 'ผู้รับไม่อยู่บ้าน', '2020-12-20 10:28:03'),
(14, '1', 'sending', '', '2020-12-20 10:28:49'),
(15, '1', 'success', '', '2020-12-20 10:29:03'),
(16, '10', 'sending', '', '2020-12-20 10:34:37');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_transport`
--
ALTER TABLE `tbl_transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
