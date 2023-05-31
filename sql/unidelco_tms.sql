/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.5.5-10.4.24-MariaDB : Database - unidelco_tms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`unidelco_tms` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `unidelco_tms`;

/*Table structure for table `authorities` */

DROP TABLE IF EXISTS `authorities`;

CREATE TABLE `authorities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `authorities` */

insert  into `authorities`(`id`,`name`,`created_at`,`updated_at`) values (1,'Administrator','2022-08-04 17:40:11','2022-08-04 17:40:11'),(2,'Manager','2022-08-04 17:40:11','2022-08-04 17:40:11'),(3,'Supplier','2022-08-05 16:20:08','2022-08-05 16:20:08');

/*Table structure for table `clients` */

DROP TABLE IF EXISTS `clients`;

CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `clients` */

insert  into `clients`(`id`,`account_no`,`name`,`address1`,`created_at`,`updated_at`) values (4,'AFR002','AFRORES & TRINIDAD','8A AFRICAN STREET, OAKLANDS','2022-08-04 20:34:59','2023-01-30 02:10:51'),(10,'BE001','B&E INTERNATIONAL','93-94 MAPLE STREET, POMONA, KEMPTON PARK','2022-11-29 13:06:53','2023-01-30 02:12:00'),(13,'PRO001','PROCESS AUTOMATION','148 EPSOM AVENUE, NORTH RIDING','2023-01-20 05:18:38','2023-01-30 02:12:48'),(14,'PT001','PTS SOLUTIONS','78 BUCKINGHAM ROAD, KLOOF, DURBAN','2023-01-30 02:15:26','2023-01-30 02:15:26'),(15,'LE001','LEADING EDGE PLANT HIRE','223 LONDON LANE, KNOPPIESLAAGTE','2023-01-30 02:16:20','2023-01-30 02:16:20'),(16,'FQ001','FQM TRIDENT LIMITED PROJECTS','LEVEL 1, 24 OUTRAM STREET, PERTH, AUSTRALIA','2023-01-30 02:17:44','2023-01-30 02:33:55'),(17,'KAN001','KANSANSHI MINING PLC - PROJECTS','LEVEL 1, 24 OUTRAM STREET, PERTH, AUSTRALIA','2023-01-30 02:18:26','2023-01-30 02:18:37'),(18,'KAN002','KANSANSHI MINING PLC - OPERATIONS','OLD CONGO ROAD, SOLWEZI, ZAMBIA','2023-01-30 02:19:30','2023-01-30 02:19:30'),(19,'ME001','MEDUPI POWER STATION J/V','DOUGLAS ROBERTS CENTRE, 22 SKEEN BOULEVARD, BEDFORDVIEW','2023-01-30 02:20:35','2023-01-30 02:20:35'),(20,'MO001','MOSCO SCAFFOLDING & FIRE PREVENT','15 PLUTO STREET, NALEDI INDUSTRIAL PARK, SASOLBURG','2023-01-30 02:21:29','2023-01-30 02:21:29'),(21,'KH001','KHAVAHAKONE CONSTRUCTION GROUP','223 LONDON LANE, KNOPPIESLAAGTE ROAD, MIDRAND','2023-01-30 02:23:45','2023-01-30 02:23:45'),(22,'EN001','ENDRESS + HAUSER','5 COMMERSE CRESCENT, EAST GATE EXT. WEST 13, SANDTON','2023-01-30 02:25:17','2023-01-30 02:25:17'),(23,'BA001','BANELLA METALS SUPPLIERS','4 MANGANESE STREET, VULCANIA','2023-01-30 02:26:04','2023-01-30 02:26:04'),(24,'IM001','IMBABALA LOGISTICS MANAGEMENT','130 BLACKREEF ROAD, DINWIDDIE, GERMISTON','2023-01-30 02:35:40','2023-01-30 02:35:40'),(25,'LE002','LEICA GEOSYSTEMS','WOODMEAD OFFICE PARK, BUILDING 18, 2ND FLOOR, 20 WOODLANDS DRIVE, WOODMEAD','2023-01-30 02:36:51','2023-01-30 02:36:51'),(26,'CA001','CANAF LOGISTICS','1427 BELLEVUE AVE, WEST VANCOUVER, CANADA','2023-01-30 02:38:27','2023-01-30 02:38:27'),(27,'AF001','AFRICA RAIL LOGISTICS & TECHNOLOGIES','UNIT 14, CNR. KENTMERE STREET & HEATON LANE, LONGLAKE EXT 19, MODDERFONTEIN','2023-01-30 02:42:19','2023-01-30 02:42:19'),(28,'YI001','YIELD TRADING 110 CC','PO BOX 1364, NIGEL','2023-01-30 02:44:44','2023-01-30 02:44:44'),(29,'MA001','MAKHAYA CORROSIION CONTROL','40 RIETBOK STREET, HIGHBURY, RANDVAAL','2023-01-30 02:49:45','2023-01-30 02:49:45'),(30,'LA001','LAVINSTAR LOGISTICS','MAKWANA ROAD, MAROL, MUMBAI','2023-01-30 02:51:28','2023-01-30 02:51:28'),(31,'AC001','ACTIVE INDUSTRIAL ENGINEERING SUPPLIES','140 LAMP ROAD, WADEVILLE','2023-01-30 02:52:49','2023-01-30 02:52:49'),(32,'SU001','SUWENDA TRADING 52','51 TUIN STREET, RUSTENBURG','2023-01-30 02:54:22','2023-01-30 02:54:22'),(33,'SO001','SOUTHEY CONTRACTING CAPE','NIT F1-3 CENTURY SQUARE, 7 HERON CRESCENT, CAPE TOWN','2023-01-30 02:57:49','2023-01-30 02:57:49'),(34,'AN001','ENZA CONSTRUCTION','SILVERSTREAM BUSINESS PARK, 10 MUSWELL ROAD SOUTH, BRYANSTON','2023-01-30 02:59:49','2023-01-30 02:59:49'),(35,'ER001','ERB TECHNOLOGIES','11 CNR SUNI & LECHWE AVE. CORPORATE PARK SOUTH, OLD JHB/PTA ROAD, RANDJIESPARK','2023-01-30 03:01:01','2023-01-30 03:01:01'),(36,'TH001','THETA CONSTRUCTION PLANT & TRUCK HIRE','3 - 5TH STREET, BOOYSENS RESERVE','2023-01-30 03:02:50','2023-01-30 03:02:50'),(37,'ST001','STEFANUTTI STOCKS INLAND','ELANDSFONTEIN, GERMISTON','2023-01-30 03:05:53','2023-01-30 03:05:53'),(38,'CO001','CONCOR CONSTRUCTION','HQ BEDFORDVIEW BUILDING - BLOCK B, 2 ARBROATH ROAD, BEDFORDVIEW','2023-01-30 03:07:06','2023-01-30 03:07:06'),(39,'VA001','VAN STADEN ENGINEERING','9 MOLECULE ROAD, VULCANIA, BRAKPAN','2023-01-30 03:07:58','2023-01-30 03:07:58'),(40,'RE001','RENTTECH SA','1 MANCHESTER ROAD, WADEVILLE','2023-01-30 03:10:36','2023-01-30 03:10:36');

/*Table structure for table `clients_orders` */

DROP TABLE IF EXISTS `clients_orders`;

CREATE TABLE `clients_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_orders_order_id_foreign` (`order_id`),
  KEY `clients_orders_client_id_foreign` (`client_id`),
  CONSTRAINT `clients_orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `clients_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `clients_orders` */

insert  into `clients_orders`(`id`,`order_id`,`client_id`,`created_at`,`updated_at`) values (27,27,4,'2022-10-09 13:30:38','2022-10-09 13:30:38'),(33,33,10,'2022-11-29 13:08:54','2022-11-29 13:08:54'),(35,35,10,'2022-12-04 14:09:14','2022-12-04 14:09:14'),(38,38,4,'2022-12-15 01:20:13','2022-12-15 01:20:13'),(39,39,10,'2022-12-19 01:53:30','2022-12-19 01:53:30'),(44,44,13,'2023-01-20 05:20:52','2023-01-20 05:20:52'),(45,45,13,'2023-01-31 07:05:47','2023-01-31 07:05:47'),(46,46,10,'2023-02-01 01:45:18','2023-02-01 01:45:18'),(47,47,18,'2023-02-01 01:45:27','2023-02-01 01:45:27'),(48,48,10,'2023-02-06 00:06:41','2023-02-06 00:06:41'),(49,49,18,'2023-02-16 03:53:12','2023-02-16 03:53:12');

/*Table structure for table `containers` */

DROP TABLE IF EXISTS `containers`;

CREATE TABLE `containers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `containers` */

