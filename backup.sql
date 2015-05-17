-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: project
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

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
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcement` (
  `announcementID` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`announcementID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcement`
--

LOCK TABLES `announcement` WRITE;
/*!40000 ALTER TABLE `announcement` DISABLE KEYS */;
INSERT INTO `announcement` VALUES (1,'2015-05-13 16:03:37');
/*!40000 ALTER TABLE `announcement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appFeedbackAnnouncement`
--

DROP TABLE IF EXISTS `appFeedbackAnnouncement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appFeedbackAnnouncement` (
  `announcementID` int(11) NOT NULL,
  `studentApproval` char(3) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `secretaryID` int(11) DEFAULT NULL,
  `studentID` int(11) DEFAULT NULL,
  PRIMARY KEY (`announcementID`),
  KEY `secretaryID` (`secretaryID`),
  KEY `studentID` (`studentID`),
  CONSTRAINT `appFeedbackAnnouncement_ibfk_1` FOREIGN KEY (`announcementID`) REFERENCES `announcement` (`announcementID`),
  CONSTRAINT `appFeedbackAnnouncement_ibfk_2` FOREIGN KEY (`secretaryID`) REFERENCES `secretary` (`userID`),
  CONSTRAINT `appFeedbackAnnouncement_ibfk_3` FOREIGN KEY (`studentID`) REFERENCES `student` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appFeedbackAnnouncement`
--

