-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 26, 2019 at 04:47 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_number` int(11) DEFAULT NULL,
  `amount` float NOT NULL DEFAULT '15000',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `account_number`, `amount`, `user_id`) VALUES
(1, 80542354, 1970370, 1),
(5, 81000867, 3595.75, 22),
(4, 80358923, 15000, 21),
(6, 8925648, 21500, 23),
(7, 6787956, 15000, 24),
(8, 85358923, 38000, 25),
(9, 80353923, 12000, 26),
(11, 80935641, 20000, 27);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `NIC` text NOT NULL,
  `password` varchar(20) NOT NULL,
  `log_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `log_out_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `number` int(11) NOT NULL,
  `img_path` varchar(20) NOT NULL,
  `img` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `user_name`, `email`, `NIC`, `password`, `log_time`, `log_out_time`, `isActive`, `number`, `img_path`, `img`) VALUES
(1, 'A.M.Lahiru', 'sampath', 'admin', 'lahirusampath8899@gmail.com', '980250849V', '12', '2019-10-20 10:41:52', '2019-10-20 11:20:27', 1, 763304183, '../upload/', '4-sea-beach-sand-wallpaper.jpg'),
(3, 'S.A.Saman', ' Kumara', 'admin', 'sampath980250@gmail.com', '972458962V', '1212', '2019-07-06 15:36:50', '2019-07-14 21:21:16', 1, 703129153, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `bill_payment`
--

DROP TABLE IF EXISTS `bill_payment`;
CREATE TABLE IF NOT EXISTS `bill_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(20) NOT NULL,
  `status` varchar(15) NOT NULL,
  `amount` float NOT NULL,
  `date` date NOT NULL,
  `type` varchar(40) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_payment`
--

INSERT INTO `bill_payment` (`id`, `number`, `status`, `amount`, `date`, `type`, `user_id`) VALUES
(1, 80542354, 'succuss', 800, '2019-09-04', 'Dialog', 1),
(2, 763301183, 'succuss', 800, '2019-09-04', 'Dialog', 1),
(3, 763301183, 'succuss', 800, '2019-09-04', 'Dialog', 1),
(4, 763301183, 'succuss', 800, '2019-09-04', 'Dialog', 1),
(5, 763301183, 'succuss', 800, '2019-09-04', 'Dialog', 1),
(6, 763301183, 'succuss', 800, '2019-09-04', 'Dialog', 1),
(7, 763301183, 'succuss', 800, '2019-09-04', 'Dialog', 1),
(8, 763301183, 'succuss', 800, '2019-09-04', 'Dialog', 1),
(36, 763304183, 'succuss', 70, '2019-09-14', 'Dialog', 1),
(10, 763301183, 'succuss', 800, '2019-09-04', 'Dialog', 1),
(11, 763301183, 'succuss', 800, '2019-09-04', 'Dialog', 1),
(12, 789895772, 'succuss', 50, '2019-09-04', 'Hutch', 1),
(13, 789895772, 'succuss', 50, '2019-09-04', 'Hutch', 1),
(15, 789895772, 'succuss', 50, '2019-09-04', 'Hutch', 1),
(16, 789895772, 'succuss', 50, '2019-09-04', 'Hutch', 1),
(17, 789895772, 'fail', 50, '2019-09-04', 'Hutch', 1),
(18, 789895772, 'succuss', 50, '2019-09-04', 'Hutch', 1),
(19, 789895772, 'succuss', 50, '2019-09-04', 'Hutch', 1),
(20, 789895772, 'succuss', 50, '2019-09-04', 'Hutch', 1),
(21, 789895772, 'succuss', 50, '2019-09-04', 'Hutch', 1),
(22, 763301183, 'succuss', 50, '2019-09-04', 'Dialog', 1),
(23, 763301183, 'succuss', 50, '2019-09-04', 'Dialog', 1),
(24, 763301183, 'succuss', 50, '2019-09-04', 'Dialog', 1),
(35, 763301183, 'succuss', 50, '2019-09-11', 'Dialog', 1),
(26, 763301183, 'succuss', 50, '2019-09-11', 'Dialog', 1),
(27, 763301183, 'succuss', 50, '2019-09-11', 'Dialog', 1),
(28, 763301183, 'succuss', 50, '2019-09-11', 'Dialog', 1),
(29, 703029153, 'succuss', 100, '2019-09-11', 'Mobitel', 1),
(30, 763301183, 'succuss', 50, '2019-09-11', 'Dialog', 1),
(31, 763301183, 'succuss', 50, '2019-09-11', 'Dialog', 1),
(32, 763301183, 'succuss', 50, '2019-09-11', 'Dialog', 1),
(33, 763301183, 'succuss', 50, '2019-09-11', 'Dialog', 1),
(34, 763301183, 'succuss', 50, '2019-09-11', 'Dialog', 1);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(150) NOT NULL,
  `msg` text NOT NULL,
  `dates` date NOT NULL,
  `expire` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `subject`, `msg`, `dates`, `expire`) VALUES
(15, 'Update', 'System Update', '2019-10-20', '2019-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_number` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  `amount` float NOT NULL,
  `date` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `account_number`, `status`, `amount`, `date`, `user_id`) VALUES
