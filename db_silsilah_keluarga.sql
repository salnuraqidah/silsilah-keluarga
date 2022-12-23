-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 23, 2022 at 09:06 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_silsilah_keluarga`
--

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'L : laki-laki P : perempuan',
  `family` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0',
  `family_id` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `parent` varchar(11) DEFAULT NULL,
  `parent_id` varchar(11) DEFAULT NULL,
  `posisi` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`id`, `nama`, `jenis_kelamin`, `family`, `family_id`, `parent`, `parent_id`, `posisi`) VALUES
(1, 'Budi S', 'L', '1', '0', NULL, NULL, 'root'),
(2, 'Dedi', 'L', '0', '1', '1', NULL, 'Anak'),
(3, 'Dodi', 'L', '0', '1', '2', NULL, 'Anak'),
(4, 'Dewi', 'P', '0', '1', '4', NULL, 'Anak'),
(5, 'Feri', 'L', '0', '1', NULL, '1', 'Cucu'),
(6, 'Farah', 'P', '0', '1', NULL, '1', 'Cucu'),
(7, 'Gugus', 'L', '0', '1', NULL, '2', 'Cucu'),
(8, 'Gandi', 'L', '0', '1', NULL, '2', 'Cucu'),
(9, 'Hani', 'P', '0', '1', NULL, '3', 'Cucu'),
(10, 'Hana', 'P', '0', '1', NULL, '3', 'Cucu'),
(11, 'Dede', 'L', '0', '1', '3', NULL, 'Anak');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
