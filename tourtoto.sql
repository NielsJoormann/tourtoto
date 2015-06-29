-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Gegenereerd op: 29 jun 2015 om 13:35
-- Serverversie: 5.6.24
-- PHP-versie: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tourtoto`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `etappe`
--

CREATE TABLE IF NOT EXISTS `etappe` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `afstand` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIES VOOR TABEL `etappe`:
--

--
-- Gegevens worden geëxporteerd voor tabel `etappe`
--

INSERT INTO `etappe` (`id`, `naam`, `afstand`) VALUES
(1, 'Utrecht > Utrecht', 14),
(2, 'Utrecht > Neeltje Jans', 166),
(3, 'Antwerpen > Muur van Hoei', 160),
(4, 'Seraing > Cambrai', 224),
(5, 'Arras > Amiens', 190),
(6, 'Abbeville > Le Havre', 192),
(7, 'Livarot > Fougères', 191),
(8, 'Rennes > Mûr-de-Bretagne', 182),
(9, 'Vannes > Plumelec', 28),
(10, 'Tarbes > Arette La Pierre Saint Martin', 167),
(11, 'Pau > Cauterets', 188),
(12, 'Lannemezan > Plateau de Beille', 195),
(13, 'Muret > Rodez', 199),
(14, 'Rodez > Mende', 179),
(15, 'Mende > Valence', 183),
(16, 'Bourg-De-Péage > Gap', 201),
(17, 'Digne-les-Bains > Pra Loup', 161),
(18, 'Gap > Saint-Jean-de-Maurienne', 187),
(19, 'Saint-Jean-de-Maurienne > La Toussuire', 138),
(20, 'Modane > L’Alpe d’Huez', 111),
(21, 'Sèvres - Parijs / Champs-Élysées', 110);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `etapperegel`
--

CREATE TABLE IF NOT EXISTS `etapperegel` (
  `id` int(11) NOT NULL,
  `etappe_id` int(11) NOT NULL,
  `positie` int(11) NOT NULL,
  `tijd` time NOT NULL,
  `renner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIES VOOR TABEL `etapperegel`:
--   `renner_id`
--       `renner` -> `id`
--   `etappe_id`
--       `etappe` -> `id`
--

--
-- Gegevens worden geëxporteerd voor tabel `etapperegel`
--

INSERT INTO `etapperegel` (`id`, `etappe_id`, `positie`, `tijd`, `renner_id`) VALUES
(0, 1, 1, '00:13:00', 23),
(1, 1, 2, '00:13:05', 3),
(2, 1, 3, '00:13:06', 7),
(3, 1, 6, '00:09:11', 222),
(4, 1, 4, '00:13:07', 15),
(5, 1, 5, '00:13:10', 45),
(6, 1, 7, '00:13:12', 46),
(7, 1, 8, '00:13:15', 100),
(8, 1, 9, '00:13:20', 34),
(9, 1, 10, '00:26:00', 9);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `land`
--

