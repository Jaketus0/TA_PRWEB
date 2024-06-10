-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2024 at 04:20 AM
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
  `nama_artis` varchar(100) NOT NULL,
  `datakonser_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artis`
--

INSERT INTO `artis` (`artis_id`, `nama_artis`, `datakonser_id`) VALUES
(2, 'Niki Zefanya', 1),
(3, 'Treasure', 2),
(4, 'Doh Kyungsoo', 3),
(12, 'Jihoon', 2),
(13, '.Feast', 4),
(14, 'Feel Koplo', 4),
(15, 'Maliq &  D\'Essentials', 4),
(16, 'Hindia', 4),
(17, 'Guyon Waton', 5),
(18, 'Reality CLub', 5),
(19, 'The Sigit', 5),
(20, 'Kunto Aji', 5),
(21, 'Juicy Luicy', 5),
(22, 'Fourtwnty', 5),
(29, 'The RedJumsuit Apparatus', 6),
(30, 'Secondhand Serenade', 6),
(31, 'Lomba Sihir', 6),
(32, 'Juicy Luicy', 6),
(33, 'Feel Koplo', 6),
(34, 'Maliq & D\'Essentials', 6),
(35, 'Mahalini', 7),
(36, 'Rizky Febian', 7),
(37, 'Meiska', 7),
(38, 'Borong Boys', 7);

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
  `harga_max` int(50) NOT NULL,
  `harga_min` int(50) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_konser`
--

INSERT INTO `data_konser` (`datakonser_id`, `nama_konser`, `tanggal`, `lokasi`, `kota`, `harga_max`, `harga_min`, `gambar`, `deskripsi`) VALUES
(1, 'Buzz World Tour Jakarta', '2025-02-14', 'GBK Sport Complex Senayan', 'Jakarta', 2000000, 500000, 'niki.png', 'Penyanyi-penulis lagu Indonesia, Niki Zefanya, siap menggebrak Jakarta dengan \"Buzz World Tour\" yang akan digelar pada tanggal 14 dan 15 Februari 2025. Meriahkan perilisan album terbarunya yang ditunggu-tunggu, \"Buzz\", Niki siap menghadirkan malam yang penuh energi, musik yang memukau, dan kenangan tak terlupakan untuk para penggemarnya di Indonesia.'),
(2, 'Treasure Relay Tour Reboot', '2024-06-29', 'GBK Sport Complex Senayan', 'Jakarta', 3600000, 1400000, 'treasure.jpg', 'Treasure, boy group asal Korea Selatan yang dibentuk oleh YG Entertainment, akan kembali ke Jakarta untuk konser mereka yang bertajuk \"Treasure Relay Tour Reboot\". Konser ini akan menjadi momen spesial bagi para penggemar Treasure di Indonesia, yang dikenal dengan sebutan \"Teume\".\r\n\r\nTreasure akan membawakan lagu-lagu hits mereka dari album \"JIKJIN\" dan \"Hello\", serta beberapa lagu kejutan lainnya. Konser ini dijamin akan penuh dengan energi, musik yang catchy, dan penampilan yang memukau dari para anggota Treasure.'),
(3, 'BLOOM Asia Fan Tour Concert ', '2024-07-12', 'The Kasablanka Hall', 'Jakarta', 3000000, 1400000, 'do.jpg', 'Doh Kyung Soo, atau yang dikenal dengan nama D.O. dari EXO, akan menggelar tur konser solo pertamanya di Asia bertajuk DOH KYUNG SOO ASIA FAN CONCERT TOUR <BLOOM>. Konser ini akan membawa para penggemarnya dalam perjalanan musikal yang penuh dengan pesona dan kehangatan.'),
(4, 'Crsl Concert 5', '2024-11-02', 'stadiun kridosono yogyakarta', 'yogyakarta', 250000, 139000, 'crsl.png', 'CRSL Concert merupakan aktivasi dari brand CRSL yang menggunakan medium pertunjukan musik sebagai medianya dan sudah terselenggara sebanyak empat kali di tahun 2019, 2020, 2022 dan 2023 serta kedepanya akan menjadi agenda secara periodik di setiap tahunnya.'),
(5, 'Ekspectanica 2024 ', '2024-07-20', 'Laswi Heritage', 'Bandung', 516000, 149000, 'Ekspectanic.png', 'Ekspectanica 2024 kembali hadir di Bandung!! Tentu dengan sajian akan jauh lebih menarik dan menyenagkan. 20 dan 21 Juli 2024. Catat tanggalnya!  Menghadirkan banyak Guest Star dengan berbagai genre, Ekspectanica 2024 akan menjadi festival yang menyenangkan untuk dinikmati, Total 14 Guest Star akan tersaji di dua hari pelaksanaan Ekspectanica, Sampai bertemu nanti !!'),
(6, 'YLO FEST 2024', '2024-09-07', 'Kompleks SKA Mall', 'Pekanbaru', 1200000, 450000, 'ylo.png', 'Ylo Festival merupakan acara yang diselenggarakan oleh Kompen Entertainment dalam rangkaian festival yang bertemakan Event. Ini merupakan acara lanjutan Kompen Entertainment berkonsep festival dengan skala yang lebih besar.'),
(7, 'DIESTERIA VOL.II INSTIKI', '2024-06-15', 'Taman Festival Bali', 'Denpasar', 160000, 135000, 'diesteria.png', 'Diesteria merupakan program kerja dari Badan Eksekutif Mahasiswa Pemerintahan Mahasiswa INSTIKI dengan tujuan besar untuk merangkul organisasi mahasiswa dari Himpunan Mahasiswa, FPK dan UKM dalam suatu acara yaitu konser DIESTERIA BEM-PM INSTIKI Kegiatan Diesteria ini pernah di jalankan beberapa tahun lalu, diakarenakan adanya pandemic covid-19 kegiatan ini tidak dapat dilaksanakan sebagaimana mestinya. Pada tahun ini Badan Eksekutif Mahasiswa dan Civitas Akademika INSTIKI kembali bersemangat dan bertekad besar untuk menjalankan kembali Diesteria ini.');

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
  `user_email` varchar(100) NOT NULL,
  `total_harga` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_tiket`
