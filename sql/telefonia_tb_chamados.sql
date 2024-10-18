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
  `descricao` varchar(9999) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `unidade_usuario` varchar(100) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `data_abertura` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fechado_por` varchar(45) DEFAULT NULL,
  `motivo_fechamento` varchar(256) DEFAULT NULL,
  `data_fechamento` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_chamados`
--

LOCK TABLES `tb_chamados` WRITE;
/*!40000 ALTER TABLE `tb_chamados` DISABLE KEYS */;
INSERT INTO `tb_chamados` VALUES (1,'TESTE','MOBIT','AQUISIÇÃO DE LINHA','BAIXA','sdvw','dpfelix','CDARCEX','EM ABERTO','2024-10-12 14:41:22','NÃO FECHADO','NÃO FECHADO','NÃO FECHADO'),(2,'TESTE 2','INFRAESTRUTURA IDL','AQUISIÇÃO DE LINHA','BAIXA','assa','dpfelix','CDARCEX','EM ABERTO','2024-10-12 14:47:11','NÃO FECHADO','NÃO FECHADO','NÃO FECHADO'),(3,'TROCA DE TELA DO TABLET','INFRAESTRUTURA IDL','REPARO DE APARELHO','URGENTE','Boa tarde!\r\n\r\nPoderiam encaminhar um codigo de postagem correios para envio do seguinte tablet:\r\n\r\nIEMI: 239847239857866\r\n\r\nAt.te,\r\nDauton Pereira Félix','teste','CDARCEX','EM ABERTO','2024-10-12 18:59:17','NÃO FECHADO','NÃO FECHADO','NÃO FECHADO'),(4,'INSTALAÇÃO MDM','MOBIT','INCLUIR OU REMOVER MDM','ALTA','Boa tarde!\r\n\r\nPoderia realizar a ativação nesse aparelho com as seguintes liberação?\r\n\r\nGoogle Chrome, Câmera, Galeria e Calculadora\r\n\r\nDados do aparelho:\r\n\r\nMarca: Samsung\r\nModelo: Galaxy A03\r\nIMEI: 35090830983028\r\nUnidade: CDARCEX\r\nCDC: 219002\r\nPonto Focal: Dauton Pereira Félix\r\nGestor: Gilberto Simões\r\n\r\nAt.te,\r\nDauton Pereira Félix','dpfelix','CDARCEX','EM ABERTO','2024-10-12 20:28:41','NÃO FECHADO','NÃO FECHADO','NÃO FECHADO'),(5,'COMPRA DE CELULAR','MOBIT','AQUISIÇÃO DE APARELHO','ALTA','Boa tarde!\r\n\r\nPrecisamos que seja efetuada a compra de um celular que será detinado oa uso do drone\r\n\r\nNão precisa de linha.\r\n\r\nAt.te,\r\nDauton Pereira Félix','dpfelix','CDARCEX','FECHADO','2024-10-14 16:53:51','mobit','Aparelho enviado\r\n\r\nSegue código de rastreio:\r\nBR0923740989FR','14/10/2024 às 13:57'),(6,'CHAMADO DE TESTE','INFRAESTRUTURA IDL','INCLUIR OU REMOVER MDM','MÉDIA','Boa tarde\r\n\r\nSegue chamado teste','mobit','MOBIT','EM ABERTO','2024-10-14 20:28:24','NÃO FECHADO',NULL,'NÃO FECHADO'),(7,'CHAMADO TESTE','MOBIT','AQUISIÇÃO DE LINHA E APARELHO','ALTA','Boa tarde!\r\n\r\nSegue chamado teste','mobit','MOBIT','EM ABERTO','2024-10-14 20:28:53','NÃO FECHADO',NULL,'NÃO FECHADO'),(8,'CHAMADO TESTE','INFRAESTRUTURA IDL','TROCA DE NÚMERO OU DDD','ALTA','Boa tarde!\r\n\r\nSegue chamado teste','mobit','MOBIT','EM ABERTO','2024-10-14 20:29:10','NÃO FECHADO',NULL,'NÃO FECHADO'),(9,'CHAMADO TESTE','MOBIT','CANCELAMENTO DE LINHA','URGENTE','Boa tarde!\r\n\r\nSegue chamado teste','mobit','MOBIT','EM ABERTO','2024-10-14 20:29:48','NÃO FECHADO',NULL,'NÃO FECHADO'),(10,'CHAMADO TESTE','MOBIT','AQUISIÇÃO DE LINHA','BAIXA','Boa tarde!\r\n\r\nSegue chamado teste','mobit','MOBIT','EM ABERTO','2024-10-14 20:30:05','NÃO FECHADO',NULL,'NÃO FECHADO'),(11,'TROCA DE TELA DE TABLET','MOBIT','REPARO DE APARELHO','URGENTE','Boa tarde!\r\n\r\n\r\nPoderiam encaminhar um código de postagem Correios para envio do seguinte tablet?\r\n\r\nIMEI: 369876213876872\r\n\r\nAtenciosamente,\r\nDauton Félix','dpfelix','CDARCEX','EM ABERTO','2024-10-17 20:13:13','NÃO FECHADO','NÃO FECHADO','NÃO FECHADO'),(12,'CHAMADO DE TESTE','MOBIT','AQUISIÇÃO DE LINHA','BAIXA','wadwqd','dpfelix','CDARCEX','EM ABERTO','2024-10-18 16:35:08','NÃO FECHADO',NULL,'NÃO FECHADO'),(13,'SADFDWEF','INFRAESTRUTURA IDL','AQUISIÇÃO DE LINHA','BAIXA','sdvwd','dpfelix','CDARCEX','EM ABERTO','2024-10-18 16:36:34','NÃO FECHADO','NÃO FECHADO','NÃO FECHADO'),(14,'SADFDWEF','INFRAESTRUTURA IDL','AQUISIÇÃO DE LINHA','BAIXA','sdvwd','dpfelix','CDARCEX','EM ABERTO','2024-10-18 16:36:45','NÃO FECHADO','NÃO FECHADO','NÃO FECHADO');
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

-- Dump completed on 2024-10-18 15:57:44
