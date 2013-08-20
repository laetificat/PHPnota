-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 20, 2013 at 05:30 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.21

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phpinvoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `name` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `isAdmin` int(1) NOT NULL DEFAULT '0',
  `ownerOf` varchar(100) NOT NULL,
  `language` varchar(100) NOT NULL DEFAULT 'english',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `companyinfo`
--

CREATE TABLE IF NOT EXISTS `companyinfo` (
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `kvk` varchar(50) NOT NULL,
  `btw` varchar(50) NOT NULL,
  `bankAccount` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `filename` varchar(255) NOT NULL,
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `date` varchar(14) NOT NULL,
  `type` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
