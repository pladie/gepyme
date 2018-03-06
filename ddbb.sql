-- MySQL dump 10.16  Distrib 10.2.13-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 192.168.33.80    Database: XXX
-- ------------------------------------------------------
-- Server version       10.1.30-MariaDB-1~jessie

-- Cambios de 1.0.0 a 2.0.0

ALTER TABLE `stock` 
CHANGE COLUMN `stkserie` `stkserie` VARCHAR(100) NOT NULL ,
CHANGE COLUMN `stkasignacion` `stkasignacion` VARCHAR(100) NOT NULL ,
ADD UNIQUE INDEX `stkserie_UNIQUE` (`stkserie` ASC);

-- Version 1.0.0
CREATE TABLE `log` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `logserie` varchar(45) NOT NULL,
  `logdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `logtrans` varchar(45) DEFAULT NULL,
  `logitem` varchar(45) DEFAULT NULL,
  `loglong` varchar(255) DEFAULT NULL,
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
  PRIMARY KEY (`stkid`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `facturas` (
  `facid` int(11) NOT NULL AUTO_INCREMENT,
  `facnro` varchar(45) DEFAULT NULL,
  `facfecha` varchar(45) DEFAULT NULL,
  `facimporte` varchar(45) DEFAULT NULL,
  `facevaladmin` varchar(45) DEFAULT NULL,
  `facevalprod` varchar(45) DEFAULT NULL,
  `facproveedor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`facid`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `proveedores` (
  `provid` int(11) NOT NULL AUTO_INCREMENT,
  `provnombre` varchar(45) DEFAULT NULL,
  `provestado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`provid`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
