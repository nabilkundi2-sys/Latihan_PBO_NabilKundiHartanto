-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2026 at 03:08 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_latihan_pbo_trpl1a_nabil_kundi_hartanto`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_tiket`
--

CREATE TABLE `tabel_tiket` (
  `id_tiket` int NOT NULL,
  `nama_film` varchar(100) NOT NULL,
  `jadwal_tayang` datetime NOT NULL,
  `jumlah_kursi` int NOT NULL,
  `harga_dasar_tiket` decimal(10,2) NOT NULL,
  `jenis_studio` enum('regular','imax','velvet') NOT NULL,
  `tipe_audio` varchar(50) DEFAULT NULL,
  `lokasi_baris` varchar(20) DEFAULT NULL,
  `kacamata_3d_id` varchar(50) DEFAULT NULL,
  `efek_gerak_fitur` varchar(100) DEFAULT NULL,
  `bantal_selimut_pack` varchar(100) DEFAULT NULL,
  `layanan_butler` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_tiket`
--

INSERT INTO `tabel_tiket` (`id_tiket`, `nama_film`, `jadwal_tayang`, `jumlah_kursi`, `harga_dasar_tiket`, `jenis_studio`, `tipe_audio`, `lokasi_baris`, `kacamata_3d_id`, `efek_gerak_fitur`, `bantal_selimut_pack`, `layanan_butler`) VALUES
(1, 'Avengers: Doomsday', '2026-06-15 10:00:00', 100, 45000.00, 'regular', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Minecraft Movie', '2026-06-15 13:00:00', 100, 45000.00, 'regular', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Mission Impossible 8', '2026-06-16 11:00:00', 100, 45000.00, 'regular', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Jumbo', '2026-06-16 14:00:00', 100, 45000.00, 'regular', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Pengepungan di Bukit Duri', '2026-06-17 10:30:00', 100, 45000.00, 'regular', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Pabrik Gula', '2026-06-17 13:30:00', 100, 45000.00, 'regular', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Superman', '2026-06-18 15:00:00', 100, 45000.00, 'regular', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Avengers: Doomsday', '2026-06-15 11:00:00', 80, 95000.00, 'imax', 'Dolby Atmos', NULL, 'KM-IMAX-001', 'Kursi Getar', NULL, NULL),
(9, 'Minecraft Movie', '2026-06-15 14:00:00', 80, 95000.00, 'imax', 'Dolby Atmos', NULL, 'KM-IMAX-002', 'Angin', NULL, NULL),
(10, 'Mission Impossible 8', '2026-06-16 12:00:00', 80, 95000.00, 'imax', 'DTS:X', NULL, 'MI-IMAX-001', 'Kursi Getar', NULL, NULL),
(11, 'Superman', '2026-06-16 15:00:00', 80, 95000.00, 'imax', 'DTS:X', NULL, 'SM-IMAX-001', 'Angin + Getar', NULL, NULL),
(12, 'Jumbo', '2026-06-17 11:00:00', 80, 95000.00, 'imax', 'Dolby Atmos', NULL, 'JB-IMAX-001', 'Angin', NULL, NULL),
(13, 'Pabrik Gula', '2026-06-17 14:00:00', 80, 95000.00, 'imax', 'DTS:X', NULL, 'PG-IMAX-001', 'Kursi Getar', NULL, NULL),
(14, 'Pengepungan di Bukit Duri', '2026-06-18 10:00:00', 80, 95000.00, 'imax', 'Dolby Atmos', NULL, 'PD-IMAX-001', 'Angin + Getar', NULL, NULL),
(15, 'Avengers: Doomsday', '2026-06-15 19:00:00', 30, 175000.00, 'velvet', NULL, 'Baris A', NULL, NULL, 'Bantal + Selimut Fleece', 'Tersedia'),
(16, 'Minecraft Movie', '2026-06-15 20:00:00', 30, 175000.00, 'velvet', NULL, 'Baris B', NULL, NULL, 'Bantal + Selimut Fleece', 'Tersedia'),
(17, 'Mission Impossible 8', '2026-06-16 19:30:00', 30, 175000.00, 'velvet', NULL, 'Baris A', NULL, NULL, 'Bantal Memory Foam', 'Tersedia'),
(18, 'Superman', '2026-06-16 20:30:00', 30, 175000.00, 'velvet', NULL, 'Baris B', NULL, NULL, 'Bantal Memory Foam', 'Tersedia'),
(19, 'Jumbo', '2026-06-17 19:00:00', 30, 175000.00, 'velvet', NULL, 'Baris A', NULL, NULL, 'Bantal + Selimut Fleece', 'Tersedia'),
(20, 'Pabrik Gula', '2026-06-17 20:00:00', 30, 175000.00, 'velvet', NULL, 'Baris C', NULL, NULL, 'Bantal + Selimut Fleece', 'Tersedia'),
(21, 'Pengepungan di Bukit Duri', '2026-06-18 19:30:00', 30, 175000.00, 'velvet', NULL, 'Baris B', NULL, NULL, 'Bantal Memory Foam', 'Tersedia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  ADD PRIMARY KEY (`id_tiket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  MODIFY `id_tiket` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
