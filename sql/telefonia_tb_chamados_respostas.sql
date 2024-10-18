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
-- Table structure for table `tb_chamados_respostas`
--

DROP TABLE IF EXISTS `tb_chamados_respostas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_chamados_respostas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_chamado` int DEFAULT NULL,
  `descricao_resposta` varchar(256) DEFAULT NULL,
  `respondido_por` varchar(45) DEFAULT NULL,
  `data_resposta` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_chamados_respostas`
--

LOCK TABLES `tb_chamados_respostas` WRITE;
/*!40000 ALTER TABLE `tb_chamados_respostas` DISABLE KEYS */;
INSERT INTO `tb_chamados_respostas` VALUES (1,1,'Teste','dpfelix','2024-10-12 14:45:25'),(6,2,'Resposta do usuário teste','teste','2024-10-12 17:18:03'),(7,1,'Atualizado','teste','2024-10-12 17:52:29'),(8,3,'Boa tarde!\r\n\r\nSegue código de postagem:\r\n\r\n1258625\r\n\r\nAtenciosamente\r\nEquipe Mobit','teste','2024-10-12 19:00:09'),(10,3,'Bom dia!\r\n\r\nMuito obrigado!\r\n\r\nAt.te,\r\nDauton Pereira Félix','teste','2024-10-12 19:17:22'),(11,4,'Boa tarde!\r\n\r\nInstalação realizada, poderia validar?\r\n\r\nAtenciosamente,\r\nMobit','mobit','2024-10-12 20:48:43'),(12,4,'Boa tarde!\r\n\r\nDeu certo!\r\nMuito obrigado!!\r\n\r\nAt.te,\r\nDauton Pereira Félix','dpfelix','2024-10-12 21:05:09'),(18,5,'Boa tarde!\r\n\r\nAprovado\r\n\r\nMobit, por favor, enviar o aparelho.\r\n\r\nAt.te,\r\nInfraestrutura IDL','teste','2024-10-14 16:54:46'),(19,5,'Boa tarde!\r\n\r\nAparelho enviado\r\n\r\nSegue código de rastreio:\r\nBR0923740989FR\r\n\r\nAtenciosamente,\r\nMobit Soluções','mobit','2024-10-14 16:56:14'),(20,11,'Bom dia!\r\n\r\nSegue código de postagem:\r\n\r\n921873982173\r\n\r\nAtenciosamente, \r\nEquipe Mobit','dpfelix','2024-10-17 20:14:01'),(21,12,'Resposta teste','dpfelix','2024-10-18 16:46:39'),(22,12,'Resposta teste','dpfelix','2024-10-18 16:47:40'),(23,14,'pokjpods','dpfelix','2024-10-18 17:28:19'),(24,14,'ewfewf','dpfelix','2024-10-18 17:29:30'),(25,13,'Olá mundo','dpfelix','2024-10-18 17:44:33');
/*!40000 ALTER TABLE `tb_chamados_respostas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-18 15:57:44