/*Table structure for table `equipments` */

DROP TABLE IF EXISTS `equipments`;

CREATE TABLE `equipments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `equipments` */

insert  into `equipments`(`id`,`name`,`created_at`,`updated_at`) values (1,'CHAINS','2022-10-15 21:43:20','2023-03-20 07:53:07'),(2,'C/PLATES','2022-10-15 21:43:53','2023-03-20 07:53:07'),(3,'DUNNAGE','2022-10-15 21:44:03','2023-03-20 07:53:07'),(4,'SIDES','2022-10-15 21:44:16','2023-03-20 07:53:07'),(5,'STRAPS','2022-10-15 21:44:27','2023-03-20 07:53:07'),(6,'TARPS','2022-10-15 21:44:39','2023-03-20 07:53:07'),(14,'TWISTLOCKS','2022-11-29 13:30:41','2023-03-20 07:53:07'),(15,'LOCK','2023-01-31 10:04:35','2023-03-20 07:53:07'),(16,'LOCK 1','2023-01-31 10:13:05','2023-03-20 07:53:07');

/*Table structure for table `load_addresses` */

DROP TABLE IF EXISTS `load_addresses`;

CREATE TABLE `load_addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `load_addresses` */

insert  into `load_addresses`(`id`,`name`,`address1`,`address2`,`address3`,`city`,`province1`,`province2`,`created_at`,`updated_at`) values (1,'UNIDEL CARRIERS','285 DEODAR STREET,','POMONA AH','KEMPTON PARK','GAUTENG','SA',NULL,'2022-08-21 22:57:02','2023-04-07 15:15:49'),(5,'DCT','EX','DURBAN','NAVIS UPDATED WITH','OCEAN MARINE','KZN','TOWN','2022-08-22 12:43:50','2023-01-30 04:20:42'),(6,'PROCESS AUTOMATION','148 EPSOM AVENUE,','NORTH RIDING','GAUTENG','GAUTENG','GAUTENG',NULL,'2022-08-22 12:44:33','2023-01-30 04:20:26'),(8,'B&E INTERNATIONAL','93-94 MAPLE STREET','POMONA','KEMPTON PARK','GAUTENG','GAUTENG',NULL,'2022-11-29 13:32:19','2023-04-07 11:49:54'),(9,'BANELLA METALS','BRAKPAN','BRAKPAN','BRAKPAN','BRAKPAN','GAUTENG',NULL,'2022-12-19 02:02:18','2023-01-30 04:18:33'),(10,'SOUTHEY CAPE','SOUTHEY CAPE TOWN','548 SMITH AVE','CAPE','CAPE','CAPE',NULL,'2023-01-18 07:26:04','2023-01-18 07:26:04');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_09_21_154824_create_authorities_table',1),(4,'2018_09_21_194311_add_level_to_users',1),(5,'2022_07_14_055157_create_orders_table',1),(6,'2022_07_17_152232_create_clients_table',1),(7,'2022_07_17_152606_create_transporters_table',1),(8,'2022_07_18_064934_add_client_id_to_orders',1),(9,'2022_07_18_071946_add_order_id_to_clients',1),(10,'2022_07_19_063530_remove_order_id_from_clients',1),(11,'2022_07_19_063927_remove_client_id_from_orders',1),(12,'2022_07_19_064846_create_clients_orders_table',1),(13,'2022_07_19_082745_create_transporters_orders_table',1),(14,'2022_07_28_075246_add_addresses_to_clients',1),(15,'2022_07_28_191505_add_addresses_to_transporters',1),(16,'2022_08_01_190559_remove_address2_from_clients',1),(17,'2022_08_01_192716_remove_address2_from_transporters',1),(18,'2022_08_01_200954_remove_uc_number_from_orders',1),(19,'2022_08_07_150008_create_vehicle_types_table',2),(21,'2022_08_08_071138_create_transporter_order_details_table',3),(23,'2022_08_22_143047_create_load_addresses_table',4),(24,'2022_08_23_070456_create_off_load_addresses_table',5),(25,'2022_08_29_061305_add_load_addr_id_to_transporter_order_details',6),(26,'2022_08_29_062018_add_offload_addr_id_to_transporter_order_details',7),(27,'2022_09_14_065656_add_gi_currency_to_transporter_order_details',8),(28,'2022_09_26_213721_create_containers_table',9),(29,'2022_10_16_154043_create_equipments_table',10),(30,'2022_10_16_161548_add_equipment_ids_to_transporter_order_details',11),(31,'2022_11_23_072938_add_additional_fields_to_transporter_order_details',12),(32,'2022_11_23_085539_add_additional_fields2_to_transporter_order_details',13),(33,'2022_12_12_205748_add_trailer2_to_transporter_order_details',14),(34,'2023_01_14_085822_add_extension_to_transporter_order_details',15),(35,'2023_02_15_144946_add_transporter_id_to_transporter_order_details',16),(36,'2023_02_15_153231_add_order_id_to_transporter_order_details',16);

