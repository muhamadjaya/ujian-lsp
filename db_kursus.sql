-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Agu 2022 pada 19.03
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kursus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jadwal`
--

CREATE TABLE `tb_jadwal` (
  `id_jadwal` int(3) NOT NULL,
  `id_kursus` int(3) NOT NULL,
  `waktu_kursus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kursus`
--

CREATE TABLE `tb_kursus` (
  `id_kursus` int(3) NOT NULL,
  `nama_kursus` varchar(50) NOT NULL,
  `keterangan_kursus` text NOT NULL,
  `durasi_kursus` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kursus`
--

INSERT INTO `tb_kursus` (`id_kursus`, `nama_kursus`, `keterangan_kursus`, `durasi_kursus`) VALUES
(1, 'Funda DBMS', 'Belajar Database', '7 Hari'),
(2, 'Funda Desktop', 'Belajar Pemrograman Desktop', '7 Hari'),
(3, 'Funda Web', 'Belajar Pemrograman Web', '7 Hari');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `id_laporan` int(3) NOT NULL,
  `id_mahasiswa` int(3) NOT NULL,
  `laporan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `id_mahasiswa` int(3) NOT NULL,
  `npm` varchar(8) NOT NULL,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `kelas` varchar(5) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`id_mahasiswa`, `npm`, `nama_mahasiswa`, `kelas`, `username`, `password`) VALUES
(1, '14118340', 'MUHAMAD JAYA', '4KA07', '14118340', '14118340');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pendaftaran_kursus`
--

CREATE TABLE `tb_pendaftaran_kursus` (
  `id_pendaftaran_kursus` int(3) NOT NULL,
  `id_mahasiswa` int(3) NOT NULL,
  `id_kursus` int(3) NOT NULL,
  `krs` text NOT NULL,
  `verifikasi` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pendaftaran_kursus`
--

INSERT INTO `tb_pendaftaran_kursus` (`id_pendaftaran_kursus`, `id_mahasiswa`, `id_kursus`, `krs`, `verifikasi`) VALUES
(1, 1, 1, 'krs_14118340.pdf', 1),
(2, 2, 1, 'krs_14118345.pdf', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `tb_kursus`
--
ALTER TABLE `tb_kursus`
  ADD PRIMARY KEY (`id_kursus`);

--
-- Indeks untuk tabel `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indeks untuk tabel `tb_pendaftaran_kursus`
--
ALTER TABLE `tb_pendaftaran_kursus`
  ADD PRIMARY KEY (`id_pendaftaran_kursus`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  MODIFY `id_jadwal` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_kursus`
--
ALTER TABLE `tb_kursus`
  MODIFY `id_kursus` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `id_laporan` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  MODIFY `id_mahasiswa` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_pendaftaran_kursus`
--
ALTER TABLE `tb_pendaftaran_kursus`
  MODIFY `id_pendaftaran_kursus` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
