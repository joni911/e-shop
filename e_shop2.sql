-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 07, 2022 at 07:01 AM
-- Server version: 10.5.8-MariaDB-log
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_shop2`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamat_users`
--

CREATE TABLE `alamat_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `katagori_barang_id` bigint(20) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `katagori_barang_id`, `nama`, `keterangan`, `harga`, `created_at`, `updated_at`, `deleted_at`, `deskripsi`) VALUES
(6, 1, 'UUD 45', 'nothing', '5000.00', '2022-01-02 22:36:41', '2022-01-02 22:36:41', NULL, 'After run above command, you can see created new file as bellow and you have to add new column for string, integer, timestamp and text data type as like bellow:'),
(7, 1, '123', '11', '100000.00', '2022-01-03 20:57:18', '2022-01-03 20:57:18', NULL, ''),
(8, 1, '123', '11', '100000.00', '2022-01-03 20:58:16', '2022-01-03 20:58:16', NULL, ''),
(9, 1, 'Belajar Baca 123', '11', '100000.00', '2022-01-03 21:00:42', '2022-03-16 22:49:08', NULL, '111'),
(10, 1, 'Kertas', '12', '119999.00', '2022-01-03 21:02:26', '2022-01-03 21:02:26', NULL, ''),
(11, 1, 'Kertas', '12', '119999.00', '2022-01-03 21:03:08', '2022-01-03 21:03:08', NULL, ''),
(12, 1, 'Kertas', '12', '119999.00', '2022-01-03 21:03:20', '2022-01-03 21:03:20', NULL, ''),
(13, 1, 'try', '10000 asda', '10000.00', '2022-01-03 21:56:41', '2022-01-03 21:56:41', NULL, ''),
(14, 1, 'try', '10000 asda', '10000.00', '2022-01-03 21:57:20', '2022-01-03 21:57:20', NULL, ''),
(15, 1, 'Cara membuat PKS', 'Buku untuk membuat pks', '10000.00', '2022-03-13 19:53:14', '2022-03-13 19:53:14', NULL, ''),
(16, 1, 'Buku 12', '10 x 1000', '1000.00', '2022-03-15 18:42:53', '2022-03-15 18:42:53', NULL, ''),
(17, 2, 'A4', '10000', '10000.00', '2022-03-15 19:01:37', '2022-03-15 19:01:37', NULL, ''),
(18, 2, 'i7', '1', '1.00', '2022-03-15 19:54:01', '2022-03-15 19:54:01', NULL, ''),
(19, 1, 'UUD 45', 'nothing', '5000.00', '2022-03-16 16:28:25', '2022-03-16 16:28:25', NULL, 'After run above command, you can see created new file as bellow and you have to add new column for string, integer, timestamp and text data type as like bellow:'),
(20, 1, 'Buku kelas 1', 'buku', '100000.00', '2022-03-16 20:08:49', '2022-03-16 20:08:49', NULL, 'buku des'),
(21, 1, 'Buku kelas 1', 'keterangan x', '1500.00', '2022-03-16 20:10:17', '2022-03-16 20:13:48', NULL, 'deskripsi y'),
(22, 2, 'Acer i3', '123', '100000.00', '2022-03-16 20:15:30', '2022-03-16 22:42:33', NULL, '123');

-- --------------------------------------------------------

--
-- Table structure for table `barang_photos`
--

CREATE TABLE `barang_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_photos`
--

INSERT INTO `barang_photos` (`id`, `barang_id`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 17, '2/images/2022/03/2/2-20220316032851.jpg', '2022-03-15 19:28:51', '2022-03-15 19:28:51', NULL),
(4, 17, '2/images/2022/03/2/2-20220316032930.jpg', '2022-03-15 19:29:30', '2022-03-15 19:29:30', NULL),
(5, 17, '2/images/2022/03/2/2-20220316032941.jpg', '2022-03-15 19:29:41', '2022-03-15 19:29:41', NULL),
(6, 17, '2/images/2022/03/2/2-20220316034005.jpg', '2022-03-15 19:40:05', '2022-03-15 19:40:05', NULL),
(7, 18, '2/images/2022/03/2/2-20220316035425.jpg', '2022-03-15 19:54:25', '2022-03-15 19:54:25', NULL),
(8, 6, '2/images/2022/03/2/2-20220316045449.png', '2022-03-15 20:54:49', '2022-03-15 20:54:49', NULL),
(9, 6, '2/images/2022/03/2/2-20220316050503.jpg', '2022-03-15 21:05:03', '2022-03-15 21:05:03', NULL),
(10, 6, '2/images/2022/03/2/2-20220316050509.jpg', '2022-03-15 21:05:09', '2022-03-15 21:05:09', NULL),
(11, 6, '2/images/2022/03/2/2-20220316050516.jpg', '2022-03-15 21:05:16', '2022-03-15 21:05:16', NULL),
(12, 6, '2/images/2022/03/2/2-20220316050528.png', '2022-03-15 21:05:28', '2022-03-15 21:05:28', NULL),
(13, 6, '2/images/2022/03/2/2-20220316050541.png', '2022-03-15 21:05:41', '2022-03-15 21:05:41', NULL),
(14, 21, '2/images/2022/03/2/2-20220317064151.jpeg', '2022-03-16 22:41:51', '2022-03-16 22:41:51', NULL),
(15, 21, '2/images/2022/03/2/2-20220317064158.png', '2022-03-16 22:41:58', '2022-03-16 22:41:58', NULL),
(16, 22, '2/images/2022/03/2/2-20220317064244.jpg', '2022-03-16 22:42:44', '2022-03-16 22:42:44', NULL),
(17, 22, '2/images/2022/03/2/2-20220317064254.jpeg', '2022-03-16 22:42:54', '2022-03-16 22:42:54', NULL),
(18, 9, '2/images/2022/03/2/2-20220317064915.png', '2022-03-16 22:49:15', '2022-03-16 22:49:15', NULL),
(19, 9, '2/images/2022/03/2/2-20220317064920.jpg', '2022-03-16 22:49:20', '2022-03-16 22:49:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deal_barangs`
--

