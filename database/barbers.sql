-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: barbers
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Table structure for table `barber`
--

DROP TABLE IF EXISTS `barber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barber` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7C48A9A4A76ED395` (`user_id`),
  CONSTRAINT `FK_7C48A9A4A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barber`
--

LOCK TABLES `barber` WRITE;
/*!40000 ALTER TABLE `barber` DISABLE KEYS */;
INSERT INTO `barber` VALUES (5,'test','testaaaaaaa@gmail.com','test','test',NULL,22),(6,'test','test@gmail.com','test','test',NULL,23);
/*!40000 ALTER TABLE `barber` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20251201031534','2025-12-01 04:16:18',9461),('DoctrineMigrations\\Version20251203005319','2025-12-03 01:53:59',323),('DoctrineMigrations\\Version20251207132405','2025-12-07 14:24:42',1193),('DoctrineMigrations\\Version20251207141842','2025-12-07 15:19:01',30),('DoctrineMigrations\\Version20251207160606','2025-12-07 17:06:13',428),('DoctrineMigrations\\Version20251207171454','2025-12-07 19:56:41',1097),('DoctrineMigrations\\Version20251213233305','2025-12-14 00:44:59',1411);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `requested_time` datetime NOT NULL,
  `service` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `user_id` int NOT NULL,
  `barber_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_42C84955A76ED395` (`user_id`),
  KEY `IDX_42C84955BFF2FEF2` (`barber_id`),
  CONSTRAINT `FK_42C84955A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_42C84955BFF2FEF2` FOREIGN KEY (`barber_id`) REFERENCES `barber` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `price` double NOT NULL,
  `duration` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_barber`
--

