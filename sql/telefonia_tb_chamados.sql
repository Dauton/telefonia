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
-- Table structure for table `tb_chamados`
--

DROP TABLE IF EXISTS `tb_chamados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_chamados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `prioridade` varchar(100) DEFAULT NULL,
  `descricao` varchar(256) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `unidade_usuario` varchar(100) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `data_abertura` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_chamados`
--

LOCK TABLES `tb_chamados` WRITE;
/*!40000 ALTER TABLE `tb_chamados` DISABLE KEYS */;
INSERT INTO `tb_chamados` VALUES (1,'INCLUSÃO DE MDM','MOBIT','INCLUIR OU REMOVER MDM','URGENTE','Boa tarde!\r\n\r\nPoderiam incluir MDM nos seguintes tablets?\r\n\r\nSegue IMEIs\r\n\r\n210349719208477\r\n983298732474383\r\n\r\nAt.te,\r\nDauton Pereira Félix','dpfelix','CDARCEX','EM ABERTO','2024-10-06 20:24:56'),(2,'COMPRA DE CELULAR','INFRAESTRUTURA IDL','AQUISIÇÃO DE LINHA E APARELHO','ALTA','Bom dia!\r\n\r\nPreciso que seja comprado um aparelho + linha para o novo supervisor da unidade CDARCEX','dpfelix','CDARCEX','EM ABERTO','2024-10-06 20:27:26'),(3,'GCVNHFGD','INFRAESTRUTURA IDL','AQUISIÇÃO DE APARELHO','BAIXA','FGHFG','dpfelix','CDARCEX','EM ABERTO','2024-10-06 20:32:26'),(4,'SDFSDF','MOBIT','AQUISIÇÃO DE APARELHO','BAIXA','sdfsd','dpfelix','CDARCEX','EM ABERTO','2024-10-06 20:50:37'),(5,'DFGDRFG','INFRAESTRUTURA IDL','AQUISIÇÃO DE APARELHO','MÉDIA','dsfgsd','dpfelix','CDARCEX','EM ABERTO','2024-10-06 20:50:49');
/*!40000 ALTER TABLE `tb_chamados` ENABLE KEYS */;
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
