-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 20 apr 2017 om 23:19
-- Serverversie: 5.7.14
-- PHP-versie: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medialibrary`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `startDate` datetime DEFAULT NULL,
  `endDate` datetime DEFAULT NULL,
  `Person_id` int(11) NOT NULL,
  `Media_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `media`
--

INSERT INTO `media` (`id`, `type`, `name`, `description`, `category`) VALUES
(20, 'movie', 'Inception', 'A thief, who steals corporate secrets through use of dream-sharing technology, is given the inverse task of planting an idea into the mind of a CEO.', 'bucket'),
(21, 'movie', 'GoldenEye', 'James Bond teams up with the lone survivor of a destroyed Russian research center to stop the hijacking of a nuclear space weapon by a fellow agent formerly believed to be dead.', 'seen'),
(22, 'movie', 'Interstellar', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanitys survival.', 'seen'),
(23, 'movie', 'GoldenEye', 'James Bond teams up with the lone survivor of a destroyed Russian research center to stop the hijacking of a nuclear space weapon by a fellow agent formerly believed to be dead.', 'seen'),
(24, 'movie', 'GoldenEye', 'James Bond teams up with the lone survivor of a destroyed Russian research center to stop the hijacking of a nuclear space weapon by a fellow agent formerly believed to be dead.', 'seen'),
(25, 'movie', 'GoldenEye', 'James Bond teams up with the lone survivor of a destroyed Russian research center to stop the hijacking of a nuclear space weapon by a fellow agent formerly believed to be dead.', 'seen'),
(26, 'movie', 'GoldenEye', 'James Bond teams up with the lone survivor of a destroyed Russian research center to stop the hijacking of a nuclear space weapon by a fellow agent formerly believed to be dead.', 'seen'),
(27, 'movie', 'GoldenEye', 'James Bond teams up with the lone survivor of a destroyed Russian research center to stop the hijacking of a nuclear space weapon by a fellow agent formerly believed to be dead.', 'seen'),
(28, 'movie', 'Interstellar', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanitys survival.', 'seen'),
(29, 'movie', 'Interstellar', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanitys survival.', 'seen'),
(30, 'movie', 'Interstellar', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanitys survival.', 'seen'),
(31, 'movie', 'GoldenEye', 'James Bond teams up with the lone survivor of a destroyed Russian research center to stop the hijacking of a nuclear space weapon by a fellow agent formerly believed to be dead.', 'bucket'),
(32, 'movie', 'GoldenEye', 'James Bond teams up with the lone survivor of a destroyed Russian research center to stop the hijacking of a nuclear space weapon by a fellow agent formerly believed to be dead.', 'bucket'),
(33, 'movie', 'GoldenEye', 'James Bond teams up with the lone survivor of a destroyed Russian research center to stop the hijacking of a nuclear space weapon by a fellow agent formerly believed to be dead.', 'bucket');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `surName` varchar(45) DEFAULT NULL,
  `emailAddress` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `password` varchar(45) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `person`
--

INSERT INTO `person` (`id`, `firstName`, `surName`, `emailAddress`, `age`, `password`, `points`) VALUES
(1, 'Mark', 'Everaert', 'test@test.nl', 25, 'test', 60),
(2, 'Hoa', 'Pham', 'hoa@hoa.nl', 26, 'hoa', 0),
(3, 'Sven', 'de Ronde', 'sven@sven.nl', 20, 'sven', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `person_has_friend`
--

CREATE TABLE `person_has_friend` (
  `Person_id` int(11) NOT NULL,
  `Person_id_friend` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `person_has_friend`
--

INSERT INTO `person_has_friend` (`Person_id`, `Person_id_friend`) VALUES
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `person_has_media`
--

CREATE TABLE `person_has_media` (
  `Person_id` int(11) NOT NULL,
  `Media_id` int(11) NOT NULL,
  `Rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `person_has_media`
--

INSERT INTO `person_has_media` (`Person_id`, `Media_id`, `Rating`) VALUES
(1, 20, NULL),
(1, 21, NULL),
(1, 27, NULL),
(1, 28, NULL),
(1, 29, NULL),
(1, 30, NULL),
(1, 31, NULL),
(1, 32, NULL),
(1, 33, NULL),
(2, 22, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `personId` int(11) DEFAULT NULL,
  `friendId` int(11) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `isAccepted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Activity_Person1_idx` (`Person_id`),
  ADD KEY `fk_Activity_Media1_idx` (`Media_id`);

--
-- Indexen voor tabel `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `person_has_friend`
--
ALTER TABLE `person_has_friend`
  ADD PRIMARY KEY (`Person_id`,`Person_id_friend`),
  ADD KEY `fk_Person_has_Person_Person2_idx` (`Person_id_friend`),
  ADD KEY `fk_Person_has_Person_Person1_idx` (`Person_id`);

--
-- Indexen voor tabel `person_has_media`
--
ALTER TABLE `person_has_media`
  ADD PRIMARY KEY (`Person_id`,`Media_id`),
  ADD KEY `fk_Person_has_Media_Media1_idx` (`Media_id`),
  ADD KEY `fk_Person_has_Media_Person_idx` (`Person_id`);

--
-- Indexen voor tabel `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT voor een tabel `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `fk_Activity_Media1` FOREIGN KEY (`Media_id`) REFERENCES `media` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Activity_Person1` FOREIGN KEY (`Person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `person_has_friend`
--
ALTER TABLE `person_has_friend`
  ADD CONSTRAINT `fk_Person_has_Person_Person1` FOREIGN KEY (`Person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Person_has_Person_Person2` FOREIGN KEY (`Person_id_friend`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `person_has_media`
--
ALTER TABLE `person_has_media`
  ADD CONSTRAINT `fk_Person_has_Media_Media1` FOREIGN KEY (`Media_id`) REFERENCES `media` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Person_has_Media_Person` FOREIGN KEY (`Person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
