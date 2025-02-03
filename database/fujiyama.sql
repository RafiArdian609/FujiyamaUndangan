-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 03, 2025 at 09:11 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fujiyama`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `id` int NOT NULL,
  `attendance` enum('belum','hadir','tidak_hadir') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'belum',
  `konfirmasi_kehadiran` enum('belum','hadir') DEFAULT 'belum',
  `nama_lengkap` varchar(100) NOT NULL,
  `instansi` varchar(100) DEFAULT 'Tidak Diketahui'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`id`, `attendance`, `konfirmasi_kehadiran`, `nama_lengkap`, `instansi`) VALUES
(1, 'belum', 'belum', 'Bayu', 'PT G-Smart Solusion\r\n'),
(2, 'belum', 'belum', 'Direktur atau Manager', 'Finger Spot\r\n'),
(3, 'belum', 'belum', 'Bernard', 'PKS Komputer Surabaya\r\n'),
(4, 'belum', 'belum', 'Achmad Rizky', 'Hotel Grand Mercure Surabaya\r\n'),
(5, 'belum', 'belum', 'Sigit Purnomo', 'Unilever\r\n'),
(6, 'belum', 'belum', 'Orang Tua Firlia', 'Orang Tua kelas XII\r\n'),
(7, 'belum', 'belum', 'Hartono', 'Waringin\r\n'),
(8, 'belum', 'belum', 'Yunanto', 'G-Suites\r\n'),
(9, 'belum', 'belum', 'Nita', 'Alana Hotel\r\n'),
(10, 'belum', 'belum', 'Belum Ada 1', 'Tidak Diketahui'),
(11, 'belum', 'belum', 'Belum Ada 2', 'Tidak Diketahui'),
(12, 'belum', 'belum', 'Belum Ada 3', 'Tidak Diketahui'),
(13, 'belum', 'belum', 'Siswoyo', 'SMP Islam Maryam Surabaya\r\n'),
(14, 'belum', 'belum', 'Aisyah', 'SMP Islam Raden Paku\r\n'),
(15, 'belum', 'belum', 'Waka Humas', 'SMP Muhammadiyah 2'),
(16, 'belum', 'belum', 'Zaidahtul Aliyah', 'Kepala Sekolah SMP Daniswara'),
(17, 'belum', 'belum', 'Cantas Kartika', 'Kalab.PH\r\n'),
(18, 'belum', 'belum', 'Yunia Widiastuti', 'Kalab.TB\r\n'),
(19, 'belum', 'belum', 'Meita Istiqomah', 'Sekertaris Sekolah\r\n'),
(20, 'belum', 'belum', 'Abdullah Muhammad', 'Pembina OSIS\r\n'),
(100, 'hadir', 'belum', 'test', 'Tidak Diketahui'),
(102, 'belum', 'belum', 'Siswoyo', 'SMP Islam Maryam Surabaya\r\n\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
