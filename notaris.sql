-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 19, 2019 at 04:17 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_berkas`
--

CREATE TABLE `data_berkas` (
  `id_data_berkas` int(11) NOT NULL,
  `no_client` varchar(255) NOT NULL,
  `no_jenis_dokumen` varchar(255) NOT NULL,
  `tanggal_upload` varchar(255) NOT NULL,
  `pengupload` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_client`
--

CREATE TABLE `data_client` (
  `id_data_client` int(11) NOT NULL,
  `no_client` varchar(255) NOT NULL,
  `nama_client` varchar(255) NOT NULL,
  `jenis_client` varchar(255) NOT NULL,
  `tanggal_daftar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_dokumen`
--

CREATE TABLE `data_dokumen` (
  `id_data_client` int(11) NOT NULL,
  `no_jenis_dokumen` varchar(255) NOT NULL,
  `no_syarat_dokumen` varchar(255) NOT NULL,
  `tanggal_dibuat` varchar(255) NOT NULL,
  `pembuat_data_dokumen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_jenis_dokumen`
--

CREATE TABLE `data_jenis_dokumen` (
  `id_jenis_dokumen` int(11) NOT NULL,
  `no_jenis_dokumen` varchar(255) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `tanggal_dibuat` varchar(255) NOT NULL,
  `pembuat_dokumen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_syarat_jenis_dokumen`
--

CREATE TABLE `data_syarat_jenis_dokumen` (
  `id_syarat_dokumen` int(11) NOT NULL,
  `no_syarat_dokumen` varchar(255) NOT NULL,
  `nama_syarat` varchar(255) NOT NULL,
  `tanggal_dibuat` varchar(255) NOT NULL,
  `pembuat_dokumen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'dedi', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_berkas`
--
ALTER TABLE `data_berkas`
  ADD PRIMARY KEY (`id_data_berkas`),
  ADD KEY `no_jenis_dokumen` (`no_jenis_dokumen`),
  ADD KEY `no_client` (`no_client`);

--
-- Indexes for table `data_client`
--
ALTER TABLE `data_client`
  ADD PRIMARY KEY (`id_data_client`),
  ADD KEY `no_client` (`no_client`);

--
-- Indexes for table `data_dokumen`
--
ALTER TABLE `data_dokumen`
  ADD PRIMARY KEY (`id_data_client`),
  ADD KEY `no_jenis_dokumen` (`no_jenis_dokumen`),
  ADD KEY `no_syarat_dokumen` (`no_syarat_dokumen`);

--
-- Indexes for table `data_jenis_dokumen`
--
ALTER TABLE `data_jenis_dokumen`
  ADD PRIMARY KEY (`id_jenis_dokumen`),
  ADD KEY `no_jenis_dokumen` (`no_jenis_dokumen`);

--
-- Indexes for table `data_syarat_jenis_dokumen`
--
ALTER TABLE `data_syarat_jenis_dokumen`
  ADD PRIMARY KEY (`id_syarat_dokumen`),
  ADD KEY `no_syarat_dokumen` (`no_syarat_dokumen`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_berkas`
--
ALTER TABLE `data_berkas`
  MODIFY `id_data_berkas` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_client`
--
ALTER TABLE `data_client`
  MODIFY `id_data_client` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_dokumen`
--
ALTER TABLE `data_dokumen`
  MODIFY `id_data_client` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_jenis_dokumen`
--
ALTER TABLE `data_jenis_dokumen`
  MODIFY `id_jenis_dokumen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_syarat_jenis_dokumen`
--
ALTER TABLE `data_syarat_jenis_dokumen`
  MODIFY `id_syarat_dokumen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_berkas`
--
ALTER TABLE `data_berkas`
  ADD CONSTRAINT `data_berkas_ibfk_1` FOREIGN KEY (`no_client`) REFERENCES `data_client` (`no_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_berkas_ibfk_2` FOREIGN KEY (`no_jenis_dokumen`) REFERENCES `data_jenis_dokumen` (`no_jenis_dokumen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_dokumen`
--
ALTER TABLE `data_dokumen`
  ADD CONSTRAINT `data_dokumen_ibfk_1` FOREIGN KEY (`no_jenis_dokumen`) REFERENCES `data_jenis_dokumen` (`no_jenis_dokumen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_dokumen_ibfk_2` FOREIGN KEY (`no_syarat_dokumen`) REFERENCES `data_syarat_jenis_dokumen` (`no_syarat_dokumen`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
