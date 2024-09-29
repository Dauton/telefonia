CREATE DATABASE  IF NOT EXISTS `telefonia` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `telefonia`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: telefonia
-- ------------------------------------------------------
-- Server version	8.0.37

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
-- Table structure for table `tb_logs_login`
--

DROP TABLE IF EXISTS `tb_logs_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_logs_login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `usuario_informado` varchar(100) DEFAULT NULL,
  `evento` varchar(100) DEFAULT NULL,
  `data_evento` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_logs_login`
--

LOCK TABLES `tb_logs_login` WRITE;
/*!40000 ALTER TABLE `tb_logs_login` DISABLE KEYS */;
INSERT INTO `tb_logs_login` VALUES (1,NULL,'dpfelix','Erro: Usuário desativado!','2024-09-25 10:40:41'),(2,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-25 10:41:56'),(3,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-25 10:44:46'),(4,NULL,'dpfelix','Alerou sua senha no primeiro acesso!','2024-09-25 10:45:30'),(5,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-25 10:45:34'),(6,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-26 14:55:59'),(7,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-27 08:41:43'),(8,NULL,'admin','Erro: Usuário não encontrado!','2024-09-29 08:52:42'),(9,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-29 08:52:44'),(10,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-29 09:20:35'),(11,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-29 09:21:33'),(12,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-29 10:11:31');
/*!40000 ALTER TABLE `tb_logs_login` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-29 16:12:09