(5, 8054823, 'succuss', 100, '2019-08-10', 1),
(6, 8054823, 'succuss', 4500, '2019-08-11', 1),
(7, 8054823, 'succuss', 2000.45, '2019-08-08', 1),
(8, 8054823, 'succuss', 2500.45, '2019-08-10', 1),
(9, 81000876, 'fail', 500000, '2019-08-11', 1),
(10, 8054823, 'succuss', 2500.25, '2019-08-10', 1),
(11, 8054823, 'succuss', 100, '2019-08-09', 1),
(12, 8054823, 'succuss', 3000, '2019-08-10', 1),
(13, 80518390, 'succuss', 200000, '2019-08-10', 1),
(14, 81000876, 'fail', 800000, '2019-08-10', 1),
(15, 81000876, 'succuss', 3000, '2019-08-10', 26),
(16, 80518390, 'succuss', 2500.25, '2019-08-11', 1),
(17, 8054823, 'succuss', 2500.25, '2019-08-11', 1),
(18, 80518390, 'succuss', 2500.25, '2019-08-17', 1),
(19, 2072001, 'succuss', 5000, '2019-08-28', 1),
(20, 20017004, 'succuss', 5000, '2019-08-28', 1),
(21, 20017004, 'succuss', 5000, '2019-08-28', 1),
(22, 20017004, 'succuss', 5000, '2019-08-28', 1),
(23, 20017004, 'succuss', 5000, '2019-08-28', 1),
(24, 20017004, 'succuss', 5000, '2019-08-28', 1),
(25, 20017004, 'succuss', 5000, '2019-08-28', 1),
(26, 20017004, 'succuss', 5000, '2019-08-28', 1),
(27, 895624, 'succuss', 100, '2019-09-11', 1),
(28, 810089562, 'succuss', 1500, '2019-09-13', 1),
(29, 12345, 'succuss', 1500, '2019-09-15', 1),
(30, 12345, 'succuss', 1500, '2019-09-15', 1),
(31, 12345, 'succuss', 1500, '2019-09-15', 1),
(32, 12345, 'succuss', 1500, '2019-09-15', 1),
(33, 12345, 'succuss', 1500, '2019-09-15', 1),
(34, 12345, 'succuss', 1500, '2019-09-15', 1),
(35, 12345, 'succuss', 1500, '2019-09-15', 1),
(36, 12345, 'succuss', 5000, '2019-09-15', 1),
(37, 85358923, 'succuss', 20000, '2019-09-15', 1),
(38, 85358923, 'succuss', 1500, '2019-09-15', 1),
(39, 85358923, 'succuss', 1500, '2019-09-15', 1),
(40, 853589231, 'Fial', 1500, '2019-09-15', 1),
(41, 80935641, 'succuss', 5000, '2019-09-16', 1),
(42, 534234343, 'Fial', 32, '2019-10-24', 1),
(43, 81000867, 'succuss', 32, '2019-10-24', 1),
(44, 81000867, 'succuss', 32, '2019-10-24', 1),
(45, 81000867, 'succuss', 32, '2019-10-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_other_bank`
--

DROP TABLE IF EXISTS `payment_other_bank`;
CREATE TABLE IF NOT EXISTS `payment_other_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_number` int(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `amount` float NOT NULL,
  `bank` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_other_bank`
--

INSERT INTO `payment_other_bank` (`id`, `account_number`, `status`, `amount`, `bank`, `date`, `user_id`) VALUES
(6, 81008589, 'succuss', 5000, 'Boc', '2019-08-28', 1),
(2, 207044292, 'succuss', 5000, 'Commercial Bank', '2019-08-28', 1),
(3, 207044292, 'succuss', 5000, 'Commercial Bank', '2019-08-28', 1),
(4, 207044292, 'succuss', 5000, 'Commercial Bank', '2019-08-28', 1),
(5, 81008589, 'succuss', 2000, 'DFCC', '2019-08-28', 1),
(7, 895624, 'succuss', 23, 'people,s Bank', '2019-09-02', 1),
(8, 85358923, 'succuss', 1500, 'Amana Bank', '2019-09-15', 1),
(9, 5324, 'succuss', 32, 'Boc', '2019-10-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `NIC` varchar(12) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `log_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `path` varchar(10) NOT NULL,
  `img` varchar(100) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `user_name`, `password`, `email`, `NIC`, `phone_number`, `log_time`, `logout_time`, `path`, `img`, `isActive`) VALUES
(1, 'A.Lahiru', 'sampath', 'user', '12', 'lahirusampath8899@gmail.com', '980250849V', 703029153, '2019-10-24 11:14:55', '2019-06-12 14:23:15', '../upload/', '4-sea-beach-sand-wallpaper.jpg', 1),
(25, 'Fasmina', 'musammil', 'fathimina', '71392', 'fathimina04@gmail.com', '972458951V', 784446639, '2019-08-01 13:21:58', '2019-08-01 13:21:58', '../upload/', 'user.png', 1),
(26, 'isanka', 'udayangi', 'isanka', '12', 'isankaudayangi97@gmail.com', '979794548V', 763314583, '2019-09-14 12:35:14', '2019-08-02 08:08:17', '../upload/', 'user.png', 1),
(22, 'A.A Kavindu', 'Lakshan', 'user3', '35282', 'sampath980250@gmail.com', '9724568914v', 789897772, '2019-07-19 17:40:11', '2019-07-19 11:34:03', '../upload/', 'user.png', 1),
(23, 'Ruvindu', 'Madhushanka', 'ruvi', '36147', 'ruvindumadushanka@gmail.com', '973592220V', 784446639, '2019-07-23 22:35:52', '2019-07-23 22:35:52', '../upload/', 'user.png', 1),
(21, 'T.A Dilshan', 'Rathnayake', 'user2', '11543', 'lahirusampath3366@gmail.com', '972458951V', 703029153, '2019-07-19 11:30:03', '2019-07-19 11:30:03', '../upload/', 'user.png', 1),
(27, 'samaka', 'perera', 'u8', '95144', 'is.samaka06@gmail.com', '951225534v', 715605092, '2019-08-14 22:13:24', '2019-08-14 22:11:06', '../upload/', 'user.png', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
