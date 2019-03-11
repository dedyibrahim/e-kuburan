-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2019 at 02:49 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

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
  `id_berkas` varchar(255) NOT NULL,
  `no_client` varchar(255) NOT NULL,
  `no_berkas` varchar(255) NOT NULL,
  `status_berkas` varchar(255) NOT NULL,
  `tanggal_dibuat` varchar(255) NOT NULL,
  `tanggal_selesai` varchar(255) DEFAULT NULL,
  `folder_berkas` varchar(255) NOT NULL,
  `no_user` varchar(255) NOT NULL,
  `jenis_perizinan` varchar(255) NOT NULL,
  `id_jenis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_berkas`
--

INSERT INTO `data_berkas` (`id_data_berkas`, `id_berkas`, `no_client`, `no_berkas`, `status_berkas`, `tanggal_dibuat`, `tanggal_selesai`, `folder_berkas`, `no_user`, `jenis_perizinan`, `id_jenis`) VALUES
(4, '20190309/0001/000001', 'C_000001', '000001', 'Proses', '2019/03/09', NULL, 'file_000001', '0001', 'Akta pendirian Perseroan Terbatas ( PT )', 'J_0001'),
(5, '20190310/0001/000002', 'C_000002', '000002', 'Proses', '2019/03/10', NULL, 'file_000002', '0001', 'Akta pendirian Yayasan', 'J_0009');

-- --------------------------------------------------------

--
-- Table structure for table `data_client`
--

