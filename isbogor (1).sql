-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2014 at 10:24 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `isbogor`
--
CREATE DATABASE IF NOT EXISTS `isbogor` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `isbogor`;

-- --------------------------------------------------------

--
-- Table structure for table `configuration_field_submodule`
--

CREATE TABLE IF NOT EXISTS `configuration_field_submodule` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `subModuleId` int(12) NOT NULL DEFAULT '0',
  `label` varchar(200) NOT NULL DEFAULT '',
  `field` varchar(200) NOT NULL DEFAULT '',
  `timeUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `configuration_field_submodule`
--

INSERT INTO `configuration_field_submodule` (`id`, `subModuleId`, `label`, `field`, `timeUpdated`) VALUES
(13, 38, 'nama actor', 'nama_actor', '2014-03-17 15:17:23'),
(14, 38, 'lawan actor', 'lawan_actor', '2014-03-17 15:17:23'),
(15, 38, 'jumlah pasangan', 'jumlah_pasangan', '2014-03-17 15:17:23'),
(19, 39, 'nis', 'nis', '2014-03-17 15:26:20'),
(20, 39, 'name', 'name', '2014-03-17 15:26:20'),
(21, 39, 'address', 'address', '2014-03-17 15:26:20'),
(22, 39, 'phonenumber', 'phonenumber', '2014-03-17 15:26:20'),
(29, 1, 'username', 'username', '2014-03-19 07:31:53'),
(30, 1, 'password', 'password', '2014-03-19 07:31:53'),
(31, 3, 'info', 'info', '2014-03-19 07:33:05'),
(32, 3, 'pembayaran', 'pembayaran', '2014-03-19 07:33:05'),
(33, 3, 'total', 'total', '2014-03-19 07:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `config_view`
--

CREATE TABLE IF NOT EXISTS `config_view` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL DEFAULT '',
  `path` varchar(800) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `config_view`
--

INSERT INTO `config_view` (`id`, `name`, `path`, `type`) VALUES
(1, 'bootstrap_min_css', 'asset/custom_1/bootstrap/css/bootstrap.min.css', 'link'),
(2, 'bootstrap_min_responsive_css', 'asset/custom_1/bootstrap/css/bootstrap-responsive.min.css', 'link'),
(3, 'themes_css_bootstrappage.css', 'asset/custom_1/themes/css/bootstrappage.css', 'link'),
(4, 'themes_flexslider_css', 'asset/custom_1/themes/css/flexslider.css', 'link'),
(5, 'themes_main_css', 'asset/custom_1/themes/css/main.css', 'link'),
(6, 'jquery_min_js', 'asset/custom_1/themes/js/jquery-1.7.2.min.js', 'script'),
(7, 'bootstrap_min_js', 'asset/custom_1/bootstrap/js/bootstrap.min.js', 'script'),
(8, 'super_fish_js', 'asset/custom_1/themes/js/superfish.js', 'script'),
(9, 'bootstrap_min_js', 'asset/custom_1/themes/js/jquery.scrolltotop.js', 'script'),
(10, 'common_js', 'asset/custom_1/themes/js/common.js', 'script'),
(11, 'jquery_flexslider_min_js', 'asset/custom_1/themes/js/jquery.flexslider-min.js', 'script');

-- --------------------------------------------------------

--
-- Table structure for table `data_payment`
--

CREATE TABLE IF NOT EXISTS `data_payment` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `groupId` int(10) unsigned NOT NULL DEFAULT '0',
  `fieldName` varchar(100) NOT NULL DEFAULT '',
  `value` varchar(999) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `data_payment`
--

INSERT INTO `data_payment` (`id`, `groupId`, `fieldName`, `value`) VALUES
(1, 1, 'name', 'Marianus Desato Paulo Djemana'),
(2, 1, 'address', 'Jl. Legong 1 No. 18 Depok 2 Utara'),
(3, 1, 'date_of_birth', '8 September 2012'),
(4, 2, 'name', 'Raga Pinilih'),
(5, 2, 'address', 'Jalan Benda Atas'),
(6, 2, 'date_of_birth', '7 November 1990'),
(7, 3, 'username', 'ari'),
(8, 3, 'password', 'manusia'),
(9, 1, 'info', 'Pembayaran Toefl'),
(10, 1, 'pembayaran', '1000000000'),
(11, 1, 'total', '1000000000');

-- --------------------------------------------------------

--
-- Table structure for table `isb_sessions`
--

CREATE TABLE IF NOT EXISTS `isb_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `isb_sessions`
--

