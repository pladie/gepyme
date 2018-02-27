-- MySQL dump 10.16  Distrib 10.2.13-MariaDB, for debian-linux-gnu (x86_64)
--
-- ------------------------------------------------------
-- Server version	10.1.30-MariaDB-1~jessie
--
-- Table structure for table `personas`
--
-- Version 1.0.0
CREATE TABLE `personas` (
  `perid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pernombre` varchar(100) DEFAULT NULL,
  `perestado` varchar(20) DEFAULT NULL,
  `perfecalta` date DEFAULT '2017-01-02',
  `perfecbaja` date DEFAULT NULL,
  `perdni` int(8) DEFAULT NULL,
  PRIMARY KEY (`perid`)
) ENGINE=InnoDB AUTO_INCREMENT=323 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
