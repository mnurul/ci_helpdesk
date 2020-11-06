-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Okt 2020 pada 10.22
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
-- Struktur dari tabel `asking`
--

CREATE TABLE `asking` (
  `idasking` int(11) NOT NULL,
  `jenisedc` varchar(30) NOT NULL,
  `lokasi` text NOT NULL,
  `pic` varchar(30) NOT NULL,
  `pertanyaan` text NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `askpending`
--

CREATE TABLE `askpending` (
  `idaskpending` int(11) NOT NULL,
  `ask` text NOT NULL,
  `tglask` timestamp NOT NULL DEFAULT current_timestamp(),
  `idcustomer` varchar(5) NOT NULL,
  `status` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `askpending`
--

INSERT INTO `askpending` (`idaskpending`, `ask`, `tglask`, `idcustomer`, `status`, `email`) VALUES
(1, 'tidak', '2020-09-11 15:50:59', 'cs002', '1', ''),
(2, 'tidak', '2020-09-11 15:51:08', 'cs002', '1', ''),
(3, 'tidak', '2020-09-11 15:51:31', 'cs002', '1', ''),
(4, 'tidak', '2020-09-11 15:51:34', 'cs002', '1', ''),
(5, 'tidak', '2020-09-11 15:51:35', 'cs002', '1', ''),
(6, 'tidak', '2020-09-11 15:51:35', 'cs002', '1', ''),
(7, 'tidak', '2020-09-11 15:52:02', 'cs003', '1', ''),
(8, 'tidak', '2020-09-11 15:53:46', 'cs003', '1', ''),
(9, 'tidak', '2020-09-11 15:55:15', 'cs003', '1', ''),
(10, 'tidak', '2020-09-11 15:58:45', 'cs003', '1', ''),
(11, 'tidak', '2020-09-11 16:02:50', 'cs003', '1', ''),
(12, 'tidak', '2020-09-11 16:09:09', 'cs003', '1', ''),
(13, 'tidak', '2020-09-11 16:10:02', 'cs003', '1', ''),
(14, 'tidak', '2020-09-11 16:28:37', 'cs003', '1', ''),
(15, 'tidak', '2020-09-11 16:29:49', 'cs003', '1', ''),
(16, 'tidak', '2020-09-11 15:35:21', 'cs003', '1', ''),
(17, 'tidak', '2020-09-11 15:40:12', 'cs003', '1', 'nozehoveka@mailinator.com'),
(18, 'printer tidak hidup', '2020-09-11 15:45:17', 'cs003', '1', 'nozehoveka@mailinator.com'),
(19, 'tidak', '2020-09-11 15:49:51', 'cs003', '1', 'nozehoveka@mailinator.com'),
(20, 'tidak', '2020-09-11 15:52:08', 'cs003', '1', 'nozehoveka@mailinator.com'),
(21, 'tidak', '2020-09-11 15:54:34', 'cs003', '1', 'nozehoveka@mailinator.com'),
(22, 'tidak', '2020-09-11 16:03:19', 'cs003', '1', 'nozehoveka@mailinator.com'),
(23, 'printer tidak hidup', '2020-09-11 16:06:06', 'cs003', '1', 'nozehoveka@mailinator.com'),
(24, 'tidak', '2020-09-11 16:10:07', 'cs003', '1', 'nozehoveka@mailinator.com'),
(25, 'card edc error', '2020-09-11 16:11:31', 'cs003', '1', 'nozehoveka@mailinator.com'),
(26, 'card edc error', '2020-09-11 15:35:31', 'cs003', '1', 'nozehoveka@mailinator.com'),
(27, 'card edc error', '2020-09-11 15:39:27', 'cs003', '1', 'nozehoveka@mailinator.com'),
(28, 'card edc eror', '2020-09-11 15:40:44', 'cs003', '1', 'nozehoveka@mailinator.com'),
(29, 'error', '2020-09-11 15:44:25', 'cs003', '1', 'nozehoveka@mailinator.com'),
(30, 'error', '2020-09-11 15:44:54', 'cs003', '1', 'nozehoveka@mailinator.com'),
(31, 'error', '2020-09-11 15:45:26', 'cs003', '1', 'nozehoveka@mailinator.com'),
(32, 'error', '2020-09-11 15:48:42', 'cs003', '1', 'nozehoveka@mailinator.com'),
(33, 'error error', '2020-09-11 15:50:30', 'cs003', '1', 'nozehoveka@mailinator.com'),
(34, 'error error', '2020-09-11 15:50:50', 'cs003', '1', 'nozehoveka@mailinator.com'),
(35, 'error error', '2020-09-11 15:51:33', 'cs003', '1', 'nozehoveka@mailinator.com'),
(36, 'error error', '2020-09-11 15:53:39', 'cs003', '1', 'nozehoveka@mailinator.com'),
(37, 'error error', '2020-09-11 15:54:14', 'cs003', '1', 'nozehoveka@mailinator.com'),
(38, 'error', '2020-09-11 15:54:29', 'cs003', '1', 'nozehoveka@mailinator.com'),
(39, 'error', '2020-09-11 15:59:53', 'cs003', '1', 'nozehoveka@mailinator.com'),
(40, 'error', '2020-09-11 16:00:51', 'cs003', '1', 'nozehoveka@mailinator.com'),
(41, 'error', '2020-09-11 16:03:41', 'cs003', '1', 'nozehoveka@mailinator.com'),
(42, 'error', '2020-09-11 16:04:04', 'cs003', '1', 'nozehoveka@mailinator.com'),
(43, 'error', '2020-09-11 16:05:47', 'cs003', '1', 'nozehoveka@mailinator.com'),
(44, 'error', '2020-09-11 16:06:03', 'cs003', '1', 'nozehoveka@mailinator.com'),
(45, 'error', '2020-09-11 16:06:14', 'cs003', '1', 'nozehoveka@mailinator.com'),
(46, 'error', '2020-10-03 02:07:06', 'cs003', '1', 'nozehoveka@mailinator.com'),
(47, 'error', '2020-10-03 02:07:07', 'cs003', '1', 'nozehoveka@mailinator.com'),
(48, 'error', '2020-10-03 02:07:43', 'cs003', '1', 'nozehoveka@mailinator.com'),
(49, 'error', '2020-10-03 02:08:10', 'cs003', '1', 'nozehoveka@mailinator.com'),
(50, 'error', '2020-10-03 02:18:50', 'cs003', '1', 'nozehoveka@mailinator.com'),
(51, 'error', '2020-10-03 02:19:18', 'cs003', '1', 'nozehoveka@mailinator.com'),
(52, 'error', '2020-10-03 02:20:13', 'cs003', '1', 'nozehoveka@mailinator.com'),
(53, 'error', '2020-10-03 02:22:38', 'cs003', '1', 'nozehoveka@mailinator.com'),
(54, 'error', '2020-10-03 02:24:53', 'cs003', '1', 'nozehoveka@mailinator.com'),
(55, 'error', '2020-10-03 02:25:17', 'cs003', '1', 'nozehoveka@mailinator.com'),
(56, 'error', '2020-10-03 02:30:02', 'cs003', '1', 'nozehoveka@mailinator.com'),
(57, 'error', '2020-10-03 02:30:03', 'cs003', '1', 'nozehoveka@mailinator.com'),
(58, 'error', '2020-10-03 02:30:09', 'cs003', '1', 'nozehoveka@mailinator.com'),
(59, 'error', '2020-10-03 02:31:04', 'cs003', '1', 'nozehoveka@mailinator.com'),
(60, 'error', '2020-10-03 02:31:30', 'cs003', '1', 'nozehoveka@mailinator.com'),
(61, 'error', '2020-10-03 02:33:44', 'cs003', '1', 'nozehoveka@mailinator.com'),
(62, 'error', '2020-10-03 02:34:20', 'cs003', '1', 'nozehoveka@mailinator.com'),
(63, 'error', '2020-10-03 02:36:53', 'cs003', '1', 'nozehoveka@mailinator.com'),
(64, 'error', '2020-10-03 02:38:28', 'cs003', '1', 'nozehoveka@mailinator.com'),
(65, 'error', '2020-10-03 02:42:28', 'cs003', '1', 'nozehoveka@mailinator.com'),
(66, 'error', '2020-10-03 02:43:48', 'cs003', '1', 'nozehoveka@mailinator.com'),
(67, 'error', '2020-10-03 02:46:22', 'cs003', '1', 'nozehoveka@mailinator.com'),
(68, 'error', '2020-10-03 02:46:56', 'cs003', '1', 'nozehoveka@mailinator.com'),
(69, 'error', '2020-10-03 02:48:00', 'cs003', '1', 'nozehoveka@mailinator.com'),
(70, 'error', '2020-10-03 02:49:10', 'cs003', '1', 'nozehoveka@mailinator.com'),
(71, 'error', '2020-10-03 02:49:44', 'cs003', '1', 'nozehoveka@mailinator.com'),
(72, 'error', '2020-10-03 02:52:11', 'cs003', '1', 'nozehoveka@mailinator.com'),
(73, 'error', '2020-10-03 02:03:55', 'cs003', '1', 'nozehoveka@mailinator.com'),
(74, 'error', '2020-10-03 02:04:20', 'cs003', '1', 'nozehoveka@mailinator.com'),
(75, 'error', '2020-10-03 02:00:16', 'cs003', '1', 'nozehoveka@mailinator.com'),
(76, 'error', '2020-10-03 02:10:06', 'cs003', '1', 'nozehoveka@mailinator.com'),
(77, 'error', '2020-10-03 02:19:16', 'cs003', '1', 'nozehoveka@mailinator.com'),
(78, 'error', '2020-10-03 02:19:56', 'cs003', '1', 'nozehoveka@mailinator.com'),
(79, 'error', '2020-10-03 02:22:07', 'cs003', '1', 'nozehoveka@mailinator.com'),
(80, 'error', '2020-10-03 02:23:31', 'cs003', '1', 'nozehoveka@mailinator.com'),
(81, 'error', '2020-10-03 02:24:12', 'cs003', '1', 'nozehoveka@mailinator.com'),
(82, 'error', '2020-10-03 02:24:59', 'cs003', '1', 'nozehoveka@mailinator.com'),
(83, 'error', '2020-10-03 02:25:22', 'cs003', '1', 'nozehoveka@mailinator.com'),
(84, 'error', '2020-10-03 02:25:38', 'cs003', '1', 'nozehoveka@mailinator.com'),
(85, 'error', '2020-10-03 02:31:41', 'cs003', '1', 'nozehoveka@mailinator.com'),
(86, 'error', '2020-10-03 02:31:54', 'cs003', '1', 'nozehoveka@mailinator.com'),
(87, 'error', '2020-10-03 02:32:11', 'cs003', '1', 'nozehoveka@mailinator.com'),
(88, 'edc', '2020-10-03 02:33:53', 'cs003', '1', 'nozehoveka@mailinator.com'),
(89, 'card', '2020-10-03 02:39:12', 'cs003', '1', 'nozehoveka@mailinator.com'),
(90, 'card', '2020-10-03 02:42:54', 'cs003', '1', 'nozehoveka@mailinator.com'),
(91, 'card', '2020-10-03 02:43:10', 'cs003', '1', 'nozehoveka@mailinator.com'),
(92, 'card', '2020-10-03 02:51:05', 'cs003', '1', 'nozehoveka@mailinator.com'),
(93, 'card edc', '2020-10-03 02:51:43', 'cs003', '1', 'nozehoveka@mailinator.com'),
(94, 'card', '2020-10-03 02:52:11', 'cs003', '1', 'nozehoveka@mailinator.com'),
(95, 'card edc', '2020-10-03 02:52:46', 'cs003', '1', 'nozehoveka@mailinator.com'),
(96, 'edc', '2020-10-03 02:53:27', 'cs003', '1', 'nozehoveka@mailinator.com'),
(97, 'error', '2020-10-03 02:02:17', 'cs003', '1', 'nozehoveka@mailinator.com'),
(98, 'edc', '2020-10-03 02:02:59', 'cs003', '1', 'nozehoveka@mailinator.com'),
(99, 'edc', '2020-10-03 02:25:51', 'cs003', '1', 'nozehoveka@mailinator.com'),
(100, 'edc', '2020-10-03 02:26:27', 'cs003', '1', 'nozehoveka@mailinator.com'),
(101, 'edc', '2020-10-03 02:26:42', 'cs003', '1', 'nozehoveka@mailinator.com'),
(102, 'card edc', '2020-10-03 02:27:26', 'cs003', '1', 'nozehoveka@mailinator.com'),
(103, 'edc', '2020-10-03 02:30:32', 'cs003', '1', 'nozehoveka@mailinator.com'),
(104, 'edc', '2020-10-03 02:02:31', 'cs003', '1', 'nozehoveka@mailinator.com'),
(105, 'edc', '2020-10-03 02:03:06', 'cs003', '1', 'nozehoveka@mailinator.com'),
(106, 'edc', '2020-10-03 02:03:24', 'cs003', '1', 'nozehoveka@mailinator.com'),
(107, 'printer tidak hidup', '2020-10-05 19:51:39', 'cs001', '1', 'nozehoveka@mailinator.com'),
(108, 'printer tidak hidup', '2020-10-05 19:53:17', 'cs001', '1', 'nozehoveka@mailinator.com'),
(109, 'printer tidak hidup', '2020-10-05 19:53:39', 'cs001', '1', 'nozehoveka@mailinator.com'),
(110, 'printer tidak hidup', '2020-10-05 19:54:22', 'cs001', '1', 'nozehoveka@mailinator.com'),
(111, 'printer tidak nyala', '2020-10-05 19:56:08', 'cs001', '1', 'nozehoveka@mailinator.com'),
(112, 'printer tidak nyala', '2020-10-05 19:56:34', 'cs001', '1', 'nozehoveka@mailinator.com'),
(113, 'printer tidak hidup', '2020-10-05 19:57:40', 'cs001', '1', 'nozehoveka@mailinator.com'),
(114, 'printer tidak hidup', '2020-10-05 19:58:21', 'cs001', '1', 'nozehoveka@mailinator.com'),
(115, 'printer tidak hidup', '2020-10-05 20:01:24', 'cs001', '1', 'nozehoveka@mailinator.com'),
(116, 'printer tidak hidup', '2020-10-05 20:03:28', 'cs001', '1', 'nozehoveka@mailinator.com'),
(117, 'printer tidak hidup', '2020-10-05 20:04:11', 'cs001', '1', 'nozehoveka@mailinator.com'),
(118, 'printer tidak hidup', '2020-10-05 20:04:11', 'cs001', '1', 'nozehoveka@mailinator.com'),
(119, 'printer tidak nyala', '2020-10-05 20:04:52', 'cs001', '1', 'nozehoveka@mailinator.com'),
(120, 'printer tidak nyala', '2020-10-05 20:04:52', 'cs001', '1', 'nozehoveka@mailinator.com'),
(121, 'printer tidak nyala', '2020-10-05 20:05:59', 'cs001', '1', 'nozehoveka@mailinator.com'),
(122, 'printer tidak nyala', '2020-10-05 20:05:59', 'cs001', '1', 'nozehoveka@mailinator.com'),
(123, 'printer tidak hidup', '2020-10-05 20:07:18', 'cs001', '1', 'nozehoveka@mailinator.com'),
(124, 'printer tidak hidup', '2020-10-05 20:07:18', 'cs001', '1', 'nozehoveka@mailinator.com'),
(125, 'printer tidak hidup', '2020-10-05 20:08:28', 'cs001', '1', 'nozehoveka@mailinator.com'),
(126, 'printer tidak hidup', '2020-10-05 20:08:28', 'cs001', '1', 'nozehoveka@mailinator.com'),
(127, 'printer tidak nyala', '2020-10-06 08:09:25', 'cs001', '1', ''),
(128, 'printer tidak nyala', '2020-10-05 20:10:03', 'cs001', '1', 'nozehoveka@mailinator.com'),
(129, 'printer tidak nyala', '2020-10-05 20:10:03', 'cs001', '1', 'nozehoveka@mailinator.com'),
(130, 'printer tidak nyala', '2020-10-05 19:26:25', 'cs001', '1', 'nozehoveka@mailinator.com'),
(131, 'printer tidak nyala', '2020-10-05 19:26:25', 'cs001', '1', 'nozehoveka@mailinator.com'),
(132, 'printer tidak nyala', '2020-10-05 19:26:34', 'cs001', '1', 'nozehoveka@mailinator.com'),
(133, 'printer tidak nyala', '2020-10-05 20:10:18', 'cs001', '1', 'nozehoveka@mailinator.com'),
(134, 'printer tidak nyala', '2020-10-05 20:15:08', 'cs001', '1', 'nozehoveka@mailinator.com'),
(135, 'printer tidak hidup', '2020-10-05 20:15:40', 'cs001', '1', 'nozehoveka@mailinator.com'),
(136, 'printer tidak hidup', '2020-10-05 20:15:57', 'cs001', '1', 'nozehoveka@mailinator.com'),
(137, 'printer tidak hidup', '2020-10-05 20:17:53', 'cs001', '1', 'nozehoveka@mailinator.com'),
(138, 'printer tidak hidup', '2020-10-05 20:18:23', 'cs001', '1', 'nozehoveka@mailinator.com'),
(139, 'printer tidak hidup', '2020-10-05 19:37:08', 'cs001', '1', 'nozehoveka@mailinator.com'),
(140, 'card edc error', '2020-10-05 19:34:18', 'cs003', '1', 'nozehoveka@mailinator.com'),
(141, 'printer edc error', '2020-10-05 19:37:29', 'cs002', '1', 'nozehoveka@mailinator.com');

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
  `word` varchar(30) NOT NULL,
  `id` int(11) NOT NULL,
  `correctword` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `correctword`
--

INSERT INTO `correctword` (`word`, `id`, `correctword`) VALUES
('eror', 3, 'error'),
('edv', 4, 'edc'),
('progra', 5, 'program'),
('carf', 6, 'card'),
('printe', 7, 'printer'),
('q', 8, 'saya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `csproduct`
--

CREATE TABLE `csproduct` (
  `idcustomer` varchar(5) NOT NULL,
  `csproduct` varchar(20) NOT NULL,
  `jenisedc` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `csproduct`
--

INSERT INTO `csproduct` (`idcustomer`, `csproduct`, `jenisedc`) VALUES
('Conse', 'Penggantian EDC ', ''),
('cs001', 'EDC', ''),
('cs002', 'DATA', ''),
('Ex qu', 'Ratione magnam occae', ''),
('Expli', 'Aperiam corporis rep', ''),
('Verit', 'Doloremque amet quo', ''),
('cs001', 'Kabel EDC', ''),
('cs001', 'Commodo tempora est ', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `idcustomer` varchar(5) NOT NULL,
  `csnama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(13) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pic` varchar(30) NOT NULL,
  `time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`idcustomer`, `csnama`, `alamat`, `telp`, `email`, `pic`, `time`) VALUES
('cs001', 'MCD', 'Bekasi Timur', '0881116785623', 'mcd@gmail.com', 'ari', '2020-08-13'),
('cs002', 'PHD', 'Bekasi Utara', '0881116785623', 'phd@gmail.com', 'randi', '2020-08-13'),
('cs003', 'KFC', 'Bekasi Selatan', '081234555', 'kfc@gmail.com', 'ali', '0000-00-00'),
('cs004', 'CFC', 'Bekasi Selatan', '089767999', 'cfc@gmail.com', 'indra', '2020-08-13'),
('cs005', '', '', '', '', '', '0000-00-00'),
('cs006', '', '', '', '', '', '0000-00-00'),
('cs007', '', '', '', '', '', '0000-00-00'),
('cs008', '', '', '', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `edc`
--

CREATE TABLE `edc` (
  `id` int(11) NOT NULL,
  `jenisedc` varchar(30) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `pic` varchar(30) NOT NULL,
  `pertanyaan` text NOT NULL,
  `idtmpvocab` varchar(7) NOT NULL,
  `idcustomer` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `edc`
--

INSERT INTO `edc` (`id`, `jenisedc`, `lokasi`, `pic`, `pertanyaan`, `idtmpvocab`, `idcustomer`) VALUES
(1, 'Verifone', 'Bekasi Timur', 'Ari', 'program edc error', '', 'cs001'),
(2, 'Pax', 'Bekasi Utara', 'Randi', 'display edc error', '', 'cs002'),
(3, 'Ingenico', 'Bekasi Selatan', 'Ali', 'card edc error', '', 'cs003'),
(5, 'Ingenico', 'Bekasi Selatan', 'Indra', 'ecyription edc error', '', 'cs004'),
(6, 'Verifone', 'Bekasi Timur', 'Jess', 'printer edc error', '', 'cs005');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `idgejala` varchar(6) NOT NULL,
  `namagejala` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kerusakan`
--

CREATE TABLE `kerusakan` (
  `idkerusakan` varchar(6) NOT NULL,
  `namakerusakan` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `idsolusi` varchar(6) NOT NULL
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
-- Struktur dari tabel `mst_edc`
--

CREATE TABLE `mst_edc` (
  `idedc` int(11) NOT NULL,
  `jenisedc` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mst_edc`
--

INSERT INTO `mst_edc` (`idedc`, `jenisedc`) VALUES
(1, 'verifone'),
(2, 'pax'),
(3, 'ingenico');

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
-- Struktur dari tabel `probvocabs`
--

CREATE TABLE `probvocabs` (
  `idedc` int(11) NOT NULL,
  `ask` varchar(30) NOT NULL,
  `answer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `probvocabs`
--

INSERT INTO `probvocabs` (`idedc`, `ask`, `answer`) VALUES
(1, 'program edc error', 'Restart EDC'),
(1, 'display edc error', 'Restart EDC'),
(1, 'card edc error', 'Melakukan Insert kartu dengan '),
(1, 'ecyription edc error', 'Masukkan PIN dengan benar'),
(1, 'printer edc error', 'Lakukan penggantian Adaptor EDC'),
(2, 'program edc error', 'Restart EDC'),
(2, 'display edc error', 'Restart EDC'),
(2, 'card edc error', 'Melakukan Insert kartu dengan sempurna'),
(2, 'ecyription edc error', 'Masukkan PIN dengan benar'),
(2, 'printer edc error', 'Lakukan penggantian Adaptor EDC'),
(3, 'program edc error', 'Restart EDC'),
(3, 'display edc error', 'Restart EDC'),
(3, 'card edc error', 'Melakukan Insert kartu dengan sempurna'),
(3, 'ecyription edc error', 'Masukkan PIN dengan benar'),
(3, 'printer edc error', 'Lakukan penggantian Adaptor EDC');

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects`
--

CREATE TABLE `projects` (
  `idproject` varchar(6) NOT NULL,
  `namaproject` varchar(30) NOT NULL,
  `idcustomer` varchar(5) NOT NULL,
  `deliveyrbegin` date DEFAULT NULL,
  `deliveryend` date DEFAULT NULL,
  `installdate` date DEFAULT NULL,
  `installend` date DEFAULT NULL,
  `uatbegin` date DEFAULT NULL,
  `uatend` date DEFAULT NULL,
  `billstartdate` date DEFAULT NULL,
  `billdueend` date DEFAULT NULL,
  `warantyperiod` int(2) DEFAULT NULL,
  `contractstartdate` date DEFAULT NULL,
  `contractenddate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `projects`
--

INSERT INTO `projects` (`idproject`, `namaproject`, `idcustomer`, `deliveyrbegin`, `deliveryend`, `installdate`, `installend`, `uatbegin`, `uatend`, `billstartdate`, `billdueend`, `warantyperiod`, `contractstartdate`, `contractenddate`) VALUES
('pjt001', 'Verifone', 'cs001', '2020-07-01', '2020-07-14', '2020-07-08', '2020-07-14', '2020-07-15', '2020-07-21', '2020-07-08', '2020-07-14', 2, '2020-07-08', 12),
('pjt002', 'Verifone', 'cs001', '2020-07-01', '2020-07-14', '2020-07-08', '2020-07-14', '2020-07-15', '2020-07-19', '2020-07-06', '2020-07-14', 2, '2020-07-08', 12),
('pjt003', 'Pax', 'cs002', '2020-08-15', '2020-05-27', '2020-06-08', '2020-02-03', '2020-05-01', '2020-08-27', '2020-04-11', '2020-10-14', 2, '2020-03-13', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `revise`
--

CREATE TABLE `revise` (
  `idrevise` varchar(6) NOT NULL,
  `nilaidiagnosa` int(11) NOT NULL,
  `idkerusakan` varchar(6) NOT NULL,
  `idgejala` varchar(6) NOT NULL,
  `statusrevise` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rule`
--

CREATE TABLE `rule` (
  `idrule` varchar(6) NOT NULL,
  `namarule` varchar(50) NOT NULL,
  `idgejala` varchar(6) NOT NULL
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

--
-- Dumping data untuk tabel `sla`
--

INSERT INTO `sla` (`idsla`, `namasla`, `respontime`, `resolusitime`, `slawarning`) VALUES
('1', 'Critical', 1, 6, 4),
('2', 'High', 1, 24, 20),
('3', 'Medium', 1, 72, 50),
('4', 'Low', 1, 360, 270);

-- --------------------------------------------------------

--
-- Struktur dari tabel `solusi`
--

CREATE TABLE `solusi` (
  `idsolusi` varchar(6) NOT NULL,
  `namasolusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tester`
--

CREATE TABLE `tester` (
  `id` int(11) NOT NULL,
  `hasil` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tester`
--

INSERT INTO `tester` (`id`, `hasil`) VALUES
(1, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tickets`
--

CREATE TABLE `tickets` (
  `idtickets` int(11) NOT NULL,
  `idcustomer` varchar(6) NOT NULL,
  `iduser` varchar(6) NOT NULL,
  `noticket` varchar(30) NOT NULL,
  `idsla` varchar(6) NOT NULL,
  `reportdate` date DEFAULT current_timestamp(),
  `reportby` varchar(30) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `email` varchar(30) NOT NULL,
  `problemsummary` varchar(30) NOT NULL,
  `problemdetail` text NOT NULL,
  `ticketstatus` varchar(30) NOT NULL,
  `assigne` varchar(6) NOT NULL,
  `assignedate` date DEFAULT NULL,
  `pendingby` varchar(30) NOT NULL,
  `pendingdate` date DEFAULT NULL,
  `resolution` text NOT NULL,
  `resolveby` varchar(30) NOT NULL,
  `resolvedate` date DEFAULT NULL,
  `closeby` varchar(30) NOT NULL,
  `closedate` date DEFAULT NULL,
  `documentby` varchar(30) NOT NULL,
  `documentdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tickets`
--

INSERT INTO `tickets` (`idtickets`, `idcustomer`, `iduser`, `noticket`, `idsla`, `reportdate`, `reportby`, `telp`, `email`, `problemsummary`, `problemdetail`, `ticketstatus`, `assigne`, `assignedate`, `pendingby`, `pendingdate`, `resolution`, `resolveby`, `resolvedate`, `closeby`, `closedate`, `documentby`, `documentdate`) VALUES
(1, 'cs001', '', '1/HD/Aug/2020', '1', '2020-08-02', 'Ut ad officia reicie', '', '', 'EDC tidak bisa input pin', 'Sunt voluptates exce', 'Closed', 'usr002', '2020-08-10', '', NULL, 'EDC direset ulang', 'usr002', '2020-08-10', 'usr001', '2020-08-10', '', NULL),
(3, 'cs001', '', '2/HD/Aug/2020', '2', '2020-08-02', 'Neque voluptas venia', '', '', 'Kabel ada yang terkelupas', 'Possimus voluptatem', 'Assigned', 'usr002', '2020-08-10', '', NULL, '', '', NULL, '', NULL, '', NULL),
(5, 'cs001', '', '3/HD/Aug/2020', '1', '2020-08-08', 'Animi porro sed cup', '', '', 'Nobis vel hic sed es', 'Expedita nemo dolore', 'Assigned', 'usr002', '2020-10-22', '', NULL, '', '', NULL, '', NULL, '', NULL),
(6, 'cs001', '', '3/HD/Aug/2020', '1', '2020-08-08', 'Animi porro sed cup', '', '', 'Nobis vel hic sed es', 'Expedita nemo dolore', 'Assigned', 'Aliqua', '2020-10-22', '', NULL, '', '', NULL, '', NULL, '', NULL),
(7, 'cs001', '', '2/HD/Aug/2020', '1', '2020-08-02', 'Neque voluptas venia', '', '', 'Kabel ada yang terkelupas', 'Possimus voluptatem', 'Assigned', 'Et cum', '2020-08-10', '', NULL, '', '', NULL, '', NULL, '', NULL),
(8, 'cs001', '', '2/HD/Aug/2020', '4', '2020-08-02', 'Neque voluptas venia', '', '', 'Kabel ada yang terkelupas', 'Possimus voluptatem', 'Assigned', 'Aliqua', '2020-08-10', '', NULL, '', '', NULL, '', NULL, '', NULL),
(10, ' cs001', '', '5/HD/Aug/2020', '1', '2020-08-08', 'Occaecat nisi odit e', '', '', 'Necessitatibus volup', 'Aliquid corporis vol', 'Assigned', 'usr002', '2020-08-08', '', NULL, '', '', NULL, '', NULL, '', NULL),
(12, ' cs001', '', '7/HD/Oct/2020', '2', '2020-10-06', 'Adi', '', '', 'EDC error', 'EDC tidak mau menyala', 'Assigned', 'Aliqua', NULL, '', NULL, '', '', NULL, '', NULL, '', NULL),
(13, ' cs001', '', '14/HD/Oct/2020', '1', '2020-10-06', 'michael', '', '', 'printer tidak hidup ', '', 'Assigned', 'Dolore', NULL, '', NULL, '', '', NULL, '', NULL, '', NULL),
(14, 'cs002', '', '32/HD/Oct/2020', '2', '2020-10-27', 'randi', '', '', 'ecyription edc error', '', 'Closed', 'usr002', '2020-10-27', '', NULL, 'Mesin edc harus diganti', 'usr002', '2020-10-27', 'usr001', '2020-10-27', '', NULL),
(15, 'cs002', '', '33/HD/Oct/2020', '1', '2020-10-27', 'randi', '', '', 'card edc error', '', 'Resolved', 'usr002', '2020-10-27', '', NULL, 'Mesin edc ganti', 'usr002', '2020-10-27', '', NULL, '', NULL),
(16, ' cs001', '', '34/HD/Oct/2020', '1', '2020-10-27', 'ari', '', '', 'printer edc error', '', 'Assigned', 'usr002', NULL, '', NULL, '', '', NULL, '', NULL, '', NULL),
(17, ' cs001', '', '35/HD/Oct/2020', '1', '2020-10-27', 'ari', '', '', 'card edc error', '', 'Assigned', 'usr002', NULL, '', NULL, '', '', NULL, '', NULL, '', NULL),
(18, ' cs002', '', '36/HD/Oct/2020', '4', '2020-10-27', 'randi', '', '', 'program edc error', '', 'Closed', 'usr002', '2020-10-27', '', NULL, 'Mesin Edc harus direset ulang', 'usr002', '2020-10-27', 'usr001', '2020-10-27', '', NULL),
(19, ' cs002', '', '36/HD/Oct/2020', '3', '2020-10-27', 'randi', '', '', 'program edc error', '', 'Assigned', 'usr002', NULL, '', NULL, '', '', NULL, '', NULL, '', NULL),
(20, ' cs002', '', '36/HD/Oct/2020', '1', '2020-10-27', 'randi', '', '', 'program edc error', '', 'Assigned', 'usr002', NULL, '', NULL, '', '', NULL, '', NULL, '', NULL),
(21, ' cs002', '', '36/HD/Oct/2020', '4', '2020-10-27', 'randi', '', '', 'program edc error', '', 'Assigned', 'usr002', NULL, '', NULL, '', '', NULL, '', NULL, '', NULL),
(22, ' cs002', '', '37/HD/Oct/2020', '3', '2020-10-27', 'randi', '', '', 'printer edc error', '', 'Closed', 'usr002', '2020-10-27', '', NULL, 'Mesin Edc harus diganti', 'usr002', '2020-10-27', 'usr001', '2020-10-27', '', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmppropabilityvocab`
--

CREATE TABLE `tmppropabilityvocab` (
  `idtmpvocab` int(11) NOT NULL,
  `idcustomer` varchar(5) NOT NULL,
  `idvocab` int(11) NOT NULL,
  `jumpprobability` double(10,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `iduser` varchar(6) NOT NULL,
  `idcustomer` varchar(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level` varchar(30) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `emailcode` varchar(100) NOT NULL,
  `time` date NOT NULL DEFAULT current_timestamp(),
  `confirmed` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `is_active` int(1) NOT NULL,
  `data_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`iduser`, `idcustomer`, `username`, `password`, `level`, `fullname`, `email`, `telp`, `emailcode`, `time`, `confirmed`, `ip`, `is_active`, `data_created`) VALUES
('Accusa', '', 'sujewuho', 'Pa$$w0rd!', 'admin', 'Timon Jensen', 'cahuvu@mailinator.com', 'Qui eveniet r', 'fohepi@mailinator.com', '0000-00-00', 0, 'Autem veniam qui mi', 0, '2020-07-23'),
('Aliqua', '', 'cerewi', 'Pa$$w0rd!', 'teknisi', 'MacKensie Reid', 'givicukab@mailinator.com', 'Porro fugiat ', 'moroqa@mailinator.com', '0000-00-00', 0, 'Est exercitationem q', 0, '2020-07-23'),
('Aliqui', '', 'zajige', 'Pa$$w0rd!', 'admin', 'Phoebe Logan', 'malobecudi@mailinator.com', 'Nesciunt volu', 'hiva@mailinator.com', '0000-00-00', 0, 'Eveniet recusandae', 0, '2020-07-23'),
('Debiti', '', 'fixubyty', 'Pa$$w0rd!', 'manager', 'Tanya Parrish', 'side@mailinator.com', 'Quae culpa te', 'zazelide@mailinator.com', '0000-00-00', 0, 'Proident aut sit o', 0, '2020-07-23'),
('Dolor ', '', 'ricebivi', 'Pa$$w0rd!', 'manager', 'Lynn Moody', 'wexisixaxi@mailinator.com', 'Dignissimos d', 'gatecyd@mailinator.com', '0000-00-00', 0, 'Et culpa ut nihil a', 0, '2020-07-23'),
('Dolore', '', 'kumefegyg', 'Pa$$w0rd!', 'teknisi', 'Curran Hogan', 'jyxyper@mailinator.com', 'Quo laboriosa', 'vycyv@mailinator.com', '0000-00-00', 0, 'Ea sunt molestiae e', 0, '2020-07-23'),
('Eiusmo', '', 'pefixo', 'Pa$$w0rd!', 'manager', 'George Crane', 'qahady@mailinator.com', 'Sequi nostrum', 'biqydesy@mailinator.com', '0000-00-00', 0, 'Cumque nobis volupta', 0, '2020-07-23'),
('Et cum', '', 'safoboxew', 'Pa$$w0rd!', 'teknisi', 'Willow Owen', 'pamerur@mailinator.com', 'Molestiae et ', 'gabyn@mailinator.com', '0000-00-00', 0, 'Vel sit dolore impe', 0, '2020-07-23'),
('Hic do', '', 'guricu', 'Pa$$w0rd!', 'admin', 'Brenna Johns', 'jyle@mailinator.com', 'Quia suscipit', 'cefutamo@mailinator.com', '0000-00-00', 0, 'Minim est similique ', 0, '2020-07-23'),
('Id do ', '', 'jykymuqale', 'Pa$$w0rd!', 'customer', 'Aspen Peterson', 'gadulu@mailinator.com', 'Duis laborum ', 'zudih@mailinator.com', '0000-00-00', 0, 'Hic cupidatat incidi', 0, '2020-07-23'),
('Invent', '', 'xojukuvezu', 'Pa$$w0rd!', 'customer', 'Sydnee Goodwin', 'suzikety@mailinator.com', 'Dolores dolor', 'leposagufi@mailinator.com', '0000-00-00', 0, 'Consectetur exercita', 0, '2020-07-23'),
('Laudan', '', 'quremyp', 'Pa$$w0rd!', 'admin', 'Shaine Patterson', 'fobih@mailinator.com', 'Exercitatione', 'buhyp@mailinator.com', '0000-00-00', 0, 'Et eaque fugiat quam', 0, '2020-07-23'),
('Non of', '', 'gaducos', 'Pa$$w0rd!', 'admin', 'Donna Garrett', 'qiragugapa@mailinator.com', 'Ut est delect', 'kunikowyfi@mailinator.com', '0000-00-00', 0, 'Quo nisi impedit am', 0, '2020-07-23'),
('Numqua', '', 'tefupitoce', 'Pa$$w0rd!', 'manager', 'Wang Hicks', 'givif@mailinator.com', 'In ipsum quo ', 'pyjeq@mailinator.com', '0000-00-00', 0, 'Eos id doloremque m', 0, '2020-07-23'),
('Omnis ', '', 'lagykasi', 'Pa$$w0rd!', 'admin', 'Summer Roy', 'gigiced@mailinator.com', 'Elit lorem hi', 'cuqaqy@mailinator.com', '0000-00-00', 0, 'Aut sed sint adipisi', 0, '2020-07-23'),
('Quia i', '', 'qejoqogy', 'Pa$$w0rd!', 'admin', 'Brian Kennedy', 'tiqyjesy@mailinator.com', 'Voluptas qui ', 'nifo@mailinator.com', '0000-00-00', 0, 'Nihil voluptas error', 0, '2020-07-23'),
('Quis e', '', 'qyceviwaki', 'Pa$$w0rd!', 'teknisi', 'Jael Deleon', 'zadolyjaxo@mailinator.com', 'Ut velit illu', 'quhixu@mailinator.com', '0000-00-00', 0, 'Eos aut id corrupti', 0, '2020-07-23'),
('Repell', '', 'xyhabosef', 'Pa$$w0rd!', 'manager', 'Maite Bowen', 'zeduvapy@mailinator.com', 'Deserunt itaq', 'tyxem@mailinator.com', '0000-00-00', 0, 'Sed consequatur eu e', 0, '2020-07-23'),
('usr001', '', 'dims', 'pwadmin', 'admin', 'dims mmmmmmmmm', 'nurulraws@gmail.com', '0881116785623', '', '2020-07-20', 0, '', 1, '2020-07-20'),
('usr002', '', 'teknisi', 'pwteknisi', 'teknisi', 'Teknisi', 'teknisi@gmail.com', '0881116785623', '', '2020-07-11', 0, '', 1, '2020-07-20'),
('usr003', 'cs001', 'user', 'customer', 'customer', 'Brett Stokes', 'nozehoveka@mailinator.com', 'Beatae dolore', '', '0000-00-00', 0, 'Incididunt atque con', 1, '2020-07-26'),
('usr004', '', 'manager', 'pwmanager', 'manager', 'Clio Mayer', 'dowytasiw@mailinator.com', 'Nulla neque o', 'cypa@mailinator.com', '0000-00-00', 0, 'Rerum id aut dolorem', 1, '2020-07-23'),
('usr005', 'cs002', 'userdua', 'customer2', 'customer', 'Kenyon Hart', 'cewarotik@mailinator.com', 'Aute quo quam', '', '2020-08-13', 0, 'Praesentium non repr', 1, '2020-08-13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `token` varchar(32) NOT NULL,
  `data_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `email`, `token`, `data_created`) VALUES
(15, 'nurulraws@gmail.com', '8npvI7jH5Vlcc+arX/usjS8o/76RdMYc', '0000-00-00'),
(16, 'gede@mailinator.com', 'n3E0ltDVzM9LLsELcrF1rwuWIdxQWx5n', '0000-00-00'),
(17, 'toxefixeqo@mailinator.com', '77oWxNinVRCrPbN44zYrsAQIABz/75VT', '0000-00-00'),
(18, 'vyhyrica@mailinator.com', 'iNWYk8SUdBYZ2wnVDLAhaoQN6EG/D6on', '0000-00-00'),
(19, 'qolox@mailinator.com', 'xHCzf6tPwA4Mu7TinVMnSeDvSjF+6RD6', '0000-00-00'),
(20, 'nurulraws@gmail.com', 'ZUWel4qBW1OuEjwptH5HLj8mVQvM98lA', '0000-00-00'),
(21, 'nurulraws@gmail.com', 'Q99UHLw3bi1x31nSnLJhhcrekU+QIMGR', '0000-00-00'),
(22, 'nurulraws@gmail.com', 'N9rGRcMNivjtD62BawO8U3aWuPOer/db', '0000-00-00'),
(23, 'nurulraws@gmail.com', 'i9MqNXa1DBNda703u8k7Y9Sngs/YFVnO', '0000-00-00'),
(24, 'nurulraws@gmail.com', 'QwdCofQSmzq/xnQV9XNCvzgoy9MnPl0J', '0000-00-00'),
(25, 'dowytasiw@mailinator.com', 'FCIq/yTYR+/Jz4x8OWRBWK4XyUW+/E3M', '0000-00-00'),
(26, 'fobih@mailinator.com', 'zFm5sgj6DgRd2DYC8JGhv9hknD/g42b3', '0000-00-00'),
(27, 'pamerur@mailinator.com', 'I9/fNqQhV2nEO9w5GWpcBKikmqn+RbeT', '0000-00-00'),
(28, 'givicukab@mailinator.com', 'bLdyeQyAimaKHGsdCaVT99KVVOFEnMjC', '0000-00-00'),
(29, 'qahady@mailinator.com', 'Ph6Rbvg3eXDxbnPTN2DPTzhDaxBFnXIb', '0000-00-00'),
(30, 'wexisixaxi@mailinator.com', 'R+ItGxLEfSC/uMWgmTvWzt1pauYLyG3v', '0000-00-00'),
(31, 'jyle@mailinator.com', 'wY33nH6MVcip2w+MZDARKgBCH2GLmwQh', '0000-00-00'),
(32, 'malobecudi@mailinator.com', 'SZdRZcZpiGhxvwSgyvlxj/gY44ctAZta', '0000-00-00'),
(33, 'jyxyper@mailinator.com', 'UBLmJn52RP0Ax5Ln2XaM+oBwl8dra1pB', '0000-00-00'),
(34, 'gadulu@mailinator.com', 'yN4MlaUdMl8fOTUS98bggHgecs2TjPhu', '0000-00-00'),
(35, 'tiqyjesy@mailinator.com', 'OBinhKezRPhQnvWrkPpMC1K9n4v36fvM', '0000-00-00'),
(36, 'side@mailinator.com', 'i7H6crJ7kl+o6VZRwxCkEXDJ5VgnonqW', '0000-00-00'),
(37, 'qiragugapa@mailinator.com', 'WpaRSBsUvbG7ifyD1EJam0qDYHSPgcgM', '0000-00-00'),
(38, 'zeduvapy@mailinator.com', '2uXGt3qDrwR7VOs+DMOta9d0758k+4Wq', '0000-00-00'),
(39, 'givif@mailinator.com', '783QV4dHL2bcL6Vrdc8aI6I6gPMK6WvT', '0000-00-00'),
(40, 'gigiced@mailinator.com', 'Qsc3M/UclpRwZ8qbxfbp9QVRaW1UoJjj', '0000-00-00'),
(41, 'suzikety@mailinator.com', 'AFXqBY+e71wHeJfwkWS9x8q4ErO6LPz1', '0000-00-00'),
(42, 'zadolyjaxo@mailinator.com', 'FUpARYhtOZ+dneHr+CSNQGdQjAh84C60', '0000-00-00'),
(43, 'cahuvu@mailinator.com', 'SVyT4jg8S6P/jRxH9Q4BdcxcV1BycmTG', '0000-00-00'),
(44, 'nozehoveka@mailinator.com', 'vLhcVQD4R0/XsMr3uaklT6NCFrDJD2P1', '0000-00-00'),
(45, 'nimehuvoto@mailinator.com', 'j1DVF2o+8Eq6MJ4Og+tLOp6/9VRXg9DH', '0000-00-00'),
(46, 'cewarotik@mailinator.com', 'h0hIM6z2AeGVQ1nf1ZfdCho71hCZRYh3', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vocabs`
--

CREATE TABLE `vocabs` (
  `idvocab` int(11) NOT NULL,
  `idcustomer` varchar(5) NOT NULL,
  `pic` varchar(30) NOT NULL,
  `ipclient` varchar(15) NOT NULL,
  `ask` text NOT NULL,
  `answer` text NOT NULL,
  `tolask` int(11) NOT NULL,
  `jenisedc` varchar(30) NOT NULL,
  `lokasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `vocabs`
--

INSERT INTO `vocabs` (`idvocab`, `idcustomer`, `pic`, `ipclient`, `ask`, `answer`, `tolask`, `jenisedc`, `lokasi`) VALUES
(1, '', 'Ari', '', 'program edc error', 'Restart EDC', 18, 'Verifone', 'Bekasi Timur'),
(2, '', 'Randi', '', 'display edc error', 'Restart EDC', 8, 'PAX', 'Bekasi Utara'),
(3, '', 'Ali', '', 'card edc error', 'Melakukan Insert kartu dengan sempurna', 27, 'Ingenico', 'Bekasi Selatan'),
(6, '', 'Indra', '', 'ecyription edc error', 'Masukkan PIN dengan benar', 4, 'Ingenico', 'Bekasi Selatan'),
(7, '', 'Jess', '', 'printer edc error', 'Lakukan penggantian adaptor EDC', 5, 'Verifone', 'Bekasi Timur');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_customers`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_customers` (
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_project`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_project` (
`idproject` varchar(6)
,`idcustomer` varchar(5)
,`namaproject` varchar(30)
,`csnama` varchar(30)
,`deliveyrbegin` date
,`deliveryend` date
,`installdate` date
,`installend` date
,`uatbegin` date
,`uatend` date
,`billstartdate` date
,`billdueend` date
,`warantyperiod` int(2)
,`contractstartdate` date
,`contractenddate` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_ticket`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_ticket` (
`idtickets` int(11)
,`idcustomer` varchar(6)
,`noticket` varchar(30)
,`reportdate` date
,`reportby` varchar(30)
,`assignedate` date
,`ticketstatus` varchar(30)
,`namasla` varchar(30)
,`csnama` varchar(30)
,`username` varchar(30)
,`problemsummary` varchar(30)
,`problemdetail` text
,`assigne` varchar(6)
,`resolution` text
,`resolveby` varchar(30)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `while_ticket`
--

CREATE TABLE `while_ticket` (
  `id` int(11) NOT NULL,
  `noticket` varchar(30) NOT NULL,
  `csnama` varchar(30) NOT NULL,
  `csproduct` varchar(50) NOT NULL,
  `warantyperiod` date NOT NULL,
  `contractperiod` date NOT NULL,
  `reportdate` date NOT NULL,
  `reportby` varchar(30) NOT NULL,
  `problemsummary` varchar(50) NOT NULL,
  `problemdetail` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `idcustomer` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `while_ticket`
--

INSERT INTO `while_ticket` (`id`, `noticket`, `csnama`, `csproduct`, `warantyperiod`, `contractperiod`, `reportdate`, `reportby`, `problemsummary`, `problemdetail`, `status`, `idcustomer`) VALUES
(1, '1/HD/Aug/2020', 'MCD', 'Verifone', '2022-07-21', '2022-07-08', '2020-08-02', 'Ut ad officia reicie', 'EDC tidak bisa input pin', 'Sunt voluptates exce', 'Assigned', 'cs001'),
(2, '2/HD/Aug/2020', 'MCD', 'Pax', '2022-07-19', '2022-07-06', '2020-08-02', 'Neque voluptas venia', 'Kabel ada yang terkelupas', 'Possimus voluptatem', 'Assigned', 'cs001'),
(3, '3/HD/Aug/2020', 'MCD', 'Pax', '2022-07-21', '2022-07-08', '2020-08-08', 'Animi porro sed cup', 'Nobis vel hic sed es', 'Expedita nemo dolore', 'Assigned', 'cs001'),
(4, '4/HD/Aug/2020', 'PHD', 'Pax', '2022-07-19', '2022-07-06', '2020-08-08', 'Est alias occaecat i', 'Dolore perspiciatis', 'Quis impedit volupt', 'Assigned', 'cs002'),
(5, '5/HD/Aug/2020', 'PHD', 'Pax', '2022-07-21', '2022-07-08', '2020-08-08', 'Occaecat nisi odit e', 'Necessitatibus volup', 'Aliquid corporis vol', 'Assigned', 'cs002'),
(6, '6/HD/Aug/2020', 'PHD', 'Pax', '2022-07-19', '2022-07-06', '2020-08-08', 'Occaecat est asperi', 'Ratione sint non sa', 'Nisi quia minus in c', 'Assigned', 'cs002'),
(7, '7/HD/Oct/2020', 'PHD', 'Pax', '2022-07-21', '2022-07-08', '2020-10-06', 'Adi', 'edc error', 'EDC tidak mau menyala', 'Assigned', 'cs002'),
(8, '', 'MCD', 'Ingenico', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'printer tidak hidup', '', 'Not Approve', 'cs001'),
(9, '', 'MCD', 'Pax', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'printer tidak hidup', '', 'Not Approve', 'cs001'),
(10, '', 'MCD', 'Pax', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'printer tidak hidup', '', 'Not Approve', 'cs001'),
(11, '', 'MCD', 'Ingenico', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'printer tidak hidup', '', 'Not Approve', 'cs001'),
(12, '', 'MCD', 'Verifone', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'printer tidak hidup', '', 'Not Approve', 'cs001'),
(13, '', 'MCD', 'Verifone', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'printer tidak hidup', '', 'Not Approve', 'cs001'),
(14, '14/HD/Oct/2020', 'MCD', 'Verifone', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'printer tidak hidup ', '', 'Assigned', 'cs001'),
(15, '', 'MCD', 'Verifone', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'card edc error', '', 'Not Approve', 'cs001'),
(16, '', 'MCD', 'Verifone', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'mesin edc error ', '', 'Not Approve', 'cs001'),
(17, '', 'MCD', 'Verifone', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'printer tidak hidup ', '', 'Not Approve', 'cs001'),
(18, '', 'MCD', 'Pax', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'printer tidak hidup ', '', 'Not Approve', 'cs001'),
(19, '', 'MCD', 'Pax', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'mesin edc error ', '', 'Not Approve', 'cs001'),
(20, '', 'MCD', 'Pax', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'printer tidak hidup ', '', 'Not Approve', 'cs001'),
(21, '', 'MCD', 'Verifone', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'card edc error', '', 'Not Approve', 'cs001'),
(22, '', 'MCD', 'Verifone', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'card edc error', '', 'Not Approve', 'cs001'),
(23, '', 'MCD', 'Verifone', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'ecyription edc error', '', 'Not Approve', 'cs001'),
(24, '', 'MCD', 'Verifone', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'card edc error', '', 'Not Approve', 'cs001'),
(25, '', 'MCD', 'Verifone', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'card edc error', '', 'Not Approve', 'cs001'),
(26, '', 'MCD', 'Ingenico', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'card edc error', '', 'Not Approve', 'cs001'),
(27, '', 'MCD', 'Ingenico', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'card edc error', '', 'Not Approve', 'cs001'),
(28, '', 'MCD', 'Pax', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'card edc error', '', 'Not Approve', 'cs001'),
(29, '', 'MCD', 'Ingenico', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'card edc error', '', 'Not Approve', 'cs001'),
(30, '', 'MCD', 'Ingenico', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'card edc error', '', 'Not Approve', 'cs001'),
(31, '', 'MCD', 'Ingenico', '2022-07-21', '2022-07-08', '2020-10-06', 'michael', 'mesin edc mati ', '', 'Not Approve', 'cs001'),
(32, '32/HD/Oct/2020', 'PHD', 'Pax', '2022-08-27', '2022-04-11', '2020-10-27', 'randi', 'ecyription edc error', '', 'Assigned', 'cs002'),
(33, '33/HD/Oct/2020', 'PHD', 'Pax', '2022-08-27', '2022-04-11', '2020-10-27', 'randi', 'card edc error', '', 'Assigned', 'cs002'),
(34, '34/HD/Oct/2020', 'MCD', 'Verifone', '2022-07-21', '2022-07-08', '2020-10-27', 'ari', 'printer edc error', '', 'Assigned', 'cs001'),
(35, '35/HD/Oct/2020', 'MCD', 'Verifone', '2022-07-21', '2022-07-08', '2020-10-27', 'ari', 'card edc error', '', 'Assigned', 'cs001'),
(36, '36/HD/Oct/2020', 'PHD', 'Pax', '2022-08-27', '2022-04-11', '2020-10-27', 'randi', 'program edc error', '', 'Assigned', 'cs002'),
(37, '37/HD/Oct/2020', 'PHD', 'Pax', '2022-08-27', '2022-04-11', '2020-10-27', 'randi', 'printer edc error', '', 'Assigned', 'cs002');

-- --------------------------------------------------------

--
-- Struktur untuk view `v_customers`
--
DROP TABLE IF EXISTS `v_customers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_customers`  AS  select `customers`.`idcustomer` AS `idcustomer`,`customers`.`csnama` AS `csnama`,`customers`.`alamat` AS `alamat`,`customers`.`telp` AS `telp`,`customers`.`email` AS `email`,`customers`.`pic` AS `pic`,`customers`.`time` AS `time`,`customers`.`ip` AS `ip`,`csproduct`.`csproduct` AS `csproduct` from (`customers` left join `csproduct` on(`customers`.`idcustomer` = `csproduct`.`idcustomer`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_project`
--
DROP TABLE IF EXISTS `v_project`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_project`  AS  select distinct `projects`.`idproject` AS `idproject`,`projects`.`idcustomer` AS `idcustomer`,`projects`.`namaproject` AS `namaproject`,`customers`.`csnama` AS `csnama`,`projects`.`deliveyrbegin` AS `deliveyrbegin`,`projects`.`deliveryend` AS `deliveryend`,`projects`.`installdate` AS `installdate`,`projects`.`installend` AS `installend`,`projects`.`uatbegin` AS `uatbegin`,`projects`.`uatend` AS `uatend`,`projects`.`billstartdate` AS `billstartdate`,`projects`.`billdueend` AS `billdueend`,`projects`.`warantyperiod` AS `warantyperiod`,`projects`.`contractstartdate` AS `contractstartdate`,`projects`.`contractenddate` AS `contractenddate` from (`projects` left join `customers` on(`projects`.`idcustomer` = `customers`.`idcustomer`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_ticket`
--
DROP TABLE IF EXISTS `v_ticket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ticket`  AS  select distinct `tickets`.`idtickets` AS `idtickets`,`tickets`.`idcustomer` AS `idcustomer`,`tickets`.`noticket` AS `noticket`,`tickets`.`reportdate` AS `reportdate`,`tickets`.`reportby` AS `reportby`,`tickets`.`assignedate` AS `assignedate`,`tickets`.`ticketstatus` AS `ticketstatus`,`sla`.`namasla` AS `namasla`,`customers`.`csnama` AS `csnama`,`users`.`username` AS `username`,`tickets`.`problemsummary` AS `problemsummary`,`tickets`.`problemdetail` AS `problemdetail`,`tickets`.`assigne` AS `assigne`,`tickets`.`resolution` AS `resolution`,`tickets`.`resolveby` AS `resolveby` from (((`tickets` left join `sla` on(`tickets`.`idsla` = `sla`.`idsla`)) left join `customers` on(`tickets`.`idcustomer` = `customers`.`idcustomer`)) left join `users` on(`tickets`.`assigne` = `users`.`iduser`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `asking`
--
ALTER TABLE `asking`
  ADD PRIMARY KEY (`idasking`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`idcustomer`);

--
-- Indeks untuk tabel `edc`
--
ALTER TABLE `edc`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`idgejala`);

--
-- Indeks untuk tabel `kerusakan`
--
ALTER TABLE `kerusakan`
  ADD PRIMARY KEY (`idkerusakan`);

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
-- Indeks untuk tabel `mst_edc`
--
ALTER TABLE `mst_edc`
  ADD PRIMARY KEY (`idedc`);

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
-- Indeks untuk tabel `solusi`
--
ALTER TABLE `solusi`
  ADD PRIMARY KEY (`idsolusi`);

--
-- Indeks untuk tabel `tester`
--
ALTER TABLE `tester`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`idtickets`);

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
-- Indeks untuk tabel `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `vocabs`
--
ALTER TABLE `vocabs`
  ADD PRIMARY KEY (`idvocab`);
ALTER TABLE `vocabs` ADD FULLTEXT KEY `ask` (`ask`);

--
-- Indeks untuk tabel `while_ticket`
--
ALTER TABLE `while_ticket`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `asking`
--
ALTER TABLE `asking`
  MODIFY `idasking` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `askpending`
--
ALTER TABLE `askpending`
  MODIFY `idaskpending` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `correctword`
--
ALTER TABLE `correctword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `edc`
--
ALTER TABLE `edc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mst_edc`
--
ALTER TABLE `mst_edc`
  MODIFY `idedc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tester`
--
ALTER TABLE `tester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tickets`
--
ALTER TABLE `tickets`
  MODIFY `idtickets` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tmppropabilityvocab`
--
ALTER TABLE `tmppropabilityvocab`
  MODIFY `idtmpvocab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2818;

--
-- AUTO_INCREMENT untuk tabel `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `vocabs`
--
ALTER TABLE `vocabs`
  MODIFY `idvocab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `while_ticket`
--
ALTER TABLE `while_ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
