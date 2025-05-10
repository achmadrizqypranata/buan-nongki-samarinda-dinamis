-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 10, 2025 at 11:03 PM
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
-- Database: `buan_nongki`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `nama`, `email`, `pesan`) VALUES
(1, 'Fatah', 'fatah291@gmail.com', 'mantap');

-- --------------------------------------------------------

--
-- Table structure for table `review_user`
--

CREATE TABLE `review_user` (
  `id` int(11) NOT NULL,
  `tempat_id` int(11) DEFAULT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `ulasan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review_user`
--

INSERT INTO `review_user` (`id`, `tempat_id`, `nama_user`, `rating`, `ulasan`, `created_at`) VALUES
(7, 9, 'Rizky Santoso', 5, 'tempat yang enak buat mengerjakan tugas', '2025-05-11 03:44:38'),
(8, 9, 'Rizky Santoso', 5, 'tempat yang enak buat mengerjakan tugas', '2025-05-11 03:48:08'),
(10, 9, 'Fatah', 5, 'tempat nya keren buat ngopi', '2025-05-11 03:57:02'),
(11, 10, 'Fatah', 5, 'waalaikumsalam', '2025-05-11 03:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `tempat_ngopi`
--

CREATE TABLE `tempat_ngopi` (
  `id` int(11) NOT NULL,
  `nama_tempat` varchar(100) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `jam_buka` time DEFAULT NULL,
  `jam_tutup` time DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `maps_link` text DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempat_ngopi`
--

INSERT INTO `tempat_ngopi` (`id`, `nama_tempat`, `gambar`, `jam_buka`, `jam_tutup`, `deskripsi`, `maps_link`, `lokasi`) VALUES
(9, 'Seraung Coffee', 'seraung.jpg', '00:00:00', '23:59:00', 'Seraung Coffee adalah salah satu tempat nongkrong favorit di jantung Kota Samarinda yang menawarkan suasana hangat dan nyaman, cocok untuk melepas penat atau mengerjakan tugas. Dengan konsep interior minimalis modern yang dipadukan dengan nuansa alam, Seraung Coffee menghadirkan pengalaman ngopi yang tenang namun tetap estetik.\r\n\r\nMenu andalan seperti kopi susu gula aren, matcha latte, dan berbagai varian pastry siap memanjakan lidah para pengunjung. Tempat ini juga menyediakan fasilitas lengkap seperti Wi-Fi gratis, colokan di setiap meja, serta area indoor dan outdoor yang Instagramable.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1324.4210057288137!2d117.13230663130787!3d-0.4874998745959274!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f478b0ac8bd%3A0xeb396aa129873394!2sSeraung%20Coffice!5e0!3m2!1sen!2sid!4v1746469705077!5m2!1sen!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"', 'Samarinda Ulu'),
(10, 'Da’coffe Shop', 'dacoffee.jpg', '13:00:00', '23:00:00', 'Dacoffee Samarinda adalah kafe modern yang memadukan cita rasa kopi berkualitas dengan kenyamanan tempat yang cozy dan kekinian. Terletak di kawasan strategis, Dacoffee menjadi pilihan populer bagi anak muda hingga pekerja yang ingin bersantai atau produktif di luar rumah.\r\n\r\nDengan sajian kopi lokal pilihan, minuman non-kopi, dan makanan ringan yang menggugah selera, Dacoffee tak hanya mengutamakan rasa, tapi juga pelayanan ramah dan suasana yang mendukung. Desain interiornya yang stylish dan atmosfer tenang menjadikan tempat ini cocok untuk meeting santai, nugas, maupun sekadar hangout bareng teman.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6555700206936!2d117.1207396745519!3d-0.517515635268218!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f7aa9e3863b%3A0xac134d0feb988174!2sDa%E2%80%99coffe%20Shop%20Samarinda!5e0!3m2!1sen!2sid!4v1746469846610!5m2!1sen!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"', 'Samarinda Seberang'),
(11, 'Siliwangi Coffee', 'siliwangi.jpg', '10:00:00', '01:30:00', 'Siliwangi Coffee Samarinda adalah kedai kopi yang mengusung konsep tradisional dengan sentuhan modern, menghadirkan suasana hangat dan nyaman bagi para pecinta kopi. Dengan pilihan biji kopi berkualitas dan racikan khas, tempat ini menjadi tempat favorit untuk bersantai atau bekerja.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.676048044279!2d117.12917037455168!3d-0.4838631352746624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f001449df61%3A0xe9ba3c46fa839bae!2sSiliwangi%20Coffee%20Wijaya%20Kusuma!5e0!3m2!1sen!2sid!4v1746469989827!5m2!1sen!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade', 'Samarinda Ulu');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama_lengkap`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin Buan Nongki', 'admin', 'admin@nongki.com', 'password123', 'admin', '2025-05-01 19:37:07'),
(2, 'Rizky Santoso', 'rizky', 'rizky@email.com', 'password123', 'user', '2025-05-01 19:37:07'),
(3, 'Fatah', 'fatah891', 'fatah291@gmail.com', 'Fatah299*', 'user', '2025-05-06 01:28:38'),
(4, 'Jamaluddin', 'jamal235', 'jamal@gmail.com', 'Jamal2*', 'user', '2025-05-11 04:30:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_user`
--
ALTER TABLE `review_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tempat_id` (`tempat_id`);

--
-- Indexes for table `tempat_ngopi`
--
ALTER TABLE `tempat_ngopi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `review_user`
--
ALTER TABLE `review_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tempat_ngopi`
--
ALTER TABLE `tempat_ngopi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `review_user`
--
ALTER TABLE `review_user`
  ADD CONSTRAINT `review_user_ibfk_1` FOREIGN KEY (`tempat_id`) REFERENCES `tempat_ngopi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
