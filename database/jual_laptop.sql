-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2024 at 03:05 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jual_laptop`
--

-- --------------------------------------------------------

--
-- Table structure for table `laptop`
--

CREATE TABLE `laptop` (
  `id_laptop` int(11) NOT NULL,
  `jenis_laptop` varchar(100) NOT NULL,
  `harga` varchar(40) NOT NULL,
  `spesifikasi` varchar(500) NOT NULL,
  `gambar` varchar(70) NOT NULL,
  `stok` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laptop`
--

INSERT INTO `laptop` (`id_laptop`, `jenis_laptop`, `harga`, `spesifikasi`, `gambar`, `stok`) VALUES
(7, 'Zenbook 14 OLED (UX3402)', '17.000.000', 'Windows 11 Home - ASUS recommends Windows 11 Pro for business\r\nUp to 12th gen Intel® Core™ i7 processor\r\nIntel® Evo™ certified laptop\r\nUp to 16 GB memory\r\nUp to 1 TB SSD storage\r\nUp to 14&quot; 2.8K OLED NanoEdge touchscreen\r\nLong-lasting 75 Wh battery\r\nThunderbolt™ 4 USB-C™', '63ca064b69fa3.png', 1),
(13, 'Asus Vivobook', '15.000.000', 'Windows 11 Home - ASUS recommends Windows 11 Pro for business Up to 12th gen Intel® Core™ i7 processor Intel® Evo™ certified laptop Up to 16 GB memory Up to 1 TB SSD storage Up to 14&quot; 2.8K OLED NanoEdge touchscreen Long-lasting 75 Wh battery ', '65ae7f1a0dae7.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `tgl_bayar` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `email_user`, `id_pemesanan`, `tgl_bayar`) VALUES
(13, 'nana@gmail.com', 36, '23-01-2024');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_laptop` int(11) NOT NULL,
  `total_harga` varchar(30) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` varchar(40) NOT NULL,
  `nama_pembeli` varchar(70) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_laptop`, `total_harga`, `jumlah`, `tanggal`, `nama_pembeli`, `status`) VALUES
(36, 13, '16.000.000', 1, '23-01-2024', 'nana@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(150) NOT NULL,
  `status` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `status`) VALUES
(1, 'putrabasuki24@gmail.com', '$2y$10$S6tIGhmX.OZly1MXVRJyJ.nmlpnlYiK86AXlsXjaOAh8ZwLlzTzAO', '1'),
(10, 'princelloputrabasuki24@gmail.com', '$2y$10$i8BFa0G4jQQbchnjdIUja.0tfrWIBcmjqkJMbz7dNwm/2WsztWSPm', '2'),
(18, 'nana@gmail.com', '$2y$10$ncz6JqTATBCfer3HDF4TpewTGvJfYQpqHDjMvNeMpPP/eQxu3dVUa', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laptop`
--
ALTER TABLE `laptop`
  ADD PRIMARY KEY (`id_laptop`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laptop`
--
ALTER TABLE `laptop`
  MODIFY `id_laptop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
