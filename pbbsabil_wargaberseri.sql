-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2021 at 05:39 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pbbsabil_wargaberseri`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`pbbsabil`@`localhost` FUNCTION `cek_iuran` (`bulan` VARCHAR(20), `tahun` YEAR) RETURNS BIGINT(20) NO SQL
BEGIN
                 DECLARE hasil INT DEFAULT 0;
                 SELECT SUM(nominal) INTO hasil FROM data_iuran_warga
                 WHERE data_iuran_warga.bulan_iuran = bulan AND data_iuran_warga.tahun_iuran = tahun AND data_iuran_warga.status_iuran = 'Lunas' ;
                  RETURN hasil;
              END$$

CREATE DEFINER=`pbbsabil`@`localhost` FUNCTION `cek_pemasukan` (`bulan` VARCHAR(20), `tahun` INT) RETURNS BIGINT(20) BEGIN
                 DECLARE hasil INT DEFAULT 0;
                 SELECT SUM(jumlah_pemasukan) INTO hasil FROM data_pemasukan_iuran
                 WHERE data_pemasukan_iuran.bulan_pemasukan = bulan AND data_pemasukan_iuran.tahun_pemasukan = tahun;
                  RETURN hasil;
              END$$

CREATE DEFINER=`pbbsabil`@`localhost` FUNCTION `cek_pengeluaran` (`bulan` VARCHAR(20), `tahun` INT) RETURNS BIGINT(20) BEGIN
                     DECLARE hasil INT DEFAULT 0;
                     SELECT SUM(jumlah_pengeluaran) INTO hasil FROM data_penggunaan_iuran
                     WHERE data_penggunaan_iuran.bulan_penggunaan = bulan AND data_penggunaan_iuran.tahun_penggunaan = tahun;
                      RETURN hasil;
                  END$$

CREATE DEFINER=`pbbsabil`@`localhost` FUNCTION `cek_tagihan` (`bulan` VARCHAR(20), `tahun` YEAR) RETURNS BIGINT(20) NO SQL
BEGIN
                 DECLARE hasil INT DEFAULT 0;
                 SELECT SUM(nominal) INTO hasil FROM data_iuran_warga
                 WHERE data_iuran_warga.bulan_iuran = bulan AND data_iuran_warga.tahun_iuran = tahun AND data_iuran_warga.status_iuran = 'Belum Lunas' ;
                  RETURN hasil;
              END$$

CREATE DEFINER=`pbbsabil`@`localhost` FUNCTION `friwayat_pembayaran_iuran` (`tagihan` INT) RETURNS INT(11) NO SQL
BEGIN
DECLARE status VARCHAR(255);
DECLARE hasil VARCHAR(255);
SELECT IF(tanggal_diterima IS NOT NULL, 'Benar', 'Salah') INTO status FROM riwayat_pembayaran_iuran WHERE no_tagihan=tagihan;
IF status = 'Benar' THEN
SET hasil = 'Sudah Bayar Iuran';
ELSE 
SET hasil = 'Belum Bayar Iuran';
END IF;
RETURN(hasil);
END$$

CREATE DEFINER=`pbbsabil`@`localhost` FUNCTION `ftotal_warga` () RETURNS VARCHAR(100) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci NO SQL
BEGIN
DECLARE total VARCHAR(100);
SELECT COUNT(id_warga) INTO total FROM pendataan_warga;
RETURN total;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `agama`
--

CREATE TABLE `agama` (
  `id` int(10) UNSIGNED NOT NULL,
  `agama` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`id`, `agama`) VALUES
(1, 'Islam'),
(2, 'Kristen Protestan'),
(3, 'Kristen Katolik'),
(4, 'Budha'),
(5, 'Hindu'),
(6, 'Konghucu');

-- --------------------------------------------------------

--
-- Table structure for table `aspirasi`
--

CREATE TABLE `aspirasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_wa` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_aspirasi` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aspirasi` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_kirim` datetime NOT NULL,
  `aktif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aspirasi`
--

INSERT INTO `aspirasi` (`id`, `nama`, `email`, `no_wa`, `jenis_aspirasi`, `aspirasi`, `status`, `bukti`, `waktu_kirim`, `aktif`) VALUES
(3, 'Eva Sofia', '', '12312', 'kebersihan', 'asdasd', 'Sedang diproses', '75_-Manfaat-jogging-untuk-kesehatan-anda.jpg', '2021-07-19 11:38:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_post` datetime NOT NULL,
  `terakhir_diubah` datetime NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `penulis`, `waktu_post`, `terakhir_diubah`, `thumbnail`) VALUES
