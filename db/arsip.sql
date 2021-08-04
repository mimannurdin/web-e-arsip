-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2019 at 09:54 PM
-- Server version: 10.3.14-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsip`
--

CREATE TABLE `arsip` (
  `id_arsip` int(11) NOT NULL,
  `dari_kepada` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `tgl_surat` date NOT NULL,
  `indeks` varchar(100) NOT NULL,
  `no_urut` int(11) NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `tgl_simpan` date NOT NULL,
  `jenis_surat` enum('M','K') NOT NULL,
  `id_user` int(11) NOT NULL,
  `kerahasiaan` enum('B','R','SR') NOT NULL,
  `sistem_simpan` enum('abjad','kronologi','wilayah') NOT NULL,
  `kode_simpan` varchar(100) NOT NULL DEFAULT '',
  `isi_ringkasan` text NOT NULL,
  `catatan` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `arsip`
--

INSERT INTO `arsip` (`id_arsip`, `dari_kepada`, `alamat`, `kota`, `no_surat`, `tgl_surat`, `indeks`, `no_urut`, `perihal`, `tgl_simpan`, `jenis_surat`, `id_user`, `kerahasiaan`, `sistem_simpan`, `kode_simpan`, `isi_ringkasan`, `catatan`) VALUES
(1, 'Muhammad Bagus Zulmi', 'Jl. Raya Lontar', 'Surabaya', 'CS/2019/05/02', '2019-05-01', 'MBZ', 9, 'Cuti sehat', '2019-05-01', 'M', 1, 'B', 'abjad', 'a-z', 'Test ringkasan', 'Test catatan'),
(2, 'anna', 'terusan surabya', 'Surabaya', '12/AD/111', '2019-05-08', 'AA', 1, 'Pegawai', '2019-05-03', 'M', 1, 'B', 'abjad', 'An', 'sbnnsxcsn', 'jnsxn');

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE `disposisi` (
  `id_disposisi` int(11) NOT NULL,
  `tgl_terima` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `id_arsip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kembali_arsip`
--

CREATE TABLE `kembali_arsip` (
  `id_kembali` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `kondisi_kembali` enum('bagus','sedang','kurang') NOT NULL,
  `id_pinjam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `kembali_arsip`
--

