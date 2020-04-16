-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 15, 2018 at 01:00 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `fines`
--

DROP TABLE IF EXISTS `fines`;
CREATE TABLE IF NOT EXISTS `fines` (
  `Fine_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Fine_Amount` int(11) NOT NULL,
  `Fine_Points` int(11) NOT NULL,
  `Incident_ID` int(11) NOT NULL,
  PRIMARY KEY (`Fine_ID`),
  KEY `Incident_ID` (`Incident_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fines`
--

INSERT INTO `fines` (`Fine_ID`, `Fine_Amount`, `Fine_Points`, `Incident_ID`) VALUES
(1, 2000, 6, 3),
(2, 50, 0, 2),
(3, 500, 3, 4),
(6, 100, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `incident`
--

DROP TABLE IF EXISTS `incident`;
CREATE TABLE IF NOT EXISTS `incident` (
  `Incident_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Vehicle_ID` int(11) DEFAULT NULL,
  `People_ID` int(11) DEFAULT NULL,
  `Incident_Date` date NOT NULL,
  `Incident_Report` varchar(500) NOT NULL,
  `Offence_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Incident_ID`),
  KEY `fk_incident_vehicle` (`Vehicle_ID`),
  KEY `fk_incident_people` (`People_ID`),
  KEY `fk_incident_offence` (`Offence_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incident`
--

INSERT INTO `incident` (`Incident_ID`, `Vehicle_ID`, `People_ID`, `Incident_Date`, `Incident_Report`, `Offence_ID`) VALUES
(1, 15, 4, '2017-12-01', '40mph in a 30 limit', 1),
(2, 20, 8, '2017-11-01', 'Double parked again', 4),
(3, 13, 4, '2017-09-17', '110mph on motorway', 1),
(4, 14, 2, '2017-08-22', 'Failure to stop at a red light - travelling 25mph', 8),
(8, 1, 1, '2012-01-02', 'awful driving', 4);

-- --------------------------------------------------------

--
-- Table structure for table `offence`
--

DROP TABLE IF EXISTS `offence`;
CREATE TABLE IF NOT EXISTS `offence` (
  `Offence_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Offence_description` varchar(50) NOT NULL,
  `Offence_maxFine` int(11) NOT NULL,
  `Offence_maxPoints` int(11) NOT NULL,
  PRIMARY KEY (`Offence_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offence`
--

INSERT INTO `offence` (`Offence_ID`, `Offence_description`, `Offence_maxFine`, `Offence_maxPoints`) VALUES
(1, 'Speeding', 1000, 3),
(2, 'Speeding on a motorway', 2500, 6),
(3, 'Seat belt offence', 500, 0),
(4, 'Illegal parking', 500, 0),
(5, 'Drink driving', 10000, 11),
(6, 'Driving without a licence', 10000, 0),
(7, 'Driving without a licence', 10000, 0),
(8, 'Traffic light offences', 1000, 3),
(9, 'Cycling on pavement', 500, 0),
(10, 'Failure to have control of vehicle', 1000, 3),
(11, 'Dangerous driving', 1000, 11),
(12, 'Careless driving', 5000, 6),
(13, 'Dangerous cycling', 2500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ownership`
--

DROP TABLE IF EXISTS `ownership`;
CREATE TABLE IF NOT EXISTS `ownership` (
  `People_ID` int(11) DEFAULT NULL,
  `Vehicle_ID` int(11) DEFAULT NULL,
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `Vehicle_licence` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`UID`),
  KEY `fk_people` (`People_ID`),
  KEY `fk_vehicle` (`Vehicle_ID`),
  KEY `Vehicle_licence` (`Vehicle_licence`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ownership`
--

INSERT INTO `ownership` (`People_ID`, `Vehicle_ID`, `UID`, `Vehicle_licence`) VALUES
(3, 12, 1, ''),
(4, 13, 2, ''),
(2, 14, 3, ''),
(4, 15, 4, ''),
(1, 16, 5, ''),
(5, 17, 6, ''),
(6, 18, 7, ''),
(8, 20, 8, ''),
(7, 21, 9, ''),
(5, 54, 35, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
CREATE TABLE IF NOT EXISTS `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fn` varchar(50) DEFAULT NULL,
  `People_address` varchar(50) DEFAULT NULL,
  `People_licence` varchar(16) DEFAULT NULL,
  `ln` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fn` (`fn`),
  KEY `ln` (`ln`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `fn`, `People_address`, `People_licence`, `ln`) VALUES
(1, 'James', '23 Barnsdale Road, Leicester', 'SMITH92LDOFJJ829', 'Smith'),
(2, 'Jennifer ', '46 Bramcote Drive, Nottingham', 'ALLEN88K23KLR9B3', 'Allen'),
(3, 'John ', '323 Derby Road, Nottingham', 'MYERS99JDW8REWL3', 'Myers'),
(4, 'James ', '26 Devonshire Avenue, Nottingham', 'SMITHR004JFS20TR', 'Smith'),
(5, 'Terry ', '7 Clarke Rd, Nottingham', 'BROWND3PJJ39DLFG', 'Brown'),
(6, 'Mary ', '38 Thurman St, Nottingham', 'ADAMSH9O3JRHH107', 'Adams'),
(7, 'Neil ', '6 Fairfax Close, Nottingham', 'BECKE88UPR840F9R', 'Becker'),
(8, 'Angela ', '30 Avenue Road, Grantham', 'SMITH222LE9FJ5DS', 'Smith');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `email`, `password`) VALUES
(6, 'haskins', 'haskins@me.com', 'copper99'),
(7, 'Regan', 'regan@me.com', 'plod123'),
(8, 'Carter', 'carter@me.com', 'fuzz42'),
(9, 'admin', 'admin@me.com', 'pass');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE IF NOT EXISTS `vehicle` (
  `Vehicle_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Vehicle_type` varchar(20) DEFAULT NULL,
  `Vehicle_colour` varchar(20) DEFAULT NULL,
  `Vehicle_licence` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`Vehicle_ID`),
  KEY `Vehicle_licence` (`Vehicle_licence`),
  KEY `Vehicle_type` (`Vehicle_type`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`Vehicle_ID`, `Vehicle_type`, `Vehicle_colour`, `Vehicle_licence`) VALUES
(12, 'Ford Fiesta', 'Blue', 'LB15AJL'),
(13, 'Ferrari 458', 'Red', 'MY64PRE'),
(14, 'Vauxhall Astra', 'Silver', 'FD65WPQ'),
(15, 'Honda Civic', 'Green', 'FJ17AUG'),
(16, 'Toyota Prius', 'Silver', 'FP16KKE'),
(17, 'Ford Mondeo', 'Black', 'FP66KLM'),
(18, 'Ford Focus', 'White', 'DJ14SLE'),
(20, 'Nissan Pulsar', 'Red', 'NY64KWD'),
(21, 'Renault Scenic', 'Silver', 'BC16OEA'),
(54, 'VW Golf', 'Burgundy', 'TJ67HJI');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fines`
--
ALTER TABLE `fines`
  ADD CONSTRAINT `fk_fines` FOREIGN KEY (`Incident_ID`) REFERENCES `incident` (`Incident_ID`);

--
-- Constraints for table `incident`
--
ALTER TABLE `incident`
  ADD CONSTRAINT `fk_incident_offence` FOREIGN KEY (`Offence_ID`) REFERENCES `offence` (`Offence_ID`);

--
-- Constraints for table `ownership`
--
ALTER TABLE `ownership`
  ADD CONSTRAINT `fk_person` FOREIGN KEY (`People_ID`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `fk_vehicle` FOREIGN KEY (`Vehicle_ID`) REFERENCES `vehicle` (`Vehicle_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
