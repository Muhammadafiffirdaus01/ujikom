-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2026 at 01:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujikom`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `alamat`, `tanggal_lahir`, `gender`, `created_at`) VALUES
('K3522001', 'Achmad Zarir Adzdzaki', 'Bojonegoro, Jawa Timur', '2003-02-03', 'L', '2026-02-21 05:04:01'),
('K3522002', 'Jaisy', 'Sukoharjo', '2003-02-02', 'L', '2026-02-21 05:44:38'),
('K3522016', 'Daru Jinan Najmi', 'Kebumen, Jawa Tengah', '2003-02-05', 'L', '2026-02-21 03:21:50'),
('K3522042', 'Maranatha', 'Jawa Tengah', '2003-01-01', 'P', '2026-02-21 02:01:48'),
('K3522044', 'MUHAMMAD AFIF FIRDAUS', 'Kedungrejo RT 35/RW 09, Sidodadi, Masaran, Sragen, Jawa Tengah', '2003-07-17', 'L', '2026-02-21 01:58:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
