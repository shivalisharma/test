-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 09, 2015 at 09:56 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pdonew`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_worker_relation`
--

CREATE TABLE IF NOT EXISTS `admin_worker_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `admin_worker_relation`
--

INSERT INTO `admin_worker_relation` (`id`, `admin_id`, `worker_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(7, 4, 7),
(8, 4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `login_admin`
--

CREATE TABLE IF NOT EXISTS `login_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `message` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `login_admin`
--

INSERT INTO `login_admin` (`id`, `username`, `email`, `password`, `creation_date`, `message`) VALUES
(1, 'shivali', 'shivali@impingeonline.com', '81dc9bdb52d04dc20036dbd8313ed055', '2015-01-15 20:54:07', 'hello'),
(2, 'Satish', 'satishsaini@impingeonline.com', 'df1514b3db92d4930eb976649fdcc947', '2014-10-28 03:17:34', 'hello'),
(3, 'kapil', 'shivali@impingeonline.com', '552dbfedcffe3231d818b27b88fa8219', '2014-11-05 02:53:51', 'hi'),
(4, 'Ghan Shyam', 'ghanshyam@impingeonline.com', '81dc9bdb52d04dc20036dbd8313ed055', '2015-01-23 03:20:40', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `payer_consumer_relation`
--

CREATE TABLE IF NOT EXISTS `payer_consumer_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payer_id` int(11) NOT NULL,
  `tea_rel_id` int(11) NOT NULL,
  `consumer_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `amount_to_pay` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 for not paid, 1 for paid',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `payer_consumer_relation`
--

INSERT INTO `payer_consumer_relation` (`id`, `payer_id`, `tea_rel_id`, `consumer_id`, `date`, `amount_to_pay`, `status`) VALUES
(9, 3, 3, 2, '2015-01-23 16:31:35', 7, '0'),
(10, 3, 3, 3, '2015-01-23 16:31:35', 7, '0'),
(11, 3, 3, 4, '2015-01-23 16:31:35', 7, '0'),
(12, 5, 4, 1, '2015-01-23 16:32:09', 7, '0'),
(13, 5, 4, 2, '2015-01-23 16:32:09', 7, '0'),
(14, 5, 4, 3, '2015-01-23 16:32:09', 7, '0'),
(15, 5, 4, 4, '2015-01-23 16:32:09', 7, '0'),
(16, 5, 4, 5, '2015-01-23 16:32:09', 7, '0'),
(27, 2, 6, 3, '2015-01-29 10:34:29', 8, '0'),
(26, 2, 6, 2, '2015-01-29 10:34:29', 8, '0'),
(22, 3, 7, 2, '2015-01-28 10:34:53', 5, '0'),
(23, 3, 7, 3, '2015-01-28 10:34:53', 5, '0'),
(24, 3, 8, 2, '2015-01-28 05:35:17', 5, '0'),
(25, 3, 8, 3, '2015-01-28 05:35:17', 5, '0'),
(28, 4, 9, 1, '2015-01-29 16:31:29', 7, '0'),
(29, 4, 9, 2, '2015-01-29 16:31:29', 7, '0'),
(30, 4, 9, 3, '2015-01-29 16:31:29', 7, '0'),
(31, 4, 9, 4, '2015-01-29 16:31:29', 7, '0'),
(32, 2, 10, 1, '2015-01-29 16:31:54', 6, '0'),
(33, 2, 10, 2, '2015-01-29 16:31:54', 6, '0'),
(34, 2, 10, 3, '2015-01-29 16:31:54', 6, '0'),
(35, 2, 10, 4, '2015-01-29 16:31:54', 6, '0'),
(36, 2, 11, 1, '2015-02-03 17:24:43', 4, '0'),
(37, 2, 11, 2, '2015-02-03 17:24:43', 4, '0'),
(38, 2, 11, 3, '2015-02-03 17:24:43', 4, '0'),
(39, 2, 11, 4, '2015-02-03 17:24:43', 4, '0'),
(40, 2, 11, 5, '2015-02-03 17:24:43', 4, '0'),
(46, 3, 12, 4, '2015-02-02 10:25:13', 7, '0'),
(45, 3, 12, 3, '2015-02-02 10:25:13', 7, '0'),
(44, 3, 12, 2, '2015-02-02 10:25:13', 7, '0'),
(47, 4, 13, 2, '2015-02-03 10:30:23', 9, '0'),
(48, 4, 13, 3, '2015-02-03 10:30:23', 9, '0'),
(49, 4, 13, 4, '2015-02-03 10:30:23', 9, '0'),
(50, 3, 14, 3, '2015-02-04 11:56:55', 6, '0'),
(51, 3, 14, 4, '2015-02-04 11:56:55', 6, '0'),
(52, 1, 15, 1, '2015-02-05 17:00:48', 6, '0'),
(53, 1, 15, 2, '2015-02-05 17:00:48', 6, '0'),
(54, 1, 15, 3, '2015-02-05 17:00:48', 6, '0'),
(55, 1, 15, 4, '2015-02-05 17:00:48', 6, '0'),
(56, 2, 16, 2, '2015-02-06 17:01:39', 6, '0'),
(57, 2, 16, 3, '2015-02-06 17:01:39', 6, '0');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `posts`
--


-- --------------------------------------------------------

--
-- Table structure for table `tea_entry`
--

CREATE TABLE IF NOT EXISTS `tea_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `who_paid` varchar(255) NOT NULL,
  `money` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `shift` varchar(255) NOT NULL,
  `who_paid_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tea_entry`
--

INSERT INTO `tea_entry` (`id`, `who_paid`, `money`, `date`, `shift`, `who_paid_id`) VALUES
(3, 'Shivali Sharma', 20, '2015-01-23 16:31:35', 'Morning', 3),
(4, 'Preet Pal', 35, '2015-01-23 16:32:09', 'Evening', 5),
(6, 'Kiran Kashyap', 16, '2015-01-29 10:34:29', 'Morning', 2),
(7, 'Shivali Sharma', 10, '2015-01-28 10:34:53', 'Morning', 3),
(8, 'Shivali Sharma', 10, '2015-01-28 05:35:17', 'Evening', 3),
(9, 'Pintu Kumar', 28, '2015-01-29 16:31:29', 'Evening', 4),
(10, 'Kiran Kashyap', 24, '2015-01-29 16:31:54', 'Evening', 2),
(11, 'Kiran Kashyap', 20, '2015-02-03 17:24:43', 'Evening', 2),
(12, 'Shivali Sharma', 20, '2015-02-02 10:25:13', 'Morning', 3),
(13, 'Pintu Kumar', 28, '2015-02-03 10:30:23', 'Morning', 4),
(14, 'Shivali Sharma', 12, '2015-02-04 11:56:55', 'Morning', 3),
(15, 'Satish Saini', 24, '2015-02-05 17:00:48', 'Evening', 1),
(16, 'Kiran Kashyap', 12, '2015-02-06 17:01:39', 'Morning', 2);

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE IF NOT EXISTS `worker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `designation` varchar(255) CHARACTER SET utf8 NOT NULL,
  `admin_id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`id`, `name`, `email`, `designation`, `admin_id`, `phone`) VALUES
(1, 'Satish Saini', 'satishsaini@impingeonline.com', 'Team Lead', 1, '9034302495'),
(2, 'Kiran Kashyap', 'kiran@impingeonline.com', 'Software Developer', 1, '7355838574'),
(3, 'Shivali Sharma', 'shivali@impingeonline.com', 'Web Developer', 1, '9876686789'),
(4, 'Pintu Kumar', 'pintu@impingeonline.com', 'Web Developer', 1, '9988636506'),
(5, 'Preet Pal', 'preetpal@impingeonline.com', 'Sr. Web Developer', 1, '9888055235'),
(7, 'Rashmi', 'rashmi@impingeonline.com', 'Software Developer', 4, '3849032489'),
(8, 'Ghan Shyam', 'ghanshyam@impingeonline.com', 'Team Leader', 4, '3432534534');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
