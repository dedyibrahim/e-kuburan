-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2019 at 03:46 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuburan`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_ahli_waris`
--

CREATE TABLE `data_ahli_waris` (
  `id_data_ahli_waris` int(11) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_tlp` varchar(255) NOT NULL,
  `status_berkas` varchar(255) NOT NULL,
  `hubungan_keluarga` varchar(255) NOT NULL,
  `file_ktp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_ahli_waris`
--

INSERT INTO `data_ahli_waris` (`id_data_ahli_waris`, `nik`, `nama`, `alamat`, `no_tlp`, `status_berkas`, `hubungan_keluarga`, `file_ktp`) VALUES
(2, '327106230198', 'Dedi ibrahim', 'Kp.Sumurwangi Kel.Kayumanis Kec.Tanah Sareal Kota Bogor', '081289903664', 'Terupload', 'Adik', '8dc6ed2db9473fb5f8fad06efa9c1692.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `data_berkas_jenazah`
--

CREATE TABLE `data_berkas_jenazah` (
  `id_data_berkas_jenazah` int(11) NOT NULL,
  `nama_lampiran` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `berkas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_berkas_jenazah`
--

INSERT INTO `data_berkas_jenazah` (`id_data_berkas_jenazah`, `nama_lampiran`, `file`, `berkas`) VALUES
(24, 'KTP Jenazah', 'f6a742e734b42bdc68ee1be28b61062b.jpg', '32689978836677'),
(25, 'Surat pengantar RT RW', '6b9beb38c4b16cafa8ec3113e26ed28d.jpg', '32689978836677'),
(26, 'Surat pengantar rumah sakit', '6fcebefc7d3147f72a0fe2281545f9ca.jpg', '32689978836677'),
(27, 'Kartu Keluarga', 'e2e9cc236e2d27f01d16c3c4cd3f5cbc.jpg', '32689978836677'),
(28, 'KTP Jenazah', '2a9e2f4da0f8280015f5333540e9d820.jpg', '32689978836677'),
(29, 'Surat pengantar RT RW', 'd13b3daf7fbbea8fd9cc331264ba5dec.jpg', '32689978836677'),
(30, 'Surat pengantar rumah sakit', 'ce4669472fd759f831993f521abcc728.jpg', '32689978836677'),
(31, 'Kartu Keluarga', 'cc369724fd5d3fa6f79d0ec3b42539a7.jpg', '32689978836677'),
(32, 'KTP Jenazah', '63d74dd613aa2dbba89542f237d676a5.jpg', '32689978836677'),
(33, 'Surat pengantar RT RW', '9252ba72b2fbea55cfdd753be355bd73.jpg', '32689978836677'),
(34, 'Surat pengantar rumah sakit', 'ab332eac067c6c2d68b897b01963e76b.jpg', '32689978836677'),
(35, 'Kartu Keluarga', '450384bcf9a477b7cce461db1101eb9c.jpg', '32689978836677'),
(36, 'KTP Jenazah', '0a6551a4c1ada5ce87c1b2932f363027.jpg', '32689978836677'),
(37, 'Surat pengantar RT RW', 'da77cbd6146d8492edb25d30a94e13e4.jpg', '32689978836677'),
(38, 'Surat pengantar rumah sakit', '24f5ca2a31948b1256b6e4f176e13e1e.jpg', '32689978836677'),
(39, 'Kartu Keluarga', '964b1b3fb9f110d579755149fa8f6d6d.jpg', '32689978836677');

-- --------------------------------------------------------

--
-- Table structure for table `data_biaya`
--

CREATE TABLE `data_biaya` (
  `id_data_biaya` int(11) NOT NULL,
  `nik_jenazah` varchar(255) NOT NULL,
  `jenis_biaya` varchar(255) NOT NULL,
  `jumlah_biaya` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_biaya`
--

INSERT INTO `data_biaya` (`id_data_biaya`, `nik_jenazah`, `jenis_biaya`, `jumlah_biaya`) VALUES
(1, '32689978836677', 'Pemesanan makam', '800000'),
(2, '32689978836677', 'Batu nisan', '300000'),
(3, '32689978836677', 'Perpanjang', '100000');

-- --------------------------------------------------------

--
-- Table structure for table `data_blok`
--

CREATE TABLE `data_blok` (
  `id_data_blok` int(11) NOT NULL,
  `nama_blok` varchar(255) NOT NULL,
  `jumlah_makam` varchar(255) NOT NULL,
  `nama_agama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_blok`
--

INSERT INTO `data_blok` (`id_data_blok`, `nama_blok`, `jumlah_makam`, `nama_agama`) VALUES
(12, 'BLOK A', '100', 'Islam'),
(13, 'BLOK B', '90', 'Kristen'),
(14, 'BLOK C', '80', 'Budha');

-- --------------------------------------------------------

--
-- Table structure for table `data_jenazah`
--

CREATE TABLE `data_jenazah` (
  `id_data_jenazah` int(11) NOT NULL,
  `blok_agama` varchar(255) NOT NULL,
  `blok_makam` varchar(255) NOT NULL,
  `nama_makam` varchar(255) NOT NULL,
  `nik_ahli_waris` varchar(255) NOT NULL,
  `nama_ahli_waris` varchar(255) NOT NULL,
  `tanggal_lahir` varchar(255) NOT NULL,
  `tanggal_wafat` varchar(255) NOT NULL,
  `nik_jenazah` varchar(255) NOT NULL,
  `nama_jenazah` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_jenazah`
--

INSERT INTO `data_jenazah` (`id_data_jenazah`, `blok_agama`, `blok_makam`, `nama_makam`, `nik_ahli_waris`, `nama_ahli_waris`, `tanggal_lahir`, `tanggal_wafat`, `nik_jenazah`, `nama_jenazah`, `jenis_kelamin`) VALUES
(14, 'Islam', 'BLOK A', 'BLOK A1', '327106230198', 'Dedi ibrahim', '2019/06/30', '2019/06/30', '32689978836677', 'Pak Puat', 'Perumpuan'),
(15, 'Islam', 'BLOK A', 'BLOK A2', '327106230198', 'Dedi ibrahim', '2019/06/30', '2019/07/03', '32689978836677', 'Zaenudin', 'Laki-laki'),
(16, 'Islam', 'BLOK A', 'BLOK A3', '327106230198', 'Dedi ibrahim', '2019/06/30', '2019/08/07', '32689978836677', 'Zaenudin', 'Laki-laki'),
(17, 'Islam', 'BLOK A', 'BLOK A6', '327106230198', 'Dedi ibrahim', '2019/06/30', '2019/06/30', '32689978836677', 'Pak Puat', 'Perumpuan');

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id_data_user` int(11) NOT NULL,
  `nama_depan` varchar(255) NOT NULL,
  `nama_belakang` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_data_user`, `nama_depan`, `nama_belakang`, `nama_lengkap`, `level`, `username`, `password`) VALUES
(16, 'Dedi', 'Ibrahim', 'Dedi Ibrahim', 'Admin', 'admin', '$2y$10$ik31DTVW3t0vx/PYeKU7T.FYT2H1T9NNXmtWK4C7OFf7d5lEz6Ae6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_ahli_waris`
--
ALTER TABLE `data_ahli_waris`
  ADD PRIMARY KEY (`id_data_ahli_waris`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `data_berkas_jenazah`
--
ALTER TABLE `data_berkas_jenazah`
  ADD PRIMARY KEY (`id_data_berkas_jenazah`),
  ADD KEY `berkas` (`berkas`);

--
-- Indexes for table `data_biaya`
--
ALTER TABLE `data_biaya`
  ADD PRIMARY KEY (`id_data_biaya`),
  ADD KEY `nik_jenazah` (`nik_jenazah`);

--
-- Indexes for table `data_blok`
--
ALTER TABLE `data_blok`
  ADD PRIMARY KEY (`id_data_blok`),
  ADD KEY `nama_blok` (`nama_blok`);

--
-- Indexes for table `data_jenazah`
--
ALTER TABLE `data_jenazah`
  ADD PRIMARY KEY (`id_data_jenazah`),
  ADD KEY `nik_jenazah` (`nik_jenazah`),
  ADD KEY `nik_ahli_waris` (`nik_ahli_waris`),
  ADD KEY `blok_makam` (`blok_makam`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id_data_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_ahli_waris`
--
ALTER TABLE `data_ahli_waris`
  MODIFY `id_data_ahli_waris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `data_berkas_jenazah`
--
ALTER TABLE `data_berkas_jenazah`
  MODIFY `id_data_berkas_jenazah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `data_biaya`
--
ALTER TABLE `data_biaya`
  MODIFY `id_data_biaya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `data_blok`
--
ALTER TABLE `data_blok`
  MODIFY `id_data_blok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `data_jenazah`
--
ALTER TABLE `data_jenazah`
  MODIFY `id_data_jenazah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id_data_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_berkas_jenazah`
--
ALTER TABLE `data_berkas_jenazah`
  ADD CONSTRAINT `data_berkas_jenazah_ibfk_1` FOREIGN KEY (`berkas`) REFERENCES `data_jenazah` (`nik_jenazah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_biaya`
--
ALTER TABLE `data_biaya`
  ADD CONSTRAINT `data_biaya_ibfk_1` FOREIGN KEY (`nik_jenazah`) REFERENCES `data_jenazah` (`nik_jenazah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_jenazah`
--
ALTER TABLE `data_jenazah`
  ADD CONSTRAINT `data_jenazah_ibfk_1` FOREIGN KEY (`nik_ahli_waris`) REFERENCES `data_ahli_waris` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_jenazah_ibfk_2` FOREIGN KEY (`blok_makam`) REFERENCES `data_blok` (`nama_blok`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
