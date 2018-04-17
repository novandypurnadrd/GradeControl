-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2018 at 04:15 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acidsample`
--

INSERT INTO `acidsample` (`id`, `Date`, `Prospect`, `Location`, `FromHoleID`, `ToHoleID`, `TotalHole`, `FromSample`, `ToSample`, `TotalSample`, `Remarks`, `usrid`, `recdate`) VALUES
(1, '2018-04-03', '1', '4', '25492', '25498', 7, '25492', '25498', 7, '', 'yuni.kartika', '2018-04-12 03:05:39');

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
`Id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Stockpile` varchar(20) NOT NULL,
  `Tonnes` varchar(20) DEFAULT NULL,
  `Au` varchar(10) DEFAULT NULL,
  `Ag` varchar(10) DEFAULT NULL,
  `usrid` varchar(25) DEFAULT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `closingstock`
--

INSERT INTO `closingstock` (`id`, `Date`, `Stockpile`, `Volume`, `Density`, `Tonnes`, `Au`, `Ag`, `AuEq75`, `Class`, `Status`, `usrid`, `recdate`) VALUES
(13, '2018-04-05', 2, '-32.220640', '-2.81', '90.54', '-4.75', '-18.3', '-4.99', '-', 'Complete', '', '2018-04-12 06:33:55'),
(14, '2018-04-05', 3, '4.04761904', '1.68', '6.8', '1.82', '54.37', '2.54', 'Medium Grade', 'Complete', '', '2018-04-12 06:45:28'),
(15, '2018-04-05', 5, '1142.41447', '1.52', '1736.47', '1.6', '81.13', '2.68', 'Medium Grade', 'Complete', '', '2018-04-12 06:46:08'),
(16, '2018-04-06', 8, '986.685353', '1.78', '1760', '4.54', '107.65', '5', 'High Grade', 'Pending', '', '2018-04-12 07:59:56'),
(17, '2018-04-08', 9, '461.261261', '2.08', '960', '1.51', '78.13', '2.41', 'Medium Grade', 'Pending', '', '2018-04-12 08:08:05'),
(18, '2018-03-31', 10, '4178.57142', '1.68', '7020', '4.18', '131.56', '5.93', 'High Grade', 'Pending', '', '2018-04-07 07:34:00'),
(19, '2018-03-31', 11, '2000', '1.68', '3360', '1.47', '60.74', '2.28', 'Mid Grade', 'Pending', '', '2018-04-07 07:34:38'),
(20, '2018-04-05', 12, '0', '0', '0.00', '0', '0', '0', '-', 'Complete', '', '2018-04-12 06:47:32'),
(21, '2018-03-31', 14, '399.404166', '1.68', '671', '1.21', '42.45', '1.78', 'Marginal', 'Pending', '', '2018-04-07 23:41:20'),
(22, '2018-04-06', 15, '132714.641', '1.68', '222967.74', '0.7', '30.98', '0.9', 'Marginal', 'Pending', '', '2018-04-12 08:00:58'),
(23, '2018-03-31', 17, '142.543107', '1.68', '239.47', '0.81', '43.16', '1.39', 'Marginal', 'Pending', '', '2018-04-07 23:42:22'),
(24, '2018-04-06', 13, '489.705882', '1.36', '666', '0.66', '29.36', '1.05', 'Marginal', 'Pending', '', '2018-04-12 07:57:44'),
(25, '2018-04-06', 4, '271.942446', '1.39', '378', '3', '11.85', '3.16', 'Medium Grade', 'Pending', '', '2018-04-12 07:58:48'),
(26, '2018-04-05', 20, '24952.9516', '1.24', '30941.66', '1.6', '70', '2.53', 'Medium Grade', 'Complete', '', '2018-04-12 07:01:56');

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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `closingstockgrade`
--

INSERT INTO `closingstockgrade` (`id`, `Date`, `Stockpile`, `Tonnes`, `Au`, `Ag`, `AuEq75`, `Class`, `Status`, `Volume`, `Density`) VALUES
(17, '2018-03-31', '2', '325.54', '2.04', '15.3', '2.25', 'Mid Grade', NULL, NULL, NULL),
(18, '2018-03-31', '3', '510.8', '1.82', '54.37', '2.54', 'Mid Grade', NULL, NULL, NULL),
(19, '2018-03-31', '5', '1750.87', '1.6', '81.13', '2.68', 'Mid Grade', NULL, NULL, NULL),
(20, '2018-03-31', '8', '1300', '4.48', '111.12', '5.96', 'High Grade', NULL, NULL, NULL),
(21, '2018-04-04', '9', '1260', '1.47', '75.6', '2.48', 'Medium Grade', 'Continue', '597.16', '2.11'),
(22, '2018-03-31', '10', '7020', '4.18', '131.56', '5.93', 'High Grade', NULL, NULL, NULL),
(23, '2018-03-31', '11', '3360', '1.47', '60.74', '2.28', 'Mid Grade', NULL, NULL, NULL),
(24, '2018-03-31', '12', '50', '1.29', '61.7', '2.12', 'Mid Grade', NULL, NULL, NULL),
(25, '2018-03-31', '14', '671', '1.21', '42.45', '1.78', 'Marginal', NULL, NULL, NULL),
(26, '2018-03-31', '15', '234744.54', '0.7', '30.97', '1.11', 'Marginal', NULL, NULL, NULL),
(27, '2018-03-31', '17', '239.47', '0.81', '43.16', '1.39', 'Marginal', NULL, NULL, NULL),
(28, '2018-04-01', '2', '187.54', '2.04', '15.3', '2.24', 'Medium Grade', NULL, NULL, NULL),
(29, '2018-04-01', '3', '317.6', '1.82', '54.37', '2.54', 'Medium Grade', NULL, NULL, NULL),
(30, '2018-04-01', '12', '34.04', '1.29', '61.7', '2.11', 'Medium Grade', NULL, NULL, NULL),
(31, '2018-04-01', '15', '231930.54', '0.7', '30.97', '1.11', 'Marginal', NULL, NULL, NULL),
(32, '2018-04-02', '13', '720', '0.53', '35.55', '0.8', 'Marginal', NULL, NULL, NULL),
(33, '2018-04-02', '4', '108', '3', '11.85', '3.16', 'Medium Grade', NULL, '-5400', '-0.02'),
(34, '2018-04-02', '2', '139.54', '2.04', '15.3', '2.24', 'Medium Grade', NULL, NULL, NULL),
(35, '2018-04-02', '3', '200', '1.82', '54.37', '2.54', 'Medium Grade', NULL, NULL, NULL),
(36, '2018-04-02', '15', '230678.94', '0.7', '30.97', '1.11', 'Marginal', NULL, NULL, NULL),
(37, '2018-04-03', '15', '228037.74', '0.7', '30.98', '1.11', 'Marginal', NULL, '137322.498', '2.08'),
(38, '2018-04-03', '2', '103.54', '2.04', '15.3', '2.24', 'Medium Grade', NULL, NULL, NULL),
(39, '2018-04-03', '3', '82.4', '1.82', '54.37', '2.54', 'Medium Grade', NULL, NULL, NULL),
(40, '2018-04-03', '13', '666', '0.53', '35.55', '1', 'Marginal', NULL, NULL, NULL),
(41, '2018-04-04', '4', '288', '3', '11.85', '3.16', 'Medium Grade', NULL, '207.19', '1.39'),
(42, '2018-04-04', '13', '690', '0.67', '28.85', '1.01', 'Marginal', NULL, '452.188283', '1.52591304'),
(43, '2018-04-04', '9', '1260', '1.47', '75.6', '2.48', 'Medium Grade', 'Continue', '597.16', '2.11'),
(44, '2018-04-04', '2', '1.54', '2.04', '15.3', '2.24', 'Medium Grade', NULL, NULL, NULL),
(45, '2018-04-04', '3', '15.2', '1.82', '54.37', '2.54', 'Medium Grade', NULL, NULL, NULL),
(46, '2018-04-04', '15', '225307.74', '0.7', '30.98', '1.11', 'Marginal', NULL, NULL, NULL),
(47, '2018-04-05', '8', '1460', '4.6', '111.38', '7.12', 'SHG', NULL, '846.948506', '2.08'),
(48, '2018-04-05', '2', '90.54', '-4.75', '-18.3', '-4.99', '-', NULL, '14.3064898', '1.38'),
(49, '2018-04-05', '3', '6.8', '1.82', '54.37', '2.54', 'Medium Grade', NULL, NULL, NULL),
(50, '2018-04-05', '5', '1736.47', '1.6', '81.13', '2.68', 'Medium Grade', NULL, NULL, NULL),
(51, '2018-04-05', '12', '0.00', '0', '0', '0', '-', NULL, NULL, NULL),
(52, '2018-04-05', '13', '612', '0.67', '28.7', '1.05', 'Marginal', NULL, '0', '0'),
(53, '2018-04-05', '15', '222937.74', '0.7', '30.98', '1.11', 'Marginal', NULL, NULL, NULL),
(54, '2018-03-31', '20', '30989.54', '1.6', '70', '2.53', 'Mid Grade', NULL, '24991.5637', '1.24'),
(55, '2018-04-05', '20', '30941.66', '1.6', '70', '2.53', 'Medium Grade', NULL, NULL, NULL),
(56, '2018-04-06', '8', '1760', '4.54', '107.65', '5', 'High Grade', NULL, '846.153846', '2.08'),
(57, '2018-04-06', '13', '666', '0.66', '29.36', '1.05', 'Marginal', NULL, '489.705882', '1.36'),
(58, '2018-04-06', '4', '378', '3', '11.85', '3.16', 'Medium Grade', NULL, '271.942446', '1.39'),
(59, '2018-04-06', '15', '222967.74', '0.7', '30.98', '0.9', 'Marginal', NULL, '132714.641', '2.08'),
(60, '2018-04-08', '9', '960', '1.51', '78.13', '2.41', 'Medium Grade', NULL, '461.261261', '2.11');

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
  `Act` int(15) DEFAULT NULL,
  `Remarks` varchar(15) DEFAULT NULL,
  `Note` varchar(50) DEFAULT NULL,
  `Shift` varchar(5) DEFAULT NULL,
  `Type` varchar(10) DEFAULT NULL,
  `usrid` varchar(20) DEFAULT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orefeed`