/*Table structure for table `off_load_addresses` */

DROP TABLE IF EXISTS `off_load_addresses`;

CREATE TABLE `off_load_addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `off_load_addresses` */

insert  into `off_load_addresses`(`id`,`name`,`address1`,`address2`,`address3`,`city`,`province1`,`province2`,`created_at`,`updated_at`) values (2,'KANSANSHI MINE','SOLWEZI,','ZAMBIA','ZAMBIA','ZAMBIA','ZAMBIA',NULL,'2022-08-22 13:26:02','2023-04-07 15:15:49'),(3,'KALUMBILA MINE','SENTINEL PROJECT','BETWEEN SOLWEZI AND LUMWANA','ZAMBIA','ZAMBIAZ','ZAMBIA',NULL,'2022-08-22 13:28:04','2023-01-30 04:23:36'),(5,'UNIDEL CARRIERS','285 DEODAR STREET','POMONA AH','KEMPTON PARK','GAUTENG','GAUTENG',NULL,'2023-01-30 04:24:34','2023-01-30 04:24:34');

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `cancelled` tinyint(1) NOT NULL DEFAULT 0,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `orders` */

insert  into `orders`(`id`,`branch`,`date_created`,`cancelled`,`remarks`,`created_at`,`updated_at`) values (25,'J','2022-10-09 06:00:00',0,'test','2022-10-09 13:27:01','2022-10-09 13:27:01'),(26,'J','2022-10-08 06:00:00',0,'test','2022-10-09 13:29:12','2022-10-09 13:29:12'),(27,'J','2022-10-09 06:00:00',0,'test','2022-10-09 13:30:37','2022-10-09 13:30:37'),(28,'J','2022-10-13 06:00:00',0,'test','2022-10-13 20:32:49','2022-10-13 20:32:49'),(29,'J','2022-11-10 03:00:00',0,'test','2022-11-10 10:18:43','2022-11-10 10:18:43'),(30,'J','2022-11-16 03:00:00',0,'test','2022-11-16 19:27:37','2022-11-16 19:27:37'),(31,'J','2022-11-24 03:00:00',0,'test','2022-11-24 13:40:16','2022-11-24 13:40:16'),(32,'J','2022-11-28 03:00:00',0,'test','2022-11-28 19:00:23','2022-11-28 19:00:23'),(33,'J','2022-11-29 03:00:00',0,'test','2022-11-29 13:08:54','2022-11-29 13:08:54'),(34,'J','2022-11-29 03:00:00',0,'test','2022-11-29 17:08:51','2022-11-29 17:08:51'),(35,'J','2022-12-04 03:00:00',0,'test','2022-12-04 14:09:14','2022-12-04 14:09:14'),(36,'J','2022-12-12 10:00:00',0,'test','2022-12-13 01:05:46','2022-12-13 01:05:46'),(37,'J','2022-12-12 10:00:00',0,'test','2022-12-13 01:13:37','2022-12-13 01:13:37'),(38,'J','2022-12-14 10:00:00',0,'test','2022-12-15 01:20:13','2022-12-15 01:20:13'),(39,'J','2022-12-18 10:00:00',0,'test','2022-12-19 01:53:30','2022-12-19 01:53:30'),(40,'J','2023-01-08 10:00:00',0,'test','2023-01-09 02:39:25','2023-01-09 02:39:25'),(41,'J','2023-01-16 17:00:00',0,'test','2023-01-17 07:09:46','2023-01-17 07:09:46'),(42,'J','2023-01-17 17:00:00',0,'test','2023-01-18 07:17:09','2023-01-18 07:17:09'),(43,'J','2023-01-17 17:00:00',0,'test','2023-01-18 07:44:34','2023-01-18 07:44:34'),(44,'J','2023-01-19 17:00:00',0,'test','2023-01-20 05:20:52','2023-01-20 05:20:52'),(45,'J','2023-01-30 17:00:00',0,'test','2023-01-31 07:05:47','2023-01-31 07:05:47'),(46,'J','2023-01-31 17:00:00',0,'test','2023-02-01 01:45:18','2023-02-01 01:45:18'),(47,'J','2023-01-31 17:00:00',0,'test','2023-02-01 01:45:27','2023-02-01 01:45:27'),(48,'J','2023-02-05 17:00:00',0,'test','2023-02-06 00:06:41','2023-02-06 00:06:41'),(49,'J','2023-02-15 17:00:00',0,'test','2023-02-16 03:53:12','2023-02-16 03:53:12');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `transporter_order_details` */

DROP TABLE IF EXISTS `transporter_order_details`;

CREATE TABLE `transporter_order_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transporter_order_id` int(10) unsigned NOT NULL,
  `transporter_id` int(10) unsigned DEFAULT NULL,
  `order_id` int(10) unsigned DEFAULT NULL,
  `gi_extension` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A',
  `gi_att` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gi_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gi_tons` int(11) NOT NULL DEFAULT 0,
  `gi_abnormal` tinyint(1) NOT NULL DEFAULT 0,
  `gi_instruction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gi_reqd` tinyint(1) NOT NULL DEFAULT 0,
  `gi_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gi_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gi_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gi_terms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v_type_id` int(10) unsigned NOT NULL,
  `v_l` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v_w` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v_h` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v_add_dimension` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v_equipments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v_container_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v_driver_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v_vessel_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v_truck` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v_trailer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `load_addr_id` int(10) unsigned DEFAULT NULL,
  `offload_addr_id` int(10) unsigned DEFAULT NULL,
  `l_date` timestamp NULL DEFAULT NULL,
  `l_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l_telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `o_date` timestamp NULL DEFAULT NULL,
  `o_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `o_telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v_trailer2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transporter_order_details_transporter_order_id_foreign` (`transporter_order_id`),
  KEY `transporter_order_details_v_type_id_foreign` (`v_type_id`),
  KEY `transporter_order_details_load_addr_id_foreign` (`load_addr_id`),
  KEY `transporter_order_details_offload_addr_id_foreign` (`offload_addr_id`),
  CONSTRAINT `transporter_order_details_load_addr_id_foreign` FOREIGN KEY (`load_addr_id`) REFERENCES `load_addresses` (`id`),
  CONSTRAINT `transporter_order_details_offload_addr_id_foreign` FOREIGN KEY (`offload_addr_id`) REFERENCES `off_load_addresses` (`id`),
  CONSTRAINT `transporter_order_details_transporter_order_id_foreign` FOREIGN KEY (`transporter_order_id`) REFERENCES `transporters_orders` (`id`),
  CONSTRAINT `transporter_order_details_v_type_id_foreign` FOREIGN KEY (`v_type_id`) REFERENCES `vehicle_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transporter_order_details` */