INSERT INTO `isb_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('11ddc421ddc659914e5e40438a4f7f9a', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', 1395151737, 'a:8:{s:9:"user_data";s:0:"";s:8:"username";s:5:"admin";s:5:"email";s:20:"aridjemana@gmail.com";s:6:"roleId";s:1:"1";s:8:"roleName";s:11:"Super Admin";s:10:"first_name";s:5:"Super";s:9:"last_name";s:5:"Admin";s:9:"logged_in";b:1;}'),
('2c50db7222ac943d8a792bec95edfa5a', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', 1395156252, ''),
('79b52c7b88d7e6a9af1f739771ebcdc8', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', 1395214431, '');

-- --------------------------------------------------------

--
-- Table structure for table `master_data_payment`
--

CREATE TABLE IF NOT EXISTS `master_data_payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupId` int(10) unsigned NOT NULL DEFAULT '0',
  `subModuleId` int(12) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `timeInsert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `timeUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `master_data_payment`
--

INSERT INTO `master_data_payment` (`id`, `groupId`, `subModuleId`, `title`, `timeInsert`, `timeUpdate`) VALUES
(1, 1, 1, 'Marianus Desato Paulo Djemana', '2014-03-18 12:59:47', '2014-03-18 12:59:47'),
(2, 2, 1, 'Raga Pinilih', '2014-03-18 15:21:49', '2014-03-18 15:21:49'),
(3, 3, 1, 'ari', '2014-03-19 07:32:02', '2014-03-19 07:32:02'),
(4, 1, 3, 'Pembayaran Toefl', '2014-03-19 07:33:32', '2014-03-19 07:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `master_module`
--

CREATE TABLE IF NOT EXISTS `master_module` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `timeCreated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `timeUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `master_module`
--

INSERT INTO `master_module` (`id`, `name`, `timeCreated`, `timeUpdated`) VALUES
(1, 'payment', '2014-03-14 17:00:00', '2014-03-15 07:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `master_role`
--

CREATE TABLE IF NOT EXISTS `master_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `roleId` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `master_role`
--

INSERT INTO `master_role` (`id`, `name`, `roleId`) VALUES
(1, 'Super Admin', 1),
(2, 'IT', 2),
(3, 'Tata Usaha', 3),
(4, 'Marketing', 4);

-- --------------------------------------------------------

--
-- Table structure for table `master_role_reference`
--

CREATE TABLE IF NOT EXISTS `master_role_reference` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `roleIdReference` int(10) unsigned NOT NULL DEFAULT '0',
  `subModuleId` int(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `master_role_reference`
--

INSERT INTO `master_role_reference` (`id`, `roleIdReference`, `subModuleId`) VALUES
(43, 1, 38),
(44, 2, 38),
(45, 3, 38),
(46, 4, 38),
(47, 1, 39),
(48, 3, 39),
(49, 1, 1),
(50, 2, 1),
(51, 3, 1),
(52, 1, 2),
(53, 2, 2),
(54, 4, 2),
(55, 1, 3),
(56, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `master_sub_module`
--

CREATE TABLE IF NOT EXISTS `master_sub_module` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `moduleId` int(12) NOT NULL,
  `name` varchar(150) NOT NULL,
  `page` varchar(100) NOT NULL,
  `timeCreated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `master_sub_module`
--

INSERT INTO `master_sub_module` (`id`, `moduleId`, `name`, `page`, `timeCreated`) VALUES
(1, 1, 'TK', 'TK', '2014-03-18 12:25:24'),
(2, 1, 'SD', 'SD', '2014-03-19 07:31:19'),
(3, 1, 'Invoice', 'Invoice', '2014-03-19 07:32:34');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `roleId` int(2) unsigned NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '',
  `username` varchar(150) NOT NULL DEFAULT '',
  `password` varchar(800) NOT NULL DEFAULT '',
  `first_name` varchar(200) NOT NULL DEFAULT '',
  `last_name` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `roleId`, `email`, `username`, `password`, `first_name`, `last_name`) VALUES
(1, 1, 'aridjemana@gmail.com', 'admin', 'NBXHKndF/Wik4k776I/fMmCKr1WxqKqZZim/jJ/WVa7NsdEYW/hJWq+bbyXOGGEXBc4R/GgV0fSOpo4HRPpCAQ==', 'Super', 'Admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
