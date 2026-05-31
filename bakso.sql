-- MySQL dump 10.13  Distrib 8.4.8, for Linux (x86_64)
--
-- Host: localhost    Database: bakso
-- ------------------------------------------------------
-- Server version	8.4.8-0ubuntu1

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
-- Table structure for table `bahan_bakus`
--

DROP TABLE IF EXISTS `bahan_bakus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bahan_bakus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_bahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minimum_stok` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bahan_bakus`
--

LOCK TABLES `bahan_bakus` WRITE;
/*!40000 ALTER TABLE `bahan_bakus` DISABLE KEYS */;
INSERT INTO `bahan_bakus` VALUES (1,'Tepung',45,'kg',10,'2026-05-16 01:27:46','2026-05-16 05:19:37'),(2,'Daging Ayam',129,'kg',8,'2026-05-16 01:27:46','2026-05-16 05:19:47'),(3,'Bumbu',18,'kg',5,'2026-05-16 01:27:46','2026-05-16 01:27:46');
/*!40000 ALTER TABLE `bahan_bakus` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('sibakso-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6','i:2;',1779703416),('sibakso-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6:timer','i:1779703416;',1779703416);
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
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
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
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_02_13_093403_add_role_to_users_table',1),(5,'2026_02_13_093444_create_pesanans_table',1),(6,'2026_02_13_093517_create_bahan_bakus_table',1),(7,'2026_02_13_093628_create_produksis_table',1),(8,'2026_02_13_093647_create_produksi_details_table',1),(9,'2026_02_14_071955_create_stok_logs_table',1),(10,'2026_02_15_000001_create_pemasoks_table',1),(11,'2026_02_15_000002_create_pembelians_table',1),(12,'2026_02_15_000003_create_pelanggans_table',1),(13,'2026_02_15_000004_add_pelanggan_id_to_pesanans_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelanggans`
--

DROP TABLE IF EXISTS `pelanggans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pelanggans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `nohp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelanggans`
--

LOCK TABLES `pelanggans` WRITE;
/*!40000 ALTER TABLE `pelanggans` DISABLE KEYS */;
INSERT INTO `pelanggans` VALUES (1,'Andi','Bangkinang','081234567890','2026-05-16 01:27:46','2026-05-16 01:27:46');
/*!40000 ALTER TABLE `pelanggans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pemasoks`
--

DROP TABLE IF EXISTS `pemasoks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pemasoks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `nohp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemasoks`
--

