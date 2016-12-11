-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2016 at 03:45 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medical_system`
--
CREATE DATABASE IF NOT EXISTS `medical_system` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `medical_system`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(60) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `contact` bigint(100) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `pwd` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `first_name`, `last_name`, `birthday`, `contact`, `address`, `email`, `pwd`) VALUES
('venkat', 'venkatesh', 'sharma', '1994-03-19', 3852887115, 'SLC', 'venkatesh.1324@gmail.com', 'venkat123');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(6) NOT NULL,
  `patient_id` int(6) DEFAULT NULL,
  `doctor_id` int(6) DEFAULT NULL,
  `time_id` int(6) DEFAULT NULL,
  `doctor_schedule_id` int(6) DEFAULT NULL,
  `schedule_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `doctor_id`, `time_id`, `doctor_schedule_id`, `schedule_date`) VALUES
(31, 2, 7, 18, 73, '2016-12-08'),
(30, 4, 7, 19, 74, '2016-12-08'),
(25, 2, 5, 9, 65, '2016-12-12'),
(24, 2, 7, 19, 76, '2016-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(6) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `specialization` varchar(50) NOT NULL,
  `bio` varchar(1000) DEFAULT NULL,
  `birthday` date NOT NULL,
  `contact` bigint(10) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `username`, `first_name`, `last_name`, `pwd`, `email`, `gender`, `specialization`, `bio`, `birthday`, `contact`, `address`) VALUES
(6, 'venkat', 'venkatesh', 'sharma', '5fe372adb4f667960152ae841d2371b9', 'Venkatesh.1324@gmail.com', 'Male', 'Medicine', '', '1994-03-19', 9422177067, 'Park City'),
(7, 'asane', 'Anand', 'Sane', '4aafb234b5e27e35df4c4711309a8bf4', 'asane@gmail.com', 'Male', 'Medicine', '', '1963-08-11', 9422177777, 'SLC'),
(5, 'cwhite', 'Cam', 'White', '2d3090830922ea4f67aa2aabcf9e1f5f', 'c.white@gmail.com', 'Male', 'Dentistry', '', '1973-12-06', 1234567890, 'SLC'),
(8, 'swilliams', 'Spenser', 'Williams', 'd20687f3b173a23579e51e70e6bc7ce4', 's.williams@gmail.com', 'Male', 'Ear,', '', '1990-08-30', 9422177066, 'SLC');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedule`
--

CREATE TABLE `doctor_schedule` (
  `id` int(6) NOT NULL,
  `d_first_name` varchar(256) NOT NULL,
  `d_last_name` varchar(256) NOT NULL,
  `set_time_id` int(10) NOT NULL,
  `sch_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_schedule`
--

INSERT INTO `doctor_schedule` (`id`, `d_first_name`, `d_last_name`, `set_time_id`, `sch_date`) VALUES
(86, 'Pranav', 'Sane', 2, '2016-12-09'),
(85, 'Pranav', 'Sane', 1, '2016-12-09'),
(84, 'Cam', 'White', 19, '2016-12-15'),
(83, 'Cam', 'White', 18, '2016-12-15'),
(82, 'Cam', 'White', 17, '2016-12-15'),
(81, 'Cam', 'White', 2, '2016-12-15'),
(80, 'Cam', 'White', 1, '2016-12-15'),
(79, 'Anand', 'Sane', 19, '2016-12-07'),
(78, 'Anand', 'Sane', 18, '2016-12-07'),
(77, 'Anand', 'Sane', 17, '2016-12-07'),
(76, 'Anand', 'Sane', 19, '2016-12-06'),
(75, 'Anand', 'Sane', 18, '2016-12-06'),
(74, 'Anand', 'Sane', 19, '2016-12-08'),
(73, 'Anand', 'Sane', 18, '2016-12-08'),
(72, 'Anand', 'Sane', 17, '2016-12-08'),
(71, 'Anand', 'Sane', 16, '2016-12-08'),
(70, 'Anand', 'Sane', 15, '2016-12-08'),
(69, 'Cam', 'White', 13, '2016-12-12'),
(68, 'Cam', 'White', 12, '2016-12-12'),
(67, 'Cam', 'White', 11, '2016-12-12'),
(66, 'Cam', 'White', 10, '2016-12-12'),
(65, 'Cam', 'White', 9, '2016-12-12'),
(64, 'Cam', 'White', 8, '2016-12-12'),
(63, 'Pranav', 'Sane', 13, '2016-12-06'),
(62, 'Pranav', 'Sane', 12, '2016-12-06'),
(61, 'Pranav', 'Sane', 11, '2016-12-06'),
(60, 'Pranav', 'Sane', 10, '2016-12-06'),
(59, 'Pranav', 'Sane', 9, '2016-12-06'),
(58, 'Pranav', 'Sane', 8, '2016-12-06'),
(87, 'Pranav', 'Sane', 18, '2016-12-09'),
(88, 'Pranav', 'Sane', 19, '2016-12-09'),
(89, 'Anand', 'Sane', 1, '2016-12-31'),
(90, 'Anand', 'Sane', 2, '2016-12-31'),
(91, 'Anand', 'Sane', 3, '2016-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_specialty`
--

