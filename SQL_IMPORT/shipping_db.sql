-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 06, 2021 at 10:05 AM
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
-- Table structure for table `tbl_company`
--

CREATE TABLE IF NOT EXISTS `tbl_company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`id`, `company_name`) VALUES
(1, 'Nakhon Pathom'),
(2, 'Name2');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `firstname`, `lastname`, `id_card`, `phone_number`) VALUES
(1, 'สมหาย', 'ใจดี', '1102005555888', '0830884161'),
(2, 'ชื่อคนทำรายการAAA', 'นามสกุลคนทำรายการ', '1102002841486', '0819584848'),
(3, 'ชื่อใหม่', 'นามสกุลใหม่', '1102002555666', '0859484444'),
(4, 'ชื่อก็พอ', '', '1102002444555', '025555555'),
(5, 'ชื่อก็พอ', 'นะ', '1102002444555', '025555555');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_map_transaction`
--

CREATE TABLE IF NOT EXISTS `tbl_map_transaction` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(20) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `get_price` varchar(255) NOT NULL,
  `change_price` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_map_transaction`
--

INSERT INTO `tbl_map_transaction` (`id`, `transaction_id`, `total_price`, `get_price`, `change_price`) VALUES
(1, '161185388391LK', '4500', '5000', '500'),
(2, '161202152897LW', '60', '60', '0'),
(3, '161203011360QY', '2800', '2900', '100'),
(4, '161254376084QB', '60', '60', '0'),
(5, '161331709394FW', '50000', '100000', '50000'),
(6, '161391947673JU', '15', '600', '585'),
(7, '161391964486QJ', '5000', '20000', '15000'),
(8, '161391971597FZ', '4000', '4000', '0'),
(9, '161435944638ZB', '55', '55', '0'),
(10, '161435980769RE', '550', '555', '5'),
(11, '161444648018322LK', '855.2', '0', '0'),
(12, '161444648018322LK', '855.2', '900', '44.8'),
(13, '161444648018322LK', '855.2', '900', '44.8'),
(14, '161444719384621YT', '458.9', '500', '41.1'),
(15, '161444732201286RD', '4952', '5000', '48'),
(16, '161444834149377AQ', '783.6', '1000', '216.4'),
(17, '161445001083768UT', '783.5999999999999', '1000', '216.4'),
(18, '161445165707862JM', '751.20', '1000', '248.80'),
(19, '161450636791519LT', '500.00', '500', '0.00'),
(20, '161450831054281RF', '0.00', '', ''),
(21, '161451951550541SO', '428.80', '900', '471.20'),
(22, '161452077433113ZF', '1057.69', '1200', '142.31'),
(23, '161452077433113ZF', '1057.69', '1200', '142.31'),
(24, '161452077433113ZF', '1057.69', '1200', '142.31'),
(25, '161452077433113ZF', '1057.69', '1200', '142.31'),
(26, '161452077433113ZF', '1057.69', '1200', '142.31'),
(27, '161452077433113ZF', '1057.69', '1200', '142.31'),
(28, '161452077433113ZF', '1057.69', '1200', '142.31'),
(29, '161452077433113ZF', '1057.69', '1200', '142.31'),
(30, '161452077433113ZF', '1057.69', '1200', '142.31'),
(31, '161452077433113ZF', '1057.69', '1200', '142.31'),
(32, '161452077433113ZF', '1057.69', '1200', '142.31'),
(33, '161452077433113ZF', '1057.69', '1200', '142.31'),
(34, '161452077433113ZF', '1057.69', '1200', '142.31'),
(35, '161452077433113ZF', '1057.69', '1200', '142.31'),
(36, '161452077433113ZF', '1057.69', '1200', '142.31'),
(37, '161452571349421HQ', '1675.00', '2000', '325.00'),
(38, '161452571349421HQ', '1675.00', '2000', '325.00'),
(39, '161452664320655VW', '653.90', '653.90', '0.00'),
(40, '161452692404812AA', '450.00', '500', '50.00'),
(41, '161530539608982CC', '130.00', '200', '70.00'),
(42, '161660592299718NX', '0.00', '', ''),
(43, '161712390039628NG', '500.00', '4000', '3500.00'),
(44, '161712469067693SP', '515.00', '1000', '485.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE IF NOT EXISTS `tbl_member` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `member_type` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `session_id` text,
  `active_status` varchar(1) NOT NULL DEFAULT 'T'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`id`, `company_id`, `firstname`, `lastname`, `member_type`, `username`, `password`, `session_id`, `active_status`) VALUES
(4, 1, 'มาลี2', 'ไม่อร่อยนะ', 'admin', 'admin', '$2y$12$BP0jqnze1LL/VfJe3DcT.eB/ODAhkxDZtO9oTaKmvXi.2tVGNtFKu', '$2y$12$enuftxcZUNHZ3cwRf3qcluBul73YVFYTVu2zEjEdc68IOoyfUpuh.', 'T'),
(5, 1, 'Test', 'Create2', 'staff', 'testaccount', '$2y$12$i0G.Xb3tKE50HPqzsWkhQ.U00Nz1uR8xSUOpj4b9JVMYxuO/xuFmy', NULL, 'F'),
(6, 1, 'Testadd', 'Onpage', 'admin', 'admin2', '$2y$12$xQfZzkrtApWh/D280A0BseVN/d2rh8KcylzpTQAvMCsciEVBcVPIW', NULL, 'T'),
(7, 1, 'Chutipas2', 'Borsub', 'staff', 'itsofun01', '$2y$12$H.ISNtFqC.jCeGTsJmOiW.WepH7w0hGbsw9VKbFLXHwZxhy9eH0e.', '$2y$12$5VBl0Inj..C/ld5GSad0ae0LL52OL1clFtcXTIEHFxEgKEt5ZH5gC', 'T'),
(8, 2, 'Manee', 'Aroina', 'admin', 'Manee01', '$2y$12$SLL7v8bGgA7VMLs.kyUwIuroR9qGUsLiLTl0EEqssuZN7lPb942oy', NULL, 'T'),
(9, 2, 'Bot', 'test', 'staff', 'Bot01', '$2y$12$DoRHcqnFtQ.56dLRkKK9feQvFrR/rIWn6lBs9F.N5EnaAtfd4lH/q', NULL, 'F'),
(10, 1, 'Bot2', 'Test', 'staff', 'Bot02', '$2y$12$TDPRxMF3RBFwu.AwQ0zz3e/fVJBBM93ssU4OWla7/ih2u5l.VEAq2', NULL, 'F'),
(11, 2, 'Test', 'Postman', 'admin', 'admin_postman', '$2y$12$g.CiobjIU9wgVm6b526Z9.mLh40omKe7IFomwyfw/pxF2sXyaTNqO', '$2y$12$EiHGyuiv.dWRdiJiDKV6C.I/1oqPYr4tzNqjR56IOD4LiLPwDUL8C', 'T'),
(12, 2, 'Test', 'Shipper', 'shipper', 'shipper01', '$2y$12$RuFmO0OLmbCtdvJJ5gNVjuvGvgrrWG81XQ4qJwTw.wEx2Opm8wm4m', '$2y$12$9Kh3botS8H1QX5ogpNKbb.U6m4t4azGEOwij9MmVakZMGVHyzeBru', 'T'),
(13, 2, 'ChutipasN', 'N', 'shipper', 'testN', '$2y$12$vM5Uy/xa4tqIQnOZgcO7bOxya9er.3hLGZsSEFeLD/ZbZK5.rbLvO', NULL, 'T'),
(14, 1, 'Nakorn', 'P', 'admin', 'A1', '$2y$12$1Ua0SGX7rHjvmg6xHnFKlOatBEGjYUkxTJ5Pg03CZfdda2omVs296', NULL, 'T');

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
  `create_date` datetime NOT NULL,
  `shipper_id` int(11) DEFAULT NULL,
  `payment_type` text NOT NULL,
  `cod_price` float NOT NULL DEFAULT '0',
  `product_type` varchar(50) NOT NULL,
  `image_signature` text,
  `active_status` varchar(1) NOT NULL DEFAULT 'T',
  `confirm_create` varchar(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `shipping_type`, `weight`, `price`, `tracking_code`, `status`, `create_date`, `shipper_id`, `payment_type`, `cod_price`, `product_type`, `image_signature`, `active_status`, `confirm_create`) VALUES
(1, 'normal', 450, 4500, 'SH291U7513ZT5', 'return_distribution_center', '2021-01-29 00:11:23', 8, 'normal', 0, '', '', 'T', ''),
(2, 'normal', 1.5, 30, 'SH356S1089GO6', 'waiting', '2021-01-30 22:45:28', 0, 'cod', 8000, '', '', 'T', ''),
(3, 'normal', 1.5, 30, 'SH951E4153UQ7', 'waiting', '2021-01-30 22:45:29', 0, 'normal', 0, '', '', 'T', ''),
(4, 'normal', 28, 2800, 'SH570Y8275OU1', 'waiting', '2021-01-31 01:08:33', 0, 'cod', 900, '', '', 'T', ''),
(5, 'normal', 1.5, 30, 'SH934J5702CX0', 'success', '2021-02-05 23:49:20', 8, 'normal', 0, '', '601d7778d0697_product5.png', 'T', ''),
(6, 'normal', 1.5, 30, 'SH980W1840DK4', 'sending', '2021-02-05 23:49:20', 8, 'normal', 0, '', '', 'T', ''),
(7, 'normal', 5000, 50000, 'SH759I8579RY4', 'waiting', '2021-02-14 22:38:13', NULL, 'normal', 0, '', '', 'T', ''),
(8, 'normal', 1.5, 15, 'SH602J2964EZ9', 'waiting', '2021-02-21 21:57:56', NULL, 'normal', 0, '', '', 'T', ''),
(9, 'normal', 500, 5000, 'SH502M6974FB4', 'waiting', '2021-02-21 22:00:44', NULL, 'normal', 0, '', '', 'T', ''),
(10, 'normal', 400, 4000, 'SH154T8193BL8', 'waiting', '2021-02-21 22:01:55', NULL, 'normal', 0, '', '', 'T', ''),
(11, 'normal', 0, 0, 'SH195A0763NK0', 'waiting', '2021-02-27 00:10:46', NULL, '', 0, '', '', 'T', ''),
(12, 'normal', 5.5, 55, 'SH865A7264HL0', 'waiting', '2021-02-27 00:10:46', NULL, 'normal', 0, '', '', 'T', ''),
(13, 'normal', 0, 0, 'SH723E3416GQ9', 'waiting', '2021-02-27 00:10:46', NULL, '', 0, '', '', 'T', ''),
(14, 'normal', 55, 550, 'SH783S0492MI8', 'waiting', '2021-02-27 00:16:47', NULL, 'normal', 0, '', '', 'T', ''),
(15, 'normal', 10, 100, 'SH358H9475YJ7', 'waiting', '2021-02-27 20:13:30', NULL, 'normal', 0, '', '', 'T', ''),
(16, 'normal', 10, 100, 'SH178P3618FD6', 'waiting', '2021-02-27 20:14:08', NULL, 'normal', 0, '', '', 'T', ''),
(17, 'normal', 50, 500, 'SH782O5618LB9', 'waiting', '2021-02-27 20:22:24', NULL, 'normal', 0, '', '', 'T', ''),
(18, 'normal', 55, 550, 'SH254Q8416JI6', 'waiting', '2021-02-27 21:28:17', NULL, 'normal', 0, '', '', 'T', ''),
(19, 'normal', 40, 400, 'SH810R8237TD2', 'waiting', '2021-02-27 21:28:57', NULL, 'normal', 0, '', '', 'T', ''),
(20, 'normal', 55, 550, 'SH813R6715PD0', 'waiting', '2021-02-27 21:33:51', NULL, 'normal', 0, '', '', 'T', ''),
(21, 'normal', 47, 470, 'SH913J1679LE6', 'waiting', '2021-02-27 21:34:16', NULL, 'normal', 0, '', '', 'T', ''),
(22, 'normal', 47.54, 475.4, 'SH985A2589KT4', 'waiting', '2021-02-27 21:36:10', NULL, 'normal', 0, '', '', 'T', ''),
(23, 'normal', 58.54, 585.4, 'SH392G7145SK9', 'waiting', '2021-02-27 21:39:16', NULL, 'normal', 0, '', '', 'T', ''),
(24, 'normal', 69.584, 695.84, 'SH028N6894PD2', 'waiting', '2021-02-27 21:39:48', NULL, 'normal', 0, '', '', 'T', ''),
(25, 'normal', 58.697, 586.97, 'SH701G0731UY7', 'waiting', '2021-02-27 21:42:16', NULL, 'normal', 0, '', '', 'T', ''),
(26, 'normal', 58.474, 584.74, 'SH157D6702ET9', 'waiting', '2021-02-27 21:45:28', NULL, 'normal', 0, '', '', 'T', ''),
(27, 'normal', 45.787, 457.87, 'SH759N6180JR1', 'waiting', '2021-02-27 21:46:54', NULL, 'normal', 0, '', '', 'T', ''),
(28, 'normal', 45.884, 458.84, 'SH106J4806EO9', 'waiting', '2021-02-27 21:48:08', NULL, 'normal', 0, '', '', 'T', ''),
(29, 'normal', 45.822, 458.22, 'SH904F9631VB8', 'waiting', '2021-02-27 21:49:24', NULL, 'normal', 0, '', '', 'T', ''),
(30, 'normal', 45.666, 456.66, 'SH985Q3254KY2', 'waiting', '2021-02-27 21:50:19', NULL, 'normal', 0, '', '', 'T', ''),
(31, 'normal', 45.226, 452.26, 'SH347X3527SB4', 'waiting', '2021-02-27 21:56:44', NULL, 'normal', 0, '', '', 'T', ''),
(32, 'normal', 402.55, 4025.5, 'SH648C5619QR4', 'waiting', '2021-02-27 21:57:56', NULL, 'normal', 0, '', '', 'T', ''),
(33, 'normal', 12.544, 125.44, 'SH875I3970XJ3', 'waiting', '2021-02-27 21:58:51', NULL, 'normal', 0, '', '', 'T', ''),
(34, 'normal', 15.666, 156.66, 'SH623I2978AG5', 'waiting', '2021-02-27 22:00:20', NULL, 'normal', 0, '', '', 'T', ''),
(35, 'normal', 44.521, 445.21, 'SH581D4813UZ7', 'waiting', '2021-02-27 22:41:41', NULL, 'normal', 0, '', '', 'T', ''),
(36, 'normal', 52.11, 521.1, 'SH506Z4653WC6', 'waiting', '2021-02-27 22:44:12', NULL, 'normal', 0, '', '', 'T', ''),
(37, 'normal', 2.554, 25.54, 'SH205K7413PG3', 'waiting', '2021-02-27 22:53:59', NULL, 'normal', 0, '', '', 'T', ''),
(38, 'normal', 44.213, 442.13, 'SH831Y5380RC7', 'waiting', '2021-02-27 22:54:32', NULL, 'normal', 0, '', '', 'T', ''),
(39, 'normal', 2.541, 25.41, 'SH735N3648ID9', 'waiting', '2021-02-27 23:06:06', NULL, 'normal', 0, '', '', 'T', ''),
(40, 'normal', 45.887, 458.87, 'SH830P0245EK0', 'waiting', '2021-02-27 23:15:51', NULL, 'normal', 0, '', '', 'T', ''),
(41, 'normal', 45.98, 459.8, 'SH837O5409DW4', 'waiting', '2021-02-27 23:16:20', NULL, 'normal', 0, '', '', 'T', ''),
(42, 'normal', 12.455, 124.55, 'SH874Q5973CD5', 'waiting', '2021-02-27 23:24:13', NULL, 'normal', 0, '', '', 'T', ''),
(43, 'normal', 42.88, 428.8, 'SH375B1506AN0', 'waiting', '2021-02-27 23:25:20', NULL, 'cod', 300, '', '', 'T', ''),
(44, 'normal', 45.882, 458.82, 'SH082J6048SC8', 'waiting', '2021-02-28 00:20:45', NULL, 'normal', 0, '', '', 'T', ''),
(45, 'normal', 85.52, 855.2, 'SH403N4192YX7', 'waiting', '2021-02-28 00:23:07', NULL, 'normal', 0, '', '', 'T', ''),
(46, 'normal', 45.89, 458.9, 'SH239S3498JU3', 'waiting', '2021-02-28 00:33:48', NULL, 'normal', 0, '', '', 'T', ''),
(47, 'normal', 450, 4500, 'SH681R5931XP4', 'waiting', '2021-02-28 00:36:57', NULL, 'normal', 0, '', '', 'T', ''),
(48, 'normal', 45.2, 452, 'SH128N6483TA1', 'waiting', '2021-02-28 00:37:29', NULL, 'normal', 0, '', '', 'T', ''),
(49, 'normal', 45.82, 458.2, 'SH974N3498OW0', 'waiting', '2021-02-28 00:52:43', NULL, 'normal', 0, '', '', 'T', ''),
(50, 'normal', 32.54, 325.4, 'SH508N4069JA0', 'waiting', '2021-02-28 00:52:58', NULL, 'normal', 0, '', '', 'T', ''),
(51, 'normal', 45.82, 458.2, 'SH732A5697YX5', 'waiting', '2021-02-28 01:20:53', NULL, 'normal', 0, '', '', 'T', ''),
(52, 'normal', 32.54, 325.4, 'SH583W0574XB0', 'waiting', '2021-02-28 01:21:12', NULL, 'normal', 0, '', '', 'T', ''),
(53, 'normal', 42.58, 425.8, 'SH490B5639JL8', 'waiting', '2021-02-28 01:48:07', NULL, 'normal', 0, '', '', 'T', ''),
(54, 'normal', 32.54, 325.4, 'SH361H0945BG0', 'waiting', '2021-02-28 01:48:29', NULL, 'normal', 0, '', '', 'T', ''),
(55, 'normal', 12.556, 125.56, 'SH429V2485WC8', 'waiting', '2021-02-28 16:10:25', NULL, 'normal', 0, '', '', 'T', ''),
(56, 'normal', 66, 660, 'SH709C4067SY5', 'waiting', '2021-02-28 16:17:02', NULL, 'normal', 0, '', '', 'T', ''),
(57, 'normal', 45.25, 452.5, 'SH254Q4698UM5', 'waiting', '2021-02-28 16:36:36', NULL, 'normal', 0, '', '', 'T', ''),
(58, 'normal', 22, 220, 'SH703W3062XM2', 'waiting', '2021-02-28 16:37:42', NULL, 'normal', 0, '', '', 'T', ''),
(59, 'normal', 12.554, 125.54, 'SH860Y3786TV6', 'waiting', '2021-02-28 16:39:08', NULL, 'normal', 0, '', '', 'T', ''),
(60, 'normal', 25.14, 251.4, 'SH167J3507XD1', 'waiting', '2021-02-28 16:40:10', NULL, 'normal', 0, '', '', 'T', ''),
(61, 'normal', 42.5, 500, 'SH423X3254WS2', 'waiting', '2021-02-28 16:59:55', NULL, 'normal', 0, '', '', 'T', ''),
(62, 'normal', 45.88, 458.8, 'SH461G1059OT3', 'waiting', '2021-02-28 17:30:33', NULL, 'normal', 0, '', '', 'T', ''),
(63, 'normal', 452.64, 4526.4, 'SH102T8129NW5', 'waiting', '2021-02-28 17:38:06', NULL, 'normal', 0, '', '', 'T', ''),
(64, 'normal', 42.85, 428.5, 'SH352X0174RV6', 'waiting', '2021-02-28 17:42:30', NULL, 'normal', 0, '', '', 'T', ''),
(65, 'normal', 50, 500, 'SH981Y0853ER6', 'waiting', '2021-02-28 17:43:26', NULL, 'normal', 0, '', '', 'T', ''),
(66, 'normal', 12.5, 125, 'SH297B5634WA1', 'waiting', '2021-02-28 17:56:17', NULL, 'normal', 0, '', '', 'T', ''),
(67, 'normal', 50, 500, 'SH892A4170GP2', 'waiting', '2021-02-28 18:00:07', NULL, 'normal', 0, '', '', 'T', ''),
(68, 'normal', 12.52, 125.2, 'SH067N7931HW3', 'waiting', '2021-02-28 18:03:05', NULL, 'normal', 0, '', '', 'T', ''),
(69, 'normal', 42.88, 428.8, 'SH371A9854ZQ6', 'waiting', '2021-02-28 20:38:54', NULL, 'normal', 0, 'none', '', 'T', ''),
(70, 'normal', 52.889, 528.89, 'SH714V5863DZ4', 'waiting', '2021-02-28 20:59:51', 6, 'normal', 0, 'none', '', 'T', 'T'),
(71, 'normal', 52.88, 528.8, 'SH793U3716AF1', 'waiting', '2021-02-28 21:01:22', NULL, 'normal', 0, 'none', '', 'T', 'T'),
(72, 'normal', 12.5, 125, 'SH156S2408SZ3', 'waiting', '2021-02-28 21:55:21', NULL, 'normal', 0, 'none', '', 'T', 'F'),
(73, 'normal', 12.5, 125, 'SH596M1724SQ2', 'waiting', '2021-02-28 22:22:17', NULL, 'normal', 0, 'it', '', 'T', 'T'),
(74, 'normal', 55, 550, 'SH947R0237OA0', 'waiting', '2021-02-28 22:22:50', NULL, 'normal', 0, 'it', '', 'T', 'T'),
(75, 'normal', 45, 450, 'SH679P2635UC8', 'waiting', '2021-02-28 22:31:18', 7, 'normal', 0, 'it', '', 'T', 'T'),
(76, 'normal', 55, 550, 'SH649F8062IE0', 'waiting', '2021-02-28 22:31:37', NULL, 'normal', 0, 'it', '', 'T', 'T'),
(77, 'normal', 12.85, 128.5, 'SH463X9642KA6', 'waiting', '2021-02-28 22:37:39', 4, 'normal', 0, 'none', '', 'T', 'T'),
(78, 'normal', 52.54, 525.4, 'SH241Z1234RA4', 'waiting', '2021-02-28 22:37:57', 4, 'normal', 0, 'none', '', 'T', 'T'),
(79, 'normal', 45, 450, 'SH986Y0763OV6', 'waiting', '2021-02-28 22:42:38', 6, 'normal', 0, 'fruits', '', 'T', 'T'),
(80, 'normal', 13, 130, 'SH142R4251YI6', 'waiting', '2021-03-09 22:56:54', 8, 'cod', 500, 'doc', '', 'T', 'T'),
(82, 'normal', 1.5, 15, 'SH236J5209DP6', 'waiting', '2021-03-24 23:50:08', NULL, 'normal', 0, 'doc', '', 'T', 'F'),
(83, 'normal', 1.5, 15, 'SH075K6924QG1', 'waiting', '2021-03-24 23:51:16', NULL, 'normal', 0, 'doc', '', 'T', 'F'),
(84, 'normal', 1.5, 15, 'SH193O2578IB9', 'waiting', '2021-03-24 23:51:52', NULL, 'normal', 0, 'doc', '', 'T', 'F'),
(87, 'normal', 1.5, 15, 'SH306P5109TN3', 'waiting', '2021-03-25 00:27:31', NULL, 'normal', 0, 'doc', '', 'T', 'F'),
(88, 'normal', 50, 500, 'SH421V1698WQ3', 'waiting', '2021-03-31 00:05:21', 8, 'normal', 0, 'doc', '', 'T', 'T'),
(89, 'normal', 1.5, 15, 'SH213H9750TR6', 'waiting', '2021-03-31 00:18:24', 7, 'normal', 0, 'doc', '', 'T', 'T'),
(90, 'normal', 50, 500, 'SH798Z1695CY9', 'waiting', '2021-03-31 00:18:48', NULL, 'cod', 200, 'doc', '', 'T', 'T');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_receiver`
--