CREATE TABLE `data_client` (
  `id_data_client` int(11) NOT NULL,
  `no_client` varchar(255) NOT NULL,
  `nama_client` varchar(255) NOT NULL,
  `jenis_client` varchar(255) NOT NULL,
  `alamat_client` varchar(255) NOT NULL,
  `tanggal_daftar` varchar(255) NOT NULL,
  `pembuat_client` varchar(255) NOT NULL,
  `no_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_client`
--

INSERT INTO `data_client` (`id_data_client`, `no_client`, `nama_client`, `jenis_client`, `alamat_client`, `tanggal_daftar`, `pembuat_client`, `no_user`) VALUES
(4, 'C_000001', 'PT Angkasindo Dunia', 'Perorangan', 'Jl.Muara Karang Blok L9 T No.8 Penjaringan Jakarta Utara', '2019/03/09', 'Dedy Ibrahim', '0001'),
(5, 'C_000002', 'PT Angkasindo Dunia', 'Perorangan', 'dedi ibrahim', '2019/03/10', 'Dedy Ibrahim', '0001');

-- --------------------------------------------------------

--
-- Table structure for table `data_jenis_dokumen`
--

CREATE TABLE `data_jenis_dokumen` (
  `id_jenis_dokumen` int(11) NOT NULL,
  `no_jenis_dokumen` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `nama_jenis` varchar(255) NOT NULL,
  `tanggal_dibuat` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `data_jenis_dokumen`
--

INSERT INTO `data_jenis_dokumen` (`id_jenis_dokumen`, `no_jenis_dokumen`, `pekerjaan`, `nama_jenis`, `tanggal_dibuat`, `pembuat_jenis`) VALUES
(1, 'J_0001', 'NOTARIS', 'Akta pendirian Perseroan Terbatas ( PT )', '2019-03-05 06:28:28.165949', 'Dedy Ibrahim'),
(2, 'J_0002', 'NOTARIS', 'Akta perubahan perseroan terbatas ( PT )', '2019-03-05 06:29:24.100515', 'Dedy Ibrahim'),
(3, 'J_0003', 'NOTARIS', 'Akta pendirian CV', '2019-03-05 06:30:13.576017', 'Dedy Ibrahim'),
(4, 'J_0004', 'NOTARIS', 'Akta perubahan CV', '2019-03-05 06:30:31.712436', 'Dedy Ibrahim'),
(5, 'J_0005', 'NOTARIS', 'Akta pendirian Firma', '2019-03-05 06:31:49.696745', 'Dedy Ibrahim'),
(6, 'J_0006', 'NOTARIS', 'Akta perubahan Firma', '2019-03-05 06:32:10.476590', 'Dedy Ibrahim'),
(7, 'J_0007', 'NOTARIS', 'Akta pendirian Koperasi', '2019-03-05 06:33:01.350481', 'Dedy Ibrahim'),
(8, 'J_0008', 'NOTARIS', 'Akta perubahan Koperasi', '2019-03-05 06:33:23.456080', 'Dedy Ibrahim'),
(9, 'J_0009', 'NOTARIS', 'Akta pendirian Yayasan', '2019-03-05 06:37:31.682419', 'Dedy Ibrahim'),
(10, 'J_0010', 'NOTARIS', 'Akta perubahan Yayasan', '2019-03-05 06:37:55.661141', 'Dedy Ibrahim'),
(11, 'J_0011', 'NOTARIS', 'Akta pendirian Perkumpulan', '2019-03-05 06:38:39.618898', 'Dedy Ibrahim'),
(12, 'J_0012', 'NOTARIS', 'Akta perubahan Perkumpulan', '2019-03-05 06:39:10.083953', 'Dedy Ibrahim'),
(13, 'J_0013', 'NOTARIS', 'Akta perjanjian Hutang', '2019-03-05 06:40:41.199175', 'Dedy Ibrahim'),
(14, 'J_0014', 'NOTARIS', 'Akta perjanjian Kawin', '2019-03-05 06:40:58.992524', 'Dedy Ibrahim'),
(15, 'J_0015', 'NOTARIS', 'Akta perjanjian Jual Beli', '2019-03-05 06:41:35.892605', 'Dedy Ibrahim'),
(16, 'J_0016', 'NOTARIS', 'Akta perjanjian Sewa Menyewa', '2019-03-05 06:42:18.334631', 'Dedy Ibrahim'),
(17, 'J_0017', 'NOTARIS', 'Akta perjanjian Kerjasama', '2019-03-05 06:42:50.359475', 'Dedy Ibrahim'),
(18, 'J_0018', 'NOTARIS', 'Akta perjanjian Kredit', '2019-03-05 06:43:23.037420', 'Dedy Ibrahim'),
(20, 'J_0019', 'NOTARIS', 'Akta perjanjian Koperasi', '2019-03-05 06:45:58.615867', 'Dedy Ibrahim'),
(21, 'J_0020', 'NOTARIS', 'Akta Wasiat', '2019-03-05 06:46:23.085321', 'Dedy Ibrahim'),
(22, 'J_0021', 'NOTARIS', 'Akta jaminan Tanah', '2019-03-05 06:50:01.945909', 'Dedy Ibrahim'),
(23, 'J_0022', 'NOTARIS', 'Akta Jaminan personal Guarantee', '2019-03-05 06:50:30.948411', 'Dedy Ibrahim'),
(24, 'J_0023', 'NOTARIS', 'Akta Fidusia', '2019-03-05 06:50:46.733389', 'Dedy Ibrahim'),
(25, 'J_0024', 'NOTARIS', 'Akta legalisir surat Kuasa', '2019-03-05 06:57:20.671361', 'Dedy Ibrahim'),
(27, 'J_0025', 'NOTARIS', 'Akta Legalisir Surat Kuasa', '2019-03-05 06:58:53.346596', 'Dedy Ibrahim'),
(28, 'J_0026', 'NOTARIS', 'Akta legalisir surat Pernyataan', '2019-03-05 07:00:34.582190', 'Dedy Ibrahim'),
(29, 'J_0027', 'NOTARIS', 'Akta legalisir Surat Persetujuan', '2019-03-05 07:01:02.329769', 'Dedy Ibrahim'),
(30, 'J_0028', 'PPAT', 'Akta peralihan hak Jual Beli', '2019-03-05 07:02:58.130489', 'Dedy Ibrahim'),
(31, 'J_0029', 'PPAT', 'Akta peralihan hak Hibah', '2019-03-05 07:04:15.530001', 'Dedy Ibrahim'),
(32, 'J_0030', 'PPAT', 'Akta peralihan hak Tukar Menukar', '2019-03-05 07:03:55.906857', 'Dedy Ibrahim'),
(33, 'J_0031', 'PPAT', 'Akta peralihan hak Pembagian Hak', '2019-03-05 07:06:21.486152', 'Dedy Ibrahim'),
(34, 'J_0032', 'PPAT', 'Akta pembebanan hak SKMHT', '2019-03-05 07:06:07.412667', 'Dedy Ibrahim'),
(35, 'J_0033', 'PPAT', 'Akta pembebanan hak APHT', '2019-03-05 07:07:18.824630', 'Dedy Ibrahim');

-- --------------------------------------------------------

--
-- Table structure for table `data_perorangan`
--

CREATE TABLE `data_perorangan` (
  `id_perorangan` int(11) NOT NULL,
  `no_nama_perorangan` varchar(255) NOT NULL,
  `nama_identitas` varchar(255) NOT NULL,
  `no_identitas` varchar(255) NOT NULL,
  `jenis_identitas` varchar(255) NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `file_berkas` varchar(255) NOT NULL,
  `status_jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_syarat_jenis_dokumen`
--

CREATE TABLE `data_syarat_jenis_dokumen` (
  `id_syarat_dokumen` int(11) NOT NULL,
  `no_nama_dokumen` varchar(255) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `no_berkas` varchar(255) NOT NULL,
  `file_berkas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_syarat_perorangan`
--

CREATE TABLE `data_syarat_perorangan` (
  `id_data_syarat_perorangan` int(11) NOT NULL,
  `no_nama_perorangan` varchar(255) NOT NULL,
  `nama_identitas` varchar(255) NOT NULL,
  `no_identitas` varchar(255) NOT NULL,
  `jenis_identitas` varchar(255) NOT NULL,
  `no_berkas` varchar(255) NOT NULL,
  `file_berkas` varchar(255) NOT NULL,
  `file_lampiran` varchar(255) NOT NULL,
  `status_jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nama_dokumen`
--

CREATE TABLE `nama_dokumen` (
  `id_nama_dokumen` int(11) NOT NULL,
  `no_nama_dokumen` varchar(255) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `tanggal_dibuat` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `nama_dokumen`
--

INSERT INTO `nama_dokumen` (`id_nama_dokumen`, `no_nama_dokumen`, `nama_dokumen`, `tanggal_dibuat`, `pembuat`) VALUES
(1, 'N_0001', 'Surat Izin Usaha Perdagangan ( SIUP )', '2019-03-06 06:35:35.892906', 'Dedy Ibrahim'),
(2, 'N_0002', 'Nomor pokok wajib pajak (NPWP)', '2019-03-06 06:36:01.479696', 'Dedy Ibrahim'),
(3, 'N_0003', 'SK Kehakiman', '2019-03-06 06:36:20.751813', 'Dedy Ibrahim'),
(4, 'N_0004', 'Tanda daftar perusahaan ( TDP )', '2019-03-06 06:36:57.464862', 'Dedy Ibrahim'),
(5, 'N_0005', 'Domisili', '2019-03-06 06:37:33.825515', 'Dedy Ibrahim');

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
  `tanggal_daftar` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `no_user`, `username`, `nama_lengkap`, `email`, `phone`, `level`, `tanggal_daftar`, `password`, `foto`, `status`) VALUES
(14, '0001', 'Dedi', 'Dedy Ibrahim', 'dedyibrahym23@gmail.com', '0887487772', 'Admin', '2019-02-27 06:36:37.309694', '21232f297a57a5a743894a0e4a801fc3', NULL, 'Aktif'),
(15, '0002', 'zaenudin', 'zaenudin al bughuri', 'sajarudin', '082381109774', 'Admin', '2019-02-27 06:36:18.564278', '7815696ecbf1c96e6894b779456d330e', NULL, 'Aktif'),
(16, '0003', 'Fajri', 'Fajri Ja', 'fajri@gmail.com', '081873772', 'Admin', '2019-02-27 06:35:46.434698', '21232f297a57a5a743894a0e4a801fc3', NULL, 'Aktif'),
(17, '0004', 'Wisnu', 'nugroho', 'wisnu@gmail.com', '081289903664', 'Admin', '2019-02-27 06:12:13.449046', '21232f297a57a5a743894a0e4a801fc3', NULL, 'Aktif'),
(18, '0005', 'BANS', 'WISNU SUBROTO NOVI ARIYANTO', 'yuniaryanto697@gmail.com', '087877912311', 'Admin', '2019-03-05 07:41:05.163385', 'ea6b2efbdd4255a9f1b3bbc6399b58f4', NULL, 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_berkas`
--
ALTER TABLE `data_berkas`
  ADD PRIMARY KEY (`id_data_berkas`),
  ADD KEY `no_berkas` (`no_berkas`),
  ADD KEY `id_jenis` (`id_jenis`),
  ADD KEY `no_client` (`no_client`);

--
-- Indexes for table `data_client`
--
ALTER TABLE `data_client`
  ADD PRIMARY KEY (`id_data_client`),
  ADD KEY `no_client` (`no_client`),
  ADD KEY `no_user` (`no_user`);

--
-- Indexes for table `data_perorangan`
--
ALTER TABLE `data_perorangan`
  ADD PRIMARY KEY (`id_perorangan`),
  ADD KEY `no_nama_perorangan` (`no_nama_perorangan`);

--
-- Indexes for table `data_syarat_jenis_dokumen`
--
ALTER TABLE `data_syarat_jenis_dokumen`
  ADD PRIMARY KEY (`id_syarat_dokumen`),
  ADD KEY `no_nama_dokumen` (`no_nama_dokumen`),
  ADD KEY `no_berkas` (`no_berkas`);

--
-- Indexes for table `data_syarat_perorangan`
--
ALTER TABLE `data_syarat_perorangan`
  ADD PRIMARY KEY (`id_data_syarat_perorangan`),
  ADD KEY `no_nama_perorangan` (`no_nama_perorangan`),
  ADD KEY `no_berkas` (`no_berkas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_berkas`
--
ALTER TABLE `data_berkas`
  MODIFY `id_data_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `data_client`
--
ALTER TABLE `data_client`
  MODIFY `id_data_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `data_jenis_dokumen`
--
ALTER TABLE `data_jenis_dokumen`
  MODIFY `id_jenis_dokumen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_perorangan`
--
ALTER TABLE `data_perorangan`
  MODIFY `id_perorangan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_syarat_jenis_dokumen`
--
ALTER TABLE `data_syarat_jenis_dokumen`
  MODIFY `id_syarat_dokumen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_syarat_perorangan`
--
ALTER TABLE `data_syarat_perorangan`
  MODIFY `id_data_syarat_perorangan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nama_dokumen`
--
ALTER TABLE `nama_dokumen`
  MODIFY `id_nama_dokumen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_berkas`
--
ALTER TABLE `data_berkas`
  ADD CONSTRAINT `data_berkas_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `data_jenis_dokumen` (`no_jenis_dokumen`),
  ADD CONSTRAINT `data_berkas_ibfk_2` FOREIGN KEY (`no_client`) REFERENCES `data_client` (`no_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_client`
--
ALTER TABLE `data_client`
  ADD CONSTRAINT `data_client_ibfk_1` FOREIGN KEY (`no_user`) REFERENCES `user` (`no_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_syarat_jenis_dokumen`
--
ALTER TABLE `data_syarat_jenis_dokumen`
  ADD CONSTRAINT `data_syarat_jenis_dokumen_ibfk_1` FOREIGN KEY (`no_berkas`) REFERENCES `data_berkas` (`no_berkas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_syarat_jenis_dokumen_ibfk_2` FOREIGN KEY (`no_nama_dokumen`) REFERENCES `nama_dokumen` (`no_nama_dokumen`);

--
-- Constraints for table `data_syarat_perorangan`
--
ALTER TABLE `data_syarat_perorangan`
  ADD CONSTRAINT `data_syarat_perorangan_ibfk_1` FOREIGN KEY (`no_nama_perorangan`) REFERENCES `data_perorangan` (`no_nama_perorangan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_syarat_perorangan_ibfk_2` FOREIGN KEY (`no_berkas`) REFERENCES `data_berkas` (`no_berkas`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