--

INSERT INTO `orefeed` (`id`, `Date`, `Stockpile`, `Bucket`, `Volume`, `Density`, `Tonnes`, `Au`, `Ag`, `AuEq75`, `Class`, `AdjAu`, `AdjAg`, `AdjAuPersen`, `AdjAgPersen`, `Loader`, `Material`, `Percentage`, `Tonnestocrush`, `Act`, `Remarks`, `Note`, `Shift`, `Type`, `usrid`, `recdate`) VALUES
(5, '2018-04-01', 2, '23', '271.28', '1.20', '187.5400', '2.04', '15.3', '2.24', 'Medium Grade', '1.94', '21.42', '95%', '140%', 'Loader_H_Clay_Apr', 'Clay', '1', '138.0000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-07 23:43:47'),
(6, '2018-04-01', 3, '23', '304.05', '1.68', '317.6000', '1.82', '54.37', '2.54', 'Medium Grade', '2.82', '76.12', '155%', '140%', 'Loader_H_Fresh_Apr', 'Fresh', '1', '193.2000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-07 23:44:24'),
(7, '2018-04-01', 12, '2', '29.76', '1.68', '34.0400', '1.29', '61.7', '2.11', 'Medium Grade', '1.29', '77.13', '100%', '125%', 'Loader_H_Bypass_Apr', 'Bypass', '0.95', '15.9600', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-07 23:44:49'),
(8, '2018-04-01', 15, '335', '139728.89', '1.68', '231930.540', '0.7', '30.97', '1.11', 'Marginal', '0.63', '30.97', '90%', '100%', 'Loader_H_Fresh_Apr', 'Fresh', '1', '2814.0000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-07 23:45:18'),
(9, '2018-04-02', 2, '8', '156.28', '1.20', '139.5400', '2.04', '15.3', '2.24', '', '2.04', '18.36', '100%', '120%', 'Loader_H_Clay_Apr', 'Clay', '1', '48.0000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-08 00:17:21'),
(10, '2018-04-02', 3, '14', '189.05', '1.68', '200.0000', '1.82', '54.37', '2.54', '', '2.82', '76.12', '155%', '140%', 'Loader_H_Fresh_Apr', 'Fresh', '1', '117.6000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-08 00:17:59'),
(11, '2018-04-02', 15, '149', '138053.89', '1.68', '230678.940', '0.7', '30.97', '1.11', '', '0.70', '26.32', '100%', '85%', 'Loader_H_Fresh_Apr', 'Fresh', '1', '1251.6000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-08 00:18:25'),
(12, '2018-04-03', 2, '6', '116.28', '1.20', '103.5400', '2.04', '15.3', '2.24', '', '2.04', '19.89', '100%', '130%', 'Loader_H_Clay_Apr', 'Clay', '1', '36.0000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-11 06:54:45'),
(13, '2018-04-03', 3, '14', '119.05', '1.68', '82.4000', '1.82', '54.37', '2.54', '', '2.91', '81.55', '160%', '150%', 'Loader_H_Fresh_Apr', 'Fresh', '1', '117.6000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-11 06:55:23'),
(14, '2018-04-03', 13, '9', '529.41', '1.36', '666.0000', '0.53', '35.55', '1', 'Marginal', '0.53', '35.55', '100%', '100%', 'Loader_H_Clay_Apr', 'Clay', '1', '54.0000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-11 06:56:36'),
(15, '2018-04-03', 15, '318', '110917.76', '2.08', '228037.740', '0.7', '30.98', '1.11', 'Marginal', '0.84', '32.53', '120%', '105%', 'Loader_H_Fresh_Apr', 'Fresh', '1', '2671.2000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-11 06:57:12'),
(16, '2018-04-04', 2, '17', '86.28', '1.20', '1.5400', '2.04', '15.3', '2.24', '', '2.04', '19.89', '100%', '130%', 'Loader_H_Clay_Apr', 'Clay', '1', '102.0000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-12 02:55:47'),
(17, '2018-04-04', 3, '8', '49.05', '1.68', '15.2000', '1.82', '54.37', '2.54', '', '2.91', '81.55', '160%', '150%', 'Loader_H_Fresh_Apr', 'Fresh', '1', '67.2000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-12 02:56:22'),
(19, '2018-04-04', 15, '157', '109633.53', '2.08', '226718.940', '0.7', '30.98', '1.11', '', '0.84', '35.63', '120%', '115%', 'Loader_H_Fresh_Apr', 'Fresh', '1', '1318.8000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-12 02:59:24'),
(20, '2018-04-04', 15, '196', '108999.49', '2.08', '225307.740', '0.7', '30.98', '1.11', '', '0.84', '35.63', '120%', '115%', 'Loader_H_Trans_Apr', 'Transisi', '1', '1411.2000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-12 02:59:46'),
(21, '2018-04-04', 15, '34', '108321.03', '2.08', '225036.420', '0.7', '30.98', '1.11', '', '0.84', '35.63', '120%', '115%', 'Loader_H_Bypass_Apr', 'Bypass', '0.95', '271.3200', NULL, '', '', '', 'Bypass', 'yuni.kartika', '2018-04-12 03:02:00'),
(22, '2018-04-04', 13, '26', '557.75', '1.42', '636.0000', '0.6', '30.62', '1.01', 'Marginal', '0.66', '30.62', '110%', '100%', 'Loader_H_Clay_Apr', 'Clay', '1', '156.0000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-12 03:03:06'),
(23, '2018-04-05', 2, '34', '14.16', '1.38', '90.54', '2.33', '8.98', '2.45', 'Medium Grade', '2.80', '10.78', '120%', '120%', 'Loader_H_Clay_Apr', 'Clay', '1', '204.0000', 275, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-12 06:33:55'),
(24, '2018-04-05', 3, '13', '9.05', '1.68', '6.8000', '1.82', '54.37', '2.54', '', '2.91', '76.12', '160%', '140%', 'Loader_H_Fresh_Apr', 'Fresh', '1', '8.4000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-12 06:45:28'),
(25, '2018-04-05', 5, '2', '1151.89', '1.52', '1736.4700', '1.6', '81.13', '2.68', 'Medium Grade', '2.96', '105.47', '185%', '130%', 'Loader_H_Trans_Apr', 'Transisi', '1', '14.4000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-12 06:46:08'),
(26, '2018-04-05', 12, '10', '20.26', '1.68', '0.00', '1.29', '61.7', '2.11', '', '1.29', '77.13', '100%', '125%', 'Loader_H_Bypass_Apr', 'Bypass', '0.95', '79.8000', 46, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-12 06:47:32'),
(27, '2018-04-05', 13, '13', '507.35', '1.36', '612.0000', '0.67', '28.85', '1.06', 'Marginal', '0.87', '24.52', '130%', '85%', 'Loader_H_Clay_Apr', 'Clay', '1', '78.0000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-12 06:55:06'),
(28, '2018-04-05', 15, '103', '108321.03', '2.08', '224442.540', '0.7', '30.98', '1.11', '', '0.80', '27.88', '115%', '90%', 'Loader_H_Fresh_Apr', 'Fresh', '1', '865.2000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-12 06:56:37'),
(29, '2018-04-05', 15, '209', '107905.07', '2.08', '222937.740', '0.7', '30.98', '1.11', '', '0.80', '27.88', '115%', '90%', 'Loader_H_Trans_Apr', 'Transisi', '1', '1504.8000', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-12 06:57:00'),
(30, '2018-04-05', 20, '6', '24991.56', '1.24', '30941.6600', '1.6', '70', '2.53', 'Medium Grade', '1.60', '63.00', '100%', '90%', 'Loader_H_Bypass_Apr', 'Bypass', '0.95', '47.8800', 0, '', '', '', 'Oremill', 'yuni.kartika', '2018-04-12 07:01:56');

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
  `Note` varchar(100) DEFAULT NULL,
  `usrid` varchar(20) NOT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oreinventory`
--

INSERT INTO `oreinventory` (`id`, `Pit`, `Block`, `RL`, `Type`, `Au`, `Ag`, `AuEq75`, `Class`, `Dbdensity`, `DryTonBM`, `DryTonFF`, `Start`, `Finish`, `StartHour`, `FinishHour`, `Stockpile`, `Value`, `Status`, `Achievement`, `Density`, `Note`, `usrid`, `recdate`) VALUES
(13, 1, 'stockpile_A1', '55', 'Ore', '2.04', '15.3', '2.25', 'Mid Grade', '1.5', '325.54', '325.5375', '2018-03-31', '2018-03-31', '06:00', '22:00', '2', 'Block Model', 'Completed', '100.0', '1.5', '', 'yuni.kartika', '2018-04-07 07:30:59'),
(14, 1, 'stockpile_A2', '-10', 'Ore', '1.82', '54.37', '2.54', 'Mid Grade', '2.1', '510.8', '510.8', '2018-03-31', '2018-03-31', '10:00', '21:00', '3', 'Block Model', 'Completed', '100.0', '2.1', '', 'yuni.kartika', '2018-04-07 07:31:38'),
(15, 1, 'stockpile_B2', '-10;-15;-20', 'Ore', '1.6', '81.13', '2.68', 'Mid Grade', '1.9', '1750.87', '1750.87185', '2018-03-31', '2018-03-31', '06:00', '19:00', '5', 'Block Model', 'Completed', '100.0', '1.9', '', 'yuni.kartika', '2018-04-07 07:32:24'),
(16, 2, 'stockpile_D1', '0;-5', 'Ore', '4.48', '111.12', '5.96', 'High Grade', '2.1', '1300', '1300', '2018-03-31', NULL, '06:00', NULL, '8', 'Block Model', 'Continue', '100.0', '2.1', '', 'yuni.kartika', '2018-04-07 07:32:57'),
(17, 2, 'stockpile_D2', '-5', 'Ore', '1.36', '72.92', '2.33', 'Mid Grade', '2.1', '60', '60', '2018-03-31', NULL, '06:00', NULL, '9', 'Block Model', 'Continue', '100.0', '2.1', '', 'yuni.kartika', '2018-04-07 07:33:23'),
(18, 2, 'stockpile_E1', '-60;-65', 'Ore', '4.18', '131.56', '5.93', 'High Grade', '2.1', '7020', '7020', '2018-03-31', '2018-03-31', '06:00', '20:00', '10', 'Block Model', 'Completed', '100.0', '2.1', '', 'yuni.kartika', '2018-04-07 07:34:01'),
(19, 1, 'stockpile_E2', '-20', 'Ore', '1.47', '60.74', '2.28', 'Mid Grade', '2.1', '3360', '3360', '2018-03-31', '2018-03-31', '06:00', '19:00', '11', 'Block Model', 'Completed', '100.0', '2.1', '', 'yuni.kartika', '2018-04-07 07:34:38'),
(20, 2, 'stockpile_F', '-7.5', 'Ore', '1.29', '61.7', '2.12', 'Mid Grade', '2.1', '50', '50', '2018-03-31', '2018-03-31', '06:00', '21:00', '12', 'Block Model', 'Completed', '100.0', '2.1', '', 'yuni.kartika', '2018-04-07 07:43:14'),
(21, 9, 'stockpile_H', '-10', 'Ore', '1.21', '42.45', '1.78', 'Marginal', '2.1', '671', '670.999', '2018-03-31', NULL, '06:00', NULL, '14', 'Block Model', 'Continue', '100.0', '2.1', '', 'yuni.kartika', '2018-04-07 23:41:20'),
(22, 9, 'stockpile_I', '-25;-35;-0', 'Ore', '0.7', '30.97', '1.11', 'Marginal', '2.1', '234744.54', '234744.542', '2018-03-31', NULL, '07:00', NULL, '15', 'Block Model', 'Continue', '100.0', '2.1', '', 'yuni.kartika', '2018-04-07 23:41:50'),
(23, 9, 'stockpile_J2', '-25', 'Ore', '0.81', '43.16', '1.39', 'Marginal', '2.1', '239.47', '239.47242', '2018-03-31', NULL, '06:00', NULL, '17', 'Block Model', 'Continue', '100.0', '2.1', '', 'yuni.kartika', '2018-04-07 23:42:22'),
(24, 1, 'nke_55a_55_01', '55', 'Ore', '0.56', '36.94', '1.06', 'Marginal', '1.7', '627.5', '576', '2018-04-02', NULL, '19:38', NULL, '13', 'Block Model', 'Continue', '91.8', '1.7', '', 'yuni.kartika', '2018-04-07 23:55:14'),
(25, 1, 'nke_55a_55_03', '55', 'Ore', '3', '11.85', '3.16', 'Mid Grade', '1.74', '653.44', '108', '2018-04-02', NULL, '22:27', NULL, '4', 'Block Model', 'Continue', '16.5', '1.74', '', 'yuni.kartika', '2018-04-07 23:56:10'),
(26, 1, 'NKE+55_A', '55', 'Visual', '0.4', '30', '0.80', 'Marginal', '1.7', '144', '144', '2018-04-02', '2018-04-02', '22:20', '23:20', '13', 'Block Model', 'Completed', '100', '1.7', '', 'yuni.kartika', '2018-04-07 23:58:22'),
(27, 2, 'bwd_st2_05b_7p5_01 (v)', '7.5', 'Visual', '1', '70', '1.93', 'Marginal', '2.6', '30', '30', '2018-04-03', '2018-04-03', '07:00', '08:00', '15', 'Block Model', 'Completed', '100', '2.6', '', 'yuni.kartika', '2018-04-11 06:44:46'),
(28, 1, 'nke_55a_55_03', '55 ', 'Ore', '3', '11.85', '3.16', 'Mid Grade', '1.74', '653.44', '180', '2018-04-04', NULL, '06:00', NULL, '4', 'Block Model', 'Continue', '44.1', '1.74', '', 'yuni.kartika', '2018-04-12 02:21:34'),
(29, 1, 'nke_55a_55_02', '55', 'Ore', '0.96', '4.53', '1.02', 'Marginal', '1.78', '109.29', '126', '2018-04-04', '2018-04-04', '08:09', '08:37', '13', 'Final Figure', 'Completed', '115.3', '1.78', '', 'yuni.kartika', '2018-04-12 02:25:28'),
(30, 2, 'bwd_-05d_-05_01_db', '-05', 'Ore', '1.37', '70.42', '2.31', 'Mid Grade', '2.64', '1020.73', '60', '2018-04-04', NULL, '06:00', NULL, '9', 'Block Model', 'Continue', '5.9', '2.64', '', 'yuni.kartika', '2018-04-12 02:31:01'),
(32, 2, 'bwd_-05d_-05_01_db', '-05  ', 'Ore', '1.37', '70.42', '2.31', 'Mid Grade', '2.64', '941.51', '570', '2018-04-05', NULL, '12:00', NULL, '9', 'Block Model', 'Continue', '66.9', '2.64', '', 'yuni.kartika', '2018-04-12 06:24:53'),
(33, 2, 'bwd_-05b_-2p5_01', '-2.5', 'Ore', '5.61', '113.53', '7.13', 'SHG', '2.6', '124.37', '160', '2018-04-05', '2018-04-05', '18:28', '19:27', '8', 'Final Figure', 'Completed', '128.6', '2.6', '', 'yuni.kartika', '2018-04-12 06:18:56'),
(34, 1, 'nke_55a_57p5_02', '57.5', 'Ore', '2.35', '8.44', '2.47', 'Mid Grade', '1.72', '543.14', '18', '2018-04-05', '2018-04-05', '14:09', '14:09', '2', 'Block Model', 'Completed', '3.3', '1.72', '', 'yuni.kartika', '2018-04-12 06:20:04'),
(35, 1, 'NKE+55_A', '55', 'Visual', '0.69', '24', '1.01', 'Marginal', '1.7', '54', '54', '2018-04-04', '2018-04-04', '18:00', '19:00', '13', 'Block Model', 'Completed', '100', '1.7', '', 'yuni.kartika', '2018-04-12 06:23:07'),
(36, 9, 'stockpile_scat', '5', 'Ore', '1.6', '70', '2.53', 'Mid Grade', '1.55', '30989.54', '30989.5390', '2018-03-31', '2018-03-31', '07:00', '19:00', '20', 'Block Model', 'Completed', '100.0', '1.55', '', 'yuni.kartika', '2018-04-12 07:01:32'),
(37, 2, 'bwd_-05b_-05_01', '-5', 'Ore', '4.59', '111.23', '6.08', 'SHG', '2.6', '81.76', '120', '2018-04-06', '2018-04-06', '23:24', '23:49', '8', 'Final Figure', 'Completed', '146.8', '2.6', '', 'yuni.kartika', '2018-04-12 07:56:27'),
(38, 1, 'nke_55a_55_01', '55 ', 'Ore', '0.56', '36.79', '1.05', 'Marginal', '1.7', '627.5', '54', '2018-04-06', '2018-04-06', '21:00', '21:27', '13', 'Final Figure', 'Completed', '100.4', '1.7', '', 'yuni.kartika', '2018-04-12 07:57:44'),
(39, 1, 'nke_55a_55_03', '55  ', 'Ore', '3', '11.85', '3.16', 'Mid Grade', '1.74', '653.44', '90', '2018-04-06', '2018-04-06', '20:00', '20:38', '4', 'Block Model', 'Completed', '57.8', '1.74', '', 'yuni.kartika', '2018-04-12 07:58:48'),
(40, 1, 'bwd_-05b_-05_01(v)', '-5', 'Visual', '4', '75', '5.00', 'High Grade', '2.6', '180', '180', '2018-04-06', '2018-04-06', '08:00', '08:30', '8', 'Block Model', 'Completed', '100', '2.6', '', 'yuni.kartika', '2018-04-12 07:59:56'),
(41, 1, 'bwd_-05b_-05_01(v)', '-5', 'Visual', '0.5', '30', '0.90', 'Marginal', '2.6', '30', '30', '2018-04-06', '2018-04-06', '08:00', '08:00', '15', 'Block Model', 'Completed', '100', '2.6', '', 'yuni.kartika', '2018-04-12 08:00:58'),
(42, 2, 'bwd_-05d_-05_01_db', '-05   ', 'Ore', '1.43', '73.67', '2.42', 'Mid Grade', '2.64', '941.51', '270', '2018-04-08', '2018-04-08', '10:41', '10:41', '9', 'Final Figure', 'Completed', '95.6', '2.64', '', 'yuni.kartika', '2018-04-12 08:08:05');

-- --------------------------------------------------------

--
-- Table structure for table `oreinventorygeneral`
--

CREATE TABLE IF NOT EXISTS `oreinventorygeneral` (
`id` int(11) NOT NULL,
  `Pit` int(3) NOT NULL,
  `Block` varchar(40) NOT NULL,
  `RL` varchar(50) NOT NULL,
  `Type` varchar(15) DEFAULT NULL,
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
  `Note` varchar(100) DEFAULT NULL,
  `usrid` varchar(20) NOT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oreinventorygeneral`
--

INSERT INTO `oreinventorygeneral` (`id`, `Pit`, `Block`, `RL`, `Type`, `Au`, `Ag`, `AuEq75`, `Class`, `Dbdensity`, `DryTonBM`, `DryTonFF`, `Start`, `Finish`, `StartHour`, `FinishHour`, `Stockpile`, `Value`, `Status`, `Achievement`, `Density`, `Note`, `usrid`, `recdate`) VALUES
(13, 1, 'stockpile_A1', '55', 'Ore', '2.04', '15.3', '2.25', 'Mid Grade', '1.5', '325.54', '325.5375', '2018-03-31', '2018-03-31', '06:00', '22:00', '2', 'Block Model', 'Completed', '100.0', '1.5', '', 'yuni.kartika', '2018-04-07 07:30:59'),
(14, 1, 'stockpile_A2', '-10', 'Ore', '1.82', '54.37', '2.54', 'Mid Grade', '2.1', '510.8', '510.8', '2018-03-31', '2018-03-31', '10:00', '21:00', '3', 'Block Model', 'Completed', '100.0', '2.1', '', 'yuni.kartika', '2018-04-07 07:31:38'),
(15, 1, 'stockpile_B2', '-10;-15;-20', 'Ore', '1.6', '81.13', '2.68', 'Mid Grade', '1.9', '1750.87', '1750.87185', '2018-03-31', '2018-03-31', '06:00', '19:00', '5', 'Block Model', 'Completed', '100.0', '1.9', '', 'yuni.kartika', '2018-04-07 07:32:24'),
(16, 2, 'stockpile_D1', '0;-5', 'Ore', '4.48', '111.12', '5.96', 'High Grade', '2.1', '1300', '1300', '2018-03-31', NULL, '06:00', NULL, '8', 'Block Model', 'Continue', '100.0', '2.1', '', 'yuni.kartika', '2018-04-07 07:32:57'),
(17, 2, 'stockpile_D2', '-5', 'Ore', '1.36', '72.92', '2.33', 'Mid Grade', '2.1', '60', '60', '2018-03-31', NULL, '06:00', NULL, '9', 'Block Model', 'Continue', '100.0', '2.1', '', 'yuni.kartika', '2018-04-07 07:33:23'),
(18, 2, 'stockpile_E1', '-60;-65', 'Ore', '4.18', '131.56', '5.93', 'High Grade', '2.1', '7020', '7020', '2018-03-31', '2018-03-31', '06:00', '20:00', '10', 'Block Model', 'Completed', '100.0', '2.1', '', 'yuni.kartika', '2018-04-07 07:34:00'),
(19, 1, 'stockpile_E2', '-20', 'Ore', '1.47', '60.74', '2.28', 'Mid Grade', '2.1', '3360', '3360', '2018-03-31', '2018-03-31', '06:00', '19:00', '11', 'Block Model', 'Completed', '100.0', '2.1', '', 'yuni.kartika', '2018-04-07 07:34:38'),
(20, 2, 'stockpile_F', '-7.5', 'Ore', '1.29', '61.7', '2.12', 'Mid Grade', '2.1', '50', '50', '2018-03-31', '2018-03-31', '06:00', '21:00', '12', 'Block Model', 'Completed', '100.0', '2.1', '', 'yuni.kartika', '2018-04-07 07:43:14'),
(21, 9, 'stockpile_H', '-10', 'Ore', '1.21', '42.45', '1.78', 'Marginal', '2.1', '671', '670.999', '2018-03-31', NULL, '06:00', NULL, '14', 'Block Model', 'Continue', '100.0', '2.1', '', 'yuni.kartika', '2018-04-07 23:41:20'),
(22, 9, 'stockpile_I', '-25;-35;-0', 'Ore', '0.7', '30.97', '1.11', 'Marginal', '2.1', '234744.54', '234744.542', '2018-03-31', NULL, '07:00', NULL, '15', 'Block Model', 'Continue', '100.0', '2.1', '', 'yuni.kartika', '2018-04-07 23:41:50'),
(23, 9, 'stockpile_J2', '-25', 'Ore', '0.81', '43.16', '1.39', 'Marginal', '2.1', '239.47', '239.47242', '2018-03-31', NULL, '06:00', NULL, '17', 'Block Model', 'Continue', '100.0', '2.1', '', 'yuni.kartika', '2018-04-07 23:42:22'),
(24, 1, 'nke_55a_55_01', '55 ', 'Ore', '0.56', '36.79', '1.05', 'Marginal', '1.7', '627.5', '630', '2018-04-02', '2018-04-06', '21:00', '21:27', '13', 'Final Figure', 'Completed', '100.4', '1.7', '', 'yuni.kartika', '2018-04-12 07:57:44'),
(25, 1, 'nke_55a_55_03', '55  ', 'Ore', '3', '11.85', '3.16', 'Mid Grade', '1.74', '653.44', '378', '2018-04-02', '2018-04-06', '20:00', '20:38', '4', 'Block Model', 'Completed', '57.8', '1.74', '', 'yuni.kartika', '2018-04-12 07:58:47'),
(26, 1, 'NKE+55_A', '55', 'Visual', '0.4', '30', '0.80', 'Marginal', '1.7', '144', '144', '2018-04-02', '2018-04-02', '22:20', '23:20', '13', 'Block Model', 'Completed', '100', '1.7', '', 'yuni.kartika', '2018-04-07 23:58:22'),
(27, 2, 'bwd_st2_05b_7p5_01 (v)', '7.5', 'Visual', '1', '70', '1.93', 'Marginal', '2.6', '30', '30', '2018-04-03', '2018-04-03', '07:00', '08:00', '15', 'Block Model', 'Completed', '100', '2.6', '', 'yuni.kartika', '2018-04-11 06:44:46'),
(28, 1, 'nke_55a_55_02', '55', 'Ore', '0.96', '4.53', '1.02', 'Marginal', '1.78', '109.29', '126', '2018-04-04', '2018-04-04', '08:09', '08:37', '13', 'Final Figure', 'Completed', '115.3', '1.78', '', 'yuni.kartika', '2018-04-12 02:25:28'),
(29, 2, 'bwd_-05d_-05_01_db', '-05   ', 'Ore', '1.43', '73.67', '2.42', 'Mid Grade', '2.64', '941.51', '900', '2018-04-04', '2018-04-08', '10:41', '10:41', '9', 'Final Figure', 'Completed', '95.6', '2.64', '', 'yuni.kartika', '2018-04-12 08:08:05'),
(30, 1, '', '55', 'Visual', '0.69', '24', '1.01', 'Marginal', '1.7', '54', '54', '2018-04-04', '2018-04-04', '07:00', '12:00', '13', 'Block Model', 'Completed', '100', '1.7', '', 'yuni.kartika', '2018-04-12 05:28:21'),
(31, 2, 'bwd_-05b_-2p5_01', '-2.5', 'Ore', '5.61', '113.53', '7.13', 'SHG', '2.6', '124.37', '160', '2018-04-05', '2018-04-05', '18:28', '19:27', '8', 'Final Figure', 'Completed', '128.6', '2.6', '', 'yuni.kartika', '2018-04-12 06:18:56'),
(32, 1, 'nke_55a_57p5_02', '57.5', 'Ore', '2.35', '8.44', '2.47', 'Mid Grade', '1.72', '543.14', '18', '2018-04-05', '2018-04-05', '14:09', '14:09', '2', 'Block Model', 'Completed', '3.3', '1.72', '', 'yuni.kartika', '2018-04-12 06:20:04'),
(33, 9, 'stockpile_scat', '5', 'Ore', '1.6', '70', '2.53', 'Mid Grade', '1.55', '30989.54', '30989.5390', '2018-03-31', '2018-03-31', '07:00', '19:00', '20', 'Block Model', 'Completed', '100.0', '1.55', '', 'yuni.kartika', '2018-04-12 07:01:32'),
(34, 2, 'bwd_-05b_-05_01', '-5', 'Ore', '4.59', '111.23', '6.08', 'SHG', '2.6', '81.76', '120', '2018-04-06', '2018-04-06', '23:24', '23:49', '8', 'Final Figure', 'Completed', '146.8', '2.6', '', 'yuni.kartika', '2018-04-12 07:56:26'),
(35, 1, 'bwd_-05b_-05_01(v)', '-5', 'Visual', '4', '75', '5.00', 'High Grade', '2.6', '180', '180', '2018-04-06', '2018-04-06', '08:00', '08:30', '8', 'Block Model', 'Completed', '100', '2.6', '', 'yuni.kartika', '2018-04-12 07:59:56'),
(36, 1, 'bwd_-05b_-05_01(v)', '-5', 'Visual', '0.5', '30', '0.90', 'Marginal', '2.6', '30', '30', '2018-04-06', '2018-04-06', '08:00', '08:00', '15', 'Block Model', 'Completed', '100', '2.6', '', 'yuni.kartika', '2018-04-12 08:00:58');

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oreline`
--

INSERT INTO `oreline` (`id`, `File`, `pit`, `Volume`, `Tonnes`, `Au`, `Ag`, `Aueq`, `Class`, `Dbdensity`, `Partial`, `Actual`, `status`, `recdate`, `usrid`) VALUES
(12, 'stockpile_A1', 1, '217.03', '325.54', '2.04', '15.3', '2.25', 'Mid Grade', '1.5', '1', '325.54', 'Completed', '2018-04-07 07:30:59', 'yuni.kartika'),
(13, 'stockpile_A2', 1, '243.24', '510.8', '1.82', '54.37', '2.54', 'Mid Grade', '2.1', '1', '510.8', 'Completed', '2018-04-07 07:31:38', 'yuni.kartika'),
(14, 'stockpile_B2', 1, '921.51', '1750.87', '1.6', '81.13', '2.68', 'Mid Grade', '1.9', '1', '1750.87', 'Completed', '2018-04-07 07:32:24', 'yuni.kartika'),
(15, 'stockpile_D1', 2, '619.05', '1300', '4.48', '111.12', '5.96', 'High Grade', '2.1', '1', '1300', 'Continue', '2018-04-07 07:25:38', 'yuni.kartika'),
(16, 'stockpile_D2', 2, '28.57', '60', '1.36', '72.92', '2.33', 'Mid Grade', '2.1', '1', '60', 'Continue', '2018-04-07 07:25:45', 'yuni.kartika'),
(17, 'stockpile_E1', 2, '3342.86', '7020', '4.18', '131.56', '5.93', 'High Grade', '2.1', '1', '7020', 'Completed', '2018-04-07 07:34:00', 'yuni.kartika'),
(18, 'stockpile_E2', 1, '1600', '3360', '1.47', '60.74', '2.28', 'Mid Grade', '2.1', '1', '3360', 'Completed', '2018-04-07 07:34:38', 'yuni.kartika'),
(19, 'stockpile_F', 2, '23.81', '50', '1.29', '61.7', '2.12', 'Mid Grade', '2.1', '1', '50', 'Completed', '2018-04-07 07:43:13', 'yuni.kartika'),
(20, 'stockpile_H', 9, '319.52', '671', '1.21', '42.45', '1.78', 'Marginal', '2.1', '1', '671', 'Continue', '2018-04-07 07:26:21', 'yuni.kartika'),
(21, 'stockpile_I', 9, '111783.12', '234744.54', '0.7', '30.97', '1.11', 'Marginal', '2.1', '1', '234744.54', 'Continue', '2018-04-07 07:26:28', 'yuni.kartika'),
(22, 'stockpile_J2', 9, '114.03', '239.47', '0.81', '43.16', '1.39', 'Marginal', '2.1', '1', '239.47', 'Continue', '2018-04-07 07:26:37', 'yuni.kartika'),
(23, 'stockpile_maspur', 6, '612405.79', '1163571', '0.36', '11.28', '0.51', 'Waste', '1.9', '1', '1163571', 'Continue', '2018-04-07 07:26:45', 'yuni.kartika'),
(24, 'nke_55a_55_01', 1, '403.32', '682.07', '0.56', '36.94', '1.06', 'Marginal', '1.7', '0.92', '627.5', 'Completed', '2018-04-12 07:57:44', 'yuni.kartika'),
(25, 'nke_55a_55_03', 1, '398.44', '687.83', '3', '11.85', '3.16', 'Mid Grade', '1.74', '0.95', '653.44', 'Completed', '2018-04-12 07:58:47', 'yuni.kartika'),
(26, 'nke_55a_55_02', 1, '66.16', '117.51', '1.11', '5.22', '1.18', 'Marginal', '1.78', '0.93', '109.29', 'Completed', '2018-04-12 02:25:28', 'yuni.kartika'),
(29, 'bwd_-05b_-2p5_01', 2, '49.32', '128.22', '7.22', '146.06', '9.17', 'SHG', '2.6', '0.97', '124.37', 'Completed', '2018-04-12 06:18:56', 'yuni.kartika'),
(30, 'nke_55a_57p5_02', 1, '333.98', '571.72', '2.35', '8.44', '2.47', 'Mid Grade', '1.72', '0.95', '543.14', 'Completed', '2018-04-12 06:20:04', 'yuni.kartika'),
(31, 'bwd_-05d_-05_01_db', 2, '394.53', '960.73', '1.37', '70.42', '2.31', 'Mid Grade', '2.64', '0.98', '941.51', 'Completed', '2018-04-12 08:08:05', 'yuni.kartika'),
(32, 'stockpile_scat', 9, '21429.77', '30989.54', '1.6', '70', '2.53', 'Mid Grade', '1.55', '1', '30989.54', 'Completed', '2018-04-12 07:01:32', 'yuni.kartika'),
(33, 'bwd_-05b_-05_01', 2, '34.18', '88.87', '6.74', '163.26', '8.92', 'SHG', '2.6', '0.92', '81.76', 'Completed', '2018-04-12 07:56:26', 'yuni.kartika');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

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
(9, 'All Pit', 'girlly.marchlina', '2018-03-02 09:54:58');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockpilesample`
--

INSERT INTO `stockpilesample` (`id`, `Date`, `FromST`, `ToST`, `TotalSample`, `Remarks`, `usrid`, `recdate`) VALUES
(3, '2018-04-01', '70108', 70158, 51, 'Stockpile D1', 'yuni.kartika', '2018-04-07 23:46:56');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tostockpile`
--

INSERT INTO `tostockpile` (`id`, `Date`, `Stockpile`, `RL`, `Volume`, `Density`, `Tonnes`, `Au`, `Ag`, `AuEq75`, `Class`, `recdate`) VALUES
(13, '2018-04-05', '2', '57.5', '13.66', '6.63', '90.54', '-4.75', '-18.3', '-4.99', NULL, '2018-04-12 06:33:55'),
(14, '2018-04-05', '3', '-10', '4.05', '1.68', '6.8', '1.82', '54.37', '2.54', NULL, '2018-04-12 06:45:28'),
(15, '2018-04-05', '5', '-10;-15;-20', '1142.41', '1.52', '1736.47', '1.6', '81.13', '2.68', NULL, '2018-04-12 06:46:08'),
(16, '2018-04-06', '8', '-5', '846.15', '2.08', '1760', '4.54', '107.65', '5.97', 'High Grade', '2018-04-12 07:59:56'),
(17, '2018-04-08', '9', '-05   ', '454.98', '2.11', '960', '1.51', '78.13', '2.55', 'Medium Grade', '2018-04-12 08:08:05'),
(18, '2018-03-31', '10', '-60;-65', '4178.57', '1.68', '7020', '4.18', '131.56', '5.93', 'High Grade', '2018-04-07 07:34:00'),
(19, '2018-03-31', '11', '-20', '2000', '1.68', '3360', '1.47', '60.74', '2.28', 'Medium Grade', '2018-04-07 07:34:38'),
(20, '2018-04-05', '12', '-7.5', '0', '0', '0.00', '0', '0', '0', NULL, '2018-04-12 06:47:32'),
(21, '2018-03-31', '14', '-10', '399.4', '1.68', '671', '1.21', '42.45', '1.78', 'Marginal', '2018-04-07 23:41:20'),
(22, '2018-04-06', '15', '-5', '107196.03', '2.08', '222967.74', '0.7', '30.98', '1.11', 'Marginal', '2018-04-12 08:00:58'),
(23, '2018-03-31', '17', '-25', '142.54', '1.68', '239.47', '0.81', '43.16', '1.39', 'Marginal', '2018-04-07 23:42:22'),
(24, '2018-04-06', '13', '55 ', '489.71', '1.36', '666', '0.66', '29.36', '1.05', 'Marginal', '2018-04-12 07:57:44'),
(25, '2018-04-06', '4', '55  ', '271.94', '1.39', '378', '3', '11.85', '3.16', 'Medium Grade', '2018-04-12 07:58:48'),
(26, '2018-04-05', '20', '5', '24952.95', '1.24', '30941.66', '1.6', '70', '2.53', NULL, '2018-04-12 07:01:56');

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `augersample`
--
ALTER TABLE `augersample`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `boulder`
--
ALTER TABLE `boulder`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `closingstock`
--
ALTER TABLE `closingstock`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `closingstockgrade`
--
ALTER TABLE `closingstockgrade`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `oreinventory`
--
ALTER TABLE `oreinventory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `oreinventorygeneral`
--
ALTER TABLE `oreinventorygeneral`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `oreline`
--
ALTER TABLE `oreline`
MODIFY `id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `oremined`
--
ALTER TABLE `oremined`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pit`
--
ALTER TABLE `pit`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
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
MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stockpile`
--
ALTER TABLE `stockpile`
MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `stockpilesample`
--
ALTER TABLE `stockpilesample`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tostockpile`
--
ALTER TABLE `tostockpile`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
