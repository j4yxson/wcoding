-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 22, 2023 at 04:05 AM
-- Server version: 10.4.28-MariaDB-log
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `businessdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Phones`
--

CREATE TABLE `Phones` (
  `id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `owner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `Phones`
--

INSERT INTO `Phones` (`id`, `model`, `brand`, `brand_id`, `price`, `weight`, `comment`, `owner_id`) VALUES
(1, 'iphoneX', 'Apple', NULL, 100, 174, 'No scratches brand new state', 1),
(2, 'G10', 'Huawei ', NULL, 150, 164, 'old phone from my mom good deal', 2),
(3, '9 PureView', 'Nokia  ', NULL, 50, 172, 'loved that phone', 3),
(4, 'P99', 'Panasonic', NULL, 75, 145, 'good deal low price', 2),
(5, 'A7 XL', 'alcatel ', NULL, 20, 175, 'the screen resoltion is nice not too heavy', 3),
(6, 'K8 Plus', 'Lenovo ', NULL, 80, 165, 'good a new phone don\'t need that one', 4),
(7, 'Xperia XZ1', 'Sony', NULL, 60, 155, 'Always been a fan on this phone very convenient', 2),
(8, 'Galaxy A8+ (2018)', 'Samsung', NULL, 90, 191, 'heavy but good phone', 5),
(9, 'Z3', 'Sharp', NULL, 120, 185, 'sharp like a knife haha', 5),
(10, 'Q8 (2017)', 'LG', NULL, 30, 146, 'good opportunity', 3),
(11, 'Mi A1 (Mi 5X)', 'Xiaomi', NULL, 50, 146, 'basic xiaomi light', 3),
(12, 'nubia M2 lite', 'ZTE', NULL, 30, 164, 'lighter than air :)', 2),
(13, 'Sense 50x', 'Archos', NULL, 70, 223, 'my wife\'s phone she doesn\'t need it anymore ', 4),
(14, 'Pixel 2', 'Google', NULL, 80, 143, 'perfect for teens', 6),
(15, 'Moto E4 Plus', 'Motorola', NULL, 90, 198, 'never got it wrong with motorola', 6),
(16, 'Aurora', 'BlackBerry', NULL, 200, 178, 'vintage', 3),
(17, 'Pixel XL', 'Google', NULL, 100, 168, 'the best google phone', 7),
(18, 'Galaxy S8', 'Samsung', NULL, 120, 155, 'Light and practical ', 7),
(19, 'Y5II', 'Huawei', NULL, 150, 184, 'good phone', 2),
(20, 'Xperia X Performance', 'Sony', NULL, 100, 164, 'good performance', 2),
(21, '230 Dual SIM', 'Nokia', NULL, 60, 91, 'light dual SIM good for PRO', 7),
(22, '222 Dual SIM', 'Nokia', NULL, 60, 91, 'light dual SIM good for PRO', 7),
(23, 'Desire 520', 'HTC', NULL, 30, 100, 'heh good', 4),
(24, 'iPhone 6s Plus', 'Apple', NULL, 100, 192, 'basic but still really good for a first phone', 3),
(25, 'One M9+', 'HTC', NULL, 115, 168, 'basic', 8),
(26, 'Desire P', 'HTC', NULL, 115, 136, 'basic', 8),
(27, 'Desire 700 dual sim', 'HTC', NULL, 115, 149, 'basic DUAL', 8),
(28, '108 Dual SIM', 'Nokia', NULL, 35, 70, 'basic DUAL', 8),
(29, 'Butterfly', 'HTC', NULL, 95, 140, 'like the name', 8),
(30, 'Desire SV', 'HTC', NULL, 45, 131, 'like the name', 8),
(31, 'Galaxy A02', 'Samsung', NULL, 45, 206, 'good samsung phone', 3),
(32, '1.4', 'Nokia', NULL, 200, 178, 'my favorite Nokia', 9),
(33, 'Mate X2', 'Huawei', NULL, 150, 295, 'find your mate mate', 9),
(34, 'Desire 21 Pro 5G', 'HTC', NULL, 350, 295, 'finally 5g', 9),
(35, 'Galaxy S21+ 5G', 'Samsung', NULL, 350, 169, 'the best', 5),
(36, '5.4', 'Nokia', NULL, 350, 181, 'very good for a nokia', 5),
(37, 'Wildfire E', 'HTC', NULL, 150, 160, 'wild one', 5),
(38, 'Moto G Stylus (2021)', 'Motorola', NULL, 160, 213, 'stylus system', 5),
(39, 'iPhone 12 mini', 'Apple', NULL, 660, 135, 'tiny but awesome', 3),
(40, 'Galaxy S20 FE', 'Samsung', NULL, 360, 190, 'sell my old phone', 10),
(41, 'K31', 'LG', NULL, 160, 146, 'dad\'s old phone', 10),
(42, 'Xperia 5 II', 'Sony', NULL, 180, 163, 'mom\'s old phone', 10),
(43, 'Velvet 5G UW', 'LG', NULL, 210, 193, 'sis old phone', 10),
(44, 'Galaxy Note20 Ultra', 'Samsung', NULL, 310, 208, 'bro old phone', 10),
(45, 'Galaxy Note20', 'Samsung', NULL, 300, 192, 'good phone sad to sell it', 5),
(46, 's8', 'Samsung', NULL, 80, 173, 'Good for watching videos And listening to music', 0),
(48, 'iPhone 12', 'Apple', NULL, 690, 164, 'my company provided a phone i don’t need this one anymore, brand new', 5),
(49, 'iPhone 16', 'Apple', NULL, 1505, 200, 'exclusivity first on the market', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Phones`
--
ALTER TABLE `Phones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Phones`
--
ALTER TABLE `Phones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
