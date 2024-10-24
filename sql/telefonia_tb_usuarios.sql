CREATE DATABASE  IF NOT EXISTS `telefonia` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `telefonia`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: telefonia
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `tb_usuarios`
--

DROP TABLE IF EXISTS `tb_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `matricula` varchar(10) DEFAULT NULL,
  `unidade` varchar(100) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `perfil` varchar(45) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `senha` varchar(256) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `senha_primeiro_acesso` varchar(45) DEFAULT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cadastrado_por` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_usuarios`
--

LOCK TABLES `tb_usuarios` WRITE;
/*!40000 ALTER TABLE `tb_usuarios` DISABLE KEYS */;
INSERT INTO `tb_usuarios` VALUES (1,'DAUTON FÉLIX','123456','CDARCEX','ANALISTA DE TI','INFRAESTRUTURA IDL','dpfelix','$argon2id$v=19$m=65536,t=4,p=1$alZROVFIWC4xV1pzT1ZoeA$eWVhdLzLXmF5QcxCePQShY5iO/xXpY5tZKJGqLeDF9Q','ATIVADO','ALTERADA','2024-09-30 17:00:36','DAUTON PEREIRA FÉLIX'),(15,'USUÁRIO TI SITES','123456','CDARCEX','ANALISTA DE TI','TI SITES','sites','$argon2id$v=19$m=65536,t=4,p=1$MlVjcGpZWmhFeHdzOThQRA$6B8THFXiyvS9wc+a+P0nSzKHzVQdNL+fkP3Mbz/rPXY','ATIVADO','ALTERADA','2024-10-12 17:15:10','DAUTON FÉLIX'),(16,'ADMINISTRADOR MOBIT','123456','MOBIT','ANALISTA DE TI','MOBIT','mobit','$argon2id$v=19$m=65536,t=4,p=1$dXdWR2F3bWpGekU4MHFtQw$KdCM/2ZccQifWwzPMWtmOU785+RnAAT9cGguJ8tNztk','ATIVADO','ALTERADA','2024-10-12 20:47:31','DAUTON FÉLIX'),(17,'USUÁRIO DE TESTE','12345','CDAMBEX','ANALISTA DE TI','MOBIT','teste','$argon2id$v=19$m=65536,t=4,p=1$bjN4QzdFRWoxLjAyMXQuTA$LP/p+NprkeC3PBL2DhnqV1khsGekFZw32QCKJuSpcys','ATIVADO','ALTERADA','2024-10-19 16:14:30','DAUTON FÉLIX');
/*!40000 ALTER TABLE `tb_usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-24 17:10:38
