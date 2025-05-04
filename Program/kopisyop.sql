-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2025 at 12:48 PM
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
-- Database: `kopisyop`
--

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `ID` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `posisi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`ID`, `nama`, `posisi`) VALUES
(1, 'Karyawan 1', 'Barista'),
(2, 'Karyawan 2', 'Kasir'),
(3, 'Karyawan 3', 'Barista'),
(4, 'Karyawan 4', 'Pelayan'),
(5, 'Karyawan 5', 'Barista'),
(6, 'Karyawan 6', 'Pelayan'),
(7, 'Karyawan 7', 'Kasir'),
(8, 'Karyawan 8', 'Barista'),
(9, 'Karyawan 9', 'Pelayan'),
(10, 'Karyawan 10', 'Kasir');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `ID` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`ID`, `nama`) VALUES
(1, 'Kopi'),
(2, 'Roti & Pastry'),
(3, 'Non-Kopi'),
(4, 'Minuman Dingin'),
(5, 'Makanan Berat');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `ID` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kategori_ID` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`ID`, `nama`, `kategori_ID`, `harga`) VALUES
(1, 'Espressooo', 2, 15000000),
(2, 'Cappuccino', 1, 18000),
(3, 'Latte', 1, 17000),
(4, 'Americano', 1, 16000),
(5, 'Mocha', 1, 19000),
(6, 'Croissant', 2, 10000),
(7, 'Donat', 2, 9000),
(8, 'Waffle', 2, 12000),
(9, 'Matcha Latte', 3, 20000),
(10, 'Caramel Macchiato', 3, 22000);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `ID` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `karyawan_ID` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`ID`, `waktu`, `karyawan_ID`, `harga`) VALUES
(1, '2025-04-17 08:10:00', 1, 15000),
(2, '2025-04-17 08:30:00', 2, 18000),
(3, '2025-04-17 09:00:00', 3, 27000),
(4, '2025-04-17 09:30:00', 4, 36000),
(5, '2025-04-17 10:00:00', 5, 20000),
(6, '2025-04-17 10:30:00', 6, 25000),
(7, '2025-04-17 11:00:00', 7, 19000),
(8, '2025-04-17 11:30:00', 8, 30000),
(9, '2025-04-17 12:00:00', 9, 21000),
(10, '2025-05-04 12:26:33', 10, 63000),
(23, '2025-05-04 11:41:27', 2, 35000);

-- --------------------------------------------------------

--
-- Table structure for table `order_menu`
--

CREATE TABLE `order_menu` (
  `ID` int(11) NOT NULL,
  `order_ID` int(11) NOT NULL,
  `menu_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_menu`
--

INSERT INTO `order_menu` (`ID`, `order_ID`, `menu_ID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 2, 3),
(5, 3, 4),
(6, 3, 5),
(7, 4, 6),
(8, 5, 7),
(9, 5, 8),
(10, 6, 9),
(11, 6, 10),
(12, 7, 1),
(13, 8, 3),
(14, 8, 4),
(15, 9, 5),
(16, 9, 6),
(22, 23, 2),
(23, 23, 3),
(24, 10, 7),
(25, 10, 8),
(26, 10, 9),
(27, 10, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_kategori` (`kategori_ID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_karyawan` (`karyawan_ID`);

--
-- Indexes for table `order_menu`
--
ALTER TABLE `order_menu`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_order` (`order_ID`),
  ADD KEY `FK_menu` (`menu_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_menu`
--
ALTER TABLE `order_menu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `FK_kategori` FOREIGN KEY (`kategori_ID`) REFERENCES `kategori` (`ID`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_karyawan` FOREIGN KEY (`karyawan_ID`) REFERENCES `karyawan` (`ID`),
  ADD CONSTRAINT `FK_pelayan` FOREIGN KEY (`karyawan_ID`) REFERENCES `karyawan` (`ID`);

--
-- Constraints for table `order_menu`
--
ALTER TABLE `order_menu`
  ADD CONSTRAINT `FK_menu` FOREIGN KEY (`menu_ID`) REFERENCES `menu` (`ID`),
  ADD CONSTRAINT `FK_order` FOREIGN KEY (`order_ID`) REFERENCES `order` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
