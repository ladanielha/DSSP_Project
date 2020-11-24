-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 10:17 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Pria','Wanita') NOT NULL,
  `birth_date` date NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`first_name`, `last_name`, `gender`, `birth_date`, `username`, `password`) VALUES
('Wijayanto', 'Gunawan', 'Pria', '1970-11-13', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nip` varchar(18) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` enum('Pria','Wanita') NOT NULL,
  `birth_date` date NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `first_name`, `last_name`, `gender`, `birth_date`, `username`, `password`) VALUES
('197205252001032201', 'Linda', 'Rumawangun', 'Wanita', '1972-05-25', 'linda.rawamangun', '77e69c137812518e359196bb2f5e9bb9');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` varchar(6) NOT NULL,
  `name` varchar(10) NOT NULL,
  `tahun_ajaran` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `name`, `tahun_ajaran`) VALUES
('KS0001', '9A', 2017),
('KS0002', '9B', 2017),
('KS0003', '8A', 2018),
('KS0004', '8B', 2018),
('KS0005', '7A', 2019),
('KS0006', '7B', 2019);

-- --------------------------------------------------------

--
-- Table structure for table `matapelajaran`
--

CREATE TABLE `matapelajaran` (
  `id` varchar(6) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matapelajaran`
--

INSERT INTO `matapelajaran` (`id`, `name`) VALUES
('MP0001', 'Agama'),
('MP0002', 'Bahasa Indonesia'),
('MP0003', 'Bahasa Inggris'),
('MP0004', 'Ilmu Pengetahuan Sosial'),
('MP0005', 'Matematika'),
('MP0006', 'Ilmu Pengetahuan Alam'),
('MP0007', 'Agama'),
('MP0008', 'Bahasa Indonesia'),
('MP0009', 'Bahasa Inggris'),
('MP0010', 'Ilmu Pengetahuan Sosial'),
('MP0011', 'Matematika'),
('MP0012', 'Ilmu Pengetahuan Alam');

-- --------------------------------------------------------

--
-- Table structure for table `mengajar`
--

CREATE TABLE `mengajar` (
  `id` varchar(6) NOT NULL,
  `matpelID` varchar(6) NOT NULL,
  `kelasID` varchar(6) NOT NULL,
  `guruNIP` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mengajar`
--

INSERT INTO `mengajar` (`id`, `matpelID`, `kelasID`, `guruNIP`) VALUES
('MA0001', 'MP0001', 'KS0001', '197205252001032201');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` varchar(6) NOT NULL,
  `tugas` float NOT NULL DEFAULT 0,
  `uts` float NOT NULL DEFAULT 0,
  `uas` float NOT NULL DEFAULT 0,
  `akhir` float NOT NULL DEFAULT 0,
  `semester` int(1) NOT NULL,
  `siswaNISN` varchar(10) NOT NULL,
  `mengajarID` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `tugas`, `uts`, `uas`, `akhir`, `semester`, `siswaNISN`, `mengajarID`) VALUES
('NL0001', 85, 77, 82, 0, 1, '0021113337', 'MA0001');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` varchar(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` enum('Lelaki','Perempuan') NOT NULL,
  `birth_date` date NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `kelasID` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `first_name`, `last_name`, `gender`, `birth_date`, `tahun_masuk`, `username`, `password`, `kelasID`) VALUES
('0021113337', 'Rheina', 'Dea Kintana', 'Perempuan', '2002-07-22', 2017, 'rheina.dea', 'bcd724d15cde8c47650fda962968f102', 'KS0001'),
('0021119992', 'Rayhan', 'Noval Ramadhan', 'Lelaki', '2002-11-07', 2017, 'rayhan.noval', 'bcd724d15cde8c47650fda962968f102', 'KS0002'),
('0031122331', 'Fadil', 'Arfan', 'Lelaki', '2003-03-03', 2018, 'fadil.arfan', 'bcd724d15cde8c47650fda962968f102', 'KS0003'),
('0033344559', 'Shella', 'Miliyanti Praja', 'Perempuan', '2003-04-04', 2018, 'shella.miliyanti', 'bcd724d15cde8c47650fda962968f102', 'KS0004'),
('0042233441', 'Feraldi', 'Fauzan', 'Lelaki', '2004-01-19', 2019, 'feraldi.fauzan', 'bcd724d15cde8c47650fda962968f102', 'KS0006'),
('0043136311', 'Larasati', 'Kurniawan', 'Perempuan', '2004-02-12', 2019, 'larasati.kurniawan', 'bcd724d15cde8c47650fda962968f102', 'KS0005');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matapelajaran`
--
ALTER TABLE `matapelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mengajar`
--
ALTER TABLE `mengajar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matpelID` (`matpelID`),
  ADD KEY `kelasID` (`kelasID`),
  ADD KEY `guruNIP` (`guruNIP`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswaNISN` (`siswaNISN`),
  ADD KEY `mengajarID` (`mengajarID`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `kelasID` (`kelasID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mengajar`
--
ALTER TABLE `mengajar`
  ADD CONSTRAINT `mengajar_ibfk_1` FOREIGN KEY (`guruNIP`) REFERENCES `guru` (`nip`),
  ADD CONSTRAINT `mengajar_ibfk_2` FOREIGN KEY (`kelasID`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `mengajar_ibfk_3` FOREIGN KEY (`matpelID`) REFERENCES `matapelajaran` (`id`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`siswaNISN`) REFERENCES `siswa` (`nisn`),
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`mengajarID`) REFERENCES `mengajar` (`id`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kelasID`) REFERENCES `kelas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
