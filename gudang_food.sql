-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2024 at 08:07 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudang_food`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_area_gudang`
--

CREATE TABLE `tbl_area_gudang` (
  `id_area_gudang` int(11) NOT NULL,
  `jenis_gudang` varchar(50) NOT NULL,
  `nama_area` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_area_gudang`
--

INSERT INTO `tbl_area_gudang` (`id_area_gudang`, `jenis_gudang`, `nama_area`) VALUES
(1, 'Gudang Besar', 'ATK'),
(2, 'Gudang Besar', 'Sticker'),
(3, 'Gudang Besar', 'Plastik'),
(4, 'Gudang Besar', 'Kaleng'),
(5, 'Gudang Besar', 'Kardus'),
(6, 'Gudang Mekanik', 'Gudang Mekanik'),
(7, 'Gudang Besar', 'Titipan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departement`
--

CREATE TABLE `tbl_departement` (
  `id_department` varchar(255) NOT NULL,
  `nama_departement` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_departement`
--

INSERT INTO `tbl_departement` (`id_department`, `nama_departement`) VALUES
('1', 'PAYROLL'),
('2', 'FINANCE DAN COSTING'),
('3', 'IT'),
('4', 'HRD'),
('5', 'AUDIT'),
('6', 'PURCHASING'),
('7', 'BAHAN BAKU '),
('8', 'QMS'),
('9', 'GA'),
('10', 'MINA ARUNA (BRAND)'),
('11', 'MINA ARUNA (NON BRAND)'),
('12', 'INTERNATIONAL MARKETING'),
('13', 'SECURITY'),
('14', 'Gudang Besar'),
('15', 'Gudang Mekanik'),
('16', 'Gudang Andalan Nelayan Indonesia'),
('17', 'Workshop'),
('18', 'Finance'),
('19', 'Marketing Lokal'),
('20', 'Kendaraan'),
('21', 'PPIC'),
('22', 'Exim'),
('23', 'RND'),
('24', 'IT Programmer'),
('25', 'Produksi'),
('26', 'Lab'),
('27', 'Utility'),
('28', 'Kebersihan'),
('29', 'Management'),
('30', 'Quality Control (QC)'),
('31', 'Programmer'),
('32', 'PBB'),
('33', 'ColdRoom'),
('34', 'Shrimp'),
('35', 'Sipil'),
('36', 'MT'),
('37', 'Akuntan Medan'),
('38', 'Kapal'),
('39', 'Hrd Office');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permintaan_barang`
--

CREATE TABLE `tbl_permintaan_barang` (
  `id_permintaan_barang` varchar(255) DEFAULT NULL,
  `nomor_resi` varchar(255) DEFAULT NULL,
  `nomor_surat` varchar(255) DEFAULT NULL,
  `id_area_gudang` varchar(100) DEFAULT NULL,
  `encrtypt_id` varchar(255) DEFAULT NULL,
  `id_department` varchar(255) DEFAULT NULL,
  `inputed_by` varchar(255) DEFAULT NULL,
  `aproved_by` varchar(255) DEFAULT NULL,
  `gudang_by` varchar(100) DEFAULT NULL,
  `waktu_input` datetime DEFAULT NULL,
  `waktu_approve` datetime DEFAULT NULL,
  `waktu_gudang` datetime DEFAULT NULL,
  `waktu_terima` datetime DEFAULT NULL,
  `jumlah_revisi` int(11) DEFAULT NULL,
  `tgl_input` date DEFAULT NULL,
  `tgl_approve` date DEFAULT NULL,
  `tgl_terima` date DEFAULT NULL,
  `tgl_gudang` date DEFAULT NULL,
  `status` enum('Dibatalkan','Diajukan','Diapprove','Diterima','Selesai','Revisi','Dilanjutkan') DEFAULT 'Dilanjutkan',
  `note` varchar(100) DEFAULT NULL,
  `note_resi` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rack`
--

CREATE TABLE `tbl_rack` (
  `id_rack` int(11) NOT NULL,
  `id_area_gudang` int(11) NOT NULL,
  `nama_rack` varchar(20) NOT NULL,
  `no_rack` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rack`
--

INSERT INTO `tbl_rack` (`id_rack`, `id_area_gudang`, `nama_rack`, `no_rack`) VALUES
(3, 2, 'A.01', 1),
(4, 2, 'B.01', 12),
(5, 3, 'A.23', 4),
(6, 4, 'A.AB', 1),
(7, 7, 'A.BB', 5),
(8, 4, 'A.AB', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id_role`, `nama_role`) VALUES
(1, 'superadmin'),
(2, 'kepala gudang'),
(3, 'user request'),
(4, 'atasan'),
(5, 'staff purchasing                                                                                                                                                                                                                                          '),
(6, 'admin purchasing'),
(7, 'adm ATK GUDANG'),
(8, 'adm Stiker GUDANG'),
(9, 'adm Penolong Gudang'),
(10, 'adm plastik Gudang'),
(11, 'adm kaleng & tutup Gudang'),
(12, 'adm kardus Gudang'),
(13, 'adm LPB Gudang');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_satuan`
--

CREATE TABLE `tbl_satuan` (
  `id_satuan` int(11) NOT NULL,
  `satuan` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`id_satuan`, `satuan`) VALUES
(1, 'BOX'),
(2, 'JS'),
(3, 'BAG'),
(4, 'BAK'),
(5, 'BALL'),
(6, 'BATANG'),
(7, 'BKS'),
(8, 'BO'),
(9, 'BOTOL '),
(10, 'BOX'),
(11, 'BTG'),
(12, 'BTL'),
(13, 'BUAH'),
(14, 'BUKU'),
(15, 'BUNGKUS'),
(16, 'BX'),
(17, 'CA'),
(18, 'CAN'),
(19, 'CARTON'),
(20, 'CM'),
(21, 'CYLINDER'),
(22, 'DERIGEN'),
(23, 'DIRIGEN'),
(24, 'DOS'),
(25, 'DOZEN'),
(26, 'DRG'),
(27, 'DRIGEN'),
(28, 'DRM'),
(29, 'DRUM'),
(30, 'DUS'),
(31, 'EKOR'),
(32, 'GALON'),
(33, 'GLN'),
(34, 'GRAM'),
(35, 'IKAT'),
(36, 'JERIGEN'),
(37, 'JRG'),
(38, 'KALENG'),
(39, 'KARUNG'),
(40, 'KB'),
(41, 'KG'),
(42, 'KGM'),
(43, 'KIT'),
(44, 'KLG'),
(45, 'KOTAK'),
(46, 'KRAT'),
(47, 'KRN'),
(48, 'KTK'),
(49, 'KUBIK'),
(50, 'LBR'),
(51, 'LEMBAR'),
(52, 'M2'),
(53, 'LITER'),
(54, 'LMBR'),
(55, 'LOT'),
(56, 'LSN'),
(57, 'LTR'),
(58, 'LUSING'),
(59, 'M3'),
(60, 'MERCK'),
(61, 'METER'),
(62, 'MTR'),
(63, 'PAIL'),
(64, 'pak'),
(65, 'PASANG'),
(66, 'PCS'),
(67, 'PCK'),
(68, 'PCSS'),
(69, 'PCE'),
(70, 'PL'),
(71, 'PLSTIK'),
(72, 'PSC'),
(73, 'PSG'),
(74, 'RAK'),
(75, 'RENCENG'),
(76, 'RIM'),
(77, 'ROLL'),
(78, 'RTG'),
(79, 'SAK'),
(80, 'SET'),
(81, 'SLOP'),
(82, 'STRIP'),
(83, 'TABUNG'),
(84, 'TANGKI'),
(85, 'TBG'),
(86, 'TN'),
(87, 'TON'),
(88, 'TUBE'),
(89, 'UNT'),
(90, 'GB'),
(91, 'orang'),
(92, 'test taufik'),
(93, 'test taufik2'),
(94, 'Kodi'),
(95, 'UNIT');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suplier_barang`
--

CREATE TABLE `tbl_suplier_barang` (
  `id_suplier_barang` varchar(255) NOT NULL,
  `kode_suplier_barang` varchar(255) DEFAULT NULL,
  `no_urut_suplier_barang` varchar(255) DEFAULT NULL,
  `nama_suplier_barang` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `no_rek` varchar(255) DEFAULT NULL,
  `nama_rekening` varchar(255) DEFAULT NULL,
  `no_npwp` varchar(255) DEFAULT NULL,
  `telp_ekstensi` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `link_map` varchar(255) DEFAULT NULL,
  `tgl_input` date DEFAULT NULL,
  `status` enum('Aktif','Non Aktif') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_pengguna` varchar(25) NOT NULL,
  `nama_pengguna` varchar(25) NOT NULL,
  `nama_lengkap` varchar(25) NOT NULL,
  `password` varchar(256) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `hak_akses` enum('1','0') NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_departement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_pengguna`, `nama_pengguna`, `nama_lengkap`, `password`, `status`, `hak_akses`, `id_role`, `id_departement`) VALUES
('USER0043', 'superadmin', 'Superadmin', '$2y$10$ahvFhg.Lqy.xHw8a1Mi3Wud7aZx9PSKrpxM2I3Mz52DbK0RS4CKuG', '1', '1', 0, NULL),
('USER0046', 'admin', 'admin', '$2y$10$IO8wH1j1rXBOT8v.0avfTOpgWG6W8AXwxWGRP/HmwI8tMO6DOm8Lq', '1', '0', 0, NULL),
('USER0047', 'taufik', 'taufik', '$2y$10$icOI9fDbRfVqYk4qQDdV7O6INuEZK5kQwFBNGW0mbQN.DU0Aw4h2q', '', '1', 7, 14),
('USER0048', 'adeade', 'ade', '$2y$10$Mj62i8DkDnoPI2LLvz8vzekwZ0eAXVy2L2dbW045fF760IShhg.YS', '', '1', 6, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_area_gudang`
--
ALTER TABLE `tbl_area_gudang`
  ADD PRIMARY KEY (`id_area_gudang`);

--
-- Indexes for table `tbl_departement`
--
ALTER TABLE `tbl_departement`
  ADD PRIMARY KEY (`id_department`);

--
-- Indexes for table `tbl_rack`
--
ALTER TABLE `tbl_rack`
  ADD PRIMARY KEY (`id_rack`),
  ADD KEY `id_area_gudang` (`id_area_gudang`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `tbl_suplier_barang`
--
ALTER TABLE `tbl_suplier_barang`
  ADD PRIMARY KEY (`id_suplier_barang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_area_gudang`
--
ALTER TABLE `tbl_area_gudang`
  MODIFY `id_area_gudang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_rack`
--
ALTER TABLE `tbl_rack`
  MODIFY `id_rack` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_rack`
--
ALTER TABLE `tbl_rack`
  ADD CONSTRAINT `tbl_rack_ibfk_1` FOREIGN KEY (`id_area_gudang`) REFERENCES `tbl_area_gudang` (`id_area_gudang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
