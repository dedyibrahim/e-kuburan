-- MySQL dump 10.13  Distrib 5.7.24, for Linux (i686)
--
-- Host: localhost    Database: notaris
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.16.04.1

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
  `id_berkas` varchar(255) NOT NULL,
  `no_berkas` varchar(255) NOT NULL,
  `status_berkas` varchar(255) NOT NULL,
  `tanggal_dibuat` varchar(255) NOT NULL,
  `tanggal_selesai` varchar(255) DEFAULT NULL,
  `folder_berkas` varchar(255) NOT NULL,
  `no_user` varchar(255) NOT NULL,
  `jenis_client` varchar(255) NOT NULL,
  `jenis_perizinan` varchar(255) NOT NULL,
  `id_jenis` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  PRIMARY KEY (`id_data_berkas`),
  KEY `no_berkas` (`no_berkas`),
  KEY `id_jenis` (`id_jenis`),
  CONSTRAINT `data_berkas_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `data_jenis_dokumen` (`no_jenis_dokumen`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_berkas`
--

LOCK TABLES `data_berkas` WRITE;
/*!40000 ALTER TABLE `data_berkas` DISABLE KEYS */;
INSERT INTO `data_berkas` VALUES (4,'','20190303/0001/00000000','Proses','03/03/2019',NULL,'00000000','0001','Badan Hukum','Akta Peralihan Hak Pembagian Hak','J_0008','PT BAL','asd'),(5,'','20190303/0001/00000001','Proses','03/03/2019',NULL,'00000001','0001','Badan Hukum','Akta Peralihan Hak Pembagian Hak','J_0008','PT BAL','asd'),(6,'','20190303/0001/00000002','Proses','03/03/2019',NULL,'00000002','0001','Badan Hukum','Akta Peralihan Hak Pembagian Hak','J_0008','PT BAL','asd'),(7,'','20190303/0001/00000003','Proses','03/03/2019',NULL,'00000003','0001','Badan Hukum','Akta Peralihan Hak Pembagian Hak','J_0008','PT BAL','asd'),(8,'','20190303/0001/00000004','Proses','03/03/2019',NULL,'00000004','0001','Badan Hukum','Akta Peralihan Hak Pembagian Hak','J_0008','PT BAL','asd'),(9,'','20190303/0001/00000005','Proses','03/03/2019',NULL,'00000005','0001','Badan Hukum','Akta Peralihan Hak Pembagian Hak','J_0008','PT BAL','asd'),(10,'','20190303/0001/00000006','Proses','03/03/2019',NULL,'00000006','0001','Badan Hukum','Akta Peralihan Hak Pembagian Hak','J_0008','PT BAL','asd'),(11,'','20190303/0001/00000007','Proses','03/03/2019',NULL,'00000007','0001','Badan Hukum','Akta Peralihan Hak Pembagian Hak','J_0008','PT BAL','asd'),(12,'','20190303/0001/00000008','Proses','03/03/2019',NULL,'00000008','0001','Badan Hukum','Akta Peralihan Hak Pembagian Hak','J_0008','PT BAL','asd'),(13,'','20190303/0001/00000009','Proses','03/03/2019',NULL,'00000009','0001','Badan Hukum','Akta Peralihan Hak Pembagian Hak','J_0008','PT BAL','asd'),(14,'','20190303/0001/00000010','Proses','03/03/2019',NULL,'00000010','0001','Badan Hukum','Akta Peralihan Hak Pembagian Hak','J_0008','PT BAL','asd'),(15,'','20190303/0001/00000011','Proses','03/03/2019',NULL,'00000011','0001','Badan Hukum','Akta Peralihan Hak Pembagian Hak','J_0008','PT BAL','asd'),(16,'','20190303/0001/00000012','Proses','03/03/2019',NULL,'00000012','0001','Badan Hukum','Akta Peralihan Hak Pembagian Hak','J_0008','PT BAL','asd'),(17,'','20190303/0001/00000013','Proses','03/03/2019',NULL,'00000013','0001','Perorangan','Perjanjian Hutang','J_0004','PT BAL','asdasd'),(18,'','20190303/0001/00000014','Proses','03/03/2019',NULL,'00000014','0001','Badan Hukum','Akta Pendirian Firma','J_0003','PT BAL','Kp.Sumurwangi Kel.Lebak Bulus'),(19,'','20190303/0001/00000015','Proses','03/03/2019',NULL,'00000015','0001','Perorangan','Akta Peralihan Hak Hibah','J_0006','PT BAL','Kp.Sumurwangi Kel.kayumanis Kec.Tanah sareal KOta Bogor'),(20,'','20190303/0001/00000016','Proses','03/03/2019',NULL,'00000016','0001','Perorangan','Akta Peralihan Hak Jual Beli','J_0005','JAMALUDIN','KP.SUmurwangi Kel.kayumanis Bogor'),(21,'20190303/0001/00000017','00000017','Proses','03/03/2019',NULL,'00000017','0001','Badan Hukum','Akta Peralihan Hak Jual Beli','J_0005','JAMALUDIN','KP.SUmurwangi Kel.kayumanis Bogor'),(22,'20190303/0001/00000018','00000018','Proses','03/03/2019',NULL,'00000018','0001','Perorangan','Akta Peralihan Hak Jual Beli','J_0005','JAMALUDIN','KP.SUmurwangi Kel.kayumanis Bogor'),(23,'20190303/0001/00000019','00000019','Proses','03/03/2019',NULL,'00000019','0001','Badan Hukum','Perjanjian Hutang','J_0004','bogot','asd'),(24,'20190303/0001/00000020','00000020','Proses','03/03/2019',NULL,'00000020','0001','Badan Hukum','Perjanjian Hutang','J_0004','bogot','asd'),(25,'20190303/0001/00000021','00000021','Proses','03/03/2019',NULL,'00000021','0001','Badan Hukum','Perjanjian Hutang','J_0004','bogot','asd');
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
  `tanggal_daftar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_data_client`),
  KEY `no_client` (`no_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_client`
--

LOCK TABLES `data_client` WRITE;
/*!40000 ALTER TABLE `data_client` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_client` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_jenis_dokumen`
--

LOCK TABLES `data_jenis_dokumen` WRITE;
/*!40000 ALTER TABLE `data_jenis_dokumen` DISABLE KEYS */;
INSERT INTO `data_jenis_dokumen` VALUES (19,'J_0001','NOTARIS','Akta pendirian PT (Perseroan Terbatas)','2019-02-26 07:28:02.515110','Dedy Ibrahim'),(20,'J_0002','NOTARIS','Akta pendirian CV','2019-02-26 09:23:23.668040','Dedy Ibrahim'),(21,'J_0003','NOTARIS','Akta Pendirian Firma','2019-02-26 09:23:42.930930','Dedy Ibrahim'),(22,'J_0004','NOTARIS','Perjanjian Hutang','2019-02-27 01:43:26.810944','Dedy Ibrahim'),(23,'J_0005','PPAT','Akta Peralihan Hak Jual Beli','2019-02-27 01:43:56.315881','Dedy Ibrahim'),(24,'J_0006','PPAT','Akta Peralihan Hak Hibah','2019-02-27 06:49:57.007134','Dedy Ibrahim'),(25,'J_0007','PPAT','Akta Peralihan Hak Tukar Menukar','2019-02-27 06:50:33.959891','Dedy Ibrahim'),(26,'J_0008','NOTARIS','Akta Peralihan Hak Pembagian Hak','2019-02-27 07:08:16.622642','Dedy Ibrahim');
/*!40000 ALTER TABLE `data_jenis_dokumen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_perorangan`
--

DROP TABLE IF EXISTS `data_perorangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_perorangan` (
  `id_perorangan` int(11) NOT NULL AUTO_INCREMENT,
  `no_berkas_perorangan` varchar(255) NOT NULL,
  `nama_identitas` varchar(255) NOT NULL,
  `no_identitas` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `jenis_identitas` varchar(255) NOT NULL,
  `lampiran_perorangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_perorangan`),
  KEY `no_berkas_perorangan` (`no_berkas_perorangan`),
  CONSTRAINT `data_perorangan_ibfk_1` FOREIGN KEY (`no_berkas_perorangan`) REFERENCES `data_berkas` (`no_berkas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_perorangan`
--

LOCK TABLES `data_perorangan` WRITE;
/*!40000 ALTER TABLE `data_perorangan` DISABLE KEYS */;
INSERT INTO `data_perorangan` VALUES (5,'20190303/0001/00000000','Dedy Ibrahim','327106230198','Komisaris Utama','KTP',NULL),(6,'20190303/0001/00000001','Dedy Ibrahim','327106230198','Komisaris Utama','KTP',NULL),(7,'20190303/0001/00000002','Dedy Ibrahim','327106230198','Komisaris Utama','KTP',NULL),(8,'20190303/0001/00000003','Dedy Ibrahim','327106230198','Komisaris Utama','KTP',NULL),(9,'20190303/0001/00000004','Dedy Ibrahim','327106230198','Komisaris Utama','KTP',NULL),(10,'20190303/0001/00000005','Dedy Ibrahim','327106230198','Komisaris Utama','KTP',NULL),(11,'20190303/0001/00000006','Dedy Ibrahim','327106230198','Komisaris Utama','KTP',NULL),(12,'20190303/0001/00000007','Dedy Ibrahim','327106230198','Komisaris Utama','KTP',NULL),(13,'20190303/0001/00000008','Dedy Ibrahim','327106230198','Komisaris Utama','KTP',NULL),(14,'20190303/0001/00000009','Dedy Ibrahim','327106230198','Komisaris Utama','KTP',NULL),(15,'20190303/0001/00000010','Dedy Ibrahim','327106230198','Komisaris Utama','KTP',NULL),(16,'20190303/0001/00000011','Dedy Ibrahim','327106230198','Komisaris Utama','KTP',NULL),(17,'20190303/0001/00000012','Dedy Ibrahim','327106230198','Komisaris Utama','KTP',NULL),(18,'20190303/0001/00000013','Dedy Ibrahim','327106230198','Presiden Direktur','KTP',NULL),(19,'20190303/0001/00000014','asd','asd','Presiden Komisaris','KTP',NULL),(20,'20190303/0001/00000015','Dedy Ibrahim','327106230198','Presiden Komisaris','KTP',NULL),(21,'20190303/0001/00000016','Dedy Ibrahim','327106230198','Komisaris ','PASSPOR ',NULL),(22,'00000017','Dedy Ibrahim','327106230198','Komisaris ','PASSPOR ',NULL),(23,'00000018','Dedy Ibrahim','327106230198','Komisaris ','PASSPOR ',NULL),(24,'00000019','asd','asd','Komisaris ','KTP',NULL),(25,'00000020','asd','asd','Komisaris ','KTP',NULL),(26,'00000021','asd','asd','Komisaris ','KTP',NULL);
/*!40000 ALTER TABLE `data_perorangan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_syarat_jenis_dokumen`
--

DROP TABLE IF EXISTS `data_syarat_jenis_dokumen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_syarat_jenis_dokumen` (
  `id_syarat_dokumen` int(11) NOT NULL AUTO_INCREMENT,
  `no_jenis_dokumen` varchar(255) NOT NULL,
  `no_nama_dokumen` varchar(255) NOT NULL,
  `nama_syarat` varchar(255) NOT NULL,
  `status_syarat` varchar(255) NOT NULL,
  `tanggal_dibuat` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `pembuat_syarat` varchar(255) NOT NULL,
  PRIMARY KEY (`id_syarat_dokumen`),
  KEY `no_syarat_dokumen` (`no_jenis_dokumen`),
  KEY `no_nama_dokumen` (`no_nama_dokumen`),
  CONSTRAINT `data_syarat_jenis_dokumen_ibfk_1` FOREIGN KEY (`no_jenis_dokumen`) REFERENCES `data_jenis_dokumen` (`no_jenis_dokumen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `data_syarat_jenis_dokumen_ibfk_2` FOREIGN KEY (`no_nama_dokumen`) REFERENCES `nama_dokumen` (`no_nama_dokumen`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_syarat_jenis_dokumen`
--

LOCK TABLES `data_syarat_jenis_dokumen` WRITE;
/*!40000 ALTER TABLE `data_syarat_jenis_dokumen` DISABLE KEYS */;
INSERT INTO `data_syarat_jenis_dokumen` VALUES (43,'J_0005','N_0002','KK (Kartu Keluarga)','undefined','2019-02-27 07:13:56.710589','Dedy Ibrahim'),(44,'J_0008','N_0002','KK (Kartu Keluarga)','wajib','2019-02-27 07:25:03.056056','Dedy Ibrahim'),(45,'J_0008','N_0001','Akta nikah','wajib','2019-02-27 07:56:34.153895','Dedy Ibrahim'),(46,'J_0008','N_0004','NPWP (Nomor pokok wajib pajak)','wajib','2019-02-27 07:56:34.270698','Dedy Ibrahim'),(47,'J_0008','N_0002','KK (Kartu Keluarga)','wajib','2019-02-27 07:56:34.495391','Dedy Ibrahim'),(48,'J_0008','N_0006','Akta perubahan','wajib','2019-02-27 07:56:34.536271','Dedy Ibrahim'),(49,'J_0008','N_0005','Akta pendirian','wajib','2019-02-27 07:56:34.576968','Dedy Ibrahim'),(50,'J_0008','N_0003','KTP (Kartu tanda penduduk)','wajib','2019-02-27 07:56:34.668862','Dedy Ibrahim'),(51,'J_0008','N_0007','SK Kehakiman','wajib','2019-02-27 07:56:34.710041','Dedy Ibrahim'),(52,'J_0008','N_0008','SIUP','wajib','2019-02-27 07:56:34.761470','Dedy Ibrahim'),(53,'J_0008','N_0011','Voucher Bayar','wajib','2019-02-27 07:56:34.802068','Dedy Ibrahim'),(54,'J_0008','N_0009','TDP','wajib','2019-02-27 07:56:34.842758','Dedy Ibrahim'),(55,'J_0008','N_0010','DOMISILI','wajib','2019-02-27 07:56:34.924660','Dedy Ibrahim');
/*!40000 ALTER TABLE `data_syarat_jenis_dokumen` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nama_dokumen`
--

LOCK TABLES `nama_dokumen` WRITE;
/*!40000 ALTER TABLE `nama_dokumen` DISABLE KEYS */;
INSERT INTO `nama_dokumen` VALUES (8,'N_0001','Akta nikah','2019-02-26 06:49:17.097335','Dedy Ibrahim'),(9,'N_0002','KK (Kartu Keluarga)','2019-02-26 06:49:37.945339','Dedy Ibrahim'),(10,'N_0003','KTP (Kartu tanda penduduk)','2019-02-26 06:50:30.829062','Dedy Ibrahim'),(11,'N_0004','NPWP (Nomor pokok wajib pajak)','2019-02-26 06:51:09.563744','Dedy Ibrahim'),(12,'N_0005','Akta pendirian','2019-02-26 06:51:31.757534','Dedy Ibrahim'),(13,'N_0006','Akta perubahan','2019-02-26 06:51:46.010922','Dedy Ibrahim'),(14,'N_0007','SK Kehakiman','2019-02-26 06:52:10.422947','Dedy Ibrahim'),(15,'N_0008','SIUP','2019-02-26 06:52:28.971613','Dedy Ibrahim'),(16,'N_0009','TDP','2019-02-26 06:52:39.695265','Dedy Ibrahim'),(17,'N_0010','DOMISILI','2019-02-26 06:52:50.917544','Dedy Ibrahim'),(18,'N_0011','Voucher Bayar','2019-02-26 09:47:49.029433','Dedy Ibrahim');
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
  `tanggal_daftar` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `no_user` (`no_user`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (14,'0001','Dedi','Dedy Ibrahim','dedyibrahym23@gmail.com','0887487772','Admin','2019-02-27 06:36:37.309694','21232f297a57a5a743894a0e4a801fc3',NULL,'Aktif'),(15,'0002','zaenudin','zaenudin al bughuri','sajarudin','082381109774','Admin','2019-02-27 06:36:18.564278','7815696ecbf1c96e6894b779456d330e',NULL,'Aktif'),(16,'0003','Fajri','Fajri Ja','fajri@gmail.com','081873772','Admin','2019-02-27 06:35:46.434698','21232f297a57a5a743894a0e4a801fc3',NULL,'Aktif'),(17,'0004','Wisnu','nugroho','wisnu@gmail.com','081289903664','Admin','2019-02-27 06:12:13.449046','21232f297a57a5a743894a0e4a801fc3',NULL,'Aktif');
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

-- Dump completed on 2019-03-04  9:18:26
