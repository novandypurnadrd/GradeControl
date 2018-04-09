-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2017 at 12:12 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `closingstock`
--

INSERT INTO `closingstock` (`id`, `Date`, `Stockpile`, `Volume`, `Density`, `Tonnes`, `Au`, `Ag`, `AuEq75`, `Class`, `Status`, `usrid`, `recdate`) VALUES
(1, '2017-09-30', 2, '223.684210', '1.9', '425', '1.56', '82.64', '2.66', 'Mid Grade', 'Pending', '', '2017-10-31 00:10:16');

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
  `Class` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `closingstockgrade`
--

INSERT INTO `closingstockgrade` (`id`, `Date`, `Stockpile`, `Tonnes`, `Au`, `Ag`, `AuEq75`, `Class`) VALUES
(1, '2017-09-30', '2', '425', '1.56', '82.64', '2.66', 'Mid Grade');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loader`
--

INSERT INTO `loader` (`id`, `Capacity`, `Density`, `Tonnage`, `Percentage`, `Tonnageper`, `Material`, `Equipment`, `usrid`, `recdate`) VALUES
(14, '4.2', '1.5', '6.30', '0.9', '5.67', 'Clay', '966H_Clay', 'yuni.kartika', '2017-10-11 00:29:55'),
(15, '4.2', '1.5', '6.30', '1', '6.30', 'Clayfull', '966H_Clayfull', 'yuni.kartika', '2017-10-11 00:31:21'),
(16, '4.2', '1.8', '7.56', '0.85', '6.426', 'Transisi', '966H_Transisi', 'yuni.kartika', '2017-10-14 00:14:55'),
(17, '4.2', '2.1', '8.82', '0.9051', '7.9829', 'Fresh', '966H_Fresh', 'yuni.kartika', '2017-10-14 00:15:25'),
(18, '4.2', '2.1', '8.82', '0.7925', '6.9898', 'Bypass', '966H_Bypass', 'yuni.kartika', '2017-10-14 00:16:45'),
(19, '3.5', '2.1', '7.35', '0.90514285', '6.6528', 'Fresh', '966F_Fresh', 'nugroho.nur', '2017-10-14 00:17:44'),
(20, '3.5', '1.5', '5.25', '1.13333333', '5.9499', 'Clayfull', '966F_Clayfull', 'nugroho.nur', '2017-10-14 00:18:17'),
(21, '3.5', '2.1', '7.35', '0.704', '5.1744', 'Bypass', '966F_Bypass', 'nugroho.nur', '2017-10-14 00:18:43');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
`Id` int(11) NOT NULL,
  `Nama` varchar(20) NOT NULL,
  `usrid` varchar(20) NOT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`Id`, `Nama`, `usrid`, `recdate`) VALUES
(1, 'BSW', 'yuni.kartika', '2017-10-15 03:38:16'),
(2, 'NK', 'yuni.kartika', '2017-10-15 03:39:43');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oreinventory`
--

