-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2018 at 11:45 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gradecontrol`
--

-- --------------------------------------------------------

--
-- Table structure for table `acidsample`
--

CREATE TABLE IF NOT EXISTS `acidsample` (
`id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Prospect` varchar(10) NOT NULL,
  `Location` varchar(10) NOT NULL,
  `FromHoleID` varchar(10) NOT NULL,
  `ToHoleID` varchar(10) NOT NULL,
  `TotalHole` int(10) NOT NULL,
  `FromSample` varchar(10) NOT NULL,
  `ToSample` varchar(10) NOT NULL,
  `TotalSample` int(10) NOT NULL,
  `Remarks` varchar(50) DEFAULT NULL,
  `usrid` varchar(15) NOT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `augersample`
--

CREATE TABLE IF NOT EXISTS `augersample` (
`id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Prospect` varchar(10) NOT NULL,
  `Location` varchar(10) NOT NULL,
  `FromHoleID` varchar(10) NOT NULL,
  `ToHoleID` varchar(10) NOT NULL,
  `TotalHole` int(10) NOT NULL,
  `FromSample` varchar(10) NOT NULL,
  `ToSample` varchar(10) NOT NULL,
  `TotalSample` int(10) NOT NULL,
  `Remarks` varchar(50) DEFAULT NULL,
  `usrid` varchar(15) NOT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `boulder`
--

CREATE TABLE IF NOT EXISTS `boulder` (
`Id` int(10) NOT NULL,
  `Date` date NOT NULL,
  `Stockpile` varchar(20) DEFAULT NULL,
  `Volume` double NOT NULL,
  `Density` double NOT NULL,
  `Tonnes` varchar(20) DEFAULT NULL,
  `Au` varchar(10) DEFAULT NULL,
  `Ag` varchar(10) DEFAULT NULL,
  `AuEq75` double NOT NULL,
  `usrid` varchar(20) DEFAULT NULL,
  `recdate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `closingstock`
--

