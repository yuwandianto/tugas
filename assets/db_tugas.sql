-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 23, 2021 at 09:36 PM
-- Server version: 10.3.29-MariaDB-0+deb10u1
-- PHP Version: 7.3.29-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tugas`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_api`
--

CREATE TABLE `data_api` (
  `id` int(11) NOT NULL,
  `url` varchar(200) NOT NULL,
  `versi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_api`
--

INSERT INTO `data_api` (`id`, `url`, `versi`) VALUES
(1, 'http://localhost:8000/', '1.0.0');

-- --------------------------------------------------------

--
-- Table structure for table `data_kelas`
--

CREATE TABLE `data_kelas` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_kelas`
--

INSERT INTO `data_kelas` (`id`, `nama_kelas`) VALUES
(8, '11 MIPA 1'),
(9, '11 MIPA 2'),
(10, '11 MIPA 3'),
(11, '11 MIPA 4'),
(12, '11 IPS 1'),
(13, '11 IPS 2'),
(14, '11 IPS 3'),
(15, '11 IPS 4');

-- --------------------------------------------------------

--
-- Table structure for table `data_pd`
--

CREATE TABLE `data_pd` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pd`
--

INSERT INTO `data_pd` (`id`, `nama`, `kelas`, `hp`) VALUES
(1, 'Alvian', '11 MIPA 1', '082153240501'),
(2, 'Alvian Fake', '11 MIPA 1', '0821532405011');

-- --------------------------------------------------------

--
-- Table structure for table `data_siswa`
--

CREATE TABLE `data_siswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `tugas` int(11) NOT NULL,
  `hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_tugas`
--

CREATE TABLE `data_tugas` (
  `id` int(11) NOT NULL,
  `mapel` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_tugas`
--

INSERT INTO `data_tugas` (`id`, `mapel`, `keterangan`) VALUES
(9, 'PJOK', 'Silakan lihat kembali tugas PJOK pertemuan ke 2 tanggal 26 juli 2021. Baca komentar lalu lakukan perbaikan. '),
(10, 'PJOK', 'Kamu belum mengerjakan tugas PJOK pertemuan ke 2, hari Senin 26 juli 2021. Silakan segera dikerjakan.\r\nBukan masalah benar atau salah dari jawaban, tapi nilai tanggungjawab atas tugas yang diberikan yang terpenting.'),
(11, 'PJOK', 'Kamu belum mengerjakan tugas ke 2 tanggal 9 agustus 2021. Yakni mempraktikkan hasil analisis gerak. silakan segera dikerjakan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_api`
--
ALTER TABLE `data_api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_kelas`
--
ALTER TABLE `data_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_pd`
--
ALTER TABLE `data_pd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_tugas`
--
ALTER TABLE `data_tugas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_kelas`
--
ALTER TABLE `data_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `data_pd`
--
ALTER TABLE `data_pd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_tugas`
--
ALTER TABLE `data_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
