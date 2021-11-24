-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: dorayaki_factory
-- ------------------------------------------------------
-- Server version	8.0.27

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `refresh_token` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('dadang','$2b$10$g8Lr4ZN5nUhOrAHGh0KX.O4qe9KGUy6HOIMaa2vpwyJY8IgtH8wZi','dadang@gmail.com','eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6ImRhZGFuZyIsImVtYWlsIjoiZGFkYW5nQGdtYWlsLmNvbSIsImlhdCI6MTYzNjcyOTcyMywiZXhwIjoxNjM2ODE2MTIzfQ.T5Hzd2vrboqcQjApBT8vDAFm7S7puuVR3XQiqqCN4r0');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bahan_baku`
--

DROP TABLE IF EXISTS `bahan_baku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bahan_baku` (
  `nama_bahan_baku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stok` int NOT NULL,
  PRIMARY KEY (`nama_bahan_baku`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bahan_baku`
--

LOCK TABLES `bahan_baku` WRITE;
/*!40000 ALTER TABLE `bahan_baku` DISABLE KEYS */;
INSERT INTO `bahan_baku` VALUES ('Apel',120),('Coklat',180),('Gula',82),('Pasir',70),('Strawberry',120),('Terigu',88);
/*!40000 ALTER TABLE `bahan_baku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bahan_resep`
--

DROP TABLE IF EXISTS `bahan_resep`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bahan_resep` (
  `id_resep` int NOT NULL,
  `bahan_baku` varchar(255) NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`id_resep`,`bahan_baku`),
  KEY `fk_bahan_baku` (`bahan_baku`),
  KEY `id_resep` (`id_resep`),
  CONSTRAINT `fk_bahan_baku` FOREIGN KEY (`bahan_baku`) REFERENCES `bahan_baku` (`nama_bahan_baku`),
  CONSTRAINT `fk_id_resep` FOREIGN KEY (`id_resep`) REFERENCES `resep` (`id_resep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bahan_resep`
--

LOCK TABLES `bahan_resep` WRITE;
/*!40000 ALTER TABLE `bahan_resep` DISABLE KEYS */;
INSERT INTO `bahan_resep` VALUES (1,'Gula',7),(1,'Pasir',7),(5,'Gula',3),(5,'Pasir',5),(5,'Terigu',2);
/*!40000 ALTER TABLE `bahan_resep` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_request`
--

DROP TABLE IF EXISTS `log_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_request` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `ip` text NOT NULL,
  `endpoint` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_request`
--

LOCK TABLES `log_request` WRITE;
/*!40000 ALTER TABLE `log_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_toko`
--

DROP TABLE IF EXISTS `request_toko`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request_toko` (
  `id_request` int NOT NULL AUTO_INCREMENT,
  `varian` varchar(255) NOT NULL,
  `jumlah_penambahan` int NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_request`),
  KEY `FK_request_toko_resep` (`varian`),
  CONSTRAINT `FK_request_toko_resep` FOREIGN KEY (`varian`) REFERENCES `resep` (`nama_resep`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_toko`
--

LOCK TABLES `request_toko` WRITE;
/*!40000 ALTER TABLE `request_toko` DISABLE KEYS */;
INSERT INTO `request_toko` VALUES (1,'Rasa Pasir',1,0);
/*!40000 ALTER TABLE `request_toko` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resep`
--

DROP TABLE IF EXISTS `resep`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resep` (
  `id_resep` int NOT NULL AUTO_INCREMENT,
  `nama_resep` varchar(255) NOT NULL,
  PRIMARY KEY (`id_resep`),
  UNIQUE KEY `nama_resep` (`nama_resep`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resep`
--

LOCK TABLES `resep` WRITE;
/*!40000 ALTER TABLE `resep` DISABLE KEYS */;
INSERT INTO `resep` VALUES (9,'Rasa Coklat'),(6,'Rasa Melon'),(5,'Rasa Pasir'),(1,'Terigu');
/*!40000 ALTER TABLE `resep` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-24 18:22:46
