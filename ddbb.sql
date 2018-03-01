-- MySQL dump 10.16  Distrib 10.2.13-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 192.168.33.80    Database: XXX
-- ------------------------------------------------------
-- Server version       10.1.30-MariaDB-1~jessie

CREATE TABLE `log` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `logserie` varchar(45) NOT NULL,
  `logdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `logtrans` varchar(45) DEFAULT NULL,
  `logitem` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `personas` (
  `perid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pernombre` varchar(100) DEFAULT NULL,
  `perestado` varchar(20) DEFAULT NULL,
  `perfecalta` date DEFAULT '2017-01-02',
  `perfecbaja` date DEFAULT NULL,
  `perdni` int(8) DEFAULT NULL,
  PRIMARY KEY (`perid`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `stock` (
  `stkid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stktipo` varchar(50) DEFAULT NULL,
  `stkmarca` varchar(50) DEFAULT NULL,
  `stkmodelo` varchar(50) DEFAULT NULL,
  `stkserie` varchar(100) DEFAULT NULL,
  `stkasignacion` varchar(100) DEFAULT NULL,
  `stkestado` varchar(45) DEFAULT NULL,
  `stkplan` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
