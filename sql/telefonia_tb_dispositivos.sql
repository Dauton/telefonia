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
-- Table structure for table `tb_dispositivos`
--

DROP TABLE IF EXISTS `tb_dispositivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_dispositivos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `linha` varchar(100) DEFAULT NULL,
  `operadora` varchar(100) DEFAULT NULL,
  `servico` varchar(100) DEFAULT NULL,
  `perfil` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `data_ativacao` varchar(100) DEFAULT NULL,
  `sim_card` varchar(100) DEFAULT NULL,
  `marca_aparelho` varchar(100) DEFAULT NULL,
  `modelo_aparelho` varchar(100) DEFAULT NULL,
  `imei_aparelho` varchar(100) DEFAULT NULL,
  `gestao_mdm` varchar(100) DEFAULT NULL,
  `unidade` varchar(100) DEFAULT NULL,
  `centro_custo` varchar(100) DEFAULT NULL,
  `uf` varchar(10) DEFAULT NULL,
  `canal` varchar(100) DEFAULT NULL,
  `ponto_focal` varchar(100) DEFAULT NULL,
  `gestor` varchar(100) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `matricula` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `funcao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_dispositivos`
--

LOCK TABLES `tb_dispositivos` WRITE;
/*!40000 ALTER TABLE `tb_dispositivos` DISABLE KEYS */;
INSERT INTO `tb_dispositivos` VALUES (6,'32542353455','TIM','MOVEL','DFGDFGDFG','DESATIVADO','2024-09-03','3453453453','SAMSUNG','DFGFDGDSFG','345345','','CDARCEX','219002','PA','ID DO BRASIL LOGÍSTICA LTDA','SGCDSFG','DFGDFSG','ERTGERGERW','234234','','SDGSDRFG');
/*!40000 ALTER TABLE `tb_dispositivos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-29 16:12:10
