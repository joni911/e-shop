-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2022 at 06:42 PM
-- Server version: 10.5.17-MariaDB-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1294722_pengadaan`
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
-- Table structure for table `daftar_pesertas`
--

CREATE TABLE `daftar_pesertas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `tender_id` bigint(20) NOT NULL,
  `peserta_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daftar_pesertas`
--

INSERT INTO `daftar_pesertas` (`id`, `user_id`, `tender_id`, `peserta_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 6, 8, '2022-09-09 12:03:41', '2022-09-09 12:03:41', NULL),
(2, 2, 7, 8, '2022-09-09 16:13:18', '2022-09-09 16:13:18', NULL),
(3, 13, 7, 9, '2022-09-11 13:38:07', '2022-09-11 13:38:07', NULL),
(4, 20, 7, 10, '2022-09-12 15:06:34', '2022-09-12 15:06:34', NULL);

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
(2, 'Laptop', 'Laptop untuk pegawai', '2022-01-02 20:54:43', '2022-01-02 20:54:43', NULL),
(3, 'Jasa', '123', '2022-04-11 18:04:16', '2022-04-11 18:04:16', NULL);

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
-- Table structure for table `koreksis`
--

CREATE TABLE `koreksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tender_id` bigint(20) NOT NULL,
  `peserta_id` bigint(20) NOT NULL,
  `koreksi` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `managemens`
--

CREATE TABLE `managemens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peserta_id` bigint(20) NOT NULL,
  `tender_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_menjabat` date DEFAULT NULL,
  `tgl_berakhir` date DEFAULT NULL,
  `ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `NPWP` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `managemens`
--

INSERT INTO `managemens` (`id`, `peserta_id`, `tender_id`, `user_id`, `nama`, `tgl_menjabat`, `tgl_berakhir`, `ktp`, `alamat`, `NPWP`, `status`, `deleted_at`, `created_at`, `updated_at`, `file1`, `ket1`, `file2`, `ket2`, `file3`, `ket3`, `file4`, `ket4`, `file5`, `ket5`) VALUES
(1, 2, 4, 2, 'joni', '2022-08-02', '2022-08-31', '`12', '`12', '`12', 'Pemilik', NULL, '2022-08-02 01:02:26', '2022-08-02 01:02:26', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 9, 1, 13, 'q', '2021-08-10', '2021-08-10', 'a', 'a', 'a', 'Pemilik', NULL, '2022-09-11 13:37:45', '2022-09-11 13:37:45', 'Tender/FILE/9/1662903465_Jadwal Waktu Pelaksanaan(2).xlsx', '123', '', NULL, '', NULL, '', NULL, '', NULL);

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
(49, '2022_03_18_020236_syarats', 7),
(50, '2022_03_18_020252_syarat_details', 7),
(51, '2022_03_18_042634_perubahans', 7),
(52, '2022_03_18_044435_status_tenders', 7),
(53, '2022_03_20_141055_drop_paket', 8),
(54, '2022_03_21_064538_add_keterangan', 9),
(56, '2022_03_21_092725_edit_syarat', 10),
(57, '2022_03_31_110501_create_tender_files_table', 11),
(58, '2022_03_31_110506_create_tender_file_details_table', 11),
(61, '2022_04_24_071929_add_hak_akses_to_users_table', 13),
(62, '2022_05_04_134721_create_tender_komens_table', 14),
(63, '2022_05_05_142820_create_koreksis_table', 15),
(64, '2022_07_06_103320_create_pemenang_tenders_table', 15),
(66, '2022_07_07_214218_create_notifications_table', 15),
(74, '2022_07_12_113902_add_status_to_tender_file_details_table', 8),
(75, '2022_07_12_114105_create_tender_status_files_table', 16),
(76, '2022_03_18_020149_pesertas', 17),
(77, '2022_04_07_045531_add_peserta_id_to_tender_file_details_table', 17),
(78, '2022_07_21_152058_add_akta_to_pesertas_table', 18),
(79, '2022_07_25_152611_add_izin_to_pesertas_table', 18),
(81, '2022_07_28_113803_add_no_hp_to_pesertas_table', 19),
(82, '2022_07_28_113923_add_no_nama_npwp_to_pesertas_table', 20),
(83, '2022_07_28_110252_create_pengalaman_tenders_table', 21),
(84, '2022_07_28_130413_add_tender_id_to_pengalaman_tenders_table', 22),
(85, '2022_07_28_145553_add_user_id_to_pengalaman_tenders_table', 23),
(86, '2022_07_28_160255_add_nilai_kontrak_to_pengalaman_tenders_table', 24),
(87, '2022_07_28_164128_create_tenaga_ahlis_table', 25),
(88, '2022_07_31_224113_create_peralatans_table', 26),
(89, '2022_08_01_093851_create_pekerjaan_berjalans_table', 27),
(90, '2022_08_01_112938_create_managemens_table', 28),
(106, '2022_07_06_160728_create_pemeriksaans_table', 29),
(107, '2022_08_03_103841_create_validasi_files_table', 29),
(108, '2022_08_05_175542_add_kesimpulan_to_pemeriksaans_table', 30),
(109, '2022_08_09_144918_add_user_id_to_tenders_table', 31),
(110, '2022_08_18_082623_add_email_to_pesertas_table', 32),
(111, '2022_08_18_114445_add_default_to_tenders_table', 32),
(112, '2022_08_18_120459_create_daftar_pesertas_table', 32),
(113, '2022_08_20_121718_add_files_to_managemens_table', 32),
(114, '2022_08_21_214816_create_tender_persyaratans_table', 32),
(115, '2022_08_21_215126_create_tender_persyaratan_files_table', 32),
(116, '2022_08_22_161243_create_penawarans_table', 32),
(117, '2022_08_22_221854_create_penawaran_files_table', 32),
(118, '2022_08_22_221911_create_penawaran_pesertas_table', 32),
(119, '2022_08_22_221932_create_penawaran_peserta_files_table', 32),
(120, '2022_08_17_222921_add_unique_to_pesertas_table', 33);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('04777071-08fb-469b-b51d-c6b577045df1', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 13, '{\"project_id\":57}', NULL, '2022-07-11 04:03:07', '2022-07-11 04:03:07'),
('1a9515fb-3858-44ca-898d-20a09edc0152', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"project_id\":57}', NULL, '2022-08-09 01:31:12', '2022-08-09 01:31:12'),
('203a2152-2556-4e96-b99c-761a09771e3b', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 20, '{\"project_id\":57}', NULL, '2022-09-12 14:37:00', '2022-09-12 14:37:00'),
('2c2a5915-6fe9-48d2-abde-3d6f91732376', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 3, '{\"project_id\":57}', NULL, '2022-08-09 06:36:29', '2022-08-09 06:36:29'),
('2dc211e1-2147-4789-b644-45bf2ba6ae15', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"project_id\":57}', NULL, '2022-08-09 06:54:53', '2022-08-09 06:54:53'),
('2f7d2a20-ae00-44b5-a123-6058c5c29561', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"project_id\":57}', NULL, '2022-08-09 06:00:34', '2022-08-09 06:00:34'),
('54c2ed4f-97c9-4d9b-af74-88f236fa962c', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 3, '{\"project_id\":57}', NULL, '2022-08-09 03:05:29', '2022-08-09 03:05:29'),
('5674ece7-45e2-41e2-8625-3710e142d76d', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 3, '{\"project_id\":57}', NULL, '2022-08-09 01:50:06', '2022-08-09 01:50:06'),
('62b8c0e8-384d-4989-946b-5a9218e14d99', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 17, '{\"project_id\":57}', NULL, '2022-09-07 09:53:46', '2022-09-07 09:53:46'),
('750c3810-f7e4-49d4-93e1-de8eddc1bd9f', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"project_id\":57}', NULL, '2022-08-09 03:00:55', '2022-08-09 03:00:55'),
('75e6c7b7-231a-4f87-b212-403c031f9bce', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 20, '{\"project_id\":57}', NULL, '2022-09-12 15:38:13', '2022-09-12 15:38:13'),
('9994b3f0-ab69-46d1-bf9d-5666e53cea06', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 15, '{\"project_id\":57}', NULL, '2022-08-25 16:36:26', '2022-08-25 16:36:26'),
('9d22cbe9-566d-42c5-a896-aa7cc2e9b920', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 19, '{\"project_id\":57}', NULL, '2022-09-12 14:21:06', '2022-09-12 14:21:06'),
('a16fa7e6-1afc-4a80-84f9-7dbe0d9570fd', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"project_id\":57}', NULL, '2022-08-09 03:06:49', '2022-08-09 03:06:49'),
('bcc31614-b527-4ca0-95a7-3b64bcde9f5e', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 6, '{\"project_id\":57}', NULL, '2022-07-08 02:35:01', '2022-07-08 02:35:01'),
('c4dc4b8a-4099-4b27-bf8a-ea73f9c68d44', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"project_id\":57}', NULL, '2022-08-09 06:38:38', '2022-08-09 06:38:38'),
('c894063b-b750-41a3-9439-e98c81116b59', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 20, '{\"project_id\":57}', NULL, '2022-09-12 15:46:21', '2022-09-12 15:46:21'),
('e120db01-2365-4c3f-901c-168ec18e3b3f', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"project_id\":57}', NULL, '2022-08-09 01:28:53', '2022-08-09 01:28:53'),
('e3c3cf77-e3f0-48c9-9223-fb0f227f5199', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 3, '{\"project_id\":57}', NULL, '2022-08-09 06:39:24', '2022-08-09 06:39:24'),
('e9d82233-35eb-4b0d-8fd1-3f8ba33caf6f', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"project_id\":57}', NULL, '2022-08-09 06:31:55', '2022-08-09 06:31:55'),
('ebf81d68-01b7-4cc4-a710-f8ffe70c5a77', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"project_id\":57}', NULL, '2022-08-09 06:33:52', '2022-08-09 06:33:52'),
('f2bb12b5-b0f2-4456-92c3-7611e2a28032', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"project_id\":57}', NULL, '2022-08-09 01:29:36', '2022-08-09 01:29:36'),
('fa9a83d2-669f-4bb3-981c-498f7dad6c48', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 16, '{\"project_id\":57}', NULL, '2022-09-07 07:29:30', '2022-09-07 07:29:30');

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
-- Table structure for table `pekerjaan_berjalans`
--

CREATE TABLE `pekerjaan_berjalans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `tender_id` bigint(20) NOT NULL,
  `peserta_id` bigint(20) NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kontrak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_kontrak` date DEFAULT NULL,
  `presentasi` int(11) NOT NULL,
  `tgl_selesai_kontrak` date NOT NULL,
  `tgl_serah_terima` date NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_kontrak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pekerjaan_berjalans`
--

INSERT INTO `pekerjaan_berjalans` (`id`, `user_id`, `tender_id`, `peserta_id`, `pekerjaan`, `lokasi`, `instansi`, `alamat`, `no_hp`, `no_kontrak`, `tgl_kontrak`, `presentasi`, `tgl_selesai_kontrak`, `tgl_serah_terima`, `keterangan`, `nilai_kontrak`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 2, 'bpd pasang kaca', 'bangli', 'bangli', 'bangli', '085', '123/k/12/2021', '2022-08-01', 90, '2022-08-01', '2022-08-01', 'selesai', '1000000', NULL, '2022-08-01 03:07:09', '2022-08-01 03:07:09'),
(2, 3, 4, 4, '199', '199', '199', '199', '199', '199', '1999-12-09', 99, '1999-12-09', '1999-12-19', '99', '199', NULL, '2022-08-05 09:47:30', '2022-08-05 09:47:30'),
(3, 13, 1, 9, '2', '2', '2', '2', '2', '2', '2021-08-10', 2, '2023-10-12', '2023-10-12', 'a', '2', NULL, '2022-09-11 13:35:16', '2022-09-11 13:35:16');

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
-- Table structure for table `pemenang_tenders`
--

CREATE TABLE `pemenang_tenders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lelang_id` bigint(20) NOT NULL,
  `peserta_id` bigint(20) NOT NULL,
  `komentar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaans`
--

CREATE TABLE `pemeriksaans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `tender_id` bigint(20) NOT NULL,
  `peserta_id` bigint(20) NOT NULL,
  `pengalaman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kpengalaman` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenaga_ahli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ktenaga_ahli` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peralatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kperalatan` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_berjalan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kpekerjaan_berjalan` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `managemen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kmanagemen` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kfile` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kesimpulan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemeriksaans`
--

INSERT INTO `pemeriksaans` (`id`, `user_id`, `tender_id`, `peserta_id`, `pengalaman`, `kpengalaman`, `tenaga_ahli`, `ktenaga_ahli`, `peralatan`, `kperalatan`, `pekerjaan_berjalan`, `kpekerjaan_berjalan`, `managemen`, `kmanagemen`, `file`, `kfile`, `deleted_at`, `created_at`, `updated_at`, `kesimpulan`, `nilai`) VALUES
(1, 2, 4, 2, 'Lulus', '2', 'Lulus', 'Lulus', 'Lulus', '4', 'Lulus', '5', 'Lulus', '7', 'Lulus', '1', NULL, '2022-08-05 03:52:46', '2022-08-05 10:11:29', 'Lulus', 100),
(3, 2, 4, 4, 'Lulus', NULL, 'Lulus', 'Lulus', 'Lulus', NULL, 'Lulus', NULL, 'Tidak Lulus', 'Tidak memiliki Managemen', 'Lulus', 'file salah', NULL, '2022-08-05 09:49:17', '2022-08-05 10:08:11', 'Tidak Lulus', 83),
(4, 2, 4, 3, 'Lulus', NULL, 'Lulus', 'Lulus', 'Lulus', NULL, 'Lulus', '222', 'Lulus', '123', 'Lulus', NULL, NULL, '2022-08-09 00:24:54', '2022-08-09 02:28:35', 'Lulus', 100),
(5, 2, 1, 10, 'Lulus', '2', 'Lulus', 'Tidak Lulus', 'Lulus', '4', 'Lulus', '5', 'Lulus', '6', 'Lulus', '1', NULL, '2022-09-12 15:22:58', '2022-09-12 15:38:07', 'Lulus', 100);

-- --------------------------------------------------------

--
-- Table structure for table `penawarans`
--

CREATE TABLE `penawarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `tender_id` bigint(20) NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjelasan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hps` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penawarans`
--

INSERT INTO `penawarans` (`id`, `user_id`, `tender_id`, `judul`, `penjelasan`, `anggaran`, `hps`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 6, 'Penawaran', '<p>Detail<br></p>', '1000000', '900000', NULL, '2022-09-06 15:50:01', '2022-09-06 15:50:01'),
(2, 2, 7, 'Penawaran Pengadaan barang Jasa', '<p><strong>Persyaratan Kualifikasi Administrasi/Legalitas</strong></p><table class=\"table table-sm\"><tbody><tr><td>Memenuhi ketentuan peraturan perundang-undangan untuk menjalankan kegiatan/usaha.</td></tr><tr><td><table class=\"table table-sm\"><tbody><tr><td>Jenis Izin</td><td>Bidang Usaha/Sub Bidang Usaha/Klasifikasi/Sub Klasifikasi</td></tr><tr><td>SIUJK atau NIB</td><td>Bidang\r\n Sipil, sub bidang klasifikasi  Jasa Pelaksana Konstruksi Saluran Air, \r\nPelabuhan, Dam, dan Prasarana Sumber Daya Air Lainnya SI001  sub \r\nklasifikasi jasa pelaksana konstruksi jaringan Irigasi dan Drainase \r\nBS004, Kualifikasi Usaha Kecil</td></tr></tbody></table></td></tr><tr><td><div style=\"word-wrap: break-word;\">2. Peserta yang berbadan usaha harus memiliki Surat Ijin Usaha Jasa Konstruksi (IUJK)<br></div></td></tr><tr><td><div style=\"word-wrap: break-word;\">3.\r\n Memiliki Sertifikat Badan Usaha (SBU) dengan Kualifikasi Usaha Kecil \r\n[Kecil/Menengah/Besar], serta disyaratkan sub bidang klasifikasi/layanan\r\n SI001 atau BS004 [sesuai dengan sub bidang klasifikasi/layanan SBU yang\r\n dibutuhkan]<br></div></td></tr><tr><td><div style=\"word-wrap: break-word;\">6.\r\n Memiliki NPWP dan telah memenuhi kewajiban pelaporan perpajakan (SPT \r\nTahunan) tahun pajak 2021 [tuliskan tahun pajak yang diminta dengan \r\nmemperhatikan batas akhir pemasukan penawaran dan batas akhir pelaporan \r\npajak sesuai peraturan perpajakan]<br></div></td></tr><tr><td><div style=\"word-wrap: break-word;\">7. Memiliki akta pendirian perusahaan dan aktaperubahan perusahaan (apabila ada perubahan)<br></div></td></tr><tr><td><div style=\"word-wrap: break-word;\">8.\r\n Tidak masuk dalam Daftar Hitam, keikutsertaannya tidak menimbulkan \r\npertentangan kepentingan pihak yang terkait, tidak dalam pengawasan \r\npengadilan, tidak pailit, kegiatan usahanya tidak sedang dihentikan \r\ndan/atau yang bertindak untuk dan atas nama Badan Usaha tidak sedang \r\ndalam menjalani sanksi pidana, dan pengurus/pegawai tidak berstatus \r\nAparatur Sipil Negara, kecuali yang bersangkutan mengambil cuti di luar \r\ntanggungan Negara<br></div></td></tr><tr><td><div style=\"word-wrap: break-word;\">9.\r\n Memiliki pengalaman paling kurang 1 (satu) pekerjaan konstruksi dalam \r\nkurun waktu 4 (empat) tahun terakhir, baik di lingkungan pemerintah \r\nmaupun swasta termasuk pengalaman subkontrak, kecuali bagi pelaku usaha \r\nyang baru berdiri kurang dari 3 (tiga) tahun<br></div></td></tr><tr><td><div style=\"word-wrap: break-word;\">10.\r\n Memenuhi Sisa Kemampuan Paket (SKP)dengan perhitungan:SKP = 5 - P, \r\ndimana P adalah Paket pekerjaan yang sedang dikerjakan (hanya untuk \r\npeserta Kualifikasi Usaha Kecil)</div></td></tr></tbody></table>', '10000000', '9000000', NULL, '2022-09-09 15:53:03', '2022-09-09 15:53:03');

-- --------------------------------------------------------

--
-- Table structure for table `penawaran_files`
--

CREATE TABLE `penawaran_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `penawaran_id` bigint(20) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penawaran_files`
--

INSERT INTO `penawaran_files` (`id`, `user_id`, `penawaran_id`, `nama`, `keterangan`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'File 1', NULL, NULL, '2022-09-06 15:50:10', '2022-09-06 15:50:10'),
(2, 2, 2, 'Surat penawaran', NULL, NULL, '2022-09-09 15:54:50', '2022-09-09 15:54:50'),
(3, 2, 2, 'Jaminan Penawaran', NULL, NULL, '2022-09-09 15:55:10', '2022-09-09 15:55:10'),
(4, 2, 2, 'Jadwal Waktu Pelaksanaan', NULL, NULL, '2022-09-09 15:55:31', '2022-09-09 15:55:31'),
(5, 2, 2, 'Metode Kerja', NULL, NULL, '2022-09-09 15:55:46', '2022-09-09 15:55:46'),
(6, 2, 2, 'Personil Lapangan', NULL, NULL, '2022-09-09 15:55:57', '2022-09-09 15:55:57'),
(7, 2, 2, 'Peralatan', NULL, NULL, '2022-09-09 15:56:04', '2022-09-09 15:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `penawaran_pesertas`
--

CREATE TABLE `penawaran_pesertas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `tender_id` bigint(20) NOT NULL,
  `peserta_id` bigint(20) NOT NULL,
  `penawaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `koreksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penawaran_pesertas`
--

INSERT INTO `penawaran_pesertas` (`id`, `user_id`, `tender_id`, `peserta_id`, `penawaran`, `koreksi`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 2, 7, 8, '100000', '0', NULL, '2022-09-11 13:50:43', '2022-09-11 13:50:43'),
(3, 20, 7, 10, '8500000', '0', NULL, '2022-09-12 15:14:30', '2022-09-12 15:14:30');

-- --------------------------------------------------------

--
-- Table structure for table `penawaran_peserta_files`
--

CREATE TABLE `penawaran_peserta_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `penawaran_peserta_id` bigint(20) NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penawaran_peserta_files`
--

INSERT INTO `penawaran_peserta_files` (`id`, `user_id`, `penawaran_peserta_id`, `file`, `nama`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Tender/penawaran/7/2/1662741025_Surat penawaran.pdf', 'Surat penawaran', NULL, '2022-09-09 16:30:25', '2022-09-09 16:30:25'),
(2, 2, 1, 'Tender/penawaran/7/2/1662741025_Jaminan Penawaran.pdf', 'Jaminan Penawaran', NULL, '2022-09-09 16:30:25', '2022-09-09 16:30:25'),
(3, 2, 1, 'Tender/penawaran/7/2/1662741025_Jadwal Waktu Pelaksanaan.xlsx', 'Jadwal Waktu Pelaksanaan', NULL, '2022-09-09 16:30:25', '2022-09-09 16:30:25'),
(4, 2, 1, 'Tender/penawaran/7/2/1662741025_Metode Kerja.xlsx', 'Metode Kerja', NULL, '2022-09-09 16:30:25', '2022-09-09 16:30:25'),
(5, 2, 1, 'Tender/penawaran/7/2/1662741025_Personil Lapangan.xlsx', 'Personil Lapangan', NULL, '2022-09-09 16:30:25', '2022-09-09 16:30:25'),
(6, 2, 1, 'Tender/penawaran/7/2/1662741025_Peralatan.pdf', 'Peralatan', NULL, '2022-09-09 16:30:25', '2022-09-09 16:30:25'),
(7, 2, 2, 'Tender/penawaran/7/2/1662904243_Surat penawaran.sql', 'Surat penawaran', NULL, '2022-09-11 13:50:43', '2022-09-11 13:50:43'),
(8, 2, 2, 'Tender/penawaran/7/2/1662904243_Jaminan Penawaran.xlsx', 'Jaminan Penawaran', NULL, '2022-09-11 13:50:43', '2022-09-11 13:50:43'),
(9, 2, 2, 'Tender/penawaran/7/2/1662904243_Jadwal Waktu Pelaksanaan.pdf', 'Jadwal Waktu Pelaksanaan', NULL, '2022-09-11 13:50:43', '2022-09-11 13:50:43'),
(10, 2, 2, 'Tender/penawaran/7/2/1662904243_Metode Kerja.xlsx', 'Metode Kerja', NULL, '2022-09-11 13:50:43', '2022-09-11 13:50:43'),
(11, 2, 2, 'Tender/penawaran/7/2/1662904243_Personil Lapangan.xlsx', 'Personil Lapangan', NULL, '2022-09-11 13:50:43', '2022-09-11 13:50:43'),
(12, 2, 2, 'Tender/penawaran/7/2/1662904243_Peralatan.doc', 'Peralatan', NULL, '2022-09-11 13:50:43', '2022-09-11 13:50:43'),
(13, 20, 3, 'Tender/penawaran/7/20/1662992070_Surat penawaran.pdf', 'Surat penawaran', NULL, '2022-09-12 15:14:30', '2022-09-12 15:14:30'),
(14, 20, 3, 'Tender/penawaran/7/20/1662992070_Jaminan Penawaran.pdf', 'Jaminan Penawaran', NULL, '2022-09-12 15:14:30', '2022-09-12 15:14:30'),
(15, 20, 3, 'Tender/penawaran/7/20/1662992070_Jadwal Waktu Pelaksanaan.pdf', 'Jadwal Waktu Pelaksanaan', NULL, '2022-09-12 15:14:30', '2022-09-12 15:14:30'),
(16, 20, 3, 'Tender/penawaran/7/20/1662992070_Metode Kerja.pdf', 'Metode Kerja', NULL, '2022-09-12 15:14:30', '2022-09-12 15:14:30'),
(17, 20, 3, 'Tender/penawaran/7/20/1662992070_Personil Lapangan.pdf', 'Personil Lapangan', NULL, '2022-09-12 15:14:30', '2022-09-12 15:14:30'),
(18, 20, 3, 'Tender/penawaran/7/20/1662992070_Peralatan.pdf', 'Peralatan', NULL, '2022-09-12 15:14:30', '2022-09-12 15:14:30');

-- --------------------------------------------------------

--
-- Table structure for table `pengalaman_tenders`
--

CREATE TABLE `pengalaman_tenders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peserta_id` bigint(20) NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kontrak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_kontrak` date DEFAULT NULL,
  `presentasi` int(11) NOT NULL,
  `tgl_selesai_kontrak` date NOT NULL,
  `tgl_serah_terima` date NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tender_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `nilai_kontrak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengalaman_tenders`
--

INSERT INTO `pengalaman_tenders` (`id`, `peserta_id`, `pekerjaan`, `lokasi`, `instansi`, `alamat`, `no_hp`, `no_kontrak`, `tgl_kontrak`, `presentasi`, `tgl_selesai_kontrak`, `tgl_serah_terima`, `keterangan`, `deleted_at`, `created_at`, `updated_at`, `tender_id`, `user_id`, `nilai_kontrak`) VALUES
(6, 2, 'pekerjaan', 'instans', 'instansiA', 'alamat', '085', 'no kontra', '2023-08-29', 100, '2024-09-30', '2023-08-29', 'keterangan', NULL, '2022-07-28 08:27:21', '2022-07-28 08:27:21', 4, 2, '100000'),
(7, 2, '9', '9', '9', '9', '9', '9', '2023-09-29', 999, '2023-08-29', '2023-08-29', '9', NULL, '2022-07-28 08:30:46', '2022-07-28 08:30:46', 4, 2, '9'),
(8, 2, '99', '99', '99', '99', '99', '99', '9999-09-09', 9, '0009-09-09', '0009-09-09', '999', NULL, '2022-07-28 08:34:25', '2022-07-28 08:34:25', 4, 2, '99'),
(9, 2, 'n', 'n', 'n', 'n', '0888', 'n', '2023-08-29', 45, '2023-08-29', '2023-08-29', '9', NULL, '2022-07-28 08:35:36', '2022-07-28 08:35:36', 4, 2, '1000000'),
(10, 4, '127', '123', '123', '123', '123', '123', '1999-12-31', 11, '1999-12-12', '1299-12-12', '1239', NULL, '2022-08-05 09:44:40', '2022-08-05 09:44:40', 4, 3, '123'),
(11, 6, 'barang jasa', 'bangli', 'bank daerah bangli', 'bangli - bali', '081353991008', '102', '2022-09-30', 30, '2022-10-31', '2022-09-07', 'pembangunan selesai', NULL, '2022-09-07 10:11:25', '2022-09-07 10:11:25', 2, 17, '5001123123'),
(12, 9, 'p', 'a', 'a', 'a', '085', '085', '2021-08-10', 80, '2021-08-10', '2021-08-10', 'a', NULL, '2022-09-11 13:31:38', '2022-09-11 13:31:38', 1, 13, '100');

-- --------------------------------------------------------

--
-- Table structure for table `peralatans`
--

CREATE TABLE `peralatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `tender_id` bigint(20) NOT NULL,
  `peserta_id` bigint(20) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kepemilikan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peralatans`
--

INSERT INTO `peralatans` (`id`, `user_id`, `tender_id`, `peserta_id`, `nama`, `jumlah`, `kapasitas`, `merk`, `tahun`, `kondisi`, `lokasi`, `kepemilikan`, `bukti`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 2, 'GPS', '1', NULL, 'merek', '2022', 'Baik', 'dps', 'Sewa', 'kwitansi sewa', NULL, '2022-08-01 01:09:22', '2022-08-01 01:09:22'),
(2, 3, 4, 4, 'printer', '1', '1', 'epson', '2022', 'Baik', 'bangli', 'Sewa', 'kwitansi', NULL, '2022-08-05 09:46:13', '2022-08-05 09:46:13'),
(3, 13, 1, 9, 'ary', '1', '1', '1', '1', 'Baik', '1', 'Sewa', '1', NULL, '2022-09-11 13:33:49', '2022-09-11 13:33:49');

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
(5, 3, '2022-03-21', '2022-03-23', '', '2022-03-21 02:28:26', '2022-03-21 02:28:26', NULL),
(6, 7, '2022-07-25', '2022-07-29', '', '2022-07-25 03:41:15', '2022-07-25 03:41:15', NULL),
(7, 12, '2022-09-05', '2022-09-09', '', '2022-09-07 10:32:40', '2022-09-07 10:32:40', NULL),
(8, 16, '2022-09-09', '2022-09-09', '', '2022-09-09 15:28:02', '2022-09-09 15:28:02', NULL),
(9, 16, '2022-09-09', '2022-09-09', 'Menjadi Masa Pendaftaran', '2022-09-09 15:29:12', '2022-09-09 15:29:12', NULL),
(10, 18, '2022-09-11', '2022-09-11', '', '2022-09-09 15:29:53', '2022-09-09 15:29:53', NULL),
(11, 19, '2022-09-10', '2022-09-10', '', '2022-09-09 15:30:37', '2022-09-09 15:30:37', NULL),
(12, 16, '2022-09-09', '2022-09-10', 'Menjadi Masa Pendaftaran', '2022-09-09 16:08:47', '2022-09-09 16:08:47', NULL),
(13, 19, '2022-09-11', '2022-09-11', 'Perubahan jenis', '2022-09-09 16:24:49', '2022-09-09 16:24:49', NULL),
(14, 19, '2022-09-10', '2022-09-11', 'Perubahan jenis', '2022-09-09 16:27:45', '2022-09-09 16:27:45', NULL),
(15, 16, '2022-09-09', '2022-09-10', 'Menjadi Masa Pendaftaran', '2022-09-11 12:40:13', '2022-09-11 12:40:13', NULL),
(16, 19, '2022-09-10', '2022-09-11', 'Perubahan jenis', '2022-09-11 12:40:38', '2022-09-11 12:40:38', NULL),
(17, 16, '2022-09-09', '2022-09-11', 'Menjadi Masa Pendaftaran', '2022-09-12 14:23:58', '2022-09-12 14:23:58', NULL),
(18, 17, '2022-09-09', '2022-09-10', '', '2022-09-12 14:24:46', '2022-09-12 14:24:46', NULL),
(19, 19, '2022-09-10', '2022-09-12', 'Perubahan jenis', '2022-09-12 14:25:02', '2022-09-12 14:25:02', NULL),
(20, 16, '2022-09-12', '2022-09-12', 'Menjadi Masa Pendaftaran', '2022-09-12 14:50:13', '2022-09-12 14:50:13', NULL),
(21, 17, '2022-09-12', '2022-09-12', 'pemajuan tanggal', '2022-09-12 14:50:57', '2022-09-12 14:50:57', NULL),
(22, 18, '2022-09-10', '2022-09-10', 'Perbaikan Jadwal', '2022-09-12 14:51:25', '2022-09-12 14:51:25', NULL),
(23, 19, '2022-09-13', '2022-09-13', 'Perubahan jenis', '2022-09-12 14:51:53', '2022-09-12 14:51:53', NULL),
(24, 16, '2022-09-01', '2022-09-03', 'Menjadi Masa Pendaftaran', '2022-09-12 14:54:03', '2022-09-12 14:54:03', NULL),
(25, 16, '2022-09-01', '2022-09-03', 'Menjadi Masa Pendaftaran', '2022-09-12 15:04:53', '2022-09-12 15:04:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pesertas`
--

CREATE TABLE `pesertas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tender_id` bigint(20) NOT NULL,
  `NPWP` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penawaran` double(19,2) NOT NULL,
  `harga_koreksi` double(19,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `notaris` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_akta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_akta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notaris_b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_aktab` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_aktab` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kswp_npwp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kswp_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `izin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_izin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `izin_berlaku` date DEFAULT NULL,
  `instansi_pemberi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kualifikasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `klasifikasi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_npwp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesertas`
--

INSERT INTO `pesertas` (`id`, `tender_id`, `NPWP`, `penawaran`, `harga_koreksi`, `created_at`, `updated_at`, `deleted_at`, `notaris`, `no_akta`, `tgl_akta`, `notaris_b`, `no_aktab`, `tgl_aktab`, `kswp_npwp`, `kswp_nama`, `izin`, `nomor_izin`, `izin_berlaku`, `instansi_pemberi`, `kualifikasi`, `klasifikasi`, `nama_pt`, `no_hp`, `alamat`, `nama_npwp`, `email`, `user_id`) VALUES
(8, 1, 'P123', 0.00, 0.00, '2022-09-07 14:10:57', '2022-09-11 13:56:26', NULL, '9', '1', '2021-08-06', '123', '1', '2021-08-06', '123', 'PT.KONINDO PANORAMA KONSULTAN', 'PT YYY', '123', '2021-08-06', '9', '9', '565', 'PT.KONINDO PANORAMA KONSULTAN', '08221', 'jl merdeka no 27', '123', 'juni@bankpasarbangli.co.id', 2),
(9, 1, '1018101301.097-0', 0.00, 0.00, '2022-09-11 13:29:32', '2022-09-11 13:29:32', NULL, 'suamaya, sh', '123', '2021-08-10', 'suaraadnkn, sh', '1', '2023-08-10', '102108384', 'PT.KONINDO PANORAMA KONSULTAN', 'Sertifikat Badan Usaha (SBU)', '1212/andwlin/09390-/1323', '2022-09-11', '123', '123', '123', '123', '081353991008', 'qwe', 'x', 'artha699@gmail.com', 13),
(10, 1, '1200-1U319.9979-0', 0.00, 0.00, '2022-09-12 14:59:40', '2022-09-12 14:59:40', NULL, 'SUARMAYA, SH.', '10', '2022-01-01', 'SUARMAYA, SH.', '11', '2022-02-01', '018310398.20382083-04282987.000', 'PT MAJU JAYA', 'PT MAJU JAYA', '123/qwe/2022', '2022-12-01', 'DINAS PER. KAB.', 'SEHAT 09Q', 'pengdaaan barng dana jasa', 'PT MAJU JAYA', '081353991008', 'bangli-.', 'PT MAJU JAYA', 'sedanaartha909@gmail.com', 20);

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
(5, 2, 'GIT', '2022-03-21 02:29:08', '2022-03-21 02:29:08', NULL, '<h3>Required Plugin Configuration</h3>\r\n<p>To use this component you need to install and enable the required <a href=\"https://developer.snapappointments.com/bootstrap-select/\" rel=\"nofollow\">bootstrap-select</a> plugin. You can manually download and install the plugin locally on the <code>public/vendor/bootstrap-select/</code> folder. Please, note there is no artisan command to install this plugin.</p>\r\n<p>After installed on <code>public/vendor/bootstrap-select/</code> folder, you can use the next plugin configuration as a reference</p><p></p>'),
(6, 4, 'Persyatatan 1', '2022-07-25 03:42:51', '2022-07-25 03:42:51', NULL, '<p>ISI<br></p>'),
(7, 4, 'Persyatatan 2', '2022-07-25 03:43:02', '2022-07-25 03:43:02', NULL, '<p>ISI 2<br></p>'),
(8, 6, 'Persyaratan', '2022-09-06 15:48:32', '2022-09-06 15:48:32', NULL, '<p>Deskripsi Persyaratan<br></p>'),
(9, 7, 'Persyaratan Kualifikasi Administrasi/Legalitas', '2022-09-09 15:41:45', '2022-09-09 15:41:45', NULL, '<table class=\"table table-sm\"><tbody><tr><td>Memenuhi ketentuan peraturan perundang-undangan untuk menjalankan kegiatan/usaha.</td></tr><tr><td><table class=\"table table-sm\"><tbody><tr><td>Jenis Izin</td><td>Bidang Usaha/Sub Bidang Usaha/Klasifikasi/Sub Klasifikasi</td></tr><tr><td>SIUJK atau NIB</td><td>Bidang\r\n Sipil, sub bidang klasifikasi  Jasa Pelaksana Konstruksi Saluran Air, \r\nPelabuhan, Dam, dan Prasarana Sumber Daya Air Lainnya SI001  sub \r\nklasifikasi jasa pelaksana konstruksi jaringan Irigasi dan Drainase \r\nBS004, Kualifikasi Usaha Kecil</td></tr></tbody></table></td></tr><tr><td><div style=\"word-wrap: break-word;\">2. Peserta yang berbadan usaha harus memiliki Surat Ijin Usaha Jasa Konstruksi (IUJK)<br></div></td></tr><tr><td><div style=\"word-wrap: break-word;\">3.\r\n Memiliki Sertifikat Badan Usaha (SBU) dengan Kualifikasi Usaha Kecil \r\n[Kecil/Menengah/Besar], serta disyaratkan sub bidang klasifikasi/layanan\r\n SI001 atau BS004 [sesuai dengan sub bidang klasifikasi/layanan SBU yang\r\n dibutuhkan]<br></div></td></tr><tr><td><div style=\"word-wrap: break-word;\">6.\r\n Memiliki NPWP dan telah memenuhi kewajiban pelaporan perpajakan (SPT \r\nTahunan) tahun pajak 2021 [tuliskan tahun pajak yang diminta dengan \r\nmemperhatikan batas akhir pemasukan penawaran dan batas akhir pelaporan \r\npajak sesuai peraturan perpajakan]<br></div></td></tr><tr><td><div style=\"word-wrap: break-word;\">7. Memiliki akta pendirian perusahaan dan aktaperubahan perusahaan (apabila ada perubahan)<br></div></td></tr><tr><td><div style=\"word-wrap: break-word;\">8.\r\n Tidak masuk dalam Daftar Hitam, keikutsertaannya tidak menimbulkan \r\npertentangan kepentingan pihak yang terkait, tidak dalam pengawasan \r\npengadilan, tidak pailit, kegiatan usahanya tidak sedang dihentikan \r\ndan/atau yang bertindak untuk dan atas nama Badan Usaha tidak sedang \r\ndalam menjalani sanksi pidana, dan pengurus/pegawai tidak berstatus \r\nAparatur Sipil Negara, kecuali yang bersangkutan mengambil cuti di luar \r\ntanggungan Negara<br></div></td></tr><tr><td><div style=\"word-wrap: break-word;\">9.\r\n Memiliki pengalaman paling kurang 1 (satu) pekerjaan konstruksi dalam \r\nkurun waktu 4 (empat) tahun terakhir, baik di lingkungan pemerintah \r\nmaupun swasta termasuk pengalaman subkontrak, kecuali bagi pelaku usaha \r\nyang baru berdiri kurang dari 3 (tiga) tahun<br></div></td></tr><tr><td><div style=\"word-wrap: break-word;\">10.\r\n Memenuhi Sisa Kemampuan Paket (SKP)dengan perhitungan:SKP = 5 - P, \r\ndimana P adalah Paket pekerjaan yang sedang dikerjakan (hanya untuk \r\npeserta Kualifikasi Usaha Kecil)</div></td></tr></tbody></table>');

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
(5, 1, 'Tahap Negosiasi Harga', '2022-04-07', '2022-04-14', '2022-04-05 17:35:24', '2022-04-05 17:35:24', NULL, '', 0),
(6, 1, 'Pengumuman', '2022-04-18', '2022-04-22', '2022-04-17 20:25:55', '2022-04-17 20:25:55', NULL, '', 0),
(7, 4, 'Pendaftaran', '2022-07-25', '2022-07-29', '2022-07-25 03:34:05', '2022-07-25 03:41:15', NULL, 'typo', 0),
(8, 4, 'Seleksi', '2022-08-01', '2022-08-05', '2022-07-25 03:42:04', '2022-07-25 03:42:04', NULL, '', 0),
(9, 4, 'Pengumuman', '2022-08-08', '2022-08-12', '2022-07-25 03:42:26', '2022-07-25 03:42:26', NULL, '', 0),
(10, 5, 'Pendaftaran', '2022-08-15', '2022-08-16', '2022-08-14 05:42:15', '2022-08-14 05:42:15', NULL, '', 0),
(11, 5, 'Penawaran', '2022-08-16', '2022-08-17', '2022-08-14 05:42:48', '2022-08-14 05:42:48', NULL, '', 0),
(12, 6, 'Pendaftaran Peserta', '2022-09-05', '2022-09-09', '2022-09-05 08:43:06', '2022-09-07 10:32:40', NULL, 'masa pendaftaran', 1),
(13, 6, 'Tahap Penyampaian  Informasi', '2022-09-06', '2022-09-06', '2022-09-05 11:14:43', '2022-09-05 11:14:43', NULL, '', 0),
(14, 6, 'Upload Penawaran', '2022-09-06', '2022-09-16', '2022-09-06 15:47:58', '2022-09-06 15:47:58', NULL, '', 4),
(15, 6, 'Pengumuman Pemenang', '2022-09-30', '2022-09-30', '2022-09-06 15:48:14', '2022-09-06 15:48:14', NULL, '', 3),
(16, 7, 'Pengumuman Pasca Kualifikasi', '2022-09-12', '2022-09-13', '2022-09-09 15:27:33', '2022-09-12 15:04:53', NULL, 'Menjadi Masa Pendaftaran', 1),
(17, 7, 'Download Dokuman Pemilihan', '2022-09-04', '2022-09-06', '2022-09-09 15:29:06', '2022-09-12 14:50:57', NULL, 'pemajuan tanggal', 0),
(18, 7, 'Pemberian Penjelasan', '2022-09-07', '2022-09-09', '2022-09-09 15:29:32', '2022-09-12 14:51:25', NULL, 'Perbaikan Jadwal', 0),
(19, 7, 'Upload Dokumen Penawaran', '2022-09-10', '2022-09-12', '2022-09-09 15:30:22', '2022-09-12 14:51:53', NULL, 'Perubahan jenis', 4),
(20, 7, 'Pembukaan Dokumen Penawaran', '2022-09-12', '2022-09-12', '2022-09-09 15:31:05', '2022-09-09 15:31:05', NULL, '', 2),
(21, 7, 'Evaluasi Administrasi, Kualifikasi, Teknis dan harga', '2022-09-12', '2022-09-12', '2022-09-09 15:31:39', '2022-09-09 15:31:39', NULL, '', 0),
(22, 7, 'Pembuktian Kualifikasi', '2022-09-13', '2022-09-13', '2022-09-09 15:32:07', '2022-09-09 15:32:07', NULL, '', 0),
(23, 7, 'Penentuan Pemenang', '2022-09-14', '2022-09-14', '2022-09-09 15:32:20', '2022-09-09 15:32:20', NULL, '', 0),
(24, 7, 'Pengumuman Pemenang', '2022-09-15', '2022-09-15', '2022-09-09 15:32:44', '2022-09-09 15:32:44', NULL, '', 0),
(25, 7, 'Masa Sanggah Banding', '2022-09-16', '2022-09-16', '2022-09-09 15:32:58', '2022-09-09 15:32:58', NULL, '', 0),
(26, 7, 'Surat Penunjukan Penyedia Barang /Jasa', '2022-09-17', '2022-09-17', '2022-09-09 15:33:32', '2022-09-09 15:33:32', NULL, '', 0),
(27, 7, 'Penandatanganan Kontrak', '2022-09-18', '2022-09-18', '2022-09-09 15:33:52', '2022-09-09 15:33:52', NULL, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tenaga_ahlis`
--

CREATE TABLE `tenaga_ahlis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peserta_id` bigint(20) NOT NULL,
  `tender_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `negara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengalaman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenaga_ahlis`
--

INSERT INTO `tenaga_ahlis` (`id`, `peserta_id`, `tender_id`, `user_id`, `nama`, `tgl_lahir`, `jk`, `alamat`, `negara`, `jabatan`, `pengalaman`, `email`, `keterangan`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 2, 'wayan', '1000-10-10', 'Laki - Laki', 'alamat', 'indo', 'jabatan', 'pengalaman', 'email@email.com', 'keterangan', NULL, '2022-08-01 01:08:53', '2022-08-01 01:08:53'),
(2, 4, 4, 3, 'wayan', '1991-10-10', 'Laki - Laki', '123', '123', '123', '12 tahun', '123@gmail.com', '123', NULL, '2022-08-05 09:45:14', '2022-08-05 09:45:14'),
(3, 9, 1, 13, 'a', '2022-09-11', 'Laki - Laki', 'as', 'as', 'as', 'as', 'artha699@gmail.com', 'as', NULL, '2022-09-11 13:32:44', '2022-09-11 13:32:44');

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
  `hps` double(19,2) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `default` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenders`
--

INSERT INTO `tenders` (`id`, `tahapan_id`, `jenis_pegadaan_id`, `metode_pengadaan_id`, `jenis_kontrak_id`, `syarat_id`, `status_tender_id`, `nama`, `sumber_dana`, `KLPD`, `satuan_kerja`, `tahun_anggaran`, `lokasi_pekerjaan`, `created_at`, `updated_at`, `deleted_at`, `nilai_pagu`, `hps`, `user_id`, `default`) VALUES
(1, 0, 3, 1, 1, 0, 1, 'Default', 'APBD', 'Bank Daerah Bangli', 'Umum SDM', '2022-03-21', 'Bangli', '2022-03-20 18:09:09', '2022-09-07 14:07:01', NULL, 1200000.00, 1000000.00, 2, 1),
(2, 0, 3, 1, 1, 0, 1, 'mobil', 'apbd', 'pemprov bangli', 'dishub', '2022-03-21', 'bangli', '2022-03-21 00:06:19', '2022-03-21 02:31:28', '2022-09-09 12:05:22', 1000000.00, 990000.00, 2, 0),
(3, 0, 3, 1, 2, 0, 1, 'Kertas', '1', '1', '1', '2022-03-29', '1', '2022-03-29 00:35:40', '2022-03-29 00:35:40', '2022-09-09 12:05:23', 10000000.00, 1000000.00, 2, 0),
(4, 0, 3, 1, 1, 0, 1, 'Kertas f4', 'APBD', '123', 'turt', '2022-07-25', 'bangli', '2022-07-25 03:32:53', '2022-07-25 03:33:25', '2022-09-09 12:05:24', 20.00, 15.00, 2, 0),
(5, 0, 3, 1, 1, 0, 1, 'Pembangunan Pagar Bank Pasar Bangli', 'Internal', 'BPR BANGLI', 'Umum', '2022-08-14', 'Bangli', '2022-08-14 05:41:32', '2022-08-14 05:41:32', '2022-09-09 12:05:54', 600000000.00, 590000000.00, 2, 0),
(6, 0, 3, 1, 1, 0, 1, 'Pembongkaran Tembok PT. BPR Bank Daerah Bangli Perseroda', 'Pendapatan Internal', 'PT. BPR Bank Daerah Bangli Perseroda', 'UMUM dan SDM', '2022-09-05', 'Jl. Merdeka No.27 Kawan, Kec. Bangli, Kabupaten Bangli, Bali 80614', '2022-09-05 08:42:30', '2022-09-05 08:42:30', NULL, 10000000.00, 9800000.00, 2, 0),
(7, 0, 3, 1, 1, 0, 1, 'Pembangunan Padmasana Bank Daerah Bangli', 'Pendapatan Internal', 'PT. BPR Bank Daerah Bangli Perseroda', 'UMUM dan SDM', '2021-08-08', 'Jl. Merdeka No.27 Kawan, Kec. Bangli, Kabupaten Bangli, Bali 80614', '2022-09-09 15:24:47', '2022-09-09 15:24:47', NULL, 100000000.00, 90000000.00, 2, 0);

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
(2, 1, 'NPWP', 'NPWP', '2022-04-05 17:36:13', '2022-04-05 17:36:13'),
(3, 2, 'IMG', 'File Foto', '2022-07-12 03:22:40', '2022-07-12 03:22:40'),
(4, 2, 'PDF', 'File PDF', '2022-07-12 03:22:51', '2022-07-12 03:22:51'),
(5, 2, 'Compressed File', 'File Compress Zip rar 7zip', '2022-07-12 03:23:24', '2022-07-12 03:23:24'),
(6, 4, 'KTP', 'KTP', '2022-07-25 03:43:11', '2022-07-25 03:43:11'),
(7, 4, 'NPWP', 'File NPWP Berupa JPG atau PNG', '2022-07-25 03:43:26', '2022-07-25 03:43:26'),
(8, 1, 'AKTA', 'AKTA PERUSAHAAN PERTAMA', '2022-08-14 05:25:53', '2022-08-14 05:25:53'),
(9, 1, 'AKTA TERBARU', 'Akta Terakhir Perusahaan', '2022-08-14 05:26:07', '2022-08-14 05:26:07'),
(10, 1, 'Izin Perusahaan', 'Upload Izin Perusahaan', '2022-08-14 05:26:23', '2022-08-14 05:26:23'),
(11, 1, 'KSWP', 'Bukti KSWP Perusahaan', '2022-08-14 05:26:46', '2022-08-14 05:26:46'),
(12, 5, 'AKTA TERBARU', 'AKTA PERUSAHAAN PERTAMA', '2022-08-14 05:43:10', '2022-08-14 05:43:10');

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
(5, 1, 2, 'Tender/FILE/6/1/1651726008_I WAYAN JUNI ARTA(2).xlsx', '', '2022-04-06 21:00:42', '2022-05-05 04:46:48', NULL, 6, 6),
(6, 2, 2, 'Tender/FILE/6/2/1651726008_JONI.pdf', '', '2022-04-06 21:00:42', '2022-05-05 04:46:48', NULL, 6, 6),
(7, 1, 2, '1649307679_img20220405_14125680.pdf', '', '2022-04-06 21:01:19', '2022-04-06 21:01:19', NULL, 7, 1),
(8, 2, 2, '1649307679_WhatsApp Image 2022-04-05 at 9.10.20 AM.jpeg', '', '2022-04-06 21:01:19', '2022-04-06 21:01:19', NULL, 7, 1),
(9, 1, 2, 'Tender/FILE/1/1/1649314590_3. JUKNIS VPN TLKOM.doc', '', '2022-04-06 22:56:30', '2022-04-06 22:56:30', NULL, 8, 1),
(10, 2, 2, 'Tender/FILE/1/2/1649314590_109_REKRUTMEN_BDB_X_2021.doc', '', '2022-04-06 22:56:30', '2022-04-06 22:56:30', NULL, 8, 1),
(11, 1, 2, 'Tender/FILE/9/1/1651726146_KTP.txt', '', '2022-05-04 01:08:34', '2022-05-05 04:49:06', NULL, 9, 9),
(12, 2, 2, 'Tender/FILE/9/2/1651726146_NPWP.txt', '', '2022-05-04 01:08:34', '2022-05-05 04:49:06', NULL, 9, 9),
(13, 1, 2, 'Tender/FILE/13/1/1651731887_data 1.txt', '', '2022-05-05 06:12:54', '2022-05-05 06:24:47', NULL, 13, 1),
(14, 2, 2, 'Tender/FILE/13/2/1651731253_NPWP.txt', '', '2022-05-05 06:12:54', '2022-05-05 06:14:13', NULL, 13, 1),
(15, 1, 3, 'Tender/FILE/14/1/1651732053_data 1.txt', '', '2022-05-05 06:25:52', '2022-05-05 06:27:33', NULL, 14, 1),
(16, 2, 3, 'Tender/FILE/14/2/1651731983_NPWP.txt', '', '2022-05-05 06:25:52', '2022-05-05 06:26:23', NULL, 14, 1),
(17, 1, 4, 'Tender/FILE/1/1/1656570772_KTP.txt', '', '2022-06-30 06:32:52', '2022-06-30 06:32:52', NULL, 15, 1),
(18, 2, 4, 'Tender/FILE/1/2/1656570772_NPWP.txt', '', '2022-06-30 06:32:52', '2022-06-30 06:32:52', NULL, 15, 1),
(19, 3, 2, 'Tender/FILE/2/3/1657596279_foto kantor(1).png', '', '2022-07-12 03:24:39', '2022-07-12 03:24:39', NULL, 18, 2),
(20, 4, 2, 'Tender/FILE/2/4/1657596279_Maret 16 2.pdf', '', '2022-07-12 03:24:39', '2022-07-12 03:24:39', NULL, 18, 2),
(21, 5, 2, 'Tender/FILE/2/5/1657596279_hetman_office_recove.rar', '', '2022-07-12 03:24:39', '2022-07-12 03:24:39', NULL, 18, 2),
(22, 3, 13, 'Tender/FILE/2/3/1657601030_WhatsApp Image 2022-03-09 at 7.09.40 AM.jpeg', '', '2022-07-12 04:43:50', '2022-07-12 04:43:50', NULL, 20, 2),
(23, 4, 13, 'Tender/FILE/2/4/1657601030_surat dukungan bpti bngli2.docx', '', '2022-07-12 04:43:50', '2022-07-12 04:43:50', NULL, 20, 2),
(24, 5, 13, 'Tender/FILE/2/5/1657601030_hetman_office_recove.rar', '', '2022-07-12 04:43:50', '2022-07-12 04:43:50', NULL, 20, 2),
(25, 6, 2, 'Tender/FILE/4/6/1658979732_VP ECASH.jpg', '', '2022-07-28 03:42:12', '2022-07-28 03:42:12', NULL, 1, 4),
(26, 7, 2, 'Tender/FILE/4/7/1658979732_CBS.pdf', '', '2022-07-28 03:42:12', '2022-07-28 03:42:12', NULL, 1, 4),
(27, 6, 2, 'Tender/FILE/2/6/1659316307_Logo_kementerian_keuangan_republik_indonesia.png', '', '2022-07-28 05:00:21', '2022-08-01 01:11:47', NULL, 2, 4),
(28, 7, 2, 'Tender/FILE/2/7/1659316307_Kualifikasi-120381113.pdf', '', '2022-07-28 05:00:21', '2022-08-01 01:11:47', NULL, 2, 4),
(29, 6, 3, 'Tender/FILE/4/6/1659683233_Surat_Tugas(1).pdf', '', '2022-08-05 07:07:13', '2022-08-05 07:07:13', NULL, 4, 4),
(30, 7, 3, 'Tender/FILE/4/7/1659683233_D.03-4021-7-2022-1203.pdf', '', '2022-08-05 07:07:13', '2022-08-05 07:07:13', NULL, 4, 4),
(31, 1, 2, 'Tender/FILE/1/1/1660451517_YANLY ANGELA - BERAWA - REV.04 - all.dwg', '', '2022-08-14 05:31:57', '2022-08-14 05:31:57', NULL, 5, 1),
(32, 2, 2, 'Tender/FILE/1/2/1660451517_Undangan MC-0 UHN Sugriwa001.pdf', '', '2022-08-14 05:31:57', '2022-08-14 05:31:57', NULL, 5, 1),
(33, 8, 2, 'Tender/FILE/1/8/1660451517_FA_ LAMPIRAN JUKNIS TPS3R - 2021.pdf', '', '2022-08-14 05:31:59', '2022-08-14 05:31:59', NULL, 5, 1),
(34, 9, 2, 'Tender/FILE/1/9/1660451519_KETUT DERAWAN.rar', '', '2022-08-14 05:32:01', '2022-08-14 05:32:01', NULL, 5, 1),
(35, 10, 2, 'Tender/FILE/1/10/1660451521_WhatsApp Image 2022-08-10 at 12.54.08.jpeg', '', '2022-08-14 05:32:01', '2022-08-14 05:32:01', NULL, 5, 1),
(36, 11, 2, 'Tender/FILE/1/11/1660451521_surat_22.pdf', '', '2022-08-14 05:32:01', '2022-08-14 05:32:01', NULL, 5, 1),
(37, 3, 17, 'Tender/FILE/2/3/1662541605_VB.jpg', '', '2022-09-07 10:06:45', '2022-09-07 10:06:45', NULL, 6, 2),
(38, 4, 17, 'Tender/FILE/2/4/1662541605_undangan hari ini.pdf', '', '2022-09-07 10:06:45', '2022-09-07 10:06:45', NULL, 6, 2),
(39, 5, 17, 'Tender/FILE/2/5/1662541605_LATIHAN2-20210608T104455Z-001.zip', '', '2022-09-07 10:06:45', '2022-09-07 10:06:45', NULL, 6, 2),
(40, 1, 2, 'Tender/FILE/1/1/1662559767_laporan_inventaris2022-09-07_20-42-54.xlsx', '', '2022-09-07 14:09:27', '2022-09-07 14:09:27', NULL, 7, 1),
(41, 2, 2, 'Tender/FILE/1/2/1662559767_LAPORAN PERJALANAN DINAS RBB.docx', '', '2022-09-07 14:09:27', '2022-09-07 14:09:27', NULL, 7, 1),
(42, 8, 2, 'Tender/FILE/1/8/1662559767_laporan_pengambilan_Perbulan2022-09.csv', '', '2022-09-07 14:09:27', '2022-09-07 14:09:27', NULL, 7, 1),
(43, 9, 2, 'Tender/FILE/1/9/1662559767_laporan_pengambilan_Perbulan2022-09.csv', '', '2022-09-07 14:09:27', '2022-09-07 14:09:27', NULL, 7, 1),
(44, 10, 2, 'Tender/FILE/1/10/1662559767_virtual_accounts(3).sql', '', '2022-09-07 14:09:27', '2022-09-07 14:09:27', NULL, 7, 1),
(45, 11, 2, 'Tender/FILE/1/11/1662559767_Daftar pengguanaan aplikasi pungutan PDL di atas 200 transaksi adalah 13 user.docx', '', '2022-09-07 14:09:27', '2022-09-07 14:09:27', NULL, 7, 1),
(46, 1, 2, 'Tender/FILE/1/1/1662559857_laporan_inventaris2022-09-07_20-42-54.xlsx', '', '2022-09-07 14:10:57', '2022-09-07 14:10:57', NULL, 8, 1),
(47, 2, 2, 'Tender/FILE/1/2/1662559857_LAPORAN PERJALANAN DINAS RBB.docx', '', '2022-09-07 14:10:57', '2022-09-07 14:10:57', NULL, 8, 1),
(48, 8, 2, 'Tender/FILE/1/8/1662559857_laporan_pengambilan_Perbulan2022-09.csv', '', '2022-09-07 14:10:57', '2022-09-07 14:10:57', NULL, 8, 1),
(49, 9, 2, 'Tender/FILE/8/9/1662741669_Surat penawaran.pdf', '', '2022-09-07 14:10:57', '2022-09-09 16:41:09', NULL, 8, 1),
(50, 10, 2, 'Tender/FILE/1/10/1662559857_virtual_accounts(3).sql', '', '2022-09-07 14:10:57', '2022-09-07 14:10:57', NULL, 8, 1),
(51, 11, 2, 'Tender/FILE/1/11/1662559857_Daftar pengguanaan aplikasi pungutan PDL di atas 200 transaksi adalah 13 user.docx', '', '2022-09-07 14:10:57', '2022-09-07 14:10:57', NULL, 8, 1),
(52, 1, 13, 'Tender/FILE/1/1/1662902972_Ascendance of a Bookworm_ Part 3 Adopted Daughter of an Archduke Volume 3.epub', '', '2022-09-11 13:29:32', '2022-09-11 13:29:32', NULL, 9, 1),
(53, 2, 13, 'Tender/FILE/1/2/1662902972_Jadwal Waktu Pelaksanaan(2).xlsx', '', '2022-09-11 13:29:32', '2022-09-11 13:29:32', NULL, 9, 1),
(54, 8, 13, 'Tender/FILE/1/8/1662902972_Surat penawaran.pdf', '', '2022-09-11 13:29:32', '2022-09-11 13:29:32', NULL, 9, 1),
(55, 9, 13, 'Tender/FILE/1/9/1662902972_RAB.xlsx', '', '2022-09-11 13:29:32', '2022-09-11 13:29:32', NULL, 9, 1),
(56, 10, 13, 'Tender/FILE/1/10/1662902972_LAPORAN PERJALANAN DINAS RBB.docx', '', '2022-09-11 13:29:32', '2022-09-11 13:29:32', NULL, 9, 1),
(57, 11, 13, 'Tender/FILE/1/11/1662902972_Surat penawaran.pdf', '', '2022-09-11 13:29:32', '2022-09-11 13:29:32', NULL, 9, 1),
(58, 1, 20, 'Tender/FILE/1/1/1662991180_WhatsApp Image 2022-08-30 at 17.14.05 lps.jpeg', '', '2022-09-12 14:59:40', '2022-09-12 14:59:40', NULL, 10, 1),
(59, 2, 20, 'Tender/FILE/1/2/1662991180_undangan hari ini.pdf', '', '2022-09-12 14:59:40', '2022-09-12 14:59:40', NULL, 10, 1),
(60, 8, 20, 'Tender/FILE/1/8/1662991180_RADIOGRAM PENGUATAN BUMD.pdf', '', '2022-09-12 14:59:40', '2022-09-12 14:59:40', NULL, 10, 1),
(61, 9, 20, 'Tender/FILE/1/9/1662991180_SurveiQuestion (8).pdf', '', '2022-09-12 14:59:40', '2022-09-12 14:59:40', NULL, 10, 1),
(62, 10, 20, 'Tender/FILE/1/10/1662991180_SurveiQuestion (7).pdf', '', '2022-09-12 14:59:40', '2022-09-12 14:59:40', NULL, 10, 1),
(63, 11, 20, 'Tender/FILE/1/11/1662991180_SurveiQuestion.pdf', '', '2022-09-12 14:59:40', '2022-09-12 14:59:40', NULL, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tender_komens`
--

CREATE TABLE `tender_komens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peserta_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `komentar` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tender_komens`
--

INSERT INTO `tender_komens` (`id`, `peserta_id`, `user_id`, `komentar`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 10, 2, 'dingin', NULL, '2022-05-04 15:58:53', '2022-05-04 15:58:53'),
(2, 10, 2, 'what', NULL, '2022-05-04 16:06:41', '2022-05-04 16:06:41'),
(3, 10, 2, 'the', NULL, '2022-05-04 16:52:31', '2022-05-04 16:52:31'),
(4, 10, 2, 'hell', NULL, '2022-05-04 16:52:40', '2022-05-04 16:52:40'),
(5, 10, 2, 'the', NULL, '2022-05-05 00:55:48', '2022-05-05 00:55:48'),
(6, 10, 2, 'kok bisa', NULL, '2022-05-05 00:56:08', '2022-05-05 00:56:08'),
(7, 10, 2, 'tgl 5', NULL, '2022-05-05 00:57:46', '2022-05-05 00:57:46'),
(8, 11, 2, 'tgl 5', NULL, '2022-05-05 00:59:56', '2022-05-05 00:59:56'),
(9, 10, 2, 'HEI', NULL, '2022-05-05 01:01:35', '2022-05-05 01:01:35'),
(10, 12, 3, '123', NULL, '2022-05-05 01:22:00', '2022-05-05 01:22:00'),
(11, 13, 2, 'halllo', NULL, '2022-05-05 09:12:28', '2022-05-05 09:12:28'),
(12, 13, 2, 'qwertyu', NULL, '2022-05-05 13:16:23', '2022-05-05 13:16:23'),
(13, 13, 2, '123 test', NULL, '2022-07-06 07:42:31', '2022-07-06 07:42:31'),
(14, 3, 2, '123', NULL, '2022-08-09 02:37:26', '2022-08-09 02:37:26'),
(15, 3, 2, '132', NULL, '2022-08-09 02:37:40', '2022-08-09 02:37:40'),
(16, 3, 3, '2222', NULL, '2022-08-09 02:38:02', '2022-08-09 02:38:02'),
(17, 3, 3, 'x', NULL, '2022-08-09 03:00:08', '2022-08-09 03:00:08'),
(18, 3, 3, 'x', NULL, '2022-08-09 03:00:50', '2022-08-09 03:00:50'),
(19, 3, 2, '{\"id\":18,\"peserta_id\":3,\"user_id\":3,\"komentar\":\"x\",\"deleted_at\":null,\"created_at\":\"2022-08-09T03:00:50.000000Z\",\"updated_at\":\"2022-08-09T03:00:50.000000Z\",\"pt\":\"PT 26\",\"user\":\"Joni\"} Selasa 9 Agustus 2022 11:00:50 x', NULL, '2022-08-09 03:05:21', '2022-08-09 03:05:21'),
(20, 3, 3, '1277', NULL, '2022-08-09 03:06:44', '2022-08-09 03:06:44'),
(21, 3, 2, '1277', NULL, '2022-08-09 06:00:14', '2022-08-09 06:00:14'),
(22, 3, 3, '1227', NULL, '2022-08-09 06:00:27', '2022-08-09 06:00:27'),
(23, 3, 3, 'email ke admin', NULL, '2022-08-09 06:31:47', '2022-08-09 06:31:47'),
(24, 3, 2, 'email dari admin', NULL, '2022-08-09 06:32:18', '2022-08-09 06:32:18'),
(25, 3, 3, 'joni email ke admin', NULL, '2022-08-09 06:33:40', '2022-08-09 06:33:40'),
(26, 3, 2, 'email dari admin ke user joni', NULL, '2022-08-09 06:36:23', '2022-08-09 06:36:23'),
(27, 3, 3, 'user mengirim email ke admin part 2', NULL, '2022-08-09 06:38:32', '2022-08-09 06:38:32'),
(28, 3, 2, 'admin mengirim email ke user part 2', NULL, '2022-08-09 06:39:16', '2022-08-09 06:39:16'),
(29, 3, 3, 'w2', NULL, '2022-08-09 06:54:47', '2022-08-09 06:54:47'),
(30, 5, 2, 'TEST', NULL, '2022-08-14 05:46:28', '2022-08-14 05:46:28'),
(31, 10, 2, 'tes pengadaan', NULL, '2022-09-12 15:46:18', '2022-09-12 15:46:18'),
(32, 10, 2, 'tes pengadaan', NULL, '2022-09-12 15:46:19', '2022-09-12 15:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `tender_persyaratans`
--

CREATE TABLE `tender_persyaratans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `tender_id` bigint(20) NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjelasan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tender_persyaratans`
--

INSERT INTO `tender_persyaratans` (`id`, `user_id`, `tender_id`, `judul`, `penjelasan`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 6, 'Persyaran Dan Dokumen', '<p>Detail Persyaratab<br></p>', NULL, '2022-09-06 15:49:17', '2022-09-06 15:49:17'),
(2, 2, 7, 'Persyaratan Kualifikasi Administrasi/Legalitas', '<p><strong>Persyaratan Kualifikasi Administrasi/Legalitas</strong></p><table class=\"table table-sm\"><tbody><tr><td>Memenuhi ketentuan peraturan perundang-undangan untuk menjalankan kegiatan/usaha.</td></tr><tr><td><table class=\"table table-sm\"><tbody><tr><td>Jenis Izin</td><td>Bidang Usaha/Sub Bidang Usaha/Klasifikasi/Sub Klasifikasi</td></tr><tr><td>SIUJK atau NIB</td><td>Bidang\r\n Sipil, sub bidang klasifikasi  Jasa Pelaksana Konstruksi Saluran Air, \r\nPelabuhan, Dam, dan Prasarana Sumber Daya Air Lainnya SI001  sub \r\nklasifikasi jasa pelaksana konstruksi jaringan Irigasi dan Drainase \r\nBS004, Kualifikasi Usaha Kecil</td></tr></tbody></table></td></tr><tr><td><div style=\"word-wrap: break-word;\">2. Peserta yang berbadan usaha harus memiliki Surat Ijin Usaha Jasa Konstruksi (IUJK)<br></div></td></tr><tr><td><div style=\"word-wrap: break-word;\">3.\r\n Memiliki Sertifikat Badan Usaha (SBU) dengan Kualifikasi Usaha Kecil \r\n[Kecil/Menengah/Besar], serta disyaratkan sub bidang klasifikasi/layanan\r\n SI001 atau BS004 [sesuai dengan sub bidang klasifikasi/layanan SBU yang\r\n dibutuhkan]<br></div></td></tr><tr><td><div style=\"word-wrap: break-word;\">6.\r\n Memiliki NPWP dan telah memenuhi kewajiban pelaporan perpajakan (SPT \r\nTahunan) tahun pajak 2021 [tuliskan tahun pajak yang diminta dengan \r\nmemperhatikan batas akhir pemasukan penawaran dan batas akhir pelaporan \r\npajak sesuai peraturan perpajakan]<br></div></td></tr><tr><td><div style=\"word-wrap: break-word;\">7. Memiliki akta pendirian perusahaan dan aktaperubahan perusahaan (apabila ada perubahan)<br></div></td></tr><tr><td><div style=\"word-wrap: break-word;\">8.\r\n Tidak masuk dalam Daftar Hitam, keikutsertaannya tidak menimbulkan \r\npertentangan kepentingan pihak yang terkait, tidak dalam pengawasan \r\npengadilan, tidak pailit, kegiatan usahanya tidak sedang dihentikan \r\ndan/atau yang bertindak untuk dan atas nama Badan Usaha tidak sedang \r\ndalam menjalani sanksi pidana, dan pengurus/pegawai tidak berstatus \r\nAparatur Sipil Negara, kecuali yang bersangkutan mengambil cuti di luar \r\ntanggungan Negara<br></div></td></tr><tr><td><div style=\"word-wrap: break-word;\">9.\r\n Memiliki pengalaman paling kurang 1 (satu) pekerjaan konstruksi dalam \r\nkurun waktu 4 (empat) tahun terakhir, baik di lingkungan pemerintah \r\nmaupun swasta termasuk pengalaman subkontrak, kecuali bagi pelaku usaha \r\nyang baru berdiri kurang dari 3 (tiga) tahun<br></div></td></tr><tr><td><div style=\"word-wrap: break-word;\">10.\r\n Memenuhi Sisa Kemampuan Paket (SKP)dengan perhitungan:SKP = 5 - P, \r\ndimana P adalah Paket pekerjaan yang sedang dikerjakan (hanya untuk \r\npeserta Kualifikasi Usaha Kecil)</div></td></tr></tbody></table>', NULL, '2022-09-09 15:42:25', '2022-09-09 15:42:25');

-- --------------------------------------------------------

--
-- Table structure for table `tender_persyaratan_files`
--

CREATE TABLE `tender_persyaratan_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `tender_persyaratan_id` bigint(20) NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tender_persyaratan_files`
--

INSERT INTO `tender_persyaratan_files` (`id`, `user_id`, `tender_persyaratan_id`, `file`, `nama`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Tender/Persyaratan/1/1662475770_File 1.docx', 'File 1', NULL, '2022-09-06 15:49:30', '2022-09-06 15:49:30'),
(2, 2, 2, 'Tender/Persyaratan/2/1662738493_Surat penawaran.docx', 'Surat penawaran', '2022-09-09 15:48:37', '2022-09-09 15:48:13', '2022-09-09 15:48:37'),
(3, 2, 2, 'Tender/Persyaratan/2/1662738512_Jaminan Penawaran.doc', 'Jaminan Penawaran', '2022-09-09 15:48:41', '2022-09-09 15:48:32', '2022-09-09 15:48:41'),
(4, 2, 2, 'Tender/Persyaratan/2/1662738585_Surat penawaran.pdf', 'Surat penawaran', NULL, '2022-09-09 15:49:45', '2022-09-09 15:49:45'),
(5, 2, 2, 'Tender/Persyaratan/2/1662738610_Jaminan Penawaran.pdf', 'Jaminan Penawaran', NULL, '2022-09-09 15:50:10', '2022-09-09 15:50:10'),
(6, 2, 2, 'Tender/Persyaratan/2/1662738631_RAB.xlsx', 'RAB', NULL, '2022-09-09 15:50:31', '2022-09-09 15:50:31'),
(7, 2, 2, 'Tender/Persyaratan/2/1662738706_Jadwal Waktu Pelaksanaan.xlsx', 'Jadwal Waktu Pelaksanaan', NULL, '2022-09-09 15:51:46', '2022-09-09 15:51:46'),
(8, 2, 2, 'Tender/Persyaratan/2/1662738718_Metode Kerja.doc', 'Metode Kerja', NULL, '2022-09-09 15:51:58', '2022-09-09 15:51:58'),
(9, 2, 2, 'Tender/Persyaratan/2/1662738728_Personil Lapangan.docx', 'Personil Lapangan', NULL, '2022-09-09 15:52:08', '2022-09-09 15:52:08'),
(10, 2, 2, 'Tender/Persyaratan/2/1662738737_Peralatan.xlsx', 'Peralatan', NULL, '2022-09-09 15:52:17', '2022-09-09 15:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `tender_status_files`
--

CREATE TABLE `tender_status_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `hak_akses` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `hak_akses`) VALUES
(1, 'joni', 'joni@admin.com', NULL, '$2y$10$gzjA7907K3HXJYh69czHG.aL9Mvih9Mvb2YS9kSX9CCBGNi4FfC1i', NULL, '2021-12-29 03:27:36', '2021-12-29 03:27:36', 'user'),
(2, 'arta', 'artha699@gmail.com', '2022-10-23 12:42:36', '$2y$10$6WbhNXnrzZ/GXOWmvRU1uuTOkLb6QNVrWk8gRj9WqqSis/mBs9Yyq', 'ikhrLZHHo7Vg7I1fW8qCh58CZZtrjGOkrwtqRY36fEGSKqTPtIc4Ya8svhSz', '2022-01-02 17:04:07', '2022-10-23 12:42:36', 'admin'),
(3, 'Joni', 'joni1277@eay.jp', NULL, '$2y$10$yB7f2UPHTSDLIaO7LGtiKuSmOql1hfqXo/AhgVzI/Rkhw1JI8B2rq', NULL, '2022-04-23 23:23:37', '2022-04-23 23:23:37', 'user'),
(4, 'wayan', 'pokego.jon002@gmail.com', NULL, '$2y$10$DOotmntnUHQ/heaUzpB/UeaTbqBhBKeJPFbwXnDjISv5s9tlf/b/C', NULL, '2022-06-30 06:31:37', '2022-06-30 06:31:37', 'user'),
(5, 'Jonwn', 'jonwn@sika3.com', NULL, '$2y$10$PDobAAgxFMQavy1M6pgau.fF1a3IVKexAPLqYxL5mr847qvJAkEf6', NULL, '2022-07-08 02:26:09', '2022-07-08 02:26:09', 'user'),
(6, 'napoliman', 'napoliman@kmail.li', NULL, '$2y$10$Fazp0Tz743JJvb0RYPb2Q.gGuZ7u4LsTsOLDshPmkSD4QrA1MNbKO', NULL, '2022-07-08 02:34:55', '2022-07-08 02:34:55', 'user'),
(7, 'nfam kun', 'nfaam@fuwamofu.com', NULL, '$2y$10$li9wmq1hv2xVhNG3AX5m6exBzsI5NS6oAecZ1peYTgbQA01LwoeSq', NULL, '2022-07-08 02:48:14', '2022-07-08 02:48:14', 'user'),
(8, 'jonicat', 'joni@lovelycats.org', NULL, '$2y$10$x8QVl8BzUJXYC4yuDQZ/ZOyKOZV/SyelBzc7TH.6sb3fQFV/hvPj6', NULL, '2022-07-08 02:50:09', '2022-07-08 02:50:09', 'user'),
(9, 'prime', 'gaenangcangamazonprimede@kpay.be', NULL, '$2y$10$v64r/uWi7ic6DOHCC/mW6eu4aiW.zKWdb2YonGTgpRN4fJwOGGUyq', NULL, '2022-07-08 02:51:05', '2022-07-08 02:51:05', 'user'),
(10, 'new user jon', '5877a2j@choco.la', NULL, '$2y$10$U9cwVQERkZJo3Rq.mb8WQ.bZFZyAjV.EJ1xyFuRAtn6mDBzo2t9mK', NULL, '2022-07-11 03:55:29', '2022-07-11 03:55:29', 'user'),
(13, 'eay mulyanan', 'egbmd@tapi.re', NULL, '$2y$10$0Rpc7jVhv3EO39qC4b6MGOKcP6vRY.AuwnRJ3.2oNysodkMazE5Lm', NULL, '2022-07-11 04:02:59', '2022-07-11 04:02:59', 'user'),
(14, 'nurfatra', 'nurfatra@yahoo.com', NULL, '$2y$10$kWnOamu63ZN8HHb.kLY75uYRaY5iQusJMQ8O6WS3TYkeNynwIUaCq', NULL, '2022-08-14 05:17:47', '2022-08-14 05:17:47', 'user'),
(15, 'ebox', 'e_shop@mbox.re', NULL, '$2y$10$Zn133uUhy4wtN8QU.0jR/.AP7gORGZEZb/.66ugtvYFQDp3lUKTZG', NULL, '2022-08-25 16:36:21', '2022-08-25 16:36:21', 'user'),
(16, 'wayan joni', 'hm.joniartha@gmail.com', NULL, '$2y$10$/0MVED4BAk1loU4hK2d4R.ffvsw4NutQq0hgpc19558ngyzdXQuEG', NULL, '2022-09-07 07:29:24', '2022-09-07 07:29:24', 'user'),
(17, 'i komang sedana artha', 'artha@bankpasar.co.id', NULL, '$2y$10$qCBDj4O6bYOdhUeiGKUgPOuM47.BR7MrkCT805mhyKZsU249el/Qe', NULL, '2022-09-07 09:53:44', '2022-09-07 09:53:44', 'user'),
(18, 'random generate', 'h9jmadd@neko2.net', NULL, '$2y$10$N2vfeg431qOF2nPMHmXtI.7Fp9gXlwby2ZGeCSJ9G0.rqg5CLP81W', NULL, '2022-09-11 14:15:49', '2022-09-11 14:15:49', 'user'),
(19, 'qs', 'joni@quicksend.ch', NULL, '$2y$10$o9ufrOsVACXN25wdqk//k.VJ9a8WQLxgAnxpfyHLCLhjIhqQYVW9u', NULL, '2022-09-12 14:21:01', '2022-09-12 14:21:01', 'user'),
(20, 'sedana', 'sedanaartha909@gmail.com', NULL, '$2y$10$QV9q.j5esyv5SZYfegffuu6I1zKjyJqsBWa3bJpAqlXIXhSQ8OeFi', NULL, '2022-09-12 14:36:58', '2022-09-12 14:36:58', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `validasi_files`
--

CREATE TABLE `validasi_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tender_file_detail_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `validasi_files`
--

INSERT INTO `validasi_files` (`id`, `tender_file_detail_id`, `user_id`, `status`, `keterangan`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 29, 2, 'Tidak Setuju', 'file bukan ktp', NULL, '2022-08-05 09:48:30', '2022-08-05 09:48:30'),
(2, 30, 2, 'Tidak Setuju', 'bukan npwp', NULL, '2022-08-05 09:48:46', '2022-08-05 09:48:46');

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
-- Indexes for table `daftar_pesertas`
--
ALTER TABLE `daftar_pesertas`
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
-- Indexes for table `koreksis`
--
ALTER TABLE `koreksis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managemens`
--
ALTER TABLE `managemens`
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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
-- Indexes for table `pekerjaan_berjalans`
--
ALTER TABLE `pekerjaan_berjalans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran_users`
--
ALTER TABLE `pembayaran_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemenang_tenders`
--
ALTER TABLE `pemenang_tenders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemeriksaans`
--
ALTER TABLE `pemeriksaans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pemeriksaans_peserta_id_unique` (`peserta_id`);

--
-- Indexes for table `penawarans`
--
ALTER TABLE `penawarans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penawarans_tender_id_unique` (`tender_id`);

--
-- Indexes for table `penawaran_files`
--
ALTER TABLE `penawaran_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penawaran_pesertas`
--
ALTER TABLE `penawaran_pesertas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penawaran_pesertas_peserta_id_unique` (`peserta_id`);

--
-- Indexes for table `penawaran_peserta_files`
--
ALTER TABLE `penawaran_peserta_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengalaman_tenders`
--
ALTER TABLE `pengalaman_tenders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peralatans`
--
ALTER TABLE `peralatans`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pesertas_user_id_unique` (`user_id`);

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
-- Indexes for table `tenaga_ahlis`
--
ALTER TABLE `tenaga_ahlis`
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
-- Indexes for table `tender_komens`
--
ALTER TABLE `tender_komens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tender_persyaratans`
--
ALTER TABLE `tender_persyaratans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tender_persyaratans_tender_id_unique` (`tender_id`);

--
-- Indexes for table `tender_persyaratan_files`
--
ALTER TABLE `tender_persyaratan_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tender_status_files`
--
ALTER TABLE `tender_status_files`
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
-- Indexes for table `validasi_files`
--
ALTER TABLE `validasi_files`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `validasi_files_tender_file_detail_id_unique` (`tender_file_detail_id`);

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
-- AUTO_INCREMENT for table `daftar_pesertas`
--
ALTER TABLE `daftar_pesertas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `koreksis`
--
ALTER TABLE `koreksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `managemens`
--
ALTER TABLE `managemens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `metode_pengadaans`
--
ALTER TABLE `metode_pengadaans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pekerjaan_berjalans`
--
ALTER TABLE `pekerjaan_berjalans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran_users`
--
ALTER TABLE `pembayaran_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemenang_tenders`
--
ALTER TABLE `pemenang_tenders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemeriksaans`
--
ALTER TABLE `pemeriksaans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penawarans`
--
ALTER TABLE `penawarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penawaran_files`
--
ALTER TABLE `penawaran_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penawaran_pesertas`
--
ALTER TABLE `penawaran_pesertas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penawaran_peserta_files`
--
ALTER TABLE `penawaran_peserta_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pengalaman_tenders`
--
ALTER TABLE `pengalaman_tenders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `peralatans`
--
ALTER TABLE `peralatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perubahans`
--
ALTER TABLE `perubahans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pesertas`
--
ALTER TABLE `pesertas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `syarat_details`
--
ALTER TABLE `syarat_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahapans`
--
ALTER TABLE `tahapans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tenaga_ahlis`
--
ALTER TABLE `tenaga_ahlis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tenders`
--
ALTER TABLE `tenders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tender_files`
--
ALTER TABLE `tender_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tender_file_details`
--
ALTER TABLE `tender_file_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tender_komens`
--
ALTER TABLE `tender_komens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tender_persyaratans`
--
ALTER TABLE `tender_persyaratans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tender_persyaratan_files`
--
ALTER TABLE `tender_persyaratan_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tender_status_files`
--
ALTER TABLE `tender_status_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `total_belanja_users`
--
ALTER TABLE `total_belanja_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `validasi_files`
--
ALTER TABLE `validasi_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