INSERT INTO `tbl_receiver` (`id`, `phone_number`, `firstname`, `lastname`, `address`, `area`) VALUES
(1, '0859484777', 'มานี', 'มีเงิน', '{"firstname":"มานี","lastname":"มีเงิน","address":"12/998","district":"บางบอน","area":"บางบอน","province":"กรุงเทพมหานคร","postal":"10150","phone_number":"0859484777"}', 'บางบอน'),
(2, '0987786666', 'ชื่อคนรับ1', 'นามสกุลคนรับ1AA', '{"firstname":"ชื่อคนรับ1","lastname":"นามสกุลคนรับ1AA","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', 'สวนหลวง'),
(3, '0830884161', 'Chutipas', 'Borsub', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', 'องครักษ์'),
(4, '0830884161', 'Chutipas', 'Borsub', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"คลองต้นไทร","area":"คลองสาน","province":"กรุงเทพมหานคร","postal":"10600","phone_number":"0830884161"}', 'คลองสาน'),
(5, '0830884161', 'E-TENT', 'Studio', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"หนองค้างพลู","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', 'หนองแขม'),
(6, '0830884161', 'E-TENT', 'Studio', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0830884161"}', 'สวนหลวง'),
(7, '0830884161', 'Chutipas', 'Borsub', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0830884161"}', 'สวนหลวง'),
(8, '0859478888', 'รวมชื่อ', 'สกุลรับ', '{"firstname":"รวมชื่อ","lastname":"สกุลรับ","address":"55","district":"สวนกล้วย","area":"กันทรลักษ์","province":"ศรีสะเกษ","postal":"33110","phone_number":"0859478888"}', 'กันทรลักษ์'),
(9, '0859884444', 'รวมชื่อ', 'คนรับ', '{"firstname":"รวมชื่อ","lastname":"คนรับ","address":"55","district":"หนองกบ","area":"หนองแซง","province":"สระบุรี","postal":"18170","phone_number":"0859884444"}', 'หนองแซง'),
(10, '0875558899', 'ชื่อคนรับ2', 'หวัดดี', '{"firstname":"ชื่อคนรับ2","lastname":"หวัดดี","address":"99 ถนนพัฒนาการ","district":"บางแค","area":"บางแค","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0875558899"}', 'บางแค');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sender`
--

INSERT INTO `tbl_sender` (`id`, `phone_number`, `firstname`, `lastname`, `address`) VALUES
(1, '0897456565', 'สมหาย', 'ใจดี', '{"firstname":"สมหาย","lastname":"ใจดี","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0897456565"}'),
(2, '0987786666', 'ชื่อคนส่ง1', 'นามสกุลคนส่ง1', '{"firstname":"ชื่อคนส่ง1","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}'),
(3, '0830884161', 'Chutipas', 'Borsub', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}'),
(4, '0830884161', 'Chutipas', 'Borsub', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"คลองต้นไทร","area":"คลองสาน","province":"กรุงเทพมหานคร","postal":"10600","phone_number":"0830884161"}'),
(5, '0830884161', 'Chutipas', 'Borsub', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"บางแค","area":"บางแค","province":"Thailand","postal":"10160","phone_number":"0830884161"}'),
(6, '0830884161', 'E-TENT', 'Studio', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}'),
(7, '0830884161', 'E-TENT', 'Studio', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"Bangkok","postal":"10160","phone_number":"0830884161"}'),
(8, '0859484646', 'รวมชื่อ', 'สกุลส่ง', '{"firstname":"รวมชื่อ","lastname":"สกุลส่ง","address":"12/100","district":"หนองกบ","area":"หนองแซง","province":"สระบุรี","postal":"18170","phone_number":"0859484646"}'),
(9, '0859478888', 'รวมชื่อ', 'คนส่ง', '{"firstname":"รวมชื่อ","lastname":"คนส่ง","address":"12","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0859478888"}'),
(10, '0830884161', 'Chutipas', 'Borsub', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"Thailand","postal":"10160","phone_number":"0830884161"}');

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
  `create_date` datetime NOT NULL,
  `active_status` varchar(1) NOT NULL DEFAULT 'T'
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`id`, `transaction_id`, `employee_id`, `customer_id`, `product_id`, `receiver_desc`, `sender_desc`, `create_date`, `active_status`) VALUES
(1, '161185388391LK', 4, 1, 1, '{"firstname":"มานี","lastname":"มีเงิน","address":"12/998","district":"บางบอน","area":"บางบอน","province":"กรุงเทพมหานคร","postal":"10150","phone_number":"0859484777"}', '{"firstname":"สมหาย","lastname":"ใจดี","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0897456565"}', '2021-01-29 00:11:23', 'T'),
(2, '161202152897LW', 11, 2, 2, '{"firstname":"ชื่อคนรับ1","lastname":"นามสกุลคนรับ1AA","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง1","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '2021-01-30 22:45:28', 'T'),
(3, '161202152997LW', 11, 2, 3, '{"firstname":"ชื่อคนรับ2","lastname":"นามสกุลคนรับ2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง2","lastname":"นามสกุลคนส่ง2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '2021-01-30 22:45:29', 'T'),
(4, '161203011360QY', 4, 1, 4, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-01-31 01:08:33', 'T'),
(5, '161254376084QB', 11, 2, 5, '{"firstname":"ชื่อคนรับ1","lastname":"นามสกุลคนรับ1AA","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง1","lastname":"นามสกุลคนส่ง1","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '2021-02-05 23:49:20', 'T'),
(6, '161254376084QB', 11, 2, 6, '{"firstname":"ชื่อคนรับ2","lastname":"นามสกุลคนรับ2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '{"firstname":"ชื่อคนส่ง2","lastname":"นามสกุลคนส่ง2","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0987786666"}', '2021-02-05 23:49:20', 'T'),
(7, '161331709394FW', 4, 1, 7, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"คลองต้นไทร","area":"คลองสาน","province":"กรุงเทพมหานคร","postal":"10600","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"คลองต้นไทร","area":"คลองสาน","province":"กรุงเทพมหานคร","postal":"10600","phone_number":"0830884161"}', '2021-02-14 22:38:13', 'T'),
(8, '161391947673JU', 4, 1, 8, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"หนองค้างพลู","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"บางแค","area":"บางแค","province":"Thailand","postal":"10160","phone_number":"0830884161"}', '2021-02-21 21:57:56', 'T'),
(9, '161391964486QJ', 4, 3, 9, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0830884161"}', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-21 22:00:44', 'T'),
(10, '161391971597FZ', 4, 5, 10, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0830884161"}', '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"สวนหลวง","area":"สวนหลวง","province":"Bangkok","postal":"10160","phone_number":"0830884161"}', '2021-02-21 22:01:55', 'T'),
(11, '161435944638ZB', 4, 1, 11, '{"firstname":"รวมชื่อ","lastname":"สกุลรับ"}', '{"firstname":"รวมชื่อ","lastname":"สกุลส่ง"}', '2021-02-27 00:10:46', 'T'),
(12, '161435944638ZB', 4, 1, 12, '{"firstname":"รวมชื่อ","lastname":"สกุลรับ"}', '{"firstname":"รวมชื่อ","lastname":"สกุลส่ง"}', '2021-02-27 00:10:46', 'T'),
(13, '161435944638ZB', 4, 1, 13, '{"firstname":"รวมชื่อ","lastname":"สกุลรับ","address":"55","district":"สวนกล้วย","area":"กันทรลักษ์","province":"ศรีสะเกษ","postal":"33110","phone_number":"0859478888"}', '{"firstname":"รวมชื่อ","lastname":"สกุลส่ง","address":"12/100","district":"หนองกบ","area":"หนองแซง","province":"สระบุรี","postal":"18170","phone_number":"0859484646"}', '2021-02-27 00:10:46', 'T'),
(14, '161435980769RE', 4, 1, 14, '{"firstname":"รวมชื่อ","lastname":"คนรับ","address":"55","district":"หนองกบ","area":"หนองแซง","province":"สระบุรี","postal":"18170","phone_number":"0859884444"}', '{"firstname":"รวมชื่อ","lastname":"คนส่ง","address":"12","district":"สวนหลวง","area":"สวนหลวง","province":"กรุงเทพมหานคร","postal":"10250","phone_number":"0859478888"}', '2021-02-27 00:16:47', 'T'),
(15, '161443157791602BR', 4, 1, 15, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 20:13:30', 'T'),
(16, '161443157791602BR', 4, 1, 16, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 20:14:08', 'T'),
(17, '161443157791602BR', 4, 1, 17, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 20:22:24', 'T'),
(18, '161443604639212JR', 4, 1, 18, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 21:28:17', 'T'),
(19, '161443604639212JR', 4, 1, 19, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 21:28:57', 'T'),
(20, '161443641024632TC', 4, 1, 20, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"คลองต้นไทร","area":"คลองสาน","province":"กรุงเทพมหานคร","postal":"10600","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 21:33:51', 'T'),
(21, '161443641024632TC', 4, 1, 21, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 21:34:16', 'T'),
(22, '161443641024632TC', 4, 1, 22, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 21:36:10', 'T'),
(23, '161443672408319YW', 4, 1, 23, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"คลองต้นไทร","area":"คลองสาน","province":"กรุงเทพมหานคร","postal":"10600","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 21:39:16', 'T'),
(24, '161443672408319YW', 4, 1, 24, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"หนองค้างพลู","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 21:39:48', 'T'),
(25, '161443690216044ZJ', 4, 1, 25, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 21:42:16', 'T'),
(26, '161443710223659RM', 4, 1, 26, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 21:45:28', 'T'),
(27, '161443719007580KV', 4, 1, 27, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 21:46:54', 'T'),
(28, '161443726169741TG', 4, 1, 28, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 21:48:08', 'T'),
(29, '161443733348175DY', 4, 1, 29, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"หนองค้างพลู","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 21:49:24', 'T'),
(30, '161443739857503AQ', 4, 1, 30, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 21:50:19', 'T'),
(31, '161443778248414UO', 4, 1, 31, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 21:56:44', 'T'),
(32, '161443778248414UO', 4, 1, 32, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 21:57:56', 'T'),
(33, '161443791064515ZY', 4, 1, 33, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 21:58:51', 'T'),
(34, '161443799522816GV', 4, 1, 34, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"คลองต้นไทร","area":"คลองสาน","province":"กรุงเทพมหานคร","postal":"10600","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 22:00:20', 'T'),
(35, '161443893832266FQ', 4, 1, 35, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"คลองต้นไทร","area":"คลองสาน","province":"กรุงเทพมหานคร","postal":"10600","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 22:41:41', 'T'),
(36, '161444061002514ZQ', 4, 1, 36, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 22:44:12', 'T'),
(37, '161444121715437LP', 4, 1, 37, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"คลองต้นไทร","area":"คลองสาน","province":"กรุงเทพมหานคร","postal":"10600","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 22:53:59', 'T'),
(38, '161444121715437LP', 4, 1, 38, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"หนองค้างพลู","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 22:54:32', 'T'),
(39, '161444194182348GH', 4, 1, 39, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 23:06:06', 'T'),
(40, '161444252641028TZ', 4, 1, 40, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"คลองต้นไทร","area":"คลองสาน","province":"กรุงเทพมหานคร","postal":"10600","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 23:15:51', 'T'),
(41, '161444252641028TZ', 4, 1, 41, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 23:16:20', 'T'),
(42, '161444302614056XX', 4, 1, 42, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 23:24:13', 'T'),
(43, '161444302614056XX', 4, 1, 43, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-27 23:25:20', 'T'),
(44, '161444641815424WG', 4, 1, 44, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 00:20:45', 'T'),
(45, '161444648018322LK', 4, 1, 45, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"คลองต้นไทร","area":"คลองสาน","province":"กรุงเทพมหานคร","postal":"10600","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 00:23:07', 'T'),
(46, '161444719384621YT', 4, 1, 46, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 00:33:48', 'T'),
(47, '161444732201286RD', 4, 1, 47, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 00:36:57', 'T'),
(48, '161444732201286RD', 4, 1, 48, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 00:37:29', 'T'),
(49, '161444834149377AQ', 4, 1, 49, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"คลองต้นไทร","area":"คลองสาน","province":"กรุงเทพมหานคร","postal":"10600","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 00:52:43', 'T'),
(50, '161444834149377AQ', 4, 1, 50, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 00:52:58', 'T'),
(51, '161445001083768UT', 4, 1, 51, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 01:20:53', 'T'),
(52, '161445001083768UT', 4, 1, 52, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 01:21:12', 'T'),
(53, '161445165707862JM', 4, 1, 53, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 01:48:07', 'T'),
(54, '161445165707862JM', 4, 1, 54, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 01:48:29', 'T'),
(55, '161450340025757HZ', 4, 1, 55, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"คลองต้นไทร","area":"คลองสาน","province":"กรุงเทพมหานคร","postal":"10600","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 16:10:25', 'T'),
(56, '161450340025757HZ', 4, 1, 56, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"คลองต้นไทร","area":"คลองสาน","province":"กรุงเทพมหานคร","postal":"10600","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 16:17:02', 'T'),
(57, '161450462811758DA', 4, 1, 57, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"คลองต้นไทร","area":"คลองสาน","province":"กรุงเทพมหานคร","postal":"10600","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 16:36:36', 'T'),
(58, '161450462811758DA', 4, 1, 58, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 16:37:42', 'T'),
(59, '161450512100104GY', 4, 1, 59, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 16:39:08', 'T'),
(60, '161450512100104GY', 4, 1, 60, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 16:40:10', 'T'),
(61, '161450636791519LT', 4, 1, 61, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 16:59:55', 'T'),
(62, '161450821145411WF', 4, 1, 62, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 17:30:33', 'T'),
(63, '161450866210772RR', 4, 1, 63, '{"firstname":"E-TENT","lastname":"Studio","address":"99 ถนนพัฒนาการ","district":"หนองค้างพลู","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 17:38:06', 'T'),
(64, '161450892926643CE', 4, 1, 64, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 17:42:30', 'T'),
(65, '161450898302181LC', 4, 1, 65, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 17:43:26', 'T'),
(66, '161450973893752HO', 4, 1, 66, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 17:56:17', 'T'),
(67, '161450999054233WP', 4, 1, 67, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 18:00:07', 'T'),
(68, '161451015824070TC', 4, 1, 68, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 18:03:05', 'T'),
(69, '161451951550541SO', 4, 1, 69, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 20:38:54', 'T'),
(70, '161452077433113ZF', 4, 1, 70, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 20:59:51', 'T'),
(71, '161452077433113ZF', 4, 1, 71, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 21:01:22', 'T'),
(72, '161452399315956QJ', 4, 1, 72, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 21:55:21', 'T'),
(73, '161452571349421HQ', 4, 1, 73, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 22:22:17', 'T'),
(74, '161452571349421HQ', 4, 1, 74, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 22:22:50', 'T'),
(75, '161452571349421HQ', 4, 1, 75, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 22:31:18', 'T'),
(76, '161452571349421HQ', 4, 1, 76, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 22:31:37', 'T'),
(77, '161452664320655VW', 4, 1, 77, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 22:37:39', 'T'),
(78, '161452664320655VW', 4, 1, 78, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 22:37:57', 'T'),
(79, '161452692404812AA', 4, 1, 79, '{"firstname":"ชื่อคนรับ2","lastname":"หวัดดี","address":"99 ถนนพัฒนาการ","district":"บางแค","area":"บางแค","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0875558899"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-02-28 22:42:38', 'T'),
(80, '161530539608982CC', 4, 1, 80, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"Thailand","postal":"10160","phone_number":"0830884161"}', '2021-03-09 22:56:54', 'T'),
(82, '161660458365777MR', 4, 1, 82, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-03-24 23:50:08', 'T'),
(83, '161660466091490KO', 4, 1, 83, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-03-24 23:51:16', 'T'),
(84, '161660466091490KO', 4, 1, 84, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-03-24 23:51:52', 'T'),
(87, '161660592299718NX', 4, 1, 87, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-03-25 00:27:31', 'T'),
(88, '161712390039628NG', 4, 1, 88, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"กรุงเทพมหานคร","postal":"10160","phone_number":"0830884161"}', '2021-03-31 00:05:21', 'T'),
(89, '161712469067693SP', 11, 1, 89, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"Thailand","postal":"10160","phone_number":"0830884161"}', '2021-03-31 00:18:24', 'T'),
(90, '161712469067693SP', 4, 1, 90, '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"องครักษ์","area":"องครักษ์","province":"นครนายก","postal":"26120","phone_number":"0830884161"}', '{"firstname":"Chutipas","lastname":"Borsub","address":"99 ถนนพัฒนาการ","district":"ยกกระบัตร","area":"หนองแขม","province":"Thailand","postal":"10160","phone_number":"0830884161"}', '2021-03-31 00:18:48', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transport`
--

CREATE TABLE IF NOT EXISTS `tbl_transport` (
  `id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'waiting',
  `note` text,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transport`
--

INSERT INTO `tbl_transport` (`id`, `product_id`, `status`, `note`, `timestamp`) VALUES
(1, '1', 'waiting', '', '2021-01-29 00:11:23'),
(2, '2', 'waiting', '', '2021-01-30 22:45:29'),
(3, '3', 'waiting', '', '2021-01-30 22:45:29'),
(4, '1', 'sending', '', '2021-01-30 23:26:57'),
(5, '4', 'waiting', '', '2021-01-31 01:08:33'),
(6, '1', 'sending', '', '2021-01-31 03:15:51'),
(7, '1', 'return_distribution_center', '', '2021-01-31 23:17:14'),
(8, '5', 'waiting', '', '2021-02-05 23:49:20'),
(9, '6', 'waiting', '', '2021-02-05 23:49:20'),
(10, '5', 'sending', '', '2021-02-05 23:50:53'),
(11, '6', 'sending', '', '2021-02-05 23:50:56'),
(12, '5', 'success', '', '2021-02-05 23:51:04'),
(13, '7', 'waiting', '', '2021-02-14 22:38:13'),
(14, '8', 'waiting', '', '2021-02-21 21:57:56'),
(15, '9', 'waiting', '', '2021-02-21 22:00:44'),
(16, '10', 'waiting', '', '2021-02-21 22:01:55'),
(17, '11', 'waiting', '', '2021-02-27 00:10:46'),
(18, '12', 'waiting', '', '2021-02-27 00:10:46'),
(19, '13', 'waiting', '', '2021-02-27 00:10:46'),
(20, '14', 'waiting', '', '2021-02-27 00:16:47'),
(21, '16', 'waiting', '', '2021-02-27 20:14:08'),
(22, '17', 'waiting', '', '2021-02-27 20:22:24'),
(23, '18', 'waiting', '', '2021-02-27 21:28:17'),
(24, '19', 'waiting', '', '2021-02-27 21:28:57'),
(25, '20', 'waiting', '', '2021-02-27 21:33:51'),
(26, '21', 'waiting', '', '2021-02-27 21:34:16'),
(27, '22', 'waiting', '', '2021-02-27 21:36:10'),
(28, '23', 'waiting', '', '2021-02-27 21:39:16'),
(29, '24', 'waiting', '', '2021-02-27 21:39:48'),
(30, '25', 'waiting', '', '2021-02-27 21:42:16'),
(31, '26', 'waiting', '', '2021-02-27 21:45:28'),
(32, '27', 'waiting', '', '2021-02-27 21:46:54'),
(33, '28', 'waiting', '', '2021-02-27 21:48:08'),
(34, '29', 'waiting', '', '2021-02-27 21:49:24'),
(35, '30', 'waiting', '', '2021-02-27 21:50:19'),
(36, '31', 'waiting', '', '2021-02-27 21:56:44'),
(37, '32', 'waiting', '', '2021-02-27 21:57:56'),
(38, '33', 'waiting', '', '2021-02-27 21:58:51'),
(39, '34', 'waiting', '', '2021-02-27 22:00:20'),
(40, '35', 'waiting', '', '2021-02-27 22:41:41'),
(41, '36', 'waiting', '', '2021-02-27 22:44:12'),
(42, '37', 'waiting', '', '2021-02-27 22:53:59'),
(43, '38', 'waiting', '', '2021-02-27 22:54:32'),
(44, '39', 'waiting', '', '2021-02-27 23:06:06'),
(45, '40', 'waiting', '', '2021-02-27 23:15:51'),
(46, '41', 'waiting', '', '2021-02-27 23:16:20'),
(47, '42', 'waiting', '', '2021-02-27 23:24:13'),
(48, '43', 'waiting', '', '2021-02-27 23:25:20'),
(49, '44', 'waiting', '', '2021-02-28 00:20:45'),
(50, '45', 'waiting', '', '2021-02-28 00:23:07'),
(51, '46', 'waiting', '', '2021-02-28 00:33:48'),
(52, '47', 'waiting', '', '2021-02-28 00:36:57'),
(53, '48', 'waiting', '', '2021-02-28 00:37:29'),
(54, '49', 'waiting', '', '2021-02-28 00:52:43'),
(55, '50', 'waiting', '', '2021-02-28 00:52:58'),
(56, '51', 'waiting', '', '2021-02-28 01:20:53'),
(57, '52', 'waiting', '', '2021-02-28 01:21:12'),
(58, '53', 'waiting', '', '2021-02-28 01:48:07'),
(59, '54', 'waiting', '', '2021-02-28 01:48:29'),
(60, '55', 'waiting', '', '2021-02-28 16:10:25'),
(61, '56', 'waiting', '', '2021-02-28 16:17:02'),
(62, '57', 'waiting', '', '2021-02-28 16:36:36'),
(63, '58', 'waiting', '', '2021-02-28 16:37:42'),
(64, '59', 'waiting', '', '2021-02-28 16:39:08'),
(65, '60', 'waiting', '', '2021-02-28 16:40:10'),
(66, '61', 'waiting', '', '2021-02-28 16:59:55'),
(67, '62', 'waiting', '', '2021-02-28 17:30:33'),
(68, '63', 'waiting', '', '2021-02-28 17:38:06'),
(69, '64', 'waiting', '', '2021-02-28 17:42:30'),
(70, '65', 'waiting', '', '2021-02-28 17:43:26'),
(71, '66', 'waiting', '', '2021-02-28 17:56:17'),
(72, '67', 'waiting', '', '2021-02-28 18:00:07'),
(73, '68', 'waiting', '', '2021-02-28 18:03:05'),
(74, '69', 'waiting', '', '2021-02-28 20:38:54'),
(75, '70', 'waiting', '', '2021-02-28 20:59:51'),
(76, '71', 'waiting', '', '2021-02-28 21:01:22'),
(77, '72', 'waiting', '', '2021-02-28 21:55:21'),
(78, '73', 'waiting', '', '2021-02-28 22:22:17'),
(79, '74', 'waiting', '', '2021-02-28 22:22:50'),
(80, '75', 'waiting', '', '2021-02-28 22:31:18'),
(81, '76', 'waiting', '', '2021-02-28 22:31:37'),
(82, '77', 'waiting', '', '2021-02-28 22:37:39'),
(83, '78', 'waiting', '', '2021-02-28 22:37:57'),
(84, '79', 'waiting', '', '2021-02-28 22:42:38'),
(85, '80', 'waiting', '', '2021-03-09 22:56:54'),
(86, '81', 'waiting', '', '2021-03-24 23:11:51'),
(87, '82', 'waiting', '', '2021-03-24 23:50:08'),
(88, '83', 'waiting', '', '2021-03-24 23:51:16'),
(89, '84', 'waiting', '', '2021-03-24 23:51:52'),
(90, '85', 'waiting', '', '2021-03-25 00:12:20'),
(91, '86', 'waiting', '', '2021-03-25 00:12:37'),
(92, '87', 'waiting', '', '2021-03-25 00:27:31'),
(93, '88', 'waiting', '', '2021-03-31 00:05:21'),
(94, '89', 'waiting', '', '2021-03-31 00:18:24'),
(95, '90', 'waiting', '', '2021-03-31 00:18:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_map_transaction`
--
ALTER TABLE `tbl_map_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `tbl_receiver`
--
ALTER TABLE `tbl_receiver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_sender`
--
ALTER TABLE `tbl_sender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `tbl_transport`
--
ALTER TABLE `tbl_transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=96;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
