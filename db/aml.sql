-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 03:16 PM
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
-- Database: `aml`
--

-- --------------------------------------------------------

--
-- Table structure for table `media_details`
--

CREATE TABLE `media_details` (
  `media_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `image_url` varchar(120) NOT NULL,
  `type` enum('book','magazine','film','video_game','newspaper') NOT NULL DEFAULT 'book'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_activation`
--

CREATE TABLE `user_activation` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `activation_code` varchar(32) NOT NULL,
  `activation_expiry` datetime NOT NULL,
  `activated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_activation`
--

INSERT INTO `user_activation` (`user_id`, `active`, `activation_code`, `activation_expiry`, `activated_at`, `created_at`, `updated_at`) VALUES
(28, 1, '04b6f7c3a14012c3f939e11107503875', '2024-12-06 03:31:03', '2024-12-05 02:32:52', '2024-12-05 02:31:03', '2024-12-05 02:32:52'),
(29, 0, '565f5242a03e21cb84ba952c76743b1e', '2024-12-06 03:33:40', NULL, '2024-12-05 02:33:40', '2024-12-05 02:33:40'),
(30, 1, '551b6f78be8687778c9780d9cfdff992', '2024-12-06 03:36:03', '2024-12-05 02:36:16', '2024-12-05 02:36:03', '2024-12-05 02:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_credentials`
--

CREATE TABLE `user_credentials` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_credentials`
--

INSERT INTO `user_credentials` (`user_id`, `username`, `password`) VALUES
(28, 'test', '$2y$10$Rjp8/ukXAZiccw0alAO5cO903f7RkJ7Tz1P/ydFNOJSwFo89wJmg2'),
(29, 'test2', '$2y$10$KauPKWtTKtCWT8LY.1qFoe3Nt.xsCGe/vsXyRc9OXscb7RHUSnXLO'),
(30, 'test3', '$2y$10$iqDmR07EKyKpgMcou55uXeePzI.sDFIBraGzcYrIrucWKhIg6Inki');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(60) NOT NULL,
  `address` varchar(60) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `phone_number` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `first_name`, `last_name`, `date_of_birth`, `email`, `address`, `postcode`, `phone_number`) VALUES
(28, '11', '11', '2024-12-20', 'matthewjones3035@gmail.com', '11', '11', '11'),
(29, '11', '11', '2024-12-11', 'matthewjones3035@gmail.com', '11', '11', '11'),
(30, '12', '11', '2024-12-20', 'matthewjones3035@gmail.com', '11', '11', '11');

-- --------------------------------------------------------

--
-- Table structure for table `user_privileges`
--

CREATE TABLE `user_privileges` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `is_branch_librarian` tinyint(1) NOT NULL DEFAULT 0,
  `is_branch_manager` tinyint(1) NOT NULL DEFAULT 0,
  `is_purchase_manager` tinyint(1) NOT NULL DEFAULT 0,
  `is_accountant` tinyint(1) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_privileges`
--

INSERT INTO `user_privileges` (`user_id`, `is_branch_librarian`, `is_branch_manager`, `is_purchase_manager`, `is_accountant`, `is_admin`) VALUES
(28, 0, 0, 0, 0, 0),
(29, 0, 0, 0, 0, 0),
(30, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `media_details`
--
ALTER TABLE `media_details`
  ADD PRIMARY KEY (`media_id`);

--
-- Indexes for table `user_activation`
--
ALTER TABLE `user_activation`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_credentials`
--
ALTER TABLE `user_credentials`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `user_privileges`
--
ALTER TABLE `user_privileges`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `media_details`
--
ALTER TABLE `media_details`
  MODIFY `media_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_credentials`
--
ALTER TABLE `user_credentials`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_activation`
--
ALTER TABLE `user_activation`
  ADD CONSTRAINT `user_activation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_credentials` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_credentials` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_privileges`
--
ALTER TABLE `user_privileges`
  ADD CONSTRAINT `user_privileges_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_credentials` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
