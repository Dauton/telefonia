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
  `id_resp_igual_id_chamado` int DEFAULT NULL,
  `descricao_resposta` varchar(256) DEFAULT NULL,
  `data_resposta` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_resposta` varchar(45) DEFAULT NULL,
  `fechado_por` varchar(45) DEFAULT NULL,
  `motivo_fechamento` varchar(256) DEFAULT NULL,
  `data_fechamento` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_chamados`
--

LOCK TABLES `tb_chamados` WRITE;
/*!40000 ALTER TABLE `tb_chamados` DISABLE KEYS */;
INSERT INTO `tb_chamados` VALUES (1,'TESTE','INFRAESTRUTURA IDL','AQUISIÇÃO DE LINHA','ALTA','teste','dpfelix','CDARCEX','FECHADO','2024-10-09 21:45:00',NULL,NULL,'2024-10-09 21:45:00',NULL,'dpfelix','Feito','09/10/2024 às 20:03'),(2,'REMOVER MDM','MOBIT','INCLUIR OU REMOVER MDM','URGENTE','Ola, preciso que seja removido o pulsus do seguinte aparelho\r\n\r\nId pulsus 1230\r\n\r\nAt.te,\r\nDauton Félix','dpfelix','CDARCEX','FECHADO','2024-10-09 21:49:16',NULL,NULL,'2024-10-09 21:49:16',NULL,'dpfelix','Ajustado','09/10/2024 às 20:04'),(3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-10-09 22:05:49',2,'Olá, poderia realizar um teste?','2024-10-09 22:05:49','dpfelix',NULL,NULL,NULL),(4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-10-09 22:28:51',1,'Teste','2024-10-09 22:28:51','dpfelix',NULL,NULL,NULL),(5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-10-10 11:37:08',1,'Testando novamente','2024-10-10 11:37:08','dpfelix',NULL,NULL,NULL),(6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-10-10 11:40:31',1,'Resposta','2024-10-10 11:40:31','dpfelix',NULL,NULL,NULL),(7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-10-10 11:40:56',1,'Testamdo nova,mente','2024-10-10 11:40:56','dpfelix',NULL,NULL,NULL),(8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-10-10 11:41:17',1,'KJWDOWQ','2024-10-10 11:41:17','dpfelix',NULL,NULL,NULL),(9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-10-10 13:21:49',1,'Olá, mundo!','2024-10-10 13:21:49','dpfelix',NULL,NULL,NULL),(10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-10-10 14:21:52',1,'Olá mundo\r\n\r\nOlá mundo\r\n\r\nOlá mundo','2024-10-10 14:21:52','dpfelix',NULL,NULL,NULL);
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

-- Dump completed on 2024-10-10 17:01:59
