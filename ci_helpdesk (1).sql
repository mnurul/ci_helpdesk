-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jul 2020 pada 15.37
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_helpdesk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `askpending`
--

CREATE TABLE `askpending` (
  `idaskpending` varchar(7) NOT NULL,
  `ask` text NOT NULL,
  `tglask` timestamp NOT NULL DEFAULT current_timestamp(),
  `idcustomer` varchar(5) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `correctword`
--

CREATE TABLE `correctword` (
  `idword` varchar(7) NOT NULL,
  `word` varchar(30) NOT NULL,
  `correctword` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `idcustomer` varchar(5) NOT NULL,
  `namacustomer` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(13) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pic` varchar(30) NOT NULL,
  `customerproduct` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_emails`
--

CREATE TABLE `log_emails` (
  `idemail` varchar(7) NOT NULL,
  `idcustomer` varchar(5) NOT NULL,
  `emailto` varchar(30) NOT NULL,
  `emailcc` varchar(30) NOT NULL,
  `emailbcc` varchar(30) NOT NULL,
  `emailsubject` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `emailstatus` varchar(20) NOT NULL,
  `senddate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_tickets`
--

CREATE TABLE `log_tickets` (
  `idlogtickets` varchar(7) NOT NULL,
  `idticket` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `news`
--

CREATE TABLE `news` (
  `idnews` varchar(7) NOT NULL,
  `newsdate` timestamp NULL DEFAULT NULL,
  `title` varchar(20) NOT NULL,
  `detail` text NOT NULL,
  `iduser` varchar(6) NOT NULL,
  `createby` varchar(30) NOT NULL,
  `createon` timestamp NOT NULL DEFAULT current_timestamp(),
  `expired` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects`
--

CREATE TABLE `projects` (
  `idproject` varchar(6) NOT NULL,
  `namaproject` varchar(30) NOT NULL,
  `idcustomer` varchar(5) NOT NULL,
  `deliveyrbegin` timestamp NULL DEFAULT NULL,
  `deliveryend` timestamp NULL DEFAULT NULL,
  `installdate` timestamp NULL DEFAULT NULL,
  `installend` timestamp NULL DEFAULT NULL,
  `uatbegin` timestamp NULL DEFAULT NULL,
  `uatend` timestamp NULL DEFAULT NULL,
  `billstartdate` timestamp NULL DEFAULT NULL,
  `billdueend` timestamp NULL DEFAULT NULL,
  `warantyperiod` int(2) DEFAULT NULL,
  `contractstartdate` timestamp NULL DEFAULT NULL,
  `contractenddate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sla`
--

CREATE TABLE `sla` (
  `idsla` varchar(6) NOT NULL,
  `namasla` varchar(30) NOT NULL,
  `respontime` int(11) NOT NULL,
  `resolusitime` int(11) NOT NULL,
  `slawarning` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tickets`
--

CREATE TABLE `tickets` (
  `idtickets` varchar(6) NOT NULL,
  `idcustomer` varchar(5) NOT NULL,
  `iduser` varchar(6) NOT NULL,
  `idsla` varchar(6) NOT NULL,
  `reportdate` timestamp NULL DEFAULT NULL,
  `reportby` varchar(30) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `email` varchar(30) NOT NULL,
  `problemsummary` varchar(30) NOT NULL,
  `problemdetail` text NOT NULL,
  `ticketstatus` varchar(30) NOT NULL,
  `assigne` varchar(30) NOT NULL,
  `assignedate` timestamp NULL DEFAULT NULL,
  `pendingby` varchar(30) NOT NULL,
  `pendingdate` timestamp NULL DEFAULT NULL,
  `resolution` text NOT NULL,
  `resolveby` varchar(30) NOT NULL,
  `resolvedate` timestamp NULL DEFAULT NULL,
  `closeby` varchar(30) NOT NULL,
  `closedate` timestamp NULL DEFAULT NULL,
  `documentby` varchar(30) NOT NULL,
  `documentdate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmppropabilityvocab`
--

CREATE TABLE `tmppropabilityvocab` (
  `idtmpvocab` varchar(7) NOT NULL,
  `idvocab` varchar(6) NOT NULL,
  `jumpprobability` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `iduser` varchar(6) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level` varchar(30) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `emailcode` varchar(100) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `confirmed` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `vocabs`
--

CREATE TABLE `vocabs` (
  `idvocab` varchar(6) NOT NULL,
  `idcustomer` varchar(5) NOT NULL,
  `pic` varchar(30) NOT NULL,
  `server` varchar(15) NOT NULL,
  `ask` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `askpending`
--
ALTER TABLE `askpending`
  ADD PRIMARY KEY (`idaskpending`);

--
-- Indeks untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `correctword`
--
ALTER TABLE `correctword`
  ADD PRIMARY KEY (`idword`);

--
-- Indeks untuk tabel `log_emails`
--
ALTER TABLE `log_emails`
  ADD PRIMARY KEY (`idemail`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`idnews`);

--
-- Indeks untuk tabel `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`idproject`);

--
-- Indeks untuk tabel `sla`
--
ALTER TABLE `sla`
  ADD PRIMARY KEY (`idsla`);

--
-- Indeks untuk tabel `tmppropabilityvocab`
--
ALTER TABLE `tmppropabilityvocab`
  ADD PRIMARY KEY (`idtmpvocab`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`);

--
-- Indeks untuk tabel `vocabs`
--
ALTER TABLE `vocabs`
  ADD PRIMARY KEY (`idvocab`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
