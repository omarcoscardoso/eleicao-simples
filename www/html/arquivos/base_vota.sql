CREATE DATABASE  IF NOT EXISTS `eleicao` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `eleicao`;
--
-- Table structure for table `apuracao`
--

DROP TABLE IF EXISTS `apuracao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apuracao` (
  `id_enquete` int(11) NOT NULL,
  `id_candidato` int(11) NOT NULL,
  `total_votos` int(11) NOT NULL,
  `turno` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `candidato`
--

DROP TABLE IF EXISTS `candidato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `candidato` (
  `id_candidato` int(11) NOT NULL,
  `nome` varchar(44) NOT NULL,
  `id_enquete` int(11) NOT NULL,
  `ativo` enum('t','f') DEFAULT NULL,
  UNIQUE KEY `candidato_tipo` (`id_candidato`,`id_enquete`,`nome`),
  UNIQUE KEY `nome` (`nome`,`id_enquete`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `eleitores`
--

DROP TABLE IF EXISTS `eleitores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eleitores` (
  `nome` varchar(44) DEFAULT NULL,
  `sexo` varchar(25) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `data_admissao` date DEFAULT NULL,
  `tipo_consagracao` varchar(25) DEFAULT NULL,
  `ativo` enum('t','f') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `opcoes`
--

DROP TABLE IF EXISTS `opcoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opcoes` (
  `id_enquete` int(11) NOT NULL,
  `nome_enquete` varchar(20) NOT NULL,
  `ativo` enum('t','f') DEFAULT NULL,
  UNIQUE KEY `id_enquete` (`id_enquete`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sessao`
--

DROP TABLE IF EXISTS `sessao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessao` (
  `id_enquete` int(11) DEFAULT NULL,
  `sessao` int(11) DEFAULT NULL,
  `turno` int(11) DEFAULT NULL,
  `votos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `urnas`
--

DROP TABLE IF EXISTS `urnas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `urnas` (
  `sessao` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL,
  `local` text,
  PRIMARY KEY (`sessao`),
  UNIQUE KEY `ip` (`ip`,`sessao`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `votos`
--

DROP TABLE IF EXISTS `votos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votos` (
  `id_enquete` int(11) NOT NULL,
  `id_opcao` int(11) NOT NULL,
  `total_votos` int(11) NOT NULL,
  `sessao` int(2) DEFAULT NULL,
  `turno` int(11) NOT NULL,
  `count` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`count`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `votou`
--

DROP TABLE IF EXISTS `votou`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votou` (
  `id_enquete` int(10) NOT NULL,
  `id_opcao` int(10) NOT NULL,
  `votos` int(255) NOT NULL,
  `sessao` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
-- /*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

-- /*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
-- /*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
-- /*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
-- /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- /*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-17 15:50:37
