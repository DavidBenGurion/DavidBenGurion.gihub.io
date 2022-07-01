-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2022 at 09:40 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokovape`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kode_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kode_kategori`, `nama_kategori`) VALUES
(8, 'Vape'),
(10, 'Liquid'),
(11, 'Coiler'),
(12, 'Mod');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `kode_keranjang` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `kode_sesi` varchar(100) NOT NULL,
  `kode_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`kode_keranjang`, `id_user`, `kode_sesi`, `kode_produk`, `jumlah`, `harga`, `subtotal`) VALUES
(51, 1, '', 13, 1, 900000, 900000);

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`id_user`, `nama`, `username`, `password`, `no_hp`) VALUES
(1, 'kopi', 'kopi', '01c92d3c5e470cbc71b8a461b0ecff53', '12345'),
(2, 'alpukat', 'alpukat', '54c6b9c06fd514cd4f8cfe88c64c2b06', '12345'),
(3, 'teh', 'teh', '38b5a6b9dafc7fc2955561cd08fe1f77', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `nomor` varchar(20) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `provinsi` int(11) NOT NULL DEFAULT 0,
  `kota` int(11) NOT NULL DEFAULT 0,
  `kurir` varchar(50) NOT NULL,
  `ongkir` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL DEFAULT 0,
  `status_penjualan` int(1) NOT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`nomor`, `tanggal`, `id_user`, `nama`, `nohp`, `alamat`, `provinsi`, `kota`, `kurir`, `ongkir`, `total`, `status_penjualan`, `bukti_transfer`) VALUES
('20220630-001', '2022-06-30 17:27:27', 1, 'kopi', '12345', 'asd', 12, 61, 'tiki', 19000, 919000, 0, 'buktiTransfer.jpg'),
('20220630-002', '2022-06-30 17:28:34', 1, 'kopi', '12345', 'asdasd', 16, 311, 'jne', 88000, 988000, 0, 'buktiTransfer.jpg'),
('20220630-003', '2022-06-30 18:26:25', 3, 'teh', '1234', 'Jl.urayBawadi  Komplek Gloria', 12, 364, 'jne', 11000, 1811000, 0, 'buktiTransfer.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id` int(11) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `kode_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id`, `nomor`, `kode_produk`, `jumlah`, `harga`, `subtotal`) VALUES
(57, '20220630-001', 14, 1, 950000, 950000),
(58, '20220630-001', 14, 1, 950000, 950000),
(59, '20220630-007', 13, 1, 900000, 900000),
(60, '20220630-020', 13, 1, 900000, 900000),
(61, '20220630-038', 14, 1, 950000, 950000),
(62, '20220630-001', 13, 1, 900000, 900000),
(63, '20220630-002', 13, 1, 900000, 900000),
(64, '20220630-003', 13, 1, 900000, 900000),
(65, '20220630-001', 13, 3, 900000, 2700000),
(66, '20220630-001', 13, 1, 900000, 900000),
(67, '20220630-002', 13, 1, 900000, 900000),
(68, '20220630-003', 13, 2, 900000, 1800000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `kode_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `kode_kategori` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` text NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`kode_produk`, `nama_produk`, `kode_kategori`, `harga`, `foto`, `deskripsi`) VALUES
(13, 'Vape Cigalkie', 8, 900000, 'vape_Cigalkie.jpg', 'Vape Cigalkie Rasakan Sensasinya\r\n'),
(14, 'vape pen', 8, 950000, 'vape pen.jpg', 'Ngebul dengan vape pen, rasakan sensasinya!!!'),
(15, 'Vape Mod', 8, 100000, 'vape_mod.jfif', 'Vape Mod mengembul semakin lancar !'),
(16, 'Liquid Paradewa', 10, 20000, 'Paradewa-Liquid.jpg', 'Jual Liquid Para dewa By R Craft X Qorygore. Liquid lokal Indonesia ini hadir dengan rasa Apple Merah memberikan kesan fruity yang menyegarkan'),
(17, 'YB This Liquid Sucks ', 10, 450000, 'this liquid Sucks.jpg', 'THIS LIQUID SUCKS 60ML by YB Reza Arap ybrap x ORA Brewery x Vape On - Freebase nic 3mg / 6mg'),
(18, 'Upods Liquid', 10, 300000, 'Upods Liquid.jpg', 'Upods adalah produsen pods ternama di Indonesia. Tak hanya pods saja, Upods ternyata juga memiliki liquid vape khusus pods. Indonesian Tobacco Kretek dari Upods adalah rasa yang cukup unik.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('User','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `password`, `level`) VALUES
('admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`kode_keranjang`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kode_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kode_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `kode_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `kode_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
