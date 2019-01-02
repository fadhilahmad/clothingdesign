-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2019 at 02:35 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothing_design`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_12_16_201111_create_posts_table', 2),
(4, '2018_12_17_164819_add_user_id_to_posts', 3),
(5, '2018_12_17_211708_add_cover_image_to_posts', 4),
(6, '2018_12_19_211756_add_user_type_to_the_users', 5),
(7, '2018_12_19_213119_add_user_type_to__users', 6),
(8, '2018_12_22_183306_add_phone_and_address_to_users', 7),
(9, '2018_12_22_191612_add_collar_sleeve_delivery_to_posts', 8),
(10, '2018_12_24_201004_add_image_and_desc_to_posts', 9),
(11, '2018_12_24_234904_add_desc_reject_to_posts', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `features` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `cover_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `collar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sleeve` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `draft_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noimage.jpg',
  `draft_desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no desc',
  `desc_reject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not rejected'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `gender`, `size`, `color`, `features`, `material`, `amount`, `created_at`, `updated_at`, `user_id`, `cover_image`, `status`, `collar`, `sleeve`, `delivery`, `draft_image`, `draft_desc`, `desc_reject`) VALUES
(1, 'First Order', '<p>cs1 first order</p>', 'male', 'S', 'white', 'no feature', '100-cotton', 11, '2018-12-25 13:46:19', '2019-01-01 07:05:39', 7, '5f5c5d785159be958f2f60dc1fcf7439_1545774379.jpg', 'Posted', 'crew neck', 'normal sleeves', 'postage', '61genc5VzmL._UX385__1545774446.jpg', '<p>first design</p>', 'not rejected'),
(2, 'Cust 2 first order', '<p>Order first from cust 2</p>', 'male', 'S', 'white', 'no feature', '100-cotton', 2, '2018-12-25 13:54:39', '2018-12-25 13:54:39', 8, '2018-new-summer-mens-letters-3d-printed-t_1545774879.jpg', 'Submitted', 'crew neck', 'normal sleeves', 'self-pickup', 'noimage.jpg', 'no desc', 'not rejected');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `user_type`, `phone`, `address`) VALUES
(1, 'Admin 1', 'ad@gmail.com', NULL, '$2y$10$xYWjlr3yR1VSmIZNV0NDGOR8e0RlUXG7z4PCmq83lsvB8wSCKbnsi', 'WHEaXlilYeuFwFSDH2hgJdxzsey8KWiiAxFMyboi7VuNRlZOlcHoXtwvuI9c', '2018-12-25 13:36:44', '2018-12-25 13:36:44', 'admin', '0111111111', 'Jalan Admin'),
(2, 'Designer 1', 'dg@gmail.com', NULL, '$2y$10$FNoJtFj.ff.pE6mbytUOJ.1fQniKMi1ppkJ9oi1NXIabXpg9Obw5m', 'JKIE9uph9fQagrPQvxQ1fXm5IzgQUiA6cxs3kMBHgSN1GPNN2cnxQbSL2IDZ', '2018-12-25 13:38:39', '2018-12-25 13:38:39', 'designer', '02222222222', 'Jalan Designer'),
(3, 'Moulder 1', 'md@gmail.com', NULL, '$2y$10$jdGbwkoEXNr8Y.Gkef4roOJKUPgl/ColsLtOcGCOXkXVi4Hl.Q68q', 'yU3QnfjwY6eZ8EmtrGdj9aUEYgwizbVZCmtygWyY6GcGSNaWEBb2t47c3aGR', '2018-12-25 13:39:14', '2018-12-25 13:39:14', 'moulder', '03333333333', 'Jalan Moulder'),
(4, 'Tailor 1', 'tl@gmail.com', NULL, '$2y$10$iDv.ymjPr02b9RNIPaNhRO6CPtGUX4zsGQWdCzbJZhIZK4nXoPeWe', 'zbvsxKCDBqtsYTDZckDeiMFVtmygwZIKXlLRrZ6STOtKjINhCfUNcvl5XI1C', '2018-12-25 13:39:55', '2018-12-25 13:39:55', 'tailor', '04444444444', 'Jalan Tailor'),
(5, 'HR 1', 'hr@gmail.com', NULL, '$2y$10$8k0sMJgbvs.vLEDCyj2xRu2W0SP./a7S6aS5.9/rV6gaOeW5Qt4WW', 'ofILc7QBmuyisbd3CnlJWfcf08j0kusyB76aWIoXJ3wDHAzEfElOvl887wDB', '2018-12-25 13:40:38', '2018-12-25 13:40:38', 'hr', '0555555555', 'Jalan HR'),
(6, 'Manager 1', 'mg@gmail.com', NULL, '$2y$10$LtMGYiqupPmGIbyuxB4p6efGwj6Qe4VNKP6zI4jcHU.ScjGznPIjm', NULL, '2018-12-25 13:41:22', '2018-12-25 13:41:22', 'manager', '0666666666', 'Jalan Manager'),
(7, 'Customer 1', 'cs1@gmail.com', NULL, '$2y$10$twiUXIcBHmtjlVy1l6lW5uLJ/q3kKVQIXAbiCbkjxezEoT0yjKGAC', 'uftMAyHQYG8C7gMeaFlFv0JnkZeivJz8v1Ok4DxjJcCoQcvrOFYYO9vBX3D2', '2018-12-25 13:42:00', '2018-12-25 13:42:00', 'customer', '0777777777', 'Jalan Customer'),
(8, 'Customer 2', 'cs2@gmail.com', NULL, '$2y$10$7/xjadywh.fptv6xmVvdKuD4pllUFMgQvhvSAPobhQKTnayMofCLu', 'WsPcbs1QKHH0v2QRchPFf57aTsRKjRUj21RMu0gIivWFUyhe0TBXVkTZhXoJ', '2018-12-25 13:43:16', '2018-12-25 13:43:16', 'customer', '0888888888', 'Jalan Customer'),
(9, 'Customer 3', 'cs3@gmail.com', NULL, '$2y$10$tjNMY1RGnFMRQjfok0sB..yeMgGWANdLTDF5oeynMQCfS2MD8YxGK', NULL, '2018-12-25 13:43:44', '2019-01-02 05:11:35', 'customer', '0999999998', 'Jalan Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
