-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2014 at 09:26 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

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
(22, 39, 'phonenumber', 'phonenumber', '2014-03-17 15:26:20');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `data_payment`
--

INSERT INTO `data_payment` (`id`, `groupId`, `fieldName`, `value`) VALUES
(1, 0, 'id', '1'),
(2, 0, 'username', 'Marianus'),
(3, 1, 'id', '1'),
(4, 1, 'username', 'Marianus'),
(5, 2, 'nama_actor', 'Satria'),
(6, 2, 'lawan_actor', 'Soraya'),
(7, 2, 'jumlah_pasangan', '2'),
(8, 1, 'nis', '1234'),
(9, 1, 'nama', 'Marianus'),
(10, 1, 'alamat', 'Jl . Legong 1');

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
('e5ce3504d6da70b31b1129d3670d18ec', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', 1395070558, '');

-- --------------------------------------------------------

--
-- Table structure for table `master_data_payment`
--

CREATE TABLE IF NOT EXISTS `master_data_payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupId` int(10) unsigned NOT NULL DEFAULT '0',
  `subModuleId` int(12) NOT NULL DEFAULT '0',
  `timeInsert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `timeUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `master_data_payment`
--

INSERT INTO `master_data_payment` (`id`, `groupId`, `subModuleId`, `timeInsert`, `timeUpdate`) VALUES
(1, 1, 38, '2014-03-17 14:57:56', '2014-03-17 14:57:56'),
(2, 2, 38, '2014-03-17 15:17:54', '2014-03-17 15:17:54'),
(3, 1, 39, '2014-03-17 15:24:20', '2014-03-17 15:24:20');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `master_role_reference`
--

INSERT INTO `master_role_reference` (`id`, `roleIdReference`, `subModuleId`) VALUES
(43, 1, 38),
(44, 2, 38),
(45, 3, 38),
(46, 4, 38),
(47, 1, 39),
(48, 3, 39);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `master_sub_module`
--

INSERT INTO `master_sub_module` (`id`, `moduleId`, `name`, `page`, `timeCreated`) VALUES
(38, 1, 'Filim Bokep', 'Filim_Bokep', '2014-03-15 22:28:36'),
(39, 1, 'TK', 'TK', '2014-03-17 15:23:08');

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
