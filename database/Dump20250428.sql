-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: pfsa
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Full_Name` varchar(450) NOT NULL,
  `Email` varchar(450) NOT NULL,
  `Username` varchar(450) NOT NULL,
  `Password` varchar(450) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Ishan','ishanas677@gmail.com','ishan','$2y$10$ZlcP5ZlQGEsPABjjY4nko.nLWzzckABowemApgPPhCfgB.5v2XSQi'),(2,'abc','abc@gmail.com','abc','$2y$10$qrabgPIBxOjvd8hLpNWiQ.YDnwh2e3vW68QxMPqy7eHVKBJUQHePi');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `food` (
  `food_id` int NOT NULL AUTO_INCREMENT,
  `food_name` varchar(450) NOT NULL,
  `category` enum('Toffee','Fruits','Biscuits','Chocolate','Cold drinks','Noodles','Beverages','Ice Cream') NOT NULL,
  `brand_name` varchar(450) NOT NULL,
  `calories` varchar(450) NOT NULL,
  `fats` varchar(450) NOT NULL,
  `saturated_fats` varchar(450) NOT NULL,
  `trans_fats` varchar(450) NOT NULL,
  `sugar` varchar(450) NOT NULL,
  `sodium` varchar(450) NOT NULL,
  `protein` varchar(450) NOT NULL,
  `fiber` varchar(450) NOT NULL,
  `carbohydrates` varchar(450) NOT NULL,
  `ingredients` varchar(450) NOT NULL,
  `allergens` varchar(450) NOT NULL,
  `additives` varchar(450) NOT NULL,
  PRIMARY KEY (`food_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food`
--

LOCK TABLES `food` WRITE;
/*!40000 ALTER TABLE `food` DISABLE KEYS */;
INSERT INTO `food` VALUES (1,'Milk Chocolate','Chocolate','Brand A','250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Cocoa, Sugar, Milk','Milk, Soy','Artificial Flavors'),(2,'Orange Juice','Cold drinks','Brand B','120 kcal','0g','0g','0g','12g','10mg','1g','0.5g','30g','100% Orange Juice','None','None'),(3,'Snickers Bar','Chocolate','Mars','250 kcal','12g','4.5g','0g','27g','120mg','4g','1g','33g','Milk Chocolate, Peanuts, Caramel','Milk, Peanuts, Soy','Artificial Flavors'),(4,'Coca-Cola Classic','Cold drinks','Coca-Cola','140 kcal','0g','0g','0g','39g','45mg','0g','0g','39g','Carbonated Water, Sugar, Caffeine','None','Artificial Flavors'),(5,'KitKat','Chocolate','Nestlé','220 kcal','11g','7g','0g','22g','20mg','3g','1g','28g','Milk Chocolate, Wheat Flour, Sugar','Milk, Gluten, Soy','Artificial Flavors'),(6,'OREO Cookies','Biscuits','Nabisco','160 kcal','7g','2g','0g','14g','135mg','1g','1g','25g','Wheat Flour, Sugar, Palm Oil','Gluten, Soy','Artificial Flavors'),(7,'Maggi 2-Minute Noodles','Noodles','Nestlé','360 kcal','14g','6g','0g','2g','900mg','7g','2g','50g','Wheat Flour, Vegetable Oil, Spices','Gluten, Soy','MSG'),(8,'Sprite','Cold drinks','Coca-Cola','140 kcal','0g','0g','0g','38g','65mg','0g','0g','38g','Carbonated Water, Sugar, Natural Flavors','None','Preservatives'),(9,'Dairy Milk Chocolate','Chocolate','Cadbury','200 kcal','11g','7g','0g','22g','40mg','3g','1g','24g','Milk, Sugar, Cocoa Butter','Milk','None'),(10,'Minute Maid Orange Juice','Cold drinks','Minute Maid','110 kcal','0g','0g','0g','24g','15mg','2g','0g','26g','Orange Juice, Vitamin C','None','None'),(11,'Ferrero Rocher','Chocolate','Ferrero','230 kcal','17g','6g','0g','16g','25mg','3g','1g','17g','Milk Chocolate, Hazelnuts, Cocoa Butter','Nuts, Milk, Soy','Artificial Flavors'),(12,'Amul Ice Cream Vanilla','Ice Cream','Amul','207 kcal','11g','7g','0g','18g','65mg','4g','0g','23g','Milk, Cream, Sugar, Vanilla Essence','Milk','None');
/*!40000 ALTER TABLE `food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food_factors`
--

DROP TABLE IF EXISTS `food_factors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `food_factors` (
  `factor_id` int NOT NULL AUTO_INCREMENT,
  `food_id` int NOT NULL,
  `calories` varchar(50) NOT NULL,
  `fats` varchar(50) NOT NULL,
  `saturated_fats` varchar(50) NOT NULL,
  `trans_fats` varchar(50) NOT NULL,
  `sugar` varchar(50) NOT NULL,
  `sodium` varchar(50) NOT NULL,
  `protein` varchar(50) NOT NULL,
  `fiber` varchar(50) NOT NULL,
  `carbohydrates` varchar(50) NOT NULL,
  `allergens` text,
  `additives` text,
  `health_suitability` enum('Safe','Moderate','Avoid') NOT NULL,
  `reason` text,
  `recommended_alternative` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`factor_id`),
  KEY `food_id` (`food_id`),
  CONSTRAINT `food_factors_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food_factors`
