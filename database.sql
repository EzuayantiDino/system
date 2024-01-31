-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2024 at 04:35 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `rowid` bigint(20) NOT NULL,
  `userid` varchar(255) NOT NULL COMMENT 'refer to table user',
  `product` bigint(20) DEFAULT NULL COMMENT 'refer to table product',
  `type` bigint(20) DEFAULT NULL COMMENT 'refer to table product_type',
  `qty` int(11) DEFAULT 0,
  `datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`rowid`, `userid`, `product`, `type`, `qty`, `datetime`) VALUES
(14, 'admin', 1, 2, 2, '2024-01-18 00:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `rowid` bigint(20) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `star` int(11) DEFAULT 0,
  `datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `rowid` bigint(20) NOT NULL,
  `userid` varchar(255) DEFAULT NULL COMMENT 'refer to table user',
  `product` bigint(20) DEFAULT NULL COMMENT 'refer to table product',
  `type` bigint(20) DEFAULT NULL COMMENT 'refer to table product_type',
  `qty` int(10) DEFAULT 0,
  `price` decimal(10,2) DEFAULT 0.00,
  `discount` decimal(10,2) DEFAULT 0.00,
  `payment` varchar(255) DEFAULT NULL COMMENT 'refet to table payment',
  `status` varchar(50) DEFAULT 'new' COMMENT 'new / accepted / shipped / arrived',
  `order_on` datetime DEFAULT current_timestamp(),
  `accepted_on` datetime DEFAULT NULL,
  `accepted_by` varchar(255) DEFAULT NULL COMMENT 'refer to table user',
  `shipped_on` datetime DEFAULT NULL,
  `shipped_by` varchar(255) DEFAULT NULL COMMENT 'refer to table user',
  `arrived_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`rowid`, `userid`, `product`, `type`, `qty`, `price`, `discount`, `payment`, `status`, `order_on`, `accepted_on`, `accepted_by`, `shipped_on`, `shipped_by`, `arrived_on`) VALUES
(1, 'admin', 2, 1, 1, 0.00, 0.00, '0', 'new', '2024-01-19 23:05:17', NULL, NULL, NULL, NULL, NULL),
(2, 'admin', 2, 1, 1, 0.00, 0.00, 'admin20240119230631', 'new', '2024-01-19 23:06:31', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `rowid` bigint(20) NOT NULL,
  `refno` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `userid` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`rowid`, `refno`, `amount`, `userid`, `datetime`) VALUES
(1, 'admin20240119230517', 60.90, 'admin', '2024-01-19 23:05:17'),
(2, 'admin20240119230631', 60.90, 'admin', '2024-01-19 23:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `rowid` bigint(20) NOT NULL,
  `category` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `about` longtext DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT 0.00,
  `last_update` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(255) DEFAULT NULL COMMENT 'refer to table user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`rowid`, `category`, `title`, `about`, `price`, `discount`, `last_update`, `updated_by`) VALUES
(1, 'Ctg1', 'tudung lawa', 'Tudung paling cantik<div>sesuai untuk perempuan cantik</div><div><br></div><div>KYL dilarang pakai</div>', 89.00, 10.00, '2024-01-14 16:46:33', 'admin'),
(2, 'Ctg1', 'test lagi', '', 56.00, 0.00, '2024-01-14 15:41:26', 'admin'),
(3, 'Ctg1', 'test lagi', '', 50.00, 15.00, '2024-01-18 00:29:19', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category`) VALUES
('Ctg1'),
('Ctg2');

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `rowid` bigint(20) NOT NULL,
  `product_rowid` bigint(20) NOT NULL COMMENT 'refer to table product',
  `filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`rowid`, `product_rowid`, `filename`) VALUES
(14, 1, 'admin_20240114153929.jpg'),
(16, 3, 'admin_20240114153948.jpg'),
(17, 1, 'admin_20240114163358.jpg'),
(18, 1, 'admin_20240114164544.jpg'),
(19, 1, 'admin_20240114164548.jpg'),
(20, 1, 'admin_20240114164558.jpg'),
(21, 1, 'admin_20240114164606.jpg'),
(22, 2, 'admin_20240114214448.jpg'),
(23, 2, 'admin_20240114214507.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `rowid` bigint(20) NOT NULL,
  `product_rowid` bigint(20) NOT NULL COMMENT 'refer to table product',
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`rowid`, `product_rowid`, `type`) VALUES
(1, 2, 'fasdf'),
(2, 1, 'biasa'),
(6, 1, 'premium'),
(7, 3, 'biasa');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `address3` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postcode` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `password`, `otp`, `type`, `full_name`, `phone`, `email`, `address1`, `address2`, `address3`, `city`, `state`, `postcode`) VALUES
('admin', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', '628ae429da73a4f993063521c1693e2a8f19df9b', 'owner', 'owner', '0189420292', 'owner@gmail.com', 'address2', 'address2', 'address3', 'jitra', 'kedah', '06000'),
('customer', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', '7ff5746ebf0747cd488aefc585c019912bb73cab', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('test', '7c222fb2927d828af22f592134e8932480637c0d', 'd91d1062758946e506023c91c22842dfe9248111', 'customer', 'username', '', '', '', NULL, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `userid` varchar(255) NOT NULL COMMENT 'refer to table user',
  `datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`userid`, `datetime`) VALUES
('admin', '2024-01-08 23:51:57'),
('admin', '2024-01-09 22:18:43'),
('staff', '2024-01-09 22:54:51'),
('admin', '2024-01-09 22:59:03'),
('admin', '2024-01-10 22:04:54'),
('admin', '2024-01-11 21:17:01'),
('admin', '2024-01-14 03:07:39'),
('admin', '2024-01-14 03:08:04'),
('admin', '2024-01-14 03:15:51'),
('test', '2024-01-14 03:54:25'),
('admin', '2024-01-14 03:55:01'),
('admin', '2024-01-14 13:34:25'),
('admin', '2024-01-14 17:04:28'),
('admin', '2024-01-14 17:07:17'),
('test', '2024-01-14 17:07:28'),
('admin', '2024-01-14 17:09:22'),
('admin', '2024-01-14 17:17:06'),
('admin', '2024-01-14 17:17:21'),
('admin', '2024-01-15 22:10:09'),
('admin', '2024-01-16 18:38:12'),
('admin', '2024-01-18 00:00:15'),
('admin', '2024-01-18 00:00:32'),
('admin', '2024-01-18 00:42:49'),
('admin', '2024-01-18 23:38:19'),
('admin', '2024-01-19 12:03:12'),
('admin', '2024-01-19 22:06:25'),
('admin', '2024-01-19 22:23:00'),
('admin', '2024-01-19 22:53:08'),
('admin', '2024-01-19 23:22:27'),
('customer', '2024-01-19 23:22:51'),
('admin', '2024-01-19 23:23:53'),
('admin', '2024-01-20 11:18:45'),
('admin', '2024-01-23 21:45:29'),
('admin', '2024-01-29 12:44:23'),
('admin', '2024-01-29 22:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`type`) VALUES
('customer'),
('owner'),
('staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`rowid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`rowid`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`rowid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`rowid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`rowid`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`rowid`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`rowid`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `rowid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `rowid` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `rowid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `rowid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `rowid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `rowid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `rowid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
