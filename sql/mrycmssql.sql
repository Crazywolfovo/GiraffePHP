/*
SQLyog Ultimate v12.3.3 (64 bit)
MySQL - 5.7.16-log : Database - mrycms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mrycms` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `mrycms`;

/*Table structure for table `mry_admin` */

DROP TABLE IF EXISTS `mry_admin`;

CREATE TABLE `mry_admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `lastloginip` varchar(30) NOT NULL DEFAULT '0',
  `lastlogintime` int(10) unsigned NOT NULL DEFAULT '0',
  `email` varchar(40) NOT NULL,
  `realname` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`admin_id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `mry_admin` */

insert  into `mry_admin`(`admin_id`,`username`,`password`,`lastloginip`,`lastlogintime`,`email`,`realname`,`status`) values 
(1,'admin','c41d33e06b77991e98b4ab441a36cb86','0',0,'154966231@qq.com','YZR',1);

/*Table structure for table `mry_article` */

DROP TABLE IF EXISTS `mry_article`;

CREATE TABLE `mry_article` (
  `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` int(10) unsigned NOT NULL,
  `title` varchar(80) NOT NULL,
  `small_title` varchar(30) NOT NULL,
  `author` varchar(30) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `keywords` varchar(40) NOT NULL,
  `discription` varchar(250) NOT NULL,
  `order` tinyint(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `copyfrom` varchar(250) NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`article_id`),
  KEY `order` (`order`),
  KEY `cate_id` (`cate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `mry_article` */

insert  into `mry_article`(`article_id`,`cate_id`,`title`,`small_title`,`author`,`thumbnail`,`keywords`,`discription`,`order`,`status`,`copyfrom`,`create_time`,`update_time`) values 
(6,4,'你的名字','名字','新海诚','/upload/a873fd4ae0d3496c1ddb81912007be48.jpg','爱情','爱情故事',0,1,'本地',1487782156,1487782156);

/*Table structure for table `mry_articlecontent` */

DROP TABLE IF EXISTS `mry_articlecontent`;

CREATE TABLE `mry_articlecontent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  CONSTRAINT `mry_articlecontent_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `mry_article` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `mry_articlecontent` */

insert  into `mry_articlecontent`(`id`,`article_id`,`content`,`create_time`,`update_time`) values 
(1,6,'<p>\r\n	挖了平时看懂萨克\r\n</p>\r\n<p>\r\n	<img src=\"/upload/bb3b9a69fb66f6accb1272a30c28e654.jpg\" alt=\"\" />\r\n</p>',1487782156,1487782156);

/*Table structure for table `mry_category` */

DROP TABLE IF EXISTS `mry_category`;

CREATE TABLE `mry_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catename` varchar(30) NOT NULL,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `order` smallint(6) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `order` (`order`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `mry_category` */

insert  into `mry_category`(`id`,`catename`,`pid`,`order`,`status`,`type`) values 
(1,'首页',0,0,1,1),
(2,'新闻',0,0,1,1),
(3,'科技',0,0,1,1),
(4,'娱乐',0,0,1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
