-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 26, 2024 at 12:53 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkl_d`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `enhancer` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` timestamp NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `coordinate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `enhancer`, `date`, `time`, `status`, `coordinate`, `created_at`, `updated_at`, `deleted_at`, `deleted_by`) VALUES
(1, 1, '2024-08-19', '2024-08-18 21:33:57', '0', '-6.917464, 107.619123', '2024-08-18 21:33:57', '2024-10-03 07:57:13', NULL, NULL),
(3, 2, '2024-08-19', '2024-08-19 01:02:04', '0', '-6.3176704,107.2955392', '2024-08-18 23:02:04', '2024-10-03 07:57:13', NULL, NULL),
(4, 2, '2024-08-20', '2024-08-20 00:03:30', '0', '-6.5574993,107.441608', '2024-08-19 18:03:30', '2024-10-03 07:57:13', NULL, NULL),
(5, 2, '2024-08-21', '2024-08-20 18:32:47', '0', '-6.3275008,107.2857088', '2024-08-20 18:32:47', '2024-10-03 07:57:13', NULL, NULL),
(6, 2, '2024-08-21', '2024-08-21 09:46:57', '1', '-6.3275008,107.2857088', '2024-08-20 23:46:57', '2024-10-03 07:57:13', NULL, NULL),
(7, 2, '2024-08-22', '2024-08-21 20:41:13', '0', '-6.3275008,107.2889856', '2024-08-21 20:41:13', '2024-10-03 07:57:13', NULL, NULL),
(8, 2, '2024-08-29', '2024-08-29 04:49:01', '0', '-6.3275008,107.2889856', '2024-08-29 04:49:01', '2024-10-03 07:57:13', NULL, NULL),
(10, 9, '2024-08-29', '2024-08-29 06:05:15', '0', '-6.3275008,107.2889856', '2024-08-29 06:05:15', '2024-10-03 07:57:13', NULL, NULL),
(12, 9, '2024-08-29', '2024-08-29 06:11:46', '1', '-6.3275008,107.2889856', '2024-08-29 06:11:46', '2024-10-03 07:57:13', NULL, NULL),
(13, 2, '2024-08-29', '2024-08-29 13:21:47', '1', '-6.2160896,106.8204032', '2024-08-29 13:21:47', '2024-10-03 07:57:13', NULL, NULL),
(21, 17, '2024-09-19', '2024-09-18 18:08:14', '0', '-6.2999641,107.1130185', '2024-09-18 18:08:14', '2024-10-03 07:57:13', NULL, 1),
(22, 17, '2024-09-19', '2024-09-18 18:16:34', '1', '-6.3091198,107.1223533', '2024-09-18 18:16:34', '2024-10-03 07:57:13', NULL, 1),
(23, 18, '2024-11-16', '2024-11-23 04:43:09', '0', '-6.3091198,107.1223533', NULL, NULL, NULL, NULL),
(24, 18, '2024-11-21', '2024-11-23 04:43:48', '0', '-6.3091198,107.1223533', NULL, NULL, NULL, NULL),
(25, 18, '2024-11-21', '2024-11-23 04:43:48', '0', '-6.3091198,107.1223533', NULL, NULL, NULL, NULL),
(26, 18, '2024-11-22', '2024-11-23 04:44:26', '0', '-6.3091198,107.1223533', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint UNSIGNED NOT NULL,
  `enhancer` bigint UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason_verification` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subcategory` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leave_letter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `enhancer`, `date`, `end_date`, `status`, `reason`, `reason_verification`, `about`, `category`, `subcategory`, `leave_letter`, `created_at`, `updated_at`, `deleted_at`, `deleted_by`) VALUES
(1, 17, '2024-09-21', '2024-09-28', '0', 'nikah nih bos', NULL, NULL, 'other', 'married', 'SOX24-24080---0.30mm-x-870mm-AZ150-G550-NEXALUME®-Acrylic-Coated-AFP.docx', '2024-09-18 19:50:16', '2024-10-03 07:57:13', NULL, 1),
(2, 17, '2024-09-20', '2024-09-25', NULL, 'cuti cutiii', NULL, NULL, 'other', 'important_reason', 'STRUKTUR-ORGANISASI-WAREHOUSE---Juli-2024.pdf', '2024-09-18 20:49:46', '2024-10-03 07:57:13', NULL, 1),
(3, 9, '2024-09-24', '2024-09-25', '0', 'idaifodsadf', NULL, NULL, 'other', 'married', '1984-Article-Text-13299-1-10-20230303.pdf', '2024-09-23 06:51:50', '2024-10-03 07:57:13', NULL, NULL),
(4, 2, '2024-09-26', '2024-09-27', NULL, 'osdfosdfodsf', NULL, NULL, 'annual', NULL, NULL, '2024-09-25 07:40:36', '2024-10-03 07:57:13', NULL, NULL),
(5, 17, '2024-11-20', '2024-11-23', '0', '2', NULL, NULL, 'annual', 'sick', NULL, '2024-11-20 08:19:07', '2024-11-20 08:19:36', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_08_14_115204_create_cache_table', 1),
(2, '2024_08_16_024331_create_permission_tables', 1),
(3, '2024_08_16_025842_create_schedules_table', 1),
(4, '2024_08_16_025855_create_users_table', 1),
(5, '2024_08_16_025904_create_attendances_table', 1),
(6, '2024_08_16_025911_create_leaves_table', 1),
(7, '2024_08_16_025933_create_jobs_table', 1),
(8, '2024_09_21_123058_add_deleted_at_field_to_users', 2),
(9, '2024_09_21_151722_add_deleted_at_field_to_attendances', 3),
(10, '2024_09_21_151729_add_deleted_at_field_to_leaves', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `team_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `team_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'pages.admin.dashboard', 'web', '2024-08-18 21:33:13', '2024-08-18 21:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `team_id` bigint UNSIGNED DEFAULT NULL,
  `name` char(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `team_id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin', 'web', '2024-08-18 21:33:13', '2024-08-18 21:33:13'),
