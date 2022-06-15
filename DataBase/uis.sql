-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 15. 06 2022 kl. 14:36:26
-- Serverversion: 10.1.38-MariaDB
-- PHP-version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uis`
--

DELIMITER $$
--
-- Procedurer
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `WriteMessage` (IN `fromP` INT, IN `toP` INT, IN `subjectP` TEXT, IN `textP` TEXT)  INSERT INTO besked
VALUES(
    DEFAULT,
    fromP,
    toP,
    subjectP,
    textP
)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `begivenhed`
--

CREATE TABLE `begivenhed` (
  `EventID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_danish_ci,
  `Subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_danish_ci NOT NULL,
  `EventType` text CHARACTER SET utf8mb4 COLLATE utf8mb4_danish_ci NOT NULL,
  `RequstedAnswer` tinyint(1) NOT NULL DEFAULT '0',
  `AnswerDeadline` date DEFAULT NULL,
  `StartTime` datetime NOT NULL,
  `EndTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Data dump for tabellen `begivenhed`
--

INSERT INTO `begivenhed` (`EventID`, `UserID`, `Text`, `Subject`, `EventType`, `RequstedAnswer`, `AnswerDeadline`, `StartTime`, `EndTime`) VALUES
(7, 25, 'test af Ã¦ndring', 'Inter bruger (Ã¦ndret)', 'Begivenhed', 0, '2022-05-21', '2022-05-21 11:11:00', '2022-05-21 11:11:00'),
(8, 26, 'test', 'Test til video', 'Begivenhed', 1, '2022-05-21', '2022-06-05 11:11:00', '2022-06-08 11:11:00'),
(9, 25, 'test', 'test', 'Begivenhed', 0, '2022-05-21', '2022-05-11 21:11:00', '2022-05-11 11:11:00'),
(10, 1, 'Anmod svar', 'Test om request svar', 'Begivenhed', 1, '2022-05-25', '2022-05-10 11:11:00', '2022-05-27 11:01:00'),
(11, 1, 'no request', 'test af ikke anmod', 'Begivenhed', 0, '2022-05-21', '2022-05-11 11:11:00', '2022-05-21 11:01:00'),
(12, 27, 'test', 'Test til video', 'Begivenhed', 1, '2022-05-21', '2022-06-30 11:01:00', '2022-06-24 11:11:00');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `besked`
--

CREATE TABLE `besked` (
  `BeskedID` int(11) NOT NULL,
  `FromUserID` int(11) NOT NULL,
  `ToUserID` int(11) NOT NULL,
  `Subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_danish_ci NOT NULL,
  `Text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_danish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Data dump for tabellen `besked`
--

INSERT INTO `besked` (`BeskedID`, `FromUserID`, `ToUserID`, `Subject`, `Text`) VALUES
(4, 25, 14, 'Visuel feedback fra submission', 'Test af alert'),
(5, 1, 25, 'Svar pÃ¥ besked', 'Tak for beskeden Mathias'),
(6, 1, 1, 'Jeg kan skrive til mig selv', 'Du er godt nok sej');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `inviterede`
--

CREATE TABLE `inviterede` (
  `UserID` int(11) NOT NULL,
  `EventID` int(11) NOT NULL,
  `Answer` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Data dump for tabellen `inviterede`
--

INSERT INTO `inviterede` (`UserID`, `EventID`, `Answer`) VALUES
(1, 7, NULL),
(25, 8, 0),
(24, 9, NULL),
(14, 0, NULL),
(25, 10, NULL),
(25, 11, NULL),
(25, 12, NULL);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `user`
--

CREATE TABLE `user` (
  `Name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_danish_ci NOT NULL,
  `Password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_danish_ci NOT NULL,
  `Age` int(11) NOT NULL,
  `Role` text CHARACTER SET utf8mb4 COLLATE utf8mb4_danish_ci NOT NULL,
  `SSN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Data dump for tabellen `user`
--

INSERT INTO `user` (`Name`, `Password`, `Age`, `Role`, `SSN`) VALUES
('Carl', '1234', 22, 'Student', 1),
('UiSTest', 'uis', 11, 'student', 14),
('test', 'test', 4, 'test', 24),
('Mathias', '1234', 21, 'Student', 25),
('Fremvisning', 'test', 21, 'Student', 26),
('VideoTest', '1234', 21, 'Video', 27);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `begivenhed`
--
ALTER TABLE `begivenhed`
  ADD PRIMARY KEY (`EventID`);

--
-- Indeks for tabel `besked`
--
ALTER TABLE `besked`
  ADD PRIMARY KEY (`BeskedID`);

--
-- Indeks for tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`SSN`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `begivenhed`
--
ALTER TABLE `begivenhed`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tilføj AUTO_INCREMENT i tabel `besked`
--
ALTER TABLE `besked`
  MODIFY `BeskedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tilføj AUTO_INCREMENT i tabel `user`
--
ALTER TABLE `user`
  MODIFY `SSN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
