-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 19 Jan 2026 pada 06.34
-- Versi server: 5.7.33
-- Versi PHP: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penyewaan_baju_tari_fix`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `baju`
--

CREATE TABLE `baju` (
  `id_baju` bigint(20) UNSIGNED NOT NULL,
  `nama_baju` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_sewa` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `baju`
--

INSERT INTO `baju` (`id_baju`, `nama_baju`, `stok`, `harga_sewa`, `created_at`, `updated_at`, `foto`) VALUES
(1, 'Tari Jaipong', 62, 50000.00, '2026-01-04 00:07:54', '2026-01-18 20:21:45', 'baju/D69oCVavyg1ltfjbHbigs5a0zhZnZgvsFb84K7tE.jpg'),
(2, 'Tari Piring', 50, 50000.00, '2026-01-04 23:06:23', '2026-01-11 21:12:57', 'baju/t6ZSAHyP2INtjU8DkSpY4KsqNXHPAZ3rfa3FxNaL.jpg'),
(4, 'Tari Jatil', 30, 50000.00, '2026-01-08 23:26:03', '2026-01-13 00:31:47', 'baju/7TFd74b0aQnMsrSUn5PV3t6w7UvT1FcDfnCUb30S.jpg'),
(5, 'Tari Betawi Jabar', 50, 50000.00, '2026-01-11 20:37:58', '2026-01-13 07:08:57', 'baju/lmuvcMwULtgX9zw165qnuZ5MfMDZccCh6Uq52tHZ.jpg'),
(6, 'Tari Gandrung', 55, 100000.00, '2026-01-13 08:29:12', '2026-01-13 08:29:12', 'baju/bNSYryTN0aDRzKUnhxGirjIc05Wu7uwMzR0nciuh.jpg'),
(7, 'Tari Merak', 45, 55000.00, '2026-01-13 08:33:00', '2026-01-18 19:53:05', 'baju/n7OCQ7EgkCUwkcI9nNk2aKeMpp8QqiSaGyVmtXw9.jpg'),
(8, 'Tari Saman', 40, 48000.00, '2026-01-13 18:02:35', '2026-01-13 18:02:35', 'baju/cW5B46fRV2sY0vcG4Dc24xG9UD9idnhCQ5knLX6Q.jpg'),
(9, 'Tari Dayak', 30, 60000.00, '2026-01-13 18:05:53', '2026-01-13 18:05:53', 'baju/dkYr7aeruxEvOdkKzIWjUiiSy8URVg7YF263dOde.jpg'),
(10, 'Tari Remo', 80, 100000.00, '2026-01-13 18:13:52', '2026-01-18 20:30:49', 'baju/u18GshgXjU0C1EhzGtLdGcJSS4VZbGhNbWv0Lel2.jpg'),
(12, 'Tari Bali', 40, 45000.00, '2026-01-18 20:40:55', '2026-01-18 20:40:55', 'baju/xnD5GMpIK5aLaILOlAcwktTPNuLnBdi94inMORpR.jpg'),
(13, 'Tari Topeng', 58, 76000.00, '2026-01-18 22:27:18', '2026-01-18 22:27:18', 'baju/1IaqiWX0OtHMn7VQGTGoNoLgZHOPD28qhMXxsaBa.jpg'),
(14, 'Tari Gembyong', 70, 60000.00, '2026-01-18 22:27:48', '2026-01-18 22:27:48', 'baju/Wpj6cuVP0BDb4O2vqPIvvi6TotHmN0EezXTHdnxR.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penyewaan`
--

CREATE TABLE `detail_penyewaan` (
  `id_detail` bigint(20) UNSIGNED NOT NULL,
  `id_penyewaan` bigint(20) UNSIGNED NOT NULL,
  `id_baju` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_sewa` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_penyewaan`
--

INSERT INTO `detail_penyewaan` (`id_detail`, `id_penyewaan`, `id_baju`, `jumlah`, `harga_sewa`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 5, 50000.00, 250000.00, '2026-01-04 01:04:36', '2026-01-04 01:04:36'),
(2, 5, 1, 5, 50000.00, 250000.00, '2026-01-04 01:08:21', '2026-01-04 01:08:21'),
(3, 6, 1, 5, 50000.00, 250000.00, '2026-01-04 02:02:17', '2026-01-04 02:02:17'),
(4, 7, 1, 2, 50000.00, 100000.00, '2026-01-04 08:27:34', '2026-01-04 08:27:34'),
(5, 8, 2, 10, 50000.00, 500000.00, '2026-01-04 23:18:39', '2026-01-04 23:18:39'),
(6, 13, 1, 10, 50000.00, 500000.00, '2026-01-07 00:07:09', '2026-01-07 00:07:09'),
(7, 15, 1, 2, 50000.00, 100000.00, '2026-01-11 20:39:04', '2026-01-11 20:39:04'),
(8, 16, 2, 5, 50000.00, 250000.00, '2026-01-11 21:12:11', '2026-01-11 21:12:11'),
(9, 17, 4, 10, 50000.00, 500000.00, '2026-01-13 00:31:30', '2026-01-13 00:31:30'),
(10, 18, 1, 2, 50000.00, 100000.00, '2026-01-13 00:52:26', '2026-01-13 00:52:26'),
(11, 19, 1, 2, 50000.00, 100000.00, '2026-01-13 05:58:07', '2026-01-13 05:58:07'),
(12, 20, 5, 5, 50000.00, 250000.00, '2026-01-13 06:14:12', '2026-01-13 06:14:12'),
(13, 21, 1, 2, 50000.00, 100000.00, '2026-01-13 06:42:45', '2026-01-13 06:42:45'),
(14, 22, 10, 10, 100000.00, 1000000.00, '2026-01-13 19:10:08', '2026-01-13 19:10:08'),
(15, 23, 7, 5, 55000.00, 275000.00, '2026-01-18 19:52:23', '2026-01-18 19:52:23'),
(16, 24, 1, 2, 50000.00, 100000.00, '2026-01-18 20:03:05', '2026-01-18 20:03:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_02_155056_create_pelanggan_table', 1),
(5, '2026_01_02_155922_create_baju_table', 1),
(6, '2026_01_02_160659_create_penyewaan_table', 1),
(7, '2026_01_02_160929_create_detail_penyewaan_table', 1),
(8, '2026_01_02_165136_create_pengembalian_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` bigint(20) UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'zakhariya', '0272735733', 'mjk gedeg', '2026-01-04 00:07:30', '2026-01-04 08:39:12'),
(4, 'jihan', '083831357728', 'sidonganti', '2026-01-04 23:17:11', '2026-01-05 00:14:49'),
(5, 'revika anak orng baik', '085749159461', 'iejd', '2026-01-11 18:55:37', '2026-01-11 18:55:37'),
(6, 'Bu leni', '088383683', 'mjk', '2026-01-13 00:29:52', '2026-01-13 00:29:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` bigint(20) UNSIGNED NOT NULL,
  `id_penyewaan` bigint(20) UNSIGNED NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `denda` decimal(12,2) NOT NULL DEFAULT '0.00',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `id_penyewaan`, `tanggal_kembali`, `denda`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 5, '2026-01-06', 0.00, 'baik', '2026-01-04 01:54:16', '2026-01-04 01:54:16'),
(2, 4, '2026-01-06', 0.00, 'Kembali dalam kondisi baik', '2026-01-04 01:59:43', '2026-01-04 01:59:43'),
(3, 6, '2026-01-09', -60000.00, 'bagus', '2026-01-04 02:02:35', '2026-01-04 02:02:35'),
(4, 8, '2026-01-09', -40000.00, 'jihan gaplek i bajune rusak', '2026-01-04 23:20:38', '2026-01-04 23:20:38'),
(5, 4, '2026-01-08', -40000.00, 'baikk', '2026-01-06 07:37:13', '2026-01-06 07:37:13'),
(6, 4, '2026-01-07', -20000.00, 'Kembali dalam kondisi baik', '2026-01-06 07:52:06', '2026-01-06 07:52:06'),
(7, 14, '2026-01-10', 10000.00, 'barang aman', '2026-01-07 09:56:42', '2026-01-07 09:56:42'),
(8, 13, '2026-01-09', 0.00, NULL, '2026-01-07 09:57:03', '2026-01-07 09:57:03'),
(9, 10, '2026-01-10', 10000.00, NULL, '2026-01-07 09:57:13', '2026-01-07 09:57:13'),
(10, 9, '2026-01-12', 30000.00, 'okee', '2026-01-07 09:57:28', '2026-01-07 09:57:28'),
(11, 7, '2026-01-08', 20000.00, NULL, '2026-01-08 09:35:27', '2026-01-08 09:35:27'),
(12, 15, '2026-01-16', 20000.00, 'bagusss barang baik', '2026-01-11 20:39:34', '2026-01-11 20:39:34'),
(13, 16, '2026-01-14', 0.00, NULL, '2026-01-11 21:12:57', '2026-01-11 21:12:57'),
(14, 17, '2026-01-16', 10000.00, NULL, '2026-01-13 00:31:47', '2026-01-13 00:31:47'),
(15, 18, '2026-01-15', 10000.00, NULL, '2026-01-13 00:59:35', '2026-01-13 00:59:35'),
(16, 19, '2026-01-14', 0.00, NULL, '2026-01-13 05:58:34', '2026-01-13 05:58:34'),
(17, 20, '2026-01-15', 0.00, 'baguss', '2026-01-13 06:14:52', '2026-01-13 06:14:52'),
(18, 21, '2026-01-14', 0.00, 'okee', '2026-01-13 06:43:25', '2026-01-13 06:43:25'),
(19, 22, '2026-01-16', 0.00, NULL, '2026-01-13 19:10:36', '2026-01-13 19:10:36'),
(20, 23, '2026-01-21', 10000.00, 'baguss', '2026-01-18 19:53:05', '2026-01-18 19:53:05'),
(21, 24, '2026-01-20', 0.00, NULL, '2026-01-18 20:21:45', '2026-01-18 20:21:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id_penyewaan` bigint(20) UNSIGNED NOT NULL,
  `kode_sewa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pelanggan` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_sewa` date NOT NULL,
  `tanggal_kembali_rencana` date NOT NULL,
  `status` enum('disewa','dikembalikan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disewa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penyewaan`
--

INSERT INTO `penyewaan` (`id_penyewaan`, `kode_sewa`, `nama_pelanggan`, `tanggal_sewa`, `tanggal_kembali_rencana`, `status`, `created_at`, `updated_at`) VALUES
(4, 'INV-20260104-DC9W', '1', '2026-01-04', '2026-01-06', 'dikembalikan', '2026-01-04 01:04:36', '2026-01-04 01:59:43'),
(5, 'INV-20260104-M8W9', '1', '2026-01-04', '2026-01-06', 'dikembalikan', '2026-01-04 01:08:21', '2026-01-04 01:54:16'),
(6, 'INV-20260104-MEHQ', '1', '2026-01-04', '2026-01-06', 'dikembalikan', '2026-01-04 02:02:17', '2026-01-04 02:02:35'),
(7, 'INV-20260104-0YHV', '1', '2026-01-04', '2026-01-06', 'dikembalikan', '2026-01-04 08:27:34', '2026-01-08 09:35:27'),
(8, 'INV-20260105-T8MD', '4', '2026-01-05', '2026-01-07', 'dikembalikan', '2026-01-04 23:18:39', '2026-01-04 23:20:38'),
(9, 'INV-20260107-VW0T', '4', '2026-01-07', '2026-01-09', 'dikembalikan', '2026-01-06 19:21:42', '2026-01-07 09:57:28'),
(10, 'INV-20260107-FOMS', '4', '2026-01-07', '2026-01-09', 'dikembalikan', '2026-01-06 19:25:10', '2026-01-07 09:57:13'),
(13, 'INV-20260107-7V5O', '4', '2026-01-07', '2026-01-09', 'dikembalikan', '2026-01-07 00:07:09', '2026-01-07 09:57:03'),
(14, 'INV-20260107-QZ3X', '4', '2026-01-07', '2026-01-09', 'dikembalikan', '2026-01-07 00:29:26', '2026-01-07 09:56:42'),
(15, 'INV-20260112-9FED', '5', '2026-01-12', '2026-01-14', 'dikembalikan', '2026-01-11 20:39:04', '2026-01-11 20:39:34'),
(16, 'INV-20260112-YFAD', '4', '2026-01-12', '2026-01-14', 'dikembalikan', '2026-01-11 21:12:11', '2026-01-11 21:12:57'),
(17, 'INV-20260113-UXIF', '6', '2026-01-13', '2026-01-15', 'dikembalikan', '2026-01-13 00:31:30', '2026-01-13 00:31:47'),
(18, 'INV-20260113-QRI4', 'revika anak baik', '2026-01-13', '2026-01-14', 'dikembalikan', '2026-01-13 00:52:26', '2026-01-13 00:59:35'),
(19, 'INV-20260113-FOYV', 'jihan', '2026-01-13', '2026-01-14', 'dikembalikan', '2026-01-13 05:58:06', '2026-01-13 05:58:34'),
(20, 'INV-20260113-WWFB', 'adelia', '2026-01-13', '2026-01-15', 'dikembalikan', '2026-01-13 06:14:12', '2026-01-13 06:14:52'),
(21, 'INV-20260113-I5IE', 'zakhariya', '2026-01-13', '2026-01-14', 'dikembalikan', '2026-01-13 06:42:45', '2026-01-13 06:43:25'),
(22, 'INV-20260114-EQLF', 'Bu leni', '2026-01-14', '2026-01-16', 'dikembalikan', '2026-01-13 19:10:08', '2026-01-13 19:10:36'),
(23, 'INV-20260119-L5JR', 'revika buaikk', '2026-01-19', '2026-01-20', 'dikembalikan', '2026-01-18 19:52:23', '2026-01-18 19:53:05'),
(24, 'INV-20260119-8NHH', 'ridho', '2026-01-19', '2026-01-20', 'dikembalikan', '2026-01-18 20:03:05', '2026-01-18 20:21:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin Laras', 'admin@laras.com', '$2y$12$nRZ1qvObbbqGaUfl02bi8u5cZENUmZeLVdMWfdXAA6Z3TGMSmuP4y', 'admin', '2026-01-04 00:06:19', '2026-01-04 00:06:19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `baju`
--
ALTER TABLE `baju`
  ADD PRIMARY KEY (`id_baju`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `detail_penyewaan`
--
ALTER TABLE `detail_penyewaan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `detail_penyewaan_id_penyewaan_foreign` (`id_penyewaan`),
  ADD KEY `detail_penyewaan_id_baju_foreign` (`id_baju`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `pengembalian_id_penyewaan_foreign` (`id_penyewaan`);

--
-- Indeks untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`id_penyewaan`),
  ADD UNIQUE KEY `penyewaan_kode_sewa_unique` (`kode_sewa`),
  ADD KEY `penyewaan_id_pelanggan_foreign` (`nama_pelanggan`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `baju`
--
ALTER TABLE `baju`
  MODIFY `id_baju` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `detail_penyewaan`
--
ALTER TABLE `detail_penyewaan`
  MODIFY `id_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  MODIFY `id_penyewaan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_penyewaan`
--
ALTER TABLE `detail_penyewaan`
  ADD CONSTRAINT `detail_penyewaan_id_baju_foreign` FOREIGN KEY (`id_baju`) REFERENCES `baju` (`id_baju`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_penyewaan_id_penyewaan_foreign` FOREIGN KEY (`id_penyewaan`) REFERENCES `penyewaan` (`id_penyewaan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_id_penyewaan_foreign` FOREIGN KEY (`id_penyewaan`) REFERENCES `penyewaan` (`id_penyewaan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
