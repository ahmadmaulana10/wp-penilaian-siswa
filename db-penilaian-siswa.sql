-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2019 at 12:30 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-penilaian-siswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nip` char(10) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `tempat_lahir` varchar(35) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(1) NOT NULL,
  `gambar` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `nama_guru`, `tempat_lahir`, `tgl_lahir`, `jk`, `gambar`) VALUES
('1218031001', 'ahmad', 'bogor', '1970-12-04', 'l', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(5) NOT NULL,
  `nama_kelas` varchar(35) NOT NULL,
  `ket` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `ket`) VALUES
(1, 'I', 'Kelas 1'),
(2, 'II', 'Kelas 2'),
(3, 'III', 'Kelas 3'),
(4, 'IV', 'Kelas 4'),
(5, 'V', 'Kelas 5'),
(6, 'VI', 'Kelas 6');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `kode_mapel` char(5) NOT NULL,
  `nama_mapel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`kode_mapel`, `nama_mapel`) VALUES
('00001', 'Bahasa Indonesia'),
('00002', 'Matematika'),
('00003', 'IPA');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` char(10) NOT NULL,
  `nama_siswa` varchar(128) NOT NULL,
  `tempat_lahir` varchar(35) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `agama` varchar(15) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `indonesia` int(100) NOT NULL,
  `matematika` int(100) NOT NULL,
  `ipa` int(100) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `gambar` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nama_siswa`, `tempat_lahir`, `tgl_lahir`, `agama`, `alamat`, `kelas`, `indonesia`, `matematika`, `ipa`, `jk`, `gambar`) VALUES
('9993372001', 'hansen', 'bogor', '2009-12-01', 'konghucu', 'rancabungur', 'I', 90, 85, 80, 'l', 'default.jpg'),
('9993372002', 'ahmad', 'bogor', '2000-12-05', 'islam', 'ciomas', 'I', 85, 80, 60, 'l', 'default.jpg'),
('9993372003', 'tias', 'palembang', '1999-12-19', 'islam', 'ciwaringin', 'II', 90, 75, 85, 'p', 'default.jpg'),
('9993372004', 'budi', 'bogor', '1986-10-05', 'islam', 'dramaga', 'II', 100, 100, 90, 'l', 'default.jpg'),
('9993372005', 'nia', 'bandung', '2001-01-19', 'islam', 'ciawi', 'III', 70, 90, 85, 'p', 'default.jpg'),
('9993372007', 'maulana', 'jakarta', '1999-12-12', 'islam', 'ciapus', 'III', 75, 40, 90, 'l', 'default.jpg'),
('9993372008', 'toni', 'jogjakarta', '1999-10-10', 'kristen', 'ciampea', 'IV', 80, 70, 85, 'l', 'default.jpg'),
('9993372009', 'tasya', 'surabaya', '1998-10-09', 'kristen', 'cibinong', 'IV', 60, 60, 85, 'p', 'default.jpg'),
('9993372010', 'komarudin', 'bandung', '1988-10-09', 'islam', 'cikoneng', 'V', 70, 80, 75, 'l', 'default.jpg'),
('9999999998', 'John Doe', 'Kansas', '1999-12-14', 'kristen', 'Ciomas', 'V', 90, 85, 90, 'l', 'default.jpg'),
('9999999999', 'Ahmad John', 'Bogor', '1998-12-14', 'islam', 'bojong sari', 'VI', 90, 60, 80, 'l', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `tanggal_buat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `gambar`, `password`, `role_id`, `is_active`, `tanggal_buat`) VALUES
(6, 'surya intan permana', 'admin@admin.com', 'pro1576102509.jpg', '$2y$10$vH1e7Tu8xcGcXsXPsxH8JugMpEpnsfS93xs/zlKt2/YYvB/OQ4tem', 1, 1, 1575686859),
(11, 'ahmad maulana', 'ahmadmaulana@gmail.com', 'default.jpg', '$2y$10$K4hZxa8Jzp48DK5JcZU/wOcDOofBLsk96yQZNNwG/PLrBwNwtlKEy', 2, 1, 1576105567),
(12, 'eka wardana', 'ekawardana@gmail.com', 'default.jpg', '$2y$10$QRV1Ac2baCeJ0YQcjD4Zn.K9y/pO/rROqK8bAqZtN82lIjhs.yYpm', 3, 1, 1576105603),
(13, 'agil maulid', 'agilmaulid@gmail.com', 'default.jpg', '$2y$10$MC/uc/QNHoFYhooyH2CVhu27LQKrdHwmGXYnupE44/e76M1ixQ6pO', 2, 1, 1576373076),
(14, 'muhammad hilmi', 'mhilmi@gmail.com', 'default.jpg', '$2y$10$O7sHMcW7A.eZOJvY5m6dme9oxL44PhyLLD3vLatJPz13ZxSybWWMS', 2, 1, 1576373170),
(15, 'rizqi awalullah', 'rizqiawal@gmail.com', 'default.jpg', '$2y$10$TKBqMyaOUk16rUxQp9tiU.VoqmNY1HNC81YFmysgn3Xy59mFLkPay', 2, 1, 1576373190),
(16, 'sri hartini rizkia', 'srihartini@gmail.com', 'default.jpg', '$2y$10$aEi4.rbRjog5SS6o7GvA5eXh8c3HBTpaxloqUN0ltMvmp9H7ELNdu', 2, 1, 1576373225);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `tanggal_buat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `tanggal_buat`) VALUES
(1, 'suryha7fold@gmail.com', 'XHm39CrkiXlqm+FgKxQ+ntzm1qqY0WDtXBXTrHORRWs=', 1575934797),
(2, 'suryha7fold@gmail.com', 'Eo0AAZSe2596MBEv1bZTweuvXoP5844g8lIpkCMmeVM=', 1575979574),
(3, 'suryha7fold@gmail.com', 'yOPaisavxFO0r2jHGCsljR6sb0qK6OaIT/n6u6OQLX0=', 1576101793),
(4, 'ahmadmaulana@gmail.com', '+Qh8+8gNL0eRXnvp2VIlGWRFoB+eHzsMSm6CGLkXo+A=', 1576105567),
(5, 'ekawardana@gmail.com', 'gvmsNX1ow45RRzaVmlGAsGdSDzZYi71qClqTChd2nXE=', 1576105603);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`kode_mapel`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
