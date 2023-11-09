-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2023 at 10:03 PM
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
-- Database: `pr`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin Id` int(11) NOT NULL,
  `Admin Name` varchar(255) NOT NULL,
  `Admin Email` varchar(255) NOT NULL,
  `Admin Password` varchar(255) NOT NULL,
  `Admin Phone` varchar(255) NOT NULL,
  `Rights` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin Id`, `Admin Name`, `Admin Email`, `Admin Password`, `Admin Phone`, `Rights`) VALUES
(1, 'Super Admin', 'sadmin', 'admin', '', '1'),
(3, 'Abdullah Sheikh', 'abdullah@gmail.com', '123', '1234567890', '2'),
(4, 'employee', 'employee@gmail.com', '123', '123', '2');

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
(12, 24, '', ''),
(13, 25, ' G-805307', '1');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category Id` int(255) NOT NULL,
  `Category Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category Id`, `Category Name`) VALUES
(4, 'Files'),
(5, 'Handbags'),
(11, 'Beauty Products'),
(12, 'Gift Articles'),
(13, 'Arts'),
(14, 'Wallets'),
(17, 'Dolls'),
(18, 'Greeting Cards');

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
(24, '123', '1234@gmail.com', '123', 120371023, 'this is my address', 'karachi', '1237102397'),
(25, 'test', 'test@gmail.com', '123', 1234567890, 'test address', 'Karachi', '123');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `Order Id` int(255) NOT NULL,
  `Order Number` varchar(255) NOT NULL,
  `Customer Id` varchar(255) NOT NULL,
  `Order Type` varchar(255) NOT NULL,
  `Order Amount` varchar(255) NOT NULL,
  `Order Date` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `Order Items` longtext NOT NULL,
  `Order Items Quantity` longtext NOT NULL,
  `Order Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`Order Id`, `Order Number`, `Customer Id`, `Order Type`, `Order Amount`, `Order Date`, `Order Items`, `Order Items Quantity`, `Order Status`) VALUES
(17, '273399099712', '24', 'Cash on Delivery', '73', '09-11-23', 'BA-246336,IS-511272, G-805307', '1, 1, 1', 'In Process'),
(18, '698893554849', '24', 'Cash on Delivery', '44', '09-11-23', ' G-805307,IS-511272', '1, 1', 'In Process'),
(19, '724545155144', '25', 'Card Payment', '27', '09-11-23', 'BL-860324', '3', 'In Process');

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
(47, 'Istanbul Wallet', 10, 'Wallets', 'IS-511272', 'IMG-654be451cca2b3.89862110.jpg', 'wallets,wallet,instanbul', 'W-392480', '22', 'DETAILS:\r\nJust like the city from which it draws its name, this wallet is traditional in appearance despite its sleek and modern design.\r\nFEATURES:\r\nOne Cash compartment\r\nSix credit card slots\r\nTwo pockets for receipts\r\nDIMENSIONS:\r\n110mm x 85mm', 'jafferees'),
(48, ' Greeting Card in a Mini Envelope', 23, 'Greeting Cards', ' G-805307', 'IMG-654be906a9fb26.35473431.jpg', 'card,cards', 'W-873703', '22', 'Package Dimensions ‏ : ‎ 5 x 3.11 x 0.28 inches; 0.32 Ounces\r\nItem model number ‏ : ‎ VariableDenomination', 'Amazon'),
(49, 'Barbie Dreamtopia Doll with Removable Unicorn Headband & Tail, Blue & Purple Fantasy Hair & Cloudy Star-Print Skirt, Unicorn Toy', 12, 'Dolls', 'BA-246336', 'IMG-654bec942975c8.46179078.jpg', 'barbie, best barbie, new barbie, barbie pink, pink, pink barbie,barbie,dreamtopia,doll,with,removable,unicorn,headband,&,tail,,blue,&,purple,fantasy,hair,&,cloudy,star-print,skirt,,unicorn,toy,dolls,barbie', 'W-953113', '29', 'Unicorn dolls from Barbie Dreamtopia bring fairytale dreams to life with fantastical looks and a magical transformation!\r\nThis Barbie doll wears a sparkly bodice and a removable skirt with a cloud and star print.\r\nKids can add a unicorn headband and clip-', 'Barbie'),
(51, 'Black Leather wallets for men/women unisex - best wallet for women and men', 11, 'Wallets', 'BL-860324', 'IMG-654c8b30e5a399.08493357.png', 'wallet for man, women, man, men, woman, wallets, wallet,black,leather,wallets,for,men/women,unisex,-,best,wallet,for,women,and,men,wallets,stride', 'W-934079', '9', 'Classic retro design wallet features a stylized dual color stripe in the middle, ample storage space and sophisticated stitch work. Crafted and sewn using luxurious Imitated leather and designed with thoughtful space and storage.\r\n\r\n•Crafted with premium ', 'STRIDE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin Id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Cart Id`),
  ADD KEY `Customer Id` (`Customer Id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category Id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer Id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`Order Id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Product Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Cart Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `Order Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Product Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

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
