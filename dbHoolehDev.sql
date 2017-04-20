CREATE DATABASE dbHooleh;
USE dbHooleh;

-- MySQL dump 10.13  Distrib 5.6.24, for osx10.8 (x86_64)
--
-- Host: 127.0.0.1    Database: dbHoolehDev
-- ------------------------------------------------------
-- Server version	5.6.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2017_04_16_061119_create_user_activations_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblAdmin`
--

DROP TABLE IF EXISTS `tblAdmin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblAdmin` (
  `intAdminID` int(11) NOT NULL AUTO_INCREMENT,
  `strAdminFirstname` varchar(45) NOT NULL,
  `strAdminLastname` varchar(45) NOT NULL,
  `strAdminEmail` varchar(45) NOT NULL,
  `intAdminUserID` int(11) unsigned NOT NULL,
  `strAdminPicture` varchar(45) NOT NULL DEFAULT 'adminAvatar.jpg',
  `datAdminLastSignedIn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimestampCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TimestampUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimestampDeleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `blAdminDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intAdminID`),
  UNIQUE KEY `strAdminEmail_UNIQUE` (`strAdminEmail`),
  KEY `fkUserAdminID_idx` (`intAdminUserID`),
  CONSTRAINT `fkUserAdminID` FOREIGN KEY (`intAdminUserID`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblAdmin`
--

LOCK TABLES `tblAdmin` WRITE;
/*!40000 ALTER TABLE `tblAdmin` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblAdmin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblDriver`
--

DROP TABLE IF EXISTS `tblDriver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblDriver` (
  `intDriverID` int(11) NOT NULL AUTO_INCREMENT,
  `strDriverLicense` char(13) NOT NULL,
  `strDriverFirstname` varchar(45) NOT NULL,
  `strDriverMiddlename` varchar(100) DEFAULT NULL,
  `strDriverLastname` varchar(45) NOT NULL,
  `datLastSignedin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `intLicenseType` int(11) NOT NULL,
  `datLicenseExpiration` date DEFAULT NULL,
  `datDriverBirthday` date NOT NULL,
  `TimestampCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TimestampUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimestampDeleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `blDriverDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intDriverID`),
  UNIQUE KEY `strDriverLicense_UNIQUE` (`strDriverLicense`),
  KEY `fkDriver_idx` (`intLicenseType`),
  CONSTRAINT `fkDriver` FOREIGN KEY (`intLicenseType`) REFERENCES `tblLicenseType` (`intLicenseId`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblDriver`
--

LOCK TABLES `tblDriver` WRITE;
/*!40000 ALTER TABLE `tblDriver` DISABLE KEYS */;
INSERT INTO `tblDriver` VALUES (1,'D06-11-008232','Locsin',NULL,'Jamil','0000-00-00 00:00:00',3,'2018-01-01','2019-02-10','2017-03-29 18:38:15','0000-00-00 00:00:00','0000-00-00 00:00:00',0),(2,'D06-11-009385','Dela Cruz',NULL,'Miranda','0000-00-00 00:00:00',1,'2018-01-01','2018-01-01','2017-03-29 18:38:15','0000-00-00 00:00:00','0000-00-00 00:00:00',0),(3,'D06-11-009386','Soberano',NULL,'Jembi','0000-00-00 00:00:00',2,'2018-01-01','2020-09-09','2017-03-29 18:38:15','0000-00-00 00:00:00','0000-00-00 00:00:00',0),(4,'D06-11-034123','Pylon',NULL,'Lomi','0000-00-00 00:00:00',2,'2018-01-01','2017-09-01','2017-03-29 18:38:15','0000-00-00 00:00:00','0000-00-00 00:00:00',0),(6,'D06-11-008259','Joseph','Porto','Javier','0000-00-00 00:00:00',3,'2018-01-01','1996-01-01','2017-04-04 03:32:09','0000-00-00 00:00:00','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `tblDriver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblEnforcer`
--

DROP TABLE IF EXISTS `tblEnforcer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblEnforcer` (
  `intEnforcerID` int(11) NOT NULL AUTO_INCREMENT,
  `intUserID` int(10) unsigned NOT NULL,
  `strEnforcerEmail` varchar(100) NOT NULL,
  `strEnforcerFirstname` varchar(45) NOT NULL,
  `strEnforcerMiddlename` varchar(45) DEFAULT NULL,
  `strEnforcerLastname` varchar(45) NOT NULL,
  `strEnforcerPosition` varchar(45) DEFAULT NULL,
  `strEnforcerPicture` varchar(150) NOT NULL DEFAULT 'officerAvatar.jpg',
  `datLastSignedin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimestampCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TimestampUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimestampDeleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `blEnforcerDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intEnforcerID`),
  UNIQUE KEY `UQ_enforcerid` (`strEnforcerEmail`),
  KEY `intUserID` (`intUserID`),
  CONSTRAINT `fk_enforcer_user` FOREIGN KEY (`intUserID`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblEnforcer`
--

LOCK TABLES `tblEnforcer` WRITE;
/*!40000 ALTER TABLE `tblEnforcer` DISABLE KEYS */;
INSERT INTO `tblEnforcer` VALUES (22,30,'carlojumagdao@gmail.com','Carlo',NULL,'Jumagdao',NULL,'officerAvatar.jpg','0000-00-00 00:00:00','2017-04-16 05:48:42','0000-00-00 00:00:00','0000-00-00 00:00:00',0),(23,31,'rafaeldesuyo@gmail.com','Rafael',NULL,'Desuyo',NULL,'officerAvatar.jpg','0000-00-00 00:00:00','2017-04-16 05:50:01','0000-00-00 00:00:00','0000-00-00 00:00:00',0),(24,32,'johnpaulescala@yahoo.com','John Paul',NULL,'Escala',NULL,'officerAvatar.jpg','0000-00-00 00:00:00','2017-04-16 05:51:24','0000-00-00 00:00:00','0000-00-00 00:00:00',0),(25,33,'kimdomingo@yahoo.com','Kim',NULL,'Domingo',NULL,'officerAvatar.jpg','0000-00-00 00:00:00','2017-04-16 05:52:41','0000-00-00 00:00:00','2017-04-16 05:54:29',1),(26,34,'jelo.javier17@yahoo.com','Jelo',NULL,'Javier',NULL,'officerAvatar.jpg','0000-00-00 00:00:00','2017-04-16 05:56:37','0000-00-00 00:00:00','0000-00-00 00:00:00',0),(27,35,'jayosonabilar@yahoo.com','Jayson',NULL,'Abilar',NULL,'officerAvatar.jpg','0000-00-00 00:00:00','2017-04-16 05:58:49','0000-00-00 00:00:00','0000-00-00 00:00:00',0),(28,36,'wendogs@yahoo.com','Wendell',NULL,'Clarete',NULL,'officerAvatar.jpg','0000-00-00 00:00:00','2017-04-16 05:59:20','0000-00-00 00:00:00','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `tblEnforcer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblLicenseType`
--

DROP TABLE IF EXISTS `tblLicenseType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblLicenseType` (
  `intLicenseId` int(11) NOT NULL AUTO_INCREMENT,
  `strLicenseType` varchar(45) NOT NULL,
  `TimestampCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`intLicenseId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblLicenseType`
--

LOCK TABLES `tblLicenseType` WRITE;
/*!40000 ALTER TABLE `tblLicenseType` DISABLE KEYS */;
INSERT INTO `tblLicenseType` VALUES (1,'Student','2017-03-29 18:31:14'),(2,'Non-Professional','2017-03-29 18:31:14'),(3,'Professional','2017-03-29 18:31:14');
/*!40000 ALTER TABLE `tblLicenseType` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblPayment`
--

DROP TABLE IF EXISTS `tblPayment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblPayment` (
  `intPaymentID` int(11) NOT NULL AUTO_INCREMENT,
  `intViolationTransactionHeader` int(11) NOT NULL,
  `intPaymentMethodID` int(11) NOT NULL,
  `dblPayment` double NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`intPaymentID`),
  KEY `fkPaymentVh_idx` (`intViolationTransactionHeader`),
  CONSTRAINT `fkPaymentVh` FOREIGN KEY (`intViolationTransactionHeader`) REFERENCES `tblViolationTransactionHeader` (`intViolationTransactionHeaderID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblPayment`
--

LOCK TABLES `tblPayment` WRITE;
/*!40000 ALTER TABLE `tblPayment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblPayment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblVehicleType`
--

DROP TABLE IF EXISTS `tblVehicleType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblVehicleType` (
  `intVehicleID` int(11) NOT NULL AUTO_INCREMENT,
  `strVehicleCode` char(2) NOT NULL,
  `strVehicleDescription` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intVehicleID`),
  UNIQUE KEY `strVehicleCode_UNIQUE` (`strVehicleCode`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblVehicleType`
--

LOCK TABLES `tblVehicleType` WRITE;
/*!40000 ALTER TABLE `tblVehicleType` DISABLE KEYS */;
INSERT INTO `tblVehicleType` VALUES (1,'01','BUS'),(2,'02','CAR'),(3,'03','AUV'),(4,'04','JEEPNEY'),(5,'05','MOTORCYCLE'),(6,'06','TAXI'),(7,'07','TRAILER'),(8,'08','TRICYCLE'),(9,'09','TRUCK'),(10,'10','UTILITY'),(11,'11','VAN');
/*!40000 ALTER TABLE `tblVehicleType` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblViolation`
--

DROP TABLE IF EXISTS `tblViolation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblViolation` (
  `intViolationID` int(11) NOT NULL AUTO_INCREMENT,
  `strViolationCode` varchar(10) NOT NULL,
  `strViolationDescription` varchar(255) DEFAULT NULL,
  `TimestampCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TimestampUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimestampDeleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `blViolationDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intViolationID`),
  UNIQUE KEY `strViolationCode_UNIQUE` (`strViolationCode`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblViolation`
--

LOCK TABLES `tblViolation` WRITE;
/*!40000 ALTER TABLE `tblViolation` DISABLE KEYS */;
INSERT INTO `tblViolation` VALUES (1,'02-03','DISOBEDIENCE TO TRAFFIC CONTROL SIGNAL/SIGNS','2017-03-29 18:23:05','2017-04-18 11:04:18','0000-00-00 00:00:00',0),(2,'06','DRIVING TRICYCLE ON NATIONAL ROAD','2017-03-29 18:23:05','2017-04-01 05:37:25','0000-00-00 00:00:00',0),(3,'07','DRIVING WITHOUT LICENSE','2017-03-29 18:23:05','2017-04-01 05:37:25','0000-00-00 00:00:00',0),(4,'10','DISCRIMINATION OF PASSENGERS/TRIP CUTTING','2017-03-29 18:23:05','2017-04-01 05:37:25','0000-00-00 00:00:00',0),(5,'13','FAILURE TO CARRY/SHOW/SURRENDER DRIVERS\'S LICENSE','2017-03-29 18:23:05','2017-04-01 05:37:25','0000-00-00 00:00:00',0),(6,'14','FAILURE TO CARRY/SHOW REGISTRATION','2017-03-29 18:23:05','2017-04-01 05:37:25','0000-00-00 00:00:00',0),(7,'29','NON-PAYMENT OF PARKING FEES','2017-03-29 18:23:05','2017-04-01 05:37:25','0000-00-00 00:00:00',0),(8,'31','NO FRANCHISE/CPC/PA CARRIED','2017-03-29 18:23:05','2017-04-01 05:37:25','0000-00-00 00:00:00',0),(9,'02-05','DISREGARDING LANE','2017-04-02 08:16:10','2017-04-02 08:16:45','0000-00-00 00:00:00',0),(10,'09-01','Against the light','2017-04-18 18:55:36','0000-00-00 00:00:00','0000-00-00 00:00:00',0),(11,'01-20','Counter Strike','2017-04-18 19:03:59','0000-00-00 00:00:00','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `tblViolation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblViolationFee`
--

DROP TABLE IF EXISTS `tblViolationFee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblViolationFee` (
  `intViolationFeeID` int(11) NOT NULL AUTO_INCREMENT,
  `intViolationID` int(11) NOT NULL,
  `dblPrice` double(6,2) NOT NULL,
  `datStartDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datEndDate` datetime NOT NULL DEFAULT '9999-12-31 00:00:00',
  PRIMARY KEY (`intViolationFeeID`),
  KEY `fkViolationID_idx` (`intViolationID`),
  CONSTRAINT `fkViolationID` FOREIGN KEY (`intViolationID`) REFERENCES `tblViolation` (`intViolationID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblViolationFee`
--

LOCK TABLES `tblViolationFee` WRITE;
/*!40000 ALTER TABLE `tblViolationFee` DISABLE KEYS */;
INSERT INTO `tblViolationFee` VALUES (1,1,350.00,'2017-03-30 00:00:00','2017-04-02 15:05:41'),(2,2,350.00,'2017-03-30 00:00:00','9999-12-31 00:00:00'),(3,3,700.00,'2017-03-30 00:00:00','9999-12-31 00:00:00'),(4,4,700.00,'2017-03-30 00:00:00','2017-04-01 23:09:21'),(5,5,700.00,'2017-03-30 00:00:00','9999-12-31 00:00:00'),(6,6,105.00,'2017-03-30 00:00:00','9999-12-31 00:00:00'),(7,7,280.00,'2017-03-30 00:00:00','9999-12-31 00:00:00'),(8,8,350.00,'2017-03-30 00:00:00','9999-12-31 00:00:00'),(9,4,999.99,'2017-04-01 23:08:51','2017-04-01 23:09:21'),(10,4,1500.00,'2017-04-01 23:09:21','9999-12-31 00:00:00'),(11,1,1500.00,'2017-04-02 15:05:41','2017-04-02 15:30:15'),(12,1,500.00,'2017-04-02 15:30:15','2017-04-02 15:31:00'),(13,1,350.00,'2017-04-02 15:31:00','2017-04-18 19:04:18'),(14,9,500.00,'2017-04-02 16:16:10','2017-04-02 16:16:45'),(15,9,1000.00,'2017-04-02 16:16:45','9999-12-31 00:00:00'),(16,10,202.00,'2017-04-18 18:55:36','9999-12-31 00:00:00'),(17,11,244.00,'2017-04-18 19:03:59','9999-12-31 00:00:00'),(18,1,354.00,'2017-04-18 19:04:18','9999-12-31 00:00:00');
/*!40000 ALTER TABLE `tblViolationFee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblViolationTransactionDetail`
--

DROP TABLE IF EXISTS `tblViolationTransactionDetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblViolationTransactionDetail` (
  `intViolationTransactionDetailID` int(11) NOT NULL AUTO_INCREMENT,
  `intViolationTransactionHeaderID` int(11) NOT NULL,
  `intViolationID` int(11) NOT NULL,
  PRIMARY KEY (`intViolationTransactionDetailID`,`intViolationTransactionHeaderID`),
  KEY `fkViolationTransactionHeader_idx` (`intViolationTransactionHeaderID`),
  KEY `fkViolationTransactionViolation_idx` (`intViolationID`),
  CONSTRAINT `fkViolationTransactionHeader` FOREIGN KEY (`intViolationTransactionHeaderID`) REFERENCES `tblViolationTransactionHeader` (`intViolationTransactionHeaderID`) ON UPDATE CASCADE,
  CONSTRAINT `fkViolationTransactionViolation` FOREIGN KEY (`intViolationID`) REFERENCES `tblViolation` (`intViolationID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblViolationTransactionDetail`
--

LOCK TABLES `tblViolationTransactionDetail` WRITE;
/*!40000 ALTER TABLE `tblViolationTransactionDetail` DISABLE KEYS */;
INSERT INTO `tblViolationTransactionDetail` VALUES (2,1,2);
/*!40000 ALTER TABLE `tblViolationTransactionDetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblViolationTransactionHeader`
--

DROP TABLE IF EXISTS `tblViolationTransactionHeader`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblViolationTransactionHeader` (
  `intViolationTransactionHeaderID` int(11) NOT NULL AUTO_INCREMENT,
  `strControlNumber` varchar(45) NOT NULL,
  `intEnforcerID` int(11) NOT NULL,
  `intDriverID` int(11) NOT NULL,
  `strRegistrationSticker` varchar(10) DEFAULT NULL,
  `strPlateNumber` varchar(10) DEFAULT NULL,
  `intVehicleTypeID` int(11) NOT NULL,
  `dblLatitude` decimal(9,6) DEFAULT NULL,
  `dblLongitude` decimal(9,6) DEFAULT NULL,
  `blDriverLicenseStatus` tinyint(1) DEFAULT NULL COMMENT 'Values - 0: Not Confiscated, 1: Confiscated',
  `blPaymentStatus` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Values - 0: Unpaid, 1: Paid',
  `TimestampCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TimestampUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `strRegisteredOwnerDriver` varchar(150) NOT NULL,
  PRIMARY KEY (`intViolationTransactionHeaderID`),
  UNIQUE KEY `strControlNumber_UNIQUE` (`strControlNumber`),
  KEY `fkVHEnforcerID_idx` (`intEnforcerID`),
  KEY `fkVHDriverID_idx` (`intDriverID`),
  KEY `fkVHVehicleType_idx` (`intVehicleTypeID`),
  CONSTRAINT `fkVHDriverID` FOREIGN KEY (`intDriverID`) REFERENCES `tblDriver` (`intDriverID`) ON UPDATE CASCADE,
  CONSTRAINT `fkVHEnforcerID` FOREIGN KEY (`intEnforcerID`) REFERENCES `tblEnforcer` (`intEnforcerID`) ON UPDATE CASCADE,
  CONSTRAINT `fkVHVehicleType` FOREIGN KEY (`intVehicleTypeID`) REFERENCES `tblVehicleType` (`intVehicleID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblViolationTransactionHeader`
--

LOCK TABLES `tblViolationTransactionHeader` WRITE;
/*!40000 ALTER TABLE `tblViolationTransactionHeader` DISABLE KEYS */;
INSERT INTO `tblViolationTransactionHeader` VALUES (1,'DD-23000-A',22,1,'AG2','AXD-0221',1,1.000000,1.000000,0,0,'2017-04-19 21:25:26','0000-00-00 00:00:00','Juan Dela Cruz');
/*!40000 ALTER TABLE `tblViolationTransactionHeader` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_activations`
--

DROP TABLE IF EXISTS `user_activations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_activations` (
  `user_id` int(10) unsigned NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  KEY `user_activations_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_activations`
--

LOCK TABLES `user_activations` WRITE;
/*!40000 ALTER TABLE `user_activations` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_activations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tinyintIdentifier` tinyint(1) NOT NULL COMMENT '0 - Enforcer \n1 - Admin',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (30,'carlojumagdao@gmail.com','$2y$10$S6bZ2vA0uDKqXvh/rHdfL.grD27UGkBLAEDmT13jMrWkPUiECeJl2',0,'s8wm8WEwTvM0VmTGFpeQ19LIhlMbguqsYaDNOWZ7HmlXtG8KNptFnyxrvacp','2017-04-16 05:48:42',NULL),(31,'rafaeldesuyo@gmail.com','$2y$10$K5XUoZYtwr45pIO.A.rvVedZ07ro9WaYbA70bK3ZqETBB1jaaLjN6',0,'Yk0RG4UrV32zJpQvYSz7gZpJ1KPbrOhihw6Ix4y6YdV9r2Wnd7pmZYshSV0W','2017-04-16 05:50:01',NULL),(32,'johnpaulescala@yahoo.com','$2y$10$eIZ2Neu66jKhtosZ8iETYeaHnixgy1SMWwFGokiKAEI05TWHW3NJG',0,'o1o9y2IA6IiQnbtm91qpvbHjmcg4kdv6oq69MYZgPPVdVQ8EYi7vaYgYSNvB','2017-04-16 05:51:24',NULL),(33,'kimdomingo@yahoo.com','$2y$10$5ybKcWW7RvpcFXL2.OQWV.vVE5klFV9b0IgN22HKdGxg0CBl0vYcS',0,'AoddcLyZVx4S3VgfebqIEySPZzhR9MwDobz49BcQcB7awrlYDC9iYPEi3At9','2017-04-16 05:52:41',NULL),(34,'jelo.javier17@yahoo.com','$2y$10$IvrmRm39pE15o6GOzijefekW2YNUPL7fHh3JQAOOQYIwTt4choQ.S',0,'QplbIhBZ4Qr1c68Z33CTfUgFJQSsCVjZUtP0kHifw7e0Wi6AilfZSO0gIUu8','2017-04-16 05:56:37',NULL),(35,'jayosonabilar@yahoo.com','$2y$10$ick/.yPFCZyX/5pMSl8/VOgXSY2yS1pkXXRAGCo0Wdydk6STn71ym',0,'VECcz3jSJ8RVQexWK7dX9kE9FGrGz5nG7XzUkRuoG26XBXIO2uLNznbloXNb','2017-04-16 05:58:48',NULL),(36,'wendogs@yahoo.com','$2y$10$1FhsMHFaVCZcLFra15peBuqSL0mxLyNXW8H957FiTu2pmiJSVtvs.',0,'FBtjIAW3KQ90uOB11brrKO8tIx93HXdTi98pYM2s2XmVo0xIF9WQ6MgG0qJr','2017-04-16 05:59:20',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'dbHoolehDev'
--

--
-- Dumping routines for database 'dbHoolehDev'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-20  6:41:20