CREATE TABLE `deal_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `harga` decimal(8,2) NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_orders`
--

CREATE TABLE `detail_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `barang_id` bigint(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembayarans`
--

CREATE TABLE `detail_pembayarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `pembayaran` decimal(8,2) NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `inventory_barangs`
--

CREATE TABLE `inventory_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_barangs`
--

INSERT INTO `inventory_barangs` (`id`, `barang_id`, `jumlah`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 10, '2022-01-02 22:36:41', '2022-01-02 22:36:41', NULL),
(2, 7, 11, '2022-01-03 20:57:18', '2022-01-03 20:57:18', NULL),
(3, 8, 11, '2022-01-03 20:58:16', '2022-01-03 20:58:16', NULL),
(4, 9, 10, '2022-01-03 21:00:42', '2022-03-16 22:50:38', NULL),
(5, 10, 123, '2022-01-03 21:02:26', '2022-01-03 21:02:26', NULL),
(6, 11, 123, '2022-01-03 21:03:08', '2022-01-03 21:03:08', NULL),
(7, 12, 123, '2022-01-03 21:03:20', '2022-01-03 21:03:20', NULL),
(8, 13, 10, '2022-01-03 21:56:41', '2022-01-03 21:56:41', NULL),
(9, 14, 10, '2022-01-03 21:57:20', '2022-01-03 21:57:20', NULL),
(10, 15, 1, '2022-03-13 19:53:14', '2022-03-13 19:53:14', NULL),
(11, 16, 10, '2022-03-15 18:42:53', '2022-03-15 18:42:53', NULL),
(12, 17, 10, '2022-03-15 19:01:37', '2022-03-15 19:01:37', NULL),
(13, 18, 1000000, '2022-03-15 19:54:01', '2022-03-15 19:54:01', NULL),
(14, 19, 0, '2022-03-16 16:28:25', '2022-03-16 16:28:25', NULL),
(15, 20, 10, '2022-03-16 20:08:49', '2022-03-16 20:08:49', NULL),
(16, 21, 0, '2022-03-16 20:10:17', '2022-03-16 22:41:38', NULL),
(17, 22, 1, '2022-03-16 20:15:30', '2022-03-16 22:42:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kontraks`
--

