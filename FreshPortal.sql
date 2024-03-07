create database FreshPortal;
use FreshPortal;

CREATE TABLE `contacten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(600) NOT NULL,
  `email` varchar(600) NOT NULL UNIQUE,
  `adres` varchar(600) NOT NULL,
  `geboortedatum` varchar(600) NOT NULL,
  PRIMARY KEY (`id`)
)