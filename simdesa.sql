-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2017 at 09:28 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_simdesa`
--

-- --------------------------------------------------------

--
-- Table structure for table `adm_surat`
--

CREATE TABLE `adm_surat` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal_pengirim_penerima` date NOT NULL,
  `nomor_surat` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_surat` date NOT NULL,
  `pengirim_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('masuk','keluar','ekspedisi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `penanggung_jawab_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `anggota_keluarga`
--

CREATE TABLE `anggota_keluarga` (
  `nomor_kk` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai_di_desa` date DEFAULT NULL,
  `tanggal_dikeluarkan` date DEFAULT NULL,
  `tempat_dikeluarkan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aparat_desa`
--

CREATE TABLE `aparat_desa` (
  `id` int(10) UNSIGNED NOT NULL,
  `niap` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `golongan` enum('I/a','I/b','I/c','I/d','II/a','II/b','II/c','II/d','III/a','III/b','III/c','III/d','IV/a','IV/b','IV/c','IV/d') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_pengangkatan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pengangkatan` date DEFAULT NULL,
  `no_pemberhentian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pemberhentian` date DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan_id` int(10) UNSIGNED DEFAULT NULL,
  `nik_penduduk` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aparat_desa`
--

INSERT INTO `aparat_desa` (`id`, `niap`, `nip`, `golongan`, `no_pengangkatan`, `tanggal_pengangkatan`, `no_pemberhentian`, `tanggal_pemberhentian`, `keterangan`, `jabatan_id`, `nik_penduduk`, `admin`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, '10112671', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '$2y$10$AHL9g/oTuKGndnHpE8b2muE4dszU9VT6.UwEm5pMsVqyT0Bk4AlCy', 'U5Y9hrtv4boFyn83ayl5gkH62YGzzVTDyP7GmsOXlDOZwOWxlxLpeFTv980S', '2017-05-11 00:22:24', '2017-05-11 00:22:24'),
(2, NULL, '10111420', 'III/d', '12/SK/Kepdes/X/2017', '2017-05-01', NULL, NULL, '.', 1, '3213010000000001', 0, '$2y$10$7WUWxcTsuHeIGTaNodTWMehzIy88MjPACxLrH.yTCoLolMFhN5eIa', '9tJE5OSGBCnshQ7OMEWeQEcLJMoO1x68C1wrF3nAskAETdIT9NccV4jLaRXK', '2017-05-11 00:49:15', '2017-05-11 00:49:15'),
(3, NULL, '10111421', 'III/b', '13/SK/Kepdes/X/2017', '2017-05-01', NULL, NULL, '.', 2, '3213010000000002', 0, '$2y$10$89gDONczOY576Rpkq/jjquEVt0YwR4yuTTMUSZeeNRWojZbl96XB2', 'CkMombi48zJb6UknEmJfp3HcC8dEmqSZKLOIJ0fqu7Izu0bvIbawqhiQiIp4', '2017-05-11 00:54:44', '2017-05-11 00:54:44'),
(4, NULL, '10111422', 'II/a', '14/SK/Kepdes/X/2017', '2017-05-02', NULL, NULL, '.', 4, '3213010000000003', 0, '$2y$10$gyjQ5cQCRW.ITpUuZoeuuu.cIdSlNB3.BLrbJj7KRaNTyXQcn3jT2', 'CGXhYuhPjs1sk1YeGxPHLV4HsVjH0CAXTyUcXWONKo1gppgHOYk5LAUkbLlW', '2017-05-11 02:21:55', '2017-05-11 02:21:55');

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('pendapatan','belanja','pembiayaan') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bidang`
--

INSERT INTO `bidang` (`id`, `nama`, `jenis`) VALUES
(1, 'Pendapatan Asli Desa', 'pendapatan'),
(2, 'Pendapatan Transfer', 'pendapatan'),
(3, 'Pendapatan Lain-lain', 'pendapatan'),
(4, 'Bidang Penyelenggaraan Pemerintahan Desa', 'belanja'),
(5, 'Bidang Pelaksanaan Pembangunan Desa', 'belanja'),
(6, 'Bidang Pembinaan Kemasyarakatan', 'belanja'),
(7, 'Bidang Pemberdayaan Masyarakat', 'belanja'),
(8, 'Bidang Tak Terduga', 'belanja'),
(9, 'Penerimaan Pembiayaan', 'pembiayaan'),
(10, 'Pengeluaran Pembiayaan', 'pembiayaan');

-- --------------------------------------------------------

--
-- Table structure for table `detail_kegiatan_kerja`
--

CREATE TABLE `detail_kegiatan_kerja` (
  `id` int(10) UNSIGNED NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `volume` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manfaat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_dana` int(10) UNSIGNED DEFAULT NULL,
  `pola_pelaksanaan` enum('SWAKELOLA','KERJASAMA ANTAR DESA','KERJASAMA PIHAK 3') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sumber_dana_id` int(10) UNSIGNED DEFAULT NULL,
  `kegiatan_kerja_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_kegiatan_kerja`
--

INSERT INTO `detail_kegiatan_kerja` (`id`, `lokasi`, `volume`, `manfaat`, `jumlah_dana`, `pola_pelaksanaan`, `keterangan`, `sumber_dana_id`, `kegiatan_kerja_id`, `created_at`, `updated_at`) VALUES
(1, 'desa sukamaju', '5', 'untuk masyarakat', 20000, 'SWAKELOLA', NULL, 1, 3, '2017-06-16 18:43:32', '2017-06-16 18:43:32');

-- --------------------------------------------------------

--
-- Table structure for table `inventaris_desa`
--

CREATE TABLE `inventaris_desa` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_barang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_sendiri` tinyint(4) NOT NULL,
  `asal_pemerintah` tinyint(4) NOT NULL,
  `asal_provinsi` tinyint(4) NOT NULL,
  `asal_kota` tinyint(4) NOT NULL,
  `asal_sumbangan` tinyint(4) NOT NULL,
  `awal_tahun_baik` tinyint(4) NOT NULL,
  `awal_tahun_rusak` tinyint(4) NOT NULL,
  `hapus_rusak` tinyint(4) NOT NULL,
  `hapus_dijual` tinyint(4) NOT NULL,
  `hapus_disumbangkan` tinyint(4) NOT NULL,
  `hapus_tanggal` date NOT NULL,
  `akhir_tahun_baik` tinyint(4) NOT NULL,
  `akhir_tahun_rusak` tinyint(4) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penanggung_jawab_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `kode`, `nama`) VALUES
(1, 'kades', 'Kepala Desa'),
(2, 'sekdes', 'Sekertaris Desa'),
(3, 'bendahara', 'Bendahara Desa'),
(4, 'staff', 'Staff Desa');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_kerja`
--

CREATE TABLE `kegiatan_kerja` (
  `id` int(10) UNSIGNED NOT NULL,
  `uraian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('level_1','level_2','level_3') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'level_1: sub-bidang; level_2: kegiatan; level_3: sub-kegiatan/rincian kegiatan',
  `bidang_id` int(10) UNSIGNED DEFAULT NULL,
  `rpjm_id` int(10) UNSIGNED NOT NULL,
  `kegiatan_kerja_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatan_kerja`
--

INSERT INTO `kegiatan_kerja` (`id`, `uraian`, `jenis`, `bidang_id`, `rpjm_id`, `kegiatan_kerja_id`, `created_at`, `updated_at`) VALUES
(1, 'Kegiatan Ketentraman dan Ketertiban', 'level_1', 4, 1, NULL, '2017-06-16 18:43:11', '2017-06-16 18:43:11'),
(2, 'Belanja Pegawai', 'level_2', NULL, 1, 1, '2017-06-16 18:43:16', '2017-06-16 18:43:16'),
(3, 'Penghasilan Tetap Kepala Desa dan Perangkat', 'level_3', NULL, 1, 2, '2017-06-16 18:43:32', '2017-06-16 18:43:32');

-- --------------------------------------------------------

--
-- Table structure for table `ktp`
--

CREATE TABLE `ktp` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal_mulai_di_desa` date DEFAULT NULL,
  `tanggal_dikeluarkan` date DEFAULT NULL,
  `tempat_dikeluarkan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lembar_berita_desa`
--

CREATE TABLE `lembar_berita_desa` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor_diundangkan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_diundangkan` date NOT NULL,
  `keterangan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peraturan_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(10) UNSIGNED NOT NULL,
  `aktifitas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(316, '2017_03_25_031700_create_r_w_s_table', 1),
(317, '2017_03_25_031702_create_r_t_s_table', 1),
(318, '2017_03_25_031705_create_pekerjaans_table', 1),
(319, '2017_03_25_031736_create_anggota_keluargas_table', 1),
(320, '2017_03_25_031909_create_status_keluargas_table', 1),
(321, '2017_03_25_032000_create_penduduks_table', 1),
(322, '2017_03_25_032018_create_penduduk_induks_table', 1),
(323, '2017_03_25_032032_create_penduduk_mutasis_table', 1),
(324, '2017_03_25_032044_create_penduduk_sementaras_table', 1),
(325, '2017_03_27_021323_create_bidangs_table', 1),
(326, '2017_03_27_021324_create_sumber_danas_table', 1),
(327, '2017_03_27_021545_create_r_p_j_m_s_table', 1),
(328, '2017_03_27_021729_create_kegiatan_kerjas_table', 1),
(329, '2017_03_27_031730_create_detail_kegiatan_kerjas_table', 1),
(330, '2017_03_27_081807_create_r_k_p_s_table', 1),
(331, '2017_03_27_091818_create_r_k_k_s_table', 1),
(332, '2017_03_28_062153_create_jabatans_table', 1),
(333, '2017_03_28_062848_create_aparat_desas_table', 1),
(334, '2017_03_28_062849_create_adm_surats_table', 1),
(335, '2017_03_29_062846_create_peraturan_desas_table', 1),
(336, '2017_03_29_062848_create_lembar_berita_desas_table', 1),
(337, '2017_03_31_132558_create_table_inventaris_desa', 1),
(338, '2017_04_02_211205_create_pendapatans_table', 1),
(339, '2017_04_02_220817_create_pembiayaans_table', 1),
(340, '2017_04_04_163120_create_realisasi_pendapatans_table', 1),
(341, '2017_04_04_165428_create_realisasi_belanjas_table', 1),
(342, '2017_04_04_165442_create_realisasi_pembiayaans_table', 1),
(343, '2017_04_05_213308_create_profil_desas_table', 1),
(344, '2017_04_08_230428_create_k_t_p_s_table', 1),
(345, '2017_04_10_170446_entrust_setup_tables', 1),
(346, '2017_04_12_105437_create_surat_menyurats_table', 1),
(347, '2017_04_13_134319_create_table_log', 1),
(348, '2017_04_14_105949_create_table_tanah_kas_desa', 1),
(349, '2017_04_14_110139_create_table_tanah_desa', 1),
(350, '2017_05_01_212937_create_sliders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id`, `nama`) VALUES
(1, 'Buruh'),
(2, 'PNS'),
(3, 'TNI / POLRI'),
(4, 'Mahasiswa / Pelajar'),
(5, 'Wiraswasta'),
(6, 'Pegawai Swasta'),
(7, 'Guru / Dosen'),
(8, 'Lain-Lain');

-- --------------------------------------------------------

--
-- Table structure for table `pembiayaan`
--

CREATE TABLE `pembiayaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `uraian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('level_1','level_2','level_3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_dana` int(10) UNSIGNED DEFAULT NULL,
  `tahun` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bidang_id` int(10) UNSIGNED DEFAULT NULL,
  `pembiayaan_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembiayaan`
--

INSERT INTO `pembiayaan` (`id`, `uraian`, `level`, `jumlah_dana`, `tahun`, `keterangan`, `bidang_id`, `pembiayaan_id`, `created_at`, `updated_at`) VALUES
(1, 'Hasil Usaha', 'level_1', 200000, '2017', '0', 9, NULL, '2017-06-16 18:46:06', '2017-06-16 18:46:06');

-- --------------------------------------------------------

--
-- Table structure for table `pendapatan`
--

CREATE TABLE `pendapatan` (
  `id` int(10) UNSIGNED NOT NULL,
  `uraian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('level_1','level_2','level_3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_dana` int(10) UNSIGNED DEFAULT NULL,
  `tahun` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bidang_id` int(10) UNSIGNED DEFAULT NULL,
  `pendapatan_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendapatan`
--

INSERT INTO `pendapatan` (`id`, `uraian`, `level`, `jumlah_dana`, `tahun`, `keterangan`, `bidang_id`, `pendapatan_id`, `created_at`, `updated_at`) VALUES
(1, 'Penghasilan Tetap Kepala Desa dan Perangkat', 'level_1', NULL, '2017', NULL, 1, NULL, '2017-06-16 18:45:31', '2017-06-16 18:45:31'),
(2, 'Tanah Kas Desa', 'level_2', 20000, '2017', 'kj', NULL, 1, '2017-06-16 18:45:43', '2017-06-16 18:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'L: LAKI-LAKI; P:PEREMPUAN;',
  `kewarga_negaraan` enum('WNI','WNA') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `kewarga_negaraan`, `created_at`, `updated_at`) VALUES
(1, 'Asep Suherman', 'Subang', '1980-01-01', 'L', 'WNI', '2017-05-11 00:47:32', '2017-05-11 00:47:32'),
(2, 'Siti Sulastri', 'Bandung', '1988-02-02', 'P', 'WNI', '2017-05-11 00:53:23', '2017-05-11 00:53:23'),
(3, 'Leni Putri Ayu', 'Subang', '1990-10-10', 'P', 'WNI', '2017-05-11 02:20:29', '2017-05-11 02:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk_induk`
--

CREATE TABLE `penduduk_induk` (
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan_darah` enum('A','B','AB','O') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` enum('ISLAM','KRISTEN PROTESTAN','KRISTEN KATOLIK','HINDU','BUDDHA','KONGHUCU') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_perkawinan` enum('BK','K','JD','DD') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'BK: BELUM KAWIN; K: KAWIN; JD: JANDA; DD:DUDA',
  `pendidikan` enum('Tidak/Belum Sekolah','SD','SMP','SMA','DIPLOMA I (D1)','DIPLOMA II (D2)','DIPLOMA III (D3)','STRATA I (S1)','STRATA II (S2)','STRATA III (S3)') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_kk` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_keluarga_id` int(10) UNSIGNED DEFAULT NULL,
  `membaca` enum('L','D','A','AL','AD','ALD') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'L: Latin; D: Daerah; A: Arab; AL: Arab Latin; AD: Arab Daerah; ALD: Arab Latin Daerah',
  `dusun` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rw_id` int(10) UNSIGNED NOT NULL,
  `rt_id` int(10) UNSIGNED NOT NULL,
  `penduduk_id` int(10) UNSIGNED NOT NULL,
  `pekerjaan_id` int(10) UNSIGNED DEFAULT NULL,
  `ayah` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ibu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik_ayah` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik_ibu` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penduduk_induk`
--

INSERT INTO `penduduk_induk` (`nik`, `golongan_darah`, `agama`, `status_perkawinan`, `pendidikan`, `alamat`, `keterangan`, `nomor_kk`, `status_keluarga_id`, `membaca`, `dusun`, `rw_id`, `rt_id`, `penduduk_id`, `pekerjaan_id`, `ayah`, `ibu`, `nik_ayah`, `nik_ibu`, `created_at`, `updated_at`) VALUES
('3213010000000001', 'O', 'ISLAM', 'K', 'STRATA I (S1)', 'Jl. Melati TImur', '.', NULL, 1, 'ALD', 'Mawar', 1, 1, 1, 2, 'Entis Sutisna', 'Sukaesih', NULL, NULL, '2017-05-11 00:47:32', '2017-05-11 00:47:32'),
('3213010000000002', 'B', 'ISLAM', 'JD', 'STRATA I (S1)', 'Jl. Melati Timur', '.', NULL, 2, 'ALD', 'Mawar', 1, 1, 2, 2, 'Bambang', 'Badriah', NULL, NULL, '2017-05-11 00:53:23', '2017-05-11 00:53:23'),
('3213010000000003', 'AB', 'ISLAM', 'BK', 'DIPLOMA III (D3)', 'Jl. MElati TImur', '.', NULL, 3, 'D', 'Mawar', 1, 1, 3, 2, 'Riki Budiman', 'Silvia Ayu', NULL, NULL, '2017-05-11 02:20:29', '2017-05-11 02:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk_mutasi`
--

CREATE TABLE `penduduk_mutasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` enum('MASUK','KELUAR','MATI') COLLATE utf8mb4_unicode_ci NOT NULL,
  `daerah` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penduduk_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penduduk_sementara`
--

CREATE TABLE `penduduk_sementara` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_identitas` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_identitas` enum('KTP','PASPORT') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `daerah_asal` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `turunan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_datang` date NOT NULL,
  `tanggal_pergi` date DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_id` int(10) UNSIGNED DEFAULT NULL,
  `penduduk_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peraturan_desa`
--

CREATE TABLE `peraturan_desa` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_peraturan` enum('Peraturan Desa','Peraturan Kepala Desa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_ditetapkan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_ditetapkan` date NOT NULL,
  `tentang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_kesepakatan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_kesepakatan` date DEFAULT NULL,
  `nomor_laporan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_laporan` date NOT NULL,
  `keterangan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tampilan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `tampilan`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'edit-profil-desa', 'Ubah', 'master_profil', 'master', '2017-05-11 00:21:00', '2017-05-11 00:21:00'),
(2, 'select-profil-desa', 'Lihat', 'master_profil', 'master', '2017-05-11 00:21:00', '2017-05-11 00:21:00'),
(3, 'select-rw-master', 'Lihat', 'master_rw', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(4, 'add-rw-master', 'Tambah', 'master_rw', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(5, 'edit-rw-master', 'Ubah', 'master_rw', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(6, 'remove-rw-master', 'Hapus', 'master_rw', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(7, 'select-rt-master', 'Lihat', 'master_rt', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(8, 'add-rt-master', 'Tambah', 'master_rt', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(9, 'edit-rt-master', 'Ubah', 'master_rt', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(10, 'remove-rt-master', 'Hapus', 'master_rt', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(11, 'select-keluarga-master', 'Lihat', 'master_keluarga', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(12, 'add-keluarga-master', 'Tambah', 'master_keluarga', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(13, 'edit-keluarga-master', 'Ubah', 'master_keluarga', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(14, 'remove-keluarga-master', 'Hapus', 'master_keluarga', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(15, 'select-jabatan-master', 'Lihat', 'master_jabatan', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(16, 'add-jabatan-master', 'Tambah', 'master_jabatan', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(17, 'edit-jabatan-master', 'Ubah', 'master_jabatan', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(18, 'remove-jabatan-master', 'Hapus', 'master_jabatan', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(19, 'select-pekerjaan-master', 'Lihat', 'master_pekerjaan', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(20, 'add-pekerjaan-master', 'Tambah', 'master_pekerjaan', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(21, 'edit-pekerjaan-master', 'Ubah', 'master_pekerjaan', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(22, 'remove-pekerjaan-master', 'Hapus', 'master_pekerjaan', 'master', '2017-05-11 00:21:01', '2017-05-11 00:21:01'),
(23, 'buat-surat-master', 'Surat', 'master_surat', 'master', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(24, 'select-akses-master', 'Lihat', 'master_akses', 'master', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(25, 'add-akses-master', 'Tambah', 'master_akses', 'master', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(26, 'edit-akses-master', 'Ubah', 'master_akses', 'master', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(27, 'remove-akses-master', 'Hapus', 'master_akses', 'master', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(28, 'select-induk-penduduk', 'Lihat', 'penduduk_induk', 'penduduk', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(29, 'add-induk-penduduk', 'Tambah', 'penduduk_induk', 'penduduk', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(30, 'edit-induk-penduduk', 'Ubah', 'penduduk_induk', 'penduduk', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(31, 'export-induk-penduduk', 'Eksport', 'penduduk_induk', 'penduduk', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(32, 'remove-induk-penduduk', 'Hapus', 'penduduk_induk', 'penduduk', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(33, 'add-pindah-mutasi-penduduk', 'Tambah Mutasi Pindah', 'penduduk_mutasi', 'penduduk', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(34, 'add-meninggal-mutasi-penduduk', 'Tambah Mutasi Meninggal', 'penduduk_mutasi', 'penduduk', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(35, 'add-datang-mutasi-penduduk', 'Tambah Mutasi Datang', 'penduduk_mutasi', 'penduduk', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(36, 'select-mutasi-penduduk', 'Lihat Mutasi', 'penduduk_mutasi', 'penduduk', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(37, 'export-mutasi-penduduk', 'Eksport Mutasi', 'penduduk_mutasi', 'penduduk', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(38, 'select-sementara-penduduk', 'Lihat', 'penduduk_sementara', 'penduduk', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(39, 'add-sementara-penduduk', 'Tambah', 'penduduk_sementara', 'penduduk', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(40, 'export-sementara-penduduk', 'Eksport', 'penduduk_sementara', 'penduduk', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(41, 'select-kk-penduduk', 'Lihat', 'penduduk_kk', 'penduduk', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(42, 'add-kk-penduduk', 'Tambah', 'penduduk_kk', 'penduduk', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(43, 'edit-kk-penduduk', 'Ubah', 'penduduk_kk', 'penduduk', '2017-05-11 00:21:02', '2017-05-11 00:21:02'),
(44, 'remove-kk-penduduk', 'Hapus', 'penduduk_kk', 'penduduk', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(45, 'export-kk-penduduk', 'Eksport', 'penduduk_kk', 'penduduk', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(46, 'select-ktp-penduduk', 'Lihat', 'penduduk_ktp', 'penduduk', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(47, 'add-ktp-penduduk', 'Tambah', 'penduduk_ktp', 'penduduk', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(48, 'edit-ktp-penduduk', 'Ubah', 'penduduk_ktp', 'penduduk', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(49, 'remove-ktp-penduduk', 'Hapus', 'penduduk_ktp', 'penduduk', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(50, 'export-ktp-penduduk', 'Eksport', 'penduduk_ktp', 'penduduk', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(51, 'select-rekapitulasi-penduduk', 'Lihat', 'penduduk_rekapitulasi', 'penduduk', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(52, 'select-rpjm-perencanaan', 'Lihat', 'perencanaan_rpjm', 'perencanaan', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(53, 'add-rpjm-perencanaan', 'Tambah', 'perencanaan_rpjm', 'perencanaan', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(54, 'edit-rpjm-perencanaan', 'Ubah', 'perencanaan_rpjm', 'perencanaan', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(55, 'remove-rpjm-perencanaan', 'Hapus', 'perencanaan_rpjm', 'perencanaan', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(56, 'export-rpjm-perencanaan', 'Eksport', 'perencanaan_rpjm', 'perencanaan', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(57, 'edit-rkp-perencanaan', 'Ubah', 'perencanaan_rkp', 'perencanaan', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(58, 'export-rkp-perencanaan', 'Eksport', 'perencanaan_rkp', 'perencanaan', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(59, 'add-rkk-perencanaan', 'Tambah', 'perencanaan_rkk', 'perencanaan', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(60, 'edit-rkk-perencanaan', 'Ubah', 'perencanaan_rkk', 'perencanaan', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(61, 'export-rkk-perencanaan', 'Eksport', 'perencanaan_rkk', 'perencanaan', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(62, 'select-apbd-perencanaan', 'Lihat', 'perencanaan_apbd', 'perencanaan', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(63, 'select-pendapatan-perencanaan', 'Lihat', 'perencanaan_pendapatan', 'perencanaan', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(64, 'add-pendapatan-perencanaan', 'Tambah', 'perencanaan_pendapatan', 'perencanaan', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(65, 'edit-pendapatan-perencanaan', 'Ubah', 'perencanaan_pendapatan', 'perencanaan', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(66, 'remove-pendapatan-perencanaan', 'Hapus', 'perencanaan_pendapatan', 'perencanaan', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(67, 'select-belanja-perencanaan', 'Lihat', 'perencanaan_belanja', 'perencanaan', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(68, 'select-pembiayaan-perencanaan', 'Lihat', 'perencanaan_pembiayaan', 'perencanaan', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(69, 'add-pembiayaan-perencanaan', 'Tambah', 'perencanaan_pembiayaan', 'perencanaan', '2017-05-11 00:21:03', '2017-05-11 00:21:03'),
(70, 'edit-pembiayaan-perencanaan', 'Ubah', 'perencanaan_pembiayaan', 'perencanaan', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(71, 'remove-pembiayaan-perencanaan', 'Hapus', 'perencanaan_pembiayaan', 'perencanaan', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(72, 'select-apbd-pelaksanaan', 'Lihat', 'pelaksanaan_apbd', 'pelaksanaan', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(73, 'select-pendapatan-pelaksanaan', 'Lihat', 'pelaksanaan_pendapatan', 'pelaksanaan', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(74, 'add-pendapatan-pelaksanaan', 'Tambah', 'pelaksanaan_pendapatan', 'pelaksanaan', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(75, 'edit-pendapatan-pelaksanaan', 'Ubah', 'pelaksanaan_pendapatan', 'pelaksanaan', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(76, 'remove-pendapatan-pelaksanaan', 'Hapus', 'pelaksanaan_pendapatan', 'pelaksanaan', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(77, 'select-belanja-pelaksanaan', 'Lihat', 'pelaksanaan_belanja', 'pelaksanaan', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(78, 'add-belanja-pelaksanaan', 'Tambah', 'pelaksanaan_belanja', 'pelaksanaan', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(79, 'edit-belanja-pelaksanaan', 'Ubah', 'pelaksanaan_belanja', 'pelaksanaan', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(80, 'remove-belanja-pelaksanaan', 'Hapus', 'pelaksanaan_belanja', 'pelaksanaan', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(81, 'select-pembiayaan-pelaksanaan', 'Lihat', 'pelaksanaan_pembiayaan', 'pelaksanaan', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(82, 'add-pembiayaan-pelaksanaan', 'Tambah', 'pelaksanaan_pembiayaan', 'pelaksanaan', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(83, 'edit-pembiayaan-pelaksanaan', 'Ubah', 'pelaksanaan_pembiayaan', 'pelaksanaan', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(84, 'remove-pembiayaan-pelaksanaan', 'Hapus', 'pelaksanaan_pembiayaan', 'pelaksanaan', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(85, 'select-peraturan-umum', 'Lihat', 'umum_peraturan', 'umum', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(86, 'add-peraturan-umum', 'Tambah', 'umum_peraturan', 'umum', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(87, 'edit-peraturan-umum', 'Ubah', 'umum_peraturan', 'umum', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(88, 'remove-peraturan-umum', 'Hapus', 'umum_peraturan', 'umum', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(89, 'export-peraturan-umum', 'Export', 'umum_peraturan', 'umum', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(90, 'select-keputusan-umum', 'Lihat', 'umum_keputusan', 'umum', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(91, 'add-keputusan-umum', 'Tambah', 'umum_keputusan', 'umum', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(92, 'edit-keputusan-umum', 'Ubah', 'umum_keputusan', 'umum', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(93, 'remove-keputusan-umum', 'Hapus', 'umum_keputusan', 'umum', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(94, 'export-keputusan-umum', 'Export', 'umum_keputusan', 'umum', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(95, 'select-inventaris-umum', 'Lihat', 'umum_inventaris', 'umum', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(96, 'add-inventaris-umum', 'Tambah', 'umum_inventaris', 'umum', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(97, 'edit-inventaris-umum', 'Ubah', 'umum_inventaris', 'umum', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(98, 'remove-inventaris-umum', 'Hapus', 'umum_inventaris', 'umum', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(99, 'export-inventaris-umum', 'Export', 'umum_inventaris', 'umum', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(100, 'select-aparat-umum', 'Lihat', 'umum_aparat', 'umum', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(101, 'add-aparat-umum', 'Tambah', 'umum_aparat', 'umum', '2017-05-11 00:21:04', '2017-05-11 00:21:04'),
(102, 'edit-aparat-umum', 'Ubah', 'umum_aparat', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(103, 'remove-aparat-umum', 'Hapus', 'umum_aparat', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(104, 'export-aparat-umum', 'Export', 'umum_aparat', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(105, 'select-tanah-kas-umum', 'Lihat', 'umum_tanah-kas', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(106, 'add-tanah-kas-umum', 'Tambah', 'umum_tanah-kas', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(107, 'edit-tanah-kas-umum', 'Ubah', 'umum_tanah-kas', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(108, 'remove-tanah-kas-umum', 'Hapus', 'umum_tanah-kas', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(109, 'export-tanah-kas-umum', 'Export', 'umum_tanah-kas', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(110, 'select-tanah-desa-umum', 'Lihat', 'umum_tanah-desa', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(111, 'add-tanah-desa-umum', 'Tambah', 'umum_tanah-desa', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(112, 'edit-tanah-desa-umum', 'Ubah', 'umum_tanah-desa', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(113, 'remove-tanah-desa-umum', 'Hapus', 'umum_tanah-desa', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(114, 'export-tanah-desa-umum', 'Export', 'umum_tanah-desa', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(115, 'select-agenda-umum', 'Lihat', 'umum_agenda', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(116, 'add-agenda-umum', 'Tambah', 'umum_agenda', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(117, 'edit-agenda-umum', 'Ubah', 'umum_agenda', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(118, 'remove-agenda-umum', 'Hapus', 'umum_agenda', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(119, 'export-agenda-umum', 'Export', 'umum_agenda', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(120, 'select-ekspedisi-umum', 'Lihat', 'umum_ekspedisi', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(121, 'add-ekspedisi-umum', 'Tambah', 'umum_ekspedisi', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(122, 'edit-ekspedisi-umum', 'Ubah', 'umum_ekspedisi', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(123, 'remove-ekspedisi-umum', 'Hapus', 'umum_ekspedisi', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(124, 'export-ekspedisi-umum', 'Export', 'umum_ekspedisi', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(125, 'select-lembar-berita-umum', 'Lihat', 'umum_lembar-berita', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(126, 'add-lembar-berita-umum', 'Tambah', 'umum_lembar-berita', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(127, 'edit-lembar-berita-umum', 'Ubah', 'umum_lembar-berita', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(128, 'remove-lembar-berita-umum', 'Hapus', 'umum_lembar-berita', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(129, 'export-lembar-berita-umum', 'Export', 'umum_lembar-berita', 'umum', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(130, 'select-rencana-kerja-pembangunan', 'Lihat', 'pembangunan_rencana-kerja', 'pembangunan', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(131, 'add-rencana-kerja-pembangunan', 'Tambah', 'pembangunan_rencana-kerja', 'pembangunan', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(132, 'edit-rencana-kerja-pembangunan', 'Ubah', 'pembangunan_rencana-kerja', 'pembangunan', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(133, 'remove-rencana-kerja-pembangunan', 'Hapus', 'pembangunan_rencana-kerja', 'pembangunan', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(134, 'export-rencana-kerja-pembangunan', 'Export', 'pembangunan_rencana-kerja', 'pembangunan', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(135, 'select-kegiatan-kerja-pembangunan', 'Lihat', 'pembangunan_kegiatan-kerja', 'pembangunan', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(136, 'add-kegiatan-kerja-pembangunan', 'Tambah', 'pembangunan_kegiatan-kerja', 'pembangunan', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(137, 'edit-kegiatan-kerja-pembangunan', 'Ubah', 'pembangunan_kegiatan-kerja', 'pembangunan', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(138, 'remove-kegiatan-kerja-pembangunan', 'Hapus', 'pembangunan_kegiatan-kerja', 'pembangunan', '2017-05-11 00:21:05', '2017-05-11 00:21:05'),
(139, 'export-kegiatan-kerja-pembangunan', 'Export', 'pembangunan_kegiatan-kerja', 'pembangunan', '2017-05-11 00:21:06', '2017-05-11 00:21:06'),
(140, 'select-inventaris-pembangunan', 'Lihat', 'pembangunan_inventaris', 'pembangunan', '2017-05-11 00:21:06', '2017-05-11 00:21:06'),
(141, 'add-inventaris-pembangunan', 'Tambah', 'pembangunan_inventaris', 'pembangunan', '2017-05-11 00:21:06', '2017-05-11 00:21:06'),
(142, 'edit-inventaris-pembangunan', 'Ubah', 'pembangunan_inventaris', 'pembangunan', '2017-05-11 00:21:06', '2017-05-11 00:21:06'),
(143, 'remove-inventaris-pembangunan', 'Hapus', 'pembangunan_inventaris', 'pembangunan', '2017-05-11 00:21:06', '2017-05-11 00:21:06'),
(144, 'export-inventaris-pembangunan', 'Export', 'pembangunan_inventaris', 'pembangunan', '2017-05-11 00:21:06', '2017-05-11 00:21:06'),
(145, 'select-pemberdayaan-masyarakat-pembangunan', 'Lihat', 'pembangunan_pemberdayaan-masyarakat', 'pembangunan', '2017-05-11 00:21:06', '2017-05-11 00:21:06'),
(146, 'add-pemberdayaan-masyarakat-pembangunan', 'Tambah', 'pembangunan_pemberdayaan-masyarakat', 'pembangunan', '2017-05-11 00:21:06', '2017-05-11 00:21:06'),
(147, 'edit-pemberdayaan-masyarakat-pembangunan', 'Ubah', 'pembangunan_pemberdayaan-masyarakat', 'pembangunan', '2017-05-11 00:21:06', '2017-05-11 00:21:06'),
(148, 'remove-pemberdayaan-masyarakat-pembangunan', 'Hapus', 'pembangunan_pemberdayaan-masyarakat', 'pembangunan', '2017-05-11 00:21:06', '2017-05-11 00:21:06'),
(149, 'export-pemberdayaan-masyarakat-pembangunan', 'Export', 'pembangunan_pemberdayaan-masyarakat', 'pembangunan', '2017-05-11 00:21:06', '2017-05-11 00:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(3, 1),
(3, 3),
(3, 4),
(4, 1),
(4, 4),
(5, 1),
(5, 4),
(6, 1),
(6, 4),
(7, 1),
(7, 3),
(7, 4),
(8, 1),
(8, 4),
(9, 1),
(9, 4),
(10, 1),
(10, 4),
(11, 1),
(11, 3),
(11, 4),
(12, 1),
(12, 4),
(13, 1),
(13, 4),
(14, 1),
(14, 4),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(19, 3),
(19, 4),
(20, 1),
(20, 4),
(21, 1),
(21, 4),
(22, 1),
(22, 4),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(28, 3),
(28, 4),
(29, 1),
(29, 4),
(30, 1),
(30, 4),
(31, 1),
(31, 4),
(32, 1),
(32, 4),
(33, 1),
(33, 4),
(34, 1),
(34, 4),
(35, 1),
(35, 4),
(36, 1),
(36, 3),
(36, 4),
(37, 1),
(37, 4),
(38, 1),
(38, 3),
(38, 4),
(39, 1),
(39, 4),
(40, 1),
(40, 4),
(41, 1),
(41, 3),
(41, 4),
(42, 1),
(42, 4),
(43, 1),
(43, 4),
(44, 1),
(44, 4),
(45, 1),
(45, 4),
(46, 1),
(46, 3),
(46, 4),
(47, 1),
(47, 4),
(48, 1),
(48, 4),
(49, 1),
(49, 4),
(50, 1),
(50, 4),
(51, 1),
(51, 2),
(51, 4),
(52, 1),
(52, 2),
(52, 3),
(52, 4),
(53, 1),
(53, 2),
(53, 4),
(54, 1),
(54, 2),
(54, 4),
(55, 1),
(55, 2),
(55, 4),
(56, 1),
(56, 2),
(56, 4),
(57, 1),
(57, 4),
(58, 1),
(58, 4),
(59, 1),
(59, 4),
(60, 1),
(60, 4),
(61, 1),
(61, 4),
(62, 1),
(62, 2),
(62, 3),
(62, 4),
(63, 1),
(63, 2),
(63, 3),
(63, 4),
(64, 1),
(64, 4),
(65, 1),
(65, 4),
(66, 1),
(66, 4),
(67, 1),
(67, 2),
(67, 3),
(67, 4),
(68, 1),
(68, 2),
(68, 3),
(68, 4),
(69, 1),
(69, 4),
(70, 1),
(70, 4),
(71, 1),
(71, 4),
(72, 1),
(72, 2),
(72, 3),
(72, 4),
(73, 1),
(73, 2),
(73, 3),
(73, 4),
(74, 1),
(74, 4),
(75, 1),
(75, 4),
(76, 1),
(76, 4),
(77, 1),
(77, 2),
(77, 3),
(77, 4),
(78, 1),
(78, 4),
(79, 1),
(79, 4),
(80, 1),
(80, 4),
(81, 1),
(81, 2),
(81, 3),
(81, 4),
(82, 1),
(82, 4),
(83, 1),
(83, 4),
(84, 1),
(84, 4),
(95, 1),
(95, 3),
(95, 4),
(96, 1),
(96, 4),
(97, 1),
(97, 4),
(98, 1),
(98, 4),
(99, 1),
(99, 4),
(100, 1),
(100, 3),
(100, 4),
(101, 1),
(101, 4),
(102, 1),
(102, 4),
(103, 1),
(103, 4),
(104, 1),
(104, 4);

-- --------------------------------------------------------

--
-- Table structure for table `profil_desa`
--

CREATE TABLE `profil_desa` (
  `kode` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `index` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profil_desa`
--

INSERT INTO `profil_desa` (`kode`, `index`, `value`, `created_at`, `updated_at`) VALUES
('alamat_desa', 'Alamat Desa', 'Jl. Mawar Selatan', '2017-05-11 00:21:07', '2017-05-11 00:42:09'),
('angkutan_umum', 'Ketersedian Anggkutan Umum', '', '2017-05-11 00:21:07', '2017-05-11 00:21:07'),
('bendahara', 'Bendahara', '', '2017-05-11 00:21:07', '2017-05-11 00:21:07'),
('des', 'Desa atau Kelurahan', 'Desa', '2017-05-11 00:21:07', '2017-05-11 00:21:07'),
('email', 'Email', '', '2017-05-11 00:21:07', '2017-05-11 00:21:07'),
('jarak_tempuh_kecamatan', 'Jarak Desa Ke Kecamatan', '', '2017-05-11 00:21:07', '2017-05-11 00:21:07'),
('jarak_tempuh_kota', 'Jarak Tempuh Ke Kota/Kabupaten', '', '2017-05-11 00:21:07', '2017-05-11 00:21:07'),
('kab', 'Kabupaten atau Kota', 'Kabupaten', '2017-05-11 00:21:07', '2017-05-11 00:21:07'),
('kec', 'Kecamatan', 'Kecamatan', '2017-05-11 00:21:07', '2017-05-11 00:21:07'),
('kecamatan', 'Kecamatan', 'Sagalaherang', '2017-05-11 00:21:07', '2017-05-11 00:41:09'),
('kepala_desa', 'Kepala Desa', 'Asep Suherman', '2017-05-11 00:21:07', '2017-05-11 00:39:51'),
('kode_kecamatan', 'Kode Kecamatan', '01', '2017-05-11 00:21:07', '2017-05-11 00:41:24'),
('kode_kota', 'Kode Kota/Kabupaten', '13', '2017-05-11 00:21:07', '2017-05-11 00:40:54'),
('kode_pos', 'Kode Pos', '', '2017-05-11 00:21:07', '2017-05-11 00:21:07'),
('kode_provinsi', 'Kode Provinsi', '32', '2017-05-11 00:21:06', '2017-05-11 00:40:34'),
('kota', 'Kota/Kabupaten', 'Subang', '2017-05-11 00:21:07', '2017-05-11 00:40:43'),
('logo_desa', 'Logo Desa', 'logo.png', '2017-05-11 00:21:08', '2017-05-11 00:21:08'),
('nama_bank_cabang', 'Nama Bank Cabang', '', '2017-05-11 00:21:07', '2017-05-11 00:21:07'),
('nama_desa', 'Nama Desa', 'Leles', '2017-05-11 00:21:07', '2017-05-11 00:39:13'),
('nomor_bank_cabang', 'Nomor Bank Cabang', '', '2017-05-11 00:21:07', '2017-05-11 00:21:07'),
('prov', 'Provinsi', 'Provinsi', '2017-05-11 00:21:08', '2017-05-11 00:21:08'),
('provinsi', 'Provinsi', 'Jawa Barat', '2017-05-11 00:21:07', '2017-05-11 00:40:27'),
('sebelah_barat', 'Sebelah Barat', '', '2017-05-11 00:21:07', '2017-05-11 00:21:07'),
('sebelah_selatan', 'Sebelah Selatan', '', '2017-05-11 00:21:07', '2017-05-11 00:21:07'),
('sebelah_timur', 'Sebelah Timur', '', '2017-05-11 00:21:07', '2017-05-11 00:21:07'),
('sebelah_utara', 'Sebelah Utara', '', '2017-05-11 00:21:07', '2017-05-11 00:21:07'),
('sekretaris', 'Sekretaris', 'Siti Sulastri', '2017-05-11 00:21:07', '2017-05-11 00:40:18'),
('telepon', 'Telepon', '', '2017-05-11 00:21:07', '2017-05-11 00:21:07'),
('waktu_tempuh_kecamatan', 'Waktu Tempuh Ke Kecamatan', '', '2017-05-11 00:21:07', '2017-05-11 00:21:07'),
('waktu_tempuh_kota', 'Waktu Tempuh Ke Kota/Kabupaten', '', '2017-05-11 00:21:07', '2017-05-11 00:21:07');

-- --------------------------------------------------------

--
-- Table structure for table `realisasi_belanja`
--

CREATE TABLE `realisasi_belanja` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor_bukti` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `metode` enum('Tunai','Bank') COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `belanja_id` int(10) UNSIGNED NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `realisasi_pembiayaan`
--

CREATE TABLE `realisasi_pembiayaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor_bukti` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `metode` enum('Tunai','Bank') COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `pembiayaan_id` int(10) UNSIGNED NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `realisasi_pendapatan`
--

CREATE TABLE `realisasi_pendapatan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor_bukti` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `metode` enum('Tunai','Bank') COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `pendapatan_id` int(10) UNSIGNED NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rkk`
--

CREATE TABLE `rkk` (
  `id` int(10) UNSIGNED NOT NULL,
  `sasaran_laki_laki` tinyint(4) NOT NULL,
  `sasaran_perempuan` tinyint(4) NOT NULL,
  `sasaran_a_rtm` tinyint(4) NOT NULL,
  `mulai` date NOT NULL,
  `selesai` date NOT NULL,
  `rkp_id` int(10) UNSIGNED NOT NULL,
  `detail_kegiatan_kerja_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rkp`
--

CREATE TABLE `rkp` (
  `id` int(10) UNSIGNED NOT NULL,
  `tahun` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rencana_kegiatan` text COLLATE utf8mb4_unicode_ci,
  `rpjm_id` int(10) UNSIGNED NOT NULL,
  `kegiatan_kerja_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rkp`
--

INSERT INTO `rkp` (`id`, `tahun`, `rencana_kegiatan`, `rpjm_id`, `kegiatan_kerja_id`, `created_at`, `updated_at`) VALUES
(1, '2017', NULL, 1, 3, '2017-06-16 18:43:48', '2017-06-16 18:43:48'),
(2, '2018', NULL, 1, 3, '2017-06-16 18:43:48', '2017-06-16 18:43:48'),
(3, '2019', NULL, 1, 3, '2017-06-16 18:43:48', '2017-06-16 18:43:48'),
(4, '2020', NULL, 1, 3, '2017-06-16 18:43:48', '2017-06-16 18:43:48'),
(5, '2021', NULL, 1, 3, '2017-06-16 18:43:48', '2017-06-16 18:43:48'),
(6, '2022', NULL, 1, 3, '2017-06-16 18:43:48', '2017-06-16 18:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'User Administrator', 'User is allowed to manage and edit other users', '2017-05-11 00:22:24', '2017-05-11 00:22:24'),
(2, 'Kades', 'Kepala Desa', NULL, '2017-05-11 00:30:08', '2017-05-11 00:30:08'),
(3, 'Sekdes', 'Sekertaris Desa', NULL, '2017-05-11 00:34:33', '2017-05-11 00:34:33'),
(4, 'Staff', 'Staff Desa', NULL, '2017-05-11 00:36:59', '2017-05-11 00:36:59');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `rpjm`
--

CREATE TABLE `rpjm` (
  `id` int(10) UNSIGNED NOT NULL,
  `periode` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_awal` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_akhir` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rpjm`
--

INSERT INTO `rpjm` (`id`, `periode`, `tahun_awal`, `tahun_akhir`, `created_at`, `updated_at`) VALUES
(1, '2017 - 2023', '2017', '2023', '2017-05-11 03:36:25', '2017-05-11 03:36:25');

-- --------------------------------------------------------

--
-- Table structure for table `r_ts`
--

CREATE TABLE `r_ts` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `petugas` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rw_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `r_ts`
--

INSERT INTO `r_ts` (`id`, `nama`, `petugas`, `rw_id`, `created_at`, `updated_at`) VALUES
(1, '01', 'Edi', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `r_ws`
--

CREATE TABLE `r_ws` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `petugas` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `r_ws`
--

INSERT INTO `r_ws` (`id`, `nama`, `petugas`, `created_at`, `updated_at`) VALUES
(1, '01', 'Agus', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `gambar`, `title`, `created_at`, `updated_at`) VALUES
(1, '1.jpg', 'Susana Desa', '2017-05-11 00:21:08', '2017-05-11 00:21:08'),
(3, '94455.png', 'asas', '2017-05-31 08:43:00', '2017-05-31 08:43:00'),
(4, '12448.png', 'asas', '2017-05-31 08:43:43', '2017-05-31 08:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `status_keluarga`
--

CREATE TABLE `status_keluarga` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_keluarga`
--

INSERT INTO `status_keluarga` (`id`, `kode`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'KK', 'Kepala Keluarga', NULL, NULL),
(2, 'Ist', 'Istri', NULL, NULL),
(3, 'AK', 'Anak Kandung', NULL, NULL),
(4, 'AA', 'Anak Angkat', NULL, NULL),
(5, 'Pemb', 'Pembantu', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sumber_dana`
--

CREATE TABLE `sumber_dana` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sumber_dana`
--

INSERT INTO `sumber_dana` (`id`, `nama`) VALUES
(1, 'Dana Desa (APBN)'),
(2, 'Alokasi Dana Desa'),
(3, 'Dana Bagian dari Hasil Pajak dan Retribusi'),
(4, 'APBD Provinsi'),
(5, 'APBD Kab/Kota');

-- --------------------------------------------------------

--
-- Table structure for table `surat_menyurat`
--

CREATE TABLE `surat_menyurat` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor_surat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_surat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemohon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_surat` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_menyurat`
--

INSERT INTO `surat_menyurat` (`id`, `nomor_surat`, `jenis_surat`, `pemohon`, `url`, `tanggal_surat`, `created_at`, `updated_at`) VALUES
(1, '1212', 'surat keterangan kelahiran', 'Asep Suherman', 'surat-keterangan-kelahiran11-may-2017asep-suherman.docx', '2017-05-11', '2017-05-11 10:16:29', '2017-05-11 10:16:29'),
(4, '5656', 'surat keterangan kelahiran', 'Siti Sulastri', 'surat-keterangan-kelahiran21-may-2017siti-sulastri.docx', '2017-05-21', '2017-05-21 06:17:21', '2017-05-21 06:17:21'),
(5, 'NOMOR/XI90/2012', 'surat keterangan usaha', 'Siti Sulastri', 'surat-keterangan-usaha16-june-2017siti-sulastri.docx', '2017-06-16', '2017-06-16 16:36:10', '2017-06-16 16:36:10'),
(6, '565612', 'surat keterangan domisili', 'Siti Sulastri', 'surat-keterangan-domisili16-june-2017siti-sulastri.docx', '2017-06-16', '2017-06-16 16:42:12', '2017-06-16 16:42:12'),
(7, '78787821', 'surat keterangan adon nikah', 'Asep Suherman', 'surat-keterangan-adon-nikah16-june-2017asep-suherman.docx', '2017-06-16', '2017-06-16 16:58:16', '2017-06-16 16:58:16'),
(8, '7878781221', 'surat keterangan izin rame rame', 'Asep Suherman', 'surat-keterangan-izin-rame-rame17-june-2017asep-suherman.docx', '2017-06-17', '2017-06-16 17:19:35', '2017-06-16 17:19:35'),
(9, '67868678', 'surat keterangan tanah', 'Siti Sulastri', 'surat-keterangan-tanah17-june-2017siti-sulastri.docx', '2017-06-17', '2017-06-16 17:46:43', '2017-06-16 17:46:43'),
(10, '1212121212', 'surat keterangan tanah', 'Siti Sulastri', 'surat-keterangan-tanah17-june-2017siti-sulastri.docx', '2017-06-17', '2017-06-16 17:52:54', '2017-06-16 17:52:54'),
(11, '1321321', 'surat keterangan kelahiran', 'Asep Suherman', 'surat-keterangan-kelahiran13-july-2017asep-suherman.docx', '2017-07-13', '2017-07-13 11:59:03', '2017-07-13 11:59:03');

-- --------------------------------------------------------

--
-- Table structure for table `tanah_desa`
--

CREATE TABLE `tanah_desa` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` tinyint(4) NOT NULL,
  `status_tanah` enum('hm','hgb','hp','hgu','hpl','ma','vi','tn') COLLATE utf8mb4_unicode_ci NOT NULL,
  `luas_status` tinyint(4) NOT NULL,
  `penggunaan_tanah` enum('Sawah','Tegalan','Kebun','Ternak / Tambak / Kolam','Tanah Kering / Darat','Hutan Belukar','Hutan Lebat / Lindung','Mutasi Tanah Di Desa','Tanah Kosong','Perumahan','Perdagangan dan Jasa','Perkantoran','Industri','Fasilitas Umum','lain-lain') COLLATE utf8mb4_unicode_ci NOT NULL,
  `luas_penggunaan` tinyint(4) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tanah_kas_desa` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tanah_kas_desa`
--

CREATE TABLE `tanah_kas_desa` (
  `id` int(10) UNSIGNED NOT NULL,
  `asal_tanah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `luas` tinyint(4) NOT NULL,
  `peroleh_tkd` enum('Asli Milik Desa','Pemerintah','Provinsi','Kabupaten','Lain-lain') COLLATE utf8mb4_unicode_ci NOT NULL,
  `luas_peroleh_tkd` tinyint(4) NOT NULL,
  `tanggal_peroleh` date NOT NULL,
  `luas_ada_patok` tinyint(4) NOT NULL,
  `luas_tidak_patok` tinyint(4) NOT NULL,
  `luas_ada_papan_nama` tinyint(4) NOT NULL,
  `luas_tidak_papan_nama` tinyint(4) NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manfaat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mutasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adm_surat`
--
ALTER TABLE `adm_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adm_surat_penanggung_jawab_id_foreign` (`penanggung_jawab_id`);

--
-- Indexes for table `anggota_keluarga`
--
ALTER TABLE `anggota_keluarga`
  ADD PRIMARY KEY (`nomor_kk`);

--
-- Indexes for table `aparat_desa`
--
ALTER TABLE `aparat_desa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aparat_desa_niap_unique` (`niap`),
  ADD UNIQUE KEY `aparat_desa_nip_unique` (`nip`),
  ADD KEY `aparat_desa_jabatan_id_foreign` (`jabatan_id`),
  ADD KEY `aparat_desa_nik_penduduk_foreign` (`nik_penduduk`);

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_kegiatan_kerja`
--
ALTER TABLE `detail_kegiatan_kerja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_kegiatan_kerja_kegiatan_kerja_id_foreign` (`kegiatan_kerja_id`),
  ADD KEY `detail_kegiatan_kerja_sumber_dana_id_foreign` (`sumber_dana_id`);

--
-- Indexes for table `inventaris_desa`
--
ALTER TABLE `inventaris_desa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventaris_desa_penanggung_jawab_id_foreign` (`penanggung_jawab_id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jabatan_kode_unique` (`kode`);

--
-- Indexes for table `kegiatan_kerja`
--
ALTER TABLE `kegiatan_kerja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kegiatan_kerja_bidang_id_foreign` (`bidang_id`),
  ADD KEY `kegiatan_kerja_rpjm_id_foreign` (`rpjm_id`),
  ADD KEY `kegiatan_kerja_kegiatan_kerja_id_foreign` (`kegiatan_kerja_id`);

--
-- Indexes for table `ktp`
--
ALTER TABLE `ktp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ktp_nik_unique` (`nik`);

--
-- Indexes for table `lembar_berita_desa`
--
ALTER TABLE `lembar_berita_desa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lembar_berita_desa_peraturan_id_unique` (`peraturan_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembiayaan`
--
ALTER TABLE `pembiayaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembiayaan_pembiayaan_id_foreign` (`pembiayaan_id`),
  ADD KEY `pembiayaan_bidang_id_foreign` (`bidang_id`);

--
-- Indexes for table `pendapatan`
--
ALTER TABLE `pendapatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendapatan_pendapatan_id_foreign` (`pendapatan_id`),
  ADD KEY `pendapatan_bidang_id_foreign` (`bidang_id`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penduduk_induk`
--
ALTER TABLE `penduduk_induk`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `penduduk_induk_pekerjaan_id_foreign` (`pekerjaan_id`),
  ADD KEY `penduduk_induk_status_keluarga_id_foreign` (`status_keluarga_id`),
  ADD KEY `penduduk_induk_penduduk_id_foreign` (`penduduk_id`),
  ADD KEY `penduduk_induk_nomor_kk_foreign` (`nomor_kk`),
  ADD KEY `penduduk_induk_rt_id_foreign` (`rt_id`),
  ADD KEY `penduduk_induk_rw_id_foreign` (`rw_id`),
  ADD KEY `penduduk_induk_nik_ayah_foreign` (`nik_ayah`),
  ADD KEY `penduduk_induk_nik_ibu_foreign` (`nik_ibu`);

--
-- Indexes for table `penduduk_mutasi`
--
ALTER TABLE `penduduk_mutasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penduduk_mutasi_nik_unique` (`nik`),
  ADD KEY `penduduk_mutasi_penduduk_id_foreign` (`penduduk_id`);

--
-- Indexes for table `penduduk_sementara`
--
ALTER TABLE `penduduk_sementara`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penduduk_sementara_pekerjaan_id_foreign` (`pekerjaan_id`),
  ADD KEY `penduduk_sementara_penduduk_id_foreign` (`penduduk_id`);

--
-- Indexes for table `peraturan_desa`
--
ALTER TABLE `peraturan_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `profil_desa`
--
ALTER TABLE `profil_desa`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `realisasi_belanja`
--
ALTER TABLE `realisasi_belanja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `realisasi_belanja_belanja_id_foreign` (`belanja_id`);

--
-- Indexes for table `realisasi_pembiayaan`
--
ALTER TABLE `realisasi_pembiayaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `realisasi_pembiayaan_pembiayaan_id_foreign` (`pembiayaan_id`);

--
-- Indexes for table `realisasi_pendapatan`
--
ALTER TABLE `realisasi_pendapatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `realisasi_pendapatan_pendapatan_id_foreign` (`pendapatan_id`);

--
-- Indexes for table `rkk`
--
ALTER TABLE `rkk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rkk_detail_kegiatan_kerja_id_foreign` (`detail_kegiatan_kerja_id`),
  ADD KEY `rkk_rkp_id_foreign` (`rkp_id`);

--
-- Indexes for table `rkp`
--
ALTER TABLE `rkp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rkp_rpjm_id_foreign` (`rpjm_id`),
  ADD KEY `rkp_kegiatan_kerja_id_foreign` (`kegiatan_kerja_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `rpjm`
--
ALTER TABLE `rpjm`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rpjm_periode_unique` (`periode`);

--
-- Indexes for table `r_ts`
--
ALTER TABLE `r_ts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `r_ts_rw_id_foreign` (`rw_id`);

--
-- Indexes for table `r_ws`
--
ALTER TABLE `r_ws`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_keluarga`
--
ALTER TABLE `status_keluarga`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status_keluarga_kode_unique` (`kode`);

--
-- Indexes for table `sumber_dana`
--
ALTER TABLE `sumber_dana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_menyurat`
--
ALTER TABLE `surat_menyurat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `surat_menyurat_nomor_surat_unique` (`nomor_surat`);

--
-- Indexes for table `tanah_desa`
--
ALTER TABLE `tanah_desa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tanah_desa_id_tanah_kas_desa_foreign` (`id_tanah_kas_desa`);

--
-- Indexes for table `tanah_kas_desa`
--
ALTER TABLE `tanah_kas_desa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adm_surat`
--
ALTER TABLE `adm_surat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `aparat_desa`
--
ALTER TABLE `aparat_desa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `detail_kegiatan_kerja`
--
ALTER TABLE `detail_kegiatan_kerja`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `inventaris_desa`
--
ALTER TABLE `inventaris_desa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kegiatan_kerja`
--
ALTER TABLE `kegiatan_kerja`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ktp`
--
ALTER TABLE `ktp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lembar_berita_desa`
--
ALTER TABLE `lembar_berita_desa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=351;
--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pembiayaan`
--
ALTER TABLE `pembiayaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pendapatan`
--
ALTER TABLE `pendapatan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `penduduk_mutasi`
--
ALTER TABLE `penduduk_mutasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penduduk_sementara`
--
ALTER TABLE `penduduk_sementara`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `peraturan_desa`
--
ALTER TABLE `peraturan_desa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;
--
-- AUTO_INCREMENT for table `realisasi_belanja`
--
ALTER TABLE `realisasi_belanja`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `realisasi_pembiayaan`
--
ALTER TABLE `realisasi_pembiayaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `realisasi_pendapatan`
--
ALTER TABLE `realisasi_pendapatan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rkk`
--
ALTER TABLE `rkk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rkp`
--
ALTER TABLE `rkp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rpjm`
--
ALTER TABLE `rpjm`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_ts`
--
ALTER TABLE `r_ts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_ws`
--
ALTER TABLE `r_ws`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `status_keluarga`
--
ALTER TABLE `status_keluarga`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sumber_dana`
--
ALTER TABLE `sumber_dana`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `surat_menyurat`
--
ALTER TABLE `surat_menyurat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tanah_desa`
--
ALTER TABLE `tanah_desa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tanah_kas_desa`
--
ALTER TABLE `tanah_kas_desa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `adm_surat`
--
ALTER TABLE `adm_surat`
  ADD CONSTRAINT `adm_surat_penanggung_jawab_id_foreign` FOREIGN KEY (`penanggung_jawab_id`) REFERENCES `aparat_desa` (`id`);

--
-- Constraints for table `aparat_desa`
--
ALTER TABLE `aparat_desa`
  ADD CONSTRAINT `aparat_desa_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id`),
  ADD CONSTRAINT `aparat_desa_nik_penduduk_foreign` FOREIGN KEY (`nik_penduduk`) REFERENCES `penduduk_induk` (`nik`) ON DELETE CASCADE;

--
-- Constraints for table `detail_kegiatan_kerja`
--
ALTER TABLE `detail_kegiatan_kerja`
  ADD CONSTRAINT `detail_kegiatan_kerja_kegiatan_kerja_id_foreign` FOREIGN KEY (`kegiatan_kerja_id`) REFERENCES `kegiatan_kerja` (`id`),
  ADD CONSTRAINT `detail_kegiatan_kerja_sumber_dana_id_foreign` FOREIGN KEY (`sumber_dana_id`) REFERENCES `sumber_dana` (`id`);

--
-- Constraints for table `inventaris_desa`
--
ALTER TABLE `inventaris_desa`
  ADD CONSTRAINT `inventaris_desa_penanggung_jawab_id_foreign` FOREIGN KEY (`penanggung_jawab_id`) REFERENCES `aparat_desa` (`id`);

--
-- Constraints for table `kegiatan_kerja`
--
ALTER TABLE `kegiatan_kerja`
  ADD CONSTRAINT `kegiatan_kerja_bidang_id_foreign` FOREIGN KEY (`bidang_id`) REFERENCES `bidang` (`id`),
  ADD CONSTRAINT `kegiatan_kerja_kegiatan_kerja_id_foreign` FOREIGN KEY (`kegiatan_kerja_id`) REFERENCES `kegiatan_kerja` (`id`),
  ADD CONSTRAINT `kegiatan_kerja_rpjm_id_foreign` FOREIGN KEY (`rpjm_id`) REFERENCES `rpjm` (`id`);

--
-- Constraints for table `ktp`
--
ALTER TABLE `ktp`
  ADD CONSTRAINT `ktp_nik_foreign` FOREIGN KEY (`nik`) REFERENCES `penduduk_induk` (`nik`) ON DELETE CASCADE;

--
-- Constraints for table `lembar_berita_desa`
--
ALTER TABLE `lembar_berita_desa`
  ADD CONSTRAINT `lembar_berita_desa_peraturan_id_foreign` FOREIGN KEY (`peraturan_id`) REFERENCES `peraturan_desa` (`id`);

--
-- Constraints for table `pembiayaan`
--
ALTER TABLE `pembiayaan`
  ADD CONSTRAINT `pembiayaan_bidang_id_foreign` FOREIGN KEY (`bidang_id`) REFERENCES `bidang` (`id`),
  ADD CONSTRAINT `pembiayaan_pembiayaan_id_foreign` FOREIGN KEY (`pembiayaan_id`) REFERENCES `pembiayaan` (`id`);

--
-- Constraints for table `pendapatan`
--
ALTER TABLE `pendapatan`
  ADD CONSTRAINT `pendapatan_bidang_id_foreign` FOREIGN KEY (`bidang_id`) REFERENCES `bidang` (`id`),
  ADD CONSTRAINT `pendapatan_pendapatan_id_foreign` FOREIGN KEY (`pendapatan_id`) REFERENCES `pendapatan` (`id`);

--
-- Constraints for table `penduduk_induk`
--
ALTER TABLE `penduduk_induk`
  ADD CONSTRAINT `penduduk_induk_nik_ayah_foreign` FOREIGN KEY (`nik_ayah`) REFERENCES `penduduk_induk` (`nik`) ON DELETE CASCADE,
  ADD CONSTRAINT `penduduk_induk_nik_ibu_foreign` FOREIGN KEY (`nik_ibu`) REFERENCES `penduduk_induk` (`nik`) ON DELETE CASCADE,
  ADD CONSTRAINT `penduduk_induk_nomor_kk_foreign` FOREIGN KEY (`nomor_kk`) REFERENCES `anggota_keluarga` (`nomor_kk`),
  ADD CONSTRAINT `penduduk_induk_pekerjaan_id_foreign` FOREIGN KEY (`pekerjaan_id`) REFERENCES `pekerjaan` (`id`),
  ADD CONSTRAINT `penduduk_induk_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`id`),
  ADD CONSTRAINT `penduduk_induk_rt_id_foreign` FOREIGN KEY (`rt_id`) REFERENCES `r_ts` (`id`),
  ADD CONSTRAINT `penduduk_induk_rw_id_foreign` FOREIGN KEY (`rw_id`) REFERENCES `r_ws` (`id`),
  ADD CONSTRAINT `penduduk_induk_status_keluarga_id_foreign` FOREIGN KEY (`status_keluarga_id`) REFERENCES `status_keluarga` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penduduk_mutasi`
--
ALTER TABLE `penduduk_mutasi`
  ADD CONSTRAINT `penduduk_mutasi_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`id`);

--
-- Constraints for table `penduduk_sementara`
--
ALTER TABLE `penduduk_sementara`
  ADD CONSTRAINT `penduduk_sementara_pekerjaan_id_foreign` FOREIGN KEY (`pekerjaan_id`) REFERENCES `pekerjaan` (`id`),
  ADD CONSTRAINT `penduduk_sementara_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `realisasi_belanja`
--
ALTER TABLE `realisasi_belanja`
  ADD CONSTRAINT `realisasi_belanja_belanja_id_foreign` FOREIGN KEY (`belanja_id`) REFERENCES `rkp` (`id`);

--
-- Constraints for table `realisasi_pembiayaan`
--
ALTER TABLE `realisasi_pembiayaan`
  ADD CONSTRAINT `realisasi_pembiayaan_pembiayaan_id_foreign` FOREIGN KEY (`pembiayaan_id`) REFERENCES `pembiayaan` (`id`);

--
-- Constraints for table `realisasi_pendapatan`
--
ALTER TABLE `realisasi_pendapatan`
  ADD CONSTRAINT `realisasi_pendapatan_pendapatan_id_foreign` FOREIGN KEY (`pendapatan_id`) REFERENCES `pendapatan` (`id`);

--
-- Constraints for table `rkk`
--
ALTER TABLE `rkk`
  ADD CONSTRAINT `rkk_detail_kegiatan_kerja_id_foreign` FOREIGN KEY (`detail_kegiatan_kerja_id`) REFERENCES `detail_kegiatan_kerja` (`id`),
  ADD CONSTRAINT `rkk_rkp_id_foreign` FOREIGN KEY (`rkp_id`) REFERENCES `rkp` (`id`);

--
-- Constraints for table `rkp`
--
ALTER TABLE `rkp`
  ADD CONSTRAINT `rkp_kegiatan_kerja_id_foreign` FOREIGN KEY (`kegiatan_kerja_id`) REFERENCES `kegiatan_kerja` (`id`),
  ADD CONSTRAINT `rkp_rpjm_id_foreign` FOREIGN KEY (`rpjm_id`) REFERENCES `rpjm` (`id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `aparat_desa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_ts`
--
ALTER TABLE `r_ts`
  ADD CONSTRAINT `r_ts_rw_id_foreign` FOREIGN KEY (`rw_id`) REFERENCES `r_ws` (`id`);

--
-- Constraints for table `tanah_desa`
--
ALTER TABLE `tanah_desa`
  ADD CONSTRAINT `tanah_desa_id_tanah_kas_desa_foreign` FOREIGN KEY (`id_tanah_kas_desa`) REFERENCES `tanah_kas_desa` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
