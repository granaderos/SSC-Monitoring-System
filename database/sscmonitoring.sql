-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2016 at 08:57 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sscmonitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `logID` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `timeLogged` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(3) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`logID`, `userId`, `timeLogged`, `status`) VALUES
(1, 1, '2016-11-03 08:06:13', 'in'),
(2, 1, '2016-11-03 08:06:33', 'out'),
(3, 1, '2016-11-03 08:06:48', 'in'),
(4, 1, '2016-11-03 08:07:06', 'out'),
(5, 1, '2016-11-03 08:07:41', 'in'),
(6, 1, '2016-11-03 08:09:17', 'out'),
(7, 1, '2016-11-03 08:09:54', 'in'),
(8, 1, '2016-11-03 08:10:02', 'out'),
(9, 1, '2016-11-03 08:10:09', 'in'),
(10, 1, '2016-11-03 08:10:11', 'out'),
(11, 1, '2016-11-03 08:10:12', 'in'),
(12, 1, '2016-11-03 08:10:12', 'out'),
(13, 1, '2016-11-03 08:10:13', 'in'),
(14, 1, '2016-11-03 08:10:13', 'out'),
(15, 1, '2016-11-03 08:10:13', 'in'),
(16, 1, '2016-11-03 08:10:13', 'out'),
(17, 1, '2016-11-03 08:10:14', 'in'),
(18, 1, '2016-11-03 08:10:14', 'out'),
(19, 2, '2016-11-03 08:12:53', 'in'),
(20, 2, '2016-11-03 08:13:24', 'out'),
(21, 2, '2016-11-03 08:13:27', 'in'),
(22, 1, '2016-11-03 08:13:50', 'in'),
(23, 1, '2016-11-03 08:13:53', 'out'),
(24, 1, '2016-11-03 08:14:29', 'in'),
(25, 1, '2016-11-03 08:14:43', 'out'),
(26, 1, '2016-11-03 14:39:22', 'in'),
(27, 1, '2016-11-03 14:49:51', 'out'),
(28, 1, '2016-11-03 17:37:14', 'in'),
(29, 1, '2016-11-03 17:42:50', 'out'),
(30, 1, '2016-11-03 17:44:24', 'in'),
(31, 1, '2016-11-03 17:45:09', 'out'),
(32, 1, '2016-11-03 17:45:57', 'in'),
(33, 1, '2016-11-03 17:47:08', 'out'),
(34, 1, '2016-11-03 17:47:29', 'in'),
(35, 1, '2016-11-03 17:47:41', 'out'),
(36, 1, '2016-11-03 17:48:52', 'in'),
(37, 1, '2016-11-03 17:50:00', 'out'),
(38, 1, '2016-11-03 18:10:21', 'in'),
(39, 1, '2016-11-03 18:11:53', 'out'),
(40, 1, '2016-11-03 18:14:45', 'in'),
(41, 1, '2016-11-03 18:15:47', 'out'),
(42, 1, '2016-11-03 18:16:22', 'in'),
(43, 6, '2016-11-03 18:19:20', 'in'),
(44, 6, '2016-11-03 18:19:45', 'out'),
(45, 6, '2016-11-03 18:19:50', 'in'),
(46, 1, '2016-11-03 18:19:57', 'out'),
(47, 2, '2016-11-03 18:24:39', 'out'),
(48, 1, '2016-11-03 18:29:22', 'in'),
(49, 7, '2016-11-03 18:34:34', 'in'),
(50, 7, '2016-11-03 18:35:55', 'out'),
(51, 8, '2016-11-03 18:36:42', 'in'),
(52, 7, '2016-11-03 18:37:39', 'in'),
(53, 8, '2016-11-03 18:37:55', 'out'),
(54, 7, '2016-11-03 18:38:09', 'out'),
(55, 1, '2016-11-03 18:56:18', 'out'),
(56, 1, '2016-11-03 18:58:02', NULL),
(57, 8, '2016-11-03 18:58:34', 'in'),
(58, 8, '2016-11-03 18:59:51', 'out'),
(59, 8, '2016-11-03 19:01:32', 'in'),
(60, 8, '2016-11-03 19:02:00', 'out'),
(61, 1, '2016-11-03 19:02:13', 'in'),
(62, 1, '2016-11-03 19:02:18', 'out'),
(63, 7, '2016-11-03 19:04:23', 'in'),
(64, 7, '2016-11-03 19:04:33', 'out'),
(65, 1, '2016-11-03 19:07:20', 'in'),
(66, 7, '2016-11-03 19:07:25', 'in'),
(67, 8, '2016-11-03 19:07:31', 'in'),
(68, 8, '2016-11-03 19:07:31', 'out'),
(69, 7, '2016-11-03 19:08:39', 'out'),
(70, 1, '2016-11-03 19:09:29', 'out'),
(71, 8, '2016-11-03 19:13:11', 'in'),
(72, 7, '2016-11-03 19:13:18', 'in'),
(73, 2, '2016-11-03 19:13:35', 'in'),
(74, 1, '2016-11-03 19:15:20', 'in'),
(75, 8, '2016-11-03 19:15:25', 'out'),
(76, 1, '2016-11-03 19:17:57', 'out'),
(77, 8, '2016-11-03 19:19:13', 'in'),
(78, 7, '2016-11-03 19:19:19', 'out'),
(79, 2, '2016-11-03 19:19:41', 'out'),
(80, 1, '2016-11-03 19:20:12', 'in'),
(81, 6, '2016-11-03 19:20:25', 'out'),
(82, 6, '2016-11-03 19:21:53', 'in'),
(83, 1, '2016-11-03 19:21:58', 'out'),
(84, 8, '2016-11-03 19:22:31', 'out'),
(85, 7, '2016-11-03 19:22:57', 'in'),
(86, 1, '2016-11-03 19:51:05', 'in');

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE IF NOT EXISTS `officers` (
  `officerID` int(11) NOT NULL,
  `studentNumber` int(10) DEFAULT NULL,
  `code` varchar(25) DEFAULT NULL,
  `fullName` varchar(50) DEFAULT NULL,
  `type` varchar(5) DEFAULT NULL,
  `photo` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `officers`
--

INSERT INTO `officers` (`officerID`, `studentNumber`, `code`, `fullName`, `type`, `photo`) VALUES
(1, 1410613, 'granaderos', 'Marejean G. Perpinosa', 'SSC', '1.jpg'),
(2, 1410102, '1410102', 'Joshua Karlo De Leon', 'SSC', '0.JPG'),
(6, 12345, 'Mj', 'Mj Testing', 'SSC', '6.JPG'),
(7, 898989, 'qwer', 'Perpinosa Testing II', 'YLEAP', '7.JPG'),
(8, 123, 'this', 'this testing', 'SSC', '8.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `timerendered`
--

CREATE TABLE IF NOT EXISTS `timerendered` (
  `renderedID` int(11) NOT NULL,
  `officerID` int(11) DEFAULT NULL,
  `week` int(3) DEFAULT NULL,
  `timeRendered` varchar(11) DEFAULT NULL,
  `year` int(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timerendered`
--

INSERT INTO `timerendered` (`renderedID`, `officerID`, `week`, `timeRendered`, `year`) VALUES
(1, 1, 44, '10', 2016),
(2, 1, 44, '6', 2016),
(3, 1, 44, '1', 2016),
(4, 1, 44, '1', 2016),
(5, 1, 44, '0', 2016),
(6, 1, 44, '1', 2016),
(7, 1, 44, '2', 2016),
(8, 1, 44, '1', 2016),
(9, 6, 44, '0', 2016),
(10, 1, 44, '4', 2016),
(11, 2, 44, '611', 2016),
(12, 7, 44, '1', 2016),
(13, 8, 44, '1', 2016),
(14, 7, 44, '1', 2016),
(15, 1, 44, '27', 2016),
(16, 8, 44, '1', 2016),
(17, 8, 44, '0', 2016),
(18, 1, 44, '0', 2016),
(19, 7, 44, '0', 2016),
(20, 8, 44, '0', 2016),
(21, 7, 44, '1', 2016),
(22, 1, 44, '2', 2016),
(23, 8, 44, '2', 2016),
(24, 1, 44, '3', 2016),
(25, 7, 44, '6', 2016),
(26, 2, 44, '6', 2016),
(27, 6, 44, '61', 2016),
(28, 1, 44, '2', 2016),
(29, 8, 44, '3', 2016);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`logID`);

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`officerID`);

--
-- Indexes for table `timerendered`
--
ALTER TABLE `timerendered`
  ADD PRIMARY KEY (`renderedID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `officers`
--
ALTER TABLE `officers`
  MODIFY `officerID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `timerendered`
--
ALTER TABLE `timerendered`
  MODIFY `renderedID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
