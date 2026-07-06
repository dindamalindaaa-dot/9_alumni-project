-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2026 at 05:24 AM
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
-- Database: `db_alumni`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `id_alumni` int(11) NOT NULL,
  `nim` varchar(30) NOT NULL,
  `nama_lengkap` varchar(120) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(80) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `program_studi` varchar(100) NOT NULL,
  `fakultas` varchar(100) DEFAULT NULL,
  `tahun_masuk` year(4) DEFAULT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `ipk` decimal(3,2) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status_pekerjaan` enum('Bekerja','Wirausaha','Studi Lanjut','Belum Bekerja') DEFAULT 'Belum Bekerja',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`id_alumni`, `nim`, `nama_lengkap`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `program_studi`, `fakultas`, `tahun_masuk`, `tahun_lulus`, `ipk`, `email`, `no_hp`, `alamat`, `status_pekerjaan`, `created_at`, `updated_at`) VALUES
(1, '190101001', 'Ahmad Fauzan', 'Laki-laki', 'Banda Aceh', '2001-04-12', 'Pendidikan Teknologi Informasi', 'Tarbiyah dan Keguruan', '2019', '2023', 3.65, 'fauzan@example.com', '081234567890', 'Banda Aceh', 'Bekerja', '2026-07-01 01:43:22', '2026-07-01 01:43:22'),
(2, '190101002', 'Nurul Aulia', 'Perempuan', 'Aceh Besar', '2001-08-20', 'Pendidikan Teknologi Informasi', 'Tarbiyah dan Keguruan', '2019', '2023', 3.81, 'nurul@example.com', '082345678901', 'Aceh Besar', 'Studi Lanjut', '2026-07-01 01:43:22', '2026-07-01 01:43:22'),
(3, '180101003', 'Rahmat Hidayat', 'Laki-laki', 'Pidie', '2000-02-11', 'Pendidikan Teknologi Informasi', 'Tarbiyah dan Keguruan', '2018', '2022', 3.42, 'rahmat@example.com', '083456789012', 'Pidie', 'Wirausaha', '2026-07-01 01:43:22', '2026-07-01 01:43:22'),
(4, '200101004', 'Siti Rahma', 'Perempuan', 'Bireuen', '2002-03-15', 'Pendidikan Teknologi Informasi', 'Tarbiyah dan Keguruan', '2020', '2024', 3.72, 'siti@example.com', '084567890123', 'Bireuen', 'Belum Bekerja', '2026-07-01 01:43:22', '2026-07-01 01:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL,
  `id_alumni` int(11) NOT NULL,
  `nama_instansi` varchar(150) DEFAULT NULL,
  `bidang_pekerjaan` varchar(100) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `lokasi_kerja` varchar(120) DEFAULT NULL,
  `penghasilan` enum('< 2 Juta','2-5 Juta','5-10 Juta','> 10 Juta') DEFAULT NULL,
  `tahun_mulai` year(4) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `id_alumni`, `nama_instansi`, `bidang_pekerjaan`, `jabatan`, `lokasi_kerja`, `penghasilan`, `tahun_mulai`, `keterangan`, `created_at`) VALUES
(1, 1, 'PT Digital Nusantara', 'Teknologi Informasi', 'Web Developer', 'Banda Aceh', '5-10 Juta', '2023', 'Bekerja sebagai pengembang aplikasi web', '2026-07-01 01:43:22'),
(2, 3, 'Rahmat Creative Studio', 'Kewirausahaan Digital', 'Founder', 'Pidie', '2-5 Juta', '2022', 'Mengelola usaha jasa desain dan website', '2026-07-01 01:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','operator') DEFAULT 'admin',
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `password`, `role`, `status`, `created_at`) VALUES
(1, 'Administrator Alumni', 'admin', 'admin123', 'admin', 'aktif', '2026-07-01 01:43:22'),
(2, 'Operator Alumni', 'operator', 'operator123', 'operator', 'aktif', '2026-07-01 01:43:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id_alumni`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`),
  ADD KEY `id_alumni` (`id_alumni`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id_alumni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD CONSTRAINT `pekerjaan_ibfk_1` FOREIGN KEY (`id_alumni`) REFERENCES `alumni` (`id_alumni`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