--

CREATE TABLE `jenis_tiket` (
  `jenis_id` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `stock` int(200) NOT NULL,
  `harga` int(50) NOT NULL,
  `datakonser_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_tiket`
--

INSERT INTO `jenis_tiket` (`jenis_id`, `jenis`, `stock`, `harga`, `datakonser_id`) VALUES
(2, 'Super Fan Early Festival', 200, 500000, 1),
(3, 'Early Festival', 170, 750000, 1),
(4, 'Festival', 150, 950000, 1),
(5, 'Super Fan Early VIP ', 130, 1250000, 1),
(6, 'Early Bird VIP ', 110, 1750000, 1),
(7, 'VIP ', 80, 2000000, 1),
(8, 'Purple', 200, 1400000, 2),
(9, 'Grey', 180, 2500000, 2),
(10, 'Yellow', 170, 2700000, 2),
(11, 'Green', 160, 3000000, 2),
(12, 'Pink', 140, 3100000, 2),
(13, 'Blue', 130, 3200000, 2),
(14, 'VIP Blue', 100, 3600000, 2),
(15, 'VIP Pink', 100, 3600000, 2),
(16, 'Yellow', 200, 1400000, 3),
(17, 'Green', 150, 2200000, 3),
(18, 'Blue', 100, 3000000, 3),
(23, 'Early Bird Festival', 90, 139000, 4),
(24, 'Presale-1', 70, 159000, 4),
(25, 'Presale-3', 50, 200000, 4),
(26, 'Presale-4', 40, 250000, 4),
(27, 'Festival Day 1 - Pre Sale 2 - Sendiri', 100, 149000, 5),
(28, 'Festival Day 1 - Pre Sale 2 - Berdua', 100, 278000, 5),
(29, 'Festival Day 1 - Pre Sale 2 - Berempat', 100, 516000, 5),
(30, 'EARLY BIRD DIAMOND', 150, 450000, 6),
(31, 'EARLY BIRD VIP', 150, 700000, 6),
(32, 'EARLY BIRD DIAMOND (Pass)', 100, 800000, 6),
(33, 'EARLY BIRD VIP (Pass)', 100, 1200000, 6),
(34, 'Presale 1', 200, 135000, 1),
(35, 'Presale 2', 200, 160000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stage`
--

CREATE TABLE `stage` (
  `stage_id` int(11) NOT NULL,
  `datakonser_id` int(11) NOT NULL,
  `gambar_stage` varchar(255) NOT NULL,
  `maps` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stage`
--

INSERT INTO `stage` (`stage_id`, `datakonser_id`, `gambar_stage`, `maps`) VALUES
(1, 2, 'treasure_stage.png', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.341269416672!2d106.79690177750263!3d-6.2186487777040105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f14d30079f01%3A0x2e74f2341fff266d!2sStadion%20Utama%20Gelora%20Bung%20Karno!5e0!3m2!1sid!2sid!4v1717665903103!5m2!1sid!2sid\" width=\"400\" height=\"300\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(2, 3, 'do_stage.png', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.29897114237!2d106.84094557477705!3d-6.22425379376382!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f38cc147f145%3A0x3225ec9b7b7adc0c!2sThe%20Kasablanka!5e0!3m2!1sid!2sid!4v1717668589757!5m2!1sid!2sid\" width=\"400\" height=\"300\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(3, 4, '66658cc43878f2.69817011.jpg', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.0196079444395!2d110.37156751052348!3d-7.787745392199721!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a582db4341589%3A0xd86754d15099c4c9!2sKridosono%20Stadium!5e0!3m2!1sen!2sid!4v1717931197599!5m2!1sen!2sid\" width=\"400\" height=\"300\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(4, 5, '6665dcbd975ae0.47204157.png', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.767952633999!2d107.6306233748354!3d-6.918321693081271!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7f8ff2d6d81%3A0x6cd6399e26f49a8e!2sLaswi%20Heritage!5e0!3m2!1sid!2sid!4v1717951505359!5m2!1sid!2sid\" width=\"400\" height=\"300\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(5, 1, '6665ddbf732806.81216526.jpg', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.341486536777!2d106.79962877482906!3d-6.218619993769361!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f14d30079f01%3A0x2e74f2341fff266d!2sStadion%20Utama%20Gelora%20Bung%20Karno!5e0!3m2!1sid!2sid!4v1717951917391!5m2!1sid!2sid\" width=\"400\" height=\"300\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(6, 6, '6665e16eb8be27.63974213.png', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6670207585025!2d101.41645007480251!3d0.49897789949613985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5a9347b153e01%3A0xcb644449e8a62d2!2sMal%20SKA!5e0!3m2!1sid!2sid!4v1717952863925!5m2!1sid!2sid\" width=\"400\" height=\"300\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>');

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
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_password`, `user_email`) VALUES
(1, 'hera', '1234haha', 'hera@gmail.com'),
(2, 'admin', 'admin', 'admin@gmail.com'),
(3, 'Dellas', 'dellas', 'aodellas@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artis`
--
ALTER TABLE `artis`
  ADD PRIMARY KEY (`artis_id`),
  ADD KEY `artis_ibfk_1` (`datakonser_id`);

--
-- Indexes for table `data_konser`
--
ALTER TABLE `data_konser`
  ADD PRIMARY KEY (`datakonser_id`),
  ADD UNIQUE KEY `datakonser_id` (`datakonser_id`);

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
  ADD PRIMARY KEY (`jenis_id`),
  ADD KEY `datakonser_id` (`datakonser_id`);

--
-- Indexes for table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`stage_id`),
  ADD KEY `datakonser_id` (`datakonser_id`);

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
  MODIFY `artis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `data_konser`
--
ALTER TABLE `data_konser`
  MODIFY `datakonser_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `pemesanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jenis_tiket`
--
ALTER TABLE `jenis_tiket`
  MODIFY `jenis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `stage`
--
ALTER TABLE `stage`
  MODIFY `stage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artis`
--
ALTER TABLE `artis`
  ADD CONSTRAINT `artis_ibfk_1` FOREIGN KEY (`datakonser_id`) REFERENCES `data_konser` (`datakonser_id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`datakonser_id`) REFERENCES `data_konser` (`datakonser_id`);

--
-- Constraints for table `jenis_tiket`
--
ALTER TABLE `jenis_tiket`
  ADD CONSTRAINT `jenis_tiket_ibfk_1` FOREIGN KEY (`datakonser_id`) REFERENCES `data_konser` (`datakonser_id`);

--
-- Constraints for table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `stage_ibfk_1` FOREIGN KEY (`datakonser_id`) REFERENCES `data_konser` (`datakonser_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
