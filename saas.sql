-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2020 at 01:06 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saas`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `Id_Akun` int(11) NOT NULL,
  `Username` varchar(12) DEFAULT NULL,
  `Password` char(60) NOT NULL,
  `Class` enum('Admin','User') DEFAULT NULL,
  `ID_SISWA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`Id_Akun`, `Username`, `Password`, `Class`, `ID_SISWA`) VALUES
(1, 'favian', '$2y$10$PR/KAVmNZRf9PniX4SK/5.AgjgJ/FsEBnIL57T3kDUMvL6yhiJcyu', 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ayah_siswa`
--

CREATE TABLE `ayah_siswa` (
  `ID` int(11) NOT NULL,
  `NAMA_AYAH` varchar(36) NOT NULL,
  `UMUR_AYAH` int(2) NOT NULL,
  `PEKERJAAN` varchar(24) NOT NULL,
  `PENGHASILAN` int(11) NOT NULL,
  `AGAMA` enum('Islam','Protestan','Hindu','Budha','Katolik') DEFAULT NULL,
  `ALAMAT` varchar(128) NOT NULL,
  `KODE_POS` char(5) NOT NULL,
  `NO_TELP` varchar(12) NOT NULL,
  `ID_SISWA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ayah_siswa`
--

INSERT INTO `ayah_siswa` (`ID`, `NAMA_AYAH`, `UMUR_AYAH`, `PEKERJAAN`, `PENGHASILAN`, `AGAMA`, `ALAMAT`, `KODE_POS`, `NO_TELP`, `ID_SISWA`) VALUES
(1, 'Asep Sobar', 45, 'Karyawan', 2500000, 'Islam', 'Kp. Sukaresmi, Kel. Citeureup RT02/RW14 NO. 51B', '40512', '081312196411', 1);

-- --------------------------------------------------------

--
-- Table structure for table `biodata_siswa`
--

CREATE TABLE `biodata_siswa` (
  `ID` int(11) NOT NULL,
  `NAMA_LENGKAP` varchar(36) NOT NULL,
  `NAMA_PANGGILAN` varchar(12) NOT NULL,
  `KELAS` enum('X-SIJA A','X-SIJA B','XI-SIJA A','XI-SIJA B','XII-SIJA A','XII-SIJA B') DEFAULT NULL,
  `JENIS_KELAMIN` enum('Laki - Laki','Perempuan') DEFAULT NULL,
  `TEMPAT_LAHIR` varchar(24) NOT NULL,
  `TGL_LAHIR` char(10) NOT NULL,
  `ALAMAT_SEKARANG` varchar(128) NOT NULL,
  `KP_AS` char(5) NOT NULL,
  `TLP_AS` char(12) NOT NULL,
  `ALAMAT_LIBUR` varchar(128) NOT NULL,
  `KP_AL` char(5) NOT NULL,
  `TLP_AL` char(12) NOT NULL,
  `HOBBY` varchar(24) NOT NULL,
  `EKSKUL` varchar(24) NOT NULL,
  `GOL_DARAH` enum('A','B','AB','O') DEFAULT NULL,
  `AGAMA` enum('Islam','Protestan','Hindu','Budha','Katolik') DEFAULT NULL,
  `ANAK_KE` int(2) NOT NULL,
  `DARI` int(2) NOT NULL,
  `ASAL_SMP` varchar(24) NOT NULL,
  `FOTO` varchar(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `biodata_siswa`
--

INSERT INTO `biodata_siswa` (`ID`, `NAMA_LENGKAP`, `NAMA_PANGGILAN`, `KELAS`, `JENIS_KELAMIN`, `TEMPAT_LAHIR`, `TGL_LAHIR`, `ALAMAT_SEKARANG`, `KP_AS`, `TLP_AS`, `ALAMAT_LIBUR`, `KP_AL`, `TLP_AL`, `HOBBY`, `EKSKUL`, `GOL_DARAH`, `AGAMA`, `ANAK_KE`, `DARI`, `ASAL_SMP`, `FOTO`) VALUES
(1, 'Favian Ahza', 'Ahza', 'XI-SIJA B', 'Laki - Laki', 'Cimahi', '2003-02-12', 'Kp. Sukaresmi, Kel. Citeureup RT02/RW14 No.51B', '40512', '6629207', 'Hammer C20', '00', '00', 'Membaca', 'OTB', 'O', 'Islam', 1, 2, 'SMP NEGERI 3 CIMAHI', 'Favian_08-12-2019,08;31;22+35.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ibu_siswa`
--

CREATE TABLE `ibu_siswa` (
  `ID` int(11) NOT NULL,
  `NAMA_IBU` varchar(36) NOT NULL,
  `UMUR_IBU` int(2) NOT NULL,
  `PEKERJAAN` varchar(24) NOT NULL,
  `PENGHASILAN` int(11) NOT NULL,
  `AGAMA` enum('Islam','Protestan','Hindu','Budha','Katolik') DEFAULT NULL,
  `ALAMAT` varchar(128) DEFAULT NULL,
  `KODE_POS` char(5) NOT NULL,
  `NO_TELP` varchar(12) NOT NULL,
  `ID_SISWA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ibu_siswa`
--

INSERT INTO `ibu_siswa` (`ID`, `NAMA_IBU`, `UMUR_IBU`, `PEKERJAAN`, `PENGHASILAN`, `AGAMA`, `ALAMAT`, `KODE_POS`, `NO_TELP`, `ID_SISWA`) VALUES
(1, 'Enok Tarmila', 43, 'Karyawan', 1750000, 'Islam', 'Kp. Sukaresmi, Kel. Citeureup RT02/RW14 NO. 51B', '40512', '086566166026', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wali_siswa`
--

CREATE TABLE `wali_siswa` (
  `ID` int(11) NOT NULL,
  `NAMA_WALI` varchar(36) NOT NULL,
  `UMUR_WALI` int(2) NOT NULL,
  `PEKERJAAN` varchar(24) NOT NULL,
  `PENGHASILAN` int(11) NOT NULL,
  `AGAMA` enum('Islam','Protestan','Hindu','Budha','Katolik','--') DEFAULT NULL,
  `ALAMAT` varchar(128) NOT NULL,
  `KODE_POS` char(5) NOT NULL,
  `NO_TELP` varchar(12) NOT NULL,
  `ID_SISWA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wali_siswa`
--

INSERT INTO `wali_siswa` (`ID`, `NAMA_WALI`, `UMUR_WALI`, `PEKERJAAN`, `PENGHASILAN`, `AGAMA`, `ALAMAT`, `KODE_POS`, `NO_TELP`, `ID_SISWA`) VALUES
(1, '--', 0, '--', 0, '--', '--', '--', '--', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`Id_Akun`),
  ADD KEY `id_biodata` (`ID_SISWA`);

--
-- Indexes for table `ayah_siswa`
--
ALTER TABLE `ayah_siswa`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_SISWA` (`ID_SISWA`);

--
-- Indexes for table `biodata_siswa`
--
ALTER TABLE `biodata_siswa`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ibu_siswa`
--
ALTER TABLE `ibu_siswa`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_siswa` (`ID_SISWA`);

--
-- Indexes for table `wali_siswa`
--
ALTER TABLE `wali_siswa`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_SISWA` (`ID_SISWA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `Id_Akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ayah_siswa`
--
ALTER TABLE `ayah_siswa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `biodata_siswa`
--
ALTER TABLE `biodata_siswa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ibu_siswa`
--
ALTER TABLE `ibu_siswa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wali_siswa`
--
ALTER TABLE `wali_siswa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `id_biodata` FOREIGN KEY (`ID_SISWA`) REFERENCES `biodata_siswa` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ayah_siswa`
--
ALTER TABLE `ayah_siswa`
  ADD CONSTRAINT `ayah_siswa_ibfk_1` FOREIGN KEY (`ID_SISWA`) REFERENCES `biodata_siswa` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ibu_siswa`
--
ALTER TABLE `ibu_siswa`
  ADD CONSTRAINT `id_siswa` FOREIGN KEY (`ID_SISWA`) REFERENCES `biodata_siswa` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wali_siswa`
--
ALTER TABLE `wali_siswa`
  ADD CONSTRAINT `wali_siswa_ibfk_1` FOREIGN KEY (`ID_SISWA`) REFERENCES `biodata_siswa` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
