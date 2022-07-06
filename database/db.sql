-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 07, 2021 at 09:42 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `photo` varchar(45) DEFAULT NULL,
  `created_on` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`, `type`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'Isaac', 'Arcilla', 'demo/b6.jpg', 'August 31, 2019', 'Administrator'),
(2, 'secretary', '81dc9bdb52d04dc20036dbd8313ed055', 'Isaac', 'Arcilla II', 'demo/b6.jpg', 'August 31, 2019', 'Secretary'),
(3, 'timekeeper', '81dc9bdb52d04dc20036dbd8313ed055', 'Isaac', 'Arcilla III', 'demo/b6.jpg', 'August 31, 2019', 'Timekeeper');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `attendance_id` varchar(45) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  `time_in_morning` varchar(45) DEFAULT NULL,
  `time_out_morning` varchar(45) DEFAULT NULL,
  `time_in_afternoon` varchar(45) DEFAULT NULL,
  `time_out_afternoon` varchar(45) DEFAULT NULL,
  `status_morning` int(11) DEFAULT NULL,
  `status_afternoon` int(11) DEFAULT NULL,
  `num_hr_morning` double DEFAULT NULL,
  `num_hr_afternoon` double DEFAULT NULL,
  `month` varchar(45) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `attendance_id`, `date`, `time_in_morning`, `time_out_morning`, `time_in_afternoon`, `time_out_afternoon`, `status_morning`, `status_afternoon`, `num_hr_morning`, `num_hr_afternoon`, `month`, `year`) VALUES
(24, 20, '1624530', '2019-09-09', '07:30:00', '11:31:00', '13:00:00', '17:00:00', 1, 1, 3.0166666666667, 4, 'September', '2019'),
(25, 20, '1542630', '2019-09-10', '06:57:00', '11:04:00', '13:01:00', '17:01:00', 1, 0, 3.1166666666667, 4, 'September', '2019'),
(28, 22, '5014263', '2019-09-10', '07:32:00', '11:30:00', '12:58:00', '17:01:00', 0, 1, 3.9666666666667, 4.05, 'September', '2019'),
(32, 19, '0235146', '2019-09-10', '06:56:00', '11:30:00', '13:01:00', '17:01:00', 1, 0, 3.5666666666667, 4, 'September', '2019'),
(33, 21, '4152630', '2019-09-10', '07:29:00', '11:45:00', '13:15:00', '17:14:00', 1, 0, 3.2666666666667, 3.9833333333333, 'September', '2019'),
(35, 20, '4260531', '2019-09-11', '07:30:00', '11:00:00', '12:54:00', '17:30:00', 0, 1, 3.5, 3.6, 'September', '2019'),
(36, 22, '4052613', '2019-09-11', '07:30:00', '12:00:00', '12:59:00', '17:10:00', 1, 1, 3.5, 3.1833333333333, 'September', '2019'),
(37, 19, '2650143', '2019-09-11', '07:00:00', '11:00:00', '13:01:00', '17:00:00', 1, 0, 4, 3.9833333333333, 'September', '2019'),
(38, 21, '4163052', '2019-09-11', '07:31:00', '11:32:00', '12:50:00', '17:00:00', 0, 0, 3.5, 4.1666666666667, 'September', '2019'),
(39, 20, '6213450', '2019-09-13', '07:00:00', '11:00:00', '12:50:00', '17:15:00', 1, 1, 4, 4.4166666666667, 'September', '2019'),
(40, 22, '5031426', '2019-09-13', '07:30:00', '11:45:00', '13:00:00', '17:05:00', 1, 1, 4.25, 4.0833333333333, 'September', '2019'),
(41, 20, '1320654', '2019-09-16', '07:15:00', '11:16:00', '13:00:00', '17:03:00', 0, 1, 4.0166666666667, 4.05, 'September', '2019'),
(42, 19, '6135402', '2019-09-16', '07:30:00', '11:28:00', '13:02:00', '17:30:00', 1, 1, 3.9666666666667, 4.4666666666667, 'September', '2019'),
(43, 20, '3156240', '2019-09-14', '07:00:00', '11:05:00', '13:00:00', '17:10:00', 1, 1, 4.0833333333333, 4.1666666666667, 'September', '2019'),
(44, 19, '3061245', '2019-09-14', '07:15:00', '11:35:00', '12:55:00', '17:15:00', 1, 1, 4.3333333333333, 4.3333333333333, 'September', '2019'),
(45, 20, '3610452', '2019-09-17', '07:15:00', '11:15:00', '12:55:00', '17:15:00', 0, 1, 4, 4.3333333333333, 'September', '2019'),
(46, 19, '4612035', '2019-09-17', '07:15:00', '11:18:00', '13:00:00', '17:15:00', 1, 1, 4.05, 4.25, 'September', '2019'),
(48, 20, '4153620', '2019-09-28', '08:20:01', '08:55:27', '09:09:22', '09:20:28', 0, 1, 0.58333333333333, 0.18333333333333, 'September', '2019'),
(49, 22, '0162354', '2019-09-28', '08:20:31', '09:01:35', '09:10:14', '09:20:37', 0, 1, 0.68333333333333, 0.16666666666667, 'September', '2019'),
(59, 23, '2104356', '2019-09-28', '08:41:48', '09:01:17', '09:10:27', '09:20:49', 0, 1, 0.31666666666667, 0.16666666666667, 'September', '2019'),
(60, 19, '5106432', '2019-09-28', '08:42:12', '09:01:27', '09:10:20', '09:20:43', 0, 1, 0.31666666666667, 0.16666666666667, 'September', '2019'),
(61, 21, '0536421', '2019-09-28', '08:47:24', '09:00:54', '09:10:03', '10:02:37', 0, 1, 0.21666666666667, 0.86666666666667, 'September', '2019'),
(62, 20, '0436215', '2019-10-07', '07:00:00', '11:45:00', '13:02:00', '17:04:00', 1, 1, 3.75, 4.0333333333333, 'October', '2019'),
(63, 20, '0436152', '2019-10-08', '07:00:00', '11:45:00', '13:02:00', '17:04:00', 1, 1, 3.75, 4.0333333333333, 'October', '2019'),
(64, 20, '3654210', '2019-10-09', '07:00:00', '11:40:00', '13:00:00', '17:04:00', 1, 1, 3.6666666666667, 4.0666666666667, 'October', '2019'),
(65, 20, '0615432', '2019-10-10', '07:50:00', '11:40:00', '13:00:00', '17:00:00', 0, 1, 3.8333333333333, 4, 'October', '2019'),
(67, 20, '2465031', '2019-10-11', '07:00:00', '11:00:00', '13:00:00', '17:20:00', 1, 1, 4, 4.3333333333333, 'October', '2019'),
(68, 20, '1436520', '2019-10-12', '07:00:00', '11:00:00', '13:00:00', '17:00:00', 1, 1, 4, 4, 'October', '2019'),
(70, 20, '3654201', '2019-10-13', '02:45:00', '02:45:00', '02:45:00', '02:45:00', 0, 1, 0, 0, 'October', '2019'),
(74, 21, '2635401', '2019-11-27', '07:00:00', '12:45:00', '13:45:00', '17:45:00', 1, 1, 5.75, 4, 'November', '2019');

-- --------------------------------------------------------

--
-- Table structure for table `barcode`
--

CREATE TABLE `barcode` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(45) DEFAULT NULL,
  `generated_on` varchar(45) DEFAULT NULL,
  `path` varchar(45) DEFAULT NULL,
  `bool_gen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barcode`
--

INSERT INTO `barcode` (`id`, `employee_id`, `generated_on`, `path`, `bool_gen`) VALUES
(5, '058379612', '2019-09-09', 'employee_barcode/058379612.png', 1),
(6, '017468523', '2019-09-09', 'employee_barcode/017468523.png', 1),
(7, '358041762', '2019-09-09', 'employee_barcode/358041762.png', 1),
(8, '074215963', '2019-09-09', 'employee_barcode/074215963.png', 1),
(9, '908326751', '2019-09-15', 'employee_barcode/908326751.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cashadvance`
--

