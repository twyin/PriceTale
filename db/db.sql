-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 05, 2019 at 04:27 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pricetale`
--
CREATE DATABASE IF NOT EXISTS `pricetale` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pricetale`;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Brands for items';

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'Chanel'),
(2, 'Louis Vuitton'),
(3, 'Gucci'),
(4, 'Balenciaga'),
(5, 'Valentino'),
(6, 'Tesla');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Categories for items';

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Handbag'),
(2, 'Shoes'),
(3, 'Car');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_code` tinytext NOT NULL,
  `image_url` text NOT NULL,
  `name` tinytext NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Product items for price tracking';

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `brand_id`, `category_id`, `product_code`, `image_url`, `name`, `description`) VALUES
(1, 1, 1, 'A67086 Y09953 94305', 'https://www.chanel.com/images/t_fashion/q_auto,f_jpg,fl_lossy,dpr_2/w_1920/boy-chanel-handbag-black-calfskin-ruthenium-finish-metal-calfskin-ruthenium-finish-metal-packshot-default-a67086y0995394305-8806040305694.jpg', 'Boy Chanel Handbag', 'Calfskin & Ruthenium-Finish Metal\r\n15 x 25 x 9 cm'),
(2, 2, 1, 'M41465', 'https://us.louisvuitton.com/images/is/image/lv/1/PP_VP_L/louis-vuitton-pochette-metis-monogram-reverse-canvas-handbags--M41465_PM2_Front%20view.jpg?wid=1328&hei=1328', 'Pochette Metis', 'Monogram Reverse Canvas\r\n'),
(3, 1, 1, 'A69900 Y04059 94305', 'https://www.chanel.com/images//t_fashion//q_auto,f_jpg,fl_lossy,dpr_2/w_1920/mini-flap-bag-black-lambskin-gold-tone-metal-lambskin-gold-tone-metal-packshot-default-a69900y0405994305-8806027722782.jpg', 'Mini Flap Bag', 'Black\r\nLambskin & Gold-Tone Metal\r\n12 x 20 x 6 cm'),
(4, 3, 1, 'Style ‎421882 CVLEG 8605', 'https://media.gucci.com/style/DarkGray_Center_0_0_1200x1200/1528443907/421882_CVLEG_8605_011_075_0000_Light-Sylvie-small-shoulder-bag.jpg', 'Sylvie Small Shoulder Bag', 'Off-white leather\r\n10\"W x 7\"H x 3\"D\r\nIncludes two shoulder straps: detachable leather shoulder strap with 13.5\" drop, detachable Web shoulder strap with 6.5\" drop'),
(5, 4, 1, '182342F049016 (SSense)', 'https://res-2.cloudinary.com/ssenseweb/image/upload/b_white/c_scale,h_820/f_auto,dpr_2.0/182342F049016_5.jpg', 'Balenciaga White XS Everyday Tote', 'Approx. 11\" length x 11.5\" height x 4\" width.\r\nCalfskin. Made in Italy.\r\nGrained calfskin tote in white. Twin carry handles at top. Detachable and adjustable shoulder strap with pin-buckle and lobster-clasp fastenings. Logo printed in black at face. Pocket mirror and slim pouch on leather lanyards at interior. Leather lining in black. Silver-tone hardware. Tonal stitching. \r\n'),
(9, 2, 1, 'M44018', 'https://us.louisvuitton.com/images/is/image/lv/1/PP_VP_L/louis-vuitton-pochette-metis-monogram-empreinte-leather-handbags--M44018_PM2_Front%20view.jpg?wid=1080&hei=1080', 'Pochette Metis', 'Rose Poudre\r\nMonogram Empreinte Leather\r\nL 9.8 x H 7.5 x W 2.8 inches'),
(15, 5, 2, 'PW2S0393VBS 0NO', 'https://cdn.yoox.biz/45/45351373qm_14_n_r.jpg', 'Patent Rockstud Noir Pump 100mm', 'Valentino Garavani Rockstud Noir ankle strap pump in black patent leather.\r\n- Ruthenium-finish studs \r\n- Tone-on-tone nappa leather piping\r\n- Heel height: 100 mm / 4 in.\r\n- Made in Italy'),
(18, 6, 3, 'M3', 'https://www.tesla.com/content/dam/tesla-site/sx-redesign/img/model3-proto/hero/model-3@2.jpg/_jcr_content/renditions/cq5dam.tinypng.1440.auto.jpg', 'Tesla Model 3', '3.3 s from 0-60 mph\r\n310 mi range\r\nAWD Dual Motor');

-- --------------------------------------------------------

--
-- Table structure for table `price_record`
--

CREATE TABLE `price_record` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Price tracking for items';

--
-- Dumping data for table `price_record`
--

INSERT INTO `price_record` (`id`, `item_id`, `price`, `date`) VALUES
(5, 5, 123, '2019-01-03 00:00:00'),
(6, 5, 456, '2019-01-25 00:00:00'),
(7, 5, 420, '2019-01-24 00:00:00'),
(8, 5, 22, '2018-12-31 00:00:00'),
(9, 5, 55, '2019-01-03 00:00:00'),
(10, 5, 56, '2018-12-30 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_record`
--
ALTER TABLE `price_record`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `price_record`
--
ALTER TABLE `price_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
