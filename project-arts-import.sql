-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2023 at 12:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Cart Id` int(11) NOT NULL,
  `Customer Id` int(11) NOT NULL,
  `Products` longtext NOT NULL,
  `Product Quantity` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Cart Id`, `Customer Id`, `Products`, `Product Quantity`) VALUES
(4, 18, '0', ''),
(5, 8, '{\"products\":[{\"userQuantity\":null,\"price\":\"4247\",\"name\":\"Manager\",\"SKU\":\"MA-260442\",\"category\":\"Wallets\",\"stock\":\"12\",\"images\":\"IMG-653412cb8f5069.31050753.png\",\"keywords\":\"12\",\"description\":\"12\",\"warranty\":\"W-897328\",\"brand\":\"Chanel\",\"errorStatements\":[]},{\"userQuantity\":null,\"price\":\"4247\",\"name\":\"Manager\",\"SKU\":\"MA-260442\",\"category\":\"Wallets\",\"stock\":\"12\",\"images\":\"IMG-653412cb8f5069.31050753.png\",\"keywords\":\"12\",\"description\":\"12\",\"warranty\":\"W-897328\",\"brand\":\"Chanel\",\"errorStatements\":[]},{\"userQuantity\":null,\"price\":\"23\",\"name\":\"Sweater\",\"SKU\":\"SW-299775\",\"category\":\"Wallets\",\"stock\":\"24\",\"images\":\"IMG-65341453490669.47098053.png\",\"keywords\":\"dah a hdlaw hdladhdl h\",\"description\":\"This is the best Product\",\"warranty\":\"W-389733\",\"brand\":\"Victoria\",\"errorStatements\":[]},{\"userQuantity\":null,\"price\":\"23\",\"name\":\"Sweater\",\"SKU\":\"SW-299775\",\"category\":\"Wallets\",\"stock\":\"24\",\"images\":\"IMG-65341453490669.47098053.png\",\"keywords\":\"dah a hdlaw hdladhdl h\",\"description\":\"This is the best Product\",\"warranty\":\"W-389733\",\"brand\":\"Victoria\",\"errorStatements\":[]},{\"userQuantity\":null,\"price\":\"23\",\"name\":\"Sweater\",\"SKU\":\"SW-299775\",\"category\":\"Wallets\",\"stock\":\"24\",\"images\":\"IMG-65341453490669.47098053.png\",\"keywords\":\"dah a hdlaw hdladhdl h\",\"description\":\"This is the best Product\",\"warranty\":\"W-389733\",\"brand\":\"Victoria\",\"errorStatements\":[]}]}', ''),
(6, 5, '', ''),
(7, 19, 'SW-299775,BE-394912', ' 1,3'),
(8, 20, 'SW-299775', '1'),
(9, 21, 'MA-260442', '1');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer Id` int(11) NOT NULL,
  `Customer Name` varchar(255) NOT NULL,
  `Customer Email` varchar(255) NOT NULL,
  `Customer Password` varchar(255) NOT NULL,
  `Customer Phone` int(255) NOT NULL,
  `Customer Address` varchar(255) NOT NULL,
  `Customer City` varchar(255) NOT NULL,
  `Customer Zipcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer Id`, `Customer Name`, `Customer Email`, `Customer Password`, `Customer Phone`, `Customer Address`, `Customer City`, `Customer Zipcode`) VALUES
(5, 'Abdul Raffay Sheikh', '0.abdulraffay@gmail.com', '123', 2147483647, '', '', ''),
(8, 'test123', 'test123@gmail.com', '123', 123, '', '', ''),
(13, 'New User ', 'newuser@gmail.com', '123', 123, '', '', ''),
(14, 'Beverly Hills', 'bhills_3204@mailinator.com', 'Wlumv', 0, '', '', ''),
(15, 'Beverly Hills', 'bhills_9580@mailinator.com', 'Obpkp', 0, '', '', ''),
(16, 'Beverly Hills', 'bhills_5021@mailinator.com', 'Nqmjp', 0, '', '', ''),
(17, 'Beverly Hills', 'bhills_5915@mailinator.com', 'Nmodz', 0, '', '', ''),
(18, 'Beverly Hills', 'bhills_6731@mailinator.com', 'Zfomu', 0, '', '', ''),
(19, 'new', 'new1234@gmail.com', '123', 123, 'House No. 8/282 Nagori Milk Shop Building 3rd floor Near MA High School, Liaquatabad.', 'OUTER HEBRIDES', 'OUTER HEBRIDES'),
(20, 'azeem', 'azeem@gmail.com', '123', 123, '', '', ''),
(21, 'User1', 'user1@gmail.com', '123', 1234567890, '0522 Beverly Dr', 'Williamstown', '1234');

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
(44, 'Sweater', 24, 'Wallets', 'SW-299775', 'IMG-65341453490669.47098053.png', 'dah a hdlaw hdladhdl h', 'W-389733', '23', 'This is the best Product', 'Victoria'),
(45, 'New Product', 44, 'Bags', 'NE-181059', 'IMG-653b5e73cc52b6.09116770.png', 'Wallet and Best Wallet', 'W-628687', '23', 'This has been the most selling product of all times.', 'brand'),
(46, 'Best Product Ever', 123, 'Wallets', 'BE-394912', 'IMG-653f7ef04a0816.40438093.png', '123', 'W-295694', '123', '1231', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Cart Id`),
  ADD KEY `Customer Id` (`Customer Id`);

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Cart Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Product Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `Customer Id` FOREIGN KEY (`Customer Id`) REFERENCES `customer` (`Customer Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
