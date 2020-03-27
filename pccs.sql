-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2020 at 06:29 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pccs`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `fine` decimal(10,2) NOT NULL,
  `officer_id` varchar(50) NOT NULL,
  `fine_date` date NOT NULL,
  `due_date` date GENERATED ALWAYS AS (`fine_date` + interval 7 day) STORED,
  `pay_status` tinyint(1) NOT NULL,
  `history` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `address`, `fine`, `officer_id`, `fine_date`, `pay_status`, `history`) VALUES
('180187C', 'sunil perera', 'no.20, lake road, colombo', '0.00', '', '0000-00-00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` enum('Customer','Traffic Officer','OIC','Payment Officer') NOT NULL DEFAULT 'Customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `password`, `usertype`) VALUES
('1234abc', 'oic123', 'OIC'),
('180187C', 'password', 'Customer'),
('19981030', 'wordpass', 'Traffic Officer'),
('cash123', 'cashier', 'Payment Officer');

-- --------------------------------------------------------

--
-- Table structure for table `oic`
--

CREATE TABLE `oic` (
  `oic_id` varchar(50) NOT NULL,
  `oic_name` varchar(100) NOT NULL,
  `oic_branch` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_officer`
--

CREATE TABLE `payment_officer` (
  `cashier_id` varchar(50) NOT NULL,
  `cashier_name` varchar(100) NOT NULL,
  `institute` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `traffic officer`
--

CREATE TABLE `traffic officer` (
  `officer_id` varchar(50) NOT NULL,
  `officer_name` varchar(100) NOT NULL,
  `officer_branch` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `traffic officer`
--

INSERT INTO `traffic officer` (`officer_id`, `officer_name`, `officer_branch`) VALUES
('19981030', 'A.B. De Villiers', 'Gampaha');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oic`
--
ALTER TABLE `oic`
  ADD KEY `oic_id` (`oic_id`);

--
-- Indexes for table `payment_officer`
--
ALTER TABLE `payment_officer`
  ADD KEY `cashier_id` (`cashier_id`);

--
-- Indexes for table `traffic officer`
--
ALTER TABLE `traffic officer`
  ADD KEY `officer_id` (`officer_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `login` (`id`);

--
-- Constraints for table `oic`
--
ALTER TABLE `oic`
  ADD CONSTRAINT `oic_ibfk_1` FOREIGN KEY (`oic_id`) REFERENCES `login` (`id`);

--
-- Constraints for table `payment_officer`
--
ALTER TABLE `payment_officer`
  ADD CONSTRAINT `payment_officer_ibfk_1` FOREIGN KEY (`cashier_id`) REFERENCES `login` (`id`);

--
-- Constraints for table `traffic officer`
--
ALTER TABLE `traffic officer`
  ADD CONSTRAINT `traffic officer_ibfk_1` FOREIGN KEY (`officer_id`) REFERENCES `login` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
