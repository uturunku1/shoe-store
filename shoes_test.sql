-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 06, 2017 at 06:07 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoes_test`
--
CREATE DATABASE IF NOT EXISTS `shoes_test` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `shoes_test`;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stores_brands`
--

DROP TABLE IF EXISTS `stores_brands`;
CREATE TABLE `stores_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores_brands`
--

INSERT INTO `stores_brands` (`id`, `store_id`, `brand_id`) VALUES
(1, 108, 3),
(2, 108, 3),
(3, 117, 5),
(4, 117, 5),
(5, 126, 7),
(6, 126, 7),
(7, 180, 14),
(8, 189, 15),
(9, 198, 16),
(10, 207, 17),
(11, 256, 19),
(12, 265, 20),
(13, 274, 21),
(14, 292, 24),
(15, 292, 25),
(16, 301, 29),
(17, 301, 30),
(18, 310, 36),
(19, 310, 37),
(20, 319, 44),
(21, 319, 45),
(22, 328, 54),
(23, 328, 55),
(24, 337, 64),
(25, 337, 65),
(26, 346, 92),
(27, 346, 93),
(28, 355, 102),
(29, 355, 103),
(30, 364, 112),
(31, 364, 113),
(32, 373, 122),
(33, 373, 123),
(34, 384, 133),
(35, 384, 134),
(36, 395, 144),
(37, 395, 145),
(38, 406, 155),
(39, 406, 156),
(40, 407, 165),
(41, 408, 165),
(42, 417, 166),
(43, 417, 167),
(44, 418, 176),
(45, 419, 176),
(46, 428, 177),
(47, 428, 178),
(48, 429, 187),
(49, 430, 187),
(50, 439, 188),
(51, 439, 189),
(52, 440, 198),
(53, 441, 198),
(54, 450, 199),
(55, 450, 200),
(56, 451, 209),
(57, 452, 209),
(58, 461, 210),
(59, 461, 211),
(60, 462, 220),
(61, 463, 220),
(62, 472, 221),
(63, 472, 222),
(64, 473, 231),
(65, 474, 231),
(66, 483, 232),
(67, 483, 233),
(68, 484, 242),
(69, 485, 242),
(70, 494, 243),
(71, 494, 244);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `stores_brands`
--
ALTER TABLE `stores_brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;
--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=495;
--
-- AUTO_INCREMENT for table `stores_brands`
--
ALTER TABLE `stores_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