CREATE TABLE `cashadvance` (
  `id` int(11) NOT NULL,
  `cash_id` varchar(45) DEFAULT NULL,
  `date_advance` varchar(45) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cashadvance`
--

INSERT INTO `cashadvance` (`id`, `cash_id`, `date_advance`, `employee_id`, `amount`) VALUES
(2, '3514620', '2019-09-02', 19, 100),
(3, '6052431', '2019-09-02', 19, 150),
(5, '5612340', '2019-09-03', 20, 100),
(9, '6045321', '2019-09-03', 22, 100),
(10, '3145206', '2019-09-03', 22, 200),
(12, '4361025', '2019-09-13', 20, 100),
(16, '5310426', '2019-09-15', 19, 100),
(17, '2643105', '2019-09-15', 20, 34),
(19, '0316245', '2019-10-12', 20, 200),
(20, '1560234', '2019-11-27', 21, 3),
(22, '0341265', '2019-11-27', 20, 2.06);

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `attained` varchar(45) DEFAULT NULL,
  `year_graduated` varchar(45) DEFAULT NULL,
  `eid` varchar(45) DEFAULT NULL,
  `degree_received` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `employee_id`, `attained`, `year_graduated`, `eid`, `degree_received`) VALUES
(1, 22, 'Elementary', '2010', '074215963', 'Valedictorian'),
(2, 22, 'High School', '2014', '074215963', 'Third Honors'),
(3, 20, 'Elementary', '2016', '058379612', 'Third Honors'),
(4, 21, 'College', '2018', '017468523', 'Third Honors');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(45) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `created_on` varchar(45) DEFAULT NULL,
  `photo` longtext DEFAULT NULL,
  `fullname` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phonenumber` varchar(45) DEFAULT NULL,
  `birthdate` varchar(45) DEFAULT NULL,
  `sex` varchar(45) DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL,
  `civil_status` varchar(45) DEFAULT NULL,
  `citizenship` varchar(45) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `religion` varchar(45) DEFAULT NULL,
  `spouse` varchar(45) DEFAULT NULL,
  `spouse_occupation` varchar(45) DEFAULT NULL,
  `father` varchar(45) DEFAULT NULL,
  `father_occupation` varchar(45) DEFAULT NULL,
  `mother` varchar(45) DEFAULT NULL,
  `mother_occupation` varchar(45) DEFAULT NULL,
  `parent_address` varchar(45) DEFAULT NULL,
  `emergency_name` varchar(45) DEFAULT NULL,
  `emergency_contact` varchar(45) DEFAULT NULL,
  `project_name` varchar(45) DEFAULT NULL,
  `site_location` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `position_id`, `schedule_id`, `created_on`, `photo`, `fullname`, `address`, `email`, `phonenumber`, `birthdate`, `sex`, `position`, `civil_status`, `citizenship`, `height`, `weight`, `religion`, `spouse`, `spouse_occupation`, `father`, `father_occupation`, `mother`, `mother_occupation`, `parent_address`, `emergency_name`, `emergency_contact`, `project_name`, `site_location`) VALUES
