-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 01, 2021 at 11:06 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `firstname`, `lastname`, `id_card`) VALUES
(1, 'ชื่อคนทำรายการ', 'นามสกุลคนทำรายการ', '1102002841486');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`id`, `firstname`, `lastname`, `member_type`, `username`, `password`, `session_id`) VALUES
(4, 'มาลี', 'ไม่อร่อยนะ', 'admin', 'admin', '$2y$12$BP0jqnze1LL/VfJe3DcT.eB/ODAhkxDZtO9oTaKmvXi.2tVGNtFKu', '$2y$12$mPrVLQuTRAEqqXZheiyKXeVr3rv89gmaKqAvz1rpizqyCUSF4zZwW'),
(5, 'Test', 'Create2', 'staff', 'testaccount', '$2y$12$i0G.Xb3tKE50HPqzsWkhQ.U00Nz1uR8xSUOpj4b9JVMYxuO/xuFmy', NULL),
(6, 'Testadd', 'Onpage', 'admin', 'admin2', '$2y$12$xQfZzkrtApWh/D280A0BseVN/d2rh8KcylzpTQAvMCsciEVBcVPIW', NULL),
(7, 'Chutipas2', 'Borsub', 'staff', 'itsofun01', '$2y$12$H.ISNtFqC.jCeGTsJmOiW.WepH7w0hGbsw9VKbFLXHwZxhy9eH0e.', '$2y$12$nJXkckMVDQEwM1dYw8c91u2fo393Mio8A73RhdYXQEzbQztJWp0EG'),
(8, 'Manee', 'Aroina', 'staff', 'Manee01', '$2y$12$SLL7v8bGgA7VMLs.kyUwIuroR9qGUsLiLTl0EEqssuZN7lPb942oy', NULL),
(9, 'Bot', 'test', 'staff', 'Bot01', '$2y$12$DoRHcqnFtQ.56dLRkKK9feQvFrR/rIWn6lBs9F.N5EnaAtfd4lH/q', NULL),
(10, 'Bot2', 'Test', 'staff', 'Bot02', '$2y$12$TDPRxMF3RBFwu.AwQ0zz3e/fVJBBM93ssU4OWla7/ih2u5l.VEAq2', NULL);

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
  `image_signature` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `shipping_type`, `weight`, `price`, `tracking_code`, `status`, `create_date`, `shipper_id`, `payment_type`, `image_signature`) VALUES
(1, 'normal', 1.5, 30, 'SH540H2684NJ9', 'waiting', '2020-12-26 18:27:57', 6, 'cod', ''),
(2, 'normal', 1.5, 30, 'SH023V5641RS5', 'success', '2020-12-26 18:27:57', 8, 'cod', ''),
(3, 'normal', 1.5, 30, 'SH431C2604NW3', 'success', '2020-12-26 18:28:32', 8, 'cod', '5fef0227e181a_product3.png'),
(4, 'normal', 1.5, 30, 'SH286X5783XI2', 'waiting', '2020-12-26 18:28:32', 0, 'normal', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_receiver`
--

INSERT INTO `tbl_receiver` (`id`, `phone_number`, `firstname`, `lastname`, `address`) VALUES
(1, '0987786666', 'FReceiver1', 'LReceiver1', '{"firstname":"FReceiver1","lastname":"LReceiver1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(2, '0922222222', 'FReceiver2', 'LReceiver2', '{"firstname":"FReceiver2","lastname":"LReceiver2","address":"919 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0922222222"}');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`id`, `transaction_id`, `customer_id`, `product_id`, `receiver_desc`, `sender_desc`) VALUES
(1, '160900727713YO', 1, 1, '{"firstname":"FReceiver1","lastname":"LReceiver1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง1","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0911111111"}'),
(2, '160900727713YO', 1, 2, '{"firstname":"FReceiver2","lastname":"LReceiver2","address":"919 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0922222222"}', '{"firstname":"ชื่อคนส่ง22","lastname":"นามสกุลคนส่ง2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786662"}'),
(3, '160900731274ZM', 1, 3, '{"firstname":"ทดสอบ","lastname":"อัพเดท","address":"12\\/100","district":"หนองแขม","area":"หนองแขม","province":"กรุงเทพ","postal":"10160","phone_number":"0897505566"}', '{"firstname":"ชื่อคนส่ง1","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0911111111"}'),
(4, '160900731274ZM', 1, 4, '{"firstname":"FReceiver2","lastname":"LReceiver2","address":"919 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0922222222"}', '{"firstname":"ชื่อคนส่ง22","lastname":"นามสกุลคนส่ง2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786662"}');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

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
(18, '3', 'success', '', '2021-01-01 11:06:15');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_receiver`
--
ALTER TABLE `tbl_receiver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_transport`
--
ALTER TABLE `tbl_transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
