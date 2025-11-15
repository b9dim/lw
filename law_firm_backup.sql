-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: law_firm
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `case_updates`
--

DROP TABLE IF EXISTS `case_updates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `case_updates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `case_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `case_updates_case_id_foreign` (`case_id`),
  CONSTRAINT `case_updates_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `cases` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `case_updates`
--

LOCK TABLES `case_updates` WRITE;
/*!40000 ALTER TABLE `case_updates` DISABLE KEYS */;
INSERT INTO `case_updates` VALUES (1,1,'بدء الإجراءات القانونية','تم تقديم الملف إلى المحكمة وبدء الإجراءات القانونية','2025-11-15 00:15:30','2025-11-15 00:15:30'),(2,1,'جلسة استماع','تم تحديد موعد جلسة الاستماع في 15/03/2024','2025-11-15 00:15:30','2025-11-15 00:15:30'),(3,2,'بدء المحاكمة','تم بدء جلسات المحاكمة في القضية','2025-11-15 00:15:30','2025-11-15 00:15:30'),(4,3,'انتهاء القضية','تم الحكم في القضية لصالح العميل','2025-11-15 00:15:30','2025-11-15 00:15:30'),(5,1,'تم التواصل عبر الهاتف','تم التواصل عبر الهاتف','2025-11-15 00:38:42','2025-11-15 00:38:42'),(6,4,'تم الالغاء','نعتذر منك تم الغاء القضية بسبب ان القضة ليست من اختصاصنا','2025-11-15 18:18:41','2025-11-15 18:18:41');
/*!40000 ALTER TABLE `case_updates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cases`
--

DROP TABLE IF EXISTS `cases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `case_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `lawyer_id` bigint unsigned DEFAULT NULL,
  `court_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('قيد المعالجة','قيد المحاكمة','منتهية','ملغاة') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'قيد المعالجة',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cases_case_number_unique` (`case_number`),
  KEY `cases_client_id_foreign` (`client_id`),
  KEY `cases_lawyer_id_foreign` (`lawyer_id`),
  CONSTRAINT `cases_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cases_lawyer_id_foreign` FOREIGN KEY (`lawyer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cases`
--

LOCK TABLES `cases` WRITE;
/*!40000 ALTER TABLE `cases` DISABLE KEYS */;
INSERT INTO `cases` VALUES (1,'CASE-2025-282240',1,2,'محكمة الرياض العامة','قيد المعالجة','قضية تعويضات ناتجة عن حادث مروري','2025-11-15 00:15:30','2025-11-15 18:28:04'),(2,'CASE-2025-288796',2,3,'محكمة جدة التجارية','قيد المحاكمة','قضية تجارية متعلقة بعقد بيع','2025-11-15 00:15:30','2025-11-15 18:28:11'),(3,'CASE-2025-298464',1,2,'محكمة الدمام','منتهية','قضية عقارية','2025-11-15 00:15:30','2025-11-15 18:42:16'),(4,'CASE-2025-274963',1,2,'العليا','ملغاة','ملغاة','2025-11-15 18:17:51','2025-11-15 18:27:57');
/*!40000 ALTER TABLE `cases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_national_id_unique` (`national_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'عبدالله محمد الاسمري','1234567890','0501234567','b9di@hotmail.com','$2y$12$kHQC5snLi/D3mCmgQJErJe4N3rXP.Aw/UFPsJGEBKPveWul2Zp8d.',NULL,'2025-11-15 00:15:30','2025-11-15 17:21:55'),(2,'سارة أحمد الخالدي','0987654321','0509876543','client2@example.com','$2y$12$HzHdxo.D/IDFGVda6fOXq.03tqVunIDAhYQTnBHSk3TEjrc37M0Ym',NULL,'2025-11-15 00:15:30','2025-11-15 00:15:30'),(3,'عبدالرحمن خالد السعيد','1122334455','0501122334','client3@example.com','$2y$12$FRJNSvmoAB7Dj1h8yp3uiOaO8buSpThDU3bF.k0p7CX5268MdZLpi',NULL,'2025-11-15 00:15:30','2025-11-15 00:15:30'),(4,'احمد','1082459106',NULL,'a@b9d.im','$2y$12$cB8IK0HVSgKOQV20GdeEaennf7E3cdmJ.W9kvgko77rkCAmE.j8X2',NULL,'2025-11-15 03:02:02','2025-11-15 17:24:01');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inquiries`
--

DROP TABLE IF EXISTS `inquiries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inquiries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `case_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply` text COLLATE utf8mb4_unicode_ci,
  `replied_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inquiries_case_id_foreign` (`case_id`),
  KEY `inquiries_client_id_foreign` (`client_id`),
  CONSTRAINT `inquiries_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `cases` (`id`) ON DELETE CASCADE,
  CONSTRAINT `inquiries_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inquiries`
--

LOCK TABLES `inquiries` WRITE;
/*!40000 ALTER TABLE `inquiries` DISABLE KEYS */;
INSERT INTO `inquiries` VALUES (1,1,1,'متى موعد الجلسة القادمة؟','الجلسة القادمة في 15/03/2024 الساعة 10 صباحاً','2025-11-15 00:15:30','2025-11-15 00:15:30','2025-11-15 00:15:30'),(2,2,2,'ما هي آخر التطورات في القضية؟',NULL,NULL,'2025-11-15 00:15:30','2025-11-15 00:15:30'),(3,3,1,'هذا استفسار تجريبي','وهذا رد تجريبي','2025-11-15 01:52:38','2025-11-15 00:27:14','2025-11-15 01:52:38'),(4,1,1,'هل يمكنني تأجيل الجلسة؟','نعم','2025-11-15 00:31:52','2025-11-15 00:27:58','2025-11-15 00:31:52'),(5,1,1,'هل تجديد التأمين بعد يوم يفيد؟','لا','2025-11-15 02:26:44','2025-11-15 00:44:21','2025-11-15 02:26:44'),(6,3,1,'تجربة التحديث الاخير','التحديث يعمل','2025-11-15 02:39:40','2025-11-15 02:35:26','2025-11-15 02:39:40');
/*!40000 ALTER TABLE `inquiries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` int NOT NULL,
  `cancelled_at` int DEFAULT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (9,'2024_01_01_000001_create_users_table',1),(10,'2024_01_01_000002_create_clients_table',1),(11,'2024_01_01_000003_create_cases_table',1),(12,'2024_01_01_000004_create_case_updates_table',1),(13,'2024_01_01_000005_create_inquiries_table',1),(14,'2024_01_01_000006_create_sessions_table',1),(15,'2024_01_01_000007_create_cache_table',1),(16,'2024_01_01_000008_create_jobs_table',1),(17,'2024_01_01_000009_create_ratings_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ratings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `rating` int NOT NULL COMMENT 'التقييم من 1 إلى 5',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ratings_client_id_foreign` (`client_id`),
  CONSTRAINT `ratings_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
INSERT INTO `ratings` VALUES (4,1,5,'تعامل راقي وسرعة في الانجاز','pending','2025-11-15 18:47:15','2025-11-15 18:47:15');
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('DfpVYx1kKLeeqxmybntuX0xmW2u4wSFHZIH5DIzF',1234567890,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVjBDMlIwc3BFUWZoWUU4ZmtVRnp3bEp5bHFORjFrdXNYWjZSaWJ4cCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jbGllbnQvY2FzZXMvNCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo1MzoibG9naW5fY2xpZW50XzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO3M6MTA6IjEyMzQ1Njc4OTAiO30=',1763232762),('XSQh8svEHTRKjYTWr6EZ0HHkeZe6afQz7xp8sOb2',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMFY0N3BZZFZicFI4djhpenZsWmRVQnFpVXk1SVFjR0didWw2WnVkMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9jYXNlcy8zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1763232713);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('مدير','محامي','موظف استقبال') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'موظف استقبال',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'مدير النظام','admin@admin.sa',NULL,'$2y$12$hAaHUCgKF3iKQvuUgxMl5uM0EN2jEcr64dEeTPpiYJZJswdrGLjnK','مدير','oH4waDuKZQXE8d9PsH7wGzSn89TcXZUHuF3kc7ibIYV6wDQk2eGh45D1UivV','2025-11-15 00:15:29','2025-11-15 17:36:50'),(2,'مسفر محمد العرجاني','lawyer1@lawfirm.sa',NULL,'$2y$12$9IdLjU0pGBFvG1Ngpsiep.sJLq/DIxKjwZXIF4GPrWotSMq/jJU2q','محامي',NULL,'2025-11-15 00:15:29','2025-11-15 00:37:22'),(3,'محمد عبدالله','lawyer2@lawfirm.sa',NULL,'$2y$12$YtyoF6LADOgJ9VdQZfCp4.ndsqdHMHCDRY2o3TggOrLueevbbpyWq','محامي',NULL,'2025-11-15 00:15:29','2025-11-15 00:37:47'),(4,'خالد سعيد','reception@lawfirm.sa',NULL,'$2y$12$FfKoy2b4XGTGJ4B6OoY9suYgdmZs4.ac98iO8/hsGK9Ipsn9SJOx.','موظف استقبال',NULL,'2025-11-15 00:15:30','2025-11-15 00:31:18');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-15 22:12:25
