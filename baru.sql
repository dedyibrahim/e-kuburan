-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: notaris
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `data_berkas`
--

DROP TABLE IF EXISTS `data_berkas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_berkas` (
  `id_data_berkas` int(11) NOT NULL AUTO_INCREMENT,
  `no_client` varchar(255) DEFAULT NULL,
  `no_pekerjaan` varchar(255) DEFAULT NULL,
  `no_nama_dokumen` varchar(255) DEFAULT NULL,
  `pemberi_pekerjaan` varchar(255) NOT NULL,
  `nama_folder` varchar(255) DEFAULT NULL,
  `nama_berkas` varchar(255) DEFAULT NULL,
  `nama_file` varchar(255) NOT NULL,
  `status_berkas` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `pengupload` varchar(255) DEFAULT NULL,
  `pengurus_perizinan` varchar(255) DEFAULT NULL,
  `no_pengurus` varchar(255) DEFAULT NULL,
  `tanggal_tugas` varchar(255) DEFAULT NULL,
  `tanggal_proses_tugas` varchar(255) DEFAULT NULL,
  `target_kelar_perizinan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_data_berkas`),
  KEY `nama_berkas` (`nama_berkas`),
  KEY `no_client` (`no_client`),
  KEY `no_pekerjaan` (`no_pekerjaan`),
  KEY `no_nama_dokumen` (`no_nama_dokumen`),
  CONSTRAINT `data_berkas_ibfk_1` FOREIGN KEY (`no_client`) REFERENCES `data_client` (`no_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `data_berkas_ibfk_2` FOREIGN KEY (`no_pekerjaan`) REFERENCES `data_pekerjaan` (`no_pekerjaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `data_berkas_ibfk_3` FOREIGN KEY (`no_nama_dokumen`) REFERENCES `nama_dokumen` (`no_nama_dokumen`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_berkas`
--

LOCK TABLES `data_berkas` WRITE;
/*!40000 ALTER TABLE `data_berkas` DISABLE KEYS */;
INSERT INTO `data_berkas` VALUES (150,'C_000001','000001','N_0001','0007',NULL,NULL,'Surat Izin Usaha Perdagangan ( SIUP )','Perizinan','Proses',NULL,'Wisnu Subroto N.A','0002','12/04/2019','12/04/2019','13/04/2019');
/*!40000 ALTER TABLE `data_berkas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_client`
--

DROP TABLE IF EXISTS `data_client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_client` (
  `id_data_client` int(11) NOT NULL AUTO_INCREMENT,
  `no_client` varchar(255) NOT NULL,
  `nama_client` varchar(255) NOT NULL,
  `jenis_client` varchar(255) NOT NULL,
  `alamat_client` varchar(255) NOT NULL,
  `tanggal_daftar` varchar(255) NOT NULL,
  `pembuat_client` varchar(255) NOT NULL,
  `no_user` varchar(255) NOT NULL,
  `nama_folder` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  PRIMARY KEY (`id_data_client`),
  KEY `no_client` (`no_client`),
  KEY `no_user` (`no_user`),
  CONSTRAINT `data_client_ibfk_1` FOREIGN KEY (`no_user`) REFERENCES `user` (`no_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_client`
--

LOCK TABLES `data_client` WRITE;
/*!40000 ALTER TABLE `data_client` DISABLE KEYS */;
INSERT INTO `data_client` VALUES (27,'C_000001','PT MELAMUN TIGA BELAS','Badan Hukum','Jl.Raya Bogor','11/04/2019 14:11:29','Yus Suwandari','0007','Dok000001',''),(28,'C_000002','PT Melamun Tiga Belas','Badan Hukum','JL.muara karang Blok L9 T No.8 Penjaringan Jakarta','12/04/2019 08:37:23','Yus Suwandari','0007','Dok000002','093498884');
/*!40000 ALTER TABLE `data_client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_daftar_persyaratan`
--

DROP TABLE IF EXISTS `data_daftar_persyaratan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_daftar_persyaratan` (
  `id_data_daftar_persyaratan` int(11) NOT NULL AUTO_INCREMENT,
  `no_daftar_persyaratan` varchar(255) NOT NULL,
  `nama_persyaratan` varchar(255) NOT NULL,
  `no_nama_dokumen` varchar(255) DEFAULT NULL,
  `nama_lampiran` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_data_daftar_persyaratan`),
  KEY `no_nama_dokumen` (`no_nama_dokumen`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_daftar_persyaratan`
--

LOCK TABLES `data_daftar_persyaratan` WRITE;
/*!40000 ALTER TABLE `data_daftar_persyaratan` DISABLE KEYS */;
INSERT INTO `data_daftar_persyaratan` VALUES (7,'S_001','Komisaris utama','N_0006','KTP (Kartu Tanda Penduduk)'),(8,'S_002','Direktur utama','N_0006','KTP (Kartu Tanda Penduduk)'),(9,'S_003','Jumlah Saham','',''),(10,'S_004','Jumlah karyawan','','');
/*!40000 ALTER TABLE `data_daftar_persyaratan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_jenis_dokumen`
--

DROP TABLE IF EXISTS `data_jenis_dokumen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_jenis_dokumen` (
  `id_jenis_dokumen` int(11) NOT NULL AUTO_INCREMENT,
  `no_jenis_dokumen` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `nama_jenis` varchar(255) NOT NULL,
  `tanggal_dibuat` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `pembuat_jenis` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jenis_dokumen`),
  KEY `no_jenis_dokumen` (`no_jenis_dokumen`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_jenis_dokumen`
--

LOCK TABLES `data_jenis_dokumen` WRITE;
/*!40000 ALTER TABLE `data_jenis_dokumen` DISABLE KEYS */;
INSERT INTO `data_jenis_dokumen` VALUES (1,'J_0001','NOTARIS','Akta pendirian Perseroan Terbatas ( PT )','2019-03-05 06:28:28.165949','Dedy Ibrahim'),(2,'J_0002','NOTARIS','Akta perubahan perseroan terbatas ( PT )','2019-03-05 06:29:24.100515','Dedy Ibrahim'),(3,'J_0003','NOTARIS','Akta pendirian CV','2019-03-05 06:30:13.576017','Dedy Ibrahim'),(4,'J_0004','NOTARIS','Akta perubahan CV','2019-03-05 06:30:31.712436','Dedy Ibrahim'),(5,'J_0005','NOTARIS','Akta pendirian Firma','2019-03-05 06:31:49.696745','Dedy Ibrahim'),(6,'J_0006','NOTARIS','Akta perubahan Firma','2019-03-05 06:32:10.476590','Dedy Ibrahim'),(7,'J_0007','NOTARIS','Akta pendirian Koperasi','2019-03-05 06:33:01.350481','Dedy Ibrahim'),(8,'J_0008','NOTARIS','Akta perubahan Koperasi','2019-03-05 06:33:23.456080','Dedy Ibrahim'),(9,'J_0009','NOTARIS','Akta pendirian Yayasan','2019-03-05 06:37:31.682419','Dedy Ibrahim'),(10,'J_0010','NOTARIS','Akta perubahan Yayasan','2019-03-05 06:37:55.661141','Dedy Ibrahim'),(11,'J_0011','NOTARIS','Akta pendirian Perkumpulan','2019-03-05 06:38:39.618898','Dedy Ibrahim'),(12,'J_0012','NOTARIS','Akta perubahan Perkumpulan','2019-03-05 06:39:10.083953','Dedy Ibrahim'),(13,'J_0013','NOTARIS','Akta perjanjian Hutang','2019-03-05 06:40:41.199175','Dedy Ibrahim'),(14,'J_0014','NOTARIS','Akta perjanjian Kawin','2019-03-05 06:40:58.992524','Dedy Ibrahim'),(15,'J_0015','NOTARIS','Akta perjanjian Jual Beli','2019-03-05 06:41:35.892605','Dedy Ibrahim'),(16,'J_0016','NOTARIS','Akta perjanjian Sewa Menyewa','2019-03-05 06:42:18.334631','Dedy Ibrahim'),(17,'J_0017','NOTARIS','Akta perjanjian Kerjasama','2019-03-05 06:42:50.359475','Dedy Ibrahim'),(18,'J_0018','NOTARIS','Akta perjanjian Kredit','2019-03-05 06:43:23.037420','Dedy Ibrahim'),(20,'J_0019','NOTARIS','Akta perjanjian Koperasi','2019-03-05 06:45:58.615867','Dedy Ibrahim'),(21,'J_0020','NOTARIS','Akta Wasiat','2019-03-05 06:46:23.085321','Dedy Ibrahim'),(22,'J_0021','NOTARIS','Akta jaminan Tanah','2019-03-05 06:50:01.945909','Dedy Ibrahim'),(23,'J_0022','NOTARIS','Akta Jaminan personal Guarantee','2019-03-05 06:50:30.948411','Dedy Ibrahim'),(24,'J_0023','NOTARIS','Akta Fidusia','2019-03-05 06:50:46.733389','Dedy Ibrahim'),(25,'J_0024','NOTARIS','Akta legalisir surat Kuasa','2019-03-05 06:57:20.671361','Dedy Ibrahim'),(27,'J_0025','NOTARIS','Akta Legalisir Surat Kuasa','2019-03-05 06:58:53.346596','Dedy Ibrahim'),(28,'J_0026','NOTARIS','Akta legalisir surat Pernyataan','2019-03-05 07:00:34.582190','Dedy Ibrahim'),(29,'J_0027','NOTARIS','Akta legalisir Surat Persetujuan','2019-03-05 07:01:02.329769','Dedy Ibrahim'),(30,'J_0028','PPAT','Akta peralihan hak Jual Beli','2019-03-05 07:02:58.130489','Dedy Ibrahim'),(31,'J_0029','PPAT','Akta peralihan hak Hibah','2019-03-05 07:04:15.530001','Dedy Ibrahim'),(32,'J_0030','PPAT','Akta peralihan hak Tukar Menukar','2019-03-05 07:03:55.906857','Dedy Ibrahim'),(33,'J_0031','PPAT','Akta peralihan hak Pembagian Hak','2019-03-05 07:06:21.486152','Dedy Ibrahim'),(34,'J_0032','PPAT','Akta pembebanan hak SKMHT','2019-03-05 07:06:07.412667','Dedy Ibrahim'),(35,'J_0033','PPAT','Akta pembebanan hak APHT','2019-03-05 07:07:18.824630','Dedy Ibrahim');
/*!40000 ALTER TABLE `data_jenis_dokumen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_meta`
--

DROP TABLE IF EXISTS `data_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_meta` (
  `id_data_meta` int(11) NOT NULL AUTO_INCREMENT,
  `no_nama_dokumen` varchar(255) NOT NULL,
  `nama_meta` varchar(25) NOT NULL,
  PRIMARY KEY (`id_data_meta`),
  KEY `no_nama_dokumen` (`no_nama_dokumen`),
  CONSTRAINT `data_meta_ibfk_1` FOREIGN KEY (`no_nama_dokumen`) REFERENCES `nama_dokumen` (`no_nama_dokumen`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_meta`
--

LOCK TABLES `data_meta` WRITE;
/*!40000 ALTER TABLE `data_meta` DISABLE KEYS */;
INSERT INTO `data_meta` VALUES (25,'N_0006','NIK'),(26,'N_0006','Nama'),(28,'N_0006','Tanggal lahir'),(30,'N_0005','No Domisili'),(31,'N_0005','Keterangan'),(32,'N_0004','No TDP'),(33,'N_0004','Keterangan'),(34,'N_0003','No SK'),(35,'N_0002','No NPWP'),(36,'N_0002','Nama'),(37,'N_0002','Tanggal lahir'),(38,'N_0001','No SIUP'),(39,'N_0001','Keterangan'),(40,'N_0006','Alamat');
/*!40000 ALTER TABLE `data_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_meta_berkas`
--

DROP TABLE IF EXISTS `data_meta_berkas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_meta_berkas` (
  `id_data_meta_berkas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_berkas` varchar(255) NOT NULL,
  `no_client` varchar(255) NOT NULL,
  `no_pekerjaan` varchar(255) NOT NULL,
  `no_nama_dokumen` varchar(255) NOT NULL,
  `nama_meta` varchar(255) NOT NULL,
  `value_meta` varchar(255) NOT NULL,
  `nama_folder` varchar(255) NOT NULL,
  PRIMARY KEY (`id_data_meta_berkas`),
  KEY `nama_berkas` (`nama_berkas`),
  CONSTRAINT `data_meta_berkas_ibfk_1` FOREIGN KEY (`nama_berkas`) REFERENCES `data_berkas` (`nama_berkas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_meta_berkas`
--

LOCK TABLES `data_meta_berkas` WRITE;
/*!40000 ALTER TABLE `data_meta_berkas` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_meta_berkas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_pekerjaan`
--

DROP TABLE IF EXISTS `data_pekerjaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_pekerjaan` (
  `id_data_pekerjaan` int(11) NOT NULL AUTO_INCREMENT,
  `no_client` varchar(255) NOT NULL,
  `no_pekerjaan` varchar(255) NOT NULL,
  `status_pekerjaan` varchar(255) NOT NULL,
  `tanggal_dibuat` varchar(255) NOT NULL,
  `count_up` varchar(255) NOT NULL,
  `tanggal_selesai` varchar(255) DEFAULT NULL,
  `no_user` varchar(255) NOT NULL,
  `pembuat_pekerjaan` varchar(255) NOT NULL,
  `jenis_perizinan` varchar(255) NOT NULL,
  `tanggal_antrian` varchar(255) DEFAULT NULL,
  `tanggal_proses` varchar(255) NOT NULL,
  `target_kelar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_data_pekerjaan`),
  KEY `no_client` (`no_client`),
  KEY `no_pekerjaan` (`no_pekerjaan`),
  CONSTRAINT `data_pekerjaan_ibfk_1` FOREIGN KEY (`no_client`) REFERENCES `data_client` (`no_client`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_pekerjaan`
--

LOCK TABLES `data_pekerjaan` WRITE;
/*!40000 ALTER TABLE `data_pekerjaan` DISABLE KEYS */;
INSERT INTO `data_pekerjaan` VALUES (26,'C_000001','000001','Proses','11/04/2019 14:11:29','Apr,11,2019, 14:11:29',NULL,'0007','Yus Suwandari','Akta perubahan perseroan terbatas ( PT )','11/04/2019 14:11:29','2019/04/11','12/04/2019'),(27,'C_000002','000002','Masuk','12/04/2019 08:37:23','Apr,12,2019, 08:37:23',NULL,'0007','Yus Suwandari','Akta perubahan perseroan terbatas ( PT )','12/04/2019 08:37:23','','30/04/2019');
/*!40000 ALTER TABLE `data_pekerjaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_persyaratan`
--

DROP TABLE IF EXISTS `data_persyaratan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_persyaratan` (
  `id_data_persyaratan` int(11) NOT NULL AUTO_INCREMENT,
  `no_pekerjaan` varchar(255) NOT NULL,
  `key_syarat` varchar(255) NOT NULL,
  `value_syarat` varchar(255) NOT NULL,
  PRIMARY KEY (`id_data_persyaratan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_persyaratan`
--

LOCK TABLES `data_persyaratan` WRITE;
/*!40000 ALTER TABLE `data_persyaratan` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_persyaratan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nama_dokumen`
--

DROP TABLE IF EXISTS `nama_dokumen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nama_dokumen` (
  `id_nama_dokumen` int(11) NOT NULL AUTO_INCREMENT,
  `no_nama_dokumen` varchar(255) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `tanggal_dibuat` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `pembuat` varchar(255) NOT NULL,
  PRIMARY KEY (`id_nama_dokumen`),
  KEY `no_nama_dokumen` (`no_nama_dokumen`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nama_dokumen`
--

LOCK TABLES `nama_dokumen` WRITE;
/*!40000 ALTER TABLE `nama_dokumen` DISABLE KEYS */;
INSERT INTO `nama_dokumen` VALUES (1,'N_0001','Surat Izin Usaha Perdagangan ( SIUP )','2019-03-06 06:35:35.892906','Dedy Ibrahim'),(2,'N_0002','Nomor pokok wajib pajak (NPWP)','2019-03-06 06:36:01.479696','Dedy Ibrahim'),(3,'N_0003','SK Kehakiman','2019-03-06 06:36:20.751813','Dedy Ibrahim'),(4,'N_0004','Tanda daftar perusahaan ( TDP )','2019-03-06 06:36:57.464862','Dedy Ibrahim'),(5,'N_0005','Domisili','2019-03-06 06:37:33.825515','Dedy Ibrahim'),(6,'N_0006','KTP (Kartu Tanda Penduduk)','2019-04-08 08:00:54.463990','Admin');
/*!40000 ALTER TABLE `nama_dokumen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `no_user` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `sublevel` varchar(255) DEFAULT NULL,
  `tanggal_daftar` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `no_user` (`no_user`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (14,'0001','admin','Admin','dedy@notaris-jakarta.com','0887487772','Super Admin',NULL,'2019-04-05 09:30:21.093254','21232f297a57a5a743894a0e4a801fc3',NULL,'Aktif'),(20,'0002','wisnu','Wisnu Subroto N.A','yuniaryanto679@gmail.com','087877912311','User','Level 3','2019-04-02 01:43:38.764832','ea6b2efbdd4255a9f1b3bbc6399b58f4',NULL,'Aktif'),(21,'0003','dian','Siti Rizki Dianti','dian@notaris-jakarta.com','085289885222','User','Level 2','2019-04-01 02:39:45.400718','e1b1d45dcc900e3539ba69762603f963',NULL,'Aktif'),(22,'0004','prima','Prima Yuddy F Y','prima@notaris-jakarta.com','085263908704','User','Level 2','2019-04-01 02:39:26.162350','d8f49869c8583b77ddb82847f3f1955f',NULL,'Aktif'),(23,'0005','dini','Pratiwi S Dini','dini@notaris-jakarta.com','081273602067','User','Level 2','2019-04-01 02:39:10.277360','41a8e3d62e005f880e82ef061c571cc8',NULL,'Aktif'),(24,'0006','rifka','Rifka Ramadani','rifka@notaris-jakarta.com','087739397228','User','Level 2','2019-04-01 02:38:59.368236','92d4f526576c8ad74cbab94ebb239790',NULL,'Aktif'),(25,'0007','yus','Yus Suwandari','yus@notaris-jakarta.com','081280716583','User','Level 2','2019-04-05 04:03:51.483501','efb6e5a9e90a1126301802ee0b3f11b8',NULL,'Aktif'),(26,'0008','esthi','Esthi Herlina','esthi@notaris-jakarta.com','081517697047','User','Level 2','2019-04-05 09:32:07.165660','debac5a803a64b50f4cf2211d921e589',NULL,'Aktif'),(27,'0009','ria','haryati Ardi','ria@notaris-jakarta.com','087871555505','User','Level 2','2019-04-01 02:37:53.534903','85edfaa624cbcf1cfd892d0d9336976e',NULL,'Aktif'),(29,'0010','indy','indarty','indy@notaris-jakarta.com','087876227696','User','Level 2','2019-04-02 04:08:22.572826','9fbefd6f3a1c3c29e341415e7d48c386',NULL,'Aktif'),(30,'0011','fitri','Fitri Sejayani','fitri@notaris-jakarta.com','08121923365','User','Level 2','2019-04-02 04:08:22.642780','1df83ea9876252776d4b1e53baebc926',NULL,'Aktif'),(31,'0012','fadzri','MK Fadzri Patriajaya','fadzri@notaris-jakarta.com','087788105424','User','Level 3','2019-04-05 07:32:34.997528','f46ef81f2464441ba58aeecbf654ee41',NULL,'Aktif'),(32,'0013','rohmad300','agus rohmad','agusrohmad300@gmail.com','081806446192','User','Level 1','2019-04-02 04:08:22.816289','18fe193144e4fb51d8679a9ce1818fd1',NULL,'Aktif');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-12 14:57:14
