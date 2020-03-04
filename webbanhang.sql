-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2020 at 10:34 AM
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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `DESCRIPTION` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `NAME`, `DESCRIPTION`) VALUES
(1, 'Pants', NULL),
(2, 'Shirts', NULL);

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
  `IMAGE` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `NAME`, `OLD_PRICE`, `DESCRIPTION`, `AMOUNT`, `NEW_PRICE`, `CATEGORY_ID`, `IMAGE`) VALUES
(1, 'White T-shirt ', 120000, 'For men', 12, 150000, 1, NULL),
(2, 'áo dài tay', 80000, 'for women', 30, 120000, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `PASSWORD` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `STATUS` int(11) NOT NULL,
  `COUNT_LOGIN` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CATEGORY_ID` (`CATEGORY_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
