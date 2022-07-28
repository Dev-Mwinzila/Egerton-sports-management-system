-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2022 at 07:03 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sports`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', 'e807f1fcf82d132f9bb018ca6738a19f', '2020-08-26 12:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `borroweditem`
--

CREATE TABLE `borroweditem` (
  `id` int(11) NOT NULL,
  `RegNo` varchar(40) NOT NULL,
  `ItemId` int(11) NOT NULL,
  `Count` int(11) NOT NULL,
  `timeIssued` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Status` int(11) NOT NULL,
  `Cleared` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borroweditem`
--

INSERT INTO `borroweditem` (`id`, `RegNo`, `ItemId`, `Count`, `timeIssued`, `Status`, `Cleared`) VALUES
(60, 'S13/15673/16', 1, 5, '2022-07-17 18:42:47', 3, 1),
(61, 'S13/15393/16', 1, 4, '2022-07-17 23:48:37', 3, 1),
(62, 'S13/15313/16', 3, 12, '2022-07-17 19:08:55', 0, 0),
(63, 'S13/15316/16', 7, 3, '2022-07-17 23:48:45', 3, 1),
(64, 'S13/15316/16', 2, 10, '2022-07-17 23:51:50', 0, 0),
(65, 'S13/15313/16', 2, 5, '2022-07-18 02:54:01', 3, 0),
(66, 'S13/15316/16', 2, 56, '2022-07-18 00:02:28', 3, 0),
(67, 'S13/15673/16', 3, 5, '2022-07-18 07:00:00', 1, 0),
(68, 'S13/15316/16', 1, 45, '2022-07-18 02:14:34', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `coach`
--

CREATE TABLE `coach` (
  `id` int(11) NOT NULL,
  `CoachName` varchar(60) NOT NULL,
  `IDNumber` int(11) NOT NULL,
  `EUSportsId` int(11) NOT NULL,
  `TeamId` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Password` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coach`
--

INSERT INTO `coach` (`id`, `CoachName`, `IDNumber`, `EUSportsId`, `TeamId`, `Status`, `Password`) VALUES
(1, 'jkjkjh', 32434645, 77875, 10, 1, 0),
(2, 'jkjkjhu', 24242424, 63152, 14, 1, 11),
(3, 'jkjkjhu', 24242424, 44309, 14, 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

CREATE TABLE `field` (
  `id` int(11) NOT NULL,
  `FieldName` varchar(30) NOT NULL,
  `SportName` varchar(60) NOT NULL,
  `Location` varchar(50) NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `field`
--

INSERT INTO `field` (`id`, `FieldName`, `SportName`, `Location`, `Status`) VALUES
(1, 'Pavilion Coart', 'Hockey', 'Next To EUSports Pavilion Building', 1),
(2, 'Karate Coarts', 'Badminton', 'Next To Jeff Kennedy Mess', 1),
(3, 'Karate Coarts', 'Badminton', 'Next To Jeff Kennedy Mess', 1),
(4, 'Karate Coarts', 'Badminton', 'Next To Jeff Kennedy Mess', 1),
(5, 'Karate Coarts', 'CRICKET', 'Next To EUSports Pavilion Building', 1),
(6, 'Pavilion Coart', 'Hockey', 'Next To EUSports Pavilion Building', 1),
(7, 'Pavilion Coart', 'Rugby', 'Next To EUSports Pavilion Building', 1);

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` int(11) NOT NULL,
  `PartnerName` varchar(60) NOT NULL,
  `Status` int(11) NOT NULL,
  `Sport` varchar(40) NOT NULL,
  `Beneficiary` varchar(80) NOT NULL,
  `Logo` varchar(299) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `PartnerName`, `Status`, `Sport`, `Beneficiary`, `Logo`, `CreationDate`) VALUES
