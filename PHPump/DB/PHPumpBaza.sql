/*
SQLyog Community v13.2.0 (64 bit)
MySQL - 10.4.22-MariaDB : Database - gym
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`gym` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `gym`;

/*Table structure for table `clanarine` */

DROP TABLE IF EXISTS `clanarine`;

CREATE TABLE `clanarine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clan_id` int(11) DEFAULT NULL,
  `datum_pocetka` date DEFAULT NULL,
  `datum_kraja` date DEFAULT NULL,
  `status` enum('aktivan','istekao') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clan_id` (`clan_id`),
  CONSTRAINT `clan_id` FOREIGN KEY (`clan_id`) REFERENCES `clanovi` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `clanarine` */

insert  into `clanarine`(`id`,`clan_id`,`datum_pocetka`,`datum_kraja`,`status`) values 
(1,1,'2024-07-09','2024-08-28','aktivan'),
(6,2,'2024-07-03','2024-07-08','istekao');

/*Table structure for table `clanovi` */

DROP TABLE IF EXISTS `clanovi`;

CREATE TABLE `clanovi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(255) DEFAULT NULL,
  `prezime` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefon` varchar(255) DEFAULT NULL,
  `datum_rodjenja` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `clanovi` */

insert  into `clanovi`(`id`,`ime`,`prezime`,`email`,`telefon`,`datum_rodjenja`) values 
(1,'Aleksa','Aleksic','aleksa@gmail.com','0611111111','2001-01-01'),
(2,'Marko','Markovic','marko@gmail.com','0622222222','2002-02-02'),
(3,'Boban','Bobanovic','boban@gmail.com','0633333333','2003-03-03'),
(4,'Jovan','Jovanovic','jovan@gmail.com','0644444444','2004-04-04'),
(5,'Ana','Anic','ana@gmail.com','0655555555','2005-05-05'),
(6,'Nina','Ninic','nina@gmail.com','0666666666','2006-06-06');

/*Table structure for table `zaposleni` */

DROP TABLE IF EXISTS `zaposleni`;

CREATE TABLE `zaposleni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `zanimanje` enum('trener','menadzer','admin') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `zaposleni` */

insert  into `zaposleni`(`id`,`user_name`,`password`,`zanimanje`) values 
(1,'trener','trener','trener'),
(2,'admin','admin','admin'),
(3,'menadzer','menadzer','menadzer');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
