-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2016 at 11:57 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `db_hubin`
--
-- --------------------------------------------------------
--
-- Table structure for table `al_kabupaten`
--
CREATE TABLE IF NOT EXISTS `al_kabupaten` (
`id_kabupaten` int(5) NOT NULL,
  `nama_kabupaten` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------
--
-- Table structure for table `al_kecamatan`
--
CREATE TABLE IF NOT EXISTS `al_kecamatan` (
`id_kecamatan` int(5) NOT NULL,
  `nama_kecamatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------
--
-- Table structure for table `al_kelurahan`
--
CREATE TABLE IF NOT EXISTS `al_kelurahan` (
`id_kelurahan` int(5) NOT NULL,
  `nama_kelurahan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------
--
-- Table structure for table `al_provinsi`
--
CREATE TABLE IF NOT EXISTS `al_provinsi` (
`id_provinsi` int(5) NOT NULL,
  `nama_provinsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------
--
-- Table structure for table `guru`
--
CREATE TABLE IF NOT EXISTS `guru` (
  `nip_guru` varchar(18) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `agama` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telepon` varchar(12) NOT NULL,
  `gol_darah` char(2) NOT NULL,
  `status` varchar(15) NOT NULL,
  `foto` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `guru`
--
INSERT INTO `guru` (`nip_guru`, `jenis`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `agama`, `email`, `no_telepon`, `gol_darah`, `status`, `foto`) VALUES
('111', 'Produktif', 'Agus Nugroho', 'L', 'Bandung', '1990-07-06', 'Jl. Soreang No.45', 'Islam', 'agusnugroho@ymail.com', '089617788528', 'AB', 'Menikah', 'kaprog.jpg'),
('222', 'Produktif', 'Pa KM', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('333', 'Produktif', 'Pa KP', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('444', 'Produktif', 'Pa TEI', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('555', 'Produktif', 'Pa TEK', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('666', 'Produktif', 'Pa TKJ', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('71', 'Normatif', 'Guru Normatif', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('777', 'Produktif', 'Pa TOI', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('888', 'Produktif', 'Pa TP4', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('91', 'Produktif', 'Guru RPL1', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('910', 'Produktif', 'Guru TEK 2', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('911', 'Produktif', 'Guru TKJ 1', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('912', 'Produktif', 'Guru TKJ 2', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('913', 'Produktif', 'Guru TOI 1', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('914', 'Produktif', 'Guru TOI 2', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('915', 'Produktif', 'Guru TP4 1', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('916', 'Produktif', 'Guru TP4 2', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('917', 'Produktif', 'Guru TP 1', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('918', 'Produktif', 'Guru TP 2', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('92', 'Produktif', 'Guru RPL 2', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('93', 'Produktif', 'Guru KM 1', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('94', 'Produktif', 'Guru KM 2', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('95', 'Produktif', 'Guru KP 1', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('96', 'Produktif', 'Guru KP 2', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('97', 'Produktif', 'Guru TEI 1', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('98', 'Produktif', 'Guru TEI 2', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('99', 'Produktif', 'Guru TEK 1', '', '', '0000-00-00', '', '', '', '', '', '', ''),
('999', 'Produktif', 'Pa TPTU', '', '', '0000-00-00', '', '', '', '', '', '', '');
-- --------------------------------------------------------
--
-- Table structure for table `hb_berita`
--
CREATE TABLE IF NOT EXISTS `hb_berita` (
`id_berita` int(10) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `tgl_berita` date NOT NULL,
  `judul_berita` varchar(50) NOT NULL,
  `isi_berita` text NOT NULL,
  `keterangan` text NOT NULL,
  `hits_berita` int(20) NOT NULL,
  `foto_berita` text NOT NULL,
  `sumber` varchar(18) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;
--
-- Dumping data for table `hb_berita`
--
INSERT INTO `hb_berita` (`id_berita`, `kategori`, `tgl_berita`, `judul_berita`, `isi_berita`, `keterangan`, `hits_berita`, `foto_berita`, `sumber`) VALUES
(4, 'umum', '2016-01-02', 'Sesuatu yg Baru di Hubin', '<p>Apa pun dhvsdvamn &nbsp;shbhvd hnsvbhd jsggdsb bsgjsfjgsfjg shvbabbs shvshabanvs dhvsbnsbndhhbs ndhvhdsnbd bbdhghsbxbhvddhvd hd djhd hd dh dhdh hdhd hdh dhdkjaywyeud xag xakwpvhcbxsnbd &nbsp;jsghgdhfs whwchwhvvc cwg cwg uqwggwdjdwvdwufwdhebvbsdvdw dgwvdhdwgdwgjwdv dwnvdhgwhjd hdwvdwj hjdw djdjw udwudwu.</p>\r\n', 'Tes', 1, 'S3.jpg', 'Dwi Sulistyawati'),
(5, 'umum', '2016-01-05', 'Selamat Datang di Hubin!', '<p>Hubin (Hubungan Industri) &nbsp;SMKN 1 Cimahi adalah bal agaffsgtwtdghahdab hvdgtwusa dajdidaoab dbcb dhhdbgd dghds hbbcbc hshad hdcp csyqwttdu kaiddhpa hhbhsas hdsggshshhahadh</p>\r\n', 'Tes', 1, '3s.jpg', 'Dwi Sulistyawati');
-- --------------------------------------------------------
--
-- Table structure for table `hb_du`
--
CREATE TABLE IF NOT EXISTS `hb_du` (
`id_du` int(10) NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL,
  `nama_du` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(50) NOT NULL,
  `status_du` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama_penanggung_jawab` varchar(50) NOT NULL,
  `mulai_pelaksanaan` date NOT NULL,
  `berakhir_pelaksanaan` date NOT NULL,
  `kerjasama_magang` varchar(3) NOT NULL,
  `kerjasama_tidak_langsung` varchar(3) NOT NULL,
  `permintaan_siswa` varchar(20) NOT NULL,
  `du_siswa` varchar(3) NOT NULL,
  `keterangan_du` text NOT NULL,
  `seleksi_du` varchar(5) NOT NULL,
  `seleksi_tempat` varchar(50) NOT NULL,
  `seleksi_tanggal` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;
--
-- Dumping data for table `hb_du`
--
INSERT INTO `hb_du` (`id_du`, `tahun_ajaran`, `nama_du`, `alamat`, `kota`, `status_du`, `email`, `nama_penanggung_jawab`, `mulai_pelaksanaan`, `berakhir_pelaksanaan`, `kerjasama_magang`, `kerjasama_tidak_langsung`, `permintaan_siswa`, `du_siswa`, `keterangan_du`, `seleksi_du`, `seleksi_tempat`, `seleksi_tanggal`) VALUES
(1, '2013-2014', 'Percobaan DU Penerima', 'Percobaan DU Penerima', 'Percobaan DU Penerima', 'Menerima', 'asepp@ho.oaa', 'pa Percobaan DU Penerima', '2015-11-30', '2016-01-30', '', '', '', '', 'Percobaan DU Penerima', 'Tidak', '', '0000-00-00'),
(2, '2013-2014', 'WAWA', 'er', 'ev', 'proses', 'rv@s.sds', '', '0000-00-00', '0000-00-00', '', '', '', '', 'tes', 'Tidak', '', '0000-00-00'),
(3, '2013-2014', 'ww', 'w', 'ww', 'Menolak', 'w', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 'Tidak', '', '0000-00-00'),
(5, '2013-2014', 'Tambah Lagi', 'ayo tambah', 'apacik', 'Menolak', 'd@gmail.co', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 'Tidak', '', '0000-00-00'),
(6, '2013-2014', 'for rpl', 'alam rpl', 'erpeel', 'Menerima', 'erpl@g.c', 'Dea', '2015-11-09', '2015-11-21', '', '', '', '', '', 'Tidak', '', '0000-00-00'),
(7, '2013-2014', 'toi aaxac', 'ala toi', 'hagjgh toi', 'Menerima', 'toi@g.dl', 'patoi', '2015-11-01', '2015-11-06', '', '', '', '', '', 'Tidak', '', '0000-00-00'),
(8, '2013-2014', 'kp', 'kp', 'kp', 'Menerima', 'kp@kp.kp', 'kp', '2015-11-14', '2015-11-18', '', '', '', '', '', 'Tidak', '', '0000-00-00'),
(9, '2013-2014', 'km', 'km', 'km', 'Menerima', 'km@km.km', 'kmm', '2015-11-04', '2015-12-05', '', '', '', '', '', 'Tidak', '', '0000-00-00'),
(10, '2013-2014', 'tek', 'tek', 'tek', 'Menerima', 'telk@tek.tek', '12', '2015-11-12', '2015-11-07', '', '', '', '', '', 'Tidak', '', '0000-00-00'),
(11, '2013-2014', 'tei', 'tei', 'tei', 'Menerima', 'telk@tek.tei', 'patei', '2015-10-12', '2015-12-18', '', '', '', '', '', 'Tidak', '', '0000-00-00'),
(12, '2013-2014', 'tkj', 'tkj', 'tkj', 'Menerima', 'tkj@tkj.tj', 'tkj', '2015-11-14', '2015-11-06', '', '', '', '', '', 'Tidak', '', '0000-00-00'),
(13, '2013-2014', 'tp4', 'tp4', 'tp4', 'Menerima', 'tp4@tp4.tp4', 'tp4', '2015-11-13', '2015-12-18', '', '', '', '', '', 'Tidak', '', '0000-00-00'),
(14, '2013-2014', 'tp', 'tp', 'tp', 'Menerima', 'tp@tp.tp', 'patp', '2015-11-18', '2015-11-19', '', '', '', '', '', 'Tidak', '', '0000-00-00'),
(15, '2013-2014', 'Nama DU', 'JL. Rancabali RT.06 RW.03', 'Bandung', 'Menerima', 'deaemalia28@gmail.com', 'driko', '2015-12-01', '2016-03-31', '', '', '', '', '', 'Tidak', '', '0000-00-00'),
(16, '2013-2014', 'Nama DU bARU', 'Jl. DU nya', 'Bogor', 'Menerima', 'nama@du.g', 'Penanggung jawab', '2015-11-12', '2015-11-12', '', '', '', '', '', 'Tidak', '', '0000-00-00'),
(18, '2013-2014', 'DU siswaqquuu', 'dusiswauu', 'Siswaaa', 'Menerima', 'dew@gmail.co', 'Percobaan', '0000-00-00', '0000-00-00', '', '', '132', 'Yes', '', 'Tidak', '', '0000-00-00'),
(19, '2013-2014', 'Mencobaaaaaa', 'tukaaaa', 'pahamiaaaaaaaa', 'Menerima', 'mencari@celah.d', 'Pihapuseun', '2015-12-30', '2015-12-31', '', '', '', '', 'Bialaaaaa', 'Tidak', '', '0000-00-00'),
(21, '2013-2014', 'rtgh', 'he', 'htet', 'Menerima', 'th@d.l', 'Raden Sarwijdoo', '2015-12-03', '2015-12-05', '', '', '131', 'Yes', 'te', 'Tidak', '', '0000-00-00'),
(22, '2013-2014', 'DU km', 'Jalan KM ya', 'KM', 'Menerima', 'km@jaik.a', 'Pa Siaia', '2016-01-06', '2016-01-02', '', '', '133', 'Yes', 'Ini du km', 'No', '', '0000-00-00'),
(23, '2013-2014', 'DU Satu', 'Jalan Bismillah', 'Bismillah', 'Menerima', 'Bismillah@fga.a', 'Raden Awer', '2015-12-01', '2015-12-30', '', '', '', '', 'Apaweh atuh bismillah', 'Tidak', '', '0000-00-00'),
(24, '2013-2014', 'DuniaUsahaDD', 'Jalaaa', 've', 'Menerima', 'dada@d.d', 'Rendi', '2015-12-11', '2015-12-10', '', '', '', '', 'apaalah', 'Tidak', '', '0000-00-00'),
(26, '2013-2014', 'Percobaan', 'Percobaan', 'Percobaan', 'Menerima', 'Percobaan@Percobaan.Percobaan', 'Bu Percobaan', '2015-12-09', '2015-12-17', '', '', '', '', 'Percobaan', 'Tidak', '', '0000-00-00'),
(27, '2013-2014', 'Percobaan Tolak', 'Percobaan', 'Percobaan', 'Menolak', 'Percobaan@a.a', '', '0000-00-00', '0000-00-00', '', '', '', '', 'Percobaan', 'Tidak', '', '0000-00-00'),
(28, '2013-2014', 'Percobaan DU Siswa', 'Percobaan', 'Percobaan', 'Menerima', 'Percobaan@PercobaanPercobaa.n', 'PJ Percobaan', '2015-12-17', '2015-12-26', '', '', '135', 'Yes', 'Percobaan', 'Tidak', '', '0000-00-00'),
(29, '2013-2014', 'Mencoba Lagi', 'Percobaan', 'Percobaan', 'DU_Siswa', 'Percobaan@Percobaan.Percobaan', '', '0000-00-00', '0000-00-00', '', '', '136', 'Yes', 'Percobaan', 'Tidak', '', '0000-00-00'),
(31, '2014-2015', 'Pihapuseun', 'Pihapuseun', 'Pihapuseun', 'Menolak', 'Pihapuseun@a.a', ' ', '0000-00-00', '0000-00-00', '', '', '', '', 'Pihapuseun', 'Tidak', '', '0000-00-00'),
(32, '2014-2015', 'aa', 'aa', 'aa', 'Menolak', 'aaa@f.s', '', '0000-00-00', '0000-00-00', '', '', '', '', 'aa', 'Tidak', '', '0000-00-00'),
(33, '2013-2014', 'Hapusssssssssss', 'Hapusssssssssss', 'Hapusssssssssss', 'Menerima', 'Hapusssssssssss@n.m', 'Hapusssssssssss', '2015-12-04', '2015-12-17', '', '', '', '', 'Hapusssssssssss', 'Tidak', '', '0000-00-00'),
(34, '2013-2014', 'Buat Dihapus DU Jurusan', 'Buat Dihapus DU Jurusan', 'Buat Dihapus DU Jurusan', 'Menerima', 'urusana@s.a', 'Buat Dihapus DU Jurusan', '2015-12-04', '2015-12-26', '', '', '', '', 'Buat Dihapus DU Jurusan', 'Ya', 'Ruang Media', '2015-12-12'),
(35, '2013-2014', 'Seleksi Y', 'Seleksi Y', 'v', 'Menerima', 'SeleksiY@gb.a', 'hmpp', '2015-12-09', '2015-12-02', '', '', '', '', 'Seleksi Y', 'Tidak', '', '0000-00-00'),
(36, '2013-2014', 'Tes doang', 'Tes doang', 'Tes doang', 'Menerima', 'czcz@j', 'vddfd', '2016-01-07', '2016-01-29', '', '', '', '', 'ggm', 'Ya', '', '0000-00-00'),
(37, '2013-2014', 'Apa ', 'TFGAFY', 'Cimahi', 'Menerima', 'dead@da.a', 'Agus', '2016-01-22', '2016-01-09', '', '', '', '', 'ftaftf', 'Ya', '', '0000-00-00'),
(38, '2013-2014', 'DU KM Siswa', 'ggff', 'yyty', 'Proses', 'dea@fa.a', '', '0000-00-00', '0000-00-00', '', '', '134', 'Yes', 'tffttf', '', '', '0000-00-00'),
(39, '2013-2014', 'Misal', 'Misal', 'MIsal', 'Proses', 'dea@fa.a', '', '0000-00-00', '0000-00-00', '', '', '', '', 'Misal', '', '', '0000-00-00'),
(40, '2013-2014', 'fefe', 'fefe', 'ffe', 'Menerima', 'deaemalia28@gmail.com', 'Dea ', '2016-07-22', '2016-08-12', '', '', '', '', 'aas', 'Ya', '', '0000-00-00');
-- --------------------------------------------------------
--
-- Table structure for table `hb_du_penerima`
--
CREATE TABLE IF NOT EXISTS `hb_du_penerima` (
`id_du_penerima` int(10) NOT NULL,
  `id_du` int(10) NOT NULL,
  `id_jurusan` int(10) NOT NULL,
  `jumlah_penerimaan` int(10) NOT NULL,
  `sisa_kuota_penerimaan` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;
--
-- Dumping data for table `hb_du_penerima`
--
INSERT INTO `hb_du_penerima` (`id_du_penerima`, `id_du`, `id_jurusan`, `jumlah_penerimaan`, `sisa_kuota_penerimaan`) VALUES
(1, 1, 1, 7, 7),
(2, 1, 9, 8, 8),
(3, 1, 3, 5, 5),
(4, 6, 1, 5, 4),
(5, 7, 7, 49, 49),
(6, 14, 9, 9, 9),
(7, 13, 1, 21, 21),
(8, 13, 8, 12, 12),
(9, 12, 7, 3, 3),
(10, 12, 6, 55, 54),
(11, 10, 2, 11, 11),
(12, 10, 5, 6, 6),
(13, 11, 8, 5, 5),
(14, 11, 4, 15, 15),
(15, 8, 5, 4, 4),
(16, 8, 3, 12, 12),
(17, 9, 2, 8, 8),
(18, 15, 1, 20, 20),
(19, 16, 4, 11, 11),
(20, 16, 1, 21, 21),
(21, 21, 1, 3, 3),
(22, 23, 3, 1, 1),
(23, 23, 6, 1, 0),
(24, 23, 1, 2, 2),
(25, 24, 4, 2, 2),
(26, 24, 1, 3, 2),
(27, 26, 3, 3, 3),
(28, 26, 9, 5, 5),
(29, 26, 1, 1, 1),
(30, 28, 1, 2, 2),
(31, 18, 3, 1, 1),
(32, 19, 2, 4, 3),
(33, 19, 5, 2, 2),
(35, 33, 3, 2, 2),
(43, 35, 6, 8, 8),
(44, 22, 2, 1, 0),
(45, 36, 2, 3, 3),
(46, 36, 1, 5, 5),
(47, 36, 5, 3, 3),
(48, 37, 2, 5, 5),
(49, 37, 1, 3, 3),
(50, 37, 6, 3, 3),
(51, 40, 2, 3, 3),
(52, 40, 1, 4, 4);
-- --------------------------------------------------------
--
-- Table structure for table `hb_du_permintaan_1`
--
CREATE TABLE IF NOT EXISTS `hb_du_permintaan_1` (
`id_du_permintaan` int(10) NOT NULL,
  `id_du` int(10) NOT NULL,
  `permintaan_siswa` varchar(3) NOT NULL,
  `du_siswa` varchar(18) NOT NULL,
  `permintaan_du` varchar(3) NOT NULL,
  `permintaan_hubin` varchar(3) NOT NULL,
  `status_du` varchar(10) NOT NULL,
  `seleksi_du` varchar(5) NOT NULL,
  `seleksi_tempat` varchar(50) NOT NULL,
  `seleksi_tanggal` date NOT NULL,
  `nama_penanggung_jawab` varchar(50) NOT NULL,
  `contact_person` varchar(20) NOT NULL,
  `ket_contact_person` varchar(20) NOT NULL,
  `status_permintaan` varchar(10) NOT NULL,
  `mulai_pelaksanaan` date NOT NULL,
  `berakhir_pelaksanaan` date NOT NULL,
  `kerjasama_magang` varchar(3) NOT NULL,
  `kerjasama_tidak_langsung` varchar(3) NOT NULL,
  `keterangan_permintaan` text NOT NULL,
  `fasilitas_1` varchar(3) NOT NULL,
  `fasilitas_2` varchar(3) NOT NULL,
  `fasilitas_3` varchar(3) NOT NULL,
  `fasilitas_4` varchar(3) NOT NULL,
  `fasilitas_lain` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------
--
-- Table structure for table `hb_du_permintaan_du`
--
CREATE TABLE IF NOT EXISTS `hb_du_permintaan_du` (
`id_du_permintaan_du` int(10) NOT NULL,
  `id_du` int(10) NOT NULL,
  `id_jurusan` int(10) NOT NULL,
  `jumlah_penerimaan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------
--
-- Table structure for table `hb_du_umum`
--
CREATE TABLE IF NOT EXISTS `hb_du_umum` (
`id_du` int(10) NOT NULL,
  `nama_du` varchar(50) NOT NULL,
  `email_du` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `nama_provinsi` int(5) NOT NULL,
  `nama_kabupaten` int(5) NOT NULL,
  `nama_kecamatan` int(5) NOT NULL,
  `nama_kelurahan` int(5) NOT NULL,
  `no_kodepos` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` varchar(11) NOT NULL,
  `status` varchar(11) NOT NULL,
  `keterangan` text NOT NULL,
  `bidang_usaha` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------
--
-- Table structure for table `hb_guru_jurusan`
--
CREATE TABLE IF NOT EXISTS `hb_guru_jurusan` (
`id_guru_jurusan` int(10) NOT NULL,
  `nip_guru` varchar(18) NOT NULL,
  `id_jurusan` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;
--
-- Dumping data for table `hb_guru_jurusan`
--
INSERT INTO `hb_guru_jurusan` (`id_guru_jurusan`, `nip_guru`, `id_jurusan`) VALUES
(1, '111', 1),
(2, '222', 2),
(3, '333', 3),
(4, '444', 4),
(5, '555', 5),
(6, '666', 6),
(7, '777', 7),
(8, '888', 8),
(9, '999', 9),
(10, '91', 1),
(11, '92', 1),
(12, '93', 2),
(13, '94', 2),
(14, '95', 3),
(15, '96', 3),
(16, '97', 4),
(17, '98', 4),
(18, '99', 5),
(19, '910', 5),
(20, '911', 6),
(21, '912', 6),
(22, '913', 7),
(23, '914', 7),
(24, '915', 8),
(25, '916', 8),
(26, '917', 9),
(27, '918', 9);
-- --------------------------------------------------------
--
-- Table structure for table `hb_login_operator`
--
CREATE TABLE IF NOT EXISTS `hb_login_operator` (
  `nip_nis` varchar(18) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `hb_login_operator`
--
INSERT INTO `hb_login_operator` (`nip_nis`, `password`) VALUES
('111', '698d51a19d8a121ce581499d7b701668'),
('131', '1afa34a7f984eeabdbb0a7d494132ee5'),
('133', '9fc3d7152ba9336a670e36d0ed79bc43'),
('222', 'bcbe3365e6ac95ea2c0343a2395834dd'),
('333', '310dcbbf4cce62f762a2aaa148d556bd'),
('444', '550a141f12de6341fba65b0ad0433500'),
('555', '15de21c670ae7c3f6f3f1f37029303c9'),
('666', 'fae0b27c451c728867a567e8c1bb4e53'),
('777', 'f1c1592588411002af340cbaedd6fc33'),
('888', '0a113ef6b61820daa5611c870ed8d5ee'),
('999', 'b706835de79a2b4e80506f582af3676a');
-- --------------------------------------------------------
--
-- Table structure for table `hb_monitoring`
--
CREATE TABLE IF NOT EXISTS `hb_monitoring` (
`id_monitoring` int(10) NOT NULL,
  `id_du` int(10) NOT NULL,
  `nis` varchar(18) NOT NULL,
  `nip_guru` varchar(18) NOT NULL,
  `tgl_monitoring` date NOT NULL,
  `tgl_masuk` date NOT NULL,
  `kegiatan_siswa` text NOT NULL,
  `nilai` varchar(15) NOT NULL,
  `masalah_yg_ditemukan` text NOT NULL,
  `saran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------
--
-- Table structure for table `hb_pengelola_hubin`
--
CREATE TABLE IF NOT EXISTS `hb_pengelola_hubin` (
  `username` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `agama` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telepon` varchar(12) NOT NULL,
  `gol_darah` char(2) NOT NULL,
  `status` varchar(15) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `foto` varchar(70) NOT NULL,
  `motto_hidup` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `hb_pengelola_hubin`
--
INSERT INTO `hb_pengelola_hubin` (`username`, `nama`, `jabatan`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `agama`, `email`, `no_telepon`, `gol_darah`, `status`, `nip`, `foto`, `motto_hidup`) VALUES
('deaa', '987', '987', '', '', '0000-00-00', '', '', '', '', '', '', '987', '', ''),
('dwisulis', 'Dwi Sulistyawati', 'Ketua', 'P', 'Cimahi', '2015-11-09', 'Jalan jalan', 'Islam', 'dwi@gatau.com', '089617788528', 'A', 'Belum Menikah', '1234', '2.jpg', 'Semangat Ajalah'),
('dwisulis2', 'Dwi Sulistyawati 2', 'Wakil Bu Dwi', 'P', 'Dimana ', '0000-00-00', '', '', '', '', '', '', '12345', '', ''),
('tedea', 'Teh Dea', 'deaa', '', '', '0000-00-00', '', '', '', '', '', '', '123', '', ''),
('teeg', '456', '456', '', '', '0000-00-00', '', '', '', '', '', '', '456', '', ''),
('tehdea', '321', '321e', '', '', '0000-00-00', '', '', '', '', '', '', '321', '', '');
-- --------------------------------------------------------
--
-- Table structure for table `hb_prakerin`
--
CREATE TABLE IF NOT EXISTS `hb_prakerin` (
`id_prakerin` int(10) NOT NULL,
  `nis` varchar(18) NOT NULL,
  `id_du` int(10) NOT NULL,
  `status_verifikasi` varchar(25) NOT NULL,
  `status_prakerin` varchar(25) NOT NULL,
  `nip_guru` varchar(18) NOT NULL,
  `saran_pembimbing` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;
--
-- Dumping data for table `hb_prakerin`
--
INSERT INTO `hb_prakerin` (`id_prakerin`, `nis`, `id_du`, `status_verifikasi`, `status_prakerin`, `nip_guru`, `saran_pembimbing`) VALUES
(11, '1311', 23, 'Terverifikasi', 'Menunggu Verifikasi Siswa', '111', '333'),
(13, '1312', 12, 'Menunggu Verifikasi', '', '91', '91'),
(14, '131', 24, 'Terverifikasi', 'Menunggu Verifikasi Siswa', '92', '91'),
(15, '133', 22, 'Terverifikasi', 'Menunggu Verifikasi Siswa', '93', '333'),
(16, '134', 19, 'Terverifikasi', 'Menunggu Verifikasi Siswa', '111', '333');
-- --------------------------------------------------------
--
-- Table structure for table `hb_riwayat_siswa`
--
CREATE TABLE IF NOT EXISTS `hb_riwayat_siswa` (
`id_riwayat` int(10) NOT NULL,
  `nis` varchar(18) NOT NULL,
  `riwayat` varchar(10) NOT NULL,
  `nama_tempat` varchar(50) NOT NULL,
  `tanggal_riwayat` date NOT NULL,
  `alamat_tempat` text NOT NULL,
  `status` varchar(15) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------
--
-- Table structure for table `hb_user_admin`
--
CREATE TABLE IF NOT EXISTS `hb_user_admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(11) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `hb_user_admin`
--
INSERT INTO `hb_user_admin` (`username`, `password`, `level`, `status`) VALUES
('deaa', '68053af2923e00204c3ca7c6a3150cf7', 'admin', 'aktif'),
('deaemalia', '12e0a145f08f27d8b3b0d08e467920b3', 'super_admin', 'aktif'),
('dwisulis', 'ea220da363fd87704cbd653cbc59ed49', 'admin', 'aktif'),
('dwisulis2', '4a718e220eeb9edd41ac4fec56ba8e73', 'admin', 'aktif'),
('perusahaan', '21f57628aa8d2ba238f7a6db352195c8', 'perusahaan', 'aktif'),
('tedea', 'ab72e8f0f6419701edf03f24737f3aec', 'admin', 'aktif'),
('teeg', '372c331c7b8f8d7a3e7e01a4b6af7895', 'admin', 'aktif'),
('tehdea', 'caf1a3dfb505ffed0d024130f58c5cfa', 'admin', 'aktif');
-- --------------------------------------------------------
--

-- --------------------------------------------------------
--
-- Table structure for table `jurusan`
--
CREATE TABLE IF NOT EXISTS `jurusan` (
`id_jurusan` int(10) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL,
  `singkatan` varchar(4) NOT NULL,
  `kapprog` varchar(18) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;
--
-- Dumping data for table `jurusan`
--
INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`, `singkatan`, `kapprog`) VALUES
(1, 'Rekayasa Perangkat Lunak', 'RPL', '111'),
(2, 'Kontrol Mekanik', 'KM', '222'),
(3, 'Kontrol Proses', 'KP', '333'),
(4, 'Teknik Elektronika Industri', 'TEI', '444'),
(5, 'Teknik Elektronika Komunikasi', 'TEK', '555'),
(6, 'Teknik Komputer dan Jaringan', 'TKJ', '666'),
(7, 'Teknik Otomasi Industri', 'TOI', '777'),
(8, 'Teknik Produksi & Penyiaran Program Pertelevisian', 'TP4', '888'),
(9, 'Teknik Pendingin dan Tata Udara', 'TPTU', '999');
-- --------------------------------------------------------
--
-- Table structure for table `siswa`
--
CREATE TABLE IF NOT EXISTS `siswa` (
  `nis` varchar(18) NOT NULL,
  `id_jurusan` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kelas` char(1) NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `agama` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telepon` varchar(12) NOT NULL,
  `gol_darah` char(2) NOT NULL,
  `foto` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `siswa`
--
INSERT INTO `siswa` (`nis`, `id_jurusan`, `nama`, `kelas`, `tahun_ajaran`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `agama`, `email`, `no_telepon`, `gol_darah`, `foto`) VALUES
('131', 1, 'Siswa RPL 1', 'A', '2013-2014', '', '', '0000-00-00', '', '', '', '', '', ''),
('1310', 5, 'Siswa TEK 2', 'B', '2013-2014', '', '', '0000-00-00', '', '', '', '', '', ''),
('1311', 6, 'Siswa TKJ 1', 'A', '2013-2014', '', '', '0000-00-00', '', '', '', '', '', ''),
('1312', 6, 'Siswa TKJ 2', 'B', '2013-2014', '', '', '0000-00-00', '', '', '', '', '', ''),
('1313', 7, 'Siswa TOI 1', 'A', '2013-2014', '', '', '0000-00-00', '', '', '', '', '', ''),
('1314', 7, 'Siswa TOI 2', 'B', '2013-2014', '', '', '0000-00-00', '', '', '', '', '', ''),
('1315', 8, 'Siswa TP4 1', 'A', '2013-2014', '', '', '0000-00-00', '', '', '', '', '', ''),
('1316', 8, 'Siswa TP4 2', 'B', '2013-2014', '', '', '0000-00-00', '', '', '', '', '', ''),
('1317', 9, 'Siswa TP 1', 'A', '2013-2014', '', '', '0000-00-00', '', '', '', '', '', ''),
('1318', 9, 'Siswa TP 2', 'B', '2013-2014', '', '', '0000-00-00', '', '', '', '', '', ''),
('132', 1, 'Siswa RPL 2', 'B', '2013-2014', '', '', '0000-00-00', '', '', '', '', '', ''),
('133', 2, 'Siswa KM 1', 'A', '2013-2014', '', '', '0000-00-00', '', '', '', '', '', ''),
('134', 2, 'Siswa KM 2', 'B', '2013-2014', '', '', '0000-00-00', '', '', '', '', '', ''),
('135', 3, 'Siswa KP 1', 'A', '2013-2014', '', '', '0000-00-00', '', '', '', '', '', ''),
('136', 3, 'Siswa KP 2', 'B', '2013-2014', '', '', '0000-00-00', '', '', '', '', '', ''),
('137', 4, 'Siswa TEI 1', 'A', '2013-2014', '', '', '0000-00-00', '', '', '', '', '', ''),
('138', 4, 'Siswa TEI 2', 'B', '2013-2014', '', '', '0000-00-00', '', '', '', '', '', ''),
('139', 5, 'Siswa TEK 1', 'A', '2013-2014', '', '', '0000-00-00', '', '', '', '', '', '');
-- --------------------------------------------------------
--
-- Table structure for table `tahun_ajaran`
--
CREATE TABLE IF NOT EXISTS `tahun_ajaran` (
`id_tahun_ajaran` int(10) NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL,
  `angkatan` int(3) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;
--
-- Dumping data for table `tahun_ajaran`
--
INSERT INTO `tahun_ajaran` (`id_tahun_ajaran`, `tahun_ajaran`, `angkatan`) VALUES
(1, '2013-2014', 40),
(2, '2014-2015', 41),
(3, '2015-2016', 42),
(4, '2016-2017', 43);
-- --------------------------------------------------------
--
--

-- Indexes for dumped tables
--
--
-- Indexes for table `al_kabupaten`
--
ALTER TABLE `al_kabupaten`
 ADD PRIMARY KEY (`id_kabupaten`);
--
-- Indexes for table `al_kecamatan`
--
ALTER TABLE `al_kecamatan`
 ADD PRIMARY KEY (`id_kecamatan`);
--
-- Indexes for table `al_kelurahan`
--
ALTER TABLE `al_kelurahan`
 ADD PRIMARY KEY (`id_kelurahan`);
--
-- Indexes for table `al_provinsi`
--
ALTER TABLE `al_provinsi`
 ADD PRIMARY KEY (`id_provinsi`);
--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
 ADD PRIMARY KEY (`nip_guru`);
--
-- Indexes for table `hb_berita`
--
ALTER TABLE `hb_berita`
 ADD PRIMARY KEY (`id_berita`);
--
-- Indexes for table `hb_du`
--
ALTER TABLE `hb_du`
 ADD PRIMARY KEY (`id_du`);
--
-- Indexes for table `hb_du_penerima`
--
ALTER TABLE `hb_du_penerima`
 ADD PRIMARY KEY (`id_du_penerima`);
--
-- Indexes for table `hb_du_permintaan_1`
--
ALTER TABLE `hb_du_permintaan_1`
 ADD PRIMARY KEY (`id_du_permintaan`);
--
-- Indexes for table `hb_du_permintaan_du`
--
ALTER TABLE `hb_du_permintaan_du`
 ADD PRIMARY KEY (`id_du_permintaan_du`);
--
-- Indexes for table `hb_du_umum`
--
ALTER TABLE `hb_du_umum`
 ADD PRIMARY KEY (`id_du`);
--
-- Indexes for table `hb_guru_jurusan`
--
ALTER TABLE `hb_guru_jurusan`
 ADD PRIMARY KEY (`id_guru_jurusan`);
--
-- Indexes for table `hb_login_operator`
--
ALTER TABLE `hb_login_operator`
 ADD PRIMARY KEY (`nip_nis`);
--
-- Indexes for table `hb_monitoring`
--
ALTER TABLE `hb_monitoring`
 ADD PRIMARY KEY (`id_monitoring`);
--
-- Indexes for table `hb_pengelola_hubin`
--
ALTER TABLE `hb_pengelola_hubin`
 ADD PRIMARY KEY (`username`);
--
-- Indexes for table `hb_prakerin`
--
ALTER TABLE `hb_prakerin`
 ADD PRIMARY KEY (`id_prakerin`);
--
-- Indexes for table `hb_riwayat_siswa`
--
ALTER TABLE `hb_riwayat_siswa`
 ADD PRIMARY KEY (`id_riwayat`);
--
-- Indexes for table `hb_user_admin`
--
ALTER TABLE `hb_user_admin`
 ADD PRIMARY KEY (`username`);
--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
 ADD PRIMARY KEY (`id_jurusan`);
--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
 ADD PRIMARY KEY (`nis`);
--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
 ADD PRIMARY KEY (`id_tahun_ajaran`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `al_kabupaten`
--
ALTER TABLE `al_kabupaten`
MODIFY `id_kabupaten` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `al_kecamatan`
--
ALTER TABLE `al_kecamatan`
MODIFY `id_kecamatan` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `al_kelurahan`
--
ALTER TABLE `al_kelurahan`
MODIFY `id_kelurahan` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `al_provinsi`
--
ALTER TABLE `al_provinsi`
MODIFY `id_provinsi` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hb_berita`
--
ALTER TABLE `hb_berita`
MODIFY `id_berita` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `hb_du`
--
ALTER TABLE `hb_du`
MODIFY `id_du` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `hb_du_penerima`
--
ALTER TABLE `hb_du_penerima`
MODIFY `id_du_penerima` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `hb_du_permintaan_1`
--
ALTER TABLE `hb_du_permintaan_1`
MODIFY `id_du_permintaan` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hb_du_permintaan_du`
--
ALTER TABLE `hb_du_permintaan_du`
MODIFY `id_du_permintaan_du` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hb_du_umum`
--
ALTER TABLE `hb_du_umum`
MODIFY `id_du` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hb_guru_jurusan`
--
ALTER TABLE `hb_guru_jurusan`
MODIFY `id_guru_jurusan` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `hb_monitoring`
--
ALTER TABLE `hb_monitoring`
MODIFY `id_monitoring` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hb_prakerin`
--
ALTER TABLE `hb_prakerin`
MODIFY `id_prakerin` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `hb_riwayat_siswa`
--
ALTER TABLE `hb_riwayat_siswa`
MODIFY `id_riwayat` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
MODIFY `id_jurusan` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
MODIFY `id_tahun_ajaran` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
