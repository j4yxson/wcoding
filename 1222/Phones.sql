-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 22, 2023 at 03:38 AM
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
  `owner` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `Phones`
--

INSERT INTO `Phones` (`id`, `model`, `brand`, `owner`, `price`, `weight`, `comment`, `owner_id`) VALUES
(1, 'iphoneX', 'Apple', 'Terry', 100, 174, 'No scratches brand new state', 0),
(2, 'G10', 'Huawei ', 'Brad', 150, 164, 'old phone from my mom good deal', 0),
(3, '9 PureView', 'Nokia  ', 'Stacy', 50, 172, 'loved that phone', 0),
(4, 'P99', 'Panasonic', 'Brad', 75, 145, 'good deal low price', 0),
(5, 'A7 XL', 'alcatel ', 'Stacy', 20, 175, 'the screen resoltion is nice not too heavy', 0),
(6, 'K8 Plus', 'Lenovo ', 'Richard', 80, 165, 'good a new phone don\'t need that one', 0),
(7, 'Xperia XZ1', 'Sony', 'Brad', 60, 155, 'Always been a fan on this phone very convenient', 0),
(8, 'Galaxy A8+ (2018)', 'Samsung', 'Alex', 90, 191, 'heavy but good phone', 0),
(9, 'Z3', 'Sharp', 'Alex', 120, 185, 'sharp like a knife haha', 0),
(10, 'Q8 (2017)', 'LG', 'Stacy', 30, 146, 'good opportunity', 0),
(11, 'Mi A1 (Mi 5X)', 'Xiaomi', 'Stacy', 50, 146, 'basic xiaomi light', 0),
(12, 'nubia M2 lite', 'ZTE', 'Brad', 30, 164, 'lighter than air :)', 0),
(13, 'Sense 50x', 'Archos', 'Richard', 70, 223, 'my wife\'s phone she doesn\'t need it anymore ', 0),
(14, 'Pixel 2', 'Google', 'Roland', 80, 143, 'perfect for teens', 0),
(15, 'Moto E4 Plus', 'Motorola', 'Roland', 90, 198, 'never got it wrong with motorola', 0),
(16, 'Aurora', 'BlackBerry', 'Stacy', 200, 178, 'vintage', 0),
(17, 'Pixel XL', 'Google', 'Frank', 100, 168, 'the best google phone', 0),
(18, 'Galaxy S8', 'Samsung', 'Frank', 120, 155, 'Light and practical ', 0),
(19, 'Y5II', 'Huawei', 'Brad', 150, 184, 'good phone', 0),
(20, 'Xperia X Performance', 'Sony', 'Brad', 100, 164, 'good performance', 0),
(21, '230 Dual SIM', 'Nokia', 'Frank', 60, 91, 'light dual SIM good for PRO', 0),
(22, '222 Dual SIM', 'Nokia', 'Frank', 60, 91, 'light dual SIM good for PRO', 0),
(23, 'Desire 520', 'HTC', 'Richard', 30, 100, 'heh good', 0),
(24, 'iPhone 6s Plus', 'Apple', 'Stacy', 100, 192, 'basic but still really good for a first phone', 0),
(25, 'One M9+', 'HTC', 'Victoria', 115, 168, 'basic', 0),
(26, 'Desire P', 'HTC', 'Victoria', 115, 136, 'basic', 0),
(27, 'Desire 700 dual sim', 'HTC', 'Victoria', 115, 149, 'basic DUAL', 0),
(28, '108 Dual SIM', 'Nokia', 'Victoria', 35, 70, 'basic DUAL', 0),
(29, 'Butterfly', 'HTC', 'Victoria', 95, 140, 'like the name', 0),
(30, 'Desire SV', 'HTC', 'Victoria', 45, 131, 'like the name', 0),
(31, 'Galaxy A02', 'Samsung', 'Stacy', 45, 206, 'good samsung phone', 0),
(32, '1.4', 'Nokia', 'Vincent', 200, 178, 'my favorite Nokia', 0),
(33, 'Mate X2', 'Huawei', 'Vincent', 150, 295, 'find your mate mate', 0),
(34, 'Desire 21 Pro 5G', 'HTC', 'Vincent', 350, 295, 'finally 5g', 0),
(35, 'Galaxy S21+ 5G', 'Samsung', 'Alex', 350, 169, 'the best', 0),
(36, '5.4', 'Nokia', 'Alex', 350, 181, 'very good for a nokia', 0),
(37, 'Wildfire E', 'HTC', 'Alex', 150, 160, 'wild one', 0),
(38, 'Moto G Stylus (2021)', 'Motorola', 'Alex', 160, 213, 'stylus system', 0),
(39, 'iPhone 12 mini', 'Apple', 'Stacy', 660, 135, 'tiny but awesome', 0),
(40, 'Galaxy S20 FE', 'Samsung', 'Nina', 360, 190, 'sell my old phone', 0),
(41, 'K31', 'LG', 'Nina', 160, 146, 'dad\'s old phone', 0),
(42, 'Xperia 5 II', 'Sony', 'Nina', 180, 163, 'mom\'s old phone', 0),
(43, 'Velvet 5G UW', 'LG', 'Nina', 210, 193, 'sis old phone', 0),
(44, 'Galaxy Note20 Ultra', 'Samsung', 'Nina', 310, 208, 'bro old phone', 0),
(45, 'Galaxy Note20', 'Samsung', 'Alex', 300, 192, 'good phone sad to sell it', 0),
(46, 's8', 'Samsung', 'Alexis', 80, 173, 'Good for watching videos And listening to music', 0),
(48, 'iPhone 12', 'Apple', 'Alex', 690, 164, 'my company provided a phone i don’t need this one anymore, brand new', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