LOCK TABLES `appFeedbackAnnouncement` WRITE;
/*!40000 ALTER TABLE `appFeedbackAnnouncement` DISABLE KEYS */;
/*!40000 ALTER TABLE `appFeedbackAnnouncement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application` (
  `appID` int(11) NOT NULL AUTO_INCREMENT,
  `appSubmitDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `approval` char(12) DEFAULT NULL,
  `appType` char(12) DEFAULT NULL,
  `secretaryID` int(11) DEFAULT NULL,
  PRIMARY KEY (`appID`),
  KEY `secretaryID` (`secretaryID`),
  CONSTRAINT `application_ibfk_1` FOREIGN KEY (`secretaryID`) REFERENCES `secretary` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application`
--

LOCK TABLES `application` WRITE;
/*!40000 ALTER TABLE `application` DISABLE KEYS */;
INSERT INTO `application` VALUES (49,'2015-05-17 14:10:37','notApproved','directApply',4),(51,'2015-05-17 14:12:08','not approved','directApply',NULL),(52,'2015-05-17 14:15:40','not approved','directApply',NULL),(53,'2015-05-17 14:32:53','not approved','directApply',NULL),(54,'2015-05-17 15:04:44','not approved','directApply',NULL);
/*!40000 ALTER TABLE `application` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `newApplication` AFTER INSERT ON `application` FOR EACH ROW IF NEW.appType = "directApply" THEN
  INSERT INTO directApply VALUES (NEW.appID, null, null, null, null);
ELSE
  INSERT INTO quotaApply VALUES (NEW.appID, null, null, null, 0);
END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `removeApplication` BEFORE DELETE ON `application` FOR EACH ROW IF OLD.appType = "directApply" THEN
  DELETE FROM directApply WHERE appID = OLD.appID;
ELSE
  DELETE FROM quotaApply WHERE appID = OLD.appID;
END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `compID` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(100) CHARACTER SET latin1 NOT NULL,
  `password` char(12) CHARACTER SET latin1 DEFAULT '',
  `address` char(100) CHARACTER SET latin1 DEFAULT NULL,
  `phone` char(15) CHARACTER SET latin1 DEFAULT NULL,
  `applicableDepts` char(30) CHARACTER SET latin1 DEFAULT NULL,
  `status` char(15) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `supervisorName` char(30) CHARACTER SET latin1 DEFAULT NULL,
  `supervisorPhone` char(15) CHARACTER SET latin1 DEFAULT NULL,
  `city` char(20) CHARACTER SET latin1 DEFAULT NULL,
  `country` char(20) CHARACTER SET latin1 DEFAULT NULL,
  `evaluatorRating` int(11) DEFAULT NULL,
  `studentRating` int(11) DEFAULT NULL,
  `sector` char(20) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`compID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf32;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,'Pictrum','','kizilay','123 45 68','eee','approved',NULL,NULL,'Ankara','Türkiye',2,2,'IT'),(2,'Piramit','','ulus','455 53 57','eee','approved',NULL,NULL,'Ankara','Türkiye',3,3,'yazilim'),(3,'Piksel','','eryaman','458 75 78','cs','approved',NULL,NULL,'Amsterdam','netherlands',1,1,'oyun'),(4,'TAI',NULL,'ankara','0312-256 85 42',NULL,'approved',NULL,NULL,'ankara','Ankara',NULL,NULL,'ucak sanayi'),(5,'Aselsan',NULL,'kazan','123 21 35','eee','approved',NULL,NULL,'Ankara','netherlands',NULL,NULL,'savunma'),(6,'obss',NULL,'istanbul','0216-385 74 45',NULL,'approved',NULL,NULL,'Ankara','Türkiye',NULL,NULL,'yazilim'),(7,'Havelsan',NULL,'Odtu','0312-586 79 90','cs','approved',NULL,NULL,'istanbul','Ankara',NULL,NULL,'havacilik'),(14,'Eltas','i5CgIxRr','Turgut Reis Caddesi, No: 27/2, Tandogan','0312 222 22 22',NULL,'approved',NULL,NULL,'Ankara','Türkiye',NULL,NULL,'Elektrik-Elektronik'),(15,'Comodo','ZZW4iPPf','Teknokent','444 4 444',NULL,'approved',NULL,NULL,'Ankara','Türkiye',NULL,NULL,'CS'),(16,'SimSoft','','Teknokent','528 23 34',NULL,'approved',NULL,NULL,'Ankara','Türkiye',NULL,NULL,'Yazilim');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `project`.`advisor_approval` AFTER UPDATE
    ON project.company FOR EACH ROW
BEGIN
IF 
NEW.status = "approved" AND OLD.status = "not approved" THEN
INSERT INTO registeredCompany VALUES (OLD.compID,DEFAULT);
END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `deptName` char(5) NOT NULL,
  `facultyName` char(30) DEFAULT NULL,
  PRIMARY KEY (`deptName`),
  KEY `facultyName` (`facultyName`),
  CONSTRAINT `department_ibfk_1` FOREIGN KEY (`facultyName`) REFERENCES `faculty` (`facultyName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES ('CS','Engineering');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `directApply`
--

DROP TABLE IF EXISTS `directApply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `directApply` (
  `appID` int(11) NOT NULL,
  `compID` int(11) DEFAULT NULL,
  `studentID` int(11) DEFAULT NULL,
  `internshipStartDate` date DEFAULT NULL,
  `internshipEndDate` date DEFAULT NULL,
  PRIMARY KEY (`appID`),
  KEY `compID` (`compID`),
  KEY `studentID` (`studentID`),
  CONSTRAINT `directApply_ibfk_1` FOREIGN KEY (`appID`) REFERENCES `application` (`appID`),
  CONSTRAINT `directApply_ibfk_2` FOREIGN KEY (`compID`) REFERENCES `registeredCompany` (`compID`),
  CONSTRAINT `directApply_ibfk_3` FOREIGN KEY (`studentID`) REFERENCES `student` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `directApply`
--

LOCK TABLES `directApply` WRITE;
/*!40000 ALTER TABLE `directApply` DISABLE KEYS */;
INSERT INTO `directApply` VALUES (49,1,2,NULL,NULL),(51,2,2,'1969-12-31','1969-12-31'),(52,3,2,'1969-12-31','1969-12-31'),(53,3,2,'1969-12-31','1969-12-31'),(54,3,2,'1969-12-31','1969-12-31');
/*!40000 ALTER TABLE `directApply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faculty` (
  `facultyName` char(30) NOT NULL,
  PRIMARY KEY (`facultyName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faculty`
--

LOCK TABLES `faculty` WRITE;
/*!40000 ALTER TABLE `faculty` DISABLE KEYS */;
INSERT INTO `faculty` VALUES ('Engineering');
/*!40000 ALTER TABLE `faculty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generalAnnouncement`
--

DROP TABLE IF EXISTS `generalAnnouncement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generalAnnouncement` (
  `announcementID` int(11) NOT NULL,
  `title` char(30) DEFAULT NULL,
  `message` varchar(7000) DEFAULT NULL,
  `secretaryID` int(11) DEFAULT NULL,
  PRIMARY KEY (`announcementID`),
  KEY `secretaryID` (`secretaryID`),
  CONSTRAINT `generalAnnouncement_ibfk_1` FOREIGN KEY (`announcementID`) REFERENCES `announcement` (`announcementID`),
  CONSTRAINT `generalAnnouncement_ibfk_2` FOREIGN KEY (`secretaryID`) REFERENCES `secretary` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generalAnnouncement`
--

LOCK TABLES `generalAnnouncement` WRITE;
/*!40000 ALTER TABLE `generalAnnouncement` DISABLE KEYS */;
INSERT INTO `generalAnnouncement` VALUES (1,'deneme','deniyoruz',4);
/*!40000 ALTER TABLE `generalAnnouncement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opens`
--

DROP TABLE IF EXISTS `opens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opens` (
  `quotaID` int(11) DEFAULT NULL,
  `compID` int(11) DEFAULT NULL,
  `deptName` char(5) DEFAULT NULL,
  KEY `quotaID` (`quotaID`),
  KEY `compID` (`compID`),
  KEY `deptName` (`deptName`),
  CONSTRAINT `opens_ibfk_1` FOREIGN KEY (`quotaID`) REFERENCES `quota` (`quotaID`),
  CONSTRAINT `opens_ibfk_2` FOREIGN KEY (`compID`) REFERENCES `registeredCompany` (`compID`),
  CONSTRAINT `opens_ibfk_3` FOREIGN KEY (`deptName`) REFERENCES `department` (`deptName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opens`
--

LOCK TABLES `opens` WRITE;
/*!40000 ALTER TABLE `opens` DISABLE KEYS */;
INSERT INTO `opens` VALUES (1,1,'cs');
/*!40000 ALTER TABLE `opens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(100) CHARACTER SET latin1 NOT NULL,
  `surname` char(100) CHARACTER SET latin1 NOT NULL,
  `password` char(12) CHARACTER SET latin1 NOT NULL,
  `phone` char(15) CHARACTER SET latin1 DEFAULT NULL,
  `deptName` char(5) CHARACTER SET latin1 DEFAULT NULL,
  `userType` char(20) CHARACTER SET latin1 NOT NULL DEFAULT '',
  PRIMARY KEY (`userID`),
  KEY `deptName` (`deptName`),
  CONSTRAINT `person_ibfk_1` FOREIGN KEY (`deptName`) REFERENCES `department` (`deptName`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` VALUES (1,'sinem','sav','12345678','123123','CS','student'),(2,'can','akgün','12345678','564564563','CS','student'),(3,'dogancan','demirtas','12345678','3452452353','CS','student'),(4,'ebru','ates','12345678','468541324','CS','secretary'),(7,'selim','aksoy','12345678','1234684321','CS','advisor');
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quota`
--

DROP TABLE IF EXISTS `quota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quota` (
  `quotaID` int(11) NOT NULL AUTO_INCREMENT,
  `generalAnnouncementID` int(11) DEFAULT NULL,
  `compID` int(11) DEFAULT NULL,
  `internshipDuration` int(11) NOT NULL,
  `internshipStartDate` date NOT NULL,
  `internshipEndDate` date NOT NULL,
  `availableYears` int(11) NOT NULL,
  `status` char(30) DEFAULT NULL,
  `quotaAmount` int(11) NOT NULL,
  `quotaDeadline` date NOT NULL,
  PRIMARY KEY (`quotaID`),
  KEY `generalAnnouncementID` (`generalAnnouncementID`),
  KEY `compID` (`compID`),
  CONSTRAINT `quota_ibfk_1` FOREIGN KEY (`generalAnnouncementID`) REFERENCES `generalAnnouncement` (`announcementID`),
  CONSTRAINT `quota_ibfk_2` FOREIGN KEY (`compID`) REFERENCES `company` (`compID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quota`
--

LOCK TABLES `quota` WRITE;
/*!40000 ALTER TABLE `quota` DISABLE KEYS */;
INSERT INTO `quota` VALUES (1,1,1,30,'2015-06-01','2015-07-01',3,'waiting for first drawal',5,'2015-05-01');
/*!40000 ALTER TABLE `quota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotaApply`
--

DROP TABLE IF EXISTS `quotaApply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotaApply` (
  `appID` int(11) NOT NULL,
  `quotaID` int(11) DEFAULT NULL,
  `compID` int(11) DEFAULT NULL,
  `studentID` int(11) DEFAULT NULL,
  `drawResult` int(11) DEFAULT NULL,
  PRIMARY KEY (`appID`),
  KEY `quotaID` (`quotaID`),
  KEY `compID` (`compID`),
  KEY `studentID` (`studentID`),
  CONSTRAINT `quotaApply_ibfk_1` FOREIGN KEY (`appID`) REFERENCES `application` (`appID`),
  CONSTRAINT `quotaApply_ibfk_2` FOREIGN KEY (`quotaID`) REFERENCES `quota` (`quotaID`),
  CONSTRAINT `quotaApply_ibfk_3` FOREIGN KEY (`compID`) REFERENCES `registeredCompany` (`compID`),
  CONSTRAINT `quotaApply_ibfk_4` FOREIGN KEY (`studentID`) REFERENCES `student` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotaApply`
--

LOCK TABLES `quotaApply` WRITE;
/*!40000 ALTER TABLE `quotaApply` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotaApply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registeredCompany`
--

DROP TABLE IF EXISTS `registeredCompany`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registeredCompany` (
  `compID` int(11) NOT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`compID`),
  CONSTRAINT `registeredCompany_ibfk_1` FOREIGN KEY (`compID`) REFERENCES `company` (`compID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registeredCompany`
--

LOCK TABLES `registeredCompany` WRITE;
/*!40000 ALTER TABLE `registeredCompany` DISABLE KEYS */;
INSERT INTO `registeredCompany` VALUES (1,'2015-05-16 14:56:20'),(2,'2015-05-16 15:19:38'),(3,'2015-05-16 15:19:56'),(4,'2015-05-16 15:19:59'),(5,'2015-05-16 15:20:02'),(6,'2015-05-17 16:19:29'),(7,'2015-05-16 15:20:04'),(14,'2015-05-17 16:22:35'),(15,'2015-05-17 16:20:43'),(16,'2015-05-17 15:40:13');
/*!40000 ALTER TABLE `registeredCompany` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secretary`
--

DROP TABLE IF EXISTS `secretary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secretary` (
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`userID`),
  CONSTRAINT `secretary_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `person` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secretary`
--

LOCK TABLES `secretary` WRITE;
/*!40000 ALTER TABLE `secretary` DISABLE KEYS */;
INSERT INTO `secretary` VALUES (4);
/*!40000 ALTER TABLE `secretary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `selfFoundCompany`
--

DROP TABLE IF EXISTS `selfFoundCompany`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `selfFoundCompany` (
  `compID` int(11) NOT NULL,
  `advisorID` int(11) DEFAULT NULL,
  PRIMARY KEY (`compID`),
  KEY `advisorID` (`advisorID`),
  CONSTRAINT `selfFoundCompany_ibfk_1` FOREIGN KEY (`compID`) REFERENCES `company` (`compID`),
  CONSTRAINT `selfFoundCompany_ibfk_2` FOREIGN KEY (`advisorID`) REFERENCES `studentAdvisor` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `selfFoundCompany`
--

LOCK TABLES `selfFoundCompany` WRITE;
/*!40000 ALTER TABLE `selfFoundCompany` DISABLE KEYS */;
INSERT INTO `selfFoundCompany` VALUES (6,7);
/*!40000 ALTER TABLE `selfFoundCompany` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `userID` int(11) NOT NULL,
  `cgpa` float DEFAULT NULL,
  PRIMARY KEY (`userID`),
  CONSTRAINT `student_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `person` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,3.5),(2,3.1),(3,3.2);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studentAdvisor`
--

DROP TABLE IF EXISTS `studentAdvisor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studentAdvisor` (
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`userID`),
  CONSTRAINT `studentAdvisor_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `person` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studentAdvisor`
--

LOCK TABLES `studentAdvisor` WRITE;
/*!40000 ALTER TABLE `studentAdvisor` DISABLE KEYS */;
INSERT INTO `studentAdvisor` VALUES (7);
/*!40000 ALTER TABLE `studentAdvisor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-17 12:23:03
