-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2024 at 06:17 PM
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
-- --

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `borrow_id` int(10) NOT NULL,
  `media_id` int(10) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `borrowed_date` date NOT NULL,
  `due_date` date NOT NULL,
  `borrow_type` enum('delivery','library_pickup') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`borrow_id`, `media_id`, `user_id`, `borrowed_date`, `due_date`, `borrow_type`) VALUES
(1, 7, 28, '2024-12-12', '2024-12-26', 'library_pickup'),
(2, 6, 28, '2024-12-12', '2024-12-26', NULL),
(3, 12, 28, '2024-12-12', '2024-12-26', NULL),
(4, 9, 28, '2024-12-12', '2024-12-26', NULL),
(5, 9, 28, '2024-12-12', '2024-12-26', NULL),
(6, 9, 28, '2024-12-12', '2024-12-26', NULL),
(7, 9, 28, '2024-12-12', '2024-12-26', NULL),
(8, 9, 28, '2024-12-12', '2024-12-26', NULL),
(9, 9, 28, '2024-12-12', '2024-12-26', NULL),
(10, 9, 28, '2024-12-12', '2024-12-26', NULL),
(11, 9, 28, '2024-12-12', '2024-12-26', NULL),
(12, 9, 28, '2024-12-12', '2024-12-26', NULL),
(13, 9, 28, '2024-12-12', '2024-12-26', NULL),
(14, 9, 28, '2024-12-12', '2024-12-26', NULL),
(15, 9, 28, '2024-12-12', '2024-12-26', NULL),
(16, 9, 28, '2024-12-12', '2024-12-26', NULL),
(17, 7, 28, '2024-12-12', '2024-12-26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `media_id` int(10) NOT NULL,
  `cover_img` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `published_year` year(4) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  `stock` int(10) NOT NULL,
  `media_type_id` int(11) NOT NULL,
  `favourite` enum('fav','unfav') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`media_id`, `cover_img`, `title`, `published_year`, `description`, `author`, `stock`, `media_type_id`, `favourite`) VALUES
(6, 'Congo.jpg', 'congo', '2007', 'iwj0fieifbejfro0ekfoewf0eowsfoejfeirferf', 'james', 3, 1, 'unfav'),
(7, 'emma.jpg', 'Emma', '2010', 'edovpesjfjoejfopef', 'Luke', 2, 1, 'fav'),
(8, 'Gone girl.jpg', 'gone girl', '2014', 'sfojwofjwsof', 'Marinar', 1, 2, 'fav'),
(9, 'The road.jpg', 'Road', '2021', 'iwojdfoikfisdjfosdifs', 'Luost', 5, 3, 'unfav'),
(10, 'emma.jpg', 'Luke', '2010', 'oif0wihf0iwsjf09w', 'Loust', 4, 3, 'fav'),
(11, 'The Notebook.jpg', 'NOte', '2022', 'sdjfwjfwosfos', 'U than win', 1, 4, 'fav'),
(12, 'Twilight.jpg', 'Twin', '2014', 'sdjfpwsjfowsfo-w', 'Yoon Ya ti', 4, 5, 'fav');

-- --------------------------------------------------------

--
-- Table structure for table `media_type`
--

CREATE TABLE `media_type` (
  `media_type_id` int(11) NOT NULL,
  `media_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media_type`
--

INSERT INTO `media_type` (`media_type_id`, `media_type`) VALUES
(1, 'Book'),
(2, 'Magazine'),
(3, 'Journal'),
(4, 'CD/DVD'),
(5, 'Audio');

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
(30, 'test3', '$2y$10$bk1LFHxpKOhkGDCAYNO53eIFQmbuINcq6gFNMdb6.lOpS1Oxx89Sq');

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
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `borrow_fk` (`media_id`),
  ADD KEY `user_fk` (`user_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `media_type_fk` (`media_type_id`);

--
-- Indexes for table `media_type`
--
ALTER TABLE `media_type`
  ADD PRIMARY KEY (`media_type_id`);

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
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `borrow_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `media_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `media_type`
--
ALTER TABLE `media_type`
  MODIFY `media_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_credentials`
--
ALTER TABLE `user_credentials`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `borrow_fk` FOREIGN KEY (`media_id`) REFERENCES `media` (`media_id`),
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`);

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_type_fk` FOREIGN KEY (`media_type_id`) REFERENCES `media_type` (`media_type_id`);

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
