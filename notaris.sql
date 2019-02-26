-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 26, 2019 at 04:48 PM
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
-- Table structure for table `data_jenis_dokumen`
--

CREATE TABLE `data_jenis_dokumen` (
  `id_jenis_dokumen` int(11) NOT NULL,
  `no_jenis_dokumen` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `nama_jenis` varchar(255) NOT NULL,
  `tanggal_dibuat` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `pembuat_jenis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_jenis_dokumen`
--

INSERT INTO `data_jenis_dokumen` (`id_jenis_dokumen`, `no_jenis_dokumen`, `pekerjaan`, `nama_jenis`, `tanggal_dibuat`, `pembuat_jenis`) VALUES
(19, 'J_0001', 'NOTARIS', 'Akta pendirian PT (Perseroan Terbatas)', '2019-02-26 07:28:02.515110', 'Dedy Ibrahim'),
(20, 'J_0002', 'NOTARIS', 'Akta pendirian CV', '2019-02-26 09:23:23.668040', 'Dedy Ibrahim'),
(21, 'J_0003', 'NOTARIS', 'Akta Pendirian Firma', '2019-02-26 09:23:42.930930', 'Dedy Ibrahim');

-- --------------------------------------------------------

--
-- Table structure for table `data_syarat_jenis_dokumen`
--

CREATE TABLE `data_syarat_jenis_dokumen` (
  `id_syarat_dokumen` int(11) NOT NULL,
  `no_jenis_dokumen` varchar(255) NOT NULL,
  `no_nama_dokumen` varchar(255) NOT NULL,
  `nama_syarat` varchar(255) NOT NULL,
  `status_syarat` varchar(255) NOT NULL,
  `tanggal_dibuat` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `pembuat_syarat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_syarat_jenis_dokumen`
--

INSERT INTO `data_syarat_jenis_dokumen` (`id_syarat_dokumen`, `no_jenis_dokumen`, `no_nama_dokumen`, `nama_syarat`, `status_syarat`, `tanggal_dibuat`, `pembuat_syarat`) VALUES
(4, 'J_0001', 'N_0002', 'KK (Kartu Keluarga)', 'undefined', '2019-02-26 09:04:08.116198', 'Dedy Ibrahim'),
(5, 'J_0001', 'N_0007', 'SK Kehakiman', 'undefined', '2019-02-26 09:04:08.174397', 'Dedy Ibrahim'),
(6, 'J_0001', 'N_0005', 'Akta pendirian', 'undefined', '2019-02-26 09:04:08.255904', 'Dedy Ibrahim'),
(7, 'J_0001', 'N_0010', 'DOMISILI', 'wajib', '2019-02-26 09:04:08.378428', 'Dedy Ibrahim'),
(8, 'J_0001', 'N_0002', 'KK (Kartu Keluarga)', 'undefined', '2019-02-26 09:04:08.672878', 'Dedy Ibrahim'),
(9, 'J_0001', 'N_0005', 'Akta pendirian', 'undefined', '2019-02-26 09:04:08.724673', 'Dedy Ibrahim'),
(10, 'J_0001', 'N_0007', 'SK Kehakiman', 'undefined', '2019-02-26 09:04:08.775933', 'Dedy Ibrahim'),
(11, 'J_0001', 'N_0010', 'DOMISILI', 'wajib', '2019-02-26 09:04:08.826828', 'Dedy Ibrahim');

-- --------------------------------------------------------

--
-- Table structure for table `nama_dokumen`
--

CREATE TABLE `nama_dokumen` (
  `id_nama_dokumen` int(11) NOT NULL,
  `no_nama_dokumen` varchar(255) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `tanggal_dibuat` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `pembuat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nama_dokumen`
--

INSERT INTO `nama_dokumen` (`id_nama_dokumen`, `no_nama_dokumen`, `nama_dokumen`, `tanggal_dibuat`, `pembuat`) VALUES
(8, 'N_0001', 'Akta nikah', '2019-02-26 06:49:17.097335', 'Dedy Ibrahim'),
(9, 'N_0002', 'KK (Kartu Keluarga)', '2019-02-26 06:49:37.945339', 'Dedy Ibrahim'),
(10, 'N_0003', 'KTP (Kartu tanda penduduk)', '2019-02-26 06:50:30.829062', 'Dedy Ibrahim'),
(11, 'N_0004', 'NPWP (Nomor pokok wajib pajak)', '2019-02-26 06:51:09.563744', 'Dedy Ibrahim'),
(12, 'N_0005', 'Akta pendirian', '2019-02-26 06:51:31.757534', 'Dedy Ibrahim'),
(13, 'N_0006', 'Akta perubahan', '2019-02-26 06:51:46.010922', 'Dedy Ibrahim'),
(14, 'N_0007', 'SK Kehakiman', '2019-02-26 06:52:10.422947', 'Dedy Ibrahim'),
(15, 'N_0008', 'SIUP', '2019-02-26 06:52:28.971613', 'Dedy Ibrahim'),
(16, 'N_0009', 'TDP', '2019-02-26 06:52:39.695265', 'Dedy Ibrahim'),
(17, 'N_0010', 'DOMISILI', '2019-02-26 06:52:50.917544', 'Dedy Ibrahim'),
(18, 'N_0011', 'Voucher Bayar', '2019-02-26 09:47:49.029433', 'Dedy Ibrahim');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `no_user` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `tanggal_daftar` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `no_user`, `username`, `nama_lengkap`, `level`, `tanggal_daftar`, `password`, `foto`, `status`) VALUES
(14, '0001', 'Dedi', 'Dedy Ibrahim', 'Admin', '2019-02-21 08:57:53.123384', '21232f297a57a5a743894a0e4a801fc3', NULL, 'Aktif'),
(15, '0002', 'zaenudin', 'zaenudin al bughuri', 'Admin', '2019-02-21 07:58:30.892528', '7815696ecbf1c96e6894b779456d330e', NULL, 'Aktif');

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
  ADD KEY `no_syarat_dokumen` (`no_jenis_dokumen`),
  ADD KEY `no_nama_dokumen` (`no_nama_dokumen`);

--
-- Indexes for table `nama_dokumen`
--
ALTER TABLE `nama_dokumen`
  ADD PRIMARY KEY (`id_nama_dokumen`),
  ADD KEY `no_nama_dokumen` (`no_nama_dokumen`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `no_user` (`no_user`);

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
-- AUTO_INCREMENT for table `data_jenis_dokumen`
--
ALTER TABLE `data_jenis_dokumen`
  MODIFY `id_jenis_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `data_syarat_jenis_dokumen`
--
ALTER TABLE `data_syarat_jenis_dokumen`
  MODIFY `id_syarat_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `nama_dokumen`
--
ALTER TABLE `nama_dokumen`
  MODIFY `id_nama_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
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
-- Constraints for table `data_syarat_jenis_dokumen`
--
ALTER TABLE `data_syarat_jenis_dokumen`
  ADD CONSTRAINT `data_syarat_jenis_dokumen_ibfk_1` FOREIGN KEY (`no_jenis_dokumen`) REFERENCES `data_jenis_dokumen` (`no_jenis_dokumen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_syarat_jenis_dokumen_ibfk_2` FOREIGN KEY (`no_nama_dokumen`) REFERENCES `nama_dokumen` (`no_nama_dokumen`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
