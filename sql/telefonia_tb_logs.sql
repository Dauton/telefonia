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
-- Table structure for table `tb_logs`
--

DROP TABLE IF EXISTS `tb_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `area_log` varchar(100) DEFAULT NULL,
  `usuario_log` varchar(100) DEFAULT NULL,
  `atividade_log` varchar(256) DEFAULT NULL,
  `result_atividade_log` varchar(256) DEFAULT NULL,
  `data_log` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_chamado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_logs`
--

LOCK TABLES `tb_logs` WRITE;
/*!40000 ALTER TABLE `tb_logs` DISABLE KEYS */;
INSERT INTO `tb_logs` VALUES (1,'Acesso','dpfelix','acessou o sistema','com sucesso','2024-10-18 08:29:27',NULL),(2,'Acesso','','Acesso ao sistema','Senha incorreta','2024-10-18 08:31:47',NULL),(3,'Acesso','dpfelix','Acesso ao sistema','Sucesso','2024-10-18 08:32:18',NULL),(4,'Acesso','dpfelix','Acesso ao sistema','Senha incorreta','2024-10-18 08:32:27',''),(5,'Acesso','Sdpfelix','Acesso ao sistema','Usuário não encontrado','2024-10-18 08:44:03',NULL),(6,'Acesso','dpfelix','Acesso ao sistema','Sucesso','2024-10-18 08:45:42',NULL),(7,'Acesso','','Saiu do sistema','Sucesso','2024-10-18 08:47:55',NULL),(8,'Acesso','dpfelix','Acesso ao sistema','Sucesso','2024-10-18 08:48:28',NULL),(9,'Acesso','dpfelix','Saiu do sistema','Sucesso','2024-10-18 08:48:30',NULL),(10,'Acesso','dpfelix','Acesso ao sistema','Sucesso','2024-10-18 08:49:26',NULL),(11,'Acesso','dpfelix','Logout do sistema','Sucesso','2024-10-18 08:49:29',NULL),(12,'Acesso','dpfelix','Acesso ao sistema','Sucesso','2024-10-18 08:49:31',NULL),(13,'Telefonia','dpfelix','Cadastrou o aparelho de IMEI \"324234324\" e a linha \"12345\" para o usuário \"Fulano Silva\"','Sucesso','2024-10-18 09:59:59',NULL),(14,'Telefonia','dpfelix','Cadastrou o aparelho de IMEI \"2132132131\" e a linha \"\" para o usuário \"\"','Sucesso','2024-10-18 10:00:45',NULL),(15,'Telefonia','dpfelix','Cadastrou o aparelho de IMEI \"\" e a linha \"13213213\" para o usuário \"\"','Sucesso','2024-10-18 10:42:14',NULL),(16,'Telefonia','dpfelix','Atualizou o aparelho de IMEI \"\" e a linha \"987987\" do usuário \"\"','Sucesso','2024-10-18 10:52:25',NULL),(17,'Telefonia','dpfelix','Atualizou o aparelho de IMEI \"\" e a linha \"987987\" do usuário \"\"','Sucesso','2024-10-18 10:54:44',NULL),(18,'Telefonia','dpfelix','Atualizou o aparelho de IMEI \"\" e a linha \"987987\" do usuário \"\"','Sucesso','2024-10-18 11:08:18',NULL),(19,'Telefonia','dpfelix','Cadastrou o aparelho de IMEI \"\" e a linha \"21321321\" para o usuário \"\"','Sucesso','2024-10-18 11:08:49',NULL),(20,'Telefonia','dpfelix','Excluiu o aparelho de IMEI \"\" e a linha \"\" para o usuário \"\"','Sucesso','2024-10-18 12:26:49',NULL),(21,'Telefonia','dpfelix','Excluiu o aparelho de IMEI \"\" e a linha \"\" para o usuário \"\"','Sucesso','2024-10-18 12:29:49',NULL),(22,'Telefonia','dpfelix','Excluiu o aparelho de IMEI \"2132132131\" e a linha \"\" para o usuário \"\"','Sucesso','2024-10-18 12:30:24',NULL),(23,'Opções','dpfelix','Cadastrou a opção \"HONEYWELL\" do tipo \"MARCA\"','Sucesso','2024-10-18 12:38:03',NULL),(24,'Opções','dpfelix','Cadastrou a opção \"HONEYWELL\" do tipo \"MARCA\"','Sucesso','2024-10-18 12:41:06',NULL),(25,'Opções','dpfelix','Cadastrou a opção \"honeywell\" do tipo \"MARCA\"','Sucesso','2024-10-18 12:41:28',NULL),(26,'Opções','dpfelix','Excluiu a opção \"HONEYWELL\" do tipo \"MARCA\"','Sucesso','2024-10-18 12:41:35',NULL),(27,'Opções','dpfelix','Atualizou a opção \"IPHONE\" do tipo \"MARCA\"','Sucesso','2024-10-18 12:44:31',NULL),(28,'Opções','dpfelix','Atualizou a opção \"XIAOMI\" do tipo \"MARCA\"','Sucesso','2024-10-18 12:45:36',NULL),(29,'Usuarios','dpfelix','Resetou a própria senha','Sucesso','2024-10-18 13:11:47',NULL),(30,'Usuarios','dpfelix','Resetou a senha do usuáriomobit','Sucesso','2024-10-18 13:13:19',NULL),(31,'Usuarios','dpfelix','Resetou a senha do usuário \"mobit\"','Sucesso','2024-10-18 13:13:57',NULL),(32,'Chamados','dpfelix','Abriu o chamado de ID ','Sucesso','2024-10-18 13:35:08',NULL),(34,'Chamados','dpfelix','Respondeu o chamado \"CHAMADO DE TESTE\"','Sucesso','2024-10-18 13:47:40',NULL),(35,'Chamados','dpfelix','Moveu o chamado para o departamento \"MOBIT\"','Sucesso','2024-10-18 13:49:21',NULL),(36,'Acesso','dpfelix','Logout do sistema','Sucesso','2024-10-18 14:08:08',''),(37,'Acesso','dpfelix','Acesso ao sistema','Senha incorreta','2024-10-18 14:15:35',''),(38,'Acesso','dpfelix','Acesso ao sistema','Sucesso','2024-10-18 14:15:40',''),(39,'Acesso','dpfelix','Logout do sistema','Sucesso','2024-10-18 14:16:13',''),(40,'Acesso','dpfelix','Acesso ao sistema','Sucesso','2024-10-18 14:16:36',''),(41,'Acesso','dpfelix','Logout do sistema','Sucesso','2024-10-18 14:27:18','NULL'),(42,'Acesso','dpfelix','Acesso ao sistema','Senha incorreta','2024-10-18 14:27:47',''),(43,'Acesso','dpfelix','Acesso ao sistema','Sucesso','2024-10-18 14:27:50',''),(44,'Usuarios','dpfelix','Resetou a própria senha','Sucesso','2024-10-18 14:28:01',''),(45,'Chamados','dpfelix','Respondeu o chamado \"SADFDWEF\"','Sucesso','2024-10-18 14:28:19',''),(46,'Chamados','dpfelix','Respondeu o chamado \"SADFDWEF\"','Sucesso','2024-10-18 14:29:30','14'),(47,'Chamados','dpfelix','Fechou o chamado \"SADFDWEF\"','Sucesso','2024-10-18 14:30:55','14'),(48,'Chamados','dpfelix','Reabriu o chamado \"SADFDWEF\"','Sucesso','2024-10-18 14:31:31','14'),(49,'Chamados','dpfelix','Respondeu o chamado \"SADFDWEF\"','Sucesso','2024-10-18 14:44:33','13'),(50,'Chamados','dpfelix','Fechou o chamado \"SADFDWEF\"','Sucesso','2024-10-18 14:44:54','13'),(51,'Chamados','dpfelix','Reabriu o chamado \"SADFDWEF\"','Sucesso','2024-10-18 14:44:59','13'),(52,'Acesso','dpfelix','Acesso ao sistema','Sucesso','2024-10-18 15:42:35','');
/*!40000 ALTER TABLE `tb_logs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-18 15:57:45