CREATE TABLE IF NOT EXISTS `oreinventory` (
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
  `Status` varchar(15) NOT NULL,
  `Achievement` varchar(10) NOT NULL,
  `Density` varchar(10) DEFAULT NULL,
  `Note` varchar(100) DEFAULT NULL,
  `usrid` varchar(20) NOT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oreinventory`
--

INSERT INTO `oreinventory` (`id`, `Pit`, `Block`, `RL`, `Type`, `Au`, `Ag`, `AuEq75`, `Class`, `Dbdensity`, `DryTonBM`, `DryTonFF`, `Start`, `Finish`, `StartHour`, `FinishHour`, `Stockpile`, `Status`, `Achievement`, `Density`, `Note`, `usrid`, `recdate`) VALUES
(1, 1, 'stockpile_a1', '', 'Ore', '1.56', '82.64', '2.66', 'Mid Grade', '1.9', '425', '425', '2017-09-30', '2017-09-30', '06:00', '06:01', '2', 'Completed', '100', '1.9', NULL, 'josua.christanto', '2017-10-31 00:10:16');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oreline`
--

INSERT INTO `oreline` (`id`, `File`, `pit`, `Volume`, `Tonnes`, `Au`, `Ag`, `Aueq`, `Class`, `Dbdensity`, `Partial`, `Actual`, `status`, `recdate`, `usrid`) VALUES
(1, 'stockpile_a1', 1, '223.68', '425', '1.56', '82.64', '2.66', 'Mid Grade', '1.9', '1', '425', 'Continue', '2017-10-30 01:01:02', 'josua.christanto'),
(2, 'stockpile_a2', 1, '601.05', '1142', '2.06', '95.47', '3.33', 'Mid Grade', '1.9', '1', '1142', 'Continue', '2017-10-30 01:01:12', 'josua.christanto'),
(4, 'stockpile_d2', 1, '815.79', '1550', '0.79', '41.94', '1.35', 'Marginal', '1.9', '1', '1550', 'Continue', '2017-10-30 01:01:27', 'josua.christanto'),
(5, 'stockpile_h', 1, '25504.31', '48458.2', '0.71', '37.02', '1.2', 'Marginal', '1.9', '1', '48458.2', 'Continue', '2017-10-30 01:02:11', 'josua.christanto'),
(6, 'stockpile_k', 1, '22735.25', '34102.88', '0.71', '38.72', '1.23', 'Marginal', '1.5', '1', '34102.88', 'Continue', '2017-10-30 01:02:23', 'josua.christanto'),
(7, 'stockpile_d1', 2, '214.29', '450', '0.5', '40', '1.03', 'Marginal', '2.1', '1', '450', 'Continue', '2017-10-30 01:02:33', 'josua.christanto'),
(8, 'stockpile_i', 2, '172283.11', '361794.52', '0.71', '30.09', '1.11', 'Marginal', '2.1', '1', '361794.52', 'Continue', '2017-10-30 01:02:42', 'josua.christanto'),
(9, 'stockpile_j2', 2, '1088.11', '2285.04', '1.31', '51.27', '2', 'Marginal', '2.1', '1', '2285.04', 'Continue', '2017-10-30 01:02:55', 'josua.christanto'),
(10, 'nk_10b_12p5_07', 1, '42.97', '89.63', '1.21', '20.81', '1.49', 'Marginal', '2.09', '0.76', '68.12', 'Continue', '2017-10-30 01:03:30', 'josua.christanto'),
(11, 'nk_15b_15_09', 1, '30.27', '64.88', '0.52', '29.57', '0.91', 'Marginal', '2.14', '0.87', '56.44', 'Continue', '2017-10-30 01:10:42', 'josua.christanto'),
(12, 'nk_15c_17p5_06', 1, '30.27', '64.19', '1.6', '53.19', '2.31', 'Mid Grade', '2.12', '0.75', '48.14', 'Continue', '2017-10-30 01:10:48', 'josua.christanto'),
(13, 'nk_15c_17p5_07', 1, '69.34', '170.11', '2', '141.25', '3.89', 'Mid Grade', '2.45', '0.83', '141.19', 'Continue', '2017-10-30 01:10:55', 'josua.christanto'),
(14, 'nk_15c_17p5_08', 1, '140.63', '335.2', '3.14', '38.7', '3.65', 'Mid Grade', '2.38', '0.91', '305.03', 'Continue', '2017-10-30 01:11:02', 'josua.christanto'),
(15, 'nk_15c_17p5_09', 1, '29.3', '61.33', '1.29', '100.63', '2.63', 'Mid Grade', '2.09', '0.91', '55.81', 'Continue', '2017-10-30 01:11:07', 'josua.christanto'),
(16, 'nk_15c_17p5_10', 1, '36.13', '84.5', '1.84', '47.53', '2.48', 'Mid Grade', '2.34', '0.9', '76.05', 'Continue', '2017-10-30 01:11:14', 'josua.christanto');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pit`
--

INSERT INTO `pit` (`id`, `Nama`, `usrid`, `recdate`) VALUES
(1, 'North Kuning', 'gradecontrol', '2017-09-05 01:56:34'),
(2, 'Bakam', 'anti.dwi', '2017-09-06 18:54:58'),
(3, 'North Bakam', 'anti.dwi', '2017-09-06 18:55:06');

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
  `Tonnes` varchar(20) DEFAULT NULL,
  `Au` varchar(10) DEFAULT NULL,
  `Ag` varchar(10) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

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
(20, 'Scat', 'josua.christanto', '2017-09-09 14:40:44');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tostockpile`
--

INSERT INTO `tostockpile` (`id`, `Date`, `Stockpile`, `RL`, `Volume`, `Density`, `Tonnes`, `Au`, `Ag`, `AuEq75`, `Class`, `recdate`) VALUES
(1, '2017-09-30', '2', '', '223.68', '1.9', '425', '1.56', '82.64', '2.66', 'Medium Grade', '2017-10-31 00:10:16');

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
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `closingstock`
--
ALTER TABLE `closingstock`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `closingstockgrade`
--
ALTER TABLE `closingstockgrade`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orefeed`
--
ALTER TABLE `orefeed`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `oreinventory`
--
ALTER TABLE `oreinventory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `oreline`
--
ALTER TABLE `oreline`
MODIFY `id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `oremined`
--
ALTER TABLE `oremined`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pit`
--
ALTER TABLE `pit`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `stockpilesample`
--
ALTER TABLE `stockpilesample`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tostockpile`
--
ALTER TABLE `tostockpile`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
