-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Nov 2024 pada 13.18
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jual_beli_motor`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `motor`
--

CREATE TABLE `motor` (
  `id` int(11) NOT NULL,
  `nama_motor` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `motor`
--

INSERT INTO `motor` (`id`, `nama_motor`, `harga`, `deskripsi`, `gambar`) VALUES
(5, 'Vario 150', 25000000.00, 'No minus', 'Vario 150.jpg'),
(10, 'Aerox 175', 25000000.00, 'No minus,Full Modif', 'Aerox 175.jpg'),
(12, 'Vario 160', 23000000.00, 'Mulus like new', 'Vario 160.jpg'),
(13, 'ZX25R', 55000000.00, 'NO MINUS', 'ZX25R.jpg'),
(14, 'Beat Karbu', 4000000.00, 'No minus Bekas Anam', 'Beat karbu.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cookie` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `cookie`, `created_at`) VALUES
(1, 'Eka', '$2y$10$nlxiDUAKE4ayeeNZZ9tdYek5thMMc/T/O/oP9juB19aoXNDzK1wla', '', '2024-11-05 06:21:41'),
(2, 'Ikhwan', '$2y$10$hlLVZ6/d5jL6yKZiQxcfzuphDU3dZ8BIbjzyX.00uIlIqJlceLsp.', '', '2024-11-05 07:05:34'),
(3, 'Banu', '$2y$10$UytV5V9rK9.zkafwebkmQ.LVQqlzRm.z58Q7Jak/tU8YhdweR3HU2', '', '2024-11-05 07:20:00'),
(4, 'Royyan', '$2y$10$bXtJGZBCWterQfD8DnJXGOBGbm0.K0M1060cQ46/phogAB6NG/0hi', 'Royyan', '2024-11-05 08:15:06'),
(5, 'Hamdan', '$2y$10$OJBIIWRfAiL2pKWktZkoy.jkSQyx3v3OaAPUTc1zxOIi0VPrN8HIS', '', '2024-11-05 08:35:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `motor`
--
ALTER TABLE `motor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `motor`
--
ALTER TABLE `motor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
