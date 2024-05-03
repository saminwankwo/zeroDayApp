-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 30, 2024 at 02:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zeroProject`
--
CREATE DATABASE IF NOT EXISTS `zeroProject` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `zeroProject`;

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

DROP TABLE IF EXISTS `business`;
CREATE TABLE IF NOT EXISTS `business` (
  `bizId` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `bizEmail` varchar(100) NOT NULL,
  `companyName` varchar(100) NOT NULL,
  `phoneNumber` varchar(40) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `addTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `securityType` varchar(20) NOT NULL,
  `bizImage` varchar(255) NOT NULL,
  PRIMARY KEY (`bizId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `createPassword`
--

DROP TABLE IF EXISTS `createPassword`;
CREATE TABLE IF NOT EXISTS `createPassword` (
  `passID` int(11) NOT NULL AUTO_INCREMENT,
  `BusId` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `expiryTime` datetime NOT NULL,
  `addtime` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`passID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

DROP TABLE IF EXISTS `details`;
CREATE TABLE IF NOT EXISTS `details` (
  `detailsId` int(11) NOT NULL AUTO_INCREMENT,
  `webId` int(11) NOT NULL,
  PRIMARY KEY (`detailsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dns_results`
--

DROP TABLE IF EXISTS `dns_results`;
CREATE TABLE IF NOT EXISTS `dns_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `record_type` varchar(30) NOT NULL,
  `value` varchar(100) NOT NULL,
  `detailsId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dns_results2`
--

DROP TABLE IF EXISTS `dns_results2`;
CREATE TABLE IF NOT EXISTS `dns_results2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detailsId` int(11) NOT NULL,
  `record_type` varchar(30) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `rname` varchar(100) NOT NULL,
  `serial` varchar(20) NOT NULL,
  `refresh` varchar(20) NOT NULL,
  `retry` int(20) NOT NULL,
  `expire` int(20) NOT NULL,
  `ttl` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `webDNS`
--

DROP TABLE IF EXISTS `webDNS`;
CREATE TABLE IF NOT EXISTS `webDNS` (
  `dnsId` int(11) NOT NULL AUTO_INCREMENT,
  `DNS1` varchar(30) NOT NULL,
  `DNS2` varchar(30) NOT NULL,
  `DNS3` varchar(30) NOT NULL,
  `webId` int(11) NOT NULL,
  `addTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `addBy` int(11) NOT NULL,
  PRIMARY KEY (`dnsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

DROP TABLE IF EXISTS `websites`;
CREATE TABLE IF NOT EXISTS `websites` (
  `webId` int(11) NOT NULL AUTO_INCREMENT,
  `website` varchar(300) NOT NULL,
  `bizId` int(11) NOT NULL,
  `addTime` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`webId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
