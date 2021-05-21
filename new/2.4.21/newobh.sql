-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 01, 2021 at 08:06 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `obh_combi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data_obh`
--

CREATE TABLE `tbl_data_obh` (
  `id_data_notaris` int(10) NOT NULL,
  `no_idn` varchar(30) DEFAULT NULL,
  `nama` text DEFAULT NULL,
  `no_sk` text DEFAULT NULL,
  `alamat_notaris` text DEFAULT NULL,
  `tempat_kedudukan` text DEFAULT NULL,
  `telpon` varchar(14) DEFAULT NULL,
  `email_notaris` text DEFAULT NULL,
  `foto_notaris` text DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_data_obh`
--

INSERT INTO `tbl_data_obh` (`id_data_notaris`, `no_idn`, `nama`, `no_sk`, `alamat_notaris`, `tempat_kedudukan`, `telpon`, `email_notaris`, `foto_notaris`, `id_user`) VALUES
(465, '123456789', 'urap urap', 'HURAP-HURAP14340', 'Anjani', NULL, '0819678900', 'cariprojecthalal@gmail.com', NULL, 358);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data_user`
--

CREATE TABLE `tbl_data_user` (
  `id_data_user` int(10) NOT NULL,
  `no_ktp` varchar(30) DEFAULT NULL,
  `nama` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` text DEFAULT NULL,
  `kontak` varchar(14) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_data_user`
--

INSERT INTO `tbl_data_user` (`id_data_user`, `no_ktp`, `nama`, `alamat`, `tgl_lahir`, `jk`, `kontak`, `email`, `foto`, `id_user`) VALUES
(26, '12345678910', 'masyarakat', 'Gapuk', NULL, NULL, '08113401340', '', NULL, 360);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(10) NOT NULL,
  `nama_kategori` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'Penyalahgunaan'),
(5, 'Saran &amp; Masukan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_lap`
--

CREATE TABLE `tbl_kategori_lap` (
  `id_kategori_lap` int(10) NOT NULL,
  `nama_kategori_lap` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori_lap`
--

INSERT INTO `tbl_kategori_lap` (`id_kategori_lap`, `nama_kategori_lap`) VALUES
(2, 'NON LITIGASI'),
(4, 'LITIGASI');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laporan`
--

CREATE TABLE `tbl_laporan` (
  `id_laporan` int(10) NOT NULL,
  `id_kategori_lap` int(10) DEFAULT NULL,
  `id_sub_kategori_lap` int(10) DEFAULT NULL,
  `isi_laporan` text DEFAULT NULL,
  `ket_laporan` text DEFAULT NULL,
  `lampiran` text DEFAULT NULL,
  `notaris` int(10) DEFAULT NULL,
  `status` enum('proses','konfirmasi','selesai') DEFAULT NULL,
  `petugas` int(11) DEFAULT NULL,
  `pesan_petugas` text DEFAULT NULL,
  `file_petugas` text DEFAULT NULL,
  `tgl_laporan` datetime DEFAULT NULL,
  `tgl_konfirmasi` datetime DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `no_akta` text DEFAULT NULL,
  `tgl_akta` text DEFAULT NULL,
  `no_buku` text DEFAULT NULL,
  `nama_client` text DEFAULT NULL,
  `alamat_client` text DEFAULT NULL,
  `tgl_kegiatan` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notif`
--

CREATE TABLE `tbl_notif` (
  `id_notif` int(10) NOT NULL,
  `pengirim` int(10) DEFAULT NULL,
  `penerima` int(10) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `link` text DEFAULT NULL,
  `id_pengaduan` int(10) DEFAULT NULL,
  `id_laporan` int(10) DEFAULT NULL,
  `tgl_notif` datetime DEFAULT NULL,
  `baca_notif` text DEFAULT NULL,
  `hapus_notif` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notif`
--

INSERT INTO `tbl_notif` (`id_notif`, `pengirim`, `penerima`, `pesan`, `link`, `id_pengaduan`, `id_laporan`, `tgl_notif`, `baca_notif`, `hapus_notif`) VALUES
(147, 358, 1, '', 'laporan/v/d/gY', 149, 0, '2021-04-01 23:43:01', '1, ', NULL),
(146, 1, NULL, '', 'laporan/v/d/gY', 148, 0, '2021-04-01 23:21:23', NULL, NULL),
(142, 1, 0, '', 'laporan/v/d/gY', 147, 0, '2021-04-01 23:19:58', NULL, NULL),
(143, 1, NULL, '', 'laporan/v/d/gY', 147, 0, '2021-04-01 23:19:58', NULL, NULL),
(144, 358, 1, '', 'laporan/v/d/gY', 148, 0, '2021-04-01 23:21:11', '1, ', NULL),
(145, 1, 352, '', 'laporan/v/d/gY', 148, 0, '2021-04-01 23:21:23', '352, ', NULL),
(141, 358, 1, '', 'laporan/v/d/gY', 147, 0, '2021-04-01 23:10:32', '1, ', NULL),
(139, 1, 0, '', 'laporan/v/d/gY', 146, 0, '2021-04-01 23:01:53', NULL, NULL),
(140, 1, NULL, '', 'laporan/v/d/gY', 146, 0, '2021-04-01 23:01:53', NULL, NULL),
(138, 358, 1, '', 'laporan/v/d/gY', 146, 0, '2021-04-01 22:47:38', '1, ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengaduan`
--

CREATE TABLE `tbl_pengaduan` (
  `id_pengaduan` int(10) NOT NULL,
  `id_kategori` int(10) DEFAULT NULL,
  `id_sub_kategori` int(10) DEFAULT NULL,
  `isi_pengaduan` text DEFAULT NULL,
  `ket_pengaduan` text DEFAULT NULL,
  `bukti` text DEFAULT NULL,
  `user` int(10) DEFAULT NULL,
  `status` enum('proses','konfirmasi','selesai') DEFAULT NULL,
  `petugas` int(11) DEFAULT NULL,
  `pesan_petugas` text DEFAULT NULL,
  `file_petugas` text DEFAULT NULL,
  `tgl_pengaduan` datetime DEFAULT NULL,
  `tgl_konfirmasi` datetime DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_petugas`
--

CREATE TABLE `tbl_petugas` (
  `id_petugas` int(10) NOT NULL,
  `nama` text DEFAULT NULL,
  `jk` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_petugas`
--

INSERT INTO `tbl_petugas` (`id_petugas`, `nama`, `jk`, `alamat`, `no_telp`, `email`, `id_user`) VALUES
(6, 'admin', 'Laki-Laki', 'sandik', '087865836839', 'cucoh.cibal@gmail.com', 352);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slide`
--

CREATE TABLE `tbl_slide` (
  `id_slide` int(10) NOT NULL,
  `foto_slide` text DEFAULT NULL,
  `ket_slide` text DEFAULT NULL,
  `tgl_slide` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_kategori`
--

CREATE TABLE `tbl_sub_kategori` (
  `id_sub_kategori` int(10) NOT NULL,
  `id_kategori` int(10) DEFAULT NULL,
  `nama_sub_kategori` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sub_kategori`
--

INSERT INTO `tbl_sub_kategori` (`id_sub_kategori`, `id_kategori`, `nama_sub_kategori`) VALUES
(207, 5, 'Fasilitas Publik'),
(206, 2, 'Bantuan Masyarakat');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_kategori_lap`
--

CREATE TABLE `tbl_sub_kategori_lap` (
  `id_sub_kategori_lap` int(10) NOT NULL,
  `id_kategori_lap` int(10) DEFAULT NULL,
  `nama_sub_kategori_lap` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(10) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `level` varchar(30) DEFAULT NULL,
  `tgl_daftar` datetime DEFAULT NULL,
  `aktif` enum('0','1') DEFAULT NULL,
  `dihapus` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_lengkap`, `username`, `password`, `level`, `tgl_daftar`, `aktif`, `dihapus`) VALUES
(1, 'Administrator', 'alex', 'admin', 'superadmin', '2019-02-10 00:00:00', '1', 'tidak'),
(358, 'urap urap', '123', '123', 'obh', '2021-02-14 17:13:10', '1', 'tidak'),
(352, 'admin', 'admin', 'admin', 'petugas', '2020-12-02 22:03:01', '1', 'tidak'),
(360, 'masyarakat', 'masyarakat', 'masyarakat', 'user', '2021-03-31 17:58:31', '1', 'tidak');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_web`
--

CREATE TABLE `tbl_web` (
  `id_web` int(10) NOT NULL,
  `nama_web` text DEFAULT NULL,
  `ket_web` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_web`
--

INSERT INTO `tbl_web` (`id_web`, `nama_web`, `ket_web`) VALUES
(1, 'Sistem Laporan OBH', NULL),
(2, 'Laporan OBH', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_data_obh`
--
ALTER TABLE `tbl_data_obh`
  ADD PRIMARY KEY (`id_data_notaris`);

--
-- Indexes for table `tbl_data_user`
--
ALTER TABLE `tbl_data_user`
  ADD PRIMARY KEY (`id_data_user`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_kategori_lap`
--
ALTER TABLE `tbl_kategori_lap`
  ADD PRIMARY KEY (`id_kategori_lap`);

--
-- Indexes for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `tbl_notif`
--
ALTER TABLE `tbl_notif`
  ADD PRIMARY KEY (`id_notif`);

--
-- Indexes for table `tbl_pengaduan`
--
ALTER TABLE `tbl_pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`);

--
-- Indexes for table `tbl_petugas`
--
ALTER TABLE `tbl_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `tbl_slide`
--
ALTER TABLE `tbl_slide`
  ADD PRIMARY KEY (`id_slide`);

--
-- Indexes for table `tbl_sub_kategori`
--
ALTER TABLE `tbl_sub_kategori`
  ADD PRIMARY KEY (`id_sub_kategori`);

--
-- Indexes for table `tbl_sub_kategori_lap`
--
ALTER TABLE `tbl_sub_kategori_lap`
  ADD PRIMARY KEY (`id_sub_kategori_lap`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_web`
--
ALTER TABLE `tbl_web`
  ADD PRIMARY KEY (`id_web`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_data_obh`
--
ALTER TABLE `tbl_data_obh`
  MODIFY `id_data_notaris` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=466;

--
-- AUTO_INCREMENT for table `tbl_data_user`
--
ALTER TABLE `tbl_data_user`
  MODIFY `id_data_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_kategori_lap`
--
ALTER TABLE `tbl_kategori_lap`
  MODIFY `id_kategori_lap` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  MODIFY `id_laporan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `tbl_notif`
--
ALTER TABLE `tbl_notif`
  MODIFY `id_notif` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `tbl_pengaduan`
--
ALTER TABLE `tbl_pengaduan`
  MODIFY `id_pengaduan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_petugas`
--
ALTER TABLE `tbl_petugas`
  MODIFY `id_petugas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_slide`
--
ALTER TABLE `tbl_slide`
  MODIFY `id_slide` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_sub_kategori`
--
ALTER TABLE `tbl_sub_kategori`
  MODIFY `id_sub_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `tbl_sub_kategori_lap`
--
ALTER TABLE `tbl_sub_kategori_lap`
  MODIFY `id_sub_kategori_lap` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=361;

--
-- AUTO_INCREMENT for table `tbl_web`
--
ALTER TABLE `tbl_web`
  MODIFY `id_web` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
