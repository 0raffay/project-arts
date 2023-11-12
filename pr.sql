-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 02:00 AM
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
(1, 'Super Admin', 'sadmin', 'admin', '', '1');

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
(13, 25, ' G-805307', '1'),
(14, 26, 'BA-246336', '1'),
(15, 27, '', ''),
(16, 28, '', ''),
(17, 29, '', '');

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
(25, 'test', 'test@gmail.com', '123', 1234567890, 'test address', 'Karachi', '123'),
(26, 'Rehman', 'rehmanGT125@gmail.com', 'Rehman123', 2147483647, '', '', ''),
(27, 'Abdul Raffay Sheikh', '0.abdulraffay@gmail.com', '123', 2147483647, '', '', ''),
(28, 'Donald R. Mustard', 'DonaldRMustard_1@gmail.com', '123', 123, '', '', ''),
(29, 'new', 'new@gmail.com', '123', 2147483647, '', '', '');

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
  `Order Status` varchar(255) NOT NULL,
  `Order Address` varchar(255) NOT NULL,
  `Order City` varchar(255) NOT NULL,
  `Order Phone` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `est_delivery_date` varchar(255) NOT NULL,
  `delivery_date` varchar(255) NOT NULL,
  `cancel_by` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`Order Id`, `Order Number`, `Customer Id`, `Order Type`, `Order Amount`, `Order Date`, `Order Items`, `Order Items Quantity`, `Order Status`, `Order Address`, `Order City`, `Order Phone`, `reason`, `est_delivery_date`, `delivery_date`, `cancel_by`, `order_date`) VALUES
(38, '088782582861', '24', 'Cash on Delivery', '19.5', '11-11-23', 'BA-308884', '1', 'shipped', 'this is my address', 'karachi', '120371023', '', '', '', '', '2023-11-11 19:16:01'),
(39, '971952403776', '24', 'Cash on Delivery', '63.5', '11-11-23', 'BA-308884, G-805307,IS-511272', '1, 1, 1', 'shipped', 'this is my address', 'karachi', '120371023', '', '2023-11-16', '', '', '2023-11-11 21:27:36'),
(40, '823172714717', '24', 'Cash on Delivery', '22', '12-11-23', ' G-805307', '1', 'delivered', 'this is my address', 'karachi', '120371023', '', '', '', 'admin', '2023-11-11 23:40:02'),
(41, '426925979829', '24', 'Cash on Delivery', '81', '12-11-23', 'BL-860324', '9', 'cancelled', 'this is my address', 'karachi', '120371023', '', '', '', 'Customer', '2023-11-12 00:45:15');

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
  `Product Brand` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Product Id`, `Product Name`, `Product Stock`, `Product Category`, `Product SKU`, `Images`, `Keywords`, `Warranty`, `Product Price`, `Product Description`, `Product Brand`, `upload_date`) VALUES
(47, 'Istanbul Wallet', 24, 'Wallets', 'IS-511272', 'IMG-654be451cca2b3.89862110.jpg', 'wallets,wallet,instanbul', 'W-392480', '22', 'DETAILS:\r\nJust like the city from which it draws its name, this wallet is traditional in appearance despite its sleek and modern design.\r\nFEATURES:\r\nOne Cash compartment\r\nSix credit card slots\r\nTwo pockets for receipts\r\nDIMENSIONS:\r\n110mm x 85mm', 'jafferees', '2023-11-11 18:12:35'),
(48, ' Greeting Card in a Mini Envelope', 23, 'Greeting Cards', ' G-805307', 'IMG-654be906a9fb26.35473431.jpg', 'card,cards', 'W-873703', '22', 'Package Dimensions ‏ : ‎ 5 x 3.11 x 0.28 inches; 0.32 Ounces\r\nItem model number ‏ : ‎ VariableDenomination', 'Amazon', '2023-11-11 18:12:35'),
(49, 'Barbie Dreamtopia Doll with Removable Unicorn Headband & Tail, Blue & Purple Fantasy Hair & Cloudy Star-Print Skirt, Unicorn Toy', 24, 'Dolls', 'BA-246336', 'IMG-654bec942975c8.46179078.jpg', 'barbie, best barbie, new barbie, barbie pink, pink, pink barbie,barbie,dreamtopia,doll,with,removable,unicorn,headband,&,tail,,blue,&,purple,fantasy,hair,&,cloudy,star-print,skirt,,unicorn,toy,dolls,barbie', 'W-953113', '29', 'Unicorn dolls from Barbie Dreamtopia bring fairytale dreams to life with fantastical looks and a magical transformation!\r\nThis Barbie doll wears a sparkly bodice and a removable skirt with a cloud and star print.\r\nKids can add a unicorn headband and clip-', 'Barbie', '2023-11-11 18:12:35'),
(51, 'Black Leather wallets for men/women unisex - best wallet for women and men', 0, 'Wallets', 'BL-860324', 'IMG-654c8b30e5a399.08493357.png', 'wallet for man, women, man, men, woman, wallets, wallet,black,leather,wallets,for,men/women,unisex,-,best,wallet,for,women,and,men,wallets,stride', 'W-934079', '9', 'Classic retro design wallet features a stylized dual color stripe in the middle, ample storage space and sophisticated stitch work. Crafted and sewn using luxurious Imitated leather and designed with thoughtful space and storage.\r\n\r\n•Crafted with premium ', 'STRIDE', '2023-11-11 18:12:35'),
(52, 'Basics 1/3-Cut Tab, Assorted Positions File Folders, Letter Size, Manila - Pack of 100', 23, 'Files', 'BA-308884', 'IMG-654fc6ab1d8565.05831252.jpg', 'filers, registers, sorting, managing, management, best files,basics,1/3-cut,tab,,assorted,positions,file,folders,,letter,size,,manila,-,pack,of,100,files,basics', 'W-618774', '19.5', '100 manila letter-size file folders; ideal for 8-1/2 x 11-inch documents\r\n1/3 cut reinforced tabs in assorted positions (left, middle, right) for easy labeling and readability\r\n11-point stock expands up to 3/4 inch while remaining sturdy\r\nMade of 10% recy', 'Basics', '2023-11-11 18:23:39');

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
  MODIFY `Admin Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Cart Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `Order Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Product Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

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
