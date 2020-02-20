-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2019 at 12:39 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wintage`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` varchar(10) CHARACTER SET utf8 NOT NULL COMMENT 'รหัสสินค้า',
  `product_name` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'ชื่อสินค้า',
  `product_img` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'รูปสินค้า',
  `barnch` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT 'สาขา',
  `category` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT 'ประเภทสินค้า',
  `sale_price` int(5) NOT NULL COMMENT 'ราคาขาย',
  `discount` int(5) NOT NULL COMMENT 'ส่วนลด',
  `amount` int(5) NOT NULL COMMENT 'จำนวนสินค้า',
  `score` int(5) NOT NULL COMMENT 'คะแนน',
  `store` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'ที่จัดเก็บ',
  `Supplier` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'ผู้ผลิต/ร้านค้าส่ง',
  `status` char(1) CHARACTER SET utf8 NOT NULL DEFAULT '1' COMMENT 'สถานะสินค้า'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_lastname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_phone` varchar(10) CHARACTER SET utf8 NOT NULL,
  `user_email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `position` char(1) CHARACTER SET utf8 NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `delete_flag` char(1) CHARACTER SET utf8 NOT NULL DEFAULT '1' COMMENT '1 = ใช้งาน , 0 = ไม่ใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `user_lastname`, `user_phone`, `user_email`, `user_password`, `position`, `create_date`, `update_date`, `delete_flag`) VALUES
(1, 'admin', 'test', '0812345678', 'admin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1', '2019-05-29 12:00:00', '2019-05-29 12:00:00', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;