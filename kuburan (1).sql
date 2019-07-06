-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 07, 2019 at 06:22 AM
-- Server version: 5.7.26-log
-- PHP Version: 7.0.33-0ubuntu0.16.04.5

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
  `id_ahli_waris` char(7) NOT NULL,
  `nik_ahli_waris` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `status_berkas` varchar(10) NOT NULL,
  `hubungan_keluarga` varchar(10) NOT NULL,
  `file_ktp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_ahli_waris`
--

INSERT INTO `data_ahli_waris` (`id_ahli_waris`, `nik_ahli_waris`, `password`, `email`, `nama`, `alamat`, `no_tlp`, `status_berkas`, `hubungan_keluarga`, `file_ktp`) VALUES
('AW0001', '12163861', '$2y$10$6Vo0a.luvknrW9iFRPwN7OTiMZ91KKwKJCVnOTKNUw3lHsSI0Ks2m', 'chikorehan@gmail.com', 'Khaerur rekhan', 'jl.raya pondok rajeg', '081289903664', '', 'Ayah', '');

-- --------------------------------------------------------

--
-- Table structure for table `data_berkas_jenazah`
--

CREATE TABLE `data_berkas_jenazah` (
  `id_berkas_jenazah` char(7) NOT NULL,
  `nama_berkas` varchar(30) NOT NULL,
  `file` text NOT NULL,
  `id_jenazah` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_berkas_jenazah`
--

INSERT INTO `data_berkas_jenazah` (`id_berkas_jenazah`, `nama_berkas`, `file`, `id_jenazah`) VALUES
('BJ0001', 'KTP Jenazah', 'a8698eb29b2a5a0aaa9713acc3b46146.jpg', 'JNZ0001'),
('BJ0002', 'Surat pengantar RT RW', '4d2633e185023ee200206c81a47e1a26.jpg', 'JNZ0001'),
('BJ0003', 'Surat pengantar rumah sakit', 'c1edb20626da962ab7fde33b3e5568c8.jpg', 'JNZ0001'),
('BJ0004', 'Kartu Keluarga', '811aa19a7452f7a1ef3c4a4a75e4ccbd.jpg', 'JNZ0001');

-- --------------------------------------------------------

--
-- Table structure for table `data_blok`
--

CREATE TABLE `data_blok` (
  `id_blok` char(7) NOT NULL,
  `nama_blok` varchar(15) NOT NULL,
  `jumlah_makam` varchar(5) NOT NULL,
  `nama_agama` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_blok`
--

INSERT INTO `data_blok` (`id_blok`, `nama_blok`, `jumlah_makam`, `nama_agama`) VALUES
('BLOK01', 'BLOK A', '100', 'Islam'),
('BLOK02', 'BLOK B', '100', 'Kristen'),
('BLOK03', 'BLOK C', '100', 'Budha'),
('BLOK04', 'BLOK D', '30', 'Kristen');

-- --------------------------------------------------------

--
-- Table structure for table `data_jenazah`
--

CREATE TABLE `data_jenazah` (
  `id_jenazah` char(7) NOT NULL,
  `id_ahli_waris` char(7) NOT NULL,
  `nama_jenazah` varchar(50) NOT NULL,
  `nik_jenazah` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tanggal_wafat` date NOT NULL,
  `tanggal_expired` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_jenazah`
--

INSERT INTO `data_jenazah` (`id_jenazah`, `id_ahli_waris`, `nama_jenazah`, `nik_jenazah`, `jenis_kelamin`, `tanggal_lahir`, `tanggal_wafat`, `tanggal_expired`) VALUES
('JNZ0001', 'AW0001', 'nasrulloh', '111111', 'Laki-laki', '2019-07-07', '2019-07-07', '2024-07-07');

-- --------------------------------------------------------

--
-- Table structure for table `data_pembayaran`
--

CREATE TABLE `data_pembayaran` (
  `id_pembayaran` char(10) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `jenis_biaya` varchar(50) NOT NULL,
  `jumlah_biaya` int(11) NOT NULL,
  `id_detail_pemesanan` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_pembayaran`
--

INSERT INTO `data_pembayaran` (`id_pembayaran`, `tanggal_pembayaran`, `jenis_biaya`, `jumlah_biaya`, `id_detail_pemesanan`) VALUES
('INV0001', '2019-07-07', 'Pemesanan makam', 800000, 'IDP0002'),
('INV0002', '2019-07-07', 'Batu nisan', 300000, 'IDP0002'),
('INV0003', '2019-07-07', 'Perpanjang', 100000, 'IDP0002');

-- --------------------------------------------------------

--
-- Table structure for table `data_perpanjang`
--

CREATE TABLE `data_perpanjang` (
  `id_perpanjang` char(10) NOT NULL,
  `id_jenazah` char(7) NOT NULL,
  `bukti_transfer` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_perpanjang`
--

INSERT INTO `data_perpanjang` (`id_perpanjang`, `id_jenazah`, `bukti_transfer`, `status`) VALUES
('PPJM0001', 'JNZ0001', '45170f45331f111e358e0f5775c7a3b3.jpg', 'Berhasil');

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id_data_user` char(7) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_data_user`, `nama_depan`, `nama_belakang`, `nama_lengkap`, `level`, `username`, `password`) VALUES
('USR0001', 'Administrator', 'Kuburan', 'Administrator Kuburan', 'Admin', 'admin', '$2y$10$fdWUjNdZMJGmD.I5owjl6OhKh452Dc5S69c1d56tzMdrrNpXSdMJS'),
('USR0002', 'User', 'Kuburan', 'User Kuburan', 'User', 'user', '$2y$10$wMbylkN6NuHozpGiNXSNr.ZvofWZaPNEjKRljEVujc28yCz0Q1bw6');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `id_detail_pemesanan` char(7) NOT NULL,
  `id_jenazah` char(7) NOT NULL,
  `id_blok` char(7) NOT NULL,
  `no_blok` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`id_detail_pemesanan`, `id_jenazah`, `id_blok`, `no_blok`) VALUES
('IDP0002', 'JNZ0001', 'BLOK01', 'BLOK A2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_ahli_waris`
--
ALTER TABLE `data_ahli_waris`
  ADD PRIMARY KEY (`id_ahli_waris`);

--
-- Indexes for table `data_berkas_jenazah`
--
ALTER TABLE `data_berkas_jenazah`
  ADD PRIMARY KEY (`id_berkas_jenazah`),
  ADD KEY `id_jenazah` (`id_jenazah`);

--
-- Indexes for table `data_blok`
--
ALTER TABLE `data_blok`
  ADD PRIMARY KEY (`id_blok`);

--
-- Indexes for table `data_jenazah`
--
ALTER TABLE `data_jenazah`
  ADD PRIMARY KEY (`id_jenazah`),
  ADD KEY `id_ahli_waris` (`id_ahli_waris`);

--
-- Indexes for table `data_pembayaran`
--
ALTER TABLE `data_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_detail_pemesanan` (`id_detail_pemesanan`);

--
-- Indexes for table `data_perpanjang`
--
ALTER TABLE `data_perpanjang`
  ADD PRIMARY KEY (`id_perpanjang`),
  ADD KEY `id_jenazah` (`id_jenazah`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id_data_user`);

--
-- Indexes for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`id_detail_pemesanan`),
  ADD KEY `id_jenazah` (`id_jenazah`),
  ADD KEY `id_blok` (`id_blok`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_berkas_jenazah`
--
ALTER TABLE `data_berkas_jenazah`
  ADD CONSTRAINT `data_berkas_jenazah_ibfk_1` FOREIGN KEY (`id_jenazah`) REFERENCES `data_jenazah` (`id_jenazah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_jenazah`
--
ALTER TABLE `data_jenazah`
  ADD CONSTRAINT `data_jenazah_ibfk_1` FOREIGN KEY (`id_ahli_waris`) REFERENCES `data_ahli_waris` (`id_ahli_waris`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_pembayaran`
--
ALTER TABLE `data_pembayaran`
  ADD CONSTRAINT `data_pembayaran_ibfk_1` FOREIGN KEY (`id_detail_pemesanan`) REFERENCES `detail_pemesanan` (`id_detail_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_perpanjang`
--
ALTER TABLE `data_perpanjang`
  ADD CONSTRAINT `data_perpanjang_ibfk_1` FOREIGN KEY (`id_jenazah`) REFERENCES `data_jenazah` (`id_jenazah`);

--
-- Constraints for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD CONSTRAINT `detail_pemesanan_ibfk_1` FOREIGN KEY (`id_jenazah`) REFERENCES `data_jenazah` (`id_jenazah`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pemesanan_ibfk_2` FOREIGN KEY (`id_blok`) REFERENCES `data_blok` (`id_blok`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