DROP TABLE IF EXISTS `service_barber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_barber` (
  `service_id` int NOT NULL,
  `barber_id` int NOT NULL,
  PRIMARY KEY (`service_id`,`barber_id`),
  KEY `IDX_428FAC92ED5CA9E6` (`service_id`),
  KEY `IDX_428FAC92BFF2FEF2` (`barber_id`),
  CONSTRAINT `FK_428FAC92BFF2FEF2` FOREIGN KEY (`barber_id`) REFERENCES `barber` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_428FAC92ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_barber`
--

LOCK TABLES `service_barber` WRITE;
/*!40000 ALTER TABLE `service_barber` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_barber` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `coins` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'test@example.com','[\"ROLE_USER\"]','$2y$13$Zx1aCqN5u3eVJb9k0uN7qeOi5ZkXjM1tH3YPY2e0j5aPmYXJXK2Qe','John','Doe',NULL,NULL,0),(2,'test1@gmail.com','[\"ROLE_USER\"]','$2y$13$HBpioeqVRwi6.U4fVfE4ouBksf7h44Oj17yNOYOhHaJwZsjzFTIEe','test','test',NULL,NULL,0),(3,'testqqqq@gmail.com','[\"ROLE_USER\"]','$2y$13$Pr9Lwz9SJtKW3b7IZdLhk.0e8pXYOgjfkadpCc.vSNdilG1cdMiMK','test','test',NULL,NULL,0),(4,'test@gmail.com','[\"ROLE_CLIENT\"]','$2y$13$Fg5aIzYC.uDjajGubbD/ze1oUyVQj8N/YeUGNs4k17GHCtgNk63Ey','test','test',NULL,NULL,0),(5,'test12345@gmail.com','[\"ROLE_CLIENT\"]','$2y$13$6FLh6fLrI7SYRZHpOkUQgeZIcXK9SMuIdxHXfcjsIr.Mr9W8H851i','min','hos',NULL,NULL,0),(6,'test123457@gmail.com','[\"ROLE_CLIENT\"]','$2y$13$GSFGPMEaz206PXaz7a/bpe188FvY/h5XxQqygSpYJL5FjOSJk3aFC','min','hos',NULL,NULL,0),(7,'test23@gmail.com','[]','$2y$13$Oww2CHF6bg01IHhv8jZN/uJBuMa2Lo7clAZEI3jQ8MF0aw40z9cE2','mina','mina','testtest',NULL,220),(8,'test2444@gmail.com','[\"ROLE_BARBER\"]','$2y$13$.dFE7HK9uP5F2cmJY5Q6Bu4hYgYeNRQq6DRoYgaPN5gh7Rg7QqN4W','test','test','24212',NULL,0),(9,'testbbbbbbb@gmail.com','[\"ROLE_BARBER\"]','$2y$13$cToTxTWGdDJJsF4D0vS87uavncXspDp9FF7LyTDurWc5peTzhq47q','test','test','test',NULL,10),(10,'testbbbbbbbaaa@gmail.com','[\"ROLE_BARBER\"]','$2y$13$BMVJNALICzJIwUZuBY6wLOZxKBl77eg4LBBAUeIuSSTwwCaJdJazS','min','hos','24212',NULL,0),(11,'test123457777@gmail.com','[]','$2y$13$gYXlcRbk0BAgIUzmnGrP4e6/GmeqIxUqEkbr8Rh.HW8QmiOtfsiyu','testtest','testtest','24212',NULL,0),(12,'testazerzer@gmail.com','[]','$2y$13$uWQizExzH/iTjMKRcGHK2ObNJlrXpgsmDlz9ZdY0Cc6knYqWNzpIO','test','test','test',NULL,0),(13,'testbbbb@gmail.com','[]','$2y$13$Xf2zxACZRrvf0Dxt2O5lGuwAA63mC76Xel56dNW4JJTiBkyk35Mde','min','hos','455555',NULL,0),(14,'testbbbbnbb@gmail.com','[]','$2y$13$myiC8OtcPdU3iDFdrutJZurQwvQh92JVsduWE0dSLu.QmGR/tUQ.K','testbbbb@gmail.com','testbbbb@gmail.com','testbbbb@gmail.com',NULL,0),(15,'testaaaaaaaaaaaaaa@gmail.com','[]','$2y$13$anLa1jvRRBXfaFkopu9ZuuieIrZczf/qXSEucYd/xxig6fpge91mi','test','test','test',NULL,0),(16,'testtest@gmail.com','[]','$2y$13$qtjPs9TdXGh.5/6AwBh6bOrCop6Hk0Lv7ZzrVq.ce9JXaoeJabmHa','test','test','24212',NULL,0),(17,'testaaaaaaaaa@gmail.com','[]','$2y$13$akcGNoZRCv3eAFIPnqOeo..qW1SwCeVjVJQfheSiy3CX4WQpwYnpu','aaaa','aaaa','aaaa',NULL,0),(18,'testaerzerzear@gmail.com','[\"ROLE_USER\"]','$2y$13$T5XVI8GUn8uz2vVGeUBvk.dpsg046na6d39MlOQ9UjPesr9lJoWge','testtest','testtest','zearzaer',NULL,0),(19,'zerzaerzerzer@gmail.com','[\"ROLE_BARBER\"]','$2y$13$99I8x3MzhcE9ml8bX2zkneqFW/2qFi5HruhMWrQyHtj4v0pfD0bnK','tzerze','tezrzer','eazrr',NULL,0),(20,'testtesttest@gmail.com','[\"ROLE_USER\"]','$2y$13$YhdgtLN75R/fISv3EkDaS.xu9LyAOpiVlrJU7Uo7eux0KYvA.EVZS','test','test','test',NULL,0),(21,'testaaaaaaaaaaaaaaaaaaa@gmail.com','[\"ROLE_BARBER\"]','$2y$13$Z.863sjuM1h3RzrhOdZi4ONh9qpM.HdREaP8Jhl2JCJD6TO4tTGRC','test','test','test',NULL,0),(22,'etertzearze@gmail.com','[\"ROLE_BARBER\"]','$2y$13$tBo.PzPO6TmGojAPNbKB1O64WJ5FuESW.Lj6/D6X5zNJEmQJnu2.2','test','test','test',NULL,0),(23,'thisone@gmail.com','[\"ROLE_BARBER\"]','$2y$13$G3CfiuPLpVqc6kVbSZ/CmeBZui3AC4Cr1wLqXMLJtbWbK.k1YTLm.','test','test','test',NULL,0);
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

-- Dump completed on 2025-12-14 19:51:33