LOCK TABLES `pemasoks` WRITE;
/*!40000 ALTER TABLE `pemasoks` DISABLE KEYS */;
INSERT INTO `pemasoks` VALUES (1,'Toko Tepung Sejahtera','Jl. Industri No. 10, Bangkinang','081276543210','2026-05-16 01:27:46','2026-05-16 01:27:46'),(2,'Supplier Daging Ayam','Jl. Peternakan No. 5, Bangkinang','081298765432','2026-05-16 01:27:46','2026-05-16 01:27:46');
/*!40000 ALTER TABLE `pemasoks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembelians`
--

DROP TABLE IF EXISTS `pembelians`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pembelians` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pemasok_id` bigint unsigned NOT NULL,
  `bahan_baku_id` bigint unsigned NOT NULL,
  `jumlah` int NOT NULL DEFAULT '0',
  `tgl_beli` date NOT NULL,
  `harga` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pembelians_pemasok_id_foreign` (`pemasok_id`),
  KEY `pembelians_bahan_baku_id_foreign` (`bahan_baku_id`),
  CONSTRAINT `pembelians_bahan_baku_id_foreign` FOREIGN KEY (`bahan_baku_id`) REFERENCES `bahan_bakus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pembelians_pemasok_id_foreign` FOREIGN KEY (`pemasok_id`) REFERENCES `pemasoks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembelians`
--

LOCK TABLES `pembelians` WRITE;
/*!40000 ALTER TABLE `pembelians` DISABLE KEYS */;
INSERT INTO `pembelians` VALUES (1,1,1,10,'2026-05-16',150000.00,'2026-05-16 01:27:46','2026-05-16 01:27:46'),(2,2,2,8,'2026-05-16',320000.00,'2026-05-16 01:27:46','2026-05-16 01:27:46'),(3,2,2,100,'2026-05-16',20000.00,'2026-05-16 01:31:11','2026-05-16 01:31:11');
/*!40000 ALTER TABLE `pembelians` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pesanans`
--

DROP TABLE IF EXISTS `pesanans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pesanans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pelanggan_id` bigint unsigned DEFAULT NULL,
  `nama_pelanggan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_bakso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_ambil` date NOT NULL,
  `status_pembayaran` enum('belum_lunas','lunas') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum_lunas',
  `status_produksi` enum('menunggu','diproduksi','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pesanans_pelanggan_id_foreign` (`pelanggan_id`),
  CONSTRAINT `pesanans_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggans` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pesanans`
--

LOCK TABLES `pesanans` WRITE;
/*!40000 ALTER TABLE `pesanans` DISABLE KEYS */;
INSERT INTO `pesanans` VALUES (1,1,'Andi','Bakso Ayam Besar',100,'Bangkinang','081234567890','2026-05-17','lunas','selesai','2026-05-16 01:27:46','2026-05-16 05:19:53'),(2,1,'Andi','bakso urat',100,'jasdasd','1212121212','2026-05-25','belum_lunas','menunggu','2026-05-25 03:08:07','2026-05-25 03:08:07');
/*!40000 ALTER TABLE `pesanans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produksi_details`
--

DROP TABLE IF EXISTS `produksi_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produksi_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `produksi_id` bigint unsigned NOT NULL,
  `bahan_baku_id` bigint unsigned NOT NULL,
  `jumlah_digunakan` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produksi_details_produksi_id_foreign` (`produksi_id`),
  KEY `produksi_details_bahan_baku_id_foreign` (`bahan_baku_id`),
  CONSTRAINT `produksi_details_bahan_baku_id_foreign` FOREIGN KEY (`bahan_baku_id`) REFERENCES `bahan_bakus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `produksi_details_produksi_id_foreign` FOREIGN KEY (`produksi_id`) REFERENCES `produksis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produksi_details`
--

LOCK TABLES `produksi_details` WRITE;
/*!40000 ALTER TABLE `produksi_details` DISABLE KEYS */;
INSERT INTO `produksi_details` VALUES (1,1,1,5,'2026-05-16 01:27:46','2026-05-16 01:27:46'),(2,1,2,7,'2026-05-16 01:27:46','2026-05-16 01:27:46'),(3,1,3,2,'2026-05-16 01:27:46','2026-05-16 01:27:46'),(4,1,1,10,'2026-05-16 05:19:37','2026-05-16 05:19:37'),(5,1,2,12,'2026-05-16 05:19:47','2026-05-16 05:19:47');
/*!40000 ALTER TABLE `produksi_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produksis`
--

DROP TABLE IF EXISTS `produksis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produksis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pesanan_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `tanggal_produksi` date NOT NULL,
  `jumlah_produksi` int NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produksis_pesanan_id_foreign` (`pesanan_id`),
  KEY `produksis_user_id_foreign` (`user_id`),
  CONSTRAINT `produksis_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `produksis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produksis`
--

LOCK TABLES `produksis` WRITE;
/*!40000 ALTER TABLE `produksis` DISABLE KEYS */;
INSERT INTO `produksis` VALUES (1,1,2,'2026-05-16',100,'Produksi pagi hari','2026-05-16 01:27:46','2026-05-16 01:27:46');
/*!40000 ALTER TABLE `produksis` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('IhoV1GFhQPiP6Tx4VNkUnn96mLGokrmGtAH3KtLV',NULL,'127.0.0.1','WhatsApp/2.23.20.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGdwbHBUTGZrOFFTVkVRQ1lvMU9tTEVBREsxSlZGZXZNdEtBOTdhUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly85OGMwLTEyNS0xNjUtMTA5LTE3NS5uZ3Jvay1mcmVlLmFwcCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1780125685),('Kxm7WXaKGcfmYqVHtU557U5WUisQSFnPvgEEkhNa',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSE5hUVVuU1o4V0daRERxb04xa2d5YjNzWTdMRldCbWRGenlWaHV3RiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly85OGMwLTEyNS0xNjUtMTA5LTE3NS5uZ3Jvay1mcmVlLmFwcCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1780126851),('LU9I9UsKrMmJ7T8KTrfuG58n6WQqu0Q1WI3TUNdD',NULL,'127.0.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3ZsWkNzcUZ6RTR0VndHblZEazM4OUJCcERPbG1sQmdLUWdDWjI4SCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly85OGMwLTEyNS0xNjUtMTA5LTE3NS5uZ3Jvay1mcmVlLmFwcCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1780126426),('M0CnNoRNPnHOyouWTCrmKdFp4i1EvM58W9svxkUB',NULL,'127.0.0.1','WhatsApp/2.23.20.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUZRNnljWUNTdUlYRUhCbnlEc0hZQkJEWlFGSHk5RTRkY0Rka0hZSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly85OGMwLTEyNS0xNjUtMTA5LTE3NS5uZ3Jvay1mcmVlLmFwcCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1780125723),('vU0IobJP4BSSATR5lU3uJtUrOnjRtZOqu9no6miy',NULL,'127.0.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiN3RFOVd3STR0RGlDZFhaRTdvaHRiVWhDZlhSQmpYR2UySXVBTnAwSCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly85OGMwLTEyNS0xNjUtMTA5LTE3NS5uZ3Jvay1mcmVlLmFwcCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1780126915);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stok_logs`
--

DROP TABLE IF EXISTS `stok_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stok_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `bahan_baku_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `jenis` enum('masuk','keluar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `stok_sebelum` int NOT NULL,
  `stok_sesudah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stok_logs_bahan_baku_id_foreign` (`bahan_baku_id`),
  KEY `stok_logs_user_id_foreign` (`user_id`),
  CONSTRAINT `stok_logs_bahan_baku_id_foreign` FOREIGN KEY (`bahan_baku_id`) REFERENCES `bahan_bakus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `stok_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stok_logs`
--

LOCK TABLES `stok_logs` WRITE;
/*!40000 ALTER TABLE `stok_logs` DISABLE KEYS */;
INSERT INTO `stok_logs` VALUES (1,1,2,'masuk',10,50,60,'2026-05-16 01:27:46','2026-05-16 01:27:46'),(2,2,2,'masuk',8,40,48,'2026-05-16 01:27:46','2026-05-16 01:27:46'),(3,1,2,'keluar',5,60,55,'2026-05-16 01:27:46','2026-05-16 01:27:46'),(4,2,2,'keluar',7,48,41,'2026-05-16 01:27:46','2026-05-16 01:27:46'),(5,3,2,'keluar',2,20,18,'2026-05-16 01:27:46','2026-05-16 01:27:46'),(6,2,1,'masuk',100,41,141,'2026-05-16 01:31:11','2026-05-16 01:31:11'),(7,1,2,'keluar',10,55,45,'2026-05-16 05:19:37','2026-05-16 05:19:37'),(8,2,2,'keluar',12,141,129,'2026-05-16 05:19:47','2026-05-16 05:19:47');
/*!40000 ALTER TABLE `stok_logs` ENABLE KEYS */;
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
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','karyawan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'karyawan',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin Bakso','admin234@bakso.com','$2y$12$rfAdngMYvvv.z2P0NiyoIuod.M1v0FyujNDZw2.a4bED3jTbWGGDu','admin',NULL,'2026-05-16 01:27:46','2026-05-16 01:27:46'),(2,'Budi Produksi','karyawan@bakso.com','$2y$12$FYdSPYsKIWVJs8DrhJwTLeAACGR.jLrCvV8zKfTL81EChthXXF0zC','karyawan',NULL,'2026-05-16 01:27:46','2026-05-16 01:27:46');
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

-- Dump completed on 2026-05-31 14:06:03
