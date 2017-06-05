-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2017 at 08:46 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_nota`
--
DROP DATABASE `db_nota`;
CREATE DATABASE IF NOT EXISTS `db_nota` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_nota`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brg`
--

DROP TABLE IF EXISTS `tbl_brg`;
CREATE TABLE `tbl_brg` (
  `kd_brg` varchar(6) NOT NULL,
  `nm_brg` varchar(50) NOT NULL,
  `harga` int(20) NOT NULL,
  `stok_brg` int(5) NOT NULL,
  `kd_satuan` varchar(5) NOT NULL,
  `ket_brg` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brg`
--

INSERT INTO `tbl_brg` (`kd_brg`, `nm_brg`, `harga`, `stok_brg`, `kd_satuan`, `ket_brg`) VALUES
('BL0001', 'PRINT HITAM', 500, 999, 'ST001', ''),
('BL0002', 'PRINT WARNA SEBAGIAN', 1000, 999, 'ST001', ''),
('BL0003', 'PRINT WARNA FULL', 2000, 999, 'ST001', ''),
('BL0004', 'FOTOCOPY A4', 175, 999, 'ST001', ''),
('BL0005', 'FOTOCOPY WARNA', 1000, 999, 'ST001', ''),
('BL0006', 'JILID BIASA', 3000, 999, 'ST004', ''),
('BL0007', 'JILID SAMBUNG', 5000, 999, 'ST004', ''),
('BL0008', 'JILID SKRIPSI', 25000, 999, 'ST004', ''),
('BL0009', 'SCAN', 500, 999, 'ST001', ''),
('BL0010', 'KERTAS A4S', 130000, 10, 'ST005', ''),
('BL0011', 'FOTOCOPY F4', 200, 999, 'ST001', ''),
('BL0012', 'NAME TAX', 5000, 999, 'ST003', ''),
('BL0013', 'AMPLOP AIR MAIL-E11', 1000, 999, 'ST003', ''),
('BL0014', 'FOLIO BERGARIS', 20000, 999, 'ST002', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan`
--

DROP TABLE IF EXISTS `tbl_penjualan`;
CREATE TABLE `tbl_penjualan` (
  `id_transaksi` int(3) NOT NULL,
  `kd_transaksi` varchar(10) NOT NULL,
  `tgl_transaksi` varchar(15) NOT NULL,
  `kd_brg` varchar(6) NOT NULL,
  `qty_brg` int(5) NOT NULL,
  `ket_transaksi` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penjualan`
--

INSERT INTO `tbl_penjualan` (`id_transaksi`, `kd_transaksi`, `tgl_transaksi`, `kd_brg`, `qty_brg`, `ket_transaksi`) VALUES
(1, 'TP0001', '26-04-2016', 'BL0001', 5, ''),
(2, 'TP0001', '26-04-2016', 'BL0002', 9, ''),
(3, 'TP0001', '26-04-2016', 'BL0004', 10, ''),
(4, 'TP0001', '26-04-2016', 'BL0003', 4, ''),
(5, 'TP0002', '26-04-2016', 'BL0001', 10, ''),
(6, 'TP0003', '26-04-2016', 'BL0002', 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan_detail`
--

DROP TABLE IF EXISTS `tbl_penjualan_detail`;
CREATE TABLE `tbl_penjualan_detail` (
  `id_kd_transaksi` int(11) NOT NULL,
  `kd_transaksi` varchar(150) NOT NULL,
  `kd_brg` varchar(6) NOT NULL,
  `nm_brg` varchar(150) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penjualan_detail`
--

INSERT INTO `tbl_penjualan_detail` (`id_kd_transaksi`, `kd_transaksi`, `kd_brg`, `nm_brg`, `harga`, `jumlah`, `status`) VALUES
(114, 'TP0001', 'BL0001', 'PRINT HITAM', '500', 5, 0),
(115, 'TP0001', 'BL0002', 'PRINT WARNA SEBAGIAN', '1000', 5, 0),
(116, 'TP0001', 'BL0003', 'PRINT WARNA FULL', '2000', 10, 0),
(117, 'TP0001', 'BL0004', 'FOTOCOPY A4', '175', 20, 0),
(118, 'TP0001', 'BL0005', 'FOTOCOPY WARNA', '1000', 25, 0),
(119, 'TP0001', 'BL0006', 'JILID BIASA', '3000', 3, 0),
(120, 'TP0001', 'BL0007', 'JILID SAMBUNG', '5000', 1, 0),
(121, 'TP0001', 'BL0008', 'JILID SKRIPSI', '25000', 5, 0),
(122, 'TP0001', 'BL0009', 'SCAN', '500', 10, 0),
(123, 'TP0001', 'BL0010', 'KERTAS A4S', '130000', 1, 0),
(124, 'TP0001', 'BL0011', 'FOTOCOPY F4', '200', 10, 0),
(125, 'TP0002', 'BL0002', 'PRINT WARNA SEBAGIAN', '1000', 1, 0),
(126, 'TP0003', 'BL0001', 'PRINT HITAM', '500', 11, 0),
(127, 'TP0003', 'BL0002', 'PRINT WARNA SEBAGIAN', '1000', 2, 0),
(128, 'TP0003', 'BL0003', 'PRINT WARNA FULL', '2000', 4, 0),
(129, 'TP0003', 'BL0004', 'FOTOCOPY A4', '175', 20, 0),
(130, 'TP0003', 'BL0005', 'FOTOCOPY WARNA', '1000', 10, 0),
(131, 'TP0003', 'BL0006', 'JILID BIASA', '3000', 2, 0),
(132, 'TP0003', 'BL0007', 'JILID SAMBUNG', '5000', 2, 0),
(133, 'TP0003', 'BL0008', 'JILID SKRIPSI', '25000', 2, 0),
(134, 'TP0003', 'BL0009', 'SCAN', '500', 10, 0),
(135, 'TP0003', 'BL0010', 'KERTAS A4S', '130000', 2, 0),
(136, 'TP0003', 'BL0011', 'FOTOCOPY F4', '200', 20, 0),
(137, 'TP0003', 'BL0012', 'NAME TAX', '5000', 3, 0),
(138, 'TP0003', 'BL0014', 'FOLIO BERGARIS', '20000', 5, 0),
(139, 'TP0003', 'BL0013', 'AMPLOP AIR MAIL-E11', '1000', 5, 0),
(140, 'TP0004', 'BL0001', 'PRINT HITAM', '500', 100, 0),
(141, 'TP0005', 'BL0001', 'PRINT HITAM', '500', 2, 0),
(142, 'TP0005', 'BL0004', 'FOTOCOPY A4', '175', 20, 0),
(143, 'TP0006', 'BL0001', 'PRINT HITAM', '500', 50, 0),
(144, 'TP0007', 'BL0001', 'PRINT HITAM', '500', 30, 1),
(145, 'TP0008', 'BL0002', 'PRINT WARNA SEBAGIAN', '1000', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan_header`
--

DROP TABLE IF EXISTS `tbl_penjualan_header`;
CREATE TABLE `tbl_penjualan_header` (
  `kd_transaksi` varchar(150) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `kd_pelanggan` varchar(15) NOT NULL,
  `total` varchar(150) NOT NULL,
  `bayar` varchar(150) NOT NULL,
  `status` int(1) NOT NULL,
  `ket_transaksi` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penjualan_header`
--

INSERT INTO `tbl_penjualan_header` (`kd_transaksi`, `tgl_transaksi`, `kd_pelanggan`, `total`, `bayar`, `status`, `ket_transaksi`) VALUES
('TP0001', '2017-05-10 13:27:02', '-', '332000', '350000', 1, '[LUNAS]-Uang kembalian 18000'),
('TP0002', '2017-05-10 13:25:27', '-', '1000', '2000', 1, '[LUNAS]-Uang kembalian 1000'),
('TP0003', '2017-05-10 13:25:27', '-', '484000', '500000', 1, '[LUNAS]-Uang kembalian 16000'),
('TP0004', '2017-05-10 13:27:20', '-', '50000', '100000', 1, '[LUNAS]-Uang kembalian 50000'),
('TP0005', '2017-05-10 13:33:56', '-', '4500', '5000', 1, 'Uang kembalian 500'),
('TP0006', '2017-05-10 13:33:51', '-', '25000', '30000', 1, 'Uang kembalian 5000'),
('TP0007', '2017-05-10 13:33:31', '-', '15000', '50000', 1, 'Uang kembalian 35000'),
('TP0008', '2017-05-10 13:34:22', '-', '5000', '2000', 0, 'Pembayaran Kurang 3000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_satuan`
--

DROP TABLE IF EXISTS `tbl_satuan`;
CREATE TABLE `tbl_satuan` (
  `kd_satuan` varchar(5) NOT NULL,
  `ket_satuan` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`kd_satuan`, `ket_satuan`) VALUES
('ST001', 'LBR'),
('ST002', 'PAK'),
('ST003', 'PCS'),
('ST004', 'JILID'),
('ST005', 'RIM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service`
--

DROP TABLE IF EXISTS `tbl_service`;
CREATE TABLE `tbl_service` (
  `kd_service` varchar(5) NOT NULL,
  `nm_service` varchar(35) NOT NULL,
  `harga_service` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_service`
--

INSERT INTO `tbl_service` (`kd_service`, `nm_service`, `harga_service`) VALUES
('SC001', 'INSTALL WINDOWS 10', 50000),
('SC002', 'INSTALL WINDOWS 7', 50000),
('SC003', 'INSTALL WINDOWS XP', 50000),
('SC004', 'SERVICE PRINTER', 50000),
('SC005', 'PASANG INFUS PRINTER', 150000),
('SC006', 'BATTREY AXIO NEON MNC', 750000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_detail`
--

DROP TABLE IF EXISTS `tbl_service_detail`;
CREATE TABLE `tbl_service_detail` (
  `id_kd_service` int(11) NOT NULL,
  `kd_trans_service` varchar(150) NOT NULL,
  `kd_service` varchar(6) NOT NULL,
  `nm_uraian` varchar(150) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_header`
--

DROP TABLE IF EXISTS `tbl_service_header`;
CREATE TABLE `tbl_service_header` (
  `kd_trans_service` varchar(150) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `kd_pelanggan` varchar(15) NOT NULL,
  `total` varchar(150) NOT NULL,
  `bayar` varchar(150) NOT NULL,
  `ket_transaksi` varchar(35) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

DROP TABLE IF EXISTS `tbl_setting`;
CREATE TABLE `tbl_setting` (
  `id` int(11) NOT NULL DEFAULT '1',
  `judul_app` varchar(35) NOT NULL,
  `alamat_app` text NOT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `hp` varchar(12) NOT NULL,
  `email` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id`, `judul_app`, `alamat_app`, `telp`, `hp`, `email`) VALUES
(1, 'Beliang Net', 'Jl. Beliang No. 976', '0536-3226637', '0811520892', 'beliangnet92@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_brg`
--
ALTER TABLE `tbl_brg`
  ADD PRIMARY KEY (`kd_brg`);

--
-- Indexes for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tbl_penjualan_detail`
--
ALTER TABLE `tbl_penjualan_detail`
  ADD PRIMARY KEY (`id_kd_transaksi`);

--
-- Indexes for table `tbl_penjualan_header`
--
ALTER TABLE `tbl_penjualan_header`
  ADD PRIMARY KEY (`kd_transaksi`);

--
-- Indexes for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  ADD PRIMARY KEY (`kd_satuan`);

--
-- Indexes for table `tbl_service_detail`
--
ALTER TABLE `tbl_service_detail`
  ADD PRIMARY KEY (`id_kd_service`);

--
-- Indexes for table `tbl_service_header`
--
ALTER TABLE `tbl_service_header`
  ADD PRIMARY KEY (`kd_trans_service`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `id_transaksi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_penjualan_detail`
--
ALTER TABLE `tbl_penjualan_detail`
  MODIFY `id_kd_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;
--
-- AUTO_INCREMENT for table `tbl_service_detail`
--
ALTER TABLE `tbl_service_detail`
  MODIFY `id_kd_service` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
