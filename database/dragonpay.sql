-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2024 at 07:19 AM
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
-- Database: `dragonpay`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `txnid` varchar(200) NOT NULL,
  `refno` varchar(200) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'P',
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_id` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_id`, `name`, `brand`, `price`, `date_created`) VALUES
(1, 'be2f8379-f3c2-11ee-ae5b-3b6a66c09091', 'Nike Free Metcom 5', 'Nike', 1680.00, '2024-04-06 05:05:46'),
(2, 'be2fa461-f3c2-11ee-ae5b-3b6a66c09091', 'Nike Air Max 270', 'Nike', 1320.00, '2024-04-06 05:05:46'),
(4, 'daa564ed-f3c2-11ee-ae5b-3b6a66c09091', 'Luca One', 'Nike', 2500.00, '2024-04-06 05:07:30'),
(5, 'fd51b425-f3c2-11ee-ae5b-3b6a66c09091', 'Tatum One', 'Nike', 2850.00, '2024-04-06 05:07:57'),
(6, '357382ef-f3c3-11ee-ae5b-3b6a66c09091', 'Women Oakman', 'Nike', 1450.00, '2024-04-06 05:08:51'),
(7, '3573966b-f3c3-11ee-ae5b-3b6a66c09091', 'Nike Waffle', 'Nike', 1330.00, '2024-04-06 05:08:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
