-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2024 at 04:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `quan_tri_vien`
--

CREATE DATABASE `my_db` CHARACTER
SET
  utf8mb4 COLLATE utf8mb4_unicode_ci;

use `my_db`;

CREATE TABLE `quan_tri_vien` (
  `id` int(11) NOT NULL,
  `ten_dang_nhap` varchar(30) NOT NULL,
  `mat_khau` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ho_ten` varchar(50) NOT NULL,
  `lan_dang_nhap_cuoi` datetime DEFAULT NULL
);

--
-- Dumping data for table `quan_tri_vien`
--

INSERT INTO `quan_tri_vien` (`id`, `ten_dang_nhap`, `mat_khau`, `email`, `ho_ten`, `lan_dang_nhap_cuoi`) VALUES
(1, 'nvan', 'b24331b1a138cde62aa1f679164fc62f', 'nvan@caothang.edu.vn', 'Nguyễn Văn An', '2024-06-30 21:15:30');

-- --------------------------------------------------------

--
-- Table structure for table `sinh_vien`
--

CREATE TABLE `sinh_vien` (
  `mssv` varchar(10) NOT NULL,
  `mat_khau` varchar(32) NOT NULL,
  `ho_ten` varchar(50) NOT NULL,
  `ngay_sinh` date NOT NULL,
  `gioi_tinh` tinyint(1) NOT NULL,
  `cccd` varchar(12) NOT NULL,
  `sdt` varchar(11) NOT NULL,
  `noi_sinh` varchar(50) NOT NULL,
  `dia_chi` varchar(250) NOT NULL
);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quan_tri_vien`
--
ALTER TABLE `quan_tri_vien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sinh_vien`
--
ALTER TABLE `sinh_vien`
  ADD PRIMARY KEY (`mssv`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quan_tri_vien`
--
ALTER TABLE `quan_tri_vien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
