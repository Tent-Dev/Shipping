-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2021 at 05:12 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `firstname`, `lastname`, `id_card`, `phone_number`) VALUES
(1, 'สมหาย', 'ใจดี', '1102005555888', '0830884161');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_map_transaction`
--

CREATE TABLE IF NOT EXISTS `tbl_map_transaction` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(20) NOT NULL,
  `total_price` float NOT NULL,
  `get_price` float NOT NULL,
  `change_price` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_map_transaction`
--

INSERT INTO `tbl_map_transaction` (`id`, `transaction_id`, `total_price`, `get_price`, `change_price`) VALUES
(1, '161185388391LK', 4500, 5000, 500);

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
(4, 'มาลี2', 'ไม่อร่อยนะ', 'admin', 'admin', '$2y$12$BP0jqnze1LL/VfJe3DcT.eB/ODAhkxDZtO9oTaKmvXi.2tVGNtFKu', '$2y$12$kUkv4EnMq8QzwH2ldA0faeFXOL1yaIDTaU7zaLuo2ydyR2XgQARjq', 'T'),
(5, 'Test', 'Create2', 'staff', 'testaccount', '$2y$12$i0G.Xb3tKE50HPqzsWkhQ.U00Nz1uR8xSUOpj4b9JVMYxuO/xuFmy', NULL, 'F'),
(6, 'Testadd', 'Onpage', 'admin', 'admin2', '$2y$12$xQfZzkrtApWh/D280A0BseVN/d2rh8KcylzpTQAvMCsciEVBcVPIW', NULL, 'T'),
(7, 'Chutipas2', 'Borsub', 'staff', 'itsofun01', '$2y$12$H.ISNtFqC.jCeGTsJmOiW.WepH7w0hGbsw9VKbFLXHwZxhy9eH0e.', '$2y$12$5VBl0Inj..C/ld5GSad0ae0LL52OL1clFtcXTIEHFxEgKEt5ZH5gC', 'T'),
(8, 'Manee', 'Aroina', 'admin', 'Manee01', '$2y$12$SLL7v8bGgA7VMLs.kyUwIuroR9qGUsLiLTl0EEqssuZN7lPb942oy', NULL, 'T'),
(9, 'Bot', 'test', 'staff', 'Bot01', '$2y$12$DoRHcqnFtQ.56dLRkKK9feQvFrR/rIWn6lBs9F.N5EnaAtfd4lH/q', NULL, 'F'),
(10, 'Bot2', 'Test', 'staff', 'Bot02', '$2y$12$TDPRxMF3RBFwu.AwQ0zz3e/fVJBBM93ssU4OWla7/ih2u5l.VEAq2', NULL, 'F'),
(11, 'Test', 'Postman', 'admin', 'admin_postman', '$2y$12$g.CiobjIU9wgVm6b526Z9.mLh40omKe7IFomwyfw/pxF2sXyaTNqO', '$2y$12$czOTYxjH8fxLBhWj3Rtvuu7Ii1mWhqr1Fyj1NggITT5R211XCict2', 'T'),
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
  `cod_price` float NOT NULL DEFAULT '0',
  `image_signature` text NOT NULL,
  `active_status` varchar(1) NOT NULL DEFAULT 'T'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `shipping_type`, `weight`, `price`, `tracking_code`, `status`, `create_date`, `shipper_id`, `payment_type`, `cod_price`, `image_signature`, `active_status`) VALUES
(1, 'normal', 450, 4500, 'SH291U7513ZT5', 'waiting', '2021-01-28 17:11:23', 0, 'normal', 0, '', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receiver`
--

CREATE TABLE IF NOT EXISTS `tbl_receiver` (
  `id` int(11) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `area` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_receiver`
--

INSERT INTO `tbl_receiver` (`id`, `phone_number`, `firstname`, `lastname`, `address`, `area`) VALUES
(1, '0859484777', 'มานี', 'มีเงิน', '{"firstname":"มานี","lastname":"มีเงิน","address":"12/998","district":"บางบอน","area":"บางบอน","province":"กรุงเทพมหานคร","postal":"10150","phone_number":"0859484777"}', 'บางบอน');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sender`
--

INSERT INTO `tbl_sender` (`id`, `phone_number`, `firstname`, `lastname`, `address`) VALUES
(1, '0897456565', 'สมหาย', 'ใจดี', '{"firstname":"สมหาย","lastname":"ใจดี","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0897456565"}');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`id`, `transaction_id`, `employee_id`, `customer_id`, `product_id`, `receiver_desc`, `sender_desc`, `create_date`, `active_status`) VALUES
(1, '161185388391LK', 4, 1, 1, '{"firstname":"มานี","lastname":"มีเงิน","address":"12/998","district":"บางบอน","area":"บางบอน","province":"กรุงเทพมหานคร","postal":"10150","phone_number":"0859484777"}', '{"firstname":"สมหาย","lastname":"ใจดี","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0897456565"}', '2021-01-28 17:11:23', 'T');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transport`
--

INSERT INTO `tbl_transport` (`id`, `product_id`, `status`, `note`, `timestamp`) VALUES
(1, '1', 'waiting', '', '2021-01-28 17:11:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_map_transaction`
--
ALTER TABLE `tbl_map_transaction`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_map_transaction`
--
ALTER TABLE `tbl_map_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_receiver`
--
ALTER TABLE `tbl_receiver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_sender`
--
ALTER TABLE `tbl_sender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_transport`
--
ALTER TABLE `tbl_transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