CREATE TABLE `jenis_kontraks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_kontraks`
--

INSERT INTO `jenis_kontraks` (`id`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kontrak Lumsum', '2022-03-20 16:53:26', '2022-03-20 16:53:26', NULL),
(2, 'Kontrak 2 File', '2022-03-27 22:48:10', '2022-03-27 22:48:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pengadaans`
--

CREATE TABLE `jenis_pengadaans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_pengadaans`
--

INSERT INTO `jenis_pengadaans` (`id`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Pekerjaan Konstruksi', '2022-03-17 23:22:17', '2022-03-17 23:22:17', NULL),
(4, 'Pengadaan Jasa Konstruksi', '2022-03-27 22:49:48', '2022-03-27 22:49:48', NULL),
(5, 'Pengadaan Alat Komputer', '2022-03-27 22:50:01', '2022-03-27 22:50:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `katagori_barangs`
--

CREATE TABLE `katagori_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `katagori_barangs`
--

INSERT INTO `katagori_barangs` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Buku', 'buku katagori', '2022-01-02 20:53:13', '2022-01-02 20:53:13', NULL),
(2, 'Laptop', 'Laptop untuk pegawai', '2022-01-02 20:54:43', '2022-01-02 20:54:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keranjangs`
--

CREATE TABLE `keranjangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sesi_belanja_id` bigint(20) NOT NULL,
  `barang_id` bigint(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang_users`
--

CREATE TABLE `keranjang_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total_belanja_user_id` bigint(20) NOT NULL,
  `barang_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komentars`
--

CREATE TABLE `komentars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `komentar` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komentars`
--

INSERT INTO `komentars` (`id`, `barang_id`, `user_id`, `komentar`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 2, 'komentar', '2022-03-16 01:05:27', '2022-03-16 01:05:27', NULL),
(2, 6, 2, 'jawaban', '2022-03-16 01:06:26', '2022-03-16 01:06:26', NULL),
(3, 6, 2, 'moood', '2022-03-16 01:36:38', '2022-03-16 01:36:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `metode_pengadaans`
--

CREATE TABLE `metode_pengadaans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metode_pengadaans`
--

INSERT INTO `metode_pengadaans` (`id`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pengadaan 1 File', '2022-03-20 16:53:43', '2022-03-20 16:53:43', NULL);

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
(5, '2021_12_17_050211_create_alamat_users_table', 1),
(6, '2021_12_17_050447_create_pembayaran_users_table', 1),
(7, '2021_12_17_050623_create_keranjang_users_table', 1),
(8, '2021_12_17_050647_create_total_belanja_users_table', 1),
(9, '2021_12_17_065207_create_barangs_table', 1),
(10, '2021_12_17_065254_create_inventory_barangs_table', 1),
(11, '2021_12_17_065331_create_katagori_barangs_table', 1),
(12, '2021_12_17_070341_create_deal_barangs_table', 1),
(13, '2021_12_17_071108_create_keranjangs_table', 1),
(14, '2021_12_17_071146_create_sesi_belanjas_table', 1),
(15, '2021_12_17_071222_create_orders_table', 1),
(16, '2021_12_17_071354_create_detail_orders_table', 1),
(17, '2021_12_17_071409_create_detail_pembayarans_table', 1),
(18, '2022_01_03_040939_drop_inventory_barang_id_to_barangs_table', 2),
(19, '2022_01_03_041447_drop_inventory_barang_id_to_barangs_table', 3),
(20, '2022_03_16_030251_barang_photos', 4),
(21, '2022_03_16_071550_add_deskripsi_to_barangs_table', 5),
(23, '2022_03_16_080714_komentar', 6),
(43, '2022_03_17_072617_tenders', 7),
(44, '2022_03_18_014920_tahapans', 7),
(45, '2022_03_18_015115_jenis_pengadaans', 7),
(46, '2022_03_18_015153_metode_pengadaans', 7),
(47, '2022_03_18_015218_jenis_kontraks', 7),
(48, '2022_03_18_020149_pesertas', 7),
(49, '2022_03_18_020236_syarats', 7),
(50, '2022_03_18_020252_syarat_details', 7),
(51, '2022_03_18_042634_perubahans', 7),
(52, '2022_03_18_044435_status_tenders', 7),
(53, '2022_03_20_141055_drop_paket', 8),
(54, '2022_03_21_064538_add_keterangan', 9),
(56, '2022_03_21_092725_edit_syarat', 10),
(57, '2022_03_31_110501_create_tender_files_table', 11),
(58, '2022_03_31_110506_create_tender_file_details_table', 11),
(60, '2022_04_07_045531_add_peserta_id_to_tender_file_details_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `detail_pembayaran_id` bigint(20) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `pembayaran_users`
--

CREATE TABLE `pembayaran_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `perubahans`
--

CREATE TABLE `perubahans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahapan_id` bigint(20) NOT NULL,
  `awal` date NOT NULL,
  `akhir` date NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perubahans`
--

INSERT INTO `perubahans` (`id`, `tahapan_id`, `awal`, `akhir`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '2022-03-21', '2022-03-25', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas viverra neque tellus, sit amet porttitor massa pharetra eu. Suspendisse potenti. Vivamus vel blandit ipsum. Pellentesque sollicitudin nulla sit amet ligula eleifend iaculis erat curae.', '2022-03-20 23:08:26', '2022-03-20 23:08:26', NULL),
(2, 1, '2022-03-21', '2022-03-25', 'nope', '2022-03-20 23:47:07', '2022-03-20 23:47:07', NULL),
(3, 2, '2022-03-28', '2022-03-22', '', '2022-03-21 00:02:36', '2022-03-21 00:02:36', NULL),
(4, 1, '2022-03-21', '2022-03-25', 'misc', '2022-03-21 00:03:13', '2022-03-21 00:03:13', NULL),
(5, 3, '2022-03-21', '2022-03-23', '', '2022-03-21 02:28:26', '2022-03-21 02:28:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pesertas`
--

CREATE TABLE `pesertas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tender_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `NPWP` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penawaran` double(19,2) NOT NULL,
  `harga_koreksi` double(19,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `nama_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesertas`
--

INSERT INTO `pesertas` (`id`, `tender_id`, `user_id`, `NPWP`, `penawaran`, `harga_koreksi`, `created_at`, `updated_at`, `deleted_at`, `nama_perusahaan`, `alamat`, `no_hp`) VALUES
(6, 1, 2, '1', 1.00, 0.00, '2022-04-06 21:00:42', '2022-04-06 21:00:42', NULL, 'PT X', '1', '1'),
(7, 1, 2, '1', 1.00, 0.00, '2022-04-06 21:01:19', '2022-04-06 21:01:19', NULL, 'PT Y', '1', '1'),
(8, 1, 2, '90', 90.00, 0.00, '2022-04-06 22:56:30', '2022-04-06 22:56:30', NULL, 'PT Z', '90', '90');

-- --------------------------------------------------------

--
-- Table structure for table `sesi_belanjas`
--

CREATE TABLE `sesi_belanjas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status_tenders`
--

CREATE TABLE `status_tenders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_tenders`
--

INSERT INTO `status_tenders` (`id`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dimulai', '2022-03-20 16:53:52', '2022-03-20 16:53:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `syarats`
--

CREATE TABLE `syarats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tender_id` bigint(20) NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `syarats`
--

INSERT INTO `syarats` (`id`, `tender_id`, `judul`, `created_at`, `updated_at`, `deleted_at`, `content`) VALUES
(1, 2, '123', '2022-03-21 01:41:40', '2022-03-21 01:41:40', NULL, '<h2><span style=\"background-color: rgb(255, 255, 0);\"><font color=\"#000000\">Summernote WYSIWYG Editor</font></span></h2><p>Summernote WYSIWYG editor comes \r\nwith foundational features that are necessary for content editing. \r\nImplementing Summernote in Laravel is easy, and you can edit multiple \r\nHTML elements simultaneously such as image, list items, titles, upload, \r\nanchor link, font family, bold, italic etc.</p><h3><span style=\"background-color: rgb(0, 255, 0);\">Summernote Features</span></h3><p>Theoretically,\r\n It comes with fully-loaded with features, we have conjugated a handful \r\nof features list that makes content editing flawless.</p> <div class=\"vdo-ads-wrapper ad-cls-block-580x250\"><div id=\"bsa-zone_1574377501661-3_123456\" class=\"bsa-ad\"></div></div><ul><li>Real-time Text Block Editing</li><li>Integration with Server</li><li>Rich Text Editing</li><li>Supports Bootstrap 3 to 4.x.x</li><li>Easy HTML Formatting</li><li>Smart User Interaction</li><li>Works in all Major Browsers: Safari, Chrome, Firefox, Opera, Edge and Internet Explorer 9+</li><li>Works in all Major Operating Systems: Linux, Windows and macOS</li><li>Lightweight (js+css: 100Kb)</li></ul><p></p>'),
(2, 2, 'SDM', '2022-03-21 01:55:43', '2022-03-21 01:55:43', NULL, '<p>Memiliki SDM Tenaga Ahli<br></p><table class=\"table table-sm table-bordered\" style=\"margin-top: 10px;\"><thead><tr><th>Jenis Keahlian</th><th>Keahlian/Spesifikasi</th><th>Pengalaman</th><th>Kemampuan Manajerial</th></tr></thead><tbody><tr><td>Tenaga Ahli Kelembagaan (Team Leader)</td><td>minimal magister (S-2) di bidang Kebijakan Publik/Teknik Lingkungan/Teknik Sipil</td><td>Pengalaman\r\n minimal selama 10 (sepuluh) tahun di bidang kelembagaan termasuk \r\ndiantaranya dibidang air minum minimal selama 2(dua) tahun dapat \r\ndibuktikan dengan surat referensi; b. Memiliki pengalaman memimpin tim \r\ndalam lingkup pekerjaan sektor air minum</td><td>-</td></tr><tr><td>Tenaga Ahli Air Minum</td><td>minimal magister (S-2) di bidang Teknik Sipil/Teknik Lingkungan/Teknik Perencanaan Wilayah dan Kota</td><td>Pengalaman\r\n minimal selama 10 (sepuluh) tahun di unit strategis/kegiatan bidang air\r\n minum dapat dibuktikan dengan surat referensi; b. Memiliki pengalaman \r\nminimal 5 tahun penyusunan kebijakan sektor air minum, termasuk memiliki\r\n pengalaman berkoordinasi dengan stakeholders dan mitra terkait</td><td>-</td></tr><tr><td>Tenaga Ahli Muda Komunikasi Publik / Masyarakat</td><td>minimal Sarjana S-1 di jurusan Ilmu Komunikasi / Hubungan Masyarakat</td><td>Pengalaman\r\n minimal selama 3 (tiga) tahun di bidang komunikasi dapat dibuktikan \r\ndengan surat referensi; b. Pengalaman bekerja mendukung program \r\npemerintah</td><td>-</td></tr><tr><td>Tenaga Ahli Muda Kelembagaan</td><td>minimal Sarjana S-1 di bidang Hukum/Administrasi Negara/Teknik Perencanaan Wilayah dan Kota/Teknik Lingkungan</td><td>Pengalaman minimal selama 3 (tiga) tahun, diutamakan di bidang pengelolaan air minum dapat dibuktikan dengan surat referensi</td><td>-</td></tr></tbody></table><br>'),
(3, 1, 'Syarat', '2022-03-21 02:05:21', '2022-03-21 02:27:18', NULL, '<p>Memiliki Pengalaman Pekerjaan:</p><ol><li>Pekerjaan di bidang Jasa \r\nKonsultansi paling kurang 1 pekerjaan dalam kurun waktu 1 (satu)  tahun \r\nterakhir baik di lingkungan pemerintah maupun swasta, termasuk \r\npengalaman subkontrak;</li><li>Pekerjaan yang sejenis berdasarkan jenis \r\npekerjaan, kompleksitas pekerjaan, metodologi, teknologi, atau \r\nkarakteristik lainnya yang bisa menggambarkan kesamaan, paling kurang 1 \r\npekerjaan dalam kurun waktu 3 (tiga) tahun terakhir baik di lingkungan \r\npemerintah maupun swasta, termasuk pengalaman subkontrak; dan</li><li>Nilai pekerjaan sejenis tertinggi dalam kurun waktu 10 (sepuluh) tahun \r\nterakhir paling kurang sama dengan 50% (lima puluh persen) nilai total \r\nHPS/Pagu Anggaran.</li><li>test hand<br></li><li>toast<br></li></ol>'),
(4, 1, 'SDM', '2022-03-21 02:27:41', '2022-03-21 02:27:41', NULL, '<p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><table role=\"table\"><thead><tr><th>Attribute</th><th>Description</th><th>Type</th><th>Default</th><th>Required</th></tr></thead><tbody><tr>\r\n<td>config</td>\r\n<td>Array with the plugin configuration parameters</td>\r\n<td>array</td>\r\n<td><code>[]</code></td>\r\n<td>no</td>\r\n</tr><tr><td>enable-old-support</td><td>Enable auto retrievement and filling with the submitted value in case of validation errors</td><td>any</td><td><code>null</code></td><td>no</td></tr></tbody></table>'),
(5, 2, 'GIT', '2022-03-21 02:29:08', '2022-03-21 02:29:08', NULL, '<h3>Required Plugin Configuration</h3>\r\n<p>To use this component you need to install and enable the required <a href=\"https://developer.snapappointments.com/bootstrap-select/\" rel=\"nofollow\">bootstrap-select</a> plugin. You can manually download and install the plugin locally on the <code>public/vendor/bootstrap-select/</code> folder. Please, note there is no artisan command to install this plugin.</p>\r\n<p>After installed on <code>public/vendor/bootstrap-select/</code> folder, you can use the next plugin configuration as a reference</p><p></p>');

-- --------------------------------------------------------

--
-- Table structure for table `syarat_details`
--

CREATE TABLE `syarat_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `syarat_id` bigint(20) NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tahapans`
--

CREATE TABLE `tahapans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tender_id` bigint(20) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mulai` date NOT NULL,
  `akhir` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tahapans`
--

INSERT INTO `tahapans` (`id`, `tender_id`, `nama`, `mulai`, `akhir`, `created_at`, `updated_at`, `deleted_at`, `keterangan`, `status`) VALUES
(1, 1, 'tahap pendaftaran', '2022-03-21', '2022-03-25', '2022-03-20 22:33:12', '2022-03-21 00:03:13', NULL, 'Pengujian sistem', 0),
(2, 1, 'Tahap Pemeriksaan Berkas', '2022-03-28', '2022-03-23', '2022-03-21 00:02:23', '2022-03-21 00:02:36', NULL, 'Kesalahan input', 0),
(3, 2, 'tahap pendaftaran', '2022-03-21', '2022-03-24', '2022-03-21 00:06:36', '2022-03-21 02:28:26', NULL, 'Penambahan 1 Hari', 0),
(4, 1, 'Pengumuman hasil pemeriksaan', '2022-04-01', '2022-04-07', '2022-04-05 17:34:32', '2022-04-05 17:34:32', NULL, '', 0),
(5, 1, 'Tahap Negosiasi Harga', '2022-04-07', '2022-04-14', '2022-04-05 17:35:24', '2022-04-05 17:35:24', NULL, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tenders`
--

CREATE TABLE `tenders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahapan_id` bigint(20) NOT NULL,
  `jenis_pegadaan_id` bigint(20) NOT NULL,
  `metode_pengadaan_id` bigint(20) NOT NULL,
  `jenis_kontrak_id` bigint(20) NOT NULL,
  `syarat_id` bigint(20) NOT NULL,
  `status_tender_id` bigint(20) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sumber_dana` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KLPD` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan_kerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_anggaran` date NOT NULL,
  `lokasi_pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `nilai_pagu` double(19,2) NOT NULL,
  `hps` double(19,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenders`
--

INSERT INTO `tenders` (`id`, `tahapan_id`, `jenis_pegadaan_id`, `metode_pengadaan_id`, `jenis_kontrak_id`, `syarat_id`, `status_tender_id`, `nama`, `sumber_dana`, `KLPD`, `satuan_kerja`, `tahun_anggaran`, `lokasi_pekerjaan`, `created_at`, `updated_at`, `deleted_at`, `nilai_pagu`, `hps`) VALUES
(1, 0, 3, 1, 1, 0, 1, 'Pengadaan Alat Kebersihan', 'apbd', 'bpr', 'itx', '2022-03-21', 'bangli', '2022-03-20 18:09:09', '2022-04-05 18:13:03', NULL, 1200000.00, 1000000.00),
(2, 0, 3, 1, 1, 0, 1, 'mobil', 'apbd', 'pemprov bangli', 'dishub', '2022-03-21', 'bangli', '2022-03-21 00:06:19', '2022-03-21 02:31:28', NULL, 1000000.00, 990000.00),
(3, 0, 3, 1, 2, 0, 1, 'Kertas', '1', '1', '1', '2022-03-29', '1', '2022-03-29 00:35:40', '2022-03-29 00:35:40', NULL, 10000000.00, 1000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `tender_files`
--

CREATE TABLE `tender_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tender_id` bigint(20) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tender_files`
--

INSERT INTO `tender_files` (`id`, `tender_id`, `nama`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'KTP', 'Kartu Tanda Penduduk', '2022-03-31 04:22:41', '2022-03-31 04:22:41'),
(2, 1, 'NPWP', 'NPWP', '2022-04-05 17:36:13', '2022-04-05 17:36:13');

-- --------------------------------------------------------

--
-- Table structure for table `tender_file_details`
--

CREATE TABLE `tender_file_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tender_file_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `files` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `peserta_id` bigint(20) NOT NULL,
  `tender_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tender_file_details`
--

INSERT INTO `tender_file_details` (`id`, `tender_file_id`, `user_id`, `files`, `keterangan`, `created_at`, `updated_at`, `deleted_at`, `peserta_id`, `tender_id`) VALUES
(5, 1, 2, '1649307642_Rekap Pendidikan Pegawai Apr(1).xlsx', '', '2022-04-06 21:00:42', '2022-04-06 21:00:42', NULL, 6, 1),
(6, 2, 2, '1649307642_Kajian_PC_Operator.docx', '', '2022-04-06 21:00:42', '2022-04-06 21:00:42', NULL, 6, 1),
(7, 1, 2, '1649307679_img20220405_14125680.pdf', '', '2022-04-06 21:01:19', '2022-04-06 21:01:19', NULL, 7, 1),
(8, 2, 2, '1649307679_WhatsApp Image 2022-04-05 at 9.10.20 AM.jpeg', '', '2022-04-06 21:01:19', '2022-04-06 21:01:19', NULL, 7, 1),
(9, 1, 2, 'Tender/FILE/1/1/1649314590_3. JUKNIS VPN TLKOM.doc', '', '2022-04-06 22:56:30', '2022-04-06 22:56:30', NULL, 8, 1),
(10, 2, 2, 'Tender/FILE/1/2/1649314590_109_REKRUTMEN_BDB_X_2021.doc', '', '2022-04-06 22:56:30', '2022-04-06 22:56:30', NULL, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `total_belanja_users`
--

CREATE TABLE `total_belanja_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'joni', 'joni@admin.com', NULL, '$2y$10$gzjA7907K3HXJYh69czHG.aL9Mvih9Mvb2YS9kSX9CCBGNi4FfC1i', NULL, '2021-12-29 03:27:36', '2021-12-29 03:27:36'),
(2, 'arta', 'artha699@gmail.com', NULL, '$2y$10$6WbhNXnrzZ/GXOWmvRU1uuTOkLb6QNVrWk8gRj9WqqSis/mBs9Yyq', NULL, '2022-01-02 17:04:07', '2022-01-02 17:04:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamat_users`
--
ALTER TABLE `alamat_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_photos`
--
ALTER TABLE `barang_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deal_barangs`
--
ALTER TABLE `deal_barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_orders`
--
ALTER TABLE `detail_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_pembayarans`
--
ALTER TABLE `detail_pembayarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventory_barangs`
--
ALTER TABLE `inventory_barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_kontraks`
--
ALTER TABLE `jenis_kontraks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_pengadaans`
--
ALTER TABLE `jenis_pengadaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `katagori_barangs`
--
ALTER TABLE `katagori_barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang_users`
--
ALTER TABLE `keranjang_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentars`
--
ALTER TABLE `komentars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metode_pengadaans`
--
ALTER TABLE `metode_pengadaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pembayaran_users`
--
ALTER TABLE `pembayaran_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `perubahans`
--
ALTER TABLE `perubahans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesertas`
--
ALTER TABLE `pesertas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sesi_belanjas`
--
ALTER TABLE `sesi_belanjas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_tenders`
--
ALTER TABLE `status_tenders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `syarats`
--
ALTER TABLE `syarats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `syarat_details`
--
ALTER TABLE `syarat_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahapans`
--
ALTER TABLE `tahapans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenders`
--
ALTER TABLE `tenders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tender_files`
--
ALTER TABLE `tender_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tender_file_details`
--
ALTER TABLE `tender_file_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `total_belanja_users`
--
ALTER TABLE `total_belanja_users`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `alamat_users`
--
ALTER TABLE `alamat_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `barang_photos`
--
ALTER TABLE `barang_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `deal_barangs`
--
ALTER TABLE `deal_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_orders`
--
ALTER TABLE `detail_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_pembayarans`
--
ALTER TABLE `detail_pembayarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_barangs`
--
ALTER TABLE `inventory_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jenis_kontraks`
--
ALTER TABLE `jenis_kontraks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jenis_pengadaans`
--
ALTER TABLE `jenis_pengadaans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `katagori_barangs`
--
ALTER TABLE `katagori_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keranjangs`
--
ALTER TABLE `keranjangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keranjang_users`
--
ALTER TABLE `keranjang_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komentars`
--
ALTER TABLE `komentars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `metode_pengadaans`
--
ALTER TABLE `metode_pengadaans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaran_users`
--
ALTER TABLE `pembayaran_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perubahans`
--
ALTER TABLE `perubahans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesertas`
--
ALTER TABLE `pesertas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sesi_belanjas`
--
ALTER TABLE `sesi_belanjas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_tenders`
--
ALTER TABLE `status_tenders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `syarats`
--
ALTER TABLE `syarats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `syarat_details`
--
ALTER TABLE `syarat_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahapans`
--
ALTER TABLE `tahapans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tenders`
--
ALTER TABLE `tenders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tender_files`
--
ALTER TABLE `tender_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tender_file_details`
--
ALTER TABLE `tender_file_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `total_belanja_users`
--
ALTER TABLE `total_belanja_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