insert  into `transporter_order_details`(`id`,`transporter_order_id`,`transporter_id`,`order_id`,`gi_extension`,`gi_att`,`gi_desc`,`gi_tons`,`gi_abnormal`,`gi_instruction`,`gi_reqd`,`gi_value`,`gi_currency`,`gi_rate`,`gi_terms`,`v_type_id`,`v_l`,`v_w`,`v_h`,`v_add_dimension`,`v_equipments`,`v_container_number`,`v_driver_name`,`v_vessel_name`,`v_truck`,`v_trailer`,`load_addr_id`,`offload_addr_id`,`l_date`,`l_contact`,`l_telephone`,`o_date`,`o_contact`,`o_telephone`,`v_trailer2`,`created_at`,`updated_at`) values (15,32,1,25,'A','kkk','goods',500,0,'test ins',1,'45.5','USD','70.5','30 Days',4,'23.6','405.6','78.9','160','3,6','USPS-903','LG-232','BKK-OPPP','GH-900-AFE','BKF-232-AEE',5,3,'1999-07-14 06:00:00','IOP-9000-WE','1526-7899-121','2000-01-17 03:00:00','MB-232','635-1578-021',NULL,'2022-10-09 13:27:01','2023-02-18 11:56:52'),(16,33,6,26,'A','economy','coal',120,0,'white',1,'85.2','ZAR','74.3','COD',4,'5','16','90.5','qwe','5','DHL-20','L-300','RV','TT-SS-999',NULL,6,2,'2014-04-17 12:00:00','NW-UIIP','452-09-48666','2014-05-18 12:00:00','HHP-099','859-5678-0023',NULL,'2022-10-09 13:29:12','2022-12-12 06:34:24'),(17,34,4,27,'A','Iron','CONCRETE BLOCKS',120,0,NULL,0,'400.5','USD','25','30 Days',3,'15','46','77.5',NULL,'3,4',NULL,NULL,NULL,'UPS-900-PPP','UPS-2323-FEEFE',5,3,'2003-09-29 06:00:00',NULL,'02-456-7893','2004-06-02 06:00:00',NULL,'02-8956-4565',NULL,'2022-10-09 13:30:38','2022-11-23 00:35:02'),(18,35,4,28,'A','ty','Fuel',25,1,'gg',0,'56','USD','10.2','COD',4,'23.5','5666','56','fffff','1,3,6','1111','22256','333','4444qqq','5555',5,3,'2022-11-19 03:00:00','abc','123-4569','2021-12-22 03:00:00','bb','566-9565-09',NULL,'2022-10-13 20:32:49','2022-11-22 21:40:56'),(19,36,1,29,'A','test','Food',540,0,'ssssssss',0,'45','USD','6','COD',2,'45','67','66','12*49','2,3,5','DHL-009','UU-202-QWE',NULL,'78-UOOP','789-003-VVBHE',6,3,'2020-04-26 12:00:00','OP-23','452-485-1556','2020-10-26 12:00:00','ZXW-23','482-148-7856','123UI-Z','2022-11-10 10:18:43','2022-12-12 07:05:10'),(20,37,1,30,'A','fish','fish desc',1580,0,'Test Fish Note',0,'50','ZAR','48.25','30 Days',4,'50','155.5','89',NULL,'2,3,6','USPS-009-3449','GH-934-YY','GUE','TYIE-80900','VXDJ-343-EFE',6,2,'2022-11-23 10:00:00','QW-233','152-1569-7895','2022-12-28 10:00:00','8-OVFD-WER','426-896-4856','G7','2022-11-16 19:27:37','2022-12-13 00:57:23'),(21,38,5,31,'A',NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-11-24 13:40:16','2022-11-24 13:40:16'),(22,39,1,32,'A','John','coal',12,1,'Abnormal load. CHANGED 30.11.22',1,'500','ZAR','12000','COD',1,'435','345','345','CHANGED 30.11.22','1,2,3,4,5,6','FFAU 140 7499 -','TARUVINGA','MSC BRANKA','ACE 2379','JL 14 HC GP - NEED TRAILER NO 2 / 30.11.22',5,2,'2022-11-27 10:00:00','John Doe','8383883','2002-01-31 10:00:00','CHANGES MADE 30.11.22',NULL,NULL,'2022-11-28 19:00:23','2022-12-12 01:56:29'),(23,40,2,33,'A',NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-11-29 13:08:54','2022-11-29 13:08:54'),(24,41,1,34,'A',NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-11-29 17:08:51','2022-11-29 17:08:51'),(25,42,2,35,'A','05.12.22','Description - 05.12.22',2,1,'Note - made 05.12.2022',1,'55000.00','ZAR','6500.00','30 Days',16,'05.12','05.12','05.12','Additional Dimentions - 05.12.22','3,5,14','BCAU  156 1563','BRILLIANT','EX - MSC DECEMBER','FJE 548 GP','FJE 560 GP STILL NEED ANOTHER SPACE FOR TRAILER 2',8,2,'2022-12-04 03:00:00','DNITA','054 5548','2022-12-03 06:22:00','LINDIE','011 565 9000',NULL,'2022-12-04 14:09:14','2022-12-15 21:01:47'),(26,43,1,36,'A',NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-12-13 01:05:46','2022-12-13 01:05:46'),(27,44,6,37,'A',NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-12-13 01:13:37','2022-12-13 01:13:37'),(28,45,1,38,'A',NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-12-15 01:20:13','2023-03-20 07:53:10'),(29,46,2,39,'A','19.12.22','1 X 40\' GP CONTAINER',25,1,'TRUCK MUST BE THERE AT 07:00 - 19.12.22',1,'150000.00','ZAR','5300.00','30 Days',1,'2.1','2.1','1.2','changes made - 19.12.22','1,2,3,4,5,6,14','drec 215 3356','Simon','Cost Lamore','AGE 541 NY GP','ACE 542 NY GP',8,2,'2022-12-19 06:22:00','KOOS',NULL,'2022-12-21 06:22:00',NULL,NULL,NULL,'2022-12-19 01:53:30','2022-12-19 02:02:58'),(30,47,1,40,'A',NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-01-09 02:39:25','2023-01-09 02:39:25'),(31,46,2,39,'C','TEST ATT','TEST 900',955,1,'TUII-FEFE',0,'444','ZAR','52.5','COD',1,'2.1','2.1','1.2','changes made - 19.12.22','1,2','drec 215 3356','Simon','Cost Lamore','AGE 541 NY GP','ACE 542 NY GP',8,2,'2022-12-19 06:22:00','KOOS 2023',NULL,'2022-12-21 06:22:00',NULL,NULL,NULL,'2023-01-16 23:39:53','2023-01-16 23:53:05'),(32,48,2,41,'A','John','coal',13,1,NULL,1,'3436643','ZAR','12000','30 Days',1,'435','345','2',NULL,'1','1','john','msc','4643346','463466',5,3,'2023-01-17 07:11:34','John Doe','6346364346','2023-01-17 07:11:34','test','9834759587439',NULL,'2023-01-17 07:09:46','2023-01-17 07:11:34'),(33,48,2,41,'B','John','coal',100,1,NULL,0,'3436643','ZAR','12000','30 Days',1,'435','345','2',NULL,'3',NULL,NULL,NULL,NULL,NULL,5,3,'2023-01-18 07:03:47',NULL,NULL,'2023-01-18 07:03:47',NULL,NULL,NULL,'2023-01-18 07:03:47','2023-01-18 07:17:24'),(34,49,2,42,'A',NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-01-18 07:17:09','2023-01-18 07:17:09'),(35,50,1,43,'A',NULL,NULL,0,0,NULL,0,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-01-18 07:44:34','2023-01-18 07:44:34'),(36,51,1,44,'A','CHANd','1 X 40\' HC CONTAINER',23,1,'NOTE - CHANGES MADE 20.01.23',1,'50000.00','ZAR','23000.00','30 Days',1,'22.3','3.2','1.62','ADDITIONAL DIMENSIONS - 20.01.23','3,4,14','FCIU 225 5460','BRAVER','MSC LEBU','BAX 363 ZM','BAX 364 ZM / BAX 365 ZM',1,2,'2023-01-20 13:23:00','LINDIE','011 565 9000','2023-01-27 13:23:00',NULL,NULL,NULL,'2023-01-20 05:20:52','2023-03-19 21:02:06'),(37,51,21,44,'B','DEFULTS TO ALL AFRICA','ALL AFRICA B ORDER',222,0,'B ORDER CREATED',0,'20000.00','ZAR','20.00','30 Days',16,'0','0','0',NULL,'4',NULL,NULL,NULL,NULL,NULL,1,2,'2023-01-20 13:23:00',NULL,NULL,'2023-01-20 05:32:56',NULL,NULL,NULL,'2023-01-20 05:32:56','2023-02-18 11:55:18'),(38,51,1,44,'C','C ORDER CREATED','C ORDER',222,0,'C ORDER CREATED',0,'20.00','ZAR','20.00','30 Days',1,'0','0','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,2,'2023-01-20 05:34:51',NULL,NULL,'2023-01-20 05:34:51',NULL,NULL,NULL,'2023-01-20 05:34:51','2023-01-26 01:50:27'),(39,52,2,45,'A','JACO','1 X 40 HC CONTAINER',25,1,'NOTE ADDED 31.01.23',1,'1000000.00','ZAR','25000.00','30 Days',19,'1.23','1.0','1.234','ADDITIONAL DIMENSIONS - 31.01.23','1,2,3,4,5,6,14','CXAI 254 6698','RODGER','LEBU','WDS 880 GP','1) WDS 881 GP 2) WDS 883 GP',1,3,'2023-01-31 13:23:00','CONTACT','TELEPHONE','2023-02-04 13:23:00','CONTACT','TELEPHONE',NULL,'2023-01-31 07:05:47','2023-01-31 07:10:56'),(40,53,27,46,'A','NEAL','CRATE',60,1,'HELLO',1,'3000000','ZAR','10000.00','30 Days',17,'0','0','0',NULL,'1,5,6',NULL,NULL,NULL,NULL,NULL,6,5,'2023-02-01 13:23:00',NULL,NULL,'2023-02-01 13:23:00',NULL,NULL,NULL,'2023-02-01 01:45:18','2023-03-19 16:50:59'),(41,54,4,47,'A','RISHAV','1 X 20\' GP CONTAINER',25,0,'NAVIS UPDATED WITH OCEAN MARINE LOGISTICS, 5 DAYS TURN IN',0,'1000000','ZAR','15070','30 Days',1,'6','2.5','2.6',NULL,'14','XXNU 123 4567',NULL,'EX MSC CATHERINE',NULL,NULL,5,3,'2023-02-02 13:23:00',NULL,NULL,'2023-02-06 13:23:00',NULL,NULL,NULL,'2023-02-01 01:45:27','2023-02-18 11:55:05'),(42,54,12,47,'B','GEORGE','CARGO EX CONTAINER',25,0,'15PKGS EX XXNU 123 4567',0,'0','ZAR','97500','30 Days',1,'12','2.5','1',NULL,'2,5,6',NULL,'TARUVINGA',NULL,'AFQ 9765','AFQ 4578',1,2,'2023-02-07 13:23:00',NULL,NULL,'2023-02-15 13:23:00',NULL,NULL,NULL,'2023-02-01 02:13:38','2023-03-19 16:30:55'),(43,55,1,48,'A','NEIL','3 X 6M CONTAINERS',23,1,'TRUCK MUST BE THERE TO LOAD 07:00 AM',1,'20000.00','ZAR','36500.00','30 Days',17,'4.32','3.20','1.20','ADDITIONAL DIMENTSIONS 06.01.2023','1,6,14,15','CSAU 256 5584','DRIVER','MSC MAGNOLIA','DDS 568 LE GP','DDS 569 LA GP',8,5,'2023-02-06 13:23:00','STEVEN',NULL,'2023-02-08 13:23:00',NULL,NULL,'DDS 570 LO GP','2023-02-06 00:06:41','2023-04-07 11:49:54'),(44,55,27,48,'B','MOHOLOLI','LOAD CONTAINERS',23,0,'LOAD 3 CONTAINERS ON LOWBED',1,'1000000.00','ZAR','5600.00','COD',20,'0','0','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,8,5,'2023-02-06 13:23:00',NULL,NULL,'2023-02-06 00:15:56',NULL,NULL,NULL,'2023-02-06 00:15:33','2023-04-07 10:56:19'),(45,56,2,49,'A','GEORGE','CARGO EX CONTAINER',24,0,'CARGO EX - KTES 548 5562, DRIVER GIFT',1,'1000000.00','ZAR','109200.00','BI MONTHLY',1,'25.23','22.1','32.3','ADDITIONAL DIMENSIONS - 16.02.2389','1,2,3,4,5,6,14,15,16','FDER 215 5684','GIFT','MOL PRESENCE','JKL 458 CR GP','JKL 459 CR GP',1,2,'2023-02-16 13:23:00','CONTACT','CONTACT','2023-02-24 13:23:00','CONTACT','+10845746009','JKL 460 CR GP','2023-02-16 03:53:12','2023-04-13 07:25:15'),(46,56,14,49,'B','PERSON','TO SHORT',11,0,'NOTE',1,'0.00','ZAR','0.00','30 Days',2,'0','0','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,5,'2023-02-16 04:04:05',NULL,NULL,'2023-02-16 04:04:05',NULL,NULL,NULL,'2023-02-16 04:04:05','2023-03-20 07:51:43');

