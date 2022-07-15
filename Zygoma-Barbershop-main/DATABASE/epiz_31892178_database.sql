-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql312.epizy.com
-- Generation Time: Jun 19, 2022 at 06:19 AM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_31892178_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminusers`
--

CREATE TABLE `adminusers` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminusers`
--

INSERT INTO `adminusers` (`id`, `user_name`, `password`, `name`) VALUES
(1, 'admin', '123', 'admin'),
(2, 'john', 'abc', 'John');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `timeslot` varchar(255) NOT NULL,
  `status` enum('pending','done','cancel') NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `staff_id`, `date`, `timeslot`, `status`, `userid`) VALUES
(122, 21, '2022-06-17', '07:00AM - 08:00AM', 'cancel', 25),
(123, 22, '2022-06-19', '11:00AM - 12:00PM', 'pending', 26);

-- --------------------------------------------------------

--
-- Table structure for table `clientusers`
--

CREATE TABLE `clientusers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_login` varchar(255) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `isAvailable` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clientusers`
--

INSERT INTO `clientusers` (`id`, `email`, `password`, `name`, `last_login`, `type`, `isAvailable`) VALUES
(20, 'RobertAlbao@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Robert Albao', 'null', 'staff', 1),
(21, 'SanielCelso@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Saniel Celso', 'null', 'staff', 0),
(22, 'CarloBalean@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Carlo Balean', 'null', 'staff', 1),
(24, 'MarkBetito@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Mark Betito', 'null', 'staff', 1),
(25, 'lancedones17@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Lance Joseph P Dones', 'null', NULL, 1),
(26, 'ezekeiljohn@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Ezekeil', 'null', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contactdata`
--

CREATE TABLE `contactdata` (
  `id` int(11) NOT NULL,
  `firstname` varchar(55) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `message` text NOT NULL,
  `attachement` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `text`) VALUES
(27, 23, 'Your appoinment with appointment id 80 has been moved to 16:00PM - 17:00PM. Reason: gh'),
(28, 23, 'Your appoinment with appointment id 115 has been moved to 07:00AM - 08:00AM. Reason: pakyu'),
(29, 25, 'Your appoinment with appointment id 122 has been moved to 07:00AM - 08:00AM. Reason: unvailable'),
(30, 26, 'Your appoinment with appointment id 123 has been moved to 11:00AM - 12:00PM. Reason: fgdf');

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int(1) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_table`
--

INSERT INTO `review_table` (`review_id`, `user_name`, `user_rating`, `user_review`, `datetime`) VALUES
(1, 'dfg', 1, 'jhgjh', 1655402937),
(2, 'dfg', 5, 'jhgj', 1655402970);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(45) NOT NULL,
  `price` int(11) NOT NULL,
  `est_completion` int(11) DEFAULT NULL,
  `unit` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `price`, `est_completion`, `unit`) VALUES
(20, 'Hair Cut for Men ', 50, 20, 'minute'),
(21, 'Haircut for Women ', 60, 45, 'minute'),
(22, 'Hair Rebonding (Short)', 700, 480, 'hour'),
(23, 'Hair Rebonding (Regular)', 900, 480, 'hour'),
(24, 'Hair Rebonding (Long)', 1000, 480, 'hour'),
(25, 'Brazilian Blowout (Short)', 1200, 120, 'hour'),
(26, 'Brazilian Blowout (Regular)', 1300, 120, 'hour'),
(27, 'Brazilian Blowout (Long)', 1500, 120, 'hour'),
(28, 'Hair Spa', 200, 120, 'hour'),
(29, 'Hot Oil', 300, 30, 'minute'),
(30, 'Hair Dye (VShort)', 200, 360, 'hour'),
(31, 'Hair Dye (Short)', 400, 360, 'hour'),
(32, 'Hair Dye (Regular)', 600, 360, 'hour'),
(33, 'Hair Dye (Long)', 800, 360, 'hour');

-- --------------------------------------------------------

--
-- Table structure for table `service_booking`
--

CREATE TABLE `service_booking` (
  `booking_id` int(11) NOT NULL,
  `services_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_booking`
--

INSERT INTO `service_booking` (`booking_id`, `services_id`) VALUES
(25, 16),
(25, 17),
(25, 18),
(26, 16),
(26, 17),
(27, 16),
(27, 17),
(28, 16),
(28, 17),
(28, 18),
(28, 19),
(29, 16),
(29, 17),
(29, 18),
(29, 19),
(30, 16),
(30, 17),
(30, 18),
(31, 17),
(31, 18),
(31, 19),
(32, 17),
(32, 18),
(32, 19),
(33, 17),
(33, 19),
(34, 16),
(34, 17),
(34, 18),
(34, 19),
(35, 16),
(35, 19),
(36, 16),
(36, 18),
(37, 16),
(37, 17),
(37, 18),
(37, 19),
(38, 17),
(39, 17),
(39, 19),
(40, 22),
(41, 22),
(42, 24),
(43, 21),
(44, 20),
(45, 24),
(46, 24),
(47, 24),
(48, 24),
(49, 24),
(50, 23),
(51, 23),
(52, 23),
(53, 20),
(54, 23),
(55, 23),
(56, 23),
(57, 23),
(58, 23),
(59, 20),
(60, 20),
(61, 24),
(62, 24),
(63, 24),
(64, 22),
(65, 23),
(66, 23),
(67, 23),
(68, 23),
(69, 23),
(70, 23),
(71, 23),
(72, 23),
(73, 20),
(74, 22),
(74, 23),
(75, 21),
(76, 23),
(77, 23),
(78, 23),
(79, 23),
(80, 23),
(81, 23),
(82, 22),
(83, 22),
(84, 22),
(85, 22),
(86, 22),
(87, 22),
(88, 22),
(89, 22),
(90, 23),
(91, 23),
(92, 23),
(93, 23),
(94, 23),
(95, 22),
(96, 24),
(97, 23),
(98, 23),
(99, 23),
(100, 23),
(101, 23),
(102, 23),
(103, 23),
(104, 23),
(105, 23),
(106, 23),
(107, 23),
(108, 23),
(109, 22),
(110, 23),
(111, 25),
(112, 27),
(113, 31),
(114, 31),
(115, 25),
(116, 25),
(117, 27),
(118, 25),
(119, 25),
(120, 26),
(121, 27),
(122, 26),
(123, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientusers`
--
ALTER TABLE `clientusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactdata`
--
ALTER TABLE `contactdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `clientusers`
--
ALTER TABLE `clientusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `contactdata`
--
ALTER TABLE `contactdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