--

LOCK TABLES `food_factors` WRITE;
/*!40000 ALTER TABLE `food_factors` DISABLE KEYS */;
INSERT INTO `food_factors` VALUES (1,1,'250','15g','9g','0g','24g','50mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Avoid','High sugar content, not suitable for diabetes.','Dark Chocolate'),(2,1,'250 kcal','15g','9g','0g','24g','50mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Safe','',NULL),(3,2,'120 kcal','0g','0g','0g','12g','10mg','1g','0.5g','30g','None','None','Safe','',NULL),(4,2,'120 kcal','0g','0g','0g','12g','10mg','1g','0.5g','30g','None','None','Safe','',NULL),(5,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(6,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(7,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(8,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(9,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(10,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(11,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(12,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(13,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(14,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(15,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(16,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(17,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(18,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(19,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(20,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(21,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(22,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(23,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(24,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(25,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(26,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(27,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(28,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(29,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(30,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(31,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(32,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(33,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(34,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(35,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(36,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(37,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(38,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(39,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(40,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(41,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(42,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(43,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(44,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(45,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(46,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(47,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(48,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(49,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(50,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(51,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(52,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(53,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(54,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(55,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(56,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(57,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(58,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(59,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(60,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(61,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(62,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(63,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(64,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(65,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(66,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(67,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(68,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(69,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(70,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(71,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(72,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(73,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(74,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(75,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(76,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL),(77,1,'250 kcal','18g','9g','0g','22g','100mg','3g','2g','30g','Milk, Soy','Artificial Flavors','Moderate','High fat content can worsen cholesterol levels.',NULL);
/*!40000 ALTER TABLE `food_factors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `health_profile`
--

DROP TABLE IF EXISTS `health_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `health_profile` (
  `profile_id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(450) NOT NULL,
  `age` varchar(450) NOT NULL,
  `gender` varchar(450) NOT NULL,
  `weight_category` varchar(450) NOT NULL,
  `diabetes_level` varchar(450) NOT NULL,
  `cholesterol_level` varchar(450) NOT NULL,
  `hypertension_level` varchar(450) NOT NULL,
  `heart_condition` varchar(450) NOT NULL,
  `allergies` varchar(450) NOT NULL,
  `sugar_level` varchar(450) NOT NULL,
  `sodium_level` varchar(450) NOT NULL,
  `fats_level` varchar(450) NOT NULL,
  `food_category` varchar(450) NOT NULL,
  `food_item_name` varchar(450) NOT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `health_profile`
--

LOCK TABLES `health_profile` WRITE;
/*!40000 ALTER TABLE `health_profile` DISABLE KEYS */;
INSERT INTO `health_profile` VALUES (1,'','','','','','','','','','','','','',''),(2,'','','','','','','','','','','','','',''),(3,'','','','','','','','','','','','','',''),(4,'','','','','','','','','','','','','',''),(5,'','','','','','','','','','','','','',''),(6,'','19 - 30 years (Young Adults)','female','healthy_weight','controlled','borderline','stage1','mild_risk','severe','pre-diabetic','high','normal','Chocolate','1'),(7,'','19 - 30 years (Young Adults)','female','healthy_weight','controlled','borderline','stage1','mild_risk','severe','pre-diabetic','high','normal','Chocolate','1'),(8,'','19 - 30 years (Young Adults)','female','healthy_weight','controlled','borderline','stage1','mild_risk','severe','pre-diabetic','high','normal','Chocolate','1'),(9,'','19 - 30 years (Young Adults)','female','healthy_weight','controlled','borderline','stage1','mild_risk','severe','pre-diabetic','high','normal','Chocolate','1'),(10,'','19 - 30 years (Young Adults)','female','healthy_weight','controlled','borderline','stage1','mild_risk','severe','pre-diabetic','high','normal','Chocolate','1'),(11,'Sellahewa','13 - 18 years (Teenagers)','male','healthy_weight','prediabetes','healthy','elevated','no_condition','mild','pre-diabetic','normal','normal','Chocolate','1'),(12,'Sellahewa','19 - 30 years (Young Adults)','male','obese','very_high','high','crisis','high_risk','severe','diabetic','high','high','Cold drinks','2'),(13,'Sellahewa','6 - 12 years (Children)','female','obese','normal','healthy','normal','no_condition','no_allergy','diabetic','high','high','Cold drinks','2'),(14,'Sellahewa','6 - 12 years (Children)','female','obese','controlled','healthy','normal','no_condition','no_allergy','diabetic','normal','high','Chocolate','1'),(15,'','','','','','','','','','','','','',''),(16,'','','','','','','','','','','','','',''),(17,'Ishan','','','','','','','','','','','','Chocolate','1'),(18,'Ishan','','','','','','','','','','','','Chocolate','1'),(19,'Ishan','6 - 12 years (Children)','male','healthy_weight','controlled','','','','','pre-diabetic','','','Chocolate','1'),(20,'','','','','','','','','','','','','',''),(21,'Ishan','13 - 18 years (Teenagers)','female','healthy_weight','prediabetes','','','','','pre-diabetic','','','Chocolate','1'),(22,'Ishan','13 - 18 years (Teenagers)','female','healthy_weight','prediabetes','','','','','pre-diabetic','','','Chocolate','1'),(23,'Ishan','13 - 18 years (Teenagers)','female','healthy_weight','prediabetes','','','','','pre-diabetic','','','Chocolate','1'),(24,'Ishan','13 - 18 years (Teenagers)','female','healthy_weight','prediabetes','','','','','pre-diabetic','','','Chocolate','1'),(25,'Ishan','13 - 18 years (Teenagers)','female','healthy_weight','prediabetes','','','','','pre-diabetic','','','Chocolate','1'),(26,'Ishan','13 - 18 years (Teenagers)','female','healthy_weight','prediabetes','','','','','pre-diabetic','','','Chocolate','1'),(27,'Ishan','13 - 18 years (Teenagers)','female','healthy_weight','prediabetes','','','','','pre-diabetic','','','Chocolate','1'),(28,'Ishan','13 - 18 years (Teenagers)','female','healthy_weight','prediabetes','','','','','pre-diabetic','','','Chocolate','1'),(29,'Ishan','19 - 30 years (Young Adults)','male','healthy_weight','controlled','','','','','pre-diabetic','','','Chocolate','1'),(30,'','','','','','','','','','','','','',''),(31,'','','','','','','','','','','','','',''),(32,'','','','','','','','','','','','','',''),(33,'','','','','','','','','','','','','',''),(34,'','','','','','','','','','','','','',''),(35,'','0','','','','','','','','','','','',''),(36,'','0','','','','','','','','','','','',''),(37,'Ishan','13','male','underweight','prediabetes','','','','','normal','','','Chocolate','1'),(38,'Ishan','19','male','overweight','controlled','','','','','pre-diabetic','','','Chocolate','1'),(39,'Ishan','13','male','healthy_weight','prediabetes','borderline','elevated','mild_risk','mild','pre-diabetic','normal','normal','Chocolate','1'),(40,'Ishan','13','Male','healthy_weight','prediabetes','borderline','elevated','mild_risk','mild','pre-diabetic','normal','normal','Chocolate','1'),(41,'Ishan','13','Male','healthy_weight','prediabetes','healthy','elevated','mild_risk','mild','pre-diabetic','normal','normal','Chocolate','1'),(42,'Ishan','13','Male','healthy_weight','prediabetes','healthy','elevated','mild_risk','mild','pre-diabetic','normal','normal','Chocolate','1'),(43,'Ishan','13','Male','healthy_weight','prediabetes','healthy','elevated','mild_risk','mild','pre-diabetic','normal','normal','Chocolate','1'),(44,'Ishan','13','Male','healthy_weight','prediabetes','healthy','elevated','mild_risk','mild','pre-diabetic','normal','normal','Chocolate','1'),(45,'Ishan','19','Male','overweight','prediabetes','healthy','stage1','mild_risk','mild','pre-diabetic','normal','normal','Chocolate','1'),(46,'Ishan','6','Female','overweight','prediabetes','borderline','elevated','mild_risk','mild','pre-diabetic','normal','low','Chocolate','1'),(47,'Ishan','31','Male','healthy_weight','controlled','healthy','stage1','mild_risk','moderate','normal','normal','normal','Cold drinks','2'),(48,'Ishan','31','Male','healthy_weight','controlled','healthy','stage1','mild_risk','moderate','normal','normal','normal','Chocolate','1'),(49,'Ishan','19','Female','overweight','prediabetes','borderline','elevated','mild_risk','moderate','diabetic','normal','normal','Chocolate','1'),(50,'Ishan','19','Female','overweight','prediabetes','borderline','elevated','mild_risk','moderate','diabetic','normal','normal','Chocolate','1'),(51,'Ishan','19','Female','overweight','prediabetes','borderline','elevated','mild_risk','moderate','diabetic','normal','normal','Cold drinks','2'),(52,'Ishan','6','Female','healthy_weight','controlled','healthy','stage2','mild_risk','moderate','pre-diabetic','normal','normal','Chocolate','1');
/*!40000 ALTER TABLE `health_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `Full_Name` varchar(450) NOT NULL,
  `Email` varchar(450) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Password` varchar(450) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Ishan','ishanas677@gmail.com','abc','$2y$10$Kngf5v.zXEWc7GbNrXdot.XURfxez3U/rc5ueL5w.r8VuLjvoYvui'),(2,'Ishan','ishanas677@gmail.com','abc','$2y$10$atJNlcWGySpn7WLiFoi9JekCaTzmZEyCNPn6QORNmXYwwxW8x1Pgq');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-28 19:48:07
