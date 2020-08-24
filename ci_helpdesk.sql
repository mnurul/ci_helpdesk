-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Agu 2020 pada 07.40
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
-- Struktur dari tabel `csproduct`
--

CREATE TABLE `csproduct` (
  `idcustomer` varchar(5) NOT NULL,
  `csproduct` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `csproduct`
--

INSERT INTO `csproduct` (`idcustomer`, `csproduct`) VALUES
('Conse', 'Penggantian EDC '),
('cs001', 'EDC'),
('cs002', 'DATA'),
('Ex qu', 'Ratione magnam occae'),
('Expli', 'Aperiam corporis rep'),
('Verit', 'Doloremque amet quo'),
('cs001', 'Kabel EDC'),
('cs001', 'Commodo tempora est ');

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
  `time` date NOT NULL DEFAULT current_timestamp(),
  `ip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`idcustomer`, `csnama`, `alamat`, `telp`, `email`, `pic`, `time`, `ip`) VALUES
('cs001', 'MCD', 'Bekasi', '0881116785623', 'mcd@gmail.com', 'michael', '2020-08-13', '0'),
('cs002', 'PHD', 'Bekasi', '0881116785623', 'phd@gmail.com', 'Anya', '2020-08-13', '0'),
('cs003', 'KFC', 'Aperiam fugiat temp', 'Laborum aperi', 'kfc@gmail.com', 'Dei', '0000-00-00', '0'),
('cs004', '', '', '', '', '', '2020-08-13', ''),
('cs005', '', '', '', '', '', '0000-00-00', ''),
('cs006', '', '', '', '', '', '0000-00-00', ''),
('cs007', '', '', '', '', '', '0000-00-00', ''),
('cs008', '', '', '', '', '', '0000-00-00', '');

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
('pjt001', 'Pemasangan EDC Baru', 'cs001', '2020-07-01', '2020-07-14', '2020-07-08', '2020-07-14', '2020-07-15', '2020-07-21', '2020-07-08', '2020-07-14', 2, '2020-07-08', 12),
('pjt002', 'Pemasangan Kabel', 'cs001', '2020-07-01', '2020-07-14', '2020-07-08', '2020-07-14', '2020-07-15', '2020-07-19', '2020-07-06', '2020-07-14', 2, '2020-07-08', 12),
('pjt003', 'Pemasangan EDC dan Ganti Kabel', 'cs002', '2020-08-15', '2020-05-27', '2020-06-08', '2020-02-03', '2020-05-01', '2020-08-27', '2020-04-11', '2020-10-14', 2, '2020-03-13', 12);

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
(5, 'cs001', '', '3/HD/Aug/2020', '1', '2020-08-08', 'Animi porro sed cup', '', '', 'Nobis vel hic sed es', 'Expedita nemo dolore', 'Assigned', 'usr002', '0000-00-00', '', NULL, '', '', NULL, '', NULL, '', NULL),
(6, 'cs001', '', '3/HD/Aug/2020', '1', '2020-08-08', 'Animi porro sed cup', '', '', 'Nobis vel hic sed es', 'Expedita nemo dolore', 'Assigned', 'Aliqua', '2020-08-08', '', NULL, '', '', NULL, '', NULL, '', NULL),
(7, 'cs001', '', '2/HD/Aug/2020', '1', '2020-08-02', 'Neque voluptas venia', '', '', 'Kabel ada yang terkelupas', 'Possimus voluptatem', 'Assigned', 'Et cum', '2020-08-10', '', NULL, '', '', NULL, '', NULL, '', NULL),
(8, 'cs001', '', '2/HD/Aug/2020', '4', '2020-08-02', 'Neque voluptas venia', '', '', 'Kabel ada yang terkelupas', 'Possimus voluptatem', 'Assigned', 'Aliqua', '2020-08-10', '', NULL, '', '', NULL, '', NULL, '', NULL),
(10, ' cs001', '', '5/HD/Aug/2020', '1', '2020-08-08', 'Occaecat nisi odit e', '', '', 'Necessitatibus volup', 'Aliquid corporis vol', 'Assigned', 'usr002', '2020-08-08', '', NULL, '', '', NULL, '', NULL, '', NULL);

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
('usr005', 'cs001', 'Dias Burger', 'Pa$$w0rd!', 'customer', 'Kenyon Hart', 'cewarotik@mailinator.com', 'Aute quo quam', '', '2020-08-13', 0, 'Praesentium non repr', 0, '2020-08-13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `token` varchar(32) NOT NULL,
  `data_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `email`, `token`, `data_created`) VALUES