CREATE TABLE IF NOT EXISTS `closingstock` (
`id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Stockpile` int(3) NOT NULL,
  `Volume` varchar(10) NOT NULL,
  `Density` varchar(10) NOT NULL,
  `Tonnes` varchar(10) NOT NULL,
  `Au` varchar(10) NOT NULL,
  `Ag` varchar(10) NOT NULL,
  `AuEq75` varchar(10) DEFAULT NULL,
  `Class` varchar(15) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  `usrid` varchar(10) NOT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `closingstock`
--

INSERT INTO `closingstock` (`id`, `Date`, `Stockpile`, `Volume`, `Density`, `Tonnes`, `Au`, `Ag`, `AuEq75`, `Class`, `Status`, `usrid`, `recdate`) VALUES
(97, '2018-05-01', 3, '0', '0', '0', '0', '0', '0', '-', 'Complete', '', '2018-05-17 08:48:10'),
(98, '2018-05-02', 5, '29.125', '1.52', '44.27', '1.6', '81.13', '2.68', 'Medium Grade', 'Complete', '', '2018-05-17 09:16:26'),
(99, '2018-05-02', 9, '3152.94', '1.7', '5360', '1.7', '90.43', '2.91', 'Medium Grade', 'Complete', '', '2018-05-17 09:42:43'),
(100, '2018-05-02', 10, '621.071428', '1.68', '1043.4', '4.18', '131.56', '5.93', 'High Grade', 'Complete', '', '2018-05-17 09:17:08'),
(101, '2018-05-02', 13, '146.5', '1.2', '175.8', '0.49', '43.33', '1.07', 'Marginal', 'Complete', '', '2018-05-17 09:17:32'),
(102, '2018-04-30', 14, '536.070833', '1.68', '900.6', '1.99', '58.17', '2.77', 'Mid Grade', 'Pending', '', '2018-05-17 08:27:03'),
(103, '2018-05-02', 15, '108235.827', '1.68', '181836.19', '0.7', '31.26', '1.12', 'Marginal', 'Complete', '', '2018-05-17 09:18:07'),
(104, '2018-04-30', 17, '142.543107', '1.68', '239.47', '0.81', '43.16', '1.39', 'Marginal', 'Pending', '', '2018-05-17 08:28:03'),
(105, '2018-04-30', 23, '765507.236', '1.52', '1163571', '0.36', '11.28', '0.51', 'Waste', 'Pending', '', '2018-05-17 08:29:20'),
(106, '2018-05-02', 2, '194.312796', '2.11', '410', '2.85', '135.5', '4.66', 'High Grade', 'Pending', '', '2018-05-17 09:10:32');

-- --------------------------------------------------------

--
-- Table structure for table `closingstockgrade`
--

CREATE TABLE IF NOT EXISTS `closingstockgrade` (
`id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Stockpile` varchar(15) NOT NULL,
  `Tonnes` varchar(15) NOT NULL,
  `Au` varchar(11) NOT NULL,
  `Ag` varchar(11) NOT NULL,
  `AuEq75` varchar(20) NOT NULL,
  `Class` varchar(25) NOT NULL,
  `Status` varchar(15) DEFAULT NULL,
  `Volume` varchar(10) DEFAULT NULL,
  `Density` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `closingstockgrade`
--

INSERT INTO `closingstockgrade` (`id`, `Date`, `Stockpile`, `Tonnes`, `Au`, `Ag`, `AuEq75`, `Class`, `Status`, `Volume`, `Density`) VALUES
(178, '2018-04-30', '3', '223.13', '1.63', '37.53', '2.13', 'Mid Grade', NULL, '146.798245', '1.52'),
(179, '2018-04-30', '5', '195.47', '1.6', '81.13', '2.68', 'Mid Grade', NULL, '128.599905', '1.52'),
(180, '2018-04-30', '9', '5180', '1.72', '90.82', '2.93', 'Mid Grade', NULL, '3083.33333', '1.68'),
(181, '2018-04-30', '10', '2253', '4.18', '131.56', '5.93', 'High Grade', NULL, '1341.07142', '1.68'),
(182, '2018-04-30', '13', '1073.4', '0.49', '43.33', '1.07', 'Marginal', NULL, '894.5', '1.2'),
(183, '2018-04-30', '14', '900.6', '1.99', '58.17', '2.77', 'Mid Grade', NULL, '536.070833', '1.68'),
(184, '2018-04-30', '15', '183562.99', '0.7', '31.16', '1.11', 'Marginal', NULL, '109263.685', '1.68'),
(185, '2018-04-30', '17', '239.47', '0.81', '43.16', '1.39', 'Marginal', NULL, '142.543107', '1.68'),
(186, '2018-04-30', '23', '1163571', '0.36', '11.28', '0.51', 'Waste', NULL, '765507.236', '1.52'),
(187, '2018-05-02', '9', '5180', '1.72', '90.82', '2.93', 'Medium Grade', NULL, '2514.56', '2.06'),
(188, '2018-05-01', '15', '183187.39', '0.7', '31.26', '1.12', 'Marginal', NULL, '86818.6682', '2.11'),
(189, '2018-05-01', '3', '0', '0', '0', '0', '-', NULL, '0', '0'),
(190, '2018-05-01', '5', '116.27', '1.6', '81.13', '2.68', 'Medium Grade', NULL, '76.4934210', '1.52'),
(191, '2018-05-01', '10', '1379.4', '4.18', '131.56', '5.93', 'High Grade', NULL, '821.071428', '1.68'),
(192, '2018-05-01', '13', '684', '0.49', '43.33', '1.07', 'Marginal', NULL, '570', '1.2'),
(193, '2018-05-02', '9', '6351.2', '1.7', '90.37', '2.91', 'Medium Grade', NULL, '3053.46', '2.08'),
(194, '2018-05-02', '2', '410', '2.85', '135.5', '4.66', 'High Grade', NULL, '194.312796', '2.11'),
(195, '2018-05-02', '5', '44.27', '1.6', '81.13', '2.68', 'Medium Grade', NULL, '29.125', '1.52'),
(196, '2018-05-02', '10', '1043.4', '4.18', '131.56', '5.93', 'High Grade', NULL, '621.071428', '1.68'),
(197, '2018-05-02', '13', '175.8', '0.49', '43.33', '1.07', 'Marginal', NULL, '146.5', '1.2'),
(198, '2018-05-02', '15', '181836.19', '0.7', '31.26', '1.12', 'Marginal', NULL, '108235.827', '1.68');

-- --------------------------------------------------------

--
-- Table structure for table `facesample`
--

CREATE TABLE IF NOT EXISTS `facesample` (
`id` int(10) NOT NULL,
  `Date` date NOT NULL,
  `Prospect` varchar(10) NOT NULL,
  `Location` varchar(10) NOT NULL,
  `FromHoleID` varchar(10) DEFAULT NULL,
  `ToHoleID` varchar(10) DEFAULT NULL,
  `TotalHole` int(10) DEFAULT NULL,
  `FromSample` varchar(10) NOT NULL,
  `ToSample` varchar(10) NOT NULL,
  `TotalSample` int(10) NOT NULL,
  `Remarks` varchar(50) DEFAULT NULL,
  `usrid` varchar(15) NOT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grabsample`
--

CREATE TABLE IF NOT EXISTS `grabsample` (
`Id` int(10) NOT NULL,
  `Date` date NOT NULL,
  `Prospect` varchar(20) NOT NULL,
  `Location` varchar(20) NOT NULL,
  `FromGS` varchar(10) NOT NULL,
  `ToGS` varchar(10) NOT NULL,
  `TotalSample` int(10) NOT NULL,
  `Remarks` varchar(50) DEFAULT NULL,
  `usrid` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loader`
--

CREATE TABLE IF NOT EXISTS `loader` (
`id` int(11) NOT NULL,
  `Capacity` varchar(10) NOT NULL,
  `Density` varchar(10) NOT NULL,
  `Tonnage` varchar(10) NOT NULL,
  `Percentage` varchar(10) NOT NULL,
  `Tonnageper` varchar(10) NOT NULL,
  `Material` varchar(20) NOT NULL,
  `Equipment` varchar(40) NOT NULL,
  `usrid` varchar(20) NOT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loader`
--

INSERT INTO `loader` (`id`, `Capacity`, `Density`, `Tonnage`, `Percentage`, `Tonnageper`, `Material`, `Equipment`, `usrid`, `recdate`) VALUES
(22, '3.5', '2.1', '7.35', '0.85', '6.25', 'Fresh', 'Loader_F_Fresh_Feb', 'girlly.marchlina', '2018-03-02 14:17:50'),
(23, '3.5', '1.8', '6.30', '0.85', '5.35', 'Transisi', 'Loader_F_Trans_Feb', 'girlly.marchlina', '2018-03-03 02:38:58'),
(24, '3.5', '1.5', '5.25', '0.85', '4.46', 'Clay', 'Loader_F_Clay_Feb', 'girlly.marchlina', '2018-03-03 02:39:38'),
(25, '3.5', '1.5', '5.25', '0.935', '4.91', 'Clayfull', 'Loader_F_Clayfull_Feb', 'girlly.marchlina', '2018-03-03 02:40:14'),
(26, '3.5', '2.1', '7.35', '0.8075', '5.94', 'Bypass', 'Loader_F_Bypass_Feb', 'girlly.marchlina', '2018-03-03 02:40:53'),
(34, '4', '2.1', '8.40', '1', '8.40', 'Fresh', 'Loader_H_Fresh_Apr', 'yuni.kartika', '2018-04-04 10:57:33'),
(35, '4', '1.8', '7.20', '1', '7.20', 'Transisi', 'Loader_H_Trans_Apr', 'yuni.kartika', '2018-04-04 10:58:03'),
(36, '4', '1.5', '6.00', '1', '6.00', 'Clay', 'Loader_H_Clay_Apr', 'yuni.kartika', '2018-04-04 10:58:28'),
(37, '4', '1.5', '6.00', '1.1', '6.60', 'Clayfull', 'Loader_H_Clayfull_Apr', 'yuni.kartika', '2018-04-04 10:58:52'),
(38, '4', '2.1', '8.40', '0.95', '7.98', 'Bypass', 'Loader_H_Bypass_Apr', 'yuni.kartika', '2018-04-04 10:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
`Id` int(11) NOT NULL,
  `Nama` varchar(20) NOT NULL,
  `usrid` varchar(20) NOT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`Id`, `Nama`, `usrid`, `recdate`) VALUES
(1, 'BSW', 'yuni.kartika', '2017-10-15 03:38:16'),
(2, 'NK', 'yuni.kartika', '2017-10-15 03:39:43'),
(3, 'BCW', 'girlly.marchlina', '2018-01-20 01:21:08'),
(4, 'BWD', 'yuni.kartika', '2018-04-12 03:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `orefeed`
--

CREATE TABLE IF NOT EXISTS `orefeed` (
`id` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `Stockpile` int(3) NOT NULL,
  `Bucket` varchar(10) NOT NULL,
  `Volume` varchar(10) NOT NULL,
  `Density` varchar(10) NOT NULL,
  `Tonnes` varchar(10) NOT NULL,
  `Au` varchar(10) NOT NULL,
  `Ag` varchar(10) NOT NULL,
  `AuEq75` varchar(10) DEFAULT NULL,
  `Class` varchar(15) DEFAULT NULL,
  `AdjAu` varchar(10) DEFAULT NULL,
  `AdjAg` varchar(10) DEFAULT NULL,
  `AdjAuPersen` varchar(10) DEFAULT NULL,
  `AdjAgPersen` varchar(10) DEFAULT NULL,
  `Loader` varchar(50) NOT NULL,
  `Material` varchar(20) DEFAULT NULL,
  `Percentage` varchar(5) DEFAULT NULL,
  `Tonnestocrush` varchar(10) DEFAULT NULL,
  `Act` varchar(25) DEFAULT NULL,
  `Remarks` varchar(15) DEFAULT NULL,
  `Note` varchar(1000) DEFAULT NULL,
  `Shift` varchar(5) DEFAULT NULL,
  `Type` varchar(10) DEFAULT NULL,
  `usrid` varchar(20) DEFAULT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orefeed`
--

INSERT INTO `orefeed` (`id`, `Date`, `Stockpile`, `Bucket`, `Volume`, `Density`, `Tonnes`, `Au`, `Ag`, `AuEq75`, `Class`, `AdjAu`, `AdjAg`, `AdjAuPersen`, `AdjAgPersen`, `Loader`, `Material`, `Percentage`, `Tonnestocrush`, `Act`, `Remarks`, `Note`, `Shift`, `Type`, `usrid`, `recdate`) VALUES
(101, '2018-05-01', 3, '35', '146.80', '1.52', '0.0000', '1.63', '37.53', '2.13', 'Medium Grade', '1.30', '30.02', '80%', '80%', 'Loader_H_Trans_Apr', 'Transisi', '1', '223.1300', '-28.87', '', '', '', 'Oremill', 'yuni.kartika', '2018-05-17 08:48:10'),
(102, '2018-05-01', 5, '11', '128.60', '1.52', '116.2700', '1.6', '81.13', '2.68', 'Medium Grade', '1.92', '121.69', '120%', '150%', 'Loader_H_Trans_Apr', 'Transisi', '1', '79.2000', '', '', '', '', 'Oremill', 'yuni.kartika', '2018-05-17 08:48:25'),
(103, '2018-05-01', 10, '104', '1341.07', '1.68', '1379.4000', '4.18', '131.56', '5.93', 'High Grade', '2.30', '78.94', '55%', '60%', 'Loader_H_Fresh_Apr', 'Fresh', '1', '873.6000', '', '', '', '', 'Oremill', 'yuni.kartika', '2018-05-17 08:48:43'),
(104, '2018-05-01', 13, '59', '894.50', '1.20', '684.0000', '0.49', '43.33', '1.07', 'Marginal', '0.29', '30.33', '60%', '70%', 'Loader_H_Clayfull_Apr', 'Clayfull', '1.1', '389.4000', '', '', '', '', 'Oremill', 'yuni.kartika', '2018-05-17 08:49:53'),
(105, '2018-05-01', 15, '102', '109838.43', '1.68', '183756.190', '0.7', '31.26', '1.12', 'Marginal', '0.52', '25.01', '75%', '80%', 'Loader_H_Fresh_Apr', 'Fresh', '1', '856.8000', '', '', '', '', 'Oremill', 'yuni.kartika', '2018-05-17 08:50:10'),
(106, '2018-05-01', 15, '79', '109378.68', '1.68', '183187.390', '0.7', '31.26', '1.12', 'Marginal', '0.52', '25.01', '75%', '80%', 'Loader_H_Trans_Apr', 'Transisi', '1', '568.8000', '', '', '', '', 'Oremill', 'yuni.kartika', '2018-05-17 08:50:28'),
(107, '2018-05-02', 5, '10', '76.49', '1.52', '44.2700', '1.6', '81.13', '2.68', 'Medium Grade', '1.92', '121.69', '120%', '150%', 'Loader_H_Trans_Apr', 'Transisi', '1', '72.0000', '', '', '', '', 'Oremill', 'yuni.kartika', '2018-05-17 09:16:26'),
(109, '2018-05-02', 10, '40', '821.07', '1.68', '1043.4000', '4.18', '131.56', '5.93', 'High Grade', '1.88', '59.20', '45%', '45%', 'Loader_H_Fresh_Apr', 'Fresh', '1', '336.0000', '', '', '', '', 'Oremill', 'yuni.kartika', '2018-05-17 09:17:08'),
(110, '2018-05-02', 13, '77', '570.00', '1.20', '175.8000', '0.49', '43.33', '1.07', 'Marginal', '0.29', '30.33', '60%', '70%', 'Loader_H_Clayfull_Apr', 'Clayfull', '1.1', '508.2000', '', '', '', '', 'Oremill', 'yuni.kartika', '2018-05-17 09:17:32'),
(111, '2018-05-02', 15, '58', '109040.11', '1.68', '182700.190', '0.7', '31.26', '1.12', 'Marginal', '0.52', '25.01', '75%', '80%', 'Loader_H_Fresh_Apr', 'Fresh', '1', '487.2000', '', '', '', '', 'Oremill', 'yuni.kartika', '2018-05-17 09:17:52'),
(112, '2018-05-02', 15, '120', '108750.11', '1.68', '181836.190', '0.7', '31.26', '1.12', 'Marginal', '0.52', '25.01', '75%', '80%', 'Loader_H_Trans_Apr', 'Transisi', '1', '864.0000', '', '', '', '', 'Oremill', 'yuni.kartika', '2018-05-17 09:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `oreinventory`
--

CREATE TABLE IF NOT EXISTS `oreinventory` (
`id` int(11) NOT NULL,
  `Pit` int(3) NOT NULL,
  `Block` varchar(40) NOT NULL,
  `RL` varchar(50) NOT NULL,
  `Type` varchar(25) DEFAULT NULL,
  `Au` varchar(20) NOT NULL,
  `Ag` varchar(20) NOT NULL,
  `AuEq75` varchar(10) DEFAULT NULL,
  `Class` varchar(20) DEFAULT NULL,
  `Dbdensity` varchar(15) DEFAULT NULL,
  `DryTonBM` varchar(15) DEFAULT NULL,
  `DryTonFF` varchar(10) NOT NULL,
  `Start` date NOT NULL,
  `Finish` date DEFAULT NULL,
  `StartHour` varchar(5) NOT NULL,
  `FinishHour` varchar(5) DEFAULT NULL,
  `Stockpile` varchar(15) DEFAULT NULL,
  `Value` varchar(15) NOT NULL,
  `Status` varchar(15) NOT NULL,
  `Achievement` varchar(10) NOT NULL,
  `Density` varchar(10) DEFAULT NULL,
  `Note` varchar(1000) DEFAULT NULL,
  `usrid` varchar(20) NOT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oreinventory`
--

INSERT INTO `oreinventory` (`id`, `Pit`, `Block`, `RL`, `Type`, `Au`, `Ag`, `AuEq75`, `Class`, `Dbdensity`, `DryTonBM`, `DryTonFF`, `Start`, `Finish`, `StartHour`, `FinishHour`, `Stockpile`, `Value`, `Status`, `Achievement`, `Density`, `Note`, `usrid`, `recdate`) VALUES
(134, 11, 'stockpile_A2', '40', 'Ore', '1.63', '37.53', '2.13', 'Medium Grade', '1.9', '223.13', '223.133333', '2018-04-30', '2018-04-30', '06:00', '12:00', '3', 'Final Figure', 'Completed', '100.0', '1.9', '', 'yuni.kartika', '2018-05-17 08:24:01'),
(135, 1, 'stockpile_B2', '-20;35', 'Ore', '1.60', '81.13', '2.68', 'Medium Grade', '1.9', '195.47', '195.471857', '2018-04-30', '2018-04-30', '07:00', '12:00', '5', 'Final Figure', 'Completed', '100.0', '1.9', '', 'yuni.kartika', '2018-05-17 08:24:38'),
(136, 10, 'stockpile_D2', '-20', 'Ore', '1.72', '90.82', '2.93', 'Medium Grade', '2.1', '5180', '5180', '2018-04-30', '2018-04-30', '09:00', '12:00', '9', 'Final Figure', 'Completed', '100.0', '2.1', '', 'yuni.kartika', '2018-05-17 08:25:13'),
(137, 8, 'stockpile_E1', '-70', 'Ore', '4.18', '131.56', '5.93', 'High Grade', '2.1', '2253', '2253', '2018-04-30', '2018-04-30', '07:00', '09:00', '10', 'Final Figure', 'Completed', '100.0', '2.1', '', 'yuni.kartika', '2018-05-17 08:25:41'),
(138, 11, 'stockpile_G', '40', 'Ore', '0.49', '43.33', '1.07', 'Marginal', '1.5', '1073.4', '1073.4', '2018-04-30', '2018-04-30', '09:00', '12:00', '13', 'Final Figure', 'Completed', '100.0', '1.5', '', 'yuni.kartika', '2018-05-17 08:26:23'),
(139, 9, 'stockpile_H', '-15;-20;30', 'Ore', '1.99', '58.17', '2.77', 'Medium Grade', '2.1', '900.6', '900.599', '2018-04-30', '2018-04-30', '07:00', '08:00', '14', 'Final Figure', 'Completed', '100.0', '2.1', '', 'yuni.kartika', '2018-05-17 08:27:03'),
(140, 9, 'stockpile_I', '-30;-20;0', 'Ore', '0.70', '31.16', '1.12', 'Marginal', '2.1', '183562.99', '183562.992', '2018-04-30', '2018-04-30', '06:00', '19:00', '15', 'Final Figure', 'Completed', '100.0', '2.1', '', 'yuni.kartika', '2018-05-17 08:27:36'),
(141, 9, 'stockpile_J2', '-25', 'Ore', '0.81', '43.16', '1.39', 'Marginal', '2.1', '239.47', '239.47242', '2018-04-30', '2018-04-30', '07:00', '09:00', '17', 'Final Figure', 'Completed', '100.0', '2.1', '', 'yuni.kartika', '2018-05-17 08:28:03'),
(142, 6, 'Maspur', '88', 'Mineralized Waste', '0.362696307', '11.281562', '0.51', 'Min.Waste', '1.9', '1163571', '1163571', '2018-04-30', '2018-04-30', '07:00', '09:00', '23', 'Final Figure', 'Completed', '100', '1.9', '', 'yuni.kartika', '2018-05-17 08:29:20'),
(143, 10, 'bwd_st2_-20b_-17p5_03', '-17.5', 'Ore', '1.22', '79.17', '2.28', 'Medium Grade', '2.64', '460.5', '180', '2018-05-01', NULL, '06:53', NULL, '9', 'Block Model', 'Continue', '39.1', '2.64', '', 'yuni.kartika', '2018-05-17 08:30:42'),
(144, 10, 'bwd_st2_-20b_-17p5_04', '-17.5', 'Ore', '1.03', '52.66', '1.73', 'Marginal', '2.64', '1493.83', '690', '2018-05-01', '2018-05-01', '07:27', '09:44', '15', 'Block Model', 'Completed', '46.2', '2.64', 'rl atasnya undercut 1-1.2m, heavenya (tunggu data heave survey)', 'yuni.kartika', '2018-05-17 08:31:35'),
(145, 10, 'bwd_st2_-20ramp', '-17.5', 'Visual', '0.3', '40', '0.83', 'Marginal', '2.64', '30', '30', '2018-05-01', '2018-05-01', '13:17', '13:17', '15', 'Final Figure', 'Completed', '100', '2.64', '', 'yuni.kartika', '2018-05-17 08:32:19'),
(146, 10, 'bwd_st2_-20b', '-17.5', 'Visual', '0.3', '40', '0.83', 'Marginal', '2.64', '330', '330', '2018-05-01', '2018-05-02', '19:28', '02:25', '15', 'Final Figure', 'Completed', '100', '2.64', '', 'yuni.kartika', '2018-05-17 08:33:17'),
(149, 10, 'bwd_st2_-20b_-17p5_01', '-17.5', 'Ore', '2.85', '135.5', '4.66', 'High Grade', '2.64', '427.26', '410', '2018-05-02', NULL, '18:44', NULL, '2', 'Block Model', 'Continue', '96.0', '2.64', '', 'yuni.kartika', '2018-05-17 09:10:32');

-- --------------------------------------------------------

--
-- Table structure for table `oreinventorygeneral`
--

CREATE TABLE IF NOT EXISTS `oreinventorygeneral` (
`id` int(11) NOT NULL,
  `Pit` int(3) NOT NULL,
  `Block` varchar(40) NOT NULL,
  `RL` varchar(50) NOT NULL,
  `Type` varchar(25) DEFAULT NULL,
  `Au` varchar(20) NOT NULL,
  `Ag` varchar(20) NOT NULL,
  `AuEq75` varchar(10) DEFAULT NULL,
  `Class` varchar(20) DEFAULT NULL,
  `Dbdensity` varchar(15) DEFAULT NULL,
  `DryTonBM` varchar(15) DEFAULT NULL,
  `DryTonFF` varchar(10) NOT NULL,
  `Start` date NOT NULL,
  `Finish` date DEFAULT NULL,
  `StartHour` varchar(5) NOT NULL,
  `FinishHour` varchar(5) DEFAULT NULL,
  `Stockpile` varchar(15) DEFAULT NULL,
  `Value` varchar(15) NOT NULL,
  `Status` varchar(15) NOT NULL,
  `Achievement` varchar(10) NOT NULL,
  `Density` varchar(10) DEFAULT NULL,
  `Note` varchar(1000) DEFAULT NULL,
  `usrid` varchar(20) NOT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oreinventorygeneral`
--

INSERT INTO `oreinventorygeneral` (`id`, `Pit`, `Block`, `RL`, `Type`, `Au`, `Ag`, `AuEq75`, `Class`, `Dbdensity`, `DryTonBM`, `DryTonFF`, `Start`, `Finish`, `StartHour`, `FinishHour`, `Stockpile`, `Value`, `Status`, `Achievement`, `Density`, `Note`, `usrid`, `recdate`) VALUES
(125, 11, 'stockpile_A2', '40', 'Ore', '1.63', '37.53', '2.13', 'Mid Grade', '1.9', '223.13', '223.133333', '2018-04-30', '2018-04-30', '06:00', '12:00', '3', 'Final Figure', 'Completed', '100.0', '1.9', '', 'yuni.kartika', '2018-05-17 08:24:01'),
(126, 1, 'stockpile_B2', '-20;35', 'Ore', '1.60', '81.13', '2.68', 'Mid Grade', '1.9', '195.47', '195.471857', '2018-04-30', '2018-04-30', '07:00', '12:00', '5', 'Final Figure', 'Completed', '100.0', '1.9', '', 'yuni.kartika', '2018-05-17 08:24:38'),
(127, 10, 'stockpile_D2', '-20', 'Ore', '1.72', '90.82', '2.93', 'Mid Grade', '2.1', '5180', '5180', '2018-04-30', '2018-04-30', '09:00', '12:00', '9', 'Final Figure', 'Completed', '100.0', '2.1', '', 'yuni.kartika', '2018-05-17 08:25:13'),
(128, 8, 'stockpile_E1', '-70', 'Ore', '4.18', '131.56', '5.93', 'High Grade', '2.1', '2253', '2253', '2018-04-30', '2018-04-30', '07:00', '09:00', '10', 'Final Figure', 'Completed', '100.0', '2.1', '', 'yuni.kartika', '2018-05-17 08:25:41'),
(129, 11, 'stockpile_G', '40', 'Ore', '0.49', '43.33', '1.07', 'Marginal', '1.5', '1073.4', '1073.4', '2018-04-30', '2018-04-30', '09:00', '12:00', '13', 'Final Figure', 'Completed', '100.0', '1.5', '', 'yuni.kartika', '2018-05-17 08:26:23'),
(130, 9, 'stockpile_H', '-15;-20;30', 'Ore', '1.99', '58.17', '2.77', 'Mid Grade', '2.1', '900.6', '900.599', '2018-04-30', '2018-04-30', '07:00', '08:00', '14', 'Final Figure', 'Completed', '100.0', '2.1', '', 'yuni.kartika', '2018-05-17 08:27:03'),
(131, 9, 'stockpile_I', '-30;-20;0', 'Ore', '0.70', '31.16', '1.12', 'Marginal', '2.1', '183562.99', '183562.992', '2018-04-30', '2018-04-30', '06:00', '19:00', '15', 'Final Figure', 'Completed', '100.0', '2.1', '', 'yuni.kartika', '2018-05-17 08:27:36'),
(132, 9, 'stockpile_J2', '-25', 'Ore', '0.81', '43.16', '1.39', 'Marginal', '2.1', '239.47', '239.47242', '2018-04-30', '2018-04-30', '07:00', '09:00', '17', 'Final Figure', 'Completed', '100.0', '2.1', '', 'yuni.kartika', '2018-05-17 08:28:03'),
(133, 6, 'Maspur', '88', 'Mineralized Waste', '0.362696307', '11.281562', '0.51', 'Waste', '1.9', '1163571', '1163571', '2018-04-30', '2018-04-30', '07:00', '09:00', '23', 'Final Figure', 'Completed', '100', '1.9', '', 'yuni.kartika', '2018-05-17 08:29:20'),
(134, 10, 'bwd_st2_-20b_-17p5_03', '-17.5 ', 'Ore', '1.22', '79.17', '2.28', 'Mid Grade', '2.64', '460.5', '320', '2018-05-01', NULL, '18:17', NULL, '9', 'Block Model', 'Continue', '69.5', '2.64', '', 'yuni.kartika', '2018-05-17 09:09:47'),
(135, 10, 'bwd_st2_-20b_-17p5_04', '-17.5', 'Ore', '1.03', '52.66', '1.73', 'Marginal', '2.64', '1493.83', '690', '2018-05-01', '2018-05-01', '07:27', '09:44', '15', 'Block Model', 'Completed', '46.2', '2.64', 'rl atasnya undercut 1-1.2m, heavenya (tunggu data heave survey)', 'yuni.kartika', '2018-05-17 08:31:35'),
(136, 10, 'bwd_st2_-20ramp', '-17.5', 'Visual', '0.3', '40', '0.83', 'Marginal', '2.64', '30', '30', '2018-05-01', '2018-05-01', '13:17', '13:17', '15', 'Final Figure', 'Completed', '100', '2.64', '', 'yuni.kartika', '2018-05-17 08:32:19'),
(137, 10, 'bwd_st2_-20b', '-17.5', 'Visual', '0.3', '40', '0.83', 'Marginal', '2.64', '330', '330', '2018-05-01', '2018-05-02', '19:28', '02:25', '15', 'Final Figure', 'Completed', '100', '2.64', '', 'yuni.kartika', '2018-05-17 08:33:17'),
(138, 10, 'bwd_-15a_-15_01', '-15', 'Ore', '2.59', '80.43', '3.66', 'Mid Grade', '2.6', '153.17', '60', '2018-05-02', NULL, '09:56', NULL, '9', 'Block Model', 'Continue', '39.2', '2.6', '', 'yuni.kartika', '2018-05-17 09:08:32'),
(139, 10, 'bwd_st2_-20b_-17p5_01', '-17.5', 'Ore', '2.85', '135.5', '4.66', 'High Grade', '2.64', '427.26', '410', '2018-05-02', NULL, '18:44', NULL, '2', 'Block Model', 'Continue', '96.0', '2.64', '', 'yuni.kartika', '2018-05-17 09:10:32');

-- --------------------------------------------------------

--
-- Table structure for table `oreline`
--

CREATE TABLE IF NOT EXISTS `oreline` (
`id` int(50) NOT NULL,
  `File` varchar(50) NOT NULL,
  `pit` int(3) NOT NULL,
  `Volume` varchar(10) NOT NULL,
  `Tonnes` varchar(10) NOT NULL,
  `Au` varchar(10) NOT NULL,
  `Ag` varchar(10) NOT NULL,
  `Aueq` varchar(10) NOT NULL,
  `Class` varchar(20) NOT NULL,
  `Dbdensity` varchar(10) NOT NULL,
  `Partial` varchar(10) NOT NULL,
  `Actual` varchar(10) NOT NULL,
  `status` varchar(15) DEFAULT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usrid` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oreline`
--

INSERT INTO `oreline` (`id`, `File`, `pit`, `Volume`, `Tonnes`, `Au`, `Ag`, `Aueq`, `Class`, `Dbdensity`, `Partial`, `Actual`, `status`, `recdate`, `usrid`) VALUES
(35, 'stockpile_A2', 11, '117.44', '223.13', '1.63', '37.53', '2.13', 'Mid Grade', '1.9', '1', '223.13', 'Completed', '2018-05-17 08:24:01', 'yuni.kartika'),
(36, 'stockpile_B2', 1, '102.88', '195.47', '1.6', '81.13', '2.68', 'Mid Grade', '1.9', '1', '195.47', 'Completed', '2018-05-17 08:24:38', 'yuni.kartika'),
(37, 'stockpile_D2', 10, '2466.67', '5180', '1.72', '90.82', '2.93', 'Mid Grade', '2.1', '1', '5180', 'Completed', '2018-05-17 08:25:13', 'yuni.kartika'),
(38, 'stockpile_E1', 8, '1072.86', '2253', '4.18', '131.56', '5.93', 'High Grade', '2.1', '1', '2253', 'Completed', '2018-05-17 08:25:40', 'yuni.kartika'),
(39, 'stockpile_G', 11, '715.6', '1073.4', '0.49', '43.33', '1.07', 'Marginal', '1.5', '1', '1073.4', 'Completed', '2018-05-17 08:26:23', 'yuni.kartika'),
(40, 'stockpile_H', 9, '428.86', '900.6', '1.99', '58.17', '2.77', 'Mid Grade', '2.1', '1', '900.6', 'Completed', '2018-05-17 08:27:03', 'yuni.kartika'),
(41, 'stockpile_I', 9, '87410.95', '183562.99', '0.7', '31.16', '1.11', 'Marginal', '2.1', '1', '183562.99', 'Completed', '2018-05-17 08:27:36', 'yuni.kartika'),
(42, 'stockpile_J2', 9, '114.03', '239.47', '0.81', '43.16', '1.39', 'Marginal', '2.1', '1', '239.47', 'Completed', '2018-05-17 08:28:03', 'yuni.kartika'),
(43, 'stockpile_maspur', 6, '612405.79', '1163571', '0.36', '11.28', '0.51', 'Waste', '1.9', '1', '1163571', 'Continue', '2018-05-14 07:15:20', 'yuni.kartika'),
(44, 'bwd_st2_-20b_-17p5_03', 10, '187.5', '495.16', '1.22', '79.17', '2.28', 'Mid Grade', '2.64', '0.93', '460.5', 'Continue', '2018-05-14 08:10:44', 'yuni.kartika'),
(45, 'bwd_st2_-20b_-17p5_04', 10, '577.39', '1524.32', '1.03', '52.66', '1.73', 'Marginal', '2.64', '0.98', '1493.83', 'Completed', '2018-05-17 08:31:35', 'yuni.kartika'),
(48, 'bwd_-15a_-15_01', 10, '62.01', '161.23', '2.59', '80.43', '3.66', 'Mid Grade', '2.6', '0.95', '153.17', 'Continue', '2018-05-16 04:49:45', 'yuni.kartika'),
(49, 'bwd_st2_-20b_-17p5_01', 10, '171.88', '454.53', '2.85', '135.5', '4.66', 'High Grade', '2.64', '0.94', '427.26', 'Continue', '2018-05-16 04:49:50', 'yuni.kartika');

-- --------------------------------------------------------

--
-- Table structure for table `oremined`
--

CREATE TABLE IF NOT EXISTS `oremined` (
`id` int(11) NOT NULL,
  `Block` varchar(50) NOT NULL,
  `RL` varchar(10) DEFAULT NULL,
  `Au` varchar(10) DEFAULT NULL,
  `Ag` varchar(10) DEFAULT NULL,
  `DryTon` varchar(10) DEFAULT NULL,
  `Density` varchar(10) DEFAULT NULL,
  `TruckTally` varchar(10) NOT NULL,
  `Stockpile` int(3) NOT NULL,
  `Date` date NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Remarks` varchar(15) NOT NULL,
  `Note` varchar(50) DEFAULT NULL,
  `usrid` varchar(20) NOT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pit`
--

CREATE TABLE IF NOT EXISTS `pit` (
`id` int(11) NOT NULL,
  `Nama` varchar(40) NOT NULL,
  `usrid` varchar(20) NOT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pit`
--

INSERT INTO `pit` (`id`, `Nama`, `usrid`, `recdate`) VALUES
(1, 'North Kuning', 'gradecontrol', '2017-09-05 01:56:34'),
(2, 'Bakam', 'anti.dwi', '2017-09-06 18:54:58'),
(3, 'North Bakam', 'anti.dwi', '2017-09-06 18:55:06'),
(5, 'Bakam Central West', 'girlly.marchlina', '2018-01-20 00:58:11'),
(6, 'Maspur', 'girlly.marchlina', '2018-01-21 02:23:41'),
(7, 'Kuning', 'josua.christanto', '2018-02-26 23:52:31'),
(8, 'Bakam South West', 'girlly.marchlina', '2018-03-02 09:54:54'),
(9, 'All Pit', 'girlly.marchlina', '2018-03-02 09:54:58'),
(10, 'Bakam West Deep', 'girlly.marchlina', '2018-04-18 09:48:38'),
(11, 'North Kuning Extension', 'girlly.marchlina', '2018-04-18 09:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `prospect`
--

CREATE TABLE IF NOT EXISTS `prospect` (
`Id` int(11) NOT NULL,
  `Nama` varchar(20) NOT NULL,
  `usrid` varchar(20) NOT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prospect`
--

INSERT INTO `prospect` (`Id`, `Nama`, `usrid`, `recdate`) VALUES
(1, 'Bakam', 'anti.dwi', '2017-09-17 18:18:10'),
(2, 'Kuning', 'anti.dwi', '2017-09-17 18:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `rcdrilling`
--

CREATE TABLE IF NOT EXISTS `rcdrilling` (
`id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Prospect` varchar(10) NOT NULL,
  `Location` varchar(10) NOT NULL,
  `Drill` varchar(10) NOT NULL,
  `FromHoleID` varchar(10) NOT NULL,
  `ToHoleID` varchar(10) NOT NULL,
  `TotalHole` int(10) NOT NULL,
  `FromSample` varchar(10) NOT NULL,
  `ToSample` varchar(10) NOT NULL,
  `TotalSample` int(10) NOT NULL,
  `TotalMeter` int(10) NOT NULL,
  `Remarks` varchar(50) DEFAULT NULL,
  `usrid` varchar(20) NOT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scat`
--

CREATE TABLE IF NOT EXISTS `scat` (
`Id` int(10) NOT NULL,
  `Date` date NOT NULL,
  `Stockpile` varchar(20) DEFAULT NULL,
  `Volume` double NOT NULL,
  `Density` double NOT NULL,
  `Tonnes` varchar(20) DEFAULT NULL,
  `Au` varchar(10) DEFAULT NULL,
  `Ag` varchar(10) DEFAULT NULL,
  `AuEq75` double NOT NULL,
  `usrid` varchar(20) DEFAULT NULL,
  `recdate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stockpile`
--

CREATE TABLE IF NOT EXISTS `stockpile` (
`id` int(4) NOT NULL,
  `Nama` varchar(20) NOT NULL,
  `usrid` varchar(20) NOT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockpile`
--

INSERT INTO `stockpile` (`id`, `Nama`, `usrid`, `recdate`) VALUES
(2, 'A1', 'gradecontrol', '2017-09-07 02:36:44'),
(3, 'A2', 'gradecontrol', '2017-09-07 02:36:51'),
(4, 'B1', 'gradecontrol', '2017-09-07 02:36:54'),
(5, 'B2', 'gradecontrol', '2017-09-07 02:36:57'),
(6, 'C1', 'gradecontrol', '2017-09-07 02:37:00'),
(7, 'C2', 'gradecontrol', '2017-09-07 02:37:03'),
(8, 'D1', 'gradecontrol', '2017-09-07 02:37:06'),
(9, 'D2', 'gradecontrol', '2017-09-07 02:37:09'),
(10, 'E1', 'gradecontrol', '2017-09-07 02:37:11'),
(11, 'E2', 'gradecontrol', '2017-09-07 02:37:14'),
(12, 'F', 'gradecontrol', '2017-09-07 02:37:17'),
(13, 'G', 'gradecontrol', '2017-09-07 02:37:20'),
(14, 'H', 'gradecontrol', '2017-09-07 02:37:31'),
(15, 'I', 'gradecontrol', '2017-09-07 02:37:34'),
(16, 'J1', 'gradecontrol', '2017-09-07 02:37:42'),
(17, 'J2', 'gradecontrol', '2017-09-07 02:37:46'),
(18, 'K', 'gradecontrol', '2017-09-07 02:37:59'),
(20, 'Scat', 'josua.christanto', '2017-09-09 14:40:44'),
(22, 'Boulder', 'girlly.marchlina', '2018-01-20 03:45:35'),
(23, 'MW', 'girlly.marchlina', '2018-01-20 04:39:20');

-- --------------------------------------------------------

--
-- Table structure for table `stockpilesample`
--

CREATE TABLE IF NOT EXISTS `stockpilesample` (
`id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `FromST` varchar(20) NOT NULL,
  `ToST` int(20) NOT NULL,
  `TotalSample` int(10) NOT NULL,
  `Remarks` varchar(50) DEFAULT NULL,
  `usrid` varchar(20) DEFAULT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tostockpile`
--

CREATE TABLE IF NOT EXISTS `tostockpile` (
`id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Stockpile` varchar(10) NOT NULL,
  `RL` varchar(20) NOT NULL,
  `Volume` varchar(20) NOT NULL,
  `Density` varchar(20) NOT NULL,
  `Tonnes` varchar(20) NOT NULL,
  `Au` varchar(20) NOT NULL,
  `Ag` varchar(20) NOT NULL,
  `AuEq75` varchar(10) DEFAULT NULL,
  `Class` varchar(15) DEFAULT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tostockpile`
--

INSERT INTO `tostockpile` (`id`, `Date`, `Stockpile`, `RL`, `Volume`, `Density`, `Tonnes`, `Au`, `Ag`, `AuEq75`, `Class`, `recdate`) VALUES
(97, '2018-05-01', '3', '40', '0', '0', '0', '0', '0', '0', '-', '2018-05-17 08:48:10'),
(98, '2018-05-02', '5', '-20;35', '29.13', '1.52', '44.27', '1.6', '81.13', '2.68', 'Medium Grade', '2018-05-17 09:16:26'),
(99, '2018-05-02', '9', '-17.5 ', '3308.64', '1.59', '5360', '1.7', '90.43', '2.91', 'Medium Grade', '2018-05-17 09:42:42'),
(100, '2018-05-02', '10', '-70', '621.07', '1.68', '1043.4', '4.18', '131.56', '5.93', 'High Grade', '2018-05-17 09:17:08'),
(101, '2018-05-02', '13', '40', '146.5', '1.2', '175.8', '0.49', '43.33', '1.07', 'Marginal', '2018-05-17 09:17:32'),
(102, '2018-04-30', '14', '-15;-20;30', '536.07', '1.68', '900.6', '1.99', '58.17', '2.77', 'Medium Grade', '2018-05-17 08:27:03'),
(103, '2018-05-02', '15', '-17.5', '108235.83', '1.68', '181836.19', '0.7', '31.26', '1.12', 'Marginal', '2018-05-17 09:18:08'),
(104, '2018-04-30', '17', '-25', '142.54', '1.68', '239.47', '0.81', '43.16', '1.39', 'Marginal', '2018-05-17 08:28:03'),
(105, '2018-04-30', '23', '88', '765507.24', '1.52', '1163571', '0.36', '11.28', '0.51', 'Min.Waste', '2018-05-17 08:29:20'),
(106, '2018-05-02', '2', '-17.5', '194.31', '2.11', '410', '2.85', '135.5', '4.66', 'High Grade', '2018-05-17 09:10:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acidsample`
--
ALTER TABLE `acidsample`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `augersample`
--
ALTER TABLE `augersample`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boulder`
--
ALTER TABLE `boulder`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `closingstock`
--
ALTER TABLE `closingstock`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `closingstockgrade`
--
ALTER TABLE `closingstockgrade`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facesample`
--
ALTER TABLE `facesample`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grabsample`
--
ALTER TABLE `grabsample`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `loader`
--
ALTER TABLE `loader`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `orefeed`
--
ALTER TABLE `orefeed`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oreinventory`
--
ALTER TABLE `oreinventory`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oreinventorygeneral`
--
ALTER TABLE `oreinventorygeneral`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oreline`
--
ALTER TABLE `oreline`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oremined`
--
ALTER TABLE `oremined`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pit`
--
ALTER TABLE `pit`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prospect`
--
ALTER TABLE `prospect`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `rcdrilling`
--
ALTER TABLE `rcdrilling`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scat`
--
ALTER TABLE `scat`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `stockpile`
--
ALTER TABLE `stockpile`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockpilesample`
--
ALTER TABLE `stockpilesample`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tostockpile`
--
ALTER TABLE `tostockpile`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acidsample`
--
ALTER TABLE `acidsample`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `augersample`
--
ALTER TABLE `augersample`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `boulder`
--
ALTER TABLE `boulder`
MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `closingstock`
--
ALTER TABLE `closingstock`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `closingstockgrade`
--
ALTER TABLE `closingstockgrade`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=199;
--
-- AUTO_INCREMENT for table `facesample`
--
ALTER TABLE `facesample`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grabsample`
--
ALTER TABLE `grabsample`
MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loader`
--
ALTER TABLE `loader`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orefeed`
--
ALTER TABLE `orefeed`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `oreinventory`
--
ALTER TABLE `oreinventory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=150;
--
-- AUTO_INCREMENT for table `oreinventorygeneral`
--
ALTER TABLE `oreinventorygeneral`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=140;
--
-- AUTO_INCREMENT for table `oreline`
--
ALTER TABLE `oreline`
MODIFY `id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `oremined`
--
ALTER TABLE `oremined`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pit`
--
ALTER TABLE `pit`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `prospect`
--
ALTER TABLE `prospect`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rcdrilling`
--
ALTER TABLE `rcdrilling`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scat`
--
ALTER TABLE `scat`
MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `stockpile`
--
ALTER TABLE `stockpile`
MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `stockpilesample`
--
ALTER TABLE `stockpilesample`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tostockpile`
--
ALTER TABLE `tostockpile`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=107;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
