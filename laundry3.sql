-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 05:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry3`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(12) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_name`, `phone`, `alamat`, `create_at`, `update_at`) VALUES
(4, 'oji yimeng', '434544', 'Tegal Alur', '2024-11-20 04:01:58', '2024-11-20 08:34:39'),
(5, 'Rudi Ruyatno', '783493450', 'Parang Tegal', '2024-11-21 04:26:37', '2024-11-21 04:26:37'),
(6, 'Rizky Balistik', '5467898', 'Uhledar', '2024-11-21 06:58:25', '2024-11-21 06:58:25'),
(7, 'Edwars Mujaer', '5456776878', 'Rock Bottom', '2024-11-21 07:09:13', '2024-11-21 07:09:13'),
(8, 'achmat Tornado', '09823423', 'jakarta', '2024-11-23 05:35:11', '2024-11-23 05:35:11');

-- --------------------------------------------------------

--
-- Table structure for table `detail_trans_order`
--

CREATE TABLE `detail_trans_order` (
  `id` int(12) NOT NULL,
  `id_order` int(12) DEFAULT NULL,
  `id_service` int(12) DEFAULT NULL,
  `qty` int(12) NOT NULL,
  `subtotal` varchar(50) NOT NULL,
  `note` varchar(50) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_trans_order`
--

INSERT INTO `detail_trans_order` (`id`, `id_order`, `id_service`, `qty`, `subtotal`, `note`, `create_at`, `update_at`) VALUES
(75, 82, 3, 4, '28000', '', '2024-12-02 08:12:08', '2024-12-02 08:12:08'),
(76, 83, 3, 1, '7000', '', '2024-12-02 08:46:46', '2024-12-02 08:46:46'),
(77, 83, 2, 1, '5000', '', '2024-12-02 08:46:46', '2024-12-02 08:46:46'),
(101, 98, 2, 3, '24000', '', '2024-12-02 16:01:35', '2024-12-02 16:01:35'),
(102, 98, 2, 3, '24000', '', '2024-12-02 16:01:35', '2024-12-02 16:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(12) NOT NULL,
  `nama_level` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `nama_level`, `created_at`, `update_at`) VALUES
(1, 'administrator', '2024-11-13 06:20:18', '2024-11-13 06:20:18'),
(2, 'operator', '2024-11-13 06:20:18', '2024-11-13 06:20:18'),
(3, 'pimpinan', '2024-11-15 01:58:33', '2024-12-02 15:20:35');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(50) NOT NULL,
  `service_name` text NOT NULL,
  `harga` int(50) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `service_name`, `harga`, `deskripsi`, `create_at`, `update_at`) VALUES
(2, 'Cuci & Setrika', 8000, 'Harga Untuk Cuci Sekaligus Setrika', '2024-11-15 04:48:52', '2024-12-02 13:12:31'),
(3, 'Hanya Cusi', 6000, 'Hanya Cuci Saja', '2024-11-15 08:24:29', '2024-12-02 13:13:04'),
(4, 'Hanya Setrika', 6500, 'Harga Untuk Setrika', '2024-12-02 13:25:59', '2024-12-02 13:25:59'),
(5, 'Laundry besar ', 15000, 'Laundry Barang Berat/Besar seperti selimut, karpet', '2024-12-02 13:27:02', '2024-12-02 13:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `trans_laundry_pickup`
--

CREATE TABLE `trans_laundry_pickup` (
  `id` int(12) NOT NULL,
  `id_customer` int(12) NOT NULL,
  `id_order` int(12) NOT NULL,
  `pickup_date` date NOT NULL,
  `pickup_pay` double(10,2) NOT NULL,
  `pickup_change` double(10,2) NOT NULL,
  `note` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_laundry_pickup`
--

INSERT INTO `trans_laundry_pickup` (`id`, `id_customer`, `id_order`, `pickup_date`, `pickup_pay`, `pickup_change`, `note`, `create_at`, `update_at`) VALUES
(11, 8, 74, '2024-11-23', 30000.00, 9000.00, '', '2024-11-23 05:40:11', '2024-11-23 05:40:11'),
(12, 4, 76, '2024-11-30', 7000.00, -29000.00, '', '2024-11-30 17:50:04', '2024-11-30 17:50:04'),
(13, 6, 78, '2024-12-01', 40000.00, 4000.00, '', '2024-12-01 11:53:29', '2024-12-01 11:53:29'),
(14, 7, 87, '2024-12-02', 40000.00, 9000.00, '', '2024-12-02 13:33:17', '2024-12-02 13:33:17'),
(15, 6, 83, '2024-12-02', 40000.00, 28000.00, '', '2024-12-02 13:48:48', '2024-12-02 13:48:48'),
(16, 5, 82, '2024-12-02', 0.00, 0.00, '', '2024-12-02 14:56:17', '2024-12-02 14:56:17'),
(17, 7, 96, '2024-12-02', 0.00, 0.00, '', '2024-12-02 14:58:57', '2024-12-02 14:58:57'),
(18, 4, 98, '2024-12-02', 0.00, 0.00, '', '2024-12-02 16:01:58', '2024-12-02 16:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `trans_order`
--

CREATE TABLE `trans_order` (
  `id` int(11) NOT NULL,
  `id_customer` int(12) NOT NULL,
  `order_code` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `order_date` varchar(50) NOT NULL,
  `order_end_date` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_pay` varchar(50) NOT NULL,
  `order_change` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_order`
--

INSERT INTO `trans_order` (`id`, `id_customer`, `order_code`, `status`, `order_date`, `order_end_date`, `keterangan`, `create_at`, `update_at`, `order_pay`, `order_change`) VALUES
(82, 5, '#INV0212202400080', 1, '2024-12-07', '2024-12-26', '', '2024-12-02 08:12:08', '2024-12-02 14:56:17', '60000', '32000'),
(83, 6, '#INV0212202400083', 1, '2024-12-12', '2024-12-18', '', '2024-12-02 08:46:46', '2024-12-02 13:48:48', '50000', '38000'),
(98, 4, '#INV/02122024/00084', 1, '2024-12-27', '2024-12-10', '', '2024-12-02 16:01:35', '2024-12-02 16:01:58', '60000', '12000');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(12) NOT NULL,
  `id_level` int(12) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_level`, `nama`, `email`, `username`, `password`, `create_at`, `update_at`) VALUES
(1, 1, 'admin', 'admin@gmail.com', 'admin', '123', '2024-11-13 06:43:42', '2024-11-13 06:43:42'),
(3, 2, 'operator', 'operator@gmail.com', 'operator', '1234', '2024-11-13 08:26:36', '2024-11-13 08:26:36'),
(9, 3, 'pimpinan', 'pimpinan@gmail.com', '', '123', '2024-11-15 03:33:14', '2024-11-15 03:33:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_trans_order`
--
ALTER TABLE `detail_trans_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_service` (`id_service`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_laundry_pickup`
--
ALTER TABLE `trans_laundry_pickup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_order`
--
ALTER TABLE `trans_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_level` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail_trans_order`
--
ALTER TABLE `detail_trans_order`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trans_laundry_pickup`
--
ALTER TABLE `trans_laundry_pickup`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `trans_order`
--
ALTER TABLE `trans_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_trans_order`
--
ALTER TABLE `detail_trans_order`
  ADD CONSTRAINT `detail_trans_order_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `trans_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_trans_order_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `service` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `id_level_to_level` FOREIGN KEY (`id_level`) REFERENCES `level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
