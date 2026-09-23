/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.2.2-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: secondbymephone
-- ------------------------------------------------------
-- Server version	12.2.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Current Database: `secondbymephone`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `secondbymephone` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;

USE `secondbymephone`;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES
('secondbymephone-cache-7980917d1dc036183d39706691f46509','i:1;',1784392045),
('secondbymephone-cache-7980917d1dc036183d39706691f46509:timer','i:1784392045;',1784392045),
('secondbymephone-cache-f6b7865616313234b8158b4b18390c02','i:1;',1784567330),
('secondbymephone-cache-f6b7865616313234b8158b4b18390c02:timer','i:1784567330;',1784567330);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2026_07_16_000001_create_products_table',2),
(5,'2026_07_16_000002_create_product_images_table',3),
(6,'2026_07_16_000003_add_product_options_to_products_table',4),
(7,'2026_07_16_000004_create_product_variants_table',5),
(8,'2026_07_17_000005_create_preorders_table',6),
(9,'2026_07_17_000006_sync_product_summaries_from_variants',7),
(10,'2026_07_21_000007_localize_product_images',8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `preorders`
--

DROP TABLE IF EXISTS `preorders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `preorders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `whatsapp` varchar(30) NOT NULL,
  `phone_series` varchar(150) NOT NULL,
  `storage` varchar(50) NOT NULL,
  `color` varchar(80) NOT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'baru',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `preorders_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preorders`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `preorders` WRITE;
/*!40000 ALTER TABLE `preorders` DISABLE KEYS */;
/*!40000 ALTER TABLE `preorders` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `url` text NOT NULL,
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `product_variants`
--

DROP TABLE IF EXISTS `product_variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_variants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `storage` varchar(30) NOT NULL,
  `color` varchar(60) NOT NULL,
  `price` bigint(20) unsigned NOT NULL,
  `stock` int(10) unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_variants_product_id_storage_color_unique` (`product_id`,`storage`,`color`),
  CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_variants`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `product_variants` WRITE;
/*!40000 ALTER TABLE `product_variants` DISABLE KEYS */;
INSERT INTO `product_variants` VALUES
(1,1,'64GB','Space Gray',2850000,3,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(2,2,'64GB','Coral',3250000,4,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(3,3,'64GB','Gold',3550000,2,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(6,6,'128GB','Midnight',7850000,4,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(7,7,'256GB','Sierra Blue',10250000,2,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(8,8,'128GB','Red',10850000,2,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(10,10,'256GB','Gold',4650000,2,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(12,12,'256GB','Space Gray',6850000,2,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(13,13,'128GB','Blue',5250000,2,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(14,14,'128GB','Pacific Blue',7350000,3,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(15,15,'256GB','Pacific Blue',8650000,2,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(16,16,'128GB','Pink',6850000,2,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(17,17,'256GB','Sierra Blue',11450000,3,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(18,18,'128GB','Blue',11950000,2,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(19,19,'256GB','Deep Purple',14350000,2,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(20,20,'256GB','Deep Purple',15750000,2,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(21,21,'128GB','Blue',14250000,2,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(22,22,'256GB','Natural Titanium',17250000,2,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(23,23,'256GB','Natural Titanium',19450000,2,1,'2026-07-16 09:44:41','2026-07-16 09:44:41'),
(28,4,'64GB','Purple',4250000,5,1,'2026-07-17 00:02:47','2026-07-17 00:02:47'),
(29,4,'128GB','Blue',5200000,2,1,'2026-07-17 00:02:47','2026-07-17 00:02:47'),
(42,11,'64GB','Natural Titanium',5450000,3,1,'2026-07-17 01:11:31','2026-07-17 01:11:31'),
(43,5,'128GB','Blue',6150000,3,1,'2026-07-18 09:27:31','2026-07-18 09:27:31'),
(44,5,'64GB','Yellow',7150000,2,1,'2026-07-18 09:27:31','2026-07-18 09:27:31'),
(47,24,'64GB','Yellow',121343435,3,1,'2026-07-20 10:47:41','2026-07-20 10:47:41');
/*!40000 ALTER TABLE `product_variants` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` bigint(20) unsigned NOT NULL,
  `storage` varchar(30) NOT NULL,
  `available_storages` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`available_storages`)),
  `color` varchar(60) NOT NULL,
  `available_colors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`available_colors`)),
  `stock` int(10) unsigned NOT NULL DEFAULT 0,
  `image_url` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES
(1,'iPhone X','iphone-x-64gb',2850000,'64GB',NULL,'Space Gray',NULL,3,'/images/products/iphone-x.jpg',1,'2026-07-16 08:23:48','2026-07-17 00:53:17'),
(2,'iPhone XR','iphone-xr-64gb',3250000,'64GB',NULL,'Coral',NULL,4,'/images/iphone-xr-product-v2.png',1,'2026-07-16 08:23:48','2026-07-17 00:53:17'),
(3,'iPhone XS','iphone-xs-64gb',3550000,'64GB',NULL,'Gold',NULL,2,'/images/products/iphone-xs.jpg',1,'2026-07-16 08:23:48','2026-07-17 00:53:17'),
(4,'iPhone 11','iphone-11-64gb',4250000,'64GB',NULL,'Purple',NULL,7,'/images/products/iphone-11.jpg',1,'2026-07-16 08:23:48','2026-07-17 00:53:17'),
(5,'iPhone 12','iphone-12-128gb',6150000,'128GB',NULL,'Blue',NULL,5,'/images/products/iphone-12.jpg',1,'2026-07-16 08:23:48','2026-07-18 09:27:31'),
(6,'iPhone 13','iphone-13-128gb',7850000,'128GB',NULL,'Midnight',NULL,4,'/images/iphone-13-product.png',1,'2026-07-16 08:23:48','2026-07-17 00:53:17'),
(7,'iPhone 13 Pro','iphone-13-pro-256gb',10250000,'256GB',NULL,'Sierra Blue',NULL,2,'/images/iphone-13-pro-product.png',1,'2026-07-16 08:23:48','2026-07-17 00:53:17'),
(8,'iPhone 14','iphone-14-128gb',10850000,'128GB',NULL,'Red',NULL,2,'/images/products/iphone-14.jpg',1,'2026-07-16 08:23:48','2026-07-17 00:53:17'),
(10,'iPhone XS Max','iphone-xs-max-256gb',4650000,'256GB',NULL,'Gold',NULL,2,'/images/products/iphone-xs.jpg',1,'2026-07-16 08:47:45','2026-07-17 00:53:17'),
(11,'iPhone 11 Pro','iphone-11-pro-64gb',5450000,'64GB',NULL,'Natural Titanium',NULL,3,'/images/products/iphone-11-pro.jpg',1,'2026-07-16 08:47:45','2026-07-17 01:11:31'),
(12,'iPhone 11 Pro Max','iphone-11-pro-max-256gb',6850000,'256GB',NULL,'Space Gray',NULL,2,'/images/products/iphone-11-pro.jpg',1,'2026-07-16 08:47:45','2026-07-17 00:53:17'),
(13,'iPhone 12 mini','iphone-12-mini-128gb',5250000,'128GB',NULL,'Blue',NULL,2,'/images/products/iphone-12.jpg',1,'2026-07-16 08:47:45','2026-07-17 00:53:17'),
(14,'iPhone 12 Pro','iphone-12-pro-128gb',7350000,'128GB',NULL,'Pacific Blue',NULL,3,'/images/products/iphone-12.jpg',1,'2026-07-16 08:47:45','2026-07-17 00:53:17'),
(15,'iPhone 12 Pro Max','iphone-12-pro-max-256gb',8650000,'256GB',NULL,'Pacific Blue',NULL,2,'/images/products/iphone-12.jpg',1,'2026-07-16 08:47:45','2026-07-17 00:53:17'),
(16,'iPhone 13 mini','iphone-13-mini-128gb',6850000,'128GB',NULL,'Pink',NULL,2,'/images/iphone-13-product.png',1,'2026-07-16 08:47:45','2026-07-17 00:53:17'),
(17,'iPhone 13 Pro Max','iphone-13-pro-max-256gb',11450000,'256GB',NULL,'Sierra Blue',NULL,3,'/images/iphone-13-pro-product.png',1,'2026-07-16 08:47:45','2026-07-17 00:53:17'),
(18,'iPhone 14 Plus','iphone-14-plus-128gb',11950000,'128GB',NULL,'Blue',NULL,2,'/images/products/iphone-14.jpg',1,'2026-07-16 08:47:45','2026-07-17 00:53:17'),
(19,'iPhone 14 Pro','iphone-14-pro-256gb',14350000,'256GB',NULL,'Deep Purple',NULL,2,'/images/products/iphone-14.jpg',1,'2026-07-16 08:47:45','2026-07-17 00:53:17'),
(20,'iPhone 14 Pro Max','iphone-14-pro-max-256gb',15750000,'256GB',NULL,'Deep Purple',NULL,2,'/images/products/iphone-14.jpg',1,'2026-07-16 08:47:45','2026-07-17 00:53:17'),
(21,'iPhone 15 Plus','iphone-15-plus-128gb',14250000,'128GB',NULL,'Blue',NULL,2,'/images/products/iphone-15.jpg',1,'2026-07-16 08:47:45','2026-07-17 00:53:17'),
(22,'iPhone 15 Pro','iphone-15-pro-256gb',17250000,'256GB',NULL,'Natural Titanium',NULL,2,'/images/products/iphone-15.jpg',1,'2026-07-16 08:47:45','2026-07-17 00:53:17'),
(23,'iPhone 15 Pro Max','iphone-15-pro-max-256gb',19450000,'256GB',NULL,'Natural Titanium',NULL,2,'/images/products/iphone-15.jpg',1,'2026-07-16 08:47:45','2026-07-17 00:53:17'),
(24,'iPhone 15','iphone-15-6klr',121343435,'64GB',NULL,'Yellow',NULL,3,'/images/products/iphone-15-a24c365f-5f84-44f9-bfc4-edd01029b533.jpg',1,'2026-07-20 10:47:41','2026-07-20 10:47:41');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('8cAATbrGkc2bQBrPN6DNsAIRUfwRiQ78JNyJ9Emu',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0','eyJfdG9rZW4iOiIza3V3S0V0blFCekRHOU5BamMwbzFtZGFZdFBLNTdLTkZybVByVGNrIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvcHJvZHVjdHMiLCJyb3V0ZSI6ImFkbWluLnByb2R1Y3RzLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9',1784569662),
('e9jC22qwBSsk0T4xkMTiWSrE1gPl6PtKjUNCytAS',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.129.1 Chrome/148.0.7778.280 Electron/42.6.0 Safari/537.36','eyJfdG9rZW4iOiJ2RWRiNFVWb0FGazB0TGpsR285UDhwbE1qRGI0UFhyb3B4TmxFQzJaIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1784566949),
('RTlVoxjXJ9wNgmpMaMClwexelfYdqgkgh9f8Go7y',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0','eyJfdG9rZW4iOiJqT0pBbzB3eXYxRzFrTjJhYUI1Yk5qODFwSTBRdlF1MlQyMm9hdThlIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9wcm9kdWtcL2lwaG9uZS0xNS02a2xyIiwicm91dGUiOiJwcm9kdWN0cy5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1784569671);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Admin SecondByMePhone','admin@secondbymephone.id',NULL,'$2y$12$/.skq.f84CpWiOmtVIP1Ee7Dr.80UDONjDV3t8TkYF8bNZHC/4BCG',NULL,'2026-07-16 08:23:48','2026-07-16 09:12:32');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-07-21  1:12:00
