-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: algum_v0
-- ------------------------------------------------------
-- Server version	5.5.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `conta_usuarios`
--

LOCK TABLES `conta_usuarios` WRITE;
/*!40000 ALTER TABLE `conta_usuarios` DISABLE KEYS */;
INSERT INTO `conta_usuarios` VALUES (5,5,2,'2016-04-18 14:14:15','2016-04-18 14:14:15'),(6,6,2,'2016-04-18 14:14:15','2016-04-18 14:14:15'),(7,7,2,'2016-04-18 14:14:15','2016-04-18 14:14:15'),(8,8,2,'2016-04-18 14:14:15','2016-04-18 14:14:15');
/*!40000 ALTER TABLE `conta_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `contas`
--

LOCK TABLES `contas` WRITE;
/*!40000 ALTER TABLE `contas` DISABLE KEYS */;
INSERT INTO `contas` VALUES (5,'Conta corrente',0.00,0.00,1,'2016-04-18 14:14:15','2016-04-18 14:14:15'),(6,'Investimento',0.00,0.00,2,'2016-04-18 14:14:15','2016-04-18 14:14:15'),(7,'Cartão de crédito',0.00,0.00,3,'2016-04-18 14:14:15','2016-04-18 14:14:15'),(8,'Carteira',0.00,0.00,4,'2016-04-18 14:14:15','2016-04-18 14:14:15');
/*!40000 ALTER TABLE `contas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `contas_padrao`
--

LOCK TABLES `contas_padrao` WRITE;
/*!40000 ALTER TABLE `contas_padrao` DISABLE KEYS */;
INSERT INTO `contas_padrao` VALUES (1,'Conta corrente',1,NULL,NULL),(2,'Investimento',2,NULL,NULL),(3,'Cartão de crédito',3,NULL,NULL),(4,'Carteira',4,NULL,NULL);
/*!40000 ALTER TABLE `contas_padrao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `grupo_usuarios`
--

LOCK TABLES `grupo_usuarios` WRITE;
/*!40000 ALTER TABLE `grupo_usuarios` DISABLE KEYS */;
INSERT INTO `grupo_usuarios` VALUES (1,'Dívidas',1,2,NULL,NULL),(2,'Moradia',1,2,NULL,NULL),(3,'Alimentação',1,2,NULL,NULL),(4,'Saúde',1,2,NULL,NULL),(5,'Educação',1,2,NULL,NULL),(6,'Vestuário',1,2,NULL,NULL),(7,'Transporte',1,2,NULL,NULL),(8,'Lazer',1,2,NULL,NULL),(9,'Despesas Pessoais',1,2,NULL,NULL),(10,'Despesas Financeiras',1,2,NULL,NULL),(11,'Outras',1,2,NULL,NULL),(12,'Salário',2,2,NULL,NULL),(13,'13º salário',2,2,NULL,NULL),(14,'Rendimento de investimento',2,2,NULL,NULL),(15,'Premios e bonificações',2,2,NULL,NULL),(16,'Receita de aluguéis',2,2,NULL,NULL),(17,'Indenizações',2,2,NULL,NULL),(18,'Pagto. Cartão de Crédito',3,2,NULL,NULL),(19,'Aplicação em investimento',3,2,NULL,NULL),(20,'Resgate de investimento',3,2,NULL,NULL),(21,'Saque',3,2,NULL,NULL),(22,'Transferência',3,2,NULL,NULL);
/*!40000 ALTER TABLE `grupo_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `grupos_padrao`
--

LOCK TABLES `grupos_padrao` WRITE;
/*!40000 ALTER TABLE `grupos_padrao` DISABLE KEYS */;
INSERT INTO `grupos_padrao` VALUES (1,'Dívidas',1,NULL,NULL),(2,'Moradia',1,NULL,NULL),(3,'Alimentação',1,NULL,NULL),(4,'Saúde',1,NULL,NULL),(5,'Educação',1,NULL,NULL),(6,'Vestuário',1,NULL,NULL),(7,'Transporte',1,NULL,NULL),(8,'Lazer',1,NULL,NULL),(9,'Despesas Pessoais',1,NULL,NULL),(10,'Despesas Financeiras',1,NULL,NULL),(11,'Outras',1,NULL,NULL),(12,'Salário',2,NULL,NULL),(13,'13º salário',2,NULL,NULL),(14,'Rendimento de investimento',2,NULL,NULL),(15,'Premios e bonificações',2,NULL,NULL),(16,'Receita de aluguéis',2,NULL,NULL),(17,'Indenizações',2,NULL,NULL),(18,'Pagto. Cartão de Crédito',3,NULL,NULL),(19,'Aplicação em investimento',3,NULL,NULL),(20,'Resgate de investimento',3,NULL,NULL),(21,'Saque',3,NULL,NULL),(22,'Transferência',3,NULL,NULL);
/*!40000 ALTER TABLE `grupos_padrao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tipo_contas`
--

LOCK TABLES `tipo_contas` WRITE;
/*!40000 ALTER TABLE `tipo_contas` DISABLE KEYS */;
INSERT INTO `tipo_contas` VALUES (1,'Conta corrente',NULL,NULL),(2,'Investimento',NULL,NULL),(3,'Cartão de Crédito',NULL,NULL),(4,'Espécie',NULL,NULL),(5,'Outras',NULL,NULL);
/*!40000 ALTER TABLE `tipo_contas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tipo_grupo`
--

LOCK TABLES `tipo_grupo` WRITE;
/*!40000 ALTER TABLE `tipo_grupo` DISABLE KEYS */;
INSERT INTO `tipo_grupo` VALUES (1,'Despesa',NULL,NULL),(2,'Receita',NULL,NULL),(3,'Transferência',NULL,NULL);
/*!40000 ALTER TABLE `tipo_grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (2,'andrelrs80@gmail.com','2016-04-18 14:14:15','2016-04-18 14:14:15');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-15  8:15:26
