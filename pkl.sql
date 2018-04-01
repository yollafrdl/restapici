-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2018 at 03:39 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_nc`
--

CREATE TABLE `admin_nc` (
  `id_anc` int(11) NOT NULL,
  `username_anc` varchar(255) NOT NULL,
  `password_anc` varchar(255) NOT NULL,
  `nama_anc` varchar(255) NOT NULL,
  `alamat_anc` varchar(255) NOT NULL,
  `telp_anc` varchar(255) NOT NULL,
  `status_anc` varchar(255) NOT NULL,
  `foto_profil` varchar(255) NOT NULL,
  `foto_bukti_nc` varchar(255) NOT NULL,
  `id_sa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_nc`
--

INSERT INTO `admin_nc` (`id_anc`, `username_anc`, `password_anc`, `nama_anc`, `alamat_anc`, `telp_anc`, `status_anc`, `foto_profil`, `foto_bukti_nc`, `id_sa`) VALUES
(1, 'cobajuga', '123', 'coba', 'coba', '0111', 'coba', 'coba', 'coba', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `tanggal` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `id_sa` int(11) NOT NULL,
  `nama_sa` varchar(255) NOT NULL,
  `username_sa` varchar(255) NOT NULL,
  `password_sa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`id_sa`, `nama_sa`, `username_sa`, `password_sa`) VALUES
(1, 'coba', 'coba', '123');

-- --------------------------------------------------------

--
-- Table structure for table `timbangan`
--

CREATE TABLE `timbangan` (
  `tanggal` date NOT NULL,
  `berat_badan` float NOT NULL,
  `lemak_tubuh` float NOT NULL,
  `kadar_air` float NOT NULL,
  `masa_otot` float NOT NULL,
  `rating_fisik` float NOT NULL,
  `usia_sel` float NOT NULL,
  `kepadatan_tulang` float NOT NULL,
  `lemak_perut` float NOT NULL,
  `bmr` float NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username_user` varchar(255) NOT NULL,
  `password_user` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `alamat_user` varchar(255) NOT NULL,
  `telp_user` varchar(255) NOT NULL,
  `status_user` varchar(255) NOT NULL,
  `id_anc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_nc`
--
ALTER TABLE `admin_nc`
  ADD PRIMARY KEY (`id_anc`),
  ADD KEY `id_sa` (`id_sa`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`id_sa`);

--
-- Indexes for table `timbangan`
--
ALTER TABLE `timbangan`
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_anc` (`id_anc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_nc`
--
ALTER TABLE `admin_nc`
  MODIFY `id_anc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `id_sa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_nc`
--
ALTER TABLE `admin_nc`
  ADD CONSTRAINT `admin_nc_ibfk_1` FOREIGN KEY (`id_sa`) REFERENCES `super_admin` (`id_sa`);

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `timbangan`
--
ALTER TABLE `timbangan`
  ADD CONSTRAINT `timbangan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_anc`) REFERENCES `admin_nc` (`id_anc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
