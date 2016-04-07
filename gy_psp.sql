-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2016 at 05:41 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gy_psp`
--
CREATE DATABASE IF NOT EXISTS `gy_psp` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `gy_psp`;

-- --------------------------------------------------------

--
-- Table structure for table `accinfo`
--

CREATE TABLE IF NOT EXISTS `accinfo` (
  `acc_id` int(11) NOT NULL,
  `accemail` varchar(128) NOT NULL,
  `password` varchar(200) NOT NULL,
  `accname` varchar(200) NOT NULL,
  `company` varchar(200) NOT NULL,
  `url` varchar(1024) NOT NULL,
  `flow` int(11) NOT NULL,
  `adminlist` text NOT NULL,
  `registertime` date NOT NULL,
  `lastentrytime` datetime NOT NULL,
  `lastentryip` varchar(32) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`accemail`),
  UNIQUE KEY `accmail` (`accemail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accinfo`
--

INSERT INTO `accinfo` (`acc_id`, `accemail`, `password`, `accname`, `company`, `url`, `flow`, `adminlist`, `registertime`, `lastentrytime`, `lastentryip`, `status`) VALUES
(1, 'test@test.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', 0, '', '2014-11-06', '2016-04-07 16:53:44', '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET gb2312 NOT NULL,
  `category` int(11) NOT NULL,
  `source` varchar(200) COLLATE utf8_bin NOT NULL,
  `author` varchar(50) CHARACTER SET gb2312 NOT NULL,
  `content` text CHARACTER SET gb2312 NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `category`, `source`, `author`, `content`, `date`, `time`, `status`) VALUES
(7, 'aaaaa', 9, '本站发布', '', '<p>adfasfsfsdf</p><p><br/></p><p>asdfsdf</p><p><br/></p><p><br/></p><p>asdfdsf</p>', '0000-00-00', '00:00:00', 0),
(8, 'aaaaaaa', 0, '本站发布', '', '<p>aaaaaa</p>', '0000-00-00', '00:00:00', 0),
(9, 'aaaaaaa', 9, '本站发布', '', '<p>aaaaaa</p>', '0000-00-00', '00:00:00', 0),
(10, 'aaaa', 9, '本站发布', '', '0', '0000-00-00', '00:00:00', 0);

--
-- Triggers `articles`
--
DROP TRIGGER IF EXISTS `empty_check`;
DELIMITER //
CREATE TRIGGER `empty_check` BEFORE INSERT ON `articles`
 FOR EACH ROW if NEW.content = '' then
signal sqlstate '45000';
end if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(45, 1460040819, '127.0.0.1', 'izfk');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(200) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'aaa1'),
(8, 'cce'),
(9, '时势政治');

-- --------------------------------------------------------

--
-- Table structure for table `navibar`
--

CREATE TABLE IF NOT EXISTS `navibar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET gb2312 NOT NULL,
  `type` varchar(20) COLLATE utf8_bin NOT NULL,
  `category` int(11) NOT NULL,
  `url` varchar(256) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Dumping data for table `navibar`
--

INSERT INTO `navibar` (`id`, `name`, `type`, `category`, `url`) VALUES
(2, '时势政治', 'fixedurl', 9, 'http://www.baidu.com'),
(7, '时势政治', 'category', 9, 'index.php/display/category/9'),
(8, 'cce', 'category', 8, 'index.php/display/category/8'),
(10, 'ccc', 'fixedurl', 0, 'aaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(256) COLLATE utf8_bin NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  `thumbnail` varchar(256) COLLATE utf8_bin NOT NULL,
  `url` varchar(500) COLLATE utf8_bin NOT NULL COMMENT '点击跳转链接',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL COMMENT '0 不显示 1 显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `path`, `text`, `thumbnail`, `url`, `timestamp`, `status`) VALUES
(2, '/uploads/slides/administrator.png', '管理员图标', '/uploads/slides/administrator_thumb.png', '', '2016-04-06 15:09:46', 0),
(3, '/uploads/slides/aa.png', 'windows10 desktop', '/uploads/slides/aa_thumb.png', '', '2016-04-06 15:11:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `last_login_ip` varchar(100) COLLATE utf8_bin NOT NULL,
  `last_login_time` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
