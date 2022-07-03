-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2022 at 11:03 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `larasmartkid`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Kendaraan Roda 4 atau lebih', '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(2, 'Kendaraan Roda 2', '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(3, 'Bidang Tanah / Sawah', '2022-06-24 03:25:39', '2022-06-24 03:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `assets_details`
--

CREATE TABLE `assets_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assets_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets_details`
--

INSERT INTO `assets_details` (`id`, `assets_id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'Memiliki', 0, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(2, 1, 'Tidak meiliki', 100, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(3, 2, 'Tidak memiliki', 100, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(4, 2, 'Memiliki 1 - 2', 80, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(5, 2, 'Memiliki 3 - 5', 30, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(6, 2, 'Memiliki > 5', 0, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(7, 3, 'Memiliki 2 - 3 bidang tanah / sawah', 0, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(8, 3, 'Tidak memiliki bidang tanah / sawah', 100, '2022-06-24 03:25:39', '2022-06-24 03:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `asuransis`
--

CREATE TABLE `asuransis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asuransis`
--

INSERT INTO `asuransis` (`id`, `nama`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 'Asuransi Kesehatan Swasta', 0, '2022-06-24 03:25:40', '2022-06-24 03:25:40'),
(2, 'BPJS Kelas 3', 20, '2022-06-24 03:25:40', '2022-06-24 03:25:40'),
(3, 'BPJS Kelas 2', 50, '2022-06-24 03:25:40', '2022-06-24 03:25:40'),
(4, 'BPJS Kelas 1', 70, '2022-06-24 03:25:40', '2022-06-24 03:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_beasiswas`
--

CREATE TABLE `jenis_beasiswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_beasiswa` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kondisi_rumahs`
--

CREATE TABLE `kondisi_rumahs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `ortu_id` bigint(20) UNSIGNED NOT NULL,
  `status_rumah` enum('pribadi','kontrak','milik orangtua') COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_bangunan` enum('permanen','non-permanen') COLLATE utf8mb4_unicode_ci NOT NULL,
  `berkas_surat_pajak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_01_24_054030_create_orang_tuas_table', 1),
(6, '2022_01_24_111625_create_permission_tables', 1),
(7, '2022_02_19_040825_create_kondisi_rumahs_table', 1),
(8, '2022_02_19_170943_create_jenis_beasiswas_table', 1),
(9, '2022_02_23_234220_create_siswas_table', 1),
(10, '2022_03_03_115634_create_siswa__prestasis_table', 1),
(11, '2022_03_15_042346_create_periodes_table', 1),
(12, '2022_03_16_084111_create_pendaftars_table', 1),
(13, '2022_05_10_044807_create_ternaks_table', 1),
(14, '2022_05_10_045155_create_ternak_details_table', 1),
(15, '2022_05_10_045713_create_assets_table', 1),
(16, '2022_05_10_050944_create_penghasilans_table', 1),
(17, '2022_05_10_051502_create_tanggungans_table', 1),
(18, '2022_05_26_134351_create_rumahs_table', 1),
(19, '2022_05_26_134716_create_rumah_details_table', 1),
(20, '2022_05_27_104146_create_asuransis_table', 1),
(21, '2022_05_27_111640_create_tanggungan_anaks_table', 1),
(22, '2022_05_30_052934_create_assets_details_table', 1),
(23, '2022_05_30_230654_create_penilaians_table', 1),
(24, '2022_05_30_230911_create_penilaian_details_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 1),
(6, 'App\\Models\\User', 1),
(7, 'App\\Models\\User', 1),
(8, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orang_tuas`
--

CREATE TABLE `orang_tuas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('ayah','ibu','wali') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ayah',
  `nik` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan` enum('sd','smp','sma/k','s1','s2','s3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sma/k',
  `pekerjaan` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orang_tuas`
--

INSERT INTO `orang_tuas` (`id`, `user_id`, `status`, `nik`, `pendidikan`, `pekerjaan`, `created_at`, `updated_at`) VALUES
(1, 1, 'ayah', '234354645645', 'sma/k', 'guru', '2022-06-24 03:25:38', '2022-06-24 03:25:38'),
(2, 2, 'ibu', '2343546453434', 's1', 'wirasuasta', '2022-06-24 03:25:38', '2022-06-24 03:25:38'),
(3, 3, 'wali', '234354645222', 'sma/k', 'guru', '2022-06-24 03:25:38', '2022-06-24 03:25:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftars`
--

CREATE TABLE `pendaftars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `ortu_id` bigint(20) UNSIGNED NOT NULL,
  `periode_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penghasilans`
--

CREATE TABLE `penghasilans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penghasilan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penghasilans`
--

INSERT INTO `penghasilans` (`id`, `penghasilan`, `bobot`, `created_at`, `updated_at`) VALUES
(1, '< 1.000.000', 100, '2022-06-24 03:25:40', '2022-06-24 03:25:40'),
(2, '1.000.000 - 3.000.000', 75, '2022-06-24 03:25:40', '2022-06-24 03:25:40'),
(3, '> 3.000.000 - 6.000.000', 40, '2022-06-24 03:25:40', '2022-06-24 03:25:40'),
(4, '> 10.000.00', 0, '2022-06-24 03:25:40', '2022-06-24 03:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `penilaians`
--

CREATE TABLE `penilaians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `penghasilan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggungan_id` bigint(20) UNSIGNED NOT NULL,
  `asuransi_id` bigint(20) UNSIGNED NOT NULL,
  `c1` double(8,2) NOT NULL,
  `c2` double(8,2) NOT NULL,
  `c3` double(8,2) NOT NULL,
  `c4` double(8,2) NOT NULL,
  `c5` double(8,2) NOT NULL,
  `c6` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penilaians`
--

INSERT INTO `penilaians` (`id`, `siswa_id`, `penghasilan_id`, `tanggungan_id`, `asuransi_id`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`, `created_at`, `updated_at`) VALUES
(12, 1, 2, 2, 2, 75.00, 55.00, 26.67, 80.00, 50.00, 20.00, '2022-06-24 20:20:21', '2022-06-24 20:20:21'),
(13, 1, 3, 4, 4, 40.00, 41.67, 10.00, 70.00, 100.00, 70.00, '2022-06-24 20:30:23', '2022-06-24 20:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_details`
--

CREATE TABLE `penilaian_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penilaian_id` bigint(20) UNSIGNED NOT NULL,
  `rumah_id` bigint(20) UNSIGNED NOT NULL,
  `value_rumah` int(11) NOT NULL,
  `assets_id` bigint(20) UNSIGNED NOT NULL,
  `value_assets` int(11) NOT NULL,
  `ternak_id` bigint(20) UNSIGNED NOT NULL,
  `value_ternak` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periodes`
--

CREATE TABLE `periodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `beasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `semester` enum('Ganjil','Genap') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Aktif','Non-Aktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2022-06-24 03:25:38', '2022-06-24 03:25:38'),
(2, 'role-create', 'web', '2022-06-24 03:25:38', '2022-06-24 03:25:38'),
(3, 'role-edit', 'web', '2022-06-24 03:25:38', '2022-06-24 03:25:38'),
(4, 'role-delete', 'web', '2022-06-24 03:25:38', '2022-06-24 03:25:38'),
(5, 'ortu-list', 'web', '2022-06-24 03:25:38', '2022-06-24 03:25:38'),
(6, 'ortu-create', 'web', '2022-06-24 03:25:38', '2022-06-24 03:25:38'),
(7, 'ortu-edit', 'web', '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(8, 'ortu-delete', 'web', '2022-06-24 03:25:39', '2022-06-24 03:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2022-06-24 03:25:38', '2022-06-24 03:25:38');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rumahs`
--

CREATE TABLE `rumahs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rumahs`
--

INSERT INTO `rumahs` (`id`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Status Kepemilikan', '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(2, 'Luas Bangunan', '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(3, 'Jenis / Kondisi Bangunan Dinding', '2022-06-24 03:25:40', '2022-06-24 03:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `rumah_details`
--

CREATE TABLE `rumah_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rumah_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rumah_details`
--

INSERT INTO `rumah_details` (`id`, `rumah_id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kontrak/sewa', 100, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(2, 1, 'Milik pribadi', 25, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(3, 2, '< 50 m2', 100, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(4, 2, '50 - 100 m2', 75, '2022-06-24 03:25:40', '2022-06-24 03:25:40'),
(5, 2, '100 - 400 m2', 50, '2022-06-24 03:25:40', '2022-06-24 03:25:40'),
(6, 2, '> 400 m2', 0, '2022-06-24 03:25:40', '2022-06-24 03:25:40'),
(7, 3, 'Tembok Kualitas Tinggi', 40, '2022-06-24 03:25:40', '2022-06-24 03:25:40'),
(8, 3, 'Tembok Kualitas Rendah', 65, '2022-06-24 03:25:40', '2022-06-24 03:25:40'),
(9, 3, 'Kayu Kualitas Tinggi', 0, '2022-06-24 03:25:40', '2022-06-24 03:25:40'),
(10, 3, 'Kayu Kualitas Rendah', 80, '2022-06-24 03:25:40', '2022-06-24 03:25:40'),
(11, 3, 'Bambu', 100, '2022-06-24 03:25:40', '2022-06-24 03:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `siswas`
--

CREATE TABLE `siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ortu_id` bigint(20) UNSIGNED NOT NULL,
  `nisn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` enum('Teknik Kendaraan Ringan','Teknik Permesinan','Teknik Komputer Jaringan','Teknik Kimia Industri') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` enum('X','XI','XII') COLLATE utf8mb4_unicode_ci NOT NULL,
  `berkas_prestasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswas`
--

INSERT INTO `siswas` (`id`, `user_id`, `ortu_id`, `nisn`, `jk`, `jurusan`, `kelas`, `berkas_prestasi`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2523535', 'L', 'Teknik Kendaraan Ringan', 'X', '562_PXL_20220302_022916265.PORTRAIT_2.jpg', '2022-06-24 04:34:38', '2022-06-24 04:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `siswa__prestasis`
--

CREATE TABLE `siswa__prestasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `prestasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa__prestasis`
--

INSERT INTO `siswa__prestasis` (`id`, `siswa_id`, `prestasi`, `created_at`, `updated_at`) VALUES
(1, 1, 'makan', '2022-06-24 04:34:38', '2022-06-24 04:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `tanggungans`
--

CREATE TABLE `tanggungans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tanggungan_anaks`
--

CREATE TABLE `tanggungan_anaks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tanggungan_anaks`
--

INSERT INTO `tanggungan_anaks` (`id`, `jumlah`, `nilai`, `created_at`, `updated_at`) VALUES
(1, '0', 0, '2022-06-24 03:25:40', '2022-06-24 03:25:40'),
(2, '1 Anak', 50, '2022-06-24 03:25:40', '2022-06-24 03:25:40'),
(3, '2 - 4 Anak', 75, '2022-06-24 03:25:40', '2022-06-24 03:25:40'),
(4, '> 4 Anak', 100, '2022-06-24 03:25:40', '2022-06-24 03:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `ternaks`
--

CREATE TABLE `ternaks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ternaks`
--

INSERT INTO `ternaks` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Sapi', '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(2, 'Kerbau', '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(3, 'Kuda', '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(4, 'Kambing', '2022-06-24 03:25:39', '2022-06-24 03:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `ternak_details`
--

CREATE TABLE `ternak_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ternak_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ternak_details`
--

INSERT INTO `ternak_details` (`id`, `ternak_id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tidak memiliki', 100, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(2, 1, '1 ekor', 80, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(3, 1, '2 ekor', 60, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(4, 1, '3 - 5 ekor', 40, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(5, 1, '5 - 10 ekor', 20, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(6, 1, '> 10 ekor', 0, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(7, 2, 'Tidak memiliki', 100, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(8, 2, '1 ekor', 80, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(9, 2, '2 ekor', 60, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(10, 2, '3 - 5 ekor', 40, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(11, 2, '5 - 10 ekor', 20, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(12, 2, '> 10 ekor', 0, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(13, 3, 'Tidak memiliki', 100, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(14, 3, '1 ekor', 80, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(15, 3, '2 ekor', 60, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(16, 3, '3 - 5 ekor', 40, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(17, 3, '5 - 10 ekor', 20, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(18, 3, '> 10 ekor', 0, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(19, 4, 'Tidak memiliki', 100, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(20, 4, '1 ekor', 80, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(21, 4, '2 ekor', 60, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(22, 4, '3 - 5 ekor', 40, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(23, 4, '5 - 10 ekor', 20, '2022-06-24 03:25:39', '2022-06-24 03:25:39'),
(24, 4, '> 10 ekor', 0, '2022-06-24 03:25:39', '2022-06-24 03:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ryan', 'ryan@gmail.com', NULL, '$2y$10$OCRYkvf5SI3QU.eOiKcSmuQ.6qeUA78EieWeEsTSC3v4f4VnRP3rC', NULL, '2022-06-24 03:25:38', '2022-06-24 03:25:38'),
(2, 'tyas', 'tyas@gmail.com', NULL, '$2y$10$gsnlnVlcu4nTvh8R51KpbuP/DtkeekW3grpYJ5r26xnVyCsRc9fIq', NULL, '2022-06-24 03:25:38', '2022-06-24 03:25:38'),
(3, 'rokhim', 'rokhim@gmail.com', NULL, '$2y$10$UhPGT/7u1KWpzYg1DbEezulnZvyys/Vv2w/5/qrWeMCf2DGkn90cG', NULL, '2022-06-24 03:25:38', '2022-06-24 03:25:38'),
(4, 'Michel Jordan', 'Michel Jordan@gmail.com', NULL, '$2y$10$CXPyi2jLnPoaYSG0TTyOou2Pfq3bWKLJr0KsekOZqPjP1Cui9SOMa', NULL, '2022-06-24 04:34:37', '2022-06-24 04:34:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets_details`
--
ALTER TABLE `assets_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assets_details_assets_id_foreign` (`assets_id`);

--
-- Indexes for table `asuransis`
--
ALTER TABLE `asuransis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jenis_beasiswas`
--
ALTER TABLE `jenis_beasiswas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_beasiswas_user_id_foreign` (`user_id`);

--
-- Indexes for table `kondisi_rumahs`
--
ALTER TABLE `kondisi_rumahs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kondisi_rumahs_admin_id_foreign` (`admin_id`),
  ADD KEY `kondisi_rumahs_ortu_id_foreign` (`ortu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orang_tuas`
--
ALTER TABLE `orang_tuas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orang_tuas_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pendaftars`
--
ALTER TABLE `pendaftars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendaftars_user_id_foreign` (`user_id`),
  ADD KEY `pendaftars_siswa_id_foreign` (`siswa_id`),
  ADD KEY `pendaftars_ortu_id_foreign` (`ortu_id`),
  ADD KEY `pendaftars_periode_id_foreign` (`periode_id`);

--
-- Indexes for table `penghasilans`
--
ALTER TABLE `penghasilans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penilaians`
--
ALTER TABLE `penilaians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaians_siswa_id_foreign` (`siswa_id`),
  ADD KEY `penilaians_penghasilan_id_foreign` (`penghasilan_id`),
  ADD KEY `penilaians_tanggungan_id_foreign` (`tanggungan_id`),
  ADD KEY `penilaians_asuransi_id_foreign` (`asuransi_id`);

--
-- Indexes for table `penilaian_details`
--
ALTER TABLE `penilaian_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaian_details_penilaian_id_foreign` (`penilaian_id`),
  ADD KEY `penilaian_details_rumah_id_foreign` (`rumah_id`),
  ADD KEY `penilaian_details_assets_id_foreign` (`assets_id`),
  ADD KEY `penilaian_details_ternak_id_foreign` (`ternak_id`);

--
-- Indexes for table `periodes`
--
ALTER TABLE `periodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `periodes_user_id_foreign` (`user_id`),
  ADD KEY `periodes_beasiswa_id_foreign` (`beasiswa_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `rumahs`
--
ALTER TABLE `rumahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rumah_details`
--
ALTER TABLE `rumah_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rumah_details_rumah_id_foreign` (`rumah_id`);

--
-- Indexes for table `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswas_user_id_foreign` (`user_id`),
  ADD KEY `siswas_ortu_id_foreign` (`ortu_id`);

--
-- Indexes for table `siswa__prestasis`
--
ALTER TABLE `siswa__prestasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa__prestasis_siswa_id_foreign` (`siswa_id`);

--
-- Indexes for table `tanggungans`
--
ALTER TABLE `tanggungans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tanggungan_anaks`
--
ALTER TABLE `tanggungan_anaks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ternaks`
--
ALTER TABLE `ternaks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ternak_details`
--
ALTER TABLE `ternak_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ternak_details_ternak_id_foreign` (`ternak_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assets_details`
--
ALTER TABLE `assets_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `asuransis`
--
ALTER TABLE `asuransis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_beasiswas`
--
ALTER TABLE `jenis_beasiswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kondisi_rumahs`
--
ALTER TABLE `kondisi_rumahs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orang_tuas`
--
ALTER TABLE `orang_tuas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pendaftars`
--
ALTER TABLE `pendaftars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penghasilans`
--
ALTER TABLE `penghasilans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penilaians`
--
ALTER TABLE `penilaians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `penilaian_details`
--
ALTER TABLE `penilaian_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `periodes`
--
ALTER TABLE `periodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rumahs`
--
ALTER TABLE `rumahs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rumah_details`
--
ALTER TABLE `rumah_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa__prestasis`
--
ALTER TABLE `siswa__prestasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tanggungans`
--
ALTER TABLE `tanggungans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tanggungan_anaks`
--
ALTER TABLE `tanggungan_anaks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ternaks`
--
ALTER TABLE `ternaks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ternak_details`
--
ALTER TABLE `ternak_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assets_details`
--
ALTER TABLE `assets_details`
  ADD CONSTRAINT `assets_details_assets_id_foreign` FOREIGN KEY (`assets_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jenis_beasiswas`
--
ALTER TABLE `jenis_beasiswas`
  ADD CONSTRAINT `jenis_beasiswas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kondisi_rumahs`
--
ALTER TABLE `kondisi_rumahs`
  ADD CONSTRAINT `kondisi_rumahs_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kondisi_rumahs_ortu_id_foreign` FOREIGN KEY (`ortu_id`) REFERENCES `orang_tuas` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `orang_tuas`
--
ALTER TABLE `orang_tuas`
  ADD CONSTRAINT `orang_tuas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pendaftars`
--
ALTER TABLE `pendaftars`
  ADD CONSTRAINT `pendaftars_ortu_id_foreign` FOREIGN KEY (`ortu_id`) REFERENCES `orang_tuas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pendaftars_periode_id_foreign` FOREIGN KEY (`periode_id`) REFERENCES `periodes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pendaftars_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pendaftars_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penilaians`
--
ALTER TABLE `penilaians`
  ADD CONSTRAINT `penilaians_asuransi_id_foreign` FOREIGN KEY (`asuransi_id`) REFERENCES `asuransis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaians_penghasilan_id_foreign` FOREIGN KEY (`penghasilan_id`) REFERENCES `penghasilans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaians_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaians_tanggungan_id_foreign` FOREIGN KEY (`tanggungan_id`) REFERENCES `tanggungan_anaks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penilaian_details`
--
ALTER TABLE `penilaian_details`
  ADD CONSTRAINT `penilaian_details_assets_id_foreign` FOREIGN KEY (`assets_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_details_penilaian_id_foreign` FOREIGN KEY (`penilaian_id`) REFERENCES `penilaians` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_details_rumah_id_foreign` FOREIGN KEY (`rumah_id`) REFERENCES `rumahs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_details_ternak_id_foreign` FOREIGN KEY (`ternak_id`) REFERENCES `ternaks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `periodes`
--
ALTER TABLE `periodes`
  ADD CONSTRAINT `periodes_beasiswa_id_foreign` FOREIGN KEY (`beasiswa_id`) REFERENCES `jenis_beasiswas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `periodes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rumah_details`
--
ALTER TABLE `rumah_details`
  ADD CONSTRAINT `rumah_details_rumah_id_foreign` FOREIGN KEY (`rumah_id`) REFERENCES `rumahs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `siswas`
--
ALTER TABLE `siswas`
  ADD CONSTRAINT `siswas_ortu_id_foreign` FOREIGN KEY (`ortu_id`) REFERENCES `orang_tuas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `siswas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `siswa__prestasis`
--
ALTER TABLE `siswa__prestasis`
  ADD CONSTRAINT `siswa__prestasis_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ternak_details`
--
ALTER TABLE `ternak_details`
  ADD CONSTRAINT `ternak_details_ternak_id_foreign` FOREIGN KEY (`ternak_id`) REFERENCES `ternaks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
