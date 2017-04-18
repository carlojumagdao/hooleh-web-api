-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 04, 2017 at 01:41 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbHooleh`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblDriver`
--

CREATE TABLE `tblDriver` (
  `intDriverID` int(11) NOT NULL,
  `strDriverLicense` char(13) NOT NULL,
  `strDriverFirstName` varchar(45) NOT NULL,
  `strDriverLastName` varchar(45) NOT NULL,
  `intLicenseType` int(11) NOT NULL,
  `datLicenseExpiration` date DEFAULT NULL,
  `datDriverBirthday` date NOT NULL,
  `TimestampCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TimestampUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `TimestampDeleted` datetime DEFAULT NULL,
  `blDriverDelete` tinyint(1) NOT NULL DEFAULT '0',
  `strDriverMiddleName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblDriver`
--

INSERT INTO `tblDriver` (`intDriverID`, `strDriverLicense`, `strDriverFirstName`, `strDriverLastName`, `intLicenseType`, `datLicenseExpiration`, `datDriverBirthday`, `TimestampCreated`, `TimestampUpdated`, `TimestampDeleted`, `blDriverDelete`, `strDriverMiddleName`) VALUES
(1, 'D06-11-008232', 'Locsin', 'Jamil', 3, '2018-01-01', '2019-02-10', '2017-03-29 18:38:15', '0000-00-00 00:00:00', NULL, 0, NULL),
(2, 'D06-11-009385', 'Dela Cruz', 'Miranda', 1, '2018-01-01', '2018-01-01', '2017-03-29 18:38:15', '0000-00-00 00:00:00', NULL, 0, NULL),
(3, 'D06-11-009386', 'Soberano', 'Jembi', 2, '2018-01-01', '2020-09-09', '2017-03-29 18:38:15', '0000-00-00 00:00:00', NULL, 0, NULL),
(4, 'D06-11-034123', 'Pylon', 'Lomi', 2, '2018-01-01', '2017-09-01', '2017-03-29 18:38:15', '0000-00-00 00:00:00', NULL, 0, NULL),
(6, 'D06-11-008259', 'Joseph', 'Javier', 3, '2018-01-01', '1996-01-01', '2017-04-04 03:32:09', '0000-00-00 00:00:00', NULL, 0, 'Porto');

-- --------------------------------------------------------

--
-- Table structure for table `tblEnforcer`
--

CREATE TABLE `tblEnforcer` (
  `intEnforcerID` int(11) NOT NULL,
  `strEnforcerFirstname` varchar(45) NOT NULL,
  `strEnforcerMiddlename` varchar(45) DEFAULT NULL,
  `strEnforcerLastname` varchar(45) NOT NULL,
  `strEnforcerUsername` varchar(45) NOT NULL,
  `strEnforcerPassword` varchar(45) NOT NULL,
  `strEnforcerPosition` varchar(45) DEFAULT NULL,
  `strEnforcerToken` varchar(255) DEFAULT NULL,
  `strEnforcerPicture` varchar(150) DEFAULT NULL,
  `TimestampCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TimestampUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `TimestampDeleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `blEnforcerDelete` tinyint(4) NOT NULL DEFAULT '0',
  `strEnforcerIdNumber` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblEnforcer`
--

INSERT INTO `tblEnforcer` (`intEnforcerID`, `strEnforcerFirstname`, `strEnforcerMiddlename`, `strEnforcerLastname`, `strEnforcerUsername`, `strEnforcerPassword`, `strEnforcerPosition`, `strEnforcerToken`, `strEnforcerPicture`, `TimestampCreated`, `TimestampUpdated`, `TimestampDeleted`, `blEnforcerDelete`, `strEnforcerIdNumber`) VALUES
(5, 'Joseph', 'Porto', 'Javier', 'joseph', 'password', 'PO1', NULL, NULL, '2017-04-01 09:25:09', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'DPOS-12938-0'),
(6, 'Carlo', 'Reyes', 'Jumagdao', 'carlo', 'password', 'PO2', NULL, NULL, '2017-04-01 09:25:09', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'DPOS-92849-0'),
(7, 'Rafael', 'Balingit', 'Desuyo', 'rafael', 'password', 'PO1', NULL, NULL, '2017-04-01 09:28:27', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'DPOS-88420-0'),
(8, 'John Paul', NULL, 'Escala', 'paul', 'password', 'PO2', NULL, NULL, '2017-04-01 09:28:27', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'DPOS-31940-0'),
(9, 'Jayson', 'Abilar', 'Velasco', 'jayson', 'password', 'PO4', NULL, NULL, '2017-04-01 09:29:09', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'DPOS-83210-0'),
(10, 'Ken', 'Malit', 'Layug', 'ken', '$2y$10$gfxweVykvJezwvlTWAgRuOvIfdu7jrUz57X87D', 'PO2', NULL, 'TEST PICTURE', '2017-04-01 09:32:46', '2017-04-01 11:18:02', '0000-00-00 00:00:00', 0, 'DPOS-12424-0');

-- --------------------------------------------------------

--
-- Table structure for table `tblLicenseType`
--

CREATE TABLE `tblLicenseType` (
  `intLicenseId` int(11) NOT NULL,
  `strLicenseType` varchar(45) NOT NULL,
  `TimestampCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblLicenseType`
--

INSERT INTO `tblLicenseType` (`intLicenseId`, `strLicenseType`, `TimestampCreated`) VALUES
(1, 'Student', '2017-03-29 18:31:14'),
(2, 'Non-Professional', '2017-03-29 18:31:14'),
(3, 'Professional', '2017-03-29 18:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `tblPayment`
--

CREATE TABLE `tblPayment` (
  `intPaymentID` int(11) NOT NULL,
  `intViolationTransactionHeader` int(11) NOT NULL,
  `intPaymentMethodID` int(11) NOT NULL,
  `dblPayment` double NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblVehicleType`
--

CREATE TABLE `tblVehicleType` (
  `intVehicleID` int(11) NOT NULL,
  `strVehicleCode` char(2) NOT NULL,
  `strVehicleDescription` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblVehicleType`
--

INSERT INTO `tblVehicleType` (`intVehicleID`, `strVehicleCode`, `strVehicleDescription`) VALUES
(1, '01', 'BUS'),
(2, '02', 'CAR'),
(3, '03', 'AUV'),
(4, '04', 'JEEPNEY'),
(5, '05', 'MOTORCYCLE'),
(6, '06', 'TAXI'),
(7, '07', 'TRAILER'),
(8, '08', 'TRICYCLE'),
(9, '09', 'TRUCK'),
(10, '10', 'UTILITY'),
(11, '11', 'VAN');

-- --------------------------------------------------------

--
-- Table structure for table `tblViolation`
--

CREATE TABLE `tblViolation` (
  `intViolationID` int(11) NOT NULL,
  `strViolationCode` varchar(10) NOT NULL,
  `strViolationDescription` varchar(255) DEFAULT NULL,
  `TimestampCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TimestampUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `TimestampDeleted` datetime DEFAULT '0000-00-00 00:00:00',
  `blViolationDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblViolation`
--

INSERT INTO `tblViolation` (`intViolationID`, `strViolationCode`, `strViolationDescription`, `TimestampCreated`, `TimestampUpdated`, `TimestampDeleted`, `blViolationDelete`) VALUES
(1, '02-03', 'DISOBEDIENCE TO TRAFFIC CONTROL SIGNAL/SIGNS', '2017-03-29 18:23:05', '2017-04-02 07:30:15', '0000-00-00 00:00:00', 0),
(2, '06', 'DRIVING TRICYCLE ON NATIONAL ROAD', '2017-03-29 18:23:05', '2017-04-01 05:37:25', '0000-00-00 00:00:00', 0),
(3, '07', 'DRIVING WITHOUT LICENSE', '2017-03-29 18:23:05', '2017-04-01 05:37:25', '0000-00-00 00:00:00', 0),
(4, '10', 'DISCRIMINATION OF PASSENGERS/TRIP CUTTING', '2017-03-29 18:23:05', '2017-04-01 05:37:25', '0000-00-00 00:00:00', 0),
(5, '13', 'FAILURE TO CARRY/SHOW/SURRENDER DRIVERS''S LICENSE', '2017-03-29 18:23:05', '2017-04-01 05:37:25', '0000-00-00 00:00:00', 0),
(6, '14', 'FAILURE TO CARRY/SHOW REGISTRATION', '2017-03-29 18:23:05', '2017-04-01 05:37:25', '0000-00-00 00:00:00', 0),
(7, '29', 'NON-PAYMENT OF PARKING FEES', '2017-03-29 18:23:05', '2017-04-01 05:37:25', '0000-00-00 00:00:00', 0),
(8, '31', 'NO FRANCHISE/CPC/PA CARRIED', '2017-03-29 18:23:05', '2017-04-01 05:37:25', '0000-00-00 00:00:00', 0),
(9, '02-05', 'DISREGARDING LANE', '2017-04-02 08:16:10', '2017-04-02 08:16:45', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblViolationFee`
--

CREATE TABLE `tblViolationFee` (
  `intViolationFeeID` int(11) NOT NULL,
  `intViolationID` int(11) NOT NULL,
  `dblPrice` double(6,2) NOT NULL,
  `datStartDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datEndDate` datetime NOT NULL DEFAULT '9999-12-31 00:00:00',
  `TimestampCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblViolationFee`
--

INSERT INTO `tblViolationFee` (`intViolationFeeID`, `intViolationID`, `dblPrice`, `datStartDate`, `datEndDate`, `TimestampCreated`) VALUES
(1, 1, 350.00, '2017-03-30 00:00:00', '2017-04-02 15:05:41', '2017-03-29 18:24:09'),
(2, 2, 350.00, '2017-03-30 00:00:00', '9999-12-31 00:00:00', '2017-03-29 18:29:00'),
(3, 3, 700.00, '2017-03-30 00:00:00', '9999-12-31 00:00:00', '2017-03-29 18:29:00'),
(4, 4, 700.00, '2017-03-30 00:00:00', '2017-04-01 23:09:21', '2017-03-29 18:29:00'),
(5, 5, 700.00, '2017-03-30 00:00:00', '9999-12-31 00:00:00', '2017-03-29 18:29:00'),
(6, 6, 105.00, '2017-03-30 00:00:00', '9999-12-31 00:00:00', '2017-03-29 18:29:00'),
(7, 7, 280.00, '2017-03-30 00:00:00', '9999-12-31 00:00:00', '2017-03-29 18:29:00'),
(8, 8, 350.00, '2017-03-30 00:00:00', '9999-12-31 00:00:00', '2017-03-29 18:29:00'),
(9, 4, 999.99, '2017-04-01 23:08:51', '2017-04-01 23:09:21', '2017-04-01 15:08:51'),
(10, 4, 1500.00, '2017-04-01 23:09:21', '9999-12-31 00:00:00', '2017-04-01 15:09:21'),
(11, 1, 1500.00, '2017-04-02 15:05:41', '2017-04-02 15:30:15', '2017-04-02 07:05:41'),
(12, 1, 500.00, '2017-04-02 15:30:15', '2017-04-02 15:31:00', '2017-04-02 07:30:15'),
(13, 1, 350.00, '2017-04-02 15:31:00', '9999-12-31 00:00:00', '2017-04-02 07:31:00'),
(14, 9, 500.00, '2017-04-02 16:16:10', '2017-04-02 16:16:45', '2017-04-02 08:16:10'),
(15, 9, 1000.00, '2017-04-02 16:16:45', '9999-12-31 00:00:00', '2017-04-02 08:16:45');

-- --------------------------------------------------------

--
-- Table structure for table `tblViolationTransactionDetail`
--

CREATE TABLE `tblViolationTransactionDetail` (
  `intViolationTransactionDetailID` int(11) NOT NULL,
  `intViolationTransactionHeaderID` int(11) NOT NULL,
  `intViolationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblViolationTransactionDetail`
--

INSERT INTO `tblViolationTransactionDetail` (`intViolationTransactionDetailID`, `intViolationTransactionHeaderID`, `intViolationID`) VALUES
(1, 1, 1),
(3, 3, 1),
(5, 4, 1),
(7, 5, 1),
(2, 1, 2),
(4, 3, 2),
(6, 4, 2),
(8, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblViolationTransactionHeader`
--

CREATE TABLE `tblViolationTransactionHeader` (
  `intViolationTransactionHeaderID` int(11) NOT NULL,
  `strControlNumber` varchar(45) NOT NULL,
  `intEnforcerID` int(11) NOT NULL,
  `intDriverID` int(11) NOT NULL,
  `strRegistrationSticker` varchar(10) DEFAULT NULL,
  `strPlateNumber` varchar(10) DEFAULT NULL,
  `intVehicleTypeID` int(11) NOT NULL,
  `dblLatitude` decimal(9,6) DEFAULT NULL,
  `dblLongitude` decimal(9,6) DEFAULT NULL,
  `blDriverLicenseStatus` tinyint(1) DEFAULT NULL COMMENT 'Values: 1. Confiscated, 2. Not Confiscated',
  `blStatus` tinyint(1) NOT NULL DEFAULT '1',
  `TimestampCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TimestampUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `strRegisteredOwnerDriver` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblViolationTransactionHeader`
--

INSERT INTO `tblViolationTransactionHeader` (`intViolationTransactionHeaderID`, `strControlNumber`, `intEnforcerID`, `intDriverID`, `strRegistrationSticker`, `strPlateNumber`, `intVehicleTypeID`, `dblLatitude`, `dblLongitude`, `blDriverLicenseStatus`, `blStatus`, `TimestampCreated`, `TimestampUpdated`, `strRegisteredOwnerDriver`) VALUES
(1, 'CO-84293-0', 5, 1, 'sticker 1', 'DC 27230', 1, '80.239000', '80.123400', NULL, 1, '2017-04-04 04:03:47', '0000-00-00 00:00:00', ''),
(3, 'CO-82293-0', 5, 1, 'sticker 1', 'DC 27230', 1, '80.239000', '80.123400', NULL, 1, '2017-04-04 04:06:44', '0000-00-00 00:00:00', ''),
(4, 'CO-00001-0', 5, 1, 'sticker 1', 'DC 27230', 1, '80.239000', '80.123400', NULL, 1, '2017-04-04 04:09:06', '0000-00-00 00:00:00', ''),
(5, 'CO-00002-0', 5, 1, 'sticker 1', 'DC 27230', 1, '80.239000', '80.123400', NULL, 1, '2017-04-04 04:10:38', '0000-00-00 00:00:00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblDriver`
--
ALTER TABLE `tblDriver`
  ADD PRIMARY KEY (`intDriverID`),
  ADD UNIQUE KEY `strDriverLicense_UNIQUE` (`strDriverLicense`),
  ADD KEY `fkDriver_idx` (`intLicenseType`);

--
-- Indexes for table `tblEnforcer`
--
ALTER TABLE `tblEnforcer`
  ADD PRIMARY KEY (`intEnforcerID`),
  ADD UNIQUE KEY `strEnforcerUsername_UNIQUE` (`strEnforcerUsername`),
  ADD UNIQUE KEY `UQ_enforcerid` (`strEnforcerIdNumber`);

--
-- Indexes for table `tblLicenseType`
--
ALTER TABLE `tblLicenseType`
  ADD PRIMARY KEY (`intLicenseId`);

--
-- Indexes for table `tblPayment`
--
ALTER TABLE `tblPayment`
  ADD PRIMARY KEY (`intPaymentID`),
  ADD KEY `fkPaymentVh_idx` (`intViolationTransactionHeader`);

--
-- Indexes for table `tblVehicleType`
--
ALTER TABLE `tblVehicleType`
  ADD PRIMARY KEY (`intVehicleID`),
  ADD UNIQUE KEY `strVehicleCode_UNIQUE` (`strVehicleCode`);

--
-- Indexes for table `tblViolation`
--
ALTER TABLE `tblViolation`
  ADD PRIMARY KEY (`intViolationID`),
  ADD UNIQUE KEY `strViolationCode_UNIQUE` (`strViolationCode`);

--
-- Indexes for table `tblViolationFee`
--
ALTER TABLE `tblViolationFee`
  ADD PRIMARY KEY (`intViolationFeeID`),
  ADD KEY `fkViolationID_idx` (`intViolationID`);

--
-- Indexes for table `tblViolationTransactionDetail`
--
ALTER TABLE `tblViolationTransactionDetail`
  ADD PRIMARY KEY (`intViolationTransactionDetailID`,`intViolationTransactionHeaderID`),
  ADD KEY `fkViolationTransactionHeader_idx` (`intViolationTransactionHeaderID`),
  ADD KEY `fkViolationTransactionViolation_idx` (`intViolationID`);

--
-- Indexes for table `tblViolationTransactionHeader`
--
ALTER TABLE `tblViolationTransactionHeader`
  ADD PRIMARY KEY (`intViolationTransactionHeaderID`),
  ADD UNIQUE KEY `strControlNumber_UNIQUE` (`strControlNumber`),
  ADD KEY `fkVHEnforcerID_idx` (`intEnforcerID`),
  ADD KEY `fkVHDriverID_idx` (`intDriverID`),
  ADD KEY `fkVHVehicleType_idx` (`intVehicleTypeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblDriver`
--
ALTER TABLE `tblDriver`
  MODIFY `intDriverID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tblEnforcer`
--
ALTER TABLE `tblEnforcer`
  MODIFY `intEnforcerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tblLicenseType`
--
ALTER TABLE `tblLicenseType`
  MODIFY `intLicenseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblPayment`
--
ALTER TABLE `tblPayment`
  MODIFY `intPaymentID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblVehicleType`
--
ALTER TABLE `tblVehicleType`
  MODIFY `intVehicleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tblViolation`
--
ALTER TABLE `tblViolation`
  MODIFY `intViolationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tblViolationFee`
--
ALTER TABLE `tblViolationFee`
  MODIFY `intViolationFeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tblViolationTransactionDetail`
--
ALTER TABLE `tblViolationTransactionDetail`
  MODIFY `intViolationTransactionDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tblViolationTransactionHeader`
--
ALTER TABLE `tblViolationTransactionHeader`
  MODIFY `intViolationTransactionHeaderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblDriver`
--
ALTER TABLE `tblDriver`
  ADD CONSTRAINT `fkDriver` FOREIGN KEY (`intLicenseType`) REFERENCES `tblLicenseType` (`intLicenseId`) ON UPDATE CASCADE;

--
-- Constraints for table `tblPayment`
--
ALTER TABLE `tblPayment`
  ADD CONSTRAINT `fkPaymentVh` FOREIGN KEY (`intViolationTransactionHeader`) REFERENCES `tblViolationTransactionHeader` (`intViolationTransactionHeaderID`) ON UPDATE CASCADE;

--
-- Constraints for table `tblViolationFee`
--
ALTER TABLE `tblViolationFee`
  ADD CONSTRAINT `fkViolationID` FOREIGN KEY (`intViolationID`) REFERENCES `tblViolation` (`intViolationID`) ON UPDATE CASCADE;

--
-- Constraints for table `tblViolationTransactionDetail`
--
ALTER TABLE `tblViolationTransactionDetail`
  ADD CONSTRAINT `fkViolationTransactionHeader` FOREIGN KEY (`intViolationTransactionHeaderID`) REFERENCES `tblViolationTransactionHeader` (`intViolationTransactionHeaderID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkViolationTransactionViolation` FOREIGN KEY (`intViolationID`) REFERENCES `tblViolation` (`intViolationID`) ON UPDATE CASCADE;

--
-- Constraints for table `tblViolationTransactionHeader`
--
ALTER TABLE `tblViolationTransactionHeader`
  ADD CONSTRAINT `fkVHDriverID` FOREIGN KEY (`intDriverID`) REFERENCES `tblDriver` (`intDriverID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkVHEnforcerID` FOREIGN KEY (`intEnforcerID`) REFERENCES `tblEnforcer` (`intEnforcerID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkVHVehicleType` FOREIGN KEY (`intVehicleTypeID`) REFERENCES `tblVehicleType` (`intVehicleID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
