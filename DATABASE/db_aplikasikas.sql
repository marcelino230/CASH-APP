-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2021 at 12:20 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_aplikasikas`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses_user`
--

CREATE TABLE `akses_user` (
  `id_akses` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses_user`
--

INSERT INTO `akses_user` (`id_akses`, `nama`, `ket`) VALUES
(1, 'admin', 'Administrator'),
(2, 'pengguna', 'Pengguna');

-- --------------------------------------------------------

--
-- Table structure for table `tbljeniskas`
--

CREATE TABLE `tbljeniskas` (
  `id_jeniskas` int(11) NOT NULL,
  `namajeniskas` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbljeniskas`
--

INSERT INTO `tbljeniskas` (`id_jeniskas`, `namajeniskas`) VALUES
(1, 'Kas Masuk'),
(2, 'Kas Keluar');

-- --------------------------------------------------------

--
-- Table structure for table `tblkaskeluar`
--

CREATE TABLE `tblkaskeluar` (
  `id_kaskeluar` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblkaskeluar`
--

INSERT INTO `tblkaskeluar` (`id_kaskeluar`, `nama`) VALUES
(3, 'Belanja');

-- --------------------------------------------------------

--
-- Table structure for table `tblkasmasuk`
--

CREATE TABLE `tblkasmasuk` (
  `id_kasmasuk` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblkasmasuk`
--

INSERT INTO `tblkasmasuk` (`id_kasmasuk`, `nama`) VALUES
(3, 'Gaji');

-- --------------------------------------------------------

--
-- Table structure for table `tbltransaksi`
--

CREATE TABLE `tbltransaksi` (
  `kd_transaksi` varchar(30) NOT NULL,
  `tgl` date NOT NULL,
  `id_jeniskas` int(11) NOT NULL,
  `id_kasmasuk` int(11) DEFAULT NULL,
  `id_kaskeluar` int(11) DEFAULT NULL,
  `ket` text NOT NULL,
  `nominal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltransaksi`
--

INSERT INTO `tbltransaksi` (`kd_transaksi`, `tgl`, `id_jeniskas`, `id_kasmasuk`, `id_kaskeluar`, `ket`, `nominal`) VALUES
('TRS23012100001', '2021-01-23', 1, 3, 0, 'Gaji Bulan Januari', 5000000),
('TRS23012100002', '2021-01-23', 2, 0, 3, 'Belanja Bulanan', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` varchar(5) NOT NULL,
  `id_akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `username`, `password`, `status`, `id_akses`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Y', 1),
(2, 'marcelino', '83e6d6872a758dc3b655706c2803a215', 'Y', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses_user`
--
ALTER TABLE `akses_user`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `tbljeniskas`
--
ALTER TABLE `tbljeniskas`
  ADD PRIMARY KEY (`id_jeniskas`);

--
-- Indexes for table `tblkaskeluar`
--
ALTER TABLE `tblkaskeluar`
  ADD PRIMARY KEY (`id_kaskeluar`);

--
-- Indexes for table `tblkasmasuk`
--
ALTER TABLE `tblkasmasuk`
  ADD PRIMARY KEY (`id_kasmasuk`);

--
-- Indexes for table `tbltransaksi`
--
ALTER TABLE `tbltransaksi`
  ADD PRIMARY KEY (`kd_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses_user`
--
ALTER TABLE `akses_user`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbljeniskas`
--
ALTER TABLE `tbljeniskas`
  MODIFY `id_jeniskas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblkaskeluar`
--
ALTER TABLE `tblkaskeluar`
  MODIFY `id_kaskeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblkasmasuk`
--
ALTER TABLE `tblkasmasuk`
  MODIFY `id_kasmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
