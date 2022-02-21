CREATE DATABASE IF NOT EXISTS `pizza_test`
    DEFAULT CHARACTER SET = `utf8`
    DEFAULT COLLATE = `utf8_general_ci`;

USE `pizza_test`;

# ************************************************************
# Sequel Ace SQL dump
# Version 20025
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 5.7.37)
# Database: pizza_test
# Generation Time: 2022-02-16 14:52:52 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ingredient
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ingredient`;

CREATE TABLE `ingredient` (
                              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                              `name` varchar(64) NOT NULL DEFAULT '',
                              `cost` decimal(6,2) unsigned NOT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ingredient` WRITE;
/*!40000 ALTER TABLE `ingredient` DISABLE KEYS */;

INSERT INTO `ingredient` (`id`, `name`, `cost`)
VALUES
    (1,'Mozzarella',2.00),
    (2,'Tomato',1.50),
    (3,'Salami',3.50);

/*!40000 ALTER TABLE `ingredient` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pizza
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pizza`;

CREATE TABLE `pizza` (
                         `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                         `name` varchar(64) NOT NULL DEFAULT '',
                         `price` decimal(6,2) unsigned NOT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pizza` WRITE;
/*!40000 ALTER TABLE `pizza` DISABLE KEYS */;

INSERT INTO `pizza` (`id`, `name`, `price`)
VALUES
    (1,'Salami',8.95);

/*!40000 ALTER TABLE `pizza` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pizza_ingredient
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pizza_ingredient`;

CREATE TABLE `pizza_ingredient` (
                                    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                                    `pizza_id` int(11) unsigned NOT NULL,
                                    `ingredient_id` int(11) NOT NULL,
                                    `quantity` int(11) NOT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pizza_ingredient` WRITE;
/*!40000 ALTER TABLE `pizza_ingredient` DISABLE KEYS */;

INSERT INTO `pizza_ingredient` (`id`, `pizza_id`, `ingredient_id`, `quantity`)
VALUES
    (1,1,1,3),
    (2,1,2,2),
    (3,1,3,1);

/*!40000 ALTER TABLE `pizza_ingredient` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
