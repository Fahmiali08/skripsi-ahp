/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 5.7.24-log : Database - spk_ahp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`spk_ahp` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `spk_ahp`;

/*Table structure for table `mst_alternative` */

DROP TABLE IF EXISTS `mst_alternative`;

CREATE TABLE `mst_alternative` (
  `alternative_id` varchar(25) DEFAULT NULL,
  `alternative_name` varchar(125) DEFAULT NULL,
  `stat_active` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `mst_alternative` */

insert  into `mst_alternative`(`alternative_id`,`alternative_name`,`stat_active`) values 
('A0001','Yanto',1),
('A0002','Udin',1),
('A0003','Asep',1);

/*Table structure for table `mst_criteria` */

DROP TABLE IF EXISTS `mst_criteria`;

CREATE TABLE `mst_criteria` (
  `criteria_id` varchar(25) DEFAULT NULL,
  `criteria_name` varchar(125) DEFAULT NULL,
  `stat_active` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `mst_criteria` */

insert  into `mst_criteria`(`criteria_id`,`criteria_name`,`stat_active`) values 
('C0001','Jujur',1),
('C0002','Disiplin',1),
('C0003','Tanggung Jawab',1);

/*Table structure for table `sys_role` */

DROP TABLE IF EXISTS `sys_role`;

CREATE TABLE `sys_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sys_role` */

insert  into `sys_role`(`role_id`,`role_name`) values 
(1,'ROLE_ADMIN'),
(2,'ROLE_TEACHER'),
(3,'ROLE_STUDENT');

/*Table structure for table `sys_user` */

DROP TABLE IF EXISTS `sys_user`;

CREATE TABLE `sys_user` (
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `stat_active` int(11) NOT NULL DEFAULT '1',
  `password` varchar(255) NOT NULL,
  `current_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(255) NOT NULL DEFAULT '',
  `browser` varchar(255) NOT NULL DEFAULT '',
  `operating_system` varchar(255) NOT NULL DEFAULT '',
  `reference_id` varchar(255) NOT NULL DEFAULT '',
  `role_id` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sys_user_username_unique` (`username`),
  UNIQUE KEY `sys_user_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `sys_user` */

insert  into `sys_user`(`user_id`,`name`,`username`,`email`,`email_verified_at`,`stat_active`,`password`,`current_login`,`last_login`,`ip_address`,`browser`,`operating_system`,`reference_id`,`role_id`,`remember_token`,`created_at`,`updated_at`,`id`) values 
('12457855','Admin Page','admin','admin@example.com',NULL,1,'$2y$10$QcjrTDs8ENN6q/6tD779MeB7LY43TC2f.H5.H1zPX/v.fiHckhFaq','2021-08-20 10:35:21','2021-08-20 10:35:21','','','','','1',NULL,'2021-08-20 03:35:21','2021-08-20 03:35:21',10),
('12457145','ini akun Guru (non admin)','guru','guru@example.com',NULL,1,'$2y$10$c5C8YHfvLyclRKKlzBcmC.G2mVgYVTlVLydoYSRX.P3UT3Qn92BZ.','2021-08-20 10:35:21','2021-08-20 10:35:21','','','','','2',NULL,'2021-08-20 03:35:21','2021-08-20 03:35:21',11),
('12485445','ini akun Siswa (non admin)','siswa','siswa@example.com',NULL,1,'$2y$10$xmFa/1Yc5F38pNYAjS1QXu2OwzOcUQ/kILZ30thL30mkuzJUSmtr2','2021-08-20 10:35:21','2021-08-20 10:35:21','','','','','3',NULL,'2021-08-20 03:35:21','2021-08-20 03:35:21',12);

/*Table structure for table `trx_alternative_analyst` */

DROP TABLE IF EXISTS `trx_alternative_analyst`;

CREATE TABLE `trx_alternative_analyst` (
  `alternative_analyst_id` varchar(25) DEFAULT NULL,
  `alternative_analyst_value` text,
  `alternative_analyst_vertical_value` text,
  `eigen_horizontal_value` text,
  `eigen_vertical_value` text,
  `total_value` float DEFAULT NULL,
  `total_eigen` float DEFAULT NULL,
  `average` float DEFAULT NULL,
  `criteria_id` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `trx_alternative_analyst` */

insert  into `trx_alternative_analyst`(`alternative_analyst_id`,`alternative_analyst_value`,`alternative_analyst_vertical_value`,`eigen_horizontal_value`,`eigen_vertical_value`,`total_value`,`total_eigen`,`average`,`criteria_id`) values 
('A0001','[{\"data_value\":1},{\"data_value\":2},{\"data_value\":3}]','[{\"data_value\":1,\"alternative\":\"A0001\"},{\"data_value\":\"0.500000\",\"alternative\":\"A0001\"},{\"data_value\":\"0.333333\",\"alternative\":\"A0001\"}]','[0.5454546446281172,0.6000000600000059,0.42857142857142855]','[{\"eigen_value\":\"0.545455\"},{\"eigen_value\":\"0.272727\"},{\"eigen_value\":\"0.181818\"}]',1.83333,1,0.524675,'C0001'),
('A0002','[{\"data_value\":\"0.500000\"},{\"data_value\":1},{\"data_value\":3}]','[{\"data_value\":2,\"alternative\":\"A0002\"},{\"data_value\":1,\"alternative\":\"A0002\"},{\"data_value\":\"0.333333\",\"alternative\":\"A0002\"}]','[0.2727273223140586,0.30000003000000297,0.42857142857142855]','[{\"eigen_value\":\"0.600000\"},{\"eigen_value\":\"0.300000\"},{\"eigen_value\":\"0.100000\"}]',3.33333,1,0.333766,'C0001'),
('A0003','[{\"data_value\":\"0.333333\"},{\"data_value\":\"0.333333\"},{\"data_value\":1}]','[{\"data_value\":3,\"alternative\":\"A0003\"},{\"data_value\":3,\"alternative\":\"A0003\"},{\"data_value\":1,\"alternative\":\"A0003\"}]','[0.18181803305782418,0.09999990999999099,0.14285714285714285]','[{\"eigen_value\":\"0.428571\"},{\"eigen_value\":\"0.428571\"},{\"eigen_value\":\"0.142857\"}]',7,1,0.141558,'C0001'),
('A0001','[{\"data_value\":1},{\"data_value\":3},{\"data_value\":2}]','[{\"data_value\":1,\"alternative\":\"A0001\"},{\"data_value\":\"0.333333\",\"alternative\":\"A0001\"},{\"data_value\":\"0.500000\",\"alternative\":\"A0001\"}]','[0.5454546446281172,0.6666666666666666,0.4]','[{\"eigen_value\":\"0.545455\"},{\"eigen_value\":\"0.181818\"},{\"eigen_value\":\"0.272727\"}]',1.83333,1,0.537374,'C0002'),
('A0002','[{\"data_value\":\"0.333333\"},{\"data_value\":1},{\"data_value\":2}]','[{\"data_value\":3,\"alternative\":\"A0002\"},{\"data_value\":1,\"alternative\":\"A0002\"},{\"data_value\":\"0.500000\",\"alternative\":\"A0002\"}]','[0.18181803305782418,0.2222222222222222,0.4]','[{\"eigen_value\":\"0.666667\"},{\"eigen_value\":\"0.222222\"},{\"eigen_value\":\"0.111111\"}]',4.5,1,0.268013,'C0002'),
('A0003','[{\"data_value\":\"0.500000\"},{\"data_value\":\"0.500000\"},{\"data_value\":1}]','[{\"data_value\":2,\"alternative\":\"A0003\"},{\"data_value\":2,\"alternative\":\"A0003\"},{\"data_value\":1,\"alternative\":\"A0003\"}]','[0.2727273223140586,0.1111111111111111,0.2]','[{\"eigen_value\":\"0.400000\"},{\"eigen_value\":\"0.400000\"},{\"eigen_value\":\"0.200000\"}]',5,1,0.194613,'C0002'),
('A0001','[{\"data_value\":1},{\"data_value\":2},{\"data_value\":4}]','[{\"data_value\":1,\"alternative\":\"A0001\"},{\"data_value\":\"0.500000\",\"alternative\":\"A0001\"},{\"data_value\":\"0.250000\",\"alternative\":\"A0001\"}]','[0.5714285714285714,0.6153846153846154,0.4444444444444444]','[{\"eigen_value\":\"0.571429\"},{\"eigen_value\":\"0.285714\"},{\"eigen_value\":\"0.142857\"}]',1.75,1,0.543753,'C0003'),
('A0002','[{\"data_value\":\"0.500000\"},{\"data_value\":1},{\"data_value\":4}]','[{\"data_value\":2,\"alternative\":\"A0002\"},{\"data_value\":1,\"alternative\":\"A0002\"},{\"data_value\":\"0.250000\",\"alternative\":\"A0002\"}]','[0.2857142857142857,0.3076923076923077,0.4444444444444444]','[{\"eigen_value\":\"0.615385\"},{\"eigen_value\":\"0.307692\"},{\"eigen_value\":\"0.076923\"}]',3.25,1,0.34595,'C0003'),
('A0003','[{\"data_value\":\"0.250000\"},{\"data_value\":\"0.250000\"},{\"data_value\":1}]','[{\"data_value\":4,\"alternative\":\"A0003\"},{\"data_value\":4,\"alternative\":\"A0003\"},{\"data_value\":1,\"alternative\":\"A0003\"}]','[0.14285714285714285,0.07692307692307693,0.1111111111111111]','[{\"eigen_value\":\"0.444444\"},{\"eigen_value\":\"0.444444\"},{\"eigen_value\":\"0.111111\"}]',9,1,0.110297,'C0003');

/*Table structure for table `trx_alternative_analyst_result` */

DROP TABLE IF EXISTS `trx_alternative_analyst_result`;

CREATE TABLE `trx_alternative_analyst_result` (
  `criteria_id` varchar(25) DEFAULT NULL,
  `consistency_index` float DEFAULT NULL,
  `ratio_index` float DEFAULT NULL,
  `consistency_ratio` float DEFAULT NULL,
  `consistency` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `trx_alternative_analyst_result` */

insert  into `trx_alternative_analyst_result`(`criteria_id`,`consistency_index`,`ratio_index`,`consistency_ratio`,`consistency`) values 
('C0001',0.0269089,0.58,0.0463947,'consistent'),
('C0002',0.068393,0.58,0.117919,'inconsistent'),
('C0003',0.0269357,0.58,0.0464408,'consistent');

/*Table structure for table `trx_criteria_analyst` */

DROP TABLE IF EXISTS `trx_criteria_analyst`;

CREATE TABLE `trx_criteria_analyst` (
  `criteria_analyst_id` varchar(25) DEFAULT NULL,
  `criteria_analyst_value` text,
  `criteria_analyst_vertical_value` text,
  `eigen_horizontal_value` text,
  `eigen_vertical_value` text,
  `total_value` float DEFAULT NULL,
  `total_eigen` float DEFAULT NULL,
  `average` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `trx_criteria_analyst` */

insert  into `trx_criteria_analyst`(`criteria_analyst_id`,`criteria_analyst_value`,`criteria_analyst_vertical_value`,`eigen_horizontal_value`,`eigen_vertical_value`,`total_value`,`total_eigen`,`average`) values 
('C0001','[{\"data_value\":1},{\"data_value\":2},{\"data_value\":3}]','[{\"data_value\":1,\"criteria\":\"C0001\"},{\"data_value\":\"0.500000\",\"criteria\":\"C0001\"},{\"data_value\":\"0.333333\",\"criteria\":\"C0001\"}]','[0.5454546446281172,0.6000000600000059,0.42857142857142855]','[{\"eigen_value\":\"0.545455\"},{\"eigen_value\":\"0.272727\"},{\"eigen_value\":\"0.181818\"}]',1.83333,1,0.524675),
('C0002','[{\"data_value\":\"0.500000\"},{\"data_value\":1},{\"data_value\":3}]','[{\"data_value\":2,\"criteria\":\"C0002\"},{\"data_value\":1,\"criteria\":\"C0002\"},{\"data_value\":\"0.333333\",\"criteria\":\"C0002\"}]','[0.2727273223140586,0.30000003000000297,0.42857142857142855]','[{\"eigen_value\":\"0.600000\"},{\"eigen_value\":\"0.300000\"},{\"eigen_value\":\"0.100000\"}]',3.33333,1,0.333766),
('C0003','[{\"data_value\":\"0.333333\"},{\"data_value\":\"0.333333\"},{\"data_value\":1}]','[{\"data_value\":3,\"criteria\":\"C0003\"},{\"data_value\":3,\"criteria\":\"C0003\"},{\"data_value\":1,\"criteria\":\"C0003\"}]','[0.18181803305782418,0.09999990999999099,0.14285714285714285]','[{\"eigen_value\":\"0.428571\"},{\"eigen_value\":\"0.428571\"},{\"eigen_value\":\"0.142857\"}]',7,1,0.141558);

/*Table structure for table `trx_criteria_analyst_result` */

DROP TABLE IF EXISTS `trx_criteria_analyst_result`;

CREATE TABLE `trx_criteria_analyst_result` (
  `consistency_index` float DEFAULT NULL,
  `ratio_index` float DEFAULT NULL,
  `consistency_ratio` float DEFAULT NULL,
  `consistency` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `trx_criteria_analyst_result` */

insert  into `trx_criteria_analyst_result`(`consistency_index`,`ratio_index`,`consistency_ratio`,`consistency`) values 
(0.0269089,0.58,0.0463947,'consistent');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
