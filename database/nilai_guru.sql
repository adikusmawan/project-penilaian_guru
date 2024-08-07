-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2024 at 12:00 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nilai_guru`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nama_guru`, `alamat`, `no_telepon`) VALUES
(1, 'Guru A', 'Jl. Merdeka No. 1', '081234567890'),
(2, 'Guru B', 'Jl. Kemerdekaan No. 2', '081234567891'),
(3, 'Guru C', 'Jl. Proklamasi No. 3', '081234567892');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_topsis`
--

CREATE TABLE `hasil_topsis` (
  `id_hasil` int(11) NOT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `nilai_topsis` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_topsis`
--

INSERT INTO `hasil_topsis` (`id_hasil`, `id_guru`, `id_periode`, `nilai_topsis`) VALUES
(26, 1, 1, 1),
(27, 2, 1, 0.348005),
(28, 3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_waspas`
--

CREATE TABLE `hasil_waspas` (
  `id_hasil` int(11) NOT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `nilai_waspas` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_waspas`
--

INSERT INTO `hasil_waspas` (`id_hasil`, `id_guru`, `id_periode`, `nilai_waspas`) VALUES
(14, 1, 1, 0.20741),
(15, 2, 1, 0.197848),
(16, 3, 1, 0.192172);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`) VALUES
(1, 'Absensi', 0.15),
(2, 'Ketepatan Waktu', 0.15),
(3, 'Sikap', 0.1),
(4, 'Disiplin', 0.1),
(5, 'Motivasi & Inovasi', 0.15),
(6, 'Tanggung Jawab', 0.1),
(7, 'Kemampuan Mengajar', 0.15),
(8, 'Hubungan dengan Siswa', 0.1);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `nilai` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_guru`, `id_kriteria`, `id_periode`, `nilai`) VALUES
(1, 1, 1, 1, 85),
(2, 1, 2, 1, 90),
(3, 1, 3, 1, 88),
(4, 2, 1, 1, 80),
(5, 2, 2, 1, 85),
(6, 2, 3, 1, 87),
(7, 3, 1, 1, 78),
(8, 3, 2, 1, 82),
(9, 3, 3, 1, 85),
(18, 2, 1, 2, 89),
(19, 2, 2, 2, 89),
(20, 2, 3, 2, 89),
(21, 2, 4, 2, 89),
(22, 2, 5, 2, 89),
(23, 2, 6, 2, 89),
(24, 2, 7, 2, 89),
(25, 2, 8, 2, 89);

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id_periode` int(11) NOT NULL,
  `nama_periode` varchar(20) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id_periode`, `nama_periode`, `tanggal_mulai`, `tanggal_selesai`) VALUES
(1, 'Semester 1 2024', '2024-01-01', '2024-06-30'),
(2, 'Semester 2 2024', '2024-07-01', '2024-12-31'),
(3, 'Semester 1 2025', '2025-01-01', '2025-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'user1', 'password123', 'user'),
(3, 'user2', 'password123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `hasil_topsis`
--
ALTER TABLE `hasil_topsis`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indexes for table `hasil_waspas`
--
ALTER TABLE `hasil_waspas`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `hasil_topsis`
--
ALTER TABLE `hasil_topsis`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `hasil_waspas`
--
ALTER TABLE `hasil_waspas`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_topsis`
--
ALTER TABLE `hasil_topsis`
  ADD CONSTRAINT `hasil_topsis_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`),
  ADD CONSTRAINT `hasil_topsis_ibfk_2` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`);

--
-- Constraints for table `hasil_waspas`
--
ALTER TABLE `hasil_waspas`
  ADD CONSTRAINT `hasil_waspas_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`),
  ADD CONSTRAINT `hasil_waspas_ibfk_2` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`);

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`),
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`),
  ADD CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
