-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221005.cd15c26e1f
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 28, 2025 at 08:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketing-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'department updated'),
(6, 'sales'),
(7, 'new department'),
(8, 'Department 001');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `note`, `user_id`, `ticket_id`, `created_at`) VALUES
(2, 'This is the updated note', 1, 3, '2025-05-24 13:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'in_progress',
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `description`, `status`, `user_id`, `department_id`, `created_at`, `attachment`) VALUES
(2, 'Ticket 1', 'This is ticket 2', 'open', 2, 0, '2025-05-24 12:42:09', NULL),
(3, 'Ticket 1', 'This is ticket 2', 'open', 1, 1, '2025-05-24 12:42:24', NULL),
(4, 'new department', '', '', 2, 1, '2025-05-25 09:16:26', NULL),
(5, 'new department 3', '', '', 2, 1, '2025-05-25 09:18:37', NULL),
(6, 'Ticket no 4', 'forth ticket', '', 2, 1, '2025-05-26 12:40:54', NULL),
(7, 'Ticket no 5', 'forth ticket', '', 2, 1, '2025-05-26 12:41:42', NULL),
(9, 'Ticket no 5', 'forth ticket', 'closed', 5, 1, '2025-05-26 13:07:31', NULL),
(11, 'Ticket no 9', 'forth ticket', '', 2, 1, '2025-05-26 13:09:55', NULL),
(12, 'Ticket no 9', 'forth ticket', '', 2, 1, '2025-05-26 16:59:38', NULL),
(13, 'Ticket no 9', 'forth ticket', '', 2, 1, '2025-05-26 17:06:17', NULL),
(14, 'Ticket no 9', 'forth ticket', '', 2, 1, '2025-05-26 17:28:01', NULL),
(15, 'Ticket no 9', 'forth ticket', '', 2, 1, '2025-05-26 17:30:49', NULL),
(16, 'Updated ticket', 'Description for ticket', 'in progress', 1, 3, '2025-05-28 07:18:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `user_id`, `created_at`) VALUES
(1, 'baa2768b1bfa04e305ca49e8a03749c8', 3, '2025-05-26 07:54:00'),
(2, '1a33c389af54eab79e336c35daeffbbc', 3, '2025-05-27 12:25:56'),
(3, '50c3c7105f9a5630881c3cd83a6f1c63', 3, '2025-05-27 12:36:41'),
(5, '7d1be957ad4f41e549bd8aefbe115365', 5, '2025-05-27 20:41:40'),
(6, '5c757be56c9ae71686425320fb100457', 5, '2025-05-28 07:28:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(40) NOT NULL DEFAULT 'agent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'agent 1', 'agent1@test.com', '$2y$10$1v4GS.DU9pZLjbKoLA/8fufxYYmuGfwRqxoWfJQ9KeV0iaYZKdr1.', 'agent'),
(2, 'admin 1', 'admin1@test.com', '$2y$10$Q/Mb1viNG1t0e898c5yTa.VL.TvWQF2JFKl.waTCRatQ2uq72GiSG', 'admin'),
(3, 'admin 1', 'admin2@test.com', '$2y$10$c1/OwXKxUObRvIQJHjrjS.OTSmGhH8mDx0NyQkFbKrur5zss1Al86', 'admin'),
(4, 'agent 001', 'agent001@email.com', '$2y$10$16vl8Odn1i0PMKvhuZS3jOmw2sMufSE5ieiqjcaY0ScU7tzQsiSyO', ''),
(7, 'user 011', 'user0110@email.com', '$2y$10$kElBHwky.4UbNBtQKWDs7O0v7JolNJjA66uZbhgnqGkAAnoFoRTfK', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
