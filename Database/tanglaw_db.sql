-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 08:51 PM
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
-- Database: `tanglaw_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_fullname` varchar(128) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_fullname`, `admin_email`, `admin_password`) VALUES
(1, 'Admin', 'admin@email.com', '$2y$10$JEwG0.7Mfrl8cU3EA3JyXeB.iTR1X2Gj5KCIilSpJvOy3XAGbfdZC');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_image` blob NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_location` varchar(255) NOT NULL,
  `event_contact_person` varchar(255) NOT NULL,
  `event_contact` int(11) NOT NULL,
  `event_date_start` date NOT NULL,
  `event_date_end` date NOT NULL,
  `event_time_start` time(6) NOT NULL,
  `event_time_end` time(6) NOT NULL,
  `event_content` varchar(255) NOT NULL,
  `event_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_image`, `event_name`, `event_location`, `event_contact_person`, `event_contact`, `event_date_start`, `event_date_end`, `event_time_start`, `event_time_end`, `event_content`, `event_id`) VALUES
('', 'fsd', 'sdf', 'sdf', 0, '2024-04-09', '2024-04-30', '14:57:00.000000', '02:00:00.000000', 'sdf', 9),
('', 'sdf', 'fsd', 'fsd', 2147483647, '2024-04-07', '2024-04-22', '02:00:00.000000', '05:57:00.000000', 'sdf', 10);

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `volunteer_id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`volunteer_id`, `full_name`, `email`, `username`, `password`) VALUES
(1, 'Brad Pitt', 'brad@example.com', 'root', '$2y$10$AEdfO5FP.wjJuFvAs5mwqehWi/2HtEloCLzP5R7j5pr3PHKcqfkgO'),
(2, 'user', 'user@email.com', 'root', '$2y$10$ZrLbo8I9v5mT1i808.WgfOuUowB9IZGIjr3ly90xlLJ5YNjzf7mqu'),
(3, 'user', 'user@example.com', 'root', '$2y$10$zBE3DEUqP.rP.avSfKVXz.DvAizMLRm51VvGbgzmvZQ4VjtcPW/LO'),
(4, 'dfsfsd', '1234@email.com', 'root', '$2y$10$DvvIumy/fs/w4JHZC/2Pu..tYWscVgpyzdVb4TEMKzkC6cPEgRZw2'),
(5, 'a', 'a@a.com', 'root', '$2y$10$KCuir/uxTz9oGSAWHSFzG.ZLIcybLuG7G7J/wNkDLS7Brk/iMcbq6'),
(6, 'Franz', 'franz@example.com', 'Franz', '$2y$10$g/jxQlCwYJ0/HLiDmNwc8eZPe5j00bS0skRu57l11vMCGOoCTkszG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`volunteer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `volunteer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