(19, '358041762', 7, 23, '2019-09-02', 'b6.jpg', 'Juan D. Cruz', 'Virac, Catanduanes', 'sample@email.com', '09123456789', '2001-07-18', 'Male', '7', 'Single', 'Filipino', 175, 60, 'Roman Catholic', 'Juana Dela Cruz II', 'House Wife', 'Juan Cruz', 'Engineer', 'Juana Cruz', 'Teacher', 'Virac, Catanduanes', 'Juana Cruz', '09123456789', NULL, NULL),
(20, '058379612', 8, 24, '2019-09-03', '7.jpg', 'Evelyn  O. Camacho', 'Virac, Catanduanes', 'sample@email.com', '09123456789', '1999-09-20', 'Female', '8', 'Single', 'Filipino', 160, 50, 'Roman Catholic', 'Isaac Arcilla', 'Engineer', 'Juan Cruz', 'Mechanical Engineer', 'Juana Cruz', 'Professor', 'Virac, Catanduanes', 'Juana Cruz', '09123456789', 'CSU Dormitory', 'Calatagan, Virac, Catanduanes'),
(21, '017468523', 6, 23, '2019-09-03', '4.jpg', 'Isaac D. Arcilla', 'Virac, Catanduanes', 'isaacdarcilla@gmail.com', '09509342323', '2002-11-20', 'Male', '6', 'Single', 'American', 180, 60, 'Catholic', 'Jane A. Doe', 'Accountancy', 'Juan Cruz', 'Software Engineer', 'Juana Cruz', 'Doctor', 'Bato, Catanduanes', 'Juana Cruz', '09123456789', 'CSU Dormitory', 'Calatagan, Virac, Catanduanes'),
(22, '074215963', 9, 23, '2019-09-03', '8.jpg', 'Rodrigo R. Duterte', 'Pandan, Catanduanes', 'sample@email.com', '09123456789', '1999-11-15', 'Male', '9', 'Single', 'Filipino', 150, 70, 'Catholic', 'Juana Dela Cruz II', 'House Wife', 'Juan Cruz', 'Engineer', 'Juana Cruz', 'Teacher', 'Virac, Catanduanes', 'Juana Cruz', '09123456789', NULL, NULL),
(23, '908326751', 10, 24, '2019-09-15', '18.jpg', 'Jane A. Doe', 'Virac, Catanduanes', 'sample@email.com', '09123456789', '1999-01-30', 'Female', '10', 'Married', 'American', 180, 70, 'Catholic', 'Juan Dela Cruz II', 'Accountancy', 'Juan Cruz', 'Field Engineer', 'Juana Cruz', 'Scientist', 'Bato, Catanduanes', 'Juana Cruz', '09123456789', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `overtime_id` varchar(45) DEFAULT NULL,
  `hours` double DEFAULT NULL,
  `rate_hour` double DEFAULT NULL,
  `date_overtime` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overtime`
--

INSERT INTO `overtime` (`id`, `employee_id`, `overtime_id`, `hours`, `rate_hour`, `date_overtime`) VALUES
(11, 20, '4513620', 2.0333333333333, 32, '2019-09-11'),
(12, 22, '2306451', 2.5, 32, '2019-09-15'),
(13, 20, '4521603', 2.6666666666667, 100, '2019-09-15'),
(14, 20, '0632415', 2.05, 300, '2019-09-28'),
(15, 20, '3462105', 3, 350, '2019-10-08'),
(16, 20, '3062451', 2.05, 350, '2019-10-10'),
(17, 20, '5320146', 4.0333333333333, 350, '2019-10-09'),
(19, 19, '1623045', 3.0666666666667, 300, '2019-10-10'),
(22, 21, '4203651', 2, 250, '2019-11-26'),
(23, 21, '2635041', 0.066666666666667, 250, '2019-11-27'),
(25, 21, '0546231', 0.5, 250, '2019-11-23'),
(26, 21, '6051234', 2, 250, '2019-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `position_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `description`, `rate`, `position_id`) VALUES
(6, 'Web Developer', 250, '870256493'),
(7, 'Software Engineer', 500, '764089251'),
(8, 'Technical Support', 45, '095617348'),
(9, 'Interior Designer', 40, '243951067'),
(10, 'Timekeeper', 32, '463081975'),
(11, 'Mason', 35, '839401672');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `schedule_id` varchar(45) DEFAULT NULL,
  `time_in_morning` varchar(45) DEFAULT NULL,
  `time_out_morning` varchar(45) DEFAULT NULL,
  `time_in_afternoon` varchar(45) DEFAULT NULL,
  `time_out_afternoon` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `schedule_id`, `time_in_morning`, `time_out_morning`, `time_in_afternoon`, `time_out_afternoon`) VALUES
(23, '2503614', '07:30:00', '11:30:00', '01:00:00', '05:00:00'),
(24, '2034615', '07:00:00', '11:00:00', '01:00:00', '05:00:00'),
(25, '1036542', '08:00:00', '12:00:00', '01:00:00', '05:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barcode`
--
ALTER TABLE `barcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashadvance`
--
ALTER TABLE `cashadvance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `barcode`
--
ALTER TABLE `barcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cashadvance`
--
ALTER TABLE `cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
