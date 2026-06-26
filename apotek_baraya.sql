-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jun 26, 2026 at 06:03 PM
-- Server version: 8.0.46
-- PHP Version: 8.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek_baraya`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int NOT NULL,
  `penjualan_id` int NOT NULL,
  `obat_id` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `detail_penjualan`
--
DELIMITER $$
CREATE TRIGGER `kurangi_stok_obat` AFTER INSERT ON `detail_penjualan` FOR EACH ROW BEGIN
    UPDATE obat
    SET stok = stok - NEW.jumlah
    WHERE id = NEW.obat_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log_activity`
--

CREATE TABLE `log_activity` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `action` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int NOT NULL,
  `nama_obat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_obat` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `harga_beli` decimal(10,2) DEFAULT NULL,
  `harga_jual` decimal(10,2) DEFAULT NULL,
  `stok` int DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `satuan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stok_minimum` int DEFAULT '10',
  `rak` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `kategori` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_batch` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `jenis_obat`, `harga_beli`, `harga_jual`, `stok`, `created_at`, `satuan`, `stok_minimum`, `rak`, `expired_date`, `kategori`, `no_batch`) VALUES
(4, 'Paracetamol 500mg', 'Generik', 5000.00, 7500.00, 120, '2026-06-23 17:25:29', 'Tablet', 15, 'A1', '2027-12-15', 'Analgesik', 'BCH-PCT-001'),
(5, 'Amoxicillin 500mg', 'Generik', 12000.00, 15000.00, 80, '2026-06-23 17:25:29', 'Tablet', 20, 'A2', '2027-08-10', 'Antibiotik', 'BCH-AMX-002'),
(6, 'Mylanta Cair 150ml', 'Paten', 15000.00, 18500.00, 25, '2026-06-23 17:25:29', 'Botol', 5, 'B1', '2024-05-12', 'Antasida', 'BCH-MYL-003'),
(7, 'Combantrin Jeruk 10ml', 'Paten', 16000.00, 19800.00, 3, '2026-06-23 17:25:29', 'Botol', 10, 'B2', '2026-09-24', 'Obat Cacing', 'BCH-COM-004'),
(8, 'Panadol Extra', 'Paten', 8500.00, 11000.00, 150, '2026-06-23 17:25:29', 'Strip', 25, 'A1', '2026-05-01', 'Analgesik', 'BCH-PAN-005'),
(9, 'Bodrex Sakit Kepala', 'Paten', 4000.00, 5500.00, 5, '2026-06-23 17:25:29', 'Strip', 15, 'A1', '2028-02-28', 'Analgesik', 'BCH-BOD-006'),
(10, 'Loperamide 2mg', 'Generik', 3500.00, 5000.00, 200, '2026-06-23 17:25:29', 'Tablet', 30, 'C1', '2027-11-20', 'Antidiare', 'BCH-LOP-007'),
(11, 'Betadine Antiseptic 15ml', 'Paten', 9500.00, 12500.00, 45, '2026-06-23 17:25:29', 'Botol', 10, 'D1', '2025-01-15', 'Antiseptik', 'BCH-BET-008'),
(12, 'Decolgen Tablet', 'Paten', 5500.00, 7000.00, 60, '2026-06-23 17:25:29', 'Strip', 15, 'E1', '2026-06-01', 'Obat Flu', 'BCH-DEC-009'),
(13, 'Sanmol Sirup 60ml', 'Paten', 12500.00, 16000.00, 18, '2026-06-23 17:25:29', 'Botol', 5, 'B1', '2027-04-10', 'Analgesik anak', 'BCH-SAN-010'),
(14, 'Cefadroxil 500mg', 'Generik', 18000.00, 23000.00, 90, '2026-06-23 17:25:29', 'Kapsul', 20, 'A2', '2027-10-18', 'Antibiotik', 'BCH-CEF-011'),
(15, 'Insto Eye Drops 7.5ml', 'Paten', 11000.00, 14500.00, 2, '2026-06-23 17:25:29', 'Botol', 8, 'D2', '2025-11-30', 'Obat Mata', 'BCH-INS-012'),
(16, 'OBH Tropica 100ml', 'Paten', 13000.00, 16500.00, 35, '2026-06-23 17:25:29', 'Botol', 10, 'E1', '2026-06-15', 'Obat Batuk', 'BCH-OBH-013'),
(17, 'Salbutamol 2mg', 'Generik', 6000.00, 8000.00, 110, '2026-06-23 17:25:29', 'Tablet', 20, 'C2', '2027-09-05', 'Asma', 'BCH-SAL-014'),
(18, 'Voltaren Gel 20g', 'Paten', 38000.00, 48000.00, 14, '2026-06-23 17:25:29', 'Tube', 5, 'F1', '2025-08-22', 'Topikal Otot', 'BCH-VOL-015');

-- --------------------------------------------------------

--
-- Table structure for table `obat_masuk`
--

CREATE TABLE `obat_masuk` (
  `id` int NOT NULL,
  `obat_id` int NOT NULL,
  `supplier_id` int NOT NULL,
  `jumlah` int NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_kadaluarsa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `obat_masuk`
--
DELIMITER $$
CREATE TRIGGER `tambah_stok_obat` AFTER INSERT ON `obat_masuk` FOR EACH ROW BEGIN
    UPDATE obat
    SET stok = stok + NEW.jumlah
    WHERE id = NEW.obat_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stok_opname`
--

CREATE TABLE `stok_opname` (
  `id` int NOT NULL,
  `obat_id` int NOT NULL,
  `stok_sistem` int NOT NULL,
  `stok_fisik` int NOT NULL,
  `selisih` int NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int NOT NULL,
  `nama_supplier` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `no_telp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','kasir') COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `email`, `created_at`) VALUES
(1, 'Admin', 'admin', 'admin123', 'admin', NULL, '2026-03-10 17:56:12'),
(2, 'Kasir', 'kasir', 'kasir123', 'kasir', NULL, '2026-03-10 17:56:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_id` (`penjualan_id`),
  ADD KEY `obat_id` (`obat_id`);

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat_masuk`
--
ALTER TABLE `obat_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `obat_id` (`obat_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `stok_opname`
--
ALTER TABLE `stok_opname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `obat_masuk`
--
ALTER TABLE `obat_masuk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stok_opname`
--
ALTER TABLE `stok_opname`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`obat_id`) REFERENCES `obat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `obat_masuk`
--
ALTER TABLE `obat_masuk`
  ADD CONSTRAINT `obat_masuk_ibfk_1` FOREIGN KEY (`obat_id`) REFERENCES `obat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `obat_masuk_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
