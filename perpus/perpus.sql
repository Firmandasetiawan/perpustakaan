-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2024 at 02:01 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `bukuid` int(11) NOT NULL,
  `judul` varchar(25) NOT NULL,
  `penulis` varchar(25) NOT NULL,
  `penerbit` varchar(25) NOT NULL,
  `tahunterbit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`bukuid`, `judul`, `penulis`, `penerbit`, `tahunterbit`) VALUES
(537393188, 'b.indo', 'rudi', 'jaya', 2020),
(571560668, 'Bahasa Indonesia ', 'Asep', 'Ucup', 2020),
(860308837, 'test', 'test', 'test', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `kategoribuku`
--

CREATE TABLE `kategoribuku` (
  `kategoriid` int(11) NOT NULL,
  `namakategori` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategoribuku_relasi`
--

CREATE TABLE `kategoribuku_relasi` (
  `kategoribukuid` int(11) NOT NULL,
  `bukuid` int(11) NOT NULL,
  `kategoriid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `koleksipribadi`
--

CREATE TABLE `koleksipribadi` (
  `koleksiid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `bukuid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `peminjamanid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `bukuid` int(11) NOT NULL,
  `tanggalpeminjaman` date NOT NULL,
  `tanggalpengembalian` date NOT NULL,
  `statuspeminjaman` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`peminjamanid`, `userid`, `bukuid`, `tanggalpeminjaman`, `tanggalpengembalian`, `statuspeminjaman`) VALUES
(113293457, 799719238, 860308837, '2024-02-15', '2024-02-16', 'Dikembalikan'),
(175064086, 720782470, 537393188, '2024-02-15', '2024-02-16', 'Dikembalikan'),
(179046630, 169763183, 571560668, '2024-03-01', '2024-03-03', 'Dikembalikan'),
(201074218, 162045288, 256692504, '2024-02-22', '2024-02-24', 'Dikembalikan'),
(401684570, 799719238, 256692504, '2024-02-13', '2024-02-20', 'Dikembalikan'),
(405200195, 799719238, 256692504, '2024-02-13', '2024-02-20', 'Dikembalikan'),
(447799682, 494766235, 860308837, '2024-02-14', '2024-02-15', 'Dikembalikan'),
(616165161, 169763183, 571560668, '2024-03-03', '2024-03-04', 'Telat Dikembalikan'),
(616577148, 904281616, 537393188, '2024-02-22', '2024-02-23', 'Dikembalikan'),
(707214355, 720782470, 537393188, '2024-02-14', '2024-02-15', 'Dikembalikan'),
(818698120, 938201904, 537393188, '2024-02-28', '2024-02-29', 'Dikembalikan');

-- --------------------------------------------------------

--
-- Table structure for table `ulasanbuku`
--

CREATE TABLE `ulasanbuku` (
  `ulasanid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `bukuid` int(11) NOT NULL,
  `ulasan` varchar(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ulasanbuku`
--

INSERT INTO `ulasanbuku` (`ulasanid`, `userid`, `bukuid`, `ulasan`, `rating`) VALUES
(288058, 720782470, 537393188, 'bbbb', 4),
(417257, 294732666, 878326416, 'bbbbb', 5),
(488256, 904281616, 537393188, 'Mantap', 4),
(590594, 494766235, 256692504, 'bbb', 3),
(715975, 938201904, 537393188, 'Bagus', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `namalengkap` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `level` enum('Admin','Petugas','Peminjam') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `email`, `namalengkap`, `alamat`, `level`) VALUES
(162045288, 'asep', 'asep', 'asep00@gmail.com', 'asep asep', 'jambi', 'Petugas'),
(169763183, 'firmin', 'firmin', 'firmin@gmail.com', 'Firminda', 'Unit 6', 'Admin'),
(598641967, 'aaa', 'aaa', 'aaaa', 'aaa', 'aaa', 'Peminjam'),
(734405517, 'firman', '123', 'firmanda000@gmail.co', 'Firmanda Setiawan', 'bahar', 'Peminjam'),
(820758056, 'aaa', 'qqq', 'www', 'www', 'wwww', 'Peminjam'),
(872036743, 'firman', '123', 'firmanda000@gmail.co', 'Firmanda Setiawan', 'bahar', 'Peminjam'),
(904281616, 'ceceppp', '123', 'cecep11@gmail.com', 'cecep', 'jambi', 'Peminjam'),
(938201904, 'ucup', 'ucup', 'ucup123@gmail.com', 'ucuppp', 'bahar', 'Peminjam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`bukuid`);

--
-- Indexes for table `kategoribuku`
--
ALTER TABLE `kategoribuku`
  ADD PRIMARY KEY (`kategoriid`);

--
-- Indexes for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD PRIMARY KEY (`kategoribukuid`),
  ADD KEY `bukuid` (`bukuid`,`kategoriid`),
  ADD KEY `kategoriid` (`kategoriid`);

--
-- Indexes for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD PRIMARY KEY (`koleksiid`),
  ADD KEY `userid` (`userid`,`bukuid`),
  ADD KEY `bukuid` (`bukuid`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`peminjamanid`),
  ADD KEY `userid` (`userid`,`bukuid`),
  ADD KEY `bukuid` (`bukuid`);

--
-- Indexes for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  ADD PRIMARY KEY (`ulasanid`),
  ADD KEY `userid` (`userid`,`bukuid`),
  ADD KEY `bukuid` (`bukuid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD CONSTRAINT `kategoribuku_relasi_ibfk_1` FOREIGN KEY (`kategoriid`) REFERENCES `kategoribuku` (`kategoriid`),
  ADD CONSTRAINT `kategoribuku_relasi_ibfk_2` FOREIGN KEY (`bukuid`) REFERENCES `buku` (`bukuid`);

--
-- Constraints for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD CONSTRAINT `koleksipribadi_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`),
  ADD CONSTRAINT `koleksipribadi_ibfk_2` FOREIGN KEY (`bukuid`) REFERENCES `buku` (`bukuid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
