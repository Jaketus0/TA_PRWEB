-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 04:37 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avh_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `artis`
--

CREATE TABLE `artis` (
  `artis_id` int(11) NOT NULL,
  `nama_artis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_konser`
--

CREATE TABLE `data_konser` (
  `datakonser_id` int(11) NOT NULL,
  `nama_konser` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `artis_id` int(11) NOT NULL,
  `jenis_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `pemesanan_id` int(11) NOT NULL,
  `nama_pembeli` varchar(100) NOT NULL,
  `jumlah_tiket` int(200) NOT NULL,
  `jenis_tiket` varchar(50) NOT NULL,
  `nama_konser` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datakonser_id` int(11) NOT NULL,
  `no_tlp` int(20) NOT NULL,
  `user_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_tiket`
--

CREATE TABLE `jenis_tiket` (
  `jenis_id` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `stock` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artis`
--
ALTER TABLE `artis`
  ADD PRIMARY KEY (`artis_id`);

--
-- Indexes for table `data_konser`
--
ALTER TABLE `data_konser`
  ADD PRIMARY KEY (`datakonser_id`),
  ADD KEY `artis_id` (`artis_id`),
  ADD KEY `jenis_id` (`jenis_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`pemesanan_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `datakonser_id` (`datakonser_id`);

--
-- Indexes for table `jenis_tiket`
--
ALTER TABLE `jenis_tiket`
  ADD PRIMARY KEY (`jenis_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artis`
--
ALTER TABLE `artis`
  MODIFY `artis_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_konser`
--
ALTER TABLE `data_konser`
  MODIFY `datakonser_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `pemesanan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_tiket`
--
ALTER TABLE `jenis_tiket`
  MODIFY `jenis_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_konser`
--
ALTER TABLE `data_konser`
  ADD CONSTRAINT `data_konser_ibfk_1` FOREIGN KEY (`artis_id`) REFERENCES `artis` (`artis_id`),
  ADD CONSTRAINT `data_konser_ibfk_2` FOREIGN KEY (`jenis_id`) REFERENCES `jenis_tiket` (`jenis_id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`datakonser_id`) REFERENCES `data_konser` (`datakonser_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
