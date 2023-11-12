-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 11:56 PM
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
(1, 'Best Admin', 'sadmin', '123', '1234567890', '1'),
(9, 'Babar ', 'babar@gmail.com', '1234', '1234567812', '2');

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
(17, 29, '', ''),
(18, 30, '', '');

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
(29, 'new', 'new@gmail.com', '123', 2147483647, '', '', ''),
(30, 'Beverly Hills', 'bhills_3122@mailinator.com', 'Oyzyo', 3122, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `feedback_message` text NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `feedback_date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `customer_name`, `feedback_message`, `product_id`, `feedback_date_time`) VALUES
(6, '123', 'This is the best product i have seen. Period\n', 'IS-511272', '2023-11-12 19:44:24'),
(7, '123', 'This is my second review on this product. and i think it is the best\n', 'IS-511272', '2023-11-12 19:52:58'),
(8, '123', 'Best product in the world\n', 'BA-308884', '2023-11-12 19:55:23'),
(9, '123', 'What is the best product in the world ? Ofcourse the product I uploaded...\n', 'BA-308884', '2023-11-12 20:01:37');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `message` text NOT NULL,
  `message_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `phone_number`, `message`, `message_time`) VALUES
(1, 'Abdul Raffay Sheikh', '0.abdulraffay@gmail.com', '03201291613', 'My messag eis this', '2023-11-12 18:40:04'),
(2, 'Beverly Hills', 'bhills_2766@mailinator.com', '3105552766', 'Fhbwip lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2023-11-12 18:44:01'),
(3, 'Abdul Raffay Sheikh', '0.abdulraffay@gmail.com', '03201291613', '123', '2023-11-12 20:08:55');

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
(39, '971952403776', '24', 'Cash on Delivery', '63.5', '11-11-23', 'BA-308884, G-805307,IS-511272', '1, 1, 1', 'delivered', 'this is my address', 'karachi', '120371023', '', '2023-11-16', '2023-11-12', '', '2023-11-11 21:27:36'),
(46, 'C_03272046901910', '24', 'Cash on Delivery', '19.5', '12-11-23', 'BA-308884', '1', 'cancelled', 'this is my address', 'karachi', '120371023', '', '', '', 'admin', '2023-11-12 09:57:56'),
(47, 'E_25227223278559', '24', 'Ejuhp', '22', '12-11-23', ' G-805307', '1', 'delivered', '4413 Beverly Dr', 'bhills_4413@mailinator.com', '4413123123123', '', '2023-11-16', '2023-11-12', '', '2023-11-12 12:19:32'),
(48, 'C_15012880437151', '24', 'Card Payment', '19.5', '12-11-23', 'BA-308884', '1', 'delivered', 'this is my address', 'karachi', '120371023', '', '2023-11-16', '2023-11-12', '', '2023-11-12 20:03:06');

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
(47, 'Istanbul Wallet', 21, 'Wallets', 'IS-511272', 'IMG-654be451cca2b3.89862110.jpg', 'wallets,wallet,instanbul', 'W-392480', '1050', '                                                                                                                                                                                                                                                               ', 'jafferees', '2023-11-11 18:12:35'),
(48, ' Greeting Card in a Mini Envelope', 22, 'Greeting Cards', ' G-805307', 'IMG-654be906a9fb26.35473431.jpg', 'card,cards', 'W-873703', '22', 'Package Dimensions ‏ : ‎ 5 x 3.11 x 0.28 inches; 0.32 Ounces\r\nItem model number ‏ : ‎ VariableDenomination', 'Amazon', '2023-11-11 18:12:35'),
(49, 'Barbie Dreamtopia Doll with Removable Unicorn Headband & Tail, Blue & Purple Fantasy Hair & Cloudy Star-Print Skirt, Unicorn Toys', 24, 'Dolls', 'BA-246336', 'IMG-654bec942975c8.46179078.jpg', 'barbie, best barbie, new barbie, barbie pink, pink, pink barbie,barbie,dreamtopia,doll,with,removable,unicorn,headband,&,tail,,blue,&,purple,fantasy,hair,&,cloudy,star-print,skirt,,unicorn,toy,dolls,barbie', 'W-953113', '29', '                                                                                                            Unicorn dolls from Barbie Dreamtopia bring fairytale dreams to life with fantastical looks and a magical transformation!\nThis Barbie doll wears a s', 'Barbie', '2023-11-11 18:12:35'),
(51, 'Black Leather wallets for men/women unisex - best wallet for women and men', 1, '', 'BL-860324', 'IMG-654c8b30e5a399.08493357.png', 'wallet for man, women, man, men, woman, wallets, wallet,black,leather,wallets,for,men/women,unisex,-,best,wallet,for,women,and,men,wallets,stride', 'W-934079', '9', '                                    Classic retro design wallet features a stylized dual color stripe in the middle, ample storage space and sophisticated stitch work. Crafted and sewn using luxurious Imitated leather and designed with thoughtful space an', 'STRIDE', '2023-11-11 18:12:35'),
(52, 'Basics 1/3-Cut Tab, Assorted Positions File Folders, Letter Size, Manila - Pack of 100', 22, 'Files', 'BA-308884', 'IMG-654fc6ab1d8565.05831252.jpg', 'filers, registers, sorting, managing, management, best files,basics,1/3-cut,tab,,assorted,positions,file,folders,,letter,size,,manila,-,pack,of,100,files,basics', 'W-618774', '19.5', '100 manila letter-size file folders; ideal for 8-1/2 x 11-inch documents\r\n1/3 cut reinforced tabs in assorted positions (left, middle, right) for easy labeling and readability\r\n11-point stock expands up to 3/4 inch while remaining sturdy\r\nMade of 10% recy', 'Basics', '2023-11-11 18:23:39'),
(54, 'Sooez 10 Pack Plastic Envelopes Poly Envelopes, Clear Document Folders File Folders US Letter A4 Size File Envelopes with Label Pocket, Assorted Color', 12, 'Files', 'FI-577773', 'IMG-6551372c6c0ad2.96385670.jpg', 'files', 'W-475976', '650', '                                                                        Sooez 10 Pack Plastic Envelopes Poly Envelopes, Clear Document Folders File Folders US Letter A4 Size File Envelopes with Label Pocket, Assorted Color\"\n                               ', 'Soeez', '2023-11-12 20:35:56'),
(56, 'Amazon Basics Hanging File Folders, Letter Size, Black, 25-Pack', 12, 'Files', 'FI-474044', 'IMG-655140d6743aa5.35037618.jpg', 'files, folder, folders,amazon,basics,hanging,file,folders,,letter,size,,black,,25-pack,files,basics', '0', '783', 'Best product to buy.', 'Basics', '2023-11-12 21:17:10'),
(57, 'Montana West Tote Bags Vegan Leather Purses and Handbags for Women Top Handle Ladies Shoulder Bags', 12, 'Handbags', 'HA-951876', 'IMG-6551418318fff5.71340346.jpg', 'bags, handbag, bestbag, bag, latest bags, women, woman,montana,west,tote,bags,vegan,leather,purses,and,handbags,for,women,top,handle,ladies,shoulder,bags,handbags,montana,west,', 'W-258369', '2500', '', 'Montana West ', '2023-11-12 21:20:03'),
(58, 'Womans Leather Bag handbag tote shoulder crossbody purse', 13, '', 'HA-964114', 'IMG-655141e2db3048.34677781.jpg', 'bags, handbag, bestbag, bag, latest bags, women, woman,best,bag,handbags,dreubea,', '0', '3050', '                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia eveniet excepturi id sequi dolorem, illo enim deleniti, porro error cumque suscipit ut corporis culpa nesciunt odit vero asperiores inventore qui!\"\n    ', 'Dreubea ', '2023-11-12 21:21:38'),
(59, ' ALARION Women Top Handle Satchel Handbags Shoulder Bag Messenger Tote Bag Purse', 12, 'Handbags', 'HA-567841', 'IMG-6551426dc13b23.38645210.jpg', 'bags, handbag, bestbag, bag, latest bags, women, woman,,alarion,women,top,handle,satchel,handbags,shoulder,bag,messenger,tote,bag,purse,handbags,alarion,', '0', '4000', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia eveniet excepturi id sequi dolorem, illo enim deleniti, porro error cumque suscipit ut corporis culpa nesciunt odit vero asperiores inventore qui!', 'ALARION ', '2023-11-12 21:23:57'),
(60, 'NAZANO Under Eye Patches - 30 Pairs - 24K Gold Eye Mask- Puffy Eyes & Dark Circles Treatments', 25, 'Beauty Products', 'BE-619200', 'IMG-655142e086a0b7.28444304.jpg', 'beauty, woman, women, beauties, b, ,nazano,under,eye,patches,-,30,pairs,-,24k,gold,eye,mask-,puffy,eyes,&,dark,circles,treatments,beauty,products,nazano,', 'W-982395', '700', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia eveniet excepturi id sequi dolorem, illo enim deleniti, porro error cumque suscipit ut corporis culpa nesciunt odit vero asperiores inventore qui!', 'NAZANO ', '2023-11-12 21:25:52'),
(61, 'NYX PROFESSIONAL MAKEUP Fat Oil Lip Drip, Moisturizing, Shiny and Vegan Tinted Lip Gloss - Missed Call (Sheer Pink)', 24, 'Beauty Products', 'BE-149088', 'IMG-65514329cbe6f6.34393286.jpg', 'makeup, woman, women, beauti, beauties, lips stick, lipstick,nyx,professional,makeup,fat,oil,lip,drip,,moisturizing,,shiny,and,vegan,tinted,lip,gloss,-,missed,call,(sheer,pink),beauty,products,nyx', 'W-530779', '1200', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia eveniet excepturi id sequi dolorem, illo enim deleniti, porro error cumque suscipit ut corporis culpa nesciunt odit vero asperiores inventore qui!', 'NYX', '2023-11-12 21:27:05'),
(62, 'Indian Consigners Soft Velvet Pouch for Tarot, Altar, Rune, Gift, Crystal, jewelry Wrap Bags for Precious, Sacred and Spiritial Items (Gold)', 12, 'Gift Articles', 'GI-228414', 'IMG-655143c947b1e4.28472055.jpg', 'gift, gifts, designs, painting, ,indian,consigners,soft,velvet,pouch,for,tarot,,altar,,rune,,gift,,crystal,,jewelry,wrap,bags,for,precious,,sacred,and,spiritial,items,(gold),gift,articles,cosigners', 'W-616514', '100', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia eveniet excepturi id sequi dolorem, illo enim deleniti, porro error cumque suscipit ut corporis culpa nesciunt odit vero asperiores inventore qui!', 'Cosigners', '2023-11-12 21:29:45'),
(63, 'SUBSH Seven Chakra Natural Healing Gemstone Crystal Bonsai Fortune Money Tree for Good Luck, Wealth & Prosperity Home Office Kitchen Décor Spiritual Gift ', 12, 'Gift Articles', 'GI-159974', 'IMG-6551442f9cc9b1.77534393.jpg', 'gift, gifts, designs, painting, tree,subsh,seven,chakra,natural,healing,gemstone,crystal,bonsai,fortune,money,tree,for,good,luck,,wealth,&,prosperity,home,office,kitchen,décor,spiritual,gift,,gift,articles,subsh,', 'W-619851', '2600', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia eveniet excepturi id sequi dolorem, illo enim deleniti, porro error cumque suscipit ut corporis culpa nesciunt odit vero asperiores inventore qui!', 'SUBSH ', '2023-11-12 21:31:27'),
(64, 'Art Supplies, 241 PCS Drawing Art Kit for Kids Boys Girls, Deluxe Art and Craft Set with Double Sided Trifold Easel, Markers, Oil Pastels', 12, 'Arts', 'AR-923777', 'IMG-6551447f8aef68.68044762.jpg', 'arts, pencils, pencil, pen, stationary, stationaries,art,supplies,,241,pcs,drawing,art,kit,for,kids,boys,girls,,deluxe,art,and,craft,set,with,double,sided,trifold,easel,,markers,,oil,pastels,arts,art,supplies', '0', '12', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia eveniet excepturi id sequi dolorem, illo enim deleniti, porro error cumque suscipit ut corporis culpa nesciunt odit vero asperiores inventore qui!', 'Art Supplies', '2023-11-12 21:32:47'),
(65, '5.5\" x 8.5\" Sketchbook Set, Top Spiral Bound Sketch Pad, 2 Packs 100-Sheets Each (68lb/100gsm), Acid Free Art Sketch Book Artistic Drawing Painting Writing Paper for Beginners Artists', 12, 'Arts', 'AR-132487', 'IMG-655144c27dfe83.05349840.jpg', 'arts, books, book, sketch, eraser, ,5.5\",x,8.5\",sketchbook,set,,top,spiral,bound,sketch,pad,,2,packs,100-sheets,each,(68lb/100gsm),,acid,free,art,sketch,book,artistic,drawing,painting,writing,paper,for,beginners,artists,arts,fuxi', 'W-667715', '12', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia eveniet excepturi id sequi dolorem, illo enim deleniti, porro error cumque suscipit ut corporis culpa nesciunt odit vero asperiores inventore qui!', 'Fuxi', '2023-11-12 21:33:54'),
(66, 'Steve Maddens leather wallet extra capacity flip pocket', 25, '', 'WA-357731', 'IMG-6551453c77de88.50033211.jpg', 'Wallet and Best Wallet, leather, handmade, leather wallets,,12,wallets,steve,madden', 'W-634967', '700', '                                                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia eveniet excepturi id sequi dolorem, illo enim deleniti, porro error cumque suscipit ut corporis culpa nesciunt odit ', 'Steve Madden', '2023-11-12 21:35:56'),
(68, 'Barbie Fashionistas Doll #206 with Crimped Hair & Freckles, Rainbow Marble-Print Dress, Green Mules & Purse', 25, 'Dolls', 'DO-365294', 'IMG-655145ea641a32.71990708.jpg', 'Dolls, barbie, best barbie, lovely barbie,barbie,fashionistas,doll,#206,with,crimped,hair,&,freckles,,rainbow,marble-print,dress,,green,mules,&,purse,dolls,barbie', '0', '700', 'orem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia eveniet excepturi id sequi dolorem, illo enim deleniti, porro error cumque suscipit ut corporis culpa nesciunt odit vero asperiores inventore qui!', 'Barbie', '2023-11-12 21:38:50'),
(69, 'Gabbys Dollhouse, 8-inch Gabby Girl Doll, Kids Toys for Ages 3 and up', 12, 'Dolls', 'DO-215795', 'IMG-655146272766c3.36592933.jpg', 'Dolls, barbie, best barbie, lovely barbie,gabbys,dollhouse,,8-inch,gabby,girl,doll,,kids,toys,for,ages,3,and,up,dolls,barbie', 'W-126504', '2400', 'orem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia eveniet excepturi id sequi dolorem, illo enim deleniti, porro error cumque suscipit ut corporis culpa nesciunt odit vero asperiores inventore qui!', 'Barbie', '2023-11-12 21:39:51'),
(71, 'Hallmark Boxed Holiday Cards Greetings Snowflake 40 Holiday Cards with Envelopes', 25, 'Greeting Cards', 'GR-773455', 'IMG-65514718173b10.65987289.jpg', 'card, greeting card, greeting, thank you, thanks, thank card, thankyou cards,hallmark,boxed,holiday,cards,greetings,snowflake,40,holiday,cards,with,envelopes,greeting,cards,hallmark', '0', '250', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia eveniet excepturi id sequi dolorem, illo enim deleniti, porro error cumque suscipit ut corporis culpa nesciunt odit vero asperiores inventore qui!', 'Hallmark', '2023-11-12 21:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `return_id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `order_num` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `return_item` varchar(255) NOT NULL,
  `return_item_quantity` varchar(255) NOT NULL,
  `return_details` varchar(255) NOT NULL,
  `return_status` varchar(255) NOT NULL,
  `return_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`return_id`, `order_id`, `order_num`, `customer_id`, `return_item`, `return_item_quantity`, `return_details`, `return_status`, `return_date`) VALUES
(4, '39', '971952403776', '24', ' G-805307', ' 1', '', 'returned', '2023-11-12 11:28:11'),
(5, '48', 'C_15012880437151', '24', 'BA-308884', '1', 'Not good prodcut', 'returned', '2023-11-12 20:04:59');

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
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`return_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Cart Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `Order Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Product Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
