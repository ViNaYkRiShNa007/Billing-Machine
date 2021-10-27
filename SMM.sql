-- MySQL dump 10.13  Distrib 8.0.23, for Linux (x86_64)
--
-- Host: localhost    Database: SMM
-- ------------------------------------------------------
-- Server version	8.0.23-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Cart`
--

DROP TABLE IF EXISTS `Cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Cart` (
  `VID` int NOT NULL,
  `PID` int NOT NULL,
  `QTY` double NOT NULL,
  `Date` date NOT NULL,
  `Total` double NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Payement_method` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Order_number` int NOT NULL,
  `CID` int NOT NULL,
  `Rate` double NOT NULL,
  KEY `Cart_FK` (`VID`),
  KEY `Cart_FK_1` (`CID`),
  KEY `Cart_FK_2` (`PID`),
  CONSTRAINT `Cart_FK_1` FOREIGN KEY (`CID`) REFERENCES `Customers` (`CID`) ON UPDATE CASCADE,
  CONSTRAINT `Cart_FK_2` FOREIGN KEY (`PID`) REFERENCES `Products` (`PID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cart`
--

LOCK TABLES `Cart` WRITE;
/*!40000 ALTER TABLE `Cart` DISABLE KEYS */;
INSERT INTO `Cart` VALUES (1,2,1,'2021-05-01',8.75,'Currently Billing','',18824,13,8.75),(1,46,1,'2021-05-04',125,'Billed','Cash',18485,14,125),(1,50,2,'2021-05-04',42,'Billed','Cash',18485,14,21),(1,51,2,'2021-05-04',36,'Billed','Cash',18485,14,18),(1,1,2,'2021-05-04',70,'Billed','Cash',66484,1,35),(1,35,2,'2021-05-04',2100,'Billed','Cash',66484,1,1050),(1,38,3,'2021-05-06',30,'Billed','Cash',99133,1,10),(1,10,2,'2021-05-06',66,'Billed','Cash',99133,1,33),(1,2,2,'2021-05-06',20,'Billed','Cash',99133,1,10),(1,6,1,'2021-05-06',10,'Billed','Cash',99133,1,10),(1,7,1,'2021-05-06',35,'Billed','Cash',99133,1,35),(1,36,1,'2021-05-06',1000,'Billed','Cash',99133,1,1000),(3,54,10,'2021-05-12',570,'Billed','Cash',45489,15,57),(3,55,2,'2021-05-12',60,'Billed','Cash',45489,15,30),(3,57,1,'2021-05-12',45,'Billed','Cash',45489,15,45),(3,58,1,'2021-05-12',225,'Billed','Cash',45489,15,225),(1,1,2,'2021-05-13',70,'Billed','Cash',84830,1,35),(1,2,1,'2021-05-13',10,'Billed','Cash',84830,1,10),(1,59,2,'2021-05-13',1740,'Billed','Cash',41898,17,870),(1,64,0.5,'2021-05-13',65,'Billed','Cash',41898,17,130),(1,62,0.054,'2021-05-13',32.4,'Billed','Cash',41898,17,600),(1,65,0.5,'2021-05-13',27.5,'Billed','Cash',41898,17,55),(1,67,0.25,'2021-05-13',30,'Billed','Cash',41898,17,120),(1,73,0.005,'2021-05-13',20,'Billed','Cash',41898,17,4000),(1,69,2,'2021-05-13',20,'Billed','Cash',41898,17,10),(1,71,2,'2021-05-13',20,'Billed','Cash',41898,17,10),(1,72,1,'2021-05-13',72,'Billed','Cash',41898,17,72),(1,70,1,'2021-05-13',10,'Billed','Cash',41898,17,10),(1,48,6,'2021-05-13',138,'Billed','Cash',41898,17,23),(1,60,3,'2021-05-13',30,'Billed','Cash',41898,17,10),(1,61,2,'2021-05-13',20,'Billed','Cash',41898,17,10),(3,60,3,'2021-05-25',30,'Billed','Cash',33095,16,10),(3,61,1,'2021-05-25',10,'Billed','Cash',33095,16,10),(3,57,2,'2021-05-25',90,'Billed','Cash',33095,16,45),(3,73,0.0075,'2021-05-25',30,'Billed','Cash',33095,16,4000),(3,45,0.25,'2021-05-25',22.5,'Billed','Cash',33095,16,90),(3,59,2,'2021-05-25',1740,'Billed','Cash',33095,16,870),(3,75,2,'2021-05-25',20,'Billed','Cash',33095,16,10),(3,48,3,'2021-05-25',69,'Billed','Cash',33095,16,23),(3,65,0.5,'2021-05-25',27.5,'Billed','Cash',33095,16,55),(3,77,0.002,'2021-05-25',5.6,'Billed','Cash',33095,16,2800),(3,78,1,'2021-05-25',180,'Billed','Cash',33095,16,180),(3,72,3,'2021-05-25',216,'Billed','Cash',33095,16,72),(1,79,1,'2021-05-26',230,'Billed','Cash',33095,16,230),(2,49,1,'2021-07-10',845,'Billed','Credit',63351,21,845),(2,1,1,'2021-07-10',32,'Billed','Credit',63351,21,32),(1,1,3,'2021-07-10',105,'Billed','Cash',79593,22,35),(4,5,2,'2021-08-06',90,'Billed','Paytm',71920,1,45),(4,2,2,'2021-08-06',20,'Billed','Paytm',71920,1,10),(4,36,2,'2021-08-06',2000,'Billed','Paytm',71920,1,1000),(4,49,1,'2021-08-12',845,'Billed','Cash',67392,23,845),(4,68,3,'2021-08-22',30,'Billed','Cash',96714,25,10),(4,35,2,'2021-08-22',2100,'Billed','Cash',96714,25,1050),(4,2,2,'2021-08-22',20,'Billed','Cash',96714,25,10),(1,84,3,'2021-08-30',2700,'Billed','Credit',51913,26,900),(1,72,3,'2021-08-30',216,'Billed','Credit',51913,26,72),(1,85,0.5,'2021-08-30',70,'Billed','Credit',51913,26,140),(1,64,0.25,'2021-08-30',32.5,'Billed','Credit',51913,26,130),(1,45,0.5,'2021-08-30',45,'Billed','Credit',51913,26,90),(1,86,0.25,'2021-08-30',50,'Billed','Credit',51913,26,200),(1,88,1,'2021-08-30',95,'Billed','Credit',51913,26,95),(1,47,5,'2021-08-30',190,'Billed','Credit',51913,26,38),(1,75,5,'2021-08-30',75,'Billed','Credit',51913,26,15),(1,89,0.25,'2021-08-30',32.5,'Billed','Credit',51913,26,130),(1,74,1,'2021-08-30',180,'Billed','Credit',51913,26,180),(1,52,6,'2021-08-30',228,'Billed','Credit',51913,26,38),(1,53,0.5,'2021-08-30',60,'Billed','Credit',51913,26,120),(1,65,1,'2021-08-30',55,'Billed','Credit',51913,26,55),(1,73,0.0075,'2021-08-30',30,'Billed','Credit',51913,26,4000),(1,90,3,'2021-08-30',30,'Billed','Credit',51913,26,10),(1,91,4,'2021-08-30',60,'Billed','Credit',51913,26,15),(1,92,2,'2021-08-30',30,'Billed','Credit',51913,26,15),(1,69,1,'2021-08-30',10,'Billed','Credit',51913,26,10),(1,68,6,'2021-08-30',60,'Billed','Credit',51913,26,10),(1,93,1,'2021-08-30',10,'Billed','Credit',51913,26,10),(1,94,1,'2021-08-30',10,'Billed','Credit',51913,26,10),(1,95,2,'2021-08-30',70,'Billed','Credit',51913,26,35),(1,87,1,'2021-08-30',120,'Billed','Credit',51913,26,120),(1,80,1,'2021-08-30',79,'Billed','Credit',51913,26,79),(1,82,2,'2021-08-30',324,'Billed','Credit',51913,26,162),(1,84,4,'2021-08-30',3600,'Billed','Credit',17616,26,900),(1,45,1,'2021-08-30',90,'Billed','Credit',17616,26,90),(1,64,0.5,'2021-08-30',65,'Billed','Credit',17616,26,130),(1,86,0.25,'2021-08-30',50,'Billed','Credit',17616,26,200),(1,88,1,'2021-08-30',95,'Billed','Credit',17616,26,95),(1,66,1,'2021-08-30',40,'Billed','Credit',17616,26,40),(1,96,0.25,'2021-08-30',75,'Billed','Credit',17616,26,300),(1,97,1,'2021-08-30',95,'Billed','Credit',17616,26,95),(1,74,1,'2021-08-30',180,'Billed','Credit',17616,26,180),(1,65,1,'2021-08-30',55,'Billed','Credit',17616,26,55),(1,52,6,'2021-08-30',228,'Billed','Credit',17616,26,38),(1,98,0.25,'2021-08-30',25,'Billed','Credit',17616,26,100),(1,99,1,'2021-08-30',40,'Billed','Credit',17616,26,40),(1,73,0.0075,'2021-08-30',30,'Billed','Credit',17616,26,4000),(1,77,0.011,'2021-08-30',30.799999999999997,'Billed','Credit',17616,26,2800),(1,47,3,'2021-08-30',114,'Billed','Credit',17616,26,38),(1,89,0.25,'2021-08-30',32.5,'Billed','Credit',17616,26,130),(1,87,1,'2021-08-30',120,'Billed','Credit',17616,26,120),(1,72,2,'2021-08-30',144,'Billed','Credit',17616,26,72),(1,91,4,'2021-08-30',60,'Billed','Credit',17616,26,15),(1,92,3,'2021-08-30',45,'Billed','Credit',17616,26,15),(1,94,1,'2021-08-30',10,'Billed','Credit',17616,26,10),(1,69,1,'2021-08-30',10,'Billed','Credit',17616,26,10),(1,100,1,'2021-08-30',57,'Billed','Credit',17616,26,57),(1,76,0.068,'2021-08-30',34,'Billed','Credit',17616,26,500);
/*!40000 ALTER TABLE `Cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Customers`
--

DROP TABLE IF EXISTS `Customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Customers` (
  `CID` int NOT NULL AUTO_INCREMENT,
  `Customer_name` varchar(100) NOT NULL,
  `Phone` bigint NOT NULL,
  PRIMARY KEY (`CID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Customers`
--

LOCK TABLES `Customers` WRITE;
/*!40000 ALTER TABLE `Customers` DISABLE KEYS */;
INSERT INTO `Customers` VALUES (1,'Vinay',9019083520),(2,'Shambu',8884229667),(4,'9019083520',9019083520),(5,'Vinay ',9019083520),(6,'Shambu',9535194789),(7,'Krishna',9535194154),(8,'Krishna',9535194354),(9,'Shambhu',9535194789),(10,'Harish',6958750258),(11,'Murthy',7845123690),(12,'Murthy',7418529630),(13,'Murthy',7410852963),(14,'Shivamma',9448988474),(15,'vidya.p',9620180978),(16,'Vani madam P.G',9886152412),(17,'Vani Bhaskar',9886152412),(18,'Vinay`',9019083520),(19,'deepa',9964419475),(20,'Laddu',9874561230),(21,'Kaddu',9874561230),(22,'fgstf',5887972552),(23,'Ramesh',9535194789),(24,'Sambar',9865327410),(25,'Bijoy',9784561230),(26,'Vani Madam P.G',6361720085);
/*!40000 ALTER TABLE `Customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Products`
--

DROP TABLE IF EXISTS `Products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Products` (
  `PID` int NOT NULL AUTO_INCREMENT,
  `Product_name` varchar(100) NOT NULL,
  `Quantity` int NOT NULL,
  `MRP` double NOT NULL,
  `Purchased_rate` double NOT NULL,
  `Selling_rate` double NOT NULL,
  `Manufacturer` varchar(100) NOT NULL,
  `Purchased_date` date NOT NULL,
  `Wholesale_rate` double NOT NULL,
  `Payment` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Order_number` int DEFAULT NULL,
  `isInstock` varchar(100) NOT NULL,
  PRIMARY KEY (`PID`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Products`
--

LOCK TABLES `Products` WRITE;
/*!40000 ALTER TABLE `Products` DISABLE KEYS */;
INSERT INTO `Products` VALUES (1,'Ragi',65,55,28,35,'Sirguppa','2021-01-25',32,'Paid',78007,'yes'),(2,'Surf Excel',8,10,7.75,10,'Hindustan Unilever','2021-01-25',8.75,'Paid',78007,'yes'),(3,'Rice Flour',21,45,28,35,'Bhagyalakshmi','2021-01-25',32,'Paid',78007,'yes'),(5,'idli suji',28,45,30,45,'Bhagyalakshmi','2021-01-25',35,'Paid',78007,'yes'),(6,'Mysore Sandal Small',6,10,8.75,10,'Govt of Karnataka','2021-01-25',9.5,'Paid',78007,'yes'),(7,'Mysore Sandal Big',23,35,31.5,35,'Govt of Karnataka','2021-01-25',33,'Paid',78007,'yes'),(10,'Fiama De vills',30,35,32,33,'Fiama','2021-01-26',33,'Paid',78007,'yes'),(11,'Ragi flour',15,45,28,35,'Bhagyalakshmi','2021-01-28',32,'Paid',78007,'yes'),(14,'Lux International',69,40,37.5,38.5,'Hindustan Unilever','2021-03-15',38.5,'Paid',78007,'yes'),(15,'Toordal',42,175,115,125,'Shivling','2021-03-17',125,'Paid',78007,'yes'),(16,'Indoor gold atta',45,250,126,155,'Chameli devi mills','2021-03-17',155,'Paid',78007,'yes'),(30,'Dark Fantasy',36,30,27,30,'ITC','2021-04-15',28,'Paid',78007,'yes'),(34,'Good Day',20,10,8.75,10,'Britannia','2021-04-15',9.85,'Paid',78007,'yes'),(35,'Lunch Box Rice Bag',3,1800,985,1050,'Sirguppa','2021-04-19',1050,'Paid',78007,'yes'),(36,'Nakshatra Rice Bag',3,1800,875,1000,'Sirguppa','2021-04-19',1100,'Paid',78007,'yes'),(38,'Monaco',38,10,8.75,10,'Parle','2021-05-01',10,'Paid',78007,'yes'),(39,'Jeera Rice',50,150,75,95,'Halt','2021-05-03',110,'Not Paid',64401,'yes'),(40,'Sambar Powder Sachet',36,10,8.75,9.25,'Aachi','2021-05-03',10,'Not Paid',64401,'yes'),(41,'Jeera Powder Sachet',36,10,8.75,9.25,'Aachi','2021-05-03',10,'Not Paid',64401,'yes'),(42,'Rasam powder',36,10,8.75,9.25,'Aachi','2021-05-03',10,'Paid',88749,'yes'),(43,'Bourbon',50,10,8.75,9.25,'Britannia','2021-05-04',10,'Paid',64761,'yes'),(44,'GRB Ghee 200ml',5,142,120,132,'GRB','2021-05-04',142,'Paid',64761,'yes'),(45,'Kadlebele',48,135,78,85,'Liberty','2021-05-04',90,'Paid',40521,'Yes'),(46,'Uddinbele',49,150,116,125,'Bhagyalakshmi','2021-05-04',130,'Paid',40521,'Yes'),(47,'Poha (Avalakki)',31,50,32,40,'Bhagyalakshmi','2021-05-04',38,'Paid',40521,'Yes'),(48,'Medium Rava 500g',29,38,18,25,'Best','2021-05-04',23,'Paid',40521,'Yes'),(49,'Sunpure 5l can',6,900,825,850,'Sunpure','2021-05-04',845,'Paid',40521,'Yes'),(50,'Table Salt',48,21,18,21,'Tata','2021-05-04',21,'Paid',40521,'Yes'),(51,'Rock Salt',48,18,17,18,'Tata','2021-05-04',18,'Paid',40521,'Yes'),(52,'Sugar',26,50,35.4,40,'Diamond','2021-05-04',38,'Paid',40521,'Yes'),(53,'Hesrubele (Moong Daal)',50,150,116,125,'Bhagyalakshmi','2021-05-04',120,'Paid',40521,'Yes'),(54,' RAW RICE  55',40,67,53,57,'MR INDUSTRIES','2021-05-12',55,'Paid',98330,'Yes'),(55,'Bansi Rava 500g',48,32,28,30,'Bhagyalakshmi','2021-05-12',32,'Paid',98330,'Yes'),(56,'Mustard (sasve) 50g',48,15,6,10,'Ganesh Maruti','2021-05-12',10,'Paid',98330,'Yes'),(57,'Anil Seviya 500g',17,45,41,45,'Anil','2021-05-12',45,'Paid',98330,'Yes'),(58,'Nandini Ghee 500g',6,225,220,225,'Nandini','2021-05-12',225,'Paid',98330,'Yes'),(59,'Srinivasa Rice Bag',46,1900,800,925,'Sirguppa Industries','2021-05-12',870,'Paid',64869,'Yes'),(60,'Crystal Salt',44,18,8,10,'Free Flow','2021-05-12',10,'Paid',64869,'Yes'),(61,'Powder Salt',47,18,8,10,'Free Flow','2021-05-12',10,'Paid',64869,'Yes'),(62,'Ananas Flower',50,600,500,600,'Farm Fresh','2021-05-12',600,'Paid',64869,'Yes'),(63,'Garam Masala 50g',49,40,38,40,'Teju','2021-05-12',40,'Paid',64869,'yes'),(64,'Kadlekayi (Peanuts)',50,175,115,143,'Bhagyalaksmi','2021-05-13',130,'Paid',92963,'Yes'),(65,'Jaggery',48,75,48,60,'Diamond','2021-05-13',55,'Paid',92963,'Yes'),(66,'Dhania Powder',48,40,35,40,'Teju','2021-05-13',40,'Paid',92963,'Yes'),(67,'Hesrukaalu',50,145,100,125,'Bhagyalakshmi','2021-05-13',120,'Paid',92963,'Yes'),(68,'Exo Soap',29,10,9,10,'Exo','2021-05-13',10,'Paid',92963,'Yes'),(69,'Soda Packet',46,10,7,10,'Soda','2021-05-13',10,'Paid',92963,'Yes'),(70,'Incense Sticks',49,10,7.15,10,'Bell','2021-05-13',10,'Paid',92963,'Yes'),(71,'Turmeric Powder',48,10,8.25,10,'Teju','2021-05-13',10,'Paid',92963,'Yes'),(72,'Lamp Oil',11,90,69.5,75,'Aalayam','2021-05-13',72,'Paid',92963,'Yes'),(73,'Elaichi',100,4500,2800,4000,'Dry Fruits ','2021-05-13',4000,'Paid',92963,'Yes'),(74,'Tamarind (Hunase)',48,275,165,200,'S S Industries','2021-05-25',180,'Paid',69853,'Yes'),(75,'Jeera 50g',43,20,8.75,15,'Ganesh Maruti','2021-05-25',15,'Paid',69853,'Yes'),(76,'Chakke (cinnamon)',50,650,300,500,'S S Industries','2021-05-25',450,'Paid',69853,'Yes'),(77,'Cloves (lavanga)',50,3000,2000,2800,'S S Industries','2021-05-25',2800,'Paid',69853,'Yes'),(78,'Chilli (Small)',19,200,165,180,'S S Industries','2021-05-25',180,'Paid',69853,'Yes'),(79,'Pickle (5kg)',4,300,190,250,'S S Industries','2021-05-26',230,'Paid',52806,'Yes'),(80,'Hing',47,79,63,79,'L G','2021-07-09',79,'Paid',44026,'yes'),(81,'Nandini Special milk 500ml',6,24,22,23,'Nandini','2021-08-05',23,'Not Paid',28347,'Yes'),(82,'Sunpure Oil',6,175,155,165,'Sunpure','2021-08-12',162,'Paid',27360,'yes'),(83,'Gooday Biscuit',50,10,8.75,10,'Britannia','2021-08-22',9.5,'Paid',58958,'yes'),(84,'Rice Bag (36rs)',43,1800,825,1000,'Sirguppa','2021-08-30',900,'Paid',11390,'Yes'),(85,'Peas (Batani)',50,160,120,150,'OM industries','2021-08-30',140,'Paid',11390,'Yes'),(86,'Guntur Chilli',10,220,160,200,'S S industries','2021-08-30',200,'Paid',11390,'Yes'),(87,'Prakash Tea Powder',5,120,100,120,'Prakash Agencies','2021-08-30',120,'Paid',11390,'Yes'),(88,'Chilli powder',4,110,80,95,'Teju','2021-08-30',95,'Paid',11390,'Yes'),(89,'Sasve (loose)',10,150,110,140,'S S Industries','2021-08-30',130,'Paid',11390,'Yes'),(90,'Kaju Kishmish (10rs) sachet',22,10,6,10,'OM Industries','2021-08-30',10,'Paid',11390,'Yes'),(91,'Rock Salt(Kalluppu)',42,21,14,20,'Trident','2021-08-30',15,'Paid',11390,'Yes'),(92,'Table Salt(pudiuppu)',25,21,14,20,'Trident','2021-08-30',15,'Paid',11390,'Yes'),(93,'Steel Scrubber',49,10,8,10,'Exo','2021-08-30',10,'Paid',11390,'Yes'),(94,'Menthya 50g',48,10,8,10,'SS industries','2021-08-30',10,'Paid',11390,'Yes'),(95,'Black Pepper(Kaal mensu)',48,60,28,40,'S S industries','2021-08-30',35,'Paid',11390,'Yes'),(96,'Byadagi Chilli',10,375,265,320,'S S industries','2021-08-30',300,'Paid',86864,'Yes'),(97,'Garam Masala 500g',5,110,85,100,'Teeju','2021-08-30',95,'Paid',86864,'Yes'),(98,'Dhania',10,150,95,120,'Bhagyalaksmi','2021-08-30',100,'Paid',86864,'Yes'),(99,'Turmeric 200g powder',5,50,35,45,'Teiju','2021-08-30',40,'Paid',86864,'Yes'),(100,'Wheel Soap powder 500g',5,57,55,57,'H U L','2021-08-30',57,'Paid',86864,'Yes');
/*!40000 ALTER TABLE `Products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Vendors`
--

DROP TABLE IF EXISTS `Vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Vendors` (
  `VID` int NOT NULL AUTO_INCREMENT,
  `Vendor_name` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  PRIMARY KEY (`VID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Vendors`
--

LOCK TABLES `Vendors` WRITE;
/*!40000 ALTER TABLE `Vendors` DISABLE KEYS */;
INSERT INTO `Vendors` VALUES (1,'Prasad','p@smm'),(2,'Kavitha','k@smm'),(3,'Keerthan','ke@smm'),(4,'Vinay','v@smm');
/*!40000 ALTER TABLE `Vendors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'SMM'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-27 19:27:24