/*Table structure for table `transporters` */

DROP TABLE IF EXISTS `transporters`;

CREATE TABLE `transporters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transporters` */

insert  into `transporters`(`id`,`account_no`,`name`,`address1`,`created_at`,`updated_at`) values (1,'AG001','AGA TRANSPORT COMPANY','GAUTENG','2022-08-04 20:38:15','2023-01-30 03:17:19'),(2,'ST001','STALPH 218 / GM TRANSPORT','DURBAN','2022-08-04 20:38:41','2023-01-30 03:16:29'),(4,'SA001','SANYATI LOGISTICS','OCEAN MARINE / DURBAN','2022-08-04 20:39:33','2023-01-30 04:12:02'),(5,'TW001','TWO BROTHERS PLANT HIRE & TRANSPORT','GAUTENG','2022-08-04 20:40:15','2023-01-30 03:17:11'),(6,'BR001','BRAINWAVE PROJECTS','QUICKFREIGHT / DURBAN','2022-08-04 20:45:19','2023-01-30 04:12:19'),(9,'MA001','MASLOG','GAUTENG','2023-01-30 03:13:45','2023-01-30 03:14:40'),(10,'TH001','THOMPSONS SABIE','SABIE','2023-01-30 03:14:30','2023-01-30 03:14:30'),(11,'IS001','ISANDLA LOGISTICS','GAUTENG','2023-01-30 03:15:01','2023-01-30 03:15:01'),(12,'EX001','EXPERT HAULIERS','OVERBORDER','2023-01-30 03:15:54','2023-01-30 03:15:54'),(13,'TR001','TRANS FREIGHT TRUCKING','DURBAN','2023-01-30 03:17:56','2023-01-30 03:17:56'),(14,'MO001','MOHOLOLI CARRIERS','GAUTENG - CRANE','2023-01-30 03:19:46','2023-01-30 03:19:46'),(15,'LU001','LUCKIN TRUCKIN T/A WIRE CONVERTORS','GAUTENG','2023-01-30 03:20:12','2023-01-30 03:20:12'),(16,'AL001','ALL AFRICA TRANSPORT','GAUTENG','2023-01-30 03:20:45','2023-01-30 03:20:45'),(17,'UM001','UMSUNDU T/A VANITO HOIST & HAUL','OVERBORDER','2023-01-30 03:21:46','2023-01-30 03:21:46'),(18,'NO001','NORTH MAIN INVESTMENTS','OVERBORDER','2023-01-30 03:22:09','2023-01-30 03:22:09'),(19,'FR001','FREEWAYS TRANSPORT','GAUTENG','2023-01-30 03:22:33','2023-01-30 03:22:33'),(20,'FR001','FRITS KROON TRANSPORT','GAUTENG','2023-01-30 03:23:08','2023-01-30 03:23:08'),(21,'DE001','DEHAAS LOWBEDS','GAUTENG','2023-01-30 03:23:26','2023-01-30 03:23:26'),(22,'SI001','SILVERTRON TRANSPORT','GAUTENG','2023-01-30 03:24:16','2023-01-30 03:24:16'),(23,'EN001','ENDURO CARRIERS','GAUTENG','2023-01-30 03:24:41','2023-01-30 03:24:41'),(24,'CT001','CTD LOGISTICS','GAUTENG','2023-01-30 03:59:57','2023-01-30 03:59:57'),(25,'CF001','CF TRANSPORT','GAUTENG','2023-01-30 04:00:13','2023-01-30 04:00:13'),(26,'HO001','HONSITE LOGISTICS','OVERBORDER','2023-01-30 04:00:45','2023-01-30 04:00:45'),(27,'VT001','VTI AFRICA','GAUTENG','2023-01-30 04:01:23','2023-01-30 04:01:23'),(28,'NE001','NEED TRANSPORT ZIM','OVERBORDER','2023-01-30 04:02:00','2023-01-30 04:02:00'),(29,'HM001','H MUNDOKO TRADING','OVERBORDER','2023-01-30 04:02:20','2023-01-30 04:02:20'),(30,'MA001','MASHAMBA LOGISTICS','OVERBORDER','2023-01-30 04:02:54','2023-01-30 04:02:54'),(31,'MI001','MILLTRANS','GAUTENG','2023-01-30 04:03:23','2023-01-30 04:03:23'),(32,'TE001','TEMBA ESCORTS','ESCORT SERVICES','2023-01-30 04:03:48','2023-01-30 04:03:48'),(33,'FR001','FRANKAN LOGISTICS','OVERBORDER','2023-01-30 04:04:16','2023-01-30 04:04:16'),(34,'MA001','MAKWANGUDZE TRUCKING','OVERBORDER','2023-01-30 04:05:21','2023-01-30 04:05:21'),(35,'WE001','WELLEX TRANSPORT','OVERBORDER','2023-01-30 04:05:53','2023-01-30 04:05:53'),(36,'SA001','SAN SHEEZ INVESTMENTS','OVERBORDER','2023-01-30 04:08:16','2023-01-30 04:08:16'),(37,'HA001','HANSE FREIGHT','GAUTENG','2023-01-30 04:09:38','2023-01-30 04:09:38'),(38,'ST001','STUNSTEEL ENTERPRISES','OVERBORDER','2023-01-30 04:10:44','2023-01-30 04:10:44'),(39,'UN001','UNIDEL CARRIERS BAKKIE','285 DEODAR STREET, POMONA, KEMPTON PARK','2023-01-30 04:26:38','2023-01-30 04:26:38'),(40,'UN001','UNIDEL CARRIERS WAREHOUSE','285 DEODAR STREET, POMONA, KEMPTON PARK','2023-01-30 04:27:07','2023-01-30 04:27:07'),(41,'SE001','SEDIBA CLEARING','DURBAN','2023-01-30 04:28:36','2023-01-30 04:28:36');

