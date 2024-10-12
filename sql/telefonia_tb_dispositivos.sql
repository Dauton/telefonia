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
-- Table structure for table `tb_dispositivos`
--

DROP TABLE IF EXISTS `tb_dispositivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_dispositivos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `possui_linha` varchar(45) DEFAULT NULL,
  `linha` varchar(100) DEFAULT NULL,
  `operadora` varchar(100) DEFAULT NULL,
  `servico` varchar(100) DEFAULT NULL,
  `perfil` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `data_ativacao` varchar(100) DEFAULT NULL,
  `sim_card` varchar(100) DEFAULT NULL,
  `possui_aparelho` varchar(45) DEFAULT NULL,
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
  `possui_usuario` varchar(45) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `matricula` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `funcao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `linha` (`linha`,`operadora`,`servico`,`perfil`,`status`,`sim_card`,`marca_aparelho`,`modelo_aparelho`,`imei_aparelho`,`unidade`,`centro_custo`,`uf`,`ponto_focal`,`gestor`,`nome`,`matricula`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_dispositivos`
--

LOCK TABLES `tb_dispositivos` WRITE;
/*!40000 ALTER TABLE `tb_dispositivos` DISABLE KEYS */;
INSERT INTO `tb_dispositivos` VALUES (1,'Sim','35999988733','VIVO','MOVEL','VOL ILIMITADO + 4G','DESATIVADO','2020-12-30','213213','Sim','SAMSUNG','GALAXY A03 CORE','213458765432325','','CDARCEX','219002','MG','ID DO BRASIL LOGÍSTICA LTDA','DAUTON PEREIRA FELIX','GILBERTO SIMÕES','Sim','DAUTON PEREIRA FELIX','500838','DPFELIX@ID-LOGISTICS.COM','ANALISTA DE TI'),(2,'Não','','','','','','','','Sim','MOTOROLA','MOTO E22','0987654678902333','SIM','CDAMBEX','204303','MG','ID DO BRASIL LOGÍSTICA LTDA','DAUTON PEREIRA FÉLIX','MARCELO CARRIEL','Não','','','',''),(6,'Sim','987987','CLARO','MOVEL','','ATIVADO','2024-10-07','','Não','','','','','CDAMBEX','204303','AC','ID ARMAZENS GERAIS LTDA','EWFEWV','ERF','Não','','','',''),(7,'Sim','213213','OI','MOVEL','','','','WDFCWE','Não','','','','','CDAMBEX','204303','AC','ID ARMAZENS GERAIS LTDA','DFW','DFWE','Não','','','',''),(8,'Sim','2131231','OI','','','','','','Não','','','','','CDAMBEX','204303','AC','ID ARMAZENS GERAIS LTDA','ASF','SDFW','Não','','','',''),(9,'Sim','234234','CLARO','MOVEL','SAS','DESATIVADO','','213124213412','Não','MOTOROLA','GALAXY A03 CORE','','','CDAMBEX','204303','AC','ID ARMAZENS GERAIS LTDA','SAFW','SDFGS','Não','','','',''),(10,'Sim','213123','CLARO','MOVEL','SACW','ATIVADO','2024-12-31','ASCQ','Não','','','','','CDAMBEX','204303','AC','ID ARMAZENS GERAIS LTDA','CSCQ','CWEC','Não','','','',''),(14,'Sim','2132432','CLARO','MOVEL','DSCWD','ATIVADO','2024-12-30','dwed','Não','','','','','CDAMBEX','204303','AC','ID ARMAZENS GERAIS LTDA','CDCWV','RECFE','Não','','','',''),(15,'Sim','21323432','CLARO','MOVEL','WEFWEV','ATIVADO','2024-12-30','213123','Não','','','','','CDAMBEX','204303','AC','ID ARMAZENS GERAIS LTDA','WEFEWV','ERFREW','Não','','','','');
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

-- Dump completed on 2024-10-12 16:03:01
