-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 27, 2019 at 04:35 PM
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
(21, 'J_0003', 'NOTARIS', 'Akta Pendirian Firma', '2019-02-26 09:23:42.930930', 'Dedy Ibrahim'),
(22, 'J_0004', 'NOTARIS', 'Perjanjian Hutang', '2019-02-27 01:43:26.810944', 'Dedy Ibrahim'),
(23, 'J_0005', 'PPAT', 'Akta Peralihan Hak Jual Beli', '2019-02-27 01:43:56.315881', 'Dedy Ibrahim'),
(24, 'J_0006', 'PPAT', 'Akta Peralihan Hak Hibah', '2019-02-27 06:49:57.007134', 'Dedy Ibrahim'),
(25, 'J_0007', 'PPAT', 'Akta Peralihan Hak Tukar Menukar', '2019-02-27 06:50:33.959891', 'Dedy Ibrahim'),
(26, 'J_0008', 'NOTARIS', 'Akta Peralihan Hak Pembagian Hak', '2019-02-27 07:08:16.622642', 'Dedy Ibrahim');

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
(43, 'J_0005', 'N_0002', 'KK (Kartu Keluarga)', 'undefined', '2019-02-27 07:13:56.710589', 'Dedy Ibrahim'),
(44, 'J_0008', 'N_0002', 'KK (Kartu Keluarga)', 'wajib', '2019-02-27 07:25:03.056056', 'Dedy Ibrahim'),
(45, 'J_0008', 'N_0001', 'Akta nikah', 'wajib', '2019-02-27 07:56:34.153895', 'Dedy Ibrahim'),
(46, 'J_0008', 'N_0004', 'NPWP (Nomor pokok wajib pajak)', 'wajib', '2019-02-27 07:56:34.270698', 'Dedy Ibrahim'),
(47, 'J_0008', 'N_0002', 'KK (Kartu Keluarga)', 'wajib', '2019-02-27 07:56:34.495391', 'Dedy Ibrahim'),
(48, 'J_0008', 'N_0006', 'Akta perubahan', 'wajib', '2019-02-27 07:56:34.536271', 'Dedy Ibrahim'),
(49, 'J_0008', 'N_0005', 'Akta pendirian', 'wajib', '2019-02-27 07:56:34.576968', 'Dedy Ibrahim'),
(50, 'J_0008', 'N_0003', 'KTP (Kartu tanda penduduk)', 'wajib', '2019-02-27 07:56:34.668862', 'Dedy Ibrahim'),
(51, 'J_0008', 'N_0007', 'SK Kehakiman', 'wajib', '2019-02-27 07:56:34.710041', 'Dedy Ibrahim'),
(52, 'J_0008', 'N_0008', 'SIUP', 'wajib', '2019-02-27 07:56:34.761470', 'Dedy Ibrahim'),
(53, 'J_0008', 'N_0011', 'Voucher Bayar', 'wajib', '2019-02-27 07:56:34.802068', 'Dedy Ibrahim'),
(54, 'J_0008', 'N_0009', 'TDP', 'wajib', '2019-02-27 07:56:34.842758', 'Dedy Ibrahim'),
(55, 'J_0008', 'N_0010', 'DOMISILI', 'wajib', '2019-02-27 07:56:34.924660', 'Dedy Ibrahim');

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
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `tanggal_daftar` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `no_user`, `username`, `nama_lengkap`, `email`, `phone`, `level`, `tanggal_daftar`, `password`, `foto`, `status`) VALUES
(14, '0001', 'Dedi', 'Dedy Ibrahim', 'dedyibrahym23@gmail.com', '0887487772', 'Admin', '2019-02-27 06:36:37.309694', '21232f297a57a5a743894a0e4a801fc3', NULL, 'Aktif'),
(15, '0002', 'zaenudin', 'zaenudin al bughuri', 'sajarudin', '082381109774', 'Admin', '2019-02-27 06:36:18.564278', '7815696ecbf1c96e6894b779456d330e', NULL, 'Aktif'),
(16, '0003', 'Fajri', 'Fajri Ja', 'fajri@gmail.com', '081873772', 'Admin', '2019-02-27 06:35:46.434698', '21232f297a57a5a743894a0e4a801fc3', NULL, 'Aktif'),
(17, '0004', 'Wisnu', 'nugroho', 'wisnu@gmail.com', '081289903664', 'Admin', '2019-02-27 06:12:13.449046', '21232f297a57a5a743894a0e4a801fc3', NULL, 'Aktif');

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
  MODIFY `id_jenis_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `data_syarat_jenis_dokumen`
--
ALTER TABLE `data_syarat_jenis_dokumen`
  MODIFY `id_syarat_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `nama_dokumen`
--
ALTER TABLE `nama_dokumen`
  MODIFY `id_nama_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
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
