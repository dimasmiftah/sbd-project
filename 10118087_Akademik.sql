-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2020 at 03:33 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `universitas`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `NIP` char(12) NOT NULL,
  `NamaDosen` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`NIP`, `NamaDosen`) VALUES
('123455678906', 'Alif Finandhita'),
('234432323424', 'Dian Dharmayanti');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NIM` char(8) NOT NULL,
  `NamaMahasiswa` varchar(30) NOT NULL,
  `TanggalLahir` date NOT NULL,
  `Alamat` varchar(255) NOT NULL,
  `JenisKelamin` enum('Laki-laki','Perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`NIM`, `NamaMahasiswa`, `TanggalLahir`, `Alamat`, `JenisKelamin`) VALUES
('10112093', 'Dion Samudra', '2000-03-31', 'Bandung', 'Laki-laki'),
('10118087', 'Dimas Miftahul Huda', '2000-03-01', 'Jalan Malaka IV No. 42, Rorotan, Cilincing, Jakarta Utara', 'Laki-laki'),
('10118088', 'Anggi Juliana', '2000-04-04', 'Kota Bogor', 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `KodeMK` varchar(6) NOT NULL,
  `NamaMK` varchar(50) NOT NULL,
  `SKS` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`KodeMK`, `NamaMK`, `SKS`) VALUES
('IF2018', 'Sistem Basis Data', 4),
('MATDAS', 'Matematika Dasar 1', 4);

-- --------------------------------------------------------

--
-- Table structure for table `perkuliahan`
--

CREATE TABLE `perkuliahan` (
  `NIM` char(8) NOT NULL,
  `KodeMK` varchar(6) NOT NULL,
  `NIP` char(12) DEFAULT NULL,
  `Nilai` char(1) NOT NULL,
  `id_user` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `perkuliahan`
--

INSERT INTO `perkuliahan` (`NIM`, `KodeMK`, `NIP`, `Nilai`, `id_user`) VALUES
('10118087', 'IF2018', '234432323424', 'A', 'USER-001'),
('10118088', 'IF2018', '123455678906', 'B', 'USER-001');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(10) CHARACTER SET utf8 NOT NULL,
  `username` varchar(15) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `nama` varchar(30) CHARACTER SET utf8 NOT NULL,
  `role` enum('Admin','Petugas','','') CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `role`) VALUES
('USER-000', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Dimas Miftahul Huda', 'Admin'),
('USER-001', 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'Sasi Kirana Oktaviani', 'Petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`NIP`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NIM`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`KodeMK`);

--
-- Indexes for table `perkuliahan`
--
ALTER TABLE `perkuliahan`
  ADD PRIMARY KEY (`NIM`,`KodeMK`),
  ADD KEY `NIP` (`NIP`),
  ADD KEY `NIM` (`NIM`),
  ADD KEY `KodeMK` (`KodeMK`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `perkuliahan`
--
ALTER TABLE `perkuliahan`
  ADD CONSTRAINT `perkuliahan_ibfk_1` FOREIGN KEY (`NIP`) REFERENCES `dosen` (`NIP`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `perkuliahan_ibfk_2` FOREIGN KEY (`NIM`) REFERENCES `mahasiswa` (`NIM`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `perkuliahan_ibfk_3` FOREIGN KEY (`KodeMK`) REFERENCES `matakuliah` (`KodeMK`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