INSERT INTO `kembali_arsip` (`id_kembali`, `tgl_kembali`, `kondisi_kembali`, `id_pinjam`) VALUES
(1, '2019-05-03', 'sedang', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lampiran`
--

CREATE TABLE `lampiran` (
  `id_lampiran` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `id_arsip` int(11) NOT NULL,
  `tgl_buat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lampiran`
--

INSERT INTO `lampiran` (`id_lampiran`, `nama_file`, `id_arsip`, `tgl_buat`, `tgl_update`) VALUES
(2, 'Soal-Negara-dan-Konstitusi-190502203656.pdf', 1, '2019-05-02 13:36:56', '0000-00-00 00:00:00'),
(3, 'modul_1_-_grafkom_-_hr-190503005627.pdf', 1, '2019-05-02 17:56:27', '0000-00-00 00:00:00'),
(5, 'modul_1_-_grafkom_-_hr-190503171920.pdf', 2, '2019-05-03 10:19:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam_arsip`
--

CREATE TABLE `pinjam_arsip` (
  `id_pinjam` int(11) NOT NULL,
  `id_arsip` int(11) NOT NULL,
  `nama_peminjam` varchar(100) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `batas_waktu` date NOT NULL,
  `kondisi_pinjam` enum('bagus','sedang','kurang') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `pinjam_arsip`
--

INSERT INTO `pinjam_arsip` (`id_pinjam`, `id_arsip`, `nama_peminjam`, `tgl_pinjam`, `batas_waktu`, `kondisi_pinjam`) VALUES
(1, 1, 'Muhammad Bagus', '2019-05-03', '2019-05-10', 'bagus');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` char(40) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `unit` enum('kepegawaian','umum','keuangan') NOT NULL,
  `foto_profil` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `unit`, `foto_profil`) VALUES
(1, 'mbaguszulmi', 'bfd3715e8ca9a78482f8ebf0feba83ea622072bf', 'Muhammad Bagus Zulmi', 'keuangan', '0');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pinjam`
-- (See below for the actual view)
--
CREATE TABLE `v_pinjam` (
`id_pinjam` int(11)
,`id_arsip` int(11)
,`nama_peminjam` varchar(100)
,`tgl_pinjam` date
,`batas_waktu` date
,`kondisi_pinjam` enum('bagus','sedang','kurang')
,`tgl_kembali` date
,`kondisi_kembali` enum('bagus','sedang','kurang')
);

-- --------------------------------------------------------

--
-- Structure for view `v_pinjam`
--
DROP TABLE IF EXISTS `v_pinjam`;

CREATE ALGORITHM=UNDEFINED DEFINER=`arsip`@`localhost` SQL SECURITY DEFINER VIEW `v_pinjam`  AS  select `p`.`id_pinjam` AS `id_pinjam`,`p`.`id_arsip` AS `id_arsip`,`p`.`nama_peminjam` AS `nama_peminjam`,`p`.`tgl_pinjam` AS `tgl_pinjam`,`p`.`batas_waktu` AS `batas_waktu`,`p`.`kondisi_pinjam` AS `kondisi_pinjam`,`k`.`tgl_kembali` AS `tgl_kembali`,`k`.`kondisi_kembali` AS `kondisi_kembali` from (`pinjam_arsip` `p` left join `kembali_arsip` `k` on(`p`.`id_pinjam` = `k`.`id_pinjam`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id_arsip`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id_disposisi`),
  ADD KEY `id_arsip` (`id_arsip`);

--
-- Indexes for table `kembali_arsip`
--
ALTER TABLE `kembali_arsip`
  ADD PRIMARY KEY (`id_kembali`),
  ADD UNIQUE KEY `id_pinjam` (`id_pinjam`);

--
-- Indexes for table `lampiran`
--
ALTER TABLE `lampiran`
  ADD PRIMARY KEY (`id_lampiran`),
  ADD KEY `id_arsip` (`id_arsip`);

--
-- Indexes for table `pinjam_arsip`
--
ALTER TABLE `pinjam_arsip`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `id_arsip` (`id_arsip`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arsip`
--
ALTER TABLE `arsip`
  MODIFY `id_arsip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id_disposisi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kembali_arsip`
--
ALTER TABLE `kembali_arsip`
  MODIFY `id_kembali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lampiran`
--
ALTER TABLE `lampiran`
  MODIFY `id_lampiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pinjam_arsip`
--
ALTER TABLE `pinjam_arsip`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arsip`
--
ALTER TABLE `arsip`
  ADD CONSTRAINT `arsip_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD CONSTRAINT `disposisi_ibfk_1` FOREIGN KEY (`id_arsip`) REFERENCES `arsip` (`id_arsip`);

--
-- Constraints for table `kembali_arsip`
--
ALTER TABLE `kembali_arsip`
  ADD CONSTRAINT `kembali_arsip_ibfk_1` FOREIGN KEY (`id_pinjam`) REFERENCES `pinjam_arsip` (`id_pinjam`);

--
-- Constraints for table `lampiran`
--
ALTER TABLE `lampiran`
  ADD CONSTRAINT `lampiran_ibfk_1` FOREIGN KEY (`id_arsip`) REFERENCES `arsip` (`id_arsip`);

--
-- Constraints for table `pinjam_arsip`
--
ALTER TABLE `pinjam_arsip`
  ADD CONSTRAINT `pinjam_arsip_ibfk_1` FOREIGN KEY (`id_arsip`) REFERENCES `arsip` (`id_arsip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