(2, NULL, 'Pegawai', 'web', '2024-08-18 21:33:13', '2024-08-18 21:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `shift_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Singkatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `shift_name`, `Singkatan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pegawai', 'Pe', NULL, '2024-08-18 21:33:37', NULL),
(2, 'Magang', 'Mgn', NULL, '2024-10-03 07:04:13', '2024-10-03 07:04:13'),
(4, 'cc', 'c', '2024-10-03 04:34:42', '2024-10-03 07:04:09', '2024-10-03 07:04:09'),
(5, 'cc', 'fd', '2024-10-03 04:42:24', '2024-10-03 07:03:13', '2024-10-03 07:03:13'),
(6, 'cc', 'fd', '2024-10-03 04:43:06', '2024-10-03 04:43:06', NULL),
(7, 'cc', 'fd', '2024-10-03 04:44:08', '2024-10-03 04:44:08', NULL),
(8, 'fixar', 'Far', '2024-10-03 04:50:19', '2024-10-03 06:48:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_day`
--

CREATE TABLE `schedule_day` (
  `id` int NOT NULL,
  `schedule_id` int DEFAULT NULL,
  `clock_in` time DEFAULT NULL,
  `break` time DEFAULT NULL,
  `clock_out` time DEFAULT NULL,
  `days` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule_day`
--

INSERT INTO `schedule_day` (`id`, `schedule_id`, `clock_in`, `break`, `clock_out`, `days`, `created_at`, `updated_at`) VALUES
(9, 7, '19:28:00', '20:28:00', '21:28:00', 'Senin', '2024-10-03 06:33:48', '2024-10-03 06:33:48'),
(20, 6, '13:57:00', '13:57:00', '13:57:00', 'Senin', '2024-10-03 06:57:59', '2024-10-03 06:57:59'),
(26, 8, '08:00:00', '00:00:00', '16:00:00', 'Senin', '2024-10-15 01:36:20', '2024-10-15 01:36:20'),
(27, 8, '10:34:00', '00:00:00', '16:00:00', 'Selasa', '2024-10-15 01:36:20', '2024-10-15 01:36:20'),
(28, 8, '08:00:00', '00:00:00', '16:00:00', 'Rabu', '2024-10-15 01:36:20', '2024-10-15 01:36:20'),
(29, 8, '08:00:00', '00:00:00', '16:00:00', 'Kamis', '2024-10-15 01:36:20', '2024-10-15 01:36:20'),
(30, 8, '08:00:00', '12:00:00', '16:00:00', 'Jumat', '2024-10-15 01:36:20', '2024-10-15 01:36:20'),
(31, 1, '09:00:00', '00:00:00', '17:00:00', 'Senin', '2024-10-15 01:39:07', '2024-10-15 01:39:07'),
(32, 1, '09:00:00', '00:00:00', '17:00:00', 'Selasa', '2024-10-15 01:39:07', '2024-10-15 01:39:07');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1edIWrWC8GTRBZMXCU1Or3NAKRu7xpqRWYESwOw8', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOFdMYnFrRGRwZmxEY2xMSW9uUEp3OTVRMGNaU21kZmd4VFE3aTFKSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTY6Imxhc3RBY3Rpdml0eVRpbWUiO086MjU6IklsbHVtaW5hdGVcU3VwcG9ydFxDYXJib24iOjM6e3M6NDoiZGF0ZSI7czoyNjoiMjAyNC0xMS0yNiAxNDozNzo1OC4zNTY2ODYiO3M6MTM6InRpbWV6b25lX3R5cGUiO2k6MztzOjg6InRpbWV6b25lIjtzOjEyOiJBc2lhL0pha2FydGEiO319', 1732606678),
('iPxgOq40KwUDqxR3F9fbRUQu5WZLvSiozbLlZkwI', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWnU3NnJMMUxLY1J1VFp0Qk54S0tZMUlGcGtEYmdHZU5EU0ZEVmN3USI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hdHRlbmRhbmNlLmtlbG9sYWtlaGFkaXJhbnBlZ2F3YWkvY2V0YWtyZWthcGl0dWxhc2kiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTY6Imxhc3RBY3Rpdml0eVRpbWUiO086MjU6IklsbHVtaW5hdGVcU3VwcG9ydFxDYXJib24iOjM6e3M6NDoiZGF0ZSI7czoyNjoiMjAyNC0xMS0yNSAxNDowODowMC41ODg0ODQiO3M6MTM6InRpbWV6b25lX3R5cGUiO2k6MztzOjg6InRpbWV6b25lIjtzOjEyOiJBc2lhL0pha2FydGEiO319', 1732518480),
('kwUphH9LQnI691v98q8XXDcR4ohg9BwcDfCWcrjA', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaHd5bjN5SWVLcGl5QUp0TGlUZmZNTzROQXRmUmtXRmtkY016ZFQyTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTY6Imxhc3RBY3Rpdml0eVRpbWUiO086MjU6IklsbHVtaW5hdGVcU3VwcG9ydFxDYXJib24iOjM6e3M6NDoiZGF0ZSI7czoyNjoiMjAyNC0xMS0yNiAxMDoyODozOC4wMzc3NzQiO3M6MTM6InRpbWV6b25lX3R5cGUiO2k6MztzOjg6InRpbWV6b25lIjtzOjEyOiJBc2lhL0pha2FydGEiO319', 1732591718);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` char(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` char(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `telephone` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place_of_birth` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `position` int DEFAULT NULL,
  `id_card` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` char(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` bigint UNSIGNED DEFAULT NULL,
  `avatar` char(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `available` int NOT NULL DEFAULT '10',
  `schedule` bigint UNSIGNED DEFAULT NULL,
  `delete` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `token` char(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `telephone`, `place_of_birth`, `date_of_birth`, `gender`, `religion`, `address`, `position`, `id_card`, `password`, `role`, `avatar`, `status`, `available`, `schedule`, `delete`, `token`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `deleted_by`) VALUES
(1, 'admin', 'Admin', 'admin1@polsub', '2024-08-18 21:33:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$VU62Xemx5/3QNAazJKAIguYcSW.0ScV5xjL8yFGAq/Agtoi6dvyHC', 1, 'admin.jpg', '0', 6, 1, '0', 'BFUwIubuU6', NULL, '2024-08-18 21:33:43', '2024-09-21 08:04:31', NULL, NULL),
(2, '00001', 'Faldi Reza', 'faldireza@polsub', '2024-08-18 21:33:43', '0821209687142', 'Subang', '2024-08-22', 'Laki - laki', 'Islam', 'kepo lu', NULL, '3213040912030001', '$2y$12$Eoua.RYdoC.8Dx8SC8mspeVDVfvZtDPLnCHjBD0KRsfLg6M6G.3ia', 2, 'images/1725431669.jpg', '0', 10, 8, '0', 'Sx03Ui2JM6', NULL, '2024-08-18 21:33:43', '2024-09-21 08:04:31', NULL, NULL),
(7, '00002', 'Hpissss', 'primanda@polsub', NULL, NULL, NULL, NULL, 'Laki - laki', NULL, NULL, NULL, NULL, '$2y$12$zJlCQgHiKou1GjA19QIJNuedj80MrDBx4KgU1FFiM8eqvWaOmlRQG', 2, NULL, '0', 10, 1, '0', NULL, NULL, '2024-08-23 01:07:42', '2024-10-03 07:48:58', NULL, NULL),
(8, '00003', 'Rifky Primanda', 'marketing@gmail.com', NULL, NULL, NULL, NULL, 'Laki - laki', NULL, NULL, NULL, NULL, '$2y$12$NE6oNHxDD89wXTl93qI/TeOK.NQ2/mEuIBa2PRYsc4xoufQ69O7uu', 2, NULL, '0', 10, 6, '0', NULL, NULL, '2024-08-23 01:08:28', '2024-10-03 07:48:38', NULL, 1),
(9, '00004', 'Kandita Kamalludin', 'kandita2222@polsub', NULL, NULL, NULL, NULL, 'Laki - laki', NULL, NULL, NULL, NULL, '$2y$12$GO1g2eHGRyr16PslPMMXyOpLOTa0DIOlkbRpqtfS.vbQYAm02yXvm', 2, 'images/1724659455.jpg', '0', 9, 1, '0', NULL, NULL, '2024-08-23 06:10:53', '2024-09-24 06:43:44', NULL, NULL),
(10, '00005', 'saha wae', 'operator@gmail.com', NULL, NULL, NULL, NULL, 'Perempuan', NULL, NULL, NULL, NULL, '$2y$12$jnI.T8V2ZgwS.xyNP1FNXe4eGn7kJ7qvkl3bbYU0g0/O9Q/Atgbti', 2, NULL, '0', 10, 8, '0', NULL, NULL, '2024-08-23 06:12:17', '2024-10-03 07:48:34', NULL, NULL),
(11, '00006', 'Rafly Rezamal Ilham', 'rafly@polsub', NULL, '10219292121', 'Subang', '2024-09-03', 'Laki - laki', 'Islam', 'asdasd', NULL, NULL, '$2y$12$uY.U7Tvkul8adJ9/vmfqpeZSxA9x.u4Kbd.z/4Bi18IsqIk2dlyjC', 2, NULL, '0', 10, 1, '0', NULL, NULL, '2024-08-26 07:10:39', '2024-09-21 08:04:31', NULL, NULL),
(12, '00007', 'Louis Venza', 'louis@polsub', NULL, NULL, NULL, NULL, 'Perempuan', NULL, NULL, NULL, NULL, '$2y$12$6Fmqe4XrB1VTxqofj0upoeN2RFwVCiY3JK24v6AX4ecpUbg6UmAeK', 2, NULL, '0', 10, 6, '0', NULL, NULL, '2024-08-26 07:15:54', '2024-11-26 07:37:26', NULL, 1),
(13, '00008', 'Vicky Irmansyah', 'vicky@polsub', NULL, 'asd', NULL, NULL, 'Laki - laki', NULL, NULL, NULL, NULL, '$2y$12$ms3laH22alKdeaIc7Q/ilubUUzz7aC7Bo1WJjMz8kPREUNAmstELi', 2, 'images/1724828561.jpg', '0', 10, NULL, '0', '8e05vthViQuHOPylDnSUqebcyuU1VtPY', NULL, '2024-08-28 07:01:58', '2024-09-21 08:47:57', '2024-09-21 08:47:57', 1),
(17, '00012', 'xccc', 'odanuartha@gmail.com', NULL, NULL, NULL, NULL, 'Laki - laki', NULL, NULL, NULL, NULL, '$2y$12$QISLjFRuo9EPccE8WxiXD.ZVRyb31s2EMTWTQLGcxvlSYKnep5cWW', 2, NULL, '0', 7, 8, '0', '7WrX08zXo37RB5mvvohvjsRZ8D3EOcWP', NULL, '2024-09-12 07:35:28', '2024-11-20 08:19:36', NULL, 1),
(18, '00013', 'RugiDong', 'odanuartha01@gmail.com', NULL, NULL, NULL, NULL, 'Laki - laki', NULL, NULL, NULL, NULL, '$2y$12$KszzArp.UB3v3JfHTv4TYeF5VZ19l61va8IP/Orzso.xEZOnonmWG', 2, NULL, '0', 10, 8, '0', 'UJtmAwLAEDf4LSex7WdTVq9bgMq5pbiB', NULL, '2024-11-23 04:23:37', '2024-11-23 05:17:01', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_enhancer_foreign` (`enhancer`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leaves_enhancer_foreign` (`enhancer`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`team_id`,`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  ADD KEY `model_has_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `model_has_permissions_team_foreign_key_index` (`team_id`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`team_id`,`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  ADD KEY `model_has_roles_role_id_foreign` (`role_id`),
  ADD KEY `model_has_roles_team_foreign_key_index` (`team_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_team_id_name_guard_name_unique` (`team_id`,`name`,`guard_name`),
  ADD KEY `roles_team_foreign_key_index` (`team_id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_day`
--
ALTER TABLE `schedule_day`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_foreign` (`role`),
  ADD KEY `users_schedule_foreign` (`schedule`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `schedule_day`
--
ALTER TABLE `schedule_day`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_enhancer_foreign` FOREIGN KEY (`enhancer`) REFERENCES `users` (`id`);

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_enhancer_foreign` FOREIGN KEY (`enhancer`) REFERENCES `users` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_foreign` FOREIGN KEY (`role`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `users_schedule_foreign` FOREIGN KEY (`schedule`) REFERENCES `schedules` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
