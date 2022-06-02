-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 02. 06 2022 kl. 08:52:46
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

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `begivenhed`
--

CREATE TABLE `begivenhed` (
  `EventID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Text` text COLLATE utf8mb4_danish_ci,
  `Subject` text COLLATE utf8mb4_danish_ci NOT NULL,
  `EventType` text COLLATE utf8mb4_danish_ci NOT NULL,
  `RequstedAnswer` tinyint(1) NOT NULL DEFAULT '0',
  `AnswerDeadline` date DEFAULT NULL,
  `StartTime` datetime NOT NULL,
  `EndTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_danish_ci;

--
-- Data dump for tabellen `begivenhed`
--

INSERT INTO `begivenhed` (`EventID`, `UserID`, `Text`, `Subject`, `EventType`, `RequstedAnswer`, `AnswerDeadline`, `StartTime`, `EndTime`) VALUES
(73, 14, 'test', 'test', 'volvo', 0, '2022-05-21', '2022-05-21 22:52:00', '2022-05-21 21:53:00'),
(74, 24, 'logged', 'logged', 'volvo', 0, '2022-05-21', '2022-05-21 21:55:00', '2022-05-21 01:00:00');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `inviterede`
--

CREATE TABLE `inviterede` (
  `UserID` int(11) NOT NULL,
  `EventID` int(11) NOT NULL,
  `Answer` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_danish_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `user`
--

CREATE TABLE `user` (
  `Name` text COLLATE utf8mb4_danish_ci NOT NULL,
  `Password` text COLLATE utf8mb4_danish_ci NOT NULL,
  `Age` int(11) NOT NULL,
  `Role` text COLLATE utf8mb4_danish_ci NOT NULL,
  `SSN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_danish_ci;

--
-- Data dump for tabellen `user`
--

INSERT INTO `user` (`Name`, `Password`, `Age`, `Role`, `SSN`) VALUES
('UiSTest', 'uis', 11, 'student', 14),
('test', 'test', 4, 'test', 24);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `begivenhed`
--
ALTER TABLE `begivenhed`
  ADD PRIMARY KEY (`EventID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indeks for tabel `inviterede`
--
ALTER TABLE `inviterede`
  ADD UNIQUE KEY `UserID` (`UserID`),
  ADD UNIQUE KEY `EventID` (`EventID`);

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
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Tilføj AUTO_INCREMENT i tabel `user`
--
ALTER TABLE `user`
  MODIFY `SSN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `begivenhed`
--
ALTER TABLE `begivenhed`
  ADD CONSTRAINT `begivenhed_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`SSN`);

--
-- Begrænsninger for tabel `inviterede`
--
ALTER TABLE `inviterede`
  ADD CONSTRAINT `inviterede_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`SSN`),
  ADD CONSTRAINT `inviterede_ibfk_2` FOREIGN KEY (`EventID`) REFERENCES `begivenhed` (`EventID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
