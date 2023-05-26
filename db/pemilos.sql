-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26 Mei 2023 pada 11.02
-- Versi Server: 10.1.29-MariaDB
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
-- Database: `pemilos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`username`, `password`) VALUES
('', ''),
('admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_datapilketos`
--

CREATE TABLE `tb_datapilketos` (
  `id` int(1) NOT NULL DEFAULT '1',
  `tapel` varchar(10) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_datapilketos`
--

INSERT INTO `tb_datapilketos` (`id`, `tapel`, `tgl`) VALUES
(1, '2022/2023', '2023-05-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_identitassekolah`
--

CREATE TABLE `tb_identitassekolah` (
  `npsn` varchar(15) NOT NULL,
  `nm_sekolah` varchar(32) NOT NULL,
  `jln` varchar(32) DEFAULT NULL,
  `desa` varchar(32) DEFAULT NULL,
  `kec` varchar(32) DEFAULT NULL,
  `kab` varchar(32) DEFAULT NULL,
  `kpl_sekolah` varchar(32) DEFAULT NULL,
  `nip` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_identitassekolah`
--

INSERT INTO `tb_identitassekolah` (`npsn`, `nm_sekolah`, `jln`, `desa`, `kec`, `kab`, `kpl_sekolah`, `nip`) VALUES
('20583489', 'MTs. BUSTANUL ULUM', 'Jl. Masjid Jamik', 'Waru Barat', 'Waru', 'Pamekasan', 'Agus Suparmanto, S.Pd', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `kd_kelas` int(3) NOT NULL,
  `nm_kelas` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`kd_kelas`, `nm_kelas`) VALUES
(1, 'IX-A'),
(2, 'IX-B'),
(3, 'IX-C'),
(4, 'IX-D'),
(5, 'VIII-A'),
(6, 'VIII-B'),
(7, 'VIII-C'),
(8, 'VIII-D'),
(9, 'VII-A'),
(10, 'VII-B'),
(11, 'VII-C'),
(12, 'VII-D');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pilih`
--

CREATE TABLE `tb_pilih` (
  `id_pilih` int(11) NOT NULL,
  `nisn` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pilih`
--

INSERT INTO `tb_pilih` (`id_pilih`, `nisn`, `username`) VALUES
(4, '0071707436', '0074367048'),
(5, '0071707437', '0076613488'),
(6, '1', '0071566180');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pilihan`
--

CREATE TABLE `tb_pilihan` (
  `nisn` varchar(32) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `visimisi` text,
  `photo` varchar(32) NOT NULL,
  `no` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pilihan`
--

INSERT INTO `tb_pilihan` (`nisn`, `nama`, `visimisi`, `photo`, `no`) VALUES
('0071707436', 'Jalil x Jalilah', 'Ini Contoh Visi & Misi Kandindat 1', '00717074361685085765.jpg', 1),
('0071707437', 'Aminatus x Supyatun', 'Ini Contoh Visi & Misi Kandindat 2', '00717074371685085781.jpg', 2),
('1', 'Inas x Farida', 'Ini Contoh Visi & Misi Kandindat 3', '11685089545.jpg', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nm_siswa` varchar(32) DEFAULT NULL,
  `jk` char(1) NOT NULL,
  `kd_kelas` int(3) DEFAULT NULL,
  `hadir` varchar(12) NOT NULL DEFAULT 'Tidak Hadir'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`username`, `password`, `nm_siswa`, `jk`, `kd_kelas`, `hadir`) VALUES
('0067482225', '0067482225', 'MALIK IBROHIM', 'L', 3, 'Tidak Hadir'),
('0071069708', '0071069708', 'GEA AMANDA RIANTO', 'P', 1, 'Tidak Hadir'),
('0071330926', '0071330926', 'UMAR KHADAFI', 'L', 3, 'Tidak Hadir'),
('0071566180', '0071566180', 'RIFAL MAULANA ZEIN', 'L', 1, 'Hadir'),
('0071707436', '0071707436', 'AFFAN MUBAROK', 'L', 1, 'Tidak Hadir'),
('0071913921', '0071913921', 'NAFLATUL UFAIRAH', 'P', 1, 'Tidak Hadir'),
('0072395483', '0072395483', 'AHMAD MAULANA HASAN', 'L', 3, 'Tidak Hadir'),
('0072874038', '0072874038', 'AISYATURRIFYAH', 'P', 1, 'Tidak Hadir'),
('0073226760', '0073226760', 'TAUFIK HIDAYAH RASUL', 'L', 3, 'Tidak Hadir'),
('0073232987', '0073232987', 'MARIANA', 'P', 2, 'Tidak Hadir'),
('0073416456', '0073416456', 'IMMA ATIKA ZAHAZ FANA', 'P', 1, 'Tidak Hadir'),
('0073476635', '0073476635', 'MOH. FAHMI', 'L', 3, 'Tidak Hadir'),
('0073704165', '0073704165', 'MOH. ABD. AZIZ', 'L', 1, 'Tidak Hadir'),
('0073892961', '0073892961', 'SAFIRA SEPTIA RAMADHANI', 'P', 4, 'Tidak Hadir'),
('0074095187', '0074095187', 'ALFIANSYAH', 'L', 1, 'Tidak Hadir'),
('0074161852', '0074161852', 'ALIFAN AHMAD SYAFI`E', 'L', 3, 'Tidak Hadir'),
('0074367048', '0074367048', 'JIHAN ZAHDA AMALIA', 'P', 1, 'Hadir'),
('0074401287', '0074401287', 'MOH. RIFKI', 'L', 3, 'Tidak Hadir'),
('0074842903', '0074842903', 'MOHAMMAD ALI IMRON', 'L', 3, 'Tidak Hadir'),
('0075091393', '0075091393', 'AIZATUL FITRIANI', 'P', 2, 'Tidak Hadir'),
('0075625341', '0075625341', 'PUTRI DEWI NURFAZIRAH', 'P', 4, 'Tidak Hadir'),
('0075927478', '0075927478', 'AKH.SADDAN IRAQI RHAMADLANI', 'L', 3, 'Tidak Hadir'),
('0075975634', '0075975634', 'MOH. SYAHRIL BAROQI', 'L', 3, 'Tidak Hadir'),
('0076147212', '0076147212', 'ISTIFADZOTUL UYUN', 'P', 4, 'Tidak Hadir'),
('0076477956', '0076477956', 'AISYAH', 'P', 2, 'Tidak Hadir'),
('0076613488', '0076613488', 'NADIA FATHIN', 'P', 1, 'Hadir'),
('0076696930', '0076696930', 'TSAQILA PUTRI', 'P', 4, 'Tidak Hadir'),
('0077107397', '0077107397', 'SYAIFUL RIZAL', 'L', 3, 'Tidak Hadir'),
('0077220485', '0077220485', 'NADZILATUR ROKHMAH', 'P', 1, 'Tidak Hadir'),
('0077526809', '0077526809', 'AFINA AULIA FAJARIYAH', 'P', 1, 'Tidak Hadir'),
('0077860831', '0077860831', 'MOHAMMAD SAFI`UDDIN', 'L', 3, 'Tidak Hadir'),
('0078998342', '0078998342', 'RIZKA AULIA', 'P', 4, 'Tidak Hadir'),
('0079032870', '0079032870', 'ABDUS SAKUR', 'L', 3, 'Tidak Hadir'),
('0079253561', '0079253561', 'DIAH AJENG PITALOKA', 'P', 2, 'Tidak Hadir'),
('0081416653', '0081416653', 'NAURELIA IZZA KAMELA', 'P', 2, 'Tidak Hadir'),
('0081465784', '0081465784', 'DESI NUR FAJRINA', 'P', 1, 'Tidak Hadir'),
('0081989795', '0081989795', 'NABILA FIFAN MAIMUNA', 'P', 2, 'Tidak Hadir'),
('0082038418', '0082038418', 'NAFA ARISKA STALISA', 'P', 4, 'Tidak Hadir'),
('0082061371', '0082061371', 'HILMI KHOLILULLAH', 'L', 3, 'Tidak Hadir'),
('0083106308', '0083106308', 'MOH. HAERUL UMAM', 'L', 1, 'Tidak Hadir'),
('0083516398', '0083516398', 'SITI NAFISAH', 'P', 1, 'Tidak Hadir'),
('0083864462', '0083864462', 'MISNAHORI', 'L', 3, 'Tidak Hadir'),
('0084410551', '0084410551', 'IKA FAUZIYAH', 'P', 2, 'Tidak Hadir'),
('0084661649', '0084661649', 'NADZIFA AROFATUL FIRDAUSI', 'P', 2, 'Tidak Hadir'),
('0084831476', '0084831476', 'MUHAMMAD ARSYAD', 'L', 3, 'Tidak Hadir'),
('0085252601', '0085252601', 'YUNITA TRIWULANDARI', 'P', 4, 'Tidak Hadir'),
('0085332551', '0085332551', 'PUTRI NURUL ISMA', 'P', 4, 'Tidak Hadir'),
('0085516942', '0085516942', 'NOR AINI', 'P', 2, 'Tidak Hadir'),
('0085587918', '0085587918', 'MOH. KHOLILURRAHMAN', 'L', 3, 'Tidak Hadir'),
('0086423372', '0086423372', 'SULTAN AGUNG ZEINULLAH', 'L', 3, 'Tidak Hadir'),
('0086453882', '0086453882', 'MARIA', 'P', 2, 'Tidak Hadir'),
('0086616999', '0086616999', 'YULIANA SAFIRA ARSAN', 'P', 1, 'Tidak Hadir'),
('0086744432', '0086744432', 'MUHAMAD UBAIDILAH', 'L', 3, 'Tidak Hadir'),
('0086907784', '0086907784', 'YENATUL QOMARIYAH', 'P', 4, 'Tidak Hadir'),
('0087478252', '0087478252', 'HIDAYAH', 'P', 1, 'Tidak Hadir'),
('0088255604', '0088255604', 'MOH. FARHAN MAULIDI', 'L', 1, 'Tidak Hadir'),
('0088350043', '0088350043', 'ALIMUDDIN', 'L', 3, 'Tidak Hadir'),
('0088450470', '0088450470', 'ALINI ANINDIYA PUTRI', 'P', 2, 'Tidak Hadir'),
('0088636472', '0088636472', 'MUHAMMAD SAFRIAN FEBRIANSYAH', 'L', 3, 'Tidak Hadir'),
('0088987308', '0088987308', 'NURUL RAHMAN', 'L', 3, 'Tidak Hadir'),
('0089629895', '0089629895', 'MEIDINA REVILANI', 'P', 1, 'Tidak Hadir'),
('0089631908', '0089631908', 'ROHIM', 'L', 3, 'Tidak Hadir'),
('0089935631', '0089935631', 'MOH. HAFID', 'L', 3, 'Tidak Hadir'),
('0091143645', '0091143645', 'LANA HADIYATUL MAULA NAZIL', 'P', 1, 'Tidak Hadir'),
('0092236643', '0092236643', 'MAYA ROSA YULINDARI', 'P', 2, 'Tidak Hadir'),
('0094074124', '0094074124', 'BUNGA SITI KANIA', 'P', 2, 'Tidak Hadir'),
('0097014197', '0097014197', 'DESI LATIFANI', 'P', 2, 'Tidak Hadir'),
('0708141014', '0708141014', 'SITI AISHAH BINTI ARIFIN', 'P', 2, 'Tidak Hadir'),
('3071397894', '3071397894', 'SOFIANTIKA', 'P', 4, 'Tidak Hadir'),
('3073986123', '3073986123', 'ALFIA NURIZ ZIFA', 'P', 2, 'Tidak Hadir'),
('3078882934', '3078882934', 'ROSALINDA', 'P', 4, 'Tidak Hadir'),
('3079052698', '3079052698', 'CELSE OLIVIA', 'P', 2, 'Tidak Hadir'),
('3086036618', '3086036618', 'NUR AWALIA FANNI FUROIDA', 'P', 4, 'Tidak Hadir');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_daftarhadir`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_daftarhadir` (
`NISN` varchar(32)
,`nm_siswa` varchar(32)
,`nm_kelas` varchar(32)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_vote`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_vote` (
`nisn` varchar(32)
,`nama` varchar(32)
,`photo` varchar(32)
,`no` int(1)
,`username` varchar(32)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_daftarhadir`
--
DROP TABLE IF EXISTS `view_daftarhadir`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_daftarhadir`  AS  select `tb_siswa`.`username` AS `NISN`,`tb_siswa`.`nm_siswa` AS `nm_siswa`,`tb_kelas`.`nm_kelas` AS `nm_kelas` from ((`tb_siswa` join `tb_kelas` on((`tb_kelas`.`kd_kelas` = `tb_siswa`.`kd_kelas`))) join `tb_pilih` on((`tb_siswa`.`username` = `tb_pilih`.`username`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_vote`
--
DROP TABLE IF EXISTS `view_vote`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_vote`  AS  select `tb_pilihan`.`nisn` AS `nisn`,`tb_pilihan`.`nama` AS `nama`,`tb_pilihan`.`photo` AS `photo`,`tb_pilihan`.`no` AS `no`,`tb_siswa`.`username` AS `username` from ((`tb_pilih` join `tb_pilihan` on((`tb_pilihan`.`nisn` = `tb_pilih`.`nisn`))) join `tb_siswa` on((`tb_siswa`.`username` = `tb_pilih`.`username`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tb_datapilketos`
--
ALTER TABLE `tb_datapilketos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_identitassekolah`
--
ALTER TABLE `tb_identitassekolah`
  ADD PRIMARY KEY (`npsn`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`kd_kelas`);

--
-- Indexes for table `tb_pilih`
--
ALTER TABLE `tb_pilih`
  ADD PRIMARY KEY (`id_pilih`);

--
-- Indexes for table `tb_pilihan`
--
ALTER TABLE `tb_pilihan`
  ADD PRIMARY KEY (`nisn`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `kd_kelas` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_pilih`
--
ALTER TABLE `tb_pilih`
  MODIFY `id_pilih` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
