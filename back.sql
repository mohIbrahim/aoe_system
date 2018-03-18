-- MySQL dump 10.16  Distrib 10.1.24-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: aoe_system
-- ------------------------------------------------------
-- Server version	10.1.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contract_printing_machine`
--

DROP TABLE IF EXISTS `contract_printing_machine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contract_printing_machine` (
  `contract_id` int(10) unsigned NOT NULL,
  `p_machine_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`contract_id`,`p_machine_id`),
  KEY `contract_printing_machine_contract_id_index` (`contract_id`),
  KEY `contract_printing_machine_p_machine_id_index` (`p_machine_id`),
  CONSTRAINT `contract_printing_machine_contract_id_foreign` FOREIGN KEY (`contract_id`) REFERENCES `contracts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `contract_printing_machine_p_machine_id_foreign` FOREIGN KEY (`p_machine_id`) REFERENCES `printing_machines` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract_printing_machine`
--

LOCK TABLES `contract_printing_machine` WRITE;
/*!40000 ALTER TABLE `contract_printing_machine` DISABLE KEYS */;
INSERT INTO `contract_printing_machine` VALUES (1,1),(14,1);
/*!40000 ALTER TABLE `contract_printing_machine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contracts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(12,2) DEFAULT '0.00',
  `tax` smallint(6) DEFAULT '0',
  `total_price` double(12,2) DEFAULT '0.00',
  `payment_system` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `employee_id_who_edits_the_contract` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contracts_employee_id_who_edits_the_contract_foreign` (`employee_id_who_edits_the_contract`),
  CONSTRAINT `contracts_employee_id_who_edits_the_contract_foreign` FOREIGN KEY (`employee_id_who_edits_the_contract`) REFERENCES `employees` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts`
--

LOCK TABLES `contracts` WRITE;
/*!40000 ALTER TABLE `contracts` DISABLE KEYS */;
INSERT INTO `contracts` VALUES (1,'543','ضمان','2018-03-15 00:00:00','2019-03-15 00:00:00','ساري',1000.00,10,1010.00,'ربع سنوي',NULL,'2018-03-11 06:51:11','2018-03-15 12:58:28',1),(14,'1212','صيانة شاملة قطع الغيار','2018-03-18 00:00:00','2019-03-18 00:00:00','ساري',1000.00,10,1100.00,'نصف سنوي',NULL,'2018-03-18 13:18:58','2018-03-18 13:18:58',NULL);
/*!40000 ALTER TABLE `contracts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsible_person_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsible_person_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsible_person_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `governorate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `administration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `accounts_dep_emp_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accounts_dep_emp_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accounts_dep_emp_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `main_branch_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_main_branch_id_foreign` (`main_branch_id`),
  CONSTRAINT `customers_main_branch_id_foreign` FOREIGN KEY (`main_branch_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'83','مكتبة المنار','شركات','al_manar_bookshop@gmial.com','http://www.almanarbookshop.com','ياسر محمد','01238848938','yasser_mohamed@gmail.com','17 ش مراد الشريعى، متفرع من احمد امين، ميدان سانت فاتيما','سانت فاتيما','مصر الجديدة','القاهرة','القاهرة','لايوجد','مصر الجديدة','لا يوجد حتى الآن','خالد حمدي','010377378837','khaled_hamdy@gmial.com','2018-03-11 05:45:14','2018-03-11 05:45:14',NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'السكرترية',NULL,'2018-03-11 05:55:23','2018-03-11 05:55:23'),(2,'الأعمال الفنية',NULL,'2018-03-11 05:55:47','2018-03-11 05:55:47'),(3,'الحسابات',NULL,'2018-03-11 05:56:01','2018-03-11 05:56:01');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_mach_assignments`
--

DROP TABLE IF EXISTS `emp_mach_assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_mach_assignments` (
  `employee_id` int(10) unsigned NOT NULL,
  `printing_machine_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`employee_id`,`printing_machine_id`),
  KEY `emp_mach_assignments_employee_id_index` (`employee_id`),
  KEY `emp_mach_assignments_printing_machine_id_index` (`printing_machine_id`),
  CONSTRAINT `emp_mach_assignments_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `emp_mach_assignments_printing_machine_id_foreign` FOREIGN KEY (`printing_machine_id`) REFERENCES `printing_machines` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_mach_assignments`
--

LOCK TABLES `emp_mach_assignments` WRITE;
/*!40000 ALTER TABLE `emp_mach_assignments` DISABLE KEYS */;
/*!40000 ALTER TABLE `emp_mach_assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_hiring` datetime DEFAULT NULL,
  `salary` double(10,2) DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `managed_department_id` int(10) unsigned DEFAULT NULL,
  `department_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employees_user_id_foreign` (`user_id`),
  KEY `employees_managed_department_id_foreign` (`managed_department_id`),
  KEY `employees_department_id_foreign` (`department_id`),
  CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employees_managed_department_id_foreign` FOREIGN KEY (`managed_department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'88765','مهندس صيانة','2010-07-06 00:00:00',1000.00,NULL,'2018-03-11 06:00:19','2018-03-11 06:00:19',3,NULL,2);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `follow_up_card_special_reports`
--

DROP TABLE IF EXISTS `follow_up_card_special_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `follow_up_card_special_reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `the_date` datetime DEFAULT NULL,
  `readings_of_printing_machine` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `indexation_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `the_payment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report` text COLLATE utf8mb4_unicode_ci,
  `auditor_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `follow_up_card_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `follow_up_card_special_reports_follow_up_card_id_foreign` (`follow_up_card_id`),
  CONSTRAINT `follow_up_card_special_reports_follow_up_card_id_foreign` FOREIGN KEY (`follow_up_card_id`) REFERENCES `follow_up_cards` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follow_up_card_special_reports`
--

LOCK TABLES `follow_up_card_special_reports` WRITE;
/*!40000 ALTER TABLE `follow_up_card_special_reports` DISABLE KEYS */;
INSERT INTO `follow_up_card_special_reports` VALUES (1,'2018-03-11 00:00:00','8388223','1001','10134','20000','Curabitur non nulla sit amet nisl tempus convallis quis ac lectus.','علي كمال',NULL,'2018-03-11 06:55:48','2018-03-11 06:55:48',1);
/*!40000 ALTER TABLE `follow_up_card_special_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `follow_up_cards`
--

DROP TABLE IF EXISTS `follow_up_cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `follow_up_cards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `contract_id` int(10) unsigned DEFAULT NULL,
  `printing_machine_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `follow_up_cards_contract_id_foreign` (`contract_id`),
  KEY `follow_up_cards_printing_machine_id_foreign` (`printing_machine_id`),
  CONSTRAINT `follow_up_cards_contract_id_foreign` FOREIGN KEY (`contract_id`) REFERENCES `contracts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `follow_up_cards_printing_machine_id_foreign` FOREIGN KEY (`printing_machine_id`) REFERENCES `printing_machines` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follow_up_cards`
--

LOCK TABLES `follow_up_cards` WRITE;
/*!40000 ALTER TABLE `follow_up_cards` DISABLE KEYS */;
INSERT INTO `follow_up_cards` VALUES (1,'20938',NULL,'2018-03-11 06:53:30','2018-03-11 06:53:30',1,1);
/*!40000 ALTER TABLE `follow_up_cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `i_r_other_items`
--

DROP TABLE IF EXISTS `i_r_other_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `i_r_other_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `installation_record_id` int(10) unsigned DEFAULT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i_r_other_items_installation_record_id_foreign` (`installation_record_id`),
  CONSTRAINT `i_r_other_items_installation_record_id_foreign` FOREIGN KEY (`installation_record_id`) REFERENCES `installation_records` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `i_r_other_items`
--

LOCK TABLES `i_r_other_items` WRITE;
/*!40000 ALTER TABLE `i_r_other_items` DISABLE KEYS */;
INSERT INTO `i_r_other_items` VALUES (1,1,'العنصر','تعريف العنصر','2018-03-11 06:52:47','2018-03-11 06:52:47');
/*!40000 ALTER TABLE `i_r_other_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indexation_part`
--

DROP TABLE IF EXISTS `indexation_part`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `indexation_part` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `indexation_id` int(10) unsigned NOT NULL,
  `part_id` int(10) unsigned NOT NULL,
  `price` double(10,2) DEFAULT NULL,
  `serial_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_parts` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indexation_part_indexation_id_index` (`indexation_id`),
  KEY `indexation_part_part_id_index` (`part_id`),
  CONSTRAINT `indexation_part_indexation_id_foreign` FOREIGN KEY (`indexation_id`) REFERENCES `indexations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `indexation_part_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indexation_part`
--

LOCK TABLES `indexation_part` WRITE;
/*!40000 ALTER TABLE `indexation_part` DISABLE KEYS */;
INSERT INTO `indexation_part` VALUES (1,1,1,220.00,'209488298',1,'2018-03-11 07:10:36','2018-03-11 07:10:36'),(2,1,2,230.00,'238998289',1,'2018-03-11 07:10:37','2018-03-11 07:10:37');
/*!40000 ALTER TABLE `indexation_part` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indexations`
--

DROP TABLE IF EXISTS `indexations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `indexations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `the_date` datetime DEFAULT NULL,
  `customer_approval` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `technical_manager_approval` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_approval` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `visit_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indexations_visit_id_foreign` (`visit_id`),
  CONSTRAINT `indexations_visit_id_foreign` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indexations`
--

LOCK TABLES `indexations` WRITE;
/*!40000 ALTER TABLE `indexations` DISABLE KEYS */;
INSERT INTO `indexations` VALUES (1,'332','2018-03-11 00:00:00','ليس بعد','ليس بعد','ليس بعد',NULL,'2018-03-11 07:08:33','2018-03-11 07:08:33',1);
/*!40000 ALTER TABLE `indexations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `installation_records`
--

DROP TABLE IF EXISTS `installation_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `installation_records` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trainee_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipient_of_the_printing_machine` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installation_date` datetime DEFAULT NULL,
  `feeder_model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feeder_serial_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feeder_product_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finisher_model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finisher_serial_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finisher_product_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hard_disk_model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hard_disk_serial_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hard_disk_product_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paper_drawer_model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paper_drawer_serial_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paper_drawer_product_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `network_scanner_model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `network_scanner_serial_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `network_scanner_product_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `printing_machine_id` int(10) unsigned DEFAULT NULL,
  `employee_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `installation_records_printing_machine_id_foreign` (`printing_machine_id`),
  KEY `installation_records_employee_id_foreign` (`employee_id`),
  CONSTRAINT `installation_records_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL,
  CONSTRAINT `installation_records_printing_machine_id_foreign` FOREIGN KEY (`printing_machine_id`) REFERENCES `printing_machines` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `installation_records`
--

LOCK TABLES `installation_records` WRITE;
/*!40000 ALTER TABLE `installation_records` DISABLE KEYS */;
INSERT INTO `installation_records` VALUES (1,'يوسف سعد','تامر عبدالله','2018-03-11 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-03-11 06:52:47','2018-03-11 06:52:47',1,1);
/*!40000 ALTER TABLE `installation_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` int(11) DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` int(11) DEFAULT NULL,
  `delivery_permission_number` int(11) DEFAULT NULL,
  `finance_check_out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'لم يتم الاطلاع',
  `release_date` datetime DEFAULT NULL,
  `descriptions` text COLLATE utf8mb4_unicode_ci,
  `total` double(10,2) DEFAULT '0.00',
  `comments` text COLLATE utf8mb4_unicode_ci,
  `collect_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collector_employee_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `indexation_id` int(10) unsigned DEFAULT NULL,
  `contract_id` int(10) unsigned DEFAULT NULL,
  `customer_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_indexation_id_foreign` (`indexation_id`),
  KEY `invoices_customer_id_foreign` (`customer_id`),
  KEY `invoices_contract_id_foreignkey` (`contract_id`),
  CONSTRAINT `invoices_contract_id_foreignkey` FOREIGN KEY (`contract_id`) REFERENCES `contracts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `invoices_indexation_id_foreign` FOREIGN KEY (`indexation_id`) REFERENCES `indexations` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (1,89239,'مقايسة','الأقسام الفنية',23443,23887,'لم يتم الاطلاع','2018-03-11 00:00:00',NULL,450.00,NULL,'2018-03-11 00:00:00',NULL,'2018-03-11 07:13:08','2018-03-11 07:13:08',1,NULL,1),(2,454455,'تعاقد','الأقسام الفنية',NULL,NULL,'لم يتم الاطلاع','2018-03-13 00:00:00',NULL,1000.00,NULL,'2018-03-13 00:00:00',NULL,'2018-03-13 10:13:09','2018-03-13 10:13:09',NULL,1,1),(3,99099,'تعاقد','الأقسام الفنية',NULL,NULL,'لم يتم الاطلاع','2018-03-13 00:00:00',NULL,200000.00,NULL,NULL,NULL,'2018-03-13 13:10:26','2018-03-13 13:10:26',NULL,1,1),(16,NULL,'تعاقد',NULL,NULL,NULL,'لم يتم الاطلاع','2018-03-18 00:00:00',NULL,550.00,NULL,NULL,NULL,'2018-03-18 13:18:58','2018-03-18 13:18:58',NULL,14,1),(17,NULL,'تعاقد',NULL,NULL,NULL,'لم يتم الاطلاع','2018-09-18 00:00:00',NULL,550.00,NULL,NULL,NULL,'2018-03-18 13:18:58','2018-03-18 13:18:58',NULL,14,1);
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_02_21_101702_roles_table',1),(4,'2016_02_21_101909_permissions_table',1),(5,'2016_02_21_101955_permission_role_table',1),(6,'2016_03_14_180854_create_role_user_table',1),(7,'2017_11_21_165804_create_project_images_table',1),(8,'2018_01_01_050000_create_customers_table',1),(9,'2018_01_01_050231_create_printing_machines_table',1),(10,'2018_01_06_070132_create_telecoms_table',1),(11,'2018_01_07_070529_create_departments_table',1),(12,'2018_01_07_071048_create_employees_table',1),(13,'2018_01_10_160655_create_parts_table',1),(14,'2018_01_12_092814_create_part_serial_numbers_table',1),(15,'2018_01_12_141244_create_contracts_table',1),(16,'2018_01_13_153802_create_installation_records_table',1),(17,'2018_01_18_171121_create_follow_up_cards_table',1),(18,'2018_01_18_171122_create_follow_up_card_special_reports_table',1),(19,'2018_01_18_185553_create_references_table',1),(20,'2018_01_18_185559_create_visits_table',1),(21,'2018_01_19_174146_create_reading_of_printing_machines_table',1),(22,'2018_01_21_074737_create_indexations_table',1),(23,'2018_01_22_112918_create_invoices_table',1),(24,'2018_02_13_093253_create_employee_printing_machine_pivot_table',1),(25,'2018_02_15_054057_create_indexation_part_pivot_table',1),(26,'2018_02_27_062633_create_contracts_printing_machines_pivot_table',1),(27,'2018_03_01_131331_creat_notes_on_contracting_table',1),(28,'2018_03_07_102910_create_installation_record_other_items_table',1),(29,'2018_03_10_061751_create_reference_malfunctions_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes_on_contracting`
--

DROP TABLE IF EXISTS `notes_on_contracting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes_on_contracting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contract_id` int(10) unsigned NOT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notes_on_contracting_contract_id_foreign` (`contract_id`),
  CONSTRAINT `notes_on_contracting_contract_id_foreign` FOREIGN KEY (`contract_id`) REFERENCES `contracts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes_on_contracting`
--

LOCK TABLES `notes_on_contracting` WRITE;
/*!40000 ALTER TABLE `notes_on_contracting` DISABLE KEYS */;
/*!40000 ALTER TABLE `notes_on_contracting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `part_serial_numbers`
--

DROP TABLE IF EXISTS `part_serial_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `part_serial_numbers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `part_id` int(10) unsigned NOT NULL,
  `serial_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availability` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'متوفرة',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'جديدة',
  `date_of_entry` datetime DEFAULT NULL,
  `date_of_departure` datetime DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `part_serial_numbers_part_id_foreign` (`part_id`),
  CONSTRAINT `part_serial_numbers_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `part_serial_numbers`
--

LOCK TABLES `part_serial_numbers` WRITE;
/*!40000 ALTER TABLE `part_serial_numbers` DISABLE KEYS */;
/*!40000 ALTER TABLE `part_serial_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parts`
--

DROP TABLE IF EXISTS `parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_without_tax` double(8,2) DEFAULT '0.00',
  `price_with_tax` double(8,2) DEFAULT '0.00',
  `life` int(11) DEFAULT '0',
  `qty` int(11) DEFAULT '0',
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts`
--

LOCK TABLES `parts` WRITE;
/*!40000 ALTER TABLE `parts` DISABLE KEYS */;
INSERT INTO `parts` VALUES (1,'838872','Genuine DRUM','قطعة غيار','82727','2387672376',200.00,220.00,2000,0,NULL,'2018-03-11 07:09:18','2018-03-11 07:09:18'),(2,'8668238','FUSING UNIT','مستهلكات','892399823','2378823',210.00,230.00,10000,0,NULL,'2018-03-11 07:10:12','2018-03-11 07:10:12');
/*!40000 ALTER TABLE `parts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1,'2018-03-11 05:36:53','2018-03-11 05:36:53'),(2,1,'2018-03-11 05:36:53','2018-03-11 05:36:53'),(3,1,'2018-03-11 05:36:53','2018-03-11 05:36:53'),(4,1,'2018-03-11 05:36:53','2018-03-11 05:36:53'),(5,1,'2018-03-11 05:36:53','2018-03-11 05:36:53'),(6,1,'2018-03-11 05:36:53','2018-03-11 05:36:53'),(7,1,'2018-03-11 05:36:53','2018-03-11 05:36:53'),(8,1,'2018-03-11 05:36:53','2018-03-11 05:36:53'),(9,1,'2018-03-11 05:36:53','2018-03-11 05:36:53'),(10,1,'2018-03-11 05:36:53','2018-03-11 05:36:53'),(11,1,'2018-03-11 05:36:53','2018-03-11 05:36:53'),(12,1,'2018-03-11 05:36:53','2018-03-11 05:36:53'),(13,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(14,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(15,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(16,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(17,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(18,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(19,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(20,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(21,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(22,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(23,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(24,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(25,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(26,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(27,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(28,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(29,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(30,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(31,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(32,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(33,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(34,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(35,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(36,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(37,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(38,1,'2018-03-11 05:36:54','2018-03-11 05:36:54'),(39,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(40,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(41,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(42,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(43,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(44,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(45,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(46,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(47,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(48,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(49,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(50,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(51,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(52,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(53,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(54,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(55,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(56,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(58,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(60,1,'2018-03-11 05:36:55','2018-03-11 05:36:55'),(61,1,'2018-03-11 05:36:56','2018-03-11 05:36:56'),(62,1,'2018-03-11 05:36:56','2018-03-11 05:36:56'),(63,1,'2018-03-11 05:36:56','2018-03-11 05:36:56'),(64,1,'2018-03-11 05:36:56','2018-03-11 05:36:56'),(65,1,'2018-03-11 05:36:56','2018-03-11 05:36:56'),(66,1,'2018-03-11 05:36:56','2018-03-11 05:36:56'),(67,1,'2018-03-11 05:36:56','2018-03-11 05:36:56'),(68,1,'2018-03-11 05:36:56','2018-03-11 05:36:56'),(69,1,'2018-03-11 05:36:56','2018-03-11 05:36:56'),(59,1,'2018-03-12 11:40:25','2018-03-12 11:40:25'),(57,1,'2018-03-13 09:42:59','2018-03-13 09:42:59');
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'view_permissions','permissions','2018-03-11 05:36:41',NULL),(2,'create_permissions','permissions','2018-03-11 05:36:41',NULL),(3,'update_permissions','permissions','2018-03-11 05:36:41',NULL),(4,'delete_permissions','permissions','2018-03-11 05:36:41',NULL),(5,'view_users','users','2018-03-11 05:36:41',NULL),(6,'create_users','users','2018-03-11 05:36:41',NULL),(7,'update_users','users','2018-03-11 05:36:41',NULL),(8,'delete_users','users','2018-03-11 05:36:41',NULL),(9,'view_roles','roles','2018-03-11 05:36:41',NULL),(10,'create_roles','roles','2018-03-11 05:36:41',NULL),(11,'update_roles','roles','2018-03-11 05:36:41',NULL),(12,'delete_roles','roles','2018-03-11 05:36:41',NULL),(13,'view_printing_machines','printing_machines','2018-03-11 05:36:41',NULL),(14,'create_printing_machines','printing_machines','2018-03-11 05:36:41',NULL),(15,'update_printing_machines','printing_machines','2018-03-11 05:36:41',NULL),(16,'delete_printing_machines','printing_machines','2018-03-11 05:36:41',NULL),(17,'view_customers','customers','2018-03-11 05:36:42',NULL),(18,'create_customers','customers','2018-03-11 05:36:42',NULL),(19,'update_customers','customers','2018-03-11 05:36:42',NULL),(20,'delete_customers','customers','2018-03-11 05:36:42',NULL),(21,'view_departments','departments','2018-03-11 05:36:42',NULL),(22,'create_departments','departments','2018-03-11 05:36:42',NULL),(23,'update_departments','departments','2018-03-11 05:36:42',NULL),(24,'delete_departments','departments','2018-03-11 05:36:42',NULL),(25,'view_parts','parts','2018-03-11 05:36:42',NULL),(26,'create_parts','parts','2018-03-11 05:36:42',NULL),(27,'update_parts','parts','2018-03-11 05:36:42',NULL),(28,'delete_parts','parts','2018-03-11 05:36:42',NULL),(29,'view_part_serial_numbers','part_serial_numbers','2018-03-11 05:36:42',NULL),(30,'create_part_serial_numbers','part_serial_numbers','2018-03-11 05:36:42',NULL),(31,'update_part_serial_numbers','part_serial_numbers','2018-03-11 05:36:42',NULL),(32,'delete_part_serial_numbers','part_serial_numbers','2018-03-11 05:36:42',NULL),(33,'view_installation_records','installation_records','2018-03-11 05:36:42',NULL),(34,'create_installation_records','installation_records','2018-03-11 05:36:42',NULL),(35,'update_installation_records','installation_records','2018-03-11 05:36:42',NULL),(36,'delete_installation_records','installation_records','2018-03-11 05:36:42',NULL),(37,'view_contracts','contracts','2018-03-11 05:36:42',NULL),(38,'create_contracts','contracts','2018-03-11 05:36:42',NULL),(39,'update_contracts','contracts','2018-03-11 05:36:42',NULL),(40,'delete_contracts','contracts','2018-03-11 05:36:42',NULL),(41,'view_invoices','invoices','2018-03-11 05:36:42',NULL),(42,'create_invoices','invoices','2018-03-11 05:36:42',NULL),(43,'update_invoices','invoices','2018-03-11 05:36:42',NULL),(44,'delete_invoices','invoices','2018-03-11 05:36:42',NULL),(45,'view_visits','visits','2018-03-11 05:36:43',NULL),(46,'create_visits','visits','2018-03-11 05:36:43',NULL),(47,'update_visits','visits','2018-03-11 05:36:43',NULL),(48,'delete_visits','visits','2018-03-11 05:36:43',NULL),(49,'view_follow_up_cards','follow_up_cards','2018-03-11 05:36:43',NULL),(50,'create_follow_up_cards','follow_up_cards','2018-03-11 05:36:43',NULL),(51,'update_follow_up_cards','follow_up_cards','2018-03-11 05:36:43',NULL),(52,'delete_follow_up_cards','follow_up_cards','2018-03-11 05:36:43',NULL),(53,'view_follow_up_card_special_reports','follow_up_card_special_reports','2018-03-11 05:36:43',NULL),(54,'create_follow_up_card_special_reports','follow_up_card_special_reports','2018-03-11 05:36:43',NULL),(55,'update_follow_up_card_special_reports','follow_up_card_special_reports','2018-03-11 05:36:43',NULL),(56,'delete_follow_up_card_special_reports','follow_up_card_special_reports','2018-03-11 05:36:43',NULL),(57,'view_references','references','2018-03-11 05:36:43',NULL),(58,'create_references','references','2018-03-11 05:36:43',NULL),(59,'update_references','references','2018-03-11 05:36:43',NULL),(60,'delete_references','references','2018-03-11 05:36:43',NULL),(61,'view_indexations','indexations','2018-03-11 05:36:43',NULL),(62,'create_indexations','indexations','2018-03-11 05:36:43',NULL),(63,'update_indexations','indexations','2018-03-11 05:36:43',NULL),(64,'delete_indexations','indexations','2018-03-11 05:36:43',NULL),(65,'view_employees','employees','2018-03-11 05:36:43',NULL),(66,'create_employees','employees','2018-03-11 05:36:43',NULL),(67,'update_employees','employees','2018-03-11 05:36:43',NULL),(68,'delete_employees','employees','2018-03-11 05:36:43',NULL),(69,'finance','finance','2018-03-11 05:36:43',NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `printing_machines`
--

DROP TABLE IF EXISTS `printing_machines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `printing_machines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `folder_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `the_manufacture_company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_prefix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_suffix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manufacturing_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price_without_tax` double(10,2) DEFAULT '0.00',
  `price_with_tax` double(10,2) DEFAULT '0.00',
  `is_sold_by_aoe` tinyint(1) DEFAULT '0',
  `employee_delivered_the_machine` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `printing_machines_customer_id_foreign` (`customer_id`),
  CONSTRAINT `printing_machines_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `printing_machines`
--

LOCK TABLES `printing_machines` WRITE;
/*!40000 ALTER TABLE `printing_machines` DISABLE KEYS */;
INSERT INTO `printing_machines` VALUES (1,'389927-je938','8737','فعالة','شارب','MX','2010U','02883799237327','23791239293','2008','طباعة بالألوان ذات جودة عالية من خلال ترقية الميكروستونر ٢٠ ورقة بالدقيق، شاشة 7 بوصة تعمل باللمس آل-سي-دي، وظائف لتحرير الصور: تكبير لصفحات متعددة - تكرار للصور - عاكس للصور - تكبير ثنائى الاتجاه، طباعة من الشبكة ماسح ضوئى ملون من خلال الشبكة لأوراق مقاس A3، نظام للمستخدمين يستوعب (1000 مستخدم)',5000.00,5100.00,1,'محمود إسماعيل',NULL,'2018-03-11 05:48:20','2018-03-11 06:02:03',1);
/*!40000 ALTER TABLE `printing_machines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_images`
--

DROP TABLE IF EXISTS `project_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imageable_id` int(11) NOT NULL,
  `imageable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_images`
--

LOCK TABLES `project_images` WRITE;
/*!40000 ALTER TABLE `project_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reading_of_printing_machines`
--

DROP TABLE IF EXISTS `reading_of_printing_machines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reading_of_printing_machines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reading_date` datetime DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `visit_id` int(10) unsigned DEFAULT NULL,
  `printing_machine_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reading_of_printing_machines_visit_id_foreign` (`visit_id`),
  KEY `reading_of_printing_machines_printing_machine_id_foreign` (`printing_machine_id`),
  CONSTRAINT `reading_of_printing_machines_printing_machine_id_foreign` FOREIGN KEY (`printing_machine_id`) REFERENCES `printing_machines` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reading_of_printing_machines_visit_id_foreign` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reading_of_printing_machines`
--

LOCK TABLES `reading_of_printing_machines` WRITE;
/*!40000 ALTER TABLE `reading_of_printing_machines` DISABLE KEYS */;
INSERT INTO `reading_of_printing_machines` VALUES (1,'3778322323','2018-03-11 00:00:00',NULL,'2018-03-11 06:54:17','2018-03-13 06:18:49',1,1);
/*!40000 ALTER TABLE `reading_of_printing_machines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reference_malfunctions`
--

DROP TABLE IF EXISTS `reference_malfunctions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reference_malfunctions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `malfunction_type` text COLLATE utf8mb4_unicode_ci,
  `works_were_done` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reference_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reference_malfunctions_reference_id_foreign` (`reference_id`),
  CONSTRAINT `reference_malfunctions_reference_id_foreign` FOREIGN KEY (`reference_id`) REFERENCES `references` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reference_malfunctions`
--

LOCK TABLES `reference_malfunctions` WRITE;
/*!40000 ALTER TABLE `reference_malfunctions` DISABLE KEYS */;
INSERT INTO `reference_malfunctions` VALUES (20,'نوع العطل','الأعمال التي تم تنفيذها','2018-03-13 07:34:28','2018-03-13 07:34:28',1);
/*!40000 ALTER TABLE `reference_malfunctions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `references`
--

DROP TABLE IF EXISTS `references`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `references` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notebook_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received_date` datetime DEFAULT NULL,
  `readings_of_printing_machine` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `employee_id` int(10) unsigned DEFAULT NULL,
  `employee_id_who_receive_the_reference` int(10) unsigned DEFAULT NULL,
  `printing_machine_id` int(10) unsigned DEFAULT NULL,
  `closing_date` datetime DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `references_employee_id_foreign` (`employee_id`),
  KEY `references_employee_id_who_receive_the_reference_foreign` (`employee_id_who_receive_the_reference`),
  KEY `references_printing_machine_id_foreign` (`printing_machine_id`),
  CONSTRAINT `references_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL,
  CONSTRAINT `references_employee_id_who_receive_the_reference_foreign` FOREIGN KEY (`employee_id_who_receive_the_reference`) REFERENCES `employees` (`id`) ON DELETE SET NULL,
  CONSTRAINT `references_printing_machine_id_foreign` FOREIGN KEY (`printing_machine_id`) REFERENCES `printing_machines` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `references`
--

LOCK TABLES `references` WRITE;
/*!40000 ALTER TABLE `references` DISABLE KEYS */;
INSERT INTO `references` VALUES (1,'726723','728','ضمان','2018-03-13 00:00:00','3889239',NULL,'2018-03-11 06:57:00','2018-03-13 07:34:28',1,1,1,'2018-03-12 13:40:31','مفتوحة');
/*!40000 ALTER TABLE `references` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `role_user_role_id_foreign` (`role_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,'2018-03-11 05:36:53','2018-03-11 05:36:53'),(1,2,'2018-03-11 05:36:53','2018-03-11 05:36:53');
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Developer','2018-03-11 05:36:53','2018-03-11 05:36:53');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telecoms`
--

DROP TABLE IF EXISTS `telecoms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telecoms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `telecomable_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telecomable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telecoms`
--

LOCK TABLES `telecoms` WRITE;
/*!40000 ALTER TABLE `telecoms` DISABLE KEYS */;
INSERT INTO `telecoms` VALUES (1,'1','App\\Customer','01282266882',NULL,'2018-03-11 05:45:14','2018-03-11 05:45:14'),(2,'1','App\\Customer','01082346282',NULL,'2018-03-11 05:45:15','2018-03-11 05:45:15');
/*!40000 ALTER TABLE `telecoms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mohammed Ibrahim Fawzy','mohibrahimqop@gmail.com','$2y$10$Z/5mSqlBebgasIA7rAY8ceBGSoXflp7l8T2gsc38XNm//w/EbsSqm',NULL,'2018-03-11 05:36:53','2018-03-11 05:36:53'),(2,'John Sameh','j.sameh@infomed-me.com','$2y$10$tbJQFSnd8tkj1tbX4mW0u.UlJtK2mWz4padT9Oxc9X7WwSZ6U4lmi',NULL,'2018-03-11 05:36:53','2018-03-11 05:36:53'),(3,'محمود إسماعيل','m.ismail@gmial.com','$2y$10$IMHRmNdbgD.dz6vBSW3zzO3H.6drxYJN1441iGRxoILkmCAFn.hkq',NULL,'2018-03-11 05:58:54','2018-03-11 05:58:54');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visits`
--

DROP TABLE IF EXISTS `visits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visit_date` datetime NOT NULL,
  `representative_customer_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `readings_of_printing_machine` bigint(20) DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `printing_machine_id` int(10) unsigned NOT NULL,
  `follow_up_card_id` int(10) unsigned DEFAULT NULL,
  `the_employee_who_made_the_visit_id` int(10) unsigned DEFAULT NULL,
  `reference_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `visits_printing_machine_id_foreign` (`printing_machine_id`),
  KEY `visits_follow_up_card_id_foreign` (`follow_up_card_id`),
  KEY `visits_the_employee_who_made_the_visit_id_foreign` (`the_employee_who_made_the_visit_id`),
  KEY `visits_reference_id_foreign` (`reference_id`),
  CONSTRAINT `visits_follow_up_card_id_foreign` FOREIGN KEY (`follow_up_card_id`) REFERENCES `follow_up_cards` (`id`) ON DELETE SET NULL,
  CONSTRAINT `visits_printing_machine_id_foreign` FOREIGN KEY (`printing_machine_id`) REFERENCES `printing_machines` (`id`) ON DELETE CASCADE,
  CONSTRAINT `visits_reference_id_foreign` FOREIGN KEY (`reference_id`) REFERENCES `references` (`id`) ON DELETE SET NULL,
  CONSTRAINT `visits_the_employee_who_made_the_visit_id_foreign` FOREIGN KEY (`the_employee_who_made_the_visit_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visits`
--

LOCK TABLES `visits` WRITE;
/*!40000 ALTER TABLE `visits` DISABLE KEYS */;
INSERT INTO `visits` VALUES (1,'بطاقة المتابعة','2018-03-11 00:00:00','محمد حسن',3778322323,NULL,'2018-03-11 06:54:17','2018-03-13 06:18:49',1,1,1,NULL);
/*!40000 ALTER TABLE `visits` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-18 15:43:54
