-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2020 at 05:41 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun_admin`
--

CREATE TABLE `akun_admin` (
  `username_admin` varchar(20) NOT NULL,
  `password_admin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun_admin`
--

INSERT INTO `akun_admin` (`username_admin`, `password_admin`) VALUES
('admin1', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `data_angsuran`
--

CREATE TABLE `data_angsuran` (
  `angsuran_ke` int(11) NOT NULL,
  `jumlah_angsuran` int(11) NOT NULL,
  `sisa_pinjaman` int(11) NOT NULL,
  `kode_pinjaman` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_angsuran`
--

INSERT INTO `data_angsuran` (`angsuran_ke`, `jumlah_angsuran`, `sisa_pinjaman`, `kode_pinjaman`) VALUES
(1, 1120000, 11000000, 1),
(2, 1120000, 10000000, 1),
(3, 1120000, 9000000, 1),
(4, 1120000, 8000000, 1),
(5, 1120000, 7000000, 1),
(6, 1120000, 6000000, 1),
(7, 1120000, 5000000, 1),
(8, 1120000, 4000000, 1),
(9, 1120000, 3000000, 1),
(10, 1120000, 2000000, 1),
(11, 1120000, 1000000, 1),
(12, 1120000, 0, 1),
(1, 466667, 4583333, 2),
(2, 466667, 4166667, 2),
(3, 466667, 3750000, 2),
(4, 466667, 3333333, 2),
(5, 466667, 2916667, 2),
(6, 466667, 2500000, 2),
(7, 466667, 2083333, 2),
(8, 466667, 1666667, 2),
(9, 466667, 1250000, 2),
(10, 466667, 833333, 2),
(11, 466667, 416667, 2),
(12, 466667, 0, 2),
(1, 1120000, 11000000, 3),
(1, 466667, 4583333, 4);

-- --------------------------------------------------------

--
-- Table structure for table `data_nasabah`
--

CREATE TABLE `data_nasabah` (
  `nomor_nasabah` char(9) NOT NULL,
  `nama_nasabah` varchar(30) NOT NULL,
  `nomor_ktp` char(16) NOT NULL,
  `foto_nasabah` varchar(30) NOT NULL,
  `nomor_handphone` char(12) NOT NULL,
  `jumlah_tabungan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_nasabah`
--

INSERT INTO `data_nasabah` (`nomor_nasabah`, `nama_nasabah`, `nomor_ktp`, `foto_nasabah`, `nomor_handphone`, `jumlah_tabungan`) VALUES
('137252607', 'DEWANTARA', '8765487689876543', 'wcx9m.jpg', '081220391796', 800000),
('754974790', 'IMANIAR SALSABILA', '9878987678765434', '9ntw8.jpg', '08996827350', 200000),
('863062676', 'ANDI FAUZY DEWANTARA', '1234567891234567', 'ypd7j.jpg', '085322677320', 150000);

-- --------------------------------------------------------

--
-- Table structure for table `data_pinjaman`
--

CREATE TABLE `data_pinjaman` (
  `kode_pinjaman` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `bunga_pinjaman` float NOT NULL,
  `besar_pinjaman` int(11) NOT NULL,
  `banyak_angsuran` int(11) NOT NULL,
  `nomor_nasabah` char(9) DEFAULT NULL,
  `status_pinjaman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pinjaman`
--

INSERT INTO `data_pinjaman` (`kode_pinjaman`, `tanggal_mulai`, `tanggal_berakhir`, `bunga_pinjaman`, `besar_pinjaman`, `banyak_angsuran`, `nomor_nasabah`, `status_pinjaman`) VALUES
(1, '2020-07-21', '2021-07-21', 12, 12000000, 12, '863062676', 1),
(2, '2020-07-21', '2021-07-21', 12, 5000000, 12, '137252607', 1),
(3, '2020-07-21', '2021-07-21', 12, 12000000, 12, '863062676', 0),
(4, '2020-07-21', '2021-07-21', 12, 5000000, 12, '754974790', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_tabungan`
--

CREATE TABLE `transaksi_tabungan` (
  `kode_transaksi` int(11) NOT NULL,
  `jenis_transaksi` int(11) NOT NULL,
  `besar_transaksi` int(11) NOT NULL,
  `sisa_saldo` int(11) NOT NULL,
  `tanggal_transaksi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nomor_nasabah` char(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_tabungan`
--

INSERT INTO `transaksi_tabungan` (`kode_transaksi`, `jenis_transaksi`, `besar_transaksi`, `sisa_saldo`, `tanggal_transaksi`, `nomor_nasabah`) VALUES
(1, 1, 100000, 100000, '2020-07-21 05:21:54', '863062676'),
(4, 1, 200000, 300000, '2020-07-21 05:28:08', '863062676'),
(6, 2, 150000, 150000, '2020-07-21 05:30:39', '863062676'),
(7, 1, 2000000, 2000000, '2020-07-21 08:18:38', '137252607'),
(8, 2, 1200000, 800000, '2020-07-21 08:18:46', '137252607'),
(9, 1, 500000, 500000, '2020-07-21 14:45:27', '754974790'),
(10, 2, 300000, 200000, '2020-07-21 14:46:22', '754974790');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_admin`
--
ALTER TABLE `akun_admin`
  ADD PRIMARY KEY (`username_admin`);

--
-- Indexes for table `data_angsuran`
--
ALTER TABLE `data_angsuran`
  ADD KEY `kode_pinjaman` (`kode_pinjaman`);

--
-- Indexes for table `data_nasabah`
--
ALTER TABLE `data_nasabah`
  ADD PRIMARY KEY (`nomor_nasabah`);

--
-- Indexes for table `data_pinjaman`
--
ALTER TABLE `data_pinjaman`
  ADD PRIMARY KEY (`kode_pinjaman`),
  ADD KEY `nomor_nasabah` (`nomor_nasabah`);

--
-- Indexes for table `transaksi_tabungan`
--
ALTER TABLE `transaksi_tabungan`
  ADD PRIMARY KEY (`kode_transaksi`),
  ADD KEY `nomor_nasabah` (`nomor_nasabah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_pinjaman`
--
ALTER TABLE `data_pinjaman`
  MODIFY `kode_pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi_tabungan`
--
ALTER TABLE `transaksi_tabungan`
  MODIFY `kode_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_angsuran`
--
ALTER TABLE `data_angsuran`
  ADD CONSTRAINT `data_angsuran_ibfk_1` FOREIGN KEY (`kode_pinjaman`) REFERENCES `data_pinjaman` (`kode_pinjaman`);

--
-- Constraints for table `data_pinjaman`
--
ALTER TABLE `data_pinjaman`
  ADD CONSTRAINT `data_pinjaman_ibfk_1` FOREIGN KEY (`nomor_nasabah`) REFERENCES `data_nasabah` (`nomor_nasabah`);

--
-- Constraints for table `transaksi_tabungan`
--
ALTER TABLE `transaksi_tabungan`
  ADD CONSTRAINT `transaksi_tabungan_ibfk_1` FOREIGN KEY (`nomor_nasabah`) REFERENCES `data_nasabah` (`nomor_nasabah`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
