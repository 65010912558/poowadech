-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2025 at 11:01 AM
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
-- Database: `2558db`
--
CREATE DATABASE IF NOT EXISTS `2558db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `2558db`;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `r_id` int(6) NOT NULL,
  `r_phone` varchar(255) NOT NULL,
  `r_name` varchar(255) NOT NULL,
  `r_height` int(11) NOT NULL,
  `r_address` text NOT NULL,
  `r_birthday` varchar(255) NOT NULL,
  `r_color` varchar(50) NOT NULL,
  `r_major` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`r_id`, `r_phone`, `r_name`, `r_height`, `r_address`, `r_birthday`, `r_color`, `r_major`) VALUES
(2, '0943597640', 'ภูวเดช โลเกตุ', 170, '1555', ' 2025-12-10', ' #0d6efd', 'คอมพิวเตอร์ธุรกิจ'),
(3, '0943597640', 'ภูวเดช โลเกตุ', 170, '55555555555555', ' 2025-12-17', ' #fd0d0d', 'คอมพิวเตอร์ธุรกิจ'),
(4, '0943597640', 'ภูวเดช โลเกตุ', 200, '66666666699999999', ' 2025-12-25', ' #243856', 'คอมพิวเตอร์ธุรกิจ'),
(5, '0943597640', 'หฟหเฟเเฟเฟ', 120, '656556556', ' 2025-12-10', ' #6e88af', 'คอมพิวเตอร์ธุรกิจ');

-- --------------------------------------------------------

--
-- Table structure for table `sapp`
--

CREATE TABLE `sapp` (
  `app_id` int(255) NOT NULL,
  `app_position` varchar(100) NOT NULL,
  `app_prefix` varchar(20) NOT NULL,
  `app_fullname` varchar(200) NOT NULL,
  `app_birthday` date NOT NULL,
  `app_education` varchar(100) NOT NULL,
  `app_skills` text NOT NULL,
  `app_experience` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sapp`
--

INSERT INTO `sapp` (`app_id`, `app_position`, `app_prefix`, `app_fullname`, `app_birthday`, `app_education`, `app_skills`, `app_experience`) VALUES
(1, 'Digital Marketing Specialist', 'นาง', 'ภูวเดช โลเกตุ', '0000-00-00', 'ปริญญาตรี', 'WDF', 'fwd'),
(2, 'Software Developer', 'นางสาว', 'ภูวเดช โลเกตุ', '2003-06-10', 'อนุปริญญา/ปวส.', 'DW', 'qdw');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `sapp`
--
ALTER TABLE `sapp`
  ADD PRIMARY KEY (`app_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `r_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sapp`
--
ALTER TABLE `sapp`
  MODIFY `app_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
