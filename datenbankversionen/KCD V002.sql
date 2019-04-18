-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 18. Apr 2019 um 12:24
-- Server-Version: 10.1.38-MariaDB
-- PHP-Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `kcd`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `images`
--

CREATE TABLE `images` (
  `ImageID` int(11) NOT NULL,
  `ImageTitle` varchar(500) NOT NULL,
  `ImageComment` varchar(5000) NOT NULL,
  `ImageDir` varchar(500) NOT NULL,
  `UploadedBy` int(11) DEFAULT NULL,
  `UploadedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `images`
--

INSERT INTO `images` (`ImageID`, `ImageTitle`, `ImageComment`, `ImageDir`, `UploadedBy`, `UploadedAt`) VALUES
(11, 'Titel (manuell)', 'Komeedsalkjfjakh (Kommentar)', '/KCD/resources/images/uploadedImages/0038e03ffbfe4a63a3bd0821d0334d68schallplatte-169320.jpg', 4, '2019-04-11'),
(12, 'Test2', 'meeeeeeeeeeeeeeeehr Text', '/KCD/resources/images/uploadedImages/bad30683a3bd592a090588d544178f73black-wallpaper-pc-9.jpg', 4, '2019-04-11'),
(13, 'Schmales Bild', 'fdjklsajflkdal', '/KCD/resources/images/uploadedImages/049b165dd7350ae016dded637a69eb1bScreenshot from 2019-04-01 12-01-54.png', 4, '2019-04-11'),
(14, 'Bester Verein der Welt', 'Wenn du aus Dortmund kommst, schieÃŸt Geld hier keine Tore.  Wenn du aus der Hauptstadt kommst,  scheiÃŸen wir auf dich und dein Lied.  Wenn du aus Leverkusen kommst,  dann lass den Torwart gleich zu Hause.  Wenn du auf Schalke kommst,  ist das fÃ¼r uns ein AuswÃ¤rtssieg. Wenn ich weit weit weg bin,ob bei Juve oder Rom dann denk ich Hamburg meine Perle und singe home sweet home.', '/KCD/resources/images/uploadedImages/4daf9e7626a793a8d28a4abef1ab27a02000px-HSV-Logo.svg.png', 4, '2019-04-17'),
(15, 'dsfsad', 'fdgds', '/KCD/resources/images/uploadedImages/8f08ce10b60cf4ef5bf1b19778c73f18Sample.png', 4, '2019-04-17'),
(16, 'dvfd', 'jkhkjh', '/KCD/resources/images/uploadedImages/ab3744c4a189570216f06b5060fa72efSample.png', 4, '2019-04-17'),
(17, 'dvfdfjlkdsajflkdsa', 'jkhkjh', '/KCD/resources/images/uploadedImages/d8ef4c9c10811f350f68e097d21cee6bSample.png', 4, '2019-04-17');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`ImageID`),
  ADD KEY `UploadedBy` (`UploadedBy`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `images`
--
ALTER TABLE `images`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `Uploaded by user` FOREIGN KEY (`UploadedBy`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
