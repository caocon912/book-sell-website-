-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2020 at 11:57 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webbanhang`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ID` int(11) NOT NULL,
  `ID_USER` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TIMEOUT` int(11) DEFAULT NULL,
  `TIME_CREATE` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`ID`, `ID_USER`, `TIMEOUT`, `TIME_CREATE`) VALUES
(1, 'user06', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `ID` int(11) NOT NULL,
  `ID_CART` int(11) NOT NULL,
  `ID_PRODUCT` int(11) NOT NULL,
  `QUANLITY` int(11) NOT NULL,
  `STYLE` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `COMMENT` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FIELD_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`ID`, `ID_CART`, `ID_PRODUCT`, `QUANLITY`, `STYLE`, `COMMENT`, `FIELD_1`) VALUES
(1, 1, 1, 5, 'M', NULL, NULL),
(6, 1, 5, 2, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `DESCRIPTION` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `STATUS` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `NAME`, `DESCRIPTION`, `STATUS`) VALUES
(1, 'Pants', 'quan ong dai', 1),
(2, 'Shirts', 'Ao So Mi', 1),
(3, 'Skirts', 'Vay', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID` int(11) NOT NULL,
  `ID_CART` int(11) DEFAULT NULL,
  `NAME` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PHONE` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ADDRESS` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `REGISTED` int(11) DEFAULT NULL,
  `ADDRESS_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FIELD_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `OLD_PRICE` double NOT NULL,
  `DESCRIPTION` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AMOUNT` int(11) NOT NULL,
  `NEW_PRICE` double NOT NULL,
  `CATEGORY_ID` int(11) NOT NULL,
  `IMAGE` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `STATUS` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `NAME`, `OLD_PRICE`, `DESCRIPTION`, `AMOUNT`, `NEW_PRICE`, `CATEGORY_ID`, `IMAGE`, `STATUS`) VALUES
(1, 'White T-shirt ', 120000, 'For men', 12, 150000, 1, NULL, 1),
(2, 'áo dài tay', 80000, 'for women', 30, 120000, 2, NULL, 1),
(4, 'quần bò China', 450000, 'quan bo tu china', 24, 780000, 1, 'Screenshot (58).png', 1),
(5, 'áo lụa', 67000, 'áo lụa làm từ lụa', 12, 78000, 2, 'Screenshot (62).png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `ID` int(11) NOT NULL,
  `ID_PRODUCT` int(11) NOT NULL,
  `DISCOUNT` int(11) NOT NULL,
  `DATE_START` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `DATE_END` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `COMMENT` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FIELD_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `PASSWORD` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `STATUS` int(11) NOT NULL,
  `COUNT_LOGIN` int(11) DEFAULT NULL,
  `LEVEL` int(11) NOT NULL DEFAULT 2,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `USERNAME`, `PASSWORD`, `EMAIL`, `STATUS`, `COUNT_LOGIN`, `LEVEL`, `remember_token`) VALUES
(1, 'nhitty', 'Abcd@1234', 'nhitty099@gmail.com', 1, 1, 1, NULL),
(2, 'user01', 'Abcd@1234', 'yennhicntt099@gmail.com', 1, 1, 2, NULL),
(3, 'user02', 'Abcd@1234', 'nhitty099@gmail.com', 1, 1, 2, NULL),
(4, 'user03', '$2y$10$4jjCAM7EgXjxlS2RniVB..4VAbB7gLp8.JsdvYDPTeZ.SG6Mu3v2O', 'nhitty099@gmail.com', 1, 1, 2, NULL),
(5, 'caocon912', '$2y$10$BRrkxwBaVC9R34BxL0RSCepSVbcvl5XyCDMdttX3zB.LPvVzTm/GC', 'nhitty099@gmail.com', 1, 1, 2, NULL),
(6, 'user04', '0b3bc9ce555f07d127c6da44337e364f', 'nhitty099@gmail.com', 1, 1, 2, NULL),
(7, 'user06', '$2y$10$KZlXwwh4BcJzrq2NAHvfterxmJKC/4.nm1IjWXOu/ifyl8uJAaq/G', 'nhitty099@gmail.com', 1, 1, 2, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CATEGORY_ID` (`CATEGORY_ID`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_CATEGORY_ID` FOREIGN KEY (`CATEGORY_ID`) REFERENCES `category` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
