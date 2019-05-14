-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: notaris
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.18.04.1

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
  `tanggal_upload` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_data_berkas`),
  KEY `nama_berkas` (`nama_berkas`),
  KEY `no_client` (`no_client`),
  KEY `no_pekerjaan` (`no_pekerjaan`),
  KEY `no_nama_dokumen` (`no_nama_dokumen`),
  CONSTRAINT `data_berkas_ibfk_1` FOREIGN KEY (`no_client`) REFERENCES `data_client` (`no_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `data_berkas_ibfk_2` FOREIGN KEY (`no_pekerjaan`) REFERENCES `data_pekerjaan` (`no_pekerjaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `data_berkas_ibfk_3` FOREIGN KEY (`no_nama_dokumen`) REFERENCES `nama_dokumen` (`no_nama_dokumen`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_berkas`
--

LOCK TABLES `data_berkas` WRITE;
/*!40000 ALTER TABLE `data_berkas` DISABLE KEYS */;
INSERT INTO `data_berkas` VALUES (87,'C_000002','000002','N_0018','0007','Dok000002','3780b299a192ba8e7636a46ea08b94ce.JPG','ad','Persyaratan','','Yus Suwandari',NULL,NULL,NULL,NULL,NULL,'09/05/2019 10:2515'),(88,'C_000002','000002','N_0013','0007','Dok000002','ca35e8dd0973b4164480a07b46ca3f2d.doc','Persetujuan Komisaris','Persyaratan','','Yus Suwandari',NULL,NULL,NULL,NULL,NULL,'09/05/2019 10:2604'),(89,'C_000001','000001','N_0001','0007','Dok000001','47d25e2c9f041a548cb8e50ab2b3e2e1.doc','Surat Izin Usaha Perdagangan ( SIUP )','Perizinan','Selesai','Wisnu Subroto N.A','Wisnu Subroto N.A','0002','09/05/2019','09/05/2019','09/05/2019','09/05/2019 11:0146'),(90,'C_000001','000001','N_0017','0007','Dok000001','a9e13284b8a4c46635a50ee77278cf83.doc','SPPT PBBasd','Perizinan','Selesai','Wisnu Subroto N.A','Wisnu Subroto N.A','0002','09/05/2019','09/05/2019','09/05/2019','09/05/2019 11:2642'),(91,'C_000001','000001','N_0001','0007','Dok000001','6d42490046d69ef01928f6f5da0ca90c.JPG','Surat Izin Usaha Perdagangan ( SIUP )','Persyaratan','','Yus Suwandari',NULL,NULL,NULL,NULL,NULL,'09/05/2019 11:0003'),(92,'C_000001','000001','N_0003','0007','Dok000001','970797c89d98cecb2750adef39ec6638.JPG','SK Kehakiman','Persyaratan','','Yus Suwandari',NULL,NULL,NULL,NULL,NULL,'09/05/2019 11:0020');
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
  `contact_number` varchar(255) NOT NULL,
  PRIMARY KEY (`id_data_client`),
  KEY `no_client` (`no_client`),
  KEY `no_user` (`no_user`),
  CONSTRAINT `data_client_ibfk_1` FOREIGN KEY (`no_user`) REFERENCES `user` (`no_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_client`
--

LOCK TABLES `data_client` WRITE;
/*!40000 ALTER TABLE `data_client` DISABLE KEYS */;
INSERT INTO `data_client` VALUES (78,'C_000001','PT Angin RIbut','Badan Hukum','JL.Raya Bogor KM 32 Kec Ciracas ','09/05/2019 09:57:30','Yus Suwandari','0007','Dok000001','Bapak Kheru','081289903664'),(79,'C_000002','Bapak Zainudin','Perorangan','asdad','09/05/2019 10:22:33','Yus Suwandari','0007','Dok000002','Bapak Mufid','0218225544');
/*!40000 ALTER TABLE `data_client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_dokumen_utama`
--

DROP TABLE IF EXISTS `data_dokumen_utama`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_dokumen_utama` (
  `id_data_dokumen_utama` int(11) NOT NULL AUTO_INCREMENT,
  `nama_berkas` varchar(255) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `nama_folder` varchar(255) NOT NULL,
  `no_pekerjaan` varchar(255) NOT NULL,
  `waktu` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `no_client` varchar(255) NOT NULL,
  PRIMARY KEY (`id_data_dokumen_utama`),
  KEY `no_pekerjaan` (`no_pekerjaan`),
  CONSTRAINT `data_dokumen_utama_ibfk_1` FOREIGN KEY (`no_pekerjaan`) REFERENCES `data_pekerjaan` (`no_pekerjaan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_dokumen_utama`
--

LOCK TABLES `data_dokumen_utama` WRITE;
/*!40000 ALTER TABLE `data_dokumen_utama` DISABLE KEYS */;
INSERT INTO `data_dokumen_utama` VALUES (1,'Draft utama','9b1e4b79cc38429f66b2a743dcd5fdee.doc','Dok000002','000002','2019/05/09  10:31:48','Draft','C_000002');
/*!40000 ALTER TABLE `data_dokumen_utama` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_histori_pekerjaan`
--

DROP TABLE IF EXISTS `data_histori_pekerjaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_histori_pekerjaan` (
  `id_data_histori_pekerjaan` int(11) NOT NULL AUTO_INCREMENT,
  `no_user` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  PRIMARY KEY (`id_data_histori_pekerjaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_histori_pekerjaan`
--

LOCK TABLES `data_histori_pekerjaan` WRITE;
/*!40000 ALTER TABLE `data_histori_pekerjaan` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_histori_pekerjaan` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_jenis_dokumen`
--

LOCK TABLES `data_jenis_dokumen` WRITE;
/*!40000 ALTER TABLE `data_jenis_dokumen` DISABLE KEYS */;
INSERT INTO `data_jenis_dokumen` VALUES (1,'J_0001','NOTARIS','Akta pendirian Perseroan Terbatas ( PT )','2019-05-09 02:28:49.878210','Admin'),(2,'J_0002','NOTARIS','Akta perubahan perseroan terbatas ( PT )','2019-03-05 06:29:24.100515','Dedy Ibrahim'),(3,'J_0003','NOTARIS','Akta pendirian CV','2019-03-05 06:30:13.576017','Dedy Ibrahim'),(4,'J_0004','NOTARIS','Akta perubahan CV','2019-03-05 06:30:31.712436','Dedy Ibrahim'),(5,'J_0005','NOTARIS','Akta pendirian Firma','2019-03-05 06:31:49.696745','Dedy Ibrahim'),(6,'J_0006','NOTARIS','Akta perubahan Firma','2019-03-05 06:32:10.476590','Dedy Ibrahim'),(7,'J_0007','NOTARIS','Akta pendirian Koperasi','2019-03-05 06:33:01.350481','Dedy Ibrahim'),(8,'J_0008','NOTARIS','Akta perubahan Koperasi','2019-03-05 06:33:23.456080','Dedy Ibrahim'),(9,'J_0009','NOTARIS','Akta pendirian Yayasan','2019-03-05 06:37:31.682419','Dedy Ibrahim'),(10,'J_0010','NOTARIS','Akta perubahan Yayasan','2019-03-05 06:37:55.661141','Dedy Ibrahim'),(11,'J_0011','NOTARIS','Akta pendirian Perkumpulan','2019-03-05 06:38:39.618898','Dedy Ibrahim'),(12,'J_0012','NOTARIS','Akta perubahan Perkumpulan','2019-03-05 06:39:10.083953','Dedy Ibrahim'),(13,'J_0013','NOTARIS','Akta Pengakuan Hutang','2019-05-10 08:00:30.135319','Admin'),(14,'J_0014','NOTARIS','Akta Perjanjian Kawin','2019-05-10 08:00:07.451262','Admin'),(15,'J_0015','NOTARIS','Akta Perjanjian Pengikatan Jual Beli','2019-05-10 07:59:55.616911','Admin'),(16,'J_0016','NOTARIS','Akta Perjanjian Sewa Menyewa','2019-05-10 07:59:34.878470','Admin'),(17,'J_0017','NOTARIS','Akta Perjanjian Kerjasama','2019-05-10 07:59:16.773705','Admin'),(18,'J_0018','NOTARIS','Akta Perjanjian Kredit','2019-05-10 07:59:02.510424','Admin'),(20,'J_0019','NOTARIS','Akta Jual Beli Saham','2019-05-10 08:01:41.496718','Admin'),(21,'J_0020','NOTARIS','Akta Wasiat','2019-03-05 06:46:23.085321','Dedy Ibrahim'),(22,'J_0021','NOTARIS','Akta Corporate Guarantee','2019-05-10 08:03:50.450134','Admin'),(23,'J_0022','NOTARIS','Akta Personal Guarantee','2019-05-10 07:58:05.157704','Admin'),(24,'J_0023','NOTARIS','Akta Fidusia','2019-03-05 06:50:46.733389','Dedy Ibrahim'),(25,'J_0024','NOTARIS','Akta Hibah','2019-05-10 08:03:24.625917','Admin'),(27,'J_0025','NOTARIS','Akta Kuasa Untuk Menjual','2019-05-10 08:04:14.961903','Admin'),(28,'J_0026','NOTARIS','Waarmerking Dokumen','2019-05-10 07:57:25.277177','Admin'),(29,'J_0027','NOTARIS','Legalisasi Dokumen','2019-05-10 07:39:37.393049','Admin'),(30,'J_0028','PPAT','Akta Jual Beli (AJB)','2019-05-10 07:37:43.689411','Admin'),(31,'J_0029','PPAT','Akta Hibah','2019-05-10 07:37:22.904901','Admin'),(32,'J_0030','PPAT','Akta Tukar Menukar','2019-05-10 07:37:06.312726','Admin'),(33,'J_0031','PPAT','Akta Pembagian Hak Bersama (APHB)','2019-05-10 07:36:30.910911','Admin'),(34,'J_0032','NOTARIS','Akta Surat Kuasa Memberikan Hak Tanggungan (SKMHT)','2019-05-10 07:35:05.180965','Admin'),(35,'J_0033','PPAT','Akta Pemberian Hak Tanggungan (APHT)','2019-05-10 07:35:17.404236','Admin'),(36,'J_0034','NOTARIS','Akta Pernyataan (WARIS)','2019-05-10 08:45:35.985455','Admin');
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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_meta`
--

LOCK TABLES `data_meta` WRITE;
/*!40000 ALTER TABLE `data_meta` DISABLE KEYS */;
INSERT INTO `data_meta` VALUES (41,'N_0006','NIK'),(42,'N_0005','No.Domisili'),(43,'N_0004','No TDP'),(44,'N_0003','No SK'),(45,'N_0002','No NPWP'),(46,'N_0001','No SIUP'),(47,'N_0009','Keterangan'),(48,'N_0008','Keterangan'),(49,'N_0007','Keterangan'),(50,'N_0010','No KK ');
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
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_meta_berkas`
--

LOCK TABLES `data_meta_berkas` WRITE;
/*!40000 ALTER TABLE `data_meta_berkas` DISABLE KEYS */;
INSERT INTO `data_meta_berkas` VALUES (64,'3780b299a192ba8e7636a46ea08b94ce.JPG','C_000002','000002','N_0018','Nama_berkas','ad','Dok000002'),(65,'ca35e8dd0973b4164480a07b46ca3f2d.doc','C_000002','000002','N_0013','Nama_berkas','Persetujuan Komisaris','Dok000002'),(66,'6d42490046d69ef01928f6f5da0ca90c.JPG','C_000001','000001','N_0001','Nama_berkas','Surat Izin Usaha Perdagangan ( SIUP )','Dok000001'),(67,'6d42490046d69ef01928f6f5da0ca90c.JPG','C_000001','000001','N_0001','No_SIUP','123123','Dok000001'),(68,'970797c89d98cecb2750adef39ec6638.JPG','C_000001','000001','N_0003','Nama_berkas','SK Kehakiman','Dok000001'),(69,'970797c89d98cecb2750adef39ec6638.JPG','C_000001','000001','N_0003','No_SK','sadd','Dok000001'),(70,'47d25e2c9f041a548cb8e50ab2b3e2e1.doc','C_000001','000001','N_0001','Nama_berkas','Surat Izin Usaha Perdagangan ( SIUP )','Dok000001'),(71,'47d25e2c9f041a548cb8e50ab2b3e2e1.doc','C_000001','000001','N_0001','No_SIUP','123123','Dok000001'),(72,'a9e13284b8a4c46635a50ee77278cf83.doc','C_000001','000001','N_0017','Nama_berkas','SPPT PBBasd','Dok000001');
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
  `no_jenis_perizinan` varchar(255) NOT NULL,
  `tanggal_antrian` varchar(255) DEFAULT NULL,
  `tanggal_proses` varchar(255) NOT NULL,
  `target_kelar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_data_pekerjaan`),
  KEY `no_client` (`no_client`),
  KEY `no_pekerjaan` (`no_pekerjaan`),
  KEY `jenis_perizinan` (`jenis_perizinan`),
  CONSTRAINT `data_pekerjaan_ibfk_1` FOREIGN KEY (`no_client`) REFERENCES `data_client` (`no_client`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_pekerjaan`
--

LOCK TABLES `data_pekerjaan` WRITE;
/*!40000 ALTER TABLE `data_pekerjaan` DISABLE KEYS */;
INSERT INTO `data_pekerjaan` VALUES (84,'C_000001','000001','Selesai','09/05/2019 09:57:30','May,09,2019, 09:57:30','09/05/2019','0007','Yus Suwandari','Akta pendirian Perseroan Terbatas ( PT )','J_0001','09/05/2019 09:57:30','09/05/2019','09/05/2019'),(85,'C_000002','000002','Proses','09/05/2019 10:22:33','May,09,2019, 10:22:33',NULL,'0007','Yus Suwandari','Akta perubahan perseroan terbatas ( PT )','J_0002','09/05/2019 10:22:33','09/05/2019','10/05/2019');
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
  `no_nama_dokumen` varchar(255) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `no_jenis_dokumen` varchar(255) NOT NULL,
  PRIMARY KEY (`id_data_persyaratan`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_persyaratan`
--

LOCK TABLES `data_persyaratan` WRITE;
/*!40000 ALTER TABLE `data_persyaratan` DISABLE KEYS */;
INSERT INTO `data_persyaratan` VALUES (1,'N_0001','Surat Izin Usaha Perdagangan ( SIUP )','J_0033'),(2,'N_0001','Surat Izin Usaha Perdagangan ( SIUP )','J_0001'),(4,'N_0003','SK Kehakiman','J_0001'),(5,'N_0010','Kartu Keluarga KK','J_0001'),(6,'N_0016','Persetujuan Pasangan','J_0001'),(7,'N_0003','Asli dokumen yang akan dilegalisasi ','J_0027'),(8,'N_0006','KTP (Kartu Tanda Penduduk)','J_0027'),(9,'N_0032','Dokumen lain terkait isi/jenis dokumen yang dilegalisasi/diwaarmerking','J_0027'),(10,'N_0026','Asli Dokumen yang akan diwaarmerking','J_0026'),(11,'N_0006','KTP (Kartu Tanda Penduduk)','J_0026'),(12,'N_0032','Dokumen lain terkait isi/jenis dokumen yang dilegalisasi/diwaarmerking','J_0026'),(26,'N_0006','KTP (Kartu Tanda Penduduk)','J_0025'),(27,'N_0016','Persetujuan Pasangan / Akta Perjanjian Kawin','J_0025'),(28,'N_0010','Kartu Keluarga (KK)','J_0025'),(29,'N_0002','Nomor pokok wajib pajak (NPWP)','J_0025'),(33,'N_0011','Sertifikat Tanah','J_0025'),(34,'N_0017','SPPT PBB','J_0025'),(35,'N_0018','Izin Mendirikan Bangunan (IMB)','J_0025'),(39,'N_0011','Sertifikat Tanah','J_0032'),(40,'N_0017','SPPT PBB','J_0032'),(41,'N_0018','Izin Mendirikan Bangunan (IMB)','J_0032'),(42,'N_0006','KTP (Kartu Tanda Penduduk)','J_0032'),(43,'N_0016','Persetujuan Pasangan / Akta Perjanjian Kawin','J_0032'),(46,'N_0002','Nomor pokok wajib pajak (NPWP)','J_0032'),(47,'N_0010','Kartu Keluarga (KK)','J_0032'),(48,'N_0009','Anggaran Dasar beserta SK','J_0032'),(49,'N_0005','Surat Keterangan Domisili','J_0032'),(50,'N_0029','NIB (Nomor Induk Berusaha)','J_0032'),(52,'N_0008','Persetujuan RUPS (BAR/PKR/PKPS)','J_0032'),(53,'N_0013','Persetujuan Dewan Komisaris','J_0032'),(54,'N_0030','Izin khusus lainnya (apabila ada)','J_0032'),(55,'N_0009','Anggaran Dasar beserta SK','J_0025'),(56,'N_0005','Surat Keterangan Domisili','J_0025'),(57,'N_0029','NIB (Nomor Induk Berusaha)','J_0025'),(58,'N_0008','Persetujuan RUPS (BAR/PKR/PKPS)','J_0025'),(59,'N_0013','Persetujuan Dewan Komisaris','J_0025'),(60,'N_0030','Izin khusus lainnya (apabila ada)','J_0025'),(61,'N_0006','KTP (Kartu Tanda Penduduk)','J_0024'),(62,'N_0010','Kartu Keluarga (KK)','J_0024'),(63,'N_0016','Persetujuan Pasangan / Akta Perjanjian Kawin','J_0024'),(64,'N_0012','Buku Nikah','J_0024'),(65,'N_0012','Buku Nikah','J_0025'),(66,'N_0012','Buku Nikah','J_0032'),(67,'N_0006','KTP (Kartu Tanda Penduduk)','J_0034'),(68,'N_0027','Akta Kematian','J_0034'),(69,'N_0012','Buku Nikah','J_0034'),(70,'N_0019','Akta Kelahiran','J_0034'),(71,'N_0010','Kartu Keluarga (KK)','J_0034'),(73,'N_0033','Dokumen obyek hibah (BPKB, Deposito, sertifikat saham, dsb)','J_0024'),(74,'N_0006','KTP (Kartu Tanda Penduduk)','J_0021'),(75,'N_0031','Surat ganti nama WNI','J_0034');
/*!40000 ALTER TABLE `data_persyaratan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_persyaratan_pekerjaan`
--

DROP TABLE IF EXISTS `data_persyaratan_pekerjaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_persyaratan_pekerjaan` (
  `id_data_persyaratan_pekerjaan` int(11) NOT NULL AUTO_INCREMENT,
  `no_pekerjaan` varchar(255) NOT NULL,
  `no_client` varchar(255) NOT NULL,
  `no_nama_dokumen` varchar(255) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `no_jenis_dokumen` varchar(255) NOT NULL,
  PRIMARY KEY (`id_data_persyaratan_pekerjaan`),
  KEY `no_pekerjaan` (`no_pekerjaan`),
  CONSTRAINT `data_persyaratan_pekerjaan_ibfk_1` FOREIGN KEY (`no_pekerjaan`) REFERENCES `data_pekerjaan` (`no_pekerjaan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_persyaratan_pekerjaan`
--

LOCK TABLES `data_persyaratan_pekerjaan` WRITE;
/*!40000 ALTER TABLE `data_persyaratan_pekerjaan` DISABLE KEYS */;
INSERT INTO `data_persyaratan_pekerjaan` VALUES (83,'000001','C_000001','N_0001','Surat Izin Usaha Perdagangan ( SIUP )','J_0001'),(84,'000001','C_000001','N_0003','SK Kehakiman','J_0001'),(85,'000001','C_000001','N_0010','Kartu Keluarga KK','J_0001'),(86,'000001','C_000001','N_0016','Persetujuan Pasangan','J_0001'),(90,'000001','C_000001','N_0017','SPPT PBB','J_0001'),(91,'000001','C_000001','N_0019','Akta Kelahiran','J_0001'),(92,'000001','C_000001','N_0011','SERTIFIKAT TANAH','J_0001'),(93,'000002','C_000002','N_0018','IMB','J_0002'),(94,'000002','C_000002','N_0013','Persetujuan Komisaris','J_0002'),(95,'000002','C_000002','N_0016','Persetujuan Pasangan','J_0002'),(96,'000002','C_000002','N_0011','SERTIFIKAT TANAH','J_0002');
/*!40000 ALTER TABLE `data_persyaratan_pekerjaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_progress_pekerjaan`
--

DROP TABLE IF EXISTS `data_progress_pekerjaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_progress_pekerjaan` (
  `id_data_progress_pekerjaan` int(11) NOT NULL AUTO_INCREMENT,
  `no_pekerjaan` varchar(255) NOT NULL,
  `no_user` varchar(255) NOT NULL,
  `laporan_pekerjaan` varchar(255) NOT NULL,
  `waktu` varchar(255) NOT NULL,
  PRIMARY KEY (`id_data_progress_pekerjaan`),
  KEY `no_pekerjaan` (`no_pekerjaan`),
  CONSTRAINT `data_progress_pekerjaan_ibfk_1` FOREIGN KEY (`no_pekerjaan`) REFERENCES `data_pekerjaan` (`no_pekerjaan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_progress_pekerjaan`
--

LOCK TABLES `data_progress_pekerjaan` WRITE;
/*!40000 ALTER TABLE `data_progress_pekerjaan` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_progress_pekerjaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_progress_perizinan`
--

DROP TABLE IF EXISTS `data_progress_perizinan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_progress_perizinan` (
  `id_data_progress_perizinan` int(11) NOT NULL AUTO_INCREMENT,
  `id_data_berkas` varchar(255) NOT NULL,
  `no_pekerjaan` varchar(255) NOT NULL,
  `no_user` varchar(255) NOT NULL,
  `laporan` text NOT NULL,
  `waktu` varchar(255) NOT NULL,
  PRIMARY KEY (`id_data_progress_perizinan`),
  KEY `id_data_berkas` (`id_data_berkas`),
  KEY `no_pekerjaan` (`no_pekerjaan`),
  CONSTRAINT `data_progress_perizinan_ibfk_1` FOREIGN KEY (`no_pekerjaan`) REFERENCES `data_pekerjaan` (`no_pekerjaan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_progress_perizinan`
--

LOCK TABLES `data_progress_perizinan` WRITE;
/*!40000 ALTER TABLE `data_progress_perizinan` DISABLE KEYS */;
INSERT INTO `data_progress_perizinan` VALUES (1,'90','000001','0012','MK Fadzri Patriajaya Menolak Tugas SPPT PBB dengan alasan ','09/05/2019 10:52:33'),(2,'90','000001','0012','MK Fadzri Patriajaya Menolak Tugas SPPT PBB dengan alasan banyak kasus sengketa yang tidak bisa dikerjakan','09/05/2019 10:57:02'),(3,'89','000001','0002','Dalam proses kcamatan','09/05/2019 10:59:28'),(4,'90','000001','0002','Dalam kecamatan','09/05/2019 11:26:28');
/*!40000 ALTER TABLE `data_progress_perizinan` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nama_dokumen`
--

LOCK TABLES `nama_dokumen` WRITE;
/*!40000 ALTER TABLE `nama_dokumen` DISABLE KEYS */;
INSERT INTO `nama_dokumen` VALUES (1,'N_0001','Surat Izin Usaha Perdagangan ( SIUP )','2019-03-06 06:35:35.892906','Dedy Ibrahim'),(2,'N_0002','Nomor pokok wajib pajak (NPWP)','2019-03-06 06:36:01.479696','Dedy Ibrahim'),(3,'N_0003','Asli dokumen yang akan dilegalisasi ','2019-05-10 07:45:29.450496','Admin'),(4,'N_0004','Tanda daftar perusahaan ( TDP )','2019-03-06 06:36:57.464862','Dedy Ibrahim'),(5,'N_0005','Surat Keterangan Domisili','2019-05-10 07:51:55.156500','Admin'),(6,'N_0006','KTP (Kartu Tanda Penduduk)','2019-04-08 08:00:54.463990','Admin'),(7,'N_0007','SP BKPM','2019-04-15 04:10:33.049895','Admin'),(8,'N_0008','Persetujuan RUPS (BAR/PKR/PKPS)','2019-05-10 07:44:26.156078','Admin'),(9,'N_0009','Anggaran Dasar beserta SK','2019-05-10 07:42:22.873063','Admin'),(10,'N_0010','Kartu Keluarga (KK)','2019-05-10 07:43:39.535427','Admin'),(11,'N_0011','Sertifikat Tanah','2019-05-10 07:43:15.943957','Admin'),(12,'N_0012','Buku Nikah','2019-04-30 07:47:56.479177','Admin'),(13,'N_0013','Persetujuan Dewan Komisaris','2019-05-10 07:50:13.317528','Admin'),(16,'N_0014','No. HP dan alamat email pmg saham dan pengurus','2019-05-03 01:54:02.152595','Admin'),(17,'N_0015','Pernyataan Dan Lampiran Fidusia','2019-05-03 01:54:11.503389','Admin'),(18,'N_0016','Persetujuan Pasangan / Akta Perjanjian Kawin','2019-05-10 07:50:00.134728','Admin'),(19,'N_0017','SPPT PBB','2019-05-03 01:54:27.152313','Admin'),(20,'N_0018','Izin Mendirikan Bangunan (IMB)','2019-05-10 07:51:07.431326','Admin'),(21,'N_0019','Akta Kelahiran','2019-05-03 01:54:42.001677','Admin'),(29,'N_0020','Passpor','2019-05-06 01:10:20.137408','Admin'),(30,'N_0021','BAR Pendirian Koperasi','2019-05-10 07:46:18.584331','Admin'),(31,'N_0022','Nomor Induk Koperasi (NIK)','2019-05-10 07:48:43.580820','Admin'),(32,'N_0023','Daftar Hadir Rapat','2019-05-10 07:47:12.226951','Admin'),(33,'N_0024','Fc Deposito Bank pemerintah min Rp. 15 juta','2019-05-10 07:47:51.961846','Admin'),(34,'N_0025','BAR Anggota Koperasi','2019-05-10 07:49:24.552007','Admin'),(35,'N_0026','Asli Dokumen yang akan diwaarmerking','2019-05-10 07:52:20.287023','Admin'),(36,'N_0027','Akta Kematian','2019-05-10 07:53:18.840214','Admin'),(37,'N_0028','Surat Keterangan Waris','2019-05-10 07:53:41.544865','Admin'),(38,'N_0029','NIB (Nomor Induk Berusaha)','2019-05-10 07:54:45.201843','Admin'),(39,'N_0030','Izin khusus lainnya (apabila ada)','2019-05-10 07:55:31.250812','Admin'),(40,'N_0031','Surat ganti nama WNI','2019-05-10 07:56:08.829073','Admin'),(41,'N_0032','Dokumen lain terkait isi/jenis dokumen yang dilegalisasi/diwaarmerking','2019-05-10 08:07:08.198314','Admin'),(42,'N_0033','Dokumen obyek hibah (BPKB, Deposito, sertifikat saham, dsb)','2019-05-10 08:31:45.807237','Admin'),(43,'N_0034','Dokumen obyek wasiat (sertifikat tanah, BPKB, Deposito, Sertifikat saham, dsb)','2019-05-10 09:17:21.789182','Admin');
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (14,'0001','admin','Admin','dedy@notaris-jakarta.com','0887487772','Super Admin',NULL,'2019-04-05 09:30:21.093254','21232f297a57a5a743894a0e4a801fc3',NULL,'Aktif'),(20,'0002','wisnu','Wisnu Subroto N.A','yuniaryanto679@gmail.com','087877912311','User','Level 3','2019-04-02 01:43:38.764832','ea6b2efbdd4255a9f1b3bbc6399b58f4',NULL,'Aktif'),(21,'0003','dian','Siti Rizki Dianti','dian@notaris-jakarta.com','085289885222','User','Level 2','2019-04-01 02:39:45.400718','e1b1d45dcc900e3539ba69762603f963',NULL,'Aktif'),(22,'0004','prima','Prima Yuddy F Y','prima@notaris-jakarta.com','085263908704','User','Level 2','2019-04-01 02:39:26.162350','d8f49869c8583b77ddb82847f3f1955f',NULL,'Aktif'),(23,'0005','dini','Pratiwi S Dini','dini@notaris-jakarta.com','081273602067','User','Level 2','2019-04-01 02:39:10.277360','41a8e3d62e005f880e82ef061c571cc8',NULL,'Aktif'),(24,'0006','rifka','Rifka Ramadani','rifka@notaris-jakarta.com','087739397228','User','Level 2','2019-04-01 02:38:59.368236','92d4f526576c8ad74cbab94ebb239790',NULL,'Aktif'),(25,'0007','yus','Yus Suwandari','yus@notaris-jakarta.com','081280716583','User','Level 2','2019-05-10 08:21:25.606801','efb6e5a9e90a1126301802ee0b3f11b8','5cd5348593829.png','Aktif'),(26,'0008','esthi','Esthi Herlina','esthi@notaris-jakarta.com','081517697047','User','Level 2','2019-05-10 09:01:54.709720','debac5a803a64b50f4cf2211d921e589','5cd53e02ad02d.png','Aktif'),(27,'0009','ria','haryati Ardi','ria@notaris-jakarta.com','087871555505','User','Level 2','2019-04-01 02:37:53.534903','85edfaa624cbcf1cfd892d0d9336976e',NULL,'Aktif'),(29,'0010','indy','indarty','indy@notaris-jakarta.com','087876227696','User','Level 1','2019-04-30 07:58:46.952971','9fbefd6f3a1c3c29e341415e7d48c386',NULL,'Aktif'),(30,'0011','fitri','Fitri Senjayani','fitri@notaris-jakarta.com','08121923365','User','Level 2','2019-04-30 08:01:14.303720','1df83ea9876252776d4b1e53baebc926',NULL,'Aktif'),(31,'0012','fadzri','MK Fadzri Patriajaya','fadzri@notaris-jakarta.com','087788105424','User','Level 3','2019-04-05 07:32:34.997528','f46ef81f2464441ba58aeecbf654ee41',NULL,'Aktif'),(32,'0013','rohmad300','agus rohmad','agusrohmad300@gmail.com','081806446192','User','Level 1','2019-04-02 04:08:22.816289','18fe193144e4fb51d8679a9ce1818fd1',NULL,'Aktif');
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

-- Dump completed on 2019-05-10 16:24:44
