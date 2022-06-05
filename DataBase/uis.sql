-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 05. 06 2022 kl. 12:19:46
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
(7, 25, 'Tester at kunne invitere personer', 'Inviter bruger', 'Begivenhed', 1, '2022-06-03', '2022-06-04 10:00:00', '2022-06-04 11:00:00');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `inviterede`
--

CREATE TABLE `inviterede` (
  `InvitationID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `EventID` int(11) NOT NULL,
  `Answer` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Data dump for tabellen `inviterede`
--

INSERT INTO `inviterede` (`InvitationID`, `UserID`, `EventID`, `Answer`) VALUES
(5, 1, 7, NULL);

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
('Mathias', '1234', 21, 'Student', 25);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `begivenhed`
--
ALTER TABLE `begivenhed`
  ADD PRIMARY KEY (`EventID`);

--
-- Indeks for tabel `inviterede`
--
ALTER TABLE `inviterede`
  ADD PRIMARY KEY (`InvitationID`);

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
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tilføj AUTO_INCREMENT i tabel `inviterede`
--
ALTER TABLE `inviterede`
  MODIFY `InvitationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tilføj AUTO_INCREMENT i tabel `user`
--
ALTER TABLE `user`
  MODIFY `SSN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
