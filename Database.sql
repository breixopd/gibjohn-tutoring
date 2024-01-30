CREATE DATABASE  IF NOT EXISTS `gibjohn`;
USE `gibjohn`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `idusers` int NOT NULL AUTO_INCREMENT,
  `useremail` varchar(45) NOT NULL,
  `userpass` varchar(255) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `teachcode` varchar(7) DEFAULT NULL,
  `act_done` int DEFAULT '0',
  PRIMARY KEY (`idusers`),
  UNIQUE KEY `idusers_UNIQUE` (`idusers`),
  UNIQUE KEY `useremail_UNIQUE` (`useremail`),
  UNIQUE KEY `userpass_UNIQUE` (`userpass`)
);