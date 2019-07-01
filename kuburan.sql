-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2019 at 09:21 PM
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
(2, '327106230198', 'Dedi ibrahim', 'Kp.Sumurwangi Kel.Kayumanis Kec.Tanah Sareal Kota Bogor', '081289903664', 'Terupload', 'Adik', '8dc6ed2db9473fb5f8fad06efa9c1692.jpg'),
(3, '327106230197', 'Subarjo', 'Jl.Raya Narogong', '089878833', 'Terupload', 'Ayah', '53924670252fee48e05bab02d5539917.jpg');

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
(56, 'KTP Jenazah', 'a0b5c96287132f2b8122f9362365d37c.jpg', '327106230196'),
(57, 'Surat pengantar RT RW', 'c055cd156fb861ff1707f23af2c71c6a.jpg', '327106230196'),
(58, 'Surat pengantar rumah sakit', '9c3911227a3bd1292aba435a4b6229ea.jpg', '327106230196'),
(59, 'Kartu Keluarga', '173fd41751c4ee448ceb5630de21371f.jpg', '327106230196'),
(60, 'KTP Jenazah', 'e36da9a99f8ece44d43620843b1bcf2c.jpg', '327106230195'),
(61, 'Surat pengantar RT RW', '926881684a3ad8a611fd039346e84948.jpg', '327106230195'),
(62, 'Surat pengantar rumah sakit', '89a7961a8a4ba59c57a2792dd9d20153.jpg', '327106230195'),
(63, 'Kartu Keluarga', '07006b5dcaced32aa2249c35653f8e0b.jpg', '327106230195');

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
(16, '327106230196', 'Pemesanan makam', '800000'),
(17, '327106230196', 'Batu nisan', '300000'),
(18, '327106230196', 'Perpanjang', '100000'),
(19, '327106230195', 'Pemesanan makam', '800000'),
(20, '327106230195', 'Batu nisan', '300000'),
(21, '327106230195', 'Perpanjang', '100000');

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
  `tanggal_expired` varchar(255) NOT NULL,
  `nik_jenazah` varchar(255) NOT NULL,
  `nama_jenazah` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_jenazah`
--

INSERT INTO `data_jenazah` (`id_data_jenazah`, `blok_agama`, `blok_makam`, `nama_makam`, `nik_ahli_waris`, `nama_ahli_waris`, `tanggal_lahir`, `tanggal_wafat`, `tanggal_expired`, `nik_jenazah`, `nama_jenazah`, `jenis_kelamin`) VALUES
(23, 'Islam', 'BLOK A', 'BLOK A1', '327106230198', 'Dedi ibrahim', '2019/07/02', '2019/07/02', '2024/07/01', '327106230196', 'Markonah', 'Perumpuan'),
(24, 'Kristen', 'BLOK B', 'BLOK B2', '327106230197', 'Subarjo', '2019/07/02', '2019/07/02', '2024/07/01', '327106230195', 'Zaenudin', 'Laki-laki');

-- --------------------------------------------------------

--
-- Table structure for table `data_perpanjang`
--

CREATE TABLE `data_perpanjang` (
  `id_data_perpanjang` int(11) NOT NULL,
  `nik_jenazah` varchar(255) NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_perpanjang`
--

INSERT INTO `data_perpanjang` (`id_data_perpanjang`, `nik_jenazah`, `bukti_transfer`, `status`) VALUES
(3, '327106230196', 'bd1653f1d5a2fe5b4588eef04e3e9310.jpg', 'Berhasil'),
(4, '327106230195', '8ae9007750fdb52c66ca1eabeee4ebca.jpg', 'Tolak');

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
-- Indexes for table `data_perpanjang`
--
ALTER TABLE `data_perpanjang`
  ADD PRIMARY KEY (`id_data_perpanjang`),
  ADD KEY `nik_jenazah` (`nik_jenazah`);

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
  MODIFY `id_data_ahli_waris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `data_berkas_jenazah`
--
ALTER TABLE `data_berkas_jenazah`
  MODIFY `id_data_berkas_jenazah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `data_biaya`
--
ALTER TABLE `data_biaya`
  MODIFY `id_data_biaya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `data_blok`
--
ALTER TABLE `data_blok`
  MODIFY `id_data_blok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `data_jenazah`
--
ALTER TABLE `data_jenazah`
  MODIFY `id_data_jenazah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `data_perpanjang`
--
ALTER TABLE `data_perpanjang`
  MODIFY `id_data_perpanjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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

--
-- Constraints for table `data_perpanjang`
--
ALTER TABLE `data_perpanjang`
  ADD CONSTRAINT `data_perpanjang_ibfk_1` FOREIGN KEY (`nik_jenazah`) REFERENCES `data_jenazah` (`nik_jenazah`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