/*Table structure for table `transporters_orders` */

DROP TABLE IF EXISTS `transporters_orders`;

CREATE TABLE `transporters_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `transporter_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transporters_orders_order_id_foreign` (`order_id`),
  KEY `transporters_orders_transporter_id_foreign` (`transporter_id`),
  CONSTRAINT `transporters_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `transporters_orders_transporter_id_foreign` FOREIGN KEY (`transporter_id`) REFERENCES `transporters` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transporters_orders` */

insert  into `transporters_orders`(`id`,`order_id`,`transporter_id`,`created_at`,`updated_at`) values (32,25,1,'2022-10-09 13:27:01','2022-10-09 13:27:01'),(33,26,6,'2022-10-09 13:29:12','2022-10-09 13:29:12'),(34,27,4,'2022-10-09 13:30:38','2022-10-09 13:30:38'),(35,28,4,'2022-10-13 20:32:49','2022-10-13 20:32:49'),(36,29,1,'2022-11-10 10:18:43','2022-11-10 10:18:43'),(37,30,1,'2022-11-16 19:27:37','2022-11-16 19:27:37'),(38,31,5,'2022-11-24 13:40:16','2022-11-24 13:40:16'),(39,32,1,'2022-11-28 19:00:23','2022-11-28 19:00:23'),(40,33,2,'2022-11-29 13:08:54','2022-11-29 13:08:54'),(41,34,1,'2022-11-29 17:08:51','2022-11-29 17:08:51'),(42,35,2,'2022-12-04 14:09:14','2022-12-04 14:09:14'),(43,36,1,'2022-12-13 01:05:46','2022-12-13 01:05:46'),(44,37,6,'2022-12-13 01:13:37','2022-12-13 01:13:37'),(45,38,1,'2022-12-15 01:20:13','2022-12-15 01:20:13'),(46,39,2,'2022-12-19 01:53:30','2022-12-19 01:53:30'),(47,40,1,'2023-01-09 02:39:25','2023-01-09 02:39:25'),(48,41,2,'2023-01-17 07:09:46','2023-01-17 07:09:46'),(49,42,2,'2023-01-18 07:17:09','2023-01-18 07:17:09'),(50,43,1,'2023-01-18 07:44:34','2023-01-31 10:08:08'),(51,44,1,'2023-01-20 05:20:52','2023-01-31 09:57:01'),(52,45,2,'2023-01-31 07:05:47','2023-02-01 02:58:25'),(53,46,9,'2023-02-01 01:45:18','2023-02-15 00:38:58'),(54,47,12,'2023-02-01 01:45:27','2023-02-13 00:20:21'),(55,48,1,'2023-02-06 00:06:41','2023-02-16 10:07:07'),(56,49,2,'2023-02-16 03:53:12','2023-02-16 04:12:17');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_level_foreign` (`level`),
  CONSTRAINT `users_level_foreign` FOREIGN KEY (`level`) REFERENCES `authorities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`level`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values (3,'Administrator',1,'admin@unidel.com',NULL,'$2y$10$MJNvtqkPRuEnOkR6X7Zhj.B6n6SG5gAmMhqrLruc0QZS9wgxn7XUW','VcqG6RJpRLlKpkYyPqD65sQeOU4HqiLNrCvEemaG8DlmXxwcVwX9s2eH8pWb','2022-08-04 17:40:11','2023-04-07 15:18:38'),(4,'Lindie',2,'lindie@unidel.com',NULL,'$2y$10$Oxo3xdjPim1OM63piTjH6ud/30QRO./ytF/pcZRg/rQ3NYzgRBAWK','TzlkeEsk2a8kQF7yqaVKCJ1BO8HTiaunxA1j8CWbMnHKPvM9fC9a3JbzfgWw','2022-08-04 17:40:11','2022-08-04 17:40:11'),(9,'Rick',2,'rick@unidel.com',NULL,'$2y$10$ZBhCLrV2/POkzbU3LrTrs.o7YWEu0ZMVQFYHhQPGmCG1.ROMEQ5F2',NULL,'2022-12-13 00:59:51','2022-12-13 00:59:51'),(10,'Geno',2,'geno@unidel.com',NULL,'$2y$10$XQE36RSMq/CYNdhxS5ApdeDA2wBae5rYhgyUtEFLZzqIYSAvPxC9W',NULL,'2022-12-13 01:00:16','2022-12-13 01:00:16'),(11,'Koos',2,'koos@unidel.com',NULL,'$2y$10$0iM2WCohcbUO1MGZpe0NmuiCXBiHi4W5EDe6B/GlRRP4SOUfgiqvC',NULL,'2022-12-13 01:00:42','2022-12-13 01:00:42');

/*Table structure for table `vehicle_types` */

DROP TABLE IF EXISTS `vehicle_types`;

CREATE TABLE `vehicle_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `vehicle_types` */

insert  into `vehicle_types`(`id`,`name`,`created_at`,`updated_at`) values (1,'TRIAXLE','2022-08-07 00:10:07','2023-03-20 07:51:35'),(2,'REARAXLE','2022-08-07 00:10:07','2023-03-20 07:51:35'),(3,'FRONTAXL','2022-08-07 00:10:07','2023-03-20 07:51:35'),(4,'DRIVEAXLE','2022-08-07 00:32:07','2023-03-20 07:51:35'),(16,'8 TONNER','2022-11-29 13:04:22','2023-03-20 07:51:35'),(17,'LOWBED','2022-11-29 13:29:44','2023-03-20 07:51:35'),(19,'1 TONNER','2023-01-31 07:07:06','2023-03-20 07:51:35'),(20,'CRANE TRUCK','2023-02-06 00:14:45','2023-03-20 07:51:35');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