(15, 'nurulraws@gmail.com', '8npvI7jH5Vlcc+arX/usjS8o/76RdMYc', 1595342462),
(16, 'gede@mailinator.com', 'n3E0ltDVzM9LLsELcrF1rwuWIdxQWx5n', 1595428978),
(17, 'toxefixeqo@mailinator.com', '77oWxNinVRCrPbN44zYrsAQIABz/75VT', 1595429640),
(18, 'vyhyrica@mailinator.com', 'iNWYk8SUdBYZ2wnVDLAhaoQN6EG/D6on', 1595429832),
(19, 'qolox@mailinator.com', 'xHCzf6tPwA4Mu7TinVMnSeDvSjF+6RD6', 1595430084),
(20, 'nurulraws@gmail.com', 'ZUWel4qBW1OuEjwptH5HLj8mVQvM98lA', 1595431879),
(21, 'nurulraws@gmail.com', 'Q99UHLw3bi1x31nSnLJhhcrekU+QIMGR', 1595432001),
(22, 'nurulraws@gmail.com', 'N9rGRcMNivjtD62BawO8U3aWuPOer/db', 1595432026),
(23, 'nurulraws@gmail.com', 'i9MqNXa1DBNda703u8k7Y9Sngs/YFVnO', 1595432048),
(24, 'nurulraws@gmail.com', 'QwdCofQSmzq/xnQV9XNCvzgoy9MnPl0J', 1595432088),
(25, 'dowytasiw@mailinator.com', 'FCIq/yTYR+/Jz4x8OWRBWK4XyUW+/E3M', 1595493671),
(26, 'fobih@mailinator.com', 'zFm5sgj6DgRd2DYC8JGhv9hknD/g42b3', 1595493681),
(27, 'pamerur@mailinator.com', 'I9/fNqQhV2nEO9w5GWpcBKikmqn+RbeT', 1595493689),
(28, 'givicukab@mailinator.com', 'bLdyeQyAimaKHGsdCaVT99KVVOFEnMjC', 1595493696),
(29, 'qahady@mailinator.com', 'Ph6Rbvg3eXDxbnPTN2DPTzhDaxBFnXIb', 1595493703),
(30, 'wexisixaxi@mailinator.com', 'R+ItGxLEfSC/uMWgmTvWzt1pauYLyG3v', 1595493710),
(31, 'jyle@mailinator.com', 'wY33nH6MVcip2w+MZDARKgBCH2GLmwQh', 1595494037),
(32, 'malobecudi@mailinator.com', 'SZdRZcZpiGhxvwSgyvlxj/gY44ctAZta', 1595494044),
(33, 'jyxyper@mailinator.com', 'UBLmJn52RP0Ax5Ln2XaM+oBwl8dra1pB', 1595494051),
(34, 'gadulu@mailinator.com', 'yN4MlaUdMl8fOTUS98bggHgecs2TjPhu', 1595494058),
(35, 'tiqyjesy@mailinator.com', 'OBinhKezRPhQnvWrkPpMC1K9n4v36fvM', 1595494064),
(36, 'side@mailinator.com', 'i7H6crJ7kl+o6VZRwxCkEXDJ5VgnonqW', 1595494071),
(37, 'qiragugapa@mailinator.com', 'WpaRSBsUvbG7ifyD1EJam0qDYHSPgcgM', 1595494436),
(38, 'zeduvapy@mailinator.com', '2uXGt3qDrwR7VOs+DMOta9d0758k+4Wq', 1595494444),
(39, 'givif@mailinator.com', '783QV4dHL2bcL6Vrdc8aI6I6gPMK6WvT', 1595494452),
(40, 'gigiced@mailinator.com', 'Qsc3M/UclpRwZ8qbxfbp9QVRaW1UoJjj', 1595494765),
(41, 'suzikety@mailinator.com', 'AFXqBY+e71wHeJfwkWS9x8q4ErO6LPz1', 1595494772),
(42, 'zadolyjaxo@mailinator.com', 'FUpARYhtOZ+dneHr+CSNQGdQjAh84C60', 1595494778),
(43, 'cahuvu@mailinator.com', 'SVyT4jg8S6P/jRxH9Q4BdcxcV1BycmTG', 1595501967),
(44, 'nozehoveka@mailinator.com', 'vLhcVQD4R0/XsMr3uaklT6NCFrDJD2P1', 1595746437),
(45, 'nimehuvoto@mailinator.com', 'j1DVF2o+8Eq6MJ4Og+tLOp6/9VRXg9DH', 1597263070),
(46, 'cewarotik@mailinator.com', 'h0hIM6z2AeGVQ1nf1ZfdCho71hCZRYh3', 1597263450);

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

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_customers`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_customers` (
`idcustomer` varchar(5)
,`csnama` varchar(30)
,`alamat` text
,`telp` varchar(13)
,`email` varchar(30)
,`pic` varchar(30)
,`time` date
,`ip` varchar(30)
,`csproduct` varchar(20)
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
(1, '1/HD/Aug/2020', 'MCD', 'Pemasangan EDC', '2022-07-21', '2022-07-08', '2020-08-02', 'Ut ad officia reicie', 'EDC tidak bisa input pin', 'Sunt voluptates exce', 'Assigned', 'cs001'),
(2, '2/HD/Aug/2020', 'MCD', 'Pemasangan Kabel', '2022-07-19', '2022-07-06', '2020-08-02', 'Neque voluptas venia', 'Kabel ada yang terkelupas', 'Possimus voluptatem', 'Assigned', 'cs001'),
(3, '3/HD/Aug/2020', 'MCD', 'Pemasangan EDC', '2022-07-21', '2022-07-08', '2020-08-08', 'Animi porro sed cup', 'Nobis vel hic sed es', 'Expedita nemo dolore', 'Assigned', 'cs001'),
(4, '4/HD/Aug/2020', 'MCD', 'Pemasangan Kabel', '2022-07-19', '2022-07-06', '2020-08-08', 'Est alias occaecat i', 'Dolore perspiciatis', 'Quis impedit volupt', 'Assigned', 'cs001'),
(5, '5/HD/Aug/2020', 'MCD', 'Pemasangan EDC', '2022-07-21', '2022-07-08', '2020-08-08', 'Occaecat nisi odit e', 'Necessitatibus volup', 'Aliquid corporis vol', 'Assigned', 'cs001'),
(6, '6/HD/Aug/2020', 'MCD', 'Pemasangan Kabel', '2022-07-19', '2022-07-06', '2020-08-08', 'Occaecat est asperi', 'Ratione sint non sa', 'Nisi quia minus in c', 'Assigned', 'cs001');

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ticket`  AS  select distinct `tickets`.`idtickets` AS `idtickets`,`tickets`.`noticket` AS `noticket`,`tickets`.`reportdate` AS `reportdate`,`tickets`.`reportby` AS `reportby`,`tickets`.`assignedate` AS `assignedate`,`tickets`.`ticketstatus` AS `ticketstatus`,`sla`.`namasla` AS `namasla`,`customers`.`csnama` AS `csnama`,`users`.`username` AS `username`,`tickets`.`problemsummary` AS `problemsummary`,`tickets`.`problemdetail` AS `problemdetail`,`tickets`.`assigne` AS `assigne`,`tickets`.`resolution` AS `resolution`,`tickets`.`resolveby` AS `resolveby` from (((`tickets` left join `sla` on(`tickets`.`idsla` = `sla`.`idsla`)) left join `customers` on(`tickets`.`idcustomer` = `customers`.`idcustomer`)) left join `users` on(`tickets`.`assigne` = `users`.`iduser`)) ;

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
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`idcustomer`);

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

--
-- Indeks untuk tabel `while_ticket`
--
ALTER TABLE `while_ticket`
  ADD PRIMARY KEY (`id`);

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

--
-- AUTO_INCREMENT untuk tabel `tickets`
--
ALTER TABLE `tickets`
  MODIFY `idtickets` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `while_ticket`
--
ALTER TABLE `while_ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
