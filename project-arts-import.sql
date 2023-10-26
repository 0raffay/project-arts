-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2023 at 12:01 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-arts-import`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer Id` int(11) NOT NULL,
  `Customer Name` varchar(255) NOT NULL,
  `Customer Email` varchar(255) NOT NULL,
  `Customer Password` varchar(255) NOT NULL,
  `Customer Address` varchar(255) NOT NULL,
  `Customer Phone` int(255) NOT NULL,
  `Customer Cart` varchar(255) NOT NULL,
  `Customer Wishlist` varchar(255) NOT NULL,
  `Login Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer Id`, `Customer Name`, `Customer Email`, `Customer Password`, `Customer Address`, `Customer Phone`, `Customer Cart`, `Customer Wishlist`, `Login Status`) VALUES
(1, 'Beverly Hills', 'bhills_9086@mailinator.com', 'Asxbm', '9086 Beverly Dr', 9086, '', '', 0),
(2, 'Beverly Hills', 'bhills_4736@mailinator.com', 'Tqahe', '4736 Beverly Dr', 0, '', '', 0),
(3, 'Beverly Hills', 'bhills_0792@mailinator.com', 'Lehbh', '0792 Beverly Dr', 0, '', '', 0),
(4, 'Beverly Hills', 'bhills_2878@mailinator.com', 'Vsitd', '2878 Beverly Dr', 0, '', '', 0),
(5, 'Abdul Raffay Sheikh', '0.abdulraffay@gmail.com', '123', 'Liaquatabad, Karachi No. 4', 2147483647, '', '', 0),
(6, 'Beverly Hills', 'bhills_8901@mailinator.com', 'Zjooi', '8901 Beverly Dr', 0, '', '', 0),
(7, 'new', 'new@gmail.com', '123', 'new', 123, '', '', 0),
(8, 'test123', 'test123@gmail.com', '123', 'test123', 123, '', '', 0),
(9, 'Beverly Hills', 'new123@gmial.com', '123', '2141 Beverly Dr', 123, '', '', 0),
(10, 'Beverly Hills', 'new123@gmial.com', '123', '2141 Beverly Dr', 123, '', '', 0),
(11, 'Beverly Hills', 'new123@gmial.com', '123', '2141 Beverly Dr', 123, '', '', 0),
(12, 'Beverly Hills', 'bhills_1536@mailinator.com', 'Tvpqa', '1536 Beverly Dr', 0, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Product Id` int(11) NOT NULL,
  `Product Name` varchar(255) NOT NULL,
  `Product Stock` int(11) NOT NULL,
  `Product Category` varchar(255) NOT NULL,
  `Product SKU` varchar(255) NOT NULL,
  `Images` text NOT NULL,
  `Keywords` varchar(255) NOT NULL,
  `Warranty` varchar(50) NOT NULL,
  `Product Price` varchar(255) NOT NULL,
  `Product Description` varchar(255) NOT NULL,
  `Product Brand` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Product Id`, `Product Name`, `Product Stock`, `Product Category`, `Product SKU`, `Images`, `Keywords`, `Warranty`, `Product Price`, `Product Description`, `Product Brand`) VALUES
(43, 'Manager', 12, 'Wallets', 'MA-260442', 'IMG-653412cb8f5069.31050753.png', '12', 'W-897328', '4247', '12', 'Chanel'),
(44, 'Sweater', 24, 'Wallets', 'SW-299775', 'IMG-65341453490669.47098053.png', 'dah a hdlaw hdladhdl h', 'W-389733', '23', 'This is the best Product', 'Victoria');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer Id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Product Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Product Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
