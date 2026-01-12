-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2025 at 05:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiketgo`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `location` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `desc` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `location`, `price`, `desc`, `created_at`, `image`) VALUES
(8, 'Culinary Festival', 'Dago', 100000, 'Festival\r\n', '2025-12-19 20:23:04', 'event_6945ce61118ad.jpeg'),
(9, 'City Marathon', 'Lapang Merdeka Sukabumi', 150000, 'Olahraga dengan berlari di daerah kota sukabumi', '2025-12-19 20:24:47', 'event_6945c2f855d7c.webp'),
(10, 'Musicfest', 'alunalun', 50000, 'Music\r\nMusik', '2025-12-19 20:26:24', 'event_6945c2e30c2b7.jpeg'),
(11, 'Karinding ', 'Gedung Juang', 75000, 'Pentas Seni alat Musik Sunda', '2025-12-19 20:27:21', 'event_6945c2abc065a.jpeg'),
(12, 'muasik', 'citymall', 5000000, 'musik', '2025-12-19 21:14:43', 'event_6945c317473d8.jpeg'),
(13, 'Seni Sunda', 'Lapang Merdeka Sukabumi', 50000, 'Musik dan seni', '2025-12-20 07:41:50', 'event_6946533e54fac.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(20) DEFAULT 'paid',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `status`, `created_at`) VALUES
(28, 3, 1500900000, 'paid', '2025-12-20 02:55:45'),
(29, 2, 5675000, 'paid', '2025-12-20 04:28:06'),
(30, 2, 10000000, 'paid', '2025-12-20 04:28:28'),
(31, 5, 900000, 'paid', '2025-12-20 14:33:40'),
(32, 5, 300000, 'paid', '2025-12-20 14:34:11'),
(33, 3, 400000, 'paid', '2025-12-27 21:25:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `event_id`, `qty`, `price`) VALUES
(37, 28, 6, 1, 600000),
(38, 28, 6, 1, 300000),
(39, 28, 7, 1, 500000000),
(40, 28, 7, 1, 1000000000),
(41, 29, 12, 1, 5000000),
(42, 29, 11, 1, 75000),
(43, 29, 10, 1, 50000),
(44, 29, 9, 1, 150000),
(45, 29, 8, 1, 100000),
(46, 29, 6, 1, 300000),
(47, 30, 12, 1, 10000000),
(48, 31, 6, 1, 600000),
(49, 31, 6, 1, 300000),
(50, 32, 9, 1, 300000),
(51, 33, 8, 2, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `gateway_tx_id` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `gateway_tx_id`, `amount`, `status`, `paid_at`) VALUES
(10, 6, 'SIM-6941C6398E47F', 700000.00, 'paid', '2025-12-17 03:51:05'),
(11, 7, 'SIM-6941C64EA53D9', 250000.00, 'paid', '2025-12-17 03:51:26'),
(12, 8, 'SIM-6944F494B5B47', 300000.00, 'paid', '2025-12-19 13:45:40'),
(13, 9, 'SIM-69455C9227947', 500000.00, 'paid', '2025-12-19 21:09:22'),
(14, 10, 'SIM-69455DD4BD26C', 250000.00, 'paid', '2025-12-19 21:14:44'),
(15, 11, 'SIM-694562B268FF1', 350000.00, 'paid', '2025-12-19 21:35:30');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `event_id`, `rating`, `review`, `created_at`) VALUES
(1, 3, 1, 5, 'haiii sayang\r\n', '2025-12-19 06:37:19'),
(2, 3, 1, 1, 'buruk', '2025-12-19 06:37:36'),
(3, 4, 1, 5, 'anjay', '2025-12-19 06:43:32'),
(4, 5, 6, 5, 'good', '2025-12-20 07:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `ticket_code` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `event_id`, `order_id`, `ticket_code`, `created_at`) VALUES
(13, 3, 6, 28, 'TKT-6945ADC17A1D2', '2025-12-19 19:55:45'),
(14, 3, 6, 28, 'TKT-6945ADC17ACCA', '2025-12-19 19:55:45'),
(15, 3, 7, 28, 'TKT-6945ADC17B932', '2025-12-19 19:55:45'),
(16, 3, 7, 28, 'TKT-6945ADC17C43A', '2025-12-19 19:55:45'),
(17, 2, 12, 29, 'TKT-6945C366546D7', '2025-12-19 21:28:06'),
(18, 2, 11, 29, 'TKT-6945C36655139', '2025-12-19 21:28:06'),
(19, 2, 10, 29, 'TKT-6945C36655A87', '2025-12-19 21:28:06'),
(20, 2, 9, 29, 'TKT-6945C36656593', '2025-12-19 21:28:06'),
(21, 2, 8, 29, 'TKT-6945C366572A7', '2025-12-19 21:28:06'),
(22, 2, 6, 29, 'TKT-6945C36657A0C', '2025-12-19 21:28:06'),
(23, 2, 12, 30, 'TKT-6945C37C162CD', '2025-12-19 21:28:28'),
(24, 5, 6, 31, 'TKT-6946515494836', '2025-12-20 07:33:40'),
(25, 5, 6, 31, 'TKT-694651549586D', '2025-12-20 07:33:40'),
(26, 5, 9, 32, 'TKT-694651733D38D', '2025-12-20 07:34:11'),
(27, 3, 8, 33, 'TKT-694FEC4FB247D', '2025-12-27 14:25:19'),
(28, 3, 8, 33, 'TKT-694FEC4FB530E', '2025-12-27 14:25:19');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_types`
--

CREATE TABLE `ticket_types` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `price_multiplier` decimal(4,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `role`) VALUES
(1, 'Admin TiketGo', 'admin@tiketgo.com', '$2y$10$k9l7Xz9YzLZkqH8Sx2E2hOVpU7T0JqZs3mZ1w6J9mX6s1y9JQ5HhW', '2025-12-16 17:41:08', 'user'),
(2, 'egi', 'eggimaulanarizky@gmail.com', '$2y$10$e49E6amFLwjBtip1LmJOV.OXPER/1Hu7pb/n1RGHJLSlsZp3HK8Cy', '2025-12-16 17:46:37', 'admin'),
(3, 'well', 'wellgem@gmail.com', '$2y$10$adZNUbFOLdlXwBQd.I/0LuyIEZh0wlNA3g3B22LAvEtbYqirTP9aO', '2025-12-16 18:22:45', 'user'),
(4, 'ahh', 'ahh@gmail.com', '$2y$10$YCNfBuFsK0ScZqmznUryYu/eGO37XG13PGsyW0Jvca1M2pF71HIRS', '2025-12-19 06:43:11', 'user'),
(5, 'rizkyfadillah27', 'rizkyfadillah27@gmail.com', '$2y$10$JtN6j.HBWxPAHxEmT63dPugAU2myWwoERmP4MWFF/uX.1WhJCpBqS', '2025-12-20 07:31:19', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `event_id`, `created_at`) VALUES
(5, 3, 6, '2025-12-19 19:56:40'),
(6, 2, 11, '2025-12-19 21:28:44'),
(7, 2, 12, '2025-12-19 21:41:16'),
(8, 5, 6, '2025-12-20 07:34:37'),
(9, 5, 8, '2025-12-20 07:35:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_types`
--
ALTER TABLE `ticket_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `ticket_types`
--
ALTER TABLE `ticket_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