(1, 'Mau Narok', 1, 'ladiesSoccer', 'Njoro Sharklets', 'egeg.jpg', '2022-07-02 20:23:37'),
(5, 'NjoroLine', 1, 'ladiesSoccer', 'Njoro Sharklets', 'egeg.jpg', '2022-07-02 07:00:00'),
(6, 'MlolineSacco', 1, 'Men Rugby Team', 'Wasp Team', 'egerug.jpg', '2022-07-02 07:00:00'),
(7, 'NjoroLine EU', 1, 'Hockey', 'Hens Hockey', 'egeg.jpg', '2022-07-02 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `TransactionType` varchar(120) NOT NULL,
  `TransID` varchar(45) NOT NULL,
  `TransTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `TransAmount` int(11) NOT NULL,
  `BussinesShortCode` varchar(120) NOT NULL,
  `BillRefNumber` varchar(120) NOT NULL,
  `InvoiceNumber` varchar(120) NOT NULL,
  `OrgAccountBalance` int(11) NOT NULL,
  `ThirdPartyTransID` int(11) NOT NULL,
  `MSISDN` varchar(120) NOT NULL,
  `FirstName` varchar(24) NOT NULL,
  `MiddleName` varchar(56) NOT NULL,
  `LastName` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `purchaserequest`
--

CREATE TABLE `purchaserequest` (
  `id` int(11) NOT NULL,
  `SportId` int(11) NOT NULL,
  `SportItem` varchar(45) NOT NULL,
  `Quantity` varchar(45) NOT NULL,
  `RequestCode` varchar(45) NOT NULL,
  `RequestStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sportitems`
--

CREATE TABLE `sportitems` (
  `id` int(11) NOT NULL,
  `SportsId` varchar(45) NOT NULL,
  `ItemName` varchar(80) NOT NULL,
  `Cost` varchar(60) NOT NULL,
  `ItemCode` varchar(45) NOT NULL,
  `Count` int(11) NOT NULL,
  `Borrowed` int(11) NOT NULL,
  `Description` varchar(150) NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sportitems`
--

INSERT INTO `sportitems` (`id`, `SportsId`, `ItemName`, `Cost`, `ItemCode`, `Count`, `Borrowed`, `Description`, `Status`) VALUES
(1, '65', 'HockeyBalls', '890', '3261', 31, 2, 'White Hardened Melanin Balls', 0),
(2, '64', 'Soccer Ball', '450', '3625', 14, 3, 'Addidas white balls. @2022 ', 0),
(3, '66', 'Basket-ball celtics Orage Ball ', '700', '3316', 20, 6, '2022 version in-built sensor basket Game Balls', 0),
(4, '64', 'Jerseys', '452', '5092', 0, 0, 'Green Soccer Jrseys.  NjoroLine Sacco Sponsored', 0),
(7, '67', 'Rackets', '100', '5211', 2, 1, 'Addidass Green Rackets', 0),
(8, '65', 'Jerseys', '200', '3514', 0, 5, 'Addidass Green Rackets', 0),
(9, '68', 'Soccer Ball', '400', '7780', 2, 8, '2022 version in-built sensor basket Game Balls', 0),
(10, '69', 'Rugby Ball', '', '8886', 5, 9, 'Addidass Green Rugby Balls', 0),
(11, '70', 'Soccer Boots', '1000', '8568', 10, 0, 'Addidass Green Leather Boots', 0),
(12, '65', 'HockeyBalls', '500', '5801', 70, 0, 'White Hockey Balls', 0),
(13, '66', '0000000', '12', '5045', 109, 0, '2022 version in-built sensor basket Game Balls', 0),
(14, '64', 'shorts', '500', '7441', 55, 0, 'red Soccer Jersies', 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `RegNo` varchar(60) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Gender` varchar(45) NOT NULL,
  `Course` varchar(70) NOT NULL,
  `phone` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `RegNo`, `Name`, `Gender`, `Course`, `phone`) VALUES
(1, 'S13/15313/16', 'JANU JAU', 'Male', 'COMPUTER SCIENCE', '0701237958'),
(4, 'S13/15393/16', 'David Davie', 'FeMale', 'COMPUTER SCIENCE', '56436365'),
(6, 'S13/15673/16', 'David Davie', 'FeMale', 'COMPUTER SCIENCE', '56436365'),
(12, 'S13/15316/16', 'David Davie', 'Male', 'COMPUTER SCIENCE3', '0701237958'),
(13, 'S13/15678/16', 'David Davie', 'Male', 'COMPUTER SCIENCE3', '56436323'),
(14, 'S13/15773/16', 'David Davie', 'Male', 'COMPUTER SCIENCEo', '454675745'),
(15, 'K18/08196/17', 'Syuki Syuki', 'Male', 'AgECH', '0771286635'),
(16, 'S13/1837/16', 'David Kivanga', 'Male', 'IR', '078777958'),
(17, 'K18/13313/17', 'Syuki Vinnie', 'Male', 'COMPUTER SCIENCEo', '0700309358'),
(18, 'S13/15383/16', 'David Davie2', 'Male', 'COMPUTER SCIENCE3', '564363236'),
(19, 'Kl23/1323/32', 'Nutua mutua', 'FeMale', 'BCOM', '070203484'),
(20, 'S13/183453/16', 'Kalink lon', 'Male', 'COMPUTER SCIENCE3', '0701947958'),
(21, 'S13/15313/19', 'mkoya mkooa ', 'Male', 'COMPUTER SCIENCE3', '0776237958'),
(22, 'a13/83723/19', 'James James', 'FeMale', 'COMPUTER SCIENCE3', '0701237958'),
(23, 'kkkkllll', 'James Michuki', 'Male', 'COMPUTER SCIENCE3', '0701237958');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `id` int(11) NOT NULL,
  `BookingNumber` int(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `bookingdate` date DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `HomeTeam` varchar(60) NOT NULL,
  `AwayTeam` varchar(60) NOT NULL,
  `fieldId` int(11) NOT NULL,
  `KickOff` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`id`, `BookingNumber`, `status`, `bookingdate`, `PostingDate`, `HomeTeam`, `AwayTeam`, `fieldId`, `KickOff`) VALUES
(87, 355389, '3', '2022-07-18', '2022-07-18 03:55:24', '13', '12', 4, '2022-07-18'),
(88, 875098, '3', '2022-07-18', '2022-07-18 04:03:18', '18', '13', 6, '2022-07-18'),
(89, 765334, '1', '2022-07-18', '2022-07-18 04:29:53', '14', '15', 4, '2022-07-22'),
(90, 360171, '1', '2022-07-18', '2022-07-18 04:30:28', '14', '15', 4, '2022-07-22'),
(91, 866316, '1', '2022-07-18', '2022-07-18 04:53:11', '11', '13', 1, '2022-07-18');

-- --------------------------------------------------------

--
-- Table structure for table `tblbrands`
--

CREATE TABLE `tblbrands` (
  `id` int(11) NOT NULL,
  `SportName` varchar(120) NOT NULL,
  `CreationDate` datetime DEFAULT NULL,
  `Players` varchar(30) NOT NULL,
  `Hours` int(11) NOT NULL,
  `Description` text NOT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbrands`
--

INSERT INTO `tblbrands` (`id`, `SportName`, `CreationDate`, `Players`, `Hours`, `Description`, `UpdationDate`) VALUES
(64, 'soccer', '2022-06-30 00:00:00', '2', 3, '11 by 11 side Game.', NULL),
(65, 'Hockey', '2022-06-30 00:00:00', '22', 2, 'A gam Played by 11 Players on each side, On a coart of Dimensions 70 by 100.  the winning team is determined by number of goals  scored', NULL),
(66, 'Basket Ball', '2022-06-30 00:00:00', '12', 1, 'Game Played By hand ', NULL),
(67, 'Badminton', '2022-07-04 00:00:00', '4', 3, 'A game played by rackets and a cork.', NULL),
(68, 'CRICKET', '2022-07-04 00:00:00', '6', 12, 'Game Played by dats', NULL),
(69, 'Rugby', '2022-07-05 00:00:00', '15', 2, 'A gam Played by 11 Players on each side, On a coart of Dimensions 70 by 100.  the winning team is determined by number of goals  scored', NULL),
(70, 'soccer', '2022-07-11 00:00:00', '22', 2, 'A gam Played by 11 Players on each side, On a coart of Dimensions 70 by 100.  the winning team is determined by number of goals  scorede', NULL),
(71, 'Hundred Metres', '2022-07-14 00:00:00', '6', 0, 'Best Sprinter in a range of 110 m', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusinfo`
--

CREATE TABLE `tblcontactusinfo` (
  `id` int(11) NOT NULL,
  `Address` tinytext DEFAULT NULL,
  `EmailId` varchar(255) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcontactusinfo`
--

INSERT INTO `tblcontactusinfo` (`id`, `Address`, `EmailId`, `ContactNo`) VALUES
(1, 'P.O. BOX 536,EGERTON', 'EUsports@gmail.ac.ke', '536');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusquery`
--

CREATE TABLE `tblcontactusquery` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `ContactNumber` char(11) DEFAULT NULL,
  `Message` longtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcontactusquery`
--

INSERT INTO `tblcontactusquery` (`id`, `name`, `EmailId`, `ContactNumber`, `Message`, `PostingDate`, `status`) VALUES
(2, 'janu janu', 'janu1@gmail.com', '0701234890', 'janu januh  januh januh januh januhhh', '2020-08-31 08:19:10', 1),
(3, 'janu januh', 'mbuvi009@gmail.com', '0701237958', 'i lost my car', '2020-10-29 11:54:12', 1),
(4, 'JANU JAU', 'mbuvi129@gmail.com', '0701833323', 'rwer  ffwrfwf', '2022-07-15 22:54:35', 1),
(5, 'JANU JAU', 'mbuvi129@gmail.com', '0701833323', 'rwer  ffwrfwf', '2022-07-15 23:39:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbllostitems`
--

CREATE TABLE `tbllostitems` (
  `id` int(11) NOT NULL,
  `StudetID` varchar(60) NOT NULL,
  `Name` varchar(80) NOT NULL,
  `itemId` int(11) NOT NULL,
  `Quantity` varchar(55) NOT NULL,
  `Status` int(11) NOT NULL,
  `UpdateTime` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbllostitems`
--

INSERT INTO `tbllostitems` (`id`, `StudetID`, `Name`, `itemId`, `Quantity`, `Status`, `UpdateTime`) VALUES
(1, 'S13/15316/16', 'janu janu', 5, '2', 1, '2022-06-30 17:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(1, 'Terms and Conditions', 'terms', '																																								<p align=\"justify\"><font size=\"2\"><strong><font color=\"#990000\">(1) ACCEPTANCE OF TERMS</font><br><br></strong>&nbsp; ACCEPT THIS TERMS .\r\nonce you book, you can unbook without payig.\r\nonce you confrim booking and paid, you cat unbook.\r\nonce you leave, before the booking period end, no refund of money </font></p>\r\n										\r\n										\r\n										\r\n										'),
(2, 'Privacy Policy', 'privacy', '																				<div style=\"text-align: justify;\"><span style=\"font-size: 1em; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">the terms and conditiotions for this website are:\r\n</span></div><div style=\"text-align: justify;\"><span style=\"font-size: 1em; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Trust My System please. Security of parked cars is our concern once you book  your parking lot and pay</span></div><div style=\"text-align: justify;\"><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 1em;\"><br></span></div><div style=\"text-align: justify;\"><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 1em;\"><br></span></div><div style=\"text-align: justify;\"><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 1em;\">YOU BE MY BEST&nbsp;</span></div>\r\n										\r\n										'),
(3, 'About Us ', 'aboutus', '																				<span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13.3333px;\">We offer a varied Collection of parks all around our cities.</span><div><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13.3333px;\">e offer&nbsp; nice parking with ambient security. we offer an online payment  which is via mpesa </span></div><div><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13.3333px;\"><br></span></div><div><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13.3333px;\">with lost car retrival</span></div>\r\n										'),
(11, 'FAQs', 'faqs', '																																																												<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Address PO BOX 10,\r\nNaKURU------\r\nCONTACT: 0701237958 &nbsp; &nbsp;call us via this contact</span>\r\n										\r\n										\r\n										');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubscribers`
--

CREATE TABLE `tblsubscribers` (
  `id` int(11) NOT NULL,
  `SubscriberEmail` varchar(120) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubscribers`
--

INSERT INTO `tblsubscribers` (`id`, `SubscriberEmail`, `PostingDate`) VALUES
(12, 'waema@gmail.com', '2020-11-21 14:30:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbltestimonial`
--

CREATE TABLE `tbltestimonial` (
  `id` int(11) NOT NULL,
  `UserEmail` varchar(100) NOT NULL,
  `Testimonial` mediumtext NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltestimonial`
--

INSERT INTO `tbltestimonial` (`id`, `UserEmail`, `Testimonial`, `PostingDate`, `status`) VALUES
(1, 'test@gmail.com', 'I am satisfied with their service great job', '2020-07-07 14:30:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `ContactNo` int(11) NOT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Idno` int(11) NOT NULL,
  `worklevel` varchar(100) DEFAULT NULL,
  `EUSportsId` varchar(60) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `Salary` int(11) NOT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `FullName`, `EmailId`, `ContactNo`, `Password`, `Idno`, `worklevel`, `EUSportsId`, `Address`, `RegDate`, `Salary`, `UpdationDate`) VALUES
(19, 'janu janu', 'mbuvi009@gmail.com', 7934745, 'ea066ca1f0c2742c810b8e74e40bb516', 32434645, 'SportsCordinator', '54365', NULL, '2022-06-29 19:43:06', 56700, '2022-07-13 20:08:30'),
(20, 'Davie Davie', 'mbuvi009@gmail.com', 564363, 'ea066ca1f0c2742c810b8e74e40bb516', 32434645, 'Field/Track Mgt Team', '76856', NULL, '2022-06-29 21:07:15', 9000, '2022-07-18 04:49:15'),
(21, 'janu janu', 'mbuvi009@gmail.com', 564363, 'ea066ca1f0c2742c810b8e74e40bb516', 32434645, 'supervisor', '23434', NULL, '2022-06-29 21:16:27', 6000, '2022-07-13 19:43:18'),
(22, 'davie daie', 'mbuvide09@gmail.com', 56436323, '011dade3db85ad9c3d2ed4fc769feebe', 24242424, 'supervisor', '91513', NULL, '2022-06-30 18:00:47', 4500, '2022-07-13 19:43:24'),
(23, 'Janu Janu', 'mbuvi129@gmail.com', 701237958, 'a7371d338723a4c676d8feb26cf624e0', 34577845, 'StoreKeeper', '38350', NULL, '2022-06-30 18:15:05', 5000, '2022-07-13 19:43:37'),
(24, 'janu janu', 'mbuvi009@gmail.com', 701237958, 'a7371d338723a4c676d8feb26cf624e0', 34577845, 'StoreKeeper', '34640', NULL, '2022-07-18 03:21:55', 0, NULL),
(25, 'davie daie', 'mbuvi009@gmail.com', 2147483647, 'a7371d338723a4c676d8feb26cf624e0', 34577845, 'Workers', '60704', NULL, '2022-07-18 05:24:09', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `TeamName` varchar(60) NOT NULL,
  `CoachName` varchar(50) NOT NULL,
  `SportId` varchar(54) NOT NULL,
  `Address` varchar(60) NOT NULL,
  `Image` varchar(250) NOT NULL,
  `CreationDate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `TeamName`, `CoachName`, `SportId`, `Address`, `Image`, `CreationDate`, `Status`) VALUES
(10, 'Egerton Team', '', '66', 'Jokerio6', 'egeg.jpg', '2022-07-17 19:12:38', 0),
(11, 'Leila Team', '', '68', 'Nakuru Town', '33.jpg', '2022-07-17 19:12:21', 0),
(12, 'Leila Team', '', '68', 'Nakuru Town', '33.jpg', '2022-07-16 15:59:55', 0),
(13, 'Yathonza', '', '64', 'Kitui', 'egert2.jpg', '2022-07-17 19:12:25', 0),
(14, 'Wasp', '', '69', 'EgertonGate', 'egerug.jpg', '2022-07-17 19:12:29', 0),
(15, 'KerichoSting', '', '69', 'Kericho', 'egert2.jpg', '2022-07-17 19:12:31', 0),
(16, 'garreef', '', '65', 'Nakuru Town', '33.jpg', '2022-07-17 19:12:17', 0),
(17, 'Yathonza men', '', '70', 'Kikumbulyu', 'egera.jpg', '2022-07-17 19:12:35', 0),
(18, 'Njoro Ladies', 'Wambua', '68', 'Jokerio', 'egeg.jpg', '2022-07-17 19:12:23', 0),
(19, 'Egerton Men', 'James', '66', 'Nakuru', 'eger3.jpg', '2022-07-17 21:53:57', 3);

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `fname` varchar(35) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `idno` int(11) NOT NULL,
  `location` varchar(50) NOT NULL,
  `worklevel` varchar(45) NOT NULL,
  `parkname` varchar(55) NOT NULL,
  `salary` int(6) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`fname`, `phone`, `email`, `idno`, `location`, `worklevel`, `parkname`, `salary`, `id`) VALUES
('Katumbi', 745896324, 'janu1@gmail.com', 234577, 'nairbi', 'worker', 'NJOKS', 125, 31),
('COLLINS', 741424669, 'cptmsproject@gmail.com', 3456666, 'Dagoretti', 'worker', 'Njoro,gate', 34500, 38),
('COLLINS', 741424669, 'cptmsproject12@gmail.com', 33445566, 'Dagoretti', 'supervisor', 'kanu', 10000, 39),
('rita', 745869312, 'rita@gmail.com', 34570845, 'kibwezi', 'worker', 'Egerton', 10000, 35),
('COLLINS ppp', 741424669, 'cptmsproject123@gmail.com', 34577845, 'Dagoretti', 'receptionist', 'Egerton', 9000, 36);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borroweditem`
--
ALTER TABLE `borroweditem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`TransID`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `sportitems`
--
ALTER TABLE `sportitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `RegNo` (`RegNo`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `BookingNumber` (`BookingNumber`);

--
-- Indexes for table `tblbrands`
--
ALTER TABLE `tblbrands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubscribers`
--
ALTER TABLE `tblsubscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltestimonial`
--
ALTER TABLE `tbltestimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `EmailId` (`EmailId`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`idno`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `borroweditem`
--
ALTER TABLE `borroweditem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `coach`
--
ALTER TABLE `coach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `field`
--
ALTER TABLE `field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sportitems`
--
ALTER TABLE `sportitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `tblbrands`
--
ALTER TABLE `tblbrands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblsubscribers`
--
ALTER TABLE `tblsubscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbltestimonial`
--
ALTER TABLE `tbltestimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
