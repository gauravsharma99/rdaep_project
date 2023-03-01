-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 01, 2023 at 04:00 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `EmployeeDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE `Employee` (
  `id` int(11) NOT NULL,
  `First_Name` varchar(100) NOT NULL,
  `Last_Name` varchar(100) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Country Code` varchar(10) NOT NULL,
  `Mobile` varchar(20) NOT NULL,
  `Address` varchar(500) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Hobby` varchar(50) NOT NULL,
  `Photo` varchar(500) NOT NULL,
  `Created_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Employee`
--

INSERT INTO `Employee` (`id`, `First_Name`, `Last_Name`, `Email`, `Country Code`, `Mobile`, `Address`, `Gender`, `Hobby`, `Photo`, `Created_Date`) VALUES
(1, 'neel', 'lad', 'neel.lad3110@gmail.com', '+1', '1122', 'abc', 'Male', 'reading,traveling', 'photos/employee_boat-ocean-sunset-landscape-5k-w1-2880x1800.jpeg', '2023-03-01'),
(3, 'neel', 'lad', 'neel.lad3110@gmail.com', '+1', '1122', 'abc', 'Male', 'reading,traveling', 'photos/employee_boat-ocean-sunset-landscape-5k-w1-2880x1800.jpeg', '2023-03-01'),
(6, 'Deep', 'lad', 'deep.lad@gmail.com', '+91', '9900124567', 'abc road , near hdfc bank , vapi', 'Male', 'reading,cooking', 'photos/employee_wallpapersden.com_small-memory_5120x2880.jpg', '2023-03-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Employee`
--
ALTER TABLE `Employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
