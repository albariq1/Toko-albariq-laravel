-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2022 at 12:41 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_toko_albariq`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `pemasok_id` bigint(20) UNSIGNED NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satuan` enum('Pcs','Kg') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `nama_barang`, `kategori_id`, `pemasok_id`, `barcode`, `satuan`, `created_at`, `updated_at`) VALUES
(2, 'Lifeboy', 2, 2, '098767890', 'Pcs', '2022-06-16 13:25:14', '2022-06-16 13:25:14'),
(3, 'Frisian Flag Bendera Coklat 370g', 3, 3, '8992753102204', 'Pcs', '2022-07-01 16:48:57', '2022-07-01 16:48:57'),
(4, 'Frisian Flag Bendera Kental Manis 370g', 3, 3, '8992753101207', 'Pcs', '2022-07-01 16:50:03', '2022-07-01 16:50:03'),
(5, 'Frisian Flag Bendera Full Cream Gold 370g', 3, 3, '8992753100101', 'Pcs', '2022-07-01 16:51:03', '2022-07-01 16:51:03'),
(6, 'Enaak Kental Manis Cokelat 370g', 3, 4, '8993007001465', 'Pcs', '2022-07-01 16:53:02', '2022-07-01 16:54:15'),
(7, 'Enaak Kental Manis 370g', 3, 4, '8992702000025', 'Pcs', '2022-07-01 16:53:58', '2022-07-01 16:53:58'),
(8, 'Nestle Carnation Krimer Kental Manis 495g', 3, 5, '8992696426528', 'Pcs', '2022-07-01 16:58:18', '2022-07-01 16:58:18'),
(9, 'Seiya Muaaanteb Sweetened Creamer 505g', 3, 6, '9555394503367', 'Pcs', '2022-07-01 17:00:42', '2022-07-01 17:00:42'),
(10, 'Frisian Flag Bendera Coklat 40g', 4, 3, '8992753102303', 'Pcs', '2022-07-01 17:02:36', '2022-07-01 17:02:36'),
(11, 'Frisian Flag Bendera Coklat 545g', 5, 3, '8992753004034', 'Pcs', '2022-07-01 17:04:34', '2022-07-01 17:04:34'),
(12, 'Indomilk Kental Manis Sweetened Condensed 545g', 5, 4, '8993007003902', 'Pcs', '2022-07-01 17:07:02', '2022-07-01 17:07:02'),
(13, 'Indomilk Swiss Choco 545g', 5, 4, '8993007003919', 'Pcs', '2022-07-01 17:08:00', '2022-07-01 17:08:00'),
(14, 'Ultra Milk Low Fat Source Of Calsium 1 Liter', 6, 7, '8998009010637', 'Pcs', '2022-07-01 17:16:11', '2022-07-01 17:16:11'),
(15, 'Ultra Milk Low Fat Source Of Calsium Rasa Coklat 1 Liter', 6, 7, '8998009011207', 'Pcs', '2022-07-01 17:17:17', '2022-07-01 17:17:17'),
(16, 'Ultra Milk Rasa Coklat 1 Liter', 6, 7, '8998009010620', 'Pcs', '2022-07-01 17:18:25', '2022-07-01 17:18:25'),
(17, 'Ultra Milk Full Cream 1 Liter', 6, 7, '8998009010613', 'Pcs', '2022-07-01 17:19:26', '2022-07-01 17:19:26'),
(18, 'Ultra Milk Rasa Stroberi 200 ml', 7, 7, '8998009010576', 'Pcs', '2022-07-01 17:21:17', '2022-07-01 17:21:17'),
(19, 'Ultra Milk Rasa Coklat 200 ml', 7, 7, '8998009010569', 'Pcs', '2022-07-01 17:22:25', '2022-07-01 17:22:25'),
(20, 'Ultra Milk Full Cream 200 ml', 7, 7, '8998009010552', 'Pcs', '2022-07-01 17:23:18', '2022-07-01 17:23:18'),
(21, 'Ultra Milk Rasa Stroberi 125 ml', 8, 7, '8998009010606', 'Pcs', '2022-07-01 17:25:17', '2022-07-01 17:25:17'),
(22, 'Ultra Milk Rasa Coklat 125 ml', 8, 7, '8998009010590', 'Pcs', '2022-07-01 17:27:14', '2022-07-01 17:27:14'),
(23, 'Nestle Milo 180 ml', 7, 5, '8992696523067', 'Pcs', '2022-07-01 17:28:46', '2022-07-01 17:28:46'),
(24, 'Nestle Milo 110 ml', 8, 5, '8992696523081', 'Pcs', '2022-07-01 17:29:37', '2022-07-01 17:29:37'),
(25, 'Glade Coffe', 9, 9, '89927020000121', 'Pcs', '2022-07-09 21:42:40', '2022-07-09 21:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualans`
--

CREATE TABLE `detail_penjualans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `penjualan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_pokok` double DEFAULT NULL,
  `harga_jual` double DEFAULT NULL,
  `jual_diskon` double DEFAULT NULL,
  `totalharga` double NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_penjualans`
--

INSERT INTO `detail_penjualans` (`id`, `barang_id`, `penjualan_id`, `jumlah`, `harga_pokok`, `harga_jual`, `jual_diskon`, `totalharga`, `status`, `tanggal_transaksi`, `user_id`, `created_at`, `updated_at`) VALUES
(21, 3, 19, 2, 20000, 22000, 0, 44000, '1', '2022-07-09', 5, '2022-07-09 03:54:47', '2022-07-09 03:54:54'),
(22, 3, 20, 3, 10000, 11000, 0, 33000, '1', '2022-07-10', 5, '2022-07-10 01:44:50', '2022-07-10 01:45:51'),
(23, 3, 23, 2, 20000, 21000, 0, 42000, '1', '2022-07-19', 5, '2022-07-19 02:34:28', '2022-07-19 02:35:02'),
(24, 10, 23, 1, 5000, 6000, 0, 6000, '1', '2022-07-19', 5, '2022-07-19 02:34:53', '2022-07-19 02:35:02');

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
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_katagori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_katagori`, `created_at`, `updated_at`) VALUES
(1, 'beras 5KG', '2022-06-16 13:21:49', '2022-06-16 13:21:49'),
(2, 'Sabun Mandi', '2022-06-16 13:24:55', '2022-06-16 13:24:55'),
(3, 'Susu Kental Manis Kaleng', '2022-07-01 16:47:49', '2022-07-01 16:47:49'),
(4, 'Susu Kental Manis Saset', '2022-07-01 17:01:38', '2022-07-01 17:01:38'),
(5, 'Susu Kental Manis Kemasan', '2022-07-01 17:03:37', '2022-07-01 17:03:37'),
(6, 'Susu UHT 1 Liter', '2022-07-01 17:14:11', '2022-07-01 17:14:11'),
(7, 'Susu UHT 200 ml', '2022-07-01 17:20:14', '2022-07-01 17:20:14'),
(8, 'Susu UHT 125 ml', '2022-07-01 17:24:09', '2022-07-01 17:24:09'),
(9, 'Parfume Mobil', '2022-07-09 21:40:33', '2022-07-09 21:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `kehilangan_barangs`
--

CREATE TABLE `kehilangan_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_hilang` int(11) NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_update_status` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kehilangan_barangs`
--

INSERT INTO `kehilangan_barangs` (`id`, `barang_id`, `user_id`, `jumlah_hilang`, `status`, `tgl_update_status`, `created_at`, `updated_at`) VALUES
(2, 25, 6, 1, '0', NULL, '2022-07-16 16:51:26', '2022-07-16 16:51:26');

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
(5, '2022_05_17_215809_add_foto_to_users_table', 1),
(6, '2022_05_26_182647_create_kategoris_table', 1),
(7, '2022_05_29_141658_create_pemasoks_table', 1),
(9, '2022_06_04_183336_create_barangs_table', 1),
(10, '2022_06_09_195149_create_pembelian_barangs_table', 1),
(11, '2022_06_16_194818_add_login_info_to_users_table', 1),
(12, '2022_06_16_195126_create_riwayat_logins_table', 1),
(20, '2022_05_29_153742_create_pelanggans_table', 2),
(25, '2022_06_16_202826_create_penjualan_barangs_table', 3),
(26, '2022_06_16_203244_create_detail_penjualans_table', 3),
(27, '2022_06_30_201201_add_user_id_to_penjualan_barangs_table', 4),
(29, '2022_07_08_115804_create_return_barangs_table', 5),
(31, '2022_07_09_092534_add_fields_to_detail_penjualans_table', 6),
(33, '2022_07_09_103152_update_enum_value_users', 7),
(35, '2022_07_09_110910_add_status_to_return_barangs_table', 8),
(37, '2022_07_16_132128_create_kehilangan_barangs_table', 9),
(38, '2022_07_16_140920_add_tgl_update_status_to_return_barangs_table', 10);

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
-- Table structure for table `pelanggans`
--

CREATE TABLE `pelanggans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggans`
--

INSERT INTO `pelanggans` (`id`, `nama_pelanggan`, `alamat`, `no_hp`, `created_at`, `updated_at`) VALUES
(1, 'ipan', 'soekarno hatta', '0823279797', '2022-06-22 19:37:37', '2022-06-22 19:37:37'),
(2, 'midun', 'puncak sekuning', '0829028210', '2022-06-22 19:37:58', '2022-06-22 19:37:58');

-- --------------------------------------------------------

--
-- Table structure for table `pemasoks`
--

CREATE TABLE `pemasoks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pemasok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemasoks`
--

INSERT INTO `pemasoks` (`id`, `nama_pemasok`, `alamat`, `no_hp`, `created_at`, `updated_at`) VALUES
(2, 'unilever', 'jl.mifta', '08920112', '2022-06-16 13:24:44', '2022-06-16 13:24:44'),
(3, 'Frieslandcampina', 'Jl. Raya Bogor KM 5, Pasar Rebo, Jakarta Timur, Indonesia 13760', '-', '2022-07-01 16:47:25', '2022-07-01 20:13:37'),
(4, 'PT.Indolakto', '-', '-', '2022-07-01 16:51:57', '2022-07-01 16:51:57'),
(5, 'PT. Nestle Indonesia', '-', '-', '2022-07-01 16:56:31', '2022-07-01 16:56:31'),
(6, 'PT. Buana Prima Sukses', '-', '-', '2022-07-01 16:59:34', '2022-07-01 16:59:34'),
(7, 'PT. Ultrajaya Milk Industry & Trading Co. TBK.', '-', '-', '2022-07-01 17:13:32', '2022-07-01 17:13:32'),
(8, 'baba', 'nana', '08888', '2022-07-06 18:31:55', '2022-07-06 18:31:55'),
(9, 'PT. Jhonson & Jhonson Company', 'Jl. Mampang Prpt. Raya No.1, RT.6/RW.1, Mampang Prpt., Kec. Mampang Prpt., Kota Jakarta Selatan', '0829028210', '2022-07-09 21:36:49', '2022-07-09 21:36:49');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_barangs`
--

CREATE TABLE `pembelian_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembelian_barangs`
--

INSERT INTO `pembelian_barangs` (`id`, `barang_id`, `tanggal_pembelian`, `harga_beli`, `harga_jual`, `jumlah_beli`, `total`, `user_id`, `created_at`, `updated_at`) VALUES
(11, 10, '2022-07-09', 5000, 6000, 40, 200000, 7, '2022-07-09 04:14:21', '2022-07-09 04:14:21'),
(12, 3, '2022-07-10', 10000, 11000, 2, 20000, 6, '2022-07-09 21:46:25', '2022-07-09 21:46:25'),
(13, 3, '2022-07-11', 10000, 11000, 10, 100000, 6, '2022-07-09 21:47:25', '2022-07-09 21:47:25'),
(14, 3, '2022-07-11', 20000, 21000, 5, 100000, 6, '2022-07-10 01:48:08', '2022-07-10 01:48:08'),
(15, 25, '2022-07-10', 10000, 11000, 2, 20000, 6, '2022-07-10 01:48:42', '2022-07-10 01:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_barangs`
--

CREATE TABLE `penjualan_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_penjualan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pelanggan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `potongan_harga` double DEFAULT NULL,
  `grand_total_potongan` double DEFAULT NULL,
  `grand_total` double DEFAULT NULL,
  `jumlah_bayar` double DEFAULT NULL,
  `kembalian` double DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penjualan_barangs`
--

INSERT INTO `penjualan_barangs` (`id`, `kode_penjualan`, `pelanggan_id`, `potongan_harga`, `grand_total_potongan`, `grand_total`, `jumlah_bayar`, `kembalian`, `user_id`, `tanggal_transaksi`, `created_at`, `updated_at`) VALUES
(19, 'BRQ-0001', 2, NULL, NULL, 44000, 200000, 156000, 5, '2022-07-09', '2022-07-09 03:54:54', '2022-07-09 03:54:54'),
(20, 'BRQ-0002', 2, NULL, NULL, 33000, 300000, 267000, 5, '2022-07-10', '2022-07-10 01:45:51', '2022-07-10 01:45:51'),
(23, 'BRQ-0003', 2, NULL, NULL, 48000, 50000, 2000, 5, '2022-07-19', '2022-07-19 02:35:02', '2022-07-19 02:35:02');

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
-- Table structure for table `return_barangs`
--

CREATE TABLE `return_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_return` int(11) NOT NULL,
  `alasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_barangs`
--

INSERT INTO `return_barangs` (`id`, `barang_id`, `user_id`, `jumlah_return`, `alasan`, `status`, `created_at`, `updated_at`) VALUES
(6, 3, 6, 2, 'Barang Rusak', '1', '2022-07-09 21:47:46', '2022-07-16 08:53:33'),
(7, 10, 6, 2, 'Barang Rusak', '1', '2022-07-16 08:55:02', '2022-07-16 09:06:47'),
(8, 25, 6, 2, 'Barang Rusak', '0', '2022-07-16 09:07:16', '2022-07-16 09:07:16');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_logins`
--

CREATE TABLE `riwayat_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riwayat_logins`
--

INSERT INTO `riwayat_logins` (`id`, `user_id`, `last_login_at`, `last_login_ip`, `created_at`, `updated_at`) VALUES
(62, 5, '2022-07-09 10:54:26', '127.0.0.1', '2022-07-09 03:54:26', '2022-07-09 03:54:26'),
(63, 6, '2022-07-09 11:02:30', '127.0.0.1', '2022-07-09 04:02:30', '2022-07-09 04:02:30'),
(64, 7, '2022-07-09 11:02:46', '127.0.0.1', '2022-07-09 04:02:46', '2022-07-09 04:02:46'),
(65, 6, '2022-07-09 11:14:41', '127.0.0.1', '2022-07-09 04:14:41', '2022-07-09 04:14:41'),
(66, 6, '2022-07-09 11:16:50', '127.0.0.1', '2022-07-09 04:16:50', '2022-07-09 04:16:50'),
(67, 5, '2022-07-09 11:17:05', '127.0.0.1', '2022-07-09 04:17:05', '2022-07-09 04:17:05'),
(68, 6, '2022-07-09 11:17:16', '127.0.0.1', '2022-07-09 04:17:16', '2022-07-09 04:17:16'),
(69, 6, '2022-07-09 14:10:40', '127.0.0.1', '2022-07-09 07:10:40', '2022-07-09 07:10:40'),
(70, 6, '2022-07-10 02:53:16', '127.0.0.1', '2022-07-09 19:53:16', '2022-07-09 19:53:16'),
(71, 6, '2022-07-10 03:56:39', '127.0.0.1', '2022-07-09 20:56:39', '2022-07-09 20:56:39'),
(72, 5, '2022-07-10 03:57:17', '127.0.0.1', '2022-07-09 20:57:17', '2022-07-09 20:57:17'),
(73, 6, '2022-07-10 03:57:29', '127.0.0.1', '2022-07-09 20:57:29', '2022-07-09 20:57:29'),
(74, 8, '2022-07-10 03:58:56', '127.0.0.1', '2022-07-09 20:58:56', '2022-07-09 20:58:56'),
(75, 6, '2022-07-10 04:26:28', '127.0.0.1', '2022-07-09 21:26:28', '2022-07-09 21:26:28'),
(76, 5, '2022-07-10 08:44:41', '127.0.0.1', '2022-07-10 01:44:41', '2022-07-10 01:44:41'),
(77, 6, '2022-07-10 08:46:33', '127.0.0.1', '2022-07-10 01:46:33', '2022-07-10 01:46:33'),
(78, 6, '2022-07-10 08:55:33', '127.0.0.1', '2022-07-10 01:55:33', '2022-07-10 01:55:33'),
(79, 6, '2022-07-11 06:13:40', '127.0.0.1', '2022-07-10 23:13:40', '2022-07-10 23:13:40'),
(80, 6, '2022-07-16 13:16:47', '127.0.0.1', '2022-07-16 06:16:47', '2022-07-16 06:16:47'),
(81, 6, '2022-07-16 22:27:39', '127.0.0.1', '2022-07-16 15:27:39', '2022-07-16 15:27:39'),
(82, 8, '2022-07-16 22:28:13', '127.0.0.1', '2022-07-16 15:28:13', '2022-07-16 15:28:13'),
(83, 6, '2022-07-16 22:46:45', '127.0.0.1', '2022-07-16 15:46:45', '2022-07-16 15:46:45'),
(84, 8, '2022-07-16 22:47:14', '127.0.0.1', '2022-07-16 15:47:14', '2022-07-16 15:47:14'),
(85, 9, '2022-07-16 23:06:48', '127.0.0.1', '2022-07-16 16:06:48', '2022-07-16 16:06:48'),
(86, 6, '2022-07-16 23:29:21', '127.0.0.1', '2022-07-16 16:29:21', '2022-07-16 16:29:21'),
(87, 8, '2022-07-16 23:54:26', '127.0.0.1', '2022-07-16 16:54:26', '2022-07-16 16:54:26'),
(88, 6, '2022-07-18 22:11:35', '127.0.0.1', '2022-07-18 15:11:35', '2022-07-18 15:11:35'),
(89, 8, '2022-07-18 22:55:13', '127.0.0.1', '2022-07-18 15:55:13', '2022-07-18 15:55:13'),
(90, 6, '2022-07-19 08:34:49', '127.0.0.1', '2022-07-19 01:34:49', '2022-07-19 01:34:49'),
(91, 8, '2022-07-19 08:35:22', '127.0.0.1', '2022-07-19 01:35:22', '2022-07-19 01:35:22'),
(92, 8, '2022-07-19 08:52:14', '127.0.0.1', '2022-07-19 01:52:14', '2022-07-19 01:52:14'),
(93, 5, '2022-07-19 09:34:15', '127.0.0.1', '2022-07-19 02:34:15', '2022-07-19 02:34:15'),
(94, 8, '2022-07-19 13:00:24', '127.0.0.1', '2022-07-19 06:00:24', '2022-07-19 06:00:24'),
(95, 8, '2022-07-20 17:05:01', '127.0.0.1', '2022-07-20 10:05:01', '2022-07-20 10:05:01'),
(96, 6, '2022-07-20 17:09:47', '127.0.0.1', '2022-07-20 10:09:47', '2022-07-20 10:09:47'),
(97, 5, '2022-07-20 17:37:34', '127.0.0.1', '2022-07-20 10:37:34', '2022-07-20 10:37:34');

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
  `role` enum('Admin','Direktur','Sekretaris','Keuangan','Staf Gudang','Kasir') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `No_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `alamat`, `No_hp`, `foto`, `remember_token`, `last_login_at`, `last_login_ip`, `created_at`, `updated_at`) VALUES
(5, 'kasir', 'kasir@gmail.com', NULL, '$2y$10$P6KsEh24TQ/9IEskkBp1uOrlUO/QTPHeLHr0GyQYbp7K.Mv0kLmse', 'Kasir', 'alamat', '08287919', NULL, NULL, '2022-07-20 17:37:34', '127.0.0.1', '2022-07-09 03:44:17', '2022-07-20 10:37:34'),
(6, 'albariq', 'albariq00@gmail.com', NULL, '$2y$10$4hXio6z.yns4UA1DtjrN/uMfW511xz9z6sD9D84JBVpNHKzJRoTNq', 'Admin', 'Jl.H Ahmad Dahlan Hy Maskarebet', '', 'user-images/BIBHVDDrgF1fWmRPWmF6n8eZaobZmljNNYG10jaP.jpg', NULL, '2022-07-20 17:09:47', '127.0.0.1', '2022-07-09 03:57:08', '2022-07-20 10:09:47'),
(7, 'keuangan', 'keuangan@gmail.com', NULL, '$2y$10$ayTLpkevljYhXdy9XXfC..SwhYzfURBRfj3whXm0QkVZSHAfjpoam', 'Keuangan', 'dnaida', '07979213', NULL, NULL, '2022-07-09 11:02:46', '127.0.0.1', '2022-07-09 04:02:25', '2022-07-09 04:02:46'),
(8, 'direktur', 'direktur@gmail.com', NULL, '$2y$10$9dWe76vfXvQNdK54I5hqoeJm0QDC6wph3q2zABIY6EQJOp3rfRAC6', 'Direktur', 'alang alang', '080820803', NULL, NULL, '2022-07-20 17:05:01', '127.0.0.1', '2022-07-09 20:58:39', '2022-07-20 10:05:01'),
(9, 'staff gudang', 'staffgudang@gmail.com', NULL, '$2y$10$iGJKehndJg2RLr0b.Hz4ceQUKo75h4wPNM540Aj/ctXrczHi10uZa', 'Staf Gudang', 'jl.ahmad yani', '07899801', NULL, NULL, '2022-07-16 23:06:48', '127.0.0.1', '2022-07-10 01:54:02', '2022-07-16 16:06:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangs_kategori_id_foreign` (`kategori_id`),
  ADD KEY `barangs_pemasok_id_foreign` (`pemasok_id`);

--
-- Indexes for table `detail_penjualans`
--
ALTER TABLE `detail_penjualans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_penjualans_barang_id_foreign` (`barang_id`),
  ADD KEY `detail_penjualans_penjualan_id_foreign` (`penjualan_id`),
  ADD KEY `detail_penjualans_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kehilangan_barangs`
--
ALTER TABLE `kehilangan_barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kehilangan_barangs_barang_id_foreign` (`barang_id`),
  ADD KEY `kehilangan_barangs_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemasoks`
--
ALTER TABLE `pemasoks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian_barangs`
--
ALTER TABLE `pembelian_barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembelian_barangs_barang_id_foreign` (`barang_id`),
  ADD KEY `pembelian_barangs_user_id_foreign` (`user_id`);

--
-- Indexes for table `penjualan_barangs`
--
ALTER TABLE `penjualan_barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_barangs_pelanggan_id_foreign` (`pelanggan_id`),
  ADD KEY `penjualan_barangs_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `return_barangs`
--
ALTER TABLE `return_barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_barangs_barang_id_foreign` (`barang_id`),
  ADD KEY `return_barangs_user_id_foreign` (`user_id`);

--
-- Indexes for table `riwayat_logins`
--
ALTER TABLE `riwayat_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_logins_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `detail_penjualans`
--
ALTER TABLE `detail_penjualans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kehilangan_barangs`
--
ALTER TABLE `kehilangan_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pelanggans`
--
ALTER TABLE `pelanggans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pemasoks`
--
ALTER TABLE `pemasoks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pembelian_barangs`
--
ALTER TABLE `pembelian_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `penjualan_barangs`
--
ALTER TABLE `penjualan_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_barangs`
--
ALTER TABLE `return_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `riwayat_logins`
--
ALTER TABLE `riwayat_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `barangs_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barangs_pemasok_id_foreign` FOREIGN KEY (`pemasok_id`) REFERENCES `pemasoks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_penjualans`
--
ALTER TABLE `detail_penjualans`
  ADD CONSTRAINT `detail_penjualans_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penjualans_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan_barangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penjualans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kehilangan_barangs`
--
ALTER TABLE `kehilangan_barangs`
  ADD CONSTRAINT `kehilangan_barangs_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kehilangan_barangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembelian_barangs`
--
ALTER TABLE `pembelian_barangs`
  ADD CONSTRAINT `pembelian_barangs_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_barangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan_barangs`
--
ALTER TABLE `penjualan_barangs`
  ADD CONSTRAINT `penjualan_barangs_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_barangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `return_barangs`
--
ALTER TABLE `return_barangs`
  ADD CONSTRAINT `return_barangs_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `return_barangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `riwayat_logins`
--
ALTER TABLE `riwayat_logins`
  ADD CONSTRAINT `riwayat_logins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
