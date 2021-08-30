-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table db_ads_gudang.tbl_barang
CREATE TABLE IF NOT EXISTS `tbl_barang` (
  `barang_kode` varchar(20) NOT NULL,
  `barang_nama` text NOT NULL,
  `barang_satuan` int(2) NOT NULL DEFAULT '0',
  `barang_harga_satuan` int(11) NOT NULL,
  `barang_jumlah` int(11) NOT NULL,
  `h_pengguna` varchar(20) NOT NULL,
  `h_tanggal` date NOT NULL,
  `h_waktu` time NOT NULL,
  `h_ip` varchar(50) NOT NULL,
  PRIMARY KEY (`barang_kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_ads_gudang.tbl_barang: ~0 rows (approximately)
DELETE FROM `tbl_barang`;
/*!40000 ALTER TABLE `tbl_barang` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_barang` ENABLE KEYS */;

-- Dumping structure for table db_ads_gudang.tbl_barang_keluar
CREATE TABLE IF NOT EXISTS `tbl_barang_keluar` (
  `keluar_id` int(11) NOT NULL AUTO_INCREMENT,
  `keluar_invoice` varchar(50) NOT NULL,
  `barang_kode` varchar(20) NOT NULL,
  `keluar_jumlah` int(11) NOT NULL,
  `keluar_harga` int(11) NOT NULL,
  `keluar_tgl` date NOT NULL,
  `h_pengguna` varchar(20) NOT NULL,
  `h_tanggal` date NOT NULL,
  `h_waktu` time NOT NULL,
  `h_ip` varchar(50) NOT NULL,
  PRIMARY KEY (`keluar_id`,`keluar_invoice`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_ads_gudang.tbl_barang_keluar: ~0 rows (approximately)
DELETE FROM `tbl_barang_keluar`;
/*!40000 ALTER TABLE `tbl_barang_keluar` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_barang_keluar` ENABLE KEYS */;

-- Dumping structure for table db_ads_gudang.tbl_barang_masuk
CREATE TABLE IF NOT EXISTS `tbl_barang_masuk` (
  `masuk_id` int(11) NOT NULL AUTO_INCREMENT,
  `masuk_invoice` varchar(100) NOT NULL,
  `masuk_tgl` date NOT NULL,
  `barang_kode` varchar(20) NOT NULL,
  `masuk_jumlah` int(11) NOT NULL,
  `masuk_kurir` varchar(50) NOT NULL,
  `masuk_distributor` varchar(100) NOT NULL,
  `h_pengguna` varchar(20) NOT NULL,
  `h_tanggal` date NOT NULL,
  `h_waktu` time NOT NULL,
  `h_ip` varchar(50) NOT NULL,
  PRIMARY KEY (`masuk_id`,`masuk_invoice`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_ads_gudang.tbl_barang_masuk: ~0 rows (approximately)
DELETE FROM `tbl_barang_masuk`;
/*!40000 ALTER TABLE `tbl_barang_masuk` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_barang_masuk` ENABLE KEYS */;

-- Dumping structure for table db_ads_gudang.tbl_bon_kredit
CREATE TABLE IF NOT EXISTS `tbl_bon_kredit` (
  `bon_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_invoice` varchar(50) NOT NULL,
  `bon_urut` varchar(3) NOT NULL,
  `bon_total` int(12) NOT NULL,
  `bon_dibayar` int(12) NOT NULL,
  `bon_tgl` date NOT NULL,
  `h_pengguna` varchar(20) NOT NULL,
  `h_tanggal` date NOT NULL,
  `h_waktu` time NOT NULL,
  `h_ip` varchar(50) NOT NULL,
  PRIMARY KEY (`bon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_ads_gudang.tbl_bon_kredit: ~0 rows (approximately)
DELETE FROM `tbl_bon_kredit`;
/*!40000 ALTER TABLE `tbl_bon_kredit` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_bon_kredit` ENABLE KEYS */;

-- Dumping structure for table db_ads_gudang.tbl_invoice
CREATE TABLE IF NOT EXISTS `tbl_invoice` (
  `invoice_kode` varchar(50) NOT NULL,
  `invoice_salless` int(2) NOT NULL,
  `invoice_toko` int(2) NOT NULL,
  `invoice_total_harga` int(12) NOT NULL,
  `invoice_tgl` date NOT NULL,
  `invoice_status` int(1) NOT NULL,
  `h_pengguna` varchar(20) NOT NULL,
  `h_tanggal` date NOT NULL,
  `h_waktu` time NOT NULL,
  `h_ip` varchar(50) NOT NULL,
  PRIMARY KEY (`invoice_kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_ads_gudang.tbl_invoice: ~0 rows (approximately)
DELETE FROM `tbl_invoice`;
/*!40000 ALTER TABLE `tbl_invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_invoice` ENABLE KEYS */;

-- Dumping structure for table db_ads_gudang.tbl_salless
CREATE TABLE IF NOT EXISTS `tbl_salless` (
  `salless_id` int(11) NOT NULL AUTO_INCREMENT,
  `salless_nama` varchar(100) NOT NULL,
  `salless_alamat` text NOT NULL,
  `salles_no_hp` varchar(14) NOT NULL,
  `h_pengguna` varchar(20) NOT NULL,
  `h_tanggal` date NOT NULL,
  `h_waktu` time NOT NULL,
  `h_ip` varchar(50) NOT NULL,
  PRIMARY KEY (`salless_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_ads_gudang.tbl_salless: ~2 rows (approximately)
DELETE FROM `tbl_salless`;
/*!40000 ALTER TABLE `tbl_salless` DISABLE KEYS */;
INSERT INTO `tbl_salless` (`salless_id`, `salless_nama`, `salless_alamat`, `salles_no_hp`, `h_pengguna`, `h_tanggal`, `h_waktu`, `h_ip`) VALUES
	(1, 'Umar Khalil', 'Jl. Bontang Komplek Arun', '082165401626', '', '0000-00-00', '00:00:00', ''),
	(2, 'Helmi Naluri', 'Takengon', '082165401626', '', '0000-00-00', '00:00:00', '');
/*!40000 ALTER TABLE `tbl_salless` ENABLE KEYS */;

-- Dumping structure for table db_ads_gudang.tbl_satuan
CREATE TABLE IF NOT EXISTS `tbl_satuan` (
  `satuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `satuan_nama` varchar(15) NOT NULL,
  `h_pengguna` varchar(20) NOT NULL,
  `h_tanggal` date NOT NULL,
  `h_waktu` time NOT NULL,
  `h_ip` varchar(50) NOT NULL,
  PRIMARY KEY (`satuan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_ads_gudang.tbl_satuan: ~1 rows (approximately)
DELETE FROM `tbl_satuan`;
/*!40000 ALTER TABLE `tbl_satuan` DISABLE KEYS */;
INSERT INTO `tbl_satuan` (`satuan_id`, `satuan_nama`, `h_pengguna`, `h_tanggal`, `h_waktu`, `h_ip`) VALUES
	(1, 'dus', 'admin', '2021-03-11', '12:23:42', '::1');
/*!40000 ALTER TABLE `tbl_satuan` ENABLE KEYS */;

-- Dumping structure for table db_ads_gudang.tbl_temp_barang
CREATE TABLE IF NOT EXISTS `tbl_temp_barang` (
  `temp_id` int(11) NOT NULL AUTO_INCREMENT,
  `temp_kode` varchar(20) NOT NULL,
  `temp_jumlah` int(11) NOT NULL,
  `temp_status` varchar(1) NOT NULL,
  `h_pengguna` varchar(20) NOT NULL,
  `h_tanggal` date NOT NULL,
  `h_waktu` time NOT NULL,
  `h_ip` varchar(50) NOT NULL,
  PRIMARY KEY (`temp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_ads_gudang.tbl_temp_barang: ~0 rows (approximately)
DELETE FROM `tbl_temp_barang`;
/*!40000 ALTER TABLE `tbl_temp_barang` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_temp_barang` ENABLE KEYS */;

-- Dumping structure for table db_ads_gudang.tbl_toko
CREATE TABLE IF NOT EXISTS `tbl_toko` (
  `toko_id` int(11) NOT NULL AUTO_INCREMENT,
  `toko_nama` varchar(100) NOT NULL,
  `toko_alamat` text NOT NULL,
  `toko_no_hp` varchar(14) NOT NULL,
  `h_pengguna` varchar(20) NOT NULL,
  `h_tanggal` date NOT NULL,
  `h_waktu` time NOT NULL,
  `h_ip` varchar(50) NOT NULL,
  PRIMARY KEY (`toko_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_ads_gudang.tbl_toko: ~1 rows (approximately)
DELETE FROM `tbl_toko`;
/*!40000 ALTER TABLE `tbl_toko` DISABLE KEYS */;
INSERT INTO `tbl_toko` (`toko_id`, `toko_nama`, `toko_alamat`, `toko_no_hp`, `h_pengguna`, `h_tanggal`, `h_waktu`, `h_ip`) VALUES
	(1, 'Arifa Mart', 'Jl Blang Pulo ', '082165401626', '', '0000-00-00', '00:00:00', '');
/*!40000 ALTER TABLE `tbl_toko` ENABLE KEYS */;

-- Dumping structure for table db_ads_gudang.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(225) NOT NULL,
  `user_email` varchar(225) NOT NULL,
  `user_login` varchar(225) NOT NULL,
  `user_pass` varchar(225) NOT NULL,
  `user_level` int(11) NOT NULL,
  `user_status` varchar(20) NOT NULL,
  `h_pengguna` varchar(100) NOT NULL,
  `h_tanggal` date NOT NULL,
  `h_waktu` time NOT NULL,
  `h_lokasi` varchar(250) NOT NULL,
  `h_ip` varchar(250) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_ads_gudang.tbl_users: ~0 rows (approximately)
DELETE FROM `tbl_users`;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` (`user_id`, `user_name`, `user_email`, `user_login`, `user_pass`, `user_level`, `user_status`, `h_pengguna`, `h_tanggal`, `h_waktu`, `h_lokasi`, `h_ip`) VALUES
	(1, 'admin', 'admin@gmail.com', 'admin', '2b5e148f18eb011f5863b6b171a66a41', 99, 'Aktif', '', '0000-00-00', '00:00:00', '', '');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