CREATE TABLE IF NOT EXISTS `land` (
  `id` int(11) NOT NULL,
  `code` varchar(12) NOT NULL,
  `naam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIES VOOR TABEL `land`:
--

--
-- Gegevens worden geëxporteerd voor tabel `land`
--

INSERT INTO `land` (`id`, `code`, `naam`) VALUES
(1, '(NED)', ' Netherlands '),
(2, '(ESP)', ' Spain '),
(3, '(AUS)', ' Australia '),
(4, '(GB)', ' Great Britain '),
(5, '(USA)', 'United States'),
(6, '(FRA)', 'France'),
(7, '(KAZ)', 'Kazakhstan'),
(8, '(BEL)', 'Belgium'),
(9, '(GER)', 'Germany'),
(10, '(SWI)', 'Switzerland'),
(11, '(ITA)', 'Italy'),
(12, '(RUS)', 'Russia'),
(13, '(SLO)', 'Slovenia'),
(14, '(POR)', 'Portugal'),
(15, '(POL)', 'Poland'),
(16, '(SCU)', 'Scandinavische Unie'),
(17, '(COL)', 'Colombia');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ploeg`
--

CREATE TABLE IF NOT EXISTS `ploeg` (
  `id` int(11) NOT NULL,
  `code` varchar(12) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `land_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIES VOOR TABEL `ploeg`:
--   `land_id`
--       `land` -> `id`
--

--
-- Gegevens worden geëxporteerd voor tabel `ploeg`
--

INSERT INTO `ploeg` (`id`, `code`, `naam`, `land_id`) VALUES
(1, 'ALM', 'Ag2r-La Mondiale', 6),
(2, 'AST', 'Astana', 7),
(3, 'BMC', 'BMC Racing Team', 5),
(4, 'TCG', 'Cannondale-Garmin', 5),
(5, 'EQS', 'Etixx-Quick Step', 8),
(6, 'FDJ', 'FDJ', 6),
(7, 'TGA', 'Giant-Alpecin', 9),
(8, 'IAM', 'IAM Cycling', 10),
(9, 'KAT', 'Team Katusha', 12),
(10, 'LAM', 'Lampre-Merida', 11),
(11, 'LTS', 'Lotto-Soudal', 8),
(12, 'TLJ', 'LottoNL-Jumbo', 1),
(13, 'MOV', 'Movistar Team', 2),
(14, 'OGE', 'Orica-GreenEDGE', 3),
(15, 'SKY', 'Team Sky', 4),
(16, 'TCS', 'Tinkoff-Saxo', 12),
(17, 'TFR', 'Trek Factory Racing', 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `renner`
--

CREATE TABLE IF NOT EXISTS `renner` (
  `id` int(11) NOT NULL,
  `voornaam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `ploeg_id` int(11) NOT NULL,
  `land_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIES VOOR TABEL `renner`:
--   `land_id`
--       `land` -> `id`
--   `ploeg_id`
--       `ploeg` -> `id`
--

--
-- Gegevens worden geëxporteerd voor tabel `renner`
--

INSERT INTO `renner` (`id`, `voornaam`, `achternaam`, `ploeg_id`, `land_id`, `active`) VALUES
(1, 'Ben', 'Gastauer', 1, 1, 1),
(2, 'Jempy', 'Drucker', 3, 1, 1),
(3, 'Laurent', 'Didier', 17, 1, 1),
(4, 'Bob', 'Jungels', 17, 1, 1),
(5, 'Fränk', 'Schleck', 17, 1, 1),
(6, 'Lars', 'Boom', 2, 1, 1),
(7, 'Lieuwe', 'Westra', 2, 1, 1),
(8, 'Sebastian', 'Langeveld', 4, 1, 1),
(9, 'Tom-Jelte', 'Slagter', 4, 1, 1),
(10, 'Niki', 'Terpstra', 5, 1, 1),
(11, 'Roy', 'Curvers', 7, 1, 1),
(12, 'Tom', 'Dumoulin', 7, 1, 1),
(13, 'Daan', 'Olivier', 7, 1, 1),
(14, 'Ramon', 'Sinkeldam', 7, 1, 1),
(15, 'Tom', 'Stamsnijder', 7, 1, 1),
(16, 'Albert', 'Timmer', 7, 1, 1),
(17, 'Tom', 'Veelers', 7, 1, 1),
(18, 'Stef', 'Clement', 8, 1, 1),
(19, 'Brian', 'Bulgaç', 10, 1, 1),
(20, 'Rick', 'Flens', 10, 1, 1),
(21, 'Robert', 'Gesink', 10, 1, 1),
(22, 'Marc', 'Goos', 10, 1, 1),
(23, 'Moreno', 'Hofland', 10, 1, 1),
(24, 'Martijn', 'Keizer', 10, 1, 1),
(25, 'Wilco', 'Kelderman', 10, 1, 1),
(26, 'Steven', 'Kruijswijk', 10, 1, 1),
(27, 'Tom', 'Leezer', 10, 1, 1),
(28, 'Bert-Jan', 'Lindeman', 10, 1, 1),
(29, 'Barry', 'Markus', 10, 1, 1),
(30, 'Timo', 'Roosen', 10, 1, 1),
(31, 'Bram', 'Tankink', 10, 1, 1),
(32, 'Laurens', 'ten Dam', 10, 1, 1),
(33, 'Mike', 'Teunissen', 10, 1, 1),
(34, 'Maarten', 'Tjallingii', 10, 1, 1),
(35, 'Pim', 'Ligthart', 11, 1, 1),
(36, 'Jens', 'Mouris', 13, 1, 1),
(37, 'Pieter', 'Weening', 13, 1, 1),
(38, 'Wout', 'Poels', 15, 1, 1),
(39, 'Bauke', 'Mollema', 17, 1, 1),
(40, 'Mikel', 'Landa', 2, 2, 1),
(41, 'Luis', 'León Sánchez', 2, 2, 1),
(42, 'Samuel', 'Sánchez', 3, 2, 1),
(43, 'Carlos', 'Verona', 5, 2, 1),
(44, 'Vicente', 'Reynès', 8, 2, 1),
(45, 'Rubén', 'Plaza', 9, 2, 1),
(46, 'Rafael', 'Valls', 9, 2, 1),
(47, 'Igor', 'Antón', 12, 2, 1),
(48, 'Jonathan', 'Castroviejo', 12, 2, 1),
(49, 'Imanol', 'Erviti', 12, 2, 1),
(50, 'Rubén', 'Fernández', 12, 2, 1),
(51, 'Jesús', 'Herrada', 12, 2, 1),
(52, 'José', 'Herrada', 12, 2, 1),
(53, 'Beñat', 'Intxausti', 12, 2, 1),
(54, 'Gorka', 'Izagirre', 12, 2, 1),
(55, 'Jon', 'Izagirre', 12, 2, 1),
(56, 'Pablo', 'Lastras', 12, 2, 1),
(57, 'Javier', 'Moreno', 12, 2, 1),
(58, 'Enrique', 'Sanz', 12, 2, 1),
(59, 'Marc', 'Soler', 12, 2, 1),
(60, 'Alejandro', 'Valverde', 12, 2, 1),
(61, 'Francisco', 'Ventoso', 12, 2, 1),
(62, 'Alberto', 'Losada', 14, 2, 1),
(63, 'Daniel', 'Moreno', 14, 2, 1),
(64, 'Joaquim', 'Rodríguez', 14, 2, 1),
(65, 'Ángel', 'Vicioso', 14, 2, 1),
(66, 'David', 'López', 15, 2, 1),
(67, 'Mikel', 'Nieve', 15, 2, 1),
(68, 'Xabier', 'Zandio', 15, 2, 1),
(69, 'Alberto', 'Contador', 16, 2, 1),
(70, 'Jesús', 'Hernández', 16, 2, 1),
(71, 'Markel', 'Irizar', 17, 2, 1),
(72, 'Haimar', 'Zubeldia', 17, 2, 1),
(73, 'Maximiliano', 'Richeze', 9, 3, 1),
(74, 'Rohan', 'Dennis', 3, 3, 1),
(75, 'Cadel', 'Evans', 3, 3, 1),
(76, 'Campbell', 'Flakemore', 3, 3, 1),
(77, 'Nathan', 'Haas', 4, 3, 1),
(78, 'Mark', 'Renshaw', 5, 3, 1),
(79, 'Heinrich', 'Haussler', 8, 3, 1),
(80, 'David', 'Tanner', 8, 3, 1),
(81, 'Adam', 'Hansen', 11, 3, 1),
(82, 'Rory', 'Sutherland', 12, 3, 1),
(83, 'Simon', 'Clarke', 13, 3, 1),
(84, 'Mitchell', 'Docker', 13, 3, 1),
(85, 'Luke', 'Durbridge', 13, 3, 1),
(86, 'Caleb', 'Ewan', 13, 3, 1),
(87, 'Simon', 'Gerrans', 13, 3, 1),
(88, 'Mathew', 'Hayman', 13, 3, 1),
(89, 'Michael', 'Hepburn', 13, 3, 1),
(90, 'Leigh', 'Howard', 13, 3, 1),
(91, 'Damien', 'Howson', 13, 3, 1),
(92, 'Brett', 'Lancaster', 13, 3, 1),
(93, 'Michael', 'Matthews', 13, 3, 1),
(94, 'Cameron', 'Meyer', 13, 3, 1),
(95, 'Nathan', 'Earle', 15, 3, 1),
(96, 'Richie', 'Porte', 15, 3, 1),
(97, 'Chris', 'Sutton', 15, 3, 1),
(98, 'Jay', 'McCarthy', 16, 3, 1),
(99, 'Michael', 'Rogers', 16, 3, 1),
(100, 'Calvin', 'Watson', 17, 3, 1),
(101, 'Jack', 'Bauer', 4, 3, 1),
(102, 'George', 'Bennett', 10, 3, 1),
(103, 'Greg', 'Henderson', 11, 3, 1),
(104, 'Sam', 'Bewley', 13, 3, 1),
(105, 'Hayden', 'Roulston', 17, 3, 1),
(106, 'Jesse', 'Sergent', 17, 3, 1),
(107, 'Mark', 'Cavendish', 5, 4, 1),
(108, 'Alex', 'Dowsett', 12, 4, 1),
(109, 'Adam', 'Blythe', 13, 4, 1),
(110, 'Adam', 'Yates', 13, 4, 1),
(111, 'Simon', 'Yates', 13, 4, 1),
(112, 'Andrew', 'Fenn', 15, 4, 1),
(113, 'Chris', 'Froome', 15, 4, 1),
(114, 'Peter', 'Kennaugh', 15, 4, 1),
(115, 'Luke', 'Rowe', 15, 4, 1),
(116, 'Ian', 'Stannard', 15, 4, 1),
(117, 'Ben', 'Swift', 15, 4, 1),
(118, 'Geraint', 'Thomas', 15, 4, 1),
(119, 'Brent', 'Bookwalter', 3, 5, 1),
(120, 'Taylor', 'Phinney', 3, 5, 1),
(121, 'Joey', 'Rosskopf', 3, 5, 1),
(122, 'Peter', 'Stetina', 3, 5, 1),
(123, 'Nate', 'Brown', 4, 5, 1),
(124, 'Tom', 'Danielson', 4, 5, 1),
(125, 'Joe', 'Dombrowski', 4, 5, 1),
(126, 'Alex', 'Howes', 4, 5, 1),
(127, 'Ben', 'King', 4, 5, 1),
(128, 'Ted', 'King', 4, 5, 1),
(129, 'Andrew', 'Talansky', 4, 5, 1),
(130, 'Lawson', 'Craddock', 7, 5, 1),
(131, 'Caleb', 'Fairly', 7, 5, 1),
(132, 'Chad', 'Haga', 7, 5, 1),
(133, 'Carter', 'Jones', 7, 5, 1),
(134, 'Larry', 'Warbasse', 8, 5, 1),
(135, 'Ian', 'Boswell', 15, 5, 1),
(136, 'Danny', 'Pate', 15, 5, 1),
(137, 'Matthew', 'Busche', 17, 5, 1),
(138, 'Hugo', 'Houle', 1, 5, 1),
(139, 'Ryder', 'Hesjedal', 4, 5, 1),
(140, 'Christian', 'Meier', 13, 5, 1),
(141, 'Svein', 'Tuft', 13, 5, 1),
(142, 'Romain', 'Bardet', 1, 6, 1),
(143, 'Julien', 'Bérard', 1, 6, 1),
(144, 'Guillaume', 'Bonnafond', 1, 6, 1),
(145, 'Mickaël', 'Cherel', 1, 6, 1),
(146, 'Maxime', 'Daniel', 1, 6, 1),
(147, 'Axel', 'Domont', 1, 6, 1),
(148, 'Samuel', 'Dumoulin', 1, 6, 1),
(149, 'Hubert', 'Dupont', 1, 6, 1),
(150, 'Damien', 'Gaudin', 1, 6, 1),
(151, 'Alexis', 'Gougeard', 1, 6, 1),
(152, 'Quentin', 'Jaurégui', 1, 6, 1),
(153, 'Blel', 'Kadri', 1, 6, 1),
(154, 'Pierre-Roger', 'Latour', 1, 6, 1),
(155, 'Sébastien', 'Minard', 1, 6, 1),
(156, 'Lloyd', 'Mondory', 1, 6, 1),
(157, 'Jean-Christophe', 'Péraud', 1, 6, 1),
(158, 'Christophe', 'Riblon', 1, 6, 1),
(159, 'Sébastien', 'Turgot', 1, 6, 1),
(160, 'Alexis', 'Vuillermoz', 1, 6, 1),
(161, 'Amaël', 'Moinard', 3, 6, 1),
(162, 'Julian', 'Alaphilippe', 5, 6, 1),
(163, 'Maxime', 'Bouet', 5, 6, 1),
(164, 'William', 'Bonnet', 6, 6, 1),
(165, 'Sébastien', 'Chavanel', 6, 6, 1),
(166, 'Arnaud', 'Courteille', 6, 6, 1),
(167, 'Mickaël', 'Delage', 6, 6, 1),
(168, 'Arnaud', 'Démare', 6, 6, 1),
(169, 'Kenny', 'Elissonde', 6, 6, 1),
(170, 'Alexandre', 'Geniez', 6, 6, 1),
(171, 'Anthony', 'Geslin', 6, 6, 1),
(172, 'Arnold', 'Jeannesson', 6, 6, 1),
(173, 'Mathieu', 'Ladagnous', 6, 6, 1),
(174, 'Pierre-Henri', 'Lecuisinier', 6, 6, 1),
(175, 'Lorenzo', 'Manzin', 6, 6, 1),
(176, 'Francis', 'Mourey', 6, 6, 1),
(177, 'Yoann', 'Offredo', 6, 6, 1),
(178, 'Laurent', 'Pichon', 6, 6, 1),
(179, 'Cédric', 'Pineau', 6, 6, 1),
(180, 'Thibaut', 'Pinot', 6, 6, 1),
(181, 'Kévin', 'Reza', 6, 6, 1),
(182, 'Anthony', 'Roux', 6, 6, 1),
(183, 'Jérémy', 'Roy', 6, 6, 1),
(184, 'Marc', 'Sarreau', 6, 6, 1),
(185, 'Benoît', 'Vaugrenard', 6, 6, 1),
(186, 'Arthur', 'Vichot', 6, 6, 1),
(187, 'Warren', 'Barguil', 7, 6, 1),
(188, 'Thierry', 'Hupond', 7, 6, 1),
(189, 'Sylvain', 'Chavanel', 8, 6, 1),
(190, 'Clément', 'Chevrier', 8, 6, 1),
(191, 'Jérôme', 'Coppel', 8, 6, 1),
(192, 'Jérôme', 'Pineau', 8, 6, 1),
(193, 'Tony', 'Gallopin', 11, 6, 1),
(194, 'John', 'Gadret', 12, 6, 1),
(195, 'Maxat', 'Ayazbayev', 2, 7, 1),
(196, 'Alexsandr', 'Dyachenko', 2, 7, 1),
(197, 'Daniil', 'Fominykh', 2, 7, 1),
(198, 'Dmitriy', 'Gruzdev', 2, 7, 1),
(199, 'Arman', 'Kamyshev', 2, 7, 1),
(200, 'Bakhtiyar', 'Kozhatayev', 2, 7, 1),
(201, 'Alexey', 'Lutsenko', 2, 7, 1),
(202, 'Ruslan', 'Tleubayev', 2, 7, 1),
(203, 'Andrey', 'Zeits', 2, 7, 1),
(204, 'Aleksejs', 'Saramotins', 8, 7, 1),
(205, 'Gatis', 'Smukulis', 14, 7, 1),
(206, 'Ram?nas', 'Navardauskas', 4, 7, 1),
(207, 'Jan', 'Bakelants', 1, 8, 1),
(208, 'Johan', 'Vansummeren', 1, 8, 1),
(209, 'Philippe', 'Gilbert', 3, 8, 1),
(210, 'Ben', 'Hermans', 3, 8, 1),
(211, 'Klaas', 'Lodewyck', 3, 8, 1),
(212, 'Dylan', 'Teuns', 3, 8, 1),
(213, 'Tom', 'Boonen', 5, 8, 1),
(214, 'Iljo', 'Keisse', 5, 8, 1),
(215, 'Yves', 'Lampaert', 5, 8, 1),
(216, 'Nikolas', 'Maes', 5, 8, 1),
(217, 'Gianni', 'Meersman', 5, 8, 1),
(218, 'Pieter', 'Serry', 5, 8, 1),
(219, 'Stijn', 'Vandenbergh', 5, 8, 1),
(220, 'Julien', 'Vermote', 5, 8, 1),
(221, 'David', 'Boucher', 6, 8, 1),
(222, 'Zico', 'Waeytens', 7, 8, 1),
(223, 'Thomas', 'Degand', 8, 8, 1),
(224, 'Dries', 'Devenyns', 8, 8, 1),
(225, 'Jonas', 'Vangenechten', 8, 8, 1),
(226, 'Sep', 'Vanmarcke', 10, 8, 1),
(227, 'Maarten', 'Wynants', 10, 8, 1),
(228, 'Sander', 'Armée', 11, 8, 1),
(229, 'Tiesj', 'Benoot', 11, 8, 1),
(230, 'Kris', 'Boeckmans', 11, 8, 1),
(231, 'Stig', 'Broeckx', 11, 8, 1),
(232, 'Jens', 'Debusschere', 11, 8, 1),
(233, 'Kenny', 'Dehaes', 11, 8, 1),
(234, 'Gert', 'Dockx', 11, 8, 1),
(235, 'Maxime', 'Monfort', 11, 8, 1),
(236, 'Jürgen', 'Roelandts', 11, 8, 1),
(237, 'Boris', 'Vallée', 11, 8, 1),
(238, 'Dennis', 'Vanendert', 11, 8, 1),
(239, 'Jelle', 'Vanendert', 11, 8, 1),
(240, 'Louis', 'Vervaeke', 11, 8, 1),
(241, 'Tim', 'Wellens', 11, 8, 1),
(242, 'Jens', 'Keukeleire', 13, 8, 1),
(243, 'Stijn', 'Devolder', 17, 8, 1),
(244, 'Jasper', 'Stuyven', 17, 8, 1),
(245, 'Kristof', 'Vandewalle', 17, 8, 1),
(246, 'Nico', 'Denz', 1, 9, 1),
(247, 'Patrick', 'Gretsch', 1, 9, 1),
(248, 'Julian', 'Kern', 1, 9, 1),
(249, 'Marcus', 'Burghardt', 3, 9, 1),
(250, 'Rick', 'Zabel', 3, 9, 1),
(251, 'Ruben', 'Zepuntke', 4, 9, 1),
(252, 'Tony', 'Martin', 5, 9, 1),
(253, 'Nikias', 'Arndt', 7, 9, 1),
(254, 'John', 'Degenkolb', 7, 9, 1),
(255, 'Johannes', 'Fröhlinger', 7, 9, 1),
(256, 'Simon', 'Geschke', 7, 9, 1),
(257, 'Marcel', 'Kittel', 7, 9, 1),
(258, 'Roger', 'Kluge', 8, 9, 1),
(259, 'Paul', 'Martens', 10, 9, 1),
(260, 'Robert', 'Wagner', 10, 9, 1),
(261, 'André', 'Greipel', 11, 9, 1),
(262, 'Marcel', 'Sieberg', 11, 9, 1),
(263, 'Jasha', 'Sütterlin', 12, 9, 1),
(264, 'Rüdiger', 'Selig', 14, 9, 1),
(265, 'Christian', 'Knees', 15, 9, 1),
(266, 'Silvan', 'Dillier', 3, 10, 1),
(267, 'Stefan', 'Küng', 3, 10, 1),
(268, 'Michael', 'Schär', 3, 10, 1),
(269, 'Danilo', 'Wyss', 3, 10, 1),
(270, 'Steve', 'Morabito', 6, 10, 1),
(271, 'Marcel', 'Aregger', 8, 10, 1),
(272, 'Martin', 'Elmiger', 8, 10, 1),
(273, 'Mathias', 'Frank', 8, 10, 1),
(274, 'Jonathan', 'Fumeaux', 8, 10, 1),
(275, 'Reto', 'Hollenstein', 8, 10, 1),
(276, 'Pirmin', 'Lang', 8, 10, 1),
(277, 'Simon', 'Pellaud', 8, 10, 1),
(278, 'Sébastien', 'Reichenbach', 8, 10, 1),
(279, 'Patrick', 'Schelling', 8, 10, 1),
(280, 'Marcel', 'Wyss', 8, 10, 1),
(281, 'Michael', 'Albasini', 13, 10, 1),
(282, 'Oliver', 'Zaugg', 16, 10, 1),
(283, 'Fabian', 'Cancellara', 17, 10, 1),
(284, 'Grégory', 'Rast', 17, 10, 1),
(285, 'Georg', 'Preidler', 7, 10, 1),
(286, 'Matthias', 'Brändle', 8, 10, 1),
(287, 'Stefan', 'Denifl', 8, 10, 1),
(288, 'Marco', 'Haller', 14, 10, 1),
(289, 'Bernhard', 'Eisel', 15, 10, 1),
(290, 'Riccardo', 'Zoidl', 17, 10, 1),
(291, 'Matteo', 'Montaguti', 1, 11, 1),
(292, 'Rinaldo', 'Nocentini', 1, 11, 1),
(293, 'Domenico', 'Pozzovivo', 1, 11, 1),
(294, 'Valerio', 'Agnoli', 2, 11, 1),
(295, 'Fabio', 'Aru', 2, 11, 1),
(296, 'Dario', 'Cataldo', 2, 11, 1),
(297, 'Andrea', 'Guardini', 2, 11, 1),
(298, 'Davide', 'Malacarne', 2, 11, 1),
(299, 'Vincenzo', 'Nibali', 2, 11, 1),
(300, 'Diego', 'Rosa', 2, 11, 1),
(301, 'Michele', 'Scarponi', 2, 11, 1),
(302, 'Paolo', 'Tiralongo', 2, 11, 1),
(303, 'Alessandro', 'Vanotti', 2, 11, 1),
(304, 'Damiano', 'Caruso', 3, 11, 1),
(305, 'Daniel', 'Oss', 3, 11, 1),
(306, 'Manuel', 'Quinziato', 3, 11, 1),
(307, 'Manuel', 'Senni', 3, 11, 1),
(308, 'Alberto', 'Bettiol', 4, 11, 1),
(309, 'Davide', 'Formolo', 4, 11, 1),
(310, 'Alan', 'Marangoni', 4, 11, 1),
(311, 'Moreno', 'Moser', 4, 11, 1),
(312, 'Davide', 'Villella', 4, 11, 1),
(313, 'Gianluca', 'Brambilla', 5, 11, 1),
(314, 'Fabio', 'Sabatini', 5, 11, 1),
(315, 'Matteo', 'Trentin', 5, 11, 1),
(316, 'Matteo', 'Pelucchi', 8, 11, 1),
(317, 'Niccolò', 'Bonifazio', 9, 11, 1),
(318, 'Matteo', 'Bono', 9, 11, 1),
(319, 'Mattia', 'Cattaneo', 9, 11, 1),
(320, 'Davide', 'Cimolai', 9, 11, 1),
(321, 'Valerio', 'Conti', 9, 11, 1),
(322, 'Roberto', 'Ferrari', 9, 11, 1),
(323, 'Sacha', 'Modolo', 9, 11, 1),
(324, 'Manuele', 'Mori', 9, 11, 1),
(325, 'Filippo', 'Pozzato', 9, 11, 1),
(326, 'Diego', 'Ulissi', 9, 11, 1),
(327, 'Eros', 'Capecchi', 12, 11, 1),
(328, 'Adriano', 'Malori', 12, 11, 1),
(329, 'Giovanni', 'Visconti', 12, 11, 1),
(330, 'Ivan', 'Santaromita', 13, 11, 1),
(331, 'Giampaolo', 'Caruso', 14, 11, 1),
(332, 'Jacopo', 'Guarnieri', 14, 11, 1),
(333, 'Luca', 'Paolini', 14, 11, 1),
(334, 'Salvatore', 'Puccio', 15, 11, 1),
(335, 'Elia', 'Viviani', 15, 11, 1),
(336, 'Ivan', 'Basso', 16, 11, 1),
(337, 'Daniele', 'Bennati', 16, 11, 1),
(338, 'Manuele', 'Boaro', 16, 11, 1),
(339, 'Matteo', 'Tosatto', 16, 11, 1),
(340, 'Eugenio', 'Alafaci', 17, 11, 1),
(341, 'Fabio', 'Felline', 17, 11, 1),
(342, 'Giacomo', 'Nizzolo', 17, 11, 1),
(343, 'Marco', 'Coledan', 17, 11, 1),
(344, 'Fumiyuki', 'Beppu', 17, 11, 1),
(345, 'Maxim', 'Belkov', 14, 12, 1),
(346, 'Sergey', 'Chernetskiy', 14, 12, 1),
(347, 'Vladimir', 'Isaichev', 14, 12, 1),
(348, 'Pavel', 'Kochetkov', 14, 12, 1),
(349, 'Alexandr', 'Kolobnev', 14, 12, 1),
(350, 'Dmitry', 'Kozonchuk', 14, 12, 1),
(351, 'Vyacheslav', 'Kuznetsov', 14, 12, 1),
(352, 'Sergey', 'Lagutin', 14, 12, 1),
(353, 'Alexander', 'Porsev', 14, 12, 1),
(354, 'Egor', 'Silin', 14, 12, 1),
(355, 'Yuri', 'Trofimov', 14, 12, 1),
(356, 'Alexei', 'Tsatevich', 14, 12, 1),
(357, 'Eduard', 'Vorganov', 14, 12, 1),
(358, 'Anton', 'Vorobyev', 14, 12, 1),
(359, 'Ilnur', 'Zakarin', 14, 12, 1),
(360, 'Pavel', 'Brutt', 16, 12, 1),
(361, 'Evgeni', 'Petrov', 16, 12, 1),
(362, 'Ivan', 'Rovny', 16, 12, 1),
(363, 'Nikolay', 'Trusov', 16, 12, 1),
(364, 'Ilia', 'Koshevoy', 9, 12, 1),
(365, 'Vasil', 'Kiryienka', 15, 12, 1),
(366, 'Kanstantsin', 'Sivtsov', 15, 12, 1),
(367, 'Ji', 'Cheng', 7, 12, 1),
(368, 'Xu', 'Gang', 9, 12, 1),
(369, 'Andrey', 'Amador', 12, 12, 1),
(370, 'Kristijan', '?urasek', 9, 12, 1),
(371, 'Robert', 'Kišerlovski', 16, 12, 1),
(372, 'Zden?k', 'Štybar', 5, 12, 1),
(373, 'Petr', 'Vako?', 5, 12, 1),
(374, 'Leopold', 'König', 15, 12, 1),
(375, 'Roman', 'Kreuziger', 16, 12, 1),
(376, 'Borut', 'Boži?', 2, 13, 1),
(377, 'Kristijan', 'Koren', 4, 13, 1),
(378, 'Matej', 'Mohori?', 4, 13, 1),
(379, 'Luka', 'Mezgec', 7, 13, 1),
(380, 'Luka', 'Pibernik', 9, 13, 1),
(381, 'Jan', 'Polanc', 9, 13, 1),
(382, 'Simon', 'Špilak', 14, 13, 1),
(383, 'André', 'Cardoso', 4, 14, 1),
(384, 'Mário', 'Costa', 9, 14, 1),
(385, 'Rui', 'Costa', 9, 14, 1),
(386, 'Nelson', 'Oliveira', 9, 14, 1),
(387, 'Tiago', 'Machado', 14, 14, 1),
(388, 'Sérgio', 'Paulinho', 16, 14, 1),
(389, 'Bruno', 'Pires', 16, 14, 1),
(390, 'Fábio', 'Silvestre', 17, 14, 1),
(391, 'Micha?', 'Go?a?', 5, 15, 1),
(392, 'Micha?', 'Kwiatkowski', 5, 15, 1),
(393, '?ukasz', 'Wi?niowski', 5, 15, 1),
(394, 'Przemys?aw', 'Niemiec', 9, 15, 1),
(395, 'Maciej', 'Bodnar', 16, 15, 1),
(396, 'Rafa?', 'Majka', 16, 15, 1),
(397, 'Pawe?', 'Polja?ski', 16, 15, 1),
(398, 'Jakob', 'Fuglsang', 2, 16, 1),
(399, 'Lars', 'Bak', 11, 16, 1),
(400, 'Magnus', 'Cort', 13, 16, 1),
(401, 'Matti', 'Breschel', 16, 16, 1),
(402, 'Jesper', 'Hansen', 16, 16, 1),
(403, 'Christopher', 'Juul-Jensen', 16, 16, 1),
(404, 'Michael', 'Mørkøv', 16, 16, 1),
(405, 'Michael', 'Valgren', 16, 16, 1),
(406, 'Tanel', 'Kangert', 2, 16, 1),
(407, 'Rein', 'Taaramäe', 2, 16, 1),
(408, 'Tsgabu', 'Grmay', 9, 16, 1),
(409, 'Jussi', 'Veikkanen', 6, 16, 1),
(410, 'Kristoffer', 'Skjerping', 4, 16, 1),
(411, 'Vegard', 'Breen', 11, 16, 1),
(412, 'Alexander', 'Kristoff', 14, 16, 1),
(413, 'Murilo', 'Fischer', 6, 17, 1),
(414, 'Carlos', 'Betancur', 1, 17, 1),
(415, 'Darwin', 'Atapuma', 3, 17, 1),
(416, 'Janier', 'Acevedo', 4, 17, 1),
(417, 'Rigoberto', 'Urán', 5, 17, 1),
(418, 'Jarlinson', 'Pantano', 8, 17, 1),
(419, 'José', 'Serpa', 9, 17, 1),
(420, 'Winner', 'Anacona', 12, 17, 1),
(421, 'Dayer', 'Quintana', 12, 17, 1),
(422, 'Nairo', 'Quintana', 12, 17, 1),
(423, 'Esteban', 'Chaves', 13, 17, 1),
(424, 'Sebastián', 'Henao', 15, 17, 1),
(425, 'Sergio', 'Henao', 15, 17, 1),
(426, 'Edward', 'Beltrán', 16, 17, 1),
(427, 'Julián', 'Arredondo', 17, 17, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rennerpunten`
--

CREATE TABLE IF NOT EXISTS `rennerpunten` (
  `id` int(11) NOT NULL,
  `renner_id` int(11) NOT NULL,
  `etappe_id` int(11) NOT NULL,
  `punten` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIES VOOR TABEL `rennerpunten`:
--   `renner_id`
--       `renner` -> `id`
--   `etappe_id`
--       `etappe` -> `id`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `totospeler`
--

CREATE TABLE IF NOT EXISTS `totospeler` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- RELATIES VOOR TABEL `totospeler`:
--

--
-- Gegevens worden geëxporteerd voor tabel `totospeler`
--

INSERT INTO `totospeler` (`id`, `naam`) VALUES
(1, 'testspeler'),
(2, 'Henkie');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `totospelerploeg`
--

CREATE TABLE IF NOT EXISTS `totospelerploeg` (
  `id` int(11) NOT NULL,
  `punten` int(11) NOT NULL,
  `totospeler_id` int(11) NOT NULL,
  `renner_id` int(11) NOT NULL,
  `reserve` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- RELATIES VOOR TABEL `totospelerploeg`:
--   `renner_id`
--       `renner` -> `id`
--   `totospeler_id`
--       `totospeler` -> `id`
--

--
-- Gegevens worden geëxporteerd voor tabel `totospelerploeg`
--

INSERT INTO `totospelerploeg` (`id`, `punten`, `totospeler_id`, `renner_id`, `reserve`) VALUES
(1, 0, 1, 25, 0),
(2, 0, 1, 26, 0),
(3, 0, 1, 27, 0),
(4, 0, 1, 28, 0),
(5, 0, 1, 29, 0),
(6, 0, 1, 30, 0),
(7, 0, 1, 31, 0),
(8, 0, 1, 32, 0),
(9, 0, 1, 33, 0),
(10, 0, 1, 34, 0),
(11, 0, 1, 35, 0),
(12, 0, 1, 36, 0),
(13, 0, 1, 37, 0),
(14, 0, 1, 38, 0),
(15, 0, 1, 39, 0),
(16, 0, 1, 40, 0),
(17, 0, 1, 41, 0),
(18, 0, 1, 42, 0),
(19, 0, 1, 43, 0),
(20, 0, 1, 44, 0),
(21, 0, 1, 45, 1),
(22, 0, 1, 46, 1),
(23, 0, 1, 47, 1),
(24, 0, 1, 48, 1),
(25, 0, 1, 49, 1),
(26, 0, 1, 50, 1),
(27, 10, 2, 1, 0),
(28, 10, 2, 2, 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `etappe`
--
ALTER TABLE `etappe`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `etapperegel`
--
ALTER TABLE `etapperegel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UC` (`etappe_id`,`renner_id`),
  ADD KEY `etapperegel_ibfk_1` (`renner_id`);

--
-- Indexen voor tabel `land`
--
ALTER TABLE `land`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `naam` (`naam`);

--
-- Indexen voor tabel `ploeg`
--
ALTER TABLE `ploeg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `land_id` (`land_id`);

--
-- Indexen voor tabel `renner`
--
ALTER TABLE `renner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `land_id` (`land_id`),
  ADD KEY `ploeg_id` (`ploeg_id`);

--
-- Indexen voor tabel `rennerpunten`
--
ALTER TABLE `rennerpunten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `renner_id` (`renner_id`),
  ADD KEY `etappe_id` (`etappe_id`);

--
-- Indexen voor tabel `totospeler`
--
ALTER TABLE `totospeler`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `totospelerploeg`
--
ALTER TABLE `totospelerploeg`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UCt` (`id`,`renner_id`),
  ADD KEY `renner_id` (`renner_id`),
  ADD KEY `totospeler_id` (`totospeler_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `rennerpunten`
--
ALTER TABLE `rennerpunten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `totospeler`
--
ALTER TABLE `totospeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `totospelerploeg`
--
ALTER TABLE `totospelerploeg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `etapperegel`
--
ALTER TABLE `etapperegel`
  ADD CONSTRAINT `etapperegel_ibfk_1` FOREIGN KEY (`renner_id`) REFERENCES `renner` (`id`),
  ADD CONSTRAINT `etapperegel_ibfk_2` FOREIGN KEY (`etappe_id`) REFERENCES `etappe` (`id`);

--
-- Beperkingen voor tabel `ploeg`
--
ALTER TABLE `ploeg`
  ADD CONSTRAINT `ploeg_ibfk_1` FOREIGN KEY (`land_id`) REFERENCES `land` (`id`);

--
-- Beperkingen voor tabel `renner`
--
ALTER TABLE `renner`
  ADD CONSTRAINT `renner_ibfk_1` FOREIGN KEY (`land_id`) REFERENCES `land` (`id`),
  ADD CONSTRAINT `renner_ibfk_2` FOREIGN KEY (`ploeg_id`) REFERENCES `ploeg` (`id`);

--
-- Beperkingen voor tabel `rennerpunten`
--
ALTER TABLE `rennerpunten`
  ADD CONSTRAINT `rennerpunten_ibfk_1` FOREIGN KEY (`renner_id`) REFERENCES `renner` (`id`),
  ADD CONSTRAINT `rennerpunten_ibfk_2` FOREIGN KEY (`etappe_id`) REFERENCES `etappe` (`id`);

--
-- Beperkingen voor tabel `totospelerploeg`
--
ALTER TABLE `totospelerploeg`
  ADD CONSTRAINT `totospelerploeg_ibfk_1` FOREIGN KEY (`renner_id`) REFERENCES `renner` (`id`),
  ADD CONSTRAINT `totospelerploeg_ibfk_2` FOREIGN KEY (`totospeler_id`) REFERENCES `totospeler` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
