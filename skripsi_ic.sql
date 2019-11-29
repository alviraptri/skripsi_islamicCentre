-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2019 at 04:19 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_ic`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `idAbsen` int(11) NOT NULL,
  `idSiswa` int(11) NOT NULL,
  `idJadwal` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `absen` int(11) NOT NULL,
  `statusAbsen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`idAbsen`, `idSiswa`, `idJadwal`, `tanggal`, `absen`, `statusAbsen`) VALUES
(1, 3, 0, '2019-11-19', 1, 1),
(2, 4, 0, '0000-00-00', 1, 1),
(3, 0, 0, '0000-00-00', 0, 1),
(4, 0, 0, '0000-00-00', 0, 1),
(5, 0, 0, '0000-00-00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bukunilai`
--

CREATE TABLE `bukunilai` (
  `idBukuNilai` int(11) NOT NULL,
  `nomorInduk` varchar(50) NOT NULL,
  `idMapel` int(11) NOT NULL,
  `idSiswa` int(11) NOT NULL,
  `idKetNilai` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `statusBukuNilai` bit(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `datasiswa`
--

CREATE TABLE `datasiswa` (
  `idSiswa` int(11) NOT NULL,
  `nomorInduk` varchar(50) NOT NULL,
  `idKelas` int(11) NOT NULL,
  `idTahunAjaran` int(11) NOT NULL,
  `statusSiswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datasiswa`
--

INSERT INTO `datasiswa` (`idSiswa`, `nomorInduk`, `idKelas`, `idTahunAjaran`, `statusSiswa`) VALUES
(1, '0000000001', 1, 1, 1),
(2, '0000000002', 1, 1, 1),
(3, '0000000003', 3, 1, 1),
(4, '0000000004', 3, 1, 1),
(5, '0000000005', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `informasispp`
--

CREATE TABLE `informasispp` (
  `idInfo` int(11) NOT NULL,
  `idSiswa` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `statusInfo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `informasispp`
--

INSERT INTO `informasispp` (`idInfo`, `idSiswa`, `jumlah`, `statusInfo`) VALUES
(1, 1, 1000, 1),
(2, 2, 1000, 1),
(3, 5, 1000, 1),
(4, 1, 1000, 1),
(5, 2, 1000, 1),
(6, 5, 1000, 1),
(7, 1, 1000, 1),
(8, 2, 0, 1),
(9, 5, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `idJadwal` int(11) NOT NULL,
  `idKelas` int(11) NOT NULL,
  `idTahunAjaran` int(11) NOT NULL,
  `nomorInduk` varchar(50) NOT NULL,
  `idMapel` int(11) NOT NULL,
  `hari` varchar(50) NOT NULL,
  `jamMulai` time NOT NULL,
  `jamSelesai` time NOT NULL,
  `statusJadwal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`idJadwal`, `idKelas`, `idTahunAjaran`, `nomorInduk`, `idMapel`, `hari`, `jamMulai`, `jamSelesai`, `statusJadwal`) VALUES
(1, 1, 1, 'NIP0001', 1, 'Senin', '07:00:00', '07:45:00', 1),
(2, 1, 1, 'NIP0002', 2, 'Senin', '09:15:00', '10:00:00', 1),
(3, 3, 1, 'NIP0001', 1, 'Selasa', '07:00:00', '09:15:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `idKelas` int(11) NOT NULL,
  `ketKelas` varchar(50) NOT NULL,
  `jurusanKelas` varchar(50) NOT NULL,
  `nomorKelas` int(11) NOT NULL,
  `statusKelas` bit(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`idKelas`, `ketKelas`, `jurusanKelas`, `nomorKelas`, `statusKelas`) VALUES
(1, 'X', 'IPA', 1, b'01'),
(2, 'X', 'IPS', 2, b'01'),
(3, 'X', 'IPA', 2, b'01'),
(4, 'XI', 'IPS', 2, b'01');

-- --------------------------------------------------------

--
-- Table structure for table `ketnilai`
--

CREATE TABLE `ketnilai` (
  `idKetNilai` int(11) NOT NULL,
  `nomorInduk` varchar(50) NOT NULL,
  `idMapel` int(11) NOT NULL,
  `nilaiSatu` double NOT NULL,
  `nilaiDua` double NOT NULL,
  `nilaiUts` double NOT NULL,
  `nilaiUas` double NOT NULL,
  `statusKetNilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ketnilai`
--

INSERT INTO `ketnilai` (`idKetNilai`, `nomorInduk`, `idMapel`, `nilaiSatu`, `nilaiDua`, `nilaiUts`, `nilaiUas`, `statusKetNilai`) VALUES
(1, 'NIP0001', 1, 10, 15, 35, 40, 1),
(2, 'NIP0002', 2, 15, 15, 20, 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kompetensinilai`
--

CREATE TABLE `kompetensinilai` (
  `idKompetensi` int(11) NOT NULL,
  `idSiswa` int(11) NOT NULL,
  `jenisKompetensi` varchar(50) NOT NULL,
  `nilaiPengembanganDiri` text NOT NULL,
  `bobotKompetensi` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `matapelajaran`
--

CREATE TABLE `matapelajaran` (
  `idMapel` int(11) NOT NULL,
  `idTahunAjaran` int(11) NOT NULL,
  `namaMapel` varchar(100) NOT NULL,
  `statusMapel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matapelajaran`
--

INSERT INTO `matapelajaran` (`idMapel`, `idTahunAjaran`, `namaMapel`, `statusMapel`) VALUES
(1, 1, 'Matematika Peminatan', 1),
(2, 1, 'Bimbingan dan Konseling', 1),
(3, 1, 'Bahasa Arab Qur\'an', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rapor`
--

CREATE TABLE `rapor` (
  `idRapor` int(11) NOT NULL,
  `idWaliKelas` int(11) NOT NULL,
  `idKelas` int(11) NOT NULL,
  `idMapel` int(11) NOT NULL,
  `idBukuNilai` int(11) NOT NULL,
  `idAbsen` int(11) NOT NULL,
  `idKompetensi` int(11) NOT NULL,
  `idSiswa` int(11) NOT NULL,
  `totalNilai` int(11) NOT NULL,
  `statusRapor` bit(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tahunajaran`
--

CREATE TABLE `tahunajaran` (
  `idTahunAjaran` int(11) NOT NULL,
  `tahunAjaran` varchar(100) NOT NULL,
  `statusTahunAjaran` bit(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tahunajaran`
--

INSERT INTO `tahunajaran` (`idTahunAjaran`, `tahunAjaran`, `statusTahunAjaran`) VALUES
(1, 'Tahun Ajaran 2019/2020', b'01'),
(2, 'Tahun Ajaran 2018/2019', b'01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nomorInduk` varchar(50) NOT NULL,
  `userRole` enum('Admin','Guru','Siswa','Wali Kelas','Wali Murid','') NOT NULL,
  `namaUser` varchar(200) NOT NULL,
  `ttlUser` date NOT NULL,
  `emailUser` varchar(100) NOT NULL,
  `noTelp` varchar(12) NOT NULL,
  `alamatUser` text NOT NULL,
  `jenisKelamin` int(11) NOT NULL,
  `passUser` text NOT NULL,
  `gambar` text NOT NULL,
  `statusUser` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nomorInduk`, `userRole`, `namaUser`, `ttlUser`, `emailUser`, `noTelp`, `alamatUser`, `jenisKelamin`, `passUser`, `gambar`, `statusUser`) VALUES
('NIP0001', 'Wali Kelas', 'Yani Suryani, M.Pd', '2010-11-01', 'yani@gmail.com', '021234567891', 'Tangerang', 0, 'e74cce5beeccf5199082f4c43cadfde2', 'Screenshot (4).png', 1),
('NIP0002', 'Guru', 'Sulistiani Herdiyati, S.Pd', '2019-11-01', 'sulistiani@gmail.com', '0121423738', 'Tangerang', 0, 'e74cce5beeccf5199082f4c43cadfde2', 'Screenshot (4).png', 1),
('NIP0003', 'Admin', 'Ghani ', '2019-11-01', 'ghani@gmail.com', '0121423738', 'Tangerang', 1, '12357ae9dd10b849fa1fd8a09a79c867', 'img.jpg', 1),
('NIP0004', 'Wali Kelas', 'Farah Fauzanna, S.Pd', '2019-11-01', 'farah@gmail.com', '0121423738', 'Tangerang', 0, 'e74cce5beeccf5199082f4c43cadfde2', 'picture.jpg', 1),
('NIP0005', 'Wali Kelas', 'Iyan Ihyahunas, S.Kom', '2019-11-01', 'iyan@gmail.com', '0121423738', 'Tangerang', 1, 'e74cce5beeccf5199082f4c43cadfde2', 'img.jpg', 1),
('NIP0006', 'Guru', 'Hasnan, S.Pd', '2019-11-01', 'hasnan@gmail.com', '0121423738', 'Tangerang', 1, 'e74cce5beeccf5199082f4c43cadfde2', 'img.jpg', 1),
('0000000001', 'Siswa', 'Alvira Putri', '1999-01-27', 'alvirap7@gmail.com', '08974110896', 'perumahan griya karawaci block b6 no 11', 0, '732d8cfeeb0c1c8ca06d46cfbf99c665', 'picture.jpg', 1),
('WM001', 'Wali Murid', 'Umila Atma', '1977-06-14', 'atmaumila@gmail.com', '0888123481', 'Griya', 0, '8f669c877c4e990af132c13d6b17425d', 'picture.jpg', 1),
('0000000002', 'Siswa', 'Debora Margareta', '1999-01-27', 'debmargareta@gmail.com', '0812347865', 'kelapa dua', 0, '732d8cfeeb0c1c8ca06d46cfbf99c665', 'picture.jpg', 1),
('WM002', 'Wali Murid', 'Alvira Putri', '1980-01-20', 'alvirap7@gmail.com', '08974110896', 'perumahan griya karawaci block b6 no 11', 0, 'e10adc3949ba59abbe56e057f20f883e', 'picture.jpg', 1),
('NIP0007', 'Guru', 'Empon Kartini, S.Pd', '2019-11-11', 'empon@gmail.com', '08912345678', 'Tangerang', 0, '35e87b08f267759e56f8d3d8f485581f', '9f9122726aadbcf884b1a75f35368ec9.png', 1),
('0000000003', 'Siswa', 'Sanchia Enola', '1998-09-07', 'sanchiaenola@gmail.com', '0812319473', 'Permata', 0, 'e10adc3949ba59abbe56e057f20f883e', '0d1df049763856f438619dc00750102e.jpg', 1),
('0000000004', 'Siswa', 'Velita Windasar', '1997-09-03', 'velwind@gmail.com', '01836438472', 'Kota Bumi', 0, 'e10adc3949ba59abbe56e057f20f883e', '65f202a8367d533c7a14667f53533074.png', 1),
('WM004', 'Wali Murid', 'Velwind', '1997-09-03', 'velwind@gmail.com', '086324623', 'Kota Bumi', 0, 'e10adc3949ba59abbe56e057f20f883e', 'blank-profile-picture-973461_960_720.png', 1),
('0000000005', 'Siswa', 'Eugenius Rudolf Pranoto', '1998-11-15', 'eugenepranoto@gmail.com', '0812347865', 'Ures 2', 1, '732d8cfeeb0c1c8ca06d46cfbf99c665', '09bcf832a86830e435fbb182c94903d6.jpg', 1),
('WM005', 'Wali Murid', 'Bapak Andy', '1998-11-15', 'eugenepranoto@gmail.com', '0812347865', 'batam', 1, '732d8cfeeb0c1c8ca06d46cfbf99c665', '428931.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `walikelas`
--

CREATE TABLE `walikelas` (
  `idWaliKelas` int(11) NOT NULL,
  `nomorInduk` varchar(50) NOT NULL,
  `idKelas` int(11) NOT NULL,
  `statusWaliKelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `walikelas`
--

INSERT INTO `walikelas` (`idWaliKelas`, `nomorInduk`, `idKelas`, `statusWaliKelas`) VALUES
(0, '000021', 2, 1),
(3, 'NIP0001', 3, 1),
(4, 'NIP0004', 4, 1),
(5, 'NIP0005', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `walimurid`
--

CREATE TABLE `walimurid` (
  `idWaliMurid` int(11) NOT NULL,
  `nomorInduk` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `idSiswa` int(11) NOT NULL,
  `statusWaliMurid` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `walimurid`
--

INSERT INTO `walimurid` (`idWaliMurid`, `nomorInduk`, `keterangan`, `idSiswa`, `statusWaliMurid`) VALUES
(1, 'WM001', 'Ibu', 1, 1),
(2, 'WM002', 'Ibu', 2, 1),
(3, 'WM004', 'Ibu', 4, 1),
(4, 'WM005', 'Ayah', 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`idAbsen`);

--
-- Indexes for table `bukunilai`
--
ALTER TABLE `bukunilai`
  ADD PRIMARY KEY (`idBukuNilai`);

--
-- Indexes for table `datasiswa`
--
ALTER TABLE `datasiswa`
  ADD PRIMARY KEY (`idSiswa`);

--
-- Indexes for table `informasispp`
--
ALTER TABLE `informasispp`
  ADD PRIMARY KEY (`idInfo`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`idJadwal`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`idKelas`);

--
-- Indexes for table `ketnilai`
--
ALTER TABLE `ketnilai`
  ADD PRIMARY KEY (`idKetNilai`);

--
-- Indexes for table `kompetensinilai`
--
ALTER TABLE `kompetensinilai`
  ADD PRIMARY KEY (`idKompetensi`);

--
-- Indexes for table `matapelajaran`
--
ALTER TABLE `matapelajaran`
  ADD PRIMARY KEY (`idMapel`);

--
-- Indexes for table `rapor`
--
ALTER TABLE `rapor`
  ADD PRIMARY KEY (`idRapor`);

--
-- Indexes for table `tahunajaran`
--
ALTER TABLE `tahunajaran`
  ADD PRIMARY KEY (`idTahunAjaran`);

--
-- Indexes for table `walikelas`
--
ALTER TABLE `walikelas`
  ADD PRIMARY KEY (`idWaliKelas`);

--
-- Indexes for table `walimurid`
--
ALTER TABLE `walimurid`
  ADD PRIMARY KEY (`idWaliMurid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `idAbsen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bukunilai`
--
ALTER TABLE `bukunilai`
  MODIFY `idBukuNilai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `datasiswa`
--
ALTER TABLE `datasiswa`
  MODIFY `idSiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `informasispp`
--
ALTER TABLE `informasispp`
  MODIFY `idInfo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `idJadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `idKelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ketnilai`
--
ALTER TABLE `ketnilai`
  MODIFY `idKetNilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kompetensinilai`
--
ALTER TABLE `kompetensinilai`
  MODIFY `idKompetensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matapelajaran`
--
ALTER TABLE `matapelajaran`
  MODIFY `idMapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rapor`
--
ALTER TABLE `rapor`
  MODIFY `idRapor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahunajaran`
--
ALTER TABLE `tahunajaran`
  MODIFY `idTahunAjaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `walikelas`
--
ALTER TABLE `walikelas`
  MODIFY `idWaliKelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `walimurid`
--
ALTER TABLE `walimurid`
  MODIFY `idWaliMurid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
