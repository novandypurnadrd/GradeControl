-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2018 at 11:08 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `user`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
`id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(40) NOT NULL,
  `dep` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `picture` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `name`, `dep`, `role`, `recdate`, `picture`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'Admin', 'Admin', '2018-01-24 07:56:04', 'file_1516780564.JPG'),
(2, 'chandra', '202cb962ac59075b964b07152d234b70', 'Chandra', 'MGS', 'Admin', '2017-03-06 17:11:29', NULL),
(3, 'david.roberto', 'b4a87e9f8929746e33c3d9f1613cc99a', 'David Roberto', 'Management', 'Admin', '2017-03-06 01:23:18', NULL),
(4, 'processplant', 'cb52377b701846d84747d564743c8605', 'Process Plant', 'Process Plant', 'PP1', '2017-03-13 18:39:53', NULL),
(5, 'enviro', 'f170a31806886c5f8f9bd955a7d9928b', 'Enviro', 'HSES', 'ENV1', '2017-03-06 18:29:06', NULL),
(6, 'safety', '46ff61fbc4e94cd9b16b983f8685796a', 'safety', 'HSES', 'SAF1', '2017-03-06 18:29:07', NULL),
(7, 'exploration', 'bb0ec0f3e5e604a3cbe8967ccd7b2279', 'Exploration', 'Exploration', 'EXP1', '2017-03-06 18:29:08', NULL),
(8, 'hr', '4435a4e88e984616a91c109524caf662', 'HR', 'Admin', 'HR1', '2017-03-06 18:29:09', NULL),
(9, 'supply', '2a8badaafbd0dd33b7d97471955afacd', 'Supply Chain', 'SCM', 'SCM1', '2017-03-06 18:29:10', NULL),
(10, 'csr', '1fd215949eedda323c0dc8493354e67a', 'CSR', 'CSR', 'CSR1', '2017-03-06 18:29:13', NULL),
(11, 'dharma', 'e7c24e6474f37428bc4697b72ec4c5e8', 'Franseudo Dharma', 'Admin', 'HR1', '2017-03-24 16:10:03', NULL),
(12, 'intan', 'bef7e7a665c028a50a1063424b75cbc4', 'Yovita Intan', 'Admin', 'HR1', '2017-03-24 16:11:26', NULL),
(13, 'fanny', '58e35ef5454df6a6ab2a7df1126f46a1', 'Fanny Astria', 'Admin', 'HR1', '2017-03-24 16:11:26', NULL),
(14, 'gradecontrol', 'cb0890b677595fc8c76052fe288077af', 'grade control', 'exploration', 'Admin', '2017-05-24 20:47:48', NULL),
(15, 'josua.christanto', 'a8898a670891629da70a94dc79f83f1b', 'Josua Christanto', 'exploration', 'Admin', '2017-06-10 14:05:11', NULL),
(16, 'yuni.kartika', 'b7dfe9096cebb53152aa5ce78a1a61c9', 'Yuni Kartika', 'exploration', 'Admin', '2017-09-06 18:44:21', 'file_1504673061.JPG'),
(17, 'ghea.ayu', 'acb4c394e394ce923a436660c9402c6d', 'Ghea Ayu', 'exploration', 'Admin', '2017-09-06 18:44:46', 'file_1504673086.JPG'),
(18, 'kevin.maleachi', 'd2e7a2105d0fb461fe6f2858cc33942f', 'Kevin Maleachi', 'exploration', 'Admin', '2017-06-10 14:23:12', NULL),
(19, 'febrian.nugraha', '1d9701a994c417dff6dc6d39c31ef0bd', 'Febrian Nugraha', 'exploration', 'Admin', '2017-09-06 18:45:19', 'file_1504673119.JPG'),
(20, 'anti.dwi', '20ab8fc5810e481f7602680fac630669', 'Anti Dwi', 'exploration', 'Admin', '2017-09-23 18:18:34', 'file_1506140314.jpg'),
(21, 'nugroho.nur', '77f5f3e6944139e8437279a63b2817c9', 'Nugroho Nur', 'exploration', 'Admin', '2017-09-06 18:46:38', 'file_1504673197.JPG'),
(22, 'girlly.marchlina', '32784abda824619bc7718fdfe4e1ce5d', 'Girlly Marchlina', 'exploration', 'Admin', '2017-10-05 17:45:34', 'file_1504673227.JPG'),
(23, 'muhammad.ramli', 'e21750ad04218dc1e6c27082a17c8907', 'Muhammad Ramli', 'exploration', 'Admin', '2017-09-06 18:47:41', 'file_1504673261.JPG'),
(24, 'maria.fransiska ', 'f8461b554d59b3014e8ff5165dc62fac', 'Maria Fransiska', 'exploration', 'Admin', '2017-09-06 18:48:08', 'file_1504673287.JPG'),
(25, 'norlaila', 'c6986024f026346bd0eb12050f391b4b', 'Norlaila', 'exploration', 'Admin', '2017-09-06 18:48:37', 'file_1504673317.jpg'),
(26, 'usertest', '806b2af4633e64af88d33fbe4165a06a', 'User Test', 'drilling', 'Admin', '2017-10-29 00:52:16', NULL),
(27, 'ktt', ' bfd6ef6fafc92e014d84eefce9d82e9a', 'KTT KBK', 'KTT', 'ReadOnly', '2017-12-01 07:00:22', NULL),
(28, 'subiyanto', '25ccbcd77bffe306b43392a47aadd182', 'Subiyanto', 'Drilling', 'ReadOnly', '2017-12-01 06:59:17', NULL),
(29, 'sukardi', '25ccbcd77bffe306b43392a47aadd182', 'Sukardi', 'Drilling', 'ReadOnly', '2017-12-01 06:59:22', NULL),
(30, 'tommy.viriya', '25ccbcd77bffe306b43392a47aadd182', 'Tommy Viria', 'Drilling', 'FullAccess', '2017-12-01 06:59:28', NULL),
(31, 'ali.mustofa', '25ccbcd77bffe306b43392a47aadd182', 'Ali Mustofa', 'Drilling', 'FullAccess', '2017-12-01 06:59:33', NULL),
(32, 'meidi.andino', '35e26e72c791ee1df4425071db6b68f0', 'Meidi Andino', 'Drilling', 'FullAccess', '2017-12-18 01:33:51', NULL),
(33, 'muhammad.yusuf', '25ccbcd77bffe306b43392a47aadd182', 'Muhammad Yusuf', 'Drilling', 'ReadOnly', '2017-12-01 06:59:42', NULL),
(34, 'ludy.dwi', '25ccbcd77bffe306b43392a47aadd182', 'Ludy Dwi', 'Drilling', 'ReadOnly', '2017-12-01 06:59:47', NULL),
(35, 'dwi.puspa', '25ccbcd77bffe306b43392a47aadd182', 'Dwi Puspa', 'Drilling', 'FullAccess', '2017-12-01 06:59:51', NULL),
(36, 'silvana.marcelina', '25ccbcd77bffe306b43392a47aadd182', 'Silvana Marcelina', 'Drilling', 'FullAccess', '2017-12-01 06:59:56', NULL),
(37, 'ratna.dsamosir', 'f1b24f186df30430fd244e55ddae00c8', 'Ratna D Samosir', 'Drilling', 'FullAccess', '2017-12-18 09:54:47', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