CREATE TABLE `doctor_specialty` (
  `specialty` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_specialty`
--

INSERT INTO `doctor_specialty` (`specialty`) VALUES
('Cardiology'),
('Dentistry'),
('Ear, Nose, and Throat'),
('Gastroenterology'),
('Medicine'),
('Oncology'),
('Ophthalmology'),
('Pediatrics'),
('Radiology'),
('Urology');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(6) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthday` date NOT NULL,
  `contact` bigint(10) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `username`, `first_name`, `last_name`, `pwd`, `email`, `gender`, `birthday`, `contact`, `address`) VALUES
(2, 'testuser', 'Test', 'Test', '5fe372adb4f667960152ae841d2371b9', 'test@test.com', 'Female', '1990-12-06', 1111111111, 'SLC'),
(3, 'jordang', 'Jordan', 'Golightly', 'c8cff5a39ade0b6dcde0394de9c519cc', 'jordan@gmail.com', 'Male', '1988-06-26', 1231231231, 'SLC');

-- --------------------------------------------------------

--
-- Table structure for table `patient_history`
--

CREATE TABLE `patient_history` (
  `id` int(10) NOT NULL,
  `patient_id` int(6) DEFAULT NULL,
  `appointment_id` int(10) DEFAULT NULL,
  `problems` varchar(500) DEFAULT NULL,
  `treatment` varchar(500) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_history`
--

INSERT INTO `patient_history` (`id`, `patient_id`, `appointment_id`, `problems`, `treatment`, `notes`) VALUES
(5, 2, 24, 'High blood sugar,\r\nhigh BP', 'Seanol\r\nGP2\r\nInsulin 3 units every night', ''),
(6, 4, 30, 'Cold\r\nCough', 'D cold \r\nNP', ''),
(7, 2, 31, 'Cold', 'Crocin', '');

-- --------------------------------------------------------

--
-- Table structure for table `set_time`
--

CREATE TABLE `set_time` (
  `id` int(10) DEFAULT NULL,
  `Start_time` time DEFAULT NULL,
  `End_time` time DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_time`
--

INSERT INTO `set_time` (`id`, `Start_time`, `End_time`) VALUES
(1, '10:00:00', '10:30:00'),
(2, '10:30:00', '11:00:00'),
(3, '11:00:00', '11:30:00'),
(4, '11:30:00', '12:00:00'),
(5, '12:30:00', '13:00:00'),
(6, '13:00:00', '13:30:00'),
(7, '13:30:00', '14:00:00'),
(8, '14:00:00', '14:30:00'),
(9, '14:30:00', '15:00:00'),
(10, '15:00:00', '15:30:00'),
(11, '15:30:00', '16:00:00'),
(12, '16:00:00', '16:30:00'),
(13, '16:30:00', '17:00:00'),
(14, '17:00:00', '17:30:00'),
(15, '17:30:00', '18:00:00'),
(16, '18:00:00', '18:30:00'),
(17, '18:30:00', '19:00:00'),
(18, '19:00:00', '19:30:00'),
(19, '19:30:00', '20:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_appointment` (`patient_id`,`doctor_id`,`time_id`,`doctor_schedule_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `time_id` (`time_id`),
  ADD KEY `doctor_schedule_id` (`doctor_schedule_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doctor_schedule` (`set_time_id`,`sch_date`),
  ADD KEY `d_first_name` (`d_first_name`,`d_last_name`);

--
-- Indexes for table `doctor_specialty`
--
ALTER TABLE `doctor_specialty`
  ADD UNIQUE KEY `specialty` (`specialty`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `patient_history`
--
ALTER TABLE `patient_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `patient_history`
--
ALTER TABLE `patient_history`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
