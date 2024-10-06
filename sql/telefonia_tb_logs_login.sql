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
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_logs_login`
--

LOCK TABLES `tb_logs_login` WRITE;
/*!40000 ALTER TABLE `tb_logs_login` DISABLE KEYS */;
INSERT INTO `tb_logs_login` VALUES (1,NULL,'dpfelix','Erro: Usuário desativado!','2024-09-25 10:40:41'),(2,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-25 10:41:56'),(3,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-25 10:44:46'),(4,NULL,'dpfelix','Alerou sua senha no primeiro acesso!','2024-09-25 10:45:30'),(5,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-25 10:45:34'),(6,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-26 14:55:59'),(7,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-27 08:41:43'),(8,NULL,'admin','Erro: Usuário não encontrado!','2024-09-29 08:52:42'),(9,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-29 08:52:44'),(10,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-29 09:20:35'),(11,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-29 09:21:33'),(12,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-29 10:11:31'),(13,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-30 08:41:58'),(14,NULL,'dpfelix','Saiu do sistema realizando logout!','2024-09-30 15:19:56'),(15,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:19:58'),(16,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:20:05'),(17,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:21:13'),(18,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:21:19'),(19,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:21:22'),(20,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:25:24'),(21,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:25:26'),(22,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:29:24'),(23,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:29:26'),(24,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:30:31'),(25,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:30:53'),(26,NULL,'DPFELIX','Erro: Usuário não encontrado!','2024-09-30 15:30:57'),(27,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:31:19'),(28,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:32:08'),(29,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:32:28'),(30,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:33:28'),(31,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:33:31'),(32,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:33:47'),(33,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:35:48'),(34,NULL,'dfelix','Erro: Usuário desativado!','2024-09-30 15:36:12'),(35,NULL,'dfelix','Sucesso: Usuário logado!','2024-09-30 15:36:30'),(36,NULL,'dfelix','Alerou sua senha no primeiro acesso!','2024-09-30 15:39:39'),(37,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:39:41'),(38,NULL,'dpfelix','Erro: Usuário não encontrado!','2024-09-30 15:39:46'),(39,NULL,'dfelix','Sucesso: Usuário logado!','2024-09-30 15:39:50'),(40,NULL,'dfelix','Alerou sua senha no primeiro acesso!','2024-09-30 15:41:12'),(41,NULL,'dfelix','Sucesso: Usuário logado!','2024-09-30 15:41:16'),(42,NULL,'dfelix','Saiu do sistema realizando logout!','2024-09-30 15:43:10'),(43,NULL,'dfelix','Sucesso: Usuário logado!','2024-09-30 15:43:13'),(44,NULL,'dfelix','Saiu do sistema realizando logout!','2024-09-30 15:47:24'),(45,NULL,'teste','Erro: Usuário desativado!','2024-09-30 15:47:31'),(46,NULL,'teste','Erro: Usuário desativado!','2024-09-30 15:50:17'),(47,NULL,'teste','Erro: Senha incorreta!','2024-09-30 15:50:38'),(48,NULL,'teste','Erro: Senha incorreta!','2024-09-30 15:50:46'),(49,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-30 15:50:51'),(50,NULL,'dpfelix','Saiu do sistema realizando logout!','2024-09-30 15:51:53'),(51,NULL,'teste','Sucesso: Usuário logado!','2024-09-30 15:52:00'),(52,NULL,'teste','Alerou sua senha no primeiro acesso!','2024-09-30 15:52:09'),(53,NULL,'teste','Sucesso: Usuário logado!','2024-09-30 15:52:15'),(54,NULL,'teste','Saiu do sistema realizando logout!','2024-09-30 15:55:26'),(55,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-30 15:55:29'),(56,NULL,'dpfelix','Saiu do sistema realizando logout!','2024-09-30 15:55:47'),(57,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-30 15:55:50'),(58,NULL,'dpfelix','Saiu do sistema realizando logout!','2024-09-30 15:56:47'),(59,NULL,'teste','Erro: Usuário desativado!','2024-09-30 15:56:55'),(60,NULL,'dpfelix','Erro: Usuário desativado!','2024-09-30 15:57:13'),(61,NULL,'teste','Erro: Senha incorreta!','2024-09-30 15:57:21'),(62,NULL,'teste','Erro: Senha incorreta!','2024-09-30 15:57:29'),(63,NULL,'dpfelix','Erro: Usuário desativado!','2024-09-30 15:57:45'),(64,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-30 15:58:07'),(65,NULL,'dpfelix','Saiu do sistema realizando logout!','2024-09-30 15:58:44'),(66,NULL,'teste','Sucesso: Usuário logado!','2024-09-30 15:58:52'),(67,NULL,'teste','Alerou sua senha no primeiro acesso!','2024-09-30 15:59:02'),(68,NULL,'dpfelix','Sucesso: Usuário logado!','2024-09-30 16:00:30'),(69,NULL,'dpfelix','Sucesso: Usuário logado!','2024-10-01 15:14:42'),(70,NULL,'dpfelix','Sucesso: Usuário logado!','2024-10-03 16:32:12'),(71,NULL,'dpfelix','Sucesso: Usuário logado!','2024-10-03 16:47:29'),(72,NULL,'dpfelix','Sucesso: Usuário logado!','2024-10-03 16:47:57'),(73,NULL,'dpfelix','Sucesso: Usuário logado!','2024-10-03 16:54:38'),(74,NULL,'dpfelix','Sucesso: Usuário logado!','2024-10-03 17:51:20'),(75,NULL,'dpfelix','Erro: Senha incorreta!','2024-10-03 18:18:59'),(76,NULL,'dpfelix','Sucesso: Usuário logado!','2024-10-03 18:19:04'),(77,NULL,'teste','Sucesso: Usuário logado!','2024-10-03 21:25:30'),(78,NULL,'teste','Saiu do sistema realizando logout!','2024-10-03 22:22:18'),(79,NULL,'teste','Erro: Senha incorreta!','2024-10-03 22:22:24'),(80,NULL,'dpfelix','Sucesso: Usuário logado!','2024-10-03 22:22:30'),(81,NULL,'dpfelix','Saiu do sistema realizando logout!','2024-10-03 22:22:37'),(82,NULL,'dpfelix','Sucesso: Usuário logado!','2024-10-03 22:22:40'),(83,NULL,'dpfelix','Saiu do sistema realizando logout!','2024-10-03 22:23:13'),(84,NULL,'dpfelix','Erro: Senha incorreta!','2024-10-03 22:23:14'),(85,NULL,'dpfelix','Sucesso: Usuário logado!','2024-10-03 22:23:20'),(86,NULL,'dpfelix','Saiu do sistema realizando logout!','2024-10-03 22:23:44'),(87,NULL,'teste','Sucesso: Usuário logado!','2024-10-03 22:23:50'),(88,NULL,'dpfelix','Erro: Senha incorreta!','2024-10-03 22:40:47'),(89,NULL,'dpfelix','Sucesso: Usuário logado!','2024-10-03 22:40:54'),(90,NULL,'dpfelix','Sucesso: Usuário logado!','2024-10-05 15:36:36'),(91,NULL,'dpfelix','Sucesso: Usuário logado!','2024-10-06 14:12:56'),(92,NULL,'dpfelix','Saiu do sistema realizando logout!','2024-10-06 14:31:25'),(93,NULL,'dpfelix','Sucesso: Usuário logado!','2024-10-06 14:31:26'),(94,NULL,'dpfelix','Sucesso: Usuário logado!','2024-10-06 15:18:21');
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

-- Dump completed on 2024-10-06 17:56:11