(10, 'Berita Waspada Covid-19', 'Wajib CTPS (Cuci Tangan Pakai Sabun), wajib pakai masker, wajib jaga jarak aman, dan dilarang berkerumun. Pemudik dari zona merah (Jakarta, Bekasi, Bogor, Bandung, dll). Dilarang masuk Perumahan Permata Buah Batu', 'Januarizqi', '2021-07-06 20:00:52', '2021-07-06 20:00:52', 'PBB-Eflyer-PSBB-01-1-1086x1536.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(10) UNSIGNED NOT NULL,
  `header` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

CREATE TABLE `dashboard` (
  `id` int(10) UNSIGNED NOT NULL,
  `header` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `side_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dashboard`
--

INSERT INTO `dashboard` (`id`, `header`, `title`, `content`, `footer`, `icon`, `side_logo`, `logo`) VALUES
(1, 'About Application', 'Warga Berseri', 'SELAMAT DATANG DI APLIKASI PERUMAHAN PERMATA BUAH BATU', 'Editor: Januarizqi Dwi Mileniantoro', '', 'PBB', 'pbb.png'),
(2, '<h2 class=\"text-white text-capitalize\"></i>Warga<span class=\"text-color\"> Berseri</span></h2>', 'Warga Berseri', '<span class=\"h6 d-inline-block mb-4 subhead text-uppercase\">Warga Berseri</span>\r\n					<h1 class=\"text-uppercase text-white mb-5\">Perumahan <span class=\"text-color\">Permata</span><br>Buah Batu</h1>', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `data_aspirasi_warga`
--

CREATE TABLE `data_aspirasi_warga` (
  `no_tiket` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_detail_warga` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_aspirasi` date DEFAULT NULL,
  `jenis_aspirasi` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aspirasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_aspirasi` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `respon_aspirasi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_admin` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_fasilitas`
--

CREATE TABLE `data_fasilitas` (
  `no` int(10) UNSIGNED NOT NULL,
  `nama_lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fasilitas_lokasi` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_lokasi` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_fasilitas`
--

INSERT INTO `data_fasilitas` (`no`, `nama_lokasi`, `fasilitas_lokasi`, `alamat_lokasi`, `foto_lokasi`, `lat`, `long`) VALUES
(19, 'Taman Bermain', 'Seluncuran, Bianglala, Jungkat jungkit', 'Jl. Komp. Permata Buah Batu No.A-25, Lengkong, Kec. Bojongsoang, Bandung, Jawa Barat 40287', 'https://warga-berseri.pbbsabilulungan.com/uploads/foto_lokasi/tong.jpg', '-6.9735963', '107.6390737');

-- --------------------------------------------------------

--
-- Table structure for table `data_iuran_warga`
--

CREATE TABLE `data_iuran_warga` (
  `no_tagihan` int(10) UNSIGNED NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bulan_iuran` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_iuran` year(4) NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pembayaran` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_iuran` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Belum Lunas',
  `nominal` int(11) DEFAULT NULL,
  `id_warga` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_iuran_warga`
--

INSERT INTO `data_iuran_warga` (`no_tagihan`, `jenis`, `bulan_iuran`, `tahun_iuran`, `nama`, `tanggal_pembayaran`, `bukti_pembayaran`, `status_iuran`, `nominal`, `id_warga`) VALUES
(2107013732, 'Wajib', 'Jul', 2021, 'Dhea Amalia', '07/02/2021', 'Pembayaran Tunai', 'Lunas', 200000, 'W-PBB-006'),
(2107013734, 'Wajib', 'Jul', 2021, 'Davina Dwi Andriani', NULL, NULL, 'Belum Lunas', 100000, 'W-PBB-008'),
(2107052013, 'wajib', 'Jul', 2021, 'Bagus Pribadi', NULL, NULL, 'Belum Lunas', 200000, 'W-PBB-005'),
(2107070538, 'wajib', 'Jul', 2021, 'Novia Maulida Wijaya', NULL, NULL, 'Belum Lunas', 100000, 'W-PBB-009'),
(2107075531, 'wajib', 'Jul', 2021, 'Wanda Artabella', NULL, NULL, 'Belum Lunas', 150000, 'W-PBB-010'),
(2107081318, 'Wajib', 'Jul', 2021, 'Kinan', NULL, NULL, 'Belum Lunas', 100000, 'W-PBB-004'),
(2107083532, 'Wajib', 'Jul', 2021, 'Goung Chen', NULL, NULL, 'Belum Lunas', 100000, 'W-PBB-003'),
(2107094461, 'wajib', 'Jul', 2021, 'Muhammad Arbi', NULL, NULL, 'Belum Lunas', 100000, 'W-PBB-011'),
(2107100915, 'Wajib', 'Jul', 2021, 'Papam Maulana', NULL, NULL, 'Belum Lunas', 100000, 'W-PBB-001'),
(2107100916, 'Wajib', 'Jul', 2021, 'Asep Mansyur', NULL, NULL, 'Belum Lunas', 100000, 'W-PBB-002'),
(2107100930, 'Tambahan', 'Jul', 2021, 'Papam Maulana', NULL, NULL, 'Belum Lunas', 50000, 'W-PBB-001'),
(2107100931, 'Tambahan', 'Jul', 2021, 'Asep Mansyur', NULL, NULL, 'Belum Lunas', 50000, 'W-PBB-002'),
(2107100932, 'Tambahan', 'Jul', 2021, 'Goung Chen', '07/01/2021', '/uploads/bukti_pembayaran_iuran/Screen_Shot_2021-06-22_at_21_24_334.png', 'Belum Diverifikasi', 50000, 'W-PBB-003'),
(2107115123, 'tambahan', 'Jul', 2021, 'Papam Maulana', NULL, NULL, 'Belum Lunas', 100, 'W-PBB-001'),
(2107115124, 'tambahan', 'Jul', 2021, 'Asep Mansyur', NULL, NULL, 'Belum Lunas', 100, 'W-PBB-002'),
(2107115125, 'tambahan', 'Jul', 2021, 'Goung Chen', NULL, NULL, 'Belum Lunas', 100, 'W-PBB-003'),
(2107115126, 'tambahan', 'Jul', 2021, 'Kinan', NULL, NULL, 'Belum Lunas', 100, 'W-PBB-004'),
(2107115127, 'tambahan', 'Jul', 2021, 'Bagus Pribady', NULL, NULL, 'Belum Lunas', 100, 'W-PBB-005'),
(2107115128, 'tambahan', 'Jul', 2021, 'Dhea Amalia', NULL, NULL, 'Belum Lunas', 100, 'W-PBB-006'),
(2107115129, 'tambahan', 'Jul', 2021, 'Davina Dwi Andriani', NULL, NULL, 'Belum Lunas', 100, 'W-PBB-008'),
(2107115130, 'tambahan', 'Jul', 2021, 'Novia Maulida Wijaya', NULL, NULL, 'Belum Lunas', 100, 'W-PBB-009'),
(2107115131, 'tambahan', 'Jul', 2021, 'Wanda Artabella', NULL, NULL, 'Belum Lunas', 100, 'W-PBB-010'),
(2107115132, 'tambahan', 'Jul', 2021, 'Muhammad Arbi', NULL, NULL, 'Belum Lunas', 100, 'W-PBB-011');

-- --------------------------------------------------------

--
-- Table structure for table `data_keuangan_iuran`
--

CREATE TABLE `data_keuangan_iuran` (
  `id_data_keuangan` int(10) UNSIGNED NOT NULL,
  `bulan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` year(4) NOT NULL,
  `jumlah_warga` int(11) NOT NULL,
  `jumlah_sudah_bayar` int(11) NOT NULL,
  `jumlah_belum_bayar` int(11) NOT NULL,
  `total_saldo` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_keuangan_iuran`
--

INSERT INTO `data_keuangan_iuran` (`id_data_keuangan`, `bulan`, `tahun`, `jumlah_warga`, `jumlah_sudah_bayar`, `jumlah_belum_bayar`, `total_saldo`) VALUES
(9, 'Jul', 2021, 10, 1, 9, 150000),
(14, '', 0000, 0, 0, 0, 350000);

-- --------------------------------------------------------

--
-- Table structure for table `data_pemasukan_iuran`
--

CREATE TABLE `data_pemasukan_iuran` (
  `id_pemasukan` int(10) UNSIGNED NOT NULL,
  `nama_pemasukan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_pemasukan` int(11) NOT NULL,
  `bulan_pemasukan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_pemasukan` year(4) NOT NULL,
  `tanggal_pemasukan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_pemasukan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_admin` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_penggunaan_iuran`
--

CREATE TABLE `data_penggunaan_iuran` (
  `id_penggunaan` int(10) UNSIGNED NOT NULL,
  `nama_kebutuhan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_pengeluaran` int(11) NOT NULL,
  `bulan_penggunaan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_penggunaan` year(4) NOT NULL,
  `tanggal_penggunaan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_pengeluaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_admin` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_warga`
--

CREATE TABLE `detail_warga` (
  `id_warga` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_detail_warga` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_warga` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Kepala Keluarga','Anggota Keluarga') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan` enum('Belum Sekolah','TK','SD','SMP','SMA','Diploma','S1','S2','S3') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` enum('Tidak Bekerja','Wiraswasta','Buruh Harian Lepas','Pegawai Negeri','Pegawai Swasta','Guru','Petani','Mahasiswa','Ibu Rumah Tangga') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hubungan_keluarga` enum('Anak','Istri','Suami','Kerabat','Adik','Kaka','Orang Tua') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_perkawinan` enum('Kawin','Belum Kawin','Janda','Duda') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_hunian` enum('KTP lengkong tinggal di Lengkong','KTP luar tinggal di Lengkong','KTP lengkong tinggal di luar') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profile` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_ktp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_verifikasi` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1 = Belum Terverif, 2 = Terverif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_warga`
--

INSERT INTO `detail_warga` (`id_warga`, `id_detail_warga`, `nama_warga`, `nik`, `status`, `no_hp`, `jenis_kelamin`, `agama`, `tempat_lahir`, `tanggal_lahir`, `pendidikan`, `pekerjaan`, `hubungan_keluarga`, `status_perkawinan`, `status_hunian`, `foto_profile`, `file_ktp`, `status_verifikasi`) VALUES
('W-PBB-001', 'W-001', 'Papam Maulana', '3515473471053681', 'Kepala Keluarga', '085312127191', 'Laki-laki', 'Islam', 'Bandung', '1998-05-01', 'SMP', 'Pegawai Swasta', 'Suami', 'Kawin', 'KTP luar tinggal di Lengkong', 'user-6.jpg', 'download.jpg', '2'),
('W-PBB-002', 'W-002', 'Asep Mansyur', '3515473471000031', 'Kepala Keluarga', '08969970456', 'Laki-laki', 'Kristen', 'Jakarta', '1996-07-20', 'S2', 'Pegawai Negeri', 'Suami', 'Belum Kawin', 'KTP luar tinggal di Lengkong', 'user-5.jpg', 'download1.jpg', '2'),
('W-PBB-003', 'W-004', 'Goung Chen', '1234567890768545', 'Kepala Keluarga', '082219725523', 'Laki-laki', 'Kristen', 'Bandung', '2000-02-04', 'S3', 'Tidak Bekerja', 'Orang Tua', 'Belum Kawin', 'KTP lengkong tinggal di Lengkong', 'profile_1625658067.jpeg', 'KTP3.jpeg', '2'),
('W-PBB-003', 'W-005', 'Green Nam', '1234567890123456', 'Anggota Keluarga', '081322127897', 'Perempuan', NULL, 'Sukabumi', '2021-07-09', 'SD', 'Buruh Harian Lepas', 'Kerabat', 'Duda', 'KTP luar tinggal di Lengkong', NULL, 'ktp.jpeg', '2'),
('W-PBB-004', 'W-006', 'Kinan', '3217629501857293', 'Kepala Keluarga', '082287909222', 'Perempuan', 'Islam', 'Tasikmalaya', '2004-01-05', 'Diploma', 'Tidak Bekerja', 'Istri', 'Belum Kawin', 'KTP luar tinggal di Lengkong', NULL, 'download_(1)1.jpg', '2'),
('W-PBB-004', 'W-007', 'Green Nam', '1234567890123456', 'Anggota Keluarga', '082118971019912', 'Laki-laki', 'Islam', 'SUKABUMI', '2021-04-09', 'SD', 'Wiraswasta', 'Anak', 'Kawin', 'KTP lengkong tinggal di Lengkong', NULL, 'ktp2.jpeg', '2'),
('W-PBB-005', 'W-008', 'Bagus Pribady', '9872918297621119', 'Kepala Keluarga', '089919768827', 'Laki-laki', 'Islam', 'Jogja', '2021-06-08', 'Diploma', 'Buruh Harian Lepas', 'Anak', 'Belum Kawin', 'KTP lengkong tinggal di luar', NULL, NULL, '2'),
('W-PBB-006', 'W-009', 'Dhea Amalia', '1234768959000006', 'Kepala Keluarga', '087798654434', 'Perempuan', 'Kristen', 'Bogor', '2000-05-13', 'SMA', 'Buruh Harian Lepas', 'Anak', 'Belum Kawin', 'KTP lengkong tinggal di Lengkong', NULL, NULL, '2'),
('W-PBB-001', 'W-010', 'Naufal Sahlan Maulana', '1234564367800007', 'Anggota Keluarga', '089766123453', 'Perempuan', 'Islam', 'Medan', '2000-05-25', 'SD', 'Mahasiswa', 'Anak', 'Belum Kawin', 'KTP lengkong tinggal di Lengkong', NULL, 'KTP4.jpeg', '2'),
('W-PBB-001', 'W-011', 'Wildan Maulana', '1234567582908729', 'Anggota Keluarga', '089726789213', 'Laki-laki', 'Islam', 'Solo', '2021-05-13', 'SD', 'Mahasiswa', 'Anak', 'Belum Kawin', 'KTP lengkong tinggal di Lengkong', NULL, 'KTP6.jpeg', '2'),
('W-PBB-002', 'W-012', 'Yusuf Mansyur', '1234567826790008', 'Anggota Keluarga', '082273692271', 'Perempuan', 'Islam', 'Gorontalo', '', 'SD', 'Wiraswasta', 'Adik', 'Duda', 'KTP luar tinggal di Lengkong', NULL, 'KTP61.jpeg', '2'),
('W-PBB-003', 'W-013', 'Pak Choy', '1982763900087903', 'Anggota Keluarga', '082293872657', 'Laki-laki', 'Katolik', 'Gorontalo', '1995-06-16', 'SMP', 'Buruh Harian Lepas', 'Adik', 'Belum Kawin', 'KTP lengkong tinggal di Lengkong', NULL, 'KTP62.jpeg', '2'),
('W-PBB-008', 'W-015', 'Davina Dwi Andriani', '1356472879390009', 'Kepala Keluarga', '082278918876', 'Perempuan', 'Islam', 'SUKABUMI', '2001-03-21', 'SMA', 'Pegawai Swasta', 'Kerabat', 'Belum Kawin', 'KTP lengkong tinggal di Lengkong', NULL, NULL, '2'),
('W-PBB-009', 'W-016', 'Novia Maulida Wijaya', '1234546789000798', 'Kepala Keluarga', '089929187726', 'Perempuan', 'Islam', 'Bogor', '1999-08-13', 'Diploma', 'Pegawai Negeri', 'Kerabat', 'Belum Kawin', 'KTP lengkong tinggal di Lengkong', NULL, NULL, '2'),
('W-PBB-002', 'W-018', 'Jinan', '124686898798', 'Anggota Keluarga', '082589769987', 'Perempuan', 'Islam', 'Sukabumi', '2021-07-07', 'SMP', NULL, 'Istri', 'Kawin', 'KTP lengkong tinggal di Lengkong', NULL, 'KTP21.jpeg', '2'),
('W-PBB-010', 'W-019', 'Wanda Artabella', '3217849710423817', 'Kepala Keluarga', '085619878862', 'Perempuan', 'Islam', 'Bogor', '2000-06-10', 'S1', 'Mahasiswa', 'Istri', 'Belum Kawin', 'KTP lengkong tinggal di Lengkong', NULL, NULL, '2'),
('W-PBB-011', 'W-020', 'Muhammad Arbi', '1235678790987687', 'Kepala Keluarga', '089928879280', 'Laki-laki', 'Islam', 'SUKABUMI', '1998-06-09', 'Diploma', 'Pegawai Swasta', 'Suami', 'Kawin', 'KTP lengkong tinggal di Lengkong', NULL, NULL, '2');

-- --------------------------------------------------------

--
-- Table structure for table `keluhan`
--

CREATE TABLE `keluhan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_wa` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_keluhan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keluhan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_kirim` datetime NOT NULL,
  `aktif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keluhan`
--

INSERT INTO `keluhan` (`id`, `nama`, `no_wa`, `email`, `jenis_keluhan`, `keluhan`, `status`, `bukti`, `waktu_kirim`, `aktif`) VALUES
(3, 'Papam Maulana', '085312127191', '', 'kebersihan', 'ada tikus, di kamar gua', 'Sedang diproses', 'resize-pas_1.jpg', '2021-07-19 16:31:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_warga` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kendaraan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_kendaraan` enum('Roda Dua','Roda Tiga','Roda Empat','Lebih dari Roda Empat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `merk_kendaraan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_stnk` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_polisi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_kendaraan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_verifikasi` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 = Belum Terverif, 2 = Terverfikasi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_warga`, `id_kendaraan`, `tipe_kendaraan`, `merk_kendaraan`, `nama_stnk`, `no_polisi`, `foto_kendaraan`, `status_verifikasi`) VALUES
('W-PBB-001', 'K-PBB-001', 'Roda Empat', 'Avanza', 'Papam Maulana', 'D 340 LEVI', 'download_(2).jpg', '2'),
('W-PBB-001', 'K-PBB-004', 'Lebih dari Roda Empat', 'Jonan', 'Hariadi', 'F 4423 HBU', 'mobil_roda_6.jpeg', '2'),
('W-PBB-001', 'K-PBB-005', 'Roda Tiga', 'Honda', 'Junaidi', 'D 832 BU', 'Motor_roda_tiga.jpeg', '2'),
('W-PBB-001', 'K-PBB-006', 'Roda Empat', 'Minicooper', 'Ersa Nur Maulana', 'E 135 SA', 'mobil2.jpeg', '2'),
('W-PBB-003', 'K-PBB-007', 'Roda Empat', 'Minicooper', 'Junaidi', 'D 88 KOI', 'mobil21.jpeg', '2'),
('W-PBB-011', 'K-PBB-008', 'Roda Empat', 'Minicooper', 'Arbi ', 'D 6756 HBU', 'mobil23.jpeg', '2');

-- --------------------------------------------------------

--
-- Table structure for table `musrembang`
--

CREATE TABLE `musrembang` (
  `id` int(10) UNSIGNED NOT NULL,
  `program` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sasaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume_lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengusul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `musrembang`
--

INSERT INTO `musrembang` (`id`, `program`, `kegiatan`, `sasaran`, `volume_lokasi`, `pengusul`, `keterangan`, `status`) VALUES
(4, 'Peningkatan Infrastruktur', 'Pengecoran Jalan', 'Kelancaran Lalu Lintas', 'Volume: 125 m Lokasi: Rw.01', 'Musyawarah RT di RW.01 Tanggal: 2020-11-01', 'Saat ini kondisi Jalan sudah tidak dapat dilalui oleh kendaraan karena terdapat lobang-lobang yang sangat besar dan dalam', 'Sudah diusulkan');

-- --------------------------------------------------------

--
-- Table structure for table `notulensi`
--

CREATE TABLE `notulensi` (
  `id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_post` datetime NOT NULL,
  `terakhir_diubah` datetime NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notulensi`
--

INSERT INTO `notulensi` (`id`, `judul`, `isi`, `penulis`, `waktu_post`, `terakhir_diubah`, `thumbnail`) VALUES
(3, 'Notulen Rapat Persiapan Kegiatan Padat Karya Produktif Dinas Sosial Tenaga Kerja dan Transmigrasi', 'Materi Rapat Sebagai Berikut: \r\n1. Melakukan koordinasi dengan Dinas Perikanan dan Kelautan Kabupaten Bandung dan Kepala Desan lokasi kegiatan\r\n2. Perlunya melakukan identifikasi lokasi kegiatan terkait tentang, status tempat pembuatan kolam, kesepakatan ', 'Januarizqi', '2021-07-06 20:17:37', '2021-07-06 20:17:37', 'AnyConv_com__1622945374.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_surat`
--

CREATE TABLE `pengajuan_surat` (
  `id_pengajuan_surat` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_detail_warga` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengajuan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `tanggal_disetujui` date DEFAULT NULL,
  `kode_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_surat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rw` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_rt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_rw` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verifikasi_rt` enum('Disetujui','Diproses') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verifikasi_rw` enum('Disetujui','Diproses') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan_surat`
--

INSERT INTO `pengajuan_surat` (`id_pengajuan_surat`, `id_detail_warga`, `pengajuan`, `tanggal_pengajuan`, `tanggal_disetujui`, `kode_surat`, `no_surat`, `rt`, `rw`, `nama_rt`, `nama_rw`, `verifikasi_rt`, `verifikasi_rw`) VALUES
('SURAT-001', 'W-001', 'Untuk Keperluan Pindah', '2021-07-02', '2021-07-02', '091201212', '121 / 213 / 5541XII', '1', '2', 'Naurah', 'Ersa Nur Maulana', 'Disetujui', 'Disetujui'),
('SURAT-003', 'W-010', 'Keperluan Izin Usaha', '2021-07-07', '2021-07-07', '091201212', '121 / 213 / 5541XII', '1', '2', 'Naurah', 'Ersa Nur Maulana', 'Disetujui', 'Disetujui'),
('SURAT-004', 'W-013', 'Surat Kematian', '2021-07-07', '2021-07-07', '091201212', '121 / 213 / 5541XII', '1', '2', 'Naurah', 'Ersa Nur Maulana', 'Disetujui', 'Disetujui'),
('SURAT-005', 'W-004', 'Surat Kematian', '2021-07-07', '2021-07-07', '091201212', '121 / 213 / 5541XII', '1', '2', 'Naurah', 'Ersa Nur Maulana', 'Disetujui', 'Disetujui');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_post` datetime NOT NULL,
  `terakhir_diubah` datetime NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `isi`, `penulis`, `waktu_post`, `terakhir_diubah`, `thumbnail`) VALUES
(13, 'Pengumuman Kegiatan Penyuluhan Pencegahan Kebakaran bagi Warga PBB bersama Diskar Kab Bandung', 'Sehubungan akan dilaksanakan kegiatan penyuluhan pencegahan kebakaran bagi warga PBB bersama DIKSAR Kab. Bandung, Kami mengundang Bapak/Ibu hadir pada Jumat, 30 April 2021 Pukul 15.30 WIB. Bertempat di pelataran MPI. Tetap memperhatikan disiplin prokes Covid-19. Terimakasih.', 'Januarizqi', '2021-07-06 12:44:24', '2021-07-06 12:52:06', 'IMG-20210428-WA0046-768x768.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `peraturan`
--

CREATE TABLE `peraturan` (
  `id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_post` datetime NOT NULL,
  `terakhir_diubah` datetime NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peraturan`
--

INSERT INTO `peraturan` (`id`, `judul`, `isi`, `penulis`, `waktu_post`, `terakhir_diubah`, `thumbnail`) VALUES
(3, 'Peraturan & Tata Tertib Warga RT 03 RW 07 PBB', '1. Membayar iuran warga tepat waktu\r\n2. Berpartisipasi mengikuti kegiatan gotong royong warga RT 03 RW 07 PBB\r\n3. Mematuhi rambu lalu lintas yang berlaku di wilayah PBB\r\n4. Tidak mengadakan kegiatan bersama yang mengandung unsur keributan dan kegaduhan pada saat \r\npagi, siang dan malam hari\r\n5. Menjaga dan mengamankan hewan peliharaan dengan cara hewan tersebut selalu di bawah \r\npengawasan pemilik\r\n6. Menjaga kebersihan di sekitar rumah\r\n7. Mematuhi aturan parkir kendaraan yaitu memarkir kendaraan HANYA dalam area parkir yang sudah \r\ndisediakan\r\na. Aturan parkir di depan rumah\r\nb. Aturan parkir disekitar pertigaan atau perempatan\r\n8. Tidak mengedarkan, memperjualbelikan, atau memakai narkoba dan minuman keras\r\n9. Tidak melakukan perbuatan zina atau seks bebas\r\n10. Batas kecepatan berkendara adalah 20 km /jam\r\n11. Menerima sanksi atas pelanggaran peraturan dan tata tertib', 'Januarizqi', '2021-07-06 14:19:12', '2021-07-06 14:19:12', '0001.jpg'),
(4, 'Peraturan & Tata Tertib Mahasiswa Kost dan Kontrakan RT 03 RW 07 PBB', '1. Mendaftarkan diri sebagai penghuni kost dan kontrakan dengan melampirkan fotokopi KTP & Kartu \r\nMahasiswa\r\n2. Menunjuk 1 orang sebagai Kepala Penghuni Kost atau Kontrakan yang bertanggung jawab atas \r\npenghuni lainnya\r\n3. Menghormati penghuni asli/ pemilik rumah di PBB\r\n4. Tidak mengadakan kegiatan bersama yang mengandung unsur keributan dan kegaduhan pada saat \r\npagi, siang dan malam hari\r\n5. Tidak mengadakan perayaan ulang tahun yang menjadi unsur keributan, kegaduhan, dan arak-arakan\r\n6. Menjaga dan mengamankan hewan peliharaan dengan cara hewan tersebut selalu di bawah \r\npengawasan pemilik\r\n7. Menjaga kebersihan di sekitar rumah\r\n8. Mematuhi aturan parkir kendaraan yaitu memarkir kendaraan HANYA dalam area parkir yang sudah \r\ndisediakan (Taman Sabilulungan 5)\r\n9. Kost atau kontrakan tidak boleh bersifat campur (menggabungkan penghuni laki-laki dan perempuan)\r\n10. Tidak mengedarkan, memperjualbelikan, atau memakai narkoba dan minuman keras\r\n11. Tidak melakukan perbuatan zina atau seks bebas\r\n12. Alat band tidak boleh dimainkan pada malam hari (setelah jam 18.00 WIB)\r\n13. Batas kecepatan berkendara adalah 20 km /jam\r\n14. Mengikuti kegiatan gotong royong jika diperlukan\r\n15. Kendaraan yang bising tidak boleh masuk ke wilayah komplek\r\n16. Segala tindak kejahatan, Peredaran dan penggunaan Minuman keras dan Narkoba serta seks bebas \r\nakan dilaporkan ke pihak Polisi.', 'Januarizqi', '2021-07-06 14:21:57', '2021-07-06 14:21:57', '0002.jpg'),
(5, 'PERATURAN PEMILIK KOST ATAU RUMAH KONTRAK', '1. Mendaftarkan dan mendapatkan izin usaha kost/ kontrakan ke Ketua RT 003 di PBB\r\n2. Membayar iuran warga tepat waktu\r\n3. Membuat dan memberlakukan Peraturan kost atau rumah kontrakan yang tidak berlawanan \r\ndengan peraturan dan tata tertib yang berlaku di PBB\r\n4. Memasang atau mendirikan tempat sampah di depan rumah\r\n5. Bekerja sama dengan warga PBB menciptakan suasana kehidupan yang aman dan tentram', 'Januarizqi', '2021-07-06 14:23:44', '2021-07-06 14:23:44', '0003.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `petugas_keamanan`
--

CREATE TABLE `petugas_keamanan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas_keamanan`
--

INSERT INTO `petugas_keamanan` (`id`, `nama`, `jabatan`, `foto`, `parent_id`) VALUES
(1, 'Pak Elly', 'Kepala Regu Grup 1', 'Pak-Elly.jpg', '0'),
(6, 'Pak Bobi', 'Anggota', 'Pak-Bobi.jpg', '1'),
(7, 'Pak Dodi', 'Anggota', 'Pak_Dodi.jpg', '1'),
(8, 'Pak Edi', 'Anggota', 'Pak_Edi.jpg', '1'),
(9, 'Pak Deden', 'Kepala Regu Grup 2', 'Pak Deden.jpg', '0'),
(10, 'Pak Ade', 'Anggota', 'Pak_Ade.jpeg', '9'),
(11, 'Pak Juhana', 'Anggota', 'Pak_Juhana.jpeg', '9'),
(12, 'Pak Didin', 'Anggota', 'Pak_Didin.jpeg', '9'),
(13, 'Pak Cahria', 'Kepala Regu Grup 3', 'Pak Cahria.jpeg', '0'),
(14, 'Pak Sutarman', 'Anggota', 'Pak_Sutarman.jpeg', '13'),
(15, 'Pak Agus', 'Anggota', 'Pak_Agus.jpeg', '13'),
(16, 'Pak Robi', 'Anggota', 'Pak_Robi.jpeg', '13');

-- --------------------------------------------------------

--
-- Table structure for table `petugas_rw`
--

CREATE TABLE `petugas_rw` (
  `id` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `parent_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas_rw`
--

INSERT INTO `petugas_rw` (`id`, `nama`, `jabatan`, `foto`, `parent_id`) VALUES
(1, 'Fulan', 'Ketua RW', 'default.svg', '0'),
(2, 'Olga Paurenta Simanihuru', 'Sie. Keamana', 'michael-dam-mEZ3PoFGs_k-unsplash1.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `struktur`
--

CREATE TABLE `struktur` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `struktur`
--

INSERT INTO `struktur` (`id`, `nama`, `jabatan`, `foto`, `parent_id`) VALUES
(1, 'Ade Yeni Noberti', 'Ketua RT', 'Ketua RT.jpeg', NULL),
(2, 'Suryatiningsih', 'Bendahara', 'Bendahara21.jpg', '1'),
(3, 'Hendra Moelyana', 'Sie. Insfratruktur', 'Sie-Infrastruktur-Hendra-Moelyana_-ST.jpg', '1'),
(6, 'Utoyo', 'Sie. Kerohanian', 'Sie-Kerohanian-Utoyo.jpg', '1'),
(12, 'Tri Rahayu', 'Sie. PKK', 'Sie-PKK-Tri-Rahayu.jpg', '1'),
(15, 'Eddi Subandrio', 'Sie. Keamanan', 'Sie-Keamanan-Drs_-Eddi-Subandrio.jpg', '1'),
(16, 'Santi Darnita', 'Sie. Pemuda dan Olahraga', 'Sie-Pemuda-dan-Olahraga-Santi-Darnita_-S_E_.jpg', '1'),
(17, 'Aditya Mahardhika', 'Sie. Pubdok', 'Sie__Pubdok_-_Aditya_Mahardhika,_S_Sn.jpg', '1'),
(18, 'Rudiannova', 'Sie. Kebersihan', 'Sie-Kebersihan-Rudiannova.jpg', '1'),
(19, 'Rara Ayuningtyas Pramudita', 'Sie. Kesehatan', 'Sie-Kesehatan-dr_-Rara-Ayuningtyas-Pramudita.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id_surat` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_admin` int(10) UNSIGNED NOT NULL,
  `judul` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_surat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_surat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_of_birth` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `phone_number` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion_id` int(11) NOT NULL,
  `image` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` date DEFAULT NULL,
  `rt` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rw` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `password`, `gender`, `place_of_birth`, `birthday`, `phone_number`, `address`, `religion_id`, `image`, `role_id`, `is_active`, `date_created`, `rt`, `rw`) VALUES
(1, 'Januarizqi', 'janu', 'januarrizqi5@gmail.com', '$2y$10$54Ajl0R.ArBF45hyXCsJZOnTdLzoegtv9nJbBRs3ICk1QBv1kS5yW', 'Laki-laki', 'Kediri', '2021-05-12', '085717295156', 'Kediri', 1, '2019-06-05_11_59_30_1.jpg', 1, 1, '2021-05-26', NULL, NULL),
(8, 'Firman Saputra', 'firman', 'firman@gmail.com', '$2y$10$B1OFOZlBEjT8FlzMXhFgGuMIzogqacffybkaD6BBUqKB2vXTrn4xO', 'Laki-laki', 'Padang', '2021-07-09', '085233185492', 'Komplek Permata Buah Batu', 1, 'default.svg', 6, 1, '2021-07-02', '3', '1'),
(10, 'Ngatimin', 'ngatimin', 'ngatimin@gmail.com', '$2y$10$..cDQbBsQCaS/EcwJLCdY.1UUzgLLPfbphBUhVp11wOWS7.P7.5Pe', 'Laki-laki', 'Sukabumi', '2021-06-04', '082119876543', 'cikoneng regency', 1, 'default.svg', 6, 1, '2021-07-03', '2', NULL),
(11, 'Dody', 'Dody', 'dody@gmail.com', '$2y$10$aBfhAjbq28rcxG0O3ifm6Ohc9IUjM8VFpmYSqFzN8oIR6AmCIRvOm', 'Laki-laki', 'Sukabumi', '2003-07-09', '0822917826623', 'Jln. Cikoneng', 1, 'default.svg', 7, 1, '2021-07-07', NULL, '1'),
(12, 'Akib Dahlan', 'Akib', 'akib@gmail.com', '$2y$10$DMCUA77rLlGGCHTUw/6sDeCafyjr8733NQIj7RCPp1vkE4tEfp506', 'Laki-laki', 'Palembang', '2021-07-13', '081234567891', 'Palembang', 1, 'ian-dooley-d1UPkiFd04A-unsplash.jpg', 2, 1, '2021-07-07', NULL, NULL),
(14, 'Muhammad Haitsam', 'Samuel', 'haitsam03@gmail.com', '$2y$10$nQNmG8MPApvT/AtKnLdxNOfgJFfbDGrMI0b4Y43ZC7I1Wv.hv0HzG', 'Laki-laki', 'Madinah', '2021-07-19', '082117503125', 'Jl. Raya Cilamaya', 1, 'default.svg', 1, 1, '2021-07-19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 1, 3),
(5, 1, 4),
(6, 1, 5),
(7, 1, 6),
(8, 1, 7),
(9, 1, 8),
(10, 2, 2),
(11, 2, 9),
(13, 1, 10),
(14, 1, 11),
(15, 3, 1),
(16, 3, 2),
(17, 3, 9),
(18, 4, 1),
(19, 4, 2),
(20, 4, 9),
(21, 5, 1),
(22, 5, 2),
(23, 5, 9),
(24, 2, 4),
(25, 3, 5),
(26, 4, 6),
(27, 5, 7),
(28, 1, 12),
(29, 2, 12),
(30, 3, 12),
(31, 4, 12),
(32, 5, 12),
(33, 1, 13),
(34, 1, 14),
(35, 6, 2),
(36, 7, 2),
(37, 1, 15),
(38, 6, 15),
(39, 7, 15),
(40, 1, 16),
(41, 6, 16),
(42, 7, 16);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `icon`, `active`) VALUES
(1, 'Admin', 'fe-users', 1),
(2, 'User', 'fe-user', 1),
(3, 'Set Up', 'fe-menu', 1),
(4, 'Admin Kebersihan', 'fe-trash-2', 1),
(5, 'Admin Keamanan', 'fe-shield', 1),
(6, 'Admin Fasilitas', 'fe-home', 1),
(7, 'Admin Olahraga', 'fe-globe', 1),
(8, 'DataMaster', 'fe-database', 1),
(9, 'Lainnya', 'fe-more-vertical-', 1),
(10, 'Data', 'fe-book-open', 0),
(11, 'Dashboard', 'fe-book', 0),
(12, 'KeluhanAspirasi', 'fe-people', 0),
(13, 'menu', 'fe-menu', 0),
(14, 'Struktur Organisasi', 'fas fa-fw fa-sitemap', 1),
(15, 'Pusat Informasi', 'fe-mail', 1),
(16, 'Pengurus', 'fe-navigation', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'administrator'),
(2, 'admin kebersihan'),
(3, 'admin keamanan'),
(4, 'admin fasilitas'),
(5, 'admin olahraga'),
(6, 'rt'),
(7, 'rw');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin/', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user/', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu/', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/subMenu', 'fas fa-fw fa-folder-open', 1),
(6, 3, 'Role Management', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(7, 2, 'Change Password', 'user/changePassword', 'fas fa-fw fa-key', 1),
(8, 1, 'Data User', 'admin/dataUser/', 'fas fa-fw fa-user-tie', 1),
(9, 4, 'Data Keluhan dan Aspirasi', 'KeluhanAspirasi/kebersihan', 'fas fa-fw fa-broom', 1),
(10, 8, 'Data Master', 'DataMaster/', 'fas fa-fw fa-database', 1),
(11, 5, 'Data Keluhan dan Aspirasi', 'KeluhanAspirasi/keamanan', 'fas fa-fw fa-handshake', 1),
(13, 15, 'Pengumuman', 'Pengurus/pengumuman', 'fas fa-fw fa-bullhorn', 1),
(14, 6, 'Data Keluhan dan Aspirasi', 'KeluhanAspirasi/fasilitas', 'fas fa-fw fa-building', 1),
(15, 7, 'Data Keluhan dan Aspirasi', 'KeluhanAspirasi/olahraga', 'fas fa-fw fa-basketball-ball', 1),
(17, 8, 'Data Warga', 'Dashboard/data_warga', 'fas fa-fw fa-users', 1),
(18, 8, 'Data Kendaraan', 'Dashboard/data_kendaraan', 'fas fa-fw fa-car', 1),
(19, 8, 'Data Fasilitas', 'Dashboard/fasilitas', 'fas fa-fw fa-couch', 1),
(20, 1, 'Keluhan dan Aspirasi', 'KeluhanAspirasi/', 'fas fa-fw fa-people-carry', 1),
(21, 3, 'Data Agama', 'DataMaster/agama/', 'fas fa-fw fa-pray', 1),
(22, 3, 'Edit Dashboard Admin', 'DataMaster/dashboard/', 'fas fa-fw fa-edit', 1),
(23, 8, 'Data Konten', 'DataMaster/konten', 'far fa-fw fa-newspaper', 1),
(24, 9, 'Tentang Aplikasi', 'Lainnya/tentang', 'fas fa-fw fa-address-card', 1),
(25, 9, 'Pengaturan', 'Lainnya/pengaturan', 'fas fa-fw fa-wrench', 1),
(26, 9, 'Hubungi Kami', 'Lainnya/hubungi', 'fas fa-fw fa-address-book', 1),
(27, 9, 'Bantuan', 'Lainnya/bantuan', 'far fa-fw fa-question-circle', 1),
(28, 9, 'FAQ', 'Lainnya/faq', 'fas fa-fw fa-question', 1),
(32, 15, 'Berita', 'Pengurus/berita', 'fas fa-fw fa-newspaper', 1),
(33, 15, 'Notulensi', 'Pengurus/notulensi', 'far fa-fw fa-clipboard', 1),
(34, 3, 'Edit Dashboard User', 'DataMaster/dashboardUser/', 'far fa-fw fa-edit', 1),
(35, 15, 'Musrembang', 'Pengurus/musrembang', 'fas fa-fw fa-book-open', 1),
(36, 14, 'Petugas RT', 'Admin/strukturOrganisasi', 'fas fa-fw fa-sitemap', 1),
(38, 15, 'Peraturan', 'Pengurus/peraturan', 'fas fa-book', 1),
(39, 14, 'Petugas Keamanan', 'Admin/strukturOrganisasiPetugasKeamanan', 'fas fa-fw fa-sitemap', 1),
(40, 14, 'Petugas RW', 'Admin/strukturOrganisasiPetugasRW', 'fas fa-fw fa-sitemap', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(29, 'ersanurzz@mail.com', 'fkDD9MwXTng7SL8uxN/pZ4LVGh26Jzm9U6SAmnHHpKI=', 1624990386),
(30, 'naurah@gmail.com', 'j7Z3WuXR1xz1RiWrhtFQkN50fWhklGAOyXnkigXj4g0=', 1625150932),
(31, 'firman@gmail.com', 'zKLTaFdMZtD1GQhYD0r7Eaqtodq6wFA0A+oUDDe4dVE=', 1625216237),
(32, 'galang@gmail.com', 'ochUbeK2QOODAZ5zQS54QFXkhOni4/Rnil0rig7oUDw=', 1625278808),
(33, 'ngatimin@gmail.com', 'HsrEDaVuaiMyPiQKF564jhRPteMGlg8MSA8gGKwDK/M=', 1625322742),
(34, 'dody@gmail.com', 'OiIs8rNKbwlAjXHwQpl4FNqJhEsaCbjLg1s4yAeHyUM=', 1625595762),
(35, 'akib@gmail.com', 'KyYcxjpKUIiHR2abPGrCAMYfKjnWkejrp3693N2AFQI=', 1625651508),
(36, 'galang@gmail.com', 'EH4AhoLv2q9mMJmT9wOi1xMxG9pENbD4YqX/BwZxcEc=', 1626352947),
(37, 'haitsam03@gmail.com', '2HdjJJ0Vy44pydUh4tx+MFPtIHgoMbc9D/8luz9iNgs=', 1626701479);

-- --------------------------------------------------------

--
-- Table structure for table `warga`
--

CREATE TABLE `warga` (
  `id_warga` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rumah` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kk` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_keluarga` int(11) NOT NULL,
  `status_rumah` enum('Rumah Usaha','Rumah Tinggal','Rumah Kosong') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_rumah_tangga` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rt` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rw` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_kk` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warga`
--

INSERT INTO `warga` (`id_warga`, `no_rumah`, `no_kk`, `alamat`, `jumlah_keluarga`, `status_rumah`, `status_rumah_tangga`, `rt`, `rw`, `file_kk`) VALUES
('W-PBB-001', 'A-3', '3515211845256001', 'Komplek Pbb 1', 3, 'Rumah Tinggal', 'Sangat Miskin', '1', '1', 'KARTU_KELUARGA1.jpg'),
('W-PBB-002', 'A-1', '3515211845256002', 'Komplek PBB 1', 3, 'Rumah Tinggal', 'Hampir Miskin', '2', '1', 'kecil_1500523785kartu_keluarga.jpg'),
('W-PBB-003', 'L-9', '1234567890123456', 'Jln. Lengkong Berseri', 5, 'Rumah Tinggal', 'Hampir Miskin', '1', '2', 'kk_1625669888.jpeg'),
('W-PBB-004', 'L-7', '1234567890123456', 'jln. Cikoneng', 2, 'Rumah Tinggal', 'Tidak Mendapat Bantuan', '1', '2', 'Kartu_Keluarga2.png'),
('W-PBB-005', 'A-14', '1987653456789267', 'Jln. Cikoneng Regency', 3, 'Rumah Usaha', 'Tidak Mendapat Bantuan', '2', '2', 'KK.jpeg'),
('W-PBB-006', 'A-2', '1234536785489765', 'Jln. Cikoneng regency', 3, 'Rumah Usaha', 'Tidak Mendapat Bantuan', '3', '2', 'Kartu_Keluarga3.png'),
('W-PBB-008', 'A-6', '1234672879000082', 'Jln. Cikoneng', 2, 'Rumah Tinggal', 'Tidak Mendapat Bantuan', '2', '2', 'Kartu_Keluarga5.png'),
('W-PBB-009', 'B-1', '1234561568900007', 'Jln. Cikoneng Regency', 3, 'Rumah Tinggal', 'Tidak Mendapat Bantuan', '3', '1', 'Kartu_Keluarga6.png'),
('W-PBB-010', 'B-5', '1245637829180007', 'Jln. Cikoneng Regency', 4, 'Rumah Kosong', 'Miskin', '1', '2', 'Kartu_Keluarga7.png'),
('W-PBB-011', 'A-8', '1245678938980008', 'Jln. Cikoneng Regency', 3, 'Rumah Tinggal', 'Tidak Mendapat Bantuan', '3', '2', 'Kartu_Keluarga8.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dashboard`
--
ALTER TABLE `dashboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_aspirasi_warga`
--
ALTER TABLE `data_aspirasi_warga`
  ADD PRIMARY KEY (`no_tiket`),
  ADD KEY `data_aspirasi_warga_id_detail_warga_foreign` (`id_detail_warga`),
  ADD KEY `data_aspirasi_warga_id_admin_foreign` (`id_admin`);

--
-- Indexes for table `data_fasilitas`
--
ALTER TABLE `data_fasilitas`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `data_iuran_warga`
--
ALTER TABLE `data_iuran_warga`
  ADD PRIMARY KEY (`no_tagihan`),
  ADD KEY `data_iuran_warga_id_warga_foreign` (`id_warga`);

--
-- Indexes for table `data_keuangan_iuran`
--
ALTER TABLE `data_keuangan_iuran`
  ADD PRIMARY KEY (`id_data_keuangan`);

--
-- Indexes for table `data_pemasukan_iuran`
--
ALTER TABLE `data_pemasukan_iuran`
  ADD PRIMARY KEY (`id_pemasukan`),
  ADD KEY `data_pemasukan_iuran_id_admin_foreign` (`id_admin`);

--
-- Indexes for table `data_penggunaan_iuran`
--
ALTER TABLE `data_penggunaan_iuran`
  ADD PRIMARY KEY (`id_penggunaan`),
  ADD KEY `data_penggunaan_iuran_id_admin_foreign` (`id_admin`);

--
-- Indexes for table `detail_warga`
--
ALTER TABLE `detail_warga`
  ADD PRIMARY KEY (`id_detail_warga`),
  ADD KEY `detail_warga_id_warga_foreign` (`id_warga`);

--
-- Indexes for table `keluhan`
--
ALTER TABLE `keluhan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`),
  ADD KEY `kendaraan_id_warga_foreign` (`id_warga`);

--
-- Indexes for table `musrembang`
--
ALTER TABLE `musrembang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notulensi`
--
ALTER TABLE `notulensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD PRIMARY KEY (`id_pengajuan_surat`),
  ADD KEY `pengajuan_surat_id_detail_warga_foreign` (`id_detail_warga`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peraturan`
--
ALTER TABLE `peraturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas_keamanan`
--
ALTER TABLE `petugas_keamanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas_rw`
--
ALTER TABLE `petugas_rw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `struktur`
--
ALTER TABLE `struktur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `surat_id_admin_foreign` (`id_admin`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warga`
--
ALTER TABLE `warga`
  ADD PRIMARY KEY (`id_warga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `aspirasi`
--
ALTER TABLE `aspirasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dashboard`
--
ALTER TABLE `dashboard`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_fasilitas`
--
ALTER TABLE `data_fasilitas`
  MODIFY `no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `data_iuran_warga`
--
ALTER TABLE `data_iuran_warga`
  MODIFY `no_tagihan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2107115133;

--
-- AUTO_INCREMENT for table `data_keuangan_iuran`
--
ALTER TABLE `data_keuangan_iuran`
  MODIFY `id_data_keuangan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `data_pemasukan_iuran`
--
ALTER TABLE `data_pemasukan_iuran`
  MODIFY `id_pemasukan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_penggunaan_iuran`
--
ALTER TABLE `data_penggunaan_iuran`
  MODIFY `id_penggunaan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `keluhan`
--
ALTER TABLE `keluhan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `musrembang`
--
ALTER TABLE `musrembang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notulensi`
--
ALTER TABLE `notulensi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `peraturan`
--
ALTER TABLE `peraturan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `petugas_keamanan`
--
ALTER TABLE `petugas_keamanan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `petugas_rw`
--
ALTER TABLE `petugas_rw`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `struktur`
--
ALTER TABLE `struktur`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_aspirasi_warga`
--
ALTER TABLE `data_aspirasi_warga`
  ADD CONSTRAINT `data_aspirasi_warga_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_aspirasi_warga_id_detail_warga_foreign` FOREIGN KEY (`id_detail_warga`) REFERENCES `detail_warga` (`id_detail_warga`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_iuran_warga`
--
ALTER TABLE `data_iuran_warga`
  ADD CONSTRAINT `data_iuran_warga_id_warga_foreign` FOREIGN KEY (`id_warga`) REFERENCES `warga` (`id_warga`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_pemasukan_iuran`
--
ALTER TABLE `data_pemasukan_iuran`
  ADD CONSTRAINT `data_pemasukan_iuran_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_penggunaan_iuran`
--
ALTER TABLE `data_penggunaan_iuran`
  ADD CONSTRAINT `data_penggunaan_iuran_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_warga`
--
ALTER TABLE `detail_warga`
  ADD CONSTRAINT `detail_warga_id_warga_foreign` FOREIGN KEY (`id_warga`) REFERENCES `warga` (`id_warga`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD CONSTRAINT `kendaraan_id_warga_foreign` FOREIGN KEY (`id_warga`) REFERENCES `warga` (`id_warga`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD CONSTRAINT `pengajuan_surat_id_detail_warga_foreign` FOREIGN KEY (`id_detail_warga`) REFERENCES `detail_warga` (`id_detail_warga`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat`
--
ALTER TABLE `surat`
  ADD CONSTRAINT `surat_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
